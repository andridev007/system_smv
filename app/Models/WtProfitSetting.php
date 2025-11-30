<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WtProfitSetting extends Model
{
    protected $table = 'wt_profit_setting';

    protected $primaryKey = 'id_profit_setting';

    public $timestamps = false;

    protected $fillable = [
        'level_profit_setting',
        'persen_profit_setting',
    ];

    protected $casts = [
        'persen_profit_setting' => 'decimal:4',
    ];
}
