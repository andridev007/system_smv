<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WtJoin extends Model
{
    protected $table = 'wt_join';

    protected $primaryKey = 'id_join';

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_prog',
        'nominal_join',
        'insurance',
        'kode_unik',
        'total_bayar',
        'tgl_join',
        'status_join',
        'method',
        'note',
        'wd_status',
    ];

    protected $casts = [
        'tgl_join' => 'datetime',
        'nominal_join' => 'decimal:2',
        'insurance' => 'decimal:2',
        'total_bayar' => 'decimal:2',
    ];

    /**
     * Get the user that owns the join.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(WtUser::class, 'id_user', 'id_user');
    }

    /**
     * Get the program associated with the join.
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(WtProgram::class, 'id_prog', 'id_prog');
    }

    /**
     * Get the confirm record for the join.
     */
    public function confirm(): HasOne
    {
        return $this->hasOne(WtJoinConfirm::class, 'id_join', 'id_join');
    }

    /**
     * Get the join programs for the join.
     */
    public function joinPrograms(): HasMany
    {
        return $this->hasMany(WtJoinProgram::class, 'id_join', 'id_join');
    }

    /**
     * Get the referrals for the join.
     */
    public function referrals(): HasMany
    {
        return $this->hasMany(WtReferral::class, 'id_join', 'id_join');
    }

    /**
     * Get the profit gets for the join.
     */
    public function profitGets(): HasMany
    {
        return $this->hasMany(WtProfitGet::class, 'id_join', 'id_join');
    }

    /**
     * Get the profit shares for the join.
     */
    public function profitShares(): HasMany
    {
        return $this->hasMany(WtProfitShare::class, 'id_join', 'id_join');
    }

    /**
     * Get the withdraw joins for the join.
     */
    public function withdrawJoins(): HasMany
    {
        return $this->hasMany(WtWithdrawJoin::class, 'id_join', 'id_join');
    }
}
