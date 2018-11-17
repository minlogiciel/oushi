<?php
class sql_class {
	var $serveur 	= "localhost";
	var $user		= "root";
	var $passwd		= "";
	var $base_name	= "oushi";
	var $connection = '';
	var $version 	= 0;
	
	/*function sql_class($serveur='', $user='', $passwd='', $base_name='') {
		$this->init();
	}*/
	function init($serveur='', $user='', $passwd='', $base_name='') {
		global $SQL_SERVER, $SQL_USER, $SQL_PASSWD, $SQL_BASE;
		if ($serveur) {
			$this->serveur 	= $serveur;
		} else {
			$this->serveur 	= $SQL_SERVER;
		}
		if ($user) {
			$this->user 	= $user;
		}
		else {
			$this->user 	= $SQL_USER;
		}
		if ($passwd) {
			$this->passwd 	= $passwd;
		}
		else {
			$this->passwd = $SQL_PASSWD;
		}
		if ($base_name) {
			$this->base_name = $base_name;
		} else {
			$this->base_name = $SQL_BASE;
		}
		if ($this->version == 0) {
			$v = phpversion();
			$this->version = $v[0];
		}
		//$this->connect();
	}
	function get_error() {
		if ($this->version < 7)
			return mysql_error();
		else 
			return $this->connection->connect_error;
	}
	function connect() {
		if (!$this->connection) {
			$this->init();
			if ($this->version < 7) {
				$this->connection = @mysql_connect("$this->serveur", "$this->user", "$this->passwd")
				or die("Error : connect to Mysql server ".$this->serveur. " : " .$this->user. ", " .$this->get_error());
			
				@mysql_select_db("$this->base_name", $this->connection)
				or die("Impossible to select database ".$this->base_name. ", " .$this->get_error());
			}
			else {
				$this->connection = new mysqli("$this->serveur", "$this->user", "$this->passwd", "$this->base_name")
				or die("Error : connect to Mysql server ".$this->serveur. " : " .$this->user. ", " .$this->get_error());
			}
		}
	}
	function close() {
		if ($this->connection) {
			if ($this->version < 7)
				@mysql_close($this->connection);
			else
				$this->connection->close();
		}
	}
	function get_query($sql) {
		$p = '';
		$this->connect();
		if ($this->version < 7)
			$p = @mysql_query($sql, $this->connection) or die("Problem of get connecting " .$sql. ", " .$this->get_error());
		else
			$p = $this->connection->query($sql) or die("Problem of get connecting " .$sql. ", " .$this->get_error());
		return $p;
	}
	function exec_query($sql) {
		$this->connect();
		if ($this->version < 7)
			@mysql_query($sql) or die("Problem of exection query : " .$sql. ", " .$this->get_error());
		else
			$this->connection->query($sql) or die("Problem of exection query : " .$sql. ", " .$this->get_error());
	}
	
	function fetch_array($p)
	{
		if ($this->version < 7)
			return mysql_fetch_array($p);
		else
			return $p->fetch_array();
	}

	function get_result($p, $nstart, $nend) {
		$resu = 0;
		$this->connect();
		if ($this->version < 7)
			$resu = @mysql_result($p, $nstart, $nend) or die("Problem of get_result : " .$this->get_error());
		else {
			$resu = $p->fetch_row();
		}
		return $resu;
	}

	function get_baselists($sql) {
		$elems = array();
		$p = $this->get_query($sql);
		if ($p) {
			$i = 0;
			while ($data = $this->fetch_array($p)) {
				$elems[$i++] = $data;
			}
		}
		return $elems;
	}

