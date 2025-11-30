<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WtWithdraw extends Model
{
    protected $table = 'wt_withdraw';

    protected $primaryKey = 'id_wd';

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'nominal_wd',
        'wd_diterima',
        'fee_wd',
        'tgl_wd',
        'status_wd',
        'method',
        'payment',
    ];

    protected $casts = [
        'tgl_wd' => 'datetime',
        'nominal_wd' => 'decimal:2',
        'wd_diterima' => 'decimal:2',
        'fee_wd' => 'decimal:2',
    ];

    /**
     * Get the user that owns the withdrawal.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(WtUser::class, 'id_user', 'id_user');
    }

    /**
     * Get the withdrawal request for the withdrawal.
     */
    public function withdrawRequest(): HasOne
    {
        return $this->hasOne(WtWithdrawReq::class, 'id_wd', 'id_wd');
    }

    /**
     * Get the withdraw joins for the withdrawal.
     */
    public function withdrawJoins(): HasMany
    {
        return $this->hasMany(WtWithdrawJoin::class, 'id_wd', 'id_wd');
    }
}
