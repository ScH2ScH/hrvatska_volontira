<?php

use Zantolov\Zamb\Controller\AdminCRUDController;

class AdminRegionsController extends AdminCRUDController
{

    public function beforeConstruct()
    {
        $this->checkForRoles(array('admin', 'backend'));
    }


    /**
     * CRUD controller specifics
     */
    protected function afterConstruct()
    {
        parent::afterConstruct();
        $this->repository = new \Repository\RegionRepository();
        $this->templateRoot = 'Admin.Regions';
        $this->baseRoute = 'Admin.Regions';
    }


    /**
     * Show a list of all the users formatted for Datatables.
     * @return Datatables JSON
     */
    public function getData()
    {
        $items = DB::table('regions')->select(array('regions.id', 'regions.name', 'regions.created_at'));

        return Datatables::of($items)
            ->add_column('actions', $this->getActions(array(self::EDIT_ACTION, self::DELETE_ACTION)))
            //->remove_column('id')
            ->make();
    }

}