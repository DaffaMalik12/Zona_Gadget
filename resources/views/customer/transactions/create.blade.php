@extends('layouts.app')

@section('page-title', 'Buat Transaksi')
@section('page-subtitle', 'Pilih produk dan tentukan jumlah yang ingin dibeli')

@section('header-actions')
    <a href="{{ route('customer.transactions.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-indigo-300 hover:text-indigo-600">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
@endsection

@section('content')
    <form action="{{ route('customer.transactions.store') }}" method="POST" id="transactionForm">
        @csrf

        <div class="grid grid-cols-1 items-start gap-7 lg:grid-cols-[1fr_340px]">
            {{-- Products --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50/60 px-6 py-4">
                    <h2 class="text-base font-bold text-slate-800">
                        <i class="fas fa-box-open mr-2 text-indigo-500"></i>Pilih Produk
                    </h2>
                    <span class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-0.5 text-xs font-semibold text-indigo-600">{{ $products->count() }} tersedia</span>
                </div>
                <div class="p-5">
                    @if($products->count() > 0)
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            @foreach ($products as $product)
                                <div class="group rounded-2xl border-2 border-slate-200 p-5 transition-all hover:-translate-y-0.5 hover:border-indigo-300 hover:shadow-md"
                                     id="product-card-{{ $product->id }}">
                                    <div class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-50 to-sky-50 text-indigo-500">
                                        <i class="fas fa-cube text-lg"></i>
                                    </div>
                                    <h3 class="text-sm font-bold text-slate-800">{{ $product->name }}</h3>
                                    <p class="mt-1 text-xs leading-relaxed text-slate-500">{{ Str::limit($product->description, 80) }}</p>
                                    <p class="mt-3 text-lg font-extrabold text-indigo-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                                    {{-- Qty Control --}}
                                    <div class="mt-4 flex items-center overflow-hidden rounded-lg border-2 border-slate-200" style="width: fit-content;">
                                        <button type="button" onclick="changeQty({{ $product->id }}, -1)"
                                                class="flex h-9 w-9 items-center justify-center bg-slate-50 text-sm font-bold text-slate-500 transition hover:bg-indigo-500 hover:text-white">−</button>
                                        <input type="number" name="products[{{ $product->id }}]" id="qty-{{ $product->id }}"
                                               value="0" min="0"
                                               data-price="{{ $product->price }}" data-name="{{ $product->name }}"
                                               onchange="updateSummary()"
                                               class="h-9 w-14 border-x border-slate-200 bg-white text-center text-sm font-bold text-slate-800 outline-none [appearance:textfield] [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">
                                        <button type="button" onclick="changeQty({{ $product->id }}, 1)"
                                                class="flex h-9 w-9 items-center justify-center bg-slate-50 text-sm font-bold text-slate-500 transition hover:bg-indigo-500 hover:text-white">+</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-12 text-center">
                            <i class="fas fa-box-open mb-3 text-4xl text-slate-300"></i>
                            <h3 class="text-lg font-semibold text-slate-700">Tidak Ada Produk</h3>
                            <p class="text-sm text-slate-500">Belum ada produk yang tersedia saat ini</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="sticky top-24 rounded-2xl bg-gradient-to-b from-indigo-950 to-indigo-900 p-7 text-white shadow-xl shadow-indigo-900/30">
                <h3 class="flex items-center gap-2.5 text-lg font-bold">
                    <i class="fas fa-shopping-bag"></i>
                    Ringkasan Belanja
                </h3>

                <div class="mt-5" id="summaryItems">
                    <div class="py-8 text-center text-sm text-white/40">
                        <i class="fas fa-cart-arrow-down mb-2 block text-3xl"></i>
                        Belum ada produk dipilih
                    </div>
                </div>

                <div class="mt-3 hidden border-t-2 border-white/20 pt-4" id="summaryTotal">
                    <div class="flex items-center justify-between text-lg font-extrabold">
                        <span>Total</span>
                        <span id="totalPrice">Rp 0</span>
                    </div>
                </div>

                <button type="submit" id="checkoutBtn" disabled
                        class="mt-5 flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-emerald-500 to-emerald-400 py-3.5 text-sm font-bold text-white shadow-lg shadow-emerald-500/25 transition hover:-translate-y-0.5 hover:shadow-xl disabled:cursor-not-allowed disabled:opacity-40 disabled:hover:translate-y-0 disabled:hover:shadow-lg">
                    <i class="fas fa-check-circle"></i>
                    Buat Transaksi
                </button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    function changeQty(productId, delta) {
        const input = document.getElementById('qty-' + productId);
        let val = parseInt(input.value) || 0;
        val += delta;
        if (val < 0) val = 0;
        input.value = val;

        const card = document.getElementById('product-card-' + productId);
        if (val > 0) {
            card.classList.remove('border-slate-200');
            card.classList.add('border-indigo-500', 'bg-indigo-50/30', 'shadow-md');
        } else {
            card.classList.add('border-slate-200');
            card.classList.remove('border-indigo-500', 'bg-indigo-50/30', 'shadow-md');
        }
        updateSummary();
    }

    function updateSummary() {
        const inputs = document.querySelectorAll('[id^="qty-"]');
        let html = '';
        let total = 0;
        let hasItems = false;

        inputs.forEach(input => {
            const qty = parseInt(input.value) || 0;
            if (qty > 0) {
                hasItems = true;
                const price = parseFloat(input.dataset.price);
                const name = input.dataset.name;
                const subtotal = qty * price;
                total += subtotal;
                html += `<div class="flex justify-between border-b border-white/10 py-2.5 text-sm">
                    <span class="text-white/80">${name} × ${qty}</span>
                    <span class="font-semibold">Rp ${subtotal.toLocaleString('id-ID')}</span>
                </div>`;
            }
        });

        const summaryItems = document.getElementById('summaryItems');
        const summaryTotal = document.getElementById('summaryTotal');
        const totalPrice = document.getElementById('totalPrice');
        const checkoutBtn = document.getElementById('checkoutBtn');

        if (hasItems) {
            summaryItems.innerHTML = html;
            summaryTotal.classList.remove('hidden');
            totalPrice.textContent = 'Rp ' + total.toLocaleString('id-ID');
            checkoutBtn.disabled = false;
        } else {
            summaryItems.innerHTML = `<div class="py-8 text-center text-sm text-white/40">
                <i class="fas fa-cart-arrow-down mb-2 block text-3xl"></i>
                Belum ada produk dipilih
            </div>`;
            summaryTotal.classList.add('hidden');
            checkoutBtn.disabled = true;
        }
    }

    updateSummary();
</script>
@endpush
