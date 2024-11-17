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
        Schema::table('violations', function (Blueprint $table) {
            $table->string('data_occured')->nullable()->after('date');
            $table->string('date_time_detected')->nullable()->after('data_occured');
            $table->string('incident_location')->nullable()->after('date_time_detected');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('violations', function (Blueprint $table) {
            $table->dropColumn('data_occured');
            $table->dropColumn('date_time_detected');
            $table->dropColumn('incident_location');
        });
    }
};
