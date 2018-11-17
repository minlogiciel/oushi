<?php
class ArticleClass {

	var $TABLE_NAME    	= "starticles";

	var $TABLE  = array(
		"IDS", 
		"TITLE", 
		"COMPETITION", 
		"STUDENT",
		"CLASSES",
		"REWARD", 
		"POSITION", 
		"DATES",
		"CONTENTS", 
		"FCONTENTS", 
		"TYPES",
		"LASTMODIF", 
		"DELETED", 
	);
	
	var $IDS		= 0;
	var $TITLE     	= 1;
	var $COMPETITION  = 2;
	var $STUDENT 	= 3;
	var $CLASSES 	= 4;
	var $REWARD    	= 5;
	var $POSITION  	= 6;
	var $DATES 		= 7;
	var $CONTENTS  	= 8;
	var $FCONTENTS  = 9;
	var $TYPES     	= 10;
	var $LASTMODIF 	= 11;
	var $DELETED    = 12;


	var $_id         	= 0;
	var $_title         = "";
	var $_competition   = "";
	var $_student        = "";
	var $_classes       = "";
	var $_reward		= "";
	var $_position		= 6;
	var $_dates			= "";
	var $_contents 		= "";
	var $_fcontents		= "";
	var $_types    		= 0;
	var $_lastmodif		= "";
	var $_deleted		= 0;

	var $connection		= '';
	
	function connect() {
		if (!$this->connection) {
			$this->connection = new sql_class();
		}
		return $this->connection;
	}

	function close() {
		if ($this->connection) {
			$this->connection->close();
			$this->connection = '';
		}
	}
	
	function getID() {
		return $this->_id;
	}
	function setID($id) {
		$this->_id = $id;
	}

	function getTitle() {
		return $this->_title;
	}
	function setTitle($title) {
		$this->_title = $title;
	}
	function getCompetition() {
		return $this->_competition;
	}
	function setCompetition($comp) {
		$this->_competition = $comp;
	}
	
	function getReward() {
		return  $this->_reward;
	}
	
	function setReward($reward) {
		$this->_reward = $reward;
		$this->setPosition($reward);
	}

	
	function getPosition() {
		return $this->_position;
	}
	function setPosition($position) {
		$this->_position = getRewardPosition($position);
	}
	
	function getType() {
		return $this->_types;
	}
	function setType($type) {
		$this->_types = $type;
	}
	function getLastModif() {
		return $this->_lastmodif;
	}
	function setLastModif($lastmodif) {
		$this->_lastmodif = $lastmodif;
	}
	function getStudent() {
		return $this->_student;
	}
	function setStudent($student) {
		$this->_student = $student;
	}
	function getClasses() {
		return $this->_classes;
	}
	function setClasses($classes) {
		$this->_classes = $classes;
	}
	
	function getContents() {
		return $this->_contents;
	}

	function setContents($contents) {
		$this->_contents = $contents;
	}
	
	function getFContents() {
		return $this->_fcontents;
	}

	function setFContents($contents) {
		$this->_fcontents = $contents;
	}

	function getDates() {
		return $this->_dates;
	}
	function setDates($dates) {
		$this->_dates = getFormatDate($dates);;
	}
	function getChineseDate() {
		return getChineseFormatDate($this->_dates);
	}
	
	function isDeleted() {
		return $this->_deleted;
	}
	function setDeleted($deleted) {
		$this->_deleted = $deleted;
	}
	
	function getCurrentDate() {
		return date("m/d/Y - H:i:s");
	}
	
	function buildTableRef() {
		$buf = "(";
		for ($i= 0; $i < count($this->TABLE); $i++) {
			if ($i > 0) {
				$buf .= ", ";
			}
			$buf .= $this->TABLE[$i];
		}
		$buf .= ")";
		return $buf;
	}
	
