<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $user = request()->user();
        $books = Book::where('user_id',$user->id)->get();
        $data = $books->load('genres');
        return view('admin.admin',compact('data'));
    }

    public function addBooks()
    {
        $genres = Genre::all();
        return view('admin.add-book',compact('genres'));
    }

    public function storeBook()
    {
        $user = request()->user();
        $book = Book::create([
            'user_id' => $user->id,
            // 'genre_id' => request('genre_id'),
            'name' => request('name'),
            'description' => request('description'),
            'price' => request('price')
        ]);
        $book->genres()->attach(request('genre_id'));
        return redirect('/admin');
    }

    public function editBook($bookID)
    {
        // $genres = Genre::all();
        $book = Book::find($bookID);
        return view('admin.edit-book',compact('book'));
    }

    public function updateBook($bookID)
    {
        $user = request()->user();
        $book = Book::find($bookID);
        $book->update([
            'user_id' => $user->id,
            // 'genre_id' => request('genre_id'),
            'name' => request('name'),
            'description' => request('description'),
            'price' => request('price')
        ]);
        return redirect('/admin');
    }

    public function deleteBook($bookID)
    {
        Book::destroy($bookID);
        return redirect('/admin');
    }
}
