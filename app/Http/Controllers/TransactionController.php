<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allData = Transaction::with(['user', 'services'])->get();
        return view('transaction/transaction', ['allTransactionData' => $allData]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $services = Service::all();
        $users = User::all();
        return view('transaction.create', compact('users', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'SelectedUser' => 'required|exists:users,id',
            'SelectedService' => 'required|array',
            'SelectedService.*' => 'exists:services,id',
        ]);

        // 1. ambil service yang dipilih
        $services = Service::whereIn('id', $request->SelectedService)->get();

        // 2. hitung total
        $total = $services->sum('price');

        // 3. buat transaction
        $trans = new Transaction();
        $trans->user_id = $request->SelectedUser;
        $trans->total = $total;

        $trans->save(); //save dulu untuk dpt id transaction, baru masukin ke detail transactionnya

        // 4. isi pivot table
        $trans->services()->attach($request->SelectedService);

        return redirect()
            ->route('transaction.index')
            ->with('sukses', 'Transaction berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function showDetail()
    {
        $transaction = Transaction::with('services')
            ->find($_POST['idtrans']);

        $data = $transaction->services;

        return response()->json(array(
            'status' => 'oke',
            'title' => 'Invoice #' . $transaction->id,
            'body' => view('transaction.showDetailTrans', compact('data'))->render()
        ), 200);
    }
}
