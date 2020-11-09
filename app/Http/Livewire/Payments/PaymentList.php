<?php

namespace App\Http\Livewire\Payments;

use Livewire\Component;
use App\Models\ReceivedPayment;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Redirect;

class PaymentList extends Component
{
    public $payments, $years, $filterYear;
    protected $paymentService;
    
    public function mount(){
        $this->paymentService = new PaymentService();
        $this->getPayments();
    }

    public function getPayments(){
        [$this->payments, $this->years, $this->filterYear] = $this->paymentService->getPayments();
    }

    public function markReceivedPayment(int $id, string $url){
        $this->paymentService = new PaymentService();
        $this->paymentService->createReceived($id);
        $this->getPayments();
        // request()->session()->flash('message', 'Boleta marcada como recibida.');
        
        return Redirect::away($url);
    }

    public function render()
    {
        return view('livewire.payments.payment-list');
    }
}
