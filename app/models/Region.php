<?php

use Zantolov\Zamb\Model\BaseModel;

class Region extends BaseModel
{
    protected $table = 'regions';
    public static $rules = array(
        'name' => 'required',
    );

    protected $fillable = array('name');


    public $autoHydrateEntityFromInput = true;    // hydrates on new entries' validation
    public $forceEntityHydrationFromInput = true; // hydrates whenever validation is called

    public function counties()
    {
        return $this->hasMany('County');
    }
}
