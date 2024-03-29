<table class="table table-center" id="tbl-products">
    <thead class="thead-dark">
        <tr>
            <th class="text-center text-lowercase" scope="col">#</th>
            <th class="text-center text-lowercase" scope="col">Nombre del Elemento</th>
            <th class="text-center text-lowercase" scope="col">Marca</th>
            <th class="text-center text-lowercase" scope="col">Cuenta</th>
            <th class="text-center text-lowercase" scope="col">Cantidad</th>
            <th class="text-center text-lowercase" scope="col">Valor Unitario</th>
            <th class="text-center text-lowercase" scope="col">Total</th>
        </tr>
    </thead>
    <tbody>
        @php
            $x = 0;
            $total = 0;
            $sumatotal = 0;
        @endphp
        @foreach ($products as $product)
            <tr>
                <td>{{ $x += 1; }}</td>
                <td class="text-center lowercase">{{ $product->products_name }}</td>
                <td class="text-center lowercase">{{ $product->products_brand }}</td>
                <td class="text-center lowercase">{{ $product->products_account_name }}</td>
                <td class="text-center lowercase">{{ $product->products_amount }}</td>
                <td class="text-center lowercase">$ {{ number_format($product->products_price, 0, ',', '.') }}</td>
                <td class="text-center lowercase">
                    @php
                        $amount = $product->products_amount;
                        $price = $product->products_price;
                        $total = $amount*$price;
                        $sumatotal += $amount*$price;
                    @endphp    
                
                    $ {{ number_format($total, 0, ',', '.') }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td class="text-center lowercase"></td>
            <td class="text-center lowercase"></td>
            <td class="text-center lowercase"></td>
            <td class="text-center lowercase"></td>
            <td class="text-center lowercase"></td>
            <td class="text-center lowercase"><b>TOTAL</b></td>
            <td class="text-center lowercase" colspan="2"><b>$ {{ number_format($sumatotal, 0, ',', '.') }}</b></td>
        </tr>

    </tbody>
</table>
