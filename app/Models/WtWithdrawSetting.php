<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WtWithdrawSetting extends Model
{
    protected $table = 'wt_withdraw_setting';

    protected $primaryKey = 'id_withdraw_setting';

    public $timestamps = false;

    protected $fillable = [
        'min_withdraw',
        'fee_withdraw',
    ];

    protected $casts = [
        'min_withdraw' => 'decimal:2',
        'fee_withdraw' => 'decimal:4',
    ];
}
