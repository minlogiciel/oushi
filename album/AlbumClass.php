<?php

class AlbumClass {

	var $TABLE_NAME    		= "ALBUMS";
	var $TABLE  = array(
		"IDS",
		"TITLE",
		"FTITLE",
		"ANNEE",
		"DATES",
		"PATH",
		"FILES",
		"REMARKS",
		"GROUPS",
		"DELETED",
	);

	var $IDS		= 0;
	var $TITLE		= 1;
	var $FTITLE		= 2;
	var $ANNEE  	= 3;
	var $DATES   	= 4;
	var $PATH  		= 5;
	var $FILES   	= 6;
	var $REMARKS  	= 7;
	var $GROUPS  	= 8;
	var $DELETED   	= 9;
	
	var $_ids		= 0;	
	var $_titles  	= "";
	var $_ftitles  	= "";
	var $_annee  	= 2014;
	var $_dates     = "";
	var $_path 		= "";
	var $_files  	= "";
	var $_remarks 	= "";
	var $_groups 	= "";
	var $_deleted  	= 0;

	var $connection			= '';

	function connect() {
		if (!$this->connection)
			$this->connection = new sql_class();
		return $this->connection;
	}

	function close() {
		if ($this->connection) {
			$this->connection->close();
			$this->connection = '';
		}
	}

	function getID() {
		return $this->_ids;
	}
	function setID($ids) {
		$this->_ids = $ids;
	}

	function getTitle() {
		return $this->_titles;
	}
	function setTitle($title) {
		$this->_titles = $title;
	}
	function getFTitle() {
		return $this->_ftitles;
	}
	function setFTitle($title) {
		$this->_ftitles = $title;
	}
	
	function getYear() {
		return $this->_annee;
	}
	function setYear($annee) {
		$this->_annee = $annee;
	}
	
	
	function getDates() {
		return $this->_dates;
	}
	function setDates($d) {
		return $this->_dates = $d;
	}
	function getPath() {
		return $this->_path;
	}
	function setPath($path) {
		return $this->_path = $path;
	}
	function getFiles() {
		return $this->_files;
	}
	function setFiles($files) {
		return $this->_files = $files;
	}
	function getRemarks() {
		return $this->_remarks;
	}
	function setRemarks($remarks) {
		return $this->_remarks = $remarks;
	}
	function getGroups() {
		return $this->_groups;
	}
	function setGroups($groups) {
		return $this->_groups = $groups;
	}
	
	function isDeleted() {
		return $this->_deleted;
	}
	function setDeleted($deleted) {
		return $this->_deleted = $deleted;
	}
	
	function setData($elem) {
		$this->setID($elem["$this->IDS"]);
		$this->setTitle($elem["$this->TITLE"]);
		$this->setFTitle($elem["$this->FTITLE"]);
		$this->setYear($elem["$this->ANNEE"]);
		$this->setDates($elem["$this->DATES"]);
		$this->setPath($elem["$this->PATH"]);
		$this->setFiles($elem["$this->FILES"]);
		$this->setRemarks($elem["$this->REMARKS"]);
		$this->setGroups($elem["$this->GROUPS"]);
		$this->setDeleted($elem["$this->DELETED"]);
	}

	function buildTableRef() {
		$buf = "(";
		for ($i= 0; $i < count($this->TABLE); $i++) {
			if ($i > 0)
				$buf .= ", ";
			$buf .= $this->TABLE[$i];
		}
		$buf .= ")";
		return $buf;
	}
	
	function getData() {
		$buf = "(";
		$buf .= "'" . $this->getID() . "', ";
		$buf .= "'" . $this->getTitle() . "', ";
		$buf .= "'" . $this->getFTitle() . "', ";
		$buf .= "'" . $this->getYear() . "', ";
		$buf .= "'" . $this->getDates() . "', ";
		$buf .= "'" . $this->getPath() . "', ";
		$buf .= "'" . $this->getFiles() . "', ";
		$buf .= "'" . $this->getRemarks() . "', ";
		$buf .= "'" . $this->getGroups() . "', ";
		$buf .= "'" . $this->isDeleted() . "'";
		$buf .= ")";
		return $buf;
	}
	
	function addNewPhoto() {
		$exec = $this->connect();
		$uid = $exec->get_max_number($this->TABLE_NAME, $this->TABLE[$this->IDS]);
		$this->setID($uid);
		$this->setYear(date('Y'));
		$data = $this->getData();
		$exec->add_elements($this->TABLE_NAME, $this->buildTableRef(), $data);
		$this->close();
	}

	function getUpdateData() {
		$buf = "";
		$buf .= $this->TABLE[$this->TITLE]. 	"='" . $this->getTitle() . "', ";
		$buf .= $this->TABLE[$this->FTITLE]. 	"='" . $this->getFTitle() . "', ";
		$buf .= $this->TABLE[$this->DATES]. 	"='" . $this->getDates() . "', ";
		$buf .= $this->TABLE[$this->REMARKS]. 	"='" . $this->getRemarks() . "', ";
		$buf .= $this->TABLE[$this->DELETED]. 	"='" . $this->isDeleted() . "'";
		return $buf;
	}
	function updatePhoto() {
		$exec = $this->connect();
		$data = $this->getUpdateData();
		$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
		$this->close();
	}
	function getPhoto($id) {
		$exec = $this->connect();
		$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $id);
		if ($elem) {
			$this->setData($elem);
			return 1;
		}
		return 0;
	}
	
}
?>
