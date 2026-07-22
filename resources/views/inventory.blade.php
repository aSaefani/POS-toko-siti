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
<title>TOKO SITI - Inventory Management</title>
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
        .modal-transition {
            transition: opacity 0.2s ease, visibility 0.2s ease;
        }
        .image-preview {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 0.75rem;
            border: 1px solid #C7CCBF;
            margin-top: 8px;
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
                        "error-container": "#FFDAD6",
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
        <a href="{{ url('/inventory') }}" class="flex items-center gap-3 px-4 py-3 bg-primary text-on-primary rounded-full shadow-sm">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">inventory_2</span>
            <span class="font-bold text-md sidebar-text">Inventory</span>
        </a>
        @elseif(Auth::user()->role === 'kasir')
        <a href="{{ url('/cashier') }}" class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-primary-container/40 transition-all duration-200 rounded-full">
            <span class="material-symbols-outlined">point_of_sale</span>
            <span class="font-bold text-md sidebar-text">Cashier</span>
        </a>
        <a href="{{ url('/inventory') }}" class="flex items-center gap-3 px-4 py-3 bg-primary text-on-primary rounded-full shadow-sm">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">inventory_2</span>
            <span class="font-bold text-md sidebar-text">Inventory</span>
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

<!-- Main Content -->
<main class="lg:ml-64 min-h-screen transition-all duration-300">
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
                <input type="text" id="searchInput" class="w-full bg-white border border-outline-variant/30 rounded-full py-3 pl-12 pr-6 focus:ring-2 focus:ring-primary/20 focus:outline-none text-on-surface placeholder:text-outline/60 dark:bg-dark-surface-high dark:border-dark-outline dark:text-surface-container" placeholder="Cari produk, SKU, atau kategori...">
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
    
    <div class="p-4 lg:p-6 space-y-4 lg:space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4">
            <div>
                <h2 class="text-2xl lg:text-3xl font-extrabold text-on-surface tracking-tight mb-1 lg:mb-2 headline-font dark:text-white">Inventory</h2>
                <p class="text-xs lg:text-sm text-on-surface-variant font-medium dark:text-surface-container/80">Kelola stok dan katalog produk Anda</p>
            </div>
            <div class="flex gap-2 w-full sm:w-auto">
                <button id="viewTrashBtn" class="flex-1 sm:flex-none bg-surface-container-high text-on-surface-variant px-4 lg:px-6 py-2.5 lg:py-3 rounded-full font-bold text-xs lg:text-sm flex items-center justify-center gap-2 hover:bg-surface-container transition-all shadow-sm">
                    <span class="material-symbols-outlined text-lg">delete_outline</span>
                    <span class="hidden sm:inline">Sampah</span>
                </button>
                <button id="addProductBtn" class="flex-1 sm:flex-none bg-primary text-on-primary px-4 lg:px-6 py-2.5 lg:py-3 rounded-full font-bold text-xs lg:text-sm flex items-center justify-center gap-2 hover:brightness-110 transition-all shadow-sm">
                    <span class="material-symbols-outlined text-lg">add_circle</span>
                    Tambah Barang
                </button>
            </div>
        </div>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 lg:gap-4">
            <div class="bg-white p-4 lg:p-5 rounded-xl border border-outline-variant/30 dark:bg-dark-surface dark:border-dark-outline/30">
                <div class="w-10 h-10 lg:w-14 lg:h-14 bg-primary-container rounded-xl flex items-center justify-center text-primary dark:bg-primary/20">
                    <span class="material-symbols-outlined text-2xl lg:text-3xl" style="font-variation-settings: 'FILL' 1;">inventory_2</span>
                </div>
                <div class="mt-3 lg:mt-4">
                    <p class="text-[10px] lg:text-xs text-on-surface-variant font-medium mb-1 dark:text-surface-container/60">Total Items</p>
                    <h3 class="text-xl lg:text-2xl font-black text-on-surface headline-font dark:text-white" id="totalItems">0</h3>
                </div>
            </div>
            <div class="bg-white p-4 lg:p-5 rounded-xl border border-outline-variant/30 dark:bg-dark-surface dark:border-dark-outline/30">
                <div class="w-10 h-10 lg:w-14 lg:h-14 bg-secondary-container rounded-xl flex items-center justify-center text-secondary dark:bg-secondary/20">
                    <span class="material-symbols-outlined text-2xl lg:text-3xl" style="font-variation-settings: 'FILL' 1;">warning</span>
                </div>
                <div class="mt-3 lg:mt-4">
                    <p class="text-[10px] lg:text-xs text-on-surface-variant font-medium mb-1 dark:text-surface-container/60">Low Stock</p>
                    <h3 class="text-xl lg:text-2xl font-black text-on-surface headline-font dark:text-white" id="lowStockAlerts">0</h3>
                </div>
            </div>
            <div class="bg-white p-4 lg:p-5 rounded-xl border border-outline-variant/30 dark:bg-dark-surface dark:border-dark-outline/30 col-span-2 lg:col-span-1">
                <div class="flex lg:block items-center justify-between lg:justify-start gap-4">
                    <div class="w-10 h-10 lg:w-14 lg:h-14 bg-tertiary-container rounded-xl flex items-center justify-center text-tertiary dark:bg-tertiary/20">
                        <span class="material-symbols-outlined text-2xl lg:text-3xl" style="font-variation-settings: 'FILL' 1;">category</span>
                    </div>
                    <div class="mt-0 lg:mt-4">
                        <p class="text-[10px] lg:text-xs text-on-surface-variant font-medium mb-1 dark:text-surface-container/60">Categories</p>
                        <h3 class="text-xl lg:text-2xl font-black text-on-surface headline-font dark:text-white" id="totalCategories">0</h3>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Table Container -->
        <div class="bg-white rounded-xl border border-outline-variant/30 overflow-hidden dark:bg-dark-surface dark:border-dark-outline/30">
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left border-collapse min-w-[700px]">
                    <thead>
                        <tr class="bg-surface-container-low text-on-surface-variant text-[10px] font-headline font-bold uppercase tracking-widest border-b border-outline-variant/30 dark:bg-dark-surface-high dark:text-surface-container/70 dark:border-dark-outline/20">
                            <th class="px-6 py-4">Product Details</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4 text-right">Price</th>
                            <th class="px-6 py-4 text-center">Stock Level</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="inventoryTableBody" class="divide-y divide-outline-variant/20">
                        <tr><td colspan="5" class="text-center py-12 text-on-surface-variant">Loading products...</td></tr>
                    </tbody>
                </table>
            </div>
            <!-- Pagination Controls -->
            <div id="paginationControls" class="px-8 py-4 border-t border-outline-variant/10 dark:border-dark-outline/20 flex flex-col md:flex-row items-center justify-between bg-white dark:bg-dark-surface gap-4">
                <div class="text-sm text-on-surface-variant dark:text-surface-container/60">
                    Menampilkan <span id="pageRange" class="font-bold text-on-surface dark:text-white">0-0</span> dari <span id="totalItemsDisplayCount" class="font-bold text-on-surface dark:text-white">0</span> produk
                </div>
                <div class="flex items-center gap-2" id="paginationButtons">
                    <!-- Pagination buttons injected here -->
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal Add/Edit Product -->
<div id="productModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 opacity-0 invisible modal-transition">
    <div class="bg-white rounded-2xl p-8 max-w-lg w-full mx-4 shadow-2xl max-h-[90vh] overflow-y-auto modal-scale dark:bg-dark-surface dark:border dark:border-dark-outline/30">
        <div class="flex justify-between items-center mb-6">
            <h3 id="modalTitle" class="text-2xl font-black text-on-surface headline-font dark:text-white">Tambah Produk Baru</h3>
            <button id="closeModalBtn" class="text-outline hover:text-on-surface dark:text-surface-container/40">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form id="productForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="productId" name="product_id">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-on-surface-variant mb-1 dark:text-surface-container/60">Nama Produk</label>
                    <input type="text" id="productName" name="name" required 
                        class="w-full px-4 py-3 bg-surface-container-low rounded-xl border border-outline-variant/30 focus:border-primary focus:ring-0 dark:bg-dark-surface-high dark:border-dark-outline dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-bold text-on-surface-variant mb-1 dark:text-surface-container/60">SKU</label>
                    <input type="text" id="productSku" name="sku" required 
                        class="w-full px-4 py-3 bg-surface-container-low rounded-xl border border-outline-variant/30 focus:border-primary focus:ring-0 dark:bg-dark-surface-high dark:border-dark-outline dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-bold text-on-surface-variant mb-1 dark:text-surface-container/60">Kategori</label>
                    <input type="text" id="productCategory" name="category" list="categoryList" required 
                        class="w-full px-4 py-3 bg-surface-container-low rounded-xl border border-outline-variant/30 focus:border-primary focus:ring-0 dark:bg-dark-surface-high dark:border-dark-outline dark:text-white">
                    <datalist id="categoryList">
                        <!-- Categories will be dynamic -->
                    </datalist>
                </div>
                <div>
                    <label class="block text-sm font-bold text-on-surface-variant mb-1 dark:text-surface-container/60">Harga (Rp)</label>
                    <input type="number" id="productPrice" name="price" required 
                        class="w-full px-4 py-3 bg-surface-container-low rounded-xl border border-outline-variant/30 focus:border-primary focus:ring-0 dark:bg-dark-surface-high dark:border-dark-outline dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-bold text-on-surface-variant mb-1 dark:text-surface-container/60">Stok</label>
                    <input type="number" id="productStock" name="stock" required 
                        class="w-full px-4 py-3 bg-surface-container-low rounded-xl border border-outline-variant/30 focus:border-primary focus:ring-0 dark:bg-dark-surface-high dark:border-dark-outline dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-bold text-on-surface-variant mb-1 dark:text-surface-container/60">Gambar Produk</label>
                    <input type="file" id="productImage" name="image" accept="image/*"
                        class="w-full px-4 py-2 bg-surface-container-low rounded-xl border border-outline-variant/30 focus:border-primary focus:ring-0 dark:bg-dark-surface-high dark:border-dark-outline dark:text-white text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-primary file:text-on-primary hover:file:opacity-95 cursor-pointer">
                    <div id="imagePreviewContainer" class="hidden mt-3 flex items-center gap-3">
                        <img id="imagePreview" src="#" alt="Preview" class="w-16 h-16 object-cover rounded-xl border border-outline-variant/30">
                        <span class="text-xs text-on-surface-variant dark:text-surface-container/50">Preview Gambar</span>
                    </div>
                </div>
            </div>
            <div class="mt-8 flex gap-3">
                <button type="button" id="cancelBtn" class="flex-1 py-3 bg-surface-container-high text-on-surface-variant rounded-xl font-bold hover:bg-surface-container transition-all dark:bg-dark-surface-high dark:text-surface-container/70">Batal</button>
                <button type="submit" class="flex-1 py-3 bg-primary text-on-primary rounded-xl font-bold hover:brightness-110 transition-all shadow-lg shadow-primary/20">Simpan Produk</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Quick Stock Update -->
<div id="quickStockModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 invisible transition-all duration-200">
    <div class="w-full max-w-sm bg-white rounded-2xl shadow-2xl transform scale-95 transition-all overflow-hidden dark:bg-dark-surface dark:border dark:border-dark-outline/30">
        <div class="p-6 border-b border-outline-variant/30 dark:border-dark-outline/20">
            <h3 class="text-xl font-black text-on-surface headline-font dark:text-white" id="quickStockTitle">Update Stok</h3>
            <p class="text-xs text-on-surface-variant font-medium dark:text-surface-container/60 mt-1">Masukkan jumlah stok terbaru untuk produk ini.</p>
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
<!-- MODAL KONFIRMASI HAPUS YANG MENARIK -->
<!-- Modal Sampah (Produk Terhapus) -->
<div id="trashModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 backdrop-blur-sm opacity-0 invisible transition-all duration-200">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-2xl transform scale-95 transition-all flex flex-col max-h-[85vh] dark:bg-dark-surface dark:border dark:border-dark-outline/30">
        <div class="flex justify-between items-center p-6 border-b border-outline-variant/30 dark:border-dark-outline/30">
            <h2 class="text-2xl font-black text-on-surface tracking-tight headline-font dark:text-white">Produk yang Dihapus</h2>
            <button id="closeTrashModal" class="material-symbols-outlined text-on-surface-variant/50 hover:text-error transition-colors text-3xl dark:text-surface-container/40">close</button>
        </div>
        <div class="flex-1 overflow-y-auto p-6 custom-scrollbar">
            <div id="trashList" class="space-y-4">
                <div class="text-center text-on-surface-variant py-8">Memuat data sampah...</div>
            </div>
        </div>
        <div class="p-6 border-t border-outline-variant/30 flex justify-end gap-3 dark:border-dark-outline/20">
            <button id="closeTrashFooterBtn" class="px-6 py-3 bg-surface-container-high text-on-surface-variant rounded-full font-bold hover:bg-surface-container transition-all dark:bg-dark-surface-high dark:text-surface-container/70">Tutup</button>
        </div>
    </div>
</div>

<div id="deleteConfirmModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/40 backdrop-blur-sm opacity-0 invisible transition-all duration-200">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl transform scale-95 transition-all overflow-hidden dark:bg-dark-surface dark:border dark:border-dark-outline/30">
        <div class="bg-error-container/30 p-6 text-center border-b border-outline-variant/20 dark:border-dark-outline/20">
            <div class="w-20 h-20 bg-error/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-error text-5xl" style="font-variation-settings: 'FILL' 1;">delete</span>
            </div>
            <h3 class="text-2xl font-black text-on-surface headline-font dark:text-white">Hapus Produk?</h3>
            <p class="text-on-surface-variant mt-2 dark:text-surface-container/60">Produk akan dipindahkan ke Sampah.</p>
        </div>
        
        <div class="p-6 text-center">
            <div class="bg-surface-container-low p-4 rounded-xl mb-4 dark:bg-dark-surface-high">
                <p class="text-sm text-on-surface-variant font-medium mb-1 dark:text-surface-container/60">Produk yang akan dihapus:</p>
                <p id="deleteProductName" class="text-lg font-black text-error">-</p>
            </div>
            <p class="text-sm text-on-surface-variant dark:text-surface-container/40">Anda dapat memulihkan produk ini nanti dari menu Sampah.</p>
        </div>
        
        <div class="p-6 pt-0 flex gap-3">
            <button id="cancelDeleteBtn" class="flex-1 py-3 bg-surface-container-high text-on-surface-variant rounded-xl font-bold hover:bg-surface-container transition-all dark:bg-dark-surface-high dark:text-surface-container/70">
                Batal
            </button>
            <button id="confirmDeleteBtn" class="flex-1 py-3 bg-error text-on-primary rounded-xl font-bold hover:bg-error/90 transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-lg">delete</span>
                Hapus Produk
            </button>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Logout -->
<div id="logoutModal" class="fixed inset-0 z-[150] flex items-center justify-center bg-black/40 backdrop-blur-sm opacity-0 invisible transition-all duration-200">
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
(function () {
    // =============================================
    // DATA & STATE
    // =============================================
    const initialProducts        = @json($products ?? []);
    const initialTrashedProducts = @json($trashedProducts ?? []);
    const totalItemsCount        = {{ $totalItems ?? 0 }};
    const lowStockCount          = {{ $lowStockAlerts ?? 0 }};
    const categoriesCount        = {{ $categoriesCount ?? 0 }};
    const initialCategoryNames   = @json($categoryNames ?? []);

    let products         = [...initialProducts];
    let trashedProducts  = [...initialTrashedProducts];
    let categoryNames    = [...initialCategoryNames];
    let currentSearchQuery = '';
    let pendingDeleteId  = null;
    let pendingDeleteName = null;
    let currentPage      = 1;
    const itemsPerPage   = 5;

    // =============================================
    // HELPERS
    // =============================================
    function formatPrice(price) {
        return 'Rp ' + parseInt(price).toLocaleString('id-ID');
    }

    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function getStockStatus(stock) {
        stock = parseInt(stock) || 0;
        if (stock === 0)  return { color: 'text-error',   bgColor: 'bg-error',   text: 'Out of stock',       width: 0 };
        if (stock <= 2)   return { color: 'text-error',   bgColor: 'bg-error',   text: `${stock} (Critical)`, width: Math.max((stock / 10) * 100, 5) };
        if (stock <= 10)  return { color: 'text-warning',  bgColor: 'bg-warning', text: `${stock} (Low)`,     width: Math.max((stock / 20) * 100, 10) };
        return                    { color: 'text-primary', bgColor: 'bg-primary', text: `${stock} in stock`,   width: Math.min((stock / 50) * 100, 100) };
    }

    function showToast(message, type) {
        type = type || 'success';
        const toast   = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-primary' : 'bg-error';
        const icon    = type === 'success' ? 'check_circle' : 'error';
        toast.className = 'fixed bottom-8 right-8 ' + bgColor + ' text-white px-6 py-3 rounded-full font-bold shadow-lg z-[300] flex items-center gap-2';
        toast.innerHTML = '<span class="material-symbols-outlined">' + icon + '</span> ' + message;
        document.body.appendChild(toast);
        setTimeout(function () {
            toast.style.opacity    = '0';
            toast.style.transform  = 'translateY(20px)';
            toast.style.transition = 'all 0.3s ease';
            setTimeout(function () { toast.remove(); }, 300);
        }, 3000);
    }

    // =============================================
    // STATS
    // =============================================
    var el;
    el = document.getElementById('totalItems');      if (el) el.innerText = totalItemsCount;
    el = document.getElementById('lowStockAlerts');  if (el) el.innerText = lowStockCount;
    el = document.getElementById('totalCategories'); if (el) el.innerText = categoriesCount;

    // =============================================
    // TABLE RENDER
    // =============================================
    function renderTable() {
        var tbody             = document.getElementById('inventoryTableBody');
        var paginationButtons = document.getElementById('paginationButtons');
        var pageRange         = document.getElementById('pageRange');
        var totalDisplay      = document.getElementById('totalItemsDisplayCount');

        if (!tbody) return;

        var filtered = products;
        if (currentSearchQuery) {
            var q = currentSearchQuery.toLowerCase();
            filtered = products.filter(function (p) {
                return (p.name     && p.name.toLowerCase().includes(q)) ||
                       (p.sku      && p.sku.toLowerCase().includes(q))  ||
                       (p.category && p.category.toLowerCase().includes(q));
            });
        }

        var total      = filtered.length;
        var totalPages = Math.max(1, Math.ceil(total / itemsPerPage));
        if (currentPage > totalPages) currentPage = totalPages;
        if (currentPage < 1) currentPage = 1;

        var startIdx  = (currentPage - 1) * itemsPerPage;
        var endIdx    = Math.min(startIdx + itemsPerPage, total);
        var paginated = filtered.slice(startIdx, endIdx);

        if (pageRange)    pageRange.innerText    = total === 0 ? '0-0' : (startIdx + 1) + '-' + endIdx;
        if (totalDisplay) totalDisplay.innerText = total;

        if (total === 0) {
            tbody.innerHTML = '<tr><td colspan="5" class="text-center py-12 text-on-surface-variant">Tidak ada produk ditemukan</td></tr>';
            if (paginationButtons) paginationButtons.innerHTML = '';
            return;
        }

        tbody.innerHTML = paginated.map(function (p, index) {
            var stockInfo    = getStockStatus(p.stock);
            var isLow        = stockInfo.color !== 'text-primary';
            var rowBg        = isLow
                ? 'bg-error-container/20 dark:bg-error/10'
                : (index % 2 === 0 ? 'bg-surface-container-low dark:bg-dark-surface-high/50' : 'bg-white dark:bg-dark-surface');
            var defaultImage = 'data:image/svg+xml;charset=utf-8,' + encodeURIComponent(
                '<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200">' +
                '<rect width="200" height="200" fill="#e8f0e4"/>' +
                '<text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#6B7E5F" font-size="14" font-family="sans-serif">' +
                (p.name ? escapeHtml(p.name.substring(0,3).toUpperCase()) : 'PRD') +
                '</text></svg>'
            );
            var imageUrl = p.image_url
                ? (p.image_url.startsWith('http') ? p.image_url : (p.image_url.startsWith('/') ? p.image_url : '/storage/' + p.image_url))
                : defaultImage;

            return '<tr class="group hover:bg-surface-container-high dark:hover:bg-dark-surface-high transition-all duration-300 ' + rowBg + ' border-b border-outline-variant/10 dark:border-dark-outline/20">' +
                '<td class="px-6 py-4">' +
                    '<div class="flex items-center gap-3">' +
                        '<div class="w-12 h-12 rounded-lg overflow-hidden bg-white dark:bg-dark-surface-high flex-shrink-0 border border-outline-variant/20">' +
                            '<img alt="' + escapeHtml(p.name) + '" class="w-full h-full object-cover" src="' + imageUrl + '" onerror="this.src=\'' + defaultImage + '\'">' +
                        '</div>' +
                        '<div>' +
                            '<div class="font-bold text-base text-on-surface dark:text-white">' + escapeHtml(p.name) + '</div>' +
                            '<div class="text-[10px] text-on-surface-variant/60 uppercase font-bold tracking-tighter">SKU: ' + escapeHtml(p.sku) + '</div>' +
                        '</div>' +
                    '</div>' +
                '</td>' +
                '<td class="px-6 py-4"><span class="bg-surface-container-high dark:bg-dark-surface-high px-3 py-1 rounded-full text-[11px] font-bold text-on-surface dark:text-surface-container">' + escapeHtml(p.category) + '</span></td>' +
                '<td class="px-6 py-4 text-right font-bold text-base text-on-surface dark:text-white">' + formatPrice(p.price) + '</td>' +
                '<td class="px-6 py-4">' +
                    '<div class="flex flex-col items-center gap-1">' +
                        '<div class="w-24 h-1.5 bg-surface-container-high rounded-full overflow-hidden dark:bg-dark-surface-high">' +
                            '<div class="' + stockInfo.bgColor + ' h-full" style="width:' + stockInfo.width + '%"></div>' +
                        '</div>' +
                        '<span class="text-[10px] font-black ' + stockInfo.color + ' uppercase tracking-tighter">' + stockInfo.text + '</span>' +
                    '</div>' +
                '</td>' +
                '<td class="px-6 py-4 text-right">' +
                    '<div class="flex justify-end gap-1">' +
                        '<button class="btn-add-stock p-1.5 text-secondary hover:bg-secondary-container rounded-full transition-all" data-id="' + p.id + '" data-name="' + escapeHtml(p.name) + '" data-stock="' + p.stock + '" title="Tambah Stok">' +
                            '<span class="material-symbols-outlined text-xl">add</span>' +
                        '</button>' +
                        '<button class="btn-edit-product p-1.5 text-primary hover:bg-primary-container rounded-full transition-all" data-id="' + p.id + '" title="Edit Produk">' +
                            '<span class="material-symbols-outlined text-xl">edit</span>' +
                        '</button>' +
                        '<button class="btn-delete-product p-1.5 text-error hover:bg-error-container rounded-full transition-all" data-id="' + p.id + '" data-name="' + escapeHtml(p.name) + '" title="Hapus Produk">' +
                            '<span class="material-symbols-outlined text-xl">delete</span>' +
                        '</button>' +
                    '</div>' +
                '</td>' +
            '</tr>';
        }).join('');

        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        var container = document.getElementById('paginationButtons');
        if (!container) return;
        var html = '';

        html += '<button onclick="inventoryChangePage(' + (currentPage - 1) + ')" ' + (currentPage === 1 ? 'disabled' : '') +
            ' class="w-10 h-10 flex items-center justify-center rounded-xl border border-outline-variant/30 text-on-surface-variant hover:bg-primary hover:text-white transition-all disabled:opacity-30 disabled:cursor-not-allowed dark:border-dark-outline dark:text-surface-container">' +
            '<span class="material-symbols-outlined text-sm">chevron_left</span></button>';

        var startPage = Math.max(1, currentPage - 2);
        var endPage   = Math.min(totalPages, startPage + 4);
        for (var i = startPage; i <= endPage; i++) {
            var activeClass = i === currentPage
                ? 'bg-primary text-white shadow-md'
                : 'border border-outline-variant/30 text-on-surface-variant hover:bg-surface-container-low dark:border-dark-outline dark:text-surface-container';
            html += '<button onclick="inventoryChangePage(' + i + ')" class="w-10 h-10 flex items-center justify-center rounded-xl font-bold transition-all ' + activeClass + '">' + i + '</button>';
        }

        html += '<button onclick="inventoryChangePage(' + (currentPage + 1) + ')" ' + (currentPage === totalPages ? 'disabled' : '') +
            ' class="w-10 h-10 flex items-center justify-center rounded-xl border border-outline-variant/30 text-on-surface-variant hover:bg-primary hover:text-white transition-all disabled:opacity-30 disabled:cursor-not-allowed dark:border-dark-outline dark:text-surface-container">' +
            '<span class="material-symbols-outlined text-sm">chevron_right</span></button>';

        container.innerHTML = html;
    }

    window.inventoryChangePage = function (page) {
        currentPage = page;
        renderTable();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    // =============================================
    // SEARCH
    // =============================================
    var searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            currentSearchQuery = this.value;
            currentPage = 1;
            renderTable();
        });
    }

    // =============================================
    // CATEGORY DATALIST
    // =============================================
    function updateCategoryDatalist() {
        var datalist = document.getElementById('categoryList');
        if (!datalist) return;
        var seen = {};
        var unique = [];
        products.forEach(function (p) {
            if (p.category && !seen[p.category]) { seen[p.category] = true; unique.push(p.category); }
        });
        datalist.innerHTML = unique.map(function (c) { return '<option value="' + escapeHtml(c) + '">'; }).join('');
    }
    updateCategoryDatalist();

    // =============================================
    // ADD / EDIT MODAL
    // =============================================
    var productModal          = document.getElementById('productModal');
    var modalTitle            = document.getElementById('modalTitle');
    var productForm           = document.getElementById('productForm');
    var closeModalBtn         = document.getElementById('closeModalBtn');
    var cancelBtn             = document.getElementById('cancelBtn');
    var productImageInput     = document.getElementById('productImage');
    var imagePreview          = document.getElementById('imagePreview');
    var imagePreviewContainer = document.getElementById('imagePreviewContainer');

    function openProductModal() {
        if (!productModal) return;
        productModal.classList.remove('opacity-0', 'invisible');
        productModal.classList.add('opacity-100', 'visible');
        document.body.style.overflow = 'hidden';
    }

    function closeProductModal() {
        if (!productModal) return;
        productModal.classList.add('opacity-0', 'invisible');
        productModal.classList.remove('opacity-100', 'visible');
        document.body.style.overflow = '';
        if (productForm) productForm.reset();
        var pid = document.getElementById('productId');
        if (pid) pid.value = '';
        if (imagePreviewContainer) imagePreviewContainer.classList.add('hidden');
    }

    var addProductBtn = document.getElementById('addProductBtn');
    if (addProductBtn) {
        addProductBtn.addEventListener('click', function () {
            if (modalTitle) modalTitle.innerText = 'Tambah Produk Baru';
            var pid = document.getElementById('productId');
            if (pid) pid.value = '';
            if (productForm) productForm.reset();
            if (imagePreviewContainer) imagePreviewContainer.classList.add('hidden');
            openProductModal();
        });
    }

    if (closeModalBtn) closeModalBtn.addEventListener('click', closeProductModal);
    if (cancelBtn)     cancelBtn.addEventListener('click', closeProductModal);
    if (productModal)  productModal.addEventListener('click', function (e) { if (e.target === productModal) closeProductModal(); });

    if (productImageInput) {
        productImageInput.addEventListener('change', function () {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    if (imagePreview) imagePreview.src = e.target.result;
                    if (imagePreviewContainer) imagePreviewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                if (imagePreviewContainer) imagePreviewContainer.classList.add('hidden');
            }
        });
    }

    // SUBMIT FORM (CREATE / UPDATE)
    if (productForm) {
        productForm.addEventListener('submit', function (e) {
            e.preventDefault();
            var productId = document.getElementById('productId') ? document.getElementById('productId').value : '';
            var url       = productId ? '/inventory/' + productId : '/inventory';
            var formData  = new FormData();
            formData.append('name',     document.getElementById('productName')     ? document.getElementById('productName').value     : '');
            formData.append('sku',      document.getElementById('productSku')      ? document.getElementById('productSku').value      : '');
            formData.append('category', document.getElementById('productCategory') ? document.getElementById('productCategory').value : '');
            formData.append('price',    document.getElementById('productPrice')    ? document.getElementById('productPrice').value    : '');
            formData.append('stock',    document.getElementById('productStock')    ? document.getElementById('productStock').value    : '');
            formData.append('_token',   document.querySelector('meta[name="csrf-token"]').content);
            if (productId) formData.append('_method', 'PUT');
            if (productImageInput && productImageInput.files[0]) formData.append('image', productImageInput.files[0]);

            var submitBtn   = productForm.querySelector('button[type="submit"]');
            var originalTxt = submitBtn ? submitBtn.innerText : 'Simpan';
            if (submitBtn) { submitBtn.disabled = true; submitBtn.innerText = 'Menyimpan...'; }

            fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            }).then(function (res) {
                if (res.ok) {
                    showToast(productId ? 'Produk berhasil diupdate!' : 'Produk berhasil ditambahkan!', 'success');
                    setTimeout(function () { window.location.reload(); }, 1000);
                } else {
                    res.text().then(function (text) {
                        var msg = 'Gagal menyimpan produk';
                        try { msg = JSON.parse(text).message || msg; } catch (_) {}
                        showToast(msg, 'error');
                        if (submitBtn) { submitBtn.disabled = false; submitBtn.innerText = originalTxt; }
                    });
                }
            }).catch(function (err) {
                console.error(err);
                showToast('Terjadi kesalahan jaringan', 'error');
                if (submitBtn) { submitBtn.disabled = false; submitBtn.innerText = originalTxt; }
            });
        });
    }

    // =============================================
    // DELETE MODAL
    // =============================================
    var deleteModal           = document.getElementById('deleteConfirmModal');
    var deleteProductNameSpan = document.getElementById('deleteProductName');
    var cancelDeleteBtn       = document.getElementById('cancelDeleteBtn');
    var confirmDeleteBtn      = document.getElementById('confirmDeleteBtn');

    function openDeleteModal(id, name) {
        pendingDeleteId   = id;
        pendingDeleteName = name;
        if (deleteProductNameSpan) deleteProductNameSpan.innerText = name;
        if (deleteModal) {
            deleteModal.classList.remove('opacity-0', 'invisible');
            deleteModal.classList.add('opacity-100', 'visible');
            deleteModal.querySelector('.transform')?.classList.remove('scale-95');
            deleteModal.querySelector('.transform')?.classList.add('scale-100');
        }
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        pendingDeleteId   = null;
        pendingDeleteName = null;
        if (deleteModal) {
            deleteModal.classList.add('opacity-0', 'invisible');
            deleteModal.classList.remove('opacity-100', 'visible');
            deleteModal.querySelector('.transform')?.classList.add('scale-95');
            deleteModal.querySelector('.transform')?.classList.remove('scale-100');
        }
        document.body.style.overflow = '';
        if (confirmDeleteBtn) {
            confirmDeleteBtn.disabled = false;
            confirmDeleteBtn.innerHTML = '<span class="material-symbols-outlined text-lg">delete</span> Hapus Produk';
        }
    }

    if (cancelDeleteBtn) cancelDeleteBtn.addEventListener('click', closeDeleteModal);
    if (deleteModal)     deleteModal.addEventListener('click', function (e) { if (e.target === deleteModal) closeDeleteModal(); });

    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener('click', function () {
            if (!pendingDeleteId) return;
            confirmDeleteBtn.disabled  = true;
            confirmDeleteBtn.innerHTML = '<span class="material-symbols-outlined text-lg">progress_activity</span> Menghapus...';

            fetch('/inventory/' + pendingDeleteId, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            }).then(function (res) {
                res.text().then(function (text) {
                    var result = { success: true };
                    try { result = JSON.parse(text); } catch (_) {}
                    if (res.ok && result.success !== false) {
                        showToast(pendingDeleteName + ' berhasil dihapus!', 'success');
                        closeDeleteModal();
                        setTimeout(function () { window.location.reload(); }, 1000);
                    } else {
                        showToast(result.message || 'Gagal menghapus produk', 'error');
                        confirmDeleteBtn.disabled  = false;
                        confirmDeleteBtn.innerHTML = '<span class="material-symbols-outlined text-lg">delete</span> Hapus Produk';
                    }
                });
            }).catch(function (err) {
                console.error(err);
                showToast('Terjadi kesalahan jaringan', 'error');
                confirmDeleteBtn.disabled  = false;
                confirmDeleteBtn.innerHTML = '<span class="material-symbols-outlined text-lg">delete</span> Hapus Produk';
            });
        });
    }

    // =============================================
    // DELEGATED CLICK — table body
    // =============================================
    var inventoryTableBody = document.getElementById('inventoryTableBody');
    if (inventoryTableBody) {
        inventoryTableBody.addEventListener('click', function (e) {
            // EDIT
            var editBtn = e.target.closest('.btn-edit-product');
            if (editBtn) {
                var id = editBtn.dataset.id;
                fetch('/inventory/' + id + '/edit', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                }).then(function (res) {
                    if (res.ok) {
                        res.json().then(function (p) {
                            document.getElementById('productId').value       = p.id;
                            document.getElementById('productName').value     = p.name;
                            document.getElementById('productSku').value      = p.sku;
                            document.getElementById('productCategory').value = p.category;
                            document.getElementById('productPrice').value    = p.price;
                            document.getElementById('productStock').value    = p.stock;
                            if (p.image_url) {
                                if (imagePreview) imagePreview.src = p.image_url;
                                if (imagePreviewContainer) imagePreviewContainer.classList.remove('hidden');
                            } else {
                                if (imagePreviewContainer) imagePreviewContainer.classList.add('hidden');
                            }
                            if (modalTitle) modalTitle.innerText = 'Edit Produk';
                            openProductModal();
                        });
                    } else {
                        showToast('Gagal mengambil data produk', 'error');
                    }
                }).catch(function (err) {
                    console.error(err);
                    showToast('Terjadi kesalahan', 'error');
                });
                return;
            }

            // DELETE
            var deleteBtn = e.target.closest('.btn-delete-product');
            if (deleteBtn) {
                openDeleteModal(deleteBtn.dataset.id, deleteBtn.dataset.name);
                return;
            }

            // ADD STOCK
            var stockBtn = e.target.closest('.btn-add-stock');
            if (stockBtn) {
                openQuickStock(stockBtn.dataset.id, stockBtn.dataset.name, stockBtn.dataset.stock);
            }
        });
    }

    // =============================================
    // QUICK STOCK MODAL
    // =============================================
    var quickStockModal = document.getElementById('quickStockModal');
    var quickStockForm  = document.getElementById('quickStockForm');
    var closeQSBtn      = document.getElementById('closeQuickStockBtn');

    function openQuickStock(id, name, stock) {
        var qId    = document.getElementById('quickStockId');
        var qTitle = document.getElementById('quickStockTitle');
        var qCur   = document.getElementById('quickStockCurrent');
        var qInput = document.getElementById('quickStockInput');
        if (qId)    qId.value        = id;
        if (qTitle) qTitle.innerText = name;
        if (qCur)   qCur.value       = stock;
        if (qInput) qInput.value     = stock;
        if (quickStockModal) {
            quickStockModal.classList.remove('opacity-0', 'invisible');
            quickStockModal.classList.add('opacity-100', 'visible');
        }
        document.body.style.overflow = 'hidden';
    }

    function closeQuickStockModal() {
        if (quickStockModal) {
            quickStockModal.classList.add('opacity-0', 'invisible');
            quickStockModal.classList.remove('opacity-100', 'visible');
        }
        document.body.style.overflow = '';
    }

    if (closeQSBtn)      closeQSBtn.addEventListener('click', closeQuickStockModal);
    if (quickStockModal) quickStockModal.addEventListener('click', function (e) { if (e.target === quickStockModal) closeQuickStockModal(); });

    if (quickStockForm) {
        quickStockForm.addEventListener('submit', function (e) {
            e.preventDefault();
            var id    = document.getElementById('quickStockId')    ? document.getElementById('quickStockId').value    : '';
            var stock = document.getElementById('quickStockInput') ? document.getElementById('quickStockInput').value : '';
            var btn   = this.querySelector('button[type="submit"]');
            if (btn) { btn.disabled = true; btn.innerText = 'Menyimpan...'; }

            fetch('/inventory/' + id + '/stock', {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ stock: stock })
            }).then(function (res) {
                if (res.ok) {
                    showToast('Stok berhasil diperbarui!', 'success');
                    setTimeout(function () { window.location.reload(); }, 1000);
                } else {
                    showToast('Gagal memperbarui stok', 'error');
                    if (btn) { btn.disabled = false; btn.innerText = 'Simpan'; }
                }
            }).catch(function () {
                showToast('Terjadi kesalahan', 'error');
                if (btn) { btn.disabled = false; btn.innerText = 'Simpan'; }
            });
        });
    }

    // =============================================
    // TRASH MODAL
    // =============================================
    var trashModal         = document.getElementById('trashModal');
    var viewTrashBtn       = document.getElementById('viewTrashBtn');
    var closeTrashModalBtn = document.getElementById('closeTrashModal');
    var closeTrashFooter   = document.getElementById('closeTrashFooterBtn');
    var trashListContainer = document.getElementById('trashList');

    function renderTrashTable() {
        if (!trashListContainer) return;
        if (trashedProducts.length === 0) {
            trashListContainer.innerHTML = '<div class="text-center text-on-surface-variant py-12">Tidak ada produk di sampah</div>';
            return;
        }
        var defaultImage = 'https://placehold.co/200x200?text=No+Image';
        trashListContainer.innerHTML = trashedProducts.map(function (p) {
            var imageUrl = p.image_url
                ? (p.image_url.startsWith('http') ? p.image_url : '/storage/' + p.image_url)
                : defaultImage;
            return '<div class="bg-surface-container-low p-4 rounded-xl border border-outline-variant/30 flex items-center justify-between">' +
                '<div class="flex items-center gap-4">' +
                    '<img src="' + imageUrl + '" class="w-12 h-12 rounded-lg object-cover border border-outline-variant/20" onerror="this.src=\'' + defaultImage + '\'">' +
                    '<div>' +
                        '<p class="font-bold text-on-surface">' + escapeHtml(p.name) + '</p>' +
                        '<p class="text-xs text-on-surface-variant">Dihapus: ' + new Date(p.deleted_at).toLocaleString('id-ID') + '</p>' +
                    '</div>' +
                '</div>' +
                '<button class="btn-restore-product bg-primary text-on-primary px-4 py-2 rounded-full text-xs font-bold flex items-center gap-1 hover:brightness-110 transition-all" data-id="' + p.id + '">' +
                    '<span class="material-symbols-outlined text-sm">restore</span> Pulihkan' +
                '</button>' +
            '</div>';
        }).join('');

        trashListContainer.querySelectorAll('.btn-restore-product').forEach(function (btn) {
            btn.addEventListener('click', function () { restoreProduct(this.dataset.id); });
        });
    }

    function openTrashModal() {
        renderTrashTable();
        if (trashModal) {
            trashModal.classList.remove('opacity-0', 'invisible');
            trashModal.classList.add('opacity-100', 'visible');
            trashModal.querySelector('.transform')?.classList.remove('scale-95');
            trashModal.querySelector('.transform')?.classList.add('scale-100');
        }
        document.body.style.overflow = 'hidden';
    }

    function closeTrash() {
        if (trashModal) {
            trashModal.classList.add('opacity-0', 'invisible');
            trashModal.classList.remove('opacity-100', 'visible');
            trashModal.querySelector('.transform')?.classList.add('scale-95');
            trashModal.querySelector('.transform')?.classList.remove('scale-100');
        }
        document.body.style.overflow = '';
    }

    if (viewTrashBtn)       viewTrashBtn.addEventListener('click', openTrashModal);
    if (closeTrashModalBtn) closeTrashModalBtn.addEventListener('click', closeTrash);
    if (closeTrashFooter)   closeTrashFooter.addEventListener('click', closeTrash);
    if (trashModal)         trashModal.addEventListener('click', function (e) { if (e.target === trashModal) closeTrash(); });

    function restoreProduct(id) {
        fetch('/inventory/' + id + '/restore', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        }).then(function (res) {
            if (res.ok) {
                showToast('Produk berhasil dipulihkan!', 'success');
                setTimeout(function () { window.location.reload(); }, 1000);
            } else {
                showToast('Gagal memulihkan produk', 'error');
            }
        }).catch(function () {
            showToast('Terjadi kesalahan saat memulihkan produk', 'error');
        });
    }

    // =============================================
    // LOGOUT MODAL
    // =============================================
    var logoutBtn       = document.getElementById('logoutBtn');
    var logoutModal     = document.getElementById('logoutModal');
    var cancelLogoutBtn = document.getElementById('cancelLogoutBtn');
    var confirmLogout   = document.getElementById('confirmLogoutBtn');

    if (logoutBtn) {
        logoutBtn.addEventListener('click', function (e) {
            e.preventDefault();
            if (logoutModal) {
                logoutModal.classList.remove('opacity-0', 'invisible');
                logoutModal.classList.add('opacity-100', 'visible');
            }
            document.body.style.overflow = 'hidden';
        });
    }

    if (cancelLogoutBtn) {
        cancelLogoutBtn.addEventListener('click', function () {
            if (logoutModal) {
                logoutModal.classList.add('opacity-0', 'invisible');
                logoutModal.classList.remove('opacity-100', 'visible');
            }
            document.body.style.overflow = '';
        });
    }

    if (confirmLogout) {
        confirmLogout.addEventListener('click', function () {
            var form = document.getElementById('logout-form');
            if (form) form.submit();
        });
    }

    if (logoutModal) {
        logoutModal.addEventListener('click', function (e) {
            if (e.target === logoutModal) {
                logoutModal.classList.add('opacity-0', 'invisible');
                logoutModal.classList.remove('opacity-100', 'visible');
                document.body.style.overflow = '';
            }
        });
    }

    // =============================================
    // DARK MODE & CLOCK
    // =============================================
    var htmlEl      = document.documentElement;
    var darkToggle  = document.getElementById('darkModeToggle');
    var darkIcon    = document.getElementById('darkModeIcon');

    function updateThemeIcon() {
        if (!darkIcon) return;
        darkIcon.innerText = htmlEl.classList.contains('dark') ? 'dark_mode' : 'light_mode';
    }

    if (darkToggle) {
        darkToggle.addEventListener('click', function () {
            htmlEl.classList.toggle('dark');
            localStorage.setItem('theme', htmlEl.classList.contains('dark') ? 'dark' : 'light');
            updateThemeIcon();
        });
    }
    updateThemeIcon();

    // Desktop Sidebar Collapse Logic
    var desktopSidebarToggle = document.getElementById('desktopSidebarToggle');
    var desktopSidebarToggleIcon = document.getElementById('desktopSidebarToggleIcon');

    function updateDesktopSidebarToggleIcon() {
        if (!desktopSidebarToggleIcon) return;
        if (htmlEl.classList.contains('sidebar-collapsed')) {
            desktopSidebarToggleIcon.innerText = 'menu';
        } else {
            desktopSidebarToggleIcon.innerText = 'menu_open';
        }
    }

    if (desktopSidebarToggle) {
        desktopSidebarToggle.addEventListener('click', function () {
            htmlEl.classList.toggle('sidebar-collapsed');
            var isCollapsed = htmlEl.classList.contains('sidebar-collapsed');
            localStorage.setItem('sidebar-collapsed', isCollapsed ? 'true' : 'false');
            updateDesktopSidebarToggleIcon();
        });
    }
    updateDesktopSidebarToggleIcon();

    function updateClock() {
        var timeEl = document.getElementById('realTimeClock');
        var dateEl = document.getElementById('realDateClock');
        if (!timeEl || !dateEl) return;
        var now = new Date();
        timeEl.innerText = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false });
        dateEl.innerText = now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'short', year: 'numeric' });
    }
    setInterval(updateClock, 1000);
    updateClock();

    // =============================================
    // MOBILE SIDEBAR
    // =============================================
    var sidebar        = document.getElementById('sidebar');
    var sidebarToggle  = document.getElementById('sidebarToggle');
    var sidebarOverlay = document.getElementById('sidebarOverlay');

    function toggleSidebar() {
        if (!sidebar || !sidebarOverlay) return;
        var isOpen = !sidebar.classList.contains('-translate-x-full');
        if (isOpen) {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        } else {
            sidebar.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
            setTimeout(function () { sidebarOverlay.classList.add('opacity-100'); }, 10);
        }
    }

    if (sidebarToggle)  sidebarToggle.addEventListener('click', toggleSidebar);
    if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebar);

    // ESC key closes modals
    document.addEventListener('keydown', function (e) {
        if (e.key !== 'Escape') return;
        if (deleteModal     && deleteModal.classList.contains('visible'))     closeDeleteModal();
        if (productModal    && productModal.classList.contains('visible'))    closeProductModal();
        if (quickStockModal && quickStockModal.classList.contains('visible')) closeQuickStockModal();
        if (trashModal      && trashModal.classList.contains('visible'))      closeTrash();
        if (logoutModal     && logoutModal.classList.contains('visible')) {
            logoutModal.classList.add('opacity-0', 'invisible');
            logoutModal.classList.remove('opacity-100', 'visible');
            document.body.style.overflow = '';
        }
    });

    // =============================================
    // INITIAL RENDER
    // =============================================
    renderTable();
})();
</script>
</body>
</html>