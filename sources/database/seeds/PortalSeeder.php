<?php

use Illuminate\Database\Seeder;

class PortalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('portals')->insert([
            'name' => 'Portal Pelaporan Covid 19',
            'site_title' => 'Portal Pelaporan Covid 19',
            'site_description' => 'Portal Pelaporan Covid 19',
            'site_logo' => null,
            'meta_description' => null,
            'meta_keyword' => null,
            'email_address' => null,
            'mail_port' => null,
            'mail_username' => null,
            'mail_password' => null,
            'mail_encryption' => null,
        ]);
    }
}
