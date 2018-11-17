<?php
class MemberList {

	var $DATA_BASE 				= 1;
	var $GROUPS 				= "GROUPS";
	var $SC_TABLE_NAME 			= "SSCORES";
	var $HD_TABLE_NAME 			= "HUODONG";
	var $SC_REF_TABLE_NAME 		= "SCORES_REF";
	var $STUDENTID 				= "STUDENTID";
	var $IDS 					= "IDS";
	var $ST_TABLE_NAME			= "OUSHISTUDENTS";
	var $CLASS_COL				= "CLASSES";

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

	function getHuodongLists() {
		$lists = array();
		$exec = $this->connect();
		$elems =  $exec->get_order_elements_asc($this->HD_TABLE_NAME, "", $this->IDS);
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$huodong = new HuodongClass();
				$huodong->setData($elems[$i]);
				if (!$huodong->isDeleted()) {
					$lists[] = $huodong;
				}
			}
			$this->close();
			return $lists;
		}
	}
	
	function getClassMemberStudents($classes) {
		$lists = array();
		$classname = $classes;
		$exec = $this->connect();
		$cond  = "";
		$classname = getClassBaseName($classes);
		$cond  = $this->CLASS_COL. 	" = '" .$classname. 	"' ";
		$elems =  $exec->get_order_elements_asc($this->ST_TABLE_NAME, $cond, $this->IDS);
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$student = new StudentTestClass();
				$student->setData($elems[$i]);
				if (!($student->isDeleted()))
					$lists[] = $student;
			}
		}
		$this->close();

		return $lists;
	}
	
	function getAllStudentsLists($loaddel) {
		$lists = array();
		$exec = $this->connect();
		$elems =  $exec->get_order_elements_asc($this->ST_TABLE_NAME, "", $this->IDS);
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$student = new StudentTestClass();
				$student->setData($elems[$i]);
				if ($loaddel && $student->isDeleted()) {
					$lists[] = $student;
				}
				else if (!$loaddel && !$student->isDeleted()) {
					$lists[] = $student;
				}
			}

		}
		$this->close();
		return $lists;
	}
		
	function getStudent($studentid) {
		$student = '';
		if ($this->DATA_BASE) {
			$exec = $this->connect();
			$elem = $exec->get_element($this->ST_TABLE_NAME, $this->IDS,  $studentid);
			if ($elem) {
				$student = new StudentTestClass();
				$student->setData($elem);
			}
			$this->close();
		}
		return $student;
	}
	
	function getStudentScores($studentid) {
		$lists = array();
		if ($this->DATA_BASE) {
			$exec = $this->connect();
			$elems = $exec->get_order_elements($this->SC_TABLE_NAME, $this->STUDENTID,  $studentid);
			if ($elems) {
				for ($i = 0; $i < count($elems); $i++) {
					$scores = new ScoreClass();
					$scores->setScoresData($elems[$i]);
					$lists[] = $scores;
				}
			}
			$this->close();
		}
		return $lists;
	}

	function getClassStudentScoresLists($classes) {
		$lists = array();
		$scoresRef = new ScoreRefClass();
		$period = getCurrentPeriod();
		$refs = $scoresRef->readScoresRef($classes, $period);
		if ($refs && count($refs) > 0) {
			$exec = $this->connect();
			for ($i = 0; $i < count($refs); $i++) {
				$groups = $refs[$i]->getGroups();
				$elems = $exec->get_elements($this->SC_TABLE_NAME, $this->GROUPS,  $groups);
				if ($elems) {
					$scoreslists = array();
					$hasScore = 0;
					for ($j = 0; $j < count($elems); $j++) {
						$scores = new ScoreClass();
						$scores->setScoresData($elems[$j]);
						$scoreslists[] = $scores;
						if ($scores->getTotalScores()) {
							$hasScore = 1;
						}
					}
					if ($hasScore)
					$lists[] = $scoreslists;
				}
			}
			$this->close();
		}
		return $lists;
	}


	function getClassStudentGroupsScoresLists($groups) {
		$lists = array();
		$exec = $this->connect();
		$elems = $exec->get_elements($this->SC_TABLE_NAME, $this->GROUPS,  $groups);
		if ($elems) {
			for ($j = 0; $j < count($elems); $j++) {
				$scores = new ScoreClass();
				$scores->setScoresData($elems[$j]);
				$lists[] = $scores;
			}
		}
		$this->close();
		return $lists;
	}

}
?>
