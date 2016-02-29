<?php
/*
|--------------------------------------------------------------------------
| Route model bindings
|--------------------------------------------------------------------------
*/

Route::model('user', 'User');
Route::model('permission', 'Permission');
Route::model('role', 'Role');


/*
|--------------------------------------------------------------------------
| Application Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', array('as' => 'Site.Home', 'uses' => 'PublicController@index'));
Route::get('/stats', array('as' => 'Site.StaticPages.Stats', 'uses' => 'PublicController@stats'));
Route::get('/contact', array('as' => 'Site.StaticPages.Contact', 'uses' => 'PublicController@contact'));
Route::get('/actions', array('as' => 'Site.StaticPages.Actions', 'uses' => 'PublicController@action'));
Route::get('/events', array('as' => 'Site.StaticPages.Events', 'uses' => 'PublicController@events'));
Route::get('/news', array('as' => 'Site.StaticPages.News', 'uses' => 'PublicController@news'));


/*
|--------------------------------------------------------------------------
| Specific routes for browsing events and actions
|--------------------------------------------------------------------------
*/
Route::get('/actions/action/{id}', array('as' => 'Site.StaticPages.Action', 'uses' => 'PublicController@getAction'));
Route::get('/events/event/{id}', array('as' => 'Site.StaticPages.Event', 'uses' => 'PublicController@getEvent'));
Route::get('/hosts/host/{id}', array('as' => 'Site.StaticPages.Host', 'uses' => 'PublicController@getHost'));


/*
|--------------------------------------------------------------------------
| Public stats subroutes
|--------------------------------------------------------------------------
*/
Route::get('/stats/hosts', array('as' => 'Site.StaticPages.Stats.Hosts', 'uses' => 'PublicController@getStatsHosts'));
Route::get('/stats/hours',
    array('as' => 'Site.StaticPages.Stats.WorkingHours', 'uses' => 'PublicController@getStatsWorkingHours'));
Route::get('/stats/volunteers',
    array('as' => 'Site.StaticPages.Stats.Volunteers', 'uses' => 'PublicController@getStatsVolunteers'));
Route::get('/stats/organizations',
    array('as' => 'Site.StaticPages.Stats.OrganizationType', 'uses' => 'PublicController@getStatsOrganizationTypes'));
Route::get('/stats/area', array('as' => 'Site.StaticPages.Stats.Area', 'uses' => 'PublicController@getStatsArea'));
Route::get('/stats/time', array('as' => 'Site.StaticPages.Stats.Dates', 'uses' => 'PublicController@getStatsDates'));


