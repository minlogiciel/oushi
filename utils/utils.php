<?php

function HostUrl() {
	global $DOC_ROOT;
	return ("http://".$_SERVER['SERVER_NAME']. ":".$_SERVER['SERVER_PORT']. $DOC_ROOT);
}

function DocRoot()
{
	global $DOC_PATH;
	return $DOC_PATH;
}

function getGEOIPRoot()
{
	global $DOC_PATH;
	$docroot =  $DOC_PATH . "/geoip/";
	return $docroot;
}
function getURLTitle() {
	$pfile = $_SERVER['PHP_SELF'];
	$title = "";
	if (isFrancais()) {
		if (strstr($pfile, "jiaoyu")) {
			$title .= " - Éducation Culturelle";
		} 
		else if (strstr($pfile, "jiaoliu")) {
			$title .= " - Échanges Culturels";
			
		}
		else if (strstr($pfile, "wenyi")) {
			$title .= " - Activités culturelles";
			
		}
		else if (strstr($pfile, "newschool")) {
			$title .= " - Nouveau locaux";
			
		}
		else if (strstr($pfile, "register")) {
			$title .= " - Inscriptions";
			
		}
	}
	else {
		if (strstr($pfile, "jiaoyu")) {
			$title .= " - 文化教育";
		} 
		else if (strstr($pfile, "jiaoliu")) {
			$title .= " - 文化交流";
			
		}
		else if (strstr($pfile, "wenyi")) {
			$title .= " - 文化娱乐";
			
		}
		else if (strstr($pfile, "newschool")) {
			$title .= " - 新址介绍";
			
		}
		else if (strstr($pfile, "register")) {
			$title .= " - 报名";
			
		}
		
	}
	return $title;
}


$mark = "*";
function showmark($mark="*") {
	echo("<font color=red><b>" . $mark . "</b></font>");
}

function shouldInputBirthday($ref) {
	if (strstr($ref, "summer") || strstr($ref, "children") || 
		strstr($ref, "chinois") || strstr($ref, "shuqi") || strstr($ref, "adulte")) {
			return 1;
	}
	return 0;
}

function writeAllowIP($ip)
{
	global $ALLOWED_IP;	

	$fname = "../utils/allowedIP.inc";
	$hostname = gethostbyaddr($ip);
	$text  = "<?php\n\$ALLOWED_IP = array(\n";
	for ($i = 0; $i < count($ALLOWED_IP); $i+=2) {
		$item = $ALLOWED_IP[$i];
		$text  .= "\"".$ALLOWED_IP[$i]. "\", \"".$ALLOWED_IP[$i+1]. "\",\n";
	}
	$text  .= "\"".$ip. "\", \"".$hostname. "\",\n";
	$text  .= ");\n\n?>\n";
	$fp = fopen($fname, "w");
	fwrite($fp, $text);
	fclose($fp);
	
}


function isRemoteAddrAllowed($ip='') {
	global $ALLOWED_IP;
	if (!$ip) {
		$remoteip = $_SERVER['REMOTE_ADDR'];
	}
	else {
		$remoteip = $ip;
	}
	$hostname = gethostbyaddr($remoteip);
	for ($i = 0; $i < count($ALLOWED_IP); $i+=2) {
		if (($remoteip == $ALLOWED_IP[$i]) && ($hostname == $ALLOWED_IP[$i+1]))
			return 1;
	}
	return 0;
}

function isRemoteAddrNoAllowed($remoteip) {
	$hostname = gethostbyaddr($remoteip);
	if (($remoteip == "2.186.17.100") || ($hostname == "2.186.17.100") || 
		($remoteip == "2.185.186.141") || ($hostname == "2.185.186.141") ||
		($remoteip == "2.93.50.60") || ($hostname == "2.93.50.60")) {
		return 1;
	}
	return 0;
}

function isAdminAllowed() {
	$allowed = 1;
	$remoteip = $_SERVER['REMOTE_ADDR'];
	if (isRemoteAddrNoAllowed($remoteip)) {
		$allowed = 0;
	}
	else if (isRemoteAddrAllowed($remoteip)) {
		$allowed = 1;
	}
	return $allowed;
}

