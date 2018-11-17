<?php

include_once("../jiaoliu/jl_include.php");
class JLPageForm {
	var $maxfile = 6;
function resize_photo($imagename, $path) {
	if (strstr(strtoupper($imagename), ".JPG")) {
		$file = $path."/".$imagename; 		
		$save = $path."/s_".$imagename;
		list($width, $height) = getimagesize($file) ; 
		$image = imagecreatefromjpeg($file) ; 
		
		$newwidth = 200;
		$newheight = 150;
		$tn = imagecreatetruecolor($newwidth, $newheight) ; 
		imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
		imagejpeg($tn, $save, 50) ;
		 
		
		$percent = 800/$width;
		$newwidth = $width * $percent;
		$newheight = $height * $percent;
		$tn = imagecreatetruecolor($newwidth, $newheight) ; 
		imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
		imagejpeg($tn, $file, 75) ; 
		
	}
}	
	
function uploadFile($srcfile, $destfile, $path) 
{
	$ret = 1;
	if (!file_exists($path)) {
 		mkdir($path, 0777, true);
	}
	if ($destfile && $srcfile) {
		if (file_exists( $path."/".$destfile)) {
	      	$ret = 0;
	    } else {
			$ret = move_uploaded_file($srcfile, $path."/".$destfile);
			$this->resize_photo($destfile, $path);
	    }
	}
	else {
		$ret = 0;
	}
	return $ret;
}

function WriteJLPhoto($lists, $varname, $mindex, $nindex)
{
	global $JL_TAB, $JY_START_ITEM;
	$nbphoto = 0;

	if ($mindex > 0 && $nindex >=0) {

		$items = $JL_TAB[$mindex - 1];
		$item = $items[$JY_START_ITEM][$nindex];
		$text  = "<?php\n\n\$".$varname." = array(\n";
		if (count($item) > 3) {
			$photos = $item[3];
			
			$nbphoto = count($photos);
			for ($i = 0; $i < $nbphoto; $i++) {
				$text .= "\t array(\"" .$photos[$i][0]. "\",\t\"".$photos[$i][1]. "\",\t\"".$lists[$i][0]."\",\t\"".$lists[$i][1]. "\"),\n";
			}
		}
		for ($i = $nbphoto; $i < count($lists); $i++) {
			$text .= "\t array(\"" .$lists[$i][0]. "\",\t\"".$lists[$i][1]. "\",\t\"".$lists[$i][2]. "\",\t\"".$lists[$i][3]. "\"),\n";
		}
		$text .= ");\n?>\n";
		
		$filename = "../jiaoliu/jiaoliupagephoto/".strtolower($varname).".inc";
		$fp = fopen($filename, "w");
		fwrite($fp, $text);
		fclose($fp);
	}
}


function uploadJLPhoto() {
	$lists = array();
	$mindex  = getPostValue("jlitem");
	$nindex  = getPostValue("nindex");
	$path  = getPostValue("filepath");
	$varname  = getPostValue("varname");
	
	if (!$path) {
		$path = strtolower($varname);
	}

	$nbphoto = getPostValue("nbphoto");
	for ($i = 1; $i <= $nbphoto; $i++) {
		$ff = array();
		$ff[] = getPostValue("premarks_".$i);
		$ff[] = getPostValue("fpremarks_".$i);
		$lists[] = $ff;
	}
	
 	for ($i = 1; $i < $this->maxfile; $i++) {
		if(isset($_FILES['photo_'.$i])) { 
	    	$photoname = basename($_FILES['photo_'.$i]['name']);
	     	$tmpName = $_FILES['photo_'.$i]['tmp_name'];
	     	$remake  = getPostValue("remarks_".$i);
	     	$fremake  = getPostValue("fremarks_".$i);
	     	if ($this->uploadFile($tmpName, $photoname, "../photos/" .$path)) {
				$ff = array();
				$ff[] = $path."/s_" .$photoname;
				$ff[] = $path."/" .$photoname;
				$ff[] = $remake;
				$ff[] = $fremake;
				$lists[] = $ff;
			}
		}
	}

	$this->WriteJLPhoto($lists, $varname, $mindex, $nindex);
}

function showUploadJLPhotoForm($mindex, $nindex, $msg)  {
	global $JLPHOTO_TYPE, $JL_TAB, $JY_START_ITEM;
	$title = "";
	$photos = "";
	$path = "";
	$nbphoto = 0;
	$varname = "JL_NEWS_sp";
	$show = 0;
	if ($mindex > 0 && $nindex >=0) {
		$items = $JL_TAB[$mindex - 1];
		$item = $items[$JY_START_ITEM][$nindex];
		$title = $item[0];
		if (count($item[1]) > 2) {
			$varname = $item[1][2];
		}
		
		if (count($item) > 3) {
			$photos = $item[3];
			$nbphoto = count($photos);
			if ($nbphoto > 0) {
				$pfile = $photos[0][0];
				$path_parts = pathinfo($pfile);
				$path = $path_parts['dirname'];
				
			}
		}
		$show = 1;
	}

?>
<FORM action='admin.php' name="uploadform" method=post enctype="multipart/form-data">
<INPUT type=hidden name='action' value='uploadjlphotos'>
<INPUT type=hidden name='mtype' value='<?php echo($JLPHOTO_TYPE); ?>'>
<INPUT type=hidden name='jlitem' value='<?php echo($mindex); ?>'>
<INPUT type=hidden name='nindex' value='<?php echo($nindex); ?>'>
<INPUT type=hidden name='filepath' value='<?php echo($path); ?>'>
<INPUT type=hidden name='nbphoto' value='<?php echo($nbphoto); ?>'>
<INPUT type=hidden name='varname' value='<?php echo($varname); ?>'>


<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR><TD class=error height=20><?php echo($msg) ?></TD></TR>
<TR>
	<TD class=labelright>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD height=80>
				<div class=item_tit>
				<h2>上传文化交流相关照片</h2>
				<h4><font color=red>(图片尺寸 800 x 600)</font></h4>
				</div>
			</TD>
		</TR>
		<TR>
			<TD class=labelcenter height=50><h2><?php echo($title); ?></h2></TD>
		</TR>
		<TR>
			<TD>
				<TABLE cellSpacing=1 cellPadding=0 width=98% border=0 align=center>
				<TR>
					<TD class=TABLE_TITLE height=30 width=50% colspan=2>照片文件</TD>
					<TD class=TABLE_TITLE height=30 width=50% colspan=2>照片注释</TD>
				</TR>

<?php 	for ($p = 1; $p < $this->maxfile; $p++) { ?>
				<TR>
					<TD class=labelright height=30 width=5%><?php echo($p); ?>.</TD>
					<TD class=labelleft width=45%>
						<input name="photo_<?php echo($p); ?>" size=30 type="file" id="photo_<?php echo($p); ?>" title="photo_<?php echo($p); ?>" value="photo_<?php echo($p); ?>" >
					</TD>
					<TD class=labelleft width=50%>
						中文: <INPUT class=fields type=text size=40 name="remarks_<?php echo($p); ?>" id="remarks_<?php echo($p); ?>"><br>
						法文: <INPUT class=fields type=text size=40 name="fremarks_<?php echo($p); ?>" id="fremarks_<?php echo($p); ?>">
					</TD>
				</TR>
				<TR><TD colspan=4 height=10></TD></TR>
<?php } ?>
				</TABLE>
			</TD>
		</TR>

<?php if ($photos) { ?>
		<TR>
			<TD>
				<TABLE cellSpacing=2 cellPadding=0 width=98% border=0 align=center>
<?php 	for ($p = 1; $p <= count($photos); $p++) { 
			$pitem = $photos[$p-1];
			$pfile = $pitem[0];
			$premarks = $pitem[2];
			$fpremarks = "";	
			if (count($pitem) > 3) {
				$fpremarks = $pitem[3];
			}
?>
				<TR>
					<TD class=labelright height=30 width=5%><?php echo($p); ?>.</TD>
					<TD class=labelleft width=45%>
						<IMG src="../photos/<?php echo($pfile); ?>" height=50>
					</TD>
					<TD class=labelleft colspan=2 width=50%>
						中文: <INPUT class=fields type=text size=40 name="premarks_<?php echo($p); ?>" id="premarks_<?php echo($p); ?>" value="<?php echo($premarks); ?>"><br>
						法文: <INPUT class=fields type=text size=40 name="fpremarks_<?php echo($p); ?>" id="fpremarks_<?php echo($p); ?>" value="<?php echo($fpremarks); ?>">
					</TD>
				</TR>
				<TR><TD colspan=4 height=10></TD></TR>
<?php 	} 	?>
				</TABLE>
			</TD>
		</TR>
<?php 	}  ?>


		<TR><TD height=50 class=labelleft></TD></TR>
<?php if ($show) { ?>		
		<TR>
			<TD height=50 class=labelcenter>
				<div align=center>
					<INPUT class=button type=submit name="uploadphoto" value=' 上传照片 '>
				</div>
			</TD>
<?php } ?>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
</FORM>
	
<?php	
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



function addToJiaoliuList($jiaoliutype, $varname) {
	global $JL_EXPO_NAME, $JL_CONF_NAME, $JL_FETE_NAME;
	$JL_LIST = array($JL_EXPO_NAME, $JL_CONF_NAME, $JL_FETE_NAME);
	$JL_VAR_NAME = array("JL_EXPO", "JL_CONF", "JL_FETE");
	$should = 1;
	if ($jiaoliutype < 4) {
		$tab = $JL_LIST[$jiaoliutype-1];
		$nb = count($tab);
		$new_tab = array();
		$new_tab[] = $varname;
		for ($i = 0; $i < $nb; $i++) {
			if ($tab[$i] == $varname) {
				$should = 0;
				break;
			}
			$new_tab[] = $tab[$i];
		}
		if ($should ) {
			$text = "<?php\n\n";
			for ($i = 1; $i < 4; $i++) {
				if ($i == $jiaoliutype) {
					$text .= $this->getVariableString($JL_VAR_NAME[$i-1], $new_tab);
				}
				else {
					$text .= $this->getVariableString($JL_VAR_NAME[$i-1], $JL_LIST[$i-1]);
				}
			}
			$text .= "\n\n?>";
		
			$filename = "../jiaoliu/jl_list_include.inc";
			$fp = fopen($filename, "w");
			fwrite($fp, $text);
			fclose($fp);
		}
	}
}





function addJiaoliuPage() {
	global $JL_TAB;
	$jiaoliutype  	= getPostValue("jiaoliutype");
	if ($jiaoliutype < 1) {
		return "错误 : 请选择添加哪个类型!";
	}

	$mindex 	= getPostValue("jlitem");
	$nindex  	= getPostValue("nindex");
	$varname  	= getPostValue("varname");
	if (strstr($varname, "_sp")) {
		$vvarname = $varname;
		$varname = str_replace("_sp", "_s", $vvarname);
	}
	else if(strstr($varname, "_s")) {
		$vvarname = $varname. "p";
	}
	else {
		if ($varname) {
			$varname = $varname. "_".$jiaoliutype."_s";
		}
		else {
			$items = $JL_TAB[$jiaoliutype - 1];
			$varname = "jlpage_new_".count($items)."_s";
		}
		$vvarname = $varname. "p";
	}
	
	$text = "<?php\n \$" .$varname. " = array(\n";
	
	$title = getPostValue("title");
	$stitle = getPostValue("subtitle");
	$image = getPostValue("imgfile");
	$news = changeDoubleString(getPostValue("jlpagenews"));
	$text .= "\"" .changeDoubleString($title). "\",\n";		// title
	$text .= "array(\"" .$image. "\",\t \"" .changeDoubleString($stitle).  "\",\t \"" .$vvarname. "\"),\n";	// subtitle, image, varname
	$text .= "array(\"" .changeReturnToArray($news). "\"),\n";
	// images
	$text .= "\$" .$vvarname. ",\n\n";

	// french 
	$ftitle = getPostValue("ftitle");
	$fstitle = getPostValue("fsubtitle");
	$fnews = changeDoubleString(getPostValue("fjlpagenews"));
	$fimage = getPostValue("fimgfile");
	$text .= "array(\n";
	$text .= "\"" .changeDoubleString($ftitle). "\",\n";		// title
	$text .= "array(\"" .$fimage. "\",\t \"" .changeDoubleString($fstitle).  "\",\t \"" .$vvarname. "\"),\n";	// subtitle, image, varname
	$text .= "array(\"" .changeReturnToArray($fnews). "\"),\n";
	// images
	$text .= "\$" .$vvarname. "\n),\n";
	
	$text .= "1 // new version with franch\n";
	
	$text .= ");\n?>";
	
	$path = "../jiaoliu/jiaoliupage";
	
	/* write news info */
	$filename = $path."/".strtolower($varname).".inc";
	$fp = fopen($filename, "w");
	fwrite($fp, $text);
	fclose($fp);
	
	$filename = $path."/jiaoliupageinfos.inc";
	addIncludeLine($filename, strtolower($varname));

	$path = "../jiaoliu/jiaoliupagephoto";
	$filename = $path."/jiaoliuphotos.inc";
	/* if not found, add an empty variable */
	if (addIncludeLine($filename, strtolower($vvarname)) == 0) {
		$text = "<?php\n \$" .$vvarname. " = array(); \n?>";
		$filename = $path."/".strtolower($vvarname).".inc";
		$fp = fopen($filename, "w");
		fwrite($fp, $text);
		fclose($fp);
	}
	
	/* add to jiaoliu list */
	$this->addToJiaoliuList($jiaoliutype, $varname) ;
	
	
	return "";
}

function showJLPageForm($jlnews, $mindex, $nindex, $msg) {
	global $FASTNEWS_JY, $FASTNEWS_JL, $FASTNEWS_WY, $JLNEWS_TYPE, $JL_TAB, $JY_START_ITEM;

	$modified 		= 0;
	$isupdate 	= 0;
	$title 		= "";
	$ftitle 	= "";
	$stitle 	= "";
	$fstitle 	= "";
	$news 		= "";
	$fnews 		= "";
	$imgfile	= "";
	$fimgfile	= "";
	$varname = "";
	$n_item = 0;
	if ($jlnews) {
		$title 		= $jlnews[0];
		$stitle 	= $jlnews[0];
		$newstext 	= $jlnews[5];
		for ($i = 0; $i < count($newstext); $i++) {
			$news .= $newstext[$i]. "\n";
		}
		if (count($jlnews) > 6) {
			$fjlnews 	= $jlnews[6];
			/* francais */
			$ftitle 	= $fjlnews[0];
			$fstitle 	= $fjlnews[0];
			$newstext 	= $fjlnews[5];
			for ($i = 0; $i < count($newstext); $i++) {
				$fnews .= $newstext[$i]. "\n";
			}
		}
		$varname = "jlpage_".$nindex."_sp";
		$modified = 1;
	}
	else if ($nindex >=0) {
		$n_item = $mindex;
		$items = $JL_TAB[$mindex - 1];
		if ($nindex >= count($items[$JY_START_ITEM]))
			$nindex = 0;
		$item = $items[$JY_START_ITEM][$nindex];
		$title = $item[0];
		$img 	= $item[1];
		$modified = 1;
		$newstext 	= $item[2];
		$imgfile	= $img[0];
		$stitle = $img[1];
		$varname = $img[2];
		for ($i = 0; $i < count($newstext); $i++) {
			$news .= $newstext[$i]. "\n";
		}
		if (count($item) > 4) {
			$fitem = $item[4];
			$ftitle = $fitem[0];
			$fimg 	= $fitem[1];
			$newstext 	= $fitem[2];
			$fimgfile	= $fimg[0];
			$fstitle = $fimg[1];
			for ($i = 0; $i < count($newstext); $i++) {
				$fnews .= $newstext[$i]. "\n";
			}
		}

		$isupdate = 1;
	}
	
?>

<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR>
	<TD class=error height=20><?php echo($msg) ?></TD>
</TR>
<TR>
	<TD height=50>
	<h2>
	<?php if ($isupdate) { ?>
		修改文化交流页面
	<?php } else { ?>
		添加文化交流页面
	<?php } ?>
	</h2>
	</TD>
</TR>
<TR>
	<TD>

<FORM action='admin.php' name="addjlpage" method=post enctype="multipart/form-data">
<INPUT type=hidden name='action' value='addjlpage'>
<INPUT type=hidden name='mtype' value='<?php echo($JLNEWS_TYPE); ?>'>
<INPUT type=hidden name='jlitem' value='<?php echo($mindex); ?>'>
<INPUT type=hidden name='nindex' value='<?php echo($nindex); ?>'>
<INPUT type=hidden name='varname' value='<?php echo($varname); ?>'>
		
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD >
		<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
		<TR>
			<TD width=15% class=labelright1 height=30>中文题目 : </TD>
				<TD width=85% class=labelleft>
					<INPUT class=fields type=text size=70 name="title" value="<?php echo($title); ?>">
				</TD>
			</TR>
			<TR>
				<TD class=labelright1 height=30>中文副标题 : </TD>
				<TD class=labelleft>
					<INPUT class=fields type=text size=70 name="subtitle" value="<?php echo($stitle); ?>">
				</TD>
			</TR>
			<TR>
				<TD class=labelright1 height=30>图片 : </TD>
				<TD class=labelleft>
					<INPUT class=fields type=text size=70 name="imgfile" value="<?php echo($imgfile); ?>">
				</TD>
			</TR>
			<TR>
				<TD class=labelright1 valign=top>中文介绍 : </TD>
				<TD class=labelleft>
					<textarea class=fields name="jlpagenews" cols="70" rows="20"><?php echo($news); ?></textarea>
				</TD>
			</TR>
				
			<TR><TD colspan=2 height=20></TD></TR>
			<TR>
				<TD class=labelright1 height=30>法文题目 : </TD>
				<TD class=labelleft>
					<INPUT class=fields type=text size=70 name="ftitle" value="<?php echo($ftitle); ?>">
				</TD>
			</TR>
			<TR>
				<TD class=labelright1 height=30>法文副标题 : </TD>
				<TD class=labelleft>
					<INPUT class=fields type=text size=70 name="fsubtitle" value="<?php echo($fstitle); ?>">
				</TD>
			</TR>
			<TR>
				<TD class=labelright1 height=30>法文图片 : </TD>
				<TD class=labelleft>
					<INPUT class=fields type=text size=70 name="fimgfile" value="<?php echo($fimgfile); ?>">
				</TD>
			</TR>
			<TR>
				<TD class=labelright1 valign=top>法文介绍 : </TD>
				<TD class=labelleft>
					<textarea class=fields name="fjlpagenews" cols="70" rows="20"><?php echo($fnews); ?></textarea>
				</TD>
			</TR>
			</TABLE>
		</TD>
	</TR>
	<TR>
		<TD height=60 class=formlabel>
			<TABLE cellSpacing=0 cellPadding=0 width=70% border=0 align=center>
			<TR>
<?php 
    if ($isupdate) {
    	echo("<TD class=labelleft>");
		echo("<INPUT type=radio name='jiaoliutype' value='".$n_item."' checked> ".$items[0]);
		echo("</TD>");
    }
    else {
		$nb = count($JL_TAB);
		for ($i = 1; $i <= $nb; $i++) { 
			$items = $JL_TAB[$i-1];
			echo("<TD class=labelright1>");
			if ($n_item == $i) {
				echo("<INPUT type=radio name='jiaoliutype' value='".$i."' checked> ".$items[0]);
			}
			else {
				echo("<INPUT type=radio name='jiaoliutype' value='".$i."'> ".$items[0]);
			}
			echo("</TD>");
		}
    }
?>
			</TR>
			</TABLE>
		</TD>
	</TR>
	<TR>
		<TD height=60 class=formlabel>
			<div align=center>
<?php 	if ($isupdate && $modified) { ?>
				<INPUT class=button type=submit value=' 修改'>
<?php 	} else if ($modified) { ?>
				<INPUT class=button type=submit value=' 添加 '>
<?php 	} ?>
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
