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
            $table->string("name"); 
            $table->string("middlename"); 
            $table->string("lastname"); 
            $table->string("barangay");
            $table->string("municipality");  
            $table->string("province");
            $table->string("contactnumber");
            $table->string("brand");
            $table->string("model");
            $table->string("vehiclelicense");
            $table->string("placard");
            $table->string("color");
            $table->string("date");      
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
