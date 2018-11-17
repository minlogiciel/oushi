<?php
class AdminUserClass {

	var $TABLE_NAME    	= "OUSHIADMINUSER";
	var $MIN_PASS_LEN 	= 7;
	var $MAX_PASS_LEN 	= 13;
	
	var $TABLE  = array(
		"IDS", 
		"NAMES", 
		"USER", 
		"PASSWD", 
		"LEVEL", 
		"PHONE", 
		"MOBILE", 
		"EMAIL", 
		"ADDRIP", 
		"LASTLOGIN", 
		"LASTMODIF", 
		"DELETED", 
	);

	var $IDS		= 0;
	var $NAMES     	= 1;
	var $USER     	= 2;
	var $PASSWD    	= 3;
	var $LEVEL    	= 4;
	var $PHONE   	= 5;
	var $MOBILE   	= 6;
	var $EMAIL  	= 7;
	var $ADDRIP  	= 8;
	var $LASTLOGIN  = 9;
	var $LASTMODIF 	= 10;
	var $DELETED    = 11;


	var $_id         	= 0;
	var $_name         	= "";
	var $_user        	= "";
	var $_passwd     	= "";
	var $_passwd2     	= "";
	var $_level        	= 0;
	var $_phone       	= "";
	var $_mobile     	= "";
	var $_email    		= "";
	var $_addrip 		= "";
	var $_lastlogin		= "";
	var $_lastmodif    	= "";
	var $_deleted		= 0;
	var $_trace 			= "";
	
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

	function setTrace($trace) {
		$this->_trace = $trace;
	}
	function getTrace() {
		return $this->_trace;
	}
	function addTrace($trace) {
		$this->_trace .= $trace . "<br>";
	}

