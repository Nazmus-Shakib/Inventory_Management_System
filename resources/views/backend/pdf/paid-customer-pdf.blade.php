<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paid Customer PDF</title>
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
                        <td width="40%"></td>
                        <td><h3><strong><u>Paid Customers List</u></strong></h3></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <br>

        <div class="row">
            <div class="col-md-12">
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Customer Name</th>
                            <th>Invoice No</th>
                            <th>Date</th>
                            <th>Total Amount</th>
                            <th>Paid Amount</th>
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
                            @php
                                $totalPaidAmount += $payment->paid_amount;
                            @endphp
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="5" style="text-align: right;"><b>Total Paid Amount </b></td>
                            <td>{{ $totalPaidAmount }} RM</td>
                        </tr>
                    </tbody>
                </table>
                @php
                    $date = new DateTime('now', new DateTimeZone('Asia/Kuala_Lumpur'));
                @endphp
                <i>Printing Time : {{$date->format('F j, Y, g:i a')}}</i>
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
                                <p style="text-align: center;">Owner Signature</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
