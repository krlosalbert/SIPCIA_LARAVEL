@extends('layouts.header')

@section('content')
<div class="container">
    <div class="card d-flex justify-content-around flex-wrap" id="base">
        <div class="card-header" id="head_users">
            <h3>Actualizar Proveedores<h3>
        </div>
        <div class="card-body" id="base">
            <form action="{{ route('UpdateSuppliers', $supplier->id) }}" method="post" id="form">
                @method('PUT')
                @csrf
                <div class="d-flex w-auto">
                    <div class="d-inline w-100 p-3">
                        <label for="nit">{{ __('NIT') }}</label>
                        <input id="nit" type="text" class="form-control @error('nit') is-invalid @enderror" name="nit" value="{{ $supplier->nit }}" required autocomplete="nit" autofocus />

                        @error('nit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    <div class="d-inline w-100 p-3">
                        <label for="name">{{ __('Razon social') }}</label>
                        <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ $supplier->name }}" required autocomplete="name" />
                            
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="d-inline w-100 p-3">
                        <label for="city">{{ __('Ciudad') }}</label>
                        <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $supplier->city }}" required autocomplete="city" />

                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>

                <div class="d-flex w-auto">

                    <div class="d-inline w-100 p-3">
                        <label for="addres">{{ __('Dirrecion') }}</label>
                        <input type="text" class="form-control @error('addres') is-invalid @enderror" name="addres" value="{{ $supplier->addres }}" required autocomplete="addres"/>

                            @error('addres')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="d-inline w-100 p-3">
                        <label for="phone">{{ __('Telefono') }}</label>
                        <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $supplier->phone }}" required autocomplete="phone"/>

                        @error('addres')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    <div class="d-inline w-100 p-3">
                        <label for="email">{{ __('Email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $supplier->email }}" required autocomplete="email" placeholder="Digite correo electronico">
    
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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