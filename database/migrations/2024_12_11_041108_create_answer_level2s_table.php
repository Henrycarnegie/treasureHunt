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
        Schema::create('answer_level2', function (Blueprint $table) {
            $table->id();
            $table->foreignId('murid_id')->constrained('murid')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('soal_level2_id')->constrained('soal_level2')->onDelete('cascade')->onUpdate('cascade');
            $table->string('answer')->nullable();
            $table->boolean('is_correct');
            $table->string('image_reason')->nullable();
            $table->integer('point_answer')->default(0);
            $table->integer('point_reason')->default(0);
            $table->integer('total_point')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_level2');
    }
};
