<div class="w-full max-w-xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white tracking-tight">Ganti Sandi</h1>
        <p class="text-slate-400 font-mono text-sm mt-1">Pastikan Anda menggunakan kata sandi yang kuat untuk keamanan akun.</p>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 rounded-xl bg-[#CCFF00]/10 border border-[#CCFF00]/20 text-[#CCFF00] font-mono text-sm flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-[#1E293B]/80 backdrop-blur-xl border border-white/5 rounded-[24px] p-8 shadow-xl relative overflow-hidden group">
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-purple-500 rounded-full mix-blend-multiply filter blur-[50px] opacity-10 pointer-events-none"></div>

        <form wire:submit="updatePassword" class="space-y-6 relative z-10">
            <!-- Current Password -->
            <div>
                <label for="current_password" class="block text-sm font-bold text-slate-300 uppercase tracking-wider mb-2">Kata Sandi Saat Ini</label>
                <input wire:model="current_password" type="password" id="current_password" class="w-full bg-[#020617]/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-[#CCFF00] focus:border-transparent transition-all outline-none">
                @error('current_password') <span class="text-red-400 text-xs mt-1 font-mono">{{ $message }}</span> @enderror
            </div>

            <hr class="border-white/5">

            <!-- New Password -->
            <div>
                <label for="password" class="block text-sm font-bold text-slate-300 uppercase tracking-wider mb-2">Kata Sandi Baru</label>
                <input wire:model="password" type="password" id="password" class="w-full bg-[#020617]/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-[#CCFF00] focus:border-transparent transition-all outline-none">
                @error('password') <span class="text-red-400 text-xs mt-1 font-mono">{{ $message }}</span> @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-bold text-slate-300 uppercase tracking-wider mb-2">Konfirmasi Kata Sandi Baru</label>
                <input wire:model="password_confirmation" type="password" id="password_confirmation" class="w-full bg-[#020617]/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-[#CCFF00] focus:border-transparent transition-all outline-none">
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-4 rounded-xl bg-[#00F0FF] text-black font-bold hover:bg-[#5cffff] hover:shadow-[0_0_20px_rgba(0,240,255,0.4)] transition-all flex items-center justify-center gap-2 spring-bounce">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    Perbarui Kata Sandi
                </button>
            </div>
        </form>
    </div>
</div>
