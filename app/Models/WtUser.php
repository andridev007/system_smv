<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WtUser extends Model
{
    protected $table = 'wt_user';

    protected $primaryKey = 'id_user';

    public $timestamps = false;

    protected $fillable = [
        'no_id',
        'username',
        'nama_user',
        'foto_user',
        'email',
        'hp',
        'nama_bank',
        'rek_bank',
        'referral',
        'id_user_referral',
        'acc_status',
        'status_suspend',
        'wd_status',
    ];

    /**
     * Get the user key associated with the user.
     */
    public function userKey(): HasOne
    {
        return $this->hasOne(WtUserKey::class, 'id_user', 'id_user');
    }

    /**
     * Get the referrer user.
     */
    public function referrer(): BelongsTo
    {
        return $this->belongsTo(WtUser::class, 'id_user_referral', 'id_user');
    }

    /**
     * Get the referred users.
     */
    public function referrals(): HasMany
    {
        return $this->hasMany(WtUser::class, 'id_user_referral', 'id_user');
    }

    /**
     * Get the joins for the user.
     */
    public function joins(): HasMany
    {
        return $this->hasMany(WtJoin::class, 'id_user', 'id_user');
    }

    /**
     * Get the cheques for the user.
     */
    public function cheques(): HasMany
    {
        return $this->hasMany(WtCheque::class, 'id_user', 'id_user');
    }

    /**
     * Get the withdrawals for the user.
     */
    public function withdrawals(): HasMany
    {
        return $this->hasMany(WtWithdraw::class, 'id_user', 'id_user');
    }

    /**
     * Get the referral bonuses received.
     */
    public function referralBonusesReceived(): HasMany
    {
        return $this->hasMany(WtReferral::class, 'untuk_user_referral', 'id_user');
    }

    /**
     * Get the referral bonuses given.
     */
    public function referralBonusesGiven(): HasMany
    {
        return $this->hasMany(WtReferral::class, 'dari_user_referral', 'id_user');
    }

    /**
     * Get the profit shares received.
     */
    public function profitSharesReceived(): HasMany
    {
        return $this->hasMany(WtProfitShare::class, 'untuk_user_profit', 'id_user');
    }

    /**
     * Get the profit shares given.
     */
    public function profitSharesGiven(): HasMany
    {
        return $this->hasMany(WtProfitShare::class, 'dari_user_profit', 'id_user');
    }

    /**
     * Get the manual profits for the user.
     */
    public function manualProfits(): HasMany
    {
        return $this->hasMany(WtProfitManual::class, 'id_user', 'id_user');
    }

    /**
     * Get the mutuals for the user.
     */
    public function mutuals(): HasMany
    {
        return $this->hasMany(WtMutual::class, 'id_user', 'id_user');
    }

    /**
     * Get the verification record for the user.
     */
    public function verify(): HasOne
    {
        return $this->hasOne(WtVerify::class, 'id_user', 'id_user');
    }

    /**
     * Get the password reset records for the user.
     */
    public function passwordResets(): HasMany
    {
        return $this->hasMany(WtResetPass::class, 'id_user', 'id_user');
    }
}
