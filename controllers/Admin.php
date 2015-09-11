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
        $this->data['regles'] = TexteBusiness::getByCode('REGLES')->getTexte();
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
        if(!isset($_POST['regles'])) {
            $ret['error'] = 1;
            $ret['errorMsg'] = 'Champ regles obligatoire';
        }
        if(!$this->checkDroit(Droit::ADMIN)) {
            $ret['error'] = 2;
            $ret['errorMsg'] = 'Utilisateur non admin';
        }
        $texte = TexteBusiness::getByCode('REGLES');
        $texte->setTexte(rawurldecode($_POST['regles']));
        $texte->save();
        echo json_encode($ret);
    }

    public function uploadImageRegles()
    {
        $ret = array(
            'uploaded' => 0,
            'filename' => '',
            'url' => ''
        );

        if (!isset($_FILES['upload'])) {
            $ret['error'] = "Pas de fichier envoyé";
            echo json_encode($ret);
            return;
        }

        $tmp_name = $_FILES["upload"]["tmp_name"];
        $segments = explode('.', $_FILES["upload"]["name"]);
        $extension = $segments[count($segments) - 1];
        $exts = array("gif", "jpeg", "jpg", "png");
        if (!in_array($extension, $exts)) {
            $ret['error'] = "Le fichier doit être dans les extensions suivantes : " . print_r($exts, true);
            echo json_encode($ret);
            return;
        }

        $newName = md5(time() . rand(1, 1000000)) . '.' . $extension;
        $path = Conf::path()['includes']['uploadImagesRegles'] . '/' . $newName;
        if (!move_uploaded_file($_FILES["upload"]["tmp_name"], $path)) {
            $ret['error'] = "Impossible d'enregistrer le fichier. Vérifier les droits sur le serveur";
            echo json_encode($ret);
            return;
        }

        $ret['uploaded'] = 1;
        $ret['filename'] = $newName;
        $ret['url'] = Conf::common()['urlAdmin']['images'] . '/' . Conf::path()['includes']['uploadImagesReglesURLRelative'] . '/' . $newName;

        echo json_encode($ret);
    }
}