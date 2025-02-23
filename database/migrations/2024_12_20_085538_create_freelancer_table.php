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
        Schema::create('freelancer', function (Blueprint $table) {
            $table->increments('freelancer_id');
            $table->string('freelancer_name');
            $table->date('date_of_birth')->nullable();
            $table->integer('age')->nullable();
            $table->string('address')->nullable();
            $table->string('experements')->nullable();
            $table->text('introduce')->nullable();
            $table->string('image', 255)->nullable(); 
            $table->string('gender', 50)->nullable();
            $table->unsignedInteger('account_id');
            $table->foreign('account_id')->references('account_id')->on('accounts')->onDelete('cascade');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancer');
    }
};
