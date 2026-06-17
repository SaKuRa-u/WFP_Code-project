<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // 1. PASTIKAN MODEL USER DI-IMPORT DI SINI

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Pastikan user sudah login terlebih dahulu
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        /** * 2. PERBAIKAN UTAMA: Ambil data user saat ini
         * @var User $user 
         */
        $user = Auth::user();

        // 3. Validasi tambahan jika barangkali data user gagal dimuat
        if (!$user instanceof User) {
            return redirect()->route('login');
        }

        // Jika aturan mengharuskan dokter, tapi user BUKAN dokter
        if ($role === 'doctor' && !$user->isDoctor()) {
            abort(404, 'Not-Found');
        }

        // Jika aturan mengharuskan non-dokter, tapi user ADALAH dokter
        if ($role === 'non-doctor' && $user->isDoctor()) {
            abort(404, 'Not-Found');
        }

        return $next($request);
    }
}