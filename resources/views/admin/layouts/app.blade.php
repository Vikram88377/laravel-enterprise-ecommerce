<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('admin.layouts.navbar')

    @include('admin.layouts.sidebar')

    <div class="content-wrapper">

                        <section class="content-header">

                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-sm-6">

                                        <h1>@yield('title')</h1>

                                    </div>

                                    <div class="col-sm-6">

                                        <ol class="breadcrumb float-sm-right">

                                            <li class="breadcrumb-item">

                                                <a href="{{ route('admin.dashboard') }}">

                                                    Dashboard

                                                </a>

                                            </li>

                                            <li class="breadcrumb-item active">

                                                @yield('title')

                                            </li>

                                        </ol>

                                    </div>

                                </div>

                            </div>

                        </section>

        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>

    </div>

    @include('admin.layouts.footer')

</div>

<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(function () {
        $('.datatable').DataTable();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>