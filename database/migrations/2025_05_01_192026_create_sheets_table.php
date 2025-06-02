<?php

use App\Models\User;
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
        Schema::create('sheets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->longText('content');
            $table->timestamp('last_opened_at')->nullable();
            $table->timestamp('next_revision_at')->default(now()->addDays());
            $table->integer('revision_count')->default(0);
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sheets');
    }
};
