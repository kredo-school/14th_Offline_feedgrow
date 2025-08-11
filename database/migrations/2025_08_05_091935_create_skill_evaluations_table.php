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
        Schema::create('skill_evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('student_id');
            $table->tinyInteger('speaking')->nullable()->comment('speaking');
            $table->tinyInteger('listening')->nullable()->comment('listening');
            $table->tinyInteger('reading')->nullable()->comment('reading');
            $table->tinyInteger('writing')->nullable()->comment('writing');
           $table->tinyInteger('grammar')->nullable()->comment('grammar');

            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_evaluations');
    }
};
