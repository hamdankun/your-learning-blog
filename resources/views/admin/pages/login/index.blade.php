<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ env('DIST_PATH') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ env('DIST_PATH') }}/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ env('DIST_PATH') }}/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="{{ env('DIST_PATH') . mix('/css/custom.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="logo-area">
                    <img src="{{ env('DIST_PATH') }}/images/logo.png" class="img-responsive" alt="Your Learning Logo">
                </div>
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        @if(session()->has('notification.message'))
                            <div class="alert alert-danger">
                                {{ session()->get('notification.message') }}
                            </div>
                        @endif
                        <form action="{{ route('admin.login.attemp') }}" method="POST" class="login-form">
                            <fieldset>
                            {{ csrf_field() }}
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <input class="form-control" placeholder="E-mail" name="email" type="text" value="{{ old('email') }}" autofocus>
                                    {!! $errors->has('email') ? $errors->first('email', '<span class="help-block">:message</span>') : '' !!}
                                </div>
                                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                    {!! $errors->has('password') ? $errors->first('password', '<span class="help-block">:message</span>') : '' !!}
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="1">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block do-login">
                                    Login
                                </button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ env('DIST_PATH') }}/vendor/jquery/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $(document).on('submit', '.login-form', function() {
                var _btnLogin = $('.do-login');
                _btnLogin.prop('disabled', true);
                _btnLogin.html('<i class="fa fa-spinner fa-spin"></i>');
                $(this).submit();
            });
        });
    </script>
</body>

</html>
