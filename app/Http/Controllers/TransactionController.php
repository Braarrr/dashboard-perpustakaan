<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $query = Transaction::with(['book', 'user'])->latest();

        if (Auth::user()->role === 'member') {
            $query->where('user_id', Auth::id());
        }

        $transactions = $query->get();

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        return view('transactions.create', [
            'books' => Book::where('is_borrowed', false)->get(),
            'users' => User::where('role', 'member')->get(),
        ]);
    }

    // Simpan peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        // cek apakah buku sudah dipinjam
        if ($book->is_borrowed) {
            return back()->with('error', 'Buku sedang dipinjam');
        }

        Transaction::create([
            'book_id' => $book->id,
            'user_id' => $request->user_id,
            'borrowed_at' => now(),
            'status' => 'borrowed',
        ]);

        $book->update([
            'is_borrowed' => true,
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dipinjam');
    }

    public function return(Transaction $transaction)
    {
        if (
            (Auth::user()->role == 'member') &&
                ($transaction->user_id != Auth::id())
        ) {
            abort(403);
        }

        if ($transaction->status === 'returned') {
            return redirect()
                ->route('transactions.index')
                ->with('error', 'Buku ini sudah dikembalikan');
        }

        $transaction->update([
            'returned_at' => now(),
            'status' => 'returned',
        ]);

        $transaction->book->update([
            'is_borrowed' => false,
        ]);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Buku berhasil dikembalikan');
    }
}