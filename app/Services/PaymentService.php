<?php

namespace App\Services;

use App\Models\ReceivedPayment;
use App\Models\UserPayment;
use App\Notifications\NotifyUserPaymentNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentService
{
    protected $payments = array(), $years = array(), $count_new_payments = 0;

    public function __construct()
    {

    }

    public function getPayments()
    {

        $filterYear = request('year') ? request('year') : date('Y');

        $dni = Auth::user()->dni;
        $numberOfYearsToSee = 2;
        $yearToSeeMenor = (int) date('Y') - ($numberOfYearsToSee - 1);

        if ($filterYear < $yearToSeeMenor) {
            $filterYear = date('Y');
            request()->session()->flash('message', 'No tienes permitido ver ese año.');

        }

        $urlBase = config('app.url_api');
        $token = 'dfdsfsd';

        $yearsApi = Http::get($urlBase . "/years?dni={$dni}")->json();
        $this->years = collect($yearsApi['data'])->take($numberOfYearsToSee)->all();

        $paymentsApi = Http::withToken($token)->get($urlBase . "/payments?year={$filterYear}&dni={$dni}")->json();

        $this->getNewPayments($paymentsApi);
        $this->notifyUserLatestPayments();

        return [$this->payments, $this->years, $filterYear];
    }

    public function getNewPayments($paymentsApi)
    {
        foreach ($paymentsApi['data'] as $payment) {

            $payment_received = ReceivedPayment::where('payment_id', $payment['id'])->first();
            if ($payment_received) {
                array_push($this->payments, array_merge(
                    [
                        'status' => $payment_received->status,
                    ],
                    $payment
                ));
            } else {
                array_push($this->payments, array_merge(
                    [
                        'status' => 'unreceived',
                    ],
                    $payment
                ));

            }
        }
    }

    public function createReceived(int $id)
    {
        $payment = ReceivedPayment::where('payment_id', $id)->first();
        if (!$payment) {
            ReceivedPayment::create([
                'payment_id' => $id,
                'status' => 'received',
            ]);

            request()->session()->flash('message', 'Boleta marcada como recibida.');
        }
    }

    public function notifyUserLatestPayments(): void
    {
        if (date('Y') === $this->years[0]) {
            if ($this->verifyNewPayments()) {
                // notify user
                Auth::user()->notify(new NotifyUserPaymentNotification($this->count_new_payments));
            }
        }
    }

    public function verifyNewPayments(): bool
    {
        $payment = UserPayment::where('user_id', Auth::id())->first();
        $payments = count($this->payments) > 0 ? $this->payments : '';
        if (!$payment) {
            UserPayment::create([
                'count_latest_payments' => count($payments),
                'user_id' => Auth::id(),
            ]);
            $this->count_new_payments = count($payments);

        } else {
            $this->count_new_payments = count($payments) - $payment->count_latest_payments;
            if ($this->count_new_payments > 0) {
                $payment->update([
                    'count_latest_payments' => count($payments),
                ]);
            }
        }

        return $this->count_new_payments > 0;
    }
}
