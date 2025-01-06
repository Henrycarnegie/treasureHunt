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
        Schema::create('soal_level1', function (Blueprint $table) {
            $table->id();
            $table->string('role_name');
            $table->string('type_question');
            $table->text('question_text');
            $table->string('question_image')->nullable(true);
            $table->string('answer_a');
            $table->string('answer_b');
            $table->string('correct_answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_level1');
    }
};
