@extends('layout')

@section('content')


    @if (count($items) > 0)

        <table class="table table-striped table-hover table-sm">
            <thead class="thead-light">
                <tr>
                    <td>ID</td>
                    <td>Vards</td>
                    <td>Darbibas</td>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $author)
                <tr>
                    <td>{{ $author->id}}</td>
                    <td>{{ $author->name}}</td>
                    <td>Labot / Dzest</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    @else

        <p>Nav atrasts neviens ieraksts</p>

    @endif

    <a href="/authors/create" class="btn btn-primary">Add Author</a>

@endsection
