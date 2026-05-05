<div>
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">Kelola Pengguna</h1>
            <p class="text-slate-400">Atur peran pengguna dan hapus akun jika diperlukan.</p>
        </div>
        <div class="w-full md:w-1/3">
            <div class="relative">
                <input wire:model.live="search" type="text"
                    class="w-full bg-[#1E293B]/60 border border-white/10 rounded-xl py-3 pl-4 pr-10 text-white focus:outline-none focus:border-[#CCFF00] focus:ring-1 focus:ring-[#CCFF00] transition-colors"
                    placeholder="Cari nama atau email...">
                <div class="absolute right-3 top-3.5 text-slate-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 p-4 rounded-xl bg-green-500/20 border border-green-500/50 text-green-400">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-6 p-4 rounded-xl bg-red-500/20 border border-red-500/50 text-red-400">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-[#1E293B]/60 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/5 border-b border-white/10 text-slate-300 text-sm">
                        <th class="p-4 font-semibold">Pengguna</th>
                        <th class="p-4 font-semibold">Instansi</th>
                        <th class="p-4 font-semibold">Role</th>
                        <th class="p-4 font-semibold">Bergabung</th>
                        <th class="p-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($users as $user)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <img class="w-10 h-10 rounded-full border border-slate-600"
                                        src="{{ $user->avatar_path ? Storage::url($user->avatar_path) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=1E293B&color=fff' }}"
                                        alt="{{ $user->name }}">
                                    <div>
                                        <p class="text-sm font-semibold text-white">{{ $user->name }}</p>
                                        <p class="text-xs text-slate-400">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 text-sm text-slate-300">{{ $user->asal_instansi ?? '-' }}</td>
                            <td class="p-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full border {{ $user->role === 'admin' ? 'bg-[#00F0FF]/10 text-[#00F0FF] border-[#00F0FF]/30' : 'bg-slate-700/50 text-slate-300 border-slate-600' }}">
                                    {{ ucfirst($user->role ?? 'Student') }}
                                </span>
                            </td>
                            <td class="p-4 text-sm text-slate-300">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="p-4 text-right space-x-2">
                                @if($user->id !== auth()->id())
                                    <button wire:click="toggleRole({{ $user->id }})" class="text-xs font-semibold px-3 py-1 rounded-lg border border-[#CCFF00]/50 text-[#CCFF00] hover:bg-[#CCFF00]/10 transition-colors">
                                        Ubah Role
                                    </button>
                                    <button wire:click="deleteUser({{ $user->id }})" wire:confirm="Apakah Anda yakin ingin menghapus pengguna ini?" class="text-xs font-semibold px-3 py-1 rounded-lg border border-red-500/50 text-red-400 hover:bg-red-500/10 transition-colors">
                                        Hapus
                                    </button>
                                @else
                                    <span class="text-xs text-slate-500 italic">Anda</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-slate-400">
                                Tidak ada pengguna ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-white/10">
            {{ $users->links() }}
        </div>
    </div>
</div>
