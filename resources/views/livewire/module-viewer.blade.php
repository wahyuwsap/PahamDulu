<div class="w-full">
    <!-- Header Modul -->
    <div class="mb-8 flex flex-col md:flex-row md:justify-between md:items-end gap-4">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="px-2.5 py-1 rounded-md bg-[#00F0FF]/10 text-[#00F0FF] border border-[#00F0FF]/20 text-xs font-mono font-bold uppercase tracking-wider">{{ $activeModule->title }}</span>
                <span class="text-slate-500 font-mono text-sm">/</span>
                <select wire:change="changeModule($event.target.value)" class="bg-[#1E293B] border border-slate-700/50 text-slate-300 text-sm rounded-lg focus:ring-[#00F0FF] focus:border-[#00F0FF] block px-2.5 py-1 font-mono">
                    @foreach($modules as $m)
                        <option value="{{ $m->id }}" {{ $activeModule->id == $m->id ? 'selected' : '' }}>{{ $m->subtitle }}</option>
                    @endforeach
                </select>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-white tracking-tight">{{ $activeVideo ? $activeVideo->title : 'Belum ada video' }}</h1>
        </div>
        <div class="hidden md:flex gap-2">
            <!-- Buttons dipindahkan ke bawah -->
        </div>
    </div>

    <!-- Top Grid: Video & List -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        
        <!-- Left: Video Player -->
        <div class="lg:col-span-2 bg-[#1E293B]/80 backdrop-blur-xl border border-white/5 rounded-[24px] p-6 shadow-xl relative overflow-hidden group">
            <div class="absolute -top-20 -left-20 w-48 h-48 bg-[#00F0FF] rounded-full mix-blend-multiply filter blur-[60px] opacity-10 pointer-events-none"></div>
            
            <h3 class="text-lg font-bold text-white mb-4 relative z-10">Materi Video</h3>
            
            <div class="w-full aspect-video bg-[#020617] rounded-xl border border-slate-700/50 flex flex-col items-center justify-center relative overflow-hidden group-hover:border-white/10 transition-colors">
                @if($activeVideo)
                    <iframe class="w-full h-full absolute inset-0" src="https://www.youtube.com/embed/{{ $activeVideo->youtube_id }}" title="{{ $activeVideo->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                @else
                    <p class="text-slate-500 font-mono">Belum ada video di modul ini.</p>
                @endif
            </div>
            
            <div class="mt-4 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 relative z-10">
                <p class="text-sm text-slate-400 font-mono">
                    Pastikan Anda memahami seluruh isi materi video sebelum lanjut ke kuis di bawah.
                </p>
                @if(!$isQuizUnlocked)
                <button wire:click="unlockQuiz" class="px-6 py-2 rounded-full bg-[#CCFF00] text-black font-bold text-sm hover:bg-[#d4ff33] hover:shadow-[0_0_20px_rgba(204,255,0,0.4)] transition-all flex items-center gap-2 spring-bounce shrink-0">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                    Tandai Selesai Ditonton
                </button>
                @else
                <div class="px-6 py-2 rounded-full bg-[#00F0FF]/20 text-[#00F0FF] font-bold text-sm border border-[#00F0FF]/30 shrink-0 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Video Selesai
                </div>
                @endif
            </div>
        </div>

        <!-- Right: Related Modules -->
        <div class="bg-[#1E293B]/80 backdrop-blur-xl border border-white/5 rounded-[24px] p-6 shadow-xl relative overflow-hidden">
            <h3 class="text-lg font-bold text-white mb-4 relative z-10 flex items-center justify-between">
                Daftar Video
                <span class="text-xs font-mono text-slate-500 bg-[#020617] px-2 py-1 rounded border border-slate-700">{{ $activeModule->videos->count() }} Video</span>
            </h3>
            
            <div class="space-y-3 relative z-10">
                @foreach($activeModule->videos as $index => $video)
                <div wire:click="changeVideo({{ $video->id }})" class="p-3 rounded-xl border {{ $activeVideo && $activeVideo->id === $video->id ? 'border-[#00F0FF]/50 bg-[#00F0FF]/5' : 'border-slate-700/50 bg-[#020617]/30 hover:border-slate-500 hover:bg-[#1E293B]/50' }} flex items-start gap-3 relative overflow-hidden group cursor-pointer spring-bounce transition-all">
                    
                    @if($activeVideo && $activeVideo->id === $video->id)
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#00F0FF] shadow-[0_0_10px_#00F0FF]"></div>
                    @endif

                    <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 {{ $activeVideo && $activeVideo->id === $video->id ? 'bg-[#00F0FF]/20 text-[#00F0FF]' : 'bg-[#1E293B] border border-slate-700 text-slate-400 group-hover:text-white' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold {{ $activeVideo && $activeVideo->id === $video->id ? 'text-white' : 'text-slate-300 group-hover:text-white' }}">{{ $index + 1 }}. {{ $video->title }}</h4>
                        <p class="text-xs font-mono {{ $activeVideo && $activeVideo->id === $video->id ? 'text-[#00F0FF]' : 'text-slate-500' }} mt-0.5">
                            {{ $activeVideo && $activeVideo->id === $video->id ? 'Sedang diputar' : 'Tonton' }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>

    <!-- Bottom: Quiz Section -->
    <div class="bg-[#1E293B]/80 backdrop-blur-xl border border-white/5 rounded-[24px] p-6 md:p-10 shadow-xl relative overflow-hidden group">
        
        <!-- Lock Overlay (Glassmorphism) -->
        @if(!$isQuizUnlocked)
        <div class="absolute inset-0 z-20 bg-[#020617]/60 backdrop-blur-md flex flex-col items-center justify-center border border-white/5 transition-all duration-500">
            <div class="w-16 h-16 rounded-2xl bg-[#1E293B] border border-slate-700 shadow-2xl flex items-center justify-center mb-4 spring-bounce">
                <svg class="w-8 h-8 text-[#00F0FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Kuis Terkunci</h3>
            <p class="text-sm font-mono text-slate-400 text-center max-w-sm">Anda harus menonton materi video di atas hingga selesai untuk membuka kuis ini.</p>
        </div>
        @endif

        <div class="relative z-10 space-y-12">
            @foreach($this->paginatedQuizzes as $index => $quiz)
            <div class="flex flex-col md:flex-row justify-between gap-8 border-b border-white/5 pb-8 last:border-0 last:pb-0">
                <!-- Question -->
                <div class="w-full md:w-1/2">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-mono font-bold uppercase tracking-wider mb-4">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Soal {{ ($currentPage - 1) * $perPage + $loop->iteration }} dari {{ $activeModule->quizzes->count() }}
                    </div>
                    
                    <h2 class="text-xl md:text-2xl font-bold text-white leading-relaxed">{{ $quiz->question }}</h2>
                </div>

                <!-- Options -->
                <div class="w-full md:w-1/2 space-y-3">
                    @php
                        $options = [
                            'A' => $quiz->option_a,
                            'B' => $quiz->option_b,
                            'C' => $quiz->option_c,
                            'D' => $quiz->option_d,
                        ];
                    @endphp

                    @foreach($options as $key => $text)
                    <button 
                        wire:click="selectAnswer({{ $quiz->id }}, '{{ $key }}')"
                        class="w-full text-left p-4 rounded-xl border flex items-center gap-4 transition-all duration-300 spring-bounce overflow-hidden relative
                        @if(isset($userAnswers[$quiz->id]) && $userAnswers[$quiz->id] === $key)
                            border-[#CCFF00] bg-[#CCFF00]/10 shadow-[0_0_20px_rgba(204,255,0,0.2)]
                        @else
                            border-slate-700/50 bg-[#020617]/50 hover:border-[#00F0FF]/50 hover:bg-[#00F0FF]/5 hover:shadow-[0_0_15px_rgba(0,240,255,0.1)]
                        @endif"
                    >
                        @if(isset($userAnswers[$quiz->id]) && $userAnswers[$quiz->id] === $key)
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#CCFF00] shadow-[0_0_10px_#CCFF00]"></div>
                        @endif

                        <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 font-mono font-bold text-sm transition-colors
                        @if(isset($userAnswers[$quiz->id]) && $userAnswers[$quiz->id] === $key)
                            bg-[#CCFF00] text-black
                        @else
                            bg-[#1E293B] border border-slate-700 text-slate-400 group-hover:text-white
                        @endif">
                            {{ $key }}
                        </div>
                        <span class="text-white font-medium text-base md:text-lg">{{ $text }}</span>
                    </button>
                    @endforeach
                </div>
            </div>
            @endforeach

            <!-- Pagination & Submit Controls -->
            <div class="pt-6 mt-6 flex flex-col md:flex-row justify-between items-center gap-4 border-t border-white/10">
                <div class="text-sm text-slate-400 font-mono">
                    Halaman {{ $currentPage }} dari {{ $this->totalPages }}
                </div>
                <div class="flex gap-2">
                    @if($currentPage > 1)
                    <button wire:click="prevPage" class="px-6 py-2 rounded-xl bg-[#1E293B] border border-white/10 text-white font-medium hover:bg-white/5 transition-colors text-sm flex items-center gap-2 spring-bounce">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        Sebelumnya
                    </button>
                    @endif

                    @if($currentPage < $this->totalPages)
                    <button wire:click="nextPage" class="px-6 py-2 rounded-xl bg-[#00F0FF] text-black font-bold hover:bg-[#5cffff] hover:shadow-[0_0_15px_rgba(0,240,255,0.4)] transition-all text-sm flex items-center gap-2 spring-bounce">
                        Selanjutnya
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                    @else
                    <button wire:click="submitQuiz" class="px-6 py-2 rounded-xl bg-[#CCFF00] text-black font-bold hover:bg-[#d4ff33] hover:shadow-[0_0_20px_rgba(204,255,0,0.4)] transition-all text-sm flex items-center gap-2 spring-bounce">
                        Selesai & Lihat Skor
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Score Modal -->
    @if($showScoreModal)
    <div class="fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-[#020617]/80 backdrop-blur-sm"></div>
        <div class="relative bg-[#1E293B] border border-white/10 rounded-3xl p-8 max-w-md w-full shadow-2xl text-center transform transition-all scale-100 opacity-100">
            <div class="w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-6 {{ $finalScore >= 70 ? 'bg-[#CCFF00]/20 text-[#CCFF00] shadow-[0_0_30px_rgba(204,255,0,0.3)]' : 'bg-red-500/20 text-red-400 shadow-[0_0_30px_rgba(239,68,68,0.3)]' }}">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    @if($finalScore >= 70)
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    @else
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    @endif
                </svg>
            </div>
            
            <h2 class="text-3xl font-bold text-white mb-2">Evaluasi Selesai!</h2>
            <p class="text-slate-400 mb-6 font-mono text-sm">Skor Anda telah disimpan di sistem SIKA.</p>
            
            <div class="text-7xl font-extrabold tracking-tighter mb-8 {{ $finalScore >= 70 ? 'text-[#CCFF00] drop-shadow-[0_0_15px_rgba(204,255,0,0.5)]' : 'text-red-400 drop-shadow-[0_0_15px_rgba(239,68,68,0.5)]' }}">
                {{ $finalScore }}
            </div>

            <a href="{{ route('dashboard') }}" class="block w-full py-3 rounded-xl bg-white text-black font-bold hover:bg-slate-200 transition-colors spring-bounce">
                Kembali ke Dashboard
            </a>
        </div>
    </div>
    @endif
</div>
