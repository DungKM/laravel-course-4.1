@extends('layouts.master')
@section('title', $title)
@section('css')

@endsection
@section('content')
    <div class="container">
        <h1>Thông tin người dùng</h1>
        <div class="row">
            <div class="col-6">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Description:</strong></p>
                <div>
                    {!! $user->description !!}
                </div>
            </div>
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
    </div>
@endsection
@section('script')

@endsection
