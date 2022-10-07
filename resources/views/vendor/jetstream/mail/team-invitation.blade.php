@component('mail::message')
{{ __('You have been invited to join the :team team!', ['team' => $invitation->team->name]) }}
{{ __('Has sido invitado a unirte a  :team team!', ['team' => $invitation->team->name]) }}

@if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::registration()))
{{ __('Si aún no tienes una cuenta, puedes crear una dando click al botón. Después de crear tu cuenta, puedes dar click al botón de invitación para aceptar la invitación de equipo.') }}

@component('mail::button', ['url' => route('register')])
{{ __('Crear cuenta') }}
@endcomponent

{{ __('Si ya tienes una cuenta, puedes aceptar la invitación dando click al botón.') }}

@else
{{ __('Puedes aceptar la invitación dando click al botón.') }}
@endif


@component('mail::button', ['url' => $acceptUrl])
{{ __('Aceptar invitación') }}
@endcomponent

{{ __('Si no esperabas recibir este correo, simplemente ignoralo.') }}
@endcomponent
