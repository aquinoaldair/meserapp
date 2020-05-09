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
            <div class="text-center"><img src="{{asset('assets/images/endless-logo.png')}}" alt=""></div>
            <div class="card mt-4">
                <div class="card-body">
                    <div class="text-center">
                        <h4>Inicio de sesion</h4>
                    </div>


                    <form class="theme-form" action="{{ route('login') }}" method="post">
                        @csrf
                        @error('email')
                        <div class="alert alert-warning outline" role="alert">
                            <p class="text-center">Ingrese correctamente los datos</p>
                        </div>
                        @enderror
                        <div class="form-group">
                            <label class="col-form-label pt-0">Email</label>
                            <input class="form-control" name="email" type="email" required="">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Contraseña</label>
                            <input class="form-control" name="password" type="password" required="">
                        </div>
                        <div class="checkbox p-0">
                            <input id="checkbox1" type="checkbox" name="remember">
                            <label for="checkbox1">Recordar</label>
                        </div>
                        <div class="form-group form-row mt-3 mb-0">
                            <button class="btn btn-primary btn-block" type="submit">Ingresar</button>
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
