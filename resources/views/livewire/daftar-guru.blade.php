<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Daftar Guru</h2>


    <div class="bg-white shadow-md rounded-xl p-6 overflow-auto">
        <table class="w-full text-left table-auto border-separate border-spacing-y-2">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">Nama</th>
                    <th class="p-2">NIP</th>
                    <th class="p-2">Gender</th>
                    <th class="p-2">Alamat</th>
                    <th class="p-2">Kontak</th>
                    <th class="p-2">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gurus as $guru)
                    <tr class="border-t">
                        <td class="p-2">{{ $guru->nama }}</td>
                        <td class="p-2">{{ $guru->nip }}</td>
                        <td class="p-2">{{ $guru->gender }}</td>
                        <td class="p-2">{{ $guru->alamat }}</td>
                        <td class="p-2">{{ $guru->kontak }}</td>
                        <td class="p-2">{{ $guru->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
