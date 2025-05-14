<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Industri</h1>
<div class="d-flex justify-content-between mb-4">
        <!-- Tombol untuk menambah industri -->
        <a href="{{ route('industri.create') }}" class="btn btn-primary">Tambah Industri</a>
    </div>

    <table class="w-full border rounded-lg">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Nama Industri</th>
                <th class="p-2">Bidang Usaha</th>
                <th class="p-2">Alamat</th>
                <th class="p-2">Kontak</th>
                <th class="p-2">Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($industris as $industri)
                <tr class="border-t">
                    <td class="p-2">{{ $industri->nama }}</td>
                    <td class="p-2">{{ $industri->bidang_usaha }}</td>
                    <td class="p-2">{{ $industri->alamat }}</td>
                    <td class="p-2">{{ $industri->kontak }}</td>
                    <td class="p-2">{{ $industri->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
