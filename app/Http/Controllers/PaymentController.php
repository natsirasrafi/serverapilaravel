<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request){
//        Payment::create($request->all());
        $validator = Validator::make($request->all(),[
            'value' => 'required',
            'time'  =>  'required',
            'id_user' => 'required',
            'id_order'  => 'required'
        ]);


        $result = array();

        if ($validator->fails()){
            $result['status'] = false;
            $result['error'] = 'Bad Parameter';
            return json_encode($result);
        }else{
            $payment = Payment::create([
                'value'     => $request->value,
                'time'     => $request->time,
                'id_user'     => $request->id_user,
                'id_order'     => $request->id_order,

            ]);

            $result['status'] = true;
            $result['result'] = $payment;
            return json_encode($result);
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
