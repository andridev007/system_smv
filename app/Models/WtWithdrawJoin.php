<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WtWithdrawJoin extends Model
{
    protected $table = 'wt_withdraw_join';

    protected $primaryKey = 'id_wd_join';

    public $timestamps = false;

    protected $fillable = [
        'id_wd',
        'id_join',
        'nominal_wd',
        'sumber',
    ];

    protected $casts = [
        'nominal_wd' => 'decimal:2',
    ];

    /**
     * Get the withdrawal that owns the withdraw join.
     */
    public function withdraw(): BelongsTo
    {
        return $this->belongsTo(WtWithdraw::class, 'id_wd', 'id_wd');
    }

    /**
     * Get the join that owns the withdraw join.
     */
    public function join(): BelongsTo
    {
        return $this->belongsTo(WtJoin::class, 'id_join', 'id_join');
    }
}
