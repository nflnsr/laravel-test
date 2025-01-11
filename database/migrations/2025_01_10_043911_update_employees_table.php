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
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['division_id']);
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->string('division_id')->nullable(false)->change();
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['division_id']);
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->uuid('division_id')->nullable(false)->change();
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade');
        });
    }
};