/*
|--------------------------------------------------------------------------
| Error 404 page
|--------------------------------------------------------------------------
*/
Route::get('/error', array('as' => 'Site.StaticPages.error', 'uses' => 'PublicController@getErrorPage'));


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function () {

    /*
    |--------------------------------------------------------------------------
    | Admin dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/', array('as' => 'Admin.Dashboard', 'uses' => 'AdminDashboardController@index'));


    /*
  |--------------------------------------------------------------------------
  | Admin downloading excel
  |--------------------------------------------------------------------------
  */
    Route::controller('excel', 'AdminExcelController', array(
        'getUsers' => 'Admin.Excel.Users',
        'getHosts' => 'Admin.Excel.Hosts',
        'getStaticPages' => 'Admin.Excel.News',
        'getEvents' => 'Admin.Excel.Events',
        'getHostsEvents' => 'Admin.Excel.HostsEvents',
    ));

    /*
    |--------------------------------------------------------------------------
    | Sending mail notifications
    |--------------------------------------------------------------------------
    */
    Route::controller('mail', 'AdminMailController', array(
        'getIndex' => 'Admin.Mail.Index',
        'postUpdate' => 'Admin.Mail.Update',
    ));

    /*
    |--------------------------------------------------------------------------
    | Homepage text route
    |--------------------------------------------------------------------------
    */
    Route::controller('homepage', 'AdminHomepageController', array(
        'getIndex' => 'Admin.Homepage.Index',
        'postUpdate' => 'Admin.Homepage.Update',
    ));

    /*
    |--------------------------------------------------------------------------
    | User management routes
    |--------------------------------------------------------------------------
    */
    Route::controller('users', 'AdminUsersController', array(
        'getIndex' => 'Admin.Users.Index',
        'getCreate' => 'Admin.Users.Create',
        'postStore' => 'Admin.Users.Store',
        'getShow' => 'Admin.Users.Show',
        'getEdit' => 'Admin.Users.Edit',
        'postUpdate' => 'Admin.Users.Update',
        'getDelete' => 'Admin.Users.Delete',
        'postDestroy' => 'Admin.Users.Destroy',
        'getData' => 'Admin.Users.Data',
    ));

    /*
    |--------------------------------------------------------------------------
    | Role management routes
    |--------------------------------------------------------------------------
    */
    Route::controller('roles', 'AdminRolesController', array(
        'getIndex' => 'Admin.Roles.Index',
        'getCreate' => 'Admin.Roles.Create',
        'postStore' => 'Admin.Roles.Store',
        'getShow' => 'Admin.Roles.Show',
        'getEdit' => 'Admin.Roles.Edit',
        'postUpdate' => 'Admin.Roles.Update',
        'getDelete' => 'Admin.Roles.Delete',
        'postDestroy' => 'Admin.Roles.Destroy',
        'getData' => 'Admin.Roles.Data',
    ));

    /*
    |--------------------------------------------------------------------------
    | Permissions management routes
    |--------------------------------------------------------------------------
    */
    Route::controller('permissions', 'AdminPermissionsController', array(
        'getIndex' => 'Admin.Permissions.Index',
        'getCreate' => 'Admin.Permissions.Create',
        'postStore' => 'Admin.Permissions.Store',
        'getShow' => 'Admin.Permissions.Show',
        'getEdit' => 'Admin.Permissions.Edit',
        'postUpdate' => 'Admin.Permissions.Update',
        'getDelete' => 'Admin.Permissions.Delete',
        'postDestroy' => 'Admin.Permissions.Destroy',
        'getData' => 'Admin.Permissions.Data',
    ));

    /*
    |--------------------------------------------------------------------------
    | Static Page management routes
    |--------------------------------------------------------------------------
    */
    Route::controller('static-pages', 'AdminStaticPagesController', array(
        'getIndex' => 'Admin.StaticPages.Index',
        'getCreate' => 'Admin.StaticPages.Create',
        'postStore' => 'Admin.StaticPages.Store',
        'getShow' => 'Admin.StaticPages.Show',
        'getEdit' => 'Admin.StaticPages.Edit',
        'postUpdate' => 'Admin.StaticPages.Update',
        'getDelete' => 'Admin.StaticPages.Delete',
        'postDestroy' => 'Admin.StaticPages.Destroy',
        'getData' => 'Admin.StaticPages.Data',
    ));

    /*
    |--------------------------------------------------------------------------
    | Tags management routes
    |--------------------------------------------------------------------------
    */
    Route::controller('tags', 'AdminTagsController', array(
        'getIndex' => 'Admin.Tags.Index',
        'getCreate' => 'Admin.Tags.Create',
        'postStore' => 'Admin.Tags.Store',
        'getShow' => 'Admin.Tags.Show',
        'getEdit' => 'Admin.Tags.Edit',
        'postUpdate' => 'Admin.Tags.Update',
        'getDelete' => 'Admin.Tags.Delete',
        'postDestroy' => 'Admin.Tags.Destroy',
        'getData' => 'Admin.Tags.Data',
    ));


    /*
    |--------------------------------------------------------------------------
    | Product routes
    |--------------------------------------------------------------------------
    */
    Route::controller('products', 'AdminProductsController', array(
        'getIndex' => 'Admin.Products.Index',
        'getCreate' => 'Admin.Products.Create',
        'postStore' => 'Admin.Products.Store',
        'getShow' => 'Admin.Products.Show',
        'getEdit' => 'Admin.Products.Edit',
        'postUpdate' => 'Admin.Products.Update',
        'getDelete' => 'Admin.Products.Delete',
        'postDestroy' => 'Admin.Products.Destroy',
        'getData' => 'Admin.Products.Data',
    ));


    /*
    |--------------------------------------------------------------------------
    | Image routes
    |--------------------------------------------------------------------------
    */
    Route::controller('images', 'AdminImagesController', array(
        'getIndex' => 'Admin.Images.Index',
        'getCreate' => 'Admin.Images.Create',
        'postStore' => 'Admin.Images.Store',
        'getShow' => 'Admin.Images.Show',
        'getEdit' => 'Admin.Images.Edit',
        'postUpdate' => 'Admin.Images.Update',
        'getDelete' => 'Admin.Images.Delete',
        'postDestroy' => 'Admin.Images.Destroy',
        'getData' => 'Admin.Images.Data',
        'getPopup' => 'Admin.Images.Popup',
    ));


    /*
    |--------------------------------------------------------------------------
    | Region routes
    |--------------------------------------------------------------------------
    */
    Route::controller('regions', 'AdminRegionsController', array(
        'getIndex' => 'Admin.Regions.Index',
        'getCreate' => 'Admin.Regions.Create',
        'postStore' => 'Admin.Regions.Store',
        'getShow' => 'Admin.Regions.Show',
        'getEdit' => 'Admin.Regions.Edit',
        'postUpdate' => 'Admin.Regions.Update',
        'getDelete' => 'Admin.Regions.Delete',
        'postDestroy' => 'Admin.Regions.Destroy',
        'getData' => 'Admin.Regions.Data',
    ));

    /*
    |--------------------------------------------------------------------------
    | County routes
    |--------------------------------------------------------------------------
    */
    Route::controller('counties', 'AdminCountiesController', array(
        'getIndex' => 'Admin.Counties.Index',
        'getCreate' => 'Admin.Counties.Create',
        'postStore' => 'Admin.Counties.Store',
        'getShow' => 'Admin.Counties.Show',
        'getEdit' => 'Admin.Counties.Edit',
        'postUpdate' => 'Admin.Counties.Update',
        'getDelete' => 'Admin.Counties.Delete',
        'postDestroy' => 'Admin.Counties.Destroy',
        'getData' => 'Admin.Counties.Data',
    ));

    /*
    |--------------------------------------------------------------------------
    | City routes
    |--------------------------------------------------------------------------
    */
    Route::controller('cities', 'AdminCitiesController', array(
        'getIndex' => 'Admin.Cities.Index',
        'getCreate' => 'Admin.Cities.Create',
        'postStore' => 'Admin.Cities.Store',
        'getShow' => 'Admin.Cities.Show',
        'getEdit' => 'Admin.Cities.Edit',
        'postUpdate' => 'Admin.Cities.Update',
        'getDelete' => 'Admin.Cities.Delete',
        'postDestroy' => 'Admin.Cities.Destroy',
        'getData' => 'Admin.Cities.Data',
    ));

    /*
    |--------------------------------------------------------------------------
    | Host routes
    |--------------------------------------------------------------------------
    */
    Route::controller('hosts', 'AdminHostsController', array(
        'getIndex' => 'Admin.Hosts.Index',
        'getCreate' => 'Admin.Hosts.Create',
        'postStore' => 'Admin.Hosts.Store',
        'getShow' => 'Admin.Hosts.Show',
        'getEdit' => 'Admin.Hosts.Edit',
        'postUpdate' => 'Admin.Hosts.Update',
        'getDelete' => 'Admin.Hosts.Delete',
        'postDestroy' => 'Admin.Hosts.Destroy',
        'getData' => 'Admin.Hosts.Data',
    ));


    /*
    |--------------------------------------------------------------------------
    | Organizationtype routes
    |--------------------------------------------------------------------------
    */
    Route::controller('organization_types', 'AdminOrganizationTypesController', array(
        'getIndex' => 'Admin.OrganizationTypes.Index',
        'getCreate' => 'Admin.OrganizationTypes.Create',
        'postStore' => 'Admin.OrganizationTypes.Store',
        'getShow' => 'Admin.OrganizationTypes.Show',
        'getEdit' => 'Admin.OrganizationTypes.Edit',
        'postUpdate' => 'Admin.OrganizationTypes.Update',
        'getDelete' => 'Admin.OrganizationTypes.Delete',
        'postDestroy' => 'Admin.OrganizationTypes.Destroy',
        'getData' => 'Admin.OrganizationTypes.Data',
    ));


    /*
    |--------------------------------------------------------------------------
    | Event routes
    |--------------------------------------------------------------------------
    */
    Route::controller('events', 'AdminEventsController', array(
        'getIndex' => 'Admin.Events.Index',
        'getCreate' => 'Admin.Events.Create',
        'postStore' => 'Admin.Events.Store',
        'getShow' => 'Admin.Events.Show',
        'getEdit' => 'Admin.Events.Edit',
        'postUpdate' => 'Admin.Events.Update',
        'getDelete' => 'Admin.Events.Delete',
        'postDestroy' => 'Admin.Events.Destroy',
        'getData' => 'Admin.Events.Data',
    ));

    /*
    |--------------------------------------------------------------------------
    | Action routes
    |--------------------------------------------------------------------------
    */
    Route::controller('actions', 'AdminActionsController', array(
        'getIndex' => 'Admin.Actions.Index',
        'getCreate' => 'Admin.Actions.Create',
        'postStore' => 'Admin.Actions.Store',
        'getShow' => 'Admin.Actions.Show',
        'getEdit' => 'Admin.Actions.Edit',
        'postUpdate' => 'Admin.Actions.Update',
        'getDelete' => 'Admin.Actions.Delete',
        'postDestroy' => 'Admin.Actions.Destroy',
        'getData' => 'Admin.Actions.Data',
    ));

});


