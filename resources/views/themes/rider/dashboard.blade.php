Admin
<br>
{{Auth::guard('rider')->user()}}
<br>
@auth('rider')
hello
@endauth

<form action="{{route('rider.logout')}}" method="post">
    @csrf
    <button type="submit">Logout</button>
</form>
