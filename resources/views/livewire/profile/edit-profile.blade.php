<div class="w-full max-w-2xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white tracking-tight">Edit Profil</h1>
        <p class="text-slate-400 font-mono text-sm mt-1">Perbarui informasi pribadi akun Anda.</p>
    </div>

    @if (session()->has('message'))
        <div
            class="mb-6 p-4 rounded-xl bg-[#CCFF00]/10 border border-[#CCFF00]/20 text-[#CCFF00] font-mono text-sm flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ session('message') }}
        </div>
    @endif

    <div
        class="bg-[#1E293B]/80 backdrop-blur-xl border border-white/5 rounded-[24px] p-8 shadow-xl relative overflow-hidden group">
        <div
            class="absolute -top-10 -right-10 w-32 h-32 bg-[#00F0FF] rounded-full mix-blend-multiply filter blur-[50px] opacity-10 pointer-events-none">
        </div>

        <form wire:submit="save" class="space-y-6 relative z-10">
            <!-- Avatar Upload Section -->
            <div class="flex flex-col items-center mb-8">
                <div class="relative group/avatar">
                    <div
                        class="w-32 h-32 rounded-full p-1 bg-gradient-to-br from-[#CCFF00] to-[#00F0FF] shadow-[0_0_20px_rgba(204,255,0,0.2)]">
                        @if ($avatar)
                            <img src="{{ $avatar->temporaryUrl() }}"
                                class="w-full h-full rounded-full object-cover border-4 border-[#020617]">
                        @elseif ($current_avatar_path)
                            <img src="{{ Storage::url($current_avatar_path) }}"
                                class="w-full h-full rounded-full object-cover border-4 border-[#020617]">
                        @else
                            <div
                                class="w-full h-full rounded-full bg-[#1E293B] border-4 border-[#020617] flex items-center justify-center">
                                <span class="text-4xl font-bold text-[#CCFF00]">{{ substr($name, 0, 2) }}</span>
                            </div>
                        @endif
                    </div>

                    <label for="avatar"
                        class="absolute bottom-0 right-0 w-10 h-10 bg-[#CCFF00] rounded-full flex items-center justify-center cursor-pointer border-4 border-[#020617] hover:scale-110 transition-transform shadow-lg">
                        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <input type="file" id="avatar" wire:model="avatar" class="hidden" accept="image/*">
                    </label>
                </div>
                <p class="text-xs font-mono text-slate-500 mt-4 uppercase tracking-widest">Klik ikon kamera untuk ganti
                    foto</p>
                @error('avatar') <span class="text-red-400 text-xs mt-1 font-mono">{{ $message }}</span> @enderror

                <div wire:loading wire:target="avatar" class="mt-2 text-[#CCFF00] text-xs font-mono animate-pulse">
                    Mengunggah...
                </div>
            </div>
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-bold text-slate-300 uppercase tracking-wider mb-2">Nama
                    Lengkap</label>
                <input wire:model="name" type="text" id="name"
                    class="w-full bg-[#020617]/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-[#CCFF00] focus:border-transparent transition-all outline-none">
                @error('name') <span class="text-red-400 text-xs mt-1 font-mono">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Username -->
                <div>
                    <label for="username"
                        class="block text-sm font-bold text-slate-300 uppercase tracking-wider mb-2">Username</label>
                    <input wire:model="username" type="text" id="username"
                        class="w-full bg-[#020617]/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-[#CCFF00] focus:border-transparent transition-all outline-none">
                    @error('username') <span class="text-red-400 text-xs mt-1 font-mono">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email"
                        class="block text-sm font-bold text-slate-300 uppercase tracking-wider mb-2">Email</label>
                    <input wire:model="email" type="email" id="email"
                        class="w-full bg-[#020617]/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-[#CCFF00] focus:border-transparent transition-all outline-none">
                    @error('email') <span class="text-red-400 text-xs mt-1 font-mono">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Asal Instansi -->
            <div>
                <label for="asal_instansi"
                    class="block text-sm font-bold text-slate-300 uppercase tracking-wider mb-2">Asal Instansi</label>
                <input wire:model="asal_instansi" type="text" id="asal_instansi"
                    class="w-full bg-[#020617]/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-[#CCFF00] focus:border-transparent transition-all outline-none">
                @error('asal_instansi') <span class="text-red-400 text-xs mt-1 font-mono">{{ $message }}</span>
                @enderror
            </div>

            <!-- Negara -->
            <div>
                <label for="negara"
                    class="block text-sm font-bold text-slate-300 uppercase tracking-wider mb-2">Negara</label>
                <input wire:model="negara" type="text" id="negara"
                    class="w-full bg-[#020617]/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-[#CCFF00] focus:border-transparent transition-all outline-none">
                @error('negara') <span class="text-red-400 text-xs mt-1 font-mono">{{ $message }}</span> @enderror
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="w-full py-4 rounded-xl bg-[#CCFF00] text-black font-bold hover:bg-[#d4ff33] hover:shadow-[0_0_20px_rgba(204,255,0,0.4)] transition-all flex items-center justify-center gap-2 spring-bounce">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>