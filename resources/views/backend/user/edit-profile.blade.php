@extends('backend.layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
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
                <h3> Edit Profile
                <a class="btn btn-primary float-right btn-sm"href="{{route('profiles.view')}}"><i class="fa fa-list"></i> Your Profile</a>
                </h3>
              </div><!-- /.card-header -->

                <div class="card-body">
                    <form method="post" action="{{ route('profiles.update') }}" id="myForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{$editData->name}}" class="form-control">
                                <font style="color: red">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="email">Email</label>
                                <input type="email" name="email" value="{{$editData->email}}" class="form-control">
                                <font style="color: red">{{($errors->has('email'))?($errors->first('email')):''}}</font>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="mobile">Mobile Number</label>
                                <input type="number" name="mobile" value="{{$editData->mobile}}" class="form-control">
                                <font style="color: red">{{($errors->has('mobile'))?($errors->first('mobile')):''}}</font>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="address">Address</label>
                                <input type="text" name="address" value="{{$editData->address}}" class="form-control">
                                <font style="color: red">{{($errors->has('address'))?($errors->first('address')):''}}</font>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="">Please select</option>
                                    <option value="Male" {{($editData->gender=="Male")?"selected":""}}>Male</option>
                                    <option value="Female" {{($editData->gender=="Female")?"selected":""}}>Female</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control" id="image">
                            </div>

                            <div class="form-group col-md-2">
                                <img src="{{(!empty($editData->image)) ? url('public/upload/user_images/'.$editData->image) : url('public/upload/no-image.png')}}" alt="" style="width: 150px; height: 160px; border: 1px solid black;" id="showImage">
                            </div>

                            <div class="form-group col-md-2" style="padding-top: 50px">
                                <input type="submit" value="Update" class="btn btn-info">
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
      usertype: {
        required: true
      },
      name: {
        required: true
      },
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 6
      },
      password2: {
        required: true,
        equalTo: '#password',
      },      
    },

    messages: {
      usertype: {
        required: "Please select user type"
      },
      name: {
        required: "Please enter your name"
      },
      email: {
        required: "Please enter your email address",
        email: "Please enter a vaild email address"
      },
      password: {
        required: "Please enter a password",
        minlength: "Password must be at least 6 characters or numbers"
      },
      password2: {
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