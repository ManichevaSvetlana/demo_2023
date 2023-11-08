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
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // Unique identifier for the book
            $table->string('title'); // Title of the book
            $table->string('author'); // Author of the book
            $table->text('description')->nullable(); // Description of the book
            $table->string('isbn')->unique(); // Unique ISBN number
            $table->integer('pages')->nullable(); // Number of pages
            $table->softDeletes(); // Soft delete the book (deleted_at column)
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