	function setData($anews) {
		$this->setID($anews["$this->IDS"]);
		$this->setTitle($anews["$this->TITLE"]);
		$this->setCompetition($anews["$this->COMPETITION"]);
		$this->setStudent($anews["$this->STUDENT"]);
		$this->setClasses($anews["$this->CLASSES"]);
		$this->setReward($anews["$this->REWARD"]);
		$this->setPosition($anews["$this->POSITION"]);
		$this->setDates($anews["$this->DATES"]);
		$this->setContents($anews["$this->CONTENTS"]);
		$this->setFContents($anews["$this->FCONTENTS"]);
		$this->setType($anews["$this->TYPES"]);
		$this->setLastModif($anews["$this->LASTMODIF"]);
		$this->setDeleted($anews["$this->DELETED"]);
	}

	function getData() {
		$buf = "(";
		$buf .= "'" . $this->getID() . "', ";
		$buf .= "'" . $this->getTitle() . "', ";
		$buf .= "'" . $this->getCompetition() . "', ";
		$buf .= "'" . $this->getStudent() . "', ";
		$buf .= "'" . $this->getClasses() . "', ";
		$buf .= "'" . $this->getReward() . "', ";
		$buf .= "'" . $this->getPosition() . "', ";
		$buf .= "'" . $this->getDates() . "', ";
		$buf .= "'" . $this->getContents() . "', ";
		$buf .= "'" . $this->getFContents() . "', ";
		$buf .= "'" . $this->getType() . "', ";
		$buf .= "'" . $this->getLastModif() . "', ";
		$buf .= "'" . $this->isDeleted() . "'";
		$buf .= ")";
		return $buf;
	}

	function getUpdateData() {
		$buf = "";
		$buf .= $this->TABLE[$this->TITLE]. 	"='" . $this->getTitle() . "', ";
		$buf .= $this->TABLE[$this->COMPETITION]."='" . $this->getCompetition() . "', ";
		$buf .= $this->TABLE[$this->STUDENT]. 	"='" . $this->getStudent() . "', ";
		$buf .= $this->TABLE[$this->CLASSES].	"='" . $this->getClasses() . "', ";
		$buf .= $this->TABLE[$this->REWARD]. 	"='" . $this->getReward() . "', ";
		$buf .= $this->TABLE[$this->POSITION]. 	"='" . $this->getPosition() . "', ";
		$buf .= $this->TABLE[$this->DATES]. 	"='" . $this->getDates() . "', ";
		$buf .= $this->TABLE[$this->CONTENTS]. 	"='" . $this->getContents() . "', ";
		$buf .= $this->TABLE[$this->FCONTENTS]. "='" . $this->getFContents() . "', ";
		$buf .= $this->TABLE[$this->TYPES]. 	"='" . $this->getType() . "', ";
		$buf .= $this->TABLE[$this->LASTMODIF].	"='" . $this->getLastModif() . "', ";
		$buf .= $this->TABLE[$this->DELETED]. 	"='" . $this->isDeleted(). "'";
		return $buf;
	}
	
	function addArticle() {
		$exec = $this->connect();
		$this->setLastModif($this->getCurrentDate());
		if ($this->getID() > 0) {
			$uid = $this->getID();
			$data = $this->getUpdateData();
			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
		}
		else {
			$uid = $exec->get_max_number($this->TABLE_NAME, $this->TABLE[$this->IDS]);
			$this->setID($uid);
			$data = $this->getData();
			$exec->add_elements($this->TABLE_NAME, $this->buildTableRef(), $data);
		}
		$this->close();
		return $uid;
	}
	
	function getArticle($id) {
		$ret = 0;
		$exec = $this->connect();
		$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $id);
		if ($elem) {
			$this->setData($elem);
			$ret = 1;
		}
		$this->close();

		return $ret;
	}	
	
	function getRewardString() {
		return ($this->getCompetition()." " .$this->getReward());
	}
	
	function getArticleItem() {
		

		$content = array();
		$content[] = $this->getCompetition();
		$content[] = $this->getStudent();
		$content[] = $this->getClasses();
		$content[] = $this->getReward();
		$content[] = $this->getDates();
		
		$newsitem = array();
		$newsitem[] = $this->getTitle();
		$newsitem[] = $content;
		$newsitem[] = OS_TextToTable($this->getContents(), 0);

		return $newsitem;
	}
	
}
?>
