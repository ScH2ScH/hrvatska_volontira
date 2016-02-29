<?php

use Zantolov\Zamb\Model\BaseModel;

class Action extends BaseModel
{
    protected $table = 'actions';
    public static $rules = array(
        'name'        => 'required',
        'description' => 'required',
        'start'       => 'date|required',
        'end'         => 'date|required',
    );

    protected $fillable = array(
        'name',
        'description',
        'start',
        'end',
    );

    public $autoHydrateEntityFromInput = true; // hydrates on new entries' validation
    public $forceEntityHydrationFromInput = true; // hydrates whenever validation is called

    public function events()
    {
        return $this->hasMany('Models\Event');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function images()
    {
        return $this->morphToMany('Image', 'imageable');
    }

    public function detachImages($images)
    {
        $images = json_decode($images, true);
        if (count($images)) {
            $this->images()->detach($images);
        }
    }

    /**
     * @return Image
     */
    public function firstImage()
    {
        return $this->morphToMany('Image', 'imageable')->first();

    }
}
