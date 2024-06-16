@extends('layout.main')

@section('judul')
Halaman Pengajuan Surat Izin
@endsection

@section('isi')
<form action="/letter/add" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
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
                <label for="nama">NIM <b class="text-danger">*</b></label>
                <input readonly required placeholder="Masukkan NIM" type="text" id="nim" name="nim" class="form-control @error('nim') is-invalid
                @enderror" value="{{ $user->nim }}">
                @error('nim')
                <div class="invalid-feedback">{{ $message}}</div>
                @enderror
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="nama">Nama Lengkap <b class="text-danger">*</b></label>
                <input required placeholder="Masukkan Nama" type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid
            @enderror" value="{{ $user->nama }}">
                @error('nama')
                <div class="invalid-feedback">{{ $message}}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-12 col-md-6 mb-3">
                <label for="jenis_perizinan">Jenis Perizinan <b class="text-danger">*</b></label>
                <select id="jenis_perizinan" name="jenis_perizinan"
                    class="form-control @error('jenis_perizinan') is-invalid @enderror" required>
                    <option value="">- Pilih Jenis Perizinan -</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Lembur Kerja">Lembur Kerja</option>
                    <option value="Urusan Keluarga">Urusan Keluarga</option>
                    <option value="Urusan Mendesak">Urusan Mendesak</option>
                    <option value="Bekerja Shift">Bekerja Shift</option>
                    <option value="Lainnya">Yang lain...</option>
                </select>
                <div id="lainnyaInputContainer" style="display: none;">
                    <label for="lainnyaInput" class="mt-2">Perizinan Lainnya <b class="text-danger">*</b></label>
                    <input type="text" id="lainnyaInput" name="lainnyaInput" class="form-control"
                        style="width: 200px;"></input>
                </div>
                @error('jenis_perizinan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="nama">Kelas Perkuliahan <b class="text-danger">*</b></label>
                <select required id="kelas_perkuliahan" name="kelas_perkuliahan" class="form-control @error('kelas_perkuliahan') is-invalid
                @enderror" required>
                    <option value="">- Pilih Kelas Perkuliahan -</option>
                    <option>Reguler Pagi</option>
                    <option>Reguler Malam</option>
                </select>
                @error('kelas_perkuliahan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-12 col-md-6 mb-3">
                <label for="nama">Nomor Telepon Orang tua/Wali<b class="text-danger">*</b></label>
                <input required placeholder="Masukkan Nomor Telepon Ortu/Wali" type="number"
                    id="nama_dan_nomor_telepon_orang_tua_wali" name="nama_dan_nomor_telepon_orang_tua_wali" class="form-control @error('nama_dan_nomor_telepon_orang_tua_wali') is-invalid
            @enderror" value="{{ old('nama_dan_nomor_telepon_orang_tua_wali') }}">
                @error('nama_dan_nomor_telepon_orang_tua_wali')
                <div class="invalid-feedback">{{ $message}}</div>
                @enderror
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="nama">Tanggal Mulai Izin</label> <b class="text-danger">*</b></label>
                <input required type="date" id="tanggal_mulai_izin" name="tanggal_mulai_izin" class="form-control @error('tanggal_mulai_izin') is-invalid
                @enderror" value="{{ old('tanggal_mulai_izin') }}">
                @error('tanggal_mulai_izin')
                <div class="invalid-feedback">{{ $message}}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="col-12 col-md-6 mb-3">
                <label for="nama">Nama Dosen Wali <b class="text-danger">*</b></label>
                <input required placeholder="Masukkan Nama Dosen Wali" type="text" id="nama_dosen_wali"
                    name="nama_dosen_wali" class="form-control @error('nama_dosen_wali') is-invalid
            @enderror" value="{{ old('nama_dosen_wali') }}">
                @error('nama_dosen_wali')
                <div class="invalid-feedback">{{ $message}}</div>
                @enderror
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="nama">Tanggal Akhir Izin</label> <b class="text-danger">*</b></label>
                <input required type="date" id="tanggal_akhir_izin" name="tanggal_akhir_izin" class="form-control @error('tanggal_akhir_izin') is-invalid
                @enderror" value="{{ old('tanggal_akhir_izin') }}">
                @error('tanggal_akhir_izin')
                <div class="invalid-feedback">{{ $message}}</div>
                @enderror
            </div>
        </div>
        <div class="form-grup" id="upload-foto">
            <div class="mb-3">
                <label for="foto">Upload Surat Bukti(Surat MC/ Surat Perintah Lembur/ Bukti izin lainnya) <b class="text-danger">*</b></label>
                <input type="file" id="foto1" name="foto1" class="form-control @error('foto1') is-invalid @enderror"
                    value="{{ old('foto1') }}" accept="image/*">
                @error('foto1')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-grup" id="upload-foto1">
            <div class="mb-3">
                <label for="foto">Upload bukti Chat Persetujuan Dosen Wali <b class="text-danger">*</b></label>
                <input type="file" id="foto2" name="foto2" class="form-control @error('foto2') is-invalid @enderror"
                    value="{{ old('foto2') }}" accept="image/*">
                @error('foto2')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-grup" id="upload-foto">
            <div class="mb-3">
                <label for="foto">Upload Surat Izin yang sesuai Format TU <b class="text-danger">*</b></label>
                <input type="file" id="foto3" name="foto3" class="form-control @error('foto3') is-invalid @enderror"
                    value="{{ old('foto3') }}" accept="image/*">
                @error('foto3')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="/home" class="btn btn-danger">< Kembali</a>
        <button type="submit" class="btn btn-success float-right">Simpan</button>
        <button type="reset" class="btn btn-danger float-right mr-2">Reset</button>
    </div>
</form>

@endsection
