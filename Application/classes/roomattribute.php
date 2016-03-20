<?php

class roomattributeArray extends ArrayClass {
	protected $db;

	function __construct(){
		parent::__construct("roomattribute");
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
				$this->_arrObjects[$row["ID"]] = new roomattribute();
				$this->_arrObjects[$row["ID"]]->setVarsFromRow($row);
			}
			return true;
		} else {
			return false;
		}
	}
}

class roomattribute extends BaseDB {
	protected $_RoomID;
	protected $_AttributeID;

	public function getRoomID() { return $this->_RoomID; }
	public function getAttributeID() { return $this->_AttributeID; }

	public function setRoomID($value) { $this->_RoomID = $value; }
	public function setAttributeID($value) { $this->_AttributeID = $value; }

	protected $columns = array("RoomID", "AttributeID");
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
				WHERE RoomID = $this->_RoomID";
			$this->db->setQueryStmt($strSQL);
			return $this->db->Query();
		}
	}

	private function insert() {
		$strSQL = $this->db->IStatement(get_class($this),self::prepare_data());
		$this->db->setQueryStmt($strSQL);
		if($this->db->Query()) {
			$this->_ID = $this->db->GetLastInsertedId();
			return $this->_ID;
		} else {
			return false;
		}
	}

	public function save() {
		return self::insert();
	}

	public function setDB(DBCon $db) {
		$this->db = $db;
	}

}
?>