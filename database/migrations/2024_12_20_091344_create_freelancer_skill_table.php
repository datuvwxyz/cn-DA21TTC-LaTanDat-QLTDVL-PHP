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
        Schema::create('freelancer_skill', function (Blueprint $table) {
            $table->unsignedInteger('freelancer_id');
            $table->unsignedInteger('skill_id')->nullable();;
            $table->primary(['freelancer_id', 'skill_id']); 
            $table->foreign('freelancer_id')->references('freelancer_id')->on('freelancer')->onDelete('cascade');
            $table->foreign('skill_id')->references('skill_id')->on('skill')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancer_skill');
    }
};
