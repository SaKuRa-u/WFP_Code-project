<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allData = Service::all();
        $allCategories = Category::all();
        return view('service/service', ['allServiceData' => $allData, 'categories' => $allCategories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();

        return view('service.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'SelectedCategory' => 'required|exists:categories,id',
            'description' => 'required',
            'open_hour' => 'required|date_format:H:i',
            'close_hour' => 'required|date_format:H:i',
            'price' => 'required|numeric',
        ], [
            'open_hour.date_format' => 'harap isi sesuai format yang ditentukan',
            'close_hour.date_format' => 'harap isi sesuai format yang ditentukan',
        ]);

        //
        $data = new Service();
        $data->service_name = $request->name;
        $data->category_id = $request->SelectedCategory;
        $data->description = $request->description;

        $data->availability = $request->open_hour . '-' . $request->close_hour;
        $data->price = $request->price;

        $data->save();

        return redirect()
            ->route('service.index')
            ->with('sukses', 'berhasil buat servis baru');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
        // dd($service);
        return view('service.detailService', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }
}
