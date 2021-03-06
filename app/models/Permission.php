<?php

use Zizaco\Entrust\EntrustPermission;
use Zantolov\Zamb\Model\BaseModelTrait;

class Permission extends EntrustPermission
{
    use BaseModelTrait;

    protected $fillable = array('name', 'display_name');

    /**
     * Ardent validation rules.
     *
     * @var array
     */
    public static $rules = array(
        'name' => 'required|between:4,128',
        'display_name' => 'required|between:4,128'
    );

    public $autoHydrateEntityFromInput = true;    // hydrates on new entries' validation
    public $forceEntityHydrationFromInput = true; // hydrates whenever validation is called

}
