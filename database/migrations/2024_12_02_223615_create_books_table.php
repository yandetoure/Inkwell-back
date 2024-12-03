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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('cover')->nullable(); // URL de la couverture
            $table->enum('status', ['published', 'draft'])->default('published'); // Statut du livre
            $table->boolean('is_completed')->default(false); // Indique si le livre est terminé
            $table->unsignedBigInteger('author_id'); // Auteur du livre
            $table->timestamps();
        
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
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
