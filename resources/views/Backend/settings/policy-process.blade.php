@extends('Backend.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Update Policy & Process</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Update Policy & Process</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <form action="{{ url('/admin/policies-process/update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update Policy & Process</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputDescription"> Privacy Policy*</label>
                                    <textarea id="inputDescription" name="privacy_policy" class="form-control" rows="4" required>{{$policy->privacy_policy}}</textarea>
                                </div>  
                                 <div class="form-group">
                                    <label for="inputDescription">Terms & conditions*</label>
                                    <textarea id="inputDescription" name="terms_conditions" class="form-control" rows="4" required>{{$policy->terms_conditions}}</textarea>
                                </div>  
                                 <div class="form-group">
                                    <label for="inputDescription"> Refund Policy*</label>
                                    <textarea id="inputDescription" name="refund_policy" class="form-control" rows="4" required>{{$policy->refund_policy}}</textarea>
                                </div>  
                                 <div class="form-group">
                                    <label for="inputDescription">Payment Policy*</label>
                                    <textarea id="inputDescription" name="payment_policy" class="form-control" rows="4" required>{{$policy->payment_policy}}</textarea>
                                </div>  
                                 <div class="form-group">
                                    <label for="inputDescription">Aboute Us*</label>
                                    <textarea id="inputDescription" name="about_us" class="form-control" rows="4" required>{{$policy->about_us}}</textarea>
                                </div>  
                                 <div class="form-group">
                                    <label for="inputDescription">Return Process*</label>
                                    <textarea id="inputDescription" name="return_process" class="form-control" rows="4" required>{{$policy->return_process}}</textarea>
                                </div>  
                            </div>
                        </div>
                        <input type="submit" value="Update Order" class="btn btn-success ">
                    </div>
                    
                </div>
            </form>

    </div>
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
