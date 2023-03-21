<table class="table table-center" id="">
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
        @php
            $x = 0;
        @endphp
        @foreach ($products_with_accounts as $product)
        <tr>
            <td>{{ $x += 1; }}</td>
            <td class="text-center lowercase">{{ $product->product_name }}</td>
            <td class="text-center lowercase">{{ $product->brand }}</td>
            <td class="text-center lowercase">{{ $product->account_name }}</td>
            <td class="text-center lowercase">$ {{ number_format($product->price, 0, ',', '.') }}</td>
            <td class="text-center lowercase">
                <!-- Button trigger modal -->
                <button type="button" id="btnModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#amount" data-id="{{ $product->product_id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-align-middle" viewBox="0 0 16 16">
                        <path d="M6 13a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v10zM1 8a.5.5 0 0 0 .5.5H6v-1H1.5A.5.5 0 0 0 1 8zm14 0a.5.5 0 0 1-.5.5H10v-1h4.5a.5.5 0 0 1 .5.5z"/>
                    </svg>
                </button>   
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