function getURL() {
	return "../home/";
}


function school() {
	echo("Les Amis de Nouvellles d’Europe");
}

function schooladdr() {
	return ("A. N. E.<br>48-50 Rue Benoît Malon,<br>94250 Gentilly <br>France<br>");
}

function schooladdrline() {
	echo ("48-50 Rue Benoît Malon, 94250 Gentilly, France");
}

function fax() {
	echo("+33 (0)1 41 24 41 40");
}
function telephone() {
	echo("+33 (0)1 41 24 41 40");
}

function NbJours($debut, $fin) {

  $tDeb = explode("-", $debut);
  $tFin = explode("-", $fin);

  $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) - 
          mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);
  
  return(($diff / 86400)+1);

}

function getTodayString()
{
	return (getWeekday(date("w")). ", " .getMonth(date("n")). " " .date("d"). ", " .date("Y"));
}

function getToday()
{
	return (date("Y"). "-" . date("m"). "-" .date("d"));
}

function showDateF()
{
	echo(date("d"). "/" . date("m"). "/" .date("Y"). "&nbsp;&nbsp;&nbsp;" .getWeekdayF(date("w")));
}

function showDate()
{
	//$YEAR = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

	//$WEEKS =array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
	//echo(date("Y"). "-" . date("n"). "-" . date("d"). " " .$WEEKS[date("w")]);
	echo(date("Y"). "年" . date("n"). "月" .date("j"). "日  " .getWeekday(date("w")));
	//echo(date("Y"). "年" . getMonth(date("n")). "月" .getDay(date("d")). "日  " .getWeekday(date("w")));
}

function getFormatDate($dates) {
	$newdate = $dates;
	$y = " "; $m = " "; $d = " ";
	if (strstr($dates, "年")) {
		$posy = strpos($dates, '年');
		$y = substr($dates, ($posy-4), 4);
		
		$posm = strpos($dates, '月');
		if ($posm !== false) {
			$m = substr($dates, $posy+3, ($posm-$posy-3)); 
			$m = intval($m);
			if ($m < 10)
				$m = "0".$m;
		}
		$posd = strpos($dates, '日');
		if ($posd !== false) {
			$d = substr($dates, $posm+3, ($posd-$posm-3));
			$d = intval($d);
			if ($d < 10)
				$d = "0".$d;
		}
		$newdate = $y. "-".$m. "-".$d;
	}
	else if (strstr($dates, "-")) {
		list($d, $m, $y) =  explode("-", $dates);
		if ($y > 1900)
			$newdate = $y. "-".$m. "-".$d;
	}
	return $newdate;
}

function getChineseFormatDate($dates) {
	list($d, $m, $y) =  explode("-", $dates);
	if ($y > 1900) {
		return ($y. "年". $m. "月". $d."日");
	}
	else {
		return ($d. "年". $m. "月". $y."日");
	}
}

function getFrenchFormatDate($dates) {
	list($d, $m, $y) =  explode("-", $dates);
	if ($y > 1900) {
		return $dates;
	}
	else {
		return ($y. "-". $m. "-". $d);
	}
}

function site() {
	echo("<a href='http://culture-oushi.com/'>http://culture-oushi.com/<a>");
}

function getDateTime($timestamp) {
	$str = gmdate('n', $timestamp). "/" .gmdate('j', $timestamp). "/" .gmdate('Y', $timestamp). " - " ;
	$str .= gmdate('G', $timestamp). ":" .gmdate('i', $timestamp). ":" .gmdate('s', $timestamp). "  " ;
	return $str;
}

function getSchoolYear() {
	$year = date("Y");
	if (date("m") < 9)
		$year--;
	return $year;
}

