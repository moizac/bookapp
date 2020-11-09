<?php

namespace App\Http\Controllers;

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
}

