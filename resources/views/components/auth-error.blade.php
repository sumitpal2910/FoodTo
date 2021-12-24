@if ($errors->any())
<h6 class="text-danger">Someting went wrong!</h6>
<ul class="mt-3 list-disc list-inside text-sm text-danger">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@endif
