<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WtProfitPerday extends Model
{
    protected $table = 'wt_profit_perday';

    protected $primaryKey = 'id_profit_day';

    public $timestamps = false;

    protected $fillable = [
        'persen_day',
        'profit_day',
        'tgl_profit_day',
    ];

    protected $casts = [
        'tgl_profit_day' => 'datetime',
        'persen_day' => 'decimal:4',
        'profit_day' => 'decimal:2',
    ];

    /**
     * Get the profit gets for the profit perday.
     */
    public function profitGets(): HasMany
    {
        return $this->hasMany(WtProfitGet::class, 'id_profit_day', 'id_profit_day');
    }
}
