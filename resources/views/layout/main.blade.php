<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Surat-menyurat</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.min.css">
</head>

<style>
    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<body class="hold-transition sidebar-mini" style="background-color: #ABC4AA">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar sticky-top navbar-expand navbar-white navbar-light"
            style="background-color: #F3DEBA">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('logout') }}" role="button">
                        <i class="nav-icon fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4" style="position:fixed; background-color: #675D50">
            <!-- Brand Logo -->
            <a class="brand-link">
                <img src="{{ asset('/') }}dist/img/Sisurat.jpg" alt="Logo SI-SURAT"
                    class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight" style="color: white">SI-SURAT</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('/') }}dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a class="d-block" style="color: white">
                            {{ $user->nama }}
                        </a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @include('layout.menu')
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #ABC4AA">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="group mb-2">
                        <div class="col-sm-6">
                            <h1>
                                @yield('judul')
                            </h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content" style="background-color: #ABC4AA">
                <!-- Default box -->
                @yield('isi')
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer" style="background-color: #F3DEBA">
            <div class="float-right d-none d-sm-block">
            </div>
            <strong>SI-SURAT </strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('/') }}plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/') }}dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/') }}dist/js/demo.js"></script>

    <script>
        var jenisKeperluanSelect = document.getElementById("jenis_perizinan");
        var lainnyaInputContainer = document.getElementById("lainnyaInputContainer");
        var lainnyaInput = document.getElementById("lainnyaInput");

        jenisKeperluanSelect.addEventListener("change", function () {
            if (jenisKeperluanSelect.value === "lainnya") {
                lainnyaInputContainer.style.display = "block";
                lainnyaInput.setAttribute("required", "required");
            } else {
                lainnyaInputContainer.style.display = "none";
                lainnyaInput.removeAttribute("required");
            }
        });

    </script>
    <script>
        document.getElementById('jenis_keperluan').addEventListener('change', function () {
            var style = this.value == 'izin' ? 'block' : 'none';
            document.getElementById('tabel1').style.display = style;
        });

    </script>
    <script>
        document.getElementById('jenis_keperluan').addEventListener('change', function () {
            var style = this.value == 'survey' ? 'block' : 'none';
            document.getElementById('tabel2').style.display = style;
        });

    </script>


    <script>
        // Get table elements
        const suratIzinTable = document.getElementById('surat-izin-table');
        const suratSurveyTable = document.getElementById('surat-survey-table');

        // Get filter and search elements
        const filterSelect = document.getElementById('filter');
        const searchInput = document.getElementById('search-input');
        const searchButton = document.getElementById('search-btn');

        // Add event listener to search button
        searchButton.addEventListener('click', filterData);

        // Function to filter and display data based on selected filter and search input
        function filterData() {
            const filter = filterSelect.value;
            const searchTerm = searchInput.value.trim().toLowerCase();

            // Filter and display data for Pengajuan Surat Izin table
            const suratIzinRows = suratIzinTable.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            Array.from(suratIzinRows).forEach(row => {
                const data = row.getElementsByTagName('td')[filter === 'nim' ? 1 : 2].textContent.toLowerCase();
                if (data.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Filter and display data for Pengajuan Surat Survey table
            const suratSurveyRows = suratSurveyTable.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            Array.from(suratSurveyRows).forEach(row => {
                const data = row.getElementsByTagName('td')[filter === 'nim' ? 1 : 2].textContent.toLowerCase();
                if (data.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

    </script>

    {{-- Filter Tabel Izin --}}
    <script>
        const suratIzinTable = document.getElementById('surat-izin-table');

        const filterSelect = document.getElementById('filter');
        const searchInput = document.getElementById('search-input');
        const searchButton = document.getElementById('search-btn');

        // Add event listener to search button
        searchButton.addEventListener('click', filterData);

        function filterData() {
            const filter = filterSelect.value;
            const searchTerm = searchInput.value.trim().toLowerCase();

            // Filter and display data for Pengajuan Surat Izin table
            const suratIzinRows = suratIzinTable.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            Array.from(suratIzinRows).forEach(row => {
                const data = row.getElementsByTagName('td')[filter === 'nim' ? 1 : 2].textContent.toLowerCase();
                if (data.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

    </script>

    {{-- Filter Tabel Survey --}}
    <script>
        const suratSurveyTable = document.getElementById('surat-survey-table');

        const filterSelect = document.getElementById('filter');
        const searchInput = document.getElementById('search-input');
        const searchButton = document.getElementById('search-btn');

        // Add event listener to search button
        searchButton.addEventListener('click', filterData);

        // Function to filter and display data based on selected filter and search input
        function filterData() {
            const filter = filterSelect.value;
            const searchTerm = searchInput.value.trim().toLowerCase();

            const suratSurveyRows = suratSurveyTable.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            Array.from(suratSurveyRows).forEach(row => {
                const data = row.getElementsByTagName('td')[filter === 'nim' ? 1 : 2].textContent.toLowerCase();
                if (data.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        // Fungsi untuk mengatur tampilan modal saat tombol "Preview" diklik
        $(document).ready(function () {
            // Fungsi untuk memanggil modal
            $(".preview-btn").click(function () {
                var target = $(this).data("target");
                $(target).modal("show");
            });

            // Fungsi untuk menutup modal saat tombol "X" diklik
            $(".modal").on("click", ".close", function () {
                $(this).closest(".modal").modal("hide");
            });
        });

    </script>

    <script>
        function check_ganti() {
            let ganti = document.getElementById('ganti_foto');
            let uploadFoto1 = document.getElementById('upload-foto1');
            let uploadFoto2 = document.getElementById('upload-foto2');
            let uploadFoto3 = document.getElementById('upload-foto3');

            if (ganti.checked) {
                uploadFoto1.style.display = 'block';
                uploadFoto2.style.display = 'block';
                uploadFoto3.style.display = 'block';
            } else {
                uploadFoto1.style.display = 'none';
                uploadFoto2.style.display = 'none';
                uploadFoto3.style.display = 'none';
            }
        }
    </script>

<script>
    function showImageModal(src) {
        var modal = document.getElementById("imageModal");
        var modalImg = document.getElementById("enlargedImg");
        modal.style.display = "block";
        modalImg.src = src;
    }

    function closeImageModal() {
        var modal = document.getElementById("imageModal");
        modal.style.display = "none";
    }
</script>

<script>
    function closeImageModal() {
        document.getElementById("imageModal").style.display = "none";
    }

    // Memperbarui tautan gambar saat gambar diklik
    var modalImg = document.getElementById("enlargedImg");
    var images = document.querySelectorAll(".gallery-img");

    images.forEach(function (image) {
        image.onclick = function () {
            modalImg.src = this.src;
            document.getElementById("imageModal").style.display = "block";
        };
    });
</script>

</body>

</html>
