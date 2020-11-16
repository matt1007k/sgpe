@extends('layouts.auth')

@section('content')
<div class="container h-100 w-100 flex justify-center align-center message">
    <div class="card form__register text-center" style="width: 500px">
        <div class="mb-2 flex justify-center align-center">
            <i class=" ic icon-big icon-success material-icons">check</i>
        </div>
        <h3 class="mb-1">Datos enviados con éxito</h3>
        <p class="text-light-blue">Estamos verificado tus datos, esto tomará unos minutos. Después se te enviará una notificación a tu correo electrónico, con los datos de tu cuenta. </p>
        
        <a href="{{ route('login') }}" class="mt-4 btn btn-primary">Regresar al  inicio</a>
    </div>
</div>
@endsection