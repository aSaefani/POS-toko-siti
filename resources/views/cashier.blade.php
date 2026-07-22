<!DOCTYPE html>
<html class="light" lang="en">
<script>
    if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
    if (localStorage.getItem('sidebar-collapsed') === 'true') {
        document.documentElement.classList.add('sidebar-collapsed');
    }
</script>
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>TOKO SITI - Cashier</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Be_Vietnam_Pro:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        body {
            font-family: 'Be_Vietnam_Pro', sans-serif;
            background-color: #F8F9F2;
        }
        h1, h2, h3, .headline-font {
            font-family: 'Plus_Jakarta_Sans', sans-serif;
        }
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #F8F9F2;
        }
        ::-webkit-scrollbar-thumb {
            background: #DCE3C8;
            border-radius: 10px;
        }
        .dark ::-webkit-scrollbar-track {
            background: #0E110A;
        }
        .dark ::-webkit-scrollbar-thumb {
            background: #3F4438;
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #C7CCBF;
            border-radius: 10px;
        }
        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        .modal-animate {
            animation: fadeInScale 0.2s ease-out forwards;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.3s ease-out forwards;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-spin {
            animation: spin 1s linear infinite;
        }
        @media (min-width: 1024px) {
            .sidebar-collapsed #sidebar {
                width: 5rem !important;
                padding-left: 0.75rem !important;
                padding-right: 0.75rem !important;
            }
            .sidebar-collapsed #sidebar .sidebar-text,
            .sidebar-collapsed #sidebar .sidebar-logo-text {
                display: none !important;
            }
            .sidebar-collapsed #sidebar .sidebar-header {
                justify-content: center !important;
            }
            .sidebar-collapsed #sidebar nav a,
            .sidebar-collapsed #sidebar #logoutBtn {
                justify-content: center !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
                width: 3rem !important;
                height: 3rem !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }
            .sidebar-collapsed #sidebar nav a span.material-symbols-outlined,
            .sidebar-collapsed #sidebar #logoutBtn span.material-symbols-outlined {
                margin: 0 !important;
                font-size: 1.5rem !important;
            }
            .sidebar-collapsed main {
                margin-left: 5rem !important;
            }
        }
    </style>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    screens: {
                        "3xl": "1800px",
                    },
                    "colors": {
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
                        "dark-bg": "#0E110A",
                        "dark-surface": "#1A1D16",
                        "dark-surface-high": "#23271E",
                        "dark-outline": "#3F4438"
                    },
                    "borderRadius": {
                        "DEFAULT": "1rem",
                        "lg": "1.5rem",
                        "xl": "2rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Plus Jakarta Sans"],
                        "body": ["Be Vietnam Pro"],
                        "label": ["Plus Jakarta Sans"]
                    }
                },
            },
        }
    </script>
</head>
<body class="bg-surface text-on-surface dark:bg-dark-bg dark:text-surface-container transition-colors duration-300">

<!-- Sidebar Overlay for Mobile -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-[90] hidden lg:hidden transition-opacity duration-300 opacity-0"></div>

<!-- SideNavBar -->
<aside id="sidebar" class="bg-white h-screen w-64 fixed left-0 top-0 flex flex-col p-6 gap-8 z-[100] border-r border-outline-variant/30 shadow-sm transition-all duration-300 dark:bg-dark-surface dark:border-dark-outline/30 -translate-x-full lg:translate-x-0 overflow-y-auto custom-scrollbar">
    <div class="flex items-center gap-3 sidebar-header">
        <div class="w-12 h-12 bg-primary rounded-2xl flex items-center justify-center text-on-primary shadow-sm shrink-0">
            <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">storefront</span>
        </div>
        <div class="sidebar-logo-text">
            <h1 class="text-2xl font-black text-primary tracking-tighter leading-tight">TOKO SITI</h1>
            <p class="text-[10px] font-bold text-primary/60 uppercase tracking-widest">Toko Sembako</p>
        </div>
    </div>
    
    <nav class="flex flex-col gap-2 mt-4">
        @if(Auth::user()->role === 'admin')
        <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-primary-container/40 transition-all duration-200 rounded-full">
            <span class="material-symbols-outlined">leaderboard</span>
            <span class="font-bold text-md sidebar-text">Dashboard</span>
        </a>
        <a href="{{ url('/inventory') }}" class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-primary-container/40 transition-all duration-200 rounded-full">
            <span class="material-symbols-outlined">inventory_2</span>
            <span class="font-bold text-md sidebar-text">Inventory</span>
        </a>
        @elseif(Auth::user()->role === 'kasir')
        <a href="{{ url('/cashier') }}" class="flex items-center gap-3 px-4 py-3 bg-primary text-on-primary rounded-full shadow-sm">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">point_of_sale</span>
            <span class="font-bold text-md sidebar-text">Cashier</span>
        </a>
        <a href="{{ url('/inventory') }}" class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-primary-container/40 transition-all duration-200 rounded-full">
            <span class="material-symbols-outlined">inventory_2</span>
            <span class="font-bold text-md sidebar-text">Inventory</span>
        </a>
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-primary-container/40 transition-all duration-200 rounded-full">
            <span class="material-symbols-outlined">account_circle</span>
            <span class="font-bold text-md sidebar-text">Profile</span>
        </a>
        @endif
    </nav>
    
    <div class="mt-auto flex flex-col gap-2">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="#" id="logoutBtn" class="flex items-center gap-3 px-4 py-2 text-error hover:bg-error/5 transition-all duration-200 rounded-full">
            <span class="material-symbols-outlined">logout</span>
            <span class="font-medium sidebar-text">Logout</span>
        </a>
    </div>
</aside>

