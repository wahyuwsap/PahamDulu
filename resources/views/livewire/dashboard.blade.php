<div class="w-full">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white tracking-tight">Overview Akademi</h1>
        <p class="text-slate-400 font-mono text-sm mt-1">Pantau perkembangan dan statistik belajarmu hari ini.</p>
    </div>

    <!-- The Bento Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Card 1: Total Score -->
        <div
            class="bg-[#1E293B]/80 backdrop-blur-xl border border-white/5 rounded-[24px] p-6 shadow-xl relative overflow-hidden group spring-bounce cursor-default hover:border-white/10 hover:shadow-[0_10px_30px_rgba(0,0,0,0.5)]">
            <div
                class="absolute -top-10 -right-10 w-24 h-24 bg-[#CCFF00] rounded-full mix-blend-multiply filter blur-[40px] opacity-20 group-hover:opacity-40 transition-opacity">
            </div>

            <div class="flex items-center justify-between mb-4 relative z-10">
                <h3 class="text-sm font-semibold text-slate-300 uppercase tracking-wider">Total Score</h3>
                <div
                    class="w-8 h-8 rounded-full bg-[#CCFF00]/10 flex items-center justify-center border border-[#CCFF00]/20">
                    <svg class="w-4 h-4 text-[#CCFF00]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
            </div>

            <div class="relative z-10">
                <span
                    class="text-5xl font-extrabold text-white font-mono tracking-tighter group-hover:text-[#CCFF00] transition-colors drop-shadow-md">
                    {{ $totalScore }}
                </span>
                <p class="text-xs text-slate-500 mt-2 font-mono flex items-center gap-1">
                    @if($completedCount > 0)
                        <svg class="w-3 h-3 text-[#CCFF00]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ $completedCount }}/{{ $totalModules }} modul selesai
                    @else
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                        Belum ada progres
                    @endif
                </p>
            </div>
        </div>

        <!-- Card 2: Ranking User -->
        <div
            class="bg-[#1E293B]/80 backdrop-blur-xl border border-white/5 rounded-[24px] p-6 shadow-xl relative overflow-hidden group spring-bounce cursor-default hover:border-white/10 hover:shadow-[0_10px_30px_rgba(0,0,0,0.5)]">
            <div
                class="absolute -bottom-10 -left-10 w-24 h-24 bg-[#00F0FF] rounded-full mix-blend-multiply filter blur-[40px] opacity-20 group-hover:opacity-40 transition-opacity">
            </div>

            <div class="flex items-center justify-between mb-4 relative z-10">
                <h3 class="text-sm font-semibold text-slate-300 uppercase tracking-wider">Peringkat Kelas</h3>
                <div
                    class="w-8 h-8 rounded-full bg-[#00F0FF]/10 flex items-center justify-center border border-[#00F0FF]/20">
                    <svg class="w-4 h-4 text-[#00F0FF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                        </path>
                    </svg>
                </div>
            </div>

            <div class="relative z-10">
                <div class="flex items-baseline gap-2">
                    <span class="text-5xl font-extrabold text-white font-mono tracking-tighter drop-shadow-md">{{ $ranking }}</span>
                </div>
                <p class="text-xs text-slate-500 mt-2 font-mono">
                    {{ $ranking === '-' ? 'Mulai kuis untuk melihat peringkat' : 'Peringkat berdasarkan rata-rata skor' }}
                </p>
            </div>
        </div>

        <!-- Card 4: Waktu Tercepat -->
        <div
            class="bg-[#1E293B]/80 backdrop-blur-xl border border-white/5 rounded-[24px] p-6 shadow-xl relative overflow-hidden group spring-bounce cursor-default hover:border-white/10 hover:shadow-[0_10px_30px_rgba(0,0,0,0.5)]">
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-purple-500 rounded-full mix-blend-multiply filter blur-[50px] opacity-10 group-hover:opacity-30 transition-opacity">
            </div>

            <div class="flex items-center justify-between mb-4 relative z-10">
                <h3 class="text-sm font-semibold text-slate-300 uppercase tracking-wider">Rekor Kecepatan</h3>
                <div
                    class="w-8 h-8 rounded-full bg-purple-500/10 flex items-center justify-center border border-purple-500/20">
                    <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="relative z-10">
                <span class="text-4xl font-extrabold text-white font-mono tracking-tighter drop-shadow-md">
                    @if($fastestTime)
                        {{ sprintf('%02d:%02d', floor($fastestTime / 60), $fastestTime % 60) }}<span class="text-xl text-slate-500">s</span>
                    @else
                        00:00<span class="text-xl text-slate-500">s</span>
                    @endif
                </span>
                <p class="text-xs text-slate-500 mt-2 font-mono">
                    {{ $fastestTime ? 'Waktu tercepat menyelesaikan kuis' : 'Belum ada rekor kuis' }}
                </p>
            </div>
        </div>

        <!-- Card 3: Daily Progress (Lebar) -->
        <div
            class="md:col-span-3 bg-[#1E293B]/80 backdrop-blur-xl border border-white/5 rounded-[24px] p-8 shadow-xl relative overflow-hidden group spring-bounce cursor-default hover:border-white/10 hover:shadow-[0_10px_30px_rgba(0,0,0,0.5)]">
            <div
                class="absolute -bottom-24 left-1/4 w-64 h-64 bg-[#CCFF00] rounded-full mix-blend-multiply filter blur-[80px] opacity-10 group-hover:opacity-20 transition-opacity">
            </div>

            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 relative z-10 gap-4">
                <div>
                    <h3 class="text-sm font-semibold text-slate-300 uppercase tracking-wider">Daily Progress Streak</h3>
                    <p class="text-xs text-slate-400 mt-1 font-mono">Konsistensi belajar harianmu</p>
                </div>
                <div
                    class="bg-[#020617]/50 border border-white/10 rounded-xl px-4 py-2 inline-flex items-center gap-3 w-max shadow-inner opacity-50">
                    <svg class="w-5 h-5 text-slate-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-lg font-bold text-slate-400 font-mono tracking-widest">0 HARI</span>
                    <span class="text-slate-600 font-mono">|</span>
                    <span class="text-lg font-bold text-slate-400 font-mono tracking-widest">+0 SCORE</span>
                </div>
            </div>

            <!-- Modern Progress Bar with Neon Tip -->
            @php $progressPercent = $totalModules > 0 ? round(($completedCount / $totalModules) * 100) : 0; @endphp
            <div class="relative z-10">
                <div class="flex justify-between text-xs font-mono text-slate-500 mb-2">
                    <span>Progres Modul: {{ $completedCount }}/{{ $totalModules }}</span>
                    <span class="{{ $progressPercent > 0 ? 'text-[#CCFF00]' : 'text-slate-500' }}">{{ $progressPercent }}% Selesai</span>
                </div>
                <div
                    class="w-full h-4 bg-[#020617] rounded-full overflow-hidden border border-slate-700/50 shadow-inner relative">
                    <!-- The Bar -->
                    <div class="h-full {{ $progressPercent > 0 ? 'bg-gradient-to-r from-[#CCFF00] to-[#00F0FF]' : 'bg-slate-800' }} rounded-full relative transition-all duration-1000 ease-out" style="width: {{ $progressPercent }}%">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>