<?php

class UserController extends BaseController
{
    protected $layout = "layouts.main";
    
    public function __construct() 
    {
        $this->beforeFilter('csrf', array('on'=>'post'));
        $this->beforeFilter('auth', array('only'=>array('getIndex')));
    }
    
    public function getIndex()
    {
        $this->layout->content = View::make("user.dashboard");
    }
    
    public function getRegister()
    {
        $this->layout->content = View::make("user.register");
    }
    
    public function getLogin()
    {
        $this->layout->content = View::make("user.login");
    }
    
    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('user/login')->with('message', 'Your are now logged out!');
    }
    
    public function postCreate()
    {
        $validator = Validator::make(Input::all(), User::$rules);
        
        if($validator->passes())
        {
            $user = new User;
            $user->firstname = Input::get('firstname');
            $user->lastname = Input::get('lastname');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->gender = Input::get('gender');
            $user->dob = Input::get('dob');
            $user->save();
            return Redirect::to('user/login')->with('message', 'Thanks for registering!');
            
        }else
        {
            return Redirect::to('user/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }
    }
    
    public function postSignin()
    {
        if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) 
        {
            return Redirect::to('user')->with('message', 'You are now logged in!');
        }else 
        {
            return Redirect::to('user/login')
        ->with('message', 'Your username/password combination was incorrect')
        ->withInput();
        }
    }
}