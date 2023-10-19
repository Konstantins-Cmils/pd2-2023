<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class DataController extends Controller
{
    // atgriež 3 nejauši izvelētas grāmatas
    public function getTopBooks()
    {
        return Book::where('display',true)
            ->inRandomOrder()
            ->take(3)
            ->get();
    }

    // atgriež izvēlēto Book ierakstu, ja tas ir publicēts
    public function getBook(book $book)
    {
        return Book:: where
        ([
            'id' => $book ->id,
            'display' => true,
        ])
        ->firstorFail();

    }

    // atgriež līdzigus ierakstus
    public function getRealatedBook(Book $book)
    {
        return Book::where('display', true)
            ->where('id', '<>', $book -> id)
            // ->where('author_id', '<>', $book -> author_id)
            ->inRandomOrder()
            ->take(3)
            ->get();
    }
}
