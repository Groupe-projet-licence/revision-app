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
        Schema::table('sheets', function (Blueprint $table) {
            $table->timestamp('last_opened_at')->nullable();
            $table->timestamp('next_revision_at')->default(now()->addDays());
            $table->integer('revision_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sheets', function (Blueprint $table) {
            $table->dropColumn("last_opened_at");
            $table->dropColumn("next_revision_at");
            $table->dropColumn("revision_count");
        });
    }
};
