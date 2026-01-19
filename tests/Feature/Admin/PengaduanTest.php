<?php

namespace Tests\Feature\Admin;

use App\Models\HomePengaduan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PengaduanTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_pengaduan_and_status_updates_to_read()
    {
        // Create a pengaduan with status 'baru'
        $pengaduan = HomePengaduan::create([
            'kategori' => 'Pertanyaan',
            'nama' => 'Test User',
            'no_whatsapp' => '08123456789',
            'pesan' => 'Ini adalah pesan pengaduan',
            'status' => 'baru', // Initially 'baru'
        ]);

        // Assert initial status is 'baru'
        $this->assertEquals('baru', $pengaduan->status);

        // Act: Admin views the pengaduan detail
        // Assuming there is an admin authentication or the route is protected
        // For now, testing the logic directly or via route if public/protected
        // Check routes/web.php: Route::get('/{pengaduan}', [HomeAdminController::class, 'pengaduanShow'])->name('admin.pengaduan.show');
        
        // Simulating the request
        $response = $this->get(route('admin.pengaduan.show', $pengaduan));

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.home.pengaduan.show');

        // Refresh model to get updated data from database
        $pengaduan->refresh();

        // Assert status updated to 'dibaca'
        $this->assertEquals('dibaca', $pengaduan->status);
    }
}
