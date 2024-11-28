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
        Schema::table('pass_slips', function (Blueprint $table) {
            $table->decimal('validity_hours', 4, 2)->after('time_out')->default(3.00);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pass_slips', function (Blueprint $table) {
            $table->dropColumn('validity_hours');
        });
    }
};
