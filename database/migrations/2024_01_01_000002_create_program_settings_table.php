<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('program_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('min_deposit', 15, 2);
            $table->decimal('license_fee_percent', 5, 2)->default(10.00);
            $table->decimal('daily_profit_estimate', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_settings');
    }
};
