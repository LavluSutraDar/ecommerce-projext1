@extends('layouts.admin')
@section('title')
    PickUp Point
@endsection
@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add PickUp Point</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#pickupPointModal">
                                + PickUp Point
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
                                <h3 class="card-title">All PickUp Point List here</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="yejratable table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            
                                            <th>S-L</th>
                                            <th>Pickup Point Name</th>
                                            <th>pickup point Address</th>
                                            <th>pickup phone</th>
                                            <th>pickup phone Two</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                                <form id="delete_form" action="" method="DELETE">
                                    @csrf @method('DELETE')
                                </form>

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


    {{-- --------------------------- Store Modal --------------------------- --}}

    <div class="modal fade" id="pickupPointModal" tabindex="-1" aria-labelledby="exampleModalLabel"aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">PickUp Point</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('pickuppoint.store')}}" method="POST" id="add_form">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Pickup Point Name</label>
                            <input type="text" class="form-control @error('pickup_point_name') is-invalid @enderror" name="pickup_point_name">

                            @error('pickup_point_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pickup point Address  </label>
                            <textarea name="pickup_point_address" id="" cols="5" rows="5"     class="form-control">
                            </textarea>
                        </div>

                         <div class="mb-3">
                            <label class="form-label">Pickup Point Phone</label>
                            <input type="number" class="form-control" name="pickup_point_phone"
                                @error('pickup_point_phone') is-invalid @enderror">

                            @error('pickup_point_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pickup Point Phone Two</label>
                            <input type="number" class="form-control" name="pickup_point_phone_two"
                                @error('pickup_point_phone_two') is-invalid @enderror">
                            @error('pickup_point_phone_two')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Coupon Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ---------------------------Child Category Store Modal --------------------------- --}}


    {{-- ---------------------------Child Category Edit Modal --------------------------- --}}
    <div class="modal fade" id="editpickupModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pick Up</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="pickupmodal_body">

                </div>

            </div>
        </div>
    </div>

    {{-- ---------------------------Child Category Edit Modal --------------------------- --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>


    <script>
        $(function coupon() {
            var table = $('.yejratable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pickuppoint.index') }}",
                columns: [
                    {data: 'DT_RowIndex',name: 'DT_RowIndex'},
                    {data: 'pickup_point_name', name: 'pickup_point_name'},
                    {data: 'pickup_point_address', name: 'pickup_point_address'},
                    {data: 'pickup_point_phone', name: 'pickup_point_phone'},
                    {data: 'pickup_point_phone_two', name: 'pickup_point_phone_two'},
                    {data: 'action',name: 'action',orderable: true, searchable: true},
                ],
            });
        });

        //STORE AJAX CALL
         $(document).on('submit', '#add_form', function(e) {
              e.preventDefault();
              var url = $(this).attr('action');
              var request = $(this).serialize();
              $.ajax({
                  url: url,
                  type: 'post',
                  data: request,
                  success: function(data) {
                      toastr.success(data);
                      $('#add_form')[0].reset();
                      $('#pickupPointModal').modal('hide');
                      table.ajax.reload();
                  }
              });
          });

        // EDIT
        $('body').on('click', '.editpickup', function() {
            let pickup_id = $(this).data('id');
            $.get("/pickup/edit/" + pickup_id, function(data) {
                $('#pickupmodal_body').html(data);
            });
        });

           //UPDATE AJAX CALL
          $(document).on('submit', '#edit_form', function(e) {
              e.preventDefault();
              var url = $(this).attr('action');
              var request = $(this).serialize();
              $.ajax({
                  url: url,
                  type: 'post',
                  data: request,
                  success: function(data) {
                      //toastr.success(data);
                      $('#add_form')[0].reset();
                      table.ajax.reload();
                  }
              });
          });

        // DELETE AJAX CALL
        $(document).on('click', '#delete_coupon', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $('#delete_form').attr('action', url);
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#delete_form').submit();
                    } else {
                       swal('Your data safe!');
                    }
                });
        });

        //DATA PASSE THROUGH HERE ajax call (relode chara delete)
         $(document).on('submit', '#delete_form', function(e) {
             e.preventDefault();
             var url = $(this).attr('action');
             var request = $(this).serialize();
             $.ajax({
                 url: url,
                 type: 'post',
                 data: request,
                 success: function(data) {
                     toastr.success(data);
                     $('#delete_form')[0].reset();
                     table.ajax.reload();
                 }
             });
         });
    </script>
@endsection
