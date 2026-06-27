<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Article;
use App\Models\Transaction;
use App\Models\Message;
use App\Policies\ArticlePolicy;
use App\Policies\TransactionPolicy;
use App\Policies\MessagePolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Article::class, ArticlePolicy::class);
        Gate::policy(Transaction::class, TransactionPolicy::class);
        Gate::policy(Message::class, MessagePolicy::class);
    }
}
