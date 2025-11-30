<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'min_deposit',
        'license_fee_percent',
        'daily_profit_estimate',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'min_deposit' => 'decimal:2',
            'license_fee_percent' => 'decimal:2',
            'daily_profit_estimate' => 'decimal:2',
        ];
    }
}
