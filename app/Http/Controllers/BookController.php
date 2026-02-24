<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->get();

        return view('books.index', compact(
            'books',
        ));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')
            ->with('success', 'Book berhasil ditambahkan');
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'book_code' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|digits:4',
        ]);

        $book->update($request->only([
            'book_code', 'title', 'author', 'publisher', 'year',
        ]));

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil diperbarui');
    }

    public function borrow(Book $book)
    {

        Transaction::create([
            'user_id'       => Auth::id(),
            'book_id'       => $book->id,
            'borrowed_at'   => now(),
            'status'        => 'borrowed',
        ]);


        $book->update(['is_borrowed' => true]);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dipinjam');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book berhasil dihapus');
    }
}