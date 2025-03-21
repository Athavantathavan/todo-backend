<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title'); 
            $table->string('description'); 
            $table->string('status'); 
            $table->unsignedBigInteger('userid');
            $table->foreign('userid')->references('id')->on('user')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
       
    }
};
