@extends('layout.main')

@section('judul')
Halaman Riwayat Pengajuan Surat
@endsection

@section('isi')
<div class="form-group">
    <div class="col-sm-4 mb-3">
        @if(session('notifikasi'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('notifikasi') }}
        </div>
        @endif
    </div>
</div>


{{-- Tabel Pengajuan Surat --}}
<div class="filter-container mb-3">
    <label for="filter">Saring dengan:</label>
    <select id="filter">
        <option value="nim">NIM</option>
        <option value="nama">Nama</option>
    </select>
    <input type="text" id="search-input" placeholder="Pencarian...">
    <button id="search-btn">Cari</button>
</div>

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

{{-- Tabel Surat Izin --}}
<div class="table-responsive" id="tabel1" style="display:none;">
    <table id="surat-izin-table" class="table table-bordered table-hover " style="background: rgb(188, 188, 188);">
        <h3>Pengajuan Surat Izin</h3>
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
            <td>Konfirmasi</td>
        </thead>
        <tbody>
            @forelse ( $letters as $index => $data )
            @if ($data->status === 'SELESAI' || $data->status === 'TOLAK')
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
                    <div>
                        @if ($data->status=='SELESAI')
                        <button type="button" class="btn btn-success" disabled>DITERIMA</button>
                        @elseif ($data->status=='PROSES')
                        <button type="button" class="btn btn-warning" disabled>PROSES</button>
                        @elseif ($data->status=='TOLAK')
                        <button type="button" class="btn btn-danger" disabled>TOLAK</button>
                        @endif
                        {{-- <button type="button" class="btn btn-warning" disabled>{{ $data->status}}</button> --}}
                    </div>
                </td>
                <td>
                    <form id="action-form-{{ $data->id_surat_izin }}" action="{{ url('terima', $data->id_surat_izin) }}"
                        method="post">
                        @csrf
                        <button type="submit" class="btn btn-success">TERIMA</button>
                    </form>
                    <form id="action-form-{{ $data->id_surat_izin  }}"
                        action="{{ url('tolak', $data->id_surat_izin ) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger">TOLAK</button>
                    </form>
                </td>
            </tr>
            @endif
            @empty
            <tr>
                <td rowspan="100%">Tidak ada data untuk ditampilkan !</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
{{-- Tabel Surat Survey --}}
<div class="table-responsive" id="tabel2" style="display:none;">
    <table id="surat-survey-table" class="table table-bordered table-hover col-12"
        style="background: rgb(188, 188, 188);;">
        <h3 class="mt-3">Pengajuan Surat Survey</h3>
        <thead>
            <td>No</td>
            <td>Nim</td>
            <td>Nama</td>
            <td>Nama dan Bagian Perusahaan</td>
            <td>Alamat</td>
            <td>Keperluan Mahasiswa</td>
            <td>Tugas Yang Dikerjakan</td>
            <td>Status</td>
            <td>Upload</td>
            <td>Aksi</td>
        </thead>
        <tbody>
            @forelse ( $surveys as $index => $data )
            @if ($data->status === 'TERIMA' || $data->status === 'TOLAK')
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $data->nim}}</td>
                <td>{{ $data->nama}}</td>
                <td>{{ $data->nama_dan_bagian_perusahaan }}</td>
                <td>{{ $data->alamat }}</td>
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
                <td>
                    @if ($data->status!=='TERIMA')
                    <form id="upload-form-{{ $data->id_surat_survey }}"
                        action="{{ url('upload', $data->id_surat_survey ) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="pdf_file" class="mb-3">
                        <button type="submit" class="btn btn-primary mt-2">Upload</button>
                    </form>
                    @endif
                </td>
                <td>
                    <form id="action-form-{{ $data->id_surat_survey }}"
                        action="{{ url('reject', $data->id_surat_survey ) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <button type="submit" class="btn btn-danger">BATAL</button>
                    </form>
                </td>
            </tr>
            @endif
            @empty
            <tr>
                <td rowspan="100%">Tidak ada data untuk ditampilkan !</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>


@endsection
