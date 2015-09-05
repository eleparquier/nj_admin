<?php

/**
* Created by Manu
* Date:
* Time:
*/
namespace fr\gilman\nj;

require_once(dirname(__FILE__).'/Controller.php');

class Admin extends Controller {

    public static function login(){
        require_once (dirname(__FILE__).'/../views/pages/Admin/Login.php');
    }

    public static function moderation(){
        require_once (dirname(__FILE__).'/../views/pages/Admin/Moderation.php');
    }

    public static function parties(){
        require_once (dirname(__FILE__).'/../views/pages/Admin/Parties.php');
    }

    public static function utilisateurs(){
        require_once (dirname(__FILE__).'/../views/pages/Admin/Utilisateurs.php');
    }

}