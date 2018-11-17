<?php
class NewsClass {

	var $TABLE_NAME    	= "oushinews";

	var $TABLE  = array(
		"IDS", 
		"TITLE", 
		"FTITLE", 
		"PUBLIE", 
		"STITLE", 
		"FSTITLE", 
		"RESUME", 
		"FRESUME", 
		"CONTENTS", 
		"FCONTENTS", 
		"MAINNEWS", 
		"STARS", 
		"KONGZI", 
		"POSITION", 
		"LASTMODIF", 
		"NEWSTYPE",
		"TOP5",
		"TOPPHOTOC",
		"TOPPHOTOF",
		"LINKC", 
		"LINKF", 
		"DELETED", 
	);

	var $IDS		= 0;
	var $TITLE     	= 1;
	var $FTITLE     = 2;
	var $PUBLIE    	= 3;
	var $STITLE    	= 4;
	var $FSTITLE    = 5;
	var $RESUME   	= 6;
	var $FRESUME  	= 7;
	var $CONTENTS  	= 8;
	var $FCONTENTS  = 9;
	var $MAINNEWS  	= 10;
	var $STARS  	= 11;
	var $KONGZI  	= 12;
	var $POSITION  	= 13;
	var $LASTMODIF 	= 14;
	var $TYPE      	= 15;
	var $TOP5      	= 16;
	var $TOPPHOTOC 	= 17;
	var $TOPPHOTOF 	= 18;
	var $LINKC  	= 19;
	var $LINKF  	= 20;
	var $DELETED    = 21;


	var $_id         	= 0;
	var $_title         = "";
	var $_ftitle        = "";
	var $_publie     	= "";
	var $_stitle        = "";
	var $_fstitle       = "";
	var $_resume     	= "";
	var $_fresume    	= "";
	var $_contents 		= "";
	var $_fcontents		= "";
	var $_mainnews      = 0;
	var $_stars      	= 0;
	var $_kongzi      	= 0;
	var $_position      = 0;
	var $_lastmodif    	= "";
	var $_type     		= 0;
	var $_top5     		= 0;
	var $_topphotoc		= "";
	var $_topphotof		= "";
	var $_linkc			= "";
	var $_linkf			= "";
	var $_deleted		= 0;

	var $connection		= '';
	
	var $BASE_OK = 1;
	var $READ_OK = 1;
	
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

	function getResume() {
		return $this->_resume;
	}
	function setResume($resume) {
		$this->_resume = $resume;
	}

	function getFResume() {
		return $this->_fresume;
	}
	function setFResume($resume) {
		$this->_fresume = $resume;
	}
	
	function getResumeString($str) {
		$nb_str = 120;
		$texte = "";
		foreach(preg_split("/((\r?\n)|(\r\n?))/", $str) as $line){
 			if (strstr($line, "<IMG")) {
				continue;
			}
			else if (strstr($line,"<h3>") || strstr($line,"<h5>")) {
				$line = str_replace("h3", "b", $line);
				$line = str_replace("h5", "b", $line);
				$texte .=  "<p>".$line."</p>";
			}
			else {
				$texte .=  "<p>".$line."</p>";
			}
			$len = mb_strlen($texte);
			if ($len > $nb_str) {
				break;
			}
		}
		$texte .=  "<p> ...... </p>";
		return $texte;
	} 
	
	function getContentResume() {
		return $this->getResumeString($this->_contents);
	}
	function getFContentResume() {
		return $this->getResumeString($this->_fcontents);

	}
	
	function getPublie() {
		if (!$this->_publie) {
			$this->_publie = date("Y-m-d");
		}
		return $this->_publie;
	}
	function setPublie($dates) {
		if ($dates && strlen($dates) > 7) {
			$this->_publie = getFormatDate($dates);
		}
		else {
			$this->_publie = date("Y-m-d");
		}
	}

