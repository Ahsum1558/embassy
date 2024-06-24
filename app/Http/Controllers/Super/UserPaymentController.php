<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Super;
use App\Models\User;
use App\Models\UserPayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use App\Models\Country;
use App\Models\Division;
use App\Models\District;
use App\Models\Policestation;
use App\Models\City;
use App\Models\Issue;
use Illuminate\Support\Facades\DB;

class UserPaymentController extends Controller
{
    public function extension($id)
    {
        $users_payment = User::find($id);
        $extension_data = UserPayment::latest()-> get();
        
        if($users_payment !== null){
            return view('super.operator.userPayment.extension', [
            'users_payment'=>$users_payment,
            'extension_data'=>$extension_data,
        ]);
        }else{
            return redirect('/super/operator');
        }
    }

    public function storeExtension(Request $request, $id)
    {
        $users_payment = User::findOrFail($id);
        $user_id = $users_payment->id;

        $existingRecord = UserPayment::where([
            'payment_data'=>$request->payment_data,
            'trans_date'=>$request->trans_date,
            'trans_system'=>$request->trans_system,
            'userId'=>$user_id,
        ])->first();
        if (!$existingRecord){
        $this->validation($request);

        $users_payment->type         = $request->type;
        $users_payment->payment_data = $request->payment_data;
        $users_payment->trans_system = $request->trans_system;
        $users_payment->trans_amount = $request->trans_amount;
        $users_payment->trans_date   = $request->trans_date;
        $users_payment->userExpiry   = $request->userExpiry;
        $users_payment->role         = $request->role;
        $users_payment->status       = $request->status;
        $users_payment->update();

        if($users_payment){
            $extension_data = new UserPayment();
            $extension_data->userId       = $user_id;
            $extension_data->trans_date   = $users_payment->trans_date;
            $extension_data->userExpiry   = $users_payment->userExpiry;
            $extension_data->payment_data = $users_payment->payment_data;
            $extension_data->trans_system = $users_payment->trans_system;
            $extension_data->trans_amount = $users_payment->trans_amount;
            $extension_data->type         = $users_payment->type;
            $extension_data->status       = 1;
            $extension_data->save();

            return redirect() -> back() -> with('message', 'User Payment for extension is added successfully');
        }

        }else{
            return redirect() -> back() -> with('error_message', 'User Payment is already exist in the table !');
        }
    }

    public function editExtension($id)
    {
        $extension_info = UserPayment::find($id);
        $payment_info = User::find($extension_info->userId);
        
        if ($extension_info !== null) {
            return view('super.operator.userPayment.editExtension', [
            'payment_info'=>$payment_info,
            'extension_info'=>$extension_info,
            ]);
        }else{
            return redirect('/super/operator');
        }
    }

    public function updateExtension(Request $request, $id)
    {
        $extension_info = UserPayment::findOrFail($id);
        $payment_info = User::find($extension_info->userId);
        $user_id = $payment_info->id;

        $this->validationInfo($request);

        $extension_info->userExpiry   = $request->userExpiry;
        $extension_info->trans_amount = $request->trans_amount;
        $extension_info->type         = $request->type;
        $extension_info->status       = $request->status;
        $extension_info->update();

        return redirect() -> back() -> with('message', 'User Payment Info is Updated successfully');
    }

    public function editExpansion($id)
    {
        $expansion_data = UserPayment::find($id);
        $expansion_info = User::find($expansion_data->userId);
                
        if ($expansion_data !== null) {
            return view('super.operator.userPayment.editExpansion', [
            'expansion_info'=>$expansion_info,
            'expansion_data'=>$expansion_data,
            ]);
        }else{
            return redirect('/super/operator');
        }
    }

    public function updateExpansion(Request $request, $id)
    {
        $expansion_data = UserPayment::findOrFail($id);
        $expansion_info = User::find($expansion_data->userId);
        $user_id = $expansion_info->id;

        $existingRecord = UserPayment::where([
            'payment_data'=>$request->payment_data,
            'trans_date'=>$request->trans_date,
            'trans_system'=>$request->trans_system,
            'userId'=>$user_id,
        ])->first();
        if (!$existingRecord){
            $this->validationData($request);
            $expansion_data->trans_date   = $request->trans_date;
            $expansion_data->payment_data = $request->payment_data;
            $expansion_data->trans_system = $request->trans_system;
            $expansion_data->update();

            return redirect() -> back() -> with('message', 'User Payment data is Updated successfully');
        }else{
            return redirect() -> back() -> with('error_message', 'User Payment is already exist in the table !');
        }
    }

    public function remove($id)
    {
        $payments_data = UserPayment::find($id);
        $payments_data -> delete();
        return redirect() -> back() -> with('message', 'The User Payment data is removed successfully');
    }

    protected function validation($request){
        $this -> validate($request, [
            'type'         => 'required|in:approve,pending,disable',
            'trans_date'   => 'required|date',
            'userExpiry'   => 'required|date',
            'payment_data' => 'required',
            'role'         => 'required|in:admin,author,editor,contributor,user',
            'trans_system' => 'required|in:cash,bank,nagad,bkash,rocket',
            'trans_amount' => 'required',
            'status'       => 'required|in:active,inactive',
        ],
        [
            'type.required'       => 'Type Field is required',
            'type.in'             => 'Invalid Type option selected',
            'trans_date.required' => 'Transaction Date Field must not be Empty',
            'userExpiry.required' => 'User Expiry Date Field must not be Empty',
            'payment_data.required' => 'Payment data Field must not be Empty',
            'role.in'           => 'Invalid User Role option selected',
            'trans_system.required' => 'Transaction Type Field is required',
            'trans_system.in'       => 'Invalid Transaction Type option selected',
            'trans_amount.required' => 'Amount data Field must not be Empty',
            'status.required'   => 'Status Field is required',
            'status.in'         => 'Invalid status option selected',
        ]);
    }

    protected function validationInfo($request){
        $this -> validate($request, [
            'type'         => 'required|in:approve,pending,disable',
            'userExpiry'   => 'required|date',
            'trans_amount' => 'required',
            'status'       => 'required|in:1,0',
        ],
        [
            'type.required'       => 'Type Field is required',
            'type.in'             => 'Invalid Type option selected',
            'userExpiry.required' => 'User Expiry Date Field must not be Empty',
            'trans_amount.required' => 'Amount data Field must not be Empty',
            'status.required'   => 'Status Field is required',
            'status.in'         => 'Invalid status option selected',
        ]);
    }

    protected function validationData($request){
        $this -> validate($request, [
            'trans_date'   => 'required|date',
            'payment_data' => 'required',
            'trans_system' => 'required|in:cash,bank,nagad,bkash,rocket',
        ],
        [
            'trans_date.required' => 'Transaction Date Field must not be Empty',
            'payment_data.required' => 'Payment data Field must not be Empty',
            'trans_system.required' => 'Transaction Type Field is required',
            'trans_system.in'       => 'Invalid Transaction Type option selected',
        ]);
    }
}