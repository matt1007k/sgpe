@component('mail::message')
# {{ $message->subject }}

{{ $message->body }}

@component('mail::button', ['url' => route('login')])
Ingresar
@endcomponent

Gracias por usar nuestra aplicación,<br>
{{ config('app.name') }}
@endcomponent
