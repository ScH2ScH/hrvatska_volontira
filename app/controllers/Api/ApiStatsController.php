<?php


class ApiStatsController extends \Controller
{

    /*
  |--------------------------------------------------------------------------
  | JQuery apis for total stats for current year
  |--------------------------------------------------------------------------
  */
    /**
     * API that returns total number of volunteers in current year
     * @return mixed
     */
    public function getTotalVolunteers()
    {
        $rules = array(
            'year' => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json((array('message' => 'Bad Request')), 400);
        }

        try {
            $year = (int)Input::get('year');
            $volunteersInYear = DB::table('events')
                ->where('events.start', '>', $year . "-01-01 18:00:00")
                ->where('events.start', '<', ($year + 1) . "-01-01 18:00:00")
                ->remember(1)
                ->sum('events.estimated_volunteers_no');

            return Response::json(['status' => 200, 'value' => $volunteersInYear]);

        } catch (Exception $e) {
            return Response::json(['status' => 400, 'response' => 'Bad request']);
        }
    }

    /**
     * API that returns number of total events in current year
     * @return mixed
     */
    public function getTotalEvents()
    {
        $rules = array(
            'year' => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json((array('message' => 'Bad Request')), 400);
        }

        try {
            $year = (int)Input::get('year');
            $eventsInYear = DB::table('events')
                ->select('events.name')
                ->where('events.start', '>', $year . "-01-01 18:00:00")
                ->where('events.start', '<', ($year + 1) . "-01-01 18:00:00")
                ->remember(1)
                ->count();

            return Response::json(['status' => 200, 'value' => $eventsInYear]);

        } catch (Exception $e) {
            return Response::json(['status' => 400, 'response' => 'Bad request']);
        }
    }

