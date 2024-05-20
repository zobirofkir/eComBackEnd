<?php
namespace Model;

use Auth\Auth;

class User extends Auth
{
    public function register() 
    {
        return parent::authRegister();
    }

    public function login() 
    {
        return parent::authLogin();
    }

    public function logout()
    {
        return parent::authLogout();
    }
}
