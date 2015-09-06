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

    /***************************************************************************************************
     ***************************************** AJAX *****************************************************
     ****************************************************************************************************/
    public function login()
    {
        $ret = array('error'=>0, 'errorMsg'=>'');
        if(!isset($_POST['login']) || !isset($_POST['password'])) {
            $ret['error'] = 1;
            $ret['errorMsg'] = 'Champs manquants';
        } elseif(!$_POST['login'] || !$_POST['password']) {
            $ret['error'] = 2;
            $ret['errorMsg'] = 'Champs manquants';
        } else {
            $utilisateur = UtilisateurBusiness::getByLogin($_POST['login'],$_POST['password']);
            if(is_null($utilisateur)) {
                $ret['error'] = 4;
                $ret['errorMsg'] = 'Utilisateur inconnu';
            } else {
                $session = $utilisateur->createSession();
                $session->setTimeSession(time());
                $session->genererToken();
                $session->save();
                setcookie('token',$session->getToken(),time()+(Conf::common()['env']['sessionTTL']*3600));
            }
        }
        echo json_encode($ret);
    }

}