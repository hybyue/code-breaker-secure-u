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
            $table->string('address')->nullable()->after('last_seen');
            $table->string('schedule')->nullable()->after('last_seen');
            $table->string('position')->nullable()->after('last_seen');
            $table->string('emergency_contact_name')->nullable()->after('last_seen');
            $table->string('emergency_contact_number')->nullable()->after('last_seen');
            $table->date('date_hired')->nullable()->after('last_seen');
            $table->string('badge_number')->nullable()->after('last_seen');
            $table->string('profile_picture')->nullable()->after('last_seen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'address',
                'schedule',
                'position',
                'emergency_contact_name',
                'emergency_contact_number',
                'date_hired',
                'badge_number',
                'profile_picture',
            ]);
        });
    }
};
