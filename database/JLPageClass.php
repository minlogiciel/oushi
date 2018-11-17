<?php
class JLPageClass {

	var $TABLE_NAME    	= "jlpage";

	var $TABLE  = array(
		"IDS", 
		"TITLE", 
		"FTITLE", 
		"STITLE", 
		"FSTITLE", 
		"CONTENTS", 
		"FCONTENTS", 
		"LASTMODIF", 
		"TYPES",
		"PHOTOC",
		"PHOTOF",
		"POSITION",
		"PHOTOS",
		"SPHOTOS",
		"REMARKC",
		"REMARKF",
		"DELETED", 
	);

	var $IDS		= 0;
	var $TITLE     	= 1;
	var $FTITLE     = 2;
	var $STITLE    	= 3;
	var $FSTITLE    = 4;
	var $CONTENTS  	= 5;
	var $FCONTENTS  = 6;
	var $LASTMODIF 	= 7;
	var $TYPE      	= 8;
	var $PHOTOC 	= 9;
	var $PHOTOF 	= 10;
	var $POSITION 	= 11;
	var $PHOTOS 	= 12;
	var $SPHOTOS 	= 13;
	var $REMARKC 	= 14;
	var $REMARKF 	= 15;
	var $DELETED    = 16;


	var $_id         	= 0;
	var $_title         = "";
	var $_ftitle        = "";
	var $_stitle        = "";
	var $_fstitle       = "";
	var $_contents 		= "";
	var $_fcontents		= "";
	var $_type     		= 0;
	var $_photoc		= "";
	var $_photof		= "";
	var $_position		= 0;
	var $_photos		= "";
	var $_sphotos		= "";
	var $_remarkc		= "";
	var $_remarkf		= "";
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
	function getFTitle() {
		return $this->_ftitle;
	}
	function setFTitle($title) {
		$this->_ftitle = $title;
	}
	
	function getSTitle() {
		return  $this->_stitle;
	}
	function setSTitle($title) {
		$this->_stitle = $title;
	}

	function getFSTitle() {
		return $this->_fstitle;
	}
	function setFSTitle($title) {
		$this->_fstitle = $title;
	}
	
