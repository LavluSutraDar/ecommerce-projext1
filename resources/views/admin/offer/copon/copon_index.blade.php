@extends('layouts.admin')
@section('title')
    Coupon
@endsection
@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Coupon</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#couponModal">
                                + Add Coupon
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
                                <h3 class="card-title">All Coupon List here</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="yejratable table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S-L</th>
                                            <th>Coupon Code</th>
                                            <th>Coupon Date</th>
                                            <th>Coupon Type</th>
                                            <th>Coupon Amount</th>
                                            <th>Coupon Status</th>
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


    {{-- ---------------------------Child Category Store Modal --------------------------- --}}

    <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="exampleModalLabel"aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Coupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('coupon.store') }}" method="POST" id="add_form">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Coupon code</label>
                            <input type="text" class="form-control @error('coupon_code') is-invalid @enderror"
                                name="coupon_code">

                            @error('coupon_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Coupon Date</label>
                            <input type="date" class="form-control" name="coupon_date"
                                @error('coupon_date') is-invalid @enderror">

                            @error('coupon_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Coupon Type</label>
                            <select name="coupon_type" id="" class="form-control">
                                <option style="color: yellow" selected disabled value="hidden">Chosse Category</option>
                                <option value="1">Fixed</option>
                                <option value="2">Percentage</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Coupon Amount</label>
                            <input type="number" class="form-control @error('coupon_amount') is-invalid @enderror"
                                name="coupon_amount">

                            @error('coupon_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Coupon Status</label>
                            <select name="status" id="" class="form-control">
                                <option style="color: yellow" selected disabled value="hidden">Chosse Category</option>
                                <option value="active">Active</option>
                                <option value="inactive">In Active</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"> <span class="d-none">Loading ....</span>
                                Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ---------------------------Child Category Store Modal --------------------------- --}}


    {{-- ---------------------------Child Category Edit Modal --------------------------- --}}
    <div class="modal fade" id="editCouponModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Cupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="couponmodal_body">

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
                ajax: "{{ route('coupon.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'coupon_code',
                        name: 'coupon_code'
                    },
                    {
                        data: 'coupon_date',
                        name: 'coupon_date'
                    },
                    {
                        data: 'coupon_type',
                        name: 'coupon_type'
                    },
                    {
                        data: 'coupon_amount',
                        name: 'coupon_amount'
                    },
                    {
                        data: 'status',
                        name: 'status'
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

        //STORE COUPON AJAX CALL
        //   $(document).on('submit', '#add_form', function(e) {
        //       e.preventDefault();
        //       var url = $(this).attr('action');
        //       var request = $(this).serialize();
        //       $.ajax({
        //           url: url,
        //           type: 'post',
        //           data: request,
        //           success: function(data) {
        //               toastr.success(data);
        //               $('#add_form')[0].reset();
        //               $('#couponModal').modal('hide');
        //               table.ajax.reload();
        //           }
        //       });
        //   });

        //   COUPON EDIT
        $('body').on('click', '.editCoupon', function() {
            let cupon_id = $(this).data('id');
            $.get("/coupon/edit/" + cupon_id, function(data) {
                $('#couponmodal_body').html(data);
            });
        });

        // UPDATE COUPON AJAX CALL
          $(document).on('submit', '#edit_form', function(e) {
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
                      $('#edit_form').modal('hide');
                      table.ajax.reload();
                  }
              });
          });

        // COUPON DELETE AJAX CALL

        
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
            $('#delete_form').submit(function(e) {
                e.preventDefault();
                var url = $(this).attr('action');
                var request = $(this).serialize();
                $.ajax({
                    url: url,
                    type: 'post',
                    async:false,
                    data: request,
                    success: function(data) {
                        //toastr.success(data);
                        $('#delete_form')[0].reset();
                        table.ajax.reload();
                    }
                });
            });

        
    </script>
@endsection
