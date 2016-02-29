<?php

use Zantolov\Zamb\Model\BaseModel;

class County extends BaseModel
{
    protected $table = 'counties';
    public static $rules = array(
        'name' => 'required',
        'region_id' => 'numeric',
    );

    protected $fillable = array('name','region_id');

    public $autoHydrateEntityFromInput = true;    // hydrates on new entries' validation
    public $forceEntityHydrationFromInput = true; // hydrates whenever validation is called

    public function cities()
    {
        return $this->hasMany('City');
    }


    public function region()
    {
        return $this->belongsTo('Region');
    }
}
