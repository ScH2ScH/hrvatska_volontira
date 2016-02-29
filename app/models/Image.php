<?php

use Zantolov\Zamb\Model\BaseModel;

class Image extends BaseModel
{

    protected $table = 'images';
    public static $rules = array(
        'title' => 'required|max:255',
        'filename' => 'required|max:255',
        'caption' => 'max:255',
    );

    protected $fillable = array('title', 'caption');

    public $autoHydrateEntityFromInput = true; // hydrates on new entries' validation
    public $forceEntityHydrationFromInput = true; // hydrates whenever validation is called

    public function imageable()
    {
        return $this->morphTo();
    }

    public static function boot()
    {
        parent::boot();

        Image::deleting(function ($image) {
            $im = new \Services\ImageManager();
            $im->deleteFiles($image);
            DB::table('imageables')->where('image_id', '=', $image->id)->delete();
            DB::table('images')->where('id', '=', $image->id)->delete();
        });

    }

} 