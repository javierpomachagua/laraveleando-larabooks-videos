<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class WelcomePageController extends Controller
{
    public function __invoke()
    {
        $featuredBooks = Book::query()
            ->with(['authors', 'genres', 'reviews'])
            ->withCount('reviews')
            ->withAvg('reviews', 'stars')
            ->orderByDesc('reviews_count')
            ->take(4)
            ->get();

        $reviews = Review::query()
            ->with(['book', 'user'])
            ->where('is_approved', '=', 1)
            ->where('stars', '=', 5)
            ->get()
            ->random(4);

        $books = Book::query()
            ->with(['authors', 'genres', 'reviews'])
            ->withAvg('reviews', 'stars')
            ->withCount('reviews')
            ->orderByDesc('reviews_avg_stars')
            ->take(8)
            ->get();

        return view('welcome', compact('featuredBooks', 'reviews', 'books'));
    }
}
