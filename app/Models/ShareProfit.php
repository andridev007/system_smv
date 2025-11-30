<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShareProfit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'investment_id',
        'amount',
        'percentage',
        'date',
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
            'percentage' => 'decimal:2',
            'date' => 'date',
        ];
    }

    /**
     * Get the investment that owns the share profit.
     */
    public function investment(): BelongsTo
    {
        return $this->belongsTo(Investment::class);
    }
}
