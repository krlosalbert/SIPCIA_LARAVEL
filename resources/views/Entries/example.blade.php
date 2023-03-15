<table class="table" id="tabla-productos">
    <thead class="thead-dark">
        <tr>
            <th class="text-center" scope="col">#</th>
            <th class="text-center" scope="col">Nombre del Elemento</th>
            <th class="text-center" scope="col">Marca</th>
            <th class="text-center" scope="col">Cuenta</th>
            <th class="text-center" scope="col">Valor Unitario</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products_with_accounts as $product)
        <tr>
            <td>{{ $x += 1; }}</td>
            <td class="text-center">{{ $product->name }}</td>
            <td class="text-center">{{ $product->brand }}</td>
            <td class="text-center">{{ $product->account_name }}</td>
            <td class="text-center">$ {{ $product->price }}</td>
            <td class="text-center">
                <!-- Button trigger modal -->
                <button type="button" id="btnModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{ $product->id }}">
                    Agregar
                </button>   
            </td>
        </tr>
        @endforeach
    </tbody>
</table>