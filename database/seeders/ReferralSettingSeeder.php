<?php

namespace Database\Seeders;

use App\Models\ReferralSetting;
use Illuminate\Database\Seeder;

class ReferralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Referral percentages by level: 7%, 3%, 3%, 1%, 1%, 0.5%, 0.5%, 0.5%, 0.5%
        $percentages = [7, 3, 3, 1, 1, 0.5, 0.5, 0.5, 0.5];

        foreach ($percentages as $index => $percentage) {
            $level = $index + 1;

            // Create referral_join type setting
            ReferralSetting::create([
                'level' => $level,
                'percentage' => $percentage,
                'type' => 'referral_join',
            ]);

            // Create profit_share type setting
            ReferralSetting::create([
                'level' => $level,
                'percentage' => $percentage,
                'type' => 'profit_share',
            ]);
        }
    }
}
