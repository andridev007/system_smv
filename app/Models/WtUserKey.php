<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WtUserKey extends Model
{
    protected $table = 'wt_user_key';

    protected $primaryKey = 'id_user';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'username',
        'username_asli',
        'userpass',
    ];

    /**
     * Get the user that owns the key.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(WtUser::class, 'id_user', 'id_user');
    }
}
