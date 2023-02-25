@extends('layouts.header')

@section('content')
<div class="container">
    <div class="card d-flex justify-content-around flex-wrap" id="base">
        <div class="card-header" id="head_users">
            <h3>Actualizar Usuarios<h3>
        </div>
        <div class="alert alert-danger mt-2 d-none" id="alertDanger">
            <li>Minimo 8 caracteres</li>
            <li>Maximo 15</li>
            <li>Al menos una letra mayúscula</li>
            <li>Al menos una letra minucula</li>
            <li>Al menos un dígito</li>
            <li>No espacios en blanco</li>
            <li>Al menos 1 caracter especial</li>
        </div>
        <form action="{{ route('route.Update', 11) }}" method="post" id="form">
            @method('PUT')
            @csrf
            @foreach ($Users as $User)
            <div class="d-flex w-auto">
                <div class="d-inline w-100 p-3">
                    <!-- <input type="hidden" name="id" value=" $User->UserId " > -->
                    <label><b>Cedula</b></label>
                    <input type="text" class="form-control" name="cedula" id="cedula" value="{{ $User->UserIdCard }}">
                    <p class="text-danger mb-2 d-none" id="alertCedula"></p>
                </div>
                <div class="d-inline w-100 p-3">
                    <label><b>Nombres</b></label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $User->UserName }}">
                    <p class="text-danger mb-2 d-none" id="alertName"></p>
                </div>
                <div class="d-inline w-100 p-3">
                    <label><b>Apellidos</b></label>
                    <input type="text" class="form-control" name="lastName" id="lastName" value="{{ $User->UserLastName }}">
                    <p class="text-danger mb-2 d-none" id="alertLastName"></p>
                </div>
            </div>
            <div class="d-flex w-auto">
                <div class="d-inline w-100 p-3">
                    <label><b>Email</b></label>
                    <input type="email" class="form-control" name="email" id="email"value="{{ $User->UserEmail }}">
                    <p class="text-danger mb-2 d-none" id="alertEmail"></p>
                </div>
                <div class="d-inline w-100 p-3">
                    <label><b>Celular</b></label>
                    <input type="number" class="form-control" name="phone" id="phone" value="{{ $User->UserPhone }}">
                    <p class="text-danger mb-2 d-none" id="alertPhone"></p>
                </div>
                <div class="d-inline w-100 p-3">
                    <label><b>Direccion</b></label>
                    <input type="text" class="form-control" name="addres" id="addres" value="{{ $User->UserAddres }}">
                    <p class="text-danger mb-2 d-none" id="alertAddres"></p>
                </div>
            </div>
            <div class="d-flex w-auto">
                <div class="d-inline w-100 p-3">
                    <label><b>Rol</b></label>
                    <select name="role" id="role" class="form-control"> 
                            @if( $User->RoleId > 0 ){
                                <option value="{{ $User->RoleId }}">{{ $User->RoleDescription }}</option>
                                
                                @foreach ($Roles as $Role)
                                   <option value="{{ $Role->RoleId }}">{{ $Role->RoleDescription }}</option>';
                                @endforeach

                            @endif
                        ?>
                    </select>
                    <p class="text-danger mb-2 d-none" id="alertRole"></p>
                </div>
                <div class="d-inline w-100 p-3">
                    <label><b>Contraseña</b></label>
                    <input type="password" class="form-control" name="password" id="password" value="{{ $User->UserPassword }}">
                    <p class="text-danger mb-2 d-none" id="alertPassword"></p>
                </div>
                <div class="d-inline w-100 p-3">
                    <label><b>Confirmar Contrasena</b></label>
                    <input type="password" class="form-control" name="repeatPassword" id="repeatPassword" placeholder="confirmar contraseña">
                    <p class="text-danger mb-2 d-none" id="alertRepeatPassword"></p>
                </div> 
            </div><br>
            <button type="submit" value="Enviar" class="btn btn-warning m-2"><b>Actualizar Datos</b></button>
            @endforeach
        </form>
        <script src="{{ asset('js/ScriptUsers/UpdateUsers.js') }}"></script>
    </div>
</div>
@endsection