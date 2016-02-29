<?php

use Zantolov\Zamb\Controller\AdminCRUDController;

class AdminHostsController extends AdminCRUDController
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
        $this->repository = new \Repository\HostRepository();
        $this->templateRoot = 'Admin.Hosts';
        $this->baseRoute = 'Admin.Hosts';
    }

    /**
     * Override with custom params for this method
     * @return Response
     */
    public function getCreate()
    {

        $userRepo = new \Repository\UserRepository();
        $params = array(
            'types' => DB::table('organization_types')->lists('name', 'id'),
            'users' => $userRepo->all()->lists('username', 'id'),
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
        $userRepo = new \Repository\UserRepository();
        $params = array(
            'types' => DB::table('organization_types')->lists('name', 'id'),
            'users' => $userRepo->all()->lists('username', 'id'),
        );
        $this->setParamsForMethod('getEdit', $params);

        return parent::getEdit($id);
    }


    /**
     * Show a list of all the hosts formatted for Datatables.
     * @return Datatables JSON
     */
    public function getData()
    {
        $items = DB::table('hosts')->select(array('hosts.id', 'hosts.name', 'hosts.created_at'));

        return Datatables::of($items)
            ->add_column('actions', $this->getActions(array(self::EDIT_ACTION, self::DELETE_ACTION)))
            ->edit_column('created_at', '{{{ (\Carbon\Carbon::parse($created_at)->format("d.m.Y H:i")) }}}')
            //->remove_column('id')
            ->make();
    }

}