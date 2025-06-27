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
    Schema::create('quizzes', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description')->nullable();
<<<<<<< HEAD
        // Créateur du quiz (utilisateur connecté)
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
=======
        $table->timestamp('start_time')->nullable();
        $table->timestamp('end_time')->nullable();
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
>>>>>>> 5717658 (passer un quiz)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
