@extends('backend.layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Paid Customers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Paid Customers</li>
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
                <h3>Paid Customer List
                <a class="btn btn-success float-right btn-sm"href="{{route('customers.paid.pdf')}}"><i class="fa fa-download"></i> Paid Customer Report</a>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Customer Name</th>
                            <th>Invoice No</th>
                            <th>Date</th>
                            <th>Total Amount</th>
                            <th>Paid Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalPaidAmount = 0;
                        @endphp
                        @foreach($allData as $key => $payment)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                {{ $payment['customer']['name'] }} ({{ $payment['customer']['mobile_no'] }} - {{ $payment['customer']['address'] }})
                            </td>
                            <td>#{{ $payment['invoice']['invoice_no'] }}</td>
                            <td>{{ date('d-m-Y', strtotime($payment['invoice']['date']))}}</td>
                            <td>{{ $payment->total_amount }} RM</td>
                            <td>{{ $payment->paid_amount }} RM</td>
                            <td>
                                <a title="Details" class="btn btn-success btn-sm" href="{{route('invoice.details.pdf', $payment->invoice_id)}}"><i class="fa fa-eye"></i></a>
                            </td>
                            @php
                                $totalPaidAmount += $payment->paid_amount;
                            @endphp
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <table class="table table-bordered table-hover">
                    <tbody>
                        <tr>
                            <td colspan="4" style="text-align: right;"><b>Total Paid Amount </b></td>
                            <td><b>{{ $totalPaidAmount }} RM</b></td>
                        </tr>
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
