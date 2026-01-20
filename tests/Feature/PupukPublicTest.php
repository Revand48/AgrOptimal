<?php

namespace Tests\Feature;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Publikasi;
use App\Models\Pupuk;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PupukPublicTest extends TestCase
{
    use RefreshDatabase;

    public function test_pupuk_api_returns_correct_json_data()
    {
        // Setup data
        $kecamatan = Kecamatan::factory()->create(['nama' => 'Kecamatan Test', 'is_active' => true]);
        $desa = Desa::factory()->create(['nama' => 'Desa Test', 'kecamatan_id' => $kecamatan->id, 'is_active' => true]);
        $pupuk = Pupuk::factory()->create(['nama' => 'Pupuk Test', 'kategori' => 'Subsidi', 'kg_per_sak' => 50]);
        
        Publikasi::create([
            'desa_id' => $desa->id,
            'pupuk_id' => $pupuk->id,
            'jumlah_sak' => 100,
            'is_publish' => true,
        ]);

        // Call API
        $response = $this->getJson(route('pupuk.api'));

        // Assert
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'jenis',
                        'kategori',
                        'sak',
                        'kg_per_sak',
                        'lokasi',
                        'status',
                        'kecamatan',
                        'desa',
                    ]
                ],
                'last_update'
            ])
            ->assertJsonFragment([
                'jenis' => 'Pupuk Test',
                'sak' => 100,
                'lokasi' => 'Gudang Desa Test',
                'kecamatan' => 'Kecamatan Test',
            ]);
    }
}
