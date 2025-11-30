<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'phone',
        'referral_code',
        'upline_id',
        'bank_name',
        'bank_account_name',
        'bank_account_number',
        'role',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the upline (referrer) of this user.
     */
    public function upline(): BelongsTo
    {
        return $this->belongsTo(User::class, 'upline_id');
    }

    /**
     * Get the downlines (referrals) of this user.
     */
    public function downlines(): HasMany
    {
        return $this->hasMany(User::class, 'upline_id');
    }

    /**
     * Get the investments for this user.
     */
    public function investments(): HasMany
    {
        return $this->hasMany(Investment::class);
    }

    /**
     * Get the bonuses received by this user.
     */
    public function bonuses(): HasMany
    {
        return $this->hasMany(Bonus::class);
    }

    /**
     * Get the bonuses given by this user (as source).
     */
    public function givenBonuses(): HasMany
    {
        return $this->hasMany(Bonus::class, 'from_user_id');
    }

    /**
     * Get the withdrawals for this user.
     */
    public function withdrawals(): HasMany
    {
        return $this->hasMany(Withdrawal::class);
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user is a member.
     */
    public function isMember(): bool
    {
        return $this->role === 'member';
    }
}
