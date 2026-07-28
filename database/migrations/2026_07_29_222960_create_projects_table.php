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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->string('name_fa');
            $table->string('name_en');
            $table->foreignId('technique_id')->references('id')->on('techniques')->onDelete('cascade');
            $table->foreignId('style_id')->references('id')->on('styles')->onDelete('cascade');
            $table->foreignId('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->string('image');
            $table->string('thumbnail')->default('images/projects/thumbnails/default.png');
            $table->string('height');
            $table->string('width');
            $table->string('year');
            $table->text('member_description')->nullable();
            $table->string('description')->nullable();
            $table->text('about_project')->nullable();
            $table->string('signature')->nullable();
            $table->string('theme')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
