
@extends('layout')

@section('content')

<h1>{{$title}}</h1>
    <hr>


    <h3>Pieejamas grāmatas </h1>

    <div class="row">
        @foreach($books as $book)
    <div class="col-md-4">
        <a href="/books/update/{{$book->id}}" class="text-decoration-none">
            <div class="card mb-3">
                <img
                    src="{{ asset('images/' . $book->image) }}"
                    class="img-fluid img-thumbnail d-block mb-2"
                    alt="{{ $book->name }}"
                >
                <div class="card-body">
                    <h5 class="card-title">{{ $book->name }}</h5>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

@endsection