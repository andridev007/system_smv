<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Referral Levels
            [
                'key' => 'referral_level_1',
                'value' => '7',
                'type' => 'referral',
            ],
            [
                'key' => 'referral_level_2',
                'value' => '3',
                'type' => 'referral',
            ],
            [
                'key' => 'referral_level_3',
                'value' => '3',
                'type' => 'referral',
            ],
            [
                'key' => 'referral_level_4',
                'value' => '1',
                'type' => 'referral',
            ],
            [
                'key' => 'referral_level_5',
                'value' => '1',
                'type' => 'referral',
            ],
            [
                'key' => 'referral_level_6',
                'value' => '0.5',
                'type' => 'referral',
            ],
            [
                'key' => 'referral_level_7',
                'value' => '0.5',
                'type' => 'referral',
            ],
            [
                'key' => 'referral_level_8',
                'value' => '0.5',
                'type' => 'referral',
            ],
            [
                'key' => 'referral_level_9',
                'value' => '0.5',
                'type' => 'referral',
            ],
            // Withdraw Fee
            [
                'key' => 'withdraw_fee',
                'value' => '3.12',
                'type' => 'withdraw',
            ],
            // License Fee
            [
                'key' => 'license_fee',
                'value' => '10',
                'type' => 'program',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
