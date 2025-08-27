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
        Schema::table('skill_evaluations', function (Blueprint $table) {
            $table->index(['teacher_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skill_evaluations', function (Blueprint $table) {
          $table->dropIndex(['teacher_id', 'student_id']); 
        });
    }
};
