<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class BibleService
{
    protected $client;
    protected $bookMappings;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://bible-api.com/',
            'headers' => [
                'Accept' => 'application/json',
            ],
            'verify' => false, 
        ]);

        // Mappings des noms de livres pour l'API
        $this->bookMappings = [
            'Genesis' => 'GEN',
            'Exodus' => 'EXO',
            'Leviticus' => 'LEV',
            'Numbers' => 'NUM',
            'Deuteronomy' => 'DEU',
            'Joshua' => 'JOS',
            'Judges' => 'JDG',
            'Ruth' => 'RUT',
            '1 Samuel' => '1SA',
            '2 Samuel' => '2SA',
            '1 Kings' => '1KI',
            '2 Kings' => '2KI',
            '1 Chronicles' => '1CH',
            '2 Chronicles' => '2CH',
            'Ezra' => 'EZR',
            'Nehemiah' => 'NEH',
            'Esther' => 'EST',
            'Job' => 'JOB',
            'Psalms' => 'PSA',
            'Proverbs' => 'PRO',
            'Ecclesiastes' => 'ECC',
            'Song of Songs' => 'SNG',
            'Isaiah' => 'ISA',
            'Jeremiah' => 'JER',
            'Lamentations' => 'LAM',
            'Ezekiel' => 'EZK',
            'Daniel' => 'DAN',
            'Hosea' => 'HOS',
            'Joel' => 'JOL',
            'Amos' => 'AMO',
            'Obadiah' => 'OBA',
            'Jonah' => 'JON',
            'Micah' => 'MIC',
            'Nahum' => 'NAM',
            'Habakkuk' => 'HAB',
            'Zephaniah' => 'ZEP',
            'Haggai' => 'HAG',
            'Zechariah' => 'ZEC',
            'Malachi' => 'MAL',
            'Matthew' => 'MAT',
            'Mark' => 'MRK',
            'Luke' => 'LUK',
            'John' => 'JHN',
            'Acts' => 'ACT',
            'Romans' => 'ROM',
            '1 Corinthians' => '1CO',
            '2 Corinthians' => '2CO',
            'Galatians' => 'GAL',
            'Ephesians' => 'EPH',
            'Philippians' => 'PHP',
            'Colossians' => 'COL',
            '1 Thessalonians' => '1TH',
            '2 Thessalonians' => '2TH',
            '1 Timothy' => '1TI',
            '2 Timothy' => '2TI',
            'Titus' => 'TIT',
            'Philemon' => 'PHM',
            'Hebrews' => 'HEB',
            'James' => 'JAS',
            '1 Peter' => '1PE',
            '2 Peter' => '2PE',
            '1 John' => '1JN',
            '2 John' => '2JN',
            '3 John' => '3JN',
            'Jude' => 'JUD',
            'Revelation' => 'REV'
        ];
    }

    public function getBooks()
    {
        return array_keys($this->bookMappings);
    }

    public function getChapter($book, $chapter)
    {
        try {
            // Vérifier si le livre existe dans nos mappings
            if (!isset($this->bookMappings[$book])) {
                return [
                    'verses' => [],
                    'error' => 'Livre non trouvé dans les mappings.',
                    'reference' => $book
                ];
            }

            // Formater la référence pour l'API
            $apiBook = $this->bookMappings[$book];
            $reference = $apiBook . '+' . $chapter;

            // Faire l'appel API
            $response = $this->client->get($reference);
            $data = json_decode($response->getBody(), true);

            // Vérifier et transformer la réponse
            if (isset($data['verses']) && is_array($data['verses'])) {
                $verses = [];
                foreach ($data['verses'] as $verse) {
                    $verses[$verse['verse']] = trim($verse['text']);
                }

                return [
                    'verses' => $verses,
                    'reference' => $data['reference'] ?? "$book $chapter",
                    'translation' => $data['translation_name'] ?? 'KJV'
                ];
            }

            return [
                'verses' => [],
                'error' => 'Format de réponse invalide de l\'API',
                'reference' => "$book $chapter"
            ];

        } catch (RequestException $e) {
            // Log l'erreur pour le débogage
            \Log::error('Bible API error', [
                'book' => $book,
                'chapter' => $chapter,
                'error' => $e->getMessage()
            ]);

            return [
                'verses' => [],
                'error' => 'Erreur lors de la récupération du chapitre. Vérifiez la référence.',
                'reference' => "$book $chapter",
                'debug' => $e->getMessage()
            ];
        }
    }

    public function getVerse($book, $chapter, $verse)
    {
        try {
            if (!isset($this->bookMappings[$book])) {
                return [
                    'text' => 'Livre non trouvé',
                    'reference' => $book
                ];
            }

            $apiBook = $this->bookMappings[$book];
            $reference = $apiBook . '+' . $chapter . ':' . $verse;
            
            $response = $this->client->get($reference);
            $data = json_decode($response->getBody(), true);

            if (isset($data['verses']) && !empty($data['verses'])) {
                return [
                    'text' => trim($data['verses'][0]['text']),
                    'reference' => $data['reference'],
                    'translation' => $data['translation_name'] ?? 'KJV'
                ];
            }

            return [
                'text' => 'Verset non trouvé',
                'reference' => "$book $chapter:$verse"
            ];

        } catch (\Exception $e) {
            return [
                'text' => 'Erreur lors de la récupération du verset',
                'reference' => "$book $chapter:$verse",
                'error' => $e->getMessage()
            ];
        }
    }

    private function getChaptersCount($book)
    {
        $bookChapters = [
            'Genesis' => 50, 'Exodus' => 40, 'Leviticus' => 27,
            'Numbers' => 36, 'Deuteronomy' => 34, 'Joshua' => 24,
            'Judges' => 21, 'Ruth' => 4, '1 Samuel' => 31,
            '2 Samuel' => 24, '1 Kings' => 22, '2 Kings' => 25,
            '1 Chronicles' => 29, '2 Chronicles' => 36, 'Ezra' => 10,
            'Nehemiah' => 13, 'Esther' => 10, 'Job' => 42,
            'Psalms' => 150, 'Proverbs' => 31, 'Ecclesiastes' => 12,
            'Song of Songs' => 8, 'Isaiah' => 66, 'Jeremiah' => 52,
            'Lamentations' => 5, 'Ezekiel' => 48, 'Daniel' => 12,
            'Hosea' => 14, 'Joel' => 3, 'Amos' => 9,
            'Obadiah' => 1, 'Jonah' => 4, 'Micah' => 7,
            'Nahum' => 3, 'Habakkuk' => 3, 'Zephaniah' => 3,
            'Haggai' => 2, 'Zechariah' => 14, 'Malachi' => 4,
            'Matthew' => 28, 'Mark' => 16, 'Luke' => 24,
            'John' => 21, 'Acts' => 28, 'Romans' => 16,
            '1 Corinthians' => 16, '2 Corinthians' => 13, 'Galatians' => 6,
            'Ephesians' => 6, 'Philippians' => 4, 'Colossians' => 4,
            '1 Thessalonians' => 5, '2 Thessalonians' => 3, '1 Timothy' => 6,
            '2 Timothy' => 4, 'Titus' => 3, 'Philemon' => 1,
            'Hebrews' => 13, 'James' => 5, '1 Peter' => 5,
            '2 Peter' => 3, '1 John' => 5, '2 John' => 1,
            '3 John' => 1, 'Jude' => 1, 'Revelation' => 22
        ];
        
        return $bookChapters[$book] ?? 0;
    }


    public function getDailyVerses($count = 3)
{
    $books = array_keys($this->bookMappings);
    $verses = [];

    for ($i = 0; $i < $count; $i++) {
        // Sélectionner un livre aléatoire
        $book = $books[array_rand($books)];
        $chaptersCount = $this->getChaptersCount($book);

        if ($chaptersCount > 0) {
            // Sélectionner un chapitre aléatoire
            $chapter = rand(1, $chaptersCount);

            // Récupérer le contenu du chapitre
            $chapterData = $this->getChapter($book, $chapter);

            if (!empty($chapterData['verses'])) {
                // Sélectionner un verset aléatoire dans le chapitre
                $verseNumber = array_rand($chapterData['verses']);
                $verses[] = [
                    'reference' => "{$book} {$chapter}:{$verseNumber}",
                    'text' => $chapterData['verses'][$verseNumber]
                ];
            }
        }
    }

    return $verses;
}

}