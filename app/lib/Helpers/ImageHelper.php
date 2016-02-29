<?php
namespace Helpers;

abstract class ImageHelper
{

    public static function getFullImageFilePath(\Image $image)
    {
        return self::getVariationFullFilepath($image, 'original');
    }

    public static function getVariationFullFilepath(\Image $image, $variation)
    {
        return \Config::get('zamb.images.path.root') . DIRECTORY_SEPARATOR . $variation . DIRECTORY_SEPARATOR . $image->filename;
    }

    public static function getVariationHeight($variation)
    {
        return $variation['height'];
    }

    public static function getVariationWidth($variation)
    {
        return $variation['width'];
    }

    public static function getImageUrl(\Image $image, $variation = 'original')
    {
        return \URL::route('image.output', array('variation' => $variation, 'id' => $image->id, 'filename' => $image->filename));
    }

    public static function getImageUrlById($id, $variation = 'original')
    {
        $image = \Image::findOrFail($id);
        return \URL::route('image.output', array('variation' => $variation, 'id' => $image->id, 'filename' => $image->filename));
    }

    public static function getPlaceholder()
    {
        $image = \Image::where(array("title" => "Placeholder"))->firstOrFail();
        return $image;
    }
} 