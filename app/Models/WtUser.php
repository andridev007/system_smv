<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WtUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wt_user';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_user';

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
        'id_user',
        'username',
        'email',
        'phone',
        'full_name',
        'referral_code',
        'referred_by',
        'balance',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'balance' => 'double',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the joins for the user.
     */
    public function joins(): HasMany
    {
        return $this->hasMany(WtJoin::class, 'id_user', 'id_user');
    }

    /**
     * Get the profit shares for the user.
     */
    public function profitShares(): HasMany
    {
        return $this->hasMany(WtProfitShare::class, 'id_user', 'id_user');
    }

    /**
     * Get the referrals made by the user.
     */
    public function referrals(): HasMany
    {
        return $this->hasMany(WtReferral::class, 'id_user', 'id_user');
    }

    /**
     * Get the withdrawals for the user.
     */
    public function withdrawals(): HasMany
    {
        return $this->hasMany(WtWithdraw::class, 'id_user', 'id_user');
    }
}
