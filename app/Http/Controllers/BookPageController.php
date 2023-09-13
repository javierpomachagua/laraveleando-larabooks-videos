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

        $reviews = $book->reviews()
            ->where('is_approved', 1)
            ->orderByDesc('created_at')
            ->paginate(5);

        return view('books.show', compact('book', 'reviews'));
    }
}
