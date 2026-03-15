@extends('layouts.app')

@section('page-title', 'Edit Produk')
@section('page-subtitle', 'Perbarui informasi produk')

@section('header-actions')
    <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-indigo-300 hover:text-indigo-600">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
@endsection

@section('content')
    <div class="mx-auto max-w-2xl overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 bg-slate-50/60 px-6 py-4">
            <h2 class="text-base font-bold text-slate-800">
                <i class="fas fa-pen-to-square mr-2 text-amber-500"></i>Edit: {{ $product->name }}
            </h2>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Nama Produk</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}"
                           class="w-full rounded-xl border-2 border-slate-200 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"
                           required>
                    @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Deskripsi</label>
                    <textarea name="description" rows="4"
                              class="w-full rounded-xl border-2 border-slate-200 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"
                              required>{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" min="0"
                           class="w-full rounded-xl border-2 border-slate-200 px-4 py-3 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"
                           required>
                    @error('price')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-amber-500 to-amber-400 px-6 py-3 text-sm font-bold text-white shadow-md shadow-amber-500/20 transition hover:-translate-y-0.5 hover:shadow-lg">
                        <i class="fas fa-save"></i> Update Produk
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="inline-flex items-center rounded-xl border border-slate-200 px-6 py-3 text-sm font-semibold text-slate-500 transition hover:bg-slate-50">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
