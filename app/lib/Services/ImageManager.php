<?php
namespace Services;

use Helpers\ImageHelper;

class ImageManager
{

    protected static $variations = array(
        'thumbnail' => array("width" => 100, 'height' => 100),
        'product-card' => array("width" => 200, 'height' => 180),
        'leading-image' => array("width" => 360, 'height' => 244),
    );


    public function variationExists($variationName)
    {
        return in_array($variationName, array_keys(self::$variations));
    }

    public function create(\Image $image, $variationName)
    {

        if (!$this->variationExists($variationName)) {
            throw new \Exception('Variation ' . $variationName . ' doesn\'t exists');
        }

        $filePath = ImageHelper::getFullImageFilePath($image);
        $img = \InterventionImage::make($filePath);

        $img = $img->fit(
            ImageHelper::getVariationWidth(self::$variations[$variationName]),
            ImageHelper::getVariationHeight(self::$variations[$variationName])
        );

        $img->save(ImageHelper::getVariationFullFilepath($image, $variationName));
        return $img;
    }


    /**
     * Delete all existing variations for Image model
     * @param \Image $image
     */
    public function deleteFiles(\Image $image)
    {
        $variations = array_keys(self::$variations);
        $variations[] = 'original';

        foreach ($variations as $variation) {
            $file = ImageHelper::getVariationFullFilepath($image, $variation);
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }


}