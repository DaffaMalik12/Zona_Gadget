<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalTransactions = Transaction::count();
        $totalRevenue = Transaction::sum('total_price');
        $totalCustomers = User::where('role', 'customer')->count();

        $recentTransactions = Transaction::with('user')
            ->orderBy('transaction_date', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalTransactions',
            'totalRevenue',
            'totalCustomers',
            'recentTransactions'
        ));
    }
}
