<?php
include_once ($DOC_PATH."/email/OushiMail.php");
class HuodongClass {

	var $TABLE_NAME    	= "REG_TABLE";
	var $TABLE  = array(
		"IDS",
		"CIVIL",
		"CNAME",
		"FNAME",
		"BIRTHDAY",
		"PHONE",
		"MOBILE",
		"FAX",
		"EMAIL",
		"STREET",
		"CITY",
		"POSTCODE",
		"DEPARTEMENT",
		"COUNTRY",
		"CLASSES",
		"TIMES",
		"PAYEMENT",
		"REGISTDATE",
		"LASTMODIFY",
		"CHINESE",
		"PARENTS",
		"HDINDEX",
		"COMMENTS",
		"VALIDED",
		"DELETED",
	);

	var $IDS		= 0;
	var $CIVIL      = 1;
	var $CNAME   	= 2;
	var $FNAME  	= 3;
	var $BIRTHDAY   = 4;
	var $PHONE     	= 5;
	var $MOBILE    	= 6;
	var $FAX     	= 7;
	var $EMAIL      = 8;
	var $STREET    	= 9;
	var $CITY      	= 10;
	var $POSTCODE  	= 11;
	var $DEPARTEMENT= 12;
	var $COUNTRY   	= 13;

	var $CLASSES  	= 14;
	var $TIMES  	= 15;
	var $PAYMENT  	= 16;

	var $REGISTDATE = 17;
	var $LASTMODIFY	= 18;
	var $CHINESE   	= 19;
	var $PARENTS   	= 20;
	var $HDINDEX   	= 21;
	var $COMMENTS   = 22;
	var $VALIDED  	= 23;
	var $DELETED  	= 24;
	

	var $_id		= 0;
	var $_civil		= "M";
	var $_cname		= "";
	var $_fname    	= "";
	var $_birthday  = "";
	var $_phone    	= "";
	var $_mobile   	= "";
	var $_fax    	= "";
	var $_email     = "";

	var $_street    = "";
	var $_postcode  = "";
	var $_city      = "";
	var $_department = "";
	var $_country   = "";

	var $_classes   = "";
	var $_times     = "";
	var $_payment   = "";
	var $_registerdate	= "";
	var $_lastmodify	= "";
	var $_chinese		= "cccc";
	var $_parent		= "ppp";
	var $_hdindex		= "";
	var $_comments		= "";
	var $_deleted		= 0;
	var $_valided		= 0;
	
	var $_trace 		= "";

	var $connection		= '';

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

	function setTrace($trace) {
		$this->_trace = $trace;
	}
	function getTrace() {
		return $this->_trace;
	}
	function addTrace($trace) {
		$this->_trace .= $trace . "<br>";
	}

	function getID() {
		return $this->_id;
	}
	function setID($id) {
		$this->_id = $id;
	}

