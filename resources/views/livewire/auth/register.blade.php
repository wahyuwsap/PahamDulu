<div class="min-h-screen w-full bg-cover bg-center bg-no-repeat relative flex items-center justify-center p-6" style="background-image: url('{{ asset('images/LatarBelakang.png') }}');">
    <!-- Dark Overlay for readability -->
    <div class="absolute inset-0 bg-slate-950/70 backdrop-blur-sm z-0"></div>

    <div class="relative z-10 w-full max-w-6xl flex flex-col md:flex-row items-center justify-between gap-12">
        
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
                Platform E-Learning terpadu untuk mendukung kegiatan akademik Anda secara digital, interaktif, dan efisien. Mari bergabung bersama ribuan pengguna lainnya.
            </p>
        </div>

        <!-- Right Side: Form (Bento Card) -->
        <div class="w-full md:w-1/2 flex justify-center md:justify-end">
            <div class="w-full max-w-xl bg-[#1E293B]/80 backdrop-blur-xl border border-white/10 rounded-[24px] p-6 sm:p-8 shadow-2xl relative overflow-hidden">
                <!-- Decorative subtle glow inside form -->
                <div class="absolute -top-12 -left-12 w-32 h-32 bg-[#00F0FF] rounded-full mix-blend-multiply filter blur-[60px] opacity-20 pointer-events-none"></div>

                <div class="relative z-10 mb-6">
                    <h3 class="text-2xl font-bold text-white tracking-tight">Buat Akun Baru</h3>
                    <p class="text-slate-400 mt-1 font-mono text-xs">Lengkapi data diri Anda di bawah ini</p>
                </div>

                <form wire:submit="register" class="relative z-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Nama Lengkap -->
                        <div class="md:col-span-2">
                            <label for="name" class="block text-xs font-mono text-slate-400 mb-1.5 uppercase tracking-wider">Nama Lengkap</label>
                            <input 
                                wire:model="name" 
                                type="text" 
                                id="name" 
                                class="w-full bg-[#020617]/50 border border-slate-700/50 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#00F0FF]/50 focus:border-[#00F0FF] transition-all duration-300 @error('name') border-red-500 focus:ring-red-500/50 focus:border-red-500 animate-shake @enderror"
                                placeholder="John Doe"
                            >
                            @error('name') <span class="text-red-400 text-xs mt-1.5 block font-mono animate-shake">{{ $message }}</span> @enderror
                        </div>

                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-xs font-mono text-slate-400 mb-1.5 uppercase tracking-wider">Username</label>
                            <input 
                                wire:model="username" 
                                type="text" 
                                id="username" 
                                class="w-full bg-[#020617]/50 border border-slate-700/50 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#00F0FF]/50 focus:border-[#00F0FF] transition-all duration-300 @error('username') border-red-500 focus:ring-red-500/50 focus:border-red-500 animate-shake @enderror"
                                placeholder="johndoe123"
                            >
                            @error('username') <span class="text-red-400 text-xs mt-1.5 block font-mono animate-shake">{{ $message }}</span> @enderror
                        </div>

                        <!-- Asal Instansi -->
                        <div>
                            <label for="asal_instansi" class="block text-xs font-mono text-slate-400 mb-1.5 uppercase tracking-wider">Asal Instansi</label>
                            <input 
                                wire:model="asal_instansi" 
                                type="text" 
                                id="asal_instansi" 
                                class="w-full bg-[#020617]/50 border border-slate-700/50 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#00F0FF]/50 focus:border-[#00F0FF] transition-all duration-300 @error('asal_instansi') border-red-500 focus:ring-red-500/50 focus:border-red-500 animate-shake @enderror"
                                placeholder="Universitas / Sekolah"
                            >
                            @error('asal_instansi') <span class="text-red-400 text-xs mt-1.5 block font-mono animate-shake">{{ $message }}</span> @enderror
                        </div>



                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-xs font-mono text-slate-400 mb-1.5 uppercase tracking-wider">Password</label>
                            <input 
                                wire:model="password" 
                                type="password" 
                                id="password" 
                                class="w-full bg-[#020617]/50 border border-slate-700/50 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#00F0FF]/50 focus:border-[#00F0FF] transition-all duration-300 @error('password') border-red-500 focus:ring-red-500/50 focus:border-red-500 animate-shake @enderror"
                                placeholder="Min. 8 karakter"
                            >
                            @error('password') <span class="text-red-400 text-xs mt-1.5 block font-mono animate-shake">{{ $message }}</span> @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div>
                            <label for="password_confirmation" class="block text-xs font-mono text-slate-400 mb-1.5 uppercase tracking-wider">Konfirmasi Password</label>
                            <input 
                                wire:model="password_confirmation" 
                                type="password" 
                                id="password_confirmation" 
                                class="w-full bg-[#020617]/50 border border-slate-700/50 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-[#00F0FF]/50 focus:border-[#00F0FF] transition-all duration-300"
                                placeholder="Ketik ulang"
                            >
                        </div>
                    </div>

                    <div class="mt-6">
                        <button 
                            type="submit" 
                            class="w-full bg-[#00F0FF] text-black font-bold rounded-xl px-4 py-3.5 hover:bg-[#5cffff] hover:shadow-[0_0_20px_rgba(0,240,255,0.4)] transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2 group"
                        >
                            <span wire:loading.remove wire:target="register">Daftar Akun Sekarang</span>
                            <span wire:loading wire:target="register" class="font-mono text-sm">Memproses...</span>
                            
                            <svg wire:loading.remove wire:target="register" class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </form>

                <div class="relative z-10 mt-6 pt-5 border-t border-slate-700/50 text-center">
                    <p class="text-xs text-slate-400 font-mono">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-[#00F0FF] font-semibold hover:text-white transition-colors border-b border-[#00F0FF]/30 hover:border-white pb-0.5">Masuk di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
