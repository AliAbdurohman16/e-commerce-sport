<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'title_slider' => 'Selamat Datang di Rania Sport!',
            'desc_slider' => 'Nikmati pengalaman berbelanja online yang mudah, cepat, dan aman untuk produk olahraga favorit Anda.',
            'name_bank' => 'BRI',
            'no_rek' => '3209832839923',
            'about_footer' => 'Kami adalah toko online yang menghadirkan pilihan lengkap perlengkapan olahraga dari berbagai kategori.',
        ]);
    }
}
