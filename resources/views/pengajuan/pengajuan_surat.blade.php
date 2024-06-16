@extends('layout.main')

@section('judul')
Halaman Pengajuan Surat
@endsection

@section('isi')
<div class="card-body">
    <div class="form-group">
        @if(session('notifikasi'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('notifikasi') }}
        </div>
        @endif
        <div class="col-sm-4 mb-3">
            <select id="jenis_keperluan" name="jenis_keperluan"
                class="form-control @error('jenis_keperluan') is-invalid @enderror" required>
                <option value="">- Jenis Surat -</option>
                <option value="izin">Tabel Pengajuan Surat Izin</option>
                <option value="survey">Tabel Pengajuan Surat Survey</option>
            </select>
            @error('jenis_keperluan')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="table-responsive" id="tabel1" style="display:none;">
        <table class="table table-bordered table-hover " style="background: rgb(188, 188, 188);">
            <h3>Tabel Pengajuan Surat Izin</h3>
            <thead>
                <td>No</td>
                <td>Nim</td>
                <td>Nama</td>
                <td>Nama Dosen Wali</td>
                <td>Kelas Perkuliahan</td>
                <td>Nama dan No.Tlpn Orang Tua/Wali</td>
                <td>Jenis Perizinan</td>
                <td>Tanggal Mulai Izin</td>
                <td>Tanggal Akhir Izin</td>
                <td>Surat Bukti</td>
                <td>Bukti Chat Persetujuan Dosen Wali</td>
                <td>Surat Izin Format TU</td>
                <td>Status</td>
                <td>Aksi</td>
            </thead>
            <tbody>
                @forelse ( $letters as $index => $data )
                @if ($data->id_user == auth()->user()->id_user)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $data->nim }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->nama_dosen_wali }}</td>
                    <td>{{ $data->kelas_perkuliahan }}</td>
                    <td>{{ $data->nama_dan_nomor_telepon_orang_tua_wali}}</td>
                    <td>{{ $data->jenis_perizinan }}</td>
                    <td>{{ $data->tanggal_mulai_izin }}</td>
                    <td>{{ $data->tanggal_akhir_izin }}</td>
                    <td>
                        <button class="btn btn-info"
                            onclick="showImageModal('{{ asset('storage/uploads/' .$data->foto1) }}')">
                            Preview
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-info"
                            onclick="showImageModal('{{ asset('storage/uploads/' .$data->foto2) }}')">
                            Preview
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-info"
                            onclick="showImageModal('{{ asset('storage/uploads/' .$data->foto3) }}')">
                            Preview
                        </button>
                    </td>

                    <!-- Modal for displaying the enlarged image -->

                    <div id="imageModal" class="modal"
                        style="display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0, 0, 0, 0.8);">
                        <div class="modal-dialog modal-xl" style="margin: 20px auto; max-width: 100%;">
                            <div class="modal-content"
                                style="position: relative; margin: auto; padding: 0; text-align: center; border: 1px solid #888; width: 80%;  max-width: 1200px;">
                                <div class="modal-header">
                                    <span class="close" onclick="closeImageModal()"
                                        style="position: absolute; top: 15px; right: 20px; font-size: 40px; font-weight: bold; color: #888; cursor: pointer; z-index: 1;">&times;</span>
                                </div>
                                <div class="modal-body" style=":">
                                    <img class="modal-img" id="enlargedImg"
                                        style="display: block; max-width: 100%; maax-height: 100%; margin: auto; padding: 20px;">
                                </div>

                            </div>
                        </div>
                    </div>
                    <td>
                        @if ($data->status=='SELESAI')
                        <button type="button" class="btn btn-success" disabled>DITERIMA</button>
                        @elseif ($data->status=='PROSES')
                        <button type="button" class="btn btn-warning" disabled>DIPROSES</button>
                        @elseif ($data->status=='TOLAK')
                        <button type="button" class="btn btn-danger" disabled>DITOLAK</button>
                        @endif
                    </td>
                    <td>@if ($data->status !== 'SELESAI' && $data->status !== 'TOLAK')
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#editModal{{ $data->id_surat_izin }}">
                            Ubah
                        </button>
                        @endif
                    </td>
                </tr>
                <div class="modal fade" id="editModal{{ $data->id_surat_izin }}" tabindex="-1" role="dialog"
                    aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Ubah Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Form edit data -->
                                <form action="{{ route('surat-izin.update', $data->id_surat_izin) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <!-- Input fields -->
                                    <div class="form-row">
                                        <div class="col-12 col-md-6 mb-3" hidden>
                                            <label for="nama">ID user <b class="text-danger">*</b></label>
                                            <input readonly required placeholder="Masukkan NIM" type="text" id="id_user"
                                                name="id_user" class="form-control" value="{{ $user->id_user }}">
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="nama">NIM <b class="text-danger">*</b></label>
                                            <input readonly required placeholder="Masukkan NIM" type="text" id="nim"
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
                                    <div class="form-group">
                                        <div class="col-12 col-md-12 mb-3">
                                            <label for="jenis_perizinan">Jenis Perizinan <b
                                                    class="text-danger">*</b></label>
                                            <select id="jenis_perizinan" name="jenis_perizinan"
                                                class="form-control @error('jenis_perizinan') is-invalid @enderror"
                                                required>
                                                <option value="">- Pilih Jenis Perizinan -</option>
                                                <option value="Sakit">Sakit</option>
                                                <option value="Lembur Kerja">Lembur Kerja</option>
                                                <option value="Urusan Keluarga">Urusan Keluarga</option>
                                                <option value="Urusan Mendesak">Urusan Mendesak</option>
                                                <option value="Bekerja Shift">Bekerja Shift</option>
                                                <option value="Lainnya">Yang lain...</option>
                                            </select>
                                            <div id="lainnyaInputContainer" style="display: none;">
                                                <label for="lainnyaInput" class="mt-2">Perizinan Lainnya <b
                                                        class="text-danger">*</b></label>
                                                <input type="text" id="lainnyaInput" name="lainnyaInput"
                                                    class="form-control" style="width: 200px;"></input>
                                            </div>
                                            @error('jenis_perizinan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-12 mb-3">
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
                                    <div class="form-group">
                                        <div class="col-12 col-md-12 mb-3">
                                            <label for="nama">Nomor Telepon Orang tua/Wali<b
                                                    class="text-danger">*</b></label>
                                            <input required placeholder="Masukkan Nomor Telepon Ortu/Wali" type="number"
                                                id="nama_dan_nomor_telepon_orang_tua_wali"
                                                name="nama_dan_nomor_telepon_orang_tua_wali" class="form-control @error('nama_dan_nomor_telepon_orang_tua_wali') is-invalid
                                        @enderror" value="{{ $data->nama_dan_nomor_telepon_orang_tua_wali }}">
                                            @error('nama_dan_nomor_telepon_orang_tua_wali')
                                            <div class="invalid-feedback">{{ $message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-12 mb-3">
                                            <label for="nama">Nama Dosen Wali <b class="text-danger">*</b></label>
                                            <input required placeholder="Masukkan Nama Dosen Wali" type="text"
                                                id="nama_dosen_wali" name="nama_dosen_wali" class="form-control @error('nama_dosen_wali') is-invalid
                                            @enderror" value="{{ $data->nama_dosen_wali }}">
                                            @error('nama_dosen_wali')
                                            <div class="invalid-feedback">{{ $message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="col-12 col-md-12 mb-3">
                                            <label for="nama">Tanggal Mulai Izin</label> <b
                                                class="text-danger">*</b></label>
                                            <input required type="date" id="tanggal_mulai_izin"
                                                name="tanggal_mulai_izin" class="form-control @error('tanggal_mulai_izin') is-invalid
                                            @enderror" value="{{ $data->tanggal_mulai_izin }}">
                                            @error('tanggal_mulai_izin')
                                            <div class="invalid-feedback">{{ $message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-md-12 mb-3">
                                            <label for="nama">Tanggal Akhir Izin</label> <b
                                                class="text-danger">*</b></label>
                                            <input required type="date" id="tanggal_akhir_izin"
                                                name="tanggal_akhir_izin" class="form-control @error('tanggal_akhir_izin') is-invalid
                                            @enderror" value="{{ $data->tanggal_akhir_izin }}">
                                            @error('tanggal_akhir_izin')
                                            <div class="invalid-feedback">{{ $message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="nama">Foto Surat Bukti(Surat MC/ Surat Perintah Lembur/ Bukti
                                            izin
                                            lainnya) <b class="text-danger">*</b></label>
                                        <div class="form-group"> <img class="my-2 img-fluid"
                                                src="{{ asset('storage/uploads/' .$data->foto1) }}" width="20%">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Foto Bukti Chat Persetujuan Dosen Wali <b
                                                class="text-danger">*</b></label>
                                        <div class="form-group"> <img class="my-2 img-fluid"
                                                src="{{ asset('storage/uploads/' .$data->foto2) }}" width="20%">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Foto Surat Izin yang sesuai Format TU <b
                                                class="text-danger">*</b></label>
                                        <div class="form-group"> <img class="my-2 img-fluid"
                                                src="{{ asset('storage/uploads/' .$data->foto3) }}" width="20%">
                                        </div>
                                    </div>

                                    <div class="form-group form-check">
                                        <input type="hidden" name="ganti_ganti" value="0" />

                                        <input type="checkbox" name="ganti_foto" id="ganti_foto" value="1"
                                            onclick="check_ganti()" class="form_check-input" @if (old('ganti_foto')==1)
                                            checked @endif />
                                        <label for="ganti_foto" class="form-check-label">Ingin ganti foto?</label>
                                    </div>

                                    <div class="form-grup" id="upload-foto1" style="display:none">
                                        <div class="mb-3">
                                            <label for="foto">Upload Surat Bukti(Surat MC/ Surat Perintah Lembur/ Bukti
                                                izin
                                                lainnya) <b class="text-danger">*</b></label>
                                            <input type="file" id="foto1" name="foto1"
                                                class="form-control @error('foto1') is-invalid @enderror"
                                                value="{{ old('foto1') }}" accept="image/*">
                                            @error('foto1')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-grup" id="upload-foto2" style="display:none">
                                        <div class="mb-3">
                                            <label for="foto">Upload bukti Chat Persetujuan Dosen Wali <b
                                                    class="text-danger">*</b></label>
                                            <input type="file" id="foto2" name="foto2"
                                                class="form-control @error('foto2') is-invalid @enderror"
                                                value="{{ old('foto2') }}" accept="image/*">
                                            @error('foto2')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-grup" id="upload-foto3" style="display:none">
                                        <div class="mb-3">
                                            <label for="foto">Upload Surat Izin yang sesuai Format TU <b
                                                    class="text-danger">*</b></label>
                                            <input type="file" id="foto3" name="foto3"
                                                class="form-control @error('foto3') is-invalid @enderror"
                                                value="{{ old('foto3') }}" accept="image/*">
                                            @error('foto3')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    <!-- Submit button -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @empty
                <tr>
                    <td rowspan="100%">Anda belum mengajukan surat izin !</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="table-responsive" id="tabel2" style="display:none;">
        <table class="table table-bordered table-hover col-12" style="background: rgb(188, 188, 188);;">
            <h3>Tabel Pengajuan Surat Survey</h3>
            <thead>
                <td>No</td>
                <td>Nim</td>
                <td>Nama</td>
                <td>Alamat Instansi</td>
                <td>Alamat Tujuan</td>
                <td>Keperluan Mahasiswa</td>
                <td>Tugas Yang Dikerjakan</td>
                <td>Status</td>
                <td>File</td>
            </thead>
            <tbody>
                @forelse ( $surveys as $index => $data )
                @if ($data->id_user == auth()->user()->id_user)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $data->nim}}</td>
                    <td>{{ $data->nama}}</td>
                    <td>{{ $data->alamat_instansi }}</td>
                    <td>{{ $data->alamat_tujuan }}</td>
                    <td>{{ $data->keperluan_mahasiswa }}</td>
                    <td>{{ $data->tugas_yang_dikerjakan}}</td>
                    <td>
                        @if ($data->status=='TERIMA')
                        <button type="button" class="btn btn-success" disabled>DITERIMA</button>
                        @elseif ($data->status=='PROSES')
                        <button type="button" class="btn btn-warning" disabled>DIPROSES</button>
                        @elseif ($data->status=='TOLAK')
                        <button type="button" class="btn btn-danger" disabled>DITOLAK</button>
                        @endif

                    </td>
                    <td>@if ($data->status !== 'PROSES' && $data->status !== 'TOLAK')
                        <form id="action-form-{{ $data->id_surat_survey }}"
                            action="{{ url('survey/download', $data->id_surat_survey) }}" method="post">
                            @csrf
                            <button type="submit" download class="btn btn-primary">Unduh Berkas</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endif
                @empty
                <tr>
                    <td rowspan="100%">Anda belum mengajukan surat survey !</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
