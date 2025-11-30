<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WtProgram extends Model
{
    protected $table = 'wt_program';

    protected $primaryKey = 'id_prog';

    public $timestamps = false;

    protected $fillable = [
        'id_group',
        'nama_prog',
        'hrg_prog',
        'min_depo',
        'est_balik',
        'est_terima',
    ];

    protected $casts = [
        'hrg_prog' => 'decimal:2',
        'min_depo' => 'decimal:2',
        'est_balik' => 'decimal:2',
        'est_terima' => 'decimal:2',
    ];

    /**
     * Get the group that owns the program.
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(WtJoinGroup::class, 'id_group', 'id_group');
    }

    /**
     * Get the joins for the program.
     */
    public function joins(): HasMany
    {
        return $this->hasMany(WtJoin::class, 'id_prog', 'id_prog');
    }

    /**
     * Get the join programs for the program.
     */
    public function joinPrograms(): HasMany
    {
        return $this->hasMany(WtJoinProgram::class, 'id_prog', 'id_prog');
    }
}
