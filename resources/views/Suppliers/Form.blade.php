@extends('layouts.header')

@section('content')
<div class="container">
    <div class="card d-flex justify-content-around flex-wrap" id="base">
        <div class="card-header" id="head_users">
            <h3>Nuevo Proveedor<h3>
        </div>
        <div class="card-body" id="base">
            <form action="{{ route('CreateSuppliers') }}" method="post" id="form">
                @csrf
                <div class="d-flex w-auto">
                    <div class="d-inline w-100 p-3">
                
                        <label for="nit">{{ __('NIT') }}</label>
                        <input id="nit" type="number" class="form-control @error('nit') is-invalid @enderror" name="nit" required autocomplete="nit" autofocus placeholder="Escribe el NIT" value="{{ old('nit') }}">

                        @error('nit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    <div class="d-inline w-100 p-3">
                        <label for="name">{{ __('Razon social') }}</label>
                        <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name"  required autocomplete="name" placeholder="Escribe la razon social" value="{{ old('name') }}" />
                            
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="d-inline w-100 p-3">
                        <label for="city">{{ __('Ciudad') }}</label>
                        <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city"  required autocomplete="city" placeholder="Escribe la ciudad" value="{{ old('city') }}">

                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>

                <div class="d-flex w-auto">

                    <div class="d-inline w-100 p-3">
                        <label for="addres">{{ __('Direccion') }}</label>
                        <input type="text" class="form-control @error('addres') is-invalid @enderror" name="addres"  placeholder="Escribe su direccion" required autocomplete="addres" value="{{ old('addres') }}"/>

                        @error('addres')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    <div class="d-inline w-100 p-3">
                        <label for="email">{{ __('Email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  required autocomplete="email" placeholder="Digite correo electronico" value="{{ old('email') }}">
    
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="d-inline w-100 p-3">

                    </div>
                </div>

               <div class="row mb-0">
                    <div>
                        <button type="submit" value="Enviar" class="btn btn-warning m-2">
                            <b>{{ __('Guardar') }}</b>
                        </button>
                    </div>
                </div>            
            </form>
            @if(session('success'))
                <script>
                    swal("Listo!", "Proveedor Actualizado con Exito!", "success")
                        .then((value) => {
                            window.location.replace('/ViewSuppliers'); 
                    });
                </script>
            @endif
        </div>
    </div>
</div>
@endsection