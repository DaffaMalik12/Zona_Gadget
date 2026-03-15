<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerTransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())
            ->orderBy('transaction_date', 'desc')
            ->paginate(10);

        return view('customer.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('customer.transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $products = $request->products;

        $totalQty = 0;
        $totalPrice = 0;

        DB::beginTransaction();

        try {
            $transactions = Transaction::create([
                'user_id' => auth()->id(),
                'total_quantity' => 0,
                'total_price' => 0,
                'transaction_date' => now(),
            ]);

            foreach ($products as $producId => $qty) {
                if($qty <= 0 ) continue;

                $product = Product::Find($producId);
                
                $subtotal = $qty * $product->price;

                TransactionItem::create([
                    'transaction_id' => $transactions->id,
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ]);

                $totalQty += $qty;
                $totalPrice += $subtotal;
            }

            $transactions->update([
                'total_quantity' => $totalQty,
                'total_price' => $totalPrice,
            ]);

            DB::commit();

            return redirect()->route('customer.transactions.index')->with('success', 'Transaksi berhasil');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Transaksi gagal');
        }
    }

    public function show($id)
    {
        $transaction = Transaction::with('user', 'transactionsItems.product')
            ->findOrFail($id);

        return view('customer.transactions.show', compact('transaction'));
    }
}
