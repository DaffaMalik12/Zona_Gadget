<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class AdminTransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')
            ->orderBy('transaction_date', 'desc')
            ->paginate(10);

        return view('admin.transactions.index', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = Transaction::with('user', 'transactionsItems.product')
            ->findOrFail($id);

        return view('admin.transactions.show', compact('transaction'));
    }
}
