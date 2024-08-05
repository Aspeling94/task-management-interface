<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks_dependencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('dependent_task_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('dependent_task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks_dependencies');
    }
};