	function get_elements($tab_name, $cond) {
		$elems = array();
		$sql = "SELECT * FROM $tab_name WHERE $cond";
		$p = $this->get_query($sql);
		if ($p) {
			$i = 0;
			while ($data = $this->fetch_array($p)) {
				$elems[$i++] = $data;
			}
		}
		return $elems;
	}
	function get_element_1($tab_name, $cond)
	{
		$elems = '';
		$sql = "SELECT * FROM $tab_name WHERE $cond";
		$p = $this->get_query($sql);
		if ($p)
		{
			$elems = $this->fetch_array($p);
		}
		return $elems;
	}
	function get_element_prev($tab_name, $cond)
	{
		$elems = '';
		$sql = "SELECT * FROM $tab_name WHERE $cond";
		$p = $this->get_query($sql);
		if ($p) {
			while ($data = $this->fetch_array($p)) {
				$elems = $data;
			}
		}
		return $elems;
	}
	function get_element($tab_name, $col, $val, $col2="", $val2="")
	{
		$elems = '';
		$sql = "SELECT * FROM $tab_name WHERE $col='$val'";
		if ($col2 && $val2) {
			$sql .= " AND $col2='$val2'";
		}
		$p = $this->get_query($sql);
		if ($p)
		{
			$elems = $this->fetch_array($p);
		}
		else {
			print_r("Not Found " .$sql);
		}
		return $elems;
	}

	
	function add_elements($tab_name, $cols, $vals) {
		$sql="INSERT INTO $tab_name $cols VALUES $vals" ;
		$this->exec_query($sql);
	}
	
	function delete_element($tab_name, $cond)
	{
		$sql = "DELETE FROM $tab_name WHERE $cond";
		$this->exec_query($sql);
	}

	function update_element($tab_name, $col_name, $col, $resu_col, $val)
	{
		$sql  = "UPDATE $tab_name set $resu_col='$val' WHERE $col_name='$col'"; 
		
		$exec = $this->exec_query($sql);
	}

	function update_all_elements($tab_name, $col_name, $col, $vals)
	{
		$sql  = "UPDATE $tab_name set $vals WHERE $col_name='$col'"; 
		$exec = $this->exec_query($sql);
	}
	
	function get_max_number($tab_name, $col)
	{
		$sql = "SELECT max($col) as maxnb from $tab_name";
		$p = $this->get_query($sql) ;
		if ($this->version < 7)
			$maxRecord = $this->get_result($p, "0", "maxnb");
		else {
			$row = $this->fetch_array($p);
			$maxRecord = $row['maxnb'];
		}
		
		if (empty($maxRecord)) {
			$maxRecord = 1;
		}
		else {
			$maxRecord++;
		}
		return $maxRecord;
	}

	
	function get_order_elements_ASC($tab_name, $cond, $col_key, $nb_elem=0)
	{
		$elems  = array();
		$sql = "SELECT * from $tab_name WHERE $cond ORDER BY $col_key ASC";  // ASC DESC

		$p = $this->get_query($sql);
		if ($p)
		{
			$i = 0;
			while ($data = $this->fetch_array($p)) {
				$elems[$i++] = $data;
				if ($nb_elem > 0 && $i >= $nb_elem) {
					break;
				}
			}
		}
		return $elems;
	}

	function get_order_elements_DESC($tab_name, $cond, $col_key, $nb_elem=0)
	{
		$elems  = array();
		$sql = "SELECT * from $tab_name WHERE $cond ORDER BY $col_key DESC"; 

		$p = $this->get_query($sql);
		if ($p)
		{
			$i = 0;
			while ($data = $this->fetch_array($p)) {
				$elems[$i++] = $data;
				if ($nb_elem > 0 && $i >= $nb_elem) {
					break;
				}
			}
		}
		return $elems;
	}
	
	function get_in_elements($tab_name, $col, $str) {
		$sql = "SELECT * FROM $tab_name WHERE $col IN ($str)";
	}
	function get_order_asc_elements($tab_name, $key1) {
		$sql = "SELECT * FROM $tab_name ORDER BY $key ASC";
	}
	function get_order_desc_elements($tab_name, $col_key) {
		$sql = "SELECT * from $tab_name ORDER BY $col_key DESC";
	}
	function getElements($tab_name, $cond)
	{
		$elems  = array();
		$sql = "SELECT * from $tab_name WHERE $cond";
		$p = $this->get_query($sql);
		if ($p)
		{
			$i = 0;
			while ($data = $this->fetch_array($p)) {
				$elems[$i++] = $data;
			}
		}
		return $elems;
	}
	
}
?>