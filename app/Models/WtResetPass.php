<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WtResetPass extends Model
{
    protected $table = 'wt_reset_pass';

    protected $primaryKey = 'id_reset';

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'token',
        'expired',
    ];

    protected $casts = [
        'expired' => 'datetime',
    ];

    /**
     * Get the user that owns the password reset.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(WtUser::class, 'id_user', 'id_user');
    }
}
