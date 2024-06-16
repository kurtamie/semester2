@extends('layout.main')

@section('judul')
Halaman Pengajuan Surat Survey
@endsection

@section('isi')
<form action="/survey/add" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        @if(session('notifikasi'))
        <div class="form-group">
            <div class="alert alert-{{ session('type') }}">
                {{ session('notifikasi') }}
            </div>
        </div>
        @endif
        <div class="form-row">
            <div class="col-12 col-md-6 mb-3" hidden>
                <label for="nama">ID user <b class="text-danger">*</b></label>
                <input readonly required placeholder="Masukkan NIM" type="text" id="id_user" name="id_user" class="form-control" value="{{ $user->id_user }}">
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="nama">Nim <b class="text-danger">*</b></label>
                <input readonly required placeholder="Masukkan Nim" type="text" id="nim"
                    name="nim" class="form-control @error('nim') is-invalid
                @enderror" value="{{ $user->nim }}">
                @error('nim')
                <div class="invalid-feedback">{{ $message}}</div>
                @enderror
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="nama">Nama <b class="text-danger">*</b></label>
                <input required placeholder="Masukkan Nama" type="text" id="nama"
                    name="nama" class="form-control @error('nama') is-invalid
                @enderror" value="{{ $user->nama }}">
                @error('nama')
                <div class="invalid-feedback">{{ $message}}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-12 col-md-6 mb-3">
                <label for="nama">Keperluan Mahasiswa <b class="text-danger">*</b></label>
                <input required placeholder="Masukkan Keperluan Mahasiswa" type="keperluan_mahasiswa"
                id="keperluan_mahasiswa" name="keperluan_mahasiswa"
                    class="form-control @error('keperluan_mahasiswa') is-invalid @enderror"
                    value="{{ old('keperluan_mahasiswa') }}">
                @error('keperluan_mahasiswa')
                <div class="invalid-feedback">{{ $message}}</div>
                @enderror
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="nama">Tugas Yang Dikerjakan <b class="text-danger">*</b></label>
                <input required placeholder="Masukkan Tugas Yang Dikerjakan" type="tugas_yang_dikerjakan"
                id="tugas_yang_dikerjakan" name="tugas_yang_dikerjakan"
                    class="form-control @error('tugas_yang_dikerjakan') is-invalid @enderror"
                    value="{{ old('tugas_yang_dikerjakan') }}">
                @error('tugas_yang_dikerjakan')
                <div class="invalid-feedback">{{ $message}}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-12 col-md-6 mb-3">
                <label for="nama">Alamat Instansi <b class="text-danger">*</b></label>
                <textarea required placeholder="Masukkan Alamat Instansi" type="text"
                id="alamat_instansi" name="alamat_instansi"
                class="form-control @error('alamat_instansi') is-invalid
            @enderror" value="{{ old('alamat_instansi') }}"></textarea>
                @error('alamat_instansi')
                <div class="invalid-feedback">{{ $message}}</div>
                @enderror
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="nama">Alamat Tujuan <b class="text-danger">*</b></label>
                <textarea required placeholder="Masukkan Alamat Tujuan" type="textarea" id="alamat_tujuan"
                    name="alamat_tujuan" class="form-control  @error('alamat_tujuan') is-invalid
            @enderror" value="{{ old('alamat_tujuan') }}"></textarea>
                @error('alamat_tujuan')
                <div class="invalid-feedback">{{ $message}}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="/home" class="btn btn-danger">< Kembali</a>
        <button type="submit" class="btn btn-success float-right">Simpan</button>
        <button type="reset" class="btn btn-warning float-right mr-2">Reset</button>
    </div>
</form>

@endsection
