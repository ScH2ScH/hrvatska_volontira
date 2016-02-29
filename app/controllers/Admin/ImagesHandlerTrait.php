<?php

trait ImagesHandlerTrait
{

    protected function processImageEntities($model)
    {
        $existingImages = $model->images()->lists('image_id');

        $newImages = $this->processUploadedImages();
        if (!empty($newImages)) {
            $model->images()->saveMany($newImages);
        }

        $imagesToDelete = Input::get('imagesToDelete');
        if (!empty($imagesToDelete)) {
            $model->detachImages($imagesToDelete);
        }

        $imagesToAttach = Input::get('imagesToAdd');
        $imagesToAttach = json_decode($imagesToAttach, true);
        $imagesToAttach = array_unique($imagesToAttach, true);
        $imagesToAttach = array_diff($imagesToAttach, $existingImages);
        if (!empty($imagesToAttach)) {
            $model->images()->attach($imagesToAttach);
        }
    }


    /**
     * Process uploaded files and save them to temp location
     *
     * @return array
     */
    public function processUploadedImages()
    {

        $uploadImages = Input::file('images');

        if (empty($uploadImages)) {
            return array();
        }

        $images = array();

        foreach ($uploadImages as $image) {

            if (empty($image)) {
                continue;
            }

            if ($image->isValid()) {
                $images[] = $this->imageRepository->createImageByUploadedFile($image);
            }
        }

        return $images;

    }

}