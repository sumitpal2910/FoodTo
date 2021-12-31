@component('mail::message')
# Hi {{$restaurant->name}}

Your Foodo account password has been changed on
{{$restaurant->updated_at->format('D, d M Y')}}

@component('mail::button', ['url' => route('restaurant.loginForm')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
