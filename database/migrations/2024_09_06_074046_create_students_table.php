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
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // auto-incrementing BIGINT UNSIGNED primary key
            $table->string('name')->nullable(false);
            $table->string('email')->unique()->nullable();
            $table->integer('age');

            $table->unsignedBigInteger('city');
            
            // Define the foreign key constraint on the 'city_id' column
            $table->foreign('city')->references('id')->on('cities')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
        
            //$table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
