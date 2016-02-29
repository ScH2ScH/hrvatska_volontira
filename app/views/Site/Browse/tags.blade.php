@extends('Layouts.site')

@section('content')
    <div class="container">
        @foreach($products as $product)
            @include('Site.Modules.product-card', array("product" => $product))
        @endforeach
    </div>


@endsection