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
        Schema::create('first_acccess_level3', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('box_id');
            $table->string('role_name');
            $table->string('end_time');
            $table->foreign('box_id')->references('id')->on('box_level3')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('first_acccess_level3');
    }
};
