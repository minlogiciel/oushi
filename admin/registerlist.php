<?php 

$blists = new BaseList();
	
	

for ($i = 0; $i < count($REGISTER_TAB); $i++) {
	$item = $REGISTER_TAB[$i];
	for ($j = 3; $j < count($item); $j++) {
		$sitem =  $item[$j];
		$title = $sitem[0];
		$v_ref   = $sitem[1];
		$active = $sitem[2];
		$nb = $blists->getRegisterCount($v_ref);
		echo("<div class=textlink>".$title."</div>"); 
		if ($active) {
			if ($nb > 0) {
			echo("<div class=textlink>&nbsp;&nbsp;&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;");
			echo("<a href='../admin/?action=".$SHOWMEMBER."&active=1&registerref=".$v_ref."&mtype=".$HDBM_TYPE."'>注册成员</a> (".$nb. ")</div>"); 
			}
			echo("<div class=textlink>&nbsp;&nbsp;&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;");
			echo("<a href='../admin/?action=registermember&registerref=".$v_ref."&mtype=".$HDBM_TYPE."'>报名注册</a></div>"); 
		} else {
			echo("<div class=textlink>&nbsp;&nbsp;&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;");
			echo("<font color=#aaa>注册成员</font></div>"); 
			echo("<div class=textlink>&nbsp;&nbsp;&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;");
			echo("<font color=#aaa>报名注册</font></div>"); 
		} 
	}
}


?>

