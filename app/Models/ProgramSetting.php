<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramSetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'min_amount',
        'license_percent',
        'withdraw_fee_percent',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'min_amount' => 'decimal:2',
            'license_percent' => 'decimal:2',
            'withdraw_fee_percent' => 'decimal:2',
        ];
    }
}
