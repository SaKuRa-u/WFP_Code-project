<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class ArticleController extends Controller
{
    public function landing()
    {
        $articles = Article::latest()->take(6)->get();
        return view('landing', compact('articles'));
    }

    public function index(Request $request)
    {
        $query = Article::latest();

        // Search by title (untuk member)
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Admin & Doctor → tampilan tabel CRUD
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'doctor'])) {
            $articles = $query->paginate(10);
            return view('articles.admin_index', compact('articles'));
        }

        // Member & Public → tampilan card grid
        $articles = $query->latest()->get();
        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        // Related articles (exclude current)
        $related = Article::where('id', '!=', $article->id)->latest()->take(3)->get();
        return view('articles.show', compact('article', 'related'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'author'  => ['required', 'string', 'max:255'],
        ]);

        Article::create([
            'title'   => $request->title,
            'slug'    => Str::slug($request->title) . '-' . time(),
            'content' => $request->content,
            'author'  => $request->author,
        ]);

        return redirect()->route('articles.index')
                         ->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title'   => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'author'  => ['required', 'string', 'max:255'],
        ]);

        $article->update([
            'title'   => $request->title,
            'slug'    => Str::slug($request->title) . '-' . time(),
            'content' => $request->content,
            'author'  => $request->author,
        ]);

        return redirect()->route('articles.index')
                         ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')
                         ->with('success', 'Artikel berhasil dihapus.');
    }
}