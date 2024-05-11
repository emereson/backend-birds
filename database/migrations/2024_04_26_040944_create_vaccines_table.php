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
        Schema::create('vaccines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('bird_id');
            $table->string('blister');
            $table->string('pill');
            $table->string('drops');
            $table->string('internal_deworming');
            $table->string('external_deworming');
            $table->string('date');
            $table->text('observations');

            $table->foreign('bird_id')->references('id')->on('birds');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccines');
    }
};
