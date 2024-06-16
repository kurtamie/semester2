@extends('layout.main')

@section('judul')
HALAMAN DASHBOARD
@endsection

@section('isi')

<div class="card" style="background-color: #ABC4AA">
    <div class="card-header mb-3" style="background-color: #A9907E">
        <h3 class="card-title">Selamat Datang, {{ $user->nama }}</h3>
    </div>
    @if($user->level == 'mahasiswa')
    <div class="card-body" style="background-color: #A9907E">
        <div class="alert" style="background-color: #ABC4AA; font-size: 20px;">
            Silahkan pilih pengajuan surat yang anda perlukan. Pilihlah yang anda butuh, jangan asal pilih karena suatu pilihan itu berarti
            untuk kerdepannya. <br>
            Si-SURAT adalah Sistem Pengajuan Surat. Sistem ini membantu anda untuk mengajukan surat izin dan surat survey. Maaf kami tidak bisa
            membantu untuk memecahkan masalah terberat anda karena yang bisa membantu masalah terberat anda hanya Tuhan.
        </div>
    </div>
    <div class="body" style="background-color: #A9907E">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <div class="card text-center" style="background-color: #F3DEBA">
                        <div class="card-body">
                            <h5 class="card-title-center mb-3" style="color: black">Pengajuan Surat Izin</h5>
                            <a href="letter/add" class="btn btn-primary">Ajukan Surat Izin</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card text-center" style="background-color: #F3DEBA">
                        <div class="card-body">
                            <h5 class="card-title-center mb-3" style="color: black">Pengajuan Surat Survey</h5>
                            <a href="survey/add" class="btn btn-primary">Ajukan Surat Survey</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($user->level == 'admin')
    <div class="card-body"style="background-color: #A9907E">
        <div class="form-group">
            <div class="col-sm-4 mb-3">
                @if(session('notifikasi'))
                <div class="alert alert-{{ session('type') }}">
                    {{ session('notifikasi') }}
                </div>
                @endif
            </div>
        </div>
        <div class="row mt-3 mb-3">
            <div class="col-lg-6 mb-4">
                <div class="card-data" style="border: solid 1px; background-color: #F3DEBA">
                    <div class="row">
                        <div class="col-6" style="font-size: 80px; padding: 50px 30px;"><i class="fas fa-book"></i></div>
                        <div class="col-6 d-flex flex-column justify-content-center">
                            <div class="card-desc" style="font-size: 30px;">Surat Izin</div>
                            <div class="card-count" style="font-size: 20px;">Surat Diterima : {{$totalSelesai}}</div>
                            <div class="card-count" style="font-size: 20px;">Surat Diproses : {{$totalDiproses}}</div>
                            <div class="card-count mb-3" style="font-size: 20px;">Surat Ditolak : {{$totalTolak}}</div>
                            <a href="/tabel_izin" class="btn btn-info mr-3">Lihat Surat Izin</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card-data" style="border: solid 1px; background-color: #F3DEBA">
                    <div class="row">
                        <div class="col-6" style="font-size: 80px; padding: 50px 30px;"><i class="fas fa-list"></i></div>
                        <div class="col-6 d-flex flex-column justify-content-center">
                            <div class="card-desc" style="font-size: 30px;">Surat Survey</div>
                            <div class="card-count" style="font-size: 20px;">Surat Diterima : {{$totalDiterima}}</div>
                            <div class="card-count" style="font-size: 20px;">Surat Diproses : {{$totalProses}}</div>
                            <div class="card-count mb-3" style="font-size: 20px;">Surat Ditolak : {{$totalDitolak}}</div>
                            <a href="/tabel_survey" class="btn btn-info mr-3">Lihat Surat Survey</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection
