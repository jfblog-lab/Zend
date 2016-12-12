<?php

// mettre vos constantes ici...
define("WEBAPP_DIR","/opt/lampp/htdocs/zend"); // dossier de l'application zend
define("MODEL_DIR",WEBAPP_DIR."/library"); // dossier du modèle
define("ROOT_URL","http://localhost/zend"); // l'URL absolu de zend
define("BASE_URL","/zend/"); // l'URL relative de zend
define("ZEND_FRAMEWORK_DIR","/opt/lampp/htdocs/zend/library"); // dossier comprenant toutes les classes de "Zend Framework"
 
set_include_path(".".PATH_SEPARATOR.MODEL_DIR.PATH_SEPARATOR.ZEND_FRAMEWORK_DIR.PATH_SEPARATOR.get_include_path());
 
require_once 'Zend/Loader.php';
 
// Registry init
Zend_Loader::loadClass("Zend_Registry");
 
// Controller init
Zend_Loader::loadClass('Zend_Controller_Front');
Zend_Loader::loadClass('Zend_Controller_Router_Rewrite');
$controller = Zend_Controller_Front::getInstance();
 
$controller->setBaseUrl(BASE_URL);
$controller->setControllerDirectory('ctrl');
$controller->throwExceptions(true);
 
// init viewRenderer
Zend_Loader::loadClass("Zend_View");
$view = new Zend_View();
$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
$viewRenderer->setView($view)->setViewSuffix('phtml');
 
// call dispatcher
$controller->dispatch();
?>
