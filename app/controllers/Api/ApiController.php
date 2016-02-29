<?php

use Illuminate\Http\JsonResponse;

class ApiController extends \Controller
{

    public function getSuccessResponse($data = array())
    {
        return array(
            'status' => 1,
            'data'   => $data,
        );
    }


    public function getErrorResponse($data = array())
    {
        return array(
            'status' => 0,
            'data'   => $data,
        );
    }


    public function postLogin()
    {
        $repo = App::make('UserRepository');
        $input = Input::all();

        if ($repo->login($input)) {
            $data = array('message' => 'Uspješna prijava');

            // TODO After login redirection
            if (Entrust::hasRole('admin') || Entrust::hasRole('backend')) {
                $data['redirect'] = URL::route('Admin.Dashboard');
            } else {
                $data['redirect'] = URL::route('Site.MyEvents');
            }


            return new JsonResponse($this->getSuccessResponse($data));
        } else {
            if ($repo->isThrottled($input)) {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            } elseif ($repo->existsButNotConfirmed($input)) {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            } else {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

            return new JsonResponse($this->getErrorResponse(array('message' => $err_msg)), 401);
        }
    }


    public function postRegister()
    {
        $userData = array(
            'username' => Input::get('username'),
            'password' => Input::get('password'),
            'email'    => Input::get('email'),
        );

        $organizationData = array(
            'name'                 => Input::get('name'),
            'address'              => Input::get('address'),
            'contact_person'       => Input::get('contact_person'),
            'phone'                => Input::get('phone'),
            'web'                  => Input::get('web'),
            'organization_type_id' => Input::get('organization_type_id'),
        );


        $host = new Host;
        $host->name = $organizationData['name'];
        $host->address = $organizationData['address'];
        $host->contact_person = $organizationData['contact_person'];
        $host->phone = $organizationData['phone'];
        $host->web = $organizationData['web'];
        $host->organization_type_id = $organizationData['organization_type_id'];

        if (!$host->validate()) {
            $error = $host->errors()->all(':message');

            return new JsonResponse($this->getErrorResponse(array('message' => $error)), 400);
        }

        $repo = App::make('UserRepository');
        $user = $repo->signup($userData);

        if ($user->id) {

            // Assign role
            $role = Role::where(array('name' => 'host'))->first();
            if (!empty($role)) {
                $user->roles()->save($role);
            }

            if (Config::get('confide::signup_email')) {
                Mail::queueOn(
                    Config::get('confide::email_queue'),
                    Config::get('confide::email_account_confirmation'),
                    compact('user'),
                    function ($message) use ($user) {
                        $message
                            ->to($user->email, $user->username)
                            ->subject(Lang::get('confide::confide.email.account_confirmation.subject'));
                    }
                );
            }
        } else {
            $error = $user->errors()->all(':message');

            return new JsonResponse($this->getErrorResponse(array('message' => $error)), 400);
        }

        $host->user_id = $user->id;
        if ($host->save()) {
            return new JsonResponse($this->getSuccessResponse(array('message' => Lang::get('confide::confide.alerts.account_created'))));
        } else {
            $error = 'Error creating host';

            return new JsonResponse($this->getErrorResponse(array('message' => $error)), 400);
        }
    }

    public function postLogout()
    {
        Auth::logout();

        return new JsonResponse($this->getSuccessResponse(array('message' => 'Uspješna odjava')));

    }

    public function getCheckUsername()
    {
        $username = Input::get('username');
        $user = User::where(array('username' => $username))->first();

        return array('valid' => empty($user));
    }

    public function getCheckEmail()
    {
        $email = Input::get('email');
        $user = User::where(array('email' => $email))->first();

        return array('valid' => empty($user));
    }

    public function postStoreEvent()
    {
        try {
            $event = new Models\Event();
            $event->host_id = Auth::user()->host()->first()->getKey();
            if ($event->updateUniques()) {
                $event->tags()->sync(Input::get('tags') ?: array());

                return Redirect::back()->with('notice', 'Aktivnost kreirana');
            } else {
                return Redirect::back()->withErrors($event->errors())->withInput();
            }
        } catch (Exception $e) {
            Log::error($e->getMessage(), $event->toArray());
        }

        return Redirect::back()->with('error', 'Greška');
    }

    public function postUpdateEvent($id)
    {
        try {
            $event = Models\Event::findOrFail($id);
            $event->host_id = Auth::user()->host()->first()->getKey();
            $event->tags()->sync(Input::get('tags') ?: array());

            if ($event->updateUniques()) {
                return Redirect::back()->with('notice', 'Aktivnost je ažurirana');
            } else {
                return Redirect::back()->withErrors($event->errors())->withInput();
            }
        } catch (Exception $e) {
            Log::error($e->getMessage(), $event->toArray());
        }

        return Redirect::back()->with('error', 'Error');
    }


    public function postDeleteEventImage()
    {
        $imageId = Input::get('imageID');
        $eventId = Input::get('eventID');

        $event = \Models\Event::findOrFail($eventId);
        if ($event->host_id != Auth::user()->host()->first()->id) {
            throw new Exception('Zabranjen pristup');
        }

        $images = $event->images()->lists('id');

        if (!in_array($imageId, $images)) {
            throw new Exception('Image is not assigned to model');
        } else {
            try{
                /** @var Image $image */
                $image = Image::findOrFail($imageId);
                $image->delete();

                return new JsonResponse(array('status' => 'OK'));
            }
            catch(Exception $e){
                return new JsonResponse(array('status' => 'Fail deleting'));
            }
        }
    }

    public function getHomepageDescription(){

        try {
            $homepageText = Homepage::where('active','=',1)->findOrFail(1);
            return Response::json(['status' => 200, 'value' => $homepageText]);

        } catch (Exception $e) {
            return Response::json(['status' => 400, 'response' => 'Bad request']);
        }
    }

} 