<!-- Main Content -->
<main class="lg:ml-64 min-h-screen lg:h-screen flex flex-col lg:overflow-hidden transition-all duration-300">
    <header class="bg-surface/80 backdrop-blur-xl flex justify-between items-center h-16 px-4 lg:px-8 sticky top-0 z-40 dark:bg-dark-bg/80 dark:border-b dark:border-dark-outline/20">
        <div class="flex items-center gap-4 flex-1">
            <!-- Hamburger Menu -->
            <button id="sidebarToggle" class="lg:hidden w-10 h-10 flex items-center justify-center rounded-full bg-white border border-outline-variant/20 text-on-surface-variant hover:bg-primary-container/20 transition-all dark:bg-dark-surface dark:border-dark-outline">
                <span class="material-symbols-outlined">menu</span>
            </button>
            
            <!-- Desktop Sidebar Collapse Toggle -->
            <button id="desktopSidebarToggle" class="hidden lg:flex w-10 h-10 items-center justify-center rounded-full bg-white border border-outline-variant/20 text-on-surface-variant hover:bg-primary-container/20 transition-all dark:bg-dark-surface dark:border-dark-outline shadow-sm">
                <span class="material-symbols-outlined" id="desktopSidebarToggleIcon">menu_open</span>
            </button>
            
            <div class="relative w-full max-w-md hidden sm:block">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">search</span>
                <input type="text" id="searchInput" class="w-full bg-white border border-outline-variant/30 rounded-full py-3 pl-12 pr-6 focus:ring-2 focus:ring-primary/20 focus:outline-none text-on-surface placeholder:text-outline/60 dark:bg-dark-surface-high dark:border-dark-outline dark:text-surface-container" placeholder="Cari produk...">
            </div>
        </div>
        <div class="hidden md:flex items-center gap-3 bg-white/50 backdrop-blur-md py-2 px-4 rounded-full border border-outline-variant/20 shadow-sm mr-6 dark:bg-dark-surface/50 dark:border-dark-outline/30">
            <span class="material-symbols-outlined text-primary text-xl">schedule</span>
            <div class="flex flex-col">
                <span id="realTimeClock" class="font-black text-on-surface text-sm tabular-nums dark:text-white">00:00:00</span>
                <span id="realDateClock" class="text-[10px] font-bold text-on-surface-variant/70 uppercase tracking-wider dark:text-surface-container/70">-</span>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <!-- Dark Mode Toggle -->
            <button id="darkModeToggle" class="relative z-[60] w-10 h-10 flex items-center justify-center rounded-full bg-white border border-outline-variant/20 text-on-surface-variant hover:bg-primary-container/20 transition-all shadow-sm dark:bg-dark-surface dark:border-dark-outline dark:text-primary">
                <span class="material-symbols-outlined" id="darkModeIcon">light_mode</span>
            </button>

            <div class="h-8 w-[1px] bg-outline-variant mx-2 dark:bg-dark-outline"></div>
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 bg-white py-1.5 pl-1.5 pr-4 rounded-full border border-outline-variant/20 shadow-sm hover:bg-primary-container/20 transition-all dark:bg-dark-surface dark:border-dark-outline">
                <img alt="Staff Avatar" class="w-9 h-9 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=6B7E5F&background=E1EAD1">
                <span class="font-semibold text-sm dark:text-surface-container">
                    {{ Auth::user()->name }}
                </span>
            </a>
        </div>
    </header>
    
    <div class="flex-1 flex flex-col lg:flex-row p-4 lg:p-6 gap-4 lg:gap-6 lg:overflow-hidden bg-surface dark:bg-dark-bg">
        <!-- Product Grid Area -->
        <section class="flex-1 flex flex-col lg:overflow-hidden">
            <div class="flex flex-col gap-4 mb-6">
                <div>
                    <h2 class="text-2xl lg:text-3xl font-extrabold text-on-surface tracking-tight mb-1 lg:mb-2 headline-font dark:text-white">Cashier</h2>
                    <p class="text-xs lg:text-sm text-on-surface-variant font-medium dark:text-surface-container/80">Pilih produk yang ingin ditambahkan ke keranjang.</p>
                </div>
                <div id="categoryFilters" class="flex gap-2 overflow-x-auto custom-scrollbar pb-2 flex-nowrap w-full">
                    <!-- Category buttons will be dynamically rendered from database -->
                </div>
            </div>
            
            <div id="productGrid" class="lg:flex-1 lg:overflow-y-auto pr-2 lg:pr-4 custom-scrollbar grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 3xl:grid-cols-5 gap-3 lg:gap-4 pb-6">
                <div class="col-span-full text-center py-12 text-on-surface-variant">Memuat produk...</div>
            </div>
        </section>
        
        <!-- Cart Sidebar -->
        <aside id="cartSidebar" class="fixed inset-y-0 right-0 w-full sm:w-96 lg:w-96 bg-surface lg:bg-transparent z-[80] transform translate-x-full lg:translate-x-0 transition-transform duration-300 lg:static lg:flex lg:flex-col lg:gap-6 p-4 lg:p-0 dark:bg-dark-bg lg:dark:bg-transparent">
            <div class="flex lg:hidden justify-between items-center mb-4">
                <h3 class="text-xl font-black">Detail Keranjang</h3>
                <button onclick="toggleCart()" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-outline-variant/20 dark:bg-dark-surface dark:border-dark-outline">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="flex-1 flex flex-col bg-white rounded-2xl p-4 lg:p-6 border border-outline-variant/30 shadow-sm overflow-hidden dark:bg-dark-surface dark:border-dark-outline/30 min-h-[300px]">
                <div class="flex items-center justify-between mb-4 lg:mb-6">
                    <h3 class="text-lg lg:text-xl font-extrabold text-on-surface tracking-tight uppercase headline-font dark:text-white">Keranjang</h3>
                    <span id="cartCount" class="px-3 py-1 bg-primary-container text-primary text-[10px] font-black rounded-full dark:bg-primary/20">0 ITEMS</span>
                </div>
                
                <div id="cartItems" class="flex-1 overflow-y-auto flex flex-col gap-4 pr-2 custom-scrollbar">
                    <div class="text-center text-on-surface-variant py-8">Keranjang masih kosong</div>
                </div>
                
                <div class="mt-6 pt-6 border-t border-outline-variant/30 flex flex-col gap-3 dark:border-dark-outline/20">
                    <div class="flex justify-between text-sm font-medium text-on-surface-variant dark:text-surface-container/60">
                        <span>Subtotal</span>
                        <span id="subtotal" class="dark:text-surface-container">Rp 0</span>
                    </div>
                    <div class="flex justify-between items-center mt-2">
                        <span class="text-lg font-black text-on-surface tracking-tight uppercase headline-font dark:text-white">Total</span>
                        <span id="total" class="text-2xl font-black text-primary">Rp 0</span>
                    </div>
                </div>
            </div>
            
            <div class="bg-surface-container-high rounded-2xl p-3 lg:p-4 flex flex-col gap-3 lg:gap-4 shadow-sm dark:bg-dark-surface-high">
                <div class="flex items-center justify-between mb-1">
                    <span class="text-xs font-bold text-on-surface-variant dark:text-surface-container/60 uppercase tracking-wider">Metode Pembayaran</span>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <button id="payCashBtn" class="w-full py-3 lg:py-4 bg-primary text-on-primary rounded-xl font-black text-sm lg:text-base shadow-lg shadow-primary/20 active:scale-[0.98] transition-all flex flex-col items-center justify-center gap-1">
                        <span class="material-symbols-outlined font-bold text-xl">payments</span>
                        TUNAI
                    </button>
                    <button id="payQrisBtn" class="w-full py-3 lg:py-4 bg-[#00569c] text-white rounded-xl font-black text-sm lg:text-base shadow-lg shadow-[#00569c]/20 active:scale-[0.98] transition-all flex flex-col items-center justify-center gap-1">
                        <span class="material-symbols-outlined font-bold text-xl">qr_code_scanner</span>
                        QRIS
                    </button>
                </div>
            </div>
        </aside>
    </div>

    <!-- Floating Cart Button for Mobile -->
    <button onclick="toggleCart()" class="lg:hidden fixed bottom-6 right-6 w-16 h-16 bg-primary text-on-primary rounded-full shadow-2xl flex items-center justify-center z-[70] active:scale-90 transition-all">
        <div class="relative">
            <span class="material-symbols-outlined text-3xl">shopping_cart</span>
            <span id="mobileCartBadge" class="absolute -top-2 -right-2 bg-error text-white text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center border-2 border-primary hidden">0</span>
        </div>
    </button>
