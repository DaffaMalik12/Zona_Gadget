@extends('layouts.app')

@section('page-title', 'Semua Transaksi')
@section('page-subtitle', 'Lihat semua transaksi dari seluruh pelanggan')

@section('content')
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50/60 px-6 py-4">
            <h2 class="text-base font-bold text-slate-800">
                <i class="fas fa-receipt mr-2 text-indigo-500"></i>Riwayat Transaksi
            </h2>
            <span class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-0.5 text-xs font-semibold text-indigo-600">{{ $transactions->total() }} transaksi</span>
        </div>

        @if($transactions->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/40">
                            <th class="w-16 px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400">No</th>
                            <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400">Pelanggan</th>
                            <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400">Tanggal</th>
                            <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400">Total Qty</th>
                            <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400">Total Harga</th>
                            <th class="w-28 px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($transactions as $index => $trx)
                            <tr class="transition hover:bg-indigo-50/30">
                                <td class="px-6 py-3.5">
                                    <span class="inline-flex items-center rounded-full bg-indigo-50 px-2.5 py-0.5 text-xs font-semibold text-indigo-600">{{ $transactions->firstItem() + $index }}</span>
                                </td>
                                <td class="px-6 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-sky-500 text-xs font-bold text-white">
                                            {{ strtoupper(substr($trx->user->name ?? $trx->user->username ?? 'U', 0, 1)) }}
                                        </div>
                                        <span class="text-sm font-semibold text-slate-700">{{ $trx->user->name ?? $trx->user->username }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-3.5 text-sm text-slate-500">
                                    <i class="fas fa-calendar-alt mr-1 text-slate-300"></i>
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
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="py-16 text-center">
                <i class="fas fa-receipt mb-3 text-4xl text-slate-300"></i>
                <h3 class="text-lg font-semibold text-slate-700">Belum Ada Transaksi</h3>
                <p class="text-sm text-slate-500">Transaksi dari pelanggan akan muncul di sini</p>
            </div>
        @endif

        @if($transactions->hasPages())
            <div class="border-t border-slate-100 px-6 py-4">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
@endsection
