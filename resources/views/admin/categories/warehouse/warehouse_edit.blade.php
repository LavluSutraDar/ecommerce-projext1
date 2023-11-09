<form action="{{ route('warehouse.update', $warehouse->id) }}" method="POST" id="add-form">
    <div class="modal-body">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Ware House Name</label>
            <input type="text" class="form-control @error('warehouse_name_edit') is-invalid @enderror" name="warehouse_name_edit"
                value="{{ $warehouse->warehouse_name }}">

            @error('warehouse_name_edit')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Ware House Address</label>
            <input type="text" class="form-control @error('warehouse_address_edit') is-invalid @enderror"
                name="warehouse_address_edit" value="{{ $warehouse->warehouse_address }}">

            @error('warehouse_address_edit')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Ware House Phone</label>
            <input type="number" class="form-control @error('warehouse_phone_edit') is-invalid @enderror"
                name="warehouse_phone_edit" value="{{ $warehouse->warehouse_phone }}">

            @error('warehouse_phone_edit')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Ware House Update</button>
        </div>
    </div>
</form>
