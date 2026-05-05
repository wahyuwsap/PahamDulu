<div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white mb-2">Dashboard Admin</h1>
        <p class="text-slate-400">Ikhtisar sistem pembelajaran PahamDulu.</p>
    </div>

    <!-- Stats Bento Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-[#1E293B]/60 backdrop-blur-xl border border-white/10 rounded-3xl p-6 relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-[#CCFF00]/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative z-10 flex flex-col justify-between h-full">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-[#CCFF00]/20 flex items-center justify-center border border-[#CCFF00]/30">
                        <svg class="w-6 h-6 text-[#CCFF00]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-300">Total Siswa</h3>
                </div>
                <div>
                    <p class="text-4xl font-extrabold text-white">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>

        <!-- Total Modules -->
        <div class="bg-[#1E293B]/60 backdrop-blur-xl border border-white/10 rounded-3xl p-6 relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-[#00F0FF]/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative z-10 flex flex-col justify-between h-full">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-[#00F0FF]/20 flex items-center justify-center border border-[#00F0FF]/30">
                        <svg class="w-6 h-6 text-[#00F0FF]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-300">Total Modul</h3>
                </div>
                <div>
                    <p class="text-4xl font-extrabold text-white">{{ $totalModules }}</p>
                </div>
            </div>
        </div>

        <!-- Average Score -->
        <div class="bg-[#1E293B]/60 backdrop-blur-xl border border-white/10 rounded-3xl p-6 relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-[#FF0055]/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative z-10 flex flex-col justify-between h-full">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-[#FF0055]/20 flex items-center justify-center border border-[#FF0055]/30">
                        <svg class="w-6 h-6 text-[#FF0055]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-300">Rata-rata Nilai Kuis</h3>
                </div>
                <div>
                    <p class="text-4xl font-extrabold text-white">{{ $avgScore }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Grids -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Users -->
        <div class="bg-[#1E293B]/40 backdrop-blur-xl border border-white/10 rounded-3xl p-6">
            <h3 class="text-xl font-bold text-white mb-6 border-b border-white/10 pb-4">Pengguna Baru</h3>
            <div class="space-y-4">
                @forelse($recentUsers as $user)
                    <div class="flex items-center justify-between p-4 bg-white/5 rounded-2xl hover:bg-white/10 transition-colors">
                        <div class="flex items-center gap-4">
                            <img class="w-10 h-10 rounded-full border border-slate-600"
                                src="{{ $user->avatar_path ? Storage::url($user->avatar_path) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=1E293B&color=fff' }}"
                                alt="{{ $user->name }}">
                            <div>
                                <p class="text-sm font-semibold text-white">{{ $user->name }}</p>
                                <p class="text-xs text-slate-400">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-slate-400">{{ $user->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-400 text-sm">Belum ada pengguna.</p>
                @endforelse
            </div>
            <div class="mt-6 text-center">
                <a href="{{ route('admin.users') }}" class="text-sm text-[#00F0FF] hover:text-white transition-colors">Lihat Semua Pengguna &rarr;</a>
            </div>
        </div>

        <!-- Recent Progress -->
        <div class="bg-[#1E293B]/40 backdrop-blur-xl border border-white/10 rounded-3xl p-6">
            <h3 class="text-xl font-bold text-white mb-6 border-b border-white/10 pb-4">Aktivitas Modul Terbaru</h3>
            <div class="space-y-4">
                @forelse($recentProgress as $progress)
                    <div class="flex items-center justify-between p-4 bg-white/5 rounded-2xl hover:bg-white/10 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-[#CCFF00]/10 flex items-center justify-center border border-[#CCFF00]/30">
                                <span class="text-[#CCFF00] text-xs font-bold">{{ $progress->score }}</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-white">{{ $progress->user->name ?? 'User' }}</p>
                                <p class="text-xs text-slate-400">Menyelesaikan: <span class="text-[#00F0FF]">{{ $progress->module->title ?? 'Modul' }}</span></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-slate-400">{{ $progress->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-400 text-sm">Belum ada aktivitas modul.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