</main>

<!-- Modal Payment CASH (input uang) -->
<div id="cashModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 backdrop-blur-sm opacity-0 invisible transition-all duration-200">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-2xl transform scale-95 transition-all dark:bg-dark-surface dark:border dark:border-dark-outline/30">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-black text-on-surface tracking-tight headline-font dark:text-white">Payment - Cash</h2>
            <button id="closeCashModalBtn" class="material-symbols-outlined text-on-surface-variant/50 hover:text-error transition-colors dark:text-surface-container/40">close</button>
        </div>
        <div class="flex flex-col gap-6">
            <div class="p-6 bg-primary/10 rounded-2xl border border-primary/20">
                <p class="text-xs font-black text-primary uppercase tracking-widest mb-1">Total yang Harus Dibayar</p>
                <p id="cashModalTotal" class="text-5xl font-black text-primary tracking-tighter">Rp 0</p>
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-sm font-bold text-on-surface-variant ml-2 dark:text-surface-container/60">Cash Received</label>
                <div class="relative">
                    <span class="absolute left-6 top-1/2 -translate-y-1/2 font-black text-on-surface-variant/30">Rp</span>
                    <input id="cashReceived" type="number" class="w-full pl-16 pr-6 py-4 bg-surface-container-low rounded-xl border-2 border-primary/20 text-2xl font-black text-on-surface focus:border-primary focus:ring-0 transition-colors dark:bg-dark-surface-high dark:border-primary/40 dark:text-white" value="0">
                </div>
            </div>
            <div class="flex gap-2">
                <button class="quick-cash w-1/3 py-2 bg-secondary-container text-on-secondary-container rounded-full text-xs font-bold" data-amount="50000">Rp 50k</button>
                <button class="quick-cash w-1/3 py-2 bg-secondary-container text-on-secondary-container rounded-full text-xs font-bold" data-amount="100000">Rp 100k</button>
                <button id="exactCash" class="w-1/3 py-2 bg-secondary-container text-on-secondary-container rounded-full text-xs font-bold">Exact</button>
            </div>
            <div class="p-6 bg-surface-container-low rounded-xl flex justify-between items-center border border-outline-variant/20 dark:bg-dark-surface-high">
                <div>
                    <p class="text-xs font-black text-on-surface-variant/60 uppercase tracking-widest mb-1 dark:text-surface-container/40">Kembalian</p>
                    <p id="changeAmount" class="text-4xl font-black text-on-surface tracking-tighter dark:text-white">Rp 0</p>
                </div>
                <span class="material-symbols-outlined text-5xl text-primary">account_balance_wallet</span>
            </div>
            <button id="processCashBtn" class="w-full py-5 bg-primary text-on-primary rounded-xl font-black text-lg active:scale-95 transition-transform shadow-md">
                PROSES PEMBAYARAN
            </button>
        </div>
    </div>
</div>

<!-- Modal QRIS dengan QR CODE STATIS MILIK ANDA -->
<div id="qrisModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 backdrop-blur-sm opacity-0 invisible transition-all duration-200">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-2xl transform scale-95 transition-all text-center dark:bg-dark-surface dark:border dark:border-dark-outline/30">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-black text-primary tracking-tight headline-font dark:text-primary-container">QRIS Payment</h2>
            <button id="closeQrisModalBtn" class="material-symbols-outlined text-on-surface-variant/50 hover:text-error transition-colors dark:text-surface-container/40">close</button>
        </div>
        
        <div class="flex flex-col gap-6">
            <div class="p-4 bg-primary-container/30 rounded-xl dark:bg-primary/10">
                <p class="text-sm font-bold text-primary/70 mb-1 dark:text-primary-container/60">Total Pembayaran</p>
                <p id="qrisModalTotal" class="text-4xl font-black text-primary">Rp 0</p>
            </div>
            
            <div class="bg-white p-4 rounded-xl border-2 border-primary/20">
                <!-- ================================================== -->
                <!-- QR CODE STATIS MILIK ANDA - GANTI DENGAN QR ASLI -->
                <!-- ================================================== -->
                <img id="qrcodeImage" class="w-64 h-64 mx-auto" src="{{ asset('images/src.png') }}" alt="QRIS Toko Siti">
                <p class="text-xs text-primary/80 mt-3">Scan QR Code di atas menggunakan aplikasi pembayaran (GoPay, OVO, DANA, dll)</p>
                <p class="text-xs font-bold text-primary mt-2">a.n. TOKO SITI</p>
            </div>
            
            <!-- Informasi nominal yang harus ditransfer -->
            <div class="p-4 bg-primary-container/30 rounded-xl dark:bg-primary/10">
                <div class="flex items-center justify-center gap-2 mb-2">
                    <span class="material-symbols-outlined text-primary">payments</span>
                    <span class="text-sm font-bold text-primary/70 dark:text-primary-container/60">Nominal yang harus ditransfer:</span>
                </div>
                <p id="qrisNominal" class="text-2xl font-black text-primary">Rp 0</p>
            </div>
            
            <div class="p-4 bg-primary-container/30 rounded-xl dark:bg-primary/10">
                <div class="flex items-center justify-center gap-2 mb-2">
                    <span class="material-symbols-outlined text-primary">schedule</span>
                    <span class="text-sm font-bold text-primary/70 dark:text-primary-container/60">Waktu tersisa:</span>
                    <span id="countdownTimer" class="text-lg font-black text-primary">05:00</span>
                </div>
                <p class="text-xs text-primary/60">Setelah scan QR Code dan melakukan pembayaran, tekan tombol "Sudah Dibayar" untuk konfirmasi</p>
            </div>
            
            <div class="flex gap-3">
                <button id="cancelQrisBtn" class="flex-1 py-3 bg-surface-container-high text-on-surface-variant rounded-xl font-bold hover:bg-surface-container transition-all">
                    Batal
                </button>
                <button id="confirmQrisPaidBtn" class="flex-1 py-3 bg-primary text-on-primary rounded-xl font-bold hover:bg-primary/90 transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">check_circle</span>
                    Sudah Dibayar
                </button>
            </div>
        </div>
    </div>
