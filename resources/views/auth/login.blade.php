<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Login | TOKO SITI</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&amp;family=Be_Vietnam_Pro:wght@400;500;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
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
                        "error-container": "#FFDAD6"
                    },
                    "borderRadius": {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
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
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            font-family: 'Be Vietnam Pro', sans-serif;
            background-color: #F8F9F2;
        }

        h1,
        h2,
        h3 {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .vibrant-gradient {
            background: linear-gradient(135deg, #6B7E5F 0%, #242E1B 100%);
        }

        .ghost-border {
            border: 1.5px solid rgba(139, 146, 132, 0.2);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        /* Animation for error message */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        .shake-animation {
            animation: shake 0.3s ease-in-out;
        }
    </style>
</head>

<body
    class="text-on-surface selection:bg-primary-container selection:text-on-primary-container min-h-screen flex items-center justify-center p-6 md:p-12 relative overflow-hidden">
    <!-- Decorative Background Elements (Soft Pastel Aesthetic) -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-primary-container/40 rounded-full blur-[120px]"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-secondary-container/50 rounded-full blur-[120px]"></div>
    
    <!-- Home Button - Top Right Corner -->
    <a href="{{ url('/') }}" 
       class="fixed top-6 right-6 z-20 flex items-center gap-2 px-5 py-2.5 bg-surface-container-lowest hover:bg-surface-container rounded-full shadow-md hover:shadow-lg transition-all duration-300 group border border-outline-variant/30">
        <span class="material-symbols-outlined text-primary group-hover:-translate-x-0.5 transition-transform">home</span>
        <span class="text-sm font-semibold text-on-surface hidden sm:inline">Home</span>
        <span class="material-symbols-outlined text-primary text-sm group-hover:translate-x-0.5 transition-transform hidden sm:inline">arrow_forward</span>
    </a>

    <main
        class="w-full max-w-[1200px] grid md:grid-cols-2 bg-surface-container-low rounded-xl overflow-hidden shadow-[0_20px_60px_rgba(40,54,24,0.08)] relative z-10">
        <!-- Branding Section (Asymmetric Editorial Style) -->
        <div class="hidden md:flex flex-col justify-between p-12 bg-surface">
            <div>
                <div class="flex items-center gap-3 mb-16">
                    <span class="text-2xl font-black text-primary tracking-tighter">TOKO SITI</span>
                </div>
                <h1 class="text-5xl lg:text-7xl font-extrabold text-on-surface leading-[1.1] tracking-tight mb-8">
                    Modern <span class="text-primary">Retail</span> <br />Made Simple.
                </h1>
                <p class="text-lg text-on-surface-variant max-w-sm leading-relaxed">
                    The neighborhood merchant platform designed for speed, clarity, and a serene staff experience.
                </p>
            </div>
        </div>
        <!-- Login Form Section -->
        <div class="p-8 md:p-16 flex flex-col justify-center bg-surface-container-lowest">
            <div class="md:hidden flex items-center justify-between mb-12">
                <div class="flex items-center gap-2">
                    <span class="text-xl font-black text-primary tracking-tighter">TOKO SITI</span>
                </div>
                <a href="{{ url('/') }}" class="flex items-center gap-1 px-3 py-1.5 bg-surface-container rounded-full text-sm font-medium text-primary hover:bg-primary-container transition-colors">
                    <span class="material-symbols-outlined text-sm">home</span>
                    <span>Home</span>
                </a>
            </div>
            <header class="mb-10">
                <h2 class="text-3xl font-extrabold text-on-surface tracking-tight mb-2">Welcome Back</h2>
                <p class="text-on-surface-variant">Sign in to your staff dashboard to continue.</p>
            </header>

            <!-- ERROR MESSAGE DISPLAY -->
            @if($errors->any())
                <div class="mb-6 p-4 bg-error-container/20 rounded-2xl border border-error/40 shadow-sm shake-animation">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0">
                            <span class="material-symbols-outlined text-error text-2xl">error</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-error mb-1">Login Gagal!</p>
                            <p class="text-sm text-on-surface-variant">{{ $errors->first() }}</p>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 text-on-surface-variant hover:text-error transition-colors">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    </div>
                </div>
            @endif

            <!-- SUCCESS MESSAGE DISPLAY -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-primary-container/30 rounded-2xl border border-primary/40 shadow-sm">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0">
                            <span class="material-symbols-outlined text-primary text-2xl">check_circle</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-primary mb-1">Berhasil!</p>
                            <p class="text-sm text-on-surface-variant">{{ session('success') }}</p>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 text-on-surface-variant hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6" id="loginForm">
                @csrf
                <!-- Username/Email Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-on-surface-variant ml-4" for="identity">Email</label>
                    <div class="relative group">
                        <span
                            class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-primary transition-colors">person</span>
                        <input name="email" type="email" id="identity" placeholder="example@gmail.com" 
                               value="{{ old('email') }}"
                               class="w-full pl-14 pr-6 py-4 bg-surface-container rounded-full ghost-border focus:border-primary focus:ring-0 focus:bg-surface-container-lowest transition-all placeholder:text-on-surface-variant/40 @error('email') border-error/50 @enderror" 
                               required autofocus />
                    </div>
                    @error('email')
                        <p class="text-xs text-error ml-4 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Password Field -->
                <div class="space-y-2">
                        <label class="text-sm font-bold text-on-surface-variant" for="password">Password</label>
                    <div class="relative group">
                        <span
                            class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-primary transition-colors">lock</span>
                        <input name="password" id="password" placeholder="••••••••" type="password" 
                               class="w-full pl-14 pr-14 py-4 bg-surface-container rounded-full ghost-border focus:border-primary focus:ring-0 focus:bg-surface-container-lowest transition-all placeholder:text-on-surface-variant/40 @error('password') border-error/50 @enderror" 
                               required />
                        <button type="button" onclick="togglePassword()" class="absolute right-5 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors">
                            <span class="material-symbols-outlined">visibility</span>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-xs text-error ml-4 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Remember Me -->
                <div class="flex items-center gap-3 px-4">
                    <input name="remember" id="remember" type="checkbox" class="w-5 h-5 rounded-md border-outline-variant text-primary focus:ring-primary focus:ring-offset-background" />
                    <label class="text-sm text-on-surface-variant font-medium cursor-pointer" for="remember">Keep me
                        signed in</label>
                </div>
                <!-- Primary CTA -->
                <div class="pt-4">
                    <button
                        class="w-full vibrant-gradient text-on-primary font-bold py-5 rounded-full shadow-[0_12px_24px_rgba(107,126,95,0.2)] active:scale-95 transition-transform flex items-center justify-center gap-2 group"
                        type="submit">
                        Masuk ke Dashboard
                        <span
                            class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
                    </button>
                </div>
            </form>
            <footer class="mt-12 pt-12 border-t border-outline-variant/20 text-center">
                <div class="text-[10px] text-on-surface-variant font-medium tracking-wide">
                    © {{ date('Y') }} TOKO SITI • Digital POS System
                </div>
            </footer>
        </div>
    </main>
    <!-- Contextual "The Vibrant Merchant" Floating Visuals (Soft Palette) -->
    <div
        class="absolute top-20 right-20 hidden xl:block w-32 h-32 bg-secondary-container/30 rounded-lg -rotate-12 ghost-border">
    </div>
    <div
        class="absolute bottom-20 left-20 hidden xl:block w-48 h-48 bg-primary-container/20 rounded-xl rotate-6 ghost-border">
    </div>
    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const type = password.type === 'password' ? 'text' : 'password';
            password.type = type;
        }

        // Auto dismiss error message after 5 seconds
        setTimeout(() => {
            const errorDiv = document.querySelector('.shake-animation');
            if (errorDiv) {
                errorDiv.style.transition = 'opacity 0.5s ease';
                errorDiv.style.opacity = '0';
                setTimeout(() => {
                    if (errorDiv && errorDiv.remove) errorDiv.remove();
                }, 500);
            }
        }, 5000);
    </script>
</body>

</html>