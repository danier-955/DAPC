@component('mail::message')
# ¡Bienvenido a {{ config('app.name') }}!

## Hola, {{ $usuario['nombre'] }}

Estas son tus credenciales para acceder al sistema, por motivos de seguridad es importante que una vez hayas iniciado sesión cambies tu contraseña actual por una contraseña más segura.

@component('mail::panel')
**Correo electrónico:** {{ $usuario['correo'] }} <br>
**Contraseña:** {{ $usuario['documento'] }}
@endcomponent

@component('mail::button', ['url' => route('index')])
Empezar ahora
@endcomponent

Gracias, <br>
{{ config('app.name') }}
@endcomponent
