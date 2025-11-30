<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WtContact extends Model
{
    protected $table = 'wt_contact';

    protected $primaryKey = 'id_kontak';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'subyek',
        'pesan',
        'status_kontak',
        'tgl_kontak',
    ];

    protected $casts = [
        'tgl_kontak' => 'datetime',
    ];
}