	function isEmailValide($email) {
		if($email) {
			if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email))
			//if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,8})$", $email))
			{
				$this->addTrace("Email 地址无效");
				return 0;
			}
		}
		return 1;
	}
	function isUserDataOK() {

		$this->isEmailValide($this->_email);
		if ($this->_passwd != $this->_passwd2) {
			$this->addTrace("密码不一致"); 
		}
		if ($this->_trace)
			return 0;
		else
			return 1;
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
		if (strlen($name)) {
			$this->_name = $this->replace($name);
		}
		else {
			$this->addTrace("输入管理员姓名");
		}
	}
	function getLoginName() {
		return ($this->_user);
	}
	function setLoginName($user) {
		$this->_user = $user;
	}
	
	function getPassword() {
		return  ($this->_passwd);
	}
	function setPassword($passwd) {
		$len = strlen($passwd);
		if ($len < $this->MIN_PASS_LEN || $len > $this->MAX_PASS_LEN) {
			$this->addTrace("密码必须是8到12个字符");
		}
		else {
			$this->_passwd = $passwd;
		}
	}
	function setPassword2($passwd) {
		$len = strlen($passwd);
		if ($len < $this->MIN_PASS_LEN || $len > $this->MAX_PASS_LEN) {
			$this->addTrace("密码必须是8到12个字符");
		}
		else {
			$this->_passwd2 = $passwd;
		}
	}
	function getPassword2() {
		return  $this->_passwd2;
	}
	
	function getLevel() {
		return ($this->_level);
	}
	function setLevel($level) {
		$this->_level = $level;
	}

	function getPhone() {
		return $this->_phone;
	}
	function setPhone($phone) {
		$this->_phone = $phone;
	}

	function getMobile() {
		return ($this->_mobile);
	}
	function setMobile($mobile) {
		$this->_mobile = $mobile;
	}

	function getEmail() {
		return $this->_email;
	}
	function setEmail($email) {
		$this->_email = $email;
	}

	function getAddressIP() {
		return $this->_addrip;
	}
	function setAddressIP($ip) {
		$this->_addrip = $ip;
	}
	function getLastModif() {
		return $this->_lastmodif;
	}
	function setLastModif($lastmodif) {
		$this->_lastmodif = $lastmodif;
	}
	function getLastLogin() {
		return $this->_lastlogin;
	}
	function setLastLogin($lastlogin) {
		$this->_lastlogin = $lastlogin;
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
	
	function setData($auser) {
		$this->setID($auser["$this->IDS"]);
		$this->setName($auser["$this->NAMES"]);
		$this->setLoginName($auser["$this->USER"]);
		$this->setPassword($auser["$this->PASSWD"]);
		$this->setPassword2($auser["$this->PASSWD"]);
		$this->setLevel($auser["$this->LEVEL"]);
		$this->setPhone($auser["$this->PHONE"]);
		$this->setMobile($auser["$this->MOBILE"]);
		$this->setEmail($auser["$this->EMAIL"]);
		$this->setAddressIP($auser["$this->ADDRIP"]);
		$this->setLastLogin($auser["$this->LASTLOGIN"]);
		$this->setLastModif($auser["$this->LASTMODIF"]);
		$this->setDeleted($auser["$this->DELETED"]);
	}

	function getData() {
		$buf = "(";
		$buf .= "'" . $this->getID() . "', ";
		$buf .= "'" . $this->getName() . "', ";
		$buf .= "'" . $this->getLoginName() . "', ";
		$buf .= "'" . $this->getPassword() . "', ";
		$buf .= "'" . $this->getLevel() . "', ";
		$buf .= "'" . $this->getPhone() . "', ";
		$buf .= "'" . $this->getMobile() . "', ";
		$buf .= "'" . $this->getEmail() . "', ";
		$buf .= "'" . $this->getAddressIP() . "', ";
		$buf .= "'" . $this->getLastLogin() . "', ";
		$buf .= "'" . $this->getLastModif() . "', ";
		$buf .= "'" . $this->isDeleted() . "'";
		$buf .= ")";
		return $buf;
	}

	function getUpdateData() {
		$buf = "";
		$buf .= $this->TABLE[$this->NAMES]. 	"='" . $this->getName() . 		"', ";
		$buf .= $this->TABLE[$this->USER]. 		"='" . $this->getLoginName() . 		"', ";
		$buf .= $this->TABLE[$this->PASSWD]. 	"='" . $this->getPassword().	"', ";
		$buf .= $this->TABLE[$this->LEVEL]. 	"='" . $this->getLevel() . 		"', ";
		$buf .= $this->TABLE[$this->PHONE]. 	"='" . $this->getPhone() . 		"', ";
		$buf .= $this->TABLE[$this->MOBILE]. 	"='" . $this->getMobile() . 	"', ";
		$buf .= $this->TABLE[$this->EMAIL]. 	"='" . $this->getEmail() . 		"', ";
		$buf .= $this->TABLE[$this->ADDRIP]. 	"='" . $this->getAddressIP(). 	"', ";
		$buf .= $this->TABLE[$this->LASTLOGIN]. "='" . $this->getLastlogin() . 	"', ";
		$buf .= $this->TABLE[$this->LASTMODIF].	"='" . $this->getLastModif() . 	"', ";
		$buf .= $this->TABLE[$this->DELETED]. 	"='" . $this->isDeleted(). 		"'";
		return $buf;
	}
	function getUpdateIPData() {
		$buf = "";
		$buf .= $this->TABLE[$this->ADDRIP]. 	"='" . $this->getAddressIP(). 	"', ";
		$buf .= $this->TABLE[$this->LASTLOGIN]. "='" . $this->getLastlogin() . 	"'";
		return $buf;
	}
	
	function getUpdatePassword() {
		$buf = "";
		$buf .= $this->TABLE[$this->LASTMODIF].	"='" . $this->getLastModif() . "', ";
		$buf .= $this->TABLE[$this->PASSWD]. 	"='" . $this->getPassword() . 	"'";
		return $buf;
	}

	function updatePassword() {
		$exec = $this->connect();
		$this->setLastModif($this->getCurrentDate());
		$data = $this->getUpdatePassword();
		$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
		$this->close();
	}	
	
	function deleteUser($del) {
		$exec = $this->connect();
		$this->setDeleted($del);
		$exec->update_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $this->TABLE[$this->DELETED], $del);
		$this->close();
	}
	
	function addUser() {
		$ret = 1;
		$exec = $this->connect();
		$this->setLastModif($this->getCurrentDate());
		if ($this->getID() > 0) {
			$data = $this->getUpdateData();
			$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
		}
		else {
			$cond  = $this->TABLE[$this->NAMES]."='" .$this->_name."' OR " .$this->TABLE[$this->USER]. "='" .$this->_user."'";
			$elem = $exec->get_element_1($this->TABLE_NAME, $cond);
			if ($elem) {
				$this->addTrace("用户名已经存在");
				$ret = 0;
			}
			else {
				$uid = $exec->get_max_number($this->TABLE_NAME, $this->TABLE[$this->IDS]);
				$this->setID($uid);
				$data = $this->getData();
				$exec->add_elements($this->TABLE_NAME, $this->buildTableRef(), $data);
			}
		}
		$this->close();
		return $ret;
	}
	function updateUserInfo() {
		$exec = $this->connect();
		$this->setLastModif($this->getCurrentDate());
		$data = $this->getUpdateData();
		$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
		$this->close();
	}
	function updateUserIP($ip) {
		$exec = $this->connect();
		$this->setLastLogin($this->getCurrentDate());
		$this->setAddressIP($ip);
		$data = $this->getUpdateIPData();
		$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
		$this->close();
	}
	
	function findUser($ids) {
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

	function findUserByEmail($email) {
		$ret = 0;
		$exec = $this->connect();
		$elem = $exec->get_element($this->TABLE_NAME, $this->TABLE[$this->EMAIL], $email);
		if ($elem) {
			$this->setData($elem);
			$ret = 1;
		}
		$this->close();
		return $ret;
	}
	function getRegistedUser($uname, $upass) {
		$ret = 0;
		
		if ($uname && $upass) {
			$exec = $this->connect();
			$cond  = $this->TABLE[$this->PASSWD]."='" .$upass."' AND (";
			$cond .= $this->TABLE[$this->NAMES]."='" .$uname."' OR ";
			$cond .= $this->TABLE[$this->USER]. "='" .$uname."' OR ";
			$cond .= $this->TABLE[$this->EMAIL]. "='" .$uname."')";
			$elem = $exec->get_element_1($this->TABLE_NAME, $cond);
			if ($elem) {
				$this->setData($elem);
				$currDate = $this->getCurrentDate();
				$exec->update_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $this->TABLE[$this->LASTLOGIN], $currDate);
				if (!$this->isDeleted())
					$ret = 1;
			}
			$this->close();
		}
		return $ret;
	}
	
	function getAllAdminUsers($level, $withdeleted) {
		$lists = array();
		$exec = $this->connect();
		if ($level > 0) {
			$cond = $this->TABLE[$this->LEVEL]. "='" .$level."'";
		}
		else {
			$cond = "1=1";
		}
		$elems =  $exec->get_order_elements_ASC($this->TABLE_NAME, $cond, "IDS");
		if ($elems) {
			for ($i = 0; $i < count($elems); $i++) {
				$user = new AdminUserClass();
				$user->setData($elems[$i]);
				if (!$user->isDeleted() || $withdeleted) {
					$lists[] = $user;
				}
			}
		}
		$this->close();
		return $lists;
	}
	
}
?>
