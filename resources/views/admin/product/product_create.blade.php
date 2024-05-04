 @extends('layouts.admin')
@section('title')
    New Product
@endsection

@section('admin_content')

<script type="text/javascript" src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js">
</script> 

<style type="text/css">
  .bootstrap-tagsinput .tag {
    background: #428bca;;
    border: 1px solid white; 
    padding: 1 6px;
    padding-left: 2px;
    margin-right: 2px;
    color: white;
    border-radius: 4px;
  }
</style> 


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>New Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add product</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Add New Product</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">

                                        <div class="form-group col-lg-6">
                                            <label for="product_name" class="form-label">Product Name</label>
                                            <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" id="product_name" value="{{old('product_name')}}">

                                            @error('product_name')
                                                <span class="invalid-feedback"role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                         <div class="form-group col-lg-6">
                                            <label for="product_code">Product Code <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('product_code') is-invalid @enderror" value="{{ old('product_code') }}" name="product_code" id="product_code">

                                            @error('product_code')
                                                <span class="invalid-feedback"role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                     
                                    <div class="row">

                                        <div class="form-group col-lg-6">
                                            <label for="subcategory_id">Category/ Subcategory <span
                                                    class="text-danger">*</span> </label>
                                            <select class="form-control" name="subcategory_id" id="subcategory_id">
                                                <option disabled selected="">choose category</option>
                                                @foreach ($categories as $categorie)
                                                  @php
                                                    $subcat = DB::table('subcategories')
                                                        ->where('category_id', $categorie->id)
                                                        ->get();
                                                    @endphp
                                                
                                                <option disabled style="color: yellow">{{$categorie->category_name}}</option>

                                                @foreach ($subcat as $subcategory)
                                                  <option value="{{ $subcategory->id }}"> ---{{     $subcategory->subcategory_name }}
                                                  </option>
                                                @endforeach
                                                    
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="childcategory_id">Child category<span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" name="childcategory_id" id="childcategory_id">
                                            <option disabled selected="">choose Child 
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="brand_id">Brand <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" name="brand_id">
                                              <option disabled selected="">choose Brands</option>
                                              @foreach ($brands as $brand)
                                                  <option value="{{ $brand->id }}">{{     $brand->brand_name }}
                                                  </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="pickup_point_id">Pickup Point</label>
                                            <select class="form-control" name="pickup_point_id">
                                                <option disabled selected="">Pickup Point</option>
                                                @foreach ($pickupPoints as $pickupPoint)
                                                  <option value="{{ $pickupPoint->id }}">{{     $pickupPoint->pickup_point_name }}
                                                  </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="product_unit">Product Unit <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="product_unit"   id="product_unit" class="form-control  @error('product_unit') is-invalid @enderror" value="{{old('product_unit')}}">

                                            @error('product_unit')
                                                <span class="invalid-feedback"role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="product_tags">Product Tags</label><br>
                                            <input type="text" name="product_tags" class="form-control @error('product_tags') is-invalid @enderror" data-role="tagsinput" value="{{old('product_tags')}}">

                                            @error('product_tags')
                                                <span class="invalid-feedback"role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-4">
                                            <label for="purchase_price">Purchase Price </label>
                                            <input type="text" class="form-control @error('purchase_price') is-invalid @enderror" value="{{ old('purchase_price') }}"
                                                name="purchase_price" id="purchase_price">

                                                @error('purchase_price')
                                                <span class="invalid-feedback"role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </div>

                                        <div class="form-group col-lg-4">
                                            <label for="selling_price">Selling Price <span class="text-danger">*</span>
                                            </label>

                                            <input type="text" name="selling_price" value="{{ old('selling_price') }}"
                                                class="form-control @error('selling_price') is-invalid @enderror" id="selling_price">

                                                @error('selling_price')
                                                <span class="invalid-feedback"role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-lg-4">
                                            <label for="discount_price">Discount Price </label>
                                            <input type="text" name="discount_price"
                                                value="{{ old('discount_price') }}" class="form-control @error('discount_price') is-invalid @enderror"
                                                id="discount_price">

                                                @error('discount_price')
                                                <span class="invalid-feedback"role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="warehouse">Warehouse <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control" name="warehouse">
                                                 <option disabled selected="">Warehouse</option>
                                                @foreach ($warehouses as $warehouse)
                                                  <option value="{{ $warehouse->warehouse_name }}">
                                                    {{ $warehouse->warehouse_name }}
                                                  </option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="stock_quantity">Stock Quantity</label>
                                            <input type="text" name="stock_quantity"
                                                value="{{ old('stock_quantity') }}" class="form-control @error('stock_quantity') is-invalid @enderror"
                                                id="stock_quantity">

                                                @error('stock_quantity')
                                                <span class="invalid-feedback"role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                               @enderror
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="color">Color</label><br>
                                             <input type="text" class="form-control tag" value="{{ old('color') }}" data-role="tagsinput" name="color" />
                                             
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="size">Size</label><br>
                                            <input type="text" class="form-control tag" value="{{ old('size') }}" data-role="tagsinput" name="size"  />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-12">
                                            <label for="product_description	">Product Details</label>
                                            <textarea class="form-control textarea @error('product_description') is-invalid @enderror" name="product_description" id="product_description" value="{{ old('product_description') }}">
                                            </textarea>

                                            @error('product_description')
                                                <span class="invalid-feedback"role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-12">
                                            <label for="product_video">Video Embed Code</label>
                                            <input class="form-control @error('product_video') is-invalid @enderror" name="product_video" id="product_video"
                                                value="{{ old('product_video') }}"
                                                placeholder="Only code after embed word">

                                            <small class="text-danger">Only code after embed word</small>

                                            @error('product_video')
                                                <span class="invalid-feedback"role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">

                            <div class="card card-primary">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="product_thumbnail">Product Thumbnail <span class="text-danger">*</span>
                                        </label>
                                        <br>
                                        <input type="file" name="product_thumbnail" accept="image/*"
                                            class="dropify @error('product_thumbnail') is-invalid @enderror" id="product_thumbnail">

                                            @error('product_thumbnail')
                                                <span class="invalid-feedback"role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <br>

                                    <div class="">
                                        <table class="table table-bordered" id="dynamic_field">
                                            <div class="card-header">
                                                <h3 class="card-title">More Images (Click Add For More Image)</h3>
                                            </div>
                                            <tr>
                                                <td>
                                                    <input type="file" accept="image/*" name="product_images[]"
                                                        class="form-control name_list"/>
                                                </td>
                                                <td>
                                                    <button type="button" name="add" id="add"
                                                        class="btn btn-success">Add</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
 
                                    <div class="card p-4">
                                        <h6>Product Featured</h6>
                                        <input type="checkbox" name="product_featured" value="1" checked
                                            data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>

                                    <div class="card p-4">
                                        <h6>Today Deal</h6>
                                        <input type="checkbox" name="today_deal" value="1" checked
                                            data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>

                                    <div class="card p-4">
                                        <h6>Slider Product</h6>
                                        <input type="checkbox" name="product_slider" value="1" data-bootstrap-switch
                                            data-off-color="danger" data-on-color="success">
                                    </div>

                                    <div class="card p-4">
                                        <h6>Trendy Product</h6>
                                        <input type="checkbox" name="trendy" value="1" data-bootstrap-switch
                                            data-off-color="danger" data-on-color="success">
                                    </div>

                                    <div class="card p-4">
                                        <h6>Product Status</h6>
                                        <input type="checkbox" name="product_status" value="1" checked
                                            data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button class="btn btn-info ml-2" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
    <script src="{{ asset("backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js") }}"></script>
    

    <script type="text/javascript">

        //dropify image
        $('.dropify').dropify(); 
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

    //ajax request send for collect childcategory
     $("#subcategory_id").change(function(){
      var id = $(this).val();
      $.ajax({
           url: "{{ url("/get-child-category/") }}/"+id,
           type: 'get',
           success: function(data) {
                $('select[name="childcategory_id"]').empty();
                   $.each(data, function(key,data){
                      $('select[name="childcategory_id"]').append('<option value="'+ data.id +'">'+ data.childcategory_name +'</option>');
                });
           }
        });
     });

        //MULTIPAL IMAGE STORE 
        $(document).ready(function() {
            var postURL = "<?php echo url('addmore'); ?>";
            var i = 1;
            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<tr id="row' + i +
                    '" class="dynamic-added"><td><input type="file" accept="image/*" name="product_images[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="' +
                    i + '" class="btn btn-danger btn_remove">Remove</button></td></tr>');
            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
        });
    </script>

@endsection
