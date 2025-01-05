@extends('layouts.master')
@section('title', $title)
@section('css')
@endsection
@section('content')
    <div class="container">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="name" class="form-label">Name:</label><br>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control"><br>
            @error('name')
                <div style="color: red">
                    {{ $message }}
                </div>
            @enderror
            <label for="email" class="form-label">Email:</label><br>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control"><br><br>
            @error('email')
                <div style="color: red">
                    {{ $message }}
                </div>
            @enderror
            <input type="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>
@endsection
