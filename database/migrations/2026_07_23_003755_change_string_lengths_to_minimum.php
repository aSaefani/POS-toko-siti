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
            $table->string('name', 50)->change();
            $table->string('email', 50)->change();
            $table->string('password', 60)->change(); // Bcrypt hashes are always exactly 60 characters
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('name', 50)->change();
            $table->string('sku', 20)->change();
            $table->string('category', 30)->change();
            $table->string('image_url', 100)->nullable()->change();
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->string('transaction_code', 30)->change();
        });

        Schema::table('activity_logs', function (Blueprint $table) {
            $table->string('action', 30)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name', 255)->change();
            $table->string('email', 255)->change();
            $table->string('password', 255)->change();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('name', 255)->change();
            $table->string('sku', 255)->change();
            $table->string('category', 255)->change();
            $table->string('image_url', 255)->nullable()->change();
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->string('transaction_code', 255)->change();
        });

        Schema::table('activity_logs', function (Blueprint $table) {
            $table->string('action', 255)->change();
        });
    }
};
