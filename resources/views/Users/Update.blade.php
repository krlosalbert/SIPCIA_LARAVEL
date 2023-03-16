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
        <div class="card-body" id="base">
            <form action="{{ route('Update', $user->id) }}" method="post" id="form">
                @method('PUT')
                @csrf
                <div class="d-flex w-auto">
                    <div class="d-inline w-100 p-3">
                
                        <label for="name">{{ __('Nombres') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus placeholder="Escribe su Nombre" >

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    <div class="d-inline w-100 p-3">
                        <label for="lastname">{{ __('Apellidos') }}</label>
                        <input type="text" class="form-control  @error('lastname') is-invalid @enderror" name="lastname" value="{{ $user->lastname }}" required autocomplete="lastname" placeholder="Escribe su Apellido" />
                            
                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="d-inline w-100 p-3">
                        <label for="email">{{ __('Correo Electronico') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" placeholder="Escribe su Email" >

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>

                <div class="d-flex w-auto">

                    <div class="d-inline w-100 p-3">
                        <label for="phone">{{ __('Celular') }}</label>
                        <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" placeholder="Escribe su telefono" required autocomplete="phone"/>

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="d-inline w-100 p-3">
                        <label for="addres">{{ __('Direccion') }}</label>
                        <input type="text" class="form-control @error('addres') is-invalid @enderror" name="addres" value="{{ $user->addres }}" placeholder="Escribe su direccion" required autocomplete="addres"/>

                        @error('addres')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                

                    <div class="d-inline w-100 p-3">
                        <label for="role">{{ __('Rol') }}</label>
                        <select name="role" id="role" class="form-control">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>

                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex w-auto">
                </div>

                <div class="d-flex w-auto">
                    <div class="d-inline w-100 p-3">
                        
                    </div>
                
                    <div class="d-inline w-100 p-3">
                       
                    </div>

                    <div class="d-inline w-100 p-3">
                        
                    </div>
                </div>
                <div class="row mb-0">
                    <div>
                        <button type="submit" value="Enviar" class="btn btn-warning m-2">
                            <b>{{ __('Actualizar Datos') }}</b>
                        </button>
                    </div>
                </div>            
            </form>
            @if(session('success'))
                <script>
                    swal("Listo!", "Usuario Actualizado con Exito!", "success")
                        .then((value) => {
                            window.location.replace('/ViewUsers'); 
                    });
                </script>
            @endif
        </div>
    </div>
</div>
@endsection