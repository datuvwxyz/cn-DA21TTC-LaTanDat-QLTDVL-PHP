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
        Schema::create('post_job_skill', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('skill_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('post_id')
                  ->references('post_id')
                  ->on('post_job')
                  ->onDelete('cascade');
                  
            $table->foreign('skill_id')
                  ->references('skill_id')
                  ->on('skill')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_job_skill');
    }
};
