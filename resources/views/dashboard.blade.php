<x-app-layout>
    <div class="py-10">
        @php
            $user = auth()->user();
        @endphp

        @if ($user->roles->isEmpty())
            <div class="text-center text-red-600" style="font-family: 'Poppins', sans-serif;">
                Akun Anda belum diberikan role oleh admin. Silakan tunggu konfirmasi.
            </div>

        @elseif ($user->hasRole('siswa'))
            {{-- Tampilan khusus siswa --}}
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white p-6 rounded-lg shadow">
                    <!-- <h3 class="text-lg font-bold mb-4" style="font-family: 'Poppins', sans-serif;">Welcome Back!</h3> -->
                    <h1 class="text-lg font-bold mb-4" style="font-family: 'Poppins', sans-serif;">Hi, {{ $user->name }}! Welcome Back</h1>

                    <!-- <p style="font-family: 'Poppins', sans-serif;">Silakan input data PKL dan Industri:</p> -->

                   

                    <!-- Menampilkan komponen daftar siswa -->
                    @livewire('daftar-siswa')
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
