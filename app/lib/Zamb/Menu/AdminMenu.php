<?php
namespace Zamb\Menu;

class AdminMenu
{
    const USER_PROFILE_ITEM = 'Navigation.profile-menu-item';

    protected $rightMenu = null;
    protected $menu = array();

    public function __construct()
    {
        # Home item
        $this->menu[] = new MenuItem('<i class="fa fa-home"></i>  Home', \URL::route('Admin.Dashboard'));
        #Main page text
        $this->menu[] = new MenuItem('<i class="fa fa-file-text-o"></i> Tekst homepage', \URL::route('Admin.Homepage.Index'));



        $this->rightMenu = self::USER_PROFILE_ITEM;

        # User management
        $users = new MenuItem('<i class="fa fa-users"></i> Korisnici');
        $users->addChildren(new MenuItem('<i class="fa fa-user"></i> Korisnici', \URL::route('Admin.Users.Index')));

        if (\Entrust::hasRole('admin')) {
            $users->addChildren(new MenuItem('<i class="fa fa-cube"></i> Uloge', \URL::route('Admin.Roles.Index')));
            $users->addChildren(new MenuItem('<i class="fa fa-lock"></i> Dopuštenja', \URL::route('Admin.Permissions.Index')));
        }

        $this->menu[] = $users;

        #Static Pages
        $this->menu[] = new MenuItem('<i class="fa fa-file"></i> Novosti', \URL::route('Admin.StaticPages.Index'));

        $multimedia = new MenuItem('<i class="fa fa-image"></i> Multimedija');
        $multimedia->addChildren(new MenuItem('<i class="fa fa-image"></i> Slike', \URL::route('Admin.Images.Index')));
        $this->menu[] = $multimedia;

        #Tags
        $this->menu[] = new MenuItem('<i class="fa fa-tag"></i> Oznake', \URL::route('Admin.Tags.Index'));


        # Regional data
        $regional = new MenuItem('<i class="fa fa-flag"></i> Regionalne postavke');
        $regional->addChildren(new MenuItem('<i class="fa fa-user"></i> Gradovi', \URL::route('Admin.Cities.Index')));
        $regional->addChildren(new MenuItem('<i class="fa fa-cube"></i> Županije', \URL::route('Admin.Counties.Index')));
        $regional->addChildren(new MenuItem('<i class="fa fa-lock"></i> Regije', \URL::route('Admin.Regions.Index')));
        $this->menu[] = $regional;

        # Volunteering
        $volunteering = new MenuItem('<i class="fa fa-users"></i> Volontiranja');
        $volunteering->addChildren(new MenuItem('<i class="fa fa-cube"></i> Organizatori', \URL::route('Admin.Hosts.Index')));
        $volunteering->addChildren(new MenuItem('<i class="fa fa-cube"></i> Tipovi organizatora', \URL::route('Admin.OrganizationTypes.Index')));
        $volunteering->addChildren(new MenuItem('<i class="fa fa-cube"></i> Akcije', \URL::route('Admin.Actions.Index')));
        $volunteering->addChildren(new MenuItem('<i class="fa fa-cube"></i> Volonterski događaji', \URL::route('Admin.Events.Index')));
        $this->menu[] = $volunteering;


        # Mailing
        $this->menu[] = new MenuItem('<i class="fa fa-envelope-o"></i>', \URL::route('Admin.Mail.Index'));

    }

    public function compose($view)
    {
        $view->with('menu', $this->getMenu());
    }

    public function getMenu()
    {
        return $this->menu;
    }

    public function getRightMenu()
    {
        return $this->rightMenu;
    }

} 