<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('importance', ['low', 'medium', 'high']);
            $table->enum('urgency', ['low', 'medium', 'high']);
            $table->enum('status', ['pending', 'in_progress', 'completed', 'on_hold']);
            $table->enum('context', ['@work', '@home', '@errands', '@meeting', '@calls'])->nullable();
            $table->date('due_date')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};