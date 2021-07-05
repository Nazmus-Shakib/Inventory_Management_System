@extends('backend.layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Purchases</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Purchases</h1></li>
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
                <h3> Add Purchases
                <a class="btn btn-primary float-right btn-sm" href="{{route('purchases.view')}}"><i class="fa fa-list"></i> Purchases List</a>
                </h3>
              </div><!-- /.card-header -->

              <div class="card-body">
                      <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="date">Date</label>
                                <input type="text" id="date" name="date" class="form-control datepicker" placeholder="YYYY-MM-DD" readonly>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="purchase_no">Purchase No</label>
                                <input type="text" id="purchase_no" name="purchase_no" class="form-control">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="supplier_id">Supplier Name</label>
                                <select name="supplier_id" id="supplier_id" class="form-control">
                                    <option value="">Select Supplier</option>
                                    @foreach($suppliers as $supplier)
                                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="product_id">Product Name</label>
                                <select name="product_id" id="product_id" class="form-control">
                                    <option value="">Select Product</option>
                                </select>
                            </div>

                            <div class="form-group col-md-2" style="margin-top:32px">
                                <a class="btn btn-danger addMoreEvent"><i class="fa fa-plus-circle"></i> Add More</a>
                            </div>
                      </div>
              </div><!-- /.card-body -->

              <div class="card-body">
                  <form method="post" action="{{route('purchases.store')}}" id="myForm">
                    @csrf
                    <table class="table-sm table-bordered" width="100%">
                      <thead>
                        <tr>
                          <th>Category</th>
                          <th>Product Name</th>
                          <th width="10%">PCS/KG</th>
                          <th width="10%">Unit Price</th>
                          <th>Description</th>
                          <th width="10%">Total Price</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="addRow" class="addRow">
                      
                      </tbody>
                      <tbody>
                        <tr>
                          <td colspan="5"></td>
                          <td>
                            <input type="text" name="estimated_amount" id="estimated_amount" value="0" class="form-control form-control-sm text-right estimated_amount" readonly style="background-color: #D8FDBA">
                          </td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                    <br>
                    <div class="form-group">
                      <button type="submit" class="btn btn-success" id="storeButton">Purchase Store</button>
                    </div>
                  </form>
                </div>
              </div>

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

      supplier_id: {
        required: true,
      },

      category_id: {
        required: true,
      },

      unit_id: {
        required: true,
      }, 
    },

    messages: {

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

<script>
        $('.datepicker').datepicker({
            uiLibrary: 'bootstrap4', 
            format: 'yyyy-mm-dd'
        });
</script>

<!-- get category using supplier_id -->
<script>
    $(function(){
        $(document).on('change', '#supplier_id', function(){
            var supplier_id = $(this).val();
            $.ajax({
              url: "{{route('get-category')}}",
              type: "GET",
              data: {supplier_id: supplier_id},
              success: function(data){
                var html = '<option value="">Select Category</option>';
                $.each(data, function(key, value){
                  html += '<option value="'+value.category_id+'">'+value.category.name+'</option>';
                });
                $('#category_id').html(html);
              }
            });
        });
    });
</script>

<!-- get product using category_id -->
<script>
    $(function(){
        $(document).on('change', '#category_id', function(){
            var category_id = $(this).val();
            $.ajax({
              url: "{{route('get-product')}}",
              type: "GET",
              data: {category_id: category_id},
              success: function(data){
                var html = '<option value="">Select Product</option>';
                $.each(data, function(key, value){
                  html += '<option value="'+value.id+'">'+value.name+'</option>';
                });
                $('#product_id').html(html);
              }
            });
        });
    });
</script>

<!-- Extra table HTML for Add More Option -->
<script id="document-template" type="text/x-handlebars-template">
    <tr class="delete_add_more_item" id="delete_add_more_item">
      <input type="hidden" name="date[]" value="@{{date}}">
      <input type="hidden" name="purchase_no[]" value="@{{purchase_no}}">
      <input type="hidden" name="supplier_id[]" value="@{{supplier_id}}">      
      <td>
        <input type="hidden" name="category_id[]" value="@{{category_id}}">@{{category_name}}
      </td>
      <td>
        <input type="hidden" name="product_id[]" value="@{{product_id}}">@{{product_name}}
      </td>
      <td>
        <input type="number" min="1" name="buy_qty[]" class="form-control form-control-sm text-right buy_qty" value="1">
      </td>
      <td>
        <input type="number" min="1" name="unit_price[]" class="form-control form-control-sm text-right unit_price" value="">
      </td>
      <td>
        <input type="text" name="description[]" class="form-control form-control-sm">
      </td>
      <td>
        <input type="number" name="total_price[]" class="form-control form-control-sm text-right total_price" value="0" readonly>
      </td>
      <td><i class="btn btn-danger btn-sm fa fa-window-close removeMoreEvent"></i></td>
    </tr>
</script>

<!-- functions for extra table html content  -->
<script>
  $(document).ready(function (){
    $(document).on('click', '.addMoreEvent', function (){
      var date = $('#date').val();
      var purchase_no = $('#purchase_no').val();
      var supplier_id = $('#supplier_id').val();     
      var category_id = $('#category_id').val();
      var category_name = $('#category_id').find('option:selected').text();      
      var product_id = $('#product_id').val();
      var product_name = $('#product_id').find('option:selected').text();

      if(date==''){
        $.notify("Date is required", {globalPosition: 'top center', className: 'error'});
        return false;
      }

      if(purchase_no==''){
        $.notify("Purchase Number is required", {globalPosition: 'top center', className: 'error'});
        return false;
      }

      if(supplier_id==''){
        $.notify("Supplier ID is required", {globalPosition: 'top center', className: 'error'});
        return false;
      }

      if(category_id==''){
        $.notify("Category ID is required", {globalPosition: 'top center', className: 'error'});
        return false;
      }

      if(product_id==''){
        $.notify("Product ID is required", {globalPosition: 'top center', className: 'error'});
        return false;
      }

      var source = $("#document-template").html();
      var template = Handlebars.compile(source);
      var data = {
        date: date,
        purchase_no: purchase_no,
        supplier_id: supplier_id,
        category_id: category_id,
        category_name: category_name,
        product_id: product_id,
        product_name: product_name
      };
      var html = template(data);
      $("#addRow").append(html);
    });

    $(document).on('click', '.removeMoreEvent', function(){
      $(this).closest(".delete_add_more_item").remove();
      totalAmountPrice();
    });

    $(document).on('keyup click', '.unit_price, .buy_qty', function(){
      var unit_price = $(this).closest("tr").find("input.unit_price").val();      
      var qty = $(this).closest("tr").find("input.buy_qty").val();      
      var total = unit_price * qty;
      $(this).closest("tr").find("input.total_price").val(total); 
      totalAmountPrice();
    });

    function totalAmountPrice() {
      var sum = 0;
      $(".total_price").each(function(){
        var value = $(this).val();
        if(!isNaN(value) && value.length != 0){
          sum += parseFloat(value);
        }
      });
      $("#estimated_amount").val(sum);
    }

  });
</script>

  @endsection