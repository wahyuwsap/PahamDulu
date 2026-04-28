<div class="min-h-screen w-full bg-cover bg-center bg-no-repeat relative flex items-center justify-center p-6" style="background-image: url('{{ asset('images/LatarBelakang.png') }}');">
    <!-- Dark Overlay for readability -->
    <div class="absolute inset-0 bg-slate-950/70 backdrop-blur-sm z-0"></div>

    <div class="relative z-10 w-full max-w-5xl flex flex-col md:flex-row items-center justify-between gap-12">
        
        <!-- Left Side: Branding (Logo & Text) -->
        <div class="w-full md:w-1/2 flex flex-col items-center md:items-start text-center md:text-left">
            <div class="flex flex-col items-center md:items-start mb-8 relative">
                <!-- Subtle glow effect behind logo -->
                <div class="absolute top-1/2 left-1/2 md:left-32 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-white/10 rounded-full blur-[80px] pointer-events-none"></div>
                
                <img src="{{ asset('images/PahamDuluPutih.png') }}" alt="PahamDulu Logo" class="w-48 h-48 md:w-64 md:h-64 lg:w-80 lg:h-80 object-contain drop-shadow-[0_20px_40px_rgba(255,255,255,0.2)] transform hover:scale-105 hover:rotate-2 transition-all duration-500 relative z-10">
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-white tracking-widest drop-shadow-[0_5px_15px_rgba(0,0,0,0.5)] relative z-10">PahamDulu</h1>
            </div>
            <h2 class="text-xl md:text-2xl font-semibold text-white/90 mb-3 drop-shadow-md">Sistem Informasi Kampus Akademik</h2>
            <p class="text-sm md:text-base text-white/70 max-w-md font-mono">
                Platform E-Learning terpadu untuk mendukung kegiatan akademik Anda secara digital, interaktif, dan efisien.
            </p>
        </div>

        <!-- Right Side: Form (Bento Card) -->
        <div class="w-full md:w-1/2 flex justify-center md:justify-end">
            <div class="w-full max-w-md bg-[#1E293B]/80 backdrop-blur-xl border border-white/10 rounded-[24px] p-8 shadow-2xl relative overflow-hidden">
                <!-- Decorative subtle glow inside form -->
                <div class="absolute -top-12 -right-12 w-32 h-32 bg-[#CCFF00] rounded-full mix-blend-multiply filter blur-[60px] opacity-20 pointer-events-none"></div>

                <div class="relative z-10 mb-8">
                    <h3 class="text-2xl font-bold text-white tracking-tight">Selamat Datang</h3>
                    <p class="text-slate-400 mt-1 font-mono text-xs">Masuk ke akun Anda untuk melanjutkan</p>
                </div>

                <form wire:submit="login" class="relative z-10 space-y-5">
                    <div>
                        <label for="username" class="block text-xs font-mono text-slate-400 mb-1.5 uppercase tracking-wider">Username</label>
                        <input 
                            wire:model="username" 
                            type="text" 
                            id="username" 
                            class="w-full bg-[#020617]/50 border border-slate-700/50 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#CCFF00]/50 focus:border-[#CCFF00] transition-all duration-300 @error('username') border-red-500 focus:ring-red-500/50 focus:border-red-500 animate-shake @enderror"
                            placeholder="Masukkan username"
                            autocomplete="username"
                        >
                        @error('username') <span class="text-red-400 text-xs mt-1.5 block font-mono animate-shake">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <label for="password" class="block text-xs font-mono text-slate-400 uppercase tracking-wider">Password</label>
                            <a href="#" class="text-xs font-mono text-[#CCFF00] hover:text-white transition-colors">Lupa Password?</a>
                        </div>
                        <input 
                            wire:model="password" 
                            type="password" 
                            id="password" 
                            class="w-full bg-[#020617]/50 border border-slate-700/50 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#CCFF00]/50 focus:border-[#CCFF00] transition-all duration-300 @error('password') border-red-500 focus:ring-red-500/50 focus:border-red-500 animate-shake @enderror"
                            placeholder="••••••••"
                        >
                        @error('password') <span class="text-red-400 text-xs mt-1.5 block font-mono animate-shake">{{ $message }}</span> @enderror
                    </div>

                    <button 
                        type="submit" 
                        class="w-full bg-[#CCFF00] text-black font-bold rounded-xl px-4 py-3.5 mt-2 hover:bg-[#d4ff33] hover:shadow-[0_0_20px_rgba(204,255,0,0.4)] transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2 group"
                    >
                        <span wire:loading.remove wire:target="login">Masuk ke Platform</span>
                        <span wire:loading wire:target="login" class="font-mono text-sm">Memproses...</span>
                        
                        <svg wire:loading.remove wire:target="login" class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>

                <div class="relative z-10 mt-6 pt-5 border-t border-slate-700/50 text-center">
                    <p class="text-xs text-slate-400 font-mono">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-[#CCFF00] font-semibold hover:text-white transition-colors border-b border-[#CCFF00]/30 hover:border-white pb-0.5">Daftar sekarang</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>