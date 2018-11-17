<?php

include_once("../wenyi/wy_include.php");
class WYPageForm {


function getItemString($item, $vname, $i, $f) {
	$varname = "subtitle_".$i."_".$f;
	$stitle 	= getPostValue($varname);
	
	$varname = "subtitle2_".$i."_".$f;
	$stitle2 	= getPostValue($varname);
	
	$varname = "imgfile_".$i."_".$f;
	$image 	= getPostValue($varname);

	$varname = "infos_".$i."_".$f;
	$news = changeDoubleString(getPostValue($varname));

	$text = "";
	if ($varname) {
		$text .= "array(\"" .$image. "\",\t \"" .changeDoubleString($stitle).  "\",\t \"" .changeDoubleString($stitle2).  "\",\t \"".$vname. "\"),\n";	// image, subtitle, subtitle2 , varname
	}
	else {
		$text .= "array(\"" .$image. "\",\t \"" .changeDoubleString($stitle).  "\",\t \"" .changeDoubleString($stitle2). "\"),\n";	// image, subtitle, subtitle2,
	}
	$text .= "array(\"" .changeReturnToArray($news). "\"),\n";
	
	$titem = "";
	$other = "";
	if (count($item) > 3 && count($item[3]) > 0) {
		$titem 	= $item[3][0];
		if (count($item[3]) > 1)
			$other = $item[3];
	}
	
	if ($titem) {
		$varname 	= "weektitle_".$i."_".$f;
		$wtitle 	= getPostValue($varname);		
		$text .= "array(\n\tarray(\"".$wtitle."\", \"\",\n";
		
		for ($p = 2; $p <count($titem); $p++) { 
			$varname 	= "weekday_str_".$i."_".$f."_".$p;		
			$wd_str 	= getPostValue($varname);
			if ($wd_str && strlen($wd_str) > 10) {
				$varname 	= "weekday_".$i."_".$f."_".$p;
				$wd 		= getPostValue($varname);
				$text .= "\t\tarray(\"".$wd."\", \"". str_replace(";", "\", \"", $wd_str) ."\"),\n";
			}
		}
		$text .= "\t),\n";
		if ($other) { 
			for ($p = 1; $p < count($other); $p++) {
				
				$varname 	= "other_".$i."_".$f."_".$p;		
				$other_str 	= getPostValue($varname);
				if ($other_str && strlen($other_str) > 3) {
					$varname 	= "othertitle_".$i."_".$f."_".$p;		
					$oname 	= getPostValue($varname);
					$text .= "\tarray(\"".$oname."\", \"".$other_str."\"),\n";
				}
			}
		}
		
		$text .= "),\n";
	}
	else {
		$varname 	= "weektitle_".$i."_".$f;
		$wtitle 	= getPostValue($varname);		
		$text .= "array(\n\tarray(\"".$wtitle."\", \"\",\n";
		
		$varname 	= "weekday_str_".$i."_".$f."_3";		
		$wd_str 	= getPostValue($varname);
		$varname 	= "weekday_".$i."_".$f."_3";
		$wd 		= getPostValue($varname);
		$text .= "\t\tarray(\"".$wd."\", \"". str_replace(";", "\", \"", $wd_str) ."\"),\n";
		$text .= "\t),\n";
		
		$varname 	= "other_".$i."_".$f."_3";		
		$other_str 	= getPostValue($varname);
		$varname 	= "othertitle_".$i."_".$f."_3";		
		$oname 	= getPostValue($varname);
		$text .= "\tarray(\"".$oname."\", \"".$other_str."\"),\n";
		$text .= "),\n";
	}
	
	return $text;
}	
	
	
function addWenyuPage() {
	global $WY_TAB;
	$mindex 	= getPostValue("mindex");
	$nindex  	= getPostValue("nindex");
	$title  	= getPostValue("title");
	$ftitle  	= getPostValue("ftitle");
	$varname  	= getPostValue("varname");
	
	$text = "<?php\n\n\$" .$varname. " = array(\n";
	$text .= "\t\"" .changeDoubleString($title). "\",\n";		// title
	
	if ($mindex > 0 && $nindex >=0) {
		$items = $WY_TAB[$mindex-1];
		$item = $items[$nindex];
		$nb_item = count($item);
		if ($item[$nb_item-1] == 1) {
			$nb_item -= 2;
		}
		for ($i = 3; $i < $nb_item; $i++) {
			if ($i == 3) {
				$text .= $this->getItemString($item, $varname, $i, 1);
			}
			else {
				$text .= "array(\" \",\n";
				$text .= $this->getItemString($item, "", $i, 1);
				$text .= "),\n";
			}
		}

		$text .= "// francais \n";
		$text .= "array(\n";
		$text .= "\t\"" .changeDoubleString($ftitle). "\",\n";		// title
		for ($i = 3; $i < $nb_item; $i++) {
			if ($i == 3) {
				$text .= $this->getItemString($item, $varname, $i, 2);
			}
			else {
				$text .= "array(\" \",\n";
				$text .= $this->getItemString($item, "", $i, 2);
				$text .= "),\n";
			}
		}
		$text .= "),\n";
		
	}
	else {
		$text .= $this->getItemString(array(), $varname, 3, 1);
		$text .= "// francais \n";
		$text .= "array(\n";
		$text .= "\t\"" .changeDoubleString($ftitle). "\",\n";		// title
		$text .= $this->getItemString(array(), $varname, 3, 2);
		$text .= "),\n";
				
	}
	$text .= "1 // new version with franch\n";
	
	$text .= ");\n?>";
	
	$filename = "../wenyi/".strtolower($varname).".inc";
	$fp = fopen($filename, "w");
	fwrite($fp, $text);
	fclose($fp);
	
	//addIncludeLine($filename, strtolower($vvarname));
	
}

function showWYNewItemForm($stitle, $imgfile, $news, $i, $f) {
	$TT = array("", "中文", "法文");
	$TTITLE = array("", "上课时间", "Horaires");
	$LTITLE = array("", "报名表", "Inscription");
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD width=20% class=labelright1 height=30><?php echo($TT[$f]); ?>副标题 : </TD>
	<TD width=80% class=labelleft>
		<INPUT class=fields type=text size=40 name="<?php echo("subtitle_".$i."_".$f); ?>" value="<?php echo($stitle); ?>">
		<INPUT class=fields type=text size=40 name="<?php echo("subtitle2_".$i."_".$f); ?>" value="<?php echo($stitle); ?>">
	</TD>
</TR>
<TR>
	<TD class=labelright1 height=30>图片 : </TD>
	<TD class=labelleft>
		<INPUT class=fields type=text size=50 name="<?php echo("imgfile_".$i."_".$f); ?>" value="<?php echo($imgfile); ?>">
	</TD>
</TR>
<TR>
	<TD class=labelright1 valign=top><?php echo($TT[$f]); ?>介绍: </TD>
	<TD class=labelleft >
		<textarea class=fields name="<?php echo("infos_".$i."_".$f); ?>" cols="65" rows="10"><?php echo($news); ?></textarea>
	</TD>
</TR>
<TR>
	<TD class=labelright1 height=30 >
		<INPUT class=fields type=text size=10 name="<?php echo("weektitle_".$i."_".$f); ?>" value="<?php echo($TTITLE[$f]); ?>"> : 
	</TD>
	<TD>
		<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
		<TR>
			<TD width=100% class=labelleft height=30>
				<INPUT class=fields type=text size=10 name="<?php echo("weekday_".$i."_".$f); ?>" value=""> 
				<INPUT class=fields type=text size=60 name="<?php echo("weekday_str_".$i."_".$f); ?>" value=""> 
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD class=labelright1 height=30 > 
		<INPUT class=fields type=text size=10 name="<?php echo("othertitle_".$i."_".$f."_1"); ?>" value=""> : 
	</TD>
	<TD class=labelleft>
		<INPUT class=fields type=text size=85 name="<?php echo("other_".$i."_".$f."_1"); ?>" value=""> 
	</TD>
</TR>
</TABLE>
<?php
}

function showWYItemForm($item, $i, $f) {
	global $WYNEWS_TYPE, $WY_TAB;
	$stitle 	= "";
	$news 		= "";
	$imgfile	= "";
	$TT = array("", "中文", "法文");
	$img 		= $item[1];
	$imgfile	= $img[0];
	$stitle 	= $img[1];
	$stitle2 	= $img[2];
	$newstext 	= $item[2];
	$titem = "";
	$other = "";
	for ($p = 0; $p < count($newstext); $p++) {
		$news .= $newstext[$p]. "\n";
	}
	if (count($item) > 3 && count($item[3]) > 0) {
		$titem 	= $item[3][0];
		if (count($item[3]) > 1)
			$other = $item[3];
	}
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD width=20% class=labelright1 height=30><?php echo($TT[$f]); ?>副标题 : </TD>
	<TD width=80% class=labelleft>
		<INPUT class=fields type=text size=40 name="<?php echo("subtitle_".$i."_".$f); ?>" value="<?php echo($stitle); ?>">
		<INPUT class=fields type=text size=40 name="<?php echo("subtitle2_".$i."_".$f); ?>" value="<?php echo($stitle2); ?>">
	</TD>
</TR>
<TR>
	<TD class=labelright1 height=30>图片 : </TD>
	<TD class=labelleft>
		<INPUT class=fields type=text size=50 name="<?php echo("imgfile_".$i."_".$f); ?>" value="<?php echo($imgfile); ?>">
	</TD>
</TR>
<TR>
	<TD class=labelright1 valign=top><?php echo($TT[$f]); ?>介绍: </TD>
	<TD class=labelleft >
		<textarea class=fields name="<?php echo("infos_".$i."_".$f); ?>" cols="65" rows="10"><?php echo($news); ?></textarea>
	</TD>
</TR>
<?php if ($titem) { ?>
<TR>
	<TD class=labelright1 height=30 >
		<INPUT class=fields type=text size=10 name="<?php echo("weektitle_".$i."_".$f); ?>" value="<?php echo($titem[0]); ?>"> : 
	</TD>
	<TD>
		<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<?php for ($t = 2; $t < count($titem); $t++) { 
		$atab = $titem[$t];
		$tstr = "";
		for ($k = 1; $k < count($atab); $k++) {
			if ( $k == count($atab) - 1) {
				$tstr .= $atab[$k];
			}
			else {
				$tstr .= $atab[$k]. ";";
			}
		}
?>
		<TR>
			<TD width=100% class=labelleft height=30>
				<INPUT class=fields type=text size=10 name="<?php echo("weekday_".$i."_".$f."_".$t); ?>" value="<?php echo($atab[0]); ?>"> 
				<INPUT class=fields type=text size=70 name="<?php echo("weekday_str_".$i."_".$f."_".$t); ?>" value="<?php echo($tstr); ?>"> 
			</TD>
		</TR>
<?php } ?>
		</TABLE>
	</TD>
</TR>
<?php } ?>

<?php if ($other) { 
	for ($p = 1; $p < count($other); $p++) {
?>
<TR>
	<TD class=labelright1 height=30 > 
		<INPUT class=fields type=text size=10 name="<?php echo("othertitle_".$i."_".$f."_".$p); ?>" value="<?php echo($other[$p][0]); ?>"> : 
	</TD>
	<TD class=labelleft>
		<INPUT class=fields type=text size=85 name="<?php echo("other_".$i."_".$f."_".$p); ?>" value="<?php echo($other[$p][1]); ?>"> 
	</TD>
</TR>
<?php } } ?>
</TABLE>
<?php
}

function showWYPageForm($jlnews, $mindex, $nindex, $msg) {
	global $WYNEWS_TYPE, $WY_TAB;
	$show 		= 0;
	$isupdate 	= 0;
	$title 		= "";
	$ftitle 	= "";
	$stitle 	= "";
	$fstitle 	= "";
	$news 		= "";
	$fnews 		= "";
	$imgfile	= "";
	$fimgfile	= "";
	$fitem = "";
	$item = "";
	$vname = "WY_PAGE_";
	$nb_item = 0;
	if ($jlnews) {
		$title 		= $jlnews[0];
		$stitle 	= $jlnews[0];
		$newstext 	= $jlnews[5];
		$vname .= $nindex;
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
		$show = 1;
	}
	else if ($mindex > 0 && $nindex >=0) {
		$items = $WY_TAB[$mindex - 1];
		$item = $items[$nindex];
		$title = $item[0];
		
		$v = $item[1];
		if (count($v) > 3) {
			$vname = $v[3];
		}
		else {
			$vname = "WY_".$mindex."_".$nindex;
		}
		
		$nb_item = count($item)-1;
		if ($item[$nb_item] == 1) {
			$nb_item--;
			$fitem = $item[$nb_item];
			$ftitle = $fitem[0];
		}
		else {
			$nb_item++;
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
		修改文化娱乐页面 
	<?php } else { ?>
		添加文化娱乐页面
	<?php } ?>
	</h2>
	</TD>
</TR>
<TR>
	<TD>

<FORM action='admin.php' name="addjlpage" method=post enctype="multipart/form-data">
<INPUT type=hidden name='action' value='addwypage'>
<INPUT type=hidden name='mtype' value='<?php echo($WYNEWS_TYPE); ?>'>
<INPUT type=hidden name='mindex' value='<?php echo($mindex); ?>'>
<INPUT type=hidden name='nindex' value='<?php echo($nindex); ?>'>
<INPUT type=hidden name='varname' value='<?php echo($vname); ?>'>		
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD >
				<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
				<TR>
					<TD width=20% class=labelright1 height=30>中文题目 : </TD>
					<TD width=80% class=labelleft>
						<INPUT class=fields type=text size=85 name="title" value="<?php echo($title); ?>">
					</TD>
				</TR>
		<?php if ($item) { ?>
				<TR><TD colspan=2><?php $this->showWYItemForm($item, 3, 1); ?></TD></TR>
				<TR><TD colspan=2 height=15></TD></TR>
			<?php for ($i = 4; $i < $nb_item; $i++ ) { $sitem = $item[$i]; ?>
				<TR><TD colspan=2><?php $this->showWYItemForm($sitem, $i, 1); ?></TD></TR>
				<TR><TD colspan=2 height=15></TD></TR>
			<?php  	} 	
			} else { ?>
				<TR>
					<TD colspan=2>
					<?php $this->showWYNewItemForm($stitle, $imgfile, $news, 3, 1);  ?>
					</TD>
				</TR>
			<?php } ?>
				<TR><TD colspan=2 height=15></TD></TR>		
				<TR>
					<TD class=labelright1 height=30>法文题目 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=50 name="ftitle" value="<?php echo($ftitle); ?>">
					</TD>
				</TR>
	<?php  if ($fitem) { ?>
				<TR><TD colspan=2><?php $this->showWYItemForm($fitem, 3, 2); ?></TD></TR>
				<TR><TD colspan=2 height=15></TD></TR>

			<?php for ($i = 4; $i < $nb_item; $i++ ) { $sitem = $fitem[$i]; ?>
				<TR><TD colspan=2><?php $this->showWYItemForm($sitem, $i, 2); ?></TD></TR>
				<TR><TD colspan=2 height=15></TD></TR>
			<?php  	} 
		}	else { 
			$i = 3;
			do { ?> 
				<TR>
					<TD colspan=2>
					<?php $this->showWYNewItemForm($fstitle, $fimgfile, $fnews, $i, 2);  ?>
					</TD>
				</TR>
			<?php $i++;
			} while ($i < $nb_item) ;
			
			} ?>

				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD height=60 class=formlabel>
				<div align=center>
				<?php if ($isupdate) { ?>
				<INPUT class=button type=submit value=' 修改'>
				<?php } else { ?>
				<INPUT class=button type=submit value=' 添加 '>
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



}
?>
