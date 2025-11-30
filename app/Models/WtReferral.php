<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WtReferral extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wt_referral';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_referral';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_referral',
        'id_user',
        'id_referred_user',
        'bonus_amount',
        'commission_percentage',
        'level',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'bonus_amount' => 'double',
        'commission_percentage' => 'double',
        'level' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user (referrer) that owns the referral.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(WtUser::class, 'id_user', 'id_user');
    }

    /**
     * Get the referred user.
     */
    public function referredUser(): BelongsTo
    {
        return $this->belongsTo(WtUser::class, 'id_referred_user', 'id_user');
    }
}
