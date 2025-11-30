<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Investment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'license_fee',
        'effective_balance',
        'total_earned',
        'status',
        'proof_file',
        'is_auto_compound',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'license_fee' => 'decimal:2',
            'effective_balance' => 'decimal:2',
            'total_earned' => 'decimal:2',
            'is_auto_compound' => 'boolean',
        ];
    }

    /**
     * Get the user that owns the investment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the share profits for this investment.
     */
    public function shareProfits(): HasMany
    {
        return $this->hasMany(ShareProfit::class);
    }

    /**
     * Check if the investment is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if the investment is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if the investment is completed.
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Check if the investment is rejected.
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    /**
     * Check if this is a daily investment type.
     */
    public function isDaily(): bool
    {
        return $this->type === 'daily';
    }

    /**
     * Check if this is a dream investment type.
     */
    public function isDream(): bool
    {
        return $this->type === 'dream';
    }
}
