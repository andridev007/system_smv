<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WtCheque extends Model
{
    protected $table = 'wt_cheque';

    protected $primaryKey = 'id_cheque';

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'jumlah_cheque',
        'tgl_cheque',
        'keterangan',
    ];

    protected $casts = [
        'tgl_cheque' => 'datetime',
        'jumlah_cheque' => 'decimal:2',
    ];

    /**
     * Get the user that owns the cheque.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(WtUser::class, 'id_user', 'id_user');
    }
}
