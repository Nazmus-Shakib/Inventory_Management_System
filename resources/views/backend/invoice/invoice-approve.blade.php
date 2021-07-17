@extends('backend.layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Manage Invoice</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Invoice</li>
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
              <h3>Invoice No: #{{$invoice->invoice_no}} || Date: {{date('d-m-Y'), strtotime($invoice->date)}}
                <a class="btn btn-success float-right btn-sm" href="{{route('inovices.pending.list')}}"><i class="fa fa-list"></i> Pending Invoice List</a>
              </h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                @php
                    $payment = App\Model\Payment::where('invoice_id', $invoice->id)->first();
                @endphp
                <table width="100%">
                    <tbody>
                        <tr>
                            <td width="15%"><h5><strong>Customer Info</strong></h5></td>
                            <td width="25%"><p><strong>Name :</strong> {{$payment['customer']['name']}}</p></td>
                            <td width="25%"><p><strong>Mobile Number :</strong> {{$payment['customer']['mobile_no']}}</p></td>
                            <td width="35%"><p><strong>Address :</strong> {{$payment['customer']['address']}}</p></td>
                        </tr>
                        <tr>
                            <td width="15%"></td>
                            <td width="85%" colspan="3"><strong>Description :</strong> {{$invoice->description}}</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <form method="post" action="{{route('approval.store', $invoice->id)}}">
                    @csrf
                    <table border="1" width="100%" style="margin-bottom: 10px">
                        <thead>
                            <tr>
                                <th class="text-center">Serial No</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Product Name</th>
                                <th class="text-center" style="background: #ddd; padding: 1px;">Current Stock</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Unit Price</th>
                                <th class="text-center">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalSum = 0;
                            @endphp
                            @foreach ($invoice['invoice_details'] as $key => $details)
                                <tr class="text-center">
                                    <input type="hidden" name="category_id[]" value="{{$details->category_id}}">
                                    <input type="hidden" name="product_id[]" value="{{$details->product_id}}">
                                    <input type="hidden" name="selling_qty[{{$details->id}}]" value="{{$details->selling_qty}}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{$details['category']['name']}}</td>
                                    <td>{{$details['product']['name']}}</td>
                                    <td style="background: #ddd; padding: 1px;">{{$details['product']['quantity']}}</td>
                                    <td>{{$details->selling_qty}}</td>
                                    <td>{{$details->unit_price}}</td>
                                    <td>{{$details->selling_price}}</td>
                                </tr>
                                @php
                                    $totalSum += $details->selling_price;
                                @endphp
                            @endforeach
                            <tr>
                                <td class="text-right pr-4" colspan="6"><strong>Sub Total :</strong></td>
                                <td class="text-center"><strong>{{$totalSum}}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-right pr-4" colspan="6"><strong>Discount :</strong></td>
                                <td class="text-center"><strong>{{$payment->discount_amount}}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-right pr-4" colspan="6"><strong>Grand Total :</strong></td>
                                <td class="text-center"><strong>{{$payment->total_amount}}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-right pr-4" colspan="6"><strong>Paid Amount :</strong></td>
                                <td class="text-center"><strong>{{$payment->paid_amount}}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-right pr-4" colspan="6"><strong>Due Amount :</strong></td>
                                <td class="text-center"><strong>{{$payment->due_amount}}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success">Approve Invoice</button>
                </form>
            </div>
          </div><!-- /.card-body -->
      </div>
      <!-- /.card -->
  </section>
  <!-- /.Left col -->
</div>
<!-- /.content-wrapper -->

@endsection
