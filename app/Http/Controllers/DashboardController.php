<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return match (Auth::user()->role) {
            'admin'  => view('dashboard', $this->adminData()),
            'doctor' => view('dashboard', $this->doctorData()),
            default  => view('member.dashboard', $this->memberData()),
        };
    }

    private function adminData(): array
    {
        return [
            'totalDoctors'      => User::where('role', 'doctor')->count(),
            'totalMembers'      => User::where('role', 'member')->count(),
            'totalArticles'     => Article::count(),
            'totalTransactions' => Transaction::count(),
            'activeConsult'     => Transaction::where('status', 'active')->count(),
            'completedConsult'  => Transaction::where('status', 'completed')->count(),
        ];
    }

    private function doctorData(): array
    {
        $doctorId = Auth::id();
        return [
            'activeConsult'    => Transaction::where('doctor_id', $doctorId)->where('status', 'active')->count(),
            'completedConsult' => Transaction::where('doctor_id', $doctorId)->where('status', 'completed')->count(),
            'pendingBookings'  => Transaction::where('doctor_id', $doctorId)->where('status', 'pending')->count(),
        ];
    }

    private function memberData(): array
    {
        $userId = Auth::id();
        return [
            'myTransactions'   => Transaction::where('user_id', $userId)->count(),
            'activeConsult'    => Transaction::where('user_id', $userId)->where('status', 'active')->count(),
            'completedConsult' => Transaction::where('user_id', $userId)->where('status', 'completed')->count(),
        ];
    }
}
