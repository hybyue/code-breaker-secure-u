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
           // Drop the existing address column
           $table->dropColumn('address');

           // Add new address-related fields
           $table->string('province')->nullable();
           $table->string('municipality')->nullable();
           $table->string('barangay')->nullable();
           $table->string('street')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['province', 'municipality', 'barangay', 'street']);

            // Restore the original address column
            $table->string('address')->nullable();
        });
    }
};
