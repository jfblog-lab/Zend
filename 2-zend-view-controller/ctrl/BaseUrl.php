<?php

class Zend_View_Helper_BaseUrl {
	function baseUrl(){
		$fc = Zend_Controller_Front::getIntance();
		return $fc->getBaseUrl();
	}

	function serverUrl(){
		$fc = Zend_Controller_Front::getIntance();
		return $fc->getServerUrl();
	}
}
