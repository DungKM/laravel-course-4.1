@extends('layouts.master')
@section('title', $title)
@section('css')
    <style>
        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        input[type=email] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
        }
    </style>
@endsection
@section('content')
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="fname">Name:</label><br>
        <input type="text" name="name" value="{{ $user->name }}"><br>
        @error('name')
            <div style="color: red">
                {{ $message }}
            </div>
        @enderror
        <label for="lname">Email:</label><br>
        <input type="email" name="email" value="{{ $user->email }}"><br><br>
        @error('email')
            <div style="color: red">
                {{ $message }}
            </div>
        @enderror
        <input type="submit" value="Submit">
    </form>
@endsection
