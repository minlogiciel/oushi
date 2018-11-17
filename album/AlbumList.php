<?php

include ("../database/sql/sql_include.php");
class AlbumList {
	var $IDS_NAME   = "IDS";
	var $TABLE_NAME	= "ALBUMS";
	
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
	
	function getAlbumLists($dates, $groups) {
		$lists = array();

		$exec = $this->connect();

		//$cond = "ANNEE='" .date("Y")."' AND DATES='" .$dates. "'";
		$cond = "DATES='" .$dates. "'";
		if ($groups) {
			$cond .= " AND GROUPS='" .$groups. "'";
		}
		$elems =  $exec->get_order_elements_ASC($this->TABLE_NAME, $cond, "TITLE");
		
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$album = new AlbumClass();
				$album->setData($elems[$i]);
				if (!$album->isDeleted()) {
					$lists[] = $album;
				}
			}
		}
		$this->close();
		return $lists;
	}
	
	function getAlbumDateTitleLists($dates, $title, $groups) {
		$lists = array();

		$exec = $this->connect();

		$cond = "DATES='" .$dates. "' AND TITLE='" .$title. "'";
		//$cond = "ANNEE='" .date("Y")."' AND DATES='" .$dates. "' AND TITLE='" .$title. "'";
		if ($groups) {
			$cond .= " AND GROUPS='" .$groups. "'";
		}
		$elems =  $exec->get_elements($this->TABLE_NAME, $cond);
		
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$album = new AlbumClass();
				$album->setData($elems[$i]);
				if (!$album->isDeleted()) {
					$lists[] = $album;
				}
			}
		}
		$this->close();
		return $lists;
	}
	
	function hasAlbumLists() {
		$ret = 0;
		$exec = $this->connect();

		$cond = "ANNEE='" .date("Y"). "'";
		
		$elems =  $exec->get_order_elements_DESC($this->TABLE_NAME, $cond, "TITLE");
		
		if ($elems) {
			$ret = 1;
		}
		$this->close();
		return $ret;
	}
	
}
?>
