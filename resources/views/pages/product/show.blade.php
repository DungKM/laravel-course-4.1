@extends('layouts.master')
@section('title', $title)
@section('css')
    <style>
        h1 {
            color: red;
        }
    </style>
@endsection
@section('content')
    <h1>Id sản phẩm: {{ $Idproduct }}</h1>
    <h2>Tên sản phẩm: {{ $nameProduct }}</h2>
    <h2>Giá: {{ $priceProduct }}</h2>
@endsection
@section('script')

@endsection
