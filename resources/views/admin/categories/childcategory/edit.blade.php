<form action="{{ route('childcategory.update') }}" method="POST" id="add-form">
    <div class="modal-body">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Category/Subcategory Name</label>
            <select name="subcategory_id" class="form-control">
                <option selected disabled value="hidden">Chosse Category/Subctegory</option>

                @foreach ($category as $categories)
                    
                    <option disabled style="color: yellow" value="{{ $categories->id }}">{{ $categories->category_name }}</option>

                    @php
                        $subcat = DB::table('subcategories')
                            ->where('category_id', $categories->id)
                            ->get();
                    @endphp

                    @foreach ($subcat as $subcategory)

                        <option value="{{ $subcategory->id }}" 
                        @if($subcategory->id == $childcate->subcategory_id) selected @endif> 
                            ---{{ $subcategory->subcategory_name }}
                        </option>
                    @endforeach
                @endforeach

            </select>
        </div>

        <input type="hidden" name="id" value="{{$childcate->id}}">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Child Category Name</label>
            <input type="text" class="form-control @error('childcategory_name') is-invalid @enderror"
                name="childcategory_name" value="{{$childcate->childcategory_name}}">

            @error('childcategory_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Child Category Update</button>
        </div>
    </div>
</form>
