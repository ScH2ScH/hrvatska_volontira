<?php $image = $images->shift(); ?>
<a class="fancybox leading-image" rel="gallery" href="{{ \Helpers\ImageHelper::getImageUrl($image) }}"
   title="{{ $image->title }}">
    <img class="img-responsive img-thumbnail" src="{{ \Helpers\ImageHelper::getImageUrl($image, 'leading-image') }}"
         alt=""/>
</a>


@foreach($images as $image)
<a class="fancybox" rel="gallery" href="{{ \Helpers\ImageHelper::getImageUrl($image) }}" title="{{ $image->title }}">
    <img class="img-responsive img-thumbnail" src="{{ \Helpers\ImageHelper::getImageUrl($image, 'thumbnail') }}"
         alt=""/>
</a>
@endforeach