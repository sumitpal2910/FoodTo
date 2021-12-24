@component('mail::message')
# Hi {{$restaurant->name}}

This is a reset password request.

@component('mail::button', ['url' => route('restaurant.password.reset', ['token'=>$token,'email'=>$restaurant->email])])
Reset Password
@endcomponent

This is valid for next 30 Minutes

Thanks,<br>
{{ config('app.name') }}
@endcomponent
