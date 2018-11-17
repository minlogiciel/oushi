<?php
class TeacherClass {

	var $TABLE_NAME    	= "OUSHITEACHER";
	var $TABLE  = array(
		"IDS", 
		"NAMES", 
		"TEACHERID", 
		"TITLE", 
		"JIAOCAI", 
		"TYPES", 
		"DATES", 
		"CONTENT", 
		"PATHS", 
		"FILES", 
		"FTYPE", 
		"LASTMODIF", 
		"REMARKES", 
		"DELETED", 
	);

	var $IDS		= 0;
	var $NAMES     	= 1;
	var $TEACHERID  = 2;
	var $TITLE    	= 3;
	var $JIAOCAI    = 4;
	var $TYPES   	= 5;
	var $DATES   	= 6;
	var $CONTENT  	= 7;
	var $PATHS  	= 8;
	var $FILES  	= 9;
	var $FTYPE  	= 10;
	var $LASTMODIF 	= 11;
	var $REMARKES   = 12;
	var $DELETED    = 13;


	var $_id         	= 0;
	var $_name         	= "";
	var $_teacherid    	= 0;
	var $_title     	= "";
	var $_jiaocai     	= "";
	var $_types        	= "";
	var $_dates       	= "";
	var $_content     	= "";
	var $_paths    		= "";
	var $_files    		= "";
	var $_ftype    		= "";
	var $_lastmodif    	= "";
	var $_remarkes    	= "";
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

	
	function replace($str) {
		$newstr = $str;
		if ($str ) {
			if (strstr($str, "&quot;") || strstr($str, "&#039;")) {
				$newstr = str_replace("&quot;", "\"", $newstr);
				$newstr = str_replace("&#039;", "'",  $newstr);
			}
			else {
				//$newstr = htmlspecialchars($str, ENT_NOQUOTES);
				//$newstr = htmlspecialchars($str, ENT_QUOTES);
				$newstr = str_replace('\"', "&quot;", $newstr);
				$newstr = str_replace("\'", "&#039;", $newstr);
				$newstr = str_replace("'", "&#039;", $newstr);
			}
		}
		return $newstr;
	}
	
	function getID() {
		return $this->_id;
	}
	function setID($id) {
		$this->_id = $id;
	}

	function getName() {
		return ($this->_name);
	}
	function setName($name) {
		$this->_name = $this->replace($name);
	}
	function getTeacherID() {
		return $this->_teacherid;
	}
	function setTeacherID($id) {
		$this->_teacherid = $id;
	}
	
	function getTitle() {
		return  $this->_title;
	}
	function setTitle($title) {
		$this->_title = $title;
	}
	function getJiaocai() {
		return $this->_jiaocai;
	}
	function setJiaocai($jiaocai) {
		$this->_jiaocai = $jiaocai;
	}

	function getTypes() {
		return $this->_types;
	}
	function setTypes($types) {
		$this->_types = $types;
	}

	function getDates() {
		return $this->_dates;
	}
	function setDates($dates) {
		$this->_dates = $dates;
	}

	function getContent() {
		return $this->_content;
	}
	function setContent($content) {
		$this->_content = $content;
	}

	function getPaths() {
		return $this->_paths;
	}
	function setPaths($paths) {
		$this->_paths = $paths;
	}
	function getFiles() {
		return $this->_files;
	}
	function setFiles($files) {
		$this->_files = $files;
	}
	function getFType() {
		return $this->_ftype;
	}
	function setFType($ftype) {
		$this->_ftype = $ftype;
	}
	
