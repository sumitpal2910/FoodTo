@component('mail::message')
# Hi {{$admin->name}}

This is a reset password request.

@component('mail::button', ['url' => route('admin.password.reset',['token'=>$token,'email'=>$admin->email])])
Reset Password
@endcomponent

This is valid for next 30 Minutes

Thanks,<br>
{{ config('app.name') }}
@endcomponent
