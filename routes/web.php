<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Models\Mahasiswa;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // get all mahasiswa, sorted descendingly by nim

    // begin the query
    $mahasiswas = Mahasiswa::query();

    // check if the request has a search query
    if (request()->has('search') && request()->get('search') != '') {
        // search the mahasiswa by nim, nama, alamat, or jenis_kelamin
        $mahasiswas = $mahasiswas->where('nim', 'like', '%' . request()->get('search') . '%')
            ->orWhere('nama', 'like', '%' . request()->get('search') . '%')
            ->orWhere('alamat', 'like', '%' . request()->get('search') . '%')
            ->orWhere('jenis_kelamin', 'like', '%' . request()->get('search') . '%');
    }

    $mahasiswas = $mahasiswas->orderBy('nim', 'desc')->paginate(5)->withQueryString();
    // count the total mahasiswa
    $total_mahasiswa = Mahasiswa::count();
    // count only male mahasiswa
    $mahasiswa_pria = Mahasiswa::where('jenis_kelamin', 'L')->count();
    // count only female mahasiswa
    $mahasiswa_wanita = Mahasiswa::where('jenis_kelamin', 'P')->count();
    return view('home', compact(['mahasiswas', 'total_mahasiswa', 'mahasiswa_pria', 'mahasiswa_wanita']));
})->name('home');

Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/mahasiswa/tambah', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
Route::post('/mahasiswa/simpan', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
Route::get('/mahasiswa/edit/{id}', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
Route::post('/mahasiswa/update/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
Route::post('/mahasiswa/hapus', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
