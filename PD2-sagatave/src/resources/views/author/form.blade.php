
@extends('layout')

@section('content')

@if ($errors->any())

    <div class="alert alert-danger" role="alert">Fix Errors!</div>
@endif

    <form method="post" action="/authors/put">
        @csrf

        <label for="author-name">Author name</label>

        <input 
        type="text" 
        id="author-name" 
        name="name"
        class="form-control @error('name') is-invalid @enderror">

        @error('name')
            <p>{{ $errors->first('name') }}</p>
        @enderror

        <button type="submit" class="btn btn-primary">Save</button>

    </form>

@endsection
