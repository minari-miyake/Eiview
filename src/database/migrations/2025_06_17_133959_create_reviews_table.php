<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('reviews', function (Blueprint $table) {
    $table->id();
    $table->foreignId('movie_id')->constrained()->onDelete('cascade');
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->tinyInteger('rating'); // 1〜5
    $table->string('title')->nullable();
    $table->string('comment', 200)->nullable();
    $table->timestamps();
  });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
