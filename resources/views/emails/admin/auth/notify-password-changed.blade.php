@component('mail::message')
# Hi {{$admin->name}}

Your Account password has been changed


Thanks,<br>
{{ config('app.name') }}
@endcomponent
