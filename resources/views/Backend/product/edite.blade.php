@extends('Backend.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edite Product</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edite Product</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{url('/admin/product/Update/'. $product->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Product Name*</label>
                                        <input type="text" class="form-control" id="name" value="{{$product->name}}" name="name" placeholder="Enter Product Name*" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Product Code</label>
                                        <input type="text" class="form-control" id="sku_code" value="{{$product->sku_code}}" name="sku_code" placeholder="Enter Product Code" >
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Select category*</label>
                                       <select name="cate_id" class="form-control">
                                        <option selected disabled>Select Category</option>
                                    @foreach ( $categories as $category)
                                    <option value="{{$category->id}}" @if ($category->id == $product->cate_id)
                                       selected
                                    @endif>{{$category->name}} </option>
                                    @endforeach
                                       
                                       </select>
                                      
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="name">Select Sub-Category</label>
                                           <select name="sub_cat_id" class="form-control">
                                            <option selected disabled>Select SubCategory</option>
                                        @foreach ( $subcategories as $subcategory)
                                        <option value="{{$subcategory->id}}" @if ($subcategory->id == $product->sub_cat_id)
                                            selected
                                        @endif>{{$subcategory->name}} </option>
                                        @endforeach
                                           
                                           </select>
                                          
                                        </div>
                                        <div class="form-group" id="color_field">
                                            <label for="name">Product Colors (Optional)</label>
                                            @foreach ($product->color as $singleColor)
                                            <input type="text" class="form-control" id="color" name="color[]" value="{{$singleColor->name}}" placeholder="Enter Product Color" >   
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn btn-primary" id="add_color">Add more</button>
                                        <div class="form-group" id="size_field">
                                            <label for="name">Product Sizes (Optional)</label>
                                            @foreach ($product->size as $singleSize)
                                            <input type="text" class="form-control" id="size" name="size[]" value="{{$singleSize->name}}" placeholder="Enter Product Size">  
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn btn-primary" id="add_size">Add more</button>
                                        <div class="form-group">
                                            <label for="name">Product Quantity*</label>
                                            <input type="number" class="form-control" id="qty" value="{{$product->qty}}" name="qty" placeholder="Enter Product Quantity" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Product Buying price*</label>
                                            <input type="number" class="form-control" id="buying_price" value="{{$product->buying_price}}" name="buying_price" placeholder="Enter Product Buying price" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Product Reguler price*</label>
                                            <input type="number" class="form-control" id="reguler_price" value="{{$product->reguler_price}}" name="reguler_price" placeholder="Enter Product Reguler price" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Product Discount price*</label>
                                            <input type="number" class="form-control" id="discount_price" value="{{$product->discount_price}}" name="discount_price" placeholder="Enter Product Discount price" >
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Product Description*</label>
                                            <textarea id="summernote" name="description"  class="form-control" required >{{$product->description}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Product Policy*</label>
                                            <textarea id="summernote2" name="policy"  class="form-control" required >{{$product->policy}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Select Product type</label>
                                           <select name="product_type" class="form-control">
                                            <option selected disabled>Select Product Type</option>
                                        
                                        <option value="hot" @if ($product->product_type == "hot")
                                            selected
                                        @endif>Hot Product</option>
                                        <option value="new" @if ($product->product_type == "new")
                                            selected
                                        @endif>New Arrival Product</option> 
                                        <option value="discount" @if ($product->product_type == "discount")
                                            selected
                                        @endif>Discount Product</option>
                                        <option value="reguler" @if ($product->product_type == "reguler")
                                            
                                        @endif>Reguler Product</option>  
                                           </select>
                                          
                                        </div>

                                    <div class="form-group">
                                        <label for="imag">Product Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image" value="{{$product->image}}" id="imag" accept="imag/" >
                                                   
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                        <img src="{{ asset('backend/images/products/' . $product->image) }}" height="100" width="100" alt="Product Image">

                                    </div>
                                    <div class="form-group">
                                        <label for="imag">Gallery Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="galleryimage[]" multiple id="galleryimage" accept="imag/" >
                                                    
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            
                                        
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                        
                                            </div>
                                      
                                        </div>
                                    </div>@foreach ($product->galleryimage as $image )
                                    <img src="{{asset('backend/images/galleryimage/'.$image->image)}}" height="100" width="100"> 
                                 @endforeach
                                    </div>
                                   
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('script')
    <!-- Page specific script -->
    <script>
        $(function() {
            imag.init();
        }); <script
    </script>
    <script>
        $(function () {
          // Summernote
          $('#summernote').summernote()
      
          // CodeMirror
          CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            mode: "htmlmixed",
            theme: "monokai"
          });
        })
      </script>
      </script>
      <script>
          $(function () {
            // Summernote
            $('#summernote2').summernote()
        
            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
              mode: "htmlmixed",
              theme: "monokai"
            });
          })
        </script>
        {{-- Add color --}}
        <script>
            $(document).ready(function(){
                $("#add_color").click(function(){
                    $("#color_field").append(' <input type="text" class="form-control" id="color" name="color[]" placeholder="Enter Product Color" >')
                })
            })

        </script>
        {{-- Add size --}}
        <script>
            $(document).ready(function(){
                $("#add_size").click(function(){
                    $("#size_field").append(' <input type="text" class="form-control" id="size" name="size[]" placeholder="Enter Product Size" >')
                })
            })

        </script>
    @endpush
