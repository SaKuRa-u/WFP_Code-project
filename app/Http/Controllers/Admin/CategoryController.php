<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('services')->orderBy('category_name')->get();
        $trashedCategories = Category::onlyTrashed()->withCount('services')->orderBy('deleted_at', 'desc')->get();

        return view('category.index', compact('categories', 'trashedCategories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => ['required', 'string', 'max:255'],
            'image'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $imageName = 'no-preview.jpg';

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('categories/img', $imageName, 'public');
        }

        Category::create([
            'category_name' => $request->category_name,
            'image'         => $imageName,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $category = Category::withCount('services')->with('services')->findOrFail($id);
        return view('category.show', compact('category'));
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'category_name' => ['required', 'string', 'max:255'],
            'image'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $imageName = $category->image;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika bukan default
            if ($imageName !== 'no-preview.jpg') {
                Storage::disk('public')->delete('categories/img/' . $imageName);
            }
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('categories/img/', $imageName, 'public');
        }

        $category->update([
            'category_name' => $request->category_name,
            'image'         => $imageName,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // Cegah hapus jika masih ada services
        if ($category->services()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki layanan.');
        }

        if ($category->image !== 'no-preview.jpg') {
            Storage::disk('public')->delete('categories/' . $category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    public function restore(string $id)
    {
        Category::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dipulihkan.');
    }

    public function forceDelete(string $id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        if ($category->image !== 'no-preview.jpg') {
            Storage::disk('public')->delete('categories/' . $category->image);
        }
        $category->forceDelete();
        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus permanen.');
    }
}
