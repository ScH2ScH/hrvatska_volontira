<?php

use Zantolov\Zamb\Controller\AdminCRUDController;

class AdminEventsController extends AdminCRUDController
{

    use ImagesHandlerTrait;

    /** @var  \Repository\ImageRepository $imageRepository */
    protected $imageRepository;


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
        $this->repository = new \Repository\EventRepository();
        $this->templateRoot = 'Admin.Events';
        $this->baseRoute = 'Admin.Events';
        $this->imageRepository = new \Repository\ImageRepository();

    }


    /**
     * Show a list of all the users formatted for Datatables.
     * @return Datatables JSON
     */
    public function getData()
    {
        $items = DB::table('events')->select(array('events.id', 'events.name', 'events.created_at'));

        return Datatables::of($items)
            ->add_column('actions', $this->getActions(array(self::EDIT_ACTION, self::DELETE_ACTION)))
            //->remove_column('id')
            ->make();
    }

    /**
     * Store a newly created model in storage.
     * @return Response
     */
    public function postStore()
    {

        $model = $this->repository->getNew();
        if ($model->updateUniques()) {

            $this->processImageEntities($model);

            $this->processRelatedEntities($model);

            return \Illuminate\Http\Response::create($this->getSuccessJSResponse());
        } else {
            return Redirect::back()->withErrors($model->errors())->withInput();
        }
    }


    /**
     * Update the specified model in storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate($id)
    {
        $model = $this->repository->findOrFail($id);
        if ($model->updateUniques()) {

            $this->processImageEntities($model);

            $this->processRelatedEntities($model);

            return \Illuminate\Http\Response::create($this->getSuccessJSResponse());
        } else {
            return Redirect::back()->withErrors($model->errors())->withInput();
        }
    }
}
