@extends('layouts.header')

@section('content')
<div class="container">
    <div class="card d-flex justify-content-around flex-wrap" id="base">
        <div class="card-header" id="head_users">
            <h3>Registrar Usuarios<h3>
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
        <form action="/Create" method='post' id="form">
            {{ csrf_field() }}
            <div class="d-flex w-auto">
                <div class="d-inline w-100 p-3">
                    <label>Cedula</label>
                    <input type="text" class="form-control" name="UserIdCard" id="cedula" placeholder="Escribe su documento"/>
                    <p class="text-danger mb-2 d-none" id="alertCedula"></p>
                </div>
                <div class="d-inline w-100 p-3">
                    <label>Nombres</label>
                    <input type="text" class="form-control" name="UserName" id="name" placeholder="Escribe su nombre completo" />
                    <p class="text-danger mb-2 d-none" id="alertName"></p>
                </div>
                <div class="d-inline w-100 p-3">
                    <label>Apellidos</label>
                    <input type="text" class="form-control" name="UserLastName" id="lastName" placeholder="Escribe su Apellido" />
                    <p class="text-danger mb-2 d-none" id="alertLastName"></p>
                </div>
            </div>
            <div class="d-flex w-auto">
                <div class="d-inline w-100 p-3">
                    <label>Email</label>
                    <input type="email" class="form-control" name="UserEmail" id="email" placeholder="Escribe su Email" />
                    <p class="text-danger mb-2 d-none" id="alertEmail"></p>
                </div>
                <div class="d-inline w-100 p-3">
                    <label>Celular</label>
                    <input type="number" class="form-control" name="UserPhone" id="phone" placeholder="Escribe su telefono" />
                    <p class="text-danger mb-2 d-none" id="alertPhone"></p>
                </div>
                <div class="d-inline w-100 p-3">
                    <label>Direccion</label>
                    <input type="text" class="form-control" name="UserAddres" id="addres" placeholder="Escribe su Direccion" />
                    <p class="text-danger mb-2 d-none" id="alertAddres"></p>
                </div>
            </div>
            <div class="d-flex w-auto">
                <div class="d-inline w-100 p-3">
                    <label>Rol</label>
                    <select name="RoleId" id="role" class="form-control">
                        <option value="1">Seleccione</option>
                        <?php       
/*                             while( $search = mysqli_fetch_array($resultRole) ){

                                echo '<option value="'.$search['RoleId'].'">'.$search['RoleDescription'].'</option>';
                            } */
                        ?>
                    </select>
                    <p class="text-danger mb-2 d-none" id="alertRole"></p>
                </div>
                <div class="d-inline w-100 p-3">
                    <label>Contraseña</label>
                    <input value="Carlos12345&" type="password" class="form-control" name="UserPassword" id="password" placeholder="Escribe su contraseña" />
                    <p class="text-danger mb-2 d-none" id="alertPassword"></p>
                </div>
                <div class="d-inline w-100 p-3">
                    <label>Confirmar Contraseña</label>
                    <input value="Carlos12345&" type="password" class="form-control" name="repeatPassword"  id="repeatPassword" placeholder="confirmar contraseña" />
                    <p class="text-danger mb-2 d-none" id="alertRepeatPassword"></p>
                </div>
            </div>
            <div class="d-flex w-auto">
                <input type="checkbox" class="form-check-input d-inline m-2" id="exampleCheck1">
                <label class="form-check-label d-inline w-100" for="exampleCheck1">he leido y acepto Terminos y condiciones</label>
                <br/><br/>
            </div>
            <button type="submit" value="Enviar" class="btn btn-primary m-2">Guardar</button>
        </form>
        <script src="{{ asset('js/ScriptUsers/formUsers.js') }}"></script>
    </div>
</div>    
@endsection