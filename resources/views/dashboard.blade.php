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
<title>TOKO SITI - Admin Reports Dashboard</title>
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
        .glass-panel {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
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
        .modal-transition {
            transition: opacity 0.2s ease, visibility 0.2s ease;
        }
        .btn-click-active {
            transform: scale(0.96);
        }
        .fade-update {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #F1F3E9;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #C7CCBF;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #8B9284;
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
                        "bar": "#aeee86ff",
                        "bar-container": "#96b885ff",
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
                        // Dark Mode Specific
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
        <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-primary text-on-primary rounded-full shadow-sm">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">leaderboard</span>
            <span class="font-bold text-md sidebar-text">Dashboard</span>
        </a>
        @endif
        <a href="{{ url('/inventory') }}" id="inventoryLink" class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-primary-container/40 transition-all duration-200 rounded-full">
            <span class="material-symbols-outlined">inventory_2</span>
            <span class="font-bold text-md sidebar-text">Inventory</span>
        </a>
        @if(Auth::user()->role === 'kasir')
        <a href="{{ url('/cashier') }}" id="cashierLink" class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-primary-container/40 transition-all duration-200 rounded-full">
            <span class="material-symbols-outlined">point_of_sale</span>
            <span class="font-bold text-md sidebar-text">Cashier</span>
        </a>
        @endif
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-primary-container/40 transition-all duration-200 rounded-full">
            <span class="material-symbols-outlined">account_circle</span>
            <span class="font-bold text-md sidebar-text">Profile</span>
        </a>
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

<!-- Main Canvas -->
<main class="lg:ml-64 h-screen flex flex-col overflow-hidden transition-all duration-300">
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
                <input type="text" id="searchInput" class="w-full bg-white border border-outline-variant/30 rounded-full py-3 pl-12 pr-6 focus:ring-2 focus:ring-primary/20 focus:outline-none text-on-surface placeholder:text-outline/60 dark:bg-dark-surface-high dark:border-dark-outline dark:text-surface-container" placeholder="Cari transaksi...">
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
    
    <!-- Dashboard Content -->
    <div class="flex-1 p-4 lg:p-6 space-y-4 overflow-y-auto lg:overflow-hidden flex flex-col custom-scrollbar">
        <div class="flex flex-col md:flex-row justify-between items-end gap-2">
            <div>
                <h2 class="text-2xl font-extrabold text-on-surface tracking-tight headline-font dark:text-white">Dashboard Laporan</h2>
                <p class="text-xs text-on-surface-variant font-medium dark:text-surface-container/80" id="currentDateDisplay">Ringkasan aktivitas toko Anda hari ini.</p>
            </div>
            <div class="flex gap-2">
                <button id="openActivityLogBtn" class="bg-white border border-outline-variant/40 text-on-surface-variant px-4 py-2 rounded-full font-bold text-xs hover:bg-primary-container/40 transition-all flex items-center gap-2 dark:bg-dark-surface dark:border-dark-outline dark:text-surface-container">
                    <span class="material-symbols-outlined text-sm">history</span>
                    Aktivitas
                </button>
                <a href="{{ route('dashboard.export') }}" class="bg-primary text-on-primary px-4 py-2 rounded-full font-bold text-xs hover:brightness-110 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">download</span>
                    Export
                </a>
            </div>
        </div>
        
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded-xl border border-outline-variant/30 flex flex-col justify-between group hover:border-primary/50 transition-all duration-300 dark:bg-dark-surface dark:border-dark-outline/30">
                <div class="flex justify-between items-start">
                    <div class="w-10 h-10 bg-primary-container rounded-xl flex items-center justify-center text-primary dark:bg-primary/20">
                        <span class="material-symbols-outlined text-xl" style="font-variation-settings: &quot;FILL&quot; 1;">payments</span>
                    </div>
                </div>
                <div class="mt-2">
                    <p class="text-[10px] text-on-surface-variant font-bold uppercase tracking-wider dark:text-surface-container/60">Total Penjualan</p>
                    <h3 class="text-xl font-black text-on-surface headline-font dark:text-white" id="totalSales">Rp 0</h3>
                </div>
            </div>
            <div class="bg-white p-4 rounded-xl border border-outline-variant/30 flex flex-col justify-between group hover:border-secondary/50 transition-all duration-300 dark:bg-dark-surface dark:border-dark-outline/30">
                <div class="flex justify-between items-start">
                    <div class="w-10 h-10 bg-secondary-container rounded-xl flex items-center justify-center text-secondary dark:bg-secondary/20">
                        <span class="material-symbols-outlined text-xl" style="font-variation-settings: &quot;FILL&quot; 1;">receipt_long</span>
                    </div>
                </div>
                <div class="mt-2">
                    <p class="text-[10px] text-on-surface-variant font-bold uppercase tracking-wider dark:text-surface-container/60">Jumlah Transaksi</p>
                    <h3 class="text-xl font-black text-on-surface headline-font dark:text-white" id="totalTransactions">0 Pesanan</h3>
                </div>
            </div>
            <div class="bg-tertiary-container p-4 rounded-xl flex flex-col justify-between text-on-tertiary-container shadow-sm border border-tertiary/20 dark:bg-tertiary/10 dark:border-tertiary/30">
                <div class="flex justify-between items-start">
                    <div class="w-10 h-10 bg-tertiary rounded-xl flex items-center justify-center text-on-primary">
                        <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">warning</span>
                    </div>
                </div>
                <div class="mt-2">
                    <p class="text-[10px] text-on-tertiary-container/80 font-bold uppercase tracking-wider dark:text-surface-container/60">Item Hampir Habis</p>
                    <h3 class="text-xl font-black text-on-tertiary-container headline-font dark:text-white" id="lowStockCount">0 Produk</h3>
                </div>
            </div>
        </div>
        
        <!-- Main Analytics Section -->
        <div class="flex flex-col lg:grid lg:grid-cols-5 gap-4 flex-none lg:flex-1 min-h-0">
            <div class="lg:col-span-3 bg-white p-5 rounded-xl border border-outline-variant/30 flex flex-col min-h-0 dark:bg-dark-surface dark:border-dark-outline/30">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-extrabold headline-font dark:text-white">Tren Penjualan</h3>
                    <select id="periodSelect" class="bg-surface-container-low border border-outline-variant/50 rounded-full px-4 py-1.5 text-xs font-bold focus:ring-primary focus:outline-none appearance-none dark:bg-dark-surface-high dark:border-dark-outline dark:text-surface-container">
                        <option value="today">Hari Ini</option>
                        <option value="this_month">Bulan Ini</option>
                        <option value="this_year" selected>Tahun Ini</option>
                    </select>
                </div>
                <div id="chartContainer" class="flex-1 flex items-end justify-between gap-2 min-h-0 pt-2 pb-2">
                    <div class="flex items-center justify-center w-full h-full text-on-surface-variant text-sm dark:text-surface-container/60">Memuat grafik...</div>
                </div>
            </div>
            <div class="lg:col-span-2 flex flex-col min-h-0">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-lg font-extrabold headline-font dark:text-white">Transaksi Terakhir</h3>
                    <a href="#" id="viewAllTransactions" class="text-primary font-bold text-xs hover:underline">Lihat Semua</a>
                </div>
                <div id="transactionsList" class="flex-1 overflow-y-auto pr-2 custom-scrollbar space-y-2">
                    <div class="text-center text-on-surface-variant py-8">Memuat data...</div>
                </div>
            </div>
        </div>
        
        <!-- Inventory Low Alerts Grid -->
        <div class="bg-white p-4 rounded-xl border border-outline-variant/30 shadow-sm dark:bg-dark-surface dark:border-dark-outline/30 overflow-hidden flex flex-col shrink-0 min-h-[180px]">
            <div class="flex justify-between items-center mb-1">
                <div>
                    <h3 class="text-base font-extrabold headline-font dark:text-white">Item Hampir Habis</h3>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-1 h-10">
                        <button onclick="changeLowStockPage(-1)" id="prevLowStock" class="w-9 h-9 flex items-center justify-center rounded-full border border-outline-variant/30 text-on-surface-variant hover:bg-primary hover:text-white transition-all disabled:opacity-20 dark:border-dark-outline dark:text-surface-container">
                            <span class="material-symbols-outlined text-lg">chevron_left</span>
                        </button>
                        <span id="lowStockPageInfo" class="text-xs font-black text-on-surface-variant dark:text-surface-container/60 tabular-nums px-4 h-9 flex items-center justify-center min-w-[3.5rem] leading-none">1 / 1</span>
                        <button onclick="changeLowStockPage(1)" id="nextLowStock" class="w-9 h-9 flex items-center justify-center rounded-full border border-outline-variant/30 text-on-surface-variant hover:bg-primary hover:text-white transition-all disabled:opacity-20 dark:border-dark-outline dark:text-surface-container">
                            <span class="material-symbols-outlined text-lg">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
            <div id="lowStockGrid" class="flex-1 overflow-y-auto pr-2 custom-scrollbar grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
                <div class="col-span-full text-center text-on-surface-variant py-4 text-xs dark:text-surface-container/60">Memuat data...</div>
            </div>
        </div>


        {{-- Activity Log dipindah ke modal popup (tombol Aktivitas di header) --}}
    </div>
</main>

<!-- Modal Notifikasi -->
<div id="notificationModal" class="fixed inset-0 bg-black/60 flex items-center justify-center z-[200] opacity-0 invisible modal-transition backdrop-blur-sm">
    <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4 shadow-2xl transform transition-all scale-95 dark:bg-dark-surface dark:border dark:border-dark-outline/30">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold dark:text-white">Notifikasi</h3>
            <button id="closeModalBtn" class="text-outline hover:text-on-surface dark:text-surface-container/40">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <p id="modalMessage" class="text-on-surface-variant dark:text-surface-container/60">Anda memiliki notifikasi baru.</p>
        <div class="mt-6 flex justify-end">
            <button id="modalOkBtn" class="bg-primary text-white px-5 py-2 rounded-full font-bold">OK</button>
        </div>
    </div>
</div>

<!-- Modal Quick Stock Update -->
<div id="quickStockModal" class="fixed inset-0 z-[180] flex items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 invisible transition-all duration-200">
    <div class="w-full max-w-sm bg-white rounded-2xl shadow-2xl transform scale-95 transition-all overflow-hidden dark:bg-dark-surface dark:border dark:border-dark-outline/30">
        <div class="p-6 border-b border-outline-variant/30 dark:border-dark-outline/20">
            <h3 class="text-xl font-black text-on-surface headline-font dark:text-white" id="quickStockTitle">Update Stok Produk</h3>
            <p class="text-xs text-on-surface-variant font-medium dark:text-surface-container/60 mt-1">Sesuaikan jumlah ketersediaan stok barang.</p>
        </div>
        <form id="quickStockForm" class="p-6 space-y-4">
            <input type="hidden" id="quickStockId">
            <div>
                <label class="block text-xs font-bold text-on-surface-variant mb-1 dark:text-surface-container/60 uppercase">Stok Saat Ini</label>
                <input type="text" id="quickStockCurrent" readonly disabled class="w-full px-4 py-3 bg-surface-container-low rounded-xl border border-outline-variant/30 dark:bg-dark-surface-high dark:border-dark-outline dark:text-surface-container/50 font-bold">
            </div>
            <div>
                <label class="block text-xs font-bold text-on-surface-variant mb-1 dark:text-surface-container/60 uppercase">Stok Baru</label>
                <input type="number" id="quickStockInput" required min="0" class="w-full px-4 py-3 bg-white rounded-xl border border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none dark:bg-dark-surface-high dark:border-primary dark:text-white font-black text-xl">
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" id="closeQuickStockBtn" class="flex-1 py-3 bg-surface-container-high text-on-surface-variant rounded-xl font-bold hover:bg-surface-container transition-all dark:bg-dark-surface-high dark:text-surface-container/70">Batal</button>
                <button type="submit" class="flex-1 py-3 bg-primary text-on-primary rounded-xl font-bold hover:bg-primary/90 transition-all shadow-lg shadow-primary/20">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Riwayat Aktivitas -->
<div id="activityLogModal" class="fixed inset-0 z-[160] flex items-center justify-center bg-black/50 backdrop-blur-sm opacity-0 invisible transition-all duration-200">
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl transform scale-95 transition-all flex flex-col max-h-[90vh] mx-4 dark:bg-dark-surface dark:border dark:border-dark-outline/30">
        <!-- Header -->
        <div class="flex justify-between items-center p-6 border-b border-outline-variant/20 dark:border-dark-outline/20 shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-primary-container rounded-xl flex items-center justify-center text-primary dark:bg-primary/20">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">history</span>
                </div>
                <div>
                    <h2 class="text-xl font-black text-on-surface tracking-tight headline-font dark:text-white">Riwayat Aktivitas</h2>
                    <p class="text-xs text-on-surface-variant font-medium dark:text-surface-container/60">Semua aktivitas sistem tercatat di sini</p>
                </div>
            </div>
            <button id="closeActivityLogModal" class="w-9 h-9 flex items-center justify-center rounded-full hover:bg-error/10 text-on-surface-variant hover:text-error transition-all dark:text-surface-container/40">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <!-- Log List -->
        <div class="flex-1 overflow-y-auto p-5 custom-scrollbar">
            <div class="space-y-3">
                @if(isset($activityLogs) && count($activityLogs) > 0)
                    @foreach($activityLogs as $log)
                    <div class="flex items-start gap-3 p-4 rounded-xl bg-surface-container-low dark:bg-dark-surface-high border border-outline-variant/10 dark:border-dark-outline/10 hover:border-primary/20 transition-all">
                        <div class="w-9 h-9 rounded-xl bg-primary/10 flex items-center justify-center shrink-0 mt-0.5">
                            <span class="material-symbols-outlined text-primary text-base">history</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <p class="text-sm font-black text-on-surface dark:text-white">{{ $log->action }}</p>
                                <span class="px-2 py-0.5 bg-primary/10 text-primary rounded-full text-[9px] font-black uppercase tracking-wide">{{ $log->user->role ?? 'sistem' }}</span>
                            </div>
                            <p class="text-xs text-on-surface-variant dark:text-surface-container/70 mt-1">{{ $log->description }}</p>
                            <div class="flex items-center gap-2 mt-1.5 text-[10px] text-outline font-bold uppercase tracking-wider">
                                <span class="material-symbols-outlined text-[12px]">person</span>
                                <span>{{ $log->user->name ?? 'Sistem' }}</span>
                                <span>&bull;</span>
                                <span class="material-symbols-outlined text-[12px]">schedule</span>
                                <span>{{ $log->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="flex flex-col items-center justify-center py-16 text-center">
                        <div class="w-16 h-16 bg-surface-container-low rounded-full flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-3xl text-outline">history</span>
                        </div>
                        <p class="font-bold text-on-surface-variant">Belum ada aktivitas</p>
                        <p class="text-xs text-outline mt-1">Aktivitas sistem akan tercatat di sini secara otomatis.</p>
                    </div>
                @endif
            </div>
        </div>
        <!-- Footer -->
        <div class="px-6 py-3 border-t border-outline-variant/20 dark:border-dark-outline/20 shrink-0 bg-surface-container-low/50 dark:bg-dark-bg/30 rounded-b-2xl">
            <p class="text-xs text-on-surface-variant dark:text-surface-container/60 font-medium">Total: <span class="font-black text-on-surface dark:text-white">{{ isset($activityLogs) ? count($activityLogs) : 0 }}</span> aktivitas tercatat</p>
        </div>
    </div>
</div>

<!-- Modal Riwayat Transaksi -->
<div id="historyModal" class="fixed inset-0 z-[160] flex items-center justify-center bg-black/50 backdrop-blur-sm opacity-0 invisible transition-all duration-200">
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl transform scale-95 transition-all flex flex-col max-h-[90vh] mx-4 dark:bg-dark-surface dark:border dark:border-dark-outline/30">
        <!-- Header -->
        <div class="flex justify-between items-center p-6 border-b border-outline-variant/20 dark:border-dark-outline/20 shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-primary-container rounded-xl flex items-center justify-center text-primary dark:bg-primary/20">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">receipt_long</span>
                </div>
                <div>
                    <h2 class="text-xl font-black text-on-surface tracking-tight headline-font dark:text-white">Riwayat Transaksi</h2>
                    <p class="text-xs text-on-surface-variant font-medium dark:text-surface-container/60" id="historyModalSubtitle">Semua transaksi tercatat di sini</p>
                </div>
            </div>
            <button id="closeHistoryModal" class="w-9 h-9 flex items-center justify-center rounded-full hover:bg-error/10 text-on-surface-variant hover:text-error transition-all dark:text-surface-container/40">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <!-- Search & Filter inside Modal -->
        <div class="px-6 py-4 border-b border-outline-variant/10 dark:border-dark-outline/10 flex gap-3 shrink-0">
            <div class="relative flex-1">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-lg">search</span>
                <input type="text" id="modalSearchTransactions" class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl py-2 pl-10 pr-4 focus:ring-2 focus:ring-primary/20 focus:outline-none text-sm text-on-surface dark:bg-dark-surface-high dark:border-dark-outline dark:text-white" placeholder="Cari kode transaksi atau metode pembayaran...">
            </div>
        </div>
        <!-- Transactions List -->
        <div class="flex-1 overflow-y-auto p-5 custom-scrollbar">
            <div id="allTransactionsList" class="space-y-3">
                <!-- Injected via JavaScript -->
            </div>
        </div>
        <!-- Footer -->
        <div class="px-6 py-4 border-t border-outline-variant/20 dark:border-dark-outline/20 shrink-0 bg-surface-container-low/50 dark:bg-dark-bg/30 rounded-b-2xl flex justify-between items-center text-xs text-on-surface-variant dark:text-surface-container/60 font-medium">
            <p>Total: <span class="font-black text-on-surface dark:text-white" id="historyTotalCount">0</span> transaksi</p>
            <p>Nilai Penjualan: <span class="font-black text-primary dark:text-primary-container text-sm" id="historyTotalValue">Rp 0</span></p>
        </div>
    </div>
</div>



<script>
    // ==========================================
    // REAL TIME DATE & CLOCK
    // ==========================================
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

    let previousDate = new Date().toDateString();
    
    function updateRealTimeDate() {
        const dateElem = document.getElementById('currentDateDisplay');
        if (!dateElem) return;
        
        const now = new Date();
        const options = { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric'
        };
        
        const formattedDate = now.toLocaleDateString('id-ID', options);
        dateElem.innerHTML = `Ringkasan aktivitas toko Anda, ${formattedDate}`;
        
        const newDateString = now.toDateString();
        if (newDateString !== previousDate) {
            console.log('Hari berganti! Melakukan refresh data...');
            previousDate = newDateString;
            showModal("Hari baru telah dimulai! Data dashboard akan diperbarui.");
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        }
    }
    
    setInterval(updateRealTimeDate, 60000);
    updateRealTimeDate();
    
    // ==========================================
    // DATA DARI CONTROLLER
    // ==========================================
    
    const todaySales = {{ $todaySales ?? 0 }};
    const todayTransactions = {{ $todayTransactions ?? 0 }};
    const lowStockCount = {{ $lowStockProducts ?? 0 }};
    
    const recentTransactions = @json($recentTransactions ?? []);
    const nearOutOfStock = @json($nearOutOfStock ?? []);
    const allTransactions = @json($allTransactions ?? []);
    
    // Pagination for low stock
    let currentLowStockPage = 1;
    const lowStockItemsPerPage = 4;
    
    // Data grafik untuk berbagai periode
    const chartDataToday = @json($chartDataToday ?? []);
    const chartDataThisMonth = @json($chartDataThisMonth ?? []);
    const chartDataThisYear = @json($chartDataThisYear ?? []);
    
    let currentPeriod = 'this_year';
    
    function formatPrice(price) {
        return "Rp " + new Intl.NumberFormat('id-ID').format(price);
    }
    
    function formatShortPrice(price) {
        if (price >= 1000000) {
            return "Rp " + (price / 1000000).toFixed(1) + "M";
        } else if (price >= 1000) {
            return "Rp " + (price / 1000).toFixed(0) + "K";
        }
        return "Rp " + price;
    }
    
    // Update Summary Cards
    const totalSalesElem = document.getElementById('totalSales');
    const totalTransactionsElem = document.getElementById('totalTransactions');
    const lowStockCountElem = document.getElementById('lowStockCount');
    
    if (totalSalesElem) totalSalesElem.innerText = formatPrice(todaySales);
    if (totalTransactionsElem) totalTransactionsElem.innerText = todayTransactions + " Pesanan";
    if (lowStockCountElem) lowStockCountElem.innerText = lowStockCount + " Produk";
    
    // Render Transaksi Terakhir
    function renderTransactions() {
        const container = document.getElementById('transactionsList');
        if (!container) return;
        if (!recentTransactions || recentTransactions.length === 0) {
            container.innerHTML = '<div class="text-center text-on-surface-variant py-8">Belum ada transaksi</div>';
            return;
        }
        container.innerHTML = recentTransactions.map((t, index) => {
            const isEven = index % 2 === 0;
            const printedStatus = t.is_printed 
                ? '<span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-[8px] font-black uppercase tracking-wide dark:bg-green-900/30 dark:text-green-400">Dicetak</span>' 
                : '<span class="px-2 py-0.5 bg-red-100 text-red-700 rounded-full text-[8px] font-black uppercase tracking-wide dark:bg-red-900/30 dark:text-red-400">Tidak Dicetak</span>';

            return `
                <div class="${isEven ? 'bg-white dark:bg-dark-surface' : 'bg-surface-container-low dark:bg-dark-surface-high'} p-4 rounded-xl border ${isEven ? 'border-outline-variant/30 dark:border-dark-outline/30' : 'border-transparent'} flex items-center justify-between shadow-sm hover:translate-x-1 transition-transform duration-200">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-primary-container dark:bg-primary/20 rounded-full flex items-center justify-center text-primary shrink-0">
                            <span class="material-symbols-outlined text-lg">receipt_long</span>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <p class="font-bold text-on-surface dark:text-white text-sm">${t.transaction_code || '#' + t.id}</p>
                                ${printedStatus}
                            </div>
                            <p class="text-[10px] text-on-surface-variant font-medium dark:text-surface-container/60">${t.created_at ? new Date(t.created_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) : '-'} &bull; ${t.payment_method === 'cash' ? 'Tunai' : (t.payment_method || 'Tunai')}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-black text-on-surface dark:text-white">${formatPrice(t.total)}</p>
                        <p class="text-[10px] text-on-surface-variant dark:text-surface-container/40 uppercase">${t.items_count || 0} item</p>
                    </div>
                </div>`;
        }).join('');
    }
    
    // Render All Transactions untuk Modal
    function renderAllTransactions(list) {
        const container = document.getElementById('allTransactionsList');
        if (!container) return;
        const data = list || allTransactions;
        
        // Update summary footer
        const totalCount = document.getElementById('historyTotalCount');
        const totalValue = document.getElementById('historyTotalValue');
        const subtitle = document.getElementById('historyModalSubtitle');
        if (totalCount) totalCount.innerText = data.length;
        if (totalValue) {
            const sum = data.reduce((acc, t) => acc + Number(t.total || 0), 0);
            totalValue.innerText = formatPrice(sum);
        }
        if (subtitle) subtitle.innerText = data.length + ' transaksi tercatat';
        
        if (!data || data.length === 0) {
            container.innerHTML = `
                <div class="flex flex-col items-center justify-center py-16 text-center">
                    <div class="w-16 h-16 bg-surface-container-low rounded-full flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-3xl text-outline">receipt_long</span>
                    </div>
                    <p class="font-bold text-on-surface-variant">Belum ada transaksi</p>
                    <p class="text-xs text-outline mt-1">Transaksi yang diproses kasir akan muncul di sini.</p>
                </div>`;
            return;
        }
        
        container.innerHTML = data.map((t, index) => {
            const transactionDate = t.created_at ? new Date(t.created_at) : new Date();
            const formattedDate = transactionDate.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
            const formattedTime = transactionDate.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            const itemCount = t.items_count || (t.items ? t.items.length : 0);
            const method = t.payment_method === 'cash' ? 'Tunai' : (t.payment_method || 'Tunai');
            const methodClass = t.payment_method === 'cash' ? 'bg-primary-container text-primary dark:bg-primary/20' : 'bg-secondary-container text-secondary dark:bg-secondary/20';
            const printedStatus = t.is_printed 
                ? '<span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-[9px] font-black uppercase tracking-wide dark:bg-green-900/30 dark:text-green-400">Dicetak</span>' 
                : '<span class="px-2 py-0.5 bg-red-100 text-red-700 rounded-full text-[9px] font-black uppercase tracking-wide dark:bg-red-900/30 dark:text-red-400">Tidak Dicetak</span>';
            
            return `
                <div class="bg-white dark:bg-dark-surface-high border border-outline-variant/20 dark:border-dark-outline/20 rounded-xl p-4 hover:border-primary/30 hover:shadow-sm transition-all duration-200 flex items-center gap-4">
                    <div class="w-10 h-10 bg-primary-container dark:bg-primary/10 rounded-xl flex items-center justify-center text-primary shrink-0">
                        <span class="material-symbols-outlined text-xl" style="font-variation-settings:'FILL' 1">receipt</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <p class="font-black text-on-surface dark:text-white text-sm">${escapeHtml(t.transaction_code || '#' + t.id)}</p>
                            <span class="px-2 py-0.5 ${methodClass} rounded-full text-[9px] font-black uppercase tracking-wide">${method}</span>
                            ${printedStatus}
                        </div>
                        <p class="text-[11px] text-on-surface-variant dark:text-surface-container/60 mt-0.5">${formattedDate} &bull; ${formattedTime} &bull; ${itemCount} item</p>
                    </div>
                    <p class="font-black text-primary dark:text-primary text-base shrink-0">${formatPrice(t.total)}</p>
                </div>
            `;
        }).join('');
    }
    
    // Render Low Stock Products
    function renderLowStock() {
        const grid = document.getElementById('lowStockGrid');
        const info = document.getElementById('lowStockPageInfo');
        const prevBtn = document.getElementById('prevLowStock');
        const nextBtn = document.getElementById('nextLowStock');
        
        if (!grid) return;
        
        if (!nearOutOfStock || nearOutOfStock.length === 0) {
            grid.innerHTML = `
                <div class="col-span-full py-12 flex flex-col items-center justify-center text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center text-primary mb-4">
                        <span class="material-symbols-outlined text-3xl">check_circle</span>
                    </div>
                    <h5 class="text-on-surface font-bold dark:text-white">Semua Stok Aman</h5>
                    <p class="text-on-surface-variant text-xs mt-1 dark:text-surface-container/60">Tidak ada produk yang perlu diisi ulang saat ini.</p>
                </div>
            `;
            if (info) info.innerText = '0 / 0';
            return;
        }
        
        const totalItems = nearOutOfStock.length;
        const totalPages = Math.ceil(totalItems / lowStockItemsPerPage);
        
        // Ensure page is within bounds
        if (currentLowStockPage > totalPages) currentLowStockPage = totalPages;
        if (currentLowStockPage < 1) currentLowStockPage = 1;
        
        const start = (currentLowStockPage - 1) * lowStockItemsPerPage;
        const end = Math.min(start + lowStockItemsPerPage, totalItems);
        const paginatedItems = nearOutOfStock.slice(start, end);
        
        if (info) info.innerText = `${currentLowStockPage} / ${totalPages}`;
        if (prevBtn) prevBtn.disabled = currentLowStockPage === 1;
        if (nextBtn) nextBtn.disabled = currentLowStockPage === totalPages;
        
        function getImageUrl(imagePath) {
            if (!imagePath) return 'https://placehold.co/200x200?text=No+Image';
            if (imagePath.startsWith('http')) return imagePath;
            if (imagePath.startsWith('/storage/')) return imagePath;
            return '/storage/' + imagePath;
        }
        
        grid.innerHTML = paginatedItems.map(p => {
            const imageUrl = getImageUrl(p.image_url);
            return `
                <div class="bg-surface-container-low p-3 rounded-xl border border-transparent hover:border-tertiary/20 transition-all cursor-pointer dark:bg-dark-surface-high dark:border-dark-outline/30 flex items-center gap-3 animate-fade-in-up" 
                    onclick="openQuickStockModal(${p.id}, '${escapeHtml(p.name)}', ${p.stock})"
                    data-product="${p.name}" data-id="${p.id}">
                    <div class="w-10 h-10 bg-white rounded-lg overflow-hidden border border-outline-variant/10 dark:bg-dark-surface shrink-0 shadow-sm">
                        <img alt="${escapeHtml(p.name)}" class="w-full h-full object-cover" src="${imageUrl}" onerror="this.src='https://placehold.co/200x200?text=No+Image'">
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-bold text-on-surface text-[11px] truncate dark:text-white leading-tight">${escapeHtml(p.name)}</h4>
                        <div class="flex justify-between items-center mt-0.5">
                            <span class="text-[9px] font-black text-tertiary uppercase tracking-tighter">Stok: ${p.stock}</span>
                            <span class="text-[8px] text-outline font-bold truncate dark:text-surface-container/40 ml-1 uppercase opacity-60">${p.category}</span>
                        </div>
                    </div>
                </div>
            `;
        }).join('');
    }
    
    window.changeLowStockPage = function(delta) {
        currentLowStockPage += delta;
        renderLowStock();
    }
    
    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-primary' : 'bg-error';
        const icon = type === 'success' ? 'check_circle' : 'error';
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
    
    // Render Chart berdasarkan periode
    function renderChart() {
        const chartContainer = document.getElementById('chartContainer');
        if (!chartContainer) return;
        
        let data = [];
        let labels = [];
        
        if (currentPeriod === 'today') {
            data = chartDataToday || [];
            labels = data.map(d => d.hour + ':00');
        } else if (currentPeriod === 'this_month') {
            data = chartDataThisMonth || [];
            labels = data.map(d => 'Minggu ' + d.week);
        } else if (currentPeriod === 'this_year') {
            data = chartDataThisYear || [];
            const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            labels = data.map(d => monthNames[d.month - 1] || 'Bulan ' + d.month);
        }
        
        if (!data || data.length === 0) {
            chartContainer.innerHTML = '<div class="flex items-center justify-center w-full h-64 text-on-surface-variant">Belum ada data penjualan</div>';
            return;
        }
        
        const values = data.map(d => d.total);
        const maxValue = Math.max(...values, 1);
        
        const chartHtml = data.map((item, index) => {
            const value = item.total;
            const heightPercent = maxValue > 0 ? (value / maxValue) * 100 : 0;
            const isHighest = value === maxValue && maxValue > 0;
            const barColor = isHighest ? 'bg-bar' : 'bg-bar-container';
            const adjustedHeight = Math.max(heightPercent, 5);
            const label = labels[index];
            
            return `
                <div class="flex-1 flex flex-col items-center gap-4 group">
                    <div class="w-full ${barColor} rounded-t-xl relative transition-all duration-300" style="height: ${adjustedHeight}px; min-height: 20px;">
                        ${value > 0 ? `<div class="absolute -top-7 left-1/2 -translate-x-1/2 bg-on-surface text-white text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">${formatShortPrice(value)}</div>` : ''}
                    </div>
                    <span class="text-[10px] font-${isHighest ? 'extrabold text-primary' : 'bold text-outline'} uppercase text-center">${label}</span>
                </div>
            `;
        }).join('');
        
        chartContainer.innerHTML = chartHtml;
    }

    // ==========================================
    // QUICK STOCK UPDATE LOGIC
    // ==========================================
    const quickStockModal = document.getElementById('quickStockModal');
    const quickStockForm = document.getElementById('quickStockForm');
    const closeQuickStockBtn = document.getElementById('closeQuickStockBtn');
    
    window.openQuickStockModal = function(id, name, currentStock) {
        document.getElementById('quickStockId').value = id;
        document.getElementById('quickStockTitle').innerText = name;
        document.getElementById('quickStockCurrent').value = currentStock;
        document.getElementById('quickStockInput').value = currentStock;
        
        quickStockModal.classList.remove('opacity-0', 'invisible');
        quickStockModal.classList.add('opacity-100', 'visible');
        quickStockModal.querySelector('.transform').classList.remove('scale-95');
        quickStockModal.querySelector('.transform').classList.add('scale-100');
    }
    
    function closeQuickStockModal() {
        quickStockModal.classList.add('opacity-0', 'invisible');
        quickStockModal.classList.remove('opacity-100', 'visible');
        quickStockModal.querySelector('.transform').classList.add('scale-95');
        quickStockModal.querySelector('.transform').classList.remove('scale-100');
    }
    
    closeQuickStockBtn?.addEventListener('click', closeQuickStockModal);
    
    quickStockForm?.addEventListener('submit', async function(e) {
        e.preventDefault();
        const id = document.getElementById('quickStockId').value;
        const newStock = document.getElementById('quickStockInput').value;
        
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerText;
        submitBtn.disabled = true;
        submitBtn.innerText = 'Menyimpan...';
        
        try {
            const response = await fetch(`/dashboard/product/${id}/stock`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ stock: newStock })
            });
            
            if (response.ok) {
                closeQuickStockModal();
                showToast('Stok berhasil diperbarui!', 'success');
                setTimeout(() => window.location.reload(), 1000);
            } else {
                const err = await response.json();
                showToast(err.message || 'Gagal memperbarui stok', 'error');
                submitBtn.disabled = false;
                submitBtn.innerText = originalText;
            }
        } catch (error) {
            showToast('Terjadi kesalahan koneksi', 'error');
            submitBtn.disabled = false;
            submitBtn.innerText = originalText;
        }
    });
    
    // ==========================================
    // MODAL RIWAYAT AKTIVITAS (tombol "Aktivitas")
    // ==========================================
    
    const activityLogModal = document.getElementById('activityLogModal');
    const closeActivityLogModalBtn = document.getElementById('closeActivityLogModal');
    const openActivityLogBtn = document.getElementById('openActivityLogBtn');
    
    function openActivityLog() {
        if (activityLogModal) {
            activityLogModal.classList.remove('opacity-0', 'invisible');
            activityLogModal.classList.add('opacity-100', 'visible');
            const inner = activityLogModal.querySelector('.transform');
            if (inner) { inner.classList.remove('scale-95'); inner.classList.add('scale-100'); }
            document.body.style.overflow = 'hidden';
        }
    }
    
    function closeActivityLog() {
        if (activityLogModal) {
            activityLogModal.classList.remove('opacity-100', 'visible');
            activityLogModal.classList.add('opacity-0', 'invisible');
            const inner = activityLogModal.querySelector('.transform');
            if (inner) { inner.classList.add('scale-95'); inner.classList.remove('scale-100'); }
            document.body.style.overflow = '';
        }
    }
    
    if (openActivityLogBtn) openActivityLogBtn.addEventListener('click', openActivityLog);
    if (closeActivityLogModalBtn) closeActivityLogModalBtn.addEventListener('click', closeActivityLog);
    if (activityLogModal) {
        activityLogModal.addEventListener('click', function(e) {
            if (e.target === activityLogModal) closeActivityLog();
        });
    }

    // ==========================================
    // MODAL RIWAYAT TRANSAKSI ("Lihat Semua")
    // ==========================================
    const historyModal = document.getElementById('historyModal');
    const closeHistoryModalBtn = document.getElementById('closeHistoryModal');
    const viewAllTransactionsBtn = document.getElementById('viewAllTransactions');
    const modalSearchTransactions = document.getElementById('modalSearchTransactions');

    function openHistoryModal() {
        if (historyModal) {
            renderAllTransactions();
            historyModal.classList.remove('opacity-0', 'invisible');
            historyModal.classList.add('opacity-100', 'visible');
            const inner = historyModal.querySelector('.transform');
            if (inner) { inner.classList.remove('scale-95'); inner.classList.add('scale-100'); }
            document.body.style.overflow = 'hidden';
        }
    }

    function closeHistoryModal() {
        if (historyModal) {
            historyModal.classList.remove('opacity-100', 'visible');
            historyModal.classList.add('opacity-0', 'invisible');
            const inner = historyModal.querySelector('.transform');
            if (inner) { inner.classList.add('scale-95'); inner.classList.remove('scale-100'); }
            document.body.style.overflow = '';
            if (modalSearchTransactions) modalSearchTransactions.value = '';
        }
    }

    if (viewAllTransactionsBtn) {
        viewAllTransactionsBtn.addEventListener('click', function(e) {
            e.preventDefault();
            openHistoryModal();
        });
    }
    if (closeHistoryModalBtn) closeHistoryModalBtn.addEventListener('click', closeHistoryModal);
    if (historyModal) {
        historyModal.addEventListener('click', function(e) {
            if (e.target === historyModal) closeHistoryModal();
        });
    }

    if (modalSearchTransactions) {
        modalSearchTransactions.addEventListener('input', function(e) {
            const query = e.target.value.toLowerCase().trim();
            if (query === '') {
                renderAllTransactions();
            } else {
                const filtered = (allTransactions || []).filter(t => 
                    (t.transaction_code && t.transaction_code.toLowerCase().includes(query)) ||
                    (t.payment_method && t.payment_method.toLowerCase().includes(query))
                );
                renderAllTransactions(filtered);
            }
        });
    }
    
    // ESC untuk tutup
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeActivityLog();
            closeHistoryModal();
        }
    });
    
    // Period Selector Handler
    const periodSelect = document.getElementById('periodSelect');
    if (periodSelect) {
        periodSelect.addEventListener('change', function() {
            currentPeriod = this.value;
            renderChart();
        });
    }
    
    // Search Functionality
    const searchInput = document.getElementById('searchInput');
    let originalTransactions = [...(recentTransactions || [])];
    
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const query = e.target.value.toLowerCase().trim();
            const transContainer = document.getElementById('transactionsList');
            if (!transContainer) return;
            
            if (query === "") {
                renderTransactions();
                return;
            }
            
            const filteredTrans = originalTransactions.filter(t => 
                (t.transaction_code && t.transaction_code.toLowerCase().includes(query)) ||
                (t.payment_method && t.payment_method.toLowerCase().includes(query))
            );
            
            if (filteredTrans.length === 0) {
                transContainer.innerHTML = '<div class="p-6 text-center text-outline">Tidak ada transaksi ditemukan</div>';
            } else {
                transContainer.innerHTML = filteredTrans.map((t, index) => {
                    const isEven = index % 2 === 0;
                    return `
                        <div class="${isEven ? 'bg-white' : 'bg-surface-container-low'} p-5 rounded-xl border ${isEven ? 'border-outline-variant/30' : 'border-transparent'} flex items-center justify-between shadow-sm">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-primary-container rounded-full flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined">receipt</span>
                                </div>
                                <div>
                                    <p class="font-bold text-on-surface">${t.transaction_code || '#' + t.id}</p>
                                    <p class="text-xs text-on-surface-variant font-medium">${t.created_at ? new Date(t.created_at).toLocaleString('id-ID') : '-'}</p>
                                </div>
                            </div>
                            <p class="font-black text-on-surface">${formatPrice(t.total)}</p>
                        </div>
                    `;
                }).join('');
            }
        });
    }
    
    // Navigation Handlers
    const inventoryLink = document.getElementById('inventoryLink');
    const cashierLink = document.getElementById('cashierLink');
    
    if (inventoryLink) {
        inventoryLink.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = "{{ url('/inventory') }}";
        });
    }
    
    if (cashierLink) {
        cashierLink.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = "{{ url('/cashier') }}";
        });
    }
    
    // Logout Handler
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
    
    // Button Handlers
    const downloadBtn = document.getElementById('downloadPDFBtn');
    if (downloadBtn) {
        downloadBtn.addEventListener('click', function() {
            alert("Laporan PDF sedang diproses. File akan segera terunduh.");
        });
    }
    
    // Modal Handlers
    const modal = document.getElementById('notificationModal');
    const closeModal = document.getElementById('closeModalBtn');
    const modalOk = document.getElementById('modalOkBtn');
    
    function showModal(msg) {
        const msgSpan = document.getElementById('modalMessage');
        if (msgSpan) msgSpan.innerText = msg || "Anda memiliki notifikasi baru. Stok produk menipis.";
        if (modal) {
            modal.classList.remove('opacity-0', 'invisible');
            modal.classList.add('opacity-100', 'visible');
        }
    }
    
    function hideModal() {
        if (modal) {
            modal.classList.remove('opacity-100', 'visible');
            modal.classList.add('opacity-0', 'invisible');
        }
    }
    
    if (lowStockCount > 0) {
        setTimeout(() => {
            showModal(`Notifikasi: Terdapat ${lowStockCount} produk dengan stok menipis! Segera lakukan restock.`);
        }, 1000);
    }
    
    if (closeModal) closeModal.addEventListener('click', hideModal);
    if (modalOk) modalOk.addEventListener('click', hideModal);
    
    // Initial Render
    renderTransactions();
    renderLowStock();
    renderChart();
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

        // Set initial icon
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

        // Logout Handler
        const logoutBtn = document.getElementById('logoutBtn');
        const logoutModal = document.getElementById('logoutModal');
        const cancelLogoutBtn = document.getElementById('cancelLogoutBtn');
        const confirmLogoutBtn = document.getElementById('confirmLogoutBtn');

        if (logoutBtn && logoutModal) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                logoutModal.classList.remove('opacity-0', 'invisible');
                logoutModal.classList.add('opacity-100', 'visible');
                logoutModal.querySelector('.transform')?.classList.remove('scale-95');
                logoutModal.querySelector('.transform')?.classList.add('scale-100');
            });
        }

        if (cancelLogoutBtn && logoutModal) {
            cancelLogoutBtn.addEventListener('click', function() {
                logoutModal.classList.add('opacity-0', 'invisible');
                logoutModal.classList.remove('opacity-100', 'visible');
                logoutModal.querySelector('.transform')?.classList.add('scale-95');
                logoutModal.querySelector('.transform')?.classList.remove('scale-100');
            });
        }

        if (confirmLogoutBtn) {
            confirmLogoutBtn.addEventListener('click', function() {
                document.getElementById('logout-form')?.submit();
            });
        }

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

        // Initial render calls (ensure these are present or called appropriately)
        if (typeof renderChart === 'function') renderChart();
        if (typeof renderTransactions === 'function') renderTransactions();
        if (typeof renderLowStock === 'function') renderLowStock();
        if (typeof renderAllTransactions === 'function') renderAllTransactions();
        if (typeof updateRealTimeDate === 'function') updateRealTimeDate();

    })();
</script>
</body>
</html>