<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DATA PEMINJAMAN BUKU TANAH ARSIP ATR/BPN GARUT</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        :root {
            --primary-color: #004d00;
            --primary-light: #006600;
            --primary-dark: #003300;
            --accent-color: #008000;
            --text-dark: #333333;
            --text-light: #666666;
            --border-color: #e0e0e0;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --info-color: #17a2b8;
        }

        body#page-top {
            background-color: #f8f9fa;
            color: var(--text-dark);
        }

        /* Sidebar Styling */
        .sidebar {
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--primary-light) 100%) !important;
            box-shadow: 2px 0 10px rgba(0, 77, 0, 0.15);
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            padding-left: 1.25rem;
        }

        .sidebar .nav-link:hover {
            color: white;
            background-color: rgba(0, 77, 0, 0.1);
            border-left-color: white;
        }

        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: white;
            font-weight: 600;
        }

        .sidebar-brand {
            background: rgba(0, 0, 0, 0.1);
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand-text {
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
        }

        /* Navbar Styling */
        .topbar {
            background: white !important;
            border-bottom: 2px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .topbar .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            border: none;
            transition: all 0.3s ease;
        }

        .topbar .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-light), var(--accent-color));
            box-shadow: 0 4px 12px rgba(0, 77, 0, 0.3);
            transform: translateY(-2px);
        }

        /* Page Heading */
        .d-sm-flex.align-items-center h1 {
            color: var(--primary-color);
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        /* Card Styling */
        .card {
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border-radius: 12px;
        }

        .card:hover {
            box-shadow: 0 4px 16px rgba(0, 77, 0, 0.15);
            transform: translateY(-2px);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
            border-radius: 12px 12px 0 0;
            font-weight: 600;
            border: none;
        }

        /* Button Styling */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            border: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 77, 0, 0.15);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-light), var(--accent-color));
            box-shadow: 0 4px 16px rgba(0, 77, 0, 0.3);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
        }

        /* Table Styling */
        .table thead th {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
            border: none;
            font-weight: 600;
            border-radius: 8px 8px 0 0;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 77, 0, 0.05);
        }

        /* Footer Styling */
        .sticky-footer {
            background: white;
            border-top: 2px solid var(--border-color);
            color: var(--text-light);
        }

        /* Modal Styling */
        .modal-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            color: white;
            border: none;
        }

        .modal-header .close {
            color: white;
            opacity: 0.8;
        }

        .modal-header .close:hover {
            opacity: 1;
        }

        /* Badge Styling */
        .badge-danger {
            background-color: var(--danger-color);
        }

        /* Alert Styling */
        .alert-danger {
            background-color: #fee;
            color: var(--danger-color);
            border-left: 4px solid var(--danger-color);
            border-radius: 8px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid var(--success-color);
            border-radius: 8px;
        }

        /* Form Input Styling */
        .form-control {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(0, 77, 0, 0.1);
        }

        /* Scroll to Top Button */
        .scroll-to-top {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(0, 77, 0, 0.3);
            transition: all 0.3s ease;
        }

        .scroll-to-top:hover {
            background: linear-gradient(135deg, var(--primary-light), var(--accent-color));
            box-shadow: 0 4px 16px rgba(0, 77, 0, 0.4);
            transform: translateY(-2px);
        }

        /* Divider Styling */
        .sidebar-divider {
            border-color: rgba(255, 255, 255, 0.15);
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
      @include('layouts/sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
               @include('layouts/navbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">DATA PEMINJAMAN BUKU TANAH ARSIP ATR/BPN GARUT</h1>
                    </div>
                    @yield('content')
                    <!-- Content Row -->
                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('layouts/footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #10b981, #059669); color: white; border: none;">
                    <h5 class="modal-title" id="logoutModalLabel">Keluar dari Sistem</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin keluar dari aplikasi?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }} "></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

</body>

</html>