</div>



<!-- Toast Notification -->
<div id="toast" class="fixed bottom-8 right-8 z-[250] hidden">
    <div class="bg-primary text-white px-6 py-3 rounded-full font-bold shadow-lg flex items-center gap-2 animate-fade-in-up">
        <span class="material-symbols-outlined" id="toastIcon">check_circle</span>
        <span id="toastMessage"></span>
    </div>
</div>

<!-- Receipt Modal -->
<div id="receiptModal" class="fixed inset-0 z-[200] flex items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 invisible transition-all duration-200">
    <div class="w-full max-w-sm bg-white rounded-2xl shadow-2xl transform scale-95 transition-all overflow-hidden">
        <div class="p-8" id="receiptContent">
            <!-- Receipt Header -->
            <div class="text-center mb-6">
                <h2 class="text-2xl font-black text-on-surface headline-font tracking-tighter">TOKO SITI</h2>
                <p class="text-[10px] font-bold text-on-surface-variant uppercase tracking-widest">Toko Sembako & Kebutuhan Rumah</p>
                <div class="h-[1px] w-full bg-outline-variant/30 my-4"></div>
                <p id="receiptDate" class="text-[10px] text-on-surface-variant font-medium"></p>
                <p id="receiptCode" class="text-[10px] text-on-surface-variant font-bold"></p>
            </div>

            <!-- Receipt Items -->
            <div id="receiptItems" class="space-y-2 mb-6">
                <!-- Items will be injected here -->
            </div>

            <div class="h-[1px] w-full border-t border-dashed border-outline-variant/50 my-4"></div>

            <!-- Totals -->
            <div class="space-y-1 mb-6">
                <div class="flex justify-between text-xs font-medium text-on-surface-variant">
                    <span>Subtotal</span>
                    <span id="receiptSubtotal"></span>
                </div>
                <div class="flex justify-between text-lg font-black text-on-surface headline-font">
                    <span>TOTAL</span>
                    <span id="receiptTotal" class="text-on-surface"></span>
                </div>
                <div class="flex justify-between text-xs font-medium text-on-surface-variant pt-2">
                    <span>Tunai</span>
                    <span id="receiptPaid"></span>
                </div>
                <div class="flex justify-between text-xs font-bold text-on-surface">
                    <span>Kembalian</span>
                    <span id="receiptChange"></span>
                </div>
            </div>

            <div class="text-center">
                <p class="text-[10px] font-bold text-on-surface-variant uppercase mb-1">Terima Kasih</p>
                <p class="text-[8px] text-on-surface-variant/60 font-medium">Barang yang sudah dibeli tidak dapat ditukar atau dikembalikan.</p>
            </div>
        </div>

        <div class="p-4 bg-surface-container-low flex gap-3">
            <button id="closeReceiptBtn" class="flex-1 py-3 bg-white text-on-surface-variant rounded-xl font-bold hover:bg-surface-container transition-all border border-outline-variant/30">Tutup</button>
            <button id="printReceiptBtn" class="flex-1 py-3 bg-primary text-on-primary rounded-xl font-bold hover:brightness-110 transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-sm">print</span>
                Cetak Struk
            </button>
        </div>
    </div>
</div>

<style>
    @media print {
        /* Reset and hide everything else */
        body {
            background: white !important;
            margin: 0 !important;
            padding: 0 !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        
        aside, main, header, #toast, .no-print, button {
            display: none !important;
        }
        
        #receiptModal {
            position: static !important;
            display: block !important;
            opacity: 1 !important;
            visibility: visible !important;
            background: none !important;
            backdrop-filter: none !important;
            box-shadow: none !important;
        }

        #receiptModal > div {
            box-shadow: none !important;
            border: none !important;
            width: 100% !important;
            max-width: 80mm !important;
            margin: 0 auto !important;
        }

        #receiptContent {
            padding: 5mm !important;
            width: 80mm !important;
            margin: 0 !important;
            font-family: 'Courier New', Courier, monospace !important; /* Classic receipt look or keep Jakarta Sans */
        }

        #receiptContent h2 {
            color: black !important;
            font-size: 18pt !important;
        }

        #receiptContent p, #receiptContent span {
            color: black !important;
            font-size: 9pt !important;
        }

        .border-dashed {
            border-top: 1px dashed black !important;
        }
    }
</style>

