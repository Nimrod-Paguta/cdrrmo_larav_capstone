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
            $table->unsignedBigInteger("registereduserid");
            $table->foreign('registereduserid')->references('id')->on('registers')->onDelete('cascade');
            $table->decimal("latitude", 18, 15);; 
            $table->decimal("longitude", 18, 15);; 
            $table->string("time");  
            $table->float("gforce");
            $table->string("status");  
            $table->string("month");      
            $table->string("barangay"); 
            $table->string("city");
            $table->string("address");
            $table->unsignedBigInteger("passenger_no")->nullable();
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
