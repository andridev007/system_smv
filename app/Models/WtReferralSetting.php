<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WtReferralSetting extends Model
{
    protected $table = 'wt_referral_setting';

    protected $primaryKey = 'id_referral_setting';

    public $timestamps = false;

    protected $fillable = [
        'level_referral_setting',
        'persen_referral_setting',
    ];

    protected $casts = [
        'persen_referral_setting' => 'decimal:4',
    ];
}
