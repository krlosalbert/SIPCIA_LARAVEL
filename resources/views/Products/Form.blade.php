@extends('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" id="head_users"><h3>{{ __('Nuevo Producto') }}</h3></div>

                <div class="card-body" id="base">
                    <form method="POST" action="{{ route('CreateProducts') }}">
                        @csrf
                        <div class="d-flex w-auto">
                            <div class="d-inline w-100 p-3">
                       
                                <label for="name">{{ __('Nombre del Elemento') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Escribe el nombre del producto">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="d-inline w-100 p-3">
                                <label for="brand">{{ __('Marca') }}</label>
                                <input type="text" class="form-control  @error('brand') is-invalid @enderror" name="brand" value="{{ old('brand') }}" required autocomplete="brand" placeholder="Escribe la marca" />
                                    
                                    @error('brand')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                        </div>
                        
                        <div class="d-flex w-auto">
                            
                            <div class="d-inline w-100 p-3">
                                <label for="account">{{ __('Cuenta') }}</label>
                                <select name="account" id="account" class="form-control">
                                    <option value="0">Seleccione</option>
                                    @foreach($accounts as $account)
                                        <option value="{{ $account->id }}">{{ $account->name }}</option>
                                    @endforeach
                                </select>
                                </select>
                                @error('account')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-inline w-100 p-3">
                                <label for="price">{{ __('Valor Unitario') }}</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" placeholder="Escribe su telefono" required autocomplete="price"/>

                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div>
                                <button type="submit" class="btn btn-primary btn-register">
                                   <b> {{ __('Guardar') }} </b>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <script src="{{ asset('js/ScriptUsers/formUsers.js') }}"></script>
            </div>
        </div>
    </div>
</div>
@endsection