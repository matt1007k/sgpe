<?php

namespace App\Services;

use App\Models\ReceivedPayment;
use App\Models\UserPayment;
use App\Notifications\NotifyUserPaymentNotification;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentService {
    protected $payments = array(), $years = array(), $count_new_payments = 0;

    public function __construct(){

    }
    
    public function getPayments(){

        /* $filterYear = request('year') ? request('year') : date('Y'); */
        $filterYear = request('year') ? request('year') : '2020';
        // $dni = '28211740';
        $dni = Auth::user()->dni;

        $urlBase = config('app.url_api');
        // $urlBase = 'http://scp.sharedwithexpose.com/api/v1/';
        $token = 'dfdsfsd';

        $this->years = Http::get($urlBase . "/years?dni={$dni}")->json();
        $paymentsApi = Http::withToken($token)->get($urlBase . "/payments?year={$filterYear}&dni={$dni}")->json();

        $this->getNewPayments($paymentsApi);
        $this->notifyUserLatestPayments();

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

    public function notifyUserLatestPayments() : void{
        if(date('Y') === $this->years['data'][0]){
            if($this->verifyNewPayments()){
                // notify user
                Auth::user()->notify(new NotifyUserPaymentNotification($this->count_new_payments));
            }
        }
    }

    public function verifyNewPayments() : bool {
        $payment = UserPayment::where('user_id', Auth::id())->first();
        $payments = count($this->payments) > 0 ? $this->payments : '';
        if(!$payment){
            UserPayment::create([
                'count_latest_payments' => count($payments),
                'user_id' => Auth::id()
            ]);
            $this->count_new_payments = count($payments);

        }else{
            $this->count_new_payments = count($payments) - $payment->count_latest_payments;
            if($this->count_new_payments > 0){
                $payment->update([
                    'count_latest_payments' => count($payments)
                ]);
            }
        }

        return $this->count_new_payments > 0;
    }
}