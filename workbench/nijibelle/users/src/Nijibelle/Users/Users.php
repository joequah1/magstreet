<?php
namespace Nijibelle\Users;

use Illuminate\View\Environment;
use Illuminate\Config\Repository;

class Users {

	/**
	* Illuminate view environment.
	*
	* @var Illuminate\View\Environment
	*/
	protected $view;

	/**
	* Illuminate config repository.
	*
	* @var Illuminate\Config\Repository
	*/
	protected $config;

	/**
	* 
	*
	* @var 
	*/
	protected $url;

	/**
	* Create a new profiler instance.
	*

	* @param  Illuminate\View\Environment  $view
	* @return void
	*/
	public function __construct(Environment $view, Repository $config, $url)
	{
		$this->view = $view;
		$this->config = $config;
		$this->url = $url;
	}

	/**
	* Get dashboard view.
	*
	* @return Illuminate\View\View
	*/
	public function getDashboard()
	{
		return $this->view->make('users::dashboard');
	}

	/**
	* Get login view.
	*
	* @return Illuminate\View\View
	*/
	public function getLogin()
	{
		return $this->view->make('users::login');
	}

	/**
	* Get register view.
	*
	* @return Illuminate\View\View
	*/
	public function getRegister()
	{
		return $this->view->make('users::register');
	}
    
    /**
	* Get profile view.
	*
	* @return Illuminate\View\View
	*/
	public function getProfile()
	{
		return $this->view->make('users::profile');
	}
    
    /**
	* Profile Image
	*
	* @return Illuminate\View\View
	*/
	public function getProfileImage($id)
	{
        $user = User::find($id);
        
		return $user->profileImage[0]->path;
	}

	/**
	* Get login route.
	*
	* @return Illuminate\View\View
	*/
	public function getLoginRoute()
	{
		return "login";
	}

	/**
	* Get register route.
	*
	* @return Illuminate\View\View
	*/
	public function getRegisterRoute()
	{
		return "register";
	}
    
    /**
	* Get profile route.
	*
	* @return Illuminate\View\View
	*/
	public function getProfileRoute()
	{
		return '/u/'.\Auth::user()->username;
	}

	/**
	* Get register route.
	*
	* @return Illuminate\View\View
	*/
	public function getLogoutRoute()
	{
		return "/auth/logout";
	}
    
    public function getLoginId()
    {
        return \Auth::user()->id;
    }
    
    /**
	* Check if user is login
	*
	* @return Illuminate\View\View
	*/
    public function isLogin()
    {
        if(\Auth::check())
        {
            return true;
        }
        
        return false;
    }
    
    /**
	* check if given username is current user
	*
	* @return Illuminate\View\View
	*/
    public function isUser($username)
    {
        if($this->isLogin())
        {
            if(\Auth::user()->username == $username)
            {
                return true;
            }
        }
        
        return false;
    }
    
    /**
	* Check if current user has admin access
	*
	* @return Illuminate\View\View
	*/
    public function adminAccess()
    {
        if($this->isLogin())
        {
            //$user = User::find(\Auth::user()->id)->roles()->with('roles')->get();
            $user = User::find(\Auth::user()->id)->roles()->get();
            $admin = "admin";
            $super = "super admin";
            
            foreach($user as $role)
            {
                $temp = $role->name;
                if($temp == $admin || $temp == $super)
                {
                    return true;
                }
            }
        }
            
        return  false;
    }

	/**
	 * Enable the users.
	 *
	 * @return void
	 */
	public function enable()
	{
	    $this->config->set('users::enabled', true);
	}

}

