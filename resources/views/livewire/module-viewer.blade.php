<div class="w-full">
    <!-- Header Modul -->
    <div class="mb-8 flex justify-between items-end">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="px-2.5 py-1 rounded-md bg-[#00F0FF]/10 text-[#00F0FF] border border-[#00F0FF]/20 text-xs font-mono font-bold uppercase tracking-wider">Modul 1</span>
                <span class="text-slate-500 font-mono text-sm">/</span>
                <span class="text-slate-400 font-mono text-sm">Dasar Pemrograman Web</span>
            </div>
            <h1 class="text-3xl font-bold text-white tracking-tight">Pengenalan HTML5 & CSS3</h1>
        </div>
        <div class="hidden md:flex gap-2">
            <button class="px-4 py-2 rounded-xl bg-[#1E293B] border border-white/10 text-white font-medium hover:bg-white/5 transition-colors text-sm flex items-center gap-2 spring-bounce">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Sebelumnya
            </button>
            <button class="px-4 py-2 rounded-xl bg-[#00F0FF] text-black font-bold hover:bg-[#5cffff] hover:shadow-[0_0_15px_rgba(0,240,255,0.4)] transition-all text-sm flex items-center gap-2 spring-bounce">
                Selanjutnya
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </div>

    <!-- Top Grid: Video & List -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        
        <!-- Left: Video Player -->
        <div class="lg:col-span-2 bg-[#1E293B]/80 backdrop-blur-xl border border-white/5 rounded-[24px] p-6 shadow-xl relative overflow-hidden group">
            <div class="absolute -top-20 -left-20 w-48 h-48 bg-[#00F0FF] rounded-full mix-blend-multiply filter blur-[60px] opacity-10 pointer-events-none"></div>
            
            <h3 class="text-lg font-bold text-white mb-4 relative z-10">Materi Video</h3>
            
            <div class="w-full aspect-video bg-[#020617] rounded-xl border border-slate-700/50 flex flex-col items-center justify-center relative overflow-hidden group-hover:border-white/10 transition-colors">
                <!-- Mock Video Area -->
                <div class="absolute inset-0 bg-gradient-to-br from-[#1E293B] to-[#020617] opacity-50"></div>
                
                <svg class="w-16 h-16 text-slate-600 mb-4 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                
                <p class="text-sm font-mono text-slate-400 relative z-10 mb-6">Video Player (Mockup)</p>
                
                <button wire:click="unlockQuiz" class="relative z-10 px-6 py-2.5 rounded-full bg-[#CCFF00] text-black font-bold text-sm hover:bg-[#d4ff33] hover:shadow-[0_0_20px_rgba(204,255,0,0.4)] transition-all flex items-center gap-2 spring-bounce">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                    Simulasi Putar Video
                </button>
            </div>
            
            <div class="mt-4 text-sm text-slate-400 font-mono relative z-10">
                <p>Klik tombol di atas untuk menyimulasikan selesai menonton video dan membuka kunci kuis di bawah.</p>
            </div>
        </div>

        <!-- Right: Related Modules -->
        <div class="bg-[#1E293B]/80 backdrop-blur-xl border border-white/5 rounded-[24px] p-6 shadow-xl relative overflow-hidden">
            <h3 class="text-lg font-bold text-white mb-4 relative z-10 flex items-center justify-between">
                Daftar Modul
                <span class="text-xs font-mono text-slate-500 bg-[#020617] px-2 py-1 rounded border border-slate-700">1/5 Selesai</span>
            </h3>
            
            <div class="space-y-3 relative z-10">
                <!-- Active Module -->
                <div class="p-3 rounded-xl border border-[#00F0FF]/50 bg-[#00F0FF]/5 flex items-start gap-3 relative overflow-hidden group cursor-pointer spring-bounce">
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#00F0FF] shadow-[0_0_10px_#00F0FF]"></div>
                    <div class="w-8 h-8 rounded-lg bg-[#00F0FF]/20 flex items-center justify-center shrink-0 text-[#00F0FF]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-white">1. Pengenalan HTML5 & CSS3</h4>
                        <p class="text-xs font-mono text-slate-400 mt-0.5">Sedang dipelajari</p>
                    </div>
                </div>

                <!-- Locked Module -->
                <div class="p-3 rounded-xl border border-slate-700/50 bg-[#020617]/30 flex items-start gap-3 cursor-not-allowed opacity-60">
                    <div class="w-8 h-8 rounded-lg bg-[#1E293B] border border-slate-700 flex items-center justify-center shrink-0 text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-slate-300">2. CSS Flexbox & Grid</h4>
                        <p class="text-xs font-mono text-slate-500 mt-0.5">Terkunci</p>
                    </div>
                </div>

                <div class="p-3 rounded-xl border border-slate-700/50 bg-[#020617]/30 flex items-start gap-3 cursor-not-allowed opacity-60">
                    <div class="w-8 h-8 rounded-lg bg-[#1E293B] border border-slate-700 flex items-center justify-center shrink-0 text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-slate-300">3. JavaScript Fundamental</h4>
                        <p class="text-xs font-mono text-slate-500 mt-0.5">Terkunci</p>
                    </div>
                </div>
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

        <div class="relative z-10 flex flex-col md:flex-row justify-between gap-8">
            <!-- Question -->
            <div class="w-full md:w-1/2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-mono font-bold uppercase tracking-wider mb-4">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Evaluasi Pemahaman
                </div>
                
                <h2 class="text-2xl font-bold text-white leading-relaxed">Tag HTML mana yang digunakan untuk menyisipkan gaya CSS secara internal ke dalam halaman web?</h2>
                
                <div class="mt-8 flex items-center gap-4 text-sm font-mono text-slate-400">
                    <span class="flex items-center gap-1"><svg class="w-4 h-4 text-[#CCFF00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> 2 Menit</span>
                    <span>|</span>
                    <span>Soal 1 dari 5</span>
                </div>
            </div>

            <!-- Options -->
            <div class="w-full md:w-1/2 space-y-3">
                @php
                    $options = [
                        'A' => '&lt;style&gt;',
                        'B' => '&lt;script&gt;',
                        'C' => '&lt;css&gt;',
                        'D' => '&lt;link&gt;',
                    ];
                @endphp

                @foreach($options as $key => $text)
                <button 
                    wire:click="submitAnswer('{{ $key }}')"
                    class="w-full text-left p-4 rounded-xl border flex items-center gap-4 transition-all duration-300 spring-bounce overflow-hidden relative
                    @if($selectedAnswer === $key)
                        @if($isCorrect)
                            border-[#CCFF00] bg-[#CCFF00]/10 shadow-[0_0_20px_rgba(204,255,0,0.2)]
                        @else
                            border-red-500 bg-red-500/10 shadow-[0_0_20px_rgba(239,68,68,0.2)]
                        @endif
                    @else
                        border-slate-700/50 bg-[#020617]/50 hover:border-[#00F0FF]/50 hover:bg-[#00F0FF]/5 hover:shadow-[0_0_15px_rgba(0,240,255,0.1)]
                    @endif"
                >
                    <!-- Active indicator bar -->
                    @if($selectedAnswer === $key)
                    <div class="absolute left-0 top-0 bottom-0 w-1 {{ $isCorrect ? 'bg-[#CCFF00] shadow-[0_0_10px_#CCFF00]' : 'bg-red-500 shadow-[0_0_10px_#ef4444]' }}"></div>
                    @endif

                    <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 font-mono font-bold text-sm transition-colors
                    @if($selectedAnswer === $key)
                        {{ $isCorrect ? 'bg-[#CCFF00] text-black' : 'bg-red-500 text-white' }}
                    @else
                        bg-[#1E293B] border border-slate-700 text-slate-400 group-hover:text-white
                    @endif">
                        {{ $key }}
                    </div>
                    <span class="text-white font-medium text-lg">{!! $text !!}</span>
                    
                    @if($selectedAnswer === $key)
                        <div class="ml-auto">
                            @if($isCorrect)
                                <svg class="w-6 h-6 text-[#CCFF00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            @else
                                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            @endif
                        </div>
                    @endif
                </button>
                @endforeach
            </div>
        </div>
    </div>
</div>
