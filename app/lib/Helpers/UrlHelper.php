<?php
namespace Helpers;

abstract class UrlHelper
{
    public static function getProductAlias($product)
    {
        $from = 'čćžšđ';
        $to = 'cczsd';
        $title = str_replace(str_split($from), str_split($to), $product->title);
        $title = str_replace('_', '-', snake_case($title));
        $title = str_replace(' ', '', $title);
        return $title;
    }

} 