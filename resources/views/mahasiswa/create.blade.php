@extends('layouts.app')

@section('content')
    <h1>Tambah Mahasiswa</h1>
    <form action="{{ route('mahasiswa.store') }}" method="POST">
        @csrf
        <label for="nis">NIS</label>
        <input type="text" name="nis" id="nis" required>
        
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" required>
        
        <label for="alamat">Alamat</label>
        <textarea name="alamat" id="alamat" required></textarea>
        
        <label for="no_hp">No HP</label>
        <input type="text" name="no_hp" id="no_hp" required>
        
        <label for="kelamin">Kelamin</label>
        <select name="kelamin" id="kelamin" required>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
        
        <label for="hobi">Hobi</label>
        <input type="text" name="hobi" id="hobi" required>
        
        <button type="submit">Simpan</button>
    </form>
@endsection
