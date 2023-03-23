@extends('layouts.header')

@section('content')
    <div class="container" >
        <div class="row">
            <div class="col-md-4">
                <div class="card d-flex justify-content-around flex-wrap" id="base">
                    <div class="card-header" id="head_users">
                        <h3>
                            <b>Nueva Salida</b>
                        <h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex w-auto">
                            <div class="d-inline w-100 ">
                                <label for="search_product"><b>Buscar producto:</b></label>
                                <input type="text" name="search_product" class="form-control" id="search_pro" placeholder="Buscar...">
                            </div>
                            <div class="d-inline w-25 pt-4">
                                <button class="btn btn-primary" id="search-btn" data-bs-toggle="modal" data-bs-target="#search-product">Buscar</button>
                            </div>  
                        </div>
                        <form action="{{ route('create_outputs') }}" method="POST">
                            @csrf
                            <div class="d-flex w-auto">
                                <div class="d-inline w-100 p-2">
                                    <label for="date"><b>Fecha</b></label><br>
                                    <input type="date" class="form-control" id="date" name="date" placeholder="Ingrese la fecha de la salida" value="{{ old('date') }}">
                                </div>
                            </div>
                            <div class="d-flex w-auto">
                                <div class="d-inline w-100 p-2">
                                    <label for="number"><b>Numero de Salida</b></label><br>
                                    <input type="number" class="form-control" id="number" name="number" placeholder="Ingrese el numero de salida" value="{{ old('number') }}">
                                </div>
                            </div>
                            <div class="d-flex w-auto">
                                <div class="d-inline w-100 p-2">
                                    <label for="subaccount_id"><b>Area</b></label><br>
                                    <select name="subaccount_id" id="subaccount_id" class="form-control">
                                        <option value="">Seleccione</option>
                                        @foreach($subaccounts as $subaccount)
                                            <option value="{{ $subaccount->id }}">{{ $subaccount->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex w-auto">
                                <div class="d-inline w-100 p-2">
                                    <label for="department_id"><b>Dependencia</b></label>
                                    <select name="department_id" id="department_id" class="form-control">
                                        <option value="">Seleccione</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex w-auto">
                                <div class="d-inline w-100 p-2">
                                    <label for="employee_id"><b>Profesional</b></label>
                                    <select name="employee_id" id="employee_id" class="form-control">
                                        <option value="">Seleccione</option>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex w-auto">
                                <div class="d-inline w-100 p-2">
                                    <label for="user_id"><b>Entrega</b></label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        <option value="">Seleccione</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} {{ $user->lastname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div>
                                    <button type="submit" value="Enviar" class="btn btn-primary m-2">Guardar</button>
                                </div>
                            </div>
                        </form>  
                    </div>                  
                </div>
            </div>

            @if(!empty($products))
                <div class="col-md-8">
                    <div class="container">
                        <div class="card d-flex justify-content-around flex-wrap" id="base">
                            <div class="card-header" id="head_users">
                                <h3>
                                    <b>Productos para agregar a salida</b>
                                <h3>
                            </div>
                            <div class="card-body">
                                <div class="overflow-auto">
                                    <div class="table-responsive2">
                                        <table class="table table-center" id="tbl-entries">
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
                                                $suma_total = 0;
                                            @endphp
                                            <tbody>
                                                @foreach ($products as $pro)
                                                    @foreach ($pro['searchs'] as $search)
                                                        <tr>
                                                            <td class="text-center lowercase">{{ $search['product_name'] }}</td>
                                                            <td class="text-center lowercase">{{ $pro['amount'] }}</td>
                                                            <td class="text-center lowercase">$ {{ number_format($search['price'], 0, ',', '.') }}</td>
                                                            <td class="text-center lowercase">
                                                                @php
                                                                    $amount = $pro['amount'];
                                                                    $price = $search['price'];
                                                                    $total = $amount*$price;
                                                                    $suma_total += $amount*$price;
                                                                @endphp
                                                                $ {{ number_format($total, 0, ',', '.')}}
                                                            </td>
                                                            <td class="text-center">
                                                                @php

                                                                    $posicion = array_search($pro, $products); 

                                                                @endphp
                                                                <form action="{{ route('deleteProduct_outputs') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="indice" value="{{ $posicion }}"> <!-- aquí indicas el índice del elemento que quieres eliminar -->
                                                                    <button type="submit">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                                        </svg>
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                                <tr>
                                                    <td class="text-center lowercase"></td>
                                                    <td class="text-center lowercase"><b>TOTAL</b></td>
                                                    <td class="text-center lowercase" colspan="3"><b>$ {{ number_format($suma_total, 0, ',', '.') }}</b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Modal para mostrar productos-->
            <div class="modal fade" id="search-product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-lg text-center">
                    <div class="modal-content d-flex justify-content-center align-items-center">
                        <div class="modal-header w-100">
                            <h5 class="modal-title" id="exampleModalLabel"><b>Productos</b></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body w-100" id="body">

                            <!-- El contenido de la tabla se insertará aquí -->

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para agregar cantidad-->
            <div class="modal fade" id="amount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><b>Agregar Cantidad del Producto</b></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('AddProductMoment_output') }}" method="POST" id="formAdd">
                            <div class="modal-body" id="body">
                                @csrf
                                <label for="amount"><b>{{ __('Cantidad') }}</b></label>
                                <input name="id" id="id" type="hidden" value="">
                                <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" required autocomplete="amount" autofocus placeholder="Digite la cantidad" >
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Agregar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
            @section('js')
                <script src="{{ asset('js/ScriptOutputs/outputs.js') }}"></script>
                @if(session('success'))
                    <script>
                        swal("Listo!", "Salida Guardada con Exito!", "success")
                            .then((value) => {
                        }) 
                    </script>
                @endif
                @if(session('delete'))
                    <script>
                        swal("Listo!", "Producto eliminado con Exito!", "success")
                            .then((value) => {
                        }) 
                    </script>
                @endif
            @endsection
        </div>
    </div>   
@endsection