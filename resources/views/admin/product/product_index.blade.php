@extends('layouts.admin')
@section('title')
    Product
@endsection
@section('admin_content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12"> 
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Product List here</h3>
                            </div>

                            <!-----------------FILTARING-------------------->
                            <div class="row card-body">
                                <div class="form-group col-3">
                                    <label class="form-label">Category</label>
                                    <select class="form-control submitable" name="category_id" id="category_id">
                                        <option value="">All</option>
                                        @foreach ($category as $data )
                                        <option value="{{$data->id}}">{{$data->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>   
 
                                <div class="form-group col-3">
                                    <label class="form-label">Brand</label>
                                    <select class="form-control submitable" name="brand_id" id="brand_id">
                                        <option value="">All</option>
                                        @foreach ($brand as $data )
                                        <option value="{{$data->id}}">{{$data->brand_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-3">
                                    <label class="form-label">Werehouse</label>
                                    <select class="form-control submitable" name="warehouse" id="warehouse">
                                        <option value="">All</option>
                                        @foreach ($warehouse as $data )
                                        <option value="{{$data->warehouse_name}}">{{$data->warehouse_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-control submitable" name="product_status" id="product_status">
                                    <option value="1">All</option>
                                        <option value="1">Active</option>
                                        <option value="0">In Active</option>         
                                    </select>
                                </div>

                                <div class="form-group col-3">
                                    <label class="form-label">Date</label>
                                    <select class="form-control submitable" name="date" id="date">
                                    <option value="">All</option>                               
                                        @foreach ($product as $data)
                                            <option value="{{$data->date}}">{{$data->date}}</option>
                                        @endforeach                       
                                    </select>
                                </div>
                            </div>

                            <div class="card-body">
                                <table id="example1" class="yejratable table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S-L</th>
                                            <th>product Name</th>
                                            <th>thumbnail</th>
                                            <th>product code</th>
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            <th>Brand</th>
                                            <th>Featured</th>
                                            <th>ToDay Deal</th>
                                            <th>status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>                        
                        </div>                 
                    </div>              
                </div>          
            </div>        
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <script>
        $(function products() {
             table = $('.yejratable').DataTable({
                "processing": true,
                "serverSide": true,
                "searching":true,
                "ajax":{
                  "url": "{{ route('product.index') }}", 
                  "data":function(e) {

                    //FILTARING
                    e.category_id =$("#category_id").val();
                    e.brand_id =$("#brand_id").val();
                    e.warehouse =$("#warehouse").val();
                    e.product_status =$("#product_status").val();
                    e.date =$("#date").val();
                  }
                },
                
                columns: [
                    {data: 'DT_RowIndex',name: 'DT_RowIndex'},
                    {data: 'product_name',name: 'product_name'},
                    {
                        data: 'product_thumbnail',
                        name: 'product_thumbnail',
                        render: function(data, type, full, meta) {
                            return "<img src=\"/backend/product-thumbnail/" + data + "\" height=\"100\"/>";
                        }
                    },
                    {data: 'product_code',name: 'product_code'},
                    {data: 'category_name',name: 'category_name'},
                    {data: 'subcategory_name',name: 'subcategory_name'},
                    {data: 'brand_name',name: 'brand_name'},
                    {data: 'product_featured',name: 'product_featured'},
                    {data: 'today_deal',name: 'today_deal'},
                    {data: 'product_status',name: 'product_status'},
                    {data: 'action',name: 'action',orderable: true,searchable: true},
                ],
            });
        });

    //Active featured
	$('body').on('click','.active_featurd', function(){
	    var id=$(this).data('id');
		var url = "{{ url('product/active-featured') }}/"+id;
		$.ajax({
			url:url,
			type:'get',
			success:function(data){  
	        toastr.success(data);
	        table.ajax.reload();
	      }
	  });
    });

     //deactive featured
	$('body').on('click','.deactive_featurd', function(){
	    var id=$(this).data('id');
		var url = "{{ url('product/deactive-featured') }}/"+id;
		$.ajax({
			url:url,
			type:'get',
			success:function(data){  
	        toastr.success(data);
	        table.ajax.reload();
	      }
	  });
    });

    //Active TO DAY DEAL
	$('body').on('click','.active_deal', function(){
	    var id=$(this).data('id');
		var url = "{{ url('product/active-todaydeal') }}/"+id;
		$.ajax({
			url:url,
			type:'get',
			success:function(data){  
	        toastr.success(data);
	        table.ajax.reload();
	      }
	  });
    });

    //deactive TO DAY DEAL
	$('body').on('click','.deactive_deal', function(){
	    var id=$(this).data('id');
		var url = "{{ url('product/deactive-todaydeal') }}/"+id;
		$.ajax({
			url:url,
			type:'get',
			success:function(data){  
	        toastr.success(data);
	        table.ajax.reload();
	      }
	  });
    });

    //Active STATUS
	$('body').on('click','.active_status', function(){
	    var id=$(this).data('id');
		var url = "{{ url('product/active-status') }}/"+id;
		$.ajax({
			url:url,
			type:'get',
			success:function(data){  
	        toastr.success(data);
	        table.ajax.reload();
	      }
	  });
    });

    //deactive STATUS
	$('body').on('click','.deactive_status', function(){
	    var id=$(this).data('id');
		var url = "{{ url('product/deactive-status') }}/"+id;
		$.ajax({
			url:url,
			type:'get',
			success:function(data){  
	        toastr.success(data);
	        table.ajax.reload();
	      }
	  });
    });

    //submitable class call for every change
    $(document).on('change','.submitable', function(){
      $('.yejratable').DataTable().ajax.reload();
    });
    </script>

    
@endsection
