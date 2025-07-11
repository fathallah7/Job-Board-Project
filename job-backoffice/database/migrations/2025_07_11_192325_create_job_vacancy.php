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
        Schema::create('job_vacancy', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title'); 
            $table->text('description');
            $table->string('location');
            $table->string('salary');
            $table->enum('type', ['Full-Time', 'Contract', 'Remote', 'Hybrid'])->default('Full-Time');
            $table->softDeletes();
            $table->timestamps();

            // Relations
            $table->uuid('company_id');
            $table->foreign('company_id')->references('id')->on('company')->onDelete('restrict');

            $table->uuid('category_id');
            $table->foreign('category_id')->references('id')->on('job_category')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_vacancy');
    }
};
