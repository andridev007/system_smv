<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WtGeneralKey extends Model
{
    protected $table = 'wt_general_key';

    protected $primaryKey = 'id_key';

    public $timestamps = false;

    protected $fillable = [
        'general_key',
    ];
}
