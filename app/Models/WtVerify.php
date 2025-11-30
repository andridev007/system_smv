<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WtVerify extends Model
{
    protected $table = 'wt_verify';

    protected $primaryKey = 'id_user';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'email',
        'code',
        'expired',
    ];

    protected $casts = [
        'expired' => 'datetime',
    ];

    /**
     * Get the user that owns the verification.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(WtUser::class, 'id_user', 'id_user');
    }
}
