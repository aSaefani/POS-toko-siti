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
    <title>Profile Settings | TOKO SITI</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Be_Vietnam_Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
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
        .dark ::-webkit-scrollbar-track {
            background: #0E110A;
        }
        .dark ::-webkit-scrollbar-thumb {
            background: #3F4438;
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #C7CCBF;
            border-radius: 20px;
        }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #3F4438;
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
                        "surface": "#F8F9F2",
                        "surface-container-low": "#F1F3E9",
                        "surface-container": "#E9ECEA",
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
        @endif
        <a href="{{ url('/inventory') }}" class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-primary-container/40 transition-all duration-200 rounded-full">
            <span class="material-symbols-outlined">inventory_2</span>
            <span class="font-bold text-md sidebar-text">Inventory</span>
        </a>
        @if(Auth::user()->role === 'kasir')
        <a href="{{ url('/cashier') }}" class="flex items-center gap-3 px-4 py-3 text-on-surface-variant hover:bg-primary-container/40 transition-all duration-200 rounded-full">
            <span class="material-symbols-outlined">point_of_sale</span>
            <span class="font-bold text-md sidebar-text">Cashier</span>
        </a>
        @endif
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 bg-primary-container text-primary rounded-full shadow-sm">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">account_circle</span>
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
<main class="lg:ml-64 min-h-screen transition-all duration-300">
    <header class="bg-surface/80 backdrop-blur-xl flex justify-between items-center h-16 px-4 lg:px-8 sticky top-0 z-40 dark:bg-dark-bg/80 dark:border-b dark:border-dark-outline/20">
        <div class="flex items-center gap-4">
            <!-- Hamburger Menu -->
            <button id="sidebarToggle" class="lg:hidden w-10 h-10 flex items-center justify-center rounded-full bg-white border border-outline-variant/20 text-on-surface-variant hover:bg-primary-container/20 transition-all dark:bg-dark-surface dark:border-dark-outline">
                <span class="material-symbols-outlined">menu</span>
            </button>
            
            <!-- Desktop Sidebar Collapse Toggle -->
            <button id="desktopSidebarToggle" class="hidden lg:flex w-10 h-10 items-center justify-center rounded-full bg-white border border-outline-variant/20 text-on-surface-variant hover:bg-primary-container/20 transition-all dark:bg-dark-surface dark:border-dark-outline shadow-sm">
                <span class="material-symbols-outlined" id="desktopSidebarToggleIcon">menu_open</span>
            </button>
        </div>
        <div class="flex items-center gap-4">
            <!-- Real-time Clock -->
            <div class="hidden md:flex items-center gap-3 bg-white/50 backdrop-blur-md py-2 px-4 rounded-full border border-outline-variant/20 shadow-sm mr-2 dark:bg-dark-surface/50 dark:border-dark-outline/30">
                <span class="material-symbols-outlined text-primary text-xl">schedule</span>
                <div class="flex flex-col">
                    <span id="realTimeClock" class="font-black text-on-surface text-sm tabular-nums dark:text-white">00:00:00</span>
                    <span id="realDateClock" class="text-[10px] font-bold text-on-surface-variant/70 uppercase tracking-wider dark:text-surface-container/70">-</span>
                </div>
            </div>

            <!-- Dark Mode Toggle -->
            <button id="darkModeToggle" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-outline-variant/20 text-on-surface-variant hover:bg-primary-container/20 transition-all shadow-sm dark:bg-dark-surface dark:border-dark-outline dark:text-primary">
                <span class="material-symbols-outlined" id="darkModeIcon">light_mode</span>
            </button>

            <div class="h-8 w-[1px] bg-outline-variant mx-2 dark:bg-dark-outline"></div>
            <div class="flex items-center gap-3 bg-white py-1.5 pl-1.5 pr-4 rounded-full border border-outline-variant/20 shadow-sm dark:bg-dark-surface dark:border-dark-outline">
                <img alt="Staff Avatar" class="w-9 h-9 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=6B7E5F&background=E1EAD1">
                <span class="font-semibold text-sm dark:text-surface-container">
                    {{ Auth::user()->name }}
                </span>
            </div>
        </div>
    </header>
    
    <div class="p-4 lg:p-8 max-w-4xl mx-auto space-y-8">
        <div>
            <h2 class="text-3xl font-extrabold text-on-surface tracking-tight mb-2 headline-font dark:text-white">Pengaturan Profil</h2>
            <p class="text-on-surface-variant font-medium dark:text-surface-container/80">Kelola informasi akun dan keamanan Anda.</p>
        </div>

        <div class="space-y-6">
            <div class="bg-white p-8 rounded-2xl border border-outline-variant/30 shadow-sm dark:bg-dark-surface dark:border-dark-outline/30">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="bg-white p-8 rounded-2xl border border-outline-variant/30 shadow-sm dark:bg-dark-surface dark:border-dark-outline/30">
                @include('profile.partials.update-password-form')
            </div>

            <div class="bg-white p-8 rounded-2xl border border-outline-variant/30 shadow-sm border-error/20 dark:bg-dark-surface dark:border-error/20">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</main>

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

    // Dark Mode Toggle Logic
    const darkModeToggle = document.getElementById('darkModeToggle');
    const darkModeIcon = document.getElementById('darkModeIcon');
    const html = document.documentElement;

    function updateThemeIcon() {
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
</script>
</body>
</html>
