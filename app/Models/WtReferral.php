<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WtReferral extends Model
{
    protected $table = 'wt_referral';

    protected $primaryKey = 'id_referral';

    public $timestamps = false;

    protected $fillable = [
        'id_join',
        'dari_user_referral',
        'untuk_user_referral',
        'level_referral',
        'persen_referral',
        'nominal_referral',
    ];

    protected $casts = [
        'persen_referral' => 'decimal:4',
        'nominal_referral' => 'decimal:2',
    ];

    /**
     * Get the join that owns the referral.
     */
    public function join(): BelongsTo
    {
        return $this->belongsTo(WtJoin::class, 'id_join', 'id_join');
    }

    /**
     * Get the user that gave the referral bonus.
     */
    public function fromUser(): BelongsTo
    {
        return $this->belongsTo(WtUser::class, 'dari_user_referral', 'id_user');
    }

    /**
     * Get the user that received the referral bonus.
     */
    public function toUser(): BelongsTo
    {
        return $this->belongsTo(WtUser::class, 'untuk_user_referral', 'id_user');
    }
}
