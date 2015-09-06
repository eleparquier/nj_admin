<?php

/**
* Created by Manu
* Date:
* Time:
*/
namespace fr\gilman\nj;

require_once(dirname(__FILE__).'/Controller.php');

class Admin extends Controller {

    public function index()
    {
        $this->getMenu()->setAdmin('index');
        $this->display('pages/Admin/Index.php');
    }

    public function moderation(){
        $this->getMenu()->setAdmin('moderation');
        $this->display('pages/Admin/Moderation.php');
    }

    public function parties(){
        $this->getMenu()->setAdmin('parties');
        $this->display('pages/Admin/Parties.php');
    }

    public function utilisateurs(){
        $this->getMenu()->setAdmin('utilisateurs');
        $this->display('pages/Admin/Utilisateurs.php');
    }


}