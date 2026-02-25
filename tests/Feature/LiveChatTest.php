<?php

use App\Models\AdminChatSetting;
use App\Models\ChatMessage;
use App\Models\LiveChat;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

const ADMIN_USERNAME = 'RevandAdmin33';

function getAdmin() {
    return User::firstOrCreate([
        'username' => ADMIN_USERNAME
    ], [
        'name' => 'Admin Test',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
    ]);
}

it('can check admin status', function () {
    $response = get(route('livechat.status'));
    $response->assertStatus(200)
             ->assertJsonStructure(['is_online', 'active_count', 'waiting_count', 'max_active']);
});

it('returns offline status when admin is not online', function () {
    AdminChatSetting::getSettings()->update(['is_online' => false]);
    
    $response = post(route('livechat.start'), [
        'visitor_name' => 'John Doe',
        'session_id' => 'test-session'
    ]);
    
    $response->assertStatus(200)
             ->assertJson(['success' => false, 'reason' => 'offline']);
});

it('can start a chat when admin is online', function () {
    AdminChatSetting::getSettings()->update(['is_online' => true]);
    
    $response = post(route('livechat.start'), [
        'visitor_name' => 'John Doe',
        'session_id' => 'test-session'
    ]);
    
    $response->assertStatus(200)
             ->assertJson(['success' => true])
             ->assertJsonPath('chat.status', 'active');
             
    expect(LiveChat::count())->toBe(1);
});

it('queues chats when max active is reached', function () {
    AdminChatSetting::getSettings()->update(['is_online' => true, 'max_active_chats' => 1]);
    
    // First chat (active)
    post(route('livechat.start'), ['visitor_name' => 'User 1', 'session_id' => 's1']);
    
    // Second chat (waiting)
    $response = post(route('livechat.start'), [
        'visitor_name' => 'User 2', 
        'session_id' => 's2'
    ]);
    
    $response->assertStatus(200)
             ->assertJsonPath('chat.status', 'waiting')
             ->assertJsonPath('chat.queue_position', 1);
});

it('can send and poll messages', function () {
    AdminChatSetting::getSettings()->update(['is_online' => true]);
    $chat = LiveChat::create([
        'visitor_name' => 'John', 
        'session_id' => 'sid', 
        'status' => 'active'
    ]);
    
    // Send message
    $response = post(route('livechat.send'), [
        'session_id' => 'sid',
        'message' => 'Hello admin'
    ]);
    $response->assertStatus(200)->assertJson(['success' => true]);
    
    // Poll message
    $pollResponse = get(route('livechat.poll', ['sessionId' => 'sid']));
    $pollResponse->assertStatus(200)
                 ->assertJsonCount(1, 'messages');
});

it('admin can toggle online status', function () {
    actingAs(getAdmin());
    
    $settings = AdminChatSetting::getSettings();
    $initialStatus = $settings->is_online;
    
    $response = post(route('admin.livechat.toggle'));
    $response->assertStatus(200);
    
    expect(AdminChatSetting::getSettings()->is_online)->not->toBe($initialStatus);
});

it('admin can reply and end chat', function () {
    actingAs(getAdmin());
    AdminChatSetting::getSettings()->update(['is_online' => true]);
    
    $chat = LiveChat::create([
        'visitor_name' => 'John', 
        'session_id' => 'sid', 
        'status' => 'active'
    ]);
    
    // Admin reply
    $response = post(route('admin.livechat.reply', $chat), ['message' => 'Hello back']);
    $response->assertStatus(200)->assertJson(['success' => true]);
    
    // End chat
    $endResponse = post(route('admin.livechat.end', $chat));
    $endResponse->assertStatus(200);
    
    expect($chat->fresh()->status)->toBe('done');
});

it('auto-promotes waiting chat when active chat ends', function () {
    $this->withoutExceptionHandling();
    actingAs(getAdmin());
    AdminChatSetting::getSettings()->update(['is_online' => true, 'max_active_chats' => 1]);
    
    $active = LiveChat::create(['visitor_name' => 'Active', 'session_id' => 's1', 'status' => 'active', 'started_at' => now()]);
    usleep(100000); // 100ms
    $waiting = LiveChat::create(['visitor_name' => 'Waiting', 'session_id' => 's2', 'status' => 'waiting']);
    
    // End active chat
    post(route('admin.livechat.end', $active));
    
    expect($waiting->fresh()->status)->toBe('active');
});

it('allows user to end their own chat', function () {
    $chat = LiveChat::create([
        'visitor_name' => 'User',
        'session_id' => 'user-session',
        'status' => 'active',
        'started_at' => now()
    ]);

    post(route('livechat.end'), [
        'session_id' => 'user-session'
    ])->assertSuccessful();

    expect($chat->fresh()->status)->toBe('done');
    expect($chat->fresh()->ended_at)->not->toBeNull();
});

it('admin can delete a chat history', function () {
    actingAs(getAdmin());
    
    $chat = LiveChat::create([
        'visitor_name' => 'To be deleted',
        'session_id' => 'del-session',
        'status' => 'done'
    ]);
    
    ChatMessage::create([
        'live_chat_id' => $chat->id,
        'sender' => 'user',
        'message' => 'Secret message'
    ]);
    
    expect(LiveChat::count())->toBe(1);
    expect(ChatMessage::count())->toBe(1);
    
    $response = $this->delete(route('admin.livechat.destroy', $chat));
    $response->assertSuccessful();
    
    expect(LiveChat::count())->toBe(0);
    expect(ChatMessage::count())->toBe(0);
});
