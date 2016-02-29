<?php

class AdminExcelController extends \BaseAdminController
{

    /**
     * Method that generates xls from users table
     */
    public function getUsers()
    {
        Excel::create('Korisnici', function ($excel) {

            $excel->sheet('Korisnici', function ($sheet) {
                $users = User::all();
                $sheet->loadView('Admin.Excel.users', compact('users'));
            });
        })->download('xls');
    }

    /**
     * Method that generates xls from static pages table
     */
    public function getStaticPages()
    {
        Excel::create('Novosti', function ($excel) {

            $excel->sheet('Novosti', function ($sheet) {
                $news = StaticPage::orderBy('id', 'desc')->get();
                $sheet->loadView('Admin.Excel.news', compact('news'));
            });
        })->download('xls');
    }

    /**
     * Method that generates xls from hosts table
     */
    public function getHosts()
    {
        Excel::create('organizatori', function ($excel) {

            $excel->sheet('organizatori', function ($sheet) {
                $hosts = Host::all();
                $sheet->loadView('Admin.Excel.hosts', compact('hosts'));
            });
        })->download('xls');
    }

    /**
     * Method that generates xls from static users table
     */
    public function getEvents()
    {
        Excel::create('aktivnosti', function ($excel) {
            $excel->sheet('aktivnosti', function ($sheet) {
                $events = \Models\Event::all();
                $sheet->loadView('Admin.Excel.events', compact('events'));
            });
        })->download('xls');
    }

    public function getHostsEvents()
    {
        Excel::create('organizatori_dogadjaji', function ($excel) {
            $excel->sheet('aktivnosti', function ($sheet) {
                $events = \Models\Event::all();
                $sheet->loadView('Admin.Excel.hostsEvents', compact('events'));
            });
        })->download('xls');
    }


}