/*
|--------------------------------------------------------------------------
| API routes
|--------------------------------------------------------------------------
*/

Route::controller('api', 'ApiController', array(
    'postLogin' => 'Api.Login',
    'postRegister' => 'Api.Register',
    'getCheckUsername' => 'Api.CheckUsername',
    'getCheckEmail' => 'Api.CheckEmail',
    'postStoreEvent' => 'Api.StoreEvent',
    'postUpdateEvent' => 'Api.UpdateEvent',
    'postDeleteEventImage' => 'Api.DeleteEventImage',
    'getHomepageDescription' => 'Api.Homepage',
));

Route::controller('stats', 'ApiStatsController', array(
    'getStatsHosts' => 'Api.StatsHosts',
    'getStatsVolunteers' => 'Api.StatsVolunteers',
    'getStatsWorkingHours' => 'Api.StatsWorkingHours',
    'getStatsDates' => 'Api.StatsDates',
    'getStatsOrganizationTypes' => 'Api.StatsOrganizationTypes',
    'getActions' => 'Api.Actions',
    'getYears' => 'Api.Years',
    /*
    |--------------------------------------------------------------------------
    | Public main page stats apis
    |--------------------------------------------------------------------------
    */
    'getTotalVolunteers' => 'Api.StatsHosts',
    'getTotalHosts' => 'Api.StatsHosts',
    'getTotalEvents' => 'Api.StatsEvents',
));

