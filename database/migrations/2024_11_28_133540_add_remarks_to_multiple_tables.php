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
        Schema::table('looping', function (Blueprint $table) {
            $table->string('employee_type')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
        });

        Schema::table('all_employees', function (Blueprint $table) {
            $table->string('position')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('looping', function (Blueprint $table) {
            $table->dropColumn('employee_type');
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('all_employees', function (Blueprint $table) {
            $table->dropColumn('position');
        });
    }
};
