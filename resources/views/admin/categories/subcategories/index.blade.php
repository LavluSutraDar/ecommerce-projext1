@extends('layouts.admin')
@section('title')
    SubCategory
@endsection
@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Sub Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#subcategoryModal">
                                + Add Sub Category
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
                                <h3 class="card-title">All Subcategory List here</h3>
                            </div>

                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sub Category ID</th>
                                            <th>Category ID</th>
                                            <th>Category Name</th>
                                            <th>Sub Category Name</th>
                                            <th>Sub Category Slug</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subcategories as $key => $subcategory)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $subcategory->category_id }}</td>
                                                <td>{{ $subcategory->category_name }}</td>
                                                <td>{{ $subcategory->subcategory_name }}</td>
                                                <td>{{ $subcategory->subcategory_slug }}</td>

                                                <td>
                                                    <a href="" class="btn btn-info btn-lg edit"
                                                        data-id="{{ $subcategory->id }}" data-toggle="modal"
                                                        data-target="#editsubcategoryModal">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                </td>

                                                <td>
                                                    <form action="{{ route('subcategory.destroy', $subcategory->id) }}"
                                                        method="POST" class="btn btn-danger btn-sm">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="Delete">
                                                        <button type="submit" class="delete btn btn-danger">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>

                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
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

    {{-- ---------------------------Sub Category Form Modal --------------------------- --}}

    <div class="modal fade" id="subcategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sub Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('subcategory.store') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Category Name</label>
                            <select name="category_id" class="form-control">
                                <option style="color: yellow" selected disabled value="hidden">Chosse Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" >
                                        {{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Sub Category Name</label>
                            <input type="text" class="form-control @error('subcategory_name') is-invalid @enderror" name="subcategory_name">

                            @error('subcategory_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Subcategory Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ---------------------------Sub Category Form Modal --------------------------- --}}


    {{-- ---------------------------Edit Sub Category  Modal --------------------------- --}}

    <div class="modal fade" id="editsubcategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Sub Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="" id="modal_body">

                </div>
            </div>
        </div>
    </div>
    {{-- ---------------------------Edit Category Insert Modal --------------------------- --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('body').on('click', '.edit', function() {
            let subcate_id = $(this).data('id');
            $.get("edit/" + subcate_id, function(data) {
                $('#modal_body').html(data);
            })
        })

    </script>
    
@endsection

