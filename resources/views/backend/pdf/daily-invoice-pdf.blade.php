<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Invoice Report</title>
    <link rel="stylesheet" href="{{ asset('public/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table width="100%">
                    <tr>
                        <td width="25%"></td>
                        <td width="50%"><span style="font-size:20px; background: #ddd;">Jisan Crokarise & Gift Corner</span><br><br> Gournadi Bandar, Gournadi, Barishal-8230
                        </td>
                        <td width="25%">Mobile: 01718033867</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <hr style="margin-bottom: 0px">
                <br>
                <br>
                <table width="100%">
                    <tr>
                        <td width="20%"></td>
                        <td><h3><u>Daily Invoice Report</u> ({{date('d-m-Y', strtotime($start_date))}} : {{date('d-m-Y', strtotime($end_date))}})</h3></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-md-12">
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Customer Name</th>
                            <th>Invoice No</th>
                            <th style="width: 10%">Date</th>
                            <th>Description</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $total_sum = 0;
                    @endphp
                    @foreach($allData as $key => $invoice)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                {{ $invoice['payment']['customer']['name'] }}
                                ({{ $invoice['payment']['customer']['mobile_no'] }} - {{ $invoice['payment']['customer']['address'] }})
                            </td>
                            <td>#{{ $invoice->invoice_no }}</td>
                            <td style="width: 15%">{{ date('d-m-Y', strtotime($invoice->date)) }}</td>
                            <td>{{ $invoice->description }}</td>
                            <td>{{ $invoice['payment']['total_amount'] }}</td>
                        </tr>
                    @php
                        $total_sum += $invoice['payment']['total_amount'];
                    @endphp
                    @endforeach
                        <tr>
                            <td colspan="5" style="text-align: right;">Grand Total</td>
                            <td>{{$total_sum}}</td>
                        </tr>
                    </tbody>
              </table>
            </div>
        </div>
        <br>
        <br>

        <div class="row">
            <div class="col-md-12">
                <hr style="margin-bottom: 0px">
                <table border="0" width="100%">
                    <tbody>
                        <tr>
                            <td style="width: 40%"></td>
                            <td style="width: 20%"></td>
                            <td style="width: 40%; text-align: center;">
                                <p style="text-align: center; border-bottom: 1px solid black">Owner Signature</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
