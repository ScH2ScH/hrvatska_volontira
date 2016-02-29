<?php

use Zantolov\Zamb\Controller\AdminCRUDController;

class AdminCountiesController extends AdminCRUDController
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
        $this->repository = new \Repository\CountyRepository();
        $this->templateRoot = 'Admin.Counties';
        $this->baseRoute = 'Admin.Counties';
    }


    /**
     * Show a list of all the users formatted for Datatables.
     * @return Datatables JSON
     */
    public function getData()
    {
        $items = DB::table('counties')->select(array('counties.id', 'counties.name'));

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
            'regions' => DB::table('regions')->lists('name', 'id'),
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
            'regions' => DB::table('regions')->lists('name', 'id'),
        );

        $this->setParamsForMethod('getEdit', $params);

        return parent::getEdit($id);
    }

}