<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Bootstrap Core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Toash style -->
    <link href="/css/plugins/toastr.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <link href="{{ mix('/css/custom.css') }}" rel="stylesheet">


    @yield('styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>

        _methodFieldDelete = '{!! method_field('DELETE') !!}';

        _csrfToken = '{!! csrf_field() !!}';

        @yield('js-var')
    </script>

</head>

<body>

    <div id="wrapper">

        <!-- menu & sidebar here -->
        @include('admin.layouts.navigation')
        <!-- Content Here -->
        @yield('content')

    </div>

    <!-- jQuery -->
    <script src="/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="/js/toastr.min.js"></script>

    @if(session()->has('notification.message'))
        <script>
            setTimeout(function() {
                toastr.{{ session()->get('notification.type') }}('{{ session()->get('notification.message') }}')
            }, 1000);
        </script>
    @endif

    <script>
        $(document).on('click', '.do-logout', function(e) {
            e.preventDefault();
            $('.form-logout').submit();
        })
    </script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/vendor/metisMenu/metisMenu.min.js"></script>
    <script src="{{ mix('/js/main.js') }}"></script>
    <script src="{{ mix('/js/utils.js') }}"></script>
    <script src="{{ mix('/js/datatable-builder.js') }}"></script>
    @yield('scripts')
</body>

</html>
