<?php
function getPostValue($name) {
	$var = '';
	if (isset($_POST[$name]))
		$var = $_POST[$name];
	else if (isset($_GET[$name]))
		$var = $_GET[$name];
	
	return $var;
}

/* start oushi file ***/
function OS_GetTextArrayString($str, $changeD=1) {
	$tab = OS_TextToTable($str, $changeD);
	$text = "array(";
	for ($i = 0; $i < count($tab); $i++) {
		if ($i > 0) {
			$text .= ",\n";
		}
		$text .= "\t\"" .$tab[$i]. "\"";
	}
	$text .= ")";
	return $text;
}
function OS_TextToTable($str, $changeD=1) {
	$tab = array();
	$lists  = explode("\n", $str);
	for ($i = 0; $i < count($lists); $i++) {
		$newstr =  $lists[$i];
		if (trim($newstr) && $changeD) {
			$newstr = str_replace("\"", "&quot;", $newstr);
		}
		$tab[] = str_replace("\r", "", $newstr);
	}
	return $tab;
}

function OS_GetTableString($tab, $n_tab, $newline) {
	$text = "";
	for ($i = 0; $i < count($tab); $i++) {
		if ($i > 0) {
			$text .= ", ";
			if ($newline) {
				$text .= "\n";
			}
		}
		for ($j = 0; $j < $n_tab; $j++) {
			$text .= "\t";
		}
		$text .= "\"" .$tab[$i]. "\"";
	}
	return $text;
}
	

function OS_UploadFile($srcfile, $destfile, $path, $size, $isimg){
	$error = "";
	if ($destfile && $srcfile) {
		$lowstr = strtolower($destfile);
		if ((strstr($lowstr, ".jpg") || strstr($lowstr, ".png"))) {
			if ($isimg) {
				move_uploaded_file($srcfile, $path."/".$destfile);
				resize_photo($destfile, $destfile, $path, 650);
			}
			else {
				$error .= $destfile. " doit être PDF ou DOC fichier!<br>";
			}
		}
		else if ((strstr($lowstr, ".pdf") || strstr($lowstr, ".doc")) ) {
			if ($isimg == 0) {
				move_uploaded_file($srcfile, "../files/".$destfile);
			}
			else {
				$error .= $destfile. " doit être JPG ou PNG Fichier!<br>";
			}
		}
		else {
			$error .= $destfile. " doit être IMAGE ou DOC Fichier!<br>";
		}
	}
	return $error;
}
/**** end file ****/

function getArrayText($textarray)
{
	$text = "";
	$text .= "\"" .changeDoubleString($textarray[0]). "\",\n";		// title
	$text .= "\"" .changeDoubleString($textarray[1]). "\",\n";		// resume
	$text .= "\"" .changeDoubleString($textarray[2]). "\",\n";		// sub title
	$text .= "\"" .changeDoubleString($textarray[3]). "\",\n";		// date 
	$text .= "array(\n";
	// images 
	for ($i = 0; $i < count($textarray[4]); $i+=2) {
		if (strlen($textarray[4][$i]) > 4) {
			$text .= "\"" .$textarray[4][$i]. "\", ";
			$text .= "\"" .$textarray[4][$i+1]. "\", ";
		}		
	}
	$text .= "),\n";
		
	//$text .= "array(\"".changeReturnToArray($textarray[5])."\"),\n";
	$text .= OS_GetTextArrayString($textarray[5], 0). ",\n";
	
	return $text;
}

function addIncludeLine($filename, $key) {
	$text = "";
	$found = 0;
	$lines = file($filename);
	foreach ($lines as $line_num => $line) {
		if (strstr($line, $key)) {
			$found = 1;
		}
		else {
			$text .= $line;
		}
		if (strstr($line, "<?php")) {
    		$text .= "include (\"" .$key. ".inc\");\n";
    	}
	}
	if ($found == 0) {
		$fp = fopen($filename, "w");
		fwrite($fp, $text);
		fclose($fp);
	}
	return $found;
}

function WriteCFNewsVariable($filename, $varname, $textarray, $CandF=1)
{
	$fp = fopen($filename, "w");
	$text  = "<?php\n \$" .$varname. " = array(\n";
	
	if ($CandF == 1) {
		$text .= getArrayText($textarray);
		// Francais 
		$text .= "array(\n";
		$text .= getArrayText($textarray[6]);		
		$text .= ")\n";
	}
	else {
		$text .= getArrayText($textarray);		
	}
	$text .= ");\n?>";
	
	fwrite($fp, $text);
	fclose($fp);
}

function WriteNewsListVariable($news_list, $filename, $iname, $vname, $nb_v, $n_line, $list_var, $d_line)
{
	$should = 0;
	$found = 0;
	$nb_news = count($news_list);
	$text  = "";
	
	$delline = $iname.$d_line.".inc";
	$key = $iname.$n_line.".inc";
	$lines = file($filename);
	foreach ($lines as $line_num => $line) {
		if (strstr($line, $vname) || strstr($line, "?>")) {
			
		}
		else {
			if (strstr($line, $delline)) {
				$should = 1;
			} 
			else if (strstr($line, $key)) {
				$found = 1;
			}
			else {
				$text .= $line;
			}
			if (strstr($line, "<?php") && $n_line > 0) {
	    		$text .= "include (\"" .$key. "\");\n";
	    	}
		}
	}

	if ($list_var) {
		$text .= "\$" .$vname. " = array(";
		for ($i = 1; $i <= $nb_v; $i++) {
			if ($i > 1) {
				$text .= ", ";
			}
			/* remove variable */
			if ($i != $d_line) {
				if ($i > $nb_news || $news_list[$i-1]) {
					$text .= "\$" .$vname.$i;
				}
				else {
					$text .= "0";
				}
			}
			else {
				$text .= "0";
			}
		}
		$text .= ");";
	}
	$text .= "?>\n\n";
	
	if ($should || $found == 0) {
		$fp = fopen($filename, "w");
		fwrite($fp, $text);
		fclose($fp);
	}
}


function writeVariable($filename, $varname, $varlist) {

	$text  = "<?php\n";

	$text .= "\$" .$varname. " = array(\n";
	$text .= $varlist;

	$text .= ");\n";

	$text .="?>";

	$fp = fopen($filename, "w");

	fwrite($fp, $text);
	fclose($fp);
}

function readVariable($filename) {
	$lists = array();
	if (file_exists($filename)) {
		$arr = array();
		$fp = fopen($filename, "r");
		$text = fread($fp, filesize($filename));
		$len = strlen($text);
		for ($i = 0; $i < $len; $i++) {
			if ($text[$i] == '"') {
				$i++;
				$start = $i;
				while ($i < $len) {
					if ($text[$i] == '"') {
						$lists[] = substr($text, $start, ($i - $start));
						$i++;
						break;
					}
					$i++;
				}
			}
		}
		fclose($fp);
	}
	return $lists;
}

function writeVariable1($filename, $varname, $vartext)
{
	$text  = "<?php\n \$" .$varname. " = \"" .$vartext. "\";\n?>";
	$fp = fopen($filename, "w");
	fwrite($fp, $text);
	fclose($fp);
}

function readVariable1($filename) {
	$vartext = "";
	$stop = 0;
	if (file_exists($filename)) {
		$fp = fopen($filename, "r");
		$text = fread($fp, filesize($filename));
		$vartext = $text. " (" .strlen($text);
		$len = strlen($text);
		$i = 0;
		while (($i < $len) && ($stop == 0)) {
			if ($text[$i] == '"') {
				$start = $i+1;
				while ($i < $len) {
					if ($text[$i] == '"') {
						$vartext = substr($text, $start, ($i - $start));
						$stop = 1;
					}
					$i++;
				}
			}
			$i++;
		}
		fclose($fp);
	}
	return $vartext;
}

function getActiveTable($tab, $res) {
	for ($i = 0; $i < count($tab); $i++) {
		$item = $tab[$i];
		if ($res == $item[1]) {
			return $item;
		}
	}
	return $tab[$res];
}

function getActiveTableIndice($tab, $res) {
	for ($i = 0; $i < count($tab); $i++) {
		$item = $tab[$i];
		if ($res == $item[1]) {
			return $i;
		}
	}
	return $res;
}

function showNews($newsindex, $newslist) {
	global $PHOTO_PATH;
	$_news_ = $newslist[$newsindex];
	$_photos_ = $_news_[0];
	echo("<h2>". $_news_[2]. "</h2>");
	echo("<h5>". $_news_[3]. "</h5>");
	echo("<div id=article>");
	if (count($_photos_) > 0) {
		echo("<div class=article_media>");
		for ($i = 0; $i < count($_photos_); $i++) {
			echo("<p class=photo><img src='".$PHOTO_PATH.$_photos_[$i]."' width=250></p>");
		}
		echo("</div>");
	}
	for ($i = 4; $i < count($_news_); $i++) {
		echo("<p class=LINE_20>".$_news_[$i]."</p>");
	}
	
	echo("<br></div>");
	
}


function showDetail($_detail_) {
	global $PHOTO_PATH;
	$_photos_ = $_detail_[2];
	$texte = $_detail_[3];
    echo("<div class=box_tit>");
    	echo("<div align=center><h1>".$_detail_[0]."</h1></div>");
    echo("</div>");
	echo("<div id=article>");
	if (count($_photos_) > 0) {
		echo("<div class=article_media>");
		for ($i = 0; $i < count($_photos_); $i++) {
			echo("<p class=photo><img src='".$PHOTO_PATH.$_photos_[$i]."' width=250></p>");
		}
		echo("</div>");
	}
	for ($i = 0; $i < count($texte); $i++) {
		echo("<p class=LINE_20>".$texte[$i]."</p>");
	}
	
	echo("<br></div>");

}

function showNewsDetail($item, $nindex, $url, $nType) {
	global $PHOTO_PATH, $NAME_BACK, $NAME_PUB, $NAME_PREV, $NAME_NEXT;
	
 	$texte = $item[5];
 	$image = $item[4];
 	$nbimage = count($image)/2;
	$n = 0;
    echo("<br><br><div class=box_tit2>");
    	echo("<h1>".$item[0]."</h1>");
    	echo("<h4>".$item[2]."</h4>");
    	if (strlen($item[3]) > 6) {
    		echo("<h5>【 ".$NAME_PUB." 】 ".$item[3]."</h5>");
    	}
    echo("</div><br><br>");
    echo("<div class=box_txt2>");
		for ($i = 0; $i < count($texte); $i++) {
			if ($n < $nbimage) {
				if (strlen($image[$n*2]) > 4) {
					echo("<IMG alt='". $image[$n*2+1]."' SRC='".$PHOTO_PATH.$image[$n*2]."' width=500>");
					echo("<div class=box_img_tit>". $image[$n*2+1]. "</div>");
				}
				$n++;
			}
			echo("<p>".$texte[$i]. "</p>");
		} 
	echo("</div>");
	echo("<div class=NEWS_BAR>");
if ($nType != -1) {
	$newslist = new NewsListClass();
	$prevnext = $newslist->getNextPrevNewsID($nType, $nindex);
	$nn = $prevnext[0];
	if ($nn > 0) {
		echo("<a class=NEWS_BAR href=$url?action=detail&hindex=$nn>&#171; ".$NAME_PREV."</a>");
	} 
	else {
		echo("<span>&#171; ".$NAME_PREV."</span>");
	}
	echo("&nbsp;&nbsp;&nbsp;&nbsp;");
	$nn = $prevnext[1];
	if ($nn > 0) {
		echo("<a class=NEWS_BAR href=$url?action=detail&hindex=$nn>".$NAME_NEXT."  &#187;</a>");
	} 
	else {
		echo("<span>".$NAME_NEXT."  &#187;</span>");
	}
	echo("<div class=NEWS_BAR_R>");
	if (strstr($url,"topphoto")) {
		if (isFrancais())
			echo("<a class=NEWS_BAR href='../../french/'>".$NAME_BACK."  <font color=red>&#187;</font></a>");
		else 
			echo("<a class=NEWS_BAR href='../home/'>".$NAME_BACK."  <font color=red>&#187;</font></a>");
	}
	else {
		echo("<a class=NEWS_BAR href='$url'>".$NAME_BACK."  <font color=red>&#187;</font></a>");
	}	
}
else {
	$nTotal = 0;
	if ($nTotal > 1) {
		if ($nindex > 0) {
			$nn = $nindex - 1;
			echo("<a class=NEWS_BAR href=$url?action=detail&hindex=$nn>&#171; ".$NAME_PREV."</a>");
		} 
		else {
			echo("<span>&#171; ".$NAME_PREV."</span>");
		}
		echo("&nbsp;&nbsp;&nbsp;&nbsp;");
		if ($nindex < ($nTotal-1)) {
			$nn = $nindex + 1;
			echo("<a class=NEWS_BAR href=$url?action=detail&hindex=$nn>".$NAME_NEXT."  &#187;</a>");
		} 
		else {
			echo("<span>".$NAME_NEXT."  &#187;</span>");
		}
		echo("<div class=NEWS_BAR_R>");
		if (strstr($url,"topphoto")) {
			if (isFrancais())
				echo("<a class=NEWS_BAR href='../french/'>".$NAME_BACK."  <font color=red>&#187;</font></a>");
			else 
				echo("<a class=NEWS_BAR href='../home/'>".$NAME_BACK."  <font color=red>&#187;</font></a>");
		}
		else {
			echo("<a class=NEWS_BAR href='$url'>".$NAME_BACK."  <font color=red>&#187;</font></a>");
		}
	}
}
	echo("</div>");
	
	echo("</div>");
}

function showItems($item) {
	global $PHOTO_PATH;
 	$texte = $item[4];
 	$image = $item[3];
 	$nbimage = count($image)/2;
	$n = 0;
    echo("<div class=box_tit2>");
    	echo("<h1>".$item[0]."</h1>");
    echo("</div><br><br>");
    
    echo("<div class=box_txt2>");
		for ($i = 0; $i < count($texte); $i++) {
			echo("<p>".$texte[$i]. "</p>");
			if ($n < $nbimage) {
				echo("<IMG alt='". $image[$n*2+1]."' SRC='".$PHOTO_PATH.$image[$n*2]. "' width=500 >");
				echo("<div class=img_label>". $image[$n*2+1]. "</div>");
				$n++;
			}
		} 
	echo("</div>");
}

function showAlbumPhotos($item) {
	global $PHOTO_PATH,$NAME_PHOTO;
	$nb = count($item);
	if ($nb > 0) {
		echo("<div class=box_bg>&nbsp; </div>");
		echo("<div class='video_box'>");
		echo("<h1>".$NAME_PHOTO."</h1>");
		echo("<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>");
		for ($n = 0; $n < $nb; $n+=5) { 
			echo("<TR>");
			for ($j = 0; $j < 5; $j++) {
				$i = $n + $j;
				echo("<td width=20%>");
				if ($i < $nb) {
					$tt = $item[$i][2];
					if (isFrancais() && (count($item[$i]) > 3)) {
						$tt = $item[$i][3];
					}
					echo("<a class='fancybox' data-fancybox-group='gallery'  href='".$PHOTO_PATH.$item[$i][1]."' title='".$tt."'>");
					//echo("<a class='fancybox-effects-c' href='".$PHOTO_PATH.$item[$i][1]."' title='".$item[$i][2]."'>");
					echo("<IMG SRC='".$PHOTO_PATH.$item[$i][0]."' width=100  height=75 border=0></a>");
				}
				else {
					echo("&nbsp;");
				}
				echo("</td>");
			
			}
			echo("</tr>");
		}
		echo("</table>");
		echo("</div>");
	}
}

function showVideoList($item) {
	global $NAME_VIDEO;
	$nb = count($item);
	if ($nb > 0) {
		echo("<div class=box_bg>&nbsp; </div>");
		echo("<div class='video_box'>");
	
		echo("<h1>".$NAME_VIDEO."</h1>");
		echo("<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>");
		for ($n = 0; $n < $nb; $n+=4) { 
			echo("<TR>");
			for ($j = 0; $j < 4; $j++) {
				$i = $n + $j;
				if ($i < $nb) {
					echo("<td class='bg_video' width=25%>");
					$sitem = $item[$i];
					echo("<a href='../video/?vtitle=".$sitem[1]."&vname=".$sitem[0]."'>");
					echo($sitem[1]."</a>");
					echo("</td>");
				}
				else {
					echo("<td width=25%>&nbsp;</td>");
				}
			}
			echo("</tr>");
			
		}		
		echo("</table>");
		echo("</div>");
	}
	
}

function showRelativeContent($item, $nindex, $res, $url) {
	global $JY_START_ITEM, $NAME_CONNEXE;
	if (count($item) > 0) {
		echo("<div class=box_bg>&nbsp; </div>");
		echo("<div class='video_box'>");
		echo("<h1>".$NAME_CONNEXE."</h1>");
		echo("<div class='same_item'><p >&nbsp;&nbsp;&nbsp;&nbsp;");
		
		for ($j = $JY_START_ITEM; $j < count($item); $j++) {
			if ($j != $nindex) {
				$sitem = $item[$j];
				$sitem = getItemTable($sitem);
				if (count($sitem[1] < 3))
					$title = $sitem[1][1];
				else 
					$title = $sitem[1][2];
				echo("<a href='".$url."?action=subitem&resource=".$res. "&nindex=".$j."'>".$title. "</a>&nbsp;&nbsp;&nbsp;");
		 	}
		}
		echo("</p><br></div>");
		echo("</div>");
	}
}

function showJiaoyuOtherPhotos($indice) {
	global $JY_VIDEO_TAB, $JY_OTHER_PHOTOS;
	if ($indice < count($JY_OTHER_PHOTOS)) {
		showAlbumPhotos($JY_OTHER_PHOTOS[$indice]);
		
	}
	if ($indice < count($JY_VIDEO_TAB)) {
		showVideoList($JY_VIDEO_TAB[$indice]);
	}
}


function getNewsResumeString($item, $nb_str) {
	global $JY_START_ITEM;
	$texte = "";
	$j = 0;
	$len = 0;

	while ($j < count($item[$JY_START_ITEM]) && $len < $nb_str) {
		$str = $item[$JY_START_ITEM][$j++];
		if (strstr($str, "<IMG")) {
			continue;
		}
		else if (strstr($str,"<h3>") || strstr($str,"<h5>")) {
			$str = str_replace("h3", "b", $str);
			$str = str_replace("h5", "b", $str);
			$texte .=  "<p>".$str."</p>";
			$str = $item[$JY_START_ITEM][$j++];
			if (strstr($str, "<IMG")) {
				$str = $item[$JY_START_ITEM][$j++];
			}
			$texte .=  "<p>".$str."</p>";
			$len = $nb_str;
		}
		else if (strstr($str,"href")) {
			$texte .=  "<p>".$str." ...... </p>";
			$len = mb_strlen($texte);
		}
		else {
			$texte .=  "<p>".$str;
			$len = mb_strlen($texte);
			if ($len > $nb_str) {
				$texte = mb_substr($texte,0, $nb_str, "UTF-8");
				$texte .= " ...... </p>";
			}
			else {
				$texte .="</p>";
			}
		}
	}
	echo($texte);
}


function showNewsPageList($tab, $newstype, $action="") {
	global $JY_START_ITEM, $NAME_BACK, $FASTNEWS_KZ, $FASTNEWS_ASSO;
	echo("<div class='PROG_TIT1'>");
 	echo("<h1>".$tab[0]."</h1>");   
 	echo("<div class=red_line>&nbsp; </div>");
	echo("<div class=more_bottom>");
	if ($action) {
		echo("<a class=box_tit_more href='".$tab[1]."?action=".$action."'>".$NAME_BACK."  <font color=red>&#187;</font></a>");
	}
	else {
		echo("<a class=box_tit_more href='".$tab[1]."'>".$NAME_BACK."  <font color=red>&#187;</font></a>");
	}
	echo("</div></div>");
    echo("<div class='box_txt'><br>");
 
	$newsclass = new NewsListClass();
	if ($newstype == $FASTNEWS_KZ || $newstype == $FASTNEWS_ASSO) {
    	$news_item = $newsclass->getLastNewsLists(0, $newstype);
	}
    else{
   		$news_item = $newsclass->getLastNewsLists($newstype);
    }
    $nb_news = count($news_item);
    if ($nb_news) {
	 	for ($i = $nb_news-1; $i >= 0; $i--) { 
	 		$id = $news_item[$i]->getID();
	 		if (isFrancais()) {
		 		$title = $news_item[$i]->getFTitle();
				$texte = $news_item[$i]->getFContentResume();
	 		}
	 		else {
		 		$title = $news_item[$i]->getTitle();
				$texte = $news_item[$i]->getContentResume();
	 		}
	 		echo("<div class=newslink> &#149; ");
			echo("<a href='".$tab[1]."?action=detail&hindex=".$id."'>".$title."</a>");
			echo($texte);
			echo("</div>");
	 	}
    }
	echo("</div>");
}

function showPhotoArticlePage($title, $sitem, $right=1) {
	global $PHOTO_PATH, $JY_START_ITEM;
	echo("<div class='box_txt'>");
	echo("<div id=article>");
	echo("<h1>".$title."</h1>");
	$img1 = $sitem[1][0];
	$img2 = "";
	if ($right) {
		if (strstr($img1,";")) {
			list($img1, $img2) = explode(";", $img1);
		}
		echo("<div class=article_media_right>");
	}
	else
		echo("<div class=article_media>");
	echo("<p class=photo><img src='".$PHOTO_PATH.$img1." 'title='".$PHOTO_PATH.$img1."' width=300  height=240></p></div>");
	if ($img2) {
		echo("<div class=article_media_right>");
		echo("<p class=photo><img src='".$PHOTO_PATH.$img2." 'title='".$PHOTO_PATH.$img2."' width=300  height=240></p></div>");
	}
	for ($i = 0; $i < count($sitem[2]); $i++) {
		if ($i == 0) {
			if (!strstr($sitem[2][$i],"<h3>")) {
				echo("<br><br>");
			}
		}
		echo("<p>".$sitem[2][$i]. "</p>");
	} 	
	echo("</div></div>"); //end article
}

function showPhotoArticleSimplePage($title, $sitem, $right=1) {
	global $PHOTO_PATH, $JY_START_ITEM;
	echo("<div class='box_txt'>");
	echo("<div id=article>");
	echo("<h1>".$title."</h1>");
	if ($right)
		echo("<div class=article_media_right>");
	else
		echo("<div class=article_media>");
	echo("<p class=photo><img src='".$PHOTO_PATH.$sitem[1][0]."' width=300  height=240></p></div>");
		
	echo("<br><br>");
	if (count($sitem[1]) > 2) {
		$stitle = $sitem[1][2];
	}
	else {
		$stitle = $sitem[1][1];
	}
	echo("<p><h4><IMG SRC='".$PHOTO_PATH."/icon/bull16.png' width=9> ".$stitle. "</h4></p>");
	
	$nb_items = count($sitem);
	if (isFrenchTable($sitem)) {
		$nb_items -= 2;
	}
	
	for ($i = 4; $i < $nb_items; $i++) {
		if (count($sitem[$i][1]) > 2) {
			$stitle = $sitem[$i][1][2];
		}
		else {
			$stitle = $sitem[$i][1][1];
		}	
		echo("<p><h4><IMG SRC='".$PHOTO_PATH."/icon/bull16.png' width=9> ".$stitle. "</h4></p>");
	} 	
	echo("</div></div>"); //end article
}

function showArticleLinkPage($link_item) {
	global $PHOTO_PATH, $HOST_URL;
	echo("<div class='PROG_TIT2'><div class='same_item'>"); // start link 

	for ($j = 0; $j < count($link_item); $j++) {
		$s_link = $link_item[$j];
		if (!trim($s_link[0]))
			continue;
		echo("<p class=JY_ITEM><IMG SRC='".$PHOTO_PATH."icon/bull16.png' width=9>&nbsp;&nbsp;");
		if (strlen($s_link[1]) > 3) {
			$url = $s_link[1];
			if (strstr($url, "/files/")) {
				if (isFrancais())
					echo("<span><a href='../..".$url."' target=_blank>".$s_link[0]."</a></span>");
				else
					echo("<span><a href='..".$url."' target=_blank>".$s_link[0]."</a></span>");	
			}
			else {
				if (strstr($url, "register")) {
					$pos = strrpos($url, '=');
	   				if($pos) {
	   					if (isFrancais()) {
	        				$url = $HOST_URL."/french/register/?registerref".substr($url, $pos);
	   					}
	   					else {
	        				$url = "../register/?registerref".substr($url, $pos);
	   					}
	   				}				
				}
				echo("<span><a href='$url'>".$s_link[0]."</a></span>");
			}
		}
		else { // 上课时间 
			echo("<span>".$s_link[0]."</span>&nbsp;&nbsp;&nbsp;</p>");
		}
		
		if (count($s_link) > 2 ) {
			for ($k = 2; $k < count($s_link); $k++) {
				// week 
			 	echo("<p class=JY_ITEM>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
			 	echo(getWeekday($s_link[$k][0]). " : ");
			 	for ($l = 1; $l < count($s_link[$k]); $l++) {
				 	echo("&nbsp;".$s_link[$k][$l]. "&nbsp;&nbsp;&nbsp;");
				}
				echo("</p>");
			}
		}
		
	}		
	echo("</div></div><br>"); // end link
}

function showJiaoyuItemDetail($item, $nindex, $indice) {
	global $PHOTO_PATH, $JY_START_ITEM, $NAME_BACK;

	if (strlen($item[$JY_START_ITEM-2]) > 5) {
		echo("<div class='PROG_TIT2'>");
		echo("<IMG src='".$PHOTO_PATH."icon/".$item[$JY_START_ITEM-2]."'>");
	}
	else {
    	echo("<div class='PROG_TIT1'>");
		echo("<h1>".$item[0]."</h1>");
	}
	
	
	echo("<div class=more_bottom>");
	echo("<a class=box_tit_more href='../jiaoyu/'>".$NAME_BACK."  <font color=red>&#187;</font></a>");
	echo("</div>");
	echo("<div class=red_line>&nbsp;</div>");
	echo("</div>");
	
	$res = $item[1];
	if ($nindex >= $JY_START_ITEM && $nindex < count($item)) {
		$sitem = $item[$nindex];
		$sitem = getItemTable($sitem);	
		if (count($sitem[1] < 3))
			$title = $sitem[1][1];
		else 
			$title = $sitem[1][2];
		showPhotoArticlePage($title, $sitem);
	 	// start link 
		if (count($sitem) > 3) {
			showArticleLinkPage($sitem[3]);
	 	}

	 	// second  
	 	$nb_item = count($sitem);
	 	if (isFrenchTable($sitem)) {
	 		$nb_item -= 2;
	 	}
		if ($nb_item > 4) {
			echo("<div class=gred_line>&nbsp;</div>");
			showPhotoArticlePage($sitem[4][0], $sitem[4], 0);
			
			// start link 
			if (count($sitem[4]) > 3) {
				showArticleLinkPage($sitem[4][3]);
		 	}
		} // end second
	}

	echo("<div class='PROG_TIT2'><br>");
	echo("</div>");
	
	
	//相关内容
	echo("<div class='box_txt'>  ");
	showRelativeContent($item, $nindex, $res, "../jiaoyu/education.php");
	echo("</div>");

	// photo and video
/* TODO 
	echo("<div class='box_txt'>  ");
	showJiaoyuOtherPhotos($indice);
	echo("</div>");
*/
}

function showRelativeStudentContent($item, $nindex, $res, $url) {
	global $JY_START_ITEM, $NAME_CONNEXE;
	if (count($item) > 0) {
		echo("<div class=box_bg>&nbsp; </div>");
		echo("<div class='video_box'>");
		echo("<h1>优秀习作 </h1>");
		echo("<div class='same_item'>");
		$nb = count($item);
		$n = $JY_START_ITEM;
		
		echo("<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>");
		for ($i = $JY_START_ITEM; $n < $nb; $i+=2) { 
			echo("<TR>");
			for ($j = 0; $j < 2; $j++) {
				echo("<td width=50% class=wenzhang>");
				if ($n < $nb) {
					$sitem = $item[$n];
					$title = $sitem[0]. " ".$sitem[1][0];
					echo("<a href='".$url."?action=subitem&resource=".$res. "&nindex=".$n."'>".$title. "</a>");
				}
				else {
					echo("&nbsp;");
				}
				echo("</td>");
				$n++;
			}
			echo("</TR>");
		}
		echo("</TABLE>");
		echo("</div>");
		echo("</div>");
	}
}

function showStudentWorksDetail($item) {
	
	$title = $item->getTitle();
	$stitle = $item->getCompetition(). " ".$item->getReward()." : ". $item->getClasses(). " ". $item->getStudent();

	echo("<div class='box_txt'>");
	echo("<div id=article>");
	echo("<h1>".$title."</h1>");
	echo("<h3>".$stitle."</h3>");
	
	$texte = OS_TextToTable($item->getContents(), 0);
	for ($i = 0; $i < count($texte); $i++) {
		echo("<p>".$texte[$i]. "</p>");
	} 	
	echo("</div></div>"); //end article

}

function showJiaoyuStudentItemTitle() {
	global $PHOTO_PATH, $NAME_BACK;
	echo("<div class='PROG_TIT2'>");
	echo("<IMG src='".$PHOTO_PATH."icon/studentyuandi.png'>");
	echo("<div class=more_bottom>");
	echo("<a class=box_tit_more href='../jiaoyu/'>".$NAME_BACK."  <font color=red>&#187;</font></a>");
	echo("</div>");
	echo("<div class=red_line>&nbsp;</div>");
	echo("</div>");
}



function showStudentWorksDetailBase($nindex) {

	$previd = 0; $nextid = 0; $ptitle=""; $ntitle="";
	$articles = new ArticleListClass();
	$lists = $articles->getNextPrevWorks($nindex);
	
	showJiaoyuStudentItemTitle();
	showStudentWorksDetail($lists[1]);
	
	if ($lists[0]) {
		$previd = $lists[0]->getID();
		$ptitle = $lists[0]->getTitle(). " " .$lists[0]->getStudent();
	}
	if ($lists[2]) {
		$nextid = $lists[2]->getID();
		$ntitle = $lists[2]->getTitle(). " " .$lists[2]->getStudent();
	}
	echo("<div class=NEWS_BAR>");
	if ($previd > 0) {
		echo("<a class=NEWS_BAR href='../jiaoyu/education.php?action=subitem&resource=student&nindex=".$previd."'>&#171; ".$ptitle. "</a>");
	} 
	echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
	if ($nextid > 0) {
		echo("<a class=NEWS_BAR href='../jiaoyu/education.php?action=subitem&resource=student&nindex=".$nextid."'> ".$ntitle. " &#187; </a> ");
	} 
	echo("</div>");
	
	
/*
	if ($nb < 0) {
		echo("<div class='box_txt'>  ");
		echo("<div class=box_bg>&nbsp; </div>");
		echo("<div class='video_box'>");
		echo("<h1>优秀习作 </h1>");
		echo("<div class='same_item'>");

		echo("<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>");
		$n = 0;
		for ($i = 0; $i < $nb; $i+=2) { 
			echo("<TR>");
			for ($j = 0; $j < 2; $j++) {
				echo("<td width=50% class=wenzhang>");
				if ($n < $nb) {
					$sitem = $item[$n];
					$title = $sitem->getTitle(). " " .$sitem->getStudent();
					$id = $sitem->getID();
					echo("<a href='../jiaoyu/education.php?action=subitem&resource=student&nindex=".$id."'>".$title. "</a>");
				}
				else {
					echo("&nbsp;");
				}
				echo("</td>");
				$n++;
			}
			echo("</TR>");
		}
		echo("</TABLE>");
		echo("</div>");
		echo("</div>");
		echo("</div>");
	}
*/
}


function showStudentWorksList() {
	showJiaoyuStudentItemTitle();
	
	$articles = new ArticleListClass();
	$item = $articles->getArticleTypeOrderLists();
	
	$nb = count($item);
	if ($nb > 0) {
   		echo("<div class='box_txt'><br>");
  		$prevcomp = "";
 	 	for ($i = 0; $i < $nb; $i++) { 
	 		$id = $item[$i]->getID();
	 		$title = $item[$i]->getTitle();
			$competition = $item[$i]->getCompetition();
			$student = $item[$i]->getStudent();
			$classes = $item[$i]->getClasses();
			$reward = $item[$i]->getReward();
			if ($prevcomp != trim($competition)) {
				$dates = "";
				if ($item[$i]->getDates()) {
					$dates = " ( ".$item[$i]->getChineseDate()." ) ";
				}
				echo("<br><h3><div align=center>".$competition." ".$dates." </div></h3><br>");
   				$prevcomp = trim($competition);
 			}
			echo("<div class=newslink> &#149; ");
			echo("<a href='../jiaoyu/education.php?action=subitem&resource=student&nindex=".$id."'>".$title. "</a>");
			echo(" ( ".$reward. ": " .$classes. " " .$student." ) ");
			echo("</div>");
	 	}
		echo("</div>");
	}
}




function showJiaoyuStudentItemDetail($item, $nindex) {
	global $PHOTO_PATH, $JY_START_ITEM, $NAME_BACK;
	
	if (strlen($item[$JY_START_ITEM-2]) > 5) {
		echo("<div class='PROG_TIT2'>");
		echo("<IMG src='".$PHOTO_PATH."icon/".$item[$JY_START_ITEM-2]."'>");
	}
	else {
    	echo("<div class='PROG_TIT1'>");
		echo("<h1>".$item[0]."</h1>");
	}
	
	echo("<div class=more_bottom>");
	echo("<a class=box_tit_more href='../jiaoyu/'>".$NAME_BACK."  <font color=red>&#187;</font></a>");
	echo("</div>");
	echo("<div class=red_line>&nbsp;</div>");
	echo("</div>");
	
	$res = $item[1];
	if ($nindex < $JY_START_ITEM && $nindex > count($item))
		$ni = $JY_START_ITEM;
	else 
		$ni = $nindex;
	$sitem = $item[$ni];

	showStudentWorksDetail($sitem);
	//相关内容
	echo("<div class='box_txt'>  ");
	showRelativeStudentContent($item, $nindex, $res, "../jiaoyu/education.php");
	echo("</div>");


}

function showJiaoyuAllItemsDetail($item) {
	global $PHOTO_PATH, $JY_START_ITEM;
	
	if (strlen($item[$JY_START_ITEM-2]) > 5) {
		echo("<div class='PROG_TIT2'>");
		echo("<IMG src='".$PHOTO_PATH."icon/".$item[$JY_START_ITEM-2]."'>");
	}
	else {
    	echo("<div class='PROG_TIT1'>");
		echo("<h1>".$item[0]."</h1>");
	}
	echo("<div class=red_line>&nbsp;</div></div>");
	     
    echo("<div class='PROG_TIT1'>");
	$sitem=$item[$JY_START_ITEM-1];
 	for ($i = 0; $i < count($sitem); $i++) { 
	 	echo("<h5>" .$sitem[$i]. "</h5>");  	
 	}
   	echo("</div>");
	
	echo("<div class='box_txt'><div class=box_tit1_text1>");
	for ($i = $JY_START_ITEM; $i < count($item); $i+=2) {
		$sitem = $item[$i];
		echo("<IMG SRC='".$PHOTO_PATH.$sitem[1][0]."' width=300  height=200>");
		echo("<h2>" .$sitem[1][1]. "</h2>");
		echo("<div class=box200>");
	 	echo("<p>".$sitem[2][0]. "</p>");
		echo("</div>");
		if (count($sitem) > 4) {
			echo("<div align=center><p class=JY_ITEM>");
			for ($j = 0; $j < count($sitem[4]); $j+=2) {
			 	echo("<span>&bull;<a class=JY_BAR href='../jiaoyu/education.php?resource=".$item[1]. "&nindex=".$i."&itemlink=".$j."'>".$sitem[4][$j]. "</a>&nbsp;&nbsp;</span>");
			}		
			echo("</p></div>");
		}
	} 
	echo("</div><div class=box_tit1_text2>");
	for ($i = ($JY_START_ITEM+1); $i < count($item); $i+=2) {
		$sitem = $item[$i];
		echo("<IMG SRC='".$PHOTO_PATH.$sitem[1][0]."' width=300  height=200>");
		echo("<h2>" .$sitem[1][1]. "</h2>");  	
		echo("<div class=box200>");
	 	echo("<p>".$sitem[2][0]. "</p>");
		echo("</div>");
		if (count($sitem) > 4) {
			echo("<div align=center><p class=JY_ITEM>");
			for ($j = 0; $j < count($sitem[4]); $j+=2) {
				echo("<span>&bull;<a class=JY_BAR href='../jiaoyu/education.php?resource=".$item[1]. "&nindex=".$i."&itemlink=".$j."'>".$sitem[4][$j]. "</a>&nbsp;&nbsp;</span>");
			}		
			echo("</p></div>");
		}
	} 
	echo("</div></div>");
}

function isFrenchTable($sitem) {
	$n_sitem = count($sitem);
	if (($sitem[$n_sitem-1] == 1)) {
		/* new format with french element table */
		return 1;
	}
	return 0;
}
function getItemTable($sitem) {
	$n_sitem = count($sitem);
	if (isFrancais() && isFrenchTable($sitem)) {
		return ($sitem[$n_sitem-2]);
	}
	return $sitem;
}
/********************************************/	
function showJiaoLiuItemDetailTitle($items, $more) {
	global $PHOTO_PATH, $JY_START_ITEM, $NAME_BACK, $NAME_MORE;

	if (strlen($items[$JY_START_ITEM-2]) > 5) {
		echo("<div class='PROG_TIT2'>");
		echo("<IMG src='".$PHOTO_PATH."../images/".$items[$JY_START_ITEM-2]."'>");
	}
	else {
    	echo("<div class='PROG_TIT1'>");
		echo("<h1>".$items[0]."</h1>");
	}
	echo("<div class=box_tit_more>");
	if ($more) {
		echo("<a class=box_tit_more href='../jiaoliu/?action=subitem&resource=".$items[1]."'>".$NAME_MORE." <font color=red>&#187;</font></a>");
	}
	else {
		echo("<a class=box_tit_more href='../jiaoliu/'>".$NAME_BACK." <font color=red>&#187;</font></a>");
	}
	echo("</div>");
	echo("<div class=red_line>&nbsp;</div>");
	echo("</div>");
}

function showJiaoLiuTypeItemDetail($items) {
	global $JY_START_ITEM, $NAME_DETAIL;

	showJiaoLiuItemDetailTitle($items, 1);
	
	$mitem = $items[$JY_START_ITEM];

	$nb_item = count($mitem);
	if ($nb_item == 1) {
	    $sitem = $mitem[0];

	    showPhotoArticlePage($sitem[0], $sitem, 0);
	    	
		echo("<div class='PROG_TIT2'><br>");
		echo("</div>");
		echo("<div class='box_txt'>");
		if (count($sitem) > 3) {
			showAlbumPhotos($sitem[3]);
		}
		echo("</div>");
	}
    else {
		$n = 0;
		for ($i = 0; $i < $nb_item; $i+=2) {
			$sitem = getItemTable($mitem[$n++]);
			$n_sitem = count($sitem);
			if ($n_sitem > 4) {
				/* new format with french element table */
				if (isFrenchTable($sitem)) {
					showPhotoArticlePage($sitem[0], $sitem);
				}
				else {
					showPhotoArticleSimplePage($sitem[0], $sitem);
				}
			} else {
				showPhotoArticlePage($sitem[0], $sitem);
			}
			echo("<div class='PROG_TIT2'>");
			echo("<div class=more_bottom>");
			echo("<a class=box_tit_more href='../jiaoliu/?action=subitem&resource=".$items[1]."&hindex=".$n."'>".$NAME_DETAIL." <font color=red>&#187;</font></a>");
			echo("</div><br>");
			if ($n <  $nb_item) {
				echo("<div class=gred_line>&nbsp;</div>");
			}
			echo("</div><br><br>");
			if ($n <  $nb_item) {
				$sitem = getItemTable($mitem[$n++]);
				$n_sitem = count($sitem);
				if ($n_sitem > 4) {
						/* new format with french element table */
					if (isFrenchTable($sitem)) {
						showPhotoArticlePage($sitem[0], $sitem, 0);
					}
					else {
						showPhotoArticleSimplePage($sitem[0], $sitem, 0);
					}
				} else {
					showPhotoArticlePage($sitem[0], $sitem, 0);
				}
				echo("<div class='PROG_TIT2'>");
				echo("<div class=more_bottom>");
				echo("<a class=box_tit_more href='../jiaoliu/?action=subitem&resource=".$items[1]."&hindex=".$n."'>".$NAME_DETAIL." <font color=red>&#187;</font></a>");
				echo("</div><br>");
				if ($n <  $nb_item -1) {
					echo("<div class=gred_line>&nbsp;</div>");
				}
				echo("</div><br><br>");
			}
    	}
	}
}

function showJiaoLiuItemDetail($items, $nindex) {
	global $JY_START_ITEM;
	if ($nindex > 0) {
		$mitem = $items[$JY_START_ITEM];
		$sitem = getItemTable($mitem[$nindex-1]);
		showJiaoLiuItemDetailTitle($items, 0);
		showPhotoArticlePage($sitem[0], $sitem);		
		echo("<div class='PROG_TIT2'><br>");
		if (count($sitem[1]) == 4) {
			echo("<div align=right><p>(".$sitem[1][3].")&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></div><br><br>");
		}
		echo("</div>");
		echo("<div class='box_txt'>");
		if (count($sitem) > 3) {
			showAlbumPhotos($sitem[3]);
		}
		echo("</div>");
	}
	else {
		showJiaoLiuTypeItemDetail($items);
	}
}

/* ljpage  base ***********/

function showJLPageTypeTitle($type, $more) {
	global $PHOTO_PATH, $JY_START_ITEM, $NAME_BACK, $NAME_MORE, $JL_TAB;
	
	$items = $JL_TAB[$type];
	if (strlen($items[$JY_START_ITEM-2]) > 5) {
		echo("<div class='PROG_TIT2'>");
		echo("<IMG src='".$PHOTO_PATH."../images/".$items[$JY_START_ITEM-2]."'>");
	}
	else {
    	echo("<div class='PROG_TIT1'>");
		echo("<h1>".$items[0]."</h1>");
	}
	echo("<div class=box_tit_more>");
	if ($more) {
		echo("<a class=box_tit_more href='../jiaoliu/?action=subitem&resource=".$items[1]."'>".$NAME_MORE." <font color=red>&#187;</font></a>");
	}
	else {
		echo("<a class=box_tit_more href='../jiaoliu/'>".$NAME_BACK." <font color=red>&#187;</font></a>");
	}
	echo("</div>");
	echo("<div class=red_line>&nbsp;</div>");
	echo("</div>");
}


function showJLPageItemDetail($item, $nindex) {
	$sitem = $item;
	if (!$sitem) {
		$jlpage = new JLPageClass();
		if ($jlpage->getJLPage($nindex)) {
			$sitem = $jlpage->getJLPageItem();
		}
	}
	if ($sitem) {
		if (isFrancais()) {
			$sitem = $sitem[4];
		}
		
		showPhotoArticlePage($sitem[0], $sitem);		
		echo("<div class='PROG_TIT2'><br>");
		if (count($sitem[1]) == 4) {
			echo("<div align=right><p>(".$sitem[1][3].")&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></div><br><br>");
		}
		echo("</div>");
		echo("<div class='box_txt'>");
		if (count($sitem) > 3) {
			showAlbumPhotos($sitem[3]);
		}
		echo("</div>");
	}
}

function showJLPageTypeItem_1($type, $mitem) {
	$sitem = $mitem[0]->getJLPageItem();
    showPhotoArticlePage($sitem[0], $sitem, 0);
	    	
	echo("<div class='PROG_TIT2'><br>");
	echo("</div>");
	echo("<div class='box_txt'>");
	if (count($sitem) > 3) {
		showAlbumPhotos($sitem[3]);
	}
	echo("</div>");
}

function showJLPageTypeItem_md($type, $mitem) {
	global $JY_START_ITEM, $NAME_DETAIL, $JL_TAB;
	$items = $JL_TAB[$type];
	$nb_item = count($mitem);
   	$isf = isFrancais();
	for ($i = 0; $i < $nb_item; $i+=2) {
		$ids = $mitem[$i]->getID();
		$sitem = $mitem[$i++]->getJLPageItem();
		if ($isf) {
			$sitem = $sitem[4];
		}
		showPhotoArticlePage($sitem[0], $sitem);
			
		echo("<div class='PROG_TIT2'>");
		echo("<div class=more_bottom>");
		echo("<a class=box_tit_more href='../jiaoliu/?action=subitem&resource=".$items[1]."&hindex=".$ids."'>".$NAME_DETAIL." <font color=red>&#187;</font></a>");
		echo("</div><br>");
		if ($i <  $nb_item) {
			echo("<div class=gred_line>&nbsp;</div>");
		}
		echo("</div><br><br>");
		if ($i <  $nb_item) {
			$ids = $mitem[$i]->getID();
			$sitem = $mitem[$i]->getJLPageItem();
			if ($isf) {
				$sitem = $sitem[4];
			}
			showPhotoArticlePage($sitem[0], $sitem, 0);
			echo("<div class='PROG_TIT2'>");
			echo("<div class=more_bottom>");
			echo("<a class=box_tit_more href='../jiaoliu/?action=subitem&resource=".$items[1]."&hindex=".$ids."'>".$NAME_DETAIL." <font color=red>&#187;</font></a>");
			echo("</div><br>");
			if ($i <  $nb_item -1) {
				echo("<div class=gred_line>&nbsp;</div>");
			}
			echo("</div><br><br>");
		}
   	}
}

function showJLPageTypeItem_m($type, $mitem) {
	global $JY_START_ITEM, $NAME_DETAIL, $JL_TAB, $PHOTO_PATH;
	$item = $JL_TAB[$type];
	$nb_item = count($mitem);
   	$isf = isFrancais();

	echo("<div class='box_txt'><br>");
	echo("<div class=box_tit1_text1>");
	for ($i = 0; $i < $nb_item; $i+=2) { 
		$sitem = $mitem[$i];
		$ids = $sitem->getID();
		if ($isf) {
			$title = $sitem->getFTitle();
			$photos = $sitem->getPhotoF();
		}
		else {
			$title = $sitem->getTitle();
			$photos = $sitem->getPhotoC();
		}
		echo("<a href='../jiaoliu/?action=subitem&resource=".$item[1]."&hindex=".$ids."'>"); 
		echo("<IMG SRC='".$PHOTO_PATH.$photos."' width=300  height=200 border=0>");
	 	echo("</a>"); 
	 	echo("<div class=img_label>"); 
	 	echo("<a href='../jiaoliu/?action=subitem&resource=".$item[1]."&hindex=".$ids."'>"); 
		echo($title); 
		echo("</a></div>"); 
	}
	echo("</div><div class=box_tit1_text2>");
	for ($i = 1; $i < $nb_item; $i+=2) {
		$sitem = $mitem[$i];
		$ids = $sitem->getID();
		if ($isf) {
			$title = $sitem->getFTitle();
			$photos = $sitem->getPhotoF();
		}
		else {
			$title = $sitem->getTitle();
			$photos = $sitem->getPhotoC();
		}
		echo("<a href='../jiaoliu/?action=subitem&resource=".$item[1]."&hindex=".$ids."'>"); 
		echo("<IMG SRC='".$PHOTO_PATH.$photos."' width=300  height=200 border=0>");
	 	echo("</a>"); 
	 	echo("<div class=img_label>"); 
	 	echo("<a href='../jiaoliu/?action=subitem&resource=".$item[1]."&hindex=".$ids."'>"); 
	 	echo($title); 
	 	echo("</a></div>"); 
	} 
	echo("</div>");
	echo("</div>");
}	

function showJLTypeDetail($type, $nindex) {
	showJLPageTypeTitle($type, 0);
	if ($nindex < 1) {
		$pagelist = new JLPageListClass();
		$mitem = $pagelist->getJLPageLists($type+1);
		$nb_item = count($mitem);
		if ($nb_item == 1) {
			showJLPageTypeItem_1($type, $mitem);
		}
		else {
			showJLPageTypeItem_m($type, $mitem);
			//showJLPageTypeItem_md($type, $mitem);
		}
	}
	else {
		showJLPageItemDetail("", $nindex);
	}
}
/**************************************************/

function showAllJLItemDetail() {
	global $JL_TAB, $JY_START_ITEM, $PHOTO_PATH, $NAME_MORE;

	for ($n = 0; $n < count($JL_TAB); $n++) { 
		$item = $JL_TAB[$n];
		$mitem = $item[$JY_START_ITEM];
		$nb_item = count($mitem);
		
   		if (isFrancais())
			echo("<div class='PROG_TIT1'><h1>".$item[0]. "</h1>");
		else
			echo("<div class='box_tit'><h1>" .$item[0]. "</h1>");
		
   		echo("<div class=more_bottom>");
		echo("<a class=box_tit_more href='../jiaoliu/?action=subitem&resource=".$item[1]."'>".$NAME_MORE." <font color=red>&#187;</font></a>");
		echo("</div><div class=red_line>&nbsp; </div></div>");	
		echo("<div class='box_txt'><br>");
		if ($nb_item == 1) {
			$sitem = $mitem[0];
	       	echo("<div class='tit_img'>");
			echo("<a href='../jiaoliu/?action=subitem&resource=".$item[1]."&hindex=1'>"); 
			echo("<IMG SRC='".$PHOTO_PATH.$sitem[1][0]."' width=290  border=0></a>");
	       	echo("</div>");
	       	echo("<div class='PROG_TIT1'>");
		  	$s_item = $item[$JY_START_ITEM-1];
		 	echo("<br>");
			for ($k = 0; $k < count($s_item); $k++) {
				echo("<h5>".$s_item[$k]. "</h5>");
			}
			echo("</div>");
		} else { 
			if ($nb_item > 4)
				$nb_item = 4; 
			echo("<div class=box_tit1_text1>");
			for ($i = 0; $i < $nb_item; $i+=2) { 
				$sitem = $mitem[$i];
			 	echo("<a href='../jiaoliu/?action=subitem&resource=".$item[1]."&hindex=".($i+1)."'>"); 
				echo("<IMG SRC='".$PHOTO_PATH.$sitem[1][0]."' width=300  height=200 border=0>");
			 	echo("</a><div class=img_label>"); 
			 	echo("<a href='../jiaoliu/?action=subitem&resource=".$item[1]."&hindex=".($i+1)."'>"); 
			 	echo($sitem[0]); 
			 	echo("</a></div>"); 
			}
			echo("</div><div class=box_tit1_text2>");
	
			for ($i = 1; $i < $nb_item; $i+=2) {
				$sitem = $mitem[$i];
			 	echo("<a href='../jiaoliu/?action=subitem&resource=".$item[1]."&hindex=".($i+1)."'>"); 
				echo("<IMG SRC='".$PHOTO_PATH.$sitem[1][0]."' width=300  height=200 border=0>");
			 	echo("</a><div class=img_label>"); 
			 	echo("<a href='../jiaoliu/?action=subitem&resource=".$item[1]."&hindex=".($i+1)."'>"); 
			 	echo($sitem[0]); 
			 	echo("</a></div>"); 
		 	} 
			echo("</div>");
		 }
     	echo("</div>");
	}
}
	
function showAllJLBaseItemDetail() {
	global $JL_TAB, $JY_START_ITEM, $PHOTO_PATH, $NAME_MORE;
	$isf = isFrancais();
	for ($n = 0; $n < count($JL_TAB); $n++) { 
		$item = $JL_TAB[$n];
		$mitem = $item[$JY_START_ITEM];
		$nb_item = count($mitem);

   		if ($isf)
			echo("<div class='PROG_TIT1'><h1>".$item[0]. "</h1>");
		else
			echo("<div class='box_tit'><h1>" .$item[0]. "</h1>");
   		echo("<div class=more_bottom>");
		echo("<a class=box_tit_more href='../jiaoliu/?action=subitem&resource=".$item[1]."'>".$NAME_MORE."<font color=red>&#187;</font></a>");
		echo("</div><div class=red_line>&nbsp; </div></div>");	
		echo("<div class='box_txt'><br>");
		$pagelist = new JLPageListClass();
		$mitem = $pagelist->getJLPageLists($n+1);
		$nb_item = count($mitem);
		if ($nb_item == 1) {
			$sitem = $mitem[0];
			$ids = $sitem->getID();
			if ($isf)
				$photos = $sitem->getPhotoF();
			else 
				$photos = $sitem->getPhotoC();
			echo("<div class='tit_img'>");
			echo("<a href='../jiaoliu/?action=subitem&resource=".$item[1]."&hindex=".$ids."'>"); 
			echo("<IMG SRC='".$PHOTO_PATH.$photos."' width=290  border=0></a>");
        	echo("</div>");
        	echo("<div class='PROG_TIT1'>");

		  	$s_item = $item[$JY_START_ITEM-1];
			for ($k = 0; $k < count($s_item); $k++) {
				echo("<h5>".$s_item[$k]. "</h5>");
			}
			echo("</div>");
		} else { 
 			if ($nb_item > 4)
				$nb_item = 4; 
			echo("<div class=box_tit1_text1>");
			for ($i = 0; $i < $nb_item; $i+=2) { 
				$sitem = $mitem[$i];
				$ids = $sitem->getID();
				if ($isf) {
					$title = $sitem->getFTitle();
					$photos = $sitem->getPhotoF();
				}
				else {
					$title = $sitem->getTitle();
					$photos = $sitem->getPhotoC();
				}
				echo("<a href='../jiaoliu/?action=subitem&resource=".$item[1]."&hindex=".$ids."'>"); 
				echo("<IMG SRC='".$PHOTO_PATH.$photos."' width=300  height=200 border=0>");
			 	echo("</a><div class=img_label>"); 
			 	echo("<a href='../jiaoliu/?action=subitem&resource=".$item[1]."&hindex=".$ids."'>"); 
			 	echo($title); 
			 	echo("</a></div>"); 
			}
			echo("</div><div class=box_tit1_text2>");
			for ($i = 1; $i < $nb_item; $i+=2) {
				$sitem = $mitem[$i];
				$ids = $sitem->getID();
				if ($isf) {
					$title = $sitem->getFTitle();
					$photos = $sitem->getPhotoF();
				}
				else {
					$title = $sitem->getTitle();
					$photos = $sitem->getPhotoC();
				}
				echo("<a href='../jiaoliu/?action=subitem&resource=".$item[1]."&hindex=".$ids."'>"); 
				echo("<IMG SRC='".$PHOTO_PATH.$photos."' width=300  height=200 border=0>");
			 	echo("</a><div class=img_label>"); 
			 	echo("<a href='../jiaoliu/?action=subitem&resource=".$item[1]."&hindex=".$ids."'>"); 
			 	echo($title); 
			 	echo("</a></div>"); 
	 		} 
			echo("</div>");
		 }
     	echo("</div>");
	}
}	


function showWenyiItemDetail($item, $nindex) {
	global $JY_START_ITEM,$NAME_BACK,$NAME_DETAIL, $RANDON_INDEX;
    echo("<div class=PROG_TIT1>");
    echo("<h1>".$item[0]."</h1>");
	echo("<div class=more_bottom>");
	echo("<a class=box_tit_more href='../wenyi/'>".$NAME_BACK."  <font color=red>&#187;</font></a>");
	echo("</div>");
	echo("<div class=red_line>&nbsp;</div>");
	echo("</div>");
    if ($nindex < $JY_START_ITEM) {
		for ($i = $JY_START_ITEM; $i < count($item); $i+=2) {
				$n = $i;
				$sitem = $item[$n];
				$sitem = getItemTable($sitem);
	 			$nb_items = count($sitem);
	 			if (isFrenchTable($sitem)) {
	 				$nb_items -= 2;
	 			}
				
				if ($nb_items > 4) {
					showPhotoArticleSimplePage($sitem[0], $sitem);
				} else {
					showPhotoArticlePage($sitem[0], $sitem);
				}
				echo("<div class='PROG_TIT2'>");
				echo("<div class=more_bottom>");
				echo("<a class=box_tit_more href='../wenyi/?action=subitem&resource=".$item[1]."&hindex=".$n."'>".$NAME_DETAIL." <font color=red>&#187;</font></a>");
				echo("</div><br>");
				echo("<div class=gred_line>&nbsp;</div></div><br><br>");
				
				
				$n = $i+1;
				if ($n < count($item)) {
					$sitem = $item[$n];
					$sitem = getItemTable($sitem);
		 			$nb_items = count($sitem);
		 			if (isFrenchTable($sitem)) {
		 				$nb_items -= 2;
		 			}
					
					if ($nb_items > 4) {
						showPhotoArticleSimplePage($sitem[0], $sitem, 0);
					} else {
						showPhotoArticlePage($sitem[0], $sitem, 0);
					}
					echo("<div class='PROG_TIT2'>");
					echo("<div class=more_bottom>");
					echo("<a class=box_tit_more href='../wenyi/?action=subitem&resource=".$item[1]."&hindex=".$n."'>".$NAME_DETAIL." <font color=red>&#187;</font></a>");
					echo("</div><br>");
					if ($n < count($item)-1) {
						echo("<div class=gred_line>&nbsp;</div>");
					}
					echo("</div><br><br>"); 
				}
		}
    }
    else {
	    $sitem = $item[$nindex];
	    $sitem = getItemTable($sitem);
		showPhotoArticlePage($sitem[0], $sitem);
		if (count($sitem) > 3) {
			if ($nindex == $RANDON_INDEX && $item[1] == "sports") {
				showLastRandonList($sitem[3]);
			}
			else {
				showArticleLinkPage($sitem[3]);
			}
		}
		/* start more item */
	 	$nb_items = count($sitem);
	 	if (isFrenchTable($sitem)) {
	 		$nb_items -= 2;
	 	}
	 	for ($i = 4; $i < $nb_items; $i++) {
	 		$right = $i % 2;
			echo("<div class=gred_line>&nbsp;</div>");
			showPhotoArticlePage($sitem[$i][0], $sitem[$i], $right);
			
			// start link 
			if (count($sitem[$i]) > 3) {
				showArticleLinkPage($sitem[$i][3]);
		 	}
		} // end  more item
		showRelativeContent($item, $nindex, $item[1], "../wenyi/");
		if (($nindex == $JY_START_ITEM) && $item[1] == "wenhua" ) {
			showLastBiblioList();
		}
    }
}


function showLastBiblioNews($nindex) {
	global $PHOTO_PATH, $LAST_BIBLIO_LIST, $JY_START_ITEM, $NAME_NEXT, $NAME_PREV;
	$item = $LAST_BIBLIO_LIST[$nindex];
	$nTotal = count($LAST_BIBLIO_LIST);
	echo("<div class='box_txt'>");
	echo("<div id=biblio>");
	echo("<h1>".$item[0]."</h1>");
	
	echo("<div class=article_biblio_right>");
		
	echo("<p><img src='".$PHOTO_PATH.$item[1]."' width=300></p></div>");
		
	for ($i = 0; $i < count($item[2]); $i++) {
		if ($i == 0) {
			echo("<br><br>");
		}
		echo("<p>".$item[2][$i]. "</p>");
	}
	echo("</div>");     
	echo("</div>"); 
	
	echo("<div class=NEWS_BAR>");
	
	if ($nindex > 0) {
		$nn = $nindex - 1;
		echo("<a class=NEWS_BAR href=../wenyi/?action=lastbiblio&nindex=$nn>&#171; ".$NAME_PREV."</a>");
	} 
	else {
		echo("<span>&#171;  ".$NAME_PREV."</span>");
	}
	echo("&nbsp;&nbsp;&nbsp;&nbsp;");
	if ($nindex < ($nTotal-1)) {
		$nn = $nindex + 1;
		echo("<a class=NEWS_BAR href=../wenyi/?action=lastbiblio&nindex=$nn> ".$NAME_NEXT."  &#187;</a>");
	} 
	else {
		echo("<span> ".$NAME_NEXT."  &#187;</span>");
	}
	echo("<div class=NEWS_BAR_RR>");
	echo("<a class=NEWS_BAR href='../wenyi/?action=subitem&resource=wenhua&hindex=".$JY_START_ITEM."'>".$NAME_BACK."  <font color=red>&#187;</font></a>");
	echo("</div>");
 	echo("</div>");
	
}

function showLastBiblioList() {
	global $PHOTO_PATH, $LAST_BIBLIO_LIST, $NAME_RECOM;
	$item = $LAST_BIBLIO_LIST;
	$nb = count($item);
	if ($nb > 0) {
		echo("<div class=box_bg>&nbsp; </div>");
		echo("<div class='video_box'>");
		echo("<h1>".$NAME_RECOM."</h1>");
		echo("<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>");
		for ($n = 0; $n < $nb; $n+=5) { 
			echo("<TR>");
			for ($j = 0; $j < 5; $j++) {
				$i = $n + $j;
				echo("<td width=20%>");
				if ($i < $nb) {
					echo("<a href='../wenyi/?action=lastbiblio&nindex=".$i."'>");
					echo("<IMG SRC='".$PHOTO_PATH.$item[$i][1]."' width=100  height=150></a>");
				}
				else {
					echo("&nbsp;");
				}
				echo("</td>");
			
			}
			echo("</tr>");
		}
		echo("</table>");
		echo("</div>");
		
	}
}

function showLastRandonList($item) {
	global $NAME_LASTHD;
	if (count($item) > 0) {
		echo("<div class=box_bg>&nbsp; </div>");
		echo("<div class='video_box'>");
		echo("<h1>".$NAME_LASTHD."</h1>");
		echo("<div class='same_item'>");
		for ($j = 1; $j < count($item); $j++) {
			$sitem = $item[$j];
			$title = $sitem[0];
			$url = $sitem[1];
			echo("<p>&nbsp;&nbsp;&nbsp;&nbsp;<font color=red>&#187;</font> <a href='".$url."'>".$title. "</a></p>");
		}
		echo("</div><br><br>");
		echo("</div>");
	}
}


function displaySlidePhotos($images, $pindex) {
	global $PHOTO_PATH;
	$nb = count($images)/2;
	if ($nb > 0) {
		echo("<div align=center><div class='slider-head'>");
		for ($i = 0; $i < $nb; $i++) {
			$n = $i*2;
			//echo("<div class='slider'><a href='../home/topphoto.php?pindex=".$pindex."&imgindex=".$n. "'>");
			echo("<div class='slider'><a href=javascript:ChangeImage('".$images[$n]."')>");
			echo("<IMG alt='".$images[$n+1]."' src='".$PHOTO_PATH.$images[$n]."' border=0 width=150 height=100>");
			echo("</a></div>");
		}
		echo("</div></div>");
	}
}

function displayHuiguSlidePhotos($images) {
	global $PHOTO_PATH;
	$nb = count($images);
	echo("<div align=center><div class='slider-head'>");
	for ($i = 0; $i < $nb; $i++) {
		$item = $images[$i];
		//echo("<div class='slider'><a href='../huigu/?imgindex=".$i. "'>");
		//echo("<div class='slider'><a href=javascript:ChangeHuiguItem('".$item[0]."','".$item[3]."','".$item[1]."')>");
		echo("<div class='slider'><a href=javascript:setHuiguItem('".$i."')>");
		echo("<IMG alt='".$item[2]."' src='".$PHOTO_PATH.$item[1]."' border=0 width=150 height=100>");
		echo("</a></div>");
	}
	echo("</div></div>");
}


function showYoutubeVideoItem($items, $p) {
	$i = 0;
	$vtype = $items[1][2];
	$item = $items[3];
	$nb = count($item);
	echo("<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>");
	for ($n = 0; $n < $nb; $n+=5) { 
		echo("<TR>");
		for ($j = 0; $j < 5; $j++) {
			if ($i < $nb) {
				$sitem = $item[$i];
				echo("<td width=20% class=td_video><div class='bg_video'>");
				if ($vtype == "youtube") {
					echo("<a href='../video/?hgindex=".$p."&vtype=".$vtype."&vtitle=".$sitem[0]."&vname=".$sitem[3]."'>");
				} else {
					echo("<a href='../video/?hgindex=".$p."&vtype=".$vtype."&vtitle=".$sitem[0]."&vtp=".$sitem[2]."&vcode=".$sitem[3]."&vcode1=".$sitem[4]."'>");
				}
				echo("<h5>".$sitem[1]."</h5></a>");
				echo("</div></td>");
			}
			else {
				echo("<td width=20%>&nbsp;</td>");
			}
			$i++;
		}
		echo("</TR>");	
	}
	echo("</table>");
}

function showYoutubeVideoLists($items) {
	global $NAME_VIDEO;
	$nb_v = count($items)-1;

	echo("<div class='video_box'>");
	echo("<h1>".$NAME_VIDEO."</h1>");
	for ($p = $nb_v; $p >= 0; $p--) { 
		$item = $items[$p];

		showYoutubeVideoItem($item, $p);
	}		
	echo("</div>");
}

/* expo function */

function showExpoPageTitle($index, $more) {
	global $PHOTO_PATH, $JY_START_ITEM, $NAME_BACK, $NAME_MORE, $EXPO_TAB;
	
	$items = $EXPO_TAB[$index];
	if (strlen($items[$JY_START_ITEM-2]) > 5) {
		echo("<div class='PROG_TIT2'>");
		echo("<IMG src='".$PHOTO_PATH."../images/".$items[$JY_START_ITEM-2]."'>");
	}
	else {
		echo("<div class='PROG_TIT1'>");
		echo("<h1>".$items[0]."</h1>");
	}
	echo("<div class=box_tit_more>");
	if ($more) {
		echo("<a class=box_tit_more href='../jiaoliu/?action=subitem&resource=".$items[1]."'>".$NAME_MORE." <font color=red>&#187;</font></a>");
	}
	else {
		echo("<a class=box_tit_more href='../newschool/'>".$NAME_BACK." <font color=red>&#187;</font></a>");
	}
	echo("</div>");
	echo("<div class=red_line>&nbsp;</div>");
	echo("</div>");
}


function showExpoPage($index) {
	
	showExpoPageTitle($index, 0);
	
	$pagelist = new JLPageListClass();
	
	$mitem = $pagelist->getExpoPageLists();
	
	$sitem = $mitem[0]->getJLPageItem();
	showPhotoArticlePage($sitem[0], $sitem, 0);
	
	echo("<div class='PROG_TIT2'><br>");
	echo("</div>");
	echo("<div class='box_txt'>");
	if (count($sitem) > 3) {
		showAlbumPhotos($sitem[3]);
	}
	echo("</div>");
}

function showShoolPageIndex($subitem, $nindex, $isfull) {
	
	global $PHOTO_PATH, $JY_START_ITEM, $NAME_BACK, $NAME_MORE, $EXPO_TAB;
	
	$isf = isFrancais();
		
	if ($isf)
		echo("<div class='PROG_TIT1'><h1>".$subitem[1]. "</h1>");
	else
		echo("<div class='box_tit'><h1>" .$subitem[0]. "</h1>");
	echo("<div class=more_bottom>");
	if ($isfull)
		echo("<a class=box_tit_more href='../newschool/'>".$NAME_BACK."  <font color=red>&#187;</font></a>");
	else
		echo("<a class=box_tit_more href='../newschool/?action=subitem&nindex=".$nindex."'>".$NAME_MORE."<font color=red>&#187;</font></a>");

	echo("</div><div class=red_line>&nbsp; </div></div>");
							
							
	echo("<div class='box_txt'><br>");
	echo("<div class=box_tit1_text1>");
	if ($isfull == 0)
		$nb_item = 4;
	else 
		$nb_item = count($subitem);
	for ($i = 2; $i < $nb_item; $i+=2) {
		$item = $subitem[$i];
		if ($isf) {
			$title = $item[2];
			$photos = $item[0];
		}
		else {
			$title = $item[1];
			$photos = $item[0];
		}
		echo("<IMG SRC='".$PHOTO_PATH.$photos."' width=300 height=225 border=0>");
		echo("<div class=img_label>".$title."</div>");
	}
	echo("</div><div class=box_tit1_text2>");
	for ($i = 3; $i < $nb_item; $i+=2) {
		$item = $subitem[$i];
		if ($isf) {
			$title = $item[2];
			$photos = $item[0];
		}
		else {
			$title = $item[1];
			$photos = $item[0];
		}
		echo("<IMG SRC='".$PHOTO_PATH.$photos."' width=300 height=225 border=0>");
		echo("<div class=img_label>".$title."</div>");
	}
	echo("</div></div>");
}
				

function showShoolPage($nindex) {
				
	global $PHOTO_PATH, $JY_START_ITEM, $NAME_BACK, $NAME_MORE, $EXPO_TAB;
				
				
	$sitem= $EXPO_TAB[0];
				
	$isf = isFrancais();
				
				
	if ($isf)
		echo("<div class='PROG_TIT1'><h1>".$sitem[1]."</h1>");
	else
		echo("<div class='box_tit'><h1>" .$sitem[0]."</h1>");
						
	echo("<div class=red_line>&nbsp; </div>");
	echo("<div class=more_bottom>");
	echo("</div></div>");
	echo("<div class='PROG_TIT1'>");
	if ($isf)
		$item= $sitem[$JY_START_ITEM];
	else
		$item= $sitem[$JY_START_ITEM-1];
	for ($i = 0; $i < count($item); $i++) {
		echo("<p>" .$item[$i]. "</p>");
	}
						
	echo("</div>");
						
						
						
	$mitem= $sitem[$JY_START_ITEM+1];
						
	if ($nindex > 0){
		$subitem = $mitem[$nindex-1];
		showShoolPageIndex($subitem, $nindex, 1);
	}
	else {
		for ($n = 0; $n < count($mitem); $n++) {
			$subitem = $mitem[$n];
			showShoolPageIndex($subitem, ($n+1), 0);
		}
	}
}


?>
