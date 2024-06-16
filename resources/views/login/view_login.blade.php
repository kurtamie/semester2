<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page" style="background-image: url('dist/img/poltek.jpg');">
    @if(session('notifikasi'))
    <div class="form-group col-lg-6">
        <div class="alert alert-{{ session('type') }}">
            {{ session('notifikasi') }}
        </div>
    </div>
    @endif
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline" style="background-color: #F3DEBA">
            <div class="card-header text-center">
                <h1><strong>MASUK</strong></h1>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Silahkan masukan Username dan Password anda!</p>
                <form action="{{ url('login/proses') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-4">
                        <input autofocus type="text" class="form-control
                        @error('username')
                            is-invalid
                        @enderror
                        " placeholder="Username" name="username" value="{{ old('username') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" class="form-control
                        @error('password')
                            is-invalid
                        @enderror
                        " placeholder="Password" name="password" value="{{ old('password') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row">

                        <div class="col-12">
                            <button type="submit" class="btn btn-success btn-block">Masuk</button>
                        </div>

                    </div>
                </form>

                <p class="mt-2 mb-2">
                    <a href="/register" class="text-center">Daftar pengguna baru</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('/') }}plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/') }}dist/js/adminlte.min.js"></script>
</body>

</html>
