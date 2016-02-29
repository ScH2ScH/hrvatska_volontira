<?php

use Models\Event;

class PublicController extends BaseSiteController
{

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $homepage = Homepage::where('active', '=', 1)->findOrFail(1);
        return $this->render('Site.home', compact('homepage'));
    }


    /**
     * @return \Illuminate\View\View
     */
    public function stats()
    {
        return $this->render('Site.StaticPages.Stats');
    }


    /***
     * @return \Illuminate\View\View
     */
    public function contact()
    {
        return $this->render('Site.StaticPages.Contact');
    }


    /**
     * @return \Illuminate\View\View
     */
    public function action()
    {
        $actions = Action::orderBy('id', 'DESC')->get();

        return $this->render('Site.StaticPages.Action', compact('actions'));
    }


    /**
     * @return \Illuminate\View\View
     */
    public function events()
    {
        $events = Event::orderBy('id', 'DESC')->get();
        return $this->render('Site.StaticPages.Events', compact('events'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function news()
    {
        $news = StaticPage::orderBy('id', 'DESC')->get();
        return $this->render('Site.StaticPages.News', compact('news'));
    }


    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getAction($id)
    {
        $action = Action::findOrFail($id);

        return $this->render('Site.StaticPages.ActionDetails', compact('action'));
    }


    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getEvent($id)
    {
        $event = Event::findOrFail($id);

        return $this->render('Site.StaticPages.EventDetails', compact('event'));
    }


    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getHost($id)
    {
        $host = Host::findOrFail($id);

        return $this->render('Site.StaticPages.Host', compact('host'));
    }


    /**
     * Login page
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function login()
    {
        if (Auth::check()) {
            return Redirect::route('Site.Home');
        }

        $this->setParam('title', 'Login');

        return $this->render('Site.User.login');
    }


    /**
     * Logout page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        $this->setParam('title', 'Logout');
        Auth::logout();

        return Redirect::route('Site.Home');
    }


    /**
     * @return \Illuminate\View\View
     */
    public function register()
    {
        $this->setParam('title', 'Register');

        $typeRepo = new \Repository\OrganizationTypeRepository();
        $this->setParam('types', $typeRepo->all()->lists('name', 'id'));

        return $this->render('Site.User.register');
    }


    /**
     * @param null $model
     * @return \Illuminate\View\View
     */
    public function myEvents($model = null)
    {
        /** @var Host $host */
        $host = Auth::getUser()->host()->firstOrFail();
        $events = $host->events()->get();
        $this->setParam('events', $events);

        if (empty($model)) {
            $model = new Event();
        }

        $this->setParam('model', $model);
        $this->setParam('title', 'Moje aktivnosti :: Hrvatska Volontira');

        return $this->render('Site.Event.MyEvents');
    }


    /**
     * @param $id
     * @return \Illuminate\View\View
     * @throws \Whoops\Exception\ErrorException
     */
    public function myEventDetails($id)
    {
        $event = Event::findOrFail($id);

        if ($event->host_id != Auth::user()->host()->first()->id) {
            throw new \Whoops\Exception\ErrorException('Access Denied');
        }

        return $this->myEvents($event);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Whoops\Exception\ErrorException
     *

     */

    public function myEventImages($id)
    {
        /** @var Event $event */
        $event = Event::findOrFail($id);
        if ($event->host_id != Auth::user()->host()->first()->id) {
            throw new \Whoops\Exception\ErrorException('Access Denied');
        }

        if (Request::isMethod('GET')) {
            return $this->render('Site.Event.event-images-form', array('model' => $event));
        } elseif (Request::isMethod('POST')) {

            $errorMessage = 'Greška molimo Vas držite se uputa za učitavanje slika (.jpg,.jpeg,.png) i preporučene veličine (do 4Mb)';

            $files = Input::file('files');
            if (empty($files) || (is_array($files) && !count($files))) {
                Session::flash('error', 'Error, no images found');

                return $this->render('Site.Event.event-images-form', array('model' => $event));
            }
            $imageRepository = new \Repository\ImageRepository();

            $files = Input::file('files');
            $filesCount = count($files);

            for ($i = 0; $i < $filesCount; $i++) {
                $file = $files[$i];
                $input = array(
                    'upload' => $files[$i]
                );

                $rules = array(
                    'upload' => 'image|mimes:jpeg,jpg,png|max:4096',
                );
                $validation = Validator::make($input, $rules);

                if ($validation->fails()) {
                    Session::flash('error', $errorMessage);
                    return $this->render('Site.Event.event-images-form', array('model' => $event));
                }
            }

            try {
                foreach ($files as $file) {
                    $image = $imageRepository->createImageByUploadedFile($file);
                    $event->images()->save($image);
                }
            } catch (Exception $e) {
                Session::flash('error', $errorMessage);
                return $this->render('Site.Event.event-images-form', array('model' => $event));
            }
            return Redirect::back()->with('callback', '<script>parent.window.location.reload()</script>');
        }
    }


    /**
     * Number of Hosts in every city,county and region
     * @return \Illuminate\View\View
     */
    public function getStatsHosts()
    {
        return $this->render('Site.StaticPages.Stats.Hosts');
    }

    /**
     * Number of volunteers by city,county and region
     * @return \Illuminate\View\View
     */
    public function getStatsVolunteers()
    {
        return $this->render('Site.StaticPages.Stats.Volunteers');
    }

    /**
     * Number of volunteering "working hours" by city,county and region
     * @return \Illuminate\View\View
     */
    public function getStatsWorkingHours()
    {
        return $this->render('Site.StaticPages.Stats.WorkingHours');
    }

    /**
     * Search volunteering activity by dates
     * @return \Illuminate\View\View
     */
    public function  getStatsDates()
    {
        return $this->render('Site.StaticPages.Stats.Dates');

    }

    /**
     * Stats by area of volunteering activity
     * @return \Illuminate\View\View
     */
    public function getStatsArea()
    {
        return $this->render('Site.StaticPages.Stats.Area');

    }

    /**
     * Stats by organization type
     * @return \Illuminate\View\View
     */
    public function  getStatsOrganizationTypes()
    {
        return $this->render('Site.StaticPages.Stats.OrganizationTypes');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getErrorPage()
    {
        return $this->render('Site.StaticPages.Error');
    }
}
