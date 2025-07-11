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
        Schema::create('job_application', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->float('aiGeneratedScore' , 2)->default(0);
            $table->longText('aiGeneratedFeedback')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Relations
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');

            $table->uuid('resume_id');
            $table->foreign('resume_id')->references('id')->on('resume')->onDelete('restrict');

            $table->uuid('job_vacancy_id');
            $table->foreign('job_vacancy_id')->references('id')->on('job_vacancy')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_application');
    }
};
