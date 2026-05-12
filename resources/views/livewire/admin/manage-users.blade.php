<div>
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">Kelola Pengguna</h1>
            <p class="text-slate-400">Atur peran pengguna dan hapus akun jika diperlukan.</p>
        </div>
        <div class="w-full md:w-1/3 flex gap-2">
            <div class="relative flex-grow">
                <input wire:model.live="search" type="text"
                    class="w-full bg-[#1E293B]/60 border border-white/10 rounded-xl py-3 pl-4 pr-10 text-white focus:outline-none focus:border-[#CCFF00] focus:ring-1 focus:ring-[#CCFF00] transition-colors"
                    placeholder="Cari nama atau email...">
                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            <button wire:click="openAddModal" class="bg-gradient-to-r from-[#CCFF00] to-[#CCFF00]/80 text-[#020617] font-bold py-3 px-4 rounded-xl shadow-lg hover:shadow-[#CCFF00]/30 transition-all flex-shrink-0">
                + Tambah
            </button>
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
                                    <button wire:click="confirmToggleRole({{ $user->id }})" class="text-xs font-semibold px-3 py-1 rounded-lg border border-[#CCFF00]/50 text-[#CCFF00] hover:bg-[#CCFF00]/10 transition-colors">
                                        Ubah Role
                                    </button>
                                    <button wire:click="confirmDeleteUser({{ $user->id }})" class="text-xs font-semibold px-3 py-1 rounded-lg border border-red-500/50 text-red-400 hover:bg-red-500/10 transition-colors">
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

    <!-- Add User Modal -->
    @if($isAddModalOpen)
        <template x-teleport="body">
            <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm overflow-y-auto py-10 px-4">
                <div class="bg-[#1E293B] border border-white/10 w-full max-w-4xl mx-auto rounded-3xl shadow-2xl p-6 md:p-10 relative max-h-[90vh] overflow-y-auto no-scrollbar">
                    <div class="flex justify-between items-center mb-8 border-b border-white/10 pb-4 sticky top-0 bg-[#1E293B] z-[10] pt-6 md:pt-10 -mt-6 md:-mt-10">
                        <h2 class="text-2xl font-bold text-white">Tambah Pengguna Baru</h2>
                        <button type="button" wire:click="closeAddModal" class="text-slate-400 hover:text-white transition-colors bg-[#020617] rounded-full p-1.5 border border-white/10 hover:bg-white/10">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form wire:submit.prevent="saveUser" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1">Nama Lengkap</label>
                                <input wire:model="name" type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-[#CCFF00] focus:ring-1 focus:ring-[#CCFF00] transition-colors">
                                @error('name') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1">Username</label>
                                <input wire:model="username" type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-[#CCFF00] focus:ring-1 focus:ring-[#CCFF00] transition-colors">
                                @error('username') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1">Email (Opsional)</label>
                                <input wire:model="email" type="email" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-[#CCFF00] focus:ring-1 focus:ring-[#CCFF00] transition-colors">
                                @error('email') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1">Password</label>
                                <input wire:model="password" type="password" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-[#CCFF00] focus:ring-1 focus:ring-[#CCFF00] transition-colors">
                                @error('password') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1">Konfirmasi Password</label>
                                <input wire:model="password_confirmation" type="password" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-[#CCFF00] focus:ring-1 focus:ring-[#CCFF00] transition-colors">
                                @error('password_confirmation') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1">Asal Instansi</label>
                                <input wire:model="asal_instansi" type="text" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-[#CCFF00] focus:ring-1 focus:ring-[#CCFF00] transition-colors">
                                @error('asal_instansi') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-1">Role</label>
                                <select wire:model="role" class="w-full bg-[#1E293B] border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:border-[#CCFF00] focus:ring-1 focus:ring-[#CCFF00] transition-colors appearance-none">
                                    <option value="student">Student</option>
                                    <option value="admin">Admin</option>
                                </select>
                                @error('role') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="pt-6 border-t border-white/10 flex justify-end gap-3 sticky bottom-0 bg-[#1E293B] pb-2 z-[5] mt-8">
                            <button type="button" wire:click="closeAddModal" class="px-5 py-2.5 rounded-xl border border-white/10 text-slate-300 hover:bg-white/5 transition-colors">Batal</button>
                            <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#CCFF00] text-[#020617] font-bold shadow-[0_0_15px_rgba(204,255,0,0.4)] hover:scale-105 transition-transform">Simpan Pengguna</button>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    @endif

    @script
    <script>
        $wire.on('swal:confirm-delete-user', () => {
            Swal.fire({
                title: 'HAPUS PENGGUNA',
                text: "Apakah Anda yakin ingin menghapus pengguna ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
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
                    $wire.deleteUser()
                }
            });
        });

        $wire.on('swal:confirm-toggle-role', () => {
            Swal.fire({
                title: 'UBAH ROLE',
                text: "Apakah Anda yakin ingin mengubah role pengguna ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#CCFF00',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: '<span class="text-black font-bold">Ya, ubah!</span>',
                cancelButtonText: 'Batal',
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
                    $wire.toggleRole()
                }
            });
        });
    </script>
    @endscript
</div>
