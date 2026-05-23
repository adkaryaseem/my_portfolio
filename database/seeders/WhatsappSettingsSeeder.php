<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WhatsappSetting;

class WhatsappSettingsSeeder extends Seeder
{
    public function run(): void
    {
        WhatsappSetting::updateOrCreate(
            ['id' => 1],
            [
                'country_code' => '977',
                'phone_number' => '0000000000',
                'api_key'      => 'placeholder'
            ]
        );
    }
}
