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
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id');
            $table->string('name', 90);
            $table->string('lastname', 90);
            $table->enum('gender', ['M', 'F']);
            $table->bigInteger('identity_document')->unique()->nullable();
            $table->bigInteger('mother_s_identity_document')->nullable();
            $table->date('birth');
            $table->string('slug', 200)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
