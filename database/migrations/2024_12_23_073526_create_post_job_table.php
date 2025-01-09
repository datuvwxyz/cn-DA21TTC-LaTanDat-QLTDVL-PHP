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
    Schema::create('post_job', function (Blueprint $table) {
        $table->increments('post_id')->nullable(false);
        $table->string('title')->nullable(false); 
        $table->string('position', 255)->nullable(false);
        $table->text('description', 1000)->nullable();
        $table->timestamp('expiration_date')->nullable();
        $table->string('area', 255)->nullable(false);
        $table->string('image', 255)->nullable(false);
        $table->enum('status', ['Pending', 'Rejected', 'Active', 'Expired', 'InProgress'])->default('Pending');
        $table->unsignedInteger('employer_id')->nullable(false);
        $table->unsignedInteger('category_id')->nullable(false);
        $table->timestamps();                    

        $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('restrict');
        $table->foreign('employer_id')->references('employer_id')->on('employer')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_job');
    }
};
