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
        Schema::create('parkings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('license_no');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('date_registered');
            $table->date('expiration_date');
            $table->string('license_photo')->nullable();
            $table->string('course');
            $table->date('license_exp_date');
            $table->string('plate_no');
            $table->string('cr_no');
            $table->date('cr_date_register');
            $table->string('vehicle_type');
            $table->string('vehicle_image')->nullable();
            $table->string('sticker_id');
            $table->string('dl_codes');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkings');
    }
};
