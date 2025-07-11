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
        Schema::create('resume', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('fileName');
            $table->string('fileUrl');
            $table->string('contactDetails');
            $table->longText('education');
            $table->longText('skills');
            $table->longText('experience');
            $table->longText('summary');
            $table->timestamps();
            $table->softDeletes();

            // Relations
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume');
    }
};
