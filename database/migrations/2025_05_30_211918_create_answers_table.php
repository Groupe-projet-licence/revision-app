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
    Schema::create('answers', function (Blueprint $table) {
    $table->id();
    $table->longText('answer_text');
    $table->boolean('is_correct')->default(false);  // Par défaut on suppose que la réponse est fausse
    $table->foreignId('question_id')->constrained()->onDelete('cascade');  // Clé étrangère pour question_id
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
