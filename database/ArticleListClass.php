<?php
class ArticleListClass {

	var $TABLE_NAME    	= "starticles";
	var $IDS    		= "IDS";
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

	function getArticleListsss($nb=0) {
		$lists = array();
		$exec = $this->connect();
		$elems =  $exec->get_order_elements_DESC($this->TABLE_NAME, 1, $this->IDS);
		if ($elems) {
			if ($nb == 0) {
				$n_elem =  count($elems);
			}
			else {
				$n_elem = $nb;
			}
			for ($i = 0; $i < $n_elem; $i++) {
				$works = new ArticleClass();
				$works->setData($elems[$i]);
				if (!$works->isDeleted()) {
					$lists[] = $works;
				}
			}
		}
		$this->close();
		return $lists;
	}
	
	function getArticleTypeOrderLists($nb=0) {
		$lists = array();
		$exec = $this->connect();

		$cond = "1=1 ORDER BY COMPETITION DESC, POSITION ASC";
		
		$elems =  $exec->getElements($this->TABLE_NAME, $cond);
		if ($elems) {
			$n_elem = ($nb)?$nb:count($elems);
			for ($i = 0; $i < $n_elem; $i++) {
				$works = new ArticleClass();
				$works->setData($elems[$i]);
				if (!$works->isDeleted()) {
					$lists[] = $works;
				}
			}
		}
		$this->close();
		return $lists;
	}	
	function getArticleLists($nb=0) {
		return $this->getArticleTypeOrderLists($nb);
	}
	
	function getNextPrevWorks($ids) {
		$lists = array("", "", "");
		if ($ids > 0) {
			$elems = $this->getArticleTypeOrderLists();
			$n_elem = count($elems);
			for ($i = 0; $i < $n_elem; $i++) {
				if ($elems[$i]->getID() == $ids) {
					if ($i > 0) {
						$lists[0] = $elems[$i-1];
					}
					$lists[1] = $elems[$i];
					if (($i+1) < $n_elem) {
						$lists[2] = $elems[$i+1];
					}
					break;
				}
			}
		}
		else {
			$elems = $this->getArticleTypeOrderLists(2);
			$lists[1] = $elems[0];
			$lists[2] = $elems[1];
		}
		$this->close();
		return $lists;
	}
	
}
?>
