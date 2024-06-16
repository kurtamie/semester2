<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Register Mahasiswa | Talenthub Polibatam</title>

      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
      <!-- icheck bootstrap -->
      <link rel="stylesheet" href="{{ asset('/') }}plugins/icheck-bootstrap/icheck-bootstrap.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.min.css">
    <style>
        .green-background {
            background-color: rgb(0, 119, 255);
            padding: 10px;
            color: white;
        }
    </style>
</head>

<body style="background-color: rgb(255, 150, 208)">
    <!-- Section: Design Block -->
    <section class="text-center">
        <!-- Background image -->
        <div class="p-5 bg-image" style="background-image: url('dist/img/POLIBATAM.jpg'); height: 300px; width: px;">
        </div>
        <!-- Background image -->
        <div class="card mx-4 mx-md-5 shadow-5-strong"
            style="margin-top: -100px; background: hsla(0, 0%, 100%, 0.8); backdrop-filter: blur(0px);">
            <div class="card-body py-4 px-md-4">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6">
                        <h1 class="fw-bold mb-4">REGISTER</h1>
                        <form action="{{route('create')}}" method="post">
                            @csrf
                            <!-- 2 column grid layout with text inputs for the first and last names -->
                            @if(session('notifikasi'))
                            <div class="form-group">
                                <div class="alert alert-{{ session('type') }}">
                                {{ session('notifikasi') }}
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <input placeholder="Masukkan NIM" type="text" id="nim" name="nim" class="form-control @error('nim') is-invalid
                                    @enderror" value="{{ old('nim') }}">
                                    @error('nim')
                                    <div class="invalid-feedback">{{ $message}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" name="username"
                                            class="form-control @error('username') is-invalid @enderror" id="username"
                                            placeholder="Username" autofocus required value="{{ old('username') }}">
                                        @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" name="email"
                                            class="form-control @error('email') is-invalid @enderror" id="email"
                                            placeholder="E-mail" required value="{{ old('email') }}">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" name="nama"
                                            class="form-control @error('nama') is-invalid @enderror" id="nama"
                                            placeholder="Masukkan Nama Lengkap" required value="{{ old('nama') }}">
                                        @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" id="password"
                                        placeholder="Password" required>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <!-- Register buttons -->
                                <button type="submit" class="btn btn-primary btn-block">
                                    Register
                                </button>
                                <p>Sudah memiliki akun? Kembali ke
                                    <a href="/login">Login</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section: Design Block -->
    <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ asset('/') }}plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/') }}dist/js/adminlte.min.js"></script>
</body>

</html>
