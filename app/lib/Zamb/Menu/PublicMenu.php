<?php
namespace Zamb\Menu;

class PublicMenu
{
    const USER_PROFILE_ITEM = 'Navigation.profile-menu-item';

    protected $rightMenu = null;
    protected $menu = array();

    public function __construct()
    {
        return;
        # Home item
        /*
        $this->menu[] = new MenuItem('Home', \URL::route('Site.Home'));

        $this->menu[] = new MenuItem('Register', \URL::route('user.create'));
        if (\Auth::check()) {
            $this->menu[] = new MenuItem('Logout', \URL::route('user.logout'));
            $this->rightMenu = self::USER_PROFILE_ITEM;
        } else {
            $this->menu[] = new MenuItem('Login', \URL::route('user.login'));
        }
        */
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