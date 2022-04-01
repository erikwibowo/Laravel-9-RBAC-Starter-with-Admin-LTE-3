<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'key'       => 'app_name',
            'value'     => 'Laravel RBAC Starter',
            'name'      => 'Application Short Name',
            'type'      => 'text',
            'category'  => 'information'
        ]);
        Setting::create([
            'key'       => 'app_short_name',
            'value'     => 'Laravel',
            'name'      => 'Application Name',
            'type'      => 'text',
            'category'  => 'information'
        ]);
        Setting::create([
            'key'       => 'app_logo',
            'value'     => 'storage/logo.png',
            'name'      => 'Application Logo',
            'type'      => 'file',
            'ext'       => 'png',
            'category'  => 'information'
        ]);
        Setting::create([
            'key'       => 'app_favicon',
            'value'     => 'storage/favicon.png',
            'name'      => 'Application Favicon',
            'type'      => 'file',
            'ext'       => 'png'
        ]);
        Setting::create([
            'key'       => 'app_loading_gif',
            'value'     => 'storage/loading.gif',
            'name'      => 'Application Loading Image',
            'type'      => 'file',
            'ext'       => 'gif',
            'category'  => 'information'
        ]);
        Setting::create([
            'key'       => 'app_map_loaction',
            'value'     => 'https://www.google.com/maps/place/Kajen,+Kec.+Kajen,+Kabupaten+Pekalongan,+Jawa+Tengah/@-7.0319606,109.5291791,13z/data=!3m1!4b1!4m5!3m4!1s0x2e6fe01fab873f61:0xc109484cee38731e!8m2!3d-7.0269252!4d109.5811772',
            'name'      => 'Application Map Location',
            'type'      => 'textarea',
            'category'  => 'contact'
        ]);
    }
}
