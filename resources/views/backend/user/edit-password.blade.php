@extends('backend.layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Password</hh1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Password</li>
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
                <h3> Edit Password </h3>
              </div><!-- /.card-header -->

                <div class="card-body">
                    <form method="post" action="{{ route('profiles.password.update') }}" id="myForm">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="old_password"> Old Password</label>
                                <input type="password" name="old_password" id="old_password" class="form-control">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="new_password">New Password</label>
                                <input type="password" name="new_password" id="new_password" class="form-control">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="confirm_new_password">Confirm New Password</label>
                                <input type="password" name="confirm_new_password" class="form-control">
                            </div>

                            <div class="form-group col-md-6">
                                <input type="submit" value="Update" class="btn btn-success">
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
      old_password: {
        required: true
      },
      new_password: {
        required: true,
        minlength: 6
      },
      confirm_new_password: {
        required: true,
        equalTo: '#new_password',
      },      
    },

    messages: {
      old_password: {
        required: "Please enter current password"
      },
      new_password: {
        required: "Please enter new password",
        minlength: "Password should be at least 6 characters or numbers"
      },
      confirm_new_password: {
        required: "Please enter confirm password",
        equalTo: "Confirm password doesn't match"
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