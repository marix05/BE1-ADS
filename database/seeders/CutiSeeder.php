<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cuti;
use App\Models\Karyawan;

class CutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cutiData = [
            [
                'noInduk' => 'IP06001',
                'tglCuti' => '2020-08-02',
                'lamaCuti' => 2,
                'keterangan' => 'Acara Keluarga',
            ],
            [
                'noInduk' => 'IP06001',
                'tglCuti' => '2020-08-18',
                'lamaCuti' => 2,
                'keterangan' => 'Anak Sakit',
            ],
            [
                'noInduk' => 'IP06006',
                'tglCuti' => '2020-08-19',
                'lamaCuti' => 1,
                'keterangan' => 'Nenek Sakit',
            ],
            [
                'noInduk' => 'IP06007',
                'tglCuti' => '2020-08-23',
                'lamaCuti' => 1,
                'keterangan' => 'Sakit',
            ],
            [
                'noInduk' => 'IP06004',
                'tglCuti' => '2020-08-29',
                'lamaCuti' => 5,
                'keterangan' => 'Menikah',
            ],
            [
                'noInduk' => 'IP06003',
                'tglCuti' => '2020-08-30',
                'lamaCuti' => 2,
                'keterangan' => 'Acara Keluarga',
            ],
        ];

        foreach ($cutiData as $cuti) {
            // mencari data kryawan berdasarkan noInduk
            $karyawan = Karyawan::where('noInduk', $cuti['noInduk'])->first();

            // apabila data karyawan ditemukan
            if ($karyawan) {
                Cuti::create($cuti);
            }
        }
    }
}
