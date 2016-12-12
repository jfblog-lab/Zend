<?php
namespace Todo\Model;

use Zend\Db\TableGateway\TableGateway;

class TodoTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll()
	{
		$result = $this->tableGateway->select();
		return $result;
	}
	
	public function getTodo($id)
	{
		$id = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();

		if (!$row) {
			throw new \Exception("Could not find todo $id");
		}

		return $row;
	}
	
	public function saveTodo(Todo $todo)
	{
		$data = array(
			'title' => $todo->getTitle(),
			'description' => $todo->getDescription(),
			'completed' => $todo->getCompleted(),
		);

		$id = (int) $todo->getId();
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getTodo($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception("Todo $id doesn't exist");
			}
		}
	}
	
	public function deleteTodo($id)
	{
		return $this->tableGateway->delete(array('id' => (int) $id));
	}
}
