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
        Schema::create('admins', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 50);
            $table->string('username', 20)->nullable(false)->unique("admins_username_unique");
            $table->string('phone', 20)->nullable(false)->unique("admins_phone_unique");
            $table->string('email', 50)->nullable(false)->unique("admins_email_unique");
            $table->string('password', 255)->nullable(false);
            $table->string('token', 255)->nullable()->unique("admins_token_unique");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
