<?php

use Zantolov\Zamb\Controller\AdminCRUDController;


class AdminHomepageController extends AdminCRUDController
{

    use ImagesHandlerTrait;


    public function beforeConstruct()
    {
        $this->checkForRoles(array('admin', 'backend'));
    }

    /**
     * Method that provides interface for editing text on main page
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $model = Homepage::find(1);
        return $this->render('Admin.Homepage.index', compact('model'));
    }

    /**
     * CRUD controller specifics
     */
    protected function afterConstruct()
    {
        parent::afterConstruct();
        $this->repository = new \Repository\HomepageRepository();
        $this->templateRoot = 'Admin.Homepage.index';
        $this->baseRoute = 'Admin.Homepage.index';
        $this->imageRepository = new \Repository\ImageRepository();

    }

    public function postUpdate($id)
    {
        $model = $this->repository->findOrFail($id);
        if ($model->updateUniques()) {

            $this->processImageEntities($model);
            $this->processRelatedEntities($model);

            return Redirect::action('AdminHomepageController@getIndex', array('id' => 1))->with('success', 'Group Created Successfully.');;
        } else {
            return Redirect::back()->withErrors($model->errors())->withInput();
        }
    }

    public function getData()
    {
    }
}