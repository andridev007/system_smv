<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WtMutual extends Model
{
    protected $table = 'wt_mutual';

    protected $primaryKey = 'id_mutual';

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'investor',
        'trader',
        'nominal_investor',
        'nominal_trader',
        'tgl_join',
        'status_mutual',
    ];

    protected $casts = [
        'tgl_join' => 'datetime',
        'nominal_investor' => 'decimal:2',
        'nominal_trader' => 'decimal:2',
    ];

    /**
     * Get the user that owns the mutual.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(WtUser::class, 'id_user', 'id_user');
    }
}
