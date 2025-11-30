<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WtProfitShare extends Model
{
    protected $table = 'wt_profit_share';

    protected $primaryKey = 'id_profit';

    public $timestamps = false;

    protected $fillable = [
        'id_join',
        'id_profit_get',
        'dari_user_profit',
        'untuk_user_profit',
        'level_profit',
        'persen_profit',
        'nominal_profit',
    ];

    protected $casts = [
        'persen_profit' => 'decimal:4',
        'nominal_profit' => 'decimal:2',
    ];

    /**
     * Get the join that owns the profit share.
     */
    public function join(): BelongsTo
    {
        return $this->belongsTo(WtJoin::class, 'id_join', 'id_join');
    }

    /**
     * Get the profit get that owns the profit share.
     */
    public function profitGet(): BelongsTo
    {
        return $this->belongsTo(WtProfitGet::class, 'id_profit_get', 'id_profit_get');
    }

    /**
     * Get the user that gave the profit share.
     */
    public function fromUser(): BelongsTo
    {
        return $this->belongsTo(WtUser::class, 'dari_user_profit', 'id_user');
    }

    /**
     * Get the user that received the profit share.
     */
    public function toUser(): BelongsTo
    {
        return $this->belongsTo(WtUser::class, 'untuk_user_profit', 'id_user');
    }
}
