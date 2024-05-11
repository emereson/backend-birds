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
        Schema::create('bird_fights', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('bird_id');
            $table->string('number_fight');
            $table->string('coliseum');
            $table->string('opponent');
            $table->string('weight');
            $table->string('date_fight');
            $table->string('minutes');
            $table->string('state');
            $table->text('observations');


            $table->foreign('bird_id')->references('id')->on('birds');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bird_fights');
    }
};
