@extends('layouts.client')
@section('title', 'Mis boletas de pago')

@section('content')
<div class="container">
    <div class="content mt-5">
        <h1>Boletas de pago</h1>
        <h4 class="text-light-blue">Todos los pagos recibidos por cada mes.</h4>
        <div class="list__header mt-2">
            <div class="filter flex align-center">
                <div class="tooltip">
                    <i class="material-icons icon">filter_list</i>
                    <span>Filtrar por año</span>
                </div>
                <div class="list-year">
                    @forelse($years['data'] as $year)
                        @if($year === $filterYear)
                            <a class="badge badge-success">
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
        
            @forelse($payments['data'] as $payment)
            <div class="card item">
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
                        <a href="{{ $payment['link'] }}" target="_blank" class="action tooltip">
                            <i class="material-icons-two-tone">print</i>
                            <span>Imprimir</span>
                        </a>
                        {{-- <a href="{{ $payment['link'] }}" target="_blank" class="action tooltip">
                           <i class="material-icons-two-tone">save_alt</i> 
                            <span>Descargar</span>
                        </a> --}}
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
@endsection
@push('scripts')
<script>
    var a = document.querySelectorAll('.dropdown__container');
    // var dropdown = document.querySelector('.dropdown');
    a.forEach(element => {
        element.addEventListener('click', function(){
            console.log();
            
            element.children.item(1).classList.toggle('active')
        })
    });
</script>
@endpush