function getMonthDayString($s_y, $s_m, $s_d, $i) {
	$m = (int)$s_m; 
	$d = (int)$s_d;
	$y = (int)$s_y;
	$d += $i;
	if ($d > 31) {
		$d -= 31;
		$m++;
		if ($m > 12) {
			$m = 1;
			$y++;
		}
	}
	$s = "";
	if ($d < 10) {
		$s .= "0";
	}
	$s .= $d."-";
	if ($m < 10) {
		$s .="0";
	}
	$s .= $m."-".$y;

	return $s;
}

function replace_newline($string, $toHTML) {

	$newstr = $string;
	if ($string) {
		if ($toHTML) {
			$newstr = str_replace("\r\n", "<br>", $newstr);
			$newstr = str_replace("\n", "<br>", $newstr);
		}
		else {
			$newstr = str_replace("<br>", "\n", $string);
		}
	}
	return $newstr;
}

function replace_backslash($string) {
	return (string) str_replace('\\', "", $string);;
}


function replace_areatext($string) {

	return (string)str_replace("\\\'", "\'", $string);
}

function replace_frenchpath($str) {
	$ss = $str;
	$ss = str_replace("\".\$PHOTO_PATH.\"", "../../photos/", $str);
	if (!strstr($ss, "../../photos")) {
		return str_replace("../photos", "../../photos", $ss);
	}
	else {
		return $ss;
	}
}


function replace_forbase($str) {
	$newstr = $str;
	if ($str ) {
		$newstr = str_replace('"', "\"", $newstr);
		$newstr = str_replace("'", "\'", $newstr);
	}
	return $newstr;
}

function replace_forfield($str) {
	$newstr = $str;
	if ($str ) {
		$newstr = str_replace('\"', "&quot;", $newstr);
		$newstr = str_replace("\'", "&#039;", $newstr);
		$newstr = str_replace('"',  "&quot;", $newstr);
		$newstr = str_replace("'",  "&#039;", $newstr);
	}
	return $newstr;
}

function replace($str) {
	$newstr = "";
	if ($str) {
		if (strstr($str, "&quot;") || strstr($str, "&#039;")) {
			$newstr = $str;
			$newstr = str_replace("&quot;", "\"", $newstr);
			$newstr = str_replace("&#039;", "'",  $newstr);
		}
		else {
			$newstr = htmlspecialchars($str, ENT_NOQUOTES);
			$newstr = htmlspecialchars($str, ENT_QUOTES);
			$newstr = str_replace('\"', "&quot;", $newstr);
			$newstr = str_replace("\'", "&#039;", $newstr);
			$newstr = str_replace('\\', "", $newstr);
		}
	}
	return $newstr;
}

function getNewsTitle($str) {
	return mb_substr($str, 0, 16, "UTF-8");
}

function changeDefinedTag($str) {
	$newstr = $str;
	$newstr = str_replace("<TH1>", "<div class=note_title><h1>", $newstr);
	$newstr = str_replace("</TH1>", "</h1></div>", $newstr);
	$newstr = str_replace("<TSPAN>", "<span class=spanarticle>", $newstr);
	$newstr = str_replace("</TSPAN>", "</span>", $newstr);
	$newstr = str_replace("<W>", "<a href='", $newstr);
	$newstr = str_replace("</W>", "' target=_blank>", $newstr);
	return $newstr;
}
function changeTMPTag($str, $newstype) {
	$newstr = $str;
	$imagepath = "school";
	switch ($newstype) {
		case 1:
			$imagepath = "jiaoliunews";
			break;
		case 2:
			$imagepath = "wenyunews";
			break;
		case 3:
			$imagepath = "huajiao";
			break;
	}
	$newstr = str_replace("<TIMG>", "<IMG width=500 src='\".\$PHOTO_PATH.\"".$imagepath."/", $newstr);
//	$newstr = str_replace("<TIMG>", "<IMG width=500 src='../photos/".$imagepath."/", $newstr);
	$newstr = str_replace("</TIMG>", "'>", $newstr);
	$newstr = str_replace("<TH1>", "<div class='note_title'><h1>", $newstr);
	$newstr = str_replace("</TH1>", "</h1></div>", $newstr);
	$newstr = str_replace("<TSPAN>", "<span class='spanarticle'>", $newstr);
	$newstr = str_replace("</TSPAN>", "</span>", $newstr);
	$newstr = str_replace("<W>", "<a href='", $newstr);
	$newstr = str_replace("</W>", "' target='_blank'>", $newstr);
	$newstr = str_replace("&quot;.\$PHOTO_PATH.&quot;", "\".\$PHOTO_PATH.\"", $newstr);
	$newstr = str_replace("../photos/", "\".\$PHOTO_PATH.\"", $newstr);
	return $newstr;
}
function replace_photo($str, $photoname, $photopath, $n) {
	$newstr = $str;
	$newstr = str_replace("<IMG".$n.">", "<IMG src='".$photopath."/".$photoname."' width=500>", $newstr);
	return $newstr;
}

