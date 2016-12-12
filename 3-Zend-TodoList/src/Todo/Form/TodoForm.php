<?php
namespace Todo\Form;

use Zend\Form\Form;

class TodoForm extends Form
{
	public function __construct($name = null)
	{
		parent::__construct('todo');

		$this->add(array(
			'name' => 'id',
			'type' => 'Hidden',
		));

		$this->add(array(
			'name' => 'title',
			'type' => 'Text',
			'options' => array(
				'label' => 'Titre',
			),
			'attributes' => array(
				'class' => 'form-control'
			)
		));

		$this->add(array(
			'name' => 'description',
			'type' => 'Textarea',
			'options' => array(
				'label' => 'Description',
			),
			'attributes' => array(
				'class' => 'form-control'
			)
		));

		$this->add(array(
			'name' => 'completed',
			'type' => 'Checkbox',
			'options' => array(
				'label' => 'Terminée',
				'use_hidden_element' => true,
				'checked_value' => '1',
				'unchecked_value' => '0',
			),
			'attributes' => array(
				'class' => 'form-control'
			)
		));

		$this->add(array(
			'name' => 'validate',
			'type' => 'Submit',
			'attributes' => array(
				'value' => 'Valider',
				'id' => 'validate',
				'class' => 'btn btn-default',
			)
		));
	}
}
