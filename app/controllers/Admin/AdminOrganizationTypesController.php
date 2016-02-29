<?php

use Zantolov\Zamb\Controller\AdminCRUDController;

class AdminOrganizationTypesController extends AdminCRUDController
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
        $this->repository = new \Repository\OrganizationTypeRepository();
        $this->templateRoot = 'Admin.OrganizationTypes';
        $this->baseRoute = 'Admin.OrganizationTypes';
    }


    /**
     * Show a list of all the types formatted for Datatables.
     * @return Datatables JSON
     */
    public function getData()
    {
        $items = DB::table('organization_types')->select(array('organization_types.id', 'organization_types.name', 'organization_types.created_at'));

        return Datatables::of($items)
            ->add_column('actions', $this->getActions(array(self::EDIT_ACTION, self::DELETE_ACTION)))
            ->edit_column('created_at', '{{{ (\Carbon\Carbon::parse($created_at)->format("d.m.Y H:i")) }}}')
            //->remove_column('id')
            ->make();
    }

}