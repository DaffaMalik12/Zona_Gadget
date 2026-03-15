@extends('layouts.app')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang kembali, ' . (auth()->user()->name ?? auth()->user()->username) . '!')

@section('content')
    {{-- Stats Grid --}}
    <div class="mb-7 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
        {{-- Total Produk --}}
        <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg">
            <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-xl text-indigo-500">
                <i class="fas fa-box-open"></i>
            </div>
            <p class="text-3xl font-extrabold tracking-tight text-slate-800">{{ $totalProducts }}</p>
            <p class="mt-1 text-sm font-medium text-slate-500">Total Produk</p>
        </div>

        {{-- Total Transaksi --}}
        <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg">
            <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-sky-50 text-xl text-sky-500">
                <i class="fas fa-receipt"></i>
            </div>
            <p class="text-3xl font-extrabold tracking-tight text-slate-800">{{ $totalTransactions }}</p>
            <p class="mt-1 text-sm font-medium text-slate-500">Total Transaksi</p>
        </div>

        {{-- Total Revenue --}}
        <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg">
            <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-xl text-emerald-500">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <p class="text-2xl font-extrabold tracking-tight text-slate-800">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            <p class="mt-1 text-sm font-medium text-slate-500">Total Pendapatan</p>
        </div>

        {{-- Total Customer --}}
        <div class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg">
            <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-xl text-amber-500">
                <i class="fas fa-users"></i>
            </div>
            <p class="text-3xl font-extrabold tracking-tight text-slate-800">{{ $totalCustomers }}</p>
            <p class="mt-1 text-sm font-medium text-slate-500">Total Pelanggan</p>
        </div>
    </div>

    {{-- Recent Transactions --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50/60 px-6 py-4">
            <h2 class="text-base font-bold text-slate-800">
                <i class="fas fa-clock mr-2 text-indigo-500"></i>Transaksi Terbaru
            </h2>
            <a href="{{ route('admin.transactions.index') }}" class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-500 transition hover:border-indigo-300 hover:text-indigo-600">
                Lihat Semua <i class="fas fa-arrow-right text-[10px]"></i>
            </a>
        </div>

        @if($recentTransactions->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/40">
                            <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400">Pelanggan</th>
                            <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400">Tanggal</th>
                            <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400">Items</th>
                            <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400">Total</th>
                            <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($recentTransactions as $trx)
                            <tr class="transition hover:bg-indigo-50/30">
                                <td class="px-6 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-sky-500 text-xs font-bold text-white">
                                            {{ strtoupper(substr($trx->user->name ?? $trx->user->username ?? 'U', 0, 1)) }}
                                        </div>
                                        <span class="text-sm font-semibold text-slate-700">{{ $trx->user->name ?? $trx->user->username }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-3.5 text-sm text-slate-500">
                                    {{ \Carbon\Carbon::parse($trx->transaction_date)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-3.5">
                                    <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-semibold text-emerald-600">{{ $trx->total_quantity }} item</span>
                                </td>
                                <td class="px-6 py-3.5 text-sm font-semibold tabular-nums text-slate-800">
                                    Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-3.5">
                                    <a href="{{ route('admin.transactions.show', $trx->id) }}" class="inline-flex items-center gap-1.5 rounded-lg bg-sky-50 px-3 py-1.5 text-xs font-semibold text-sky-600 transition hover:bg-sky-100">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="py-16 text-center">
                <i class="fas fa-chart-line mb-3 text-4xl text-slate-300"></i>
                <h3 class="text-lg font-semibold text-slate-700">Belum Ada Transaksi</h3>
                <p class="text-sm text-slate-500">Data transaksi akan muncul di sini</p>
            </div>
        @endif
    </div>
@endsection
