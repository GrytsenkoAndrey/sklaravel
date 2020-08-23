@if($errors->count())
    <div class="alert alert-danger mt-4">
        <ul>
            {{-- объект Ошибки пробрасывается в любую страницу --}}
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif