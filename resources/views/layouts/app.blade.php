<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>TOKO SITI - @yield('title', 'Inventory')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#6B8E61",
                        "primary-container": "#DCE6D9",
                        "on-primary-container": "#2D3E28",
                        "secondary": "#E8C872",
                        "secondary-container": "#F9F3D9",
                        "on-secondary-container": "#5D4D1D",
                        "surface": "#FCFBF4",
                        "surface-container": "#F5F2E1",
                        "surface-container-high": "#EBE8CF",
                        "surface-container-low": "#F9F7E8",
                        "surface-container-lowest": "#FFFFFF",
                        "on-surface": "#2C2C24",
                        "on-surface-variant": "#5E5E52",
                        "outline": "#B0B0A0",
                        "outline-variant": "#E0E0D0",
                        "error": "#BA7066",
                        "error-container": "#F4E2DF",
                    },
                    borderRadius: {
                        DEFAULT: "1rem", lg: "2rem", xl: "3rem", full: "9999px"
                    },
                    fontFamily: {
                        headline: ["Plus Jakarta Sans"],
                        body: ["Be Vietnam Pro"],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Be Vietnam Pro', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .active-pill-shadow { box-shadow: 0 10px 30px rgba(107,142,97,0.1); }
    </style>
</head>
<body class="bg-surface text-on-surface">

{{-- Sidebar --}}
<aside class="h-screen w-64 fixed left-0 top-0 bg-surface-container/50 flex flex-col p-6 gap-8 z-50">
    <div class="flex flex-col gap-1">
        <h1 class="text-2xl font-black text-primary tracking-tighter font-headline">TOKO SITI</h1>
        <p class="text-xs font-headline font-bold text-primary/60 uppercase tracking-widest">Vibrant Merchant</p>
    </div>
    <nav class="flex flex-col gap-2 flex-grow">
        @if(Auth::user()->role === 'kasir')
        <a href="{{ route('cashier') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('cashier') ? 'bg-white text-primary active-pill-shadow' : 'text-on-surface-variant hover:bg-surface-container' }} transition-all rounded-full">
            <span class="material-symbols-outlined">point_of_sale</span>
            <span class="font-headline font-bold text-lg">Cashier</span>
        </a>
        <a href="{{ route('inventory') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('inventory') ? 'bg-white text-primary active-pill-shadow' : 'text-on-surface-variant hover:bg-surface-container' }} transition-all rounded-full">
            <span class="material-symbols-outlined">inventory_2</span>
            <span class="font-headline font-bold text-lg">Inventory</span>
        </a>
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('profile.edit') ? 'bg-white text-primary active-pill-shadow' : 'text-on-surface-variant hover:bg-surface-container' }} transition-all rounded-full">
            <span class="material-symbols-outlined">person</span>
            <span class="font-headline font-bold text-lg">Profile</span>
        </a>
        @elseif(Auth::user()->role === 'admin')
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-white text-primary active-pill-shadow' : 'text-on-surface-variant hover:bg-surface-container' }} transition-all rounded-full">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="font-headline font-bold text-lg">Dashboard</span>
        </a>
        <a href="{{ route('inventory') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('inventory') ? 'bg-white text-primary active-pill-shadow' : 'text-on-surface-variant hover:bg-surface-container' }} transition-all rounded-full">
            <span class="material-symbols-outlined">inventory_2</span>
            <span class="font-headline font-bold text-lg">Inventory</span>
        </a>
        @endif
    </nav>
    <div class="flex flex-col gap-2 pt-6 border-t border-outline-variant/50">
        <a href="#" class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-surface-container rounded-full">
            <span class="material-symbols-outlined">settings</span>
            <span class="font-headline font-bold text-lg">Settings</span>
        </a>
        <a href="#" class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-surface-container rounded-full">
            <span class="material-symbols-outlined">logout</span>
            <span class="font-headline font-bold text-lg">Logout</span>
        </a>
    </div>
</aside>

{{-- Main --}}
<main class="ml-64 min-h-screen">
    {{-- Topbar --}}
    <header class="flex justify-between items-center h-20 px-8 sticky top-0 bg-surface/80 backdrop-blur-xl z-40">
        <div class="w-1/3">
            @yield('topbar-search')
        </div>
        <div class="flex items-center gap-6">
            <button class="relative p-2 text-on-surface-variant hover:bg-surface-container rounded-full">
                <span class="material-symbols-outlined">notifications</span>
                <span class="absolute top-2 right-2 w-2 h-2 bg-primary rounded-full border-2 border-surface"></span>
            </button>
            <div class="flex items-center gap-3 bg-surface-container-lowest py-1.5 pl-1.5 pr-4 rounded-full shadow-sm">
                <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary">person</span>
                </div>
                <span class="font-headline font-bold text-on-surface">Siti Aminah</span>
            </div>
        </div>
    </header>

    <div class="p-10 max-w-7xl mx-auto">
        {{-- Flash Message --}}
        @if(session('success'))
        <div class="mb-6 px-6 py-4 bg-primary-container text-on-primary-container rounded-xl font-bold flex items-center gap-3">
            <span class="material-symbols-outlined">check_circle</span>
            {{ session('success') }}
        </div>
        @endif

        @yield('content')
    </div>
</main>

@yield('scripts')
</body>
</html>