<?php

namespace App\Services;

use App\Models\ReceivedPayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentService {
    protected $payments = array(), $years = array();

    public function __construct(){

    }
    
    public function getPayments(){

        $filterYear = request('year') ? request('year') : date('Y');
        // $dni = '28211740';
        $dni = Auth::user()->dni;

        $urlBase = config('app.url_api');
        // $urlBase = 'http://scp.sharedwithexpose.com/api/v1/';
        $token = 'dfdsfsd';

        $this->years = Http::get($urlBase . "/years?dni={$dni}")->json();
        $paymentsApi = Http::withToken($token)->get($urlBase . "/payments?year={$filterYear}&dni={$dni}")->json();

        $this->getNewPayments($paymentsApi);

        return [$this->payments, $this->years, $filterYear];
    }

    public function getNewPayments($paymentsApi){
        foreach($paymentsApi['data'] as $payment){
            $payment_received = ReceivedPayment::where('payment_id', $payment['id'])->first();
            if($payment_received){
                array_push($this->payments, array_merge(
                    [
                        'status' => $payment_received->status,
                    ], 
                    $payment
                ));
            }else{
                array_push($this->payments, array_merge(
                    [
                        'status' => 'unreceived',
                    ], 
                    $payment
                ));

            }
        }
    }

    public function createReceived(int $id){
        $payment = ReceivedPayment::where('payment_id', $id)->first();
        if(!$payment){
            ReceivedPayment::create([
                'payment_id' => $id,
                'status' => 'received'
            ]);

            request()->session()->flash('message', 'Boleta marcada como recibida.');
        }
    }
}