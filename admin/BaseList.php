<?php

include ("../register/HuodongClass.php");
class BaseList {
	var $IDS_NAME    	= "IDS";
	var $REG_TABLE_NAME	= "REG_TABLE";
	
	var $connection	= '';

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
	
	function updateActiveRegisteLists($id, $val) {
		$huodong = new HuodongClass();
		$huodong->updateActive($id, $val);
	}
	
	function getRegisterLists($registerref) {
		$lists = array();

		$exec = $this->connect();
		if ($registerref == -1 || $registerref == "") {
			$sql = "SELECT * FROM REG_TABLE";
		}
		else {
			$sql = "SELECT * FROM REG_TABLE WHERE HDINDEX='$registerref' ORDER BY IDS DESC";
		}
		
		$elems =  $exec->get_baselists($sql);
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$huodong = new HuodongClass();
				$huodong->setData($elems[$i]);
				$lists[] = $huodong;
			}
		}
		$this->close();
		return $lists;
	}
	
	function getRegisterCount($registerref) {
		$nb = 0;
		$exec = $this->connect();
		if ($registerref) {
			$sql = "SELECT * FROM REG_TABLE WHERE HDINDEX='$registerref' ";
			$elems =  $exec->get_baselists($sql);
			if ($elems) {
				$nb = count($elems);
			}
		}
		$this->close();
		return $nb;
	}
}
?>
