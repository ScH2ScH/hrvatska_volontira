<?php

use Zantolov\Zamb\Model\BaseModel;

class City extends BaseModel
{
    protected $table = 'cities';

    public static $rules = array(
        'name' => 'required',
        'county_id' => 'numeric',
        'zip_code' => '',
    );

    protected $fillable = array('name','county_id','zip_code');


    public $autoHydrateEntityFromInput = true;    // hydrates on new entries' validation
    public $forceEntityHydrationFromInput = true; // hydrates whenever validation is called

    public function county()
    {
        return $this->belongsTo('County');
    }
}
