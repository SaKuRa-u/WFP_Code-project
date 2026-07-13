<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */

        $user = Auth::user();
        $status = $request->status;
        
        // Admin & Doctor → tabel adminlte
        if (in_array($user->role, ['admin', 'doctor'])) {
            $query = Transaction::with(['user', 'doctor', 'services'])->latest();

            // Dokter hanya lihat transaksi miliknya
            if ($user->isDoctor()) {
                $query->where('doctor_id', $user->id);
            }

            if ($status && $status !== 'all') {
                $query->where('status', $status);
            }

            $transactions = $query->get();
            $statusCounts = $this->getStatusCounts($user);

            return view('transaction.admin_index', compact('transactions', 'statusCounts'));
        }

        // Member → card list, layout member
        $transactions = Transaction::with(['doctor', 'services'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('transaction.index', compact('transactions'));
    }

    public function create()
    {
        $doctors  = User::where('role', 'doctor')->with('specializations')->get();
        $services = Service::with('category')->orderBy('category_id')->get();

        return view('transaction.create', compact('doctors', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id'    => ['required', 'exists:users,id'],
            'services'     => ['required', 'array', 'min:1'],
            'services.*'   => ['exists:services,id'],
            'scheduled_at' => ['required', 'date', 'after:now'],
        ]);

        $total = Service::whereIn('id', $request->services)->sum('price');

        $transaction = Transaction::create([
            'user_id'      => Auth::id(),
            'doctor_id'    => $request->doctor_id,
            'total'        => $total,
            'status'       => 'pending',
            'scheduled_at' => $request->scheduled_at,
        ]);

        $transaction->services()->attach($request->services);

        return redirect()->route('transactions.show', $transaction->id)
            ->with('success', 'Booking berhasil dibuat! Menunggu konfirmasi.');
    }

    public function show(string $id)
    {
        $transaction = Transaction::with([
            'user',
            'doctor.specializations',
            'services.category',
            'messages.sender'
        ])->findOrFail($id);

        $this->authorize('view', $transaction);

        return view('transaction.show', compact('transaction'));
    }

    public function edit(string $id) //? belum kepake keknya
    {
        // $transaction = Transaction::findOrFail($id);
        // $this->authorize('update', $transaction);
        // return view('transaction.edit', compact('transaction'));
    }

    public function update(Request $request, string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $this->authorize('update', $transaction);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->isDoctor()) {
            $request->validate(['status' => ['required', 'in:active,completed']]);
        } else {
            $request->validate(['status' => ['required', 'in:pending,active,completed']]);
        }

        $transaction->update(['status' => $request->status]);

        return redirect()->route('transactions.show', $transaction->id)
            ->with('success', 'Status konsultasi berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $this->authorize('delete', $transaction);
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }

    private function getStatusCounts(User $user): array
    {
        $query = Transaction::query();
        if ($user->isDoctor()) {
            $query->where('doctor_id', $user->id);
        }
        return [
            'all'       => (clone $query)->count(),
            'pending'   => (clone $query)->where('status', 'pending')->count(),
            'active'    => (clone $query)->where('status', 'active')->count(),
            'completed' => (clone $query)->where('status', 'completed')->count(),
        ];
    }
}
