<form wire:submit.prevent="save">
    
    <div class="form-group mb-3">
        <label for="nama">Nama Industri</label>
        <input type="text" class="form-control" id="nama" wire:model="nama">
        @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group mb-3">
        <label for="bidang_usaha">Bidang Usaha</label>
        <input type="text" class="form-control" id="bidang_usaha" wire:model="bidang_usaha">
        @error('bidang_usaha') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group mb-3">
        <label for="alamat">Alamat</label>
        <input type="text" class="form-control" id="alamat" wire:model="alamat">
        @error('alamat') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group mb-3">
        <label for="kontak">Kontak</label>
        <input type="text" class="form-control" id="kontak" wire:model="kontak">
        @error('kontak') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" wire:model="email">
        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="btn btn-dark w-100">Create</button>
</form>
