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
                        <td><h3><u>Daily Purchase Report</u> ({{date('d-m-Y', strtotime($start_date))}} : {{date('d-m-Y', strtotime($end_date))}})</h3></td>
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
                    <th>Serial No.</th>
                    <th>Purchase No.</th>
                    <th>Date</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $grandTotal = 0;
                    @endphp
                  @foreach($allData as $key => $purchase)
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $purchase->purchase_no }}</td>
                    <td>{{ date('d-m-Y', strtotime($purchase->date)) }}</td>
                    <td>{{ $purchase['product']['name'] }}</td>
                    <td>
                      {{ $purchase->buy_qty }}
                      {{ $purchase['product']['unit']['name'] }}
                    </td>
                    <td>{{ $purchase->unit_price }}</td>
                    <td>{{ $purchase->total_price }}</td>
                    @php
                        $grandTotal += $purchase->total_price;
                    @endphp
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="6" style="text-align: right;"><strong>Grand Total </strong></td>
                    <td>{{$grandTotal}}</td>
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
