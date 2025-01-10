<?php

namespace App\Http\Controllers;

use App\Services\BibleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BibleController extends Controller
{
    protected $bibleService;

    public function __construct(BibleService $bibleService)
    {
        $this->bibleService = $bibleService;
    }

    /**
     * Afficher le formulaire avec la liste des livres.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $books = $this->bibleService->getBooks();
            $currentBook = $books[0];
            $currentChapter = 1;

            // Récupérer le premier chapitre par défaut
            $chapterData = $this->bibleService->getChapter($currentBook, $currentChapter);
            
            return view('bible.index', [
                'books' => $books,
                'currentBook' => $currentBook,
                'currentChapter' => $currentChapter,
                'verses' => $chapterData['verses'] ?? [],
                'translation' => $chapterData['translation'] ?? null,
                'errorMessage' => $chapterData['error'] ?? null
            ]);

        } catch (\Exception $e) {
            Log::error('Bible index error: ' . $e->getMessage());
            
            return view('bible.index', [
                'books' => $this->bibleService->getBooks(),
                'errorMessage' => 'Une erreur est survenue lors du chargement de la page.'
            ]);
        }
    }

    /**
     * Afficher les versets d'un livre et d'un chapitre spécifiques.
     *
     * @param  Request $request
     * @return \Illuminate\View\View
     */
    public function showChapter(Request $request)
    {
        try {
            // Validation des paramètres
            $validated = $request->validate([
                'book' => 'required|string',
                'chapter' => 'required|integer|min:1'
            ]);

            $books = $this->bibleService->getBooks();
            
            // Vérifier si le livre existe
            if (!in_array($validated['book'], $books)) {
                throw new \Exception('Le livre spécifié n\'existe pas.');
            }

            // Récupérer les données du chapitre
            $chapterData = $this->bibleService->getChapter(
                $validated['book'],
                $validated['chapter']
            );

            // Préparer les données pour la vue
            $viewData = [
                'books' => $books,
                'currentBook' => $validated['book'],
                'currentChapter' => $validated['chapter'],
                'verses' => $chapterData['verses'] ?? [],
                'translation' => $chapterData['translation'] ?? null,
                'reference' => $chapterData['reference'] ?? null
            ];

            // Ajouter le message d'erreur si présent dans la réponse
            if (isset($chapterData['error'])) {
                $viewData['errorMessage'] = $chapterData['error'];
                
                // Log l'erreur pour le débogage
                Log::warning('Bible API error', [
                    'book' => $validated['book'],
                    'chapter' => $validated['chapter'],
                    'error' => $chapterData['error'],
                    'debug' => $chapterData['debug'] ?? null
                ]);
            }

            return view('bible.index', $viewData);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Erreur de validation
            return view('bible.index', [
                'books' => $this->bibleService->getBooks(),
                'errorMessage' => 'Paramètres invalides. Veuillez vérifier votre sélection.'
            ]);

        } catch (\Exception $e) {
            // Log l'erreur pour le débogage
            Log::error('Bible showChapter error', [
                'message' => $e->getMessage(),
                'book' => $request->input('book'),
                'chapter' => $request->input('chapter')
            ]);

            return view('bible.index', [
                'books' => $this->bibleService->getBooks(),
                'errorMessage' => 'Une erreur est survenue lors de la récupération des versets.'
            ]);
        }
    }

    /**
     * Récupérer un verset spécifique (pour les requêtes AJAX).
     *
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVerse(Request $request)
    {
        try {
            $validated = $request->validate([
                'book' => 'required|string',
                'chapter' => 'required|integer|min:1',
                'verse' => 'required|integer|min:1'
            ]);

            $verseData = $this->bibleService->getVerse(
                $validated['book'],
                $validated['chapter'],
                $validated['verse']
            );

            return response()->json($verseData);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Impossible de récupérer le verset.',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}