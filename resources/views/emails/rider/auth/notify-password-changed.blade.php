@component('mail::message')
# Hi {{$rider->name}}

Your Foodo account password has been changed on
{{$rider->updated_at->format('D, d M Y')}}

@component('mail::button', ['url' => route('rider.loginForm')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
