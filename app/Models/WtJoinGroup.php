<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WtJoinGroup extends Model
{
    protected $table = 'wt_join_group';

    protected $primaryKey = 'id_group';

    public $timestamps = false;

    protected $fillable = [
        'nama_group',
    ];

    /**
     * Get the programs for the group.
     */
    public function programs(): HasMany
    {
        return $this->hasMany(WtProgram::class, 'id_group', 'id_group');
    }
}
