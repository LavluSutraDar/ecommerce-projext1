
@extends('layouts.admin')
@section('title')
    Ware house
@endsection
@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Ware House</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#warehouseModal">
                                + Add Ware House
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
                                <h3 class="card-title">Ware house List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="yejratable table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S-L</th>
                                            <th>Ware house Name</th>
                                            <th>Ware house Address</th>
                                            <th>Ware house Phone</th>
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

    <div class="modal fade" id="warehouseModal" tabindex="-1" aria-labelledby="exampleModalLabel"aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ware House</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('warehouse.store')}}" method="POST" id="add-form">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ware House Name</label>
                            <input type="text" class="form-control @error('warehouse_name') is-invalid @enderror"
                                name="warehouse_name">

                            @error('warehouse_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ware House Address</label>
                            <input type="text" class="form-control @error('warehouse_address') is-invalid @enderror"
                                name="warehouse_address">

                            @error('warehouse_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ware House Phone</label>
                            <input type="number" class="form-control @error('warehouse_phone') is-invalid @enderror"
                                name="warehouse_phone">

                            @error('warehouse_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Ware House Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ---------------------------Child Category Store Modal --------------------------- --}}


    {{-- ---------------------------Child Category Edit Modal --------------------------- --}}
   <div class="modal fade" id="editwarehouseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Ware House</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="warehouse_body">
                    
                </div>
               
            </div>
        </div>
    </div>
    {{-- ---------------------------Child Category Edit Modal --------------------------- --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <script>
        $(function warehouse() {
            var table = $('.yejratable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('warehouse.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                   
                    {
                        data: 'warehouse_name',
                        name: 'warehouse_name'
                    },
                    {
                        data: 'warehouse_address',
                        name: 'warehouse_address'
                    },
                     {
                        data: 'warehouse_phone',
                        name: 'warehouse_phone'
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
        
         $('body').on('click', '.warehouseedit', function() {
            let warehouse_id = $(this).data('id');
            $.get("/warehouse/edit/" + warehouse_id, function(data) {
                $('#warehouse_body').html(data);
            });
         });
    </script>
@endsection
