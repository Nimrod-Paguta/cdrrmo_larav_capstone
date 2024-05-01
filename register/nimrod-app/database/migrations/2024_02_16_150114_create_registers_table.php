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
        Schema::create('registers', function (Blueprint $table) {
            $table->id();
            $table->string("name"); 
            $table->string("middlename")->nullable(); 
            $table->string("lastname"); 
            $table->string("barangay");
            $table->string("municipality");  
            $table->string("province");
            $table->unsignedBigInteger("contactnumber");
            $table->unsignedBigInteger("emergencynumber");
            $table->string("medicalcondition")->nullable();
            $table->string("brand");
            $table->string("model");
            $table->string("vehiclelicense");
            $table->string("color");
            $table->string("type");
            $table->string("gender");
            $table->string('email')->unique();
            $table->string('password'); 
            $table->timestamps();
        }); 
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registers');
    }
};
