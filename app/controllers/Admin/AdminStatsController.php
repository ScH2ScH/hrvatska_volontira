<?php

class AdminStatsController extends \BaseAdminController
{

    public function beforeConstruct()
    {
        $this->checkForRoles(array('admin', 'backend'));
    }


    /**
     * Number of Hosts in every city,county and region
     * @return \Illuminate\View\View
     */
    public function getStatsHosts()
    {
        return $this->render('Admin.Stats.Hosts');
    }

    /**
     * Number of volunteers by city,county and region
     * @return \Illuminate\View\View
     */
    public function getStatsVolunteers()
    {
        return $this->render('Admin.Stats.Volunteers');
    }

    /**
     * Number of volunteering "working hours" by city,county and region
     * @return \Illuminate\View\View
     */
    public function getStatsWorkingHours()
    {
        return $this->render('Admin.Stats.WorkingHours');
    }

    /**
     * Search volunteering activity by dates
     * @return \Illuminate\View\View
     */
    public function  getStatsDates()
    {
        return $this->render('Admin.Stats.Dates');

    }

    /**
     * Stats by area of volunteering activity
     * @return \Illuminate\View\View
     */
    public function getStatsArea()
    {
        return $this->render('Admin.Stats.Area');

    }

    /**
     * Stats by organization type
     * @return \Illuminate\View\View
     */
    public function  getStatsOrganizationTypes()
    {
        return $this->render('Admin.Stats.OrganizationTypes');
    }


}
