<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function getAll() {
        $books = Book::all();
        return response()->json([
            'status' => 'Success',
            'data' => $books
        ]);
    }
}
