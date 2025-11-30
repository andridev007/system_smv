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
        Schema::create('wt_withdraw_setting', function (Blueprint $table) {
            $table->id('id_withdraw_setting');
            $table->decimal('min_withdraw', 15, 2);
            $table->decimal('fee_withdraw', 10, 4);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_withdraw_setting');
    }
};
