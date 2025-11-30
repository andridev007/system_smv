<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WtAdminKey extends Model
{
    protected $table = 'wt_admin_key';

    protected $primaryKey = 'id_admin';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id_admin',
        'username',
        'adminpass',
    ];

    /**
     * Get the admin that owns the key.
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(WtAdmin::class, 'id_admin', 'id_admin');
    }
}
