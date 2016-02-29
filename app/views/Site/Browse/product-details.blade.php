@extends('Layouts.site')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            @include('Site.Modules.product-images', array('images' => $product->getImages()))
        </div>
        <div class="col-md-8">
            <h1 class="product-details-title">{{{ $product->title }}}</h1>

            <div class="product-details-description">{{ $product->description }}</div>
            <div class="product-details-price"><i class="fa fa-tag"></i> {{{ \Helpers\ShopHelper::formatPrice($product->price) }}}</div>

            @include('Site.Modules.add-to-cart-button')
        </div>
    </div>

</div>


@endsection