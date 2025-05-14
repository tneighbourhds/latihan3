<div class="container mt-5">
    <h3>Create PKL</h3>

    <!-- Menampilkan Pesan Sukses -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save">

    <!-- hai -->


        <div class="form-group mb-3">
            <label for="siswa_id">Siswa</label>
            <select class="form-control" id="siswa_id" wire:model="siswa_id">
                <option value="">Select Siswa</option>
                @foreach($siswas as $siswa)
                    <option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
                @endforeach
            </select>
            @error('siswa_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-3">
            <label for="industri_id">Industri</label>
            <select class="form-control" id="industri_id" wire:model="industri_id">
                <option value="">Select Industri</option>
                @foreach($industris as $industri)
                    <option value="{{ $industri->id }}">{{ $industri->nama }}</option>
                @endforeach
            </select>
            @error('industri_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-3">
            <label for="guru_id">Guru Pendamping</label>
            <select class="form-control" id="guru_id" wire:model="guru_id">
                <option value="">Select Guru</option>
                @foreach($gurus as $guru)
                    <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                @endforeach
            </select>
            @error('guru_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-3">
            <label for="mulai">Tanggal Mulai</label>
            <input type="date" class="form-control" id="mulai" wire:model="mulai">
            @error('mulai') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-3">
            <label for="selesai">Tanggal Selesai</label>
            <input type="date" class="form-control" id="selesai" wire:model="selesai">
            @error('selesai') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-dark w-100">Create</button>
    </form>
</div>
