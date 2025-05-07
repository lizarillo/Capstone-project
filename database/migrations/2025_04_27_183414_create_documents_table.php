<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Create Institutions Table
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code')->unique()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Create Programs Table
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('institution_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        // Create Courses Table
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->foreignId('program_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        // Create Documents Table
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->enum('document_type', ['report_card', 'transcript', 'certificate', 'other']);
            $table->string('file_path');
            $table->enum('status', ['pending', 'under_review', 'approved', 'rejected'])->default('pending');
            
            // Foreign Keys with proper constraints
            $table->foreignId('institution_id')->constrained()->onDelete('cascade');
            $table->foreignId('program_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('programs');
        Schema::dropIfExists('institutions');
    }
};