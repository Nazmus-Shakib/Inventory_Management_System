<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Customer;
use App\Model\Payment;
use App\Model\PaymentDetail;
use Auth;
use PDF;

class CustomerController extends Controller
{
    public function view()
    {
        $allData = Customer::all();
        return view('backend.customer.view-customer', compact('allData'));
    }

    public function add()
    {
        return view('backend.customer.add-customer');
    }

    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->mobile_no = $request->mobile_no;
        $customer->address = $request->address;
        $customer->created_by = Auth::user()->id;
        $customer->save();
        return redirect()->route('customers.view')->with('success', 'Customer Added Successfully');
    }

    public function edit($id)
    {
        $editData = Customer::find($id);
        return view('backend.customer.edit-customer', compact('editData'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->mobile_no = $request->mobile_no;
        $customer->address = $request->address;
        $customer->updated_by = Auth::user()->id;
        $customer->save();
        return redirect()->route('customers.view')->with('success', 'Customer Updated Successfully');
    }

    public function delete($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->route('customers.view')->with('success', 'Customer Deleted Successfully');
    }

    public function creditCustomers()
    {
        $allData = Payment::whereIn('paid_status', ['full_due', 'partial_paid'])->get();
        return view('backend.customer.customer-credit', compact('allData'));
    }

    public function creditCustomersPDF()
    {
        $data['allData'] = Payment::whereIn('paid_status', ['full_due', 'partial_paid'])->get();
        $pdf = PDF::loadView('backend.pdf.credit-customer-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('dueCustomerReport.pdf');
    }

    public function editInvoice($invoice_id)
    {
        $payment = Payment::where('invoice_id', $invoice_id)->first();
        return view('backend.customer.edit-invoice', compact('payment'));
    }

    public function updateInvoice(Request $request, $invoice_id)
    {
        if ($request->new_paid_amount < $request->paid_amount) {
            return redirect()->back()->with('error', 'Sorry! You Have Selected More Amount than Due');
        } else {
            $payment = Payment::where('invoice_id', $invoice_id)->first();
            $paymentDetails = new PaymentDetail();
            $payment->paid_status = $request->paid_status;
            if ($request->paid_status == 'full_paid') {
                $payment->paid_amount = Payment::where('invoice_id', $invoice_id)->first()['paid_amount'] + $request->new_paid_amount;
                $payment->due_amount = '0';
                $paymentDetails->current_paid_amount = $request->new_paid_amount;
            } else if ($request->paid_status == 'partial_paid') {
                $payment->paid_amount = Payment::where('invoice_id', $invoice_id)->first()['paid_amount'] + $request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id', $invoice_id)->first()['due_amount'] - $request->paid_amount;
                $paymentDetails->current_paid_amount = $request->paid_amount;
            }
            $payment->save();
            $paymentDetails->invoice_id = $invoice_id;
            $paymentDetails->date = date('Y-m-d', strtotime($request->date));
            $paymentDetails->updated_by = Auth::user()->id;
            $paymentDetails->save();

            return redirect()->route('customers.credit')->with('success', 'Invoice Updated Successfully');
        }
    }
}
