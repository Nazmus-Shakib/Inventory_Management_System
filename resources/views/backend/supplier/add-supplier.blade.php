@extends('backend.layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Suppliers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Suppliers</h1></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-md-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3> Add Suppliers
                <a class="btn btn-primary float-right btn-sm" href="{{route('suppliers.view')}}"><i class="fa fa-list"></i> Suppliers List</a>
                </h3>
              </div><!-- /.card-header -->

                <div class="card-body">
                    <form method="post" action="{{ route('suppliers.store') }}" id="myForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Supplier Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="email">Supplier Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="mobile_no">Supplier Mobile</label>
                                <input type="text" name="mobile_no" class="form-control">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="address">Supplier Address</label>
                                <input type="text" name="address" class="form-control">
                            </div>

                            <div class="form-group col-md-2">
                                <input type="submit" value="Submit" class="btn btn-info">
                            </div>
                        </div>
                    </form>
                </div>
              </div><!-- /.card-body -->
            </div>

            <!-- /.card -->
          </section>
          <!-- /.Left col -->
        </div>
  <!-- /.content-wrapper -->

<script>
$(function () {
  $('#myForm').validate({
    rules: {

      name: {
        required: true
      },

      email: {
        required: true,
        email: true,
      },

      mobile_no: {
        required: true,
      },

      address: {
        required: true,
      }, 
    },

    messages: {
      name: {
        required: "Please enter your name"
      },
      email: {
        required: "Please enter your email",
        email: "Please enter a valid email"
      },
      mobile_no: {
        required: "Please enter a mobile number",
      },
      address: {
        required: "Please enter your address",
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>

  @endsection