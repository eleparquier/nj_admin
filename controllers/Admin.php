<?php

/**
* Created by Manu
* Date:
* Time:
*/
namespace fr\gilman\nj;

class Admin extends Controller {

    public function index()
    {
        $this->getMenu()->setAdmin('index');
        $this->display('pages/Admin/Index.php');
    }

    public function moderation(){
        $this->getMenu()->setAdmin('moderation');
        if(!$this->checkDroit(Droit::ADMIN)) {
            $this->error("Vous devez être connecté pour voir cette page");
            return;
        }
        $this->display('pages/Admin/Moderation.php');
    }

    public function parties(){
        $this->getMenu()->setAdmin('parties');
        if(!$this->checkDroit(Droit::ADMIN)) {
            $this->error("Vous devez être connecté pour voir cette page");
            return;
        }
        $this->display('pages/Admin/Parties.php');
    }

    public function utilisateurs(){
        $this->getMenu()->setAdmin('utilisateurs');
        if(!$this->checkDroit(Droit::ADMIN)) {
            $this->error("Vous devez être connecté pour voir cette page");
            return;
        }
        $this->display('pages/Admin/Utilisateurs.php');
    }

    public function regles(){
        $this->getMenu()->setAdmin('regles');
        if(!$this->checkDroit(Droit::ADMIN)) {
            $this->error("Vous devez être connecté pour voir cette page");
            return;
        }
        $this->display('pages/Admin/Regles.php');
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
            } elseif(!$utilisateur->getDroitGroupes()->droitExists(Droit::ADMIN)) {
                $ret['error'] = 5;
                $ret['errorMsg'] = 'Utilisateur non admin';
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

    public function modifRegles()
    {
        $ret = array('error'=>0, 'errorMsg'=>'');
        if(!$this->checkDroit(Droit::ADMIN)) {
            $ret['error'] = 1;
            $ret['errorMsg'] = 'Utilisateur non admin';
        }
        echo json_encode($ret);
    }

}