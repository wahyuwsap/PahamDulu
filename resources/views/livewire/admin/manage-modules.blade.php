<div>
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">Kelola Modul</h1>
            <p class="text-slate-400">Daftar modul pembelajaran yang tersedia di platform.</p>
        </div>
        <div class="w-full md:w-1/3 flex gap-2">
            <div class="relative flex-grow">
                <input wire:model.live="search" type="text"
                    class="w-full bg-[#1E293B]/60 border border-white/10 rounded-xl py-3 pl-4 pr-10 text-white focus:outline-none focus:border-[#00F0FF] focus:ring-1 focus:ring-[#00F0FF] transition-colors"
                    placeholder="Cari modul...">
                <div class="absolute right-3 top-3.5 text-slate-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            <button wire:click="openModal" class="bg-gradient-to-r from-[#00F0FF] to-[#00F0FF]/80 text-[#020617] font-bold py-3 px-4 rounded-xl shadow-lg hover:shadow-[#00F0FF]/30 transition-all">
                + Tambah
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 rounded-xl bg-green-500/20 border border-green-500/50 text-green-400">
            {{ session('message') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($modules as $module)
            <div class="bg-[#1E293B]/60 backdrop-blur-xl border border-white/10 rounded-3xl p-6 relative overflow-hidden flex flex-col group">
                <!-- Decorative background glow -->
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-[#00F0FF]/10 blur-3xl rounded-full group-hover:bg-[#00F0FF]/20 transition-colors duration-500"></div>
                
                <div class="relative z-10 flex-grow">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-10 h-10 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-slate-300 font-bold">
                            #{{ $module->order }}
                        </div>
                        <button wire:click="deleteModule({{ $module->id }})" wire:confirm="Apakah Anda yakin ingin menghapus modul ini?" class="text-slate-500 hover:text-red-400 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                    
                    <h3 class="text-xl font-bold text-white mb-2 leading-tight">{{ $module->title }}</h3>
                    @if($module->subtitle)
                        <p class="text-sm text-[#00F0FF] mb-4">{{ $module->subtitle }}</p>
                    @endif
                    
                    <p class="text-slate-400 text-sm line-clamp-3 mb-6">
                        {{ $module->description ?? 'Tidak ada deskripsi.' }}
                    </p>
                </div>
                
                <div class="relative z-10 pt-4 border-t border-white/10 flex items-center justify-between mt-auto">
                    <span class="text-xs text-slate-500">{{ $module->created_at->format('d M Y') }}</span>
                    <button wire:click="editModule({{ $module->id }})" class="text-sm font-semibold text-white px-4 py-2 bg-white/5 hover:bg-white/10 rounded-lg border border-white/10 transition-colors">
                        Edit Modul
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center p-12 bg-[#1E293B]/40 border border-white/10 rounded-3xl">
                <p class="text-slate-400 text-lg">Belum ada modul yang tersedia.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $modules->links() }}
    </div>

    <!-- Modal Form -->
    @if($isModalOpen)
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm overflow-y-auto pt-10 pb-10">
            <div class="bg-[#1E293B] border border-white/10 w-full max-w-2xl mx-4 rounded-3xl shadow-2xl p-6 relative">
                <button wire:click="closeModal" class="absolute top-4 right-4 text-slate-400 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <h2 class="text-2xl font-bold text-white mb-6">{{ $isEditMode ? 'Edit Modul' : 'Tambah Modul Baru' }}</h2>
                
                <form wire:submit.prevent="saveModule" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1">Judul Modul</label>
                        <input wire:model="title" type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-[#00F0FF] focus:ring-1 focus:ring-[#00F0FF] transition-colors">
                        @error('title') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-1">Sub Judul</label>
                            <input wire:model="subtitle" type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-[#00F0FF] focus:ring-1 focus:ring-[#00F0FF] transition-colors">
                            @error('subtitle') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-1">Urutan (Order)</label>
                            <input wire:model="order" type="number" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-[#00F0FF] focus:ring-1 focus:ring-[#00F0FF] transition-colors">
                            @error('order') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1">Deskripsi Singkat</label>
                        <textarea wire:model="description" rows="3" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-[#00F0FF] focus:ring-1 focus:ring-[#00F0FF] transition-colors"></textarea>
                        @error('description') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1">Konten Lengkap</label>
                        <textarea wire:model="content" rows="6" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-[#00F0FF] focus:ring-1 focus:ring-[#00F0FF] transition-colors"></textarea>
                        @error('content') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="pt-4 flex justify-end gap-3">
                        <button type="button" wire:click="closeModal" class="px-5 py-2.5 rounded-xl border border-white/10 text-slate-300 hover:bg-white/5 transition-colors">Batal</button>
                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#00F0FF] text-[#020617] font-bold shadow-[0_0_15px_rgba(0,240,255,0.4)] hover:scale-105 transition-transform">
                            {{ $isEditMode ? 'Simpan Perubahan' : 'Tambah Modul' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
