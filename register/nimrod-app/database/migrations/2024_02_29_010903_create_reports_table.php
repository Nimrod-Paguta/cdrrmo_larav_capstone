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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string("registereduserid"); 
            $table->string("latitude"); 
            $table->string("longitude"); 
            $table->string("time"); 
            $table->string("gforce");
            $table->string("status");  
            $table->string("month");      
            $table->string("barangay"); 
            $table->string("city");  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
