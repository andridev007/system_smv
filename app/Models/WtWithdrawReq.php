<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WtWithdrawReq extends Model
{
    protected $table = 'wt_withdraw_req';

    protected $primaryKey = 'id_req';

    public $timestamps = false;

    protected $fillable = [
        'id_wd',
        'status_req',
        'receipt',
    ];

    /**
     * Get the withdrawal that owns the request.
     */
    public function withdraw(): BelongsTo
    {
        return $this->belongsTo(WtWithdraw::class, 'id_wd', 'id_wd');
    }
}
