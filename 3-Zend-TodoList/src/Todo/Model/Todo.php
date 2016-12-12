<?php
namespace Todo\Model;

use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;

class Todo implements InputFilterAwareInterface
{
	private $id;
	private $title;
	private $description;
	private $completed;
	protected $inputFilter;

	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();

			$inputFilter->add(array(
				'name'     => 'id',
				'required' => true,
				'filters'  => array(
					array('name' => 'Int'),
				),
			));

			$inputFilter->add(array(
				'name'     => 'title',
				'required' => true,
				'filters'  => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 1,
							'max'      => 100,
						),
					),
				),
			));

			$inputFilter->add(array(
				'name'     => 'description',
				'required' => true,
				'filters'  => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 1,
							'max'      => 250,
						),
					),
				),
			));

			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}

	public function setInputFilter(InputFilterInterface $inputFilter) {
		throw new \Exception('Not implemented');
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function getCompleted() {
		return $this->completed;
	}

	public function setCompleted($completed) {
		$this->completed = $completed;
	}

	public function exchangeArray($data) {
		$this->id =		(isset($data['id']))		? $data['id'] : null;
		$this->title =		(isset($data['title']))		? $data['title'] : null;
		$this->description =	(isset($data['description']))	? $data['description'] : null;
		$this->completed =	(isset($data['completed']))	? $data['completed'] : null;
	}

	public function getArrayCopy() {
		return get_object_vars($this);
	}
}
