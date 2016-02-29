<?php
namespace Helpers;

abstract class ShopHelper
{
    public static function formatPrice($price)
    {
        $suffix = \Config::get('zamb.currency.suffix');
        $prefix = \Config::get('zamb.currency.prefix');
        $delimiter = \Config::get('zamb.currency.decimaldelimiter');
        return $prefix . str_replace('.', $delimiter, $price) . $suffix;
    }

} 