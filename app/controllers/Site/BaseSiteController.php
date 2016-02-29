<?php

use Zantolov\Zamb\Controller\BaseController;

class BaseSiteController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->setParam('menu', new \Zamb\Menu\PublicMenu());
    }

} 