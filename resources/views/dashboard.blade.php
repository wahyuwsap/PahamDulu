<x-layouts.app>
    <div class="w-full max-w-4xl mx-auto">
        <div
            class="bg-[#1E293B]/80 backdrop-blur-xl border border-white/5 rounded-[24px] p-8 shadow-2xl relative overflow-hidden">
            <!-- Decorative Glow -->
            <div
                class="absolute -top-24 -right-24 w-48 h-48 bg-[#CCFF00] rounded-full mix-blend-multiply filter blur-[80px] opacity-10 pointer-events-none">
            </div>

            <div class="relative z-10">
                <div class="flex justify-between items-center mb-8 pb-4 border-b border-slate-700/50">
                    <div>
                        <h1 class="text-2xl font-bold text-white tracking-tight">Dashboard</h1>
                        <p class="text-slate-400 mt-1 font-mono text-sm">Selamat datang,
                            {{ auth()->user()->name ?? 'User' }}
                        </p>
                    </div>

                    <form method="POST" action="/logout" id="logout-form">
                        @csrf
                        <button type="submit"
                            class="text-xs font-mono bg-red-500/10 text-red-400 px-4 py-2 rounded-lg hover:bg-red-500/20 transition-colors">
                            Logout
                        </button>
                    </form>
                </div>

                <div class="py-12 text-center border-2 border-dashed border-slate-700/50 rounded-xl">
                    <p class="text-slate-500 font-mono">Area Dashboard Kosong</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>