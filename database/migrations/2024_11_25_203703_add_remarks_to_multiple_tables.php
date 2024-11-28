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
        Schema::table('visitors', function (Blueprint $table) {
            $table->text('remarks')->nullable();
        });

        Schema::table('violations', function (Blueprint $table) {
            $table->text('remarks')->nullable();
        });

        Schema::table('lost_found', function (Blueprint $table) {
            $table->text('remarks')->nullable();
        });

        Schema::table('pass_slips', function (Blueprint $table) {
            $table->text('remarks')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });

        Schema::table('violations', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });

        Schema::table('lost_found', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });

        Schema::table('pass_slips', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });
    }
};
