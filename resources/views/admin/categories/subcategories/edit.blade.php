<form action="{{route('subcategory.update')}}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Category Name</label>
            <select name="category_id" class="form-control">
                <option value="hidden">Chosse Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" 
                        @if ($category->id == $subcategory->category_id) selected="" @endif>

                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
            <input type="hidden" name="id" value="{{$subcategory->id}}">
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Sub Category Name</label>
            <input type="text" class="form-control @error('subcategory_name') is-invalid @enderror"
                name="subcategory_name" value="{{$subcategory->subcategory_name}}">

            @error('subcategory_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
