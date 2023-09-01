<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookPageController extends Controller
{
    public function __invoke(Request $request)
    {
        $books = Book::query()
            ->with(['authors', 'genres'])
            ->withAvg('reviews', 'stars')
            ->withCount('reviews')
            ->when(request('search'), function (Builder $query, $value) {
                $query->whereRaw('books.name LIKE ?', ["%{$value}%"])
                    ->orWhereHas('authors', function (Builder $query) use ($value) {
                        $query->whereRaw('authors.name LIKE ?', ["%{$value}%"]);
                    });
            })
            ->paginate(8);

        return view('books', compact('books'));
    }
}
