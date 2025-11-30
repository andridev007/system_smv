<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WtAdmin extends Model
{
    protected $table = 'wt_admin';

    protected $primaryKey = 'id_admin';

    public $timestamps = false;

    protected $fillable = [
        'nama_admin',
        'foto_admin',
        'level_admin',
    ];

    /**
     * Get the admin key associated with the admin.
     */
    public function adminKey(): HasOne
    {
        return $this->hasOne(WtAdminKey::class, 'id_admin', 'id_admin');
    }
}
