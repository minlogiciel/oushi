<?php
class TeacherListClass {
	var $TABLE_NAME    	= "OUSHIADMINUSER";
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

	function getAllTeachers() {
		$lists = array();
		$exec = $this->connect();

		$cond = "LEVEL=1 ORDER BY IDS ASC";
		
		$elems =  $exec->getElements($this->TABLE_NAME, $cond);
		if ($elems) {
			$n_elem = count($elems);
			for ($i = 0; $i < $n_elem; $i++) {
				$teacher = new AdminUserClass();
				$teacher->setData($elems[$i]);
				if (!$teacher->isDeleted()) {
					$lists[] = $teacher;
				}
			}
		}
		$this->close();
		return $lists;
	}	
	
	function getTeacherJiaoliuList($tn, $jc, $ty, $wj, $an, $sort1, $sort2, $sort3, $ordre, $n_start, $nb) {
		$addsort = 0;
		$lists = array();
		$exec = $this->connect();
		$cond = "";
		if ($tn) {
			$cond .= "(NAMES='".$tn."' OR TEACHERID='".$tn."') AND ";
		}
		if ($jc) {
			$cond .= "JIAOCAI='".$jc."' AND ";
		}
		if ($ty) {
			$cond .= "TYPES='".$ty."' AND ";
		}
		if ($wj) {
			$cond .= "FTYPE='".$wj."' AND ";
		}
		if ($an) {
			$cond  .= "DATES LIKE'%" .$an. 	"%' AND " ;
		}
		$cond .= "DELETED!=1 ORDER BY ";
		if ($ordre)
			$oo = $ordre;
		else 
			$oo = "ASC";
		if ($sort1) {
			$cond .= $sort1. " ".$oo;
			$addsort = 1;
		}
		if ($sort2) {
			if ($addsort)
				$cond .= ", ";
			$cond .= $sort2. " ".$oo;
			$addsort = 1;
		}
		if ($sort3) {
			if ($addsort)
				$cond .= ", ";
			$cond .= $sort3. " ".$oo;
			$addsort = 1;
		}
		if ($addsort == 0) {
			$cond .= "DATES DESC";
		}
		$elems =  $exec->getElements("OUSHITEACHER", $cond);
		
		if ($elems) {
			$nb_doc = count($elems);
			$lists[] = $nb_doc;
			if ($n_start + $nb < $nb_doc) {
				$nb_doc = $n_start + $nb;
			}
			for ($i = $n_start; $i < $nb_doc; $i++) {
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
