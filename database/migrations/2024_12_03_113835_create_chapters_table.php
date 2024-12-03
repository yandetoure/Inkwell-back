<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chapters', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('book_id'); // ID du livre associé
        $table->string('title');
        $table->text('content'); // Contenu du chapitre
        $table->enum('status', ['published', 'draft'])->default('draft'); // Brouillon ou publié
        $table->unsignedBigInteger('likes_count')->default(0); // Nombre de j'aime
        $table->unsignedBigInteger('views_count')->default(0); // Nombre de vues
        $table->timestamps();
    
        $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
