@extends('layout')

@section('content')
<div class="flex justify-center pt-16">
    <div class="mb-8">
        <h3 class="text-2xl font-semibold">Daftar Mahasiswa</h3>
    </div>
</div>

<!-- button to admin page -->
<div class="flex justify-center">
    <a href="{{ route('mahasiswa.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Masuk Sebagai Admin</a>
</div>

<div class="mt-8 mx-auto max-w-screen-lg">
    <div class="flex mb-6 justify-center">
        <div class="w-[520px]">
            <form action="" method="get" class="max-w-md mx-auto">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" name="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari mahasiswa" required />
                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <!-- statistic of mahasiswa -->
    <div class="my-2 flex gap-x-4 justify-center">
        <!-- total mahasiswa -->
        <div class="">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md px-4 py-2">
                <div class="flex justify-between items-center gap-x-12">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Total Mahasiswa</div>
                    <div class="text-lg font-semibold dark:text-white">{{ $total_mahasiswa }}</div>
                </div>
            </div>
        </div>
        <!-- total male mahasiswa -->
        <div class="">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md px-4 py-2">
                <div class="flex justify-between items-center gap-x-12">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Mahasiswa Laki-laki</div>
                    <div class="text-lg font-semibold dark:text-white">{{ $mahasiswa_pria }}</div>
                </div>
            </div>
        </div>
        <!-- total female mahasiswa -->
        <div class="">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md px-4 py-2">
                <div class="flex justify-between items-center gap-x-12">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Mahasiswa Perempuan</div>
                    <div class="text-lg font-semibold dark:text-white">{{ $mahasiswa_wanita }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- table of mahasiswa -->
    <div class="mt-8">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            NIM
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Alamat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Lahir
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jenis Kelamin
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Usia
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswas as $mahasiswa)
                    <tr class="bg-white border-b dark:border-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                            {{ $mahasiswa->nim }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                            {{ $mahasiswa->nama }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                            {{ $mahasiswa->alamat }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                            {{ $mahasiswa->tgl_lahir }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                            {{ $mahasiswa->jenis_kelamin }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                            {{ $mahasiswa->usia }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="my-4">
            {{ $mahasiswas->links() }}
        </div>
    </div>
</div>
@endsection