@extends('backend.layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
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
                <h3>Products List
                <a class="btn btn-primary float-right btn-sm"href="{{route('stocks.report.pdf')}}"><i class="fa fa-download"></i> Products Report</a>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Supplier Name</th>
                            <th>Category</th>
                            <th>Product Name</th>
                            <th>Bought Qty</th>
                            <th>Sold Qty</th>
                            <th>Current Stock</th>
                            <th>Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allData as $key => $product)
                        @php
                            $bought_qty = App\Model\Purchase::where('category_id', $product->category_id)->where('product_id', $product->id)->where('status', '1')->sum('buy_qty');

                            $sold_qty = App\Model\InvoiceDetail::where('category_id', $product->category_id)->where('product_id', $product->id)->where('status', '1')->sum('selling_qty');
                        @endphp
                        <tr>
                            <td>{{ $key + 1 }}.</td>
                            <td>{{ $product['supplier']['name'] }}</td>
                            <td>{{ $product['category']['name'] }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $bought_qty }}</td>
                            <td>{{ $sold_qty }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product['unit']['name'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
        </div>
  <!-- /.content-wrapper -->

  @endsection
