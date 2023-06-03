@extends('layout')

@section('content')


    <h1>{{$title}}</h1>
    <hr>

@if (session('success'))
    <div class="alert alert-success" role="alert" id="success-message">
        {{ session('success') }}
    </div>
@endif


    @if (count($items) > 0)

        <table class="table table-striped table-hover table-sm">
            <thead class="thead-light">
                <tr>
                    <td>ID</td>
                    <td>Nosaukums</td>
                    <td>Autors</td>
                    <td>Gads</td>
                    <td>Cena</td>
                    <td>Vai ir publicets?</td>
                    <td>Bilde</td>
                    <td>Darbibas</td>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $book)
                <tr>
                    <td>{{ $book->id}}</td>
                    <td>{{ $book->name}}</td>
                    <td>{{ $book->author->name}}</td>
                    <td>{{ $book->year}}</td>
                    <td>&euro; {{ number_format($book->price,2, '.') }} </td>
                    <td>{!! $book->display ? '&#10004;&#65039;' : '&#10060;' !!}</td>
                    <td>{{$book->image}}</td>
                    <td>
                        <a href="/books/update/{{ $book->id }}" class="btn btn-outline-primary btn-sm" >Labot </a> 
                        / 
                        <form method="post" action="/books/delete/{{$book->id}}" class="deletion-form d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">Dzest</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    @else

        <p>Nav atrasts neviens ieraksts</p>

    @endif

    <a href="/books/create" class="btn btn-primary">Pievienot gramatu!</a>




@endsection
