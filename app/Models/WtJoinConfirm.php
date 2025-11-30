<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WtJoinConfirm extends Model
{
    protected $table = 'wt_join_confirm';

    protected $primaryKey = 'id_confirm';

    public $timestamps = false;

    protected $fillable = [
        'id_join',
        'status_confirm',
        'receipt',
    ];

    /**
     * Get the join that owns the confirm.
     */
    public function join(): BelongsTo
    {
        return $this->belongsTo(WtJoin::class, 'id_join', 'id_join');
    }
}
