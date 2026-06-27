<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services   = Service::with('category')->orderBy('service_name')->get();
        $trashedServices = Service::onlyTrashed()->with('category')->get();

        $categories = Category::orderBy('category_name')->get();
        return view('service.index', compact('services', 'trashedServices', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('category_name')->get();
        return view('service.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_name' => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string'],
            'availability' => ['required', 'string', 'max:100'],
            'price'        => ['required', 'numeric', 'min:0'],
            'category_id'  => ['required', 'exists:categories,id'],
        ]);

        Service::create($request->only([
            'service_name',
            'description',
            'availability',
            'price',
            'category_id'
        ]));

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $service = Service::with('category')->findOrFail($id);
        return view('service.show', compact('service'));
    }

    public function edit(string $id)
    {
        $service    = Service::findOrFail($id);
        $categories = Category::orderBy('category_name')->get();
        return view('service.edit', compact('service', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'service_name' => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string'],
            'availability' => ['required', 'string', 'max:100'],
            'price'        => ['required', 'numeric', 'min:0'],
            'category_id'  => ['required', 'exists:categories,id'],
        ]);

        $service->update($request->only([
            'service_name',
            'description',
            'availability',
            'price',
            'category_id'
        ]));

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }

    public function restore(string $id)
    {
        Service::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil dipulihkan.');
    }

    public function forceDelete(string $id)
    {
        Service::withTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('admin.services.index')
            ->with('success', 'Layanan berhasil dihapus permanen.');
    }
}
