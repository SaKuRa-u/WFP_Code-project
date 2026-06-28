<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Transaction $transaction)
    {
        $this->authorize('view', $transaction);

        // Redirect ke halaman show transaksi (chat ada di sana)
        return redirect()->route('transactions.show', $transaction->id);
    }

    public function store(Request $request, Transaction $transaction)
    {
        $this->authorize('create', [Message::class, $transaction]);

        // Hanya bisa chat jika status active
        if ($transaction->status !== 'active') {
            return back()->with('error', 'Konsultasi belum aktif atau sudah selesai.');
        }

        $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        Message::create([
            'transaction_id' => $transaction->id,
            'sender_id'      => Auth::id(),
            'message'        => $request->message,
        ]);

        return redirect()->route('transactions.show', $transaction->id)
                         ->with('chat_sent', true);
    }
}