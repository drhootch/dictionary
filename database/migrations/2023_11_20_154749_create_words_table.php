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
        Schema::create('words', function (Blueprint $table) {
            $table->id();
            $table->json('lemma');
            $table->json('stems')->nullable();
            $table->json('wordForms')->nullable();
            $table->json('senses')->nullable();
            $table->string('morphologicalPatterns')->nullable();
            $table->string('pos')->nullable();
            $table->string('plain')->nullable();
            $table->string('verbOrigin')->nullable();
            $table->string('nounOrigin')->nullable();
            $table->string('originality')->nullable();
            $table->boolean('hasTanween')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('words');
    }
};