	function getLastModif() {
		return $this->_lastmodif;
	}
	function setLastModif($lastmodif) {
		$this->_lastmodif = $lastmodif;
	}
	function getRemarkes() {
		return $this->_remarkes;
	}
	function setRemarkes($remarkes) {
		$this->_remarkes = $remarkes;
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
	
	function setData($elem) {
		$this->setID($elem["$this->IDS"]);
		$this->setName($elem["$this->NAMES"]);
		$this->setTeacherID($elem["$this->TEACHERID"]);
		$this->setTitle($elem["$this->TITLE"]);
		$this->setJiaocai($elem["$this->JIAOCAI"]);
		$this->setTypes($elem["$this->TYPES"]);
		$this->setDates($elem["$this->DATES"]);
		$this->setContent($elem["$this->CONTENT"]);
		$this->setPaths($elem["$this->PATHS"]);
		$this->setFiles($elem["$this->FILES"]);
		$this->setFType($elem["$this->FTYPE"]);
		$this->setLastModif($elem["$this->LASTMODIF"]);
		$this->setRemarkes($elem["$this->REMARKES"]);
		$this->setDeleted($elem["$this->DELETED"]);
	}

	function getData() {
		$buf = "(";
		$buf .= "'" . $this->getID() . "', ";
		$buf .= "'" . $this->getName() . "', ";
		$buf .= "'" . $this->getTeacherID() . "', ";
		$buf .= "'" . $this->getTitle() . "', ";
		$buf .= "'" . $this->getJiaocai() . "', ";
		$buf .= "'" . $this->getTypes() . "', ";
		$buf .= "'" . $this->getDates() . "', ";
		$buf .= "'" . $this->getContent() . "', ";
		$buf .= "'" . $this->getPaths() . "', ";
		$buf .= "'" . $this->getFiles() . "', ";
		$buf .= "'" . $this->getFType() . "', ";
		$buf .= "'" . $this->getLastModif() . "', ";
		$buf .= "'" . $this->getRemarkes() . "', ";
		$buf .= "'" . $this->isDeleted() . "'";
		$buf .= ")";
		return $buf;
	}

	function getUpdateData() {
		$buf = "";
		$buf .= $this->TABLE[$this->NAMES]. 	"='" . $this->getName().		"', ";
		$buf .= $this->TABLE[$this->TEACHERID].	"='" . $this->getTeacherID() . 	"', ";
		$buf .= $this->TABLE[$this->TITLE]. 	"='" . $this->getTitle().		"', ";
		$buf .= $this->TABLE[$this->JIAOCAI]. 	"='" . $this->getJiaocai() . 	"', ";
		$buf .= $this->TABLE[$this->TYPES]. 	"='" . $this->getTypes() . 		"', ";
		$buf .= $this->TABLE[$this->DATES]. 	"='" . $this->getDates() . 		"', ";
		$buf .= $this->TABLE[$this->CONTENT]. 	"='" . $this->getContent() . 	"', ";
		$buf .= $this->TABLE[$this->PATHS]. 	"='" . $this->getPaths(). 		"', ";
		$buf .= $this->TABLE[$this->FILES]. 	"='" . $this->getFiles(). 		"', ";
		$buf .= $this->TABLE[$this->FTYPE]. 	"='" . $this->getFType(). 		"', ";
		$buf .= $this->TABLE[$this->LASTMODIF].	"='" . $this->getLastModif() . 	"', ";
		$buf .= $this->TABLE[$this->REMARKES].  "='" . $this->getRemarkes() . 	"', ";
		$buf .= $this->TABLE[$this->DELETED]. 	"='" . $this->isDeleted(). 		"'";
		return $buf;
	}
	
	function addTeacherJiaoliu() {
		$ret = 1;
		$exec = $this->connect();
		$this->setLastModif($this->getCurrentDate());
		if ($this->getID() > 0) {
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
		return $ret;
	}
	function updateJiaoliu() {
		$exec = $this->connect();
		$this->setLastModif($this->getCurrentDate());
		$data = $this->getUpdateData();
		$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
		$this->close();
	}
	function deleteJiaoliu($del) {
		$exec = $this->connect();
		$this->setDeleted($del);
		$exec->update_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $this->TABLE[$this->DELETED], $del);
		$this->close();

	}
	
	function getTeacherJiaoliu($ids) {
		$ret = 0;
		$exec = $this->connect();
		$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $ids);
		if ($elem) {
			$this->setData($elem);
			$ret = 1;
		}
		$this->close();
		return $ret;
	}
	
	function getAllJiaoliu($teacher, $withdeleted) {
		$lists = array();
		$exec = $this->connect();
		$cond = "(NAMES='" .$teacher."' OR TEACHERID='" .$teacher."') AND DELETED!=1 ORDER BY IDS DESC" ;
		$elems =  $exec->getElements($this->TABLE_NAME, $cond);
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$jiaoliu = new TeacherClass();
				$jiaoliu->setData($elems[$i]);

				if (!$jiaoliu->isDeleted()) {
					$lists[] = $jiaoliu;
				}
			}
		}
		$this->close();
		return $lists;
	}
	
}
?>
