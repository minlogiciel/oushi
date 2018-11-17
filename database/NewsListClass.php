<?php
class NewsListClass {

	var $TABLE_NAME    	= "oushinews";
	var $IDS    		= "IDS";
	var $TYPE    		= "NEWSTYPE";
	var $POSITION    	= "POSITION";
	var $PUBLIE    		= "PUBLIE";
	var $MAINNEWS    	= "MAINNEWS";
	var $TOP5    		= "TOP5";	
	
	var $BASE_OK = 1;
	var $READ_OK = 1;
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

	function getTypeLastNews($type, $nindex) {
		$ret = 0;
		if ($this->READ_OK) {
			$exec = $this->connect();
			$elem = $exec->get_element($this->TABLE_NAME, $this->TYPE, $type, $this->POSITION, $nindex);
			if ($elem) {
				$this->setData($elem);
				$ret = 1;
			}
			$this->close();
		}
		return $ret;
	}
	
	function getLastNewsLists($type, $iskongzi=0) {
		$lists = array();
		if ($this->READ_OK) {
			$exec = $this->connect();
			
			if ($iskongzi > 0) {
				$cond = "KONGZI='" .$iskongzi."'";
			}
			else {
				$cond = $this->TYPE."='" .$type."'";
			}
			$elems =  $exec->get_order_elements_ASC($this->TABLE_NAME, $cond, $this->PUBLIE);
			if ($elems) {
				for ($i = 0; $i < count($elems); $i++) {
					$news = new NewsClass();
					$news->setData($elems[$i]);
					if (!$news->isDeleted()) {
						$lists[] = $news;
					}
				}
			}
			$this->close();
		}
		return $lists;
	}
	
	function resetMainNews() {
		if ($this->READ_OK) {
			$lists = array();
			$exec = $this->connect();
			$cond = $this->MAINNEWS."!='0'";
			$elems =  $exec->get_elements($this->TABLE_NAME, $cond);
			if ($elems) {
				for ($i = 0; $i < count($elems); $i++) {
					$news = new NewsClass();
					$news->setData($elems[$i]);
					$lists[] = $news;
				}
			}
			$exec->close();
			for ($i = 0; $i < count($lists); $i++) {
				$news = $lists[$i];
				$news->setMainnews(0);
				$news->setStars(0);
				$news->updateMainNews();
			}
		}
	}
	
	function getLatestNewsLists($type, $nb) {
		$lists = array();
		if ($this->READ_OK) {
			$exec = $this->connect();
			if ($type == -1) {
					$cond = "1=1";
					$elems =  $exec->get_order_elements_DESC($this->TABLE_NAME, $cond, $this->IDS, 15);
					if ($elems) {
						for ($i = 0; $i < count($elems); $i++) {
							$news = new NewsClass();
							$news->setData($elems[$i]);
							if (!$news->isDeleted()) {
								$lists[] = $news;
							}
						}
					}
			}
			else {
				$cond = $this->TYPE."='" .$type."'";
				$elems =  $exec->get_order_elements_DESC($this->TABLE_NAME, $cond, $this->IDS, $nb);
				if ($elems) {
					for ($i = 0; $i < count($elems); $i++) {
						$news = new NewsClass();
						$news->setData($elems[$i]);
						if (!$news->isDeleted()) {
							$lists[] = $news;
						}
					}
				}
			}
			$this->close();
		}
		return $lists;
	}

	function getNextPrevNewsID($type, $ids) {
		global $FASTNEWS_TOP, $FASTNEWS_ASSO, $FASTNEWS_KZ;
		$lists = array();
		if ($this->READ_OK) {
			if ($type == $FASTNEWS_TOP) {
				$ll = $this->getTopNews();
				$nb = count($ll);
				$previd = 0;
				$nextid = 0;
				for ($i = 0; $i < $nb; $i++) {
					if ($ll[$i]->getID() == $ids) {
						$lists[0] = $previd;
						if ($i < $nb-1) {
							$nextid = $ll[$i+1]->getID();
						}
						$lists[1] = $nextid;
						break;
					}
					$previd = $ll[$i]->getID();
				}
			}
			else {
				$exec = $this->connect();
				if ($type == $FASTNEWS_ASSO || $type == $FASTNEWS_KZ )
					$cond = "KONGZI='" .$type."' AND IDS<'".$ids."'";
				else 
					$cond = $this->TYPE."='" .$type."' AND IDS<'".$ids."'";
				
				$elem =  $exec->get_element_prev($this->TABLE_NAME, $cond);
				if ($elem) {
					$lists[0] = $elem[0];
				}
				else {
					$lists[0] = 0;
				}
				if ($type == $FASTNEWS_ASSO || $type == $FASTNEWS_KZ )
					$cond = "KONGZI='" .$type."' AND IDS>'".$ids."'";
				else 
					$cond = $this->TYPE."='" .$type."' AND IDS>'".$ids."'";
				$elem =  $exec->get_element_1($this->TABLE_NAME, $cond);
				if ($elem) {
					$lists[1] = $elem[0];
				}
				else {
					$lists[1] = 0;
				}
				$this->close();
			}
		}
		return $lists;
	}
	
	function getMainNewsLists($type) {
		$lists = array();
		if ($this->READ_OK) {
			$exec = $this->connect();
			$cond = $this->TYPE."='" .$type."' AND " .$this->MAINNEWS.">0";
			$elems =  $exec->get_order_elements_DESC($this->TABLE_NAME, $cond, $this->MAINNEWS);
			if ($elems) {
				for ($i = 0; $i < count($elems); $i++) {
					$news = new NewsClass();
					$news->setData($elems[$i]);
					if (!$news->isDeleted()) {
						$lists[] = $news;
					}
				}
			}
			$this->close();
		}
		return $lists;
	}
	
	function getTopNews() {
		$lists = array();
		if ($this->READ_OK) {
			$nb = 0;
			$exec = $this->connect();
			$cond = $this->TOP5.">0";
			$elems =  $exec->get_order_elements_DESC($this->TABLE_NAME, $cond, $this->TOP5);
			if ($elems) {
				$nb = count($elems);
				for ($i = 0; $i < $nb; $i++) {
					$news = new NewsClass();
					$news->setData($elems[$i]);
					if (!$news->isDeleted()) {
						$lists[] = $news;
					}
				}
			}
			if ($nb < 5)  {
				$elems =  $exec->get_order_elements_DESC($this->TABLE_NAME, "1=1", $this->IDS, (5-$nb));
				if ($elems) {
					$nb = count($elems);
					for ($i = 0; $i < $nb; $i++) {
						$news = new NewsClass();
						$news->setData($elems[$i]);
						if (!$news->isDeleted()) {
							$lists[] = $news;
						}
					}
				}
			}
			$this->close();
		}
		return $lists;
	}
	function resetTopNews() {
		if ($this->READ_OK) {
			$lists = array();
			$exec = $this->connect();
			$cond = $this->TOP5."!='0'";
			$elems =  $exec->get_elements($this->TABLE_NAME, $cond);
			if ($elems) {
				for ($i = 0; $i < count($elems); $i++) {
					$news = new NewsClass();
					$news->setData($elems[$i]);
					$lists[] = $news;
				}
			}
			$exec->close();
			for ($i = 0; $i < count($lists); $i++) {
				$news = $lists[$i];
				$news->setTop5(0);
				$news->updateTopNews();
			}
		}
	}
	
}
?>
