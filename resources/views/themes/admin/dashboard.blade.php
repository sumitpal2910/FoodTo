Admin
<br>
{{Auth::guard('admin')->user()}}
<br>
@auth('admin')
hello
@endauth

<form action="{{route('admin.logout')}}" method="post">
    @csrf
    <button type="submit">Logout</button>
</form>
