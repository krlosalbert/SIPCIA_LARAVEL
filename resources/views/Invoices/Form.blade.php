@extends('layouts.header')

@section('content')
<div class="container">
    <div class="card d-flex justify-content-around flex-wrap" id="base">
        <div class="card-header" id="head_users">
            <h3>Nueva Factura<h3>
        </div>
        <div class="card-body" id="base">
            <form action="{{ route('CreateInvoices') }}" method="post" id="form">
                @csrf
                <div class="d-flex w-auto">
                    <div class="d-inline w-100 p-3">
                        <label for="date">{{ __('Fecha') }}</label>
                        <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" required autocomplete="date" autofocus placeholder="Digite la fecha" value="{{ old('date') }}">

                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    <div class="d-inline w-100 p-3">
                        <label for="number">{{ __('Numero de Factura') }}</label>
                        <input type="text" class="form-control  @error('number') is-invalid @enderror" name="number"  required autocomplete="number" placeholder="Escribe el numero de factura" value="{{ old('number') }}" />
                            
                            @error('number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="d-inline w-100 p-3">
                        <label for="number_entries">{{ __('Numero de Entradas') }}</label>
                        <input id="number_entries" type="text" class="form-control @error('number_entries') is-invalid @enderror" name="number_entries"  required autocomplete="number_entries" placeholder="Escriba el numero de las entradas" value="{{ old('number_entries') }}">

                            @error('number_entries')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>

                <div class="d-flex w-auto">

                    <div class="d-inline w-100 p-3">
                        <label for="supplier_id">{{ __('Proveedor') }}</label>
                        <select name="supplier_id" id="supplier_id" class="form-control">
                            <option value="">seleccione</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>

                        @error('supplier_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    <div class="d-inline w-100 p-3">
                        <label for="account_id">{{ __('Cuenta') }}</label>
                            <select name="account_id" id="account_id" class="form-control">
                                <option value="0">Seleccione</option>
                                @foreach($accounts as $account)
                                    <option value="{{ $account->id }}">{{ $account->name }}</option>
                                @endforeach
                            </select>
                            @error('account')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="d-inline w-100 p-3">
                        <label for="total">{{ __('total') }}</label>
                        <input id="total" type="number" class="form-control @error('total') is-invalid @enderror" name="total"  required autocomplete="total" placeholder="Escriba el total de la factura" value="{{ old('total') }}">
    
                        @error('total')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
                    swal("Listo!", "Factura Actualizado con Exito!", "success")
                        .then((value) => {
                            window.location.replace('/ViewInvoices'); 
                    });
                </script>
            @endif
        </div>
    </div>
</div>
@endsection