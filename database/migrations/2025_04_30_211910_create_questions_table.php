<?php

use App\Models\Quiz;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
    Schema::create('questions', function (Blueprint $table) {
    $table->id();
    $table->longText('question_text');
    $table->enum('type', ['single', 'multiple']);
    $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});
    }

    public function down(): void {
        Schema::dropIfExists('questions');
    }
};