function replace_files($str, $filename, $n) {
	$newstr = $str;
	$newstr = str_replace("<F".$n.">", "<A href='../files/".$filename."'>", $newstr);
	$newstr = str_replace("</F>", "</A>", $newstr);
	return $newstr;
}

function resize_photo($srcname, $destname, $path, $w) {
	if (strstr(strtoupper($srcname), ".JPG")) {
		$file = $path."/".$srcname; 		
		$o_file = $path."/".$destname; 		
		
		list($width, $height) = getimagesize($file) ; 
		$image = imagecreatefromjpeg($file) ; 
			
		$percent = $w/$width;
		$newwidth = $width * $percent;
		$newheight = $height * $percent;
		$tn = imagecreatetruecolor($newwidth, $newheight) ; 
		imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
		imagejpeg($tn, $o_file, 75) ; 	
	}
}	

function changeDoubleString($str) {
	$newstr = $str;
	$newstr = str_replace("\"", "&quot;", $newstr);
	return $newstr;
}

function changeReturnToArray($str) {
	$newstr = $str;
	$newstr = str_replace("\n", "\", \"", $newstr);
	return $newstr;
}


function fileToTable($fileName) {
	$tab = array();
	$cn = 0;
	$rn = 0;
	$lines = file($fileName);
	foreach($lines as $line)
	{
		$ll = trim($line);
		if (strlen($ll) > 1) {
			$tab[$rn++] = $ll;
			if (isQuestionLine($ll)) {
				$cn = 0;
			}
			$cn++;
		}
	}
	$arr = array();
	if ($rn > 0) {
		for ($i = 0; $i < $rn; $i+= $cn) {
			$arr[] = getQuestionLine($tab, $cn, $i);
		}
	}
	return $arr;
}

function getTextFileList($dirName) {
	$dir = "../public/" .$dirName;
	$files = array();
	if ($handle = opendir($dir)) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				if(is_file($dir."/".$file) && strpos($file, '.txt',1) ) {
					$files[] = $file;
				}
			}
		}
		closedir($handle);
	}
	return $files;
}

function getMonthSimple($m) {
	$MONTH = array("", "Jan",  "Feb", "Mar", "Apr", "May", "June", "July", "Aug",
	"Sep", "Oct", "Nov", "Dec"); 
	return $MONTH[(int)$m];
}

function getMonth($m) {
	$MONTH = array("", "一",  "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二");
	return $MONTH[(int)$m];
}

function getRewardPosition($reward) {
	$NUM = array("一", "1",  "二",  "2", "三", "3", "四", "4" , "五", "5");
	$nb = count($NUM)/2;
	if (is_numeric($reward)) {
		return $reward;
	}
	else {
		for ($i = 0; $i < $nb; $i++) {
			if (strstr($reward, $NUM[$i*2]) || strstr($reward, $NUM[$i*2+1])) {
				return ($i+1);
			}
		}
	}
	return ($nb+1);
}

