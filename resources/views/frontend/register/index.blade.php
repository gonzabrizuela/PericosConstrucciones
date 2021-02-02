@extends('frontend/layouts.app')

@section('content')
<link rel="stylesheet" href="css/frontend/register.css">
<div class="container mt-5">
    <h2 class="text-center  mb-3" style="font-size:25px;color: #000">Registro</h2>
    

<form method="POST" style="display: none;" id="form_register" action="{{ route('register.store') }}" role="form"
enctype="multipart/form-data">
{{ csrf_field() }}



<div class="row">

    <div class="form-group col-12">
        
        <input id="name" name="name" maxlength="60"
            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
            placeholder="Nombre" value="{{ old('name') }}">
        @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
            <strong>Debe ingresar un nombre.</strong>
        </span>
        @endif
    </div>

    <div class="form-group col-12  ">
        
        <input id="last_name" name="last_name" maxlength="60"
            class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
            placeholder="Apellido" value="{{ old('last_name') }}">
        @if ($errors->has('last_name'))
        <span class="invalid-feedback" role="alert">
            <strong>Debe ingresar un apellido.</strong>
        </span>
        @endif
    </div>

    

</div>
<div class="row">
<div class="form-group col-12">
    
    <input id="email" name="email" maxlength="60"
        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
        placeholder="Email" value="{{ old('email') }}">
    @if ($errors->has('email'))
    <span class="invalid-feedback" role="alert">
        <strong>Debe ingresar un email.</strong>
    </span>
    @endif
    @if ($errors->has('duplicated_email_error'))
    <span class="invalid-feedback" role="alert" style="display:block;">
        <strong>El email ingresado ya se encuentra registrado.</strong>
    </span>
    @endif
</div>


<div class="form-group col-12">
    
    <input id="phone" name="phone" maxlength="60"
        class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
        placeholder="Teléfono" value="{{ old('phone') }}">
    @if ($errors->has('phone'))
    <span class="invalid-feedback" role="alert">
        <strong>Debe ingresar un teléfono.</strong>
    </span>
    @endif
</div>
</div>
<div class="row mb-3">
    
        
    <div class=" col-12 m-auto" id="box_password">
        <div class="form-group">
            
            <input id="password" type="password" name="password" class="input-password form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Contraseña"  aria-describedby="emailHelp">
            <div class="eye">
               <a id="eye-pass" onclick="unlockPass(0)" style=""><i id="eye-pass-icon" class="far fa-eye"></i></a>  
            </div>
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>Debe ingresar un password (min. 8 caracteres).</strong>
                </span>
                @endif
        </div>

    </div>

</div>
<div class="row mb-3">
    {{-- <div class="form-group col-12" id="box_password">
       
        <input type="password" id="verif_password" name="verif_password"
            class="form-control{{ $errors->has('verif_password') ? ' is-invalid' : '' }}"
            placeholder="Confirmar Contraseña" value="{{ old('verif_password') }}">
        @if ($errors->has('verif_password'))
        <span class="invalid-feedback" role="alert">
            <strong>Las contraseñas deben ser iguales.</strong>
        </span>
        @endif
    </div> --}}

    
    <div class=" col-12 m-auto" id="box_password">
        <div class="form-group">
            
            <input id="verif_password" type="password" name="verif_password" class="input-password form-control{{ $errors->has('verif_password') ? ' is-invalid' : '' }}" placeholder="Confirmar Contraseña">
            <div class="eye">
               <a id="eye-pass" onclick="unlockPass(1)" style=""><i id="eye-pass-verif-icon" class="far fa-eye"></i></a>  
            </div>
            @if ($errors->has('verif_password'))
                <span class="invalid-feedback" role="alert">
                    <strong>Las contraseñas deben ser iguales.</strong>
                </span>
                @endif
        </div>

    </div>


    </div>
    <div class="row">
        <div class="col-12">
            
            <button type="submit" id="submitBtn" class="btn-block btn  "  >
                Registrarme
            </button>
            
        </div>
    </div>
    </form>

</div>

<script>
$( document ).ready(function() {
    $('#form_register').fadeIn(1000);
});
</script>



<script>
    var pass_view = 0;
    var verif_view = 0;
    function unlockPass(type){
        event.preventDefault();
        if(type == 0)
        {
            if(pass_view == 0)
            {
                $('#password').attr('type','text');
                $('#eye-pass-icon').addClass('fa-eye-slash');
                $('#eye-pass-icon').removeClass('fa-eye');
                pass_view = 1;
            }
            else{
                $('#password').attr('type','password');
                $('#eye-pass-icon').addClass('fa-eye');
                $('#eye-pass-icon').removeClass('fa-eye-slash');
                pass_view = 0;
            }
        }
        else{
            if(verif_view == 0)
            {
                $('#verif_password').attr('type','text');
                $('#eye-pass-verif-icon').addClass('fa-eye-slash');
                $('#eye-pass-verif-icon').removeClass('fa-eye');
                verif_view = 1;
            }
            else{
                $('#verif_password').attr('type','password');
                $('#eye-pass-verif-icon').addClass('fa-eye');
                $('#eye-pass-verif-icon').removeClass('fa-eye-slash');
                verif_view = 0;
            }
        }
        
        
    }
    </script>
@endsection
