<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    // show the home page
    public function index()
    {
        // get all mahasiswa, sorted descendingly by nim
        $mahasiswas = Mahasiswa::orderBy('nim', 'desc')->paginate(5);
        return view('admin.index', compact('mahasiswas'));
    }

    // show the form for creating a new mahasiswa
    public function create()
    {
        return view('admin.create');
    }

    // store a newly created mahasiswa in storage
    public function store(Request $request)
    {
        // validate the request
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim',
            'nama' => 'required',
            'alamat' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'usia' => 'required'
        ]);

        try {
            // create a new mahasiswa
            $mahasiswa = new Mahasiswa;
            $mahasiswa->nim = $request->nim;
            $mahasiswa->nama = $request->nama;
            $mahasiswa->alamat = $request->alamat;
            $mahasiswa->tgl_lahir = $request->tgl_lahir;
            $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
            $mahasiswa->usia = $request->usia;
            $mahasiswa->save();

            return redirect()->route('mahasiswa.create')->with('success', 'Data mahasiswa berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->route('mahasiswa.create')->with('error', 'Data mahasiswa gagal disimpan.');
        }
    }

    // show the form for editing the specified mahasiswa
    public function edit($id)
    {
        // find the mahasiswa by id
        $mahasiswa = Mahasiswa::find($id);
        return view('admin.edit', compact('mahasiswa'));
    }

    // update the specified mahasiswa in storage
    public function update(Request $request)
    {
        // validate the request
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'usia' => 'required'
        ]);

        try {
            // find the mahasiswa by id
            $mahasiswa = Mahasiswa::find($request->id);
            $mahasiswa->nama = $request->nama;
            $mahasiswa->alamat = $request->alamat;
            $mahasiswa->tgl_lahir = $request->tgl_lahir;
            $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
            $mahasiswa->usia = $request->usia;
            $mahasiswa->save();

            return redirect()->route('mahasiswa.index')->with('edit_success', 'Data mahasiswa berhasil diubah.');
        } catch (\Exception $e) {
            return redirect()->route('mahasiswa.index')->with('error', 'Data mahasiswa gagal diubah.');
        }
    }

    // remove the specified mahasiswa from storage
    public function destroy(Request $request)
    {
        try {
            // find the mahasiswa by id
            $mahasiswa = Mahasiswa::find($request->id);
            $mahasiswa->delete();

            return redirect()->route('mahasiswa.index')->with('delete_success', true);
        } catch (\Exception $e) {
            return redirect()->route('mahasiswa.index')->with('error', 'Data mahasiswa gagal dihapus.');
        }
    }
}
