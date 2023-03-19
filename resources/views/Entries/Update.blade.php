<div class="card-body">
    <form action="{{ route('update_entries', $entry->entry_id) }}" method="POST">
        @csrf
        <div class="d-flex w-auto">
            <div class="d-inline w-100 p-2">
                <label for="date"><b>Fecha</b></label><br>
                <input type="date" class="form-control" id="date" name="date" value="{{ $entry->entry_date }}">
            </div>
        </div>
        <div class="d-flex w-auto">
            <div class="d-inline w-100 p-2">
                <label for="supplier"><b>Proveedor</b></label><br>
                <select name="supplier" id="role" class="form-control">
                    <option value="{{ $entry->supplier_id }}">{{ $entry->supplier_name }}</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="d-flex w-auto">
            <div class="d-inline w-100 p-2">
                <label for="invoice"><b>Factura</b></label>
                <select name="invoice" id="role" class="form-control">
                    <option value="{{ $entry->invoice_id }}">{{ $entry->invoice_name }}</option>
                    @foreach($invoices as $invoice)
                        <option value="{{ $invoice->id }}">{{ $invoice->number }}</option>
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