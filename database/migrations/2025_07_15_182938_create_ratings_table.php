<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
public function up(): void
{
Schema::create('ratings', function (Blueprint $table) {
$table->id();
$table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
$table->tinyInteger('stars')->unsigned(); // 1 à 5 étoiles
$table->text('comment')->nullable();
$table->timestamps();
});
}


public function down(): void
{
    Schema::dropIfExists('ratings');
}
}
