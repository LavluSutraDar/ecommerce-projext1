@extends('layouts.admin')
@section('title')
    Category
@endsection

@section('admin_content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#categoryModal">
                                + Add Category
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
                                <h3 class="card-title">All category List here</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S-L</th>
                                            <th>Category Name</th>
                                            <th>Category Slug</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($categorys as $key=>$category)
                                          <tr>
                                            <td>{{$key +1}}</td>
                                            <td>{{$category->category_name}}</td>
                                            <td>{{$category->category_slug}}</td>
                                            
                                             <td>
                                              <a href="" class="btn btn-danger btn-lg edit" data-id="{{$category->id}}" data-toggle="modal" data-target="#editcategoryModal">
                                              <i class="fa-solid fa-pen-to-square"></i>
                                             </a>
                                             </td>

                                             <td>
                                              <a href="{{route('category.delete',$category->id)}}"     class="btn btn-danger btn-lg">
                                                <i class="fa-solid fa-trash-can"></i>
                                              </a>
                                             </td>

                                             {{-- <td>
                                               <form action="{{ route('category.delete', $category->id) }}" method="POST">
                                                   @csrf
                                                   <input type="hidden" name="_method" value="Delete">
                                                   <button type="submit" class="delete btn btn-danger">
                                                     Delete
                                                   </button>
                                                <i class="fa-solid fa-trash-can"></i>

                                               </form>
                                             </td --}}
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

    {{-- --------------------------- Category Insert Modal --------------------------- --}}

    <!-- Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('category.store')}}" method="POST">
                      @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Category Name</label>
                            <input type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name">

                             @error('category_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- --------------------------- Category Insert Modal --------------------------- --}}


    {{-- ---------------------------Edit Category  Modal --------------------------- --}}

    <div class="modal fade" id="editcategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('category.update')}}" method="POST">
                      @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Edit Category Name</label>
                            <input type="text" class="form-control" id="edit_category_name" name="category_name">
                            <input type="hidden" class="form-control" name="id" id="edit_category_id">

                
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
            </div>
        </div>
    </div>
    {{-- ---------------------------Edit Category Modal --------------------------- --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('body').on('click', '.edit', function(){
            let cat_id= $(this).data('id');
            $.get("edit/"+cat_id, function(data){
                $('#edit_category_name').val(data.category_name);
                 $('#edit_category_id').val(data.id);

            })
        })
    </script>
@endsection
