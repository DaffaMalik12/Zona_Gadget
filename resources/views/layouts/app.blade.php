<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Zona Gadget') — Dashboard</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
    </style>
    @stack('styles')
</head>
<body class="h-full bg-slate-50 text-slate-800">
    <div class="flex h-full min-h-screen">

        {{-- ===== Sidebar ===== --}}
        <aside class="fixed top-0 left-0 z-50 flex h-screen w-64 flex-col border-r border-slate-700/20 bg-gradient-to-b from-indigo-950 to-indigo-900 text-white">
            {{-- Brand --}}
            <div class="flex items-center gap-3 border-b border-white/10 px-5 py-6">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-sky-500 text-lg font-extrabold shadow-lg shadow-indigo-500/30">
                    <i class="fas fa-store"></i>
                </div>
                <span class="text-xl font-bold tracking-tight">Zona<span class="text-indigo-300">Gadget</span></span>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-5">
                @if(auth()->user()->role === 'admin')
                    <p class="mb-2 px-3 text-[11px] font-semibold uppercase tracking-widest text-white/30">Dashboard</p>
                    <a href="{{ route('admin.dashboard') }}"
                       class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white shadow-sm' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                        <i class="fas fa-th-large w-5 text-center"></i>
                        Dashboard
                    </a>

                    <p class="mb-2 mt-5 px-3 text-[11px] font-semibold uppercase tracking-widest text-white/30">Manajemen</p>
                    <a href="{{ route('admin.products.index') }}"
                       class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.products.*') ? 'bg-white/10 text-white shadow-sm' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                        <i class="fas fa-box-open w-5 text-center"></i>
                        Produk
                    </a>
                    <a href="{{ route('admin.transactions.index') }}"
                       class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.transactions.*') ? 'bg-white/10 text-white shadow-sm' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                        <i class="fas fa-receipt w-5 text-center"></i>
                        Transaksi
                    </a>
                @else
                    <p class="mb-2 px-3 text-[11px] font-semibold uppercase tracking-widest text-white/30">Menu</p>
                    <a href="{{ route('customer.transactions.index') }}"
                       class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200 {{ request()->routeIs('customer.transactions.index') ? 'bg-white/10 text-white shadow-sm' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                        <i class="fas fa-list-alt w-5 text-center"></i>
                        Transaksi Saya
                    </a>
                    <a href="{{ route('customer.transactions.create') }}"
                       class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200 {{ request()->routeIs('customer.transactions.create') ? 'bg-white/10 text-white shadow-sm' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                        <i class="fas fa-cart-plus w-5 text-center"></i>
                        Buat Transaksi
                    </a>
                @endif
            </nav>

            {{-- User Footer --}}
            <div class="border-t border-white/10 p-4">
                <div class="flex items-center gap-3 rounded-lg bg-white/5 px-3 py-2.5">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-amber-400 text-sm font-bold">
                        {{ strtoupper(substr(auth()->user()->name ?? auth()->user()->username, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold text-white">{{ auth()->user()->name ?? auth()->user()->username }}</p>
                        <p class="text-[11px] capitalize text-white/50">{{ auth()->user()->role }}</p>
                    </div>
                </div>
            </div>
        </aside>

        {{-- ===== Main Content ===== --}}
        <main class="ml-64 flex flex-1 flex-col">
            {{-- Top Header --}}
            <header class="sticky top-0 z-40 flex items-center justify-between border-b border-slate-200 bg-white/80 px-8 py-4 backdrop-blur-md">
                <div>
                    <h1 class="text-xl font-bold tracking-tight text-slate-900">@yield('page-title', 'Dashboard')</h1>
                    <p class="mt-0.5 text-sm text-slate-500">@yield('page-subtitle', '')</p>
                </div>
                <div class="flex items-center gap-3">
                    @yield('header-actions')
                </div>
            </header>

            {{-- Page Content --}}
            <div class="flex-1 p-8">
                {{-- Flash Messages --}}
                @if(session('success'))
                    <div class="mb-5 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-3.5 text-sm font-medium text-emerald-800 animate-[slideDown_0.4s_ease]">
                        <i class="fas fa-check-circle text-emerald-500"></i>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-5 flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-5 py-3.5 text-sm font-medium text-red-800 animate-[slideDown_0.4s_ease]">
                        <i class="fas fa-exclamation-circle text-red-500"></i>
                        {{ session('error') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="mb-5 flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-5 py-3.5 text-sm font-medium text-red-800 animate-[slideDown_0.4s_ease]">
                        <i class="fas fa-exclamation-circle text-red-500"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
