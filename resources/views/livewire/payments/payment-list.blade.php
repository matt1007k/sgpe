<div>
    <div class="content mt-5">
        <div class="header-page">
            <div>
            <h2>Boletas de pago</h2>
            <h4 class="paragraph">Todos los pagos recibidos por cada mes.</h4>
            </div>
            <img class="image" src="{{asset('images/payment-processed.png')}}"/>
        </div>
        <div class="list__header mt-2">
            <div class="filter">
                <span>Filtrar por Año</span>
                <div class="list-year">
                    @forelse($years['data'] as $year)
                        @if($year === $filterYear)
                            <a class="badge badge-primary-2">
                                <i class="material-icons left">check</i>
                                {{ $year }}
                            </a>
                       @else
                            <a href="{{ route('client.payments', ['year' => $year]) }}"  class="badge badge-default">
                                {{ $year }}
                            </a>
                        @endif
                    @empty
                        <p class="text-light-blue">Sin años pagados.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="list__item">
        
            @forelse($payments as $payment)
            <div class="card item {{ $payment['status'] === 'received' ? 'received' : '' }}">
                <div class="row">
                    <h3>{{ $payment['periodo'] }}</h3>
                    <x-status.person :status="$payment['person']['status']" />
                </div>
                <div class="row">
                    <p class="headline">
                        S/. {{ $payment['total_haber'] }}
                    </p>
                    <p class="text-light-blue">Total haber</p>
                </div>
                <div class="row align-center">
                    <p class="headline">
                        S/. {{ $payment['total_descuento'] }}
                    </p>
                    <p class="text-light-blue">Total descuento</p>
                </div>
                <div class="row">
                    <p class="headline">
                        S/. {{ $payment['monto_liquido'] }}
                    </p>
                    <p class="text-light-blue">Monto líquido</p>
                </div>
                <div class="row">
                    <div class="actions">
                        <a wire:click="markReceivedPayment({{ $payment['id'] }},'{{ $payment['link'] }}')" class="action tooltip">
                            <i class="material-icons-two-tone">print</i>
                            <span>Imprimir</span>
                        </a>
                    </div>
                </div>
            </div>
            @empty
                <x-not-data>
                    No tienes ningún pago.
                </x-not-data>
            @endforelse

        </div>
    </div>
</div>

@push('scripts')
<script>


    Livewire.on('onUrl', postId => {
        alert('A post was added with the id of: ' + postId);
    })
    
</script>   
@endpush