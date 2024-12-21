@extends('layouts.master')
@section('title', $title)

@section('content')
    <h1>
        Banner : {{ $banner }}
    </h1>
    <h2>
        Sale : {{ $sale }}
    </h2>
    <h2>
        Product : {{ $product }}
    </h2>
    <h2>
        Banner sale : {{ $bannerSale }}
    </h2>
    <h2>
        Blog : {{ $blog }}
    </h2>
@endsection
