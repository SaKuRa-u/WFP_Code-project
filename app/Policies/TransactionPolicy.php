<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TransactionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Transaction $transaction): bool
    {
        // Admin bisa lihat semua, member & dokter hanya milik sendiri
        return $user->role === 'admin'
            || $transaction->user_id === $user->id
            || $transaction->doctor_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->role === 'member';
    }

    public function update(User $user, Transaction $transaction): bool
    {
        return $user->role === 'admin'
            || $transaction->doctor_id === $user->id;
    }

    public function delete(User $user, Transaction $transaction): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Transaction $transaction): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Transaction $transaction): bool
    {
        return false;
    }
}