	function isEmailValide($email) {
		if($email !== "") {
			if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email))
			//if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,8})$", $email))
			{
				if (isFrancais()) {
					$this->addTrace("E-Mail invalide");
				}
				else {
					$this->addTrace("E-Mail 地址无效");
				}
				return 0;
			}
		}
		return 1;
	}

	function replace($str) {
		$newstr = "";
		if ($str) {
			$newstr = htmlspecialchars($str, ENT_NOQUOTES);
			$newstr = str_replace ('\"', "&quot;", $newstr);
			$newstr = str_replace ("\'", "&#039", $newstr);
		}
		return $newstr;
	}

	function testRegister() {
		
		$this->isEmailValide($this->_email);
		
		if (isFrancais()) {
			if (!$this->_cname && !$this->_fname) {
				$this->addTrace("Entrer Nom et Prénom");
			}
			if (shouldInputBirthday($this->_hdindex)) {
				if (!$this->_birthday) {
					$this->addTrace("Entrer la Date de Naissance");
				}
			}
			if (!$this->_phone && !$this->_mobile) {
				$this->addTrace("Entrer le numéro de téléphone");
			}
			if (!$this->_phone && !$this->_mobile) {
				$this->addTrace("Entrer le numéro de téléphone");
			}
			if (!$this->_email) {
				$this->addTrace("E-Mail invalide");
			}
			
			if (!$this->_street) {
				$this->addTrace("Entrer votre adresse");
			}
	
			if (!$this->_city) {
				$this->addTrace("Entrer votre ville");
			}
	
			if (!$this->_postcode) {
				$this->addTrace("Entrer votre code postal");
			}
			
			if (!$this->_classes) {
				$this->addTrace("Entrer votre activité");
			}
			
			
			if ($this->_hdindex == "summer") {
				if (!$this->_parent) {
					$this->addTrace("Entrer le Nom et Prénom de votre parent");
				}
			}
		}
		else {
			if (!$this->_cname && !$this->_fname) {
				$this->addTrace("请输入中文名或外文名");
			}
			if (shouldInputBirthday($this->_hdindex)) {
				if (!$this->_birthday) {
					$this->addTrace("请输入出生年月日");
				}
			}
			if (!$this->_phone && !$this->_mobile) {
				$this->addTrace("请输入联系电话  (手机或座机)");
			}
			if (!$this->_email) {
				$this->addTrace("E-Mail 地址无效");
			}
			
			if (!$this->_street) {
				$this->addTrace("请输入联系地址");
			}
	
			if (!$this->_city) {
				$this->addTrace("请输入城市名");
			}
	
			if (!$this->_postcode) {
				$this->addTrace("请输入邮政编码");
			}
			
			if (!$this->_classes) {
				$this->addTrace("请选择您活动项目");
			}
			
			if (!$this->_times) {
				$this->addTrace("请选择您活动时间");
			}
			
			if ($this->_hdindex == "summer") {
				if (!$this->_parent) {
					$this->addTrace("请输入家长姓名");
				}
				if (!$this->_classes) {
					$this->addTrace("请选择地区");
				}
			}
			
		}
	}

	function isOK() {
		$this->testRegister();
		if ($this->_trace) {
			return 0;
		}
		else {
			return 1;
		}
	}
	
	function getCivil() {
		return $this->_civil;
	}
	function setCivil($civil) {
		$this->_civil = $civil;
	}

	function getChinaName() {
		return $this->_cname;
	}
	function setChinaName($name) {
		$this->_cname = $name;
	}

	function getEnglishName() {
		return $this->_fname;
	}
	function setEnglishName($name) {
		if ($name) {
			$this->_fname = $this->replace($name);
		}
	}

	function getBirthDay() {
		return $this->_birthday;
	}
	function setBirthDay($day) {
		$this->_birthday = $day;
	}

	function getPhone() {
		return $this->_phone;
	}
	function setPhone($phone) {
		$this->_phone = $phone;
	}

	function setMobile($mobile) {
		$this->_mobile = $mobile;
	}
	function getMobile() {
		return $this->_mobile;
	}

	function setFax($fax) {
		$this->_fax = $fax;
	}
	function getFax() {
		return $this->_fax;
	}

	function getEmail() {
		return $this->_email;
	}
	function setEmail($email) {
		if ($this->isEmailValide($email))
		$this->_email = $email;
	}

	function getStreet() {
		return $this->_street;
	}
	function setStreet($street) {
		$this->_street = $this->replace($street);
	}

	function getCity() {
		return $this->_city;
	}
	function setCity($city) {
		$this->_city = $this->replace($city);
	}

	function getPostCode() {
		return $this->_postcode;
	}
	function setPostCode($postcode) {
		$this->_postcode = $this->replace($postcode);
	}

	function getCountry() {
		return $this->_country;
	}
	function setCountry($country) {
		$this->_country = $this->replace($country);
	}
	
	function getDepartement() {
		return $this->_department;
	}
	function setDepartement($country) {
		$this->_department = $this->replace($country);
	}
	
	function getRegisterDate() {
		return $this->_registerdate;
	}
	function setRegisterDate($date) {
		$this->_registerdate = $date;
	}

	function getLastModify() {
		return $this->_lastmodify;
	}
	function setLastModify($modify) {
		$this->_lastmodify = $modify;
	}

	function getClasses() {
		return $this->_classes;
	}
	function setClasses($classes) {
		$this->_classes = $classes;
	}
	function getChinese() {
		return $this->_chinese;
	}
	function setChinese($chinese) {
		$this->_chinese = $chinese;
	}
	function getParents() {
		return $this->_parent;
	}
	function setParents($parent) {
		$this->_parent = $parent;
	}
	
	function getTimes() {
		return $this->_times;
	}
	function setTimes($times) {
		$this->_times = $times;
	}
	function getHDIndex() {
		return $this->_hdindex;
	}
	function setHDIndex($index) {
		$this->_hdindex = $index;
	}
	
	function getPayment() {
		return $this->_payment;
	}
	function setPayment($payment) {
		$this->_payment = $payment;
	}

	function getComments() {
		return $this->_comments;
	}
	function setComments($comment) {
		$this->_comments = $comment;
	}

	function isValided() {

		return $this->_valided;
	}
	function setValided($valided) {
		$this->_valided = $valided;
	}
	
	function isDeleted() {

		return $this->_deleted;
	}
	function setDeleted($deleted) {
		$this->_deleted = $deleted;
	}
	
	
	function setData($huodon) {
		$this->setID($huodon["$this->IDS"]);

		$this->setCivil($huodon["$this->CIVIL"]);
		$this->setChinaName($huodon["$this->CNAME"]);
		$this->setEnglishName($huodon["$this->FNAME"]);
		$this->setBirthDay($huodon["$this->BIRTHDAY"]);
		$this->setPhone($huodon["$this->PHONE"]);
		$this->setMobile($huodon["$this->MOBILE"]);
		$this->setFax($huodon["$this->FAX"]);
		$this->setEmail($huodon["$this->EMAIL"]);

		$this->setStreet($huodon["$this->STREET"]);
		$this->setCity($huodon["$this->CITY"]);
		$this->setPostCode($huodon["$this->POSTCODE"]);
		$this->setDepartement($huodon["$this->DEPARTEMENT"]);
		$this->setCountry($huodon["$this->COUNTRY"]);
		
		$this->setTimes($huodon["$this->TIMES"]);
		$this->setClasses($huodon["$this->CLASSES"]);
		$this->setPayment($huodon["$this->PAYMENT"]);

		$this->setRegisterDate($huodon["$this->REGISTDATE"]);
		$this->setLastModify($huodon["$this->LASTMODIFY"]);
		$this->setChinese($huodon["$this->CHINESE"]);
		$this->setParents($huodon["$this->PARENTS"]);
		$this->setHDIndex($huodon["$this->HDINDEX"]);
		$this->setComments($huodon["$this->COMMENTS"]);
		$this->setValided($huodon["$this->VALIDED"]);
		$this->setDeleted($huodon["$this->DELETED"]);
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
	
	function getData() {
		$buf = "(";
		$buf .= "'" . $this->getID() . "', ";
		$buf .= "'" . $this->getCivil() . "', ";
		$buf .= "'" . $this->getChinaName() . "', ";
		$buf .= "'" . $this->getEnglishName() . "', ";
		$buf .= "'" . $this->getBirthDay() . "', ";
		$buf .= "'" . $this->getPhone() . "', ";
		$buf .= "'" . $this->getMobile() . "', ";
		$buf .= "'" . $this->getFax() . "', ";
		$buf .= "'" . $this->getEmail() . "', ";
		
		$buf .= "'" . $this->getStreet() . "', ";
		$buf .= "'" . $this->getCity() . "', ";
		$buf .= "'" . $this->getPostCode() . "', ";
		$buf .= "'" . $this->getDepartement() . "', ";
		$buf .= "'" . $this->getCountry() . "', ";

		$buf .= "'" . $this->getClasses() . "', ";
		$buf .= "'" . $this->getTimes() . "', ";
		$buf .= "'" . $this->getPayment() . "', ";

		$buf .= "'" . $this->getRegisterDate() . "', ";
		$buf .= "'" . $this->getLastModify() . "', ";
		$buf .= "'" . $this->getChinese() . "', ";
		$buf .= "'" . $this->getParents() . "', ";
		$buf .= "'" . $this->getHDIndex() . "', ";
		$buf .= "'" . $this->getComments() . "', ";
		$buf .= "'" . $this->isValided() . "', ";
		$buf .= "'" . $this->isDeleted() . "'";
		$buf .= ")";
		return $buf;
	}
	
	function getUpdateData() {
		$buf = "";
		$buf .= $this->TABLE[$this->CIVIL]. 	"='" . $this->getCivil() . "', ";
		$buf .= $this->TABLE[$this->CNAME]. 	"='" . $this->getChinaName() . "', ";
		$buf .= $this->TABLE[$this->FNAME]. 	"='" . $this->getEnglishName() . "', ";
		$buf .= $this->TABLE[$this->BIRTHDAY]. 	"='" . $this->getBirthDay() . "', ";
		$buf .= $this->TABLE[$this->PHONE]. 	"='" . $this->getPhone() . "', ";
		$buf .= $this->TABLE[$this->MOBILE]. 	"='" . $this->getMobile() . "', ";
		$buf .= $this->TABLE[$this->FAX]. 		"='" . $this->getFax() . "', ";
		$buf .= $this->TABLE[$this->EMAIL]. 	"='" . $this->getEmail() . "', ";
		$buf .= $this->TABLE[$this->STREET]. 	"='" . $this->getStreet() . "', ";
		$buf .= $this->TABLE[$this->CITY]. 		"='" . $this->getCity() . "', ";
		$buf .= $this->TABLE[$this->POSTCODE]. 	"='" . $this->getPostCode() . "', ";
		$buf .= $this->TABLE[$this->DEPARTEMENT]. 	"='" . $this->getDepartement() . "', ";
		$buf .= $this->TABLE[$this->COUNTRY]. 	"='" . $this->getCountry() . "', ";
		
		$buf .= $this->TABLE[$this->CLASSES]. 	"='" . $this->getClasses() . "', ";
		$buf .= $this->TABLE[$this->TIMES]. 	"='" . $this->getTimes() . "', ";
		$buf .= $this->TABLE[$this->PAYMENT]. 	"='" . $this->getPayment() . "', ";
		
		$buf .= $this->TABLE[$this->LASTMODIFY]."='" .getCurrentDate(). "', ";
		
		$buf .= $this->TABLE[$this->CHINESE]. 	"='" . $this->getChinese() . "', ";
		$buf .= $this->TABLE[$this->PARENTS]. 	"='" . $this->getParents() . "', ";
		$buf .= $this->TABLE[$this->HDINDEX]. 	"='" . $this->getHDIndex() . "', ";
		
		$buf .= $this->TABLE[$this->COMMENTS]. 	"='" . $this->getComments() . "', ";
		$buf .= $this->TABLE[$this->VALIDED]. 	"='" . $this->isValided() . "', ";
		$buf .= $this->TABLE[$this->DELETED]. 	"='" .$this->isDeleted(). "'";

		return $buf;
	}
	
	function updateHuodong() {
		$exec = $this->connect();
		$data = $this->getUpdateData();
		$exec->update_all_elements($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $data);
		$this->close();
	}
	function getEmailData() {

		$buf = $this->getCivil() ;
		if ($this->getChinaName()) {
			$buf .= " " .$this->getChinaName();
		}
		if ($this->getEnglishName()) {
			$buf .=  " ( " .$this->getEnglishName(). ") <br><br>";
		}
		$buf .= " 报名  : " .$this->getClasses() . "<br>";
		$buf .= " 时间 : " .$this->getTimes()."<br><br>";
		$buf .= " 电话 : " .$this->getPhone()."<br>";
		$buf .= " 手机 : " .$this->getMobile()."<br>";
		$buf .= " EMAIL : " .$this->getEmail()."<br><br>";	
		$buf .= " 报名时间 : " .date("Y-m-d")."<br><br>";	
		$buf .= "<a href='http://culture-oushi.com/admin/admin.php?mtype=3'> 查看链接 </a><br><br>";
		return $buf;
	}
	
	function addHuodong() {
		if ($this->getID() > 0) {
			$this->updateHuodong();
		}
		else {
			$exec = $this->connect();
			$uid = $exec->get_max_number($this->TABLE_NAME, $this->TABLE[$this->IDS]);
			$this->setID($uid);
			$currDate = getCurrentDate();
			$this->setRegisterDate($currDate);
			$this->setLastModify($currDate);
			$data = $this->getData();
			$exec->add_elements($this->TABLE_NAME, $this->buildTableRef(), $data);
			$this->close();

			/* sending email */
			$email = $this->getEmailData();
			$oemail = new OushiMail();
			$oemail->SendToOushi($email);
			
			
		}
	}

	function getHuodong($id) {
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
	
	function deleteHuodong($del) {
		$exec = $this->connect();

		$this->setDeleted($del);
		$exec->update_element($this->TABLE_NAME, $this->TABLE[$this->IDS], $this->getID(), $this->TABLE[$this->DELETED], $del);

		$this->close();

	}
	
	function updateActive($id, $val) {

		if ($val == 2) {
			$d = 1;
			$v = 0;
		}
		else {
			$d = 0;
			$v = $val;
		}
		
		$this->setValided($v);
		$this->setDeleted($d);

		$sql  = "UPDATE ".$this->TABLE_NAME." SET " .$this->TABLE[$this->VALIDED]."='".$v."', ".$this->TABLE[$this->DELETED]."='".$d."' WHERE ".$this->TABLE[$this->IDS]."='".$id."'"; 
		
		$exec = $this->connect();
		
		$exec->exec_query($sql);

		$this->close();

	}
	
}
?>
