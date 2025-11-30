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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('name');
            $table->string('phone')->nullable()->after('email');
            $table->string('referral_code')->unique()->after('phone');
            $table->unsignedBigInteger('upline_id')->nullable()->after('referral_code');
            $table->string('bank_name')->nullable()->after('upline_id');
            $table->string('account_number')->nullable()->after('bank_name');
            $table->string('account_name')->nullable()->after('account_number');
            $table->boolean('is_verified')->default(false)->after('account_name');

            $table->foreign('upline_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['upline_id']);
            $table->dropColumn([
                'username',
                'phone',
                'referral_code',
                'upline_id',
                'bank_name',
                'account_number',
                'account_name',
                'is_verified',
            ]);
        });
    }
};
