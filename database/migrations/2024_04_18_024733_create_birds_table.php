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
        Schema::create('birds', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('plate_color_id');
            $table->string('plate_number');
            $table->string('sex');
            $table->unsignedBigInteger('father_bird_id');
            $table->unsignedBigInteger('mother_bird_id');
            $table->date('birthdate');
            $table->json('bird_color');
            $table->string('crest_type');
            $table->string('line');
            $table->string('weight');
            $table->string('status');
            $table->string('origin');
            $table->text('observations')->nullable();
            $table->enum('in_care', ['Habilitado', 'Desabilitado'])->default('Desabilitado'); 

    
            $table->foreign('plate_color_id')->references('id')->on('plate_colors');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('birds');
    }
};
