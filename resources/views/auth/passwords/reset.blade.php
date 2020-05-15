<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/themify.css')}}">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">
</head>
<body>
<div class="container-fluid p-0">
    <!-- login page start-->
    <div class="auth-bg">
        <div class="authentication-box">
            <div class="text-center"><img src="{{asset('assets/images/meserapp_logo.png')}}" alt=""></div>
            <div class="card mt-4">
                <div class="card-body">
                    <div class="text-center">
                        <h4>{{ __("Restablecer contraseña") }}</h4>
                    </div>
                    <form class="theme-form" action="{{ route('password.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <label class="col-form-label pt-0">{{ __("Email") }}</label>
                            <input class="form-control" name="email" type="email" required="" value="{{ $email ?? old('email') }}" >
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">{{ __("Contraseña") }}</label>
                            <input class="form-control" name="password" type="password" required="" autocomplete="new-password">
                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">{{ __("Repetir Contraseña") }}</label>
                            <input class="form-control" name="password_confirmation" type="password" required="">
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Restablecer') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- login page end-->
</div>
</body>
</html>
