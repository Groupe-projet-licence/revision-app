<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
    Schema::create('questions', function (Blueprint $table) {
    $table->id();
    $table->string('question_text');
    $table->foreignId('category_id')->constrained()->onDelete('cascade');
    $table->enum('type', ['single', 'multiple']);
    $table->timestamps();
});
    }

    public function down(): void {
        Schema::dropIfExists('question_types');
    }
};
