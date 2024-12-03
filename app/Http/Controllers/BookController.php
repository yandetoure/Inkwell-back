<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return response()->json(['data' => $books]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validation des données
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string|min:200',
                'cover' => 'nullable|file|image|max:2048',
            ]);
            
            // Gérer le fichier de couverture
            $coverPath = null;
            if ($request->hasFile('cover')) {
                $coverPath = $request->file('cover')->store('covers', 'public');
            }
        
            // Créer le livre et l'associer à l'utilisateur authentifié
            $book = Book::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'cover' => $coverPath,
                'author_id' => auth()->id(),
            ]);
        
            return response()->json([
                'status' => true,
                'message' => 'Le livre a été créé avec succès',
                'data' => $book,
            ], 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Une erreur est survenue : ' . $e->getMessage(),
            ], 500);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['status' => false, 'message' => 'Livre non trouvé'], 404);
        }

        return response()->json(['data' => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['status' => false, 'message' => 'Livre non trouvé'], 404);
        }

        // Validation des données
        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|min:200',
            'cover' => 'nullable|file|image|max:2048',
        ]);

        // Mettre à jour le livre
        if ($request->hasFile('cover')) {
            // Supprimer l'ancienne couverture si elle existe
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }
            $coverPath = $request->file('cover')->store('covers', 'public');
            $book->cover = $coverPath;
        }

        $book->title = $validatedData['title'] ?? $book->title;
        $book->description = $validatedData['description'] ?? $book->description;
        $book->save();

        return response()->json(['status' => true, 'message' => 'Le livre a été mis à jour avec succès', 'data' => $book]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['status' => false, 'message' => 'Livre non trouvé'], 404);
        }

        // Supprimer la couverture si elle existe
        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }

        $book->delete();

        return response()->json(['status' => true, 'message' => 'Le livre a été supprimé avec succès']);
    }
}
