<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookPageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Book $book)
    {
        $book->loadAvg('reviews', 'stars')
            ->loadCount('reviews');

        return view('books.show', compact('book'));
    }
}