	function getFPublie() {
		return getFrenchFormatDate($this->_publie);
	}
	function getCPublie() {
		return getChineseFormatDate($this->_publie);
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
	function getMainnews() {
		return $this->_mainnews;
	}
	function setMainnews($mainnews) {
		$this->_mainnews = $mainnews;
	}
	function getStars() {
		return $this->_stars;
	}
	function setStars($stars) {
		$this->_stars = $stars;
	}
	function getKongzi() {
		return $this->_kongzi;
	}
	function setKongzi($kongzi) {
		$this->_kongzi = $kongzi;
	}
	function getPosition() {
		return $this->_position;
	}
	function setPosition($position) {
		$this->_position = $position;
	}
	function getTop5() {
		return $this->_top5;
	}
	function setTop5($top5) {
		$this->_top5 = $top5;
	}
	function getTopPhotoC() {
		return $this->_topphotoc;
	}
	function setTopPhotoC($photo) {
		$this->_topphotoc = $photo;
	}
	function getTopPhotoF() {
		return $this->_topphotof;
	}
	function setTopPhotoF($photo) {
		$this->_topphotof = $photo;
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

	function getLinkC() {
		return $this->_linkc;
	}
	function setLinkC($link) {
		$this->_linkc = $link;
	}
	function getLinkF() {
		return $this->_linkf;
	}
	function setLinkF($link) {
		$this->_linkf = $link;
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
		$this->setFTitle($anews["$this->FTITLE"]);
		$this->setSTitle($anews["$this->STITLE"]);
		$this->setFSTitle($anews["$this->FSTITLE"]);
		$this->setResume($anews["$this->RESUME"]);
		$this->setFResume($anews["$this->FRESUME"]);
		$this->setPublie($anews["$this->PUBLIE"]);
		$this->setTop5($anews["$this->TOP5"]);
		$this->setLastModif($anews["$this->LASTMODIF"]);
		$this->setMainnews($anews["$this->MAINNEWS"]);
		$this->setStars($anews["$this->STARS"]);
		$this->setKongzi($anews["$this->KONGZI"]);
		$this->setPosition($anews["$this->POSITION"]);
		$this->setType($anews["$this->TYPE"]);
		$this->setContents($anews["$this->CONTENTS"]);
		$this->setFContents($anews["$this->FCONTENTS"]);
		$this->setTopPhotoC($anews["$this->TOPPHOTOC"]);
		$this->setTopPhotoF($anews["$this->TOPPHOTOF"]);
		$this->setLinkC($anews["$this->LINKC"]);
		$this->setLinkF($anews["$this->LINKF"]);
		$this->setDeleted($anews["$this->DELETED"]);
	}

	function getData() {
		$buf = "(";
		$buf .= "'" . $this->getID() . "', ";
		$buf .= "'" . $this->getTitle() . "', ";
		$buf .= "'" . $this->getFTitle() . "', ";
		$buf .= "'" . $this->getPublie() . "', ";
		$buf .= "'" . $this->getSTitle() . "', ";
		$buf .= "'" . $this->getFSTitle() . "', ";
		$buf .= "'" . $this->getResume() . "', ";
		$buf .= "'" . $this->getFResume() . "', ";
		$buf .= "'" . $this->getContents() . "', ";
		$buf .= "'" . $this->getFContents() . "', ";
		$buf .= "'" . $this->getMainnews() . "', ";
		$buf .= "'" . $this->getStars() . "', ";
		$buf .= "'" . $this->getKongzi() . "', ";
		$buf .= "'" . $this->getPosition() . "', ";
		$buf .= "'" . $this->getLastModif() . "', ";
		$buf .= "'" . $this->getType() . "', ";
		$buf .= "'" . $this->getTop5() . "', ";
		$buf .= "'" . $this->getTopPhotoC() . "', ";
		$buf .= "'" . $this->getTopPhotoF() . "', ";
		$buf .= "'" . $this->getLinkC() . "', ";
		$buf .= "'" . $this->getLinkF() . "', ";
		$buf .= "'" . $this->isDeleted() . "'";
		$buf .= ")";
		return $buf;
	}

	function getUpdateData() {
		$buf = "";
		$buf .= $this->TABLE[$this->TITLE]. 	"='" . $this->getTitle() . "', ";
		$buf .= $this->TABLE[$this->FTITLE]. 	"='" . $this->getFTitle() . "', ";
		$buf .= $this->TABLE[$this->PUBLIE]. 	"='" . $this->getPublie() . "', ";
		$buf .= $this->TABLE[$this->KONGZI]. 	"='" . $this->getKongzi() . "', ";
		$buf .= $this->TABLE[$this->STITLE]. 	"='" . $this->getSTitle() . "', ";
		$buf .= $this->TABLE[$this->FSTITLE]. 	"='" . $this->getFSTitle() . "', ";
		$buf .= $this->TABLE[$this->RESUME]. 	"='" . $this->getResume() . "', ";
		$buf .= $this->TABLE[$this->FRESUME]. 	"='" . $this->getFResume() . "', ";
		$buf .= $this->TABLE[$this->CONTENTS]. 	"='" . $this->getContents() . "', ";
		$buf .= $this->TABLE[$this->FCONTENTS]. "='" . $this->getFContents() . "', ";
		$buf .= $this->TABLE[$this->LASTMODIF].	"='" . $this->getLastModif() . "', ";
		$buf .= $this->TABLE[$this->TYPE]. 		"='" . $this->getType() . "', ";
		$buf .= $this->TABLE[$this->DELETED]. 	"='" . $this->isDeleted(). "'";
		return $buf;
	}

	function getUpdateLinkData() {
		$buf = "";
		$buf .= $this->TABLE[$this->LASTMODIF].	"='" . $this->getLastModif() . "', ";
		$buf .= $this->TABLE[$this->LINKC]. "='" . $this->getLinkC() . "', ";
		$buf .= $this->TABLE[$this->LINKF]. "='" . $this->getLinkF(). "'";
		return $buf;
	}
	
	function getUpdateTopData() {
		$buf = "";
		$buf .= $this->TABLE[$this->LASTMODIF].	"='" . $this->getLastModif() . "', ";
		$buf .= $this->TABLE[$this->TOP5]. 		"='" . $this->getTop5() . "', ";
		$buf .= $this->TABLE[$this->TOPPHOTOC]. "='" . $this->getTopPhotoC() . "', ";
		$buf .= $this->TABLE[$this->TOPPHOTOF]. "='" . $this->getTopPhotoF(). "'";
		return $buf;
	}
	function getUpdateMainnewsData() {
		$buf = "";
		$buf .= $this->TABLE[$this->LASTMODIF].	"='" . $this->getLastModif() . "', ";
		$buf .= $this->TABLE[$this->MAINNEWS]. 	"='" . $this->getMainnews()  . "', ";
		$buf .= $this->TABLE[$this->STARS]. 	"='" . $this->getStars()  . "'";
		return $buf;
	}

	function backup() {
		$nc = new NewsClass();
		$nc->getLastNews($this->getID());
		$nc->setID(100);
		$this->setID(100);
		
		$source = "INSERT INTO " .$this->TABLE_NAME. " " .$this->buildTableRef(). " VALUES \n";
		$source .= $this->getData(). ";\n";
		
		$encoding = mb_detect_encoding( $source, "auto" );
		
		// convert the string to the target encoding
    	$target = "\xEF\xBB\xBF" .mb_convert_encoding($source, "GB2312", $encoding); 
		
		$fname = "../database/imported/oushinews_".$this->getType()."_".$this->getID().".sql";
		$fp = fopen($fname, "w");
    	fwrite($fp, $target);
		fclose($fp);
	}
	
	function updateNewsLink() {
		if ($this->BASE_OK) {
			$exec = $this->connect();
			$this->setLastModif($this->getCurrentDate());
			$data = $this->getUpdateLinkData();
			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
			$this->close();
		}
	}	
	
	function updateTopNews() {
		if ($this->BASE_OK) {
			$exec = $this->connect();
			$this->setLastModif($this->getCurrentDate());
			$data = $this->getUpdateTopData();
			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
			$this->close();
		}
	}	
	function updateMainNews() {
		if ($this->BASE_OK) {
			$exec = $this->connect();
			$this->setLastModif($this->getCurrentDate());
			$data = $this->getUpdateMainnewsData();
			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
			$this->close();
		}
	}	
	
	function deleteLastNews($del) {
		if ($this->BASE_OK) {
			$exec = $this->connect();
			$this->setDeleted($del);
			$exec->update_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $this->TABLE[$this->DELETED], $del);
			$this->close();
		}
	}
	
	function addLastNews() {
		if ($this->BASE_OK) {
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
		$this->backup();
	}
	
	function getLastNews($id) {
		$ret = 0;
		if ($this->READ_OK) {
			$exec = $this->connect();
			$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $id);
			if ($elem) {
				$this->setData($elem);
				$ret = 1;
			}
			$this->close();
		}
		return $ret;
	}

	function getNewsItem() {
		$newsitem = array();

		$newsitem[] = $this->getTitle();
		$newsitem[] = $this->getResume();
		$newsitem[] = $this->getSTitle();
		$newsitem[] = $this->getCPublie();
		$newsitem[] = array();
		$newsitem[] = OS_TextToTable($this->getContents(), 0);
		
		$fnews = array();
		$fnews[] = $this->getFTitle();
		$fnews[] = $this->getFResume();
		$fnews[] = $this->getFSTitle();
		$fnews[] = $this->getFPublie();
		$fnews[] = array();
		$fnews[] = OS_TextToTable($this->getFContents(), 0);
		$newsitem[] = $fnews;
		return $newsitem;
	}

	function getNews($newstype, $nindex, $ishome) {
		global $FASTNEWS_JY,  $FASTNEWS_JL,  $FASTNEWS_WY, $FASTNEWS_ASSO, $FASTNEWS_KZ, $FASTNEWS_TOP,  
		$JY_NEWS, 		$JL_NEWS, 		$WY_NEWS, 		$ASSO_NEWS, 
		$HOME_JY_NEWS, 	$HOME_JL_NEWS, 	$HOME_YL_NEWS, 	$HOME_ASSO_NEWS, $TOPPHOTOS;
		$newsitem = "";
		if ($this->getLastNews($nindex)) {
			$newsitem = $this->getNewsItem();
		}
		else {
			if ($newstype == $FASTNEWS_JY) {
				if ($ishome)
					$newsitem = $HOME_JY_NEWS[$nindex]; 	
				else 
					$newsitem = $JY_NEWS[$nindex]; 	
			}
			else if ($newstype == $FASTNEWS_JL) {
				if ($ishome)
					$newsitem = $HOME_JL_NEWS[$nindex]; 	
				else 
					$newsitem = $JL_NEWS[$nindex]; 
			}
			else if ($newstype == $FASTNEWS_WY) {
				if ($ishome)
					$newsitem = $HOME_YL_NEWS[$nindex]; 	
				else 
					$newsitem = $WY_NEWS[$nindex]; 
			}
			else if ($newstype == $FASTNEWS_ASSO) {
				if ($ishome)
					$newsitem = $HOME_ASSO_NEWS[$nindex]; 	
				else 
					$newsitem = $ASSO_NEWS[$nindex]; 
			}
			else if ($newstype == $FASTNEWS_TOP) {
				$newsitem = $TOPPHOTOS[$nindex][0]; 
			}
		}
		return $newsitem;
	}
	
	
	function getNewsMaxNumber() {
		$exec = $this->connect();
		$ret = $exec->get_max_number($this->TABLE_NAME, $this->TABLE[$this->IDS]);
		$this->close();
		return $ret;
	}
	
}
?>
