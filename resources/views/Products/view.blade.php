@extends('layouts..header')

@section('css')
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container" id="base">
        <div class="row">
            <div class="card-header" id="head_users">
                <h3>Productos<h3>     
            </div>
            <div class="table-responsive">
                <table class="table" id="tbl-products">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center" scope="col">#</th>
                            <th class="text-center" scope="col">Nombre del Elemento</th>
                            <th class="text-center" scope="col">Marca</th>
                            <th class="text-center" scope="col">Cuenta</th>
                            <th class="text-center" scope="col">Cantidad</th>
                            <th class="text-center" scope="col">Valor Unitario</th>
                            <th class="text-center" scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products_with_accounts as $product)
                        <tr>
                            <td>{{ $x += 1; }}</td>
                            <td class="text-center">{{ $product->name }}</td>
                            <td class="text-center">{{ $product->brand }}</td>
                            <td class="text-center">{{ $product->account_name }}</td>
                            <td class="text-center">{{ $product->amount }}</td>
                            <td class="text-center">$ {{ $product->price }}</td>
                            <td class="text-center">
                                <!-- Button trigger modal -->
                                <a href=" {{ route('ReadUpdateProducts', $product->id) }}" type="button" class="btn btn-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                    </svg>
                                </a>
                                <form class="d-inline" action="{{ route('DeleteProducts', $product->id) }}" method="post" id="delete">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger btn-delete" data-id="{{ $product->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </buttton>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Aqui empieza el script del mensaje de alerta -->
            @section('js')
                <script src="{{ asset('js/ScriptProducts/Delete.js') }}"></script>
    <!--             <script src="{{ asset('js/ScriptProducts/Search.js') }}"></script> -->
                <script src="{{ asset('js/datatables.min.js') }}"></script>
                <script src="{{ asset('js/bootstrapDatatables.js') }}"></script>
                <script>
                    $(document).ready(function () {
                        $('#tbl-products').DataTable({
                            'lengthMenu' : [[ 3, 6, 9, -1], [ 3, 6, 9, "All"]],
                            "pageLength": 3,
                            'language': { 
                                "paginate": {
                                    "previous": "Anterior",
                                    "next": "Siguiente"
                                },
                                "lengthMenu": "Mostrar _MENU_ registros",
                                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                                "search": "Buscar:"
                            }
                        });
                    });
                </script>
                @if(session('success'))
                    <script>
                        swal("Listo!", "Producto Guardado con Exito!", "success")
                        .then((value) => {
                        }) 
                    </script>
                @endif
            @endsection
        </div>
    </div>
@endsection