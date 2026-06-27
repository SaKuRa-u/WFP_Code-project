<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Specialization;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = User::where('role', 'doctor')
            ->with('specializations')
            ->orderBy('name')->get();
        $trashedDoctors = User::where('role', 'doctor')
            ->onlyTrashed()
            ->with('specializations')
            ->orderBy('deleted_at', 'desc')->get();
        return view('doctor.index', compact('doctors', 'trashedDoctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specializations = Specialization::orderBy('name')->get();
        return view('doctor.create', compact('specializations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'email', 'unique:users,email'],
            'phone'             => ['required', 'string', 'max:20'],
            'password'          => ['required', 'confirmed', Rules\Password::defaults()],
            'specializations'   => ['nullable', 'array'],
            'specializations.*' => ['exists:specializations,id'],
        ]);

        $doctor = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'role'     => 'doctor',
            'password' => Hash::make($request->password),
        ]);

        if ($request->filled('specializations')) {
            $doctor->specializations()->attach($request->specializations);
        }

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Dokter berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $doctor = User::where('role', 'doctor')
            ->with('specializations')
            ->findOrFail($id);
        return view('doctor.detail', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $doctor          = User::where('role', 'doctor')->with('specializations')->findOrFail($id);
        $specializations = Specialization::orderBy('name')->get();
        $selectedIds     = $doctor->specializations->pluck('id')->toArray();

        return view('doctor.edit', compact('doctor', 'specializations', 'selectedIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $doctor = User::where('role', 'doctor')->findOrFail($id);

        $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'email', 'unique:users,email,' . $doctor->id],
            'phone'             => ['required', 'string', 'max:20'],
            'password'          => ['nullable', 'confirmed', Rules\Password::defaults()],
            'specializations'   => ['nullable', 'array'],
            'specializations.*' => ['exists:specializations,id'],
        ]);

        //* INI CARA MANUAL UPDATE DATA DENGAN KONDISI PASSWORD TIDAK WAJIB DIISI
        // $data = [
        //     'name'  => $request->name,
        //     'email' => $request->email,
        //     'phone' => $request->phone,
        // ];

        // if ($request->filled('password')) {
        //     $data['password'] = Hash::make($request->password);
        // }

        // $doctor->update($data);

        //* INI CARA UPDATE DATA DENGAN KONDISI PASSWORD TIDAK WAJIB DIISI DENGAN SPREAD OPERATOR
        $doctor->update([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            ...($request->filled('password')
                ? ['password' => Hash::make($request->password)]
                : []),
        ]);

        // Sync spesialisasi (hapus lama, pasang baru)
        $doctor->specializations()->sync($request->specializations ?? []);

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Data dokter berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = User::where('role', 'doctor')->findOrFail($id);
        $doctor->specializations()->detach();
        $doctor->delete();

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Dokter berhasil dihapus.');
    }

       // Restore (aktifkan kembali)
    public function restore(string $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Dokter berhasil dipulihkan.');
    }

    // Hapus permanen
    public function forceDelete(string $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Dokter berhasil dihapus permanen.');
    }
    
}
