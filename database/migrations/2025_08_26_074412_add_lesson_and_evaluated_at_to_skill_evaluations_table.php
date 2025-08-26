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
        $table->string('lesson', 100)->nullable()->after('student_id');
        $table->dateTime('evaluated_at')->nullable()->after('lesson');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skill_evaluations', function (Blueprint $table) {
            $table->dropIndex(['student_id', 'evaluated_at']);
            $table->dropIndex(['teacher_id', 'evaluated_at']);
            $table->dropColumn(['lesson', 'evaluated_at']);
        });
    }
};
