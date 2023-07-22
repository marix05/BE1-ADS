<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Karyawan;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $karyawanData = [
            [
                'noInduk' => 'IP06001',
                'nama' => 'Agus',
                'alamat' => 'Jln Gaja Mada no 12, Surabaya',
                'tglLahir' => '1980-01-11',
                'tglBergabung' => '2005-08-07',
            ],
            [
                'noInduk' => 'IP06002',
                'nama' => 'Amin',
                'alamat' => 'Jln Imam Bonjol no 11, Mojokerto',
                'tglLahir' => '1977-09-03',
                'tglBergabung' => '2005-08-07',
            ],
            [
                'noInduk' => 'IP06003',
                'nama' => 'Yusuf',
                'alamat' => 'Jln A Yani Raya 15 No 14 Malang',
                'tglLahir' => '1973-08-09',
                'tglBergabung' => '2006-08-07',
            ],
            [
                'noInduk' => 'IP06004',
                'nama' => 'Alyssa',
                'alamat' => 'Jln Bungur Sari V no 166, Bandung',
                'tglLahir' => '1983-03-18',
                'tglBergabung' => '2006-09-06',
            ],
            [
                'noInduk' => 'IP06005',
                'nama' => 'Maulana',
                'alamat' => 'Jln Candi Agung, No 78 Gg 5, Jakarta',
                'tglLahir' => '1978-11-10',
                'tglBergabung' => '2006-09-10',
            ],
            [
                'noInduk' => 'IP06006',
                'nama' => 'Agfika',
                'alamat' => 'Jln Nangka, Jakarta Timur',
                'tglLahir' => '1979-02-07',
                'tglBergabung' => '2007-01-02',
            ],
            [
                'noInduk' => 'IP06007',
                'nama' => 'James',
                'alamat' => 'Jln Merpati, 8 Surabaya',
                'tglLahir' => '1989-05-18',
                'tglBergabung' => '2007-04-04',
            ],
            [
                'noInduk' => 'IP06008',
                'nama' => 'Octavanus',
                'alamat' => 'Jln A Yani 17, B 08 Sidoarjo',
                'tglLahir' => '1985-04-14',
                'tglBergabung' => '2007-05-19',
            ],
            [
                'noInduk' => 'IP06009',
                'nama' => 'Nugroho',
                'alamat' => 'Jln Duren tiga 167, Jakarta Selatan',
                'tglLahir' => '1984-01-01',
                'tglBergabung' => '2008-01-16',
            ],
            [
                'noInduk' => 'IP06010',
                'nama' => 'Raisa',
                'alamat' => 'Jln Kelapa Sawit, Jakarta Selatan',
                'tglLahir' => '1990-12-17',
                'tglBergabung' => '2008-08-16',
            ],
        ];

        foreach ($karyawanData as $karyawan) {
            Karyawan::create($karyawan);
        }
    }
}
