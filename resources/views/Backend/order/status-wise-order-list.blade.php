@extends('Backend.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>ALL Orders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
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

                            <!-- /.card-header -->

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">ALL Order List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Invoice Number</th>
                                            <th>Product</th>
                                            <th>Customer Info</th>
                                            <th>Courier Name</th>
                                            <th>Current Status</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($orders as $order)
                                              <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$order->invoiceId}}</td>
                                    <td>
                                       @foreach ($order->orderdettails as $detail)
                                           <img src="{{asset('backend/images/products/'.$detail->Products->image)}}" height="100" width="100"> <br>
                                                {{$detail->qty}}X {{$detail->Products->name}} <br> 
                                       @endforeach
                                    </td>
                                    <td> 
                                        Name: {{$order->c_name}} <br>
                                        Phone:{{$order->c_phone}} <br>
                                        address: {{$order->address}} <br> 
                                        Price:{{$order->price}}  <br> 
                                    </td>
                                    <td>{{$order->courier_name?? "Not Selected"}}</td>
                                    <td>  
                                        <span class="badge badge-success">{{$order->status}}</span>
                                    </td>
                                    <td> 
                                        <a href="{{url('/admin/order/Update-Status/pending/'.$order->id)}}" class="btn btn-warning">Pending</a>
                                        <a href="{{url('/admin/order/Update-Status/confirmed/'.$order->id)}}" class="btn btn-success">Confirmed</a>
                                        <a href="{{url('/admin/order/Update-Status/delivered/'.$order->id)}}" class="btn btn-info">Delivered</a>
                                        <a href="{{url('/admin/order/Update-Status/cancelled/'.$order->id)}}" class="btn btn-danger">Cancelled</a>
                                    </td>
                                    
                                    <td>
                                        <a href="{{url('/admin/order/Edite/'.$order->id)}}" class="btn btn-primary">Edit</a>
                                        
                                    </td>
                                </tr>
                                        @endforeach
    
                                  

                                        </tfoot>
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
@endsection
@push('script')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush

  