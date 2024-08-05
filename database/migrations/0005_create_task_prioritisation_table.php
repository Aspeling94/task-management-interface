<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('task_prioritization', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('task_id');
            $table->enum('importance', ['low', 'medium', 'high']);
            $table->enum('urgency', ['low', 'medium', 'high']);
            
            // Computed priority_level as an integer, assuming a simplified calculation 
            $table->unsignedInteger('priority_level')->storedAs('
                CASE 
                    WHEN importance = "high" AND urgency = "high" THEN 9
                    WHEN importance = "high" AND urgency = "medium" THEN 8
                    WHEN importance = "high" AND urgency = "low" THEN 7
                    WHEN importance = "medium" AND urgency = "high" THEN 6
                    WHEN importance = "medium" AND urgency = "medium" THEN 5
                    WHEN importance = "medium" AND urgency = "low" THEN 4
                    WHEN importance = "low" AND urgency = "high" THEN 3
                    WHEN importance = "low" AND urgency = "medium" THEN 2
                    ELSE 1
                END
            ');
            
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('task_prioritization');
    }
};