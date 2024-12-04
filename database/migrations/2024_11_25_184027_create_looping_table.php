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
        Schema::create('looping', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('department');
            $table->date('date');
            $table->time('time_in')->nullable();
            $table->time('time_out');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('looping');
    }
};