<?php

namespace Tests\Feature\Admin;

use App\Models\Pupuk;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PupukAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_pupuk_with_jumlah_sak()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($user)->post(route('admin.pupuk.store'), [
            'nama' => 'Pupuk Test',
            'kategori' => 'Subsidi',
            'kg_per_sak' => 50,
            'jumlah_sak' => 100,
        ]);

        $response->assertRedirect(route('admin.pupuk.index'));
        $this->assertDatabaseHas('pupuks', [
            'nama' => 'Pupuk Test',
            'kategori' => 'Subsidi',
            'kg_per_sak' => 50,
            'jumlah_sak' => 100,
        ]);
    }

    public function test_admin_can_update_pupuk_with_jumlah_sak()
    {
        $pupuk = Pupuk::create([
            'nama' => 'Pupuk Awal',
            'kategori' => 'Non Subsidi',
            'kg_per_sak' => 50,
            'jumlah_sak' => 10,
        ]);

        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)->put(route('admin.pupuk.update', $pupuk), [
            'nama' => 'Pupuk Update',
            'kategori' => 'Subsidi',
            'kg_per_sak' => 25,
            'jumlah_sak' => 200,
        ]);

        $response->assertRedirect(route('admin.pupuk.index'));
        $this->assertDatabaseHas('pupuks', [
            'id' => $pupuk->id,
            'nama' => 'Pupuk Update',
            'kategori' => 'Subsidi',
            'kg_per_sak' => 25,
            'jumlah_sak' => 200,
        ]);
    }
}
