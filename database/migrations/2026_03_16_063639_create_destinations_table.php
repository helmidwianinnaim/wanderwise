<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('country');
            $table->enum('region', ['usa', 'europe']);
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('tag')->nullable(); // e.g. "Top Pick", "Hidden Gem"
            $table->integer('guides_count')->default(0);
            $table->integer('rating')->default(5);
            $table->boolean('featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
