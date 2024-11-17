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
            $table->string('visited_person_name')->nullable()->after('person_to_visit');
            $table->string('visited_person_position')->nullable()->after('visited_person_name');
            $table->string('id_image')->nullable()->after('visited_person_position');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropColumn(['visited_person_name', 'visited_person_position', 'id_image']);
        });
    }
};
