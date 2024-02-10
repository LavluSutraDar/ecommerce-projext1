@extends('layouts.admin')
@section('title')
    Brands
@endsection
@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Brands</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#brandModal">
                                + Add Brands
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
                                <h3 class="card-title">All Brands List here</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="yejratable table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S-L</th>
                                            <th>Brand Name</th>
                                            <th>Brand Slug</th>
                                            <th>Brand Logo</th>
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

    <div class="modal fade" id="brandModal" tabindex="-1" aria-labelledby="exampleModalLabel"aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Child Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data" id="add-form">
                        @csrf
                        <div class="mb-3">
                            <label for="brand_name" class="form-label">Brand Name</label>
                            <input type="text" class="form-control @error('brand_name') is-invalid @enderror" name="brand_name" value="{{old('brand_name')}}">

                            @error('brand_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="input-file-now" class="form-label">Brand Logo</label>
                            <input type="file" id="input-file-now"
                                class="dropify form-control @error('brand_logo') is-invalid @enderror" name="brand_logo">

                            @error('brand_logo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Subcategory Submit</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

    {{-- ---------------------------Child Category Store Modal --------------------------- --}}


    {{-- ---------------------------Child Category Edit Modal --------------------------- --}}
       <div class="modal fade" id="editbrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="brandmodal_body">
                    
                </div>
               
            </div>
        </div>
    </div>

    {{-- ---------------------------Child Category Edit Modal --------------------------- --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>


    <script>
         $(function childcategory() {
             var table = $('.yejratable').DataTable({
                 processing: true,
                 serverSide: true,
                 ajax: "{{ route('brand.index') }}",
                 columns: [
                     {data: 'DT_RowIndex',name: 'DT_RowIndex'},
                     { data: 'brand_name',name: 'brand_name'},
                     { data: 'brand_slug',name: 'brand_slug'},
                     { data: 'brand_logo',name: 'brand_logo',
                         render: function(data, type, full, meta) {
                         return "<img src=\"/backend/brand-logo/" + data + "\" height=\"50\"/>";
                        }
                     },
                     {  data: 'action',name: 'action',orderable: true,searchable: true},
                 ],
             });
         }); 

        $('body').on('click', '.brandedit', function() {
            let id = $(this).data('id');
            $.get("/brand/edit/" + id, function(data) {
                $("#brandmodal_body").html(data);
            });
        });

        //Dropify your input files with style
        $('.dropify').dropify({
            messages: {
                'default': 'file click',
                'replace': 'click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });
    </script>
@endsection
