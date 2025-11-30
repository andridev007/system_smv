<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Withdrawal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'amount',
        'fee',
        'final_amount',
        'source',
        'bank_details_snapshot',
        'status',
        'proof_image',
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
            'fee' => 'decimal:2',
            'final_amount' => 'decimal:2',
            'bank_details_snapshot' => 'array',
        ];
    }

    /**
     * Get the user that owns the withdrawal.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the withdrawal is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if the withdrawal is approved.
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Check if the withdrawal is rejected.
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    /**
     * Check if the source is investment.
     */
    public function isFromInvestment(): bool
    {
        return $this->source === 'investment';
    }

    /**
     * Check if the source is share profit.
     */
    public function isFromShareProfit(): bool
    {
        return $this->source === 'share_profit';
    }

    /**
     * Check if the source is bonus.
     */
    public function isFromBonus(): bool
    {
        return $this->source === 'bonus';
    }
}
