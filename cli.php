#!/usr/bin/php
<?php
namespace fr\gilman\nj;

if(!isset($_SERVER['SSH_CLIENT'])) {
    echo "CLI only";
    exit();
}

define('BASE_DIR', dirname(__FILE__).'/');

error_reporting(E_ALL);
ini_set("display_errors", 1);

$action = $_SERVER['argv'][1];


require_once(dirname(__FILE__).'/models/Conf.php');
Conf::initCommon(dirname(__FILE__).'/common.ini');
Conf::initPath(dirname(__FILE__).'/path.ini');
require_once(Conf::common()['path']['commonClasses'].'/bb/inc.php');
require_once(Conf::common()['path']['commonClasses'].'/menu/inc.php');
require_once(Conf::common()['path']['commonClasses'].'/carte/inc.php');
require_once(Conf::common()['path']['commonClasses'].'/rules/inc.php');

require_once('controllers/Cli.php');
DbHandler::connect(Conf::common()['DB']['HOST'],Conf::common()['DB']['DB'],Conf::common()['DB']['USER'],Conf::common()['DB']['PASS']);

Cli::$action();