<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>IMS - Login</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <!-- Jquery JS-->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

    <style>
        .body {
            margin: 0px;
            padding: 0px;
        }
    </style>

</head>

<body style="background-color: #f4f6f9">
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 10%">
            <div class="col-md-8 mt-4">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <h2>Welcome User</h2>
                        <div>
                            <form id="logout-form" action="
                            {{ route('logout') }}
                            " method="POST" class="d-none">
                                @csrf
                            </form>
                            <a class="btn btn-primary" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                            >
                                {{ __('Logout') }} 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- Sweet Alert JS --}}
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script>
    @if (Session::has('success'))
        <script>
            swal("Great Job!", "{!! Session::pull('success') !!}", "success", {
                button: "OK",
                closeOnClickOutside: true,
            });
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            swal("Sorry!", "{!! Session::pull('error') !!}", "error", {
                button: "OK",
                closeOnClickOutside: true,
            });
        </script>
    @endif
</body>

</html>
