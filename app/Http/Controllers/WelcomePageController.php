<?php

namespace App\Http\Controllers;

use App\Models\Book;

class WelcomePageController extends Controller
{
    public function __invoke()
    {
        $books = Book::with(['authors', 'genres'])->get();

        return view('welcome', compact('books'));
    }
}
