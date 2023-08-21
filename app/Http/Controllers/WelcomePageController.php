<?php

namespace App\Http\Controllers;

use App\Models\Book;

class WelcomePageController extends Controller
{
    public function __invoke()
    {
        $books = Book::query()
            ->with(['authors', 'genres', 'reviews'])
            ->withCount('reviews')
            ->withAvg('reviews', 'stars')
            ->orderByDesc('reviews_count')
            ->take(4)
            ->get();

        return view('welcome', compact('books'));
    }
}
