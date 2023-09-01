<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class BookPageController extends Controller
{
    public function __invoke()
    {
        $books = Book::query()
            ->paginate(8);

        return view('books', compact('books'));
    }
}
