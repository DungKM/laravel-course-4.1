@extends('layouts.master')
@section('title', $title)
@section('css')
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
@endsection
@section('content')
    <h2>Danh sách người dùng</h2>
    <a href="{{ route('users.create') }}">Create User</a>
    <table>
        <tr>
            <th>STT</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>

        <body>
            @foreach ($users as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        <form action="{{ route('users.destroy', $item->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit">Delete</button>
                        </form>
                        <a href="{{ route('users.edit', $item->id) }}">Edit</a>
                    </td>

                </tr>
            @endforeach
        </body>
    </table>
@endsection
