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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('email')->unique();
            $table->string('user_name')->unique();
            $table->integer('verification_code');
            $table->boolean('is_email_verified')->default(false);
            $table->string('password');
            $table->foreignId('member_type_id')->references('id')->on('member_types')->onDelete('cascade')->default(2);
            $table->string('name')->nullable();
            $table->string('avatar')->nullable();
            $table->date('birthday')->nullable();
            $table->string('place')->nullable();
            $table->string('major')->nullable();
            $table->string('university')->nullable();
            $table->string('activities')->nullable();
            $table->string('phone')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('website')->nullable();
            $table->text('about')->nullable();
            $table->string('signature')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
