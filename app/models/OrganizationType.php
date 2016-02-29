<?php

use Zantolov\Zamb\Model\BaseModel;

class OrganizationType extends BaseModel
{
    protected $table = 'organization_types';
    public static $rules = array(
        'name' => 'required'
    );

    protected $fillable = array('name');

    public $autoHydrateEntityFromInput = true; // hydrates on new entries' validation
    public $forceEntityHydrationFromInput = true; // hydrates whenever validation is called
}
