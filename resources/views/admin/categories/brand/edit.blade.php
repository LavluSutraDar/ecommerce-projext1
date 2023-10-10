
<div class="modal-body">
    <form action="{{ route('brand.update') }}" method="POST" enctype="multipart/form-data" id="add-form">
        @csrf
        <div class="mb-3">
            <label for="brand_name" class="form-label">Edit Brand Name</label>
            <input type="text" class="form-control @error('brand_name') is-invalid @enderror" name="brand_name" value="{{ $data->brand_name }}">

            @error('brand_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <input type="hidden" name="id" value="{{$data->id}}">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Edit Brand Logo</label>
            <input type="file" id="input-file-now" class="form-control" name="brand_logo">

            <input type="hidden" name="old_logo" value="{{$data->brand_logo}}">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Subcategory Submit</button>
        </div>

    </form>
</div>
