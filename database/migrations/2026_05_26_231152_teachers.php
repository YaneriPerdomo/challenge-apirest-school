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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id('teacher_id');
            $table->bigInteger('identity_document')->unique()->nullable();
              $table->foreignId('subject_id')
                ->nullable()
                ->constrained('subjects', 'subject_id')
                ->onDelete('set null');
            $table->string('names', 90);
            $table->string('lastnames', 90);
            $table->enum('gender', ['M', 'F']);
            $table->string('slug', 200)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::dropIfExists('teachers');
    }
};
