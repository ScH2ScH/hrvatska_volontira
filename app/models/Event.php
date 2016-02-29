<?php
namespace Models;

use Carbon\Carbon;
use Zantolov\Zamb\Model\BaseModel;

class Event extends BaseModel
{
    const STRING_VALIDATION_REGEX = 'Regex:/^[a-zA-Z0-9_ čćžšđČĆŽŠĐ]+$/';
    const STRING_WITH_INTERPUCTION_VALIDATION_REGEX = 'Regex:/^[a-zA-Z0-9_ čćžšđČĆŽŠĐ\-:.,\n]+$/';

    protected $table = 'events';
    public static $rules = array(
        'name' => 'required|max:255',
        'description' => 'required',
        'estimated_volunteers_no' => 'required|numeric',
        'start' => 'date|required',
        'end' => 'date|required',
        'working_hours' => array(self::STRING_WITH_INTERPUCTION_VALIDATION_REGEX),
        'total_hours' => 'numeric',
        'address' => array('required', self::STRING_WITH_INTERPUCTION_VALIDATION_REGEX),
        'email' => 'required|email',
        'city_id' => 'required',
        'contact_person' => 'required',
        'phone' => 'required',
        'additional_note' => '',
        'action_id' => 'required',
        'host_id' => 'required|exists:hosts,id',
        'final_estimated_volunteers_no' => 'numeric',
        'final_total_hours' => 'numeric',
        'final_report' => '',
    );

    protected $fillable = array(
        'name',
        'description',
        'estimated_volunteers_no',
        'start',
        'end',
        'working_hours',
        'total_hours',
        'address',
        'email',
        'city_id',
        'contact_person',
        'phone',
        'additional_note',
        'action_id',
        'host_id',
        'final_estimated_volunteers_no',
        'final_total_hours',
        'final_report',
    );

    public $autoHydrateEntityFromInput = true; // hydrates on new entries' validation
    public $forceEntityHydrationFromInput = true; // hydrates whenever validation is called

    public $relatedIds = array(
        'tags' => array(),
    );


    /* RELATED MODELS START */
    /**********************/
    public function tagsLoadIds()
    {
        $this->relatedIds['tags'] = $this->tags()->lists('tag_id');
    }

    public function tagsSave($tags)
    {
        $this->tags()->sync($tags);
    }

    /**********************/
    /* RELATED MODELS END */

    public function detachImages($images)
    {
        $images = json_decode($images, true);
        if (count($images)) {
            $this->images()->detach($images);
        }
    }

    public function tags()
    {
        return $this->morphToMany('Tag', 'taggable');
    }

    public function images()
    {
        return $this->morphToMany('Image', 'imageable');
    }

    public function firstImage()
    {
        return $this->morphToMany('Image', 'imageable')->first();

    }

    public function validate(array $rules = array(), array $customMessages = array())
    {
        $ret = parent::validate($rules, $customMessages);

        $start = new \DateTime($this->start);
        $end = new \DateTime($this->end);

        if (!empty($this->start) && !empty($this->end) && ($start > $end)) {
            $this->errors()->add('start', 'Početni datum je poslije završnog datuma');
            $this->errors()->add('end', 'Početni datum je poslije završnog datuma');
            return false;
        }
        return $ret;
    }

    /**
     * @param $value
     * @return string
     */
    public function getStartAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y. H:i');
    }

    /**
     * @param $value
     */
    public function setStartAttribute($value)
    {
        $this->attributes['start'] = Carbon::parse($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getEndAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y. H:i');
    }

    /**
     * @param $value
     */
    public function setEndAttribute($value)
    {
        $this->attributes['end'] = Carbon::parse($value);
    }

    public function getCity()
    {
        return \City::find($this->city_id);
    }

    public function getCounty()
    {
        $city = \City::find($this->city_id);
        return \County::find($city->county_id);
    }

    public function getRegion()
    {
        $city = \City::find($this->city_id);
        $county = \County::find($city->county_id);
        return \Region::find($county->region_id);
    }

    public function getHost()
    {
        return \Host::find($this->host_id);
    }

    public function getAction()
    {
        return \Action::find($this->action_id);
    }
}
