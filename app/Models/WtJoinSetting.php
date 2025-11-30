<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WtJoinSetting extends Model
{
    protected $table = 'wt_join_setting';

    protected $primaryKey = 'id_join_setting';

    public $timestamps = false;

    protected $fillable = [
        'min_join',
    ];

    protected $casts = [
        'min_join' => 'decimal:2',
    ];
}
