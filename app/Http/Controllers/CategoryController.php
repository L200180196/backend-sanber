<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use App\Models\Book;

class CategoryController extends Controller
{
    public function getAll() {
        $categories = Category::all();
        return response()->json([
            'status' => 'Success',
            'data' => $categories
        ]);
    }

    public function getBook($id) {
        // Check Category
        $category = Category::find($id);
        if(!$category) {
            return response()->json([
                'status' => "Error 404",
                'message' => 'Category not Found'
            ], 404);
        }
        $book = Book::where('category_id', '=' ,$id)->get();
        return response()->json([
            'status' => 'Success',
            'data' => $book
        ]);
    }

    public function create(Request $request) {
        $rules = [
            'name' => 'required|string'
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if($validator->fails()) {
            return response()->json([
                'status' => 'Error 400',
                'message' => $validator->errors()
            ], 400);
        }

        $category = Category::create($data);
        return response()->json([
            'status' => 'Success Create Data',
            'data' => $category
        ]);
    }

    public function update(Request $request, $id) {
        // Check Data Category in Database
        $category = Category::find($id);

        if(!$category) {
            return response()->json([
                'status' => "Error 404",
                'message' => 'Category not Found'
            ], 404);
        }

        $rules = [
            'name' => 'required|string'
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if($validator->fails()) {
            return response()->json([
                'status' => 'Error 400',
                'message' => $validator->errors()
            ], 400);
        }

        $category->fill($data);
        $category->save();
        return response()->json([
            'status' => 'Success Update Data',
            'data' => $category
        ]);
    }

    public function destroy($id)
    {
        // Check data in database
        $category = Category::find($id);

        if(!$category) {
            return response()->json([
                'status' => "Error 404",
                'message' => 'Category not Found'
            ], 404);
        }

        $category->delete();
        return response()->json([
            'status' => "Success",
            'data' => 'Data Category succesfull deleted'
        ]);
    }
}
