@extends('layouts.header')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-6" id="base">
                <div class="card-header">
                    <h3>
                        <b>Nueva Entrada</b>
                    <h3>
                </div>
                <div class="d-flex w-auto">
                    <div class="d-inline w-50 p-3">
                        <label for="buscar"><b>Buscar producto:</b></label>
                    </div>
                        <div class="d-inline w-100 p-2">
                            <form action="{{ route('SearchProducts') }}" method="POST">
                                @csrf
                                <input type="text" class="form-control" id="search" name="search" placeholder="Ingrese el nombre del producto" value="{{ old('search') }}">
                        </div>
                                <div class="d-inline w-50 p-2">
                                    <button class="btn btn-info">Buscar</button>
                                </div>
                            </form>       
                </div>

                <div id="ShowMsg" class="container" >
                    @if(empty($products_with_accounts))
                        <div></div>
                    @endif

                    @if(!empty($products_with_accounts))
                        <table class="table" id="tabla-productos">
                            <thead class="thead-dark">
                                <tr>
                                <th class="text-center text-lowercase" scope="col">#</th>
                                <th class="text-center text-lowercase" scope="col">Nombre del Elemento</th>
                                <th class="text-center text-lowercase" scope="col">Marca</th>
                                <th class="text-center text-lowercase" scope="col">Cuenta</th>
                                <th class="text-center text-lowercase" scope="col">Valor Unitario</th>
                                <th class="text-center text-lowercase" scope="col">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products_with_accounts as $product)
                                <tr>
                                    <td>{{ $x += 1; }}</td>
                                    <td class="text-center lowercase">{{ $product->name }}</td>
                                    <td class="text-center lowercase">{{ $product->brand }}</td>
                                    <td class="text-center lowercase">{{ $product->account_name }}</td>
                                    <td class="text-center lowercase">$ {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="text-center lowercase">
                                        <!-- Button trigger modal -->
                                        <button type="button" id="btnModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{ $product->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-align-middle" viewBox="0 0 16 16">
                                                <path d="M6 13a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v10zM1 8a.5.5 0 0 0 .5.5H6v-1H1.5A.5.5 0 0 0 1 8zm14 0a.5.5 0 0 1-.5.5H10v-1h4.5a.5.5 0 0 1 .5.5z"/>
                                            </svg>
                                        </button>   
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                @if(!empty($products) )
                    <div></div>
                @endif
                @if(!empty($products))
                    <div class="container" id="base2">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center lowercase" scope="col">Nombre del Producto</th>
                                    <th class="text-center lowercase" scope="col">Cantidad</th>
                                    <th class="text-center lowercase" scope="col">Valor Unitario</th>
                                    <th class="text-center lowercase" scope="col">Valor Total</th>
                                    <th class="text-center lowercase" scope="col">Accion</th>
                                </tr>
                            </thead>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($products as $pro)
                                @foreach ($pro->searchs as $search)
                                    <tbody>
                                        <tr>
                                            <td class="text-center lowercase">{{ $search['name'] }}</td>
                                            <td class="text-center lowercase">{{ $pro->amount }}</td>
                                            <td class="text-center lowercase">$ {{ number_format($search['price'], 0, ',', '.') }}</td>
                                            <td class="text-center lowercase">
                                                @php
                                                    $amount = $pro->amount;
                                                    $price = $search['price'];
                                                    $total = $amount*$price;

                                                @endphp
                                                $ {{ number_format($total, 0, ',', '.')}}
                                            </td>
                                            <td class="text-center">
                                                <a href="#"  class="btn btn-danger m-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            @endforeach
                        </table>
                    </div></br>
                @endif
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('AddProductMoment') }}" method="POST" id="formAdd">
                            <div class="modal-body" id="body">
                                @csrf
                                <label for="amount"><b>{{ __('Cantidad') }}</b></label>
                                <input name="id" id="id" type="hidden" value="">
                                <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" required autocomplete="amount" autofocus placeholder="Digite la cantidad" >
                        
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Agregar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/ScriptEntries/SearchProducts.js') }}"></script>
@endsection