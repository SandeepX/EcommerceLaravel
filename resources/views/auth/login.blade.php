<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>Login</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link rel="stylesheet"  href="{{asset('css/admin.css')}}">
</head>

<body class="bg-silver-300">
    <div class="content">
        <div class="brand">
            <a class="link" href="{{ route('login')}}">Site Login </a>
        </div>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h2 class="login-title">Log in</h2>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-envelope"></i></div>
                        <input class="form-control  @error('email') is-invalid @enderror" id="email" type= "email" name="email" placeholder="Email" value="{{ old('email') }}" autocomplete="off" required autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                    <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" placeholder="Password" autocomplete="current-password" required>
                   

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror



                </div>
            </div>
            <div class="form-group d-flex justify-content-between">
                <label class="ui-checkbox ui-checkbox-info">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                     {{ old('remember') ? 'checked' : '' }}>
                    <span class="input-span"></span>Remember me</label>
                <a  href="{{ route('password.request') }}">
                    {{ 'Forgot Your Password?' }}
                </a>
            </div>
            <div class="form-group">
                <button class="btn btn-info btn-block" type="submit">Login</button>
            </div>
            
            
            
        </form>
    </div>
    
    <script src="{{ asset('js/manifest.js') }}" ></script>
    <script src="{{ asset('js/vendor.js') }}" ></script>
    <script src="{{ asset('js/admin.js') }}" ></script>    
</body>

</html>