<?php
class JLPageListClass {

	var $TABLE_NAME    	= "jlpage";
	var $IDS    		= "IDS";
	var $POSITION    	= "POSITION";
	var $TYPE    		= "TYPES";
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

	function getJLPageLists($type) {
		$lists = array();
		$exec = $this->connect();
		
		$cond = $this->TYPE."='" .$type."'";
		$elems =  $exec->get_order_elements_DESC($this->TABLE_NAME, $cond, $this->POSITION);
		//$elems =  $exec->get_order_elements_DESC($this->TABLE_NAME, $cond, $this->IDS);
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$news = new JLPageClass();
				$news->setData($elems[$i]);
				if (!$news->isDeleted()) {
					$lists[] = $news;
				}
			}
		}
		$this->close();
		return $lists;
	}
	
	function getExpoPageLists() {
		$lists = array();
		$exec = $this->connect();
		/* expo type == 4 */
		$cond = $this->TYPE."='4'";
		$elems =  $exec->get_order_elements_DESC($this->TABLE_NAME, $cond, $this->POSITION);
		//$elems =  $exec->get_order_elements_DESC($this->TABLE_NAME, $cond, $this->IDS);
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$news = new JLPageClass();
				$news->setData($elems[$i]);
				if (!$news->isDeleted()) {
					$lists[] = $news;
				}
			}
		}
		$this->close();
		return $lists;
	}
}
?>
