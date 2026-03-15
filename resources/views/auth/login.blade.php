<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Zona sGadget</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
    </style>
</head>
<body class="flex h-full min-h-screen items-center justify-center bg-gradient-to-br from-indigo-950 via-indigo-900 to-indigo-700">

    {{-- Decorative blobs --}}
    <div class="pointer-events-none fixed inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-32 h-[500px] w-[500px] animate-pulse rounded-full bg-indigo-500/20 blur-3xl"></div>
        <div class="absolute -bottom-32 -left-32 h-[400px] w-[400px] animate-pulse rounded-full bg-sky-500/15 blur-3xl" style="animation-delay: 1s"></div>
    </div>

    <div class="relative z-10 w-full max-w-md px-5">
        <div class="rounded-3xl border border-white/10 bg-white/95 p-10 shadow-2xl shadow-black/20 backdrop-blur-xl">
            {{-- Header --}}
            <div class="mb-8 text-center">
                <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-sky-500 text-3xl text-white shadow-lg shadow-indigo-500/30">
                    <i class="fas fa-store"></i>
                </div>
                <h1 class="text-2xl font-extrabold tracking-tight text-slate-800">Selamat Datang</h1>
                <p class="mt-1 text-sm text-slate-500">Masuk ke akun Zona Gadget Anda</p>
            </div>

            {{-- Error Message --}}
            @if($errors->any())
                <div class="mb-5 flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                    {{ session('error') }}
                </div>
            @endif

            {{-- Form --}}
            <form action="/login" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Username</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" name="username"
                               class="w-full rounded-xl border-2 border-slate-200 bg-white py-3 pl-11 pr-4 text-sm text-slate-800 outline-none transition-all placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"
                               placeholder="Masukkan username" value="{{ old('username') }}" required autofocus>
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">Password</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" name="password"
                               class="w-full rounded-xl border-2 border-slate-200 bg-white py-3 pl-11 pr-4 text-sm text-slate-800 outline-none transition-all placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"
                               placeholder="Masukkan password" required>
                    </div>
                </div>

                <button type="submit"
                        class="flex w-full items-center justify-center gap-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-500/30 transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-indigo-500/40 active:translate-y-0">
                    <i class="fas fa-sign-in-alt"></i>
                    Masuk
                </button>
            </form>

            <p class="mt-8 text-center text-xs text-slate-400">&copy; {{ date('Y') }} Zona Gadget. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
