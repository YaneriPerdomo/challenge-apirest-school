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
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id('qualification_id');
            $table->foreignId('student_id')
                ->nullable()
                ->constrained('students', 'student_id')
                ->onDelete('set null');
            $table->foreignId('subject_id')
                ->nullable()
                ->constrained('subjects', 'subject_id')
                ->onDelete('set null');
            $table->integer('qualification')->nullable()->default(null);
            $table->string('slug', 200)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qualifications');
    }
};
