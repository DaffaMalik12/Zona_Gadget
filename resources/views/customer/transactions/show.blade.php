@extends('layouts.app')

@section('page-title', 'Detail Transaksi')
@section('page-subtitle', 'Transaksi #' . $transaction->id)

@section('header-actions')
    <a href="{{ route('customer.transactions.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-indigo-300 hover:text-indigo-600">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
@endsection

@section('content')
    {{-- Info Cards --}}
    <div class="mb-7 grid grid-cols-1 gap-5 sm:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
            <div class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-lg text-indigo-500">
                <i class="fas fa-hashtag"></i>
            </div>
            <p class="text-xs font-medium text-slate-500">ID Transaksi</p>
            <p class="mt-1 text-lg font-bold text-slate-800">#{{ $transaction->id }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
            <div class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-sky-50 text-lg text-sky-500">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <p class="text-xs font-medium text-slate-500">Tanggal Transaksi</p>
            <p class="mt-1 text-lg font-bold text-slate-800">{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
            <div class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-lg text-emerald-500">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <p class="text-xs font-medium text-slate-500">Total Harga</p>
            <p class="mt-1 text-lg font-bold text-emerald-600">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
        </div>
    </div>

    {{-- Items Table --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50/60 px-6 py-4">
            <h2 class="text-base font-bold text-slate-800">
                <i class="fas fa-shopping-bag mr-2 text-indigo-500"></i>Detail Item
            </h2>
            <span class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-0.5 text-xs font-semibold text-emerald-600">{{ $transaction->total_quantity }} item</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50/40">
                        <th class="w-16 px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400">No</th>
                        <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400">Produk</th>
                        <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400">Harga Satuan</th>
                        <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400">Qty</th>
                        <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach ($transaction->transactionsItems as $index => $item)
                        <tr class="transition hover:bg-indigo-50/30">
                            <td class="px-6 py-3.5">
                                <span class="inline-flex items-center rounded-full bg-indigo-50 px-2.5 py-0.5 text-xs font-semibold text-indigo-600">{{ $index + 1 }}</span>
                            </td>
                            <td class="px-6 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-50 to-sky-50 text-indigo-500">
                                        <i class="fas fa-cube"></i>
                                    </div>
                                    <span class="text-sm font-semibold text-slate-800">{{ $item->product->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3.5 text-sm text-slate-500">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-3.5">
                                <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-semibold text-amber-600">{{ $item->quantity }}</span>
                            </td>
                            <td class="px-6 py-3.5 text-sm font-semibold tabular-nums text-slate-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Total Summary --}}
        <div class="flex justify-end gap-10 border-t-2 border-slate-100 bg-slate-50/60 px-6 py-5">
            <div class="text-right">
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Total Qty</p>
                <p class="mt-1 text-xl font-extrabold text-slate-800">{{ $transaction->total_quantity }}</p>
            </div>
            <div class="text-right">
                <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Total Harga</p>
                <p class="mt-1 text-xl font-extrabold text-emerald-600">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
@endsection
