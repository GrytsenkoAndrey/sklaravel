@extends('layout.main')

@section('content')
    <div class="col-md-8 blog-main">
        <h1>Contacts</h1>

        <p>{{ $email }}</p>
        <p>{{ $phone }}</p>

    </div>
@endsection