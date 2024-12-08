<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|unique:mahasiswa',
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'kelamin' => 'required',
            'hobi' => 'required',
        ]);

        Mahasiswa::create($validated);

        return redirect()->route('mahasiswa.index');
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nis' => 'required|unique:mahasiswa,nis,' . $id,
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'kelamin' => 'required',
            'hobi' => 'required',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($validated);

        return redirect()->route('mahasiswa.index');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index');
    }
}
