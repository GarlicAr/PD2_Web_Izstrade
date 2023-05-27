
@extends('layout')

@section('content')

<h1>{{$title}}</h1>
    <hr>


@if ($errors->any())

    <div class="alert alert-danger" role="alert">Fix Errors!</div>
@endif

    <form method="post" action="{{ $author->exists ? '/authors/patch/' . $author->id : '/authors/put' }}">
        @csrf

        <label for="author-name">Author name</label>

        <input 
        type="text" 
        id="author-name" 
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $author->name) }}">

        @error('name')
            <p class="invalid-feedback">{{ $errors->first('name') }}</p>
        @enderror

        <button type="submit" class="btn btn-primary">{{ $author->exists ? 'Atjaunot' : 'Pievienot'}}</button>

    </form>

@endsection
