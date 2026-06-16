<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allData = Category::all();;
        return view('category/category', ['allCategoryData' => $allData]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = new Category();
        $data->category_name = $request->name;

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $filename = time() . '.' . $file->getClientOriginalExtension();

            $file->move(
                storage_path('app/public/categories/img'),
                $filename
            );

            $data->image = $filename;
        }

        $data->save();

        return redirect()
            ->route('category.index')
            ->with('sukses', 'berhasil buat kategori baru');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }

    public function showInfo()
    {
        $highestServiceCategory = Category::withCount('service')
            ->orderByDesc('service_count')
            ->first();

        return response()->json(array(
            'status' => 'oke',
            'msg' => '<div class="alert alert-success">The category with the most services is: <b>' .
                $highestServiceCategory->category_name . '</b></div>'
        ), 200);
    }

    public function showListServices()
    {
        $category = Category::find($_POST['idcat']);
        $name = $category->category_name;
        $data = $category->services;
        return response()->json(array(
            'status' => 'oke',
            'title' => $name . ' Service List',
            'body' => view('category.showListServices', compact('name', 'data'))->render()
        ), 200);
    }
}
