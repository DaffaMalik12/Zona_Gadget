@extends('layouts.app')

@section('page-title', 'Daftar Produk')
@section('page-subtitle', 'Kelola semua produk yang tersedia di toko')

@section('header-actions')
    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 px-5 py-2.5 text-sm font-semibold text-white shadow-md shadow-indigo-500/20 transition hover:-translate-y-0.5 hover:shadow-lg hover:shadow-indigo-500/30">
        <i class="fas fa-plus"></i> Tambah Produk
    </a>
@endsection

@section('content')
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50/60 px-6 py-4">
            <h2 class="text-base font-bold text-slate-800">
                <i class="fas fa-box-open mr-2 text-indigo-500"></i>Semua Produk
            </h2>
            <span class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-0.5 text-xs font-semibold text-indigo-600">{{ $products->total() }} produk</span>
        </div>

        @if($products->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/40">
                            <th class="w-16 px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400">No</th>
                            <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400">Nama Produk</th>
                            <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400">Harga</th>
                            <th class="w-44 px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($products as $index => $product)
                            <tr class="transition hover:bg-indigo-50/30">
                                <td class="px-6 py-3.5">
                                    <span class="inline-flex items-center rounded-full bg-indigo-50 px-2.5 py-0.5 text-xs font-semibold text-indigo-600">{{ $products->firstItem() + $index }}</span>
                                </td>
                                <td class="px-6 py-3.5 text-sm font-semibold text-slate-800">{{ $product->name }}</td>
                                <td class="px-6 py-3.5 text-sm text-slate-500">{{ Str::limit($product->description, 60) }}</td>
                                <td class="px-6 py-3.5 text-sm font-semibold tabular-nums text-slate-800">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-3.5">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-600 transition hover:bg-amber-100">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="py-16 text-center">
                <i class="fas fa-box-open mb-3 text-4xl text-slate-300"></i>
                <h3 class="text-lg font-semibold text-slate-700">Belum Ada Produk</h3>
                <p class="mb-4 text-sm text-slate-500">Mulai tambahkan produk pertama Anda</p>
                <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
                    <i class="fas fa-plus"></i> Tambah Produk
                </a>
            </div>
        @endif

        @if($products->hasPages())
            <div class="border-t border-slate-100 px-6 py-4">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection