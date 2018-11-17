<?php
include_once("../french/french_news_include.inc");
include_once("../public/topphoto.items.inc");
include_once("../huigu/huigu_include.php");
include_once("../public/huigu/huigulists.inc");

class NewsForm {

	var $maxfile = 5;
	
	function uploadFile($srcfile, $destfile, $path, $size) 
	{
		$ret = 1;
		
		if ($destfile && $srcfile) {
			$lowstr = strtolower($destfile);
			if (strstr($lowstr, ".pdf") || strstr($lowstr, ".doc")) {
				$ret = move_uploaded_file($srcfile, "../files/".$destfile);
			}
			else {
				if (!file_exists($path)) {
		 			mkdir($path, 0777, true);
				}
				$ret = move_uploaded_file($srcfile, $path."/".$destfile);
				resize_photo($destfile, $destfile, $path, $size);
			}
		}
		else {
			$ret = 0;
		}
		return $ret;
	}

	function WriteAllNewsItem($alllists, $orgvarname="")
	{
		$text  = "ALLNEWSLISTS = array(\n";
		for ($i = 0;  $i <count($alllists); $i++) {
			if (!$orgvarname || $alllists[$i][3] != $orgvarname) {
				$text .= "\tarray(";
				for ($j = 0; $j < count($alllists[$i]); $j++) {
					$text .= "\"" .$alllists[$i][$j]. "\"";
					if ($j < count($alllists[$i]) -1) {
						$text .= ", ";
					}
				}
				$text .= "),\n";
			}
		}
		$text .= "); \n";

		$jstext = "var " .$text;
		$jstext = str_replace("array(", "[", $jstext);
		$jstext = str_replace(")", "]", $jstext);
		
		$filename = "../javascript/topphoto.items.js";
		$fp = fopen($filename, "w");
		fwrite($fp, $jstext);
		fclose($fp);
		
		$phptext  = "<?php\n\$" .$text. "\n?>\n";
		
		$filename = "../public/topphoto.items.inc";
		$fp = fopen($filename, "w");
		fwrite($fp, $phptext);
		fclose($fp);
	}

	
function RemoveNewsFromHomeList($newstype, $vname) {
	global 	$HOME_KZXX_NEWS_NAME, $HOME_JY_NEWS_NAME, $HOME_JL_NEWS_NAME, $HOME_YL_NEWS_NAME,
			$FHOME_KZXX_NEWS_NAME, $FHOME_JY_NEWS_NAME, $FHOME_JL_NEWS_NAME, $FHOME_YL_NEWS_NAME,
			$HOME_JL_NEWS_STAR, $HOME_JY_NEWS_STAR, $HOME_YL_NEWS_STAR;
	$NAME_TAB = array($HOME_JY_NEWS_NAME, $HOME_JL_NEWS_NAME, $HOME_YL_NEWS_NAME);
	$FNAME_TAB = array($FHOME_JY_NEWS_NAME, $FHOME_JL_NEWS_NAME, $FHOME_YL_NEWS_NAME);
	$FILE_TAB = array("news_jy.inc", "news_jl.inc", "news_wy.inc");
	$VNAME_TAB = array("HOME_JY_NEWS", "HOME_JL_NEWS", "HOME_YL_NEWS", "HOME_KZXX_NEWS");
	$STAR_TAB = array($HOME_JL_NEWS_STAR, $HOME_JY_NEWS_STAR, $HOME_YL_NEWS_STAR);
	
	$ctext = "<?php\n\n";
	$ftext = "<?php\n\n";
	
	
	/* kongzi xuexiao */ 
	if ($newstype == 0) {
		$ktab = array(); /* kzxx */
		$fktab = array();
		for ($i = 0; $i < count($HOME_KZXX_NEWS_NAME); $i++) {
			if ($HOME_KZXX_NEWS_NAME[$i] != $vname) {
				$ktab[] = $HOME_KZXX_NEWS_NAME[$i];
			}
		}
		for ($i = 0; $i < count($FHOME_KZXX_NEWS_NAME); $i++) {
			if ($FHOME_KZXX_NEWS_NAME[$i] != $vname) {
				$fktab[] = $FHOME_KZXX_NEWS_NAME[$i];
			}
		}
		$ctext .= $this->getVariableString("HOME_KZXX_NEWS", $ktab);
		$ftext .= $this->getVariableString("FHOME_KZXX_NEWS", $fktab);
	}
	
	
	$name_tab = $NAME_TAB[$newstype];
	$fname_tab = $FNAME_TAB[$newstype];
	$lists = array();
	$flists = array();
	for ($i = 0; $i < count($name_tab); $i++) {
		if ($name_tab[$i] != $vname) {
			$lists[] = $name_tab[$i];
		}
	}
	for ($i = 0; $i < count($fname_tab); $i++) {
		if ($fname_tab[$i] != $vname) {
			$flists[] = $fname_tab[$i];
		}
	}
	
	$news_vname = $VNAME_TAB[$newstype];

	
	$ctext .= $this->getVariableString($news_vname, $lists);
	$ftext .= $this->getVariableString("F".$news_vname, $flists);
	
	/* set news star */
	$star_list = $STAR_TAB[$newstype];
	$star = "\$" .$news_vname. "_STAR = array( ";
	for ($i = 0; $i < count($star_list); $i++) {
		if ($i > 0) {
			$star .= ", ";
		}
		if ($star_list[$i]) {
			$star .= "1";
		}
		else {
			$star .= "0";
		}
	}
	$star .= ");\n\n";
	$ctext .= $star;
	$ftext .= $star;
	$ctext .= "\n\n?>";
	$ftext .= "\n\n?>";
	
	$fname = $FILE_TAB[$newstype];
	
	$fp = fopen("../french/french_".$fname, "w");
	fwrite($fp, $ftext);
	fclose($fp);
 	
	
	$fp = fopen("../public/chinese_".$fname, "w");
	fwrite($fp, $ctext);
	fclose($fp);

}
	
	
function AddNewsToHomeList($newstype, $vname) {
	global 	$HOME_KZXX_NEWS_NAME, $HOME_JY_NEWS_NAME, $HOME_JL_NEWS_NAME, $HOME_YL_NEWS_NAME,
			$FHOME_KZXX_NEWS_NAME, $FHOME_JY_NEWS_NAME, $FHOME_JL_NEWS_NAME, $FHOME_YL_NEWS_NAME,
			$HOME_JL_NEWS_STAR, $HOME_JY_NEWS_STAR, $HOME_YL_NEWS_STAR;
	$NAME_TAB = array($HOME_JY_NEWS_NAME, $HOME_JL_NEWS_NAME, $HOME_YL_NEWS_NAME);
	$FNAME_TAB = array($FHOME_JY_NEWS_NAME, $FHOME_JL_NEWS_NAME, $FHOME_YL_NEWS_NAME);
	$FILE_TAB = array("news_jy.inc", "news_jl.inc", "news_wy.inc");
	$VNAME_TAB = array("HOME_JY_NEWS", "HOME_JL_NEWS", "HOME_YL_NEWS", "HOME_KZXX_NEWS");
	$STAR_TAB = array($HOME_JL_NEWS_STAR, $HOME_JY_NEWS_STAR, $HOME_YL_NEWS_STAR);
	
	$ctext = "<?php\n\n";
	$ftext = "<?php\n\n";
	
	
	/* kongzi xuexiao */ 
	if ($newstype == 0) {
		$ktab = array(); /* kzxx */
		$fktab = array();
		for ($i = 0; $i < count($HOME_KZXX_NEWS_NAME); $i++) {
			$ktab[] = $HOME_KZXX_NEWS_NAME[$i];
		}
		for ($i = 0; $i < count($FHOME_KZXX_NEWS_NAME); $i++) {
			$fktab[] = $FHOME_KZXX_NEWS_NAME[$i];
		}
		$ctext .= $this->getVariableString("HOME_KZXX_NEWS", $ktab);
		$ftext .= $this->getVariableString("FHOME_KZXX_NEWS", $fktab);
	}
	
	
	$name_tab = $NAME_TAB[$newstype];
	$fname_tab = $FNAME_TAB[$newstype];
	$lists = array();
	$flists = array();
	$lists[] = $vname;
	$flists[] = $vname;
	for ($i = 0; $i < count($name_tab); $i++) {
		$lists[] = $name_tab[$i];
	}
	for ($i = 0; $i < count($fname_tab); $i++) {
		$flists[] = $fname_tab[$i];
	}
	
	$news_vname = $VNAME_TAB[$newstype];

	
	$ctext .= $this->getVariableString($news_vname, $lists);
	$ftext .= $this->getVariableString("F".$news_vname, $flists);
	
	/* set news star */
	$star_list = $STAR_TAB[$newstype];
	$star = "\$" .$news_vname. "_STAR = array( ";
	for ($i = 0; $i < count($star_list); $i++) {
		if ($i > 0) {
			$star .= ", ";
		}
		if ($star_list[$i]) {
			$star .= "1";
		}
		else {
			$star .= "0";
		}
	}
	$star .= ");\n\n";
	$ctext .= $star;
	$ftext .= $star;
	$ctext .= "\n\n?>";
	$ftext .= "\n\n?>";
	
	$fname = $FILE_TAB[$newstype];
	
	$fp = fopen("../french/french_".$fname, "w");
	fwrite($fp, $ftext);
	fclose($fp);
 	
	
	$fp = fopen("../public/chinese_".$fname, "w");
	fwrite($fp, $ctext);
	fclose($fp);

}

	function WriteFastNews($newstype, $ni)
	{
		global $JY_NEWS, $JL_NEWS, $WY_NEWS, $FASTNEWS_JY, $FASTNEWS_JL, $FASTNEWS_WY,$FASTNEWS_ASSO, $ALLNEWSLISTS, $TOPPHOTOS, $FTOPPHOTOS;
		$NEWS_TABLE = array($JY_NEWS, $JL_NEWS, $WY_NEWS);
		$vname = "";
		$iname = "";
		$fname = "";
		$flist = "";
		$orgvars = "";
		$orgvarsname = "";
		$nb = 1;
		$n = 0;
		$nindex = $ni;
		$fastnews = $this->getFastNews();
		$news_list = $NEWS_TABLE[$newstype];
		$orgnewstype = getPostValue("orgnewstype");
		if (($orgnewstype != $newstype) && ($nindex > 0)) {
			$orgvars = getNewsVariables($orgnewstype, $nindex);
			$orgvarsname = $orgvars[4];
			/* remove news from old list */
			$orgnews_list = $NEWS_TABLE[$orgnewstype];
			WriteNewsListVariable($orgnews_list, $orgvars[0], $orgvars[1], $orgvars[2], $orgvars[5], 0, 1, ($nindex+1));
			$this->RemoveNewsFromHomeList($orgnewstype, $orgvarsname);
			$nindex = -1;	
		} 

		$w_type = $fastnews[7];
		$toc = $w_type[0];
		$tof = $w_type[1];
		
		$vars = getNewsVariables($newstype, $nindex);
		
		/* add/modify news list for TOP 5 */
		if ($nindex < 0) {
			$found = 0; 
			$alllists = array();
			if ($orgvarsname) {
				$toc = 1;
				$tof = 1;
				/* write top 5 photos */
				$should = 0;
				$toplists = array();
				for ($i = 0; $i < count($TOPPHOTOS); $i++) {
					if ($TOPPHOTOS[$i][2] == $orgvarsname) {
						$toplists[] = array($vars[4], $TOPPHOTOS[$i][1], $FTOPPHOTOS[$i][1]);
						$should = 1;
					}
					else {
						$toplists[] = array($TOPPHOTOS[$i][2], $TOPPHOTOS[$i][1], $FTOPPHOTOS[$i][1]);
					}
				}
				if ($should) {
					$this->WriteTopNews5($toplists, 1, 1);
				}
				
				/* modify all news list */
				for ($i = 0; $i < count($ALLNEWSLISTS); $i++) {
					if ($ALLNEWSLISTS[$i][3] == $orgvarsname) {
						$ALLNEWSLISTS[$i][0] =  $fastnews[0];
						$ALLNEWSLISTS[$i][3] =  $vars[4];
						$found = 1;
					}
				}	
				/* add variable to news list */			
				$this->AddNewsToHomeList($newstype, $vars[4]);
			}
			if(!$found) {
				$alllists[] = array($fastnews[0], "", "", $vars[4]);
			}
			for ($i = 0; $i < count($ALLNEWSLISTS); $i++) {
				$alllists[] = $ALLNEWSLISTS[$i];
			}
			$this->WriteAllNewsItem($alllists, $orgvarsname);
		}
		else {
			for ($i = 0; $i < count($ALLNEWSLISTS); $i++) {
				if ($ALLNEWSLISTS[$i][3] == $vars[4]) {
					if ($ALLNEWSLISTS[$i][0] != $fastnews[0]) {
						$ALLNEWSLISTS[$i][0] = $fastnews[0];
						$this->WriteAllNewsItem($ALLNEWSLISTS);
					}
					break;
				}
			}			
		}
		if ($nindex < 0)
			$n_line = $vars[5];
		else 
			$n_line = $nindex;
		/* $vars[0] = include lists file name, 	jlnews_lists.inc
		 * $vars[1] = include name,  			jl_news
		 * $vars[2] = var_name, 				JL_NEWS
		 * $vars[5] = variable_nb 				$nb
		 */
		WriteNewsListVariable($news_list, $vars[0], $vars[1], $vars[2], $vars[5], $n_line, 1, 0);
		
		/* $vars[3] = news file name, 			jl_news19.inc
		 * $vars[4] = news variable name, 		JL_NEWS16
		 * fastnews 
		 */
		// write chinese and french news
		WriteCFNewsVariable($vars[3], $vars[4],  $fastnews);
		
		// write chinese
		if ($toc == 1) {
			WriteNewsListVariable($news_list, $vars[6], $vars[1], $vars[2], $vars[5], $n_line, 0, 0);
			WriteCFNewsVariable($vars[7], $vars[4],  $fastnews, 0);
		}
		// write french 
		if ($tof == 1) {
			WriteNewsListVariable($news_list, $vars[8], $vars[1], $vars[2], $vars[5], $n_line, 0, 0);
			WriteCFNewsVariable($vars[9], $vars[4],  $fastnews[6], 0);
		}
		return $fastnews;
	}
	
	function getPhotoPath($newstype) {
		$imagepath = "jiaoyunews";
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
		return "../photos/".$imagepath;
	}
	
	function getFastNews() {
		$fastnews = array();
		$fastnews[]  = changeDoubleString($_POST["newstitle"]);  
		$fastnews[]  = changeDoubleString($_POST["resume"]);
		$fastnews[]  = changeDoubleString($_POST["subtitle"]);
		$fastnews[]  = changeDoubleString($_POST["newsdate"]);
		$orgnewstype = getPostValue("orgnewstype");
		$newstype = getPostValue("newstype");
		$photopath = $this->getPhotoPath($newstype);
		$texte  = changeDoubleString($_POST["fastnews"]);
		$ftexte  = changeDoubleString($_POST["ffastnews"]);
		
		$photos  = array();
		$fastnews[]  = $photos;

		for ($i = 1; $i <= $this->maxfile; $i++) {
			if(isset($_FILES['photo_'.$i]))
			{ 
		    	$photoname = basename($_FILES['photo_'.$i]['name']);
		     	$tmpName = $_FILES['photo_'.$i]['tmp_name'];
				if ($this->uploadFile($tmpName, $photoname, $photopath, 600)) {
				}
				$lowstr = strtolower($photoname);
				if (strstr($lowstr, ".pdf") || strstr($lowstr, ".doc")) {
					$texte = replace_files($texte, $photoname, $i);
					$ftexte = replace_files($ftexte, $photoname, $i);
				}
				else {
					$texte = replace_photo($texte, $photoname, $photopath, $i);
					$ftexte = replace_photo($ftexte, $photoname, $photopath, $i);
				}
			}
		}
		
		$texte  = changeTMPTag($texte, $newstype);
		$fastnews[]  = $texte; // 5
		
		$ff = array();
		$ff[]  = changeDoubleString($_POST["fnewstitle"]);  
		$ff[]  = changeDoubleString($_POST["fresume"]);
		$ff[]  = changeDoubleString($_POST["fsubtitle"]);
		$ff[]  = changeDoubleString($_POST["fnewsdate"]);
		$ff[]  = $photos;
		
		
		
		$ftexte  = changeTMPTag($ftexte, $newstype);
		$ff[]  = $ftexte;  
		$fastnews[]  = $ff; // 6
		
		$witetype  = array();
		$witetype[]  = getPostValue("writetype_2");
		$witetype[]  = getPostValue("writetype_3");
		$fastnews[]  = $witetype;
		
		
		return $fastnews;
	}
	
	function getTopNews() {
		global $TOPPHOTOS, $ALLNEWSLISTS;
		$topnews = array();
		$order = array();
		$photopath = "top";
		$writeallnews = 0;
		for ($i = 1; $i <= count($TOPPHOTOS); $i++) {
			
			$tindex = getPostValue("phototitle_".$i);
			
			$ff = array();
			$ff[] = getPostValue("tvariable_".$i);
			$cfile = $photopath."/".getPostValue("tphoto_".$i);
			$ff[] = $cfile;
			
			$ffile = getPostValue("ftphoto_".$i);  
			if ($ffile) {
				$ff[] = $photopath."/".$ffile;  
			}
			else {
				$ff[] = $cfile;
			}
			
			if(isset($_FILES['fphoto_'.$i]))
			{ 
		    	$photoname = basename($_FILES['fphoto_'.$i]['name']);
		     	$tmpName = $_FILES['fphoto_'.$i]['tmp_name'];
				if ($this->uploadFile($tmpName, $photoname, "../photos/".$photopath, 650)) {
					$ALLNEWSLISTS[$tindex][1] = $photoname;
					$writeallnews = 1;
				}
				
			}
			if(isset($_FILES['ffphoto_'.$i]))
			{ 
		    	$photoname = basename($_FILES['ffphoto_'.$i]['name']);
		     	$tmpName = $_FILES['ffphoto_'.$i]['tmp_name'];
				if ($this->uploadFile($tmpName, $photoname, "../photos/".$photopath, 650)) {
					$ALLNEWSLISTS[$tindex][2] = $photoname;
					$writeallnews = 1;
				}
			}
			$topnews[]  = $ff;
		}
		if ($writeallnews) {
			$this->WriteAllNewsItem($ALLNEWSLISTS);
		}
		return $topnews;
	}

	function WriteTopNews5($topnews, $toc, $tof)
	{
		if ($toc) {
			$text  = "<?php\n\n\$TOPPHOTOS = array(\n";
			for ($i = 0; $i < count($topnews); $i++) {
				$text .= "\t array(\$" .$topnews[$i][0]. ", \"".$topnews[$i][1]. "\", \"" .$topnews[$i][0]."\")";
				if ($i == count($topnews)-1) {
					$text .= "\n";
				}
				else {
					$text .= ",\n";
				}
			}
			$text .= ");\n?>\n";
			$fp = fopen("../public/chinese_top.inc", "w");
			fwrite($fp, $text);
			fclose($fp);
		}
		if ($tof) {
			$text  = "<?php\n\n\$FTOPPHOTOS = array(\n";
			for ($i = 0; $i < count($topnews); $i++) {
				$text .= "\t array(\$" .$topnews[$i][0]. ",\t\"".$topnews[$i][2]. "\", \"" .$topnews[$i][0]."\")";
				if ($i == count($topnews)-1) {
					$text .= "\n";
				}
				else {
					$text .= ",\n";
				}
			}
			$text .= ");\n?>\n";
			$fp = fopen("../french/french_top.inc", "w");
			fwrite($fp, $text);
			fclose($fp);
		}
	}

	function getNewsIndex($tvar) {
		$item = array(0,0);
		if ($tvar) {
			$vname = substr($tvar, 0, 7); 
			$item[0] = 0;
			if (strstr($vname, "JL_")) {
				$item[0] = 1;
			}
			else if (strstr($vname, "WY_")) {
				$item[0] = 2;
			}
			$item[1] = substr($tvar, 7);
		}
		return $item;
	}
	
	function WriteTopNews()
	{
		$topnews = $this->getTopNews();
		
		$toc = getPostValue("tochinese");  
		$tof = getPostValue("tofrench");  
		
		$this->WriteTopNews5($topnews, $toc, $tof );

	}

function showNewsForm($fastnews, $newstype, $nindex, $isupdate, $msg) {
	global $NEWS_TYPE;

	$action = "addfastnews";
	$newstitle = "";
	$resume = "";
	$subtitle = "";
	$newstime = "";
	$news = "";
	$fnewstitle = "";
	$fresume = "";
	$fsubtitle = "";
	$fnewstime = "";
	$fnews = "";
	$photos = array("","","","","","","","","","");
	if ($fastnews) {
		$newstitle = $fastnews[0];
		$resume = $fastnews[1];
		$subtitle = $fastnews[2];
		$newstime = $fastnews[3];
		
		$ff = array();
		if (count($fastnews) > 6) {
			$ff = $fastnews[6];
			$fnewstitle = $ff[0];
			$fresume = $ff[1];
			$fsubtitle = $ff[2];
			$fnewstime = $ff[3];
		}
		
		$photos = $fastnews[4];
		if ($isupdate) {
			$nb = count($fastnews[5]);
			while($nb > 0) {
				if (trim($fastnews[5][$nb-1])) {
					break;
				}
				$nb--;
			}
			$news = "";
			for ($i = 0; $i < $nb; $i++) {
				$news .= $fastnews[5][$i]. "\n";
			}

			$fnews = "";
			if (count($ff) > 5) {
				$nb = count($ff[5]);
				while($nb > 0) {
					if (trim($ff[5][$nb-1])) {
						break;
					}
					$nb--;
				}
				for ($i = 0; $i < $nb; $i++) {
					$fnews .= $ff[5][$i]. "\n";
				}
			}
		}
		else {
			$news = $fastnews[5];
			if (count($ff) > 5) {
				$fnews = $ff[5];
			}
		}
	}
?>

<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
	<TR><TD class=error><?php echo($msg) ?></TD></TR>
	<TR>
		<TD height=50>
			<h2>欧洲时报文化中心快讯</h2>
		</TD>
	</TR>
	<TR>
		<TD>
		<FORM action='admin.php' name="uploadnews" method=post enctype="multipart/form-data">
		<INPUT type=hidden name='action' value='<?php echo($action); ?>'>
		<INPUT type=hidden name='mtype' value='<?php echo($NEWS_TYPE); ?>'>
		<INPUT type=hidden name='nindex' value='<?php echo($nindex); ?>'>
		<INPUT type=hidden name='orgnewstype' value='<?php echo($newstype); ?>' >
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD >
				<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
				<TR>
					<TD width=10% class=labelright1 height=30>快讯题目 : </TD>
					<TD width=90%>
						<div align=left>
						<INPUT class=fields type=text size=80 name="newstitle" value="<?php echo($newstitle); ?>">
						</div>
					</TD>
				</TR>
				<TR>
					<TD width=10% class=labelright1 height=30>快讯简介 : </TD>
					<TD width=90%>
						<div align=left>
						<INPUT class=fields type=text size=80 maxlength="55" name="resume" value="<?php echo($resume); ?>">
						</div>
					</TD>
				</TR>
				<TR>
					<TD width=10% class=labelright1 height=30>快讯付标题 : </TD>
					<TD width=90%>
						<div align=left>
						<INPUT class=fields type=text size=80 name="subtitle" value="<?php echo($subtitle); ?>">
						</div>
					</TD>
				</TR>
				<TR>
					<TD width=15% class=labelright1 height=30>发布日期 : </TD>
					<TD width=85%>
						<div align=left>
						<INPUT class=fields type=text size=80 name="newsdate" value="<?php echo($newstime); ?>">
						</div>
					</TD>
				</TR>
				<TR>
					<TD width=10% class=labelright1 height=40>快讯类型 : </TD>
					<TD width=90%><div align=left>&nbsp;&nbsp;
					<?php if ($newstype == 1 ) { ?>
						<INPUT class=box type='radio' name='newstype' value='0'> 文化教育
						&nbsp;&nbsp;&nbsp;&nbsp; 
						<INPUT class=box type='radio' name='newstype' value='1'  checked> 文化交流
						&nbsp;&nbsp;&nbsp;&nbsp; 
						<INPUT class=box type='radio' name='newstype' value='2'> 文艺活动
					<?php } else if ($newstype == 2) { ?>
						<INPUT class=box type='radio' name='newstype' value='0'> 文化教育快讯
						&nbsp;&nbsp;&nbsp;&nbsp; 
						<INPUT class=box type='radio' name='newstype' value='1' > 文化交流快讯
						&nbsp;&nbsp;&nbsp;&nbsp; 
						<INPUT class=box type='radio' name='newstype' value='2' checked> 文艺活动消息
					<?php } else { ?>
						<INPUT class=box type='radio' name='newstype' value='0' checked> 文化教育快讯
						&nbsp;&nbsp;&nbsp;&nbsp; 
						<INPUT class=box type='radio' name='newstype' value='1' > 文化交流快讯
						&nbsp;&nbsp;&nbsp;&nbsp; 
						<INPUT class=box type='radio' name='newstype' value='2'> 文艺活动消息
					<?php } ?>
					</div>
					</TD>
				</TR>
				<TR>
					<TD width=10% class=labelright1 height=40>发布消息 : </TD>
					<TD width=90%><div align=left>&nbsp;&nbsp;
						<INPUT class=box type='checkbox' name='writetype_2' value='1'  checked> 发布中文
						&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
						<INPUT class=box type='checkbox' name='writetype_3' value='1'> 发布法文
					</div>
					</TD>
				</TR>
				<TR>
					<TD width=10% class=labelright1 height=20>可改变格式 : </TD>
					<TD width=90%><div align=left>
						<font color=red>
						&lt;IMG#&gt; &nbsp;&nbsp;
						&lt;TH1&gt; 中间题目 &lt;/TH1&gt; &nbsp;&nbsp;
						&lt;TSPAN&gt; 左边空格 &lt;/TSPAN&gt; &nbsp;&nbsp;
						</font>
					</div>
					</TD>
				</TR>
				<TR>
					<TD width=10% class=labelright1 height=20> </TD>
					<TD width=90%><div align=left>
						<font color=red>
						&lt;b&gt;<b>粗体</b> &lt;/b&gt; &nbsp;&nbsp;
						&lt;em&gt;<em>斜体</em>&lt;/em&gt; &nbsp;&nbsp;
						空格符号(<font color=#000>要去掉-</font>): &-nbsp; 
						</font>
					</div>
					</TD>
				</TR>
				<TR>
					<TD width=10% class=labelright1 height=20> </TD>
					<TD width=90%><div align=left>
						<font color=red>
						&lt;font color=blue size=3&gt;<font color=blue size=3>蓝色3号字</font>&lt;/font&gt; &nbsp;&nbsp;
						&lt;font color=green size=1&gt;<font color=green size=1>绿色1号字</font>&lt;/font&gt; &nbsp;&nbsp;
						</font>
					</div>
					</TD>
				</TR>
				<TR>
					<TD width=10% class=labelright1 height=25>链接格式 : </TD>
					<TD width=90%><div align=left>
						<font color=red>
						&lt;W&gt;http://culture-oushi.com&lt;/W&gt;文化中心&lt;/A&gt; &nbsp;&nbsp;
						</font>
						</div>
					</TD>
				</TR>
				<TR>
					<TD width=10% class=labelright1 height=25>下载格式 : </TD>
					<TD width=90%><div align=left>
						<font color=red>
						&lt;F#&gt;点击下载文件&lt;/F&gt; &nbsp;&nbsp;(只能是DOC和PDF文件)
						</font>
						</div>
					</TD>
				</TR>
				<TR>
					<TD width=10% class=labelright1 valign=top>中文快讯 : </TD>
					<TD width=90%>
						<div align=left>
						<textarea class=fields name="fastnews" cols="68" rows="20"><?php echo($news); ?></textarea>
						</div>
					</TD>
				</TR>
				
				
				<TR>
					<TD width=10% class=labelright1 height=30>法文题目 : </TD>
					<TD width=90%>
						<div align=left>
						<INPUT class=fields type=text size=80 name="fnewstitle" value="<?php echo($fnewstitle); ?>">
						</div>
					</TD>
				</TR>
				<TR>
					<TD width=10% class=labelright1 height=30>法文简介 : </TD>
					<TD width=90%>
						<div align=left>
						<INPUT class=fields type=text size=80 maxlength="90" name="fresume" value="<?php echo($fresume); ?>">
						</div>
					</TD>
				</TR>
				<TR>
					<TD width=10% class=labelright1 height=30>法文付标题 : </TD>
					<TD width=90%>
						<div align=left>
						<INPUT class=fields type=text size=80 name="fsubtitle" value="<?php echo($fsubtitle); ?>">
						</div>
					</TD>
				</TR>
				<TR>
					<TD width=15% class=labelright1 height=30>法文日期 : </TD>
					<TD width=85%>
						<div align=left>
						<INPUT class=fields type=text size=80 name="fnewsdate" value="<?php echo($fnewstime); ?>">
						</div>
					</TD>
				</TR>
				<TR>
					<TD width=10% class=labelright1 valign=top>法文快讯 : </TD>
					<TD width=90%>
						<div align=left>
						<textarea class=fields name="ffastnews" cols="68" rows="20"><?php echo($fnews); ?></textarea>
						</div>
					</TD>
				</TR>
		<?php 
			for ($i = 1; $i <= $this->maxfile; $i++) {
		?>
				<TR>
					<TD width=15% class=labelright1 height=30>上传照片<?php echo($i); ?> : </TD>
					<TD width=85% class=labelright1>
						<div align=left>
						<input name="photo_<?php echo($i); ?>" size=35 type="file" id="photo_<?php echo($i); ?>">
						</div>
					</TD>
				</TR>				
		<?php } ?>
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD height=60 class=formlabel>
				<div align=center>
				<?php if ($isupdate) { ?>
				<INPUT class=button type=submit value=' 修改快讯 '>
				<?php } else { ?>
				<INPUT class=button type=submit value=' 添加快讯 '>
				<?php } ?>
				</div>
			</TD>
		</TR>
		</TABLE>
		</FORM>
	</TD>
</TR>
</TABLE>
<?php
}


function showTopPhotoForm($msg) {
	global $TOPPHOTOS, $FTOPPHOTOS, $PHOTO_TYPE, $ALLNEWSLISTS;
?>

<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
	<TR><TD class=error height=20><?php echo($msg) ?></TD></TR>
	<TR>
		<TD height=80><div class=item_tit>
			<h2>欧洲时报文化主页图片</h2>
			<h4><font color=red>(图片尺寸 650 x 380)</font></h4>
			</div>
		</TD>
	</TR>
	<TR><TD class=error height=20></TD></TR>
	<TR>
		<TD>
		<!-- FORM method=post action='admin.php' -->
		<FORM action='admin.php' name="uploadtopphoto" method=post enctype="multipart/form-data">
		<INPUT type=hidden name='action' value='modifytopphoto'>
		<INPUT type=hidden name='mtype' value='<?php echo($PHOTO_TYPE); ?>'>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD>
				<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<?php
		for ($i = 1; $i <= count($TOPPHOTOS); $i++) { 
				$elem = $TOPPHOTOS[$i-1];
				$felem = $FTOPPHOTOS[$i-1];
				$title = $elem[0][0];
				$photo = basename($elem[1]);
				$fphoto = basename($felem[1]);
				$vname = $elem[2];
?>
				<TR>
					<TD width=10% class=lcenter height=30> 
						<?php echo($i); ?>  : 				
					</TD>
					<TD width=45% class=labelleft>
						<select name="phototitle_<?php echo($i); ?>" STYLE='width:280px; color:black; align: center' onChange='javascript:setTopTitle(this, <?php echo($i); ?>);'>
	<?php 
						$tvar = "";
						for ($k = 0; $k < count($ALLNEWSLISTS); $k++) {
							$elems = $ALLNEWSLISTS[$k];
							if ($vname == $elems[3]) {
								echo ("<option value=".$k." selected> " .$elems[0]. " </option>");
								$tvar = $elems[3];
							}
							else {
								echo ("<option value=".$k."> " .$elems[0]. " </option>");
							}
						}
						?>
						</select>
					</TD>
					<TD width=45% class=labelleft>
						<input name="title_<?php echo($i); ?>" size=35 type="text" id="title_<?php echo($i); ?>" value="<?php echo($title); ?>" readonly>
						<input name="tvariable_<?php echo($i); ?>" id="tvariable_<?php echo($i); ?>" type="hidden" value="<?php echo($tvar); ?>">
					</TD>
				</TR>				
				<TR>
					<TD width=5% class=lcenter height=30 >中文图
					</TD>
					<TD width=50% class=labelleft>
						<input name="fphoto_<?php echo($i); ?>" type="file" id="fphoto_<?php echo($i); ?>" onChange='javascript:setTopPhoto(<?php echo($i); ?>, 0);'>
					</TD>
					<TD width=45% class=labelleft>
						<input name="tphoto_<?php echo($i); ?>" size=35 type="text" id="tphoto_<?php echo($i); ?>" value="<?php echo($photo); ?>">
					</TD>
				</TR>				
				<TR>
					<TD width=5% class=lcenter height=30 >法文图
					</TD>
					<TD width=50% class=labelleft>
						<input name="ffphoto_<?php echo($i); ?>" type="file" id="ffphoto_<?php echo($i); ?>" onChange='javascript:setTopPhoto(<?php echo($i); ?>, 1);'>
					</TD>
					<TD width=45% class=labelleft>
						<input name="ftphoto_<?php echo($i); ?>" size=35 type="text" id="ftphoto_<?php echo($i); ?>" value="<?php echo($fphoto); ?>">
					</TD>
				</TR>				
				<TR><TD colspan=3 height=20> </TD></TR>				
		<?php } ?>
				<TR>
					<TD colspan=3 valign=top height=50 class=lcenter>
						<INPUT class=box type='checkbox' name="tochinese" value='1' checked> 修改中文
						<INPUT class=box type='checkbox' name="tofrench" value='1'> 修改法文
					</TD>
				</TR>		
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD height=60 class=lcenter>
				<INPUT class=button type=submit value=' 修改主页图片 '>
			</TD>
		</TR>
		</TABLE>
		</FORM>
	</TD>
</TR>
</TABLE>
<?php
}

function findVariable($varname, $tab) {
	for ($i = 0; $i < count($tab); $i++) {
		if ($varname == $tab[$i]) {
			return $i;
		}
	}
	return -1;
}

function getVariableString($vname, $lists) {
	
	$text = "\$" .$vname. " = array(\n\t";
	for ($i = 0; $i < count($lists); $i++) {
		if ($i ==  count($lists) - 1) {
			$text .= "\$" .$lists[$i]. "\n";
		}
		else {
			$text .= "\$" .$lists[$i]. ", ";
		}
	}
	$text .= ");\n\n";

	$text .= "\$" .$vname. "_NAME = array(\n\t";
	for ($i = 0; $i < count($lists); $i++) {
		if ($i ==  count($lists) - 1) {
			$text .= "\"" .$lists[$i]. "\"\n";
		}
		else {
			$text .= "\"" .$lists[$i]. "\", ";
		}
	}
	$text .= ");\n\n";

	return $text;
}

function WriteToFile($vlists, $klists, $newlists, $n, $toc, $tof) {
	global 	$HOME_KZXX_NEWS_NAME, $HOME_JY_NEWS_NAME, $HOME_JL_NEWS_NAME, $HOME_YL_NEWS_NAME,
			$FHOME_KZXX_NEWS_NAME, $FHOME_JY_NEWS_NAME, $FHOME_JL_NEWS_NAME, $FHOME_YL_NEWS_NAME;
	$KZ_P = 3;
	$NAME_TAB = array($HOME_JY_NEWS_NAME, $HOME_JL_NEWS_NAME, $HOME_YL_NEWS_NAME);
	$FNAME_TAB = array($FHOME_JY_NEWS_NAME, $FHOME_JL_NEWS_NAME, $FHOME_YL_NEWS_NAME);
	$FILE_TAB = array("news_jy.inc", "news_jl.inc", "news_wy.inc");
	$VNAME_TAB = array("HOME_JY_NEWS", "HOME_JL_NEWS", "HOME_YL_NEWS", "HOME_KZXX_NEWS");
	
	$ctext = "<?php\n\n";
	$ftext = "<?php\n\n";
	
	/* Jiao yu news => kongzi xuexiao */ 
	if ($n == 0) {
		$vname = $VNAME_TAB[3];
		
		$ktab = array(); /* kzxx */
		$fktab = array();
		for ($i = 0; $i < count($klists); $i++) {
			$ktab[] = $klists[$i];
			$fktab[] = $klists[$i];
		}

		for ($i = 0; $i < count($HOME_KZXX_NEWS_NAME); $i++) {
			$ret = $this->findVariable($HOME_KZXX_NEWS_NAME[$i], $klists);
			if ($ret == -1) {
				$ktab[] = $HOME_KZXX_NEWS_NAME[$i];
			}
		}
		$ctext .= $this->getVariableString($vname, $ktab);
		
		/* kzxx french */
		for ($i = 0; $i < count($FHOME_KZXX_NEWS_NAME); $i++) {
			$ret = $this->findVariable($FHOME_KZXX_NEWS_NAME[$i], $klists);
			if ($ret == -1) {
				$fktab[] = $FHOME_KZXX_NEWS_NAME[$i];
			}
		}
		$ftext .= $this->getVariableString("F".$vname, $fktab);
	}
	
	/* news list */
	$lists = array();
	$flists = array();
	for ($i = 0; $i < 3; $i++) {
		$lists[] = $vlists[$i];
		$flists[] = $vlists[$i];
	}

	$tab = $NAME_TAB[$n];
	for ($i = 0; $i < count($tab); $i++) {
		$ret = $this->findVariable($tab[$i], $vlists);
		if ($ret == -1) {
			$lists[] = $tab[$i];
		}
	}
	$tab = $FNAME_TAB[$n];
	for ($i = 0; $i < count($tab); $i++) {
		$ret = $this->findVariable($tab[$i], $vlists);
		if ($ret == -1) {
			$flists[] = $tab[$i];
		}
	}
	
	
	
	$vname = $VNAME_TAB[$n];
	$ctext .= $this->getVariableString($vname, $lists);
	$ftext .= $this->getVariableString("F".$vname, $flists);
	
	/* set news star */
	
	$star = "\$" .$vname. "_STAR = array( ";
	for ($i = 0; $i < count($newlists); $i++) {
		if ($newlists[$i]) {
			$star .= "1";
		}
		else {
			$star .= "0";
		}
		if ($i !=  count($newlists) - 1) {
			$star .= ", ";
		}
	}
	$star .= ");\n\n";
	$ctext .= $star;
	$ftext .= $star;
	
	
	$ctext .= "\n\n?>";
	$ftext .= "\n\n?>";
	
	$fname = $FILE_TAB[$n];
	if ($tof) {
		$fp = fopen("../french/french_".$fname, "w");
		fwrite($fp, $ftext);
		fclose($fp);
	} 
	if ($toc) {
		$fp = fopen("../public/chinese_".$fname, "w");
		fwrite($fp, $ctext);
		fclose($fp);
	}

}

function WriteMainNews() {
	$vlists = array("", "", "");
	$newlists = array(0, 0, 0);
	$klists = array();
	for ($n = 0; $n < 3; $n++) {
		$nb = 0;
		$varname = "tochinese_".$n;
		$toc = getPostValue($varname);
		$varname = "tofrench_".$n;
		$tof = getPostValue($varname);
		for ($i = 0; $i < 3; $i++) {
			$varname = "news_".$n."_".$i;
			$varvalue = getPostValue($varname);
			$vlists[$i] = $varvalue;
			
			$varname = "newnews_".$n."_".$i;
			$nnews = getPostValue($varname);
			if ($nnews) {
				$newlists[$i] = 1;
			}
			else {
				$newlists[$i] = 0;
			}
			if ($n == 0) {
				$varname = "tokzxx_".$i;
				$to = getPostValue($varname);
				if ($to) {
					$klists[] = $varvalue;
				}
			}
		}
		$this->WriteToFile($vlists, $klists, $newlists, $n, $toc, $tof);
	}	
}


function showMainNewsForm($msg) {
	global $JY_NEWS, $JL_NEWS, $WY_NEWS, $MNEWS_TYPE, $HOME_JL_NEWS, $HOME_JY_NEWS, $HOME_YL_NEWS;
	global $HOME_JL_NEWS_STAR, $HOME_JY_NEWS_STAR, $HOME_YL_NEWS_STAR;
	$STABLE = array($HOME_JY_NEWS_STAR, $HOME_JL_NEWS_STAR, $HOME_YL_NEWS_STAR);
	$TTABLE = array($HOME_JY_NEWS, $HOME_JL_NEWS, $HOME_YL_NEWS);
	$NTABLE = array("文化教育", "文化交流 ", "文化娱乐 ");
	$VTABLE = array("JY_NEWS", "JL_NEWS", "WY_NEWS");
	$TABS = array($JY_NEWS, $JL_NEWS, $WY_NEWS);
?>

<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
	<TR><TD class=error height=20><?php echo($msg) ?></TD></TR>
	<TR>
		<TD height=80><div class=item_tit>
			<h2>欧洲时报文化中心主页消息</h2>
			</div>
		</TD>
	</TR>
	<TR><TD class=error height=20></TD></TR>
	<TR>
		<TD>
		<FORM action='admin.php' name="updatenews" method=post>
		<INPUT type=hidden name='action' value='modifymainnews'>
		<INPUT type=hidden name='mtype' value='<?php echo($MNEWS_TYPE); ?>'>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD>
				<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<?php	for ($n = 0; $n < 3; $n++) { ?>
				<TR>
					<TD class=lcenter height=40 width=55% colspan=2>
						<font colr=green size=3><b><?php echo($NTABLE[$n]); ?> : </b></font> 
					</TD>
					<TD class=labelleft width=45%></TD>
				</TR>
			
<?php
 		$i = 0;
		for ($i = 0; $i < 3; $i++) { 
			if ($TTABLE[$n][$i])
				$str = $TTABLE[$n][$i][0];
			else 
				$str = "";
?>
				<TR>
					<TD width=10% class=lcenter height=30><?php echo(($i+1)); ?> : </TD>
					<TD width=45% class=labelleft>
						<select name="news_<?php echo($n); ?>_<?php echo($i); ?>" STYLE='width:280px; color:black; align: center'>
							<option value=""> --- </option>
<?php 
						$tvar = "";
						$n_elem = count($TABS[$n]);
						for ($j = 0; $j < 5; $j++) {
							$nn = $n_elem-$j;
							$e = $TABS[$n][$nn-1];
							$tvar = $VTABLE[$n].$nn;
							if ($e) {
								$tstr = $e[0];
							}
							else {
								$tstr = "<font color=red>消息删除</font>";
							} 
							if ($str == $tstr) {
								echo ("<option value=".$tvar." selected> " .$tstr. " </option>");
							}
							else {
								echo ("<option value=".$tvar."> " .$tstr. " </option>");
							}
													
						}
						?>
						</select>
					</TD>
					<TD width=45% class=labelleft>
					<?php $star = $STABLE[$n][$i];
						if ($star) { ?>
						<INPUT class=box type='checkbox' name="newnews_<?php echo($n); ?>_<?php echo($i); ?>" value='1' checked> 新消息
					<?php } else { ?>
						<INPUT class=box type='checkbox' name="newnews_<?php echo($n); ?>_<?php echo($i); ?>" value='1'> 新消息
					<?php } if ($n == 0) { ?>
						<INPUT class=box type='checkbox' name="tokzxx_<?php echo($i); ?>" value='1'> 添加到孔子课堂
					<?php } ?>
					</TD>
				</TR>				

				<TR><TD colspan=3 height=10></TD></TR>				
		<?php } ?>
			
				<TR>
					<TD colspan=3 valign=top height=50 class=lcenter>
						<INPUT class=box type='checkbox' name="tochinese_<?php echo($n); ?>" value='1' checked> 修改中文
						<INPUT class=box type='checkbox' name="tofrench_<?php echo($n); ?>" value='1'> 修改法文
					</TD>
				</TR>		
		<?php }  ?>
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD height=60 class=lcenter>
				<INPUT class=button type=submit value=' 修改主页消息 '>
			</TD>
		</TR>
		</TABLE>
		</FORM>
	</TD>
</TR>
</TABLE>
<?php
}


function WriteHuiguItemName($huigu, $nindex, $active){
	global $HUIGU_ITEM_NAME;
	if ($nindex < 1) {
		$HUIGU_ITEM_NAME[] = array($huigu[0], $huigu[1][1], $huigu[4][0], "", "",  $huigu[4][1][0], $huigu[1][0], $active);
	}
	else {
		$HUIGU_ITEM_NAME[$nindex-1][0] = $huigu[0];
		$HUIGU_ITEM_NAME[$nindex-1][1] = $huigu[1][1];
		$HUIGU_ITEM_NAME[$nindex-1][2] = $huigu[4][0];
		$HUIGU_ITEM_NAME[$nindex-1][5] = $huigu[4][1][0];
		$HUIGU_ITEM_NAME[$nindex-1][6] = $huigu[1][0];
		$HUIGU_ITEM_NAME[$nindex-1][7] = $active;
	}
	
	$text  = "<?php\n\$HUIGU_ITEM_NAME = array(\n";
	for ($i = 0; $i < count($HUIGU_ITEM_NAME); $i++) {
		$text  .= "\tarray(" .OS_GetTableString($HUIGU_ITEM_NAME[$i], 0, 0). "),\n";
	}
	$text  .= ");\n\n?>\n\n";
	
	$fp = fopen("../huigu/huigu_include.php", "w");	
	fwrite($fp, $text);
	fclose($fp);
	
}

function getHuiguString($huigu) {
			
	$text  = "array(\n";
	$text  .= "\"".$huigu[0]."\", \n"; 									// title
	$text  .= "array(" .OS_GetTableString($huigu[1], 0, 0). 	"),\n"; 	// image
	$text  .= "array(\n" .OS_GetTableString($huigu[2], 2, 1). "),\n"; 	// text
	$text  .= "array(\n";													// link
	for ($i = 0; $i < count($huigu[3]); $i++) {								// each photo
		$p = $huigu[3][$i];
		$text  .= "\tarray(".OS_GetTableString($p, 0, 0). "),\n";
	}
	$text  .= "),\n";	
	return $text;
}


function WriteHuigu($huigu, $nindex){
	global $HG_NEWS, $HUIGU_ITEM_NAME;
	$ret = $nindex;
	$nb_v = count($HG_NEWS)+1;
	if ($nindex < 1) {
		$ret = count($HG_NEWS)+1;
	}

	$active = getPostValue("huigu_active");
	
	$vname = "HGNEWS".$ret;
		
	$text  = "<?php\n\$" .$vname. " = ";
	$text  .= $this->getHuiguString($huigu);
	
	$text  .= "\n// version francais\n";	
	
	$text  .= $this->getHuiguString($huigu[4]);
	$text  .= "),\n";	
	
	$text  .= "1\n);\n\n?>\n";	

	$fname = "../public/huigu/hg_news".$ret.".inc";
	$fp = fopen($fname, "w");
	fwrite($fp, $text);
	fclose($fp); 
	
	if ($active) {
		$fname = "../public/lastnews/huigunews/hg_news".$ret.".inc";
		$fp = fopen($fname, "w");
		fwrite($fp, $text);
		fclose($fp); 
	}
	/* write list file */	
	if ($nindex < 1) {

		$text  = "<?php\n\n";
		for ($i = 1; $i <= $nb_v; $i++) {
			$text .= "include (\"hg_news".$i.".inc\");\n";
		}
		$text .= "\n\n\$HG_NEWS = array(";
		for ($i = 1; $i <= $nb_v; $i++) {
			if ($i > 1)
				$text .= ", \$HGNEWS".$i;
			else
				$text .= "\$HGNEWS".$i;
		}
		$text .= ");\n\n ?>\n\n";
	
		$lname = "../public/huigu/huigulists.inc";
		$fp = fopen($lname, "w");	
		fwrite($fp, $text);
		fclose($fp);

		if ($active) {
			$lname = "../public/lastnews/huigunews/huigulists.inc";
			$fp = fopen($lname, "w");	
			fwrite($fp, $text);
			fclose($fp);
		}
		
	}
	$this->WriteHuiguItemName($huigu, $nindex, $active);
	return $ret;
}
	
function getHuigu() {
	$huigu = array();
	
	
	$huigu[] = changeDoubleString(getPostValue("huigutitle")); // 0 title
	$img = array();
	$img[]  = "huigu/".getPostValue("tphoto_1");
	$img[]  = changeDoubleString(getPostValue("huiguimgtxt"));
	$img[]  = getPostValue("huiguhost");
	$img[]  = getPostValue("huigudate");
	$huigu[] = $img;											// 1 image
	
	if(isset($_FILES['fphoto_1']))
	{ 
		$photoname = basename($_FILES['fphoto_1']['name']);
		$tmpName = $_FILES['fphoto_1']['tmp_name'];
		OS_UploadFile($tmpName, $photoname, "../photos/huigu", 450, 1);
	}
	$huigu[] = OS_TextToTable(getPostValue("huigutext")); 		// 2 text
	
	$nindex = getPostValue("nindex");
	$nbp = getPostValue("nbphotos");
	$videos = array();
	for ($i = 0; $i < $nbp; $i++) {
		$vtitle = getPostValue("vtitle_".$i);
		if ($vtitle) {				
			$vshowtitle = getPostValue("vshowtitle_".$i);
			if (!$vshowtitle) {
				$vshowtitle = $vtitle;
			}
			$vtp = getPostValue("vtp_".$i);
			$vcode = getPostValue("vcode_".$i);
			$vcode1 = getPostValue("vcode1_".$i);
			$p = array();
			$p[] = $vtitle;
			$p[] = $vshowtitle;
			$p[] = $vtp;
			$p[] = $vcode;
			$p[] = $vcode1;
			$videos[] = $p;
		}
	}
	$huigu[] = $videos;										// 3 videos

	// francais 
	$fdata = array();
	$ftitle = changeDoubleString(getPostValue("fhuiguimgtxt")); 
	$fdata[] = $ftitle;										// 0 F title 
	$fimg = array();
	$fimg[]  = $img[0];
	$fimg[]  = $ftitle;
	$fimg[]  = $img[2];
	$fimg[]  = getPostValue("fhuigudate");
	$fdata[] = $fimg;										// 1 image 
	$fdata[] = OS_TextToTable(getPostValue("fhuigutext")); 	// 2 F text
	$fdata[] = $videos;										// 3 videos
	// end francais
	
	$huigu[] = $fdata;										// 4 francais
	$huigu[] = 1;											// 5 flag avec francais 
	return $huigu;
}
	
function showHuiguForm($huiguelem, $nindex, $msg) {
	global $HUIGU_TYPE, $HG_NEWS, $FHG_NEWS, $HUIGU_ITEM_NAME;
	if ($huiguelem) {
		$huigu = $huiguelem;
	}
	else if ($nindex > 0) {
		$huigu = $HG_NEWS[$nindex-1];
	}
	else {
		$huigu = "";
	} 
	if ($huigu) {
		$title = $huigu[0];
		$image 		= basename($huigu[1][0]);
		$image_txt 	= $huigu[1][1];
		$serv_host 	= $huigu[1][2];
		$huigudate 	= $huigu[1][3];
		$texte = "";
		$nb = count($huigu[2]);
		while ($nb > 0) {
			if (trim($huigu[2][$nb-1])) {
				break;
			}
			$nb--;
		}
		for ($i = 0; $i < $nb; $i++) {
			$texte .= $huigu[2][$i]. "\n";
		}
		$photos = $huigu[3];
		$nbp = count($photos) + 5;
		if (count($huigu) > 4) {
			$fitem 			= $huigu[4];
			$fimage_txt 	= $fitem[1][1];
			$fhuigudate 	= $fitem[1][3];
			
			$nb = count($fitem[2]);
			while ($nb > 0) {
				if (trim($fitem[2][$nb-1])) {
					break;
				}
				$nb--;
			}
			$ftexte = "";
			for ($i = 0; $i < $nb; $i++) {
				$ftexte .= $fitem[2][$i]. "\n";
			}
		}
		else {
			$fimage_txt 	= "";
			$fhuigudate 	= "";
			$ftexte = "";
		}
		$active = $HUIGU_ITEM_NAME[$nindex-1][7];
	}
	else {
		$title = "";		
		$huigudate = "";
		$image = "";
		$image_txt = "";
		$texte = "";
		$ftexte = "";
		$serv_host = "";
		$photos = array();
		$nbp = 10;
		$active = 0;
		$fhuigudate = "";
		$fimage = "";
		$fimage_txt = "";
	}
?>

<FORM action='admin.php' name="updatehuigu" method=post enctype="multipart/form-data">
<INPUT type=hidden name='action' value='addhuigu'>
<INPUT type=hidden name='mtype' value='<?php echo($HUIGU_TYPE); ?>'>
<INPUT type=hidden name='nindex' value='<?php echo($nindex); ?>'>
<INPUT type=hidden name='nbphotos' value='<?php echo($nbp); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR><TD class=error height=30><?php echo($msg) ?></TD></TR>
<TR>
	<TD>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD width=15% class=labelright1 height=30>回顾题目 :</TD>
			<TD width=85% class=labelleft >
				<INPUT class=fields type=text size=80 name="huigutitle" value="<?php echo($title); ?>">
			</TD>
		</TR>
		<TR>
			<TD  class=labelright1 height=30>回顾照片 : </TD>
			<TD class=labelleft >
				<INPUT class=fields type=text size=28 id="tphoto_1" name="tphoto_1" value="<?php echo($image); ?>">
				&nbsp;&nbsp;&nbsp;&nbsp 
				<input name="fphoto_1" type="file" id="fphoto_1" onChange='javascript:setTopPhoto(1, 0);'>
			</TD>
		</TR>
		<TR>
			<TD  class=labelright1 height=30>照片注释 :</TD>
			<TD class=labelleft >
				<INPUT class=fields type=text size=80 name="huiguimgtxt" value="<?php echo($image_txt); ?>">
			</TD>
		</TR>
		<TR>
			<TD class=labelright1 height=30>回顾日期 : </TD>
			<TD class=labelleft >
				<INPUT class=fields type=text size=28 name="huigudate" value="<?php echo($huigudate); ?>">
				&nbsp;&nbsp;&nbsp;&nbsp;视频网站 : 
				<INPUT class=fields type=text size=30 name="huiguhost" value="<?php echo($serv_host); ?>">
			</TD>
		</TR>
		<TR>
			<TD class=labelright1 valign=top>回顾简介 : </TD>
			<TD class=labelleft >
				<textarea class=fields name="huigutext" cols="58" rows="12"><?php echo($texte); ?></textarea>
			</TD>
		</TR>
		<TR><TD colspan=2 height=20></TD></TR> 
		<TR>
			<TD  class=labelright1 height=30>法文题目  : </TD>
			<TD class=labelleft >
				<INPUT class=fields type=text size=80 name="fhuiguimgtxt" value="<?php echo($fimage_txt); ?>">
			</TD>
		</TR>
		<TR>
			<TD class=labelright1 height=30>法文日期 : </TD>
			<TD class=labelleft >
				<INPUT class=fields type=text size=28 name="fhuigudate" value="<?php echo($fhuigudate); ?>">
			</TD>
		</TR>
		<TR>
			<TD class=labelright1 valign=top>法文简介 : </TD>
			<TD class=labelleft >
				<textarea class=fields name="fhuigutext" cols="58" rows="12"><?php echo($ftexte); ?></textarea>
			</TD>
		</TR>
		<TR><TD colspan=2 height=20></TD></TR> 
		<TR>
			<TD class=labelright1 height=30>显示回顾 : </TD>
			<TD class=labelleft>
				<?php if ($active) { ?>
				<INPUT class=box type='checkbox' name='huigu_active' value='1'  checked>
				<?php } else { ?>
				<INPUT class=box type='checkbox' name='huigu_active' value='1'>
				<?php } ?>
			</TD>
		</TR>
		<TR><TD colspan=2 height=20></TD></TR> 
		</TABLE>
	</TD>
</TR>
<TR>
	<TD>
		<TABLE cellSpacing=0 cellPadding=1 width=98% border=0 align=center>
		<TR>
			<TD width=4% class=ITEMS_LINE_TITLE height=30></TD>
			<TD width=30% class=ITEMS_LINE_TITLE height=30>活动题目</TD>
			<TD width=20% class=ITEMS_LINE_TITLE height=30>显示名称</TD>
			<TD width=6% class=ITEMS_LINE_TITLE height=30>类型</TD>
			<TD width=20% class=ITEMS_LINE_TITLE height=30>链接1</TD>
			<TD width=20% class=ITEMS_LINE_TITLE height=30>链接2</TD>
		</TR>
<?php  
for ($i = 0; $i < $nbp; $i++) { 
	$item1 = "";
	$item2 = "";
	$item3 = "";
	$item4 = "";
	$item5 = "";
	if ($i < count($photos)) {
		$item1 = $photos[$i][0];
		$item2 = $photos[$i][1];
		$item3 = $photos[$i][2];
		$item4 = $photos[$i][3];
		$item5 = $photos[$i][4];
	}
?>
		<TR>
			<TD class=listnum>
				<?php echo($i+1); ?>
			</TD>
			<TD>
				<INPUT class=fields type=text size=35 name="vtitle_<?php echo($i); ?>" value="<?php echo($item1); ?>">
			</TD>
			<TD>
				<INPUT class=fields type=text size=15 name="vshowtitle_<?php echo($i); ?>" value="<?php echo($item2); ?>">
			</TD>
			<TD>
				<INPUT class=fields type=text size=4 name="vtp_<?php echo($i); ?>" value="<?php echo($item3); ?>">
			</TD>
			<TD>
				<INPUT class=fields type=text size=15 name="vcode_<?php echo($i); ?>" value="<?php echo($item4); ?>">
			</TD>
			<TD>
				<INPUT class=fields type=text size=15 name="vcode1_<?php echo($i); ?>" value="<?php echo($item5); ?>">
			</TD>
		</TR>
<?php } ?>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD height=60 class=lcenter>
<?php if ($nindex>0) { ?>
		<INPUT class=button type=submit value=' 修改 '>
<?php } else { ?>
		<INPUT class=button type=submit value=' 添加 '>
<?php } ?>
	</TD>
</TR>
</TABLE>
</FORM>
<?php
}

function getLastAnnonceTable() {
	$annonce = array();
	$ff = array();
	$ff[] = getPostValue("ctitle");
	$ff[] = getPostValue("ftitle");
	$ff[] = getPostValue("tochinese");
	$ff[] = getPostValue("tofrench");
	$annonce[] = $ff;
	$annonce[] = OS_TextToTable(getPostValue("cannonce")); 
	$annonce[] = OS_TextToTable(getPostValue("fannonce"));
	
	return $annonce;
}
function WriteLastAnnonce() {
	$annonce = $this->getLastAnnonceTable();

	$text  = "<?php\n\n\$LAST_ANNONCE = array(\n";
	for ($i = 0; $i < count($annonce); $i++) {
		if ($i == 0) {
			$text .= "array(" .OS_GetTableString($annonce[$i], 0, 0). ")";
		}
		else {
			$text .= ",\narray(\n" .OS_GetTableString($annonce[$i], 1, 1). "\n)";
		}
	}
	$text .= "\n);\n\n?>\n";
	$fp = fopen("../public/last_annonces.inc", "w");
	fwrite($fp, $text);
	fclose($fp);
	
	return $annonce;
}

function showAnnonceForm($news, $msg) {
	global $LAST_ANNONCE, $ANNO_TYPE;

	$cannonce = "";
	$fannonce = "";
	if ($news) {
		$tab = $news;
	}
	else {
		$tab = $LAST_ANNONCE;
	}
	$ctitle = $tab[0][0];
	$ftitle = $tab[0][1];
	$toc = $tab[0][2];
	$tof = $tab[0][3];
	for ($i = 0; $i < count( $tab[1]); $i++) {
		$cannonce .= $tab[1][$i]. "\n";
	}
	for ($i = 0; $i < count( $tab[2]); $i++) {
		$fannonce .= $tab[2][$i]. "\n";
	}
?>

<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
	<?php if ($msg) { ?>
	<TR><TD class=error><?php echo($msg) ?></TD></TR>
	<?php } ?>
	<TR>
		<TD height=50>
			<h2>欧洲时报文化中心最新通知</h2>
		</TD>
	</TR>
	<TR>
		<TD>
		<FORM method=post action='admin.php'>
		<INPUT type=hidden name='action' value='lastannonce'>
		<INPUT type=hidden name='mtype' value='<?php echo($ANNO_TYPE); ?>'>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD >
				<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
				<TR>
					<TD width=15% class=labelright1 height=30>中文题目 : </TD>
					<TD width=85% class=labelleft>
						<INPUT class=fields type=text size=70  name="ctitle" value="<?php echo($ctitle); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 valign=top>中文通知 : </TD>
					<TD class=labelleft>
						<textarea class=fields name="cannonce" cols="60" rows="12"><?php echo($cannonce); ?></textarea>
					</TD>
				</TR>
				
				<TR>
					<TD class=labelright1 height=30>法文题目 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=70 name="ftitle" value="<?php echo($ftitle); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 valign=top>法文通知 : </TD>
					<TD class=labelleft>
						<textarea class=fields name="fannonce" cols="60" rows="12"><?php echo($fannonce); ?></textarea>
						</div>
					</TD>
				</TR>
				<TR>
					<TD colspan=2 valign=top height=50 class=lcenter>
					<?php if ($toc) { ?>
						<INPUT class=box type='checkbox' name="tochinese" value='1' checked> 中文通知
					<?php } else { ?>
						<INPUT class=box type='checkbox' name="tochinese" value='1'> 中文通知
					<?php } if ($tof) { ?>
						<INPUT class=box type='checkbox' name="tofrench" value='1' checked> 法文通知
					<?php } else { ?>
						<INPUT class=box type='checkbox' name="tofrench" value='1'> 法文通知
					<?php } ?>
					</TD>
				</TR>		
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD height=60 class=formlabel>
				<div align=center>
				<INPUT class=button type=submit value=' 修改通知'>
				</div>
			</TD>
		</TR>
		</TABLE>
		</FORM>
	</TD>
</TR>
</TABLE>
<?php
}



}
?>