    /**
     * API that returns number of total hosts in current year
     * @return mixed
     */
    public function getTotalHosts()
    {
        $rules = array(
            'year' => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json((array('message' => 'Bad Request')), 400);
        }

        try {
            $year = (int)Input::get('year');
            $nextYear = $year + 1;

            /**
             * This is case where Laravel fails, count distinct is therefor implemented as raw query
             */
            $hostsInYear = DB::select(
                DB::raw("SELECT count(distinct hosts.id) as 'hosts' FROM hosts
                join events on hosts.id=events.host_id
                where events.start > '$year- 01 - 01 18:00:00'
                and events.start < '$nextYear-01-01 18:00:00'"));

            return Response::json(['status' => 200, 'hosts' => $hostsInYear[0]]);

        } catch (Exception $e) {
            return Response::json(['status' => 400, 'response' => 'Bad request']);
        }
    }

    /*
   |--------------------------------------------------------------------------
   | Basic JQuery apis for list of actions and active years
   |--------------------------------------------------------------------------
   */
    public function getActions()
    {
        try {
            $actions = Action::lists('name', 'id');
            return Response::json(['status' => 200, 'actions' => $actions]);

        } catch (Exception $e) {
            return Response::json(['status' => 400, 'response' => 'Bad request']);
        }
    }

    public function getYears()
    {
        try {

            //Todo Sql query to list all years in database instead of maually adding
            $years = array();
            $years["0"] = 2014;
            $years["1"] = 2015;
            $years["2"] = 2016;
            return Response::json(['status' => 200, 'years' => $years]);

        } catch (Exception $e) {
            return Response::json(['status' => 400, 'response' => 'Bad request']);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | HOSTs stats
    |--------------------------------------------------------------------------
    */
    /**
     * Number of Hosts in specific city
     *
     * @return \Illuminate\View\View
     */
    public function getStatsHostsCity()
    {
        $rules = array(
            'year' => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json((array('message' => 'Bad Request')), 400);
        }


        try {
            $year = (int)Input::get('year');
            $action = Input::get('action');
            $result = array();
            $cities = DB::table('cities')->get();
            foreach ($cities as $city) {

                if ($year == 'empty' or $action == 'empty') {
                    $hostsInCity = DB::table('hosts')
                        ->join('events', 'hosts.id', '=', 'events.host_id')
                        ->join('cities', 'cities.id', '=', 'events.city_id')
                        ->select('hosts.name')
                        ->where('cities.name', '=', $city->name)
                        ->where('events.start', '>', $year . "-01-01 18:00:00")
                        ->where('events.start', '<', ($year + 1) . "-01-01 18:00:00")
                        ->remember(1)
                        ->count();
                } else {
                    $hostsInCity = DB::table('hosts')
                        ->join('events', 'hosts.id', '=', 'events.host_id')
                        ->join('cities', 'cities.id', '=', 'events.city_id')
                        ->join('actions', 'actions.id', '=', 'events.action_id')
                        ->select('hosts.name')
                        ->where('cities.name', '=', $city->name)
                        ->where('events.start', '>', $year . "-01-01 00:00:00")
                        ->where('events.start', '<', ($year + 1) . "-01-01 00:00:00")
                        ->where('actions.name', '=', $action)
                        ->remember(1)
                        ->count();
                }
                if ($hostsInCity == 0) {
                    continue;
                }

                $color = $this->generateRandomColor();
                $highlight = "#d5d5d5";

                array_push($result, array(
                    'label' => $city->name,
                    'value' => $hostsInCity / 100,
                    'color' => $color,
                    'highlight' => $highlight
                ));
            }

            return Response::json(['status' => 200, 'cities' => $result]);

        } catch (Exception $e) {
            return Response::json(['status' => 400, 'response' => 'Bad request']);
        }
    }

    /**
     * Number of Hosts in specific county
     * @return \Illuminate\View\View
     */
    public function getStatsHostsCounty()
    {

        $rules = array(
            'year' => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json((array('message' => 'Bad Request')), 400);
        }


        try {
            $year = (int)Input::get('year');
            $action = Input::get('action');
            $result = array();
            $counties = DB::table('counties')->get();

            foreach ($counties as $county) {
                if ($year == 'empty' or $action == 'empty') {
                    $hostsInCounty = DB::table('hosts')
                        ->join('events', 'hosts.id', '=', 'events.host_id')
                        ->join('cities', 'cities.id', '=', 'events.city_id')
                        ->join('counties', 'counties.id', '=', 'cities.county_id')
                        ->select('hosts.name')
                        ->where('counties.name', '=', $county->name)
                        ->remember(1)
                        ->count();
                } else {
                    $hostsInCounty = DB::table('hosts')
                        ->join('events', 'hosts.id', '=', 'events.host_id')
                        ->join('cities', 'cities.id', '=', 'events.city_id')
                        ->join('counties', 'counties.id', '=', 'cities.county_id')
                        ->join('actions', 'actions.id', '=', 'events.action_id')
                        ->select('hosts.name')
                        ->where('counties.name', '=', $county->name)
                        ->where('events.start', '>', $year . "-01-01 00:00:00")
                        ->where('events.start', '<', ($year + 1) . "-01-01 00:00:00")
                        ->where('actions.name', '=', $action)
                        ->remember(1)
                        ->count();
                }

                if ($hostsInCounty == 0) {
                    continue;
                }

                $color = $this->generateRandomColor();
                $highlight = "#d5d5d5";

                array_push($result, array(
                    'label' => $county->name,
                    'value' => $hostsInCounty / 100,
                    'color' => $color,
                    'highlight' => $highlight
                ));
            }

            return Response::json(['status' => 200, 'cities' => $result]);
        } catch (Exception $e) {
            return Response::json(['status' => 400, 'response' => 'Bad request']);
        }
    }

    /**
     * Number of Hosts in every region
     * @return \Illuminate\View\View
     */
    public function getStatsHostsRegion()
    {

        $rules = array(
            'year' => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json((array('message' => 'Bad Request')), 400);
        }

        try {
            $year = (int)Input::get('year');
            $action = Input::get('action');
            $result = array();
            $regions = DB::table('regions')->get();

            foreach ($regions as $region) {

                if ($year == 'empty' or $action == 'empty') {
                    $hostsInRegion = DB::table('hosts')
                        ->join('events', 'hosts.id', '=', 'events.host_id')
                        ->join('cities', 'cities.id', '=', 'events.city_id')
                        ->join('counties', 'counties.id', '=', 'cities.county_id')
                        ->join('regions', 'regions.id', '=', 'counties.region_id')
                        ->select('hosts.name')
                        ->where('regions.id', '=', $region->id)
                        ->remember(1)
                        ->count();
                } else {
                    $hostsInRegion = DB::table('hosts')
                        ->join('events', 'hosts.id', '=', 'events.host_id')
                        ->join('cities', 'cities.id', '=', 'events.city_id')
                        ->join('counties', 'counties.id', '=', 'cities.county_id')
                        ->join('regions', 'regions.id', '=', 'counties.region_id')
                        ->join('actions', 'actions.id', '=', 'events.action_id')
                        ->select('hosts.name')
                        ->where('regions.id', '=', $region->id)
                        ->where('events.start', '>', $year . "-01-01 00:00:00")
                        ->where('events.start', '<', ($year + 1) . "-01-01 00:00:00")
                        ->where('actions.name', '=', $action)
                        ->remember(1)
                        ->count();
                }

                if ($hostsInRegion == 0) {
                    continue;
                }

                $color = $this->generateRandomColor();
                $highlight = "#d5d5d5";

                array_push($result, array(
                    'label' => $region->name,
                    'value' => $hostsInRegion,
                    'color' => $color,
                    'highlight' => $highlight
                ));
            }

            return Response::json(['status' => 200, 'regions' => $result]);

        } catch (Exception $e) {
            return Response::json(['status' => 400, 'response' => 'Bad requdest']);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | VOLUNTEERs stats
    |--------------------------------------------------------------------------
    */
    /**
     * Number of volunteers by city
     * @return \Illuminate\View\View
     */
    public function getStatsVolunteersCity()
    {
        $rules = array(
            'year' => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json((array('message' => 'Bad Request')), 400);
        }

        try {
            $year = (int)Input::get('year');
            $action = Input::get('action');
            $result = array();
            $cities = DB::table('cities')->get();

            foreach ($cities as $city) {

                if ($year == 'empty' or $action == 'empty' or $action == null) {
                    $volunteersInCity = DB::table('events')
                        ->join('cities', 'cities.id', '=', 'events.city_id')
                        ->where('cities.name', '=', $city->name)
                        ->remember(1)
                        ->sum('events.estimated_volunteers_no');
                } else {
                    $volunteersInCity = DB::table('events')
                        ->join('cities', 'cities.id', '=', 'events.city_id')
                        ->join('actions', 'actions.id', '=', 'events.action_id')
                        ->where('cities.name', '=', $city->name)
                        ->where('events.start', '>', $year . "-01-01 00:00:00")
                        ->where('events.start', '<', ($year + 1) . "-01-01 00:00:00")
                        ->where('actions.name', '=', $action)
                        ->sum('events.estimated_volunteers_no');
                }

                if ($volunteersInCity == 0) {
                    continue;
                }

                $color = $this->generateRandomColor();
                $highlight = "#d5d5d5";

                array_push($result, array(
                    'label' => $city->name,
                    'value' => $volunteersInCity / 100,
                    'color' => $color,
                    'highlight' => $highlight
                ));
            }

            return Response::json(['status' => 200, 'cities' => $result, 'test' => $volunteersInCity]);

        } catch (Exception $e) {
            return Response::json(['status' => 400, 'response' => 'Bad request']);
        }
    }

    /**
     * Number of volunteers by county
     * @return \Illuminate\View\View
     */
    public function getStatsVolunteersCounty()
    {
        $rules = array(
            'year' => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json((array('message' => 'Bad Request')), 400);
        }
        try {
            $year = (int)Input::get('year');
            $action = Input::get('action');
            $result = array();
            $counties = DB::table('counties')->get();

            foreach ($counties as $county) {
                if ($year == 'empty' or $action == 'empty' or $action == null) {
                    $volunteersInCounty = DB::table('events')
                        ->join('cities', 'cities.id', '=', 'events.city_id')
                        ->join('counties', 'counties.id', '=', 'cities.county_id')
                        ->where('counties.name', '=', $county->name)
                        ->remember(1)
                        ->sum('events.estimated_volunteers_no');
                } else {
                    $volunteersInCounty = DB::table('events')
                        ->join('cities', 'cities.id', '=', 'events.city_id')
                        ->join('counties', 'counties.id', '=', 'cities.county_id')
                        ->join('actions', 'actions.id', '=', 'events.action_id')
                        ->where('counties.name', '=', $county->name)
                        ->where('events.start', '>', $year . "-01-01 00:00:00")
                        ->where('events.start', '<', ($year + 1) . "-01-01 00:00:00")
                        ->where('actions.name', '=', $action)
                        ->remember(1)
                        ->sum('events.estimated_volunteers_no');
                }
                if ($volunteersInCounty == 0) {
                    continue;
                }

                $color = $this->generateRandomColor();
                $highlight = "#d5d5d5";


                array_push($result, array(
                    'label' => $county->name,
                    'value' => $volunteersInCounty / 100,
                    'color' => $color,
                    'highlight' => $highlight
                ));
            }

            return Response::json(['status' => 200, 'no_volunteers' => $result]);
        } catch (Exception $e) {
            return Response::json(['status' => 400, 'response' => 'Bad request']);
        }
    }

    /**
     * Number of volunteers by region
     * @return \Illuminate\View\View
     */
    public function getStatsVolunteersRegion()
    {
        $rules = array(
            'year' => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json((array('message' => 'Bad Request')), 400);
        }
        try {
            $year = (int)Input::get('year');
            $action = Input::get('action');
            $result = array();
            $regions = DB::table('regions')->get();

            foreach ($regions as $region) {
                if ($year == 'empty' or $action == 'empty' or $action == null) {
                    $volunteersInRegion = DB::table('events')
                        ->join('cities', 'cities.id', '=', 'events.city_id')
                        ->join('counties', 'counties.id', '=', 'cities.county_id')
                        ->join('regions', 'regions.id', '=', 'counties.region_id')
                        ->where('regions.id', '=', $region->id)
                        ->remember(1)
                        ->sum('events.estimated_volunteers_no');
                } else {
                    $volunteersInRegion = DB::table('events')
                        ->join('cities', 'cities.id', '=', 'events.city_id')
                        ->join('counties', 'counties.id', '=', 'cities.county_id')
                        ->join('regions', 'regions.id', '=', 'counties.region_id')
                        ->join('actions', 'actions.id', '=', 'events.action_id')
                        ->where('regions.id', '=', $region->id)
                        ->where('events.start', '>', $year . "-01-01 00:00:00")
                        ->where('events.start', '<', ($year + 1) . "-01-01 00:00:00")
                        ->where('actions.name', '=', $action)
                        ->remember(1)
                        ->sum('events.estimated_volunteers_no');
                }

                if ($volunteersInRegion == 0) {
                    continue;
                }

                $color = $this->generateRandomColor();
                $highlight = "#d5d5d5";

                array_push($result, array(
                    'label' => $region->name,
                    'value' => $volunteersInRegion / 100,
                    'color' => $color,
                    'highlight' => $highlight
                ));
            }

            return Response::json(['status' => 200, 'regions' => $result]);

        } catch (Exception $e) {
            return Response::json(['status' => 400, 'response' => 'Bad requdest']);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | WORKING HOURSs stats
    |--------------------------------------------------------------------------
    */

    /**
     * Number of volunteering "working hours" by city
     * @return \Illuminate\View\View
     */
    public function getStatsWorkingHoursCity()
    {
        $rules = array(
            'year' => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json((array('message' => 'Bad Request')), 400);
        }

        try {
            $year = (int)Input::get('year');
            $action = Input::get('action');
            $result = array();
            $cities = DB::table('cities')->get();

            foreach ($cities as $city) {
                if ($year == 'empty' or $action == 'empty' or $action == null) {

                    $hoursInCity = DB::table('events')
                        ->join('cities', 'cities.id', '=', 'events.city_id')
                        ->where('cities.id', '=', $city->id)
                        ->remember(1)
                        ->sum('events.total_hours');
                } else {
                    $hoursInCity = DB::table('events')
                        ->join('cities', 'cities.id', '=', 'events.city_id')
                        ->join('actions', 'actions.id', '=', 'events.action_id')
                        ->where('cities.id', '=', $city->id)
                        ->where('events.start', '>', $year . "-01-01 00:00:00")
                        ->where('events.start', '<', ($year + 1) . "-01-01 00:00:00")
                        ->where('actions.name', '=', $action)
                        ->remember(1)
                        ->sum('events.total_hours');
                }

                if ($hoursInCity == 0) {
                    continue;
                }

                $color = $this->generateRandomColor();
                $highlight = "#d5d5d5";

                array_push($result, array(
                    'label' => $city->name,
                    'value' => $hoursInCity / 100,
                    'color' => $color,
                    'highlight' => $highlight
                ));
            }

            return Response::json(['status' => 200, 'hours' => $result]);

        } catch (Exception $e) {
            return Response::json(['status' => 400, 'response' => 'Bad request']);
        }
    }

    /**
     * Number of volunteering "working hours" by county
     * @return \Illuminate\View\View
     */
    public function getStatsWorkingHoursCounty()
    {

        $rules = array(
            'year' => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json((array('message' => 'Bad Request')), 400);
        }
        try {
            $year = (int)Input::get('year');
            $action = Input::get('action');
            $result = array();
            $counties = DB::table('counties')->get();

            foreach ($counties as $county) {
                if ($year == 'empty' or $action == 'empty' or $action == null) {

                    $hoursInCounty = DB::table('events')
                        ->join('cities', 'cities.id', '=', 'events.city_id')
                        ->join('counties', 'counties.id', '=', 'cities.county_id')
                        ->where('counties.id', '=', $county->id)
                        ->remember(1)
                        ->sum('events.total_hours');
                } else {
                    $hoursInCounty = DB::table('events')
                        ->join('cities', 'cities.id', '=', 'events.city_id')
                        ->join('counties', 'counties.id', '=', 'cities.county_id')
                        ->join('actions', 'actions.id', '=', 'events.action_id')
                        ->where('counties.id', '=', $county->id)
                        ->where('events.start', '>', $year . "-01-01 00:00:00")
                        ->where('events.start', '<', ($year + 1) . "-01-01 00:00:00")
                        ->where('actions.name', '=', $action)
                        ->remember(1)
                        ->sum('events.total_hours');
                }

                if ($hoursInCounty == 0) {
                    continue;
                }
                $color = $this->generateRandomColor();
                $highlight = "#d5d5d5";

                array_push($result, array(
                    'label' => $county->name,
                    'value' => $hoursInCounty / 100,
                    'color' => $color,
                    'highlight' => $highlight
                ));
            }

            return Response::json(['status' => 200, 'no_volunteers' => $result]);
        } catch (Exception $e) {
            return Response::json(['status' => 400, 'response' => 'Bad request']);
        }
    }

    /**
     * Number of volunteering "working hours" by region
     * @return \Illuminate\View\View
     */
    public function getStatsWorkingHoursRegion()
    {
        $rules = array(
            'year' => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json((array('message' => 'Bad Request')), 400);
        }
        try {
            $year = (int)Input::get('year');
            $action = Input::get('action');
            $result = array();
            $regions = DB::table('regions')->get();

            foreach ($regions as $region) {
                if ($year == 'empty' or $action == 'empty' or $action == null) {
                    $hoursInRegion = DB::table('events')
                        ->join('cities', 'cities.id', '=', 'events.city_id')
                        ->join('counties', 'counties.id', '=', 'cities.county_id')
                        ->join('regions', 'regions.id', '=', 'counties.region_id')
                        ->where('regions.id', '=', $region->id)
                        ->remember(1)
                        ->sum('events.total_hours');
                } else {
                    $hoursInRegion = DB::table('events')
                        ->join('cities', 'cities.id', '=', 'events.city_id')
                        ->join('counties', 'counties.id', '=', 'cities.county_id')
                        ->join('regions', 'regions.id', '=', 'counties.region_id')
                        ->join('actions', 'actions.id', '=', 'events.action_id')
                        ->where('regions.id', '=', $region->id)
                        ->where('events.start', '>', $year . "-01-01 00:00:00")
                        ->where('events.start', '<', ($year + 1) . "-01-01 00:00:00")
                        ->where('actions.name', '=', $action)
                        ->remember(1)
                        ->sum('events.total_hours');
                }
                if ($hoursInRegion == 0) {
                    continue;
                }

                $color = $this->generateRandomColor();
                $highlight = "#d5d5d5";

                array_push($result, array(
                    'label' => $region->name,
                    'value' => $hoursInRegion / 100,
                    'color' => $color,
                    'highlight' => $highlight
                ));
            }

            return Response::json(['status' => 200, 'regions' => $result]);

        } catch
        (Exception $e) {
            return Response::json(['status' => 400, 'response' => 'Bad requdest']);
        }
    }


    /*
     |--------------------------------------------------------------------------
     | Areas stats
     |--------------------------------------------------------------------------
     */

    /**
     * Number of hosts by area of volunteering activity
     * @return \Illuminate\View\View
     */
    public function getStatsAreaHosts()
    {
        $rules = array(
            'year' => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json((array('message' => 'Bad Request')), 400);
        }

        try {
            $year = (int)Input::get('year');
            $action = Input::get('action');
            $result = array();
            $areas = DB::table('tags')->get();

            foreach ($areas as $area) {
                if ($year == 'empty' or $action == 'empty' or $action == null) {
                    $hostsByActivity = DB::table('hosts')
                        ->join('events', 'events.host_id', '=', 'hosts.id')
                        ->join('taggables', 'taggables.taggable_id', '=', 'events.id')
                        ->join('tags', 'tags.id', '=', 'taggables.tag_id')
                        ->where('taggables.taggable_type', '=', 'Models\Event')
                        ->where('tags.id', '=', $area->id)
                        ->remember(1)
                        ->count();
                } else {
                    $hostsByActivity = DB::table('hosts')
                        ->join('events', 'events.host_id', '=', 'hosts.id')
                        ->join('taggables', 'taggables.taggable_id', '=', 'events.id')
                        ->join('tags', 'tags.id', '=', 'taggables.tag_id')
                        ->join('actions', 'actions.id', '=', 'events.action_id')
                        ->where('taggables.taggable_type', '=', 'Models\Event')
                        ->where('tags.id', '=', $area->id)
                        ->where('events.start', '>', $year . "-01-01 00:00:00")
                        ->where('events.start', '<', ($year + 1) . "-01-01 00:00:00")
                        ->where('actions.name', '=', $action)
                        ->remember(1)
                        ->count();
                }

                if ($hostsByActivity == 0) {
                    continue;
                }

                $color = $this->generateRandomColor();
                $highlight = "#d5d5d5";

                array_push($result, array(
                    'label' => $area->name,
                    'value' => $hostsByActivity / 100,
                    'color' => $color,
                    'highlight' => $highlight
                ));
            }

            return Response::json(['status' => 200, 'regions' => $result]);

        } catch (Exception $e) {
            return Response::json(['status' => 400, 'response' => 'Bad requdest']);
        }
    }

    /**
     * Working hours by area of volunteering activity
     * @return \Illuminate\View\View
     */
    public function getStatsAreaWorkingHours()
    {
        $rules = array(
            'year' => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json((array('message' => 'Bad Request')), 400);
        }
        try {
            $year = (int)Input::get('year');
            $action = Input::get('action');
            $result = array();
            $areas = DB::table('tags')->get();

            foreach ($areas as $area) {
                if ($year == 'empty' or $action == 'empty' or $action == null) {
                    $hoursByActivity = DB::table('hosts')
                        ->join('events', 'events.host_id', '=', 'hosts.id')
                        ->join('taggables', 'taggables.taggable_id', '=', 'events.id')
                        ->join('tags', 'tags.id', '=', 'taggables.tag_id')
                        ->where('taggables.taggable_type', '=', 'Models\Event')
                        ->where('tags.id', '=', $area->id)
                        ->remember(1)
                        ->sum('events.total_hours');
                } else {
                    $hoursByActivity = DB::table('hosts')
                        ->join('events', 'events.host_id', '=', 'hosts.id')
                        ->join('taggables', 'taggables.taggable_id', '=', 'events.id')
                        ->join('tags', 'tags.id', '=', 'taggables.tag_id')
                        ->join('actions', 'actions.id', '=', 'events.action_id')
                        ->where('taggables.taggable_type', '=', 'Models\Event')
                        ->where('tags.id', '=', $area->id)
                        ->where('events.start', '>', $year . "-01-01 00:00:00")
                        ->where('events.start', '<', ($year + 1) . "-01-01 00:00:00")
                        ->where('actions.name', '=', $action)
                        ->remember(1)
                        ->sum('events.total_hours');
                }

                if ($hoursByActivity == 0) {
                    continue;
                }

                $color = $this->generateRandomColor();
                $highlight = "#d5d5d5";

                array_push($result, array(
                    'label' => $area->name,
                    'value' => $hoursByActivity / 100,
                    'color' => $color,
                    'highlight' => $highlight
                ));
            }

            return Response::json(['status' => 200, 'regions' => $result]);

        } catch (Exception $e) {
            return Response::json(['status' => 400, 'response' => 'Bad request']);
        }
    }

    /**
     * Number of volunteers  by area of volunteering activity
     * @return \Illuminate\View\View
     */
    public function getStatsAreaVolunteers()
    {
        $rules = array(
            'year' => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json((array('message' => 'Bad Request')), 400);
        }
        try {
            $year = (int)Input::get('year');
            $action = Input::get('action');
            $result = array();
            $areas = DB::table('tags')->get();
            foreach ($areas as $area) {
                if ($year == 'empty' or $action == 'empty' or $action == null) {
                    $volunteersByActivity = DB::table('hosts')
                        ->join('events', 'events.host_id', '=', 'hosts.id')
                        ->join('taggables', 'taggables.taggable_id', '=', 'events.id')
                        ->join('tags', 'tags.id', '=', 'taggables.tag_id')
                        ->where('taggables.taggable_type', '=', 'Models\Event')
                        ->where('tags.id', '=', $area->id)
                        ->remember(1)
                        ->sum('events.estimated_volunteers_no');
                } else {
                    $volunteersByActivity = DB::table('hosts')
                        ->join('events', 'events.host_id', '=', 'hosts.id')
                        ->join('taggables', 'taggables.taggable_id', '=', 'events.id')
                        ->join('tags', 'tags.id', '=', 'taggables.tag_id')
                        ->join('actions', 'actions.id', '=', 'events.action_id')
                        ->where('taggables.taggable_type', '=', 'Models\Event')
                        ->where('tags.id', '=', $area->id)
                        ->where('events.start', '>', $year . "-01-01 00:00:00")
                        ->where('events.start', '<', ($year + 1) . "-01-01 00:00:00")
                        ->where('actions.name', '=', $action)
                        ->remember(1)
                        ->sum('events.estimated_volunteers_no');
                }
                if ($volunteersByActivity == 0) {
                    continue;
                }
                $color = $this->generateRandomColor();
                $highlight = "#d5d5d5";

                array_push($result, array(
                    'label' => $area->name,
                    'value' => $volunteersByActivity / 100,
                    'color' => $color,
                    'highlight' => $highlight
                ));
            }

            return Response::json(['status' => 200, 'volunteers' => $result]);

        } catch (Exception $e) {
            return Response::json(['status' => 400, 'response' => 'Bad requdest']);
        }
    }


    /*
     |--------------------------------------------------------------------------
     | Organizations stats
     |--------------------------------------------------------------------------
     */
    /**
     * Hosts count by organization type. Cacheable for 1 minute
     * @return \Illuminate\Http\JsonResponse
     */
    public function  getStatsOrganizationTypesHosts()
    {
        // Try from cache
        $cacheKey = 'stats.hostsByOrganizationTypes';
        $return = Cache::get($cacheKey);

        $year = (int)Input::get('year');
        $action = Input::get('action');

        if (empty($return)) {
            try {
                $result = array();
                $organizations = DB::table('organization_types')->get();
                /*
                $total = DB::select(DB::raw("SELECT count(*) as count FROM hosts"))[0]->count;
                $results = DB::select(DB::raw("SELECT organization_types.name, COUNT(*) as count FROM hosts inner join organization_types on hosts.organization_type_id = organization_types.id group by organization_types.name"));
                $return = array();
*               */

                foreach ($organizations as $organization) {
                    if ($year == 'empty' or $action == 'empty' or $action == null) {

                        $hostsByOrgType = DB::table('hosts')
                            ->join('organization_types', 'organization_types.id', '=', 'hosts.organization_type_id')
                            ->where('organization_types.id', '=', $organization->id)
                            ->count();
                    } else {
                        $hostsByOrgType = DB::table('hosts')
                            ->join('organization_types', 'organization_types.id', '=', 'hosts.organization_type_id')
                            ->join('events', 'events.host_id', '=', 'hosts.id')
                            ->join('actions', 'actions.id', '=', 'events.action_id')
                            ->where('organization_types.id', '=', $organization->id)
                            ->where('events.start', '>', $year . "-01-01 00:00:00")
                            ->where('events.start', '<', ($year + 1) . "-01-01 00:00:00")
                            ->where('actions.name', '=', $action)
                            ->remember(1)
                            ->count();
                    }
                    if ($hostsByOrgType == 0) {
                        continue;
                    }
                    $color = $this->generateRandomColor();
                    $highlight = "#d5d5d5";

                    array_push($result, array(
                        'label' => $organization->name,
                        'value' => $hostsByOrgType / 100,
                        'color' => $color,
                        'highlight' => $highlight
                    ));
                }
                return Response::json(['status' => 200, 'regions' => $result]);


            } catch (Exception $e) {
                return Response::json(['status' => 400, 'response' => 'Bad requdest']);
            }

            // Save to cache
            Cache::add($cacheKey, $return, 1);
        }

        return Response::json(['status' => 200, 'regions' => $return]);

    }

    /**
     * Working hours by organization type
     * @return \Illuminate\View\View
     */
    public function  getStatsOrganizationTypesWorkingHours()
    {
        $rules = array(
            'year' => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json((array('message' => 'Bad Request')), 400);
        }
        try {
            $year = (int)Input::get('year');
            $action = Input::get('action');
            $result = array();
            $organizations = DB::table('organization_types')->get();

            foreach ($organizations as $organization) {
                if ($year == 'empty' or $action == 'empty' or $action == null) {
                    $hostsByOrgType = DB::table('hosts')
                        ->join('organization_types', 'organization_types.id', '=', 'hosts.organization_type_id')
                        ->join('events', 'events.host_id', '=', 'hosts.id')
                        ->where('organization_types.id', '=', $organization->id)
                        ->remember(1)
                        ->sum('events.total_hours');

                } else {
                    $hostsByOrgType = DB::table('hosts')
                        ->join('organization_types', 'organization_types.id', '=', 'hosts.organization_type_id')
                        ->join('events', 'events.host_id', '=', 'hosts.id')
                        ->join('actions', 'actions.id', '=', 'events.action_id')
                        ->where('organization_types.id', '=', $organization->id)
                        ->where('events.start', '>', $year . "-01-01 00:00:00")
                        ->where('events.start', '<', ($year + 1) . "-01-01 00:00:00")
                        ->where('actions.name', '=', $action)
                        ->remember(1)
                        ->sum('events.total_hours');
                }
                if ($hostsByOrgType == 0) {
                    continue;
                }

                $color = $this->generateRandomColor();
                $highlight = "#d5d5d5";

                array_push($result, array(
                    'label' => $organization->name,
                    'value' => $hostsByOrgType / 100,
                    'color' => $color,
                    'highlight' => $highlight
                ));
            }

            return Response::json(['status' => 200, 'regions' => $result]);

        } catch (Exception $e) {
            return Response::json(['status' => 400, 'response' => 'Bad requdest']);
        }
    }

    /**
     * Volunteers number by organization type
     * @return \Illuminate\View\View
     */
    public function  getStatsOrganizationTypesVolunteers()
    {

        $rules = array(
            'year' => 'required|numeric',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json((array('message' => 'Bad Request')), 400);
        }
        try {
            $year = (int)Input::get('year');
            $action = Input::get('action');
            $result = array();
            $organizations = DB::table('organization_types')->get();

            foreach ($organizations as $organization) {

                if ($year == 'empty' or $action == 'empty' or $action == null) {
                    $hostsByOrgType = DB::table('hosts')
                        ->join('organization_types', 'organization_types.id', '=', 'hosts.organization_type_id')
                        ->join('events', 'events.host_id', '=', 'hosts.id')
                        ->where('organization_types.id', '=', $organization->id)
                        ->remember(1)
                        ->sum('events.estimated_volunteers_no');
                } else {
                    $hostsByOrgType = DB::table('hosts')
                        ->join('organization_types', 'organization_types.id', '=', 'hosts.organization_type_id')
                        ->join('events', 'events.host_id', '=', 'hosts.id')
                        ->join('actions', 'actions.id', '=', 'events.action_id')
                        ->where('organization_types.id', '=', $organization->id)
                        ->where('events.start', '>', $year . "-01-01 00:00:00")
                        ->where('events.start', '<', ($year + 1) . "-01-01 00:00:00")
                        ->where('actions.name', '=', $action)
                        ->remember(1)
                        ->sum('events.estimated_volunteers_no');
                }
                if ($hostsByOrgType == 0) {
                    continue;
                }
                $color = $this->generateRandomColor();
                $highlight = "#d5d5d5";

                array_push($result, array(
                    'label' => $organization->name,
                    'value' => $hostsByOrgType / 100,
                    'color' => $color,
                    'highlight' => $highlight
                ));
            }
            return Response::json(['status' => 200, 'regions' => $result]);

        } catch (Exception $e) {
            return Response::json(['status' => 400, 'response' => 'Bad requdest']);
        }
    }

    /**
     * Method that returns random color
     * @return string
     */
    public function generateRandomColor()
    {
        $flat_colors = array(
            "#16A085",
            "#2ECC71",
            "#27AE60",
            "#3498DB",
            "#2980B9",
            "#9B59B6",
            "#8E44AD",
            "#34495E",
            "#2C3E50",
            "#2C3E50",
            "#F1C40F",
            "#F39C12",
            "#E67E22",
            "#D35400",
            "#E74C3C",
            "#C0392B",
            "#BDC3C7",
            "#95A5A6",
            "#7F8C8D",
        );
        return $flat_colors[rand(0, 17)];
    }

}