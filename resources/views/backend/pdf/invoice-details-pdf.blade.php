<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Details PDF</title>
    <link rel="stylesheet" href="{{ asset('public/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table width="100%">
                    <tr>
                        <td width="25%"><strong>Invoice No: #{{$payment['invoice']['invoice_no']}}</strong></td>
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
                        <td width="30%"></td>
                        <td><h3><strong><u>Customer Invoice Details</u></strong></h3></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-md-12">
                <table width="100%">
                    <tbody>
                        <tr>
                            <td><h4><b>Customer's Info</b></h4></td>
                        </tr>
                        <tr>
                            <td width="30%"><strong>Name : </strong>{{$payment['customer']['name']}}</td>
                            <td width="30%"><strong>Mobile : </strong> {{$payment['customer']['mobile_no']}}
                            </td>
                            <td width="40%"><strong>Address : </strong> {{$payment['customer']['address']}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <br>

        <div class="row">
            <div class="col-md-12">
                <table border="1" width="100%" style="margin-bottom: 10px">
                    <thead>
                        <tr class="text-center">
                            <th>Serial No</th>
                            <th>Category</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $totalSum = 0;
                        $invoice_details = App\Model\InvoiceDetail::where('invoice_id', $payment->invoice_id)->get();
                    @endphp
                    @foreach ($invoice_details as $key => $details)
                        <tr class="text-center">
                            <td>{{ $key + 1 }}.</td>
                            <td>{{$details['category']['name']}}</td>
                            <td>{{$details['product']['name']}}</td>
                            <td>{{$details->selling_qty}}</td>
                            <td>{{$details->unit_price}}</td>
                            <td>{{$details->selling_price}}</td>
                        </tr>
                        @php
                            $totalSum += $details->selling_price;
                        @endphp
                        @endforeach
                        <tr>
                            <td class="text-right pr-4" colspan="5"><strong>Sub Total :</strong></td>
                            <td class="text-center"><strong>{{$totalSum}}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-right pr-4" colspan="5"><strong>Discount :</strong></td>
                            <td class="text-center"><strong>{{$payment->discount_amount}}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-right pr-4" colspan="5"><strong>Grand Total :</strong></td>
                            <td class="text-center"><strong>{{$payment->total_amount}}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-right pr-4" colspan="5"><strong>Paid Amount :</strong></td>
                            <td class="text-center"><strong>{{$payment->paid_amount}}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-right pr-4" colspan="5"><strong>Due Amount :</strong></td>
                            <input type="hidden" name="new_paid_amount" value="{{$payment->due_amount}}">
                            <td class="text-center"><strong>{{$payment->due_amount}}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align: center; font-weight: bold;">Paid Summary<td>
                        </tr>
                        <tr>
                            <td colspan="3"><strong>Date</strong></td>
                            <td colspan="3"><strong>Amount</strong></td>
                        </tr>
                        @php
                            $payment_details = App\Model\PaymentDetail::where('invoice_id', $payment->invoice_id)->get();
                        @endphp
                        @foreach ($payment_details as $detail)
                        <tr>
                            <td colspan="3">{{ date('d-m-Y', strtotime($detail->date)) }}</td>
                            <td colspan="3">{{$detail->current_paid_amount}}</td>
                        </tr>
                        @endforeach
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
                            <td style="width: 40%">
                                <p style="text-align: center; margin-left: 20px">Customer Signature</p>
                            </td>
                            <td style="width: 20%"></td>
                            <td style="width: 40%; text-align: center;">
                                <p style="text-align: center;">Seller Signature</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
