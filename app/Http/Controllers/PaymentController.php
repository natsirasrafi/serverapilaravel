<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(){
        return Payment::all();
    }

    public function show($id){

        return Payment::find($id);
    }

    public function getjoin(){
        $join = DB::table('payments')
            ->join('users', 'users.id' , '=', 'payments.id_user')
            ->join('orders', 'orders.id','=','payments.id_order')
            ->select('payments.id', 'payments.value', 'payments.time', 'users.name', 'orders.price')->get();
        return $join;
    }

    public function store(Request $request, Payment $payment){
//        Payment::create($request->all());
        $this->validate($request,[
            'value' => 'required',
            'time'  =>  'required',
            'id_user' => 'required',
            'id_order'  => 'required'
        ]);

        $payment = $payment->create([
            'value'     => $request->value,
            'time'     => $request->time,
            'id_user'     => $request->id_user,
            'id_order'     => $request->id_order,

        ]);

        if ($payment){
            return response()->json(['status' => 'success', 'message' => 'data has been created'], 201);
        }else{
            return response()->json(['status' => 'error', 'message' => 'error cannot create data'], 500);
        }


    }



    public function update(Request $request, $id){
        $payment = Payment::findOrFail($id);
        $payment->update($request->all());
        return $payment;
    }

    public function delete(Request $request, $id){
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response()->json(['status' => 'success', 'message'=> 'data has been deleted'],201);
    }
}
