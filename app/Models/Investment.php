<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Investment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
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
     * Get the share profits for the investment.
     */
    public function shareProfits(): HasMany
    {
        return $this->hasMany(ShareProfit::class);
    }
}
