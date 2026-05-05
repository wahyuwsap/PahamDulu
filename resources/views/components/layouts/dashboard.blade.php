<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard PahamDulu' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@100..900&family=Geist:wght@100..900&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Geist', sans-serif;
        }

        .font-mono {
            font-family: 'Geist Mono', monospace;
        }

        /* Spring Micro-animations */
        .spring-bounce {
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .spring-bounce:hover {
            transform: scale(1.02) translateY(-2px);
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
    <!-- Alpine.js for Dropdown -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body
    class="bg-[#020617] text-slate-200 antialiased min-h-screen flex flex-col selection:bg-[#CCFF00] selection:text-black">

    <!-- Header & Navbar -->
    <header class="sticky top-0 z-50 bg-[#020617]/80 backdrop-blur-xl border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 group cursor-pointer focus:outline-none">
                    <img src="{{ asset('images/PahamDuluPutih.png') }}" alt="PahamDulu Logo"
                        class="w-14 h-14 md:w-16 md:h-16 object-contain drop-shadow-[0_2px_10px_rgba(255,255,255,0.2)] group-hover:scale-110 group-hover:-rotate-2 transition-transform duration-300">
                    <span
                        class="text-2xl md:text-3xl font-extrabold text-white tracking-wider drop-shadow-md">PahamDulu</span>
                </a>

                <!-- Right Side: Profile Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false"
                        class="flex items-center gap-3 focus:outline-none spring-bounce">
                        <div class="text-right hidden md:block">
                            <p class="text-sm font-semibold text-white">{{ auth()->user()->name ?? 'Guest User' }}</p>
                            <p class="text-xs font-mono text-[#00F0FF] uppercase tracking-wider">
                                {{ auth()->user()->role ?? 'Student' }}
                            </p>
                        </div>
                        <div
                            class="w-10 h-10 rounded-full bg-gradient-to-br from-[#CCFF00] to-[#00F0FF] p-0.5 shadow-[0_0_15px_rgba(204,255,0,0.2)]">
                            <img class="w-full h-full rounded-full object-cover border-2 border-[#020617]"
                                src="{{ auth()->user()->avatar_path ? Storage::url(auth()->user()->avatar_path) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name ?? 'User') . '&background=1E293B&color=CCFF00' }}"
                                alt="Avatar">
                        </div>
                    </button>

                    <!-- Dropdown Menu (Glassmorphism) -->
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                        class="absolute right-0 mt-3 w-56 rounded-2xl bg-[#1E293B]/80 backdrop-blur-2xl border border-white/10 shadow-2xl overflow-hidden py-2 z-50">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-slate-300 hover:bg-white/5 hover:text-white transition-colors">Edit
                            Profile</a>
                        <a href="{{ route('profile.password') }}"
                            class="block px-4 py-2 text-sm text-slate-300 hover:bg-white/5 hover:text-white transition-colors">Ganti
                            Sandi</a>
                        <div class="border-t border-slate-700/50 my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-red-500/10 transition-colors font-semibold">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Navbar Tabs -->
            <nav class="flex space-x-8 mt-2 overflow-x-auto no-scrollbar">
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="py-3 px-1 border-b-2 font-medium text-sm transition-colors whitespace-nowrap {{ request()->routeIs('admin.dashboard') ? 'border-[#CCFF00] text-[#CCFF00] shadow-[0_4px_15px_-3px_rgba(204,255,0,0.4)]' : 'border-transparent text-slate-400 hover:text-white hover:border-slate-600' }}">
                        Dashboard Admin
                    </a>
                    <a href="{{ route('admin.users') }}"
                        class="py-3 px-1 border-b-2 font-medium text-sm transition-colors whitespace-nowrap {{ request()->routeIs('admin.users') ? 'border-[#00F0FF] text-[#00F0FF] shadow-[0_4px_15px_-3px_rgba(0,240,255,0.4)]' : 'border-transparent text-slate-400 hover:text-white hover:border-slate-600' }}">
                        Kelola Pengguna
                    </a>
                    <a href="{{ route('admin.modules') }}"
                        class="py-3 px-1 border-b-2 font-medium text-sm transition-colors whitespace-nowrap {{ request()->routeIs('admin.modules') ? 'border-[#00F0FF] text-[#00F0FF] shadow-[0_4px_15px_-3px_rgba(0,240,255,0.4)]' : 'border-transparent text-slate-400 hover:text-white hover:border-slate-600' }}">
                        Kelola Modul
                    </a>
                @else
                    <a href="{{ route('dashboard') }}"
                        class="py-3 px-1 border-b-2 font-medium text-sm transition-colors whitespace-nowrap {{ request()->routeIs('dashboard') ? 'border-[#CCFF00] text-[#CCFF00] shadow-[0_4px_15px_-3px_rgba(204,255,0,0.4)]' : 'border-transparent text-slate-400 hover:text-white hover:border-slate-600' }}">
                        Dashboard
                    </a>
                    <a href="/modul/1"
                        class="py-3 px-1 border-b-2 font-medium text-sm transition-colors whitespace-nowrap {{ request()->is('modul*') ? 'border-[#00F0FF] text-[#00F0FF] shadow-[0_4px_15px_-3px_rgba(0,240,255,0.4)]' : 'border-transparent text-slate-400 hover:text-white hover:border-slate-600' }}">
                        Modul Belajar
                    </a>
                @endif
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{ $slot }}
    </main>

    @livewireScripts
</body>

</html>