@component('mail::message')
# Hi {{$restaurant->name}}

Your account is created by Admin.

Your Login Details

>Email Id: {{$restaurant->email}}
>Password: {{$password}}

Please change password after login successfully

@component('mail::button', ['url' => route('restaurant.loginForm')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