	function getType() {
		return $this->_type;
	}
	function setType($type) {
		$this->_type = $type;
	}
	function getLastModif() {
		return $this->_lastmodif;
	}
	function setLastModif($lastmodif) {
		$this->_lastmodif = $lastmodif;
	}
	function getPhotoC() {
		return $this->_photoc;
	}
	function setPhotoC($photo) {
		$this->_photoc = $photo;
	}
	function getPhotoF() {
		return $this->_photof;
	}
	function setPhotoF($photo) {
		$this->_photof = $photo;
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

	function getPhotos() {
		return $this->_photos;
	}
	function setPhotos($photos) {
		$this->_photos = $photos;
	}
	function getSPhotos() {
		return $this->_sphotos;
	}
	function setSPhotos($photos) {
		$this->_sphotos = $photos;
	}
	function getRemarkC() {
		return $this->_remarkc;
	}
	function setRemarkC($remark) {
		$this->_remarkc = $remark;
	}
	function getRemarkF() {
		return $this->_remarkf;
	}
	function setRemarkF($remark) {
		$this->_remarkf = $remark;
	}

	function getRelativePhotoList() {
		$lists = array();
		if ($this->_photos) {
			$lphoto = explode(";", $this->_photos);
			$lsphoto = explode(";", $this->_sphotos);
			$lremarkc =  explode(";", $this->_remarkc);
			$lremarkf =  explode(";", $this->_remarkf);
			for ($i = 0; $i < count($lphoto); $i++) {
				$lists[] = array($lsphoto[$i], $lphoto[$i], $lremarkc[$i], $lremarkf[$i]);
			}
		}
		return $lists;
	}

	function isDeleted() {
		return $this->_deleted;
	}
	function setDeleted($deleted) {
		$this->_deleted = $deleted;
	}
	function getPosition() {
		return $this->_position;
	}
	function setPosition($p) {
		$this->_position = $p;
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
		$this->setFTitle($anews["$this->FTITLE"]);
		$this->setSTitle($anews["$this->STITLE"]);
		$this->setFSTitle($anews["$this->FSTITLE"]);
		$this->setLastModif($anews["$this->LASTMODIF"]);
		$this->setType($anews["$this->TYPE"]);
		$this->setContents($anews["$this->CONTENTS"]);
		$this->setFContents($anews["$this->FCONTENTS"]);
		$this->setPhotoC($anews["$this->PHOTOC"]);
		$this->setPhotoF($anews["$this->PHOTOF"]);
		$this->setPosition($anews["$this->POSITION"]);
		$this->setPhotos($anews["$this->PHOTOS"]);
		$this->setSPhotos($anews["$this->SPHOTOS"]);
		$this->setRemarkC($anews["$this->REMARKC"]);
		$this->setRemarkF($anews["$this->REMARKF"]);
		$this->setDeleted($anews["$this->DELETED"]);
	}

	function getData() {
		$buf = "(";
		$buf .= "'" . $this->getID() . "', ";
		$buf .= "'" . $this->getTitle() . "', ";
		$buf .= "'" . $this->getFTitle() . "', ";
		$buf .= "'" . $this->getSTitle() . "', ";
		$buf .= "'" . $this->getFSTitle() . "', ";
		$buf .= "'" . $this->getContents() . "', ";
		$buf .= "'" . $this->getFContents() . "', ";
		$buf .= "'" . $this->getLastModif() . "', ";
		$buf .= "'" . $this->getType() . "', ";
		$buf .= "'" . $this->getPhotoC() . "', ";
		$buf .= "'" . $this->getPhotoF() . "', ";
		$buf .= "'" . $this->getPosition() . "', ";
		$buf .= "'" . $this->getPhotos() . "', ";
		$buf .= "'" . $this->getSPhotos() . "', ";
		$buf .= "'" . $this->getRemarkC() . "', ";
		$buf .= "'" . $this->getRemarkF() . "', ";
		$buf .= "'" . $this->isDeleted() . "'";
		$buf .= ")";
		return $buf;
	}

	function getUpdateData() {
		$buf = "";
		$buf .= $this->TABLE[$this->TITLE]. 	"='" . $this->getTitle() . "', ";
		$buf .= $this->TABLE[$this->FTITLE]. 	"='" . $this->getFTitle() . "', ";
		$buf .= $this->TABLE[$this->STITLE]. 	"='" . $this->getSTitle() . "', ";
		$buf .= $this->TABLE[$this->FSTITLE]. 	"='" . $this->getFSTitle() . "', ";
		$buf .= $this->TABLE[$this->CONTENTS]. 	"='" . $this->getContents() . "', ";
		$buf .= $this->TABLE[$this->FCONTENTS]. "='" . $this->getFContents() . "', ";
		$buf .= $this->TABLE[$this->LASTMODIF].	"='" . $this->getLastModif() . "', ";
		$buf .= $this->TABLE[$this->POSITION].	"='" . $this->getPosition() . "', ";
		$buf .= $this->TABLE[$this->TYPE]. 		"='" . $this->getType() . "', ";
		$buf .= $this->TABLE[$this->PHOTOC]. 	"='" . $this->getPhotoC() . "', ";
		$buf .= $this->TABLE[$this->PHOTOF].	"='" . $this->getPhotoF() . "', ";
		$buf .= $this->TABLE[$this->DELETED]. 	"='" . $this->isDeleted(). "'";
		return $buf;
	}
	
	function deleteJLPage($del) {
		if ($this->BASE_OK) {
			$exec = $this->connect();
			$this->setDeleted($del);
			$exec->update_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $this->TABLE[$this->DELETED], $del);
			$this->close();
		}
	}
	
	function addJLPage() {
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
	}
	
	function getUpdatePhotos() {
		$buf = "";
		$buf .= $this->TABLE[$this->LASTMODIF].	"='" . $this->getLastModif() . "', ";
		$buf .= $this->TABLE[$this->PHOTOS]. 	"='" . $this->getPhotos() . "', ";
		$buf .= $this->TABLE[$this->SPHOTOS]. 	"='" . $this->getSPhotos() . "', ";
		$buf .= $this->TABLE[$this->REMARKC].	"='" . $this->getRemarkC() . "', ";
		$buf .= $this->TABLE[$this->REMARKF].	"='" . $this->getRemarkF() . "'";
		return $buf;
	}
	function updateJLPhotos() {
		$exec = $this->connect();
		$this->setLastModif($this->getCurrentDate());
		$data = $this->getUpdatePhotos();
		$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
		$this->close();
	}
	
	function getJLPageItem() {
		$newsitem = array();

		$newsitem[] = $this->getTitle();
		$newsitem[] = array($this->getPhotoC(), $this->getSTitle(), "");
		$newsitem[] = OS_TextToTable($this->getContents(), 0);
		$lphotos = $this->getRelativePhotoList(); 
		$newsitem[] = $lphotos; 
		$fnews = array();
		$fnews[] = $this->getFTitle();
		$fnews[] =  array($this->getPhotoF(), $this->getFSTitle(), "");
		$fnews[] = OS_TextToTable($this->getFContents(), 0);
		$fnews[] = $lphotos;
		$newsitem[] = $fnews;
		$newsitem[] = 1;
		return $newsitem;
	}
	
	function getJLPage($id) {
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
	
	function getJLPageNumber() {
		$ret = 0;
		$exec = $this->connect();
		$ret= $exec->get_max_number($this->TABLE_NAME, $this->TABLE[$this->IDS]);
		
		$this->close();
		
		return $ret;
	}
}
?>
