<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //Payment Account List
    public function list()
    {
        $paymentAccounts = Payment::when(request('searchKey'), function ($query) {
            $query->where('account_name', 'like', '%' . strtolower(request('searchKey') . '%'));
            $query->where('account_number', 'like', '%' . request('searchKey') . '%');
            $query->where('account_type', 'like', '%' . strtolower(request('searchKey') . '%'));
        })
            ->orderByDesc('created_at')->paginate(10);
        return view('admin.payment.list', compact('paymentAccounts'));
    }

    //Create Payment Account
    public function create(Request $request)
    {
        //dd($request->toArray());
        $this->paymentValidator($request);

        $accNum = $request->accNumber;
        $accName = $request->accName;
        $accType = $request->accType;
        //dd([$accNum, $accName, $accType]);
        $data = [
            'account_number' => $accNum,
            'account_name' => $accName,
            'account_type' => $accType,
        ];

        Payment::create($data);

        return back()->with('message', 'Payment Account successfully created.');
    }

    //Edit Payment Page
    public function edit(Request $request, $id)
    {
        $payment = Payment::find($id);
        return view('admin.payment.edit', compact('payment'));
    }

    //Edit and Update Payment Account
    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);
        //dd($request->toArray());
        $this->paymentValidator($request, $id);
        $data = [
            'account_number' => $request->accNumber,
            'account_name' => $request->accName,
            'account_type' => $request->accType,
        ];
        //dd($data);
        $hasChanged = false;
        foreach ($data as $key => $value) {
            if ($payment->$key != $value) {
                $hasChanged = true;
                break;
            }
        }

        if (!$hasChanged) {
            return to_route('payment#list')->with('message', 'No changes were made.');
        }

        $payment->update($data);
        return to_route('payment#list')->with('message', 'Payment Account successfully updated.');
    }

    //Delete Payment Account
    public function delete($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return to_route('payment#list')->with('message', 'Payment Account successfully deleted.');
    }

    // Helper function to validate payment account requests
    private function paymentValidator(Request $request, $id = null)
    {
        $request->validate(
            [
                'accNumber' => 'required|unique:payments,account_number,' . $id,
                'accName' => 'required',
                'accType' => 'required',
            ],
            [
                'accNumber.required' => 'Account Number is required',
                'accNumber.unique' => 'This Account Number is already exists',
                'accName.required' => 'Account Name is required',
                'accType.required' => 'Account Type is required',
            ]
        );
    }
}
