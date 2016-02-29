<?php

use Zantolov\Zamb\Controller\AdminCRUDController;


class AdminPermissionsController extends AdminCRUDController
{

    public function beforeConstruct()
    {
        $this->checkForRoles(array('admin'));
    }


    /**
     * CRUD controller specifics
     */
    protected function afterConstruct()
    {
        parent::afterConstruct();
        $this->repository = new \Repository\PermissionRepository();
        $this->templateRoot = 'Admin.Permissions';
        $this->baseRoute = 'Admin.Permissions';
    }


    /**
     * Show a list of all the users formatted for Datatables.
     * @return Datatables JSON
     */
    public function getData()
    {
        $roles = DB::table('permissions')->select(array('permissions.id', 'permissions.display_name', 'permissions.name', 'permissions.created_at'));

        return Datatables::of($roles)
            ->add_column('actions', $this->getActions(array(self::EDIT_ACTION, self::DELETE_ACTION)))
            ->remove_column('id')
            ->make();
    }
}