// Confide routes
// ToDo Controller routing
//Route::controller('users', 'UsersController');

//Route::get('users/create', array('as' => 'user.create', 'uses' => 'UsersController@create'));
//Route::post('users', 'UsersController@store');

//Route::get('users/login', array('as' => 'user.login', 'uses' => 'UsersController@login'));
//Route::post('users/login', 'UsersController@doLogin');
//Route::get('users/logout', array('as' => 'user.logout', 'uses' => 'UsersController@logout'));

Route::get('u/confirm/{code}', array('as' => 'User.Confirm.Get', 'uses' => 'UsersController@confirm'));

Route::get('u/forgot_password',
    array('as' => 'User.ForgottenPassword.Get', 'uses' => 'UsersController@forgotPassword'));
Route::post('u/forgot_password',
    array('as' => 'User.ForgottenPassword.Post', 'uses' => 'UsersController@doForgotPassword'));

Route::get('u/reset_password/{token}',
    array('as' => 'User.ResetPassword.Get', 'uses' => 'UsersController@resetPassword'));
Route::post('u/reset_password', array('as' => 'User.ResetPassword.Post', 'uses' => 'UsersController@doResetPassword'));

Route::get('/test', array(
    'as' => 'test',
    'uses' => function () {

        return View::make('Site.test');

        dd(Auth::user()->hasRole('admin'));
        $image = Image::find(12);
        $product = Product::find(1);

        dd($product->images()->get());

        return \Helpers\ImageHelper::getImageUrl($image, 'thumbnail');

    }
));


/*
|--------------------------------------------------------------------------
| Site routes
|--------------------------------------------------------------------------
*/
Route::get('image/{variation}/{id}-{filename}', array('as' => 'image.output', 'uses' => 'ImagesController@output'));

Route::get('u/login', array('as' => 'Public.Login', 'uses' => 'PublicController@login'));
Route::get('u/logout', array('as' => 'Public.Logout', 'uses' => 'PublicController@logout'));
Route::get('u/register', array('as' => 'Public.Registration', 'uses' => 'PublicController@register'));
Route::get('t/{name}', 'PublicController@browseByTagName')->where(array('slug' => '[a-z1-9-]*'));
Route::get('p/{id}-{alias}',
    array('as' => 'Product.Details', 'uses' => 'PublicController@product'))->where(array('slug' => '[a-z1-9-]*'));
Route::get('{slug}', 'StaticPagesController@show')->where(array('slug' => '[a-z1-9-]*'));


// Check for role on all admin routes
Entrust::routeNeedsRole('admin*', array('admin', 'backend'), Redirect::guest(route('Public.Registration')), false);

Route::get('/volunteering/events', array('as' => 'Site.MyEvents', 'uses' => 'PublicController@myEvents'));
Route::get('/volunteering/event/{id}', array('as' => 'Site.MyEvent', 'uses' => 'PublicController@myEventDetails'));
Route::any('/volunteering/event/{id}/images',
    array('as' => 'Site.MyEvent.Images', 'uses' => 'PublicController@myEventImages'));

Entrust::routeNeedsRole('volunteering/*', array('user'), function () {
    if (!Auth::check()) {
        return Redirect::guest(route('Public.Registration'));
    }
});