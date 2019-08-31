<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/assets/img/favicon/asta.png" type="image/x-icon">
    <link rel="icon" href="/assets/img/favicon/asta.png" type="image/x-icon">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/notification.css">

    <title>Document</title>
</head>
<body>
    {{--popup warning login--}}
<script src="/js/warnpopuplogin.js"></script>
<div id="dialogoverlay"></div>
<div id="dialogbox">
  <div>
    <div id="dialogboxhead"></div>
    <div id="dialogboxbody"></div>
    <div id="dialogboxfoot"></div>
  </div>
</div>
{{ Session::get('userId') }}
{{ Cache::get('op_key') }}

@if(\Session::has('alert'))
<script>
  Alert.render ("{{Session::get('alert')}}");
</script>
@endif
@if(\Session::has('alert-success'))
<script>
  Alert.render ("{{Session::get('alert-success')}}");
<script>
@endif

    <div class="d-flex flex-row w-100 h-100">
        <div class="d-flex flex-column my-aii-login">

            <div class="login-logo">
                <div class="margin-login">
                    <img src="/images/login/logo.png" alt="logo" height="80%">
                </div>
            </div>

            <div class="form-login ">
                <div class="aii-login">
                    <div class="margin-login">
                        <form method="post" action="{{ route('login') }}">
                            {{  csrf_field() }}
                            <div class="username">
                                <input type="text" name="username" id="" placeholder="username">
                                <i class="far fa-user fa-2x"></i>
                            </div>
                            <div class="password">
                                <input type="password" name="password" id="password-field" placeholder="password">
                                <i class="fas fa-lock fa-2x lock"></i>
                                <i id="pass-status" class="fa fa-eye eye" aria-hidden="true" onClick="viewPassword()"></i>
                            </div>
                            <button class="btn-login rounded-pill">LOGIN ></button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <div class="background-login ">
            <img src="/images/login/qq2.png" alt="" height="90%" width="90%">
        </div>

    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
    function viewPassword()
{
  var passwordInput = document.getElementById('password-field');
  var passStatus = document.getElementById('pass-status');
 
  if (passwordInput.type == 'password'){
    passwordInput.type='text';
    passStatus.className='fa fa-eye-slash';
    
  }
  else{
    passwordInput.type='password';
    passStatus.className='fa fa-eye';
  }
}

    </script>
</body>
</html>