@if(session()->has('message'))
    <div class="alert alert-{{ session('message_type') ?? 'danger'}} mt-4">
        {{ session('message') }}
    </div>
@endif
