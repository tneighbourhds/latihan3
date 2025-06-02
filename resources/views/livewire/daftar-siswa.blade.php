<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4" style="font-family: 'Poppins', sans-serif;">Daftar PKL</h2>

    <!-- Input Pencarian Siswa -->
    <div class="mb-4">
        <input 
            type="text" 
            wire:model="search" 
            placeholder="Cari nama siswa..." 
            class="p-2 border rounded-md w-full" 
            wire:keydown.enter="updateSearch"
            style="font-family: 'Poppins', sans-serif;" 
        />
    </div>

    <div class="d-flex justify-content-between mb-4">
                        <!-- Tombol untuk menambah industri -->
                        <a href="{{ route('pkl.create') }}" class="btn btn-dark" style="font-family: 'Poppins', sans-serif;">Input Data PKL</a>
                    </div>

    <div class="bg-white shadow-md rounded-xl p-6 overflow-auto">
        <table class="w-full text-left table-auto border-separate border-spacing-y-2">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2" style="font-family: 'Poppins', sans-serif;">Nama Siswa</th>
                    <th class="p-2" style="font-family: 'Poppins', sans-serif;">Industri</th>
                    <th class="p-2" style="font-family: 'Poppins', sans-serif;">Guru Pendamping</th>
                    <th class="p-2" style="font-family: 'Poppins', sans-serif;">Tanggal Mulai</th>
                    <th class="p-2" style="font-family: 'Poppins', sans-serif;">Tanggal Selesai</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pkls as $pkl)
                    <tr class="border-t">
                        <td class="p-2" style="font-family: 'Poppins', sans-serif;">{{ $pkl->siswa->nama ?? '-' }}</td>
                        <td class="p-2" style="font-family: 'Poppins', sans-serif;">{{ $pkl->industri->nama ?? '-' }}</td>
                        <td class="p-2" style="font-family: 'Poppins', sans-serif;">{{ $pkl->guru->nama ?? '-' }}</td>
                        <td class="p-2" style="font-family: 'Poppins', sans-serif;">{{ $pkl->mulai }}</td>
                        <td class="p-2" style="font-family: 'Poppins', sans-serif;">{{ $pkl->selesai }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-2 text-center" style="font-family: 'Poppins', sans-serif;">Siswa tidak terdaftar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- pagination -->
     <div class="mt-4">
        {{ $pkls->onEachSide(1)->links() }}
</div>
</div>
