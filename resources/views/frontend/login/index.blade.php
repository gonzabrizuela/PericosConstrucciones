@extends('frontend/layouts.app')

@section('content')
<link rel="stylesheet" href="css/frontend/login.css">

<div class="container mt-5">
    <h2 class="text-center justify-content-center mt-5 mb-3" style="font-size:25px;color: #000">Ingresar</h2>
   
    <form method="POST" action="{{ route('login') }}" style="display:none" id="form-login" class="row mt-4">
        {{csrf_field()}}
        
        <div class="  col-12 m-auto">
            <div class="form-group">
                
                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="E-mail" aria-describedby="emailHelp">
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>Credenciales no v&aacute;lidas.</strong>
                    </span>
                    @endif  
              </div>
        </div>
  
        
        <div class=" col-12 m-auto">
            <div class="form-group">
                
                <input id="password" type="password" name="password" class="input-password form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Contraseña"  aria-describedby="emailHelp">
                <div class="eye">
                   <a id="eye-pass" onclick="unlockPass()" style=""><i class="far fa-eye"></i></a>  
                </div>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
            </div>

        </div>
   
        <div class=" col-12 mt-3">
            
            <button type="submit" id="submitBtn" class="btn-block btn  "  >
                {{ __('Login') }}
            </button>
        </div>
        
        <div class="text-center mt-3 col-12 ">
            
            <p style="font-size: 1rem;color:#000;">¿No tienes cuenta? <strong> <a  id="createAc" class="ml-2" style="text-decoration: none;color:#000;font-weight: bold;"  href="{{ route('register.index') }}">Registrate ahora</a></strong>
            </p>
        </div>

    </form>

</div>

<script>
$( document ).ready(function() {
    $('#form-login').fadeIn(1000);
});
var pass_view = 0;
function unlockPass(){
    event.preventDefault();
    if(pass_view == 0)
    {
        $('#password').attr('type','text');
        $('.fa-eye').addClass('fa-eye-slash');
        $('.fa-eye').removeClass('fa-eye');
        pass_view = 1;
    }
    else{
        $('#password').attr('type','password');
        $('.fa-eye-slash').addClass('fa-eye');
        $('.fa-eye-slash').removeClass('fa-eye-slash');
        pass_view = 0;
        
    }
    
}
</script>

@endsection
