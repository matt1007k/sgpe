@extends('layouts.client')
@section('title', 'Mis boletas de pago')

@section('content')
<div class="container">
    <livewire:payments.payment-list />
</div>
@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', () => { 
            this.livewire.on('onUrl', url => {
                window.open(url, '_blank')
            })    
        })
</script>    
@endpush