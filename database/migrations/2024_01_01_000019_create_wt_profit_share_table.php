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
        Schema::create('wt_profit_share', function (Blueprint $table) {
            $table->id('id_profit');
            $table->unsignedBigInteger('id_join');
            $table->unsignedBigInteger('id_profit_get');
            $table->unsignedBigInteger('dari_user_profit');
            $table->unsignedBigInteger('untuk_user_profit');
            $table->integer('level_profit');
            $table->decimal('persen_profit', 10, 4);
            $table->decimal('nominal_profit', 15, 2);

            $table->foreign('id_join')->references('id_join')->on('wt_join')->onDelete('cascade');
            $table->foreign('id_profit_get')->references('id_profit_get')->on('wt_profit_get')->onDelete('cascade');
            $table->foreign('dari_user_profit')->references('id_user')->on('wt_user')->onDelete('cascade');
            $table->foreign('untuk_user_profit')->references('id_user')->on('wt_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_profit_share');
    }
};
