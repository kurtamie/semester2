@extends('layout.main')

@section('judul')
Halaman Pengajuan Surat
@endsection

@section('isi')
<div class="filter-container mb-3">
    <label for="filter">Saring dengan:</label>
    <select id="filter">
        <option value="nim">NIM</option>
        <option value="nama">Nama</option>
    </select>
    <input type="text" id="search-input" placeholder="Pencarian...">
    <button id="search-btn">Cari</button>
</div>
<div class="table-responsive">
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
            @if ($data->status=='PROSES')
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
                    <button type="button" class="btn btn-success" disabled>SELESAI</button>
                    @elseif ($data->status=='PROSES')
                    <button type="button" class="btn btn-warning" disabled>PROSES</button>
                    @elseif ($data->status=='TOLAK')
                    <button type="button" class="btn btn-danger" disabled>TOLAK</button>
                    @endif

                </td>
                <td>
                    <form id="upload-form-{{ $data->id_surat_survey }}"
                        action="{{ url('upload', $data->id_surat_survey) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="pdf_file">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </td>
                <td>
                    <form id="action-form-{{ $data->id_surat_survey }}"
                        action="{{ url('reject', $data->id_surat_survey ) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <button type="submit" class="btn btn-danger">TOLAK</button>
                    </form>
                </td>
            </tr>
            @endif
            @empty
            <tr>
                <td colspan="9">Tidak ada data untuk ditampilkan!</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<a href="/home" class="btn btn-danger mt-5">
    <- Kembali </a>

@endsection
