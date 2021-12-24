@component('mail::message')
# Hi {{$rider->name}}

This is a reset password request.

@component('mail::button', ['url' => route('rider.password.reset', ['token'=>$token,'email'=>$rider->email])])
Reset Password
@endcomponent

This is valid for next 30 Minutes.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
