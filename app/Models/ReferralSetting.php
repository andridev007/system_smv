<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralSetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'level',
        'percentage',
        'type',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'level' => 'integer',
            'percentage' => 'decimal:2',
        ];
    }
}
