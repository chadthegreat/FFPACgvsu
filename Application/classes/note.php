<?php

class noteArray extends ArrayClass {
	protected $db;

	function __construct(){
		parent::__construct("note");
		if(!isset($GLOBALS["DB_ADAPTER"])) {
			$GLOBALS["DB_ADAPTER"] = new DBCon();
			$GLOBALS["DB_ADAPTER"]->Link();
		}
		$this->db = $GLOBALS["DB_ADAPTER"];
		$this->db->setTBL(self::getClass()); // ArrayClass function
	}

	function load() {
		$strSQL = $this->db->SStatement(array(), self::getClass());
		$this->db->SetQueryStmt($strSQL);
		if($this->db->Query()) {
			foreach ($this->db->GetAll() as $row) {
				$this->_arrObjects[$row["ID"]] = new note();
				$this->_arrObjects[$row["ID"]]->setVarsFromRow($row);
			}
			return true;
		} else {
			return false;
		}
	}

	function loadByComplaint($ComplaintID) {
		$strSQL = $this->db->SStatement(array(), self::getClass(), array("ComplaintID" => $ComplaintID));
		$this->db->SetQueryStmt($strSQL);
		if($this->db->Query()) {
			$tmp = array();
			foreach ($this->db->GetAll() as $row) {
				$tmp[] = array("ID" => $row["ID"], "Note"=>$row["Note"]);
			}
			return $tmp;
		} else {
			return false;
		}
	}

	function getArrayKeyValue() {
		$tmp = array();
		foreach($this->_arrObjects as $object) {
			$tmp[$object->getID()] = $object->getRoomNumber();
		}
		return $tmp;
	}

	function toOptionList($BuildingID) {
		$strSQL = $this->db->SStatement(array(), self::getClass(), array("BuildingID" => $BuildingID));
		$this->db->SetQueryStmt($strSQL);
		if($this->db->Query()) {
			$rooms = array();
			foreach ($this->db->GetAll() as $row) {
				$rooms[$row["ID"]] = new room();
				$rooms[$row["ID"]]->setVarsFromRow($row);
			}
		}
		$tmp = array();
		foreach($rooms as $object) {
			$tmp[] = array("value" => $object->getID(), "label" => $object->getRoomNumber());
		}
		return $tmp;
	}

}

class note extends BaseDB {
	protected $_ID;
	protected $_ComplaintID;
	protected $_Note;
	protected $_InsertedOn;

	public function getID() { return $this->_ID; }
	public function getComplaintID() { return $this->_ComplaintID; }
	public function getNote() { return $this->_Note; }
	public function getInsertedOn() { return $this->_InsertedOn; }

	public function setID($value) { $this->_ID = $value; }
	public function setComplaintID($value) { $this->_ComplaintID = $value; }
	public function setNote($value) { $this->_Note = $value; }
	public function setInsertedOn($value) { $this->_InsertedOn = $value; }

	protected $columns = array("ID", "ComplaintID", "Note");
	protected $db;

	public function __construct($id=null) {
		if(!isset($GLOBALS["DB_ADAPTER"])) {
			$GLOBALS["DB_ADAPTER"] = new DBCon();
			$GLOBALS["DB_ADAPTER"]->Link();
		}
		$this->db = $GLOBALS["DB_ADAPTER"];
		$this->db->setTBL(get_class($this));
		if($id) {
			$this->load($id);
		}
	}

	public function delete() {
		if($this->_ID) {
			$strSQL = "DELETE FROM " . DB_NAME . "." . get_class($this) . "
				WHERE ID = $this->_ID";
			$this->db->setQueryStmt($strSQL);
			return $this->db->Query();
		}
	}

	private function insert() {
		$this->setInsertedOn(time());
		$strSQL = $this->db->IStatement(get_class($this),self::prepare_data());
		$this->db->setQueryStmt($strSQL);
		if($this->db->Query()) {
			$this->_ID = $this->db->GetLastInsertedId();
			return $this->_ID;
		} else {
			return false;
		}
	}

	public function load($id)
	{
		if (!$id) return false;
		$strSQL = $this->db->SStatement(array(), get_class($this), array("ID" => strval($id)));
		$this->db->setQueryStmt($strSQL);
		if ($this->db->Query()) {
			$this->setVarsFromRow($this->db->getRow());
			return true;
		} else {
			return false;
		}
	}

	public function save() {
		if($this->_ID) {
			return self::update();
		} else {
			return self::insert();
		}
	}

	private function update() {
		$strSQL = $this->db->UStatement(self::prepare_data(),get_class($this),array("ID" => array(0 => $this->getId())));
		$this->db->setQueryStmt($strSQL);
		if($this->db->Query())
			return ($this->db->GetAffectedRows() > -1);
		return false;
	}

	public function setDB(DBCon $db) {
		$this->db = $db;
	}

}
?>