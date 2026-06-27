<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // semua role bisa lihat list
    }

    public function view(User $user, Article $article): bool
    {
        return true; // semua role bisa baca
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'doctor']);
    }

    public function update(User $user, Article $article): bool
    {
        return in_array($user->role, ['admin', 'doctor']);
    }

    public function delete(User $user, Article $article): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Article $article): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Article $article): bool
    {
        return false;
    }
}
