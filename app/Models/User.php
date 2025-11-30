<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'password',
        'referral_code',
        'upline_id',
        'bank_name',
        'account_number',
        'account_holder',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the upline (referrer) of the user.
     */
    public function upline(): BelongsTo
    {
        return $this->belongsTo(User::class, 'upline_id');
    }

    /**
     * Get the downline (referrals) of the user.
     */
    public function downlines(): HasMany
    {
        return $this->hasMany(User::class, 'upline_id');
    }

    /**
     * Get the investments for the user.
     */
    public function investments(): HasMany
    {
        return $this->hasMany(Investment::class);
    }

    /**
     * Get the bonuses received by the user.
     */
    public function bonuses(): HasMany
    {
        return $this->hasMany(Bonus::class);
    }

    /**
     * Get the bonuses triggered by the user.
     */
    public function triggeredBonuses(): HasMany
    {
        return $this->hasMany(Bonus::class, 'from_user_id');
    }

    /**
     * Get the withdrawals for the user.
     */
    public function withdrawals(): HasMany
    {
        return $this->hasMany(Withdrawal::class);
    }
}
