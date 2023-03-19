@extends('layouts..header')

@section('content')
<div class="card d-flex justify-content-around flex-wrap" id="base">
    <div class="table-responsive">
        <div class="card-header" id="head_users">
            <h3>Proveedores<h3>
        </div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center" scope="col">#</th>
                    <th class="text-center" scope="col">NIT</th>
                    <th class="text-center" scope="col">Razon social</th>
                    <th class="text-center" scope="col">Ciudad</th>
                    <th class="text-center" scope="col">Direccion</th>
                    <th class="text-center" scope="col">Telefono</th>
                    <th class="text-center" scope="col">Email</th>
                    <th class="text-center" scope="col">Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{ $x += 1; }}</td>
                    <td class="text-center">{{ $supplier->nit }}</td>
                    <td class="text-center">{{ $supplier->name }}</td>
                    <td class="text-center">{{ $supplier->city }}</td>
                    <td class="text-center">{{ $supplier->addres }}</td>
                    <td class="text-center">{{ $supplier->phone }}</td>
                    <td class="text-center">{{ $supplier->email }}</td>
                    <td class="text-center">
                    <!-- Button trigger modal -->
                     <a href=" {{ route('ReadUpdateSuppliers', $supplier->id) }}" type="button" class="btn btn-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg>
                    </a>
                    <form class="d-inline" action="{{ route('DeleteSuppliers', $supplier->id) }}" method="post" id="delete">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger btn-delete" data-id="{{ $supplier->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </buttton>
                    </form>
                    </td>
                </tr>
                @endforeach
                <!-- Aqui inicia el paginador -->
                <tr>
                    <td colspan="6"></td>
                    <td colspan="2">
                        <ul class="d-flex list-inline text-end">
                            {{ $suppliers->links('pagination::bootstrap-4') }}
                        </ul>
                    </td>
                </tr> <!-- Aqui termina el paginador -->
            </tbody>
        </table>
        <!-- Aqui empieza el script del mensaje de alerta -->
        <script src="{{ asset('js/ScriptSuppliers/Delete.js') }}"></script>
        @if(session('success'))
            <script>
                swal("Listo!", "Proveedor Guardado con Exito!", "success")
                    .then((value) => {
                }) 
            </script>
        @endif
    </div>
</div>
@endsection