<div>
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">Kelola Modul</h1>
            <p class="text-slate-400">Daftar modul pembelajaran, video YouTube, dan kuis.</p>
        </div>
        <div class="w-full md:w-1/3 flex gap-2">
            <div class="relative flex-grow">
                <input wire:model.live.debounce.300ms="search" type="text"
                    class="w-full bg-[#1E293B]/60 border border-white/10 rounded-xl py-3 pl-4 pr-10 text-white focus:outline-none focus:border-[#00F0FF] focus:ring-1 focus:ring-[#00F0FF] transition-colors"
                    placeholder="Cari modul...">
                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            <button wire:click="openModal"
                class="bg-gradient-to-r from-[#00F0FF] to-[#00F0FF]/80 text-[#020617] font-bold py-3 px-4 rounded-xl shadow-lg hover:shadow-[#00F0FF]/30 transition-all flex-shrink-0">
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
            <div wire:key="module-{{ $module->id }}"
                class="bg-[#1E293B]/60 backdrop-blur-xl border border-white/10 rounded-3xl p-6 relative overflow-hidden flex flex-col group">
                <div
                    class="absolute -right-10 -top-10 w-32 h-32 bg-[#00F0FF]/10 blur-3xl rounded-full group-hover:bg-[#00F0FF]/20 transition-colors duration-500">
                </div>

                <div class="relative z-10 flex-grow">
                    <div class="flex items-start justify-between mb-4">
                        <div
                            class="w-10 h-10 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-slate-300 font-bold">
                            #{{ $module->order }}
                        </div>
                        <button wire:click="confirmDelete({{ $module->id }})"
                            class="text-slate-500 hover:text-red-400 transition-colors bg-white/5 p-2 rounded-lg border border-transparent hover:border-red-400/30">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>

                    <h3 class="text-xl font-bold text-white mb-2 leading-tight">{{ $module->title }}</h3>
                    @if($module->subtitle)
                        <p class="text-sm text-[#00F0FF] mb-4">{{ $module->subtitle }}</p>
                    @endif

                    <div class="flex items-center gap-4 mt-2 mb-4">
                        <span
                            class="flex items-center gap-1 text-xs font-semibold text-slate-300 bg-white/5 px-2 py-1 rounded-md">
                            <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                            </svg>
                            {{ count($module->videos) }} Video
                        </span>
                        <span
                            class="flex items-center gap-1 text-xs font-semibold text-slate-300 bg-white/5 px-2 py-1 rounded-md">
                            <svg class="w-4 h-4 text-[#CCFF00]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ count($module->quizzes) }} Kuis
                        </span>
                    </div>

                    <p class="text-slate-400 text-sm line-clamp-2 mb-6">
                        {{ $module->description ?? 'Tidak ada deskripsi.' }}
                    </p>
                </div>

                <div class="relative z-10 pt-4 border-t border-white/10 flex items-center justify-between mt-auto">
                    <span class="text-xs text-slate-500">{{ $module->created_at->format('d M Y') }}</span>
                    <button wire:click="editModule({{ $module->id }})"
                        class="text-sm font-semibold text-white px-4 py-2 bg-white/5 hover:bg-white/10 rounded-lg border border-white/10 transition-colors">
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
        <template x-teleport="body">
            <div
                class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm overflow-y-auto py-10 px-4">
                <div
                    class="bg-[#1E293B] border border-white/10 w-full max-w-4xl mx-auto rounded-3xl shadow-2xl p-6 md:p-8 relative max-h-[90vh] overflow-y-auto no-scrollbar">

                    <div
                        class="flex justify-between items-center mb-6 border-b border-white/10 pb-4 sticky top-0 bg-[#1E293B] z-[10] pt-6 md:pt-8 -mt-6 md:-mt-8">
                        <h2 class="text-2xl font-bold text-white">{{ $isEditMode ? 'Edit Modul' : 'Tambah Modul Baru' }}
                        </h2>
                        <button type="button" wire:click="closeModal"
                            class="text-slate-400 hover:text-white transition-colors bg-[#020617] rounded-full p-1.5 border border-white/10 hover:bg-white/10">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form wire:submit.prevent="saveModule" class="space-y-8">
                        <!-- Basic Info Section -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-[#00F0FF] flex items-center gap-2">
                                <span
                                    class="w-6 h-6 rounded bg-[#00F0FF]/20 flex items-center justify-center text-sm">1</span>
                                Informasi Modul
                            </h3>
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1">Judul Modul</label>
                                <input wire:model="title" type="text"
                                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-[#00F0FF] focus:ring-1 focus:ring-[#00F0FF] transition-colors">
                                @error('title') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-300 mb-1">Sub Judul</label>
                                    <input wire:model="subtitle" type="text"
                                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-[#00F0FF] focus:ring-1 focus:ring-[#00F0FF] transition-colors">
                                    @error('subtitle') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-300 mb-1">Urutan (Order)</label>
                                    <input wire:model="order" type="number"
                                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-[#00F0FF] focus:ring-1 focus:ring-[#00F0FF] transition-colors">
                                    @error('order') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1">Deskripsi Singkat</label>
                                <textarea wire:model="description" rows="2"
                                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-[#00F0FF] focus:ring-1 focus:ring-[#00F0FF] transition-colors"></textarea>
                                @error('description') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1">Konten Tambahan Lengkap</label>
                                <textarea wire:model="content" rows="4"
                                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-[#00F0FF] focus:ring-1 focus:ring-[#00F0FF] transition-colors"></textarea>
                                @error('content') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Videos Section -->
                        <div class="space-y-4 pt-4 border-t border-white/10">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-red-400 flex items-center gap-2">
                                    <span
                                        class="w-6 h-6 rounded bg-red-400/20 flex items-center justify-center text-sm">2</span>
                                    Video YouTube
                                </h3>
                                <button type="button" wire:click="addVideo"
                                    class="text-xs bg-red-500/20 text-red-400 border border-red-500/30 px-3 py-1.5 rounded-lg hover:bg-red-500/30 transition-colors">+
                                    Tambah Video</button>
                            </div>

                            <div class="space-y-4">
                                @foreach($videos as $index => $video)
                                    <div wire:key="{{ $video['_key'] ?? 'vid_' . $index }}"
                                        class="p-4 rounded-xl border border-white/10 bg-white/5 relative mt-4">
                                        <div class="flex justify-between items-center mb-4 pb-2 border-b border-white/10">
                                            <h4 class="text-sm font-semibold text-white">Video #{{ $index + 1 }}</h4>
                                            <button type="button" wire:click="removeVideo({{ $index }})"
                                                class="flex items-center gap-1 text-xs text-red-400 bg-red-500/10 hover:bg-red-500/20 px-3 py-1.5 rounded-lg transition-colors border border-red-500/30">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg> Hapus
                                            </button>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                            <div class="md:col-span-6">
                                                <label class="block text-xs font-medium text-slate-400 mb-1">Judul Video</label>
                                                <input wire:model="videos.{{ $index }}.title" type="text"
                                                    class="w-full bg-[#020617] border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-red-400 transition-colors">
                                                @error('videos.' . $index . '.title') <span
                                                class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="md:col-span-4">
                                                <label class="block text-xs font-medium text-slate-400 mb-1">YouTube ID (misal:
                                                    dQw4w9WgXcQ)</label>
                                                <input wire:model="videos.{{ $index }}.youtube_id" type="text"
                                                    class="w-full bg-[#020617] border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-red-400 transition-colors">
                                                @error('videos.' . $index . '.youtube_id') <span
                                                class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="md:col-span-2">
                                                <label class="block text-xs font-medium text-slate-400 mb-1">Urutan</label>
                                                <input wire:model="videos.{{ $index }}.order" type="number"
                                                    class="w-full bg-[#020617] border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-red-400 transition-colors">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @if(count($videos) === 0)
                                    <p
                                        class="text-sm text-slate-500 italic text-center py-4 bg-white/5 rounded-xl border border-white/10 border-dashed">
                                        Belum ada video ditambahkan.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Quizzes Section -->
                        <div class="space-y-4 pt-4 border-t border-white/10">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-[#CCFF00] flex items-center gap-2">
                                    <span
                                        class="w-6 h-6 rounded bg-[#CCFF00]/20 flex items-center justify-center text-sm text-[#CCFF00]">3</span>
                                    Soal Kuis
                                </h3>
                                <button type="button" wire:click="addQuiz"
                                    class="text-xs bg-[#CCFF00]/10 text-[#CCFF00] border border-[#CCFF00]/30 px-3 py-1.5 rounded-lg hover:bg-[#CCFF00]/20 transition-colors">+
                                    Tambah Soal</button>
                            </div>

                            <div class="space-y-6">
                                @foreach($quizzes as $index => $quiz)
                                    <div wire:key="{{ $quiz['_key'] ?? 'quiz_' . $index }}"
                                        class="p-5 rounded-xl border border-[#CCFF00]/20 bg-white/5 relative mt-4">
                                        <div class="flex justify-between items-center mb-4 pb-2 border-b border-white/10">
                                            <h4 class="text-sm font-semibold text-[#CCFF00]">Soal Kuis #{{ $index + 1 }}</h4>
                                            <button type="button" wire:click="removeQuiz({{ $index }})"
                                                class="flex items-center gap-1 text-xs text-red-400 bg-red-500/10 hover:bg-red-500/20 px-3 py-1.5 rounded-lg transition-colors border border-red-500/30">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg> Hapus
                                            </button>
                                        </div>

                                        <div class="space-y-4">
                                            <div>
                                                <label class="block text-xs font-medium text-slate-400 mb-1">Pertanyaan</label>
                                                <textarea wire:model="quizzes.{{ $index }}.question" rows="2"
                                                    class="w-full bg-[#020617] border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-[#CCFF00] transition-colors"></textarea>
                                                @error('quizzes.' . $index . '.question') <span
                                                class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-sm font-bold text-slate-500 w-6">A.</span>
                                                    <input wire:model="quizzes.{{ $index }}.option_a" type="text"
                                                        class="w-full bg-[#020617] border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-[#CCFF00] transition-colors">
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <span class="text-sm font-bold text-slate-500 w-6">B.</span>
                                                    <input wire:model="quizzes.{{ $index }}.option_b" type="text"
                                                        class="w-full bg-[#020617] border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-[#CCFF00] transition-colors">
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <span class="text-sm font-bold text-slate-500 w-6">C.</span>
                                                    <input wire:model="quizzes.{{ $index }}.option_c" type="text"
                                                        class="w-full bg-[#020617] border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-[#CCFF00] transition-colors">
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <span class="text-sm font-bold text-slate-500 w-6">D.</span>
                                                    <input wire:model="quizzes.{{ $index }}.option_d" type="text"
                                                        class="w-full bg-[#020617] border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-[#CCFF00] transition-colors">
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block text-xs font-medium text-slate-400 mb-1">Jawaban
                                                    Benar</label>
                                                <select wire:model="quizzes.{{ $index }}.correct_answer"
                                                    class="w-full md:w-1/3 bg-[#020617] border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-[#CCFF00] transition-colors">
                                                    <option value="a">A</option>
                                                    <option value="b">B</option>
                                                    <option value="c">C</option>
                                                    <option value="d">D</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @if(count($quizzes) === 0)
                                    <p
                                        class="text-sm text-slate-500 italic text-center py-4 bg-white/5 rounded-xl border border-white/10 border-dashed">
                                        Belum ada soal kuis ditambahkan.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Footer / Submit -->
                        <div
                            class="pt-6 border-t border-white/10 flex justify-end gap-3 sticky bottom-0 bg-[#1E293B] pb-2 z-[5]">
                            <button type="button" wire:click="closeModal"
                                class="px-5 py-2.5 rounded-xl border border-white/10 text-slate-300 hover:bg-white/5 transition-colors">Batal</button>
                            <button type="submit"
                                class="px-5 py-2.5 rounded-xl bg-[#00F0FF] text-[#020617] font-bold shadow-[0_0_15px_rgba(0,240,255,0.4)] hover:scale-105 transition-transform">
                                {{ $isEditMode ? 'Simpan Perubahan Modul' : 'Buat Modul Sekarang' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    @endif

    @script
    <script>
        $wire.on('swal:confirm-delete', () => {
            Swal.fire({
                title: 'DELETE',
                text: "Hapus Data Modul Ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Yes, delete!',
                cancelButtonText: 'Cancel',
                background: '#1E293B',
                color: '#ffffff',
                customClass: {
                    popup: 'border border-slate-700 rounded-3xl shadow-2xl',
                },
                backdrop: `
                    rgba(0,0,0,0.6)
                    backdrop-filter: blur(8px)
                `
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.deleteModule()
                }
            });
        });
    </script>
    @endscript
</div>