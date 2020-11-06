@component('mail::message')
# Codigo de confirmacion

Use este codigo para la aplicacion.
<h1>{{$codigo}}</h1>

Gracias,<br>
{{ config('app.name') }}
@endcomponent
