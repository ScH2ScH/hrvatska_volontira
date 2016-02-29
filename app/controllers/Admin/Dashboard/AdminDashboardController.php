<?php

class AdminDashboardController extends \BaseAdminController
{

    public function index()
    {
        return $this->render('Admin.Dashboard.index');
    }

}