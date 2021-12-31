restaurant
<br>
{{Auth::guard('restaurant')->user()}}
<br>
@auth('restaurant')
<h1>Hello {{Auth::guard('restaurant')->user()->name}}</h1>
@endauth

<form action="{{route('restaurant.logout')}}" method="post">
    @csrf
    <button type="submit">Logout</button>
</form>
