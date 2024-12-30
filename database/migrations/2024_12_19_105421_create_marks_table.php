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
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stud_id')->constrained('studs')->onDelete('cascade');
            $table->integer('eng'); 
            $table->integer('tam');
            $table->integer('mat'); 
            $table->integer('sci');
            $table->integer('soc'); 
            $table->integer('total'); 


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marks');
    }
};
