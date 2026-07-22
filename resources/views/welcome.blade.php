{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="dark:class">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Be_Vietnam_Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <title>TOKO SITI - Sembako Digital POS</title>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#6B7E5F",
                        "on-primary": "#FFFFFF",
                        "primary-container": "#E1EAD1",
                        "on-primary-container": "#242E1B",
                        "secondary": "#B08D57",
                        "secondary-container": "#F4EBD0",
                        "on-secondary-container": "#3D2E14",
                        "tertiary": "#D98E73",
                        "tertiary-container": "#FAE3DB",
                        "surface": "#F8F9F2",
                        "surface-container-low": "#F1F3E9",
                        "surface-container": "#E9ECEA",
                        "surface-container-high": "#E1E5DE",
                        "surface-container-highest": "#DCE3C8",
                        "on-surface": "#2C3129",
                        "on-surface-variant": "#5C6157",
                        "outline": "#8B9284",
                        "outline-variant": "#C7CCBF",
                        "error": "#BA1A1A",
                        "error-container": "#FFDAD6"
                    },
                    borderRadius: {
                        DEFAULT: "1rem",
                        lg: "1.5rem",
                        xl: "2rem",
                        full: "9999px"
                    },
                    fontFamily: {
                        headline: ["Plus Jakarta Sans"],
                        display: ["Plus Jakarta Sans"],
                        body: ["Be Vietnam Pro"],
                        label: ["Plus Jakarta Sans"]
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body {
            font-family: 'Be_Vietnam_Pro', sans-serif;
            background-color: #F8F9F2;
        }
        h1, h2, h3, h4, .headline-font {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-surface text-on-surface selection:bg-primary-container selection:text-on-primary-container">
    <!-- TopNavBar (Laravel Compatible) -->
    <nav class="w-full top-0 sticky z-50 bg-surface/80 backdrop-blur-xl flex justify-between items-center px-10 py-5 shadow-sm border-b border-outline-variant/10 font-headline tracking-tight">
        <div class="flex items-center gap-8">
            <a href="{{ url('/') }}" class="text-2xl font-black text-primary hover:opacity-90 transition-opacity">TOKO SITI</a>
        </div>
        <div class="flex items-center gap-8">
            @auth
                <div class="flex items-center gap-4">
                    <span class="text-on-surface font-semibold">{{ Auth::user()->name }}</span>
                    <a href="{{ Auth::user()->role === 'kasir' ? url('/cashier') : url('/dashboard') }}" class="px-6 py-2 bg-primary text-on-primary rounded-full font-bold hover:bg-primary/90 transition-all shadow-md">
                        {{ Auth::user()->role === 'kasir' ? 'Cashier' : 'Dashboard' }}
                    </a>
                </div>
            @else
                <a href="{{ route('login') }}" class="px-6 py-2 bg-primary text-on-primary rounded-full font-bold hover:bg-primary/90 transition-all shadow-md hover:shadow-lg">Login Staff</a>
            @endauth
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12 md:py-24">
        <!-- Hero Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-24">
            <div class="space-y-8">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-primary-container text-on-primary-container rounded-full text-xs font-bold uppercase tracking-wider">
                    <span class="material-symbols-outlined text-sm">potted_plant</span>
                    <span>Sembako Digital Indonesia</span>
                </div>
                <h1 class="text-5xl md:text-7xl font-black text-on-surface tracking-tight leading-[1.05]">
                    Sistem Kasir <span class="text-primary italic">TOKO SITI</span>
                </h1>
                <p class="text-lg md:text-xl text-on-surface-variant leading-relaxed max-w-xl font-medium">
                    Sederhanakan transaksi harian dan manajemen stok Anda dengan sistem POS yang cerdas, cepat, dan elegan.
                </p>
                @guest
                    <div class="flex gap-4 pt-4">
                        <a href="{{ route('login') }}" class="px-10 py-4 bg-primary text-on-primary rounded-full font-black text-lg hover:bg-primary/90 transition-all shadow-xl hover:translate-y-[-2px]">Masuk ke Sistem</a>
                    </div>
                @else
                    <div class="flex gap-4 pt-4">
                        <a href="{{ url('/cashier') }}" class="px-10 py-4 bg-primary text-on-primary rounded-full font-black text-lg hover:bg-primary/90 transition-all shadow-xl hover:translate-y-[-2px]">Buka Kasir</a>
                    </div>
                @endguest
            </div>
            <div class="relative">
                <div class="relative z-10 rounded-[3rem] overflow-hidden shadow-2xl rotate-2 hover:rotate-0 transition-transform duration-700">
                    <img class="w-full aspect-[4/5] object-cover" alt="Fresh grocery display" src="{{asset('images/welcome.png')}}">
                </div>
            </div>
        </div>

        <!-- Benefits Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-10 rounded-[2.5rem] group hover:bg-primary-container/20 transition-all duration-300 border border-outline-variant/30">
                <div class="bg-primary-container w-16 h-16 rounded-3xl flex items-center justify-center mb-8 shadow-sm group-hover:scale-110 transition-transform text-primary">
                    <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">bolt</span>
                </div>
                <h3 class="text-2xl font-black text-on-surface mb-4">Transaksi Kilat</h3>
                <p class="text-on-surface-variant leading-relaxed font-medium">
                    Sistem kasir yang dirancang untuk kecepatan tinggi. Selesaikan antrian panjang dengan mudah dan efisien.
                </p>
            </div>
            <div class="bg-secondary-container/20 p-10 rounded-[2.5rem] group hover:bg-secondary-container/40 transition-all duration-300 border border-secondary/10">
                <div class="bg-secondary-container w-16 h-16 rounded-3xl flex items-center justify-center mb-8 shadow-sm group-hover:scale-110 transition-transform text-secondary">
                    <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">inventory_2</span>
                </div>
                <h3 class="text-2xl font-black text-on-secondary-container mb-4">Stok Cerdas</h3>
                <p class="text-on-secondary-container/80 leading-relaxed font-medium">
                    Manajemen inventaris otomatis dengan peringatan stok menipis. Jangan pernah kehabisan barang lagi.
                </p>
            </div>
            <div class="bg-white p-10 rounded-[2.5rem] group hover:bg-primary-container/20 transition-all duration-300 border border-outline-variant/30">
                <div class="bg-primary-container w-16 h-16 rounded-3xl flex items-center justify-center mb-8 shadow-sm group-hover:scale-110 transition-transform text-primary">
                    <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">query_stats</span>
                </div>
                <h3 class="text-2xl font-black text-on-surface mb-4">Laporan Akurat</h3>
                <p class="text-on-surface-variant leading-relaxed font-medium">
                    Visualisasikan performa bisnis Anda secara real-time. Data yang murni, disajikan dengan elegan.
                </p>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-outline-variant/20 mt-24 py-20">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="md:col-span-1 space-y-8">
                <a href="{{ url('/') }}" class="text-2xl font-black text-primary hover:opacity-90 transition-opacity inline-block">TOKO SITI</a>
                <p class="text-on-surface-variant text-sm font-medium leading-relaxed">
                    Sistem Digital Sembako untuk pedagang visioner yang menghargai kesederhanaan, keanggunan, dan pertumbuhan organik.
                </p>
            </div>
            <div class="space-y-6">
                <h4 class="font-black text-on-surface uppercase text-xs tracking-widest">Produk</h4>
                <ul class="space-y-3 text-sm text-on-surface-variant font-bold">
                    <li><a href="#" class="hover:text-primary transition-colors">Point of Sale</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Inventory</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Laporan Keuangan</a></li>
                </ul>
            </div>
            <div class="space-y-6">
                <h4 class="font-black text-on-surface uppercase text-xs tracking-widest">Bantuan</h4>
                <ul class="space-y-3 text-sm text-on-surface-variant font-bold">
                    <li><a href="#" class="hover:text-primary transition-colors">Pusat Bantuan</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Dokumentasi</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Kontak Kami</a></li>
                </ul>
            </div>
            <div class="space-y-6">
                <h4 class="font-black text-on-surface uppercase text-xs tracking-widest">Komunitas</h4>
                <div class="flex gap-4">
                    <a href="#" class="w-12 h-12 rounded-2xl bg-surface-container flex items-center justify-center hover:bg-primary-container transition-all text-primary">
                        <span class="material-symbols-outlined">language</span>
                    </a>
                    <a href="#" class="w-12 h-12 rounded-2xl bg-surface-container flex items-center justify-center hover:bg-primary-container transition-all text-primary">
                        <span class="material-symbols-outlined">share</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 mt-20 pt-8 border-t border-outline-variant/10 text-center text-xs font-bold text-on-surface-variant/60">
            © {{ date('Y') }} TOKO SITI. Digital Ecosystem Systems. All rights reserved.
        </div>
    </footer>
</body>
</html>