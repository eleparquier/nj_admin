<?php
/**
* Created by Manu
* Date:
* Time:
*/
namespace fr\gilman\nj;

error_reporting(E_ALL);
ini_set("display_errors", 1);

$action = 'index';
if(!empty($_GET['page']) && preg_match('#^[a-zA-Z]+$#',$_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'Admin';
}
if(!empty($_GET['action']) && preg_match('#^[a-zA-Z]+$#',$_GET['action'])) {
    $action = $_GET['action'];
}

require_once(dirname(__FILE__).'/models/Conf.php');
Conf::initCommon(dirname(__FILE__).'/common.ini');
require_once(Conf::common()['path']['commonClasses'].'/bb/inc.php');
require_once(Conf::common()['path']['commonClasses'].'/menu/inc.php');
require_once(Conf::common()['path']['commonClasses'].'/carte/inc.php');
require_once(Conf::common()['path']['commonClasses'].'/rules/inc.php');

DbHandler::connect(Conf::common()['DB']['HOST'],Conf::common()['DB']['DB'],Conf::common()['DB']['USER'],Conf::common()['DB']['PASS']);
require_once('controllers/'.$page.'.php');

$page = __NAMESPACE__.'\\'.$page;
$controler = new $page(new Menu());
$controler->$action();
