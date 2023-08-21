<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

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

        $reviews = Review::query()
            ->where('is_approved', '=', 1)
            ->where('stars', '=', 5)
            ->get()
            ->random(4);

        return view('welcome', compact('books', 'reviews'));
    }
}
