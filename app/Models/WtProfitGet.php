<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WtProfitGet extends Model
{
    protected $table = 'wt_profit_get';

    protected $primaryKey = 'id_profit_get';

    public $timestamps = false;

    protected $fillable = [
        'id_profit_day',
        'id_join',
        'persen_profit_get',
        'nominal_profit_get',
        'tgl_profit_get',
    ];

    protected $casts = [
        'tgl_profit_get' => 'datetime',
        'persen_profit_get' => 'decimal:4',
        'nominal_profit_get' => 'decimal:2',
    ];

    /**
     * Get the profit perday that owns the profit get.
     */
    public function profitPerday(): BelongsTo
    {
        return $this->belongsTo(WtProfitPerday::class, 'id_profit_day', 'id_profit_day');
    }

    /**
     * Get the join that owns the profit get.
     */
    public function join(): BelongsTo
    {
        return $this->belongsTo(WtJoin::class, 'id_join', 'id_join');
    }

    /**
     * Get the profit shares for the profit get.
     */
    public function profitShares(): HasMany
    {
        return $this->hasMany(WtProfitShare::class, 'id_profit_get', 'id_profit_get');
    }
}
