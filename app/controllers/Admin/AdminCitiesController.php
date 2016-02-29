<?php

use Zantolov\Zamb\Controller\AdminCRUDController;

class AdminCitiesController extends AdminCRUDController {

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
        $this->repository = new \Repository\CityRepository();
        $this->templateRoot = 'Admin.Cities';
        $this->baseRoute = 'Admin.Cities';
    }


    /**
     * Show a list of all the users formatted for Datatables.
     * @return Datatables JSON
     */
    public function getData()
    {
        $items = DB::table('cities')->select(array('cities.id','cities.name'));

        return Datatables::of($items)
            ->add_column('actions', $this->getActions(array(self::EDIT_ACTION, self::DELETE_ACTION)))
            //->remove_column('id')
            ->make();
    }

    /**
     * Override with custom params for this method
     * @return Response
     */
    public function getCreate()
    {
        $params = array(
            'counties' => DB::table('counties')->lists('name', 'id'),
        );

        $this->setParamsForMethod('getCreate', $params);
        return parent::getCreate();
    }

    /**
     * Override with custom params for this method
     * @param int $id
     * @return Response
     */
    public function getEdit($id)
    {
        $params = array(
            'counties' => DB::table('counties')->lists('name', 'id'),
        );

        $this->setParamsForMethod('getEdit', $params);
        return parent::getEdit($id);
    }





}