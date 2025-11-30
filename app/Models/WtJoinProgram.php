<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WtJoinProgram extends Model
{
    protected $table = 'wt_join_program';

    protected $primaryKey = 'id_join_prog';

    public $timestamps = false;

    protected $fillable = [
        'id_prog',
        'id_join',
        'nama_prog',
        'hrg_prog',
        'min_depo',
    ];

    protected $casts = [
        'hrg_prog' => 'decimal:2',
        'min_depo' => 'decimal:2',
    ];

    /**
     * Get the program that owns the join program.
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(WtProgram::class, 'id_prog', 'id_prog');
    }

    /**
     * Get the join that owns the join program.
     */
    public function join(): BelongsTo
    {
        return $this->belongsTo(WtJoin::class, 'id_join', 'id_join');
    }
}
