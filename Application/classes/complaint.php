<?php

class complaintArray extends ArrayClass {
	protected $db;

	function __construct(){
		parent::__construct("complaint");
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
				$this->_arrObjects[$row["ID"]] = new complaint();
				$this->_arrObjects[$row["ID"]]->setVarsFromRow($row);
			}
			return true;
		} else {
			return false;
		}
	}

	function loadByRoom($RoomID) {
//		$strSQL = $this->db->SStatement(array(), self::getClass(), array("RoomID" => $RoomID));
		$strSQL = "SELECT *, n.note_count FROM complaint c INNER JOIN
			(select complaint.ID, COUNT(note.ID) AS note_count from complaint LEFT OUTER JOIN note ON complaint.ID = note.ComplaintID group by complaint.ID) n
			ON n.ID = c.ID
			WHERE c.RoomID = $RoomID";
		$this->db->SetQueryStmt($strSQL);
		if($this->db->Query()) {
			$tmp = array();
			foreach ($this->db->GetAll() as $row) {
				$tmp[] = array("ID"=>$row["ID"], "Complaint"=>$row["Complaint"], "Status"=>$row["Status"], "LongTermRenovation"=>$row["LongTermRenovation"], "note_count"=>$row["note_count"], "InsertedOn" => $row["InsertedOn"]);
			}
			return $tmp;
		} else {
			return false;
		}
	}

	function loadCampusLeaderboard() {
		$strSQL = "SELECT campus.Name AS Campus, COUNT(complaint.Complaint) AS Count
			FROM campus
				INNER JOIN building ON campus.ID = building.CampusID
				INNER JOIN room ON building.ID = room.BuildingID
					INNER JOIN complaint ON room.ID = complaint.RoomID
			GROUP BY campus.Name
			ORDER BY COUNT(complaint.Complaint) DESC";
		$this->db->SetQueryStmt($strSQL);
		if($this->db->Query()) {
			$tmp = array();
			foreach($this->db->GetAll() as $row) {
				$tmp[] = $row;
			}
			return $tmp;
		}
		return false;
	}

	function loadBuildingLeaderboard() {
		$strSQL = "SELECT building.Name AS Building, COUNT(complaint.Complaint) AS Count
			FROM building
				INNER JOIN room ON building.ID = room.BuildingID
					INNER JOIN complaint ON room.ID = complaint.RoomID
			GROUP BY building.Name
			ORDER BY COUNT(complaint.Complaint) DESC";
		$this->db->SetQueryStmt($strSQL);
		if($this->db->Query()) {
			$tmp = array();
			foreach($this->db->GetAll() as $row) {
				$tmp[] = $row;
			}
			return $tmp;
		}
		return false;
	}

	function loadRoomLeaderboard() {
		$strSQL = "SELECT complaint.RoomID, campus.Name AS Campus, building.Name AS Building, room.RoomNumber AS Room, COUNT(Complaint) AS Count FROM `complaint` AS complaint
			INNER JOIN `room` AS room ON complaint.RoomID = room.ID
			INNER JOIN `building` AS building ON building.ID = room.BuildingID
			INNER JOIN `campus` AS campus ON campus.ID = building.CampusID
			GROUP BY complaint.RoomID, room.RoomNumber
			ORDER BY Count(Complaint) DESC";
		$this->db->SetQueryStmt($strSQL);
		if($this->db->Query()) {
			$tmp = array();
			foreach($this->db->GetAll() as $row) {
				$tmp[] = $row;
			}
			return $tmp;
		}
		return false;
	}
}

class complaint extends BaseDB {
	protected $_ID;
	protected $_RoomID;
	protected $_Complaint;
	protected $_Status;
	protected $_LongTermRenovation;
	protected $_InsertedOn;
	protected $_UserID;

	public function getID() { return $this->_ID; }
	public function getRoomID() { return $this->_RoomID; }
	public function getComplaint() { return $this->_Complaint; }
	public function getStatus() { return $this->_Status; }
	public function getLongTermRenovation() { return $this->_LongTermRenovation; }
	public function getInsertedOn() { return $this->_InsertedOn; }
	public function getUserID() { return $this->_UserID; }


	public function setID($value) { $this->_ID = $value; }
	public function setRoomID($value) { $this->_RoomID = $value; }
	public function setComplaint($value) { $this->_Complaint = $value; }
	public function setStatus($value) { $this->_Status = $value; }
	public function setLongTermRenovation($value) { $this->_LongTermRenovation = $value; }
	public function setInsertedOn($value) { $this->_InsertedOn = $value; }
	public function setUserID($value) { $this->_UserID = $value; }

	protected $columns = array("ID", "RoomID", "Complaint", "Status", "LongTermRenovation", "UserID");
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
		if($this->_id) {
			$strSQL = "DELETE FROM " . DB_NAME . "." . get_class($this) . "
				WHERE id = $this->_id";
			$this->db->setQueryStmt($strSQL);
			return $this->db->Query();
		}
	}

	private function insert() {
		$this->setUserID(get_current_user_id());
		$this->setInsertedOn(time());
		$strSQL = $this->db->IStatement(get_class($this),self::prepare_data());
		$this->db->setQueryStmt($strSQL);
		if($this->db->Query()) {
			$this->_id = $this->db->GetLastInsertedId();
			return $this->_id;
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