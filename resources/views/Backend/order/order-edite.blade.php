@extends('Backend.master')
@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Order Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <form action="{{url('/admin/order/Update/'. $order->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Customer Details</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="invoiceid">Invoice Number</label>
                <input type="text" id="invoiceid" name="invoiceid" class="form-control" value="{{$order->invoiceId}}" readonly>
              </div>
              <div class="form-group">
                <label for="inputDescription">Customer Name</label>
                <input type="text" id="c_name" name="c_name" class="form-control" value="{{$order->c_name}}" required>
              </div>
               <div class="form-group">
                <label for="inputDescription">Customer Phone</label>
                <input type="text" id="c_phone" name="c_phone" class="form-control" value="{{$order->c_phone}}" required>
              </div>
              <div class="form-group">
                <label for="inputDescription"> Customer Address</label>
                <textarea id="inputDescription" name="address" class="form-control" rows="4" required>{{$order->address}}</textarea>
              </div>
              <div class="form-group">
                <label for="inputDescription">Delivery Charge</label>
                <input type="text" id="area" name="area" class="form-control" value="{{$order->area}}" required>
              </div>
              
              <div class="form-group">
                <label for="inputStatus">Select Courier</label>
                <select id="inputStatus" name="courier_name" class="form-control custom-select">
                 @if ($order->courier_name == null)
                  <option disabled selected>Select one</option>
                  <option value="Steadfast">Steadfast</option>
                  <option value="Pathao">Pathao</option>
                  <option  value="Others">Others</option>

                  @elseif ($order->courier_name == "Steadfast")
                  <option value="Steadfast" selected>Steadfast</option>
                  <option value="Pathao">Pathao</option>
                  <option  value="Others">Others</option>

                  @elseif ($order->courier_name == "Pathao")
                  <option value="Steadfast" >Steadfast</option>
                  <option value="Pathao" selected>Pathao</option>
                  <option  value="Others">Others</option>

                  @else ($order->courier_name == "Others")
                     <option value="Steadfast" s>Steadfast</option>
                     <option value="Pathao" >Pathao</option>
                     <option  value="Others" selected>Others</option>
                 @endif
                </select>
              </div>
             
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Product Details</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  @foreach ($order->orderdettails as $details)
                       <img src="{{asset('backend/images/products/'.$details->Products->image)}}" height="100" width="100">
                    {{$details->qty}}X {{$details->Products->name}} | Unit Price: {{$details->price}} | Color: {{$details->color ?? "N.A"}}  | Size: {{$details->size ?? "N.A"}} <br><br> 
                  @endforeach
                   
                </div>
                <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputDescription">Order Price</label>
                                <input type="text" id="" name="price" class="form-control" value="{{$order->price}}" required>
                            </div>
                        </div>
              </div>
              <input type="submit" value="Update Order" class="btn btn-success float-right">
            </div>
            <!-- /.card-body -->
          </div>
         
        </div>
      </div>
      </form>
      
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    
@endsection