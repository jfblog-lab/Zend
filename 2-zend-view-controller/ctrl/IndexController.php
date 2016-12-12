<?php

require_once 'Zend/Controller/Action.php';

class IndexController extends Zend_Controller_Action {
	public function indexAction(){
		$this->view->titreMessage = "Titre de test";
		$this->view->testMessage = "Mon message de test";
		$this->view->titreSidebar = "Titre Sidebar";
		$this->view->testSidebar = "Mon message de test Sidebar";
	}

	public function ajouterAction(){
		$this->view->titreMessage = "Titre de test ajout";
		$this->view->testMessage = "Mon message de test ajout";
		$this->view->titreSidebar = "Titre Sidebar ajout";
		$this->view->testSidebar = "Mon message de test Sidebar ajout";
	}

	public function modifierAction(){
		$this->view->titreMessage = "Titre de test modif";
		$this->view->testMessage = "Mon message de test modif";
		$this->view->titreSidebar = "Titre Sidebar modif";
		$this->view->testSidebar = "Mon message de test Sidebar modif";
	}

	public function supprimerAction(){
		$this->view->titreMessage = "Titre de test suppr";
		$this->view->testMessage = "Mon message de test suppr";
		$this->view->titreSidebar = "Titre Sidebar suppr";
		$this->view->testSidebar = "Mon message de test Sidebar suppr";
	}
}

?>
