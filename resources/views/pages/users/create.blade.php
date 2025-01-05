@extends('layouts.master')
@section('title', $title)
@section('css')
    <!-- include libraries(jQuery, bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="{{ asset('summernote-0.9.0-dist/summernote-lite.min.css') }}" rel="stylesheet">
    <script src="{{ asset('summernote-0.9.0-dist/summernote-lite.min.js') }}"></script>
    <style>
        .note-icon-caret:before {
            content: "" !important;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <h1>Create user</h1>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <label for="name" class="form-label">Name:</label><br>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control"><br>
            @error('name')
                <div style="color: red">
                    {{ $message }}
                </div>
            @enderror
            <label for="email" class="form-label">Email:</label><br>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control"><br><br>
            @error('email')
                <div style="color: red">
                    {{ $message }}
                </div>
            @enderror
            <label for="password" class="form-label">Password:</label><br>
            <input type="password" name="password" value="{{ old('password') }}" class="form-control"><br><br>
            @error('password')
                <div style="color: red">
                    {{ $message }}
                </div>
            @enderror
            <label for="description" class="form-label">Description:</label><br>
            <textarea name="description" class="form-control" id="summernote" cols="30" rows="10">{{ old('description') }}</textarea>
            @error('description')
                <div style="color: red">
                    {{ $message }}
                </div>
            @enderror
            <input type="submit" value="Submit" class="btn btn-primary mt-2">
        </form>
    </div>
@endsection
@section('script')
    <script>
        $('#summernote').summernote({
            placeholder: 'Hello Bootstrap 5',
            tabsize: 2,
            height: 100
        });
    </script>
@endsection
