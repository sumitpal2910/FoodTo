@component('mail::message')
# Hi {{$restaurant->owner_name}}

Your Restaurant **{{$restaurant->name}}** has been listed successfully

Login to access your dashboard
@component('mail::button', ['url' => route('restaurant.loginForm')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
