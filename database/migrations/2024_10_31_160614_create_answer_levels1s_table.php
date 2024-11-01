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
        Schema::create('answer_levels1', function (Blueprint $table) {
            $table->id();
            $table->foreignId('murid_id')->constrained('murid')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('level_1_id')->constrained('level1')->onDelete('cascade')->onUpdate('cascade');
            $table->string('answer');
            $table->boolean('is_correct');
            $table->string('image_reason');
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
        Schema::dropIfExists('answer_levels1');
    }
};
