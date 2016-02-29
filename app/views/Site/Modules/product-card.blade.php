<div class="col-md-3 column productbox text-center">
    <a href="{{ URL::route('Product.Details', array($product->id, \Helpers\UrlHelper::getProductAlias($product))) }}">
        <img class="img-responsive img-thumbnail"
             src="{{ \Helpers\ImageHelper::getImageUrl($product->getLeadingImage(), 'product-card') }}"/>
    </a>

    <div class="producttitle">{{{ $product->title }}}</div>
    <div class="productprice">
        <div class="pull-right"><a href="#" class="btn btn-danger btn-sm" role="button"><i
                    class="fa fa-shopping-cart"></i> BUY</a></div>
        <div class="pricetext"><i class="fa fa-tag"></i> {{{ \Helpers\ShopHelper::formatPrice($product->price) }}}</div>
    </div>
</div>
