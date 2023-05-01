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
            'name' => 'Rania Sport',
            'title_slider_1' => 'New Accessories Collections',
            'title_slider_2' => 'Headphones Speaker',
            'title_slider_3' => 'Modern Furniture, Armchair',
            'desc_slider_1' => 'Launch your campaign and benefit from our expertise on designing and managing conversion centered bootstrap v5 html page.',
            'desc_slider_2' => 'Launch your campaign and benefit from our expertise on designing and managing conversion centered bootstrap v5 html page.',
            'desc_slider_3' => 'Launch your campaign and benefit from our expertise on designing and managing conversion centered bootstrap v5 html page.',
            'title_cta' => 'End of Season Clearance Sale upto 30%',
            'desc_cta' => 'Launch your campaign and benefit from our expertise on designing and managing conversion centered bootstrap v5 html page.',
            'about_footer' => 'Start working with Landrick that can provide everything you.',
        ]);
    }
}
