<?php
namespace Todo\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Todo\Form\TodoForm;
use Todo\Model\Todo;

/**
 * IndexController
 *
 * @author
 *
 * @version
 *
 */
class IndexController extends AbstractActionController
{

	protected $todoTable;

	public function getTodoTable()
	{
		if (! $this->todoTable) {
			$sm = $this->getServiceLocator();
			$this->todoTable = $sm->get('Todo\Model\TodoTable');
		}

		return $this->todoTable;
	}

	/**
	 * Action par défaut - Lister les tâches
	 */
	public function indexAction()
	{
		$todos = $this->getTodoTable()->fetchAll();

		return array('todos' => $todos);
	}

	/**
	 * Créer une nouvelle tâche
	 *
	 */
	public function createAction()
	{
		$form = new TodoForm();

		$request = $this->getRequest();

		if ($request->isPost()) {
			$todo = new Todo();
			$form->setInputFilter($todo->getInputFilter());
			$form->setData($request->getPost());

			if ($form->isValid()) {
				$todo->exchangeArray($form->getData());
				$this->getTodoTable()->saveTodo($todo);

				return $this->redirect()->toRoute('todo');
			}
		}
		return array('form' => $form);
	}

	/**
	 * Editer une tâche
	 *
	 */
	public function editAction()
	{
		$id = $this->params()->fromRoute('id', 0);
		if (!$id) {
			throw new \Exception('ID is wrong');
		}

		try {
			$todo = $this->getTodoTable()->getTodo($id);
		} catch (\Exception $ex) {
			throw $ex;
		}

		$form = new TodoForm();
		$form->bind($todo);

		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setInputFilter($todo->getInputFilter());
			if ($form->isValid()) {
				$todo->exchangeArray($request->getPost()->toArray());
				$this->getTodoTable()->saveTodo($todo);

				return $this->redirect()->toRoute('todo');
			}
		}

		return array (
			'id' => $id,
			'form' => $form,
		);
	}

	/**
	 * Supprimer une tâche
	 *
	 */
	public function deleteAction()
	{
		$id = (int) $this->params()->fromRoute('id', 0);
		 if (!$id) {
			 throw new \Exception('id '.$id.' is wrong');
		 }

		 try {
			 $todo = $this->getTodoTable()->getTodo($id);
		 }
		 catch (\Exception $ex) {
			 throw new \Exception('todo not found');
		 }
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$this->getTodoTable()->deleteTodo($id);
			
			return $this->redirect()->toRoute('todo');
		}
		
		return array(
			'id' => $id,
			'todo' => $todo
		);
	}
}
