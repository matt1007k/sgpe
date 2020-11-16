@component('mail::message')
# Activación de cuenta

Hola Administrador, me presento ante usted para solicitar la activación de mi cuenta de usuario. Para ingresar a ver mis boletas de pagos.

Espero su disposición, cualquier aviso se me comunique a mi correo o num. de teléfono ingresado.

**DNI**<br>
{{ $user->dni }}

**Correo electrónico**<br>
{{ $user->email }}

**Teléfono o celular**<br>
{{ $user->phone }}

@component('mail::button', ['url' => route('users.edit', $user)])
Verificar usuario
@endcomponent

Gracias por su atención,<br>
{{ $user->name }}
@endcomponent
