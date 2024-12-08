@extends('layouts.app')

@section('content')
    <h1>Daftar Mahasiswa</h1>
    
    <button id="btnTambah" class="btn btn-success mb-3">Tambah Mahasiswa</button>
    
    <hr>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>NIS</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Kelamin</th>
                <th>Hobi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswa as $mhs)
                <tr>
                    <td>{{ $mhs->nis }}</td>
                    <td>{{ $mhs->nama }}</td>
                    <td>{{ $mhs->alamat }}</td>
                    <td>{{ $mhs->no_hp }}</td>
                    <td>{{ $mhs->kelamin }}</td>
                    <td>{{ $mhs->hobi }}</td>
                    <td>
                        <button class="btn btn-warning" onclick="editForm({{ $mhs->id }}, '{{ $mhs->nis }}', '{{ $mhs->nama }}', '{{ $mhs->alamat }}', '{{ $mhs->no_hp }}', '{{ $mhs->kelamin }}', '{{ $mhs->hobi }}')">Edit</button>
                        <button class="btn btn-danger" onclick="confirmDelete('{{ $mhs->nis }}', '{{ $mhs->nama }}', {{ $mhs->id }})">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    
    <div id="formTambah" style="display: none;">
        <h3>Tambah Mahasiswa</h3>
        <form action="{{ route('mahasiswa.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nis">NIS</label>
                <input type="text" name="nis" id="nis" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="no_hp">No HP</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="kelamin">Kelamin</label>
                <select name="kelamin" id="kelamin" class="form-control" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="hobi">Hobi</label>
                <input type="text" name="hobi" id="hobi" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" id="btnBatalTambah" class="btn btn-secondary">Batal</button>
        </form>
    </div>

    <div id="formEdit" style="display: none;">
        <h3>Edit Mahasiswa</h3>
        <form action="" method="POST" id="formEditAction">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nisEdit">NIS</label>
                <input type="text" name="nis" id="nisEdit" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="namaEdit">Nama</label>
                <input type="text" name="nama" id="namaEdit" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="alamatEdit">Alamat</label>
                <textarea name="alamat" id="alamatEdit" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="no_hpEdit">No HP</label>
                <input type="text" name="no_hp" id="no_hpEdit" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="kelaminEdit">Kelamin</label>
                <select name="kelamin" id="kelaminEdit" class="form-control" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="hobiEdit">Hobi</label>
                <input type="text" name="hobi" id="hobiEdit" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" id="btnBatalEdit" class="btn btn-secondary">Batal</button>
        </form>
    </div>

    <div id="confirmDelete" style="display: none;">
        <h3>Konfirmasi Hapus</h3>
        <p>Apakah Anda yakin ingin menghapus mahasiswa ini?</p>
        <p id="deleteDetails"></p> 
        <form action="" method="POST" id="formDeleteAction">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
            <button type="button" id="btnBatalDelete" class="btn btn-secondary">Batal</button>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    function hideAllForms() {
        document.getElementById('formTambah').style.display = 'none';
        document.getElementById('formEdit').style.display = 'none';
        document.getElementById('confirmDelete').style.display = 'none';
    }

    document.getElementById('btnTambah').onclick = function() {
        hideAllForms(); 
        document.getElementById('formTambah').style.display = 'block';
    };

    document.getElementById('btnBatalTambah').onclick = function() {
        document.getElementById('formTambah').style.display = 'none';
    };

    function editForm(id, nis, nama, alamat, no_hp, kelamin, hobi) {
        hideAllForms();
        document.getElementById('formEdit').style.display = 'block';
        document.getElementById('nisEdit').value = nis;
        document.getElementById('namaEdit').value = nama;
        document.getElementById('alamatEdit').value = alamat;
        document.getElementById('no_hpEdit').value = no_hp;
        document.getElementById('kelaminEdit').value = kelamin;
        document.getElementById('hobiEdit').value = hobi;
        document.getElementById('formEditAction').action = '/mahasiswa/' + id;
    }

    document.getElementById('btnBatalEdit').onclick = function() {
        document.getElementById('formEdit').style.display = 'none';
    };

    function confirmDelete(nis, nama, id) {
        hideAllForms(); 
        document.getElementById('confirmDelete').style.display = 'block';
        document.getElementById('deleteDetails').innerHTML = `NIS: ${nis}<br>Nama: ${nama}`;
        document.getElementById('formDeleteAction').action = '/mahasiswa/' + id;
    }

    document.getElementById('btnBatalDelete').onclick = function() {
        document.getElementById('confirmDelete').style.display = 'none';
    };
</script>
@endsection
