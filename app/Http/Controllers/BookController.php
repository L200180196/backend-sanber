<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function getAll() {
        $books = Book::all();
        return response()->json([
            'status' => 'Success',
            'data' => $books
        ]);
    }

    public function create(Request $request) {
        $data = $request->all();

        // Check Category
        $category = Category::find($data['category_id']);
        if(!$category) {
            return response()->json([
                'status' => "Error 404",
                'message' => 'Category not Found'
            ], 404);
        }

        // validasi Release Year
        if($data['release_year'] >= 1980 &&  $data['release_year'] <=2021) {
        } else {
            return response()->json([
                'status' => "Error 400",
                'message' => 'Release Year must between 1980 - 2021'
            ], 400);
        }

        // Input Thickness
        $total_page = $data['total_page'];
        if($total_page <= 100) {
            $data['thickness'] = 'tipis';
        } elseif($total_page <= 200) {
            $data['thickness'] = 'sedang';
        } elseif($total_page >= 201) {
            $data['thickness'] = 'tebal';
        }

        $rules = [
            'title' => 'required|string',
            'description' => 'required|string',
            'image_url' => 'required|string',
            'release_year' => 'required|integer',
            'price' => 'required|string',
            'total_page' => 'required|integer',
            'thickness' => 'required|string',
            'category_id' => 'required|integer'
        ];

        $validator = Validator::make($data, $rules);

        if($validator->fails()) {
            return response()->json([
                'status' => 'Error 400',
                'message' => $validator->errors()
            ], 400);
        }

        $book = Book::create($data);
        return response()->json([
            'status' => 'Success Create Data',
            'data' => $book
        ]);
    }

    public function update(Request $request, $id) {
        // Check data Book
        $book = Book::find($id);
        if(!$book) {
            return response()->json([
                'status' => "Error 404",
                'message' => 'Book not Found'
            ], 404);
        }

        $data = $request->all();

        // Check Category
        $category = Category::find($data['category_id']);
        if(!$category) {
            return response()->json([
                'status' => "Error 404",
                'message' => 'Category not Found'
            ], 404);
        }

        // validasi Release Year
        if($data['release_year'] >= 1980 &&  $data['release_year'] <=2021) {
        } else {
            return response()->json([
                'status' => "Error 400",
                'message' => 'Release Year must between 1980 - 2021'
            ], 400);
        }

        // Input Thickness
        $total_page = $data['total_page'];
        if($total_page <= 100) {
            $data['thickness'] = 'tipis';
        } elseif($total_page <= 200) {
            $data['thickness'] = 'sedang';
        } elseif($total_page >= 201) {
            $data['thickness'] = 'tebal';
        }

        $rules = [
            'title' => 'required|string',
            'description' => 'required|string',
            'image_url' => 'required|string',
            'release_year' => 'required|integer',
            'price' => 'required|string',
            'total_page' => 'required|integer',
            'thickness' => 'required|string',
            'category_id' => 'required|integer'
        ];

        $validator = Validator::make($data, $rules);

        if($validator->fails()) {
            return response()->json([
                'status' => 'Error 400',
                'message' => $validator->errors()
            ], 400);
        }

        $book->fill($data);
        $book->save();
        return response()->json([
            'status' => 'Success Create Data',
            'data' => $book
        ]);
    }

    public function destroy($id)
    {
        // Check data in database
        $book = Book::find($id);

        if(!$book) {
            return response()->json([
                'status' => "Error 404",
                'message' => 'Book not Found'
            ], 404);
        }

        $book->delete();
        return response()->json([
            'status' => "Success",
            'data' => 'Data Book succesfull deleted'
        ]);
    }
}