function getDay($d) {
	$MONTH = array(
		"", "一",  "二", "三", "四", "五", "六", "七", "八", "九", "十", 
		"十一", "十二", "十三", "十四", "十五", "十六", "十七", "十八", "十九", "二十", 
		"二十一", "二十二", "二十三", "二十四", "二十五", "二十六", "二十七", "二十八", "二十九", "三十", "三十一", 
	);
	return $MONTH[(int)$d];
}
function getWeekday($d) {
	$WEEKDAY = array("星期天", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期天");
	if (is_numeric($d))
		return $WEEKDAY[$d];
	else 
		return $d;
}
function getWeekdayF($d) {
	$WEEKDAY = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
	if (is_numeric($d))
		return $WEEKDAY[$d];
	else 
		return $d;
}
function getWeekdayFromYMD($annee, $mois, $jour) {
	$annee = trim($annee);
	$mois = trim($mois);
	$jour = trim($jour);
	$tstamp = mktime(0,0,0,$mois,$jour,$annee);
	$Tdate = getdate($tstamp);
	$ret = getWeekday($Tdate["wday"]);
	return $ret;
}

function getWeekdayFromYear($year) {
	$annee = '';
	$mois = '';
	$jour = '';
	if (strstr($year, "/")) {
		list($mois, $jour, $annee) =  explode("/", $year);
	}
	else if (strstr($year, "-")) {
		list($annee, $mois, $jour) =  explode("-", $year);
	}
	$ret = "";
	if ($annee && $mois && $jour) {
		$ret =getWeekdayFromYMD($annee, $mois, $jour);
	}
	return $ret;
}

function getWeekStartDate($year) {
	$annee = '';
	$mois = '';
	$jour = '';
	if (strstr($year, "/")) {
		list($mois, $jour, $annee) =  explode("/", $year);
	}
	else if (strstr($year, "-")) {
		list($annee, $mois, $jour) =  explode("-", $year);
	}
	$ret = 0;
	if ($annee && $mois && $jour) {
		$annee = trim($annee);
		$mois = trim($mois);
		$jour = trim($jour);
		$tstamp = mktime(0,0,0,$mois,$jour,$annee);
		$Tdate = getdate($tstamp);
		$ret = ($Tdate["wday"]);
	}
	return $ret;
}

function formatDate($year) {

	$timestamp = strtotime($year);
	return (date('m/d/Y', $timestamp));


}

function formatTime($times) {
	$pm = 0;
	$strtime = strtoupper($times);
	$pos = strpos($strtime, "AM");
	if ($pos) {
		$strtime = substr($times,0,$pos);
	}
	$pos = strpos($strtime, "PM");
	if ($pos) {
		$strtime = substr($times,0,$pos);
		$pm = 12;
	}

	if (strstr($strtime, ":")) {
		list($h, $m) = explode(":", $strtime);
		$h = trim($h);
		$m = trim($m);
		if (strlen($m) == 1)
		$m = "0.$m";
	}
	else {
		$h = trim($strtime);
		$m = "00";
	}
	$h = $h + $pm;
	if (strlen($h) == 1)
	$h = "0".$h;
	return $h.":".$m;
}

function getshortLocalDateTime() {
	global $LOCAL_TIME;
	$timestamp = strtotime("-" .$LOCAL_TIME." hours");
	$dt = date("m/d-H:i", $timestamp);
	return $dt;
}


function cmpDate($year1, $year2) {
	if (strstr($year1, "/")) {
		list($m1, $d1, $y1) =  explode("/", $year1);
		$yy1 = $y1."-".$m1."-".$d1;
	}
	else {
		$yy1 = $year1;
	}
	if (strstr($year2, "/")) {
		list($m1, $d1, $y1) =  explode("/", $year2);
		$yy2 = $y1."-".$m1."-".$d1;
	}
	else {
		$yy2 = $year2;
	}
	return strcmp($yy1, $yy2);
}
function canBeCanceled($dates, $beginning) {
	global $LOCAL_TIME;
	if ($dates) {
		$index = cmpDate($dates, date("Y-m-d"));
		if ($index < 0) {
			return -1;
		}
		else if ($index > 0) {
			return 1;
		}
		else {
			$timestamp = strtotime("-" .$LOCAL_TIME." hours");
			$dt = date("H:i", $timestamp);
			$index= strcmp($beginning, $dt);
			if ($index > 0) {
				$timestamp = strtotime("-". ($LOCAL_TIME-5)." hours");
				$dt = date("H:i", $timestamp);
				$index= strcmp($beginning, $dt);
				if ($index > 0) {
					return 1;
				}
				else {
					return 0;
				}
			}
			else {
				return -1;
			}
		}
	}
	return 1;
}

function canRequest($dates, $beginning) {
	global $LOCAL_TIME;
	if ($dates) {
		$index = cmpDate($dates, date("Y-m-d"));
		if ($index < 0) {
			return -1;
		}
		else if ($index > 0) {
			return 1;
		}
		else {
			$timestamp = strtotime("-" .$LOCAL_TIME." hours");
			$dt = date("H:i", $timestamp);
				
			$index= strcmp($beginning, $dt);
			if ($index > 0) {
				return 1;
			}
			else {
				return 0;
			}
		}
	}
	return 1;
}

function getWeekDates($dates) {
	if ($dates) {
		$num = getWeekStartDate($dates);
		if (strstr($dates, "/")) {
			list($m, $d, $y) =  explode("/", $dates);
		}
		else if (strstr($dates, "-")) {
			list($y, $m, $d) =  explode("-", $dates);
		}
	}
	else {
		$now = time();
		$num = date("w");
		$d = date("d", $now);
		$m = date("m", $now);
		$y = date("Y", $now);
	}
	if ($num == 0) {
		$sub = 6;
	}
	else {
		$sub = $num-1;
	}
	$d -= $sub;


	$wlist = array();
	for ($i = 0; $i < 7; $i++) {
		$wd  = mktime(0, 0, 0, $m, $d, $y);
		//		$wlist[] = date("m/d/Y", $wd);
		$wlist[] = date("Y-m-d", $wd);
		$d++;
	}
	return  $wlist;
}

function getWeekPeriods($dates) {
	$dd = '';
	if (strstr($dates, "/")) {
		list($m1, $d1, $y1) =  explode("/", $dates);
		$dd = $m1. "/" .$d1;
	}
	else if (strstr($dates, "-")) {
		list($m1, $d1, $y1) =  explode("-", $dates);
		$dd = $m1. "/" .$d1;
	}
	return $dd;
}

function getDisplayDate($dates) {
	$dd = $dates;
	if (strstr($dates, "-")) {
		list($m1, $d1, $y1) =  explode("-", $dates);
		if (strlen($m1) == 4) {
			$mm = $d1;
			$d1 = $y1;
			$y1 = $m1;
			$m1 = $mm;
		}
		if (strlen($d1) == 1) {
			$d1 = "0".$d1;
		}
		if (strlen($m1) == 1) {
			$m1 = "0".$m1;
		}
		$dd = $m1."/".$d1."/".$y1;
	}
	return $dd;
}

function getOrderDate($dates) {
	$dd = $dates;
	if (strstr($dates, "/")) {
		list($m1, $d1, $y1) =  explode("/", $dates);
		if (strlen($d1) == 1) {
			$d1 = "0".$d1;
		}
		if (strlen($m1) == 1) {
			$m1 = "0".$m1;
		}
		$dd = $y1."-".$m1."-".$d1;
	}
	return $dd;
}

function getDisplayTime($times) {
	$tt = $times;
	if (strlen($times) > 3) {
		$tt = strtoupper($times);
		if(strstr($tt, "AM") || strstr($tt, "PM")) {
				
		}
		else {
			$var = "am";
			list($h1, $m1) =  explode(":", $times);
			$h1 = trim($h1);
			$m1 = trim($m1);
			if ($h1 > 12) {
				$var = "pm";
				$h1 -= 12;
			}
			if (strlen($h1) == 1) {
				$h1 = "0".$h1;
			}
			if (strlen($m1) == 1) {
				$m1 = "0".$m1;
			}
			$tt = $h1.":".$m1. $var;
		}
	}
	return $tt;
}

function getOrderTime($times) {
	$tt = strtoupper($times);
	if (strstr($times,":")) {
		$am = strrpos($tt, "AM");
		if ($am) {
			$st = trim(substr($tt,0,$am));
			list($h1, $m1) =  explode(":", $st);
		}
		else {
			$pm = strrpos($tt, "PM");
			if ($pm) {
				$st = trim(substr($tt,0,$pm));
				list($h1, $m1) =  explode(":", $st);
				$h1 += 12;
			}
			else {
				list($h1, $m1) =  explode(":", $tt);
			}
		}
		if (strlen($h1) == 1) {
			$h1 = "0".$h1;
		}
		if (strlen($m1) == 1) {
			$m1 = "0".$m1;
		}
		$tt = $h1.":".$m1;
	}
	else {
		$tt = "24:00";
	}
	return $tt;
}

$FALL_END_DATE = 25;
$SPRING_END_DATE = 10;
$SUMMER_END_DATE = 25;

function getSemesterYear() {
	global $FALL_END_DATE;
	$y = date("Y");
	$m = date("n");
	$d = date("d");
	if ($m == 1 && $d < $FALL_END_DATE)
	$y--;
	return $y;
}

function isEndSemester() {
	global $FALL_END_DATE;
	$isend = 0;
	$m = date("n");
	$d = date("d");
	switch ($m) {
		case 1 :
			if ($d < $FALL_END_DATE)
			$isend = 1;
			break;
		case 2 :
		case 3 :
		case 4 :
		case 5 :
			break;
		case 6 :
			if ($d > 21)
			$isend = 1;
			break;
		case 7 :
			if ($d < 4)
			$isend = 1;
			break;
		case 8 :
			break;
		case 9 :
			if ($d < 10)
			$isend = 1;
			break;
	}
	return $isend;
}

function getAnnee($year='') {
	if ($year && strlen($year) > 3) {
		if (strstr($year, "/")) {
			list($m, $d, $y) =  explode("/", $year);
		}
		else if (strstr($year, "-")) {
			list($m, $d, $y) =  explode("-", $year);
		}
		else
		$y = $year;
	}
	else {
		$y = getSemesterYear();
	}
	return $y;

}

function getSemesterByString($sem) {
	if ($sem && strlen($sem) > 3)
	return $sem;
	else
	return getSemester();
}

function getYearByString($yy) {
	if ($yy && strlen($yy) == 4)
	$annee = $yy;
	else
	$annee = getAnnee();
	return $annee;
}


function getSemester($year ='') {
	global $FALL_END_DATE, $SPRING_END_DATE, $SUMMER_END_DATE;
	global $SEMESTERS, $SEMESTER_FALL, $SEMESTER_SPRING, $SEMESTER_SUMMER;

	$m = '';
	$d = '';
	$y = '';
	if ($year  && strlen($year) > 6) {
		if (strstr($year, "/")) {
			list($m, $d, $y) =  explode("/", $year);
		}
		else if (strstr($year, "-")) {
			list($m, $d, $y) =  explode("-", $year);
		}
	}
	else {
		$m = date("n");
		$d = date("d");
	}
	switch ($m) {
		case 1:
			if ($d > $FALL_END_DATE)
			$semester = $SEMESTERS[$SEMESTER_SPRING];
			else
			$semester = $SEMESTERS[$SEMESTER_FALL];
			break;
		case 7:
		case 8:
			$semester = $SEMESTERS[$SEMESTER_SUMMER];
			break;
		case 9:
			if ($d < $SUMMER_END_DATE)
			$semester = $SEMESTERS[$SEMESTER_SUMMER];
			else
			$semester = $SEMESTERS[$SEMESTER_FALL];
			break;
		case 10:
		case 11:
		case 12:
			$semester = $SEMESTERS[$SEMESTER_FALL];
			break;
		default :
			$semester = $SEMESTERS[$SEMESTER_SPRING];
			break;
	}
	return $semester;
}

function getCurrentDate() {
	return date("m/d/Y - H:i:s");
}

function getSctudentScores($id, $scoreslists)
{
	$ns = count($scoreslists);
	for ($i = 0; $i < $ns; $i++)
	{
		$stscores = $scoreslists[$i];
		if ($stscores && $stscores->getStudentID() == $id) {
			return $stscores;
		}
	}
	return 0;
}


function getStudentScoresTable($studentid, $scoreslists, $total_nb, $test_nb, $page)
{
	$slist = array();
	$scoreslist_nb = count($scoreslists);
	$end  = $scoreslist_nb - $page * $total_nb;
	if ($end > 0) {
		for ($i = 0; $i < $end; $i++) {
			$sclists = $scoreslists[$end - $i - 1];
			$slist[] = getSctudentScores($studentid, $sclists);
		}
	}
	return $slist;
}

function hasStudentScores($studentid, $scoreslists)
{
	$nb_list = count($scoreslists);
	for ($i = 0; $i < $nb_list; $i++) {
		$sclists = $scoreslists[$i];
		$score = getSctudentScores($studentid, $sclists);
		if ($score) {
			if ($score->getTotalScores() > 0) {
				return 1;
			}
		}
	}
	return 0;
}

function getScorePosition($titletable, $scoredate, $test_nb, $isTest) {
	$nb = count($titletable);
	if ($scoredate) {
		if ($isTest) {
			$start = $nb - $test_nb;
			$end = $nb;
		}
		else {
			$start = 0;
			$end = $nb - $test_nb;
				
		}
		for ($i = $start; $i < $end; $i++) {
			if ($titletable[$i] == $scoredate) {
				return $i;
			}
		}
	}
	return -1;
}

function getSubjectsTeacherName($scoresLists)
{
	for ($i = 0; $i < count($scoresLists); $i++) {
		$sclists = $scoresLists[$i];
		if ($sclists) {
			for ($j = 0; $j < count($sclists); $j++)
			{
				$stscores = $sclists[$j];
				if ($stscores && $stscores->getTeacher()) {
					return $stscores->getTeacher();
				}
			}
		}
	}
	return "";
}

function getScoresSubjectsName($sclists)
{
	for ($i = 0; $i < count($sclists); $i++)
	{
		$stscores = $sclists[$i];
		if ($stscores && $stscores->getSubjects()) {
			return $stscores->getSubjects();
		}
	}
	return "";
}
function getScoresTypeName($sclists)
{
	for ($i = 0; $i < count($sclists); $i++)
	{
		$stscores = $sclists[$i];
		if ($stscores && $stscores->getTypes()) {
			return $stscores->getTypes();
		}
	}
	return "";
}

function getCurrentDayMonth() {
	$mm = date("m");
	$dd = date("d");
	return ($dd."/".$mm);
}
function getCurrentPeriod() {

	$mm = date("m");
	$yy = date("Y");
	if ($mm < 8) {
		$period = ($yy-1). "-". $yy;
	}
	else {
		$period = $yy. "-". ($yy+1);
	}
	return $period;
}

function AreaTextToTable($str) {
	$tab = array();
	$lists  = explode("\n", $str);
	for ($i = 0; $i < count($lists); $i++) {
		if (trim($lists[$i])) {
			$tab[] = str_replace("\r", "", $lists[$i]);
		}
	}
	return $tab;
}

function ArrayToArrayString($tab) {
	$arr = "array(";
	if (count($tab) > 0) {
		for ($i = 0; $i < count($tab); $i++) {
			$arr .= "\"" .$tab[$i]. "\",\n";
		}
	}
	$arr .= ")";
	return $arr;
}

function StringToArrayString($str) {
	if (trim(str))
		$tab = AreaTextToTable(str);
	else 
		$tab = array();
	return ArrayToArrayString(tab);

}

function ArrayToString($arr) {
	$str = "";
	for ($i = 0; $i < count($arr); $i++) {
		$str .= $arr[$i]. "\n";
	}
	return $str;
}
function ArrayToHTMLString($arr) {
	$str = "";
	for ($i = 0; $i < count($arr); $i++) {
		$str .= $arr[$i]. "<br>";
	}
	return $str;
}

?>
