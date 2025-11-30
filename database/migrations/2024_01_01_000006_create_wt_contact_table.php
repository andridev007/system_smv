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
        Schema::create('wt_contact', function (Blueprint $table) {
            $table->id('id_kontak');
            $table->string('nama');
            $table->string('email');
            $table->string('subyek');
            $table->text('pesan');
            $table->string('status_kontak')->default('unread');
            $table->dateTime('tgl_kontak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wt_contact');
    }
};
