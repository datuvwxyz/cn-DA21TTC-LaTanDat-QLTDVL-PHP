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
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('account_id'); 
            $table->string('user_name', 60); 
            $table->string('password', 255); 
            $table->string('email', 255)->unique(); 
            $table->string('tel', 15)->unique(); 
            $table->string('method')->nullable(); 
            $table->enum('role', ['admin', 'employer', 'freelancer']);
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
