@component('mail::message')
# Hii {{$user->name}}

Please verify your email id

@component('mail::button', ['url' => ''])
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
