<?php
namespace Services;

class ProductManager
{

    public function getProductByTag($tag)
    {
        $tag = \Tag::findOrFail($tag);

        return $tag->products();

    }

}