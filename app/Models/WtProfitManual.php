<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WtProfitManual extends Model
{
    protected $table = 'wt_profit_manual';

    protected $primaryKey = 'id_manual';

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'tambah_manual',
        'kurang_manual',
        'tgl_manual',
        'keterangan',
    ];

    protected $casts = [
        'tgl_manual' => 'datetime',
        'tambah_manual' => 'decimal:2',
        'kurang_manual' => 'decimal:2',
    ];

    /**
     * Get the user that owns the manual profit.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(WtUser::class, 'id_user', 'id_user');
    }
}
