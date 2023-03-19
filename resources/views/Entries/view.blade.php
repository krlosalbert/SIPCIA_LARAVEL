@extends('layouts..header')

@section('css')
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="card d-flex justify-content-around flex-wrap" id="base">
        <div class="table-responsive">
            <div class="card-header" id="head_users">
                <h3>Entradas<h3>
            </div>
            <table class="table" id="entries">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Fecha</th>
                        <th class="text-center" scope="col">Proveedor</th>
                        <th class="text-center" scope="col">Factura</th>
                        <th class="text-center" scope="col">Cuenta</th>
                        <th class="text-center" scope="col">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $x = 0;
                    @endphp
                    @foreach ($entries as $entry)
                        <tr>
                            <td>{{ $x += 1; }}</td>
                            <td class="text-center">{{ $entry['entry_date'] }}</td>
                            <td class="text-center">{{ $entry['supplier_name'] }}</td>
                            <td class="text-center">{{ $entry['invoice_number'] }}</td>
                            <td class="text-center">{{ $entry['account_name'] }}</td>
                            <td class="text-center">
                                <!-- boton trigger modal para ver detalles de productos -->
                                <button class="btn btn-warning details-btn" data-bs-toggle="modal" data-bs-target="#details-entries" data-id="{{ $entry['entry_id'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                </button>
                            
                                <!-- Button trigger modal para editar la entrada-->
                                <a href=" {{ route('ReadUpdateEntries', $entry['entry_id'] ) }}" type="button" class="btn btn-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                    </svg>
                                </a>

                                <form class="d-inline" action="{{ route('DeleteEntries', $entry['entry_id']) }}" method="post" id="delete">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger btn-delete" data-id="{{ $entry['entry_id'] }}">
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

            <!-- Modal para mostrar productos-->
            <div class="modal fade" id="details-entries" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

            <!-- Aqui empiezan los scripts -->
            @section('js')
                <script src="{{ asset('js/datatables.min.js') }}"></script>
                <script src="{{ asset('js/bootstrapDatatables.js') }}"></script>
                <script src="{{ asset('js/ScriptEntries/DetailsEntries.js') }}"></script>
                <script src="{{ asset('js/ScriptEntries/Delete.js') }}"></script>
                <script>
                    $(document).ready(function () {
                        $('#entries').DataTable({
                            'lengthMenu' : [[ 3, 6, 9, -1], [ 3, 6, 9, "All"]],
                            'pageLength': 3,
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
                        swal("Listo!", "Usuario Guardado con Exito!", "success")
                            .then((value) => {
                        }) 
                    </script>
                @endif
            @endsection
        </div>
    </div>
@endsection