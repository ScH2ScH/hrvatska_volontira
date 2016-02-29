<?php


use LaravelBook\Ardent\Ardent;
use Zantolov\Zamb\Model\BaseModel;

/**
 * Class StaticPage
 *
 * @property int $id
 * @property string $title
 * @property string  $body
 * @property boolean $active
 */
class Homepage extends BaseModel
{

    public static $rules = array(
        'title' => 'required|between:3,255',
        'subtitle' => 'required|between:3,255',
        'general' => 'required|min:3',
        'specific' => 'required',
        'active' => 'required',
    );

    protected $table = 'homepage';
    protected $fillable = array('general', 'specific', 'title', 'subtitle', 'active',);

    public $autoHydrateEntityFromInput = true; // hydrates on new entries' validation
    public $forceEntityHydrationFromInput = true; // hydrates whenever validation is called



    /**********************/
    /* RELATED MODELS END */

    public function detachImages($images)
    {
        $images = json_decode($images, true);
        if (count($images)) {
            $this->images()->detach($images);
        }
    }

    public function images()
    {
        return $this->morphToMany('Image', 'imageable');
    }


}
