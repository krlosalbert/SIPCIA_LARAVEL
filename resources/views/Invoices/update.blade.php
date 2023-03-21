<div class="card-body">
    <form action="{{ route('update_invoices', $invoice->invoice_id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="d-flex w-auto">
            <div class="d-inline w-100 p-2">
                <label for="date"><b>Fecha</b></label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $invoice->invoice_date }}">
            </div>
            <div class="d-inline w-100 p-2">
                <label for="number"><b>Numero de Factura</b></label>
                <input type="text" class="form-control" id="number" name="number" value="{{ $invoice->invoice_number }}">
            </div>
        </div>
        <div class="d-flex w-auto">
            <div class="d-inline w-100 p-2">
                <label for="number_entries"><b>Numero de Entradas</b></label>
                <input type="text" class="form-control" id="number_entries" name="number_entries" value="{{ $invoice->invoice_number_entries }}">
            </div>
            <div class="d-inline w-100 p-2">
                <label for="supplier"><b>Proveedor</b></label>
                <select name="supplier_id" id="supplier_id" class="form-control">
                    <option value="{{ $invoice->supplier_id }}">{{ $invoice->supplier_name }}</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="d-flex w-auto">
            <div class="d-inline w-100 p-2">
                <label for="account"><b>Cuenta</b></label>
                <select name="account_id" id="account_id" class="form-control">
                    <option value="{{ $invoice->invoice_account_id }}">{{ $invoice->account_name }}</option>
                    @foreach($accounts as $account)
                        <option value="{{ $account->id }}">{{ $account->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-inline w-100 p-2">
                <label for="total"><b>Total</b></label>
                <input type="number" class="form-control" id="total" name="total" value="{{ $invoice->invoice_total }}">
            </div>
        </div>
        <div class="row mb-0">
            <div>
                <button type="submit" value="Enviar" class="btn btn-primary m-2">Guardar</button>
            </div>
        </div>
    </form>  
</div>     