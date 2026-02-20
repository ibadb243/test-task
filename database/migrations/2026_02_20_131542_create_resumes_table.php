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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('position')->index();
            $table->string('category');
            $table->string('description');
            $table->decimal('salary', 10, 2)->nullable();
            $table->enum('education', ['none', 'high_school', 'bachelor', 'master', 'phd'])->default('none');
            $table->enum('experience', ['none', 'junior', 'mid', 'senior'])->default('none');
            $table->json('skills')->nullable();
            $table->timestamps();

            $table->index(['category', 'salary'], 'idx_category_salary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
