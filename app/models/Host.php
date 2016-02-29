<?php

use Zantolov\Zamb\Model\BaseModel;

/**
 * Class Host
 *
 * @property mixed $user_id
 * @property mixed $name
 * @property mixed $address
 * @property mixed $city_id
 * @property mixed $contact_person
 * @property mixed $phone
 * @property mixed $web
 * @property mixed $organization_type_id
 * @property mixed $additional_note
 */
class Host extends BaseModel
{
    protected $table = 'hosts';
    public static $rules = array(
        'name' => 'required|max:255',
        'address' => 'required|max:255',
        'contact_person' => 'required|max:255',
        'phone' => 'required|max:255',
        'web' => 'required|max:255',
        'organization_type_id' => 'required',
        'additional_note' => '',
    );

    protected $fillable = array(
        'name',
        'address',
        'contact_person',
        'phone',
        'web',
        'organization_type_id',
        'additional_note',
        'user_id',
    );

    public $autoHydrateEntityFromInput = true; // hydrates on new entries' validation
    public $forceEntityHydrationFromInput = true; // hydrates whenever validation is called


    public function user()
    {
        return $this->belongsTo('User');
    }

    public function events()
    {
        return $this->hasMany('Models\Event');
    }

    public function getUser()
    {
        return \User::find($this->user_id);
    }

    public function getType()
    {
        return \OrganizationType::find($this->organization_type_id);
    }
}

