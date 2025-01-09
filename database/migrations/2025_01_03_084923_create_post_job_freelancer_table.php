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
        Schema::create('post_job_freelancer', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('freelancer_id');
            $table->string('cv_file', 255)->nullable();  
            $table->timestamp('applied_at')->nullable(); 
            $table->timestamps();

            $table->foreign('post_id')
                ->references('post_id')
                ->on('post_job')
                ->onDelete('cascade');

            $table->foreign('freelancer_id')
                ->references('freelancer_id')
                ->on('freelancer')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_job_freelancer');
    }
};
