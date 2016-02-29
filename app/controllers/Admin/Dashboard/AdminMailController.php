<?php

use Illuminate\Support\Facades\Redirect;

class AdminMailController extends \BaseAdminController
{

    public function getIndex()
    {
        return $this->render('Admin.Mail.index');
    }

    /**
     * Method that sends emails to all hosts in database
     * @return $this
     */
    public function postUpdate()
    {

        try{
            $title = Input::get('title');
            $body = Input::get('body');
            Mail::queue('emails.notification', array('title' => $title, 'body' => $body), function ($message) {

                $hosts = \Models\Event::lists('email');
                foreach ($hosts as $key => $value) {
                    $message->to($value, 'Hrvatska volontira')->subject('Novosti :: Hrvatska volontira');
                }
            });
            return Redirect::route('Admin.Mail.Index')->with('message', 'e-mailovi su uspješno poslani');
        }
        catch(Exception $e){
            return Redirect::route('Admin.Mail.Index')->with('message', 'e-mailovi NISU uspješno poslani');

        }

    }

}