@if (Session::has('status'))
<div class="text-{{Session::get('status') ?? 'success'}}">
    {{ Session::get('message') }}
</div>
@endif
