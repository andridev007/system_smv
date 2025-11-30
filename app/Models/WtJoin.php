<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WtJoin extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wt_join';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_join';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_join',
        'id_user',
        'amount',
        'profit_percentage',
        'status',
        'join_date',
        'end_date',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'double',
        'profit_percentage' => 'double',
        'join_date' => 'datetime',
        'end_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the join.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(WtUser::class, 'id_user', 'id_user');
    }

    /**
     * Get the profit shares for the join.
     */
    public function profitShares(): HasMany
    {
        return $this->hasMany(WtProfitShare::class, 'id_join', 'id_join');
    }
}
