
@extends('layouts.admin')
@section('title')
    ChildCategory
@endsection
@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Child Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#childcategoryModal">
                                + Add Child Category
                            </button>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Childcategory List here</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="yejratable table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S-L</th>
                                            <th>Category Name</th>
                                            <th>Sub Category Name</th>
                                            <th>Child Category Name</th>
                                            <th>Child Category Slug</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>


    {{-- ---------------------------Child Category Store Modal --------------------------- --}}

    <div class="modal fade" id="childcategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Child Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('childcategory.store') }}" method="POST" id="add-form">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Category/Subcategory Name</label>
                            <select name="subcategory_id" class="form-control">
                                <option selected disabled value="hidden">Chosse Subcategory</option>

                                @foreach ($category as $categories)
                                    @php
                                        $subcat = DB::table('subcategories')
                                            ->where('category_id', $categories->id)
                                            ->get();
                                    @endphp
                                    <option disabled style="color: yellow" value="{{ $categories->id }}">{{ $categories->category_name }}</option>

                                    @foreach ($subcat as $subcategory)
                                        <option value="{{ $subcategory->id }}"> ---{{ $subcategory->subcategory_name }}
                                        </option>
                                    @endforeach
                                @endforeach

                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Child Category Name</label>
                            <input type="text" class="form-control @error('childcategory_name') is-invalid @enderror"
                                name="childcategory_name">

                            @error('childcategory_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Child Category Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ---------------------------Child Category Store Modal --------------------------- --}}


    {{-- ---------------------------Child Category Edit Modal --------------------------- --}}
  <div class="modal fade" id="editchildcategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Child Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="childmodal_body">
                    
                </div>
               
            </div>
        </div>
    </div>
  
    {{-- ---------------------------Child Category Edit Modal --------------------------- --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>


    <script>
        $(function childcategory() {
            var table = $('.yejratable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('childcategory.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                   
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'subcategory_name',
                        name: 'subcategory_name'
                    },
                     {
                        data: 'childcategory_name',
                        name: 'childcategory_name'
                    },
                    {
                        data: 'childcategory_slug',
                        name: 'childcategory_slug'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },

                ],

            });
        });
        
        $('body').on('click', '.childedit', function() {
            let child_id = $(this).data('id');
            $.get("/childcategory/edit/" + child_id, function(data) {
                $('#childmodal_body').html(data);
            });
        });
    </script>
@endsection
