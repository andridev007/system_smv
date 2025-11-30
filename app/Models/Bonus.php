<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bonus extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'from_user_id',
        'type',
        'amount',
        'level',
        'description',
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
            'level' => 'integer',
        ];
    }

    /**
     * Get the user that receives the bonus.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user that the bonus originated from.
     */
    public function fromUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    /**
     * Check if this is a referral bonus.
     */
    public function isReferral(): bool
    {
        return $this->type === 'referral';
    }

    /**
     * Check if this is a profit share bonus.
     */
    public function isProfitShare(): bool
    {
        return $this->type === 'profit_share';
    }
}