<script>
    (function() {
        // Data dari database
        const productsFromDB = @json($products ?? []);
        const categoriesFromDB = @json($categories ?? []);
        
        function getImageUrl(imagePath) {
            if (!imagePath) return 'https://placehold.co/400x400?text=Product';
            if (imagePath.startsWith('http')) return imagePath;
            if (imagePath.startsWith('/storage/')) return imagePath;
            return '/storage/' + imagePath;
        }
        
        let products = productsFromDB.map(p => ({
            id: p.id,
            name: p.name,
            price: parseInt(p.price),
            stock: p.stock,
            category: p.category,
            image_url: p.image_url
        }));
        
        let cart = [];
        let currentCategory = "all";
        let selectedPaymentMethod = "cash";
        let countdownInterval = null;

        function updateClock() {
            const timeElem = document.getElementById('realTimeClock');
            const dateElem = document.getElementById('realDateClock');
            if (!timeElem || !dateElem) return;

            const now = new Date();
            timeElem.innerText = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false });
            dateElem.innerText = now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'short', year: 'numeric' });
        }
        setInterval(updateClock, 1000);
        updateClock();
        
        function formatPrice(price) {
            return "Rp " + parseInt(price).toLocaleString('id-ID');
        }
        
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            const bgColor = type === 'success' || type === false ? 'bg-primary' : 'bg-error';
            const icon = type === 'success' || type === false ? 'check_circle' : 'error';
            toast.className = `fixed bottom-8 right-8 ${bgColor} text-white px-6 py-3 rounded-full font-bold shadow-lg z-[200] flex items-center gap-2 transition-all duration-300`;
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(20px)';
            toast.innerHTML = `<span class="material-symbols-outlined">${icon}</span> ${message}`;
            document.body.appendChild(toast);
            
            // Trigger reflow
            toast.offsetHeight;
            
            toast.style.opacity = '1';
            toast.style.transform = 'translateY(0)';
            
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(20px)';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
        
        function renderCategoryButtons() {
            const container = document.getElementById('categoryFilters');
            if (!container) return;
            
            let categories = ['all', ...categoriesFromDB];
            let categoryLabels = { all: 'Semua' };
            categoriesFromDB.forEach(cat => { categoryLabels[cat] = cat; });
            
            container.innerHTML = categories.map(cat => {
                const isActive = cat === currentCategory;
                const activeClasses = 'bg-primary-container text-on-primary-container dark:bg-primary dark:text-white shadow-sm';
                const inactiveClasses = 'bg-white text-on-surface-variant border-outline-variant/30 dark:bg-dark-surface dark:text-surface-container/60 dark:border-dark-outline';
                
                return `
                    <button class="category-btn px-5 py-2.5 ${isActive ? activeClasses : inactiveClasses} rounded-full text-xs font-bold active:scale-95 transition-all border whitespace-nowrap" data-category="${cat}">
                        ${categoryLabels[cat] || cat}
                    </button>
                `;
            }).join('');
            
            document.querySelectorAll('.category-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    currentCategory = this.dataset.category;
                    renderCategoryButtons();
                    renderProducts();
                });
            });
        }
        
        function renderProducts() {
            const grid = document.getElementById('productGrid');
            if(!grid) return;
            
            let filtered = products;
            if (currentCategory !== "all") {
                filtered = products.filter(p => p.category === currentCategory);
            }
            
            const searchQuery = document.getElementById('searchInput')?.value.toLowerCase() || '';
            if (searchQuery) {
                filtered = filtered.filter(p => p.name.toLowerCase().includes(searchQuery));
            }
            
            if (filtered.length === 0) {
                grid.innerHTML = '<div class="col-span-full text-center py-12 text-on-surface-variant">Tidak ada produk ditemukan</div>';
                return;
            }
            
            grid.innerHTML = filtered.map(p => `
                <div class="product-card h-full bg-white p-3.5 rounded-2xl group hover:shadow-xl hover:shadow-primary/5 transition-all duration-300 relative cursor-pointer border border-outline-variant/30 dark:bg-dark-bg dark:border-dark-outline/30 flex flex-col" data-product='${JSON.stringify(p)}'>
                    <div class="aspect-square rounded-xl overflow-hidden mb-3 lg:mb-4 relative flex-shrink-0">
                        <img alt="${escapeHtml(p.name)}" class="w-full h-full object-cover" src="${getImageUrl(p.image_url)}" onerror="this.src='https://placehold.co/400x400?text=Product'">
                        <div class="absolute top-3 right-3 px-3 py-1 ${p.stock <= 5 ? 'bg-error/90' : 'bg-primary/90'} backdrop-blur-sm text-on-primary text-[10px] font-black rounded-full uppercase tracking-widest shadow-sm">
                            ${p.stock <= 5 ? (p.stock <= 2 ? 'Critical' : 'Low Stock') : 'In Stock'}
                        </div>
                    </div>
                    <h3 class="font-bold text-sm lg:text-base text-on-surface dark:text-white line-clamp-2 mb-2 flex-1">${escapeHtml(p.name)}</h3>
                    <div class="flex items-center justify-between mt-auto pt-2 border-t border-outline-variant/10 dark:border-dark-outline/10">
                        <span class="text-primary font-black text-sm lg:text-base">${formatPrice(p.price)}</span>
                        <div class="flex flex-col items-end">
                            ${p.stock <= 5 ? `
                                <span class="bg-error/10 text-error text-[8px] font-black px-1.5 py-0.5 rounded uppercase tracking-tighter mb-1">Low Stock</span>
                            ` : ''}
                            <span class="text-on-surface-variant/40 text-[10px] font-bold dark:text-surface-container/40">${p.stock} unit</span>
                        </div>
                    </div>
                </div>
            `).join('');
        }
        
        function renderCart() {
            const cartContainer = document.getElementById('cartItems');
            const cartCountSpan = document.getElementById('cartCount');
            const subtotalSpan = document.getElementById('subtotal');
            const totalSpan = document.getElementById('total');
            const mobileBadge = document.getElementById('mobileCartBadge');
            
            if(!cartContainer) return;
            
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            
            if (mobileBadge) {
                mobileBadge.innerText = totalItems;
                if (totalItems > 0) {
                    mobileBadge.classList.remove('hidden');
                } else {
                    mobileBadge.classList.add('hidden');
                }
            }
            
            if(cart.length === 0) {
                cartContainer.innerHTML = '<div class="text-center text-on-surface-variant py-8">Keranjang masih kosong</div>';
                cartCountSpan.innerText = "0 ITEMS";
                subtotalSpan.innerText = formatPrice(0);
                totalSpan.innerText = formatPrice(0);
                return;
            }
            
            const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            cartCountSpan.innerText = `${totalItems} ITEMS`;
            subtotalSpan.innerText = formatPrice(total);
            totalSpan.innerText = formatPrice(total);
            
            cartContainer.innerHTML = cart.map((item, idx) => `
                <div class="flex items-center gap-4 group ${idx % 2 === 1 ? 'bg-white/40 dark:bg-dark-surface-high/40' : ''} p-3 rounded-xl">
                    <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0">
                        <img alt="${escapeHtml(item.name)}" class="w-full h-full object-cover" src="${getImageUrl(item.image_url)}" onerror="this.src='https://placehold.co/400x400?text=Product'">
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-sm text-on-surface dark:text-white truncate">${escapeHtml(item.name)}</p>
                        <p class="text-xs text-primary font-bold">${formatPrice(item.price)}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button class="cart-decrease w-7 h-7 rounded-full bg-white text-on-surface flex items-center justify-center active:scale-75 transition-transform shadow-sm dark:bg-dark-surface-high dark:text-white" data-id="${item.id}">
                            <span class="material-symbols-outlined text-sm">remove</span>
                        </button>
                        <span class="text-sm font-black w-4 text-center dark:text-white">${item.quantity}</span>
                        <button class="cart-increase w-7 h-7 rounded-full bg-primary text-on-primary flex items-center justify-center active:scale-75 transition-transform shadow-sm" data-id="${item.id}">
                            <span class="material-symbols-outlined text-sm">add</span>
                        </button>
                    </div>
                </div>
            `).join('');
        }
        
        function addToCart(product) {
            const existing = cart.find(item => item.id === product.id);
            if (existing) {
                if (existing.quantity + 1 > product.stock) {
                    showToast(`Stok ${product.name} hanya tersisa ${product.stock} unit!`, true);
                    return;
                }
                existing.quantity++;
            } else {
                if (product.stock < 1) {
                    showToast(`Stok ${product.name} habis!`, true);
                    return;
                }
                cart.push({ ...product, quantity: 1 });
            }
            renderCart();
        }
        
        function updateQuantity(id, delta) {
            const index = cart.findIndex(item => item.id === id);
            if (index !== -1) {
                const product = products.find(p => p.id === id);
                const newQuantity = cart[index].quantity + delta;
                if (newQuantity <= 0) {
                    cart.splice(index, 1);
                } else if (newQuantity > product.stock) {
                    showToast(`Stok ${product.name} hanya tersisa ${product.stock} unit!`, true);
                    return;
                } else {
                    cart[index].quantity = newQuantity;
                }
                renderCart();
            }
        }
        
        function getTotal() {
            return cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        }
        
        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
        
        // ========== MODAL CASH ==========
        const cashModal = document.getElementById('cashModal');
        const closeCashModalBtn = document.getElementById('closeCashModalBtn');
        const cashReceivedInput = document.getElementById('cashReceived');
        const changeAmountSpan = document.getElementById('changeAmount');
        const cashModalTotal = document.getElementById('cashModalTotal');
        const processCashBtn = document.getElementById('processCashBtn');
        
        function openCashModal() {
            const total = getTotal();
            cashModalTotal.innerText = formatPrice(total);
            cashReceivedInput.value = total;
            updateChange();
            cashModal.classList.remove('opacity-0', 'invisible');
            cashModal.classList.add('opacity-100', 'visible');
        }
        
        function closeCashModal() {
            cashModal.classList.remove('opacity-100', 'visible');
            cashModal.classList.add('opacity-0', 'invisible');
        }
        
        function updateChange() {
            const total = getTotal();
            const received = parseInt(cashReceivedInput.value) || 0;
            const change = received - total;
            changeAmountSpan.innerText = formatPrice(change > 0 ? change : 0);
        }
        
        // ========== MODAL QRIS DENGAN QR STATIS ==========
        const qrisModal = document.getElementById('qrisModal');
        const closeQrisModalBtn = document.getElementById('closeQrisModalBtn');
        const cancelQrisBtn = document.getElementById('cancelQrisBtn');
        const confirmQrisPaidBtn = document.getElementById('confirmQrisPaidBtn');
        const qrisModalTotal = document.getElementById('qrisModalTotal');
        const qrisNominal = document.getElementById('qrisNominal');
        const countdownTimer = document.getElementById('countdownTimer');
        
        function startCountdown(seconds = 300) {
            let remaining = seconds;
            
            if (countdownInterval) clearInterval(countdownInterval);
            
            countdownInterval = setInterval(() => {
                const minutes = Math.floor(remaining / 60);
                const secs = remaining % 60;
                if (countdownTimer) {
                    countdownTimer.innerText = `${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
                }
                
                if (remaining <= 0) {
                    clearInterval(countdownInterval);
                    countdownInterval = null;
                    closeQrisModal();
                    showToast('Waktu pembayaran habis. Silakan ulangi transaksi.', true);
                }
                remaining--;
            }, 1000);
        }
        
        function openQrisModal() {
            const total = getTotal();
            qrisModalTotal.innerText = formatPrice(total);
            if (qrisNominal) qrisNominal.innerText = formatPrice(total);
            
            // TIDAK ADA GENERATE QR CODE - MENGGUNAKAN QR STATIS
            // QR Code sudah ditentukan di HTML melalui tag <img>
            
            qrisModal.classList.remove('opacity-0', 'invisible');
            qrisModal.classList.add('opacity-100', 'visible');
            startCountdown(300);
        }
        
        function closeQrisModal() {
            if (countdownInterval) {
                clearInterval(countdownInterval);
                countdownInterval = null;
            }
            qrisModal.classList.remove('opacity-100', 'visible');
            qrisModal.classList.add('opacity-0', 'invisible');
        }
        
        // ========== PROSES TRANSAKSI ==========
        async function processTransaction(paymentMethod, paidAmount = null) {
            const total = getTotal();
            const cartData = cart.map(item => ({
                id: item.id,
                quantity: item.quantity
            }));
            
            const payload = {
                cart: cartData,
                paid_amount: paidAmount !== null ? paidAmount : total,
                payment_method: paymentMethod
            };
            
            try {
                const response = await fetch('{{ route("cashier.transaction") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(payload)
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showToast('Transaksi berhasil!');
                    cart = [];
                    renderCart();
                    if (paymentMethod === 'cash') closeCashModal();
                    if (paymentMethod === 'qris') closeQrisModal();
                    
                    // Show Receipt
                    showReceipt(result.transaction, payload.paid_amount || total);
                } else {
                    showToast(result.message || 'Transaksi gagal', true);
                }
            } catch (error) {
                console.error('Transaction error:', error);
                showToast('Terjadi kesalahan: ' + error.message, true);
            }
        }
        
        // ========== EVENT LISTENERS ==========
        
        // Product click
        document.addEventListener('click', function(e) {
            const productCard = e.target.closest('.product-card');
            if (productCard) {
                const productData = productCard.getAttribute('data-product');
                if (productData) {
                    addToCart(JSON.parse(productData));
                }
            }
            
            const decreaseBtn = e.target.closest('.cart-decrease');
            if (decreaseBtn) {
                const id = parseInt(decreaseBtn.getAttribute('data-id'));
                updateQuantity(id, -1);
            }
            
            const increaseBtn = e.target.closest('.cart-increase');
            if (increaseBtn) {
                const id = parseInt(increaseBtn.getAttribute('data-id'));
                updateQuantity(id, 1);
            }
        });
        
        // Selected payment method remains cash
        selectedPaymentMethod = "cash";
        
        // Payment Buttons
        const payCashBtn = document.getElementById('payCashBtn');
        const payQrisBtn = document.getElementById('payQrisBtn');
        
        if (payCashBtn) {
            payCashBtn.addEventListener('click', function() {
                if (cart.length === 0) {
                    showToast("Keranjang masih kosong!", true);
                    return;
                }
                openCashModal();
            });
        }
        
        if (payQrisBtn) {
            payQrisBtn.addEventListener('click', function() {
                if (cart.length === 0) {
                    showToast("Keranjang masih kosong!", true);
                    return;
                }
                openQrisModal();
            });
        }
        
        // Cash Modal Events
        if (cashReceivedInput) cashReceivedInput.addEventListener('input', updateChange);
        
        document.querySelectorAll('.quick-cash').forEach(btn => {
            btn.addEventListener('click', function() {
                const amount = parseInt(this.dataset.amount);
                if (amount) {
                    cashReceivedInput.value = amount;
                    updateChange();
                }
            });
        });
        
        const exactCashBtn = document.getElementById('exactCash');
        if (exactCashBtn) {
            exactCashBtn.addEventListener('click', function() {
                const total = getTotal();
                cashReceivedInput.value = total;
                updateChange();
            });
        }
        
        if (processCashBtn) {
            processCashBtn.addEventListener('click', async function() {
                const total = getTotal();
                const received = parseInt(cashReceivedInput.value) || 0;
                
                if (received < total) {
                    showToast(`Uang yang diterima kurang! Kurang ${formatPrice(total - received)}`, true);
                    return;
                }
                
                const originalText = processCashBtn.innerHTML;
                processCashBtn.disabled = true;
                processCashBtn.innerHTML = '<span class="material-symbols-outlined animate-spin">progress_activity</span> Memproses...';
                
                await processTransaction('cash', received);
                
                processCashBtn.disabled = false;
                processCashBtn.innerHTML = originalText;
            });
        }
        
        if (closeCashModalBtn) closeCashModalBtn.addEventListener('click', closeCashModal);
        
        // QRIS Modal Events
        if (confirmQrisPaidBtn) {
            confirmQrisPaidBtn.addEventListener('click', async function() {
                const originalText = confirmQrisPaidBtn.innerHTML;
                confirmQrisPaidBtn.disabled = true;
                confirmQrisPaidBtn.innerHTML = '<span class="material-symbols-outlined animate-spin">progress_activity</span> Memproses...';
                
                await processTransaction('qris');
                
                confirmQrisPaidBtn.disabled = false;
                confirmQrisPaidBtn.innerHTML = originalText;
            });
        }
        
        if (closeQrisModalBtn) closeQrisModalBtn.addEventListener('click', closeQrisModal);
        if (cancelQrisBtn) cancelQrisBtn.addEventListener('click', closeQrisModal);
        
        // Close modals on outside click
        cashModal?.addEventListener('click', function(e) {
            if (e.target === cashModal) closeCashModal();
        });
        
        qrisModal?.addEventListener('click', function(e) {
            if (e.target === qrisModal) closeQrisModal();
        });
        
        // Escape key handler
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (cashModal?.classList.contains('visible')) closeCashModal();
                if (qrisModal?.classList.contains('visible')) closeQrisModal();
            }
        });
        
        // Logout
        const logoutBtn = document.getElementById('logoutBtn');
        const logoutModal = document.getElementById('logoutModal');
        const cancelLogoutBtn = document.getElementById('cancelLogoutBtn');
        const confirmLogoutBtn = document.getElementById('confirmLogoutBtn');

        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                logoutModal.classList.remove('opacity-0', 'invisible');
                logoutModal.classList.add('opacity-100', 'visible');
            });
        }

        if (cancelLogoutBtn) {
            cancelLogoutBtn.addEventListener('click', function() {
                logoutModal.classList.add('opacity-0', 'invisible');
                logoutModal.classList.remove('opacity-100', 'visible');
            });
        }

        if (confirmLogoutBtn) {
            confirmLogoutBtn.addEventListener('click', function() {
                document.getElementById('logout-form').submit();
            });
        }

        logoutModal?.addEventListener('click', function(e) {
            if (e.target === logoutModal) {
                logoutModal.classList.add('opacity-0', 'invisible');
                logoutModal.classList.remove('opacity-100', 'visible');
            }
        });

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                renderProducts();
            });
        }
        
        // Initial render
        renderCategoryButtons();
        renderProducts();
        renderCart();
        // Receipt Functionality
        let currentReceiptTransaction = null;
        function showReceipt(transaction, paidAmount) {
            currentReceiptTransaction = transaction;
            const modal = document.getElementById('receiptModal');
            const receiptContent = document.getElementById('receiptContent');
            const dateElem = document.getElementById('receiptDate');
            const codeElem = document.getElementById('receiptCode');
            const itemsElem = document.getElementById('receiptItems');
            const subtotalElem = document.getElementById('receiptSubtotal');
            const totalElem = document.getElementById('receiptTotal');
            const paidElem = document.getElementById('receiptPaid');
            const changeElem = document.getElementById('receiptChange');

            const now = new Date(transaction.created_at);
            dateElem.innerText = now.toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' });
            codeElem.innerText = transaction.transaction_code;

            // QRIS check removed
            
            // Apply standard black/dark colors for clarity as requested
            receiptContent.querySelectorAll('p, span, h2').forEach(el => {
                el.classList.remove('text-primary');
                if (!el.classList.contains('text-on-surface') && !el.classList.contains('text-on-surface-variant')) {
                    el.classList.add('text-on-surface');
                }
            });

            itemsElem.innerHTML = transaction.items.map(item => `
                <div class="flex justify-between text-[11px]">
                    <div class="flex flex-col">
                        <span class="font-bold text-on-surface">${item.product.name}</span>
                        <span class="text-on-surface-variant/70">${item.quantity} x ${formatPrice(item.price)}</span>
                    </div>
                    <span class="font-bold text-on-surface">${formatPrice(item.quantity * item.price)}</span>
                </div>
            `).join('');

            subtotalElem.innerText = formatPrice(transaction.total);
            totalElem.innerText = formatPrice(transaction.total);
            paidElem.innerText = formatPrice(paidAmount);
            changeElem.innerText = formatPrice(paidAmount - transaction.total);

            // Set specific highlights in black/dark
            totalElem.classList.add('text-on-surface');
            changeElem.classList.add('text-on-surface');
            dateElem.classList.add('text-on-surface-variant');
            codeElem.classList.add('text-on-surface-variant');

            modal.classList.remove('opacity-0', 'invisible');
            modal.classList.add('opacity-100', 'visible');
            modal.querySelector('.transform').classList.remove('scale-95');
            modal.querySelector('.transform').classList.add('scale-100');
        }

        document.getElementById('closeReceiptBtn')?.addEventListener('click', () => {
            document.getElementById('receiptModal').classList.add('opacity-0', 'invisible');
            window.location.reload();
        });

        document.getElementById('printReceiptBtn')?.addEventListener('click', () => {
            if (currentReceiptTransaction && currentReceiptTransaction.id) {
                fetch(`/cashier/transaction/${currentReceiptTransaction.id}/print`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                }).catch(err => console.error("Error logging print:", err));
            }
            window.print();
        });
    })();
</script>

<!-- Modal Konfirmasi Logout -->
<div id="logoutModal" class="fixed inset-0 z-[200] flex items-center justify-center bg-black/40 backdrop-blur-sm opacity-0 invisible transition-all duration-200">
    <div class="w-full max-w-sm bg-white rounded-2xl shadow-2xl transform scale-95 transition-all overflow-hidden dark:bg-dark-surface dark:border dark:border-dark-outline/30">
        <div class="bg-error-container/30 p-6 text-center border-b border-outline-variant/20 dark:border-dark-outline/20">
            <div class="w-16 h-16 bg-error/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-error text-4xl" style="font-variation-settings: 'FILL' 1;">logout</span>
            </div>
            <h3 class="text-xl font-black text-on-surface headline-font dark:text-white">Konfirmasi Logout</h3>
            <p class="text-sm text-on-surface-variant mt-2 dark:text-surface-container/60">Apakah Anda yakin ingin keluar dari sistem?</p>
        </div>
        <div class="p-4 flex gap-3">
            <button id="cancelLogoutBtn" class="flex-1 py-3 bg-surface-container-high text-on-surface-variant rounded-xl font-bold hover:bg-surface-container transition-all dark:bg-dark-surface-high dark:text-surface-container/70">Batal</button>
            <button id="confirmLogoutBtn" class="flex-1 py-3 bg-error text-on-primary rounded-xl font-bold hover:bg-error/90 transition-all">Ya, Logout</button>
        </div>
    </div>
</div>

<script>
    (function() {
        const html = document.documentElement;
        const darkModeToggle = document.getElementById('darkModeToggle');
        const darkModeIcon = document.getElementById('darkModeIcon');

        function updateThemeIcon() {
            if (!darkModeIcon) return;
            if (html.classList.contains('dark')) {
                darkModeIcon.innerText = 'dark_mode';
            } else {
                darkModeIcon.innerText = 'light_mode';
            }
        }

        darkModeToggle?.addEventListener('click', () => {
            html.classList.toggle('dark');
            const isDark = html.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            updateThemeIcon();
        });
        
        updateThemeIcon();

        // Desktop Sidebar Collapse Logic
        const desktopSidebarToggle = document.getElementById('desktopSidebarToggle');
        const desktopSidebarToggleIcon = document.getElementById('desktopSidebarToggleIcon');

        function updateDesktopSidebarToggleIcon() {
            if (!desktopSidebarToggleIcon) return;
            if (html.classList.contains('sidebar-collapsed')) {
                desktopSidebarToggleIcon.innerText = 'menu';
            } else {
                desktopSidebarToggleIcon.innerText = 'menu_open';
            }
        }

        desktopSidebarToggle?.addEventListener('click', () => {
            html.classList.toggle('sidebar-collapsed');
            const isCollapsed = html.classList.contains('sidebar-collapsed');
            localStorage.setItem('sidebar-collapsed', isCollapsed ? 'true' : 'false');
            updateDesktopSidebarToggleIcon();
        });

        updateDesktopSidebarToggleIcon();

        // Mobile Sidebar Logic
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            if (!sidebar || !sidebarOverlay) return;
            const isOpen = !sidebar.classList.contains('-translate-x-full');
            if (isOpen) {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
                sidebarOverlay.classList.remove('opacity-100');
            } else {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('hidden');
                setTimeout(() => sidebarOverlay.classList.add('opacity-100'), 10);
            }
        }

        sidebarToggle?.addEventListener('click', toggleSidebar);
        sidebarOverlay?.addEventListener('click', toggleSidebar);

        // Mobile Cart Logic
        window.toggleCart = function() {
            const cartSidebar = document.getElementById('cartSidebar');
            if (!cartSidebar) return;
            const isOpen = !cartSidebar.classList.contains('translate-x-full');
            if (isOpen) {
                cartSidebar.classList.add('translate-x-full');
            } else {
                cartSidebar.classList.remove('translate-x-full');
            }
        }

        // Clock Update
        function updateClock() {
            const timeElem = document.getElementById('realTimeClock');
            const dateElem = document.getElementById('realDateClock');
            if (!timeElem || !dateElem) return;

            const now = new Date();
            timeElem.innerText = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false });
            dateElem.innerText = now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'short', year: 'numeric' });
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Logout Handler
        const logoutBtn = document.getElementById('logoutBtn');
        const logoutModal = document.getElementById('logoutModal');
        const cancelLogoutBtn = document.getElementById('cancelLogoutBtn');
        const confirmLogoutBtn = document.getElementById('confirmLogoutBtn');

        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (logoutModal) {
                    logoutModal.classList.remove('opacity-0', 'invisible');
                    logoutModal.classList.add('opacity-100', 'visible');
                    logoutModal.querySelector('.transform')?.classList.remove('scale-95');
                    logoutModal.querySelector('.transform')?.classList.add('scale-100');
                }
            });
        }

        if (cancelLogoutBtn) {
            cancelLogoutBtn.addEventListener('click', function() {
                if (logoutModal) {
                    logoutModal.classList.add('opacity-0', 'invisible');
                    logoutModal.classList.remove('opacity-100', 'visible');
                    logoutModal.querySelector('.transform')?.classList.add('scale-95');
                    logoutModal.querySelector('.transform')?.classList.remove('scale-100');
                }
            });
        }

        if (confirmLogoutBtn) {
            confirmLogoutBtn.addEventListener('click', function() {
                document.getElementById('logout-form')?.submit();
            });
        }
    })();
</script>
</body>
</html>