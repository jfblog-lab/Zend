<?php

require_once 'Zend/Controller/Action.php';

class IndexController extends Zend_Controller_Action {
	public function indexAction(){
		$this->view->Message = "Message d'installation de Zend";
		
	}
}

?>
