<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;

class BooksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        $Book = Book::all();
        return response()->json([
            'message' => 'Menampilkan Semua Buku',
            'data' => $Book
        ], 200);
    }
    public function show($id)
    {
        $Book = Book::find($id);
        if($Book){
            return response()->json([
                'message' => 'Buku Berhasil Ditemukan',
                'data' => $Book
            ], 200);
        }else{
            return response()->json([
                'message' => 'Buku Tidak Ada'
            ], 404);
        }
    }
    public function store(Request $request)
    {
    $this->validate($request, [
      'title' => 'required',
      'description' => 'required',
      'author' => 'required'
    ]);

    $book = Book::create(
      $request->only(['title', 'description', 'author'])
    );

    return response()->json([
      'created' => true,
      'data' => $book
    ], 201);
  }
  public function update(Request $request, $id)
  {
    try {
      $book = Book::findOrFail($id);
    } catch (ModelNotFoundException $e) {
      return response()->json([
        'message' => 'book not found'
      ], 404);
    }

    $book->fill(
      $request->only(['title', 'description', 'author'])
    );
    $book->save();

    return response()->json([
      'updated' => true,
      'data' => $book
    ], 200);
  }
  public function destroy($id)
  {
    try {
      $book = Book::findOrFail($id);
    } catch (ModelNotFoundException $e) {
      return response()->json([
        'error' => [
          'message' => 'book not found'
        ]
      ], 404);
    }

    $book->delete();

    return response()->json([
      'deleted' => true
    ], 200);
  }
}

