<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks_prioritization', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('priority_level');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('priority_level')->references('id')->on('task_prioritization')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks_prioritization');
    }
};