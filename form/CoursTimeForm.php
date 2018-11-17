<?php

include_once "../register/school_schedule.inc";

class CoursTimeForm {
	var $error = "";

function writeCoursTimes() {
	global $REGISTER_TAB, $CLASS_COURS_CHINOIS;
	
	$nindex  = getPostValue("nindex");
	$isadd  = getPostValue("nadded");
	$registtab  = getPostValue("registtab");
	
	if ($registtab) {
		$filename = "../public/cours_times.inc";
		$text  = "<?php\n\n\$REGISTER_TAB = array(\n";
		$tab = $REGISTER_TAB;
	}
	else {
		$filename = "../public/cours_chinese_times.inc";		
		$text  = "<?php\n\n\$CLASS_COURS_CHINOIS = array(\n";
		$tab = $CLASS_COURS_CHINOIS;
	}
	
	if ($isadd) {
		if ($nindex < 0)
			$nindex = 0;
	}
	for ($i = 0; $i < count($tab); $i++) { 
		$items = $tab[$i];
		$text  .= "array(\"".$items[0]."\", \"".$items[1]."\", ".$items[2].",\n";

		for ($j = 3; $j < count($items); $j++) { 
			$sitems = $items[$j];
			$text  .= "\tarray(\"".$sitems[0]."\", \"".$sitems[1]."\", " ;
			if (count($sitems) > 3 ) {
				if ($isadd && ($nindex != $i)) {
					$vtime = $sitems[2];
				}
				else {
					$vvname = "vttimes_".$i."_".$j;
					$vtime  = getPostValue($vvname);
				}
				if ($vtime)
					$text  .= "1, array(";
				else {
					$text  .= "0, array(";
				}
				$wrote = 0;
				for ($k = 0; $k < count($sitems[3]); $k++) { 
					if ($isadd && ($nindex != $i)) {
						$ttime = $sitems[3][$k];
						if ($wrote)		
							$text  .= ", \"".$ttime."\"";
						else {
							$text  .= "\"".$ttime."\"";
						}
						$wrote = 1;
					}
					else {
						$vname = "ttimes_".$i."_".$j."_".$k;
						$ttime  = getPostValue($vname);
						if ($ttime && strlen($ttime) > 5) {	
							if ($wrote)		
								$text  .= ", \"".$ttime."\"";
							else {
								$text  .= "\"".$ttime."\"";
							}
							$wrote = 1;
						}
					}
				}
				/* add line */
				if ($isadd && ($nindex == $i)) {
					$nvname = "newvalue_".$i."_".$j;
					$ttime  = getPostValue($nvname);
					if ($ttime && strlen($ttime) > 5) {	
						if ($wrote)		
							$text  .= ", \"".$ttime."\"";
						else {
							$text  .= "\"".$ttime."\"";
						}
					}
				}
				$text  .= ")";
				if (count($sitems) > 4) {
					$text  .= ", array(";
					for ($k = 0; $k < count($sitems[4]); $k++) { 
						$ttime = $sitems[4][$k];
						if ($k > 0)		
							$text  .= ", \"".$ttime."\"";
						else {
							$text  .= "\"".$ttime."\"";
						}
					}
					$text  .= ")";
				}
			}
			else {
				if ($sitems[2])
					$text  .= "1";
				else {
					$text  .= "0";
				}
			}
			$text  .= "),\n";
		}
		/* add line */
		if ($isadd && ($nindex == $i)) {
			$tname  = getPostValue("newname");
			$ttime  = getPostValue("newvalue");
			$tvalide  = getPostValue("newalide");
			$tkey = $items[1]."_".count($items);
			if ($ttime && strlen($ttime) > 5) {	
				if ($tvalide)
					$text  .= "\tarray(\"".$tname."\", \"".$tkey."\", 1, ";
				else 
					$text  .= "\tarray(\"".$tname."\", \"".$tkey."\", 0, ";
				$text  .= "array(\"".$ttime."\")),\n";
			}
		}
		$text  .= "),\n";
	}
	
	$text .= ");\n?>\n";
		
	$fp = fopen($filename, "w");
	fwrite($fp, $text);
	fclose($fp);
	
}	

function showCoursTable($timeTab, $title, $reg_tab, $nindex, $isadd)  {
	global $CTIMES_TYPE; 
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<FORM action='admin.php' name="uploadform" method=post enctype="multipart/form-data">
<INPUT type=hidden name='action' value='updatetimes'>
<INPUT type=hidden name='nadded' value='<?php echo($isadd); ?>'>
<INPUT type=hidden name='nindex' value='<?php echo($nindex); ?>'>
<INPUT type=hidden name='registtab' value='<?php echo($reg_tab); ?>'>
<INPUT type=hidden name='mtype' value='<?php echo($CTIMES_TYPE); ?>'>
<TR>
	<TD height=80>
		<div class=item_tit>
		<h2><?php echo($title); ?></h2>
		</div>
	</TD>
</TR>
<TR>
	<TD valign=top>
		<TABLE cellSpacing=1 cellPadding=0 width=98% border=0 align=center>
<?php 	
		$nb_item = count($timeTab);
		$start = 0;
		if ($isadd) {
			if ($nindex < 0) {
				$start = 0;
				$nb_item = 1; 
			}
			else {
				$start = $nindex;
				$nb_item = $nindex+1; 
			}
		}
		for ($i = $start; $i < $nb_item; $i++) { 
			$items = $timeTab[$i];
?>
		<TR>
			<TD class=lcenter width=20% height=40 >
				<font color=green size=3><?php echo(($i+1). ". ". $items[0]); ?></font>
			</TD>
			<TD class=lcenter width=75%>
				<font color=green size=3><?php if ($i == $start) echo("时间"); ?></font>
			</TD>
			<TD class=labelcenter width=5%>
				<font color=green size=3><?php if ($i == $start) echo("有效"); ?></font>
			</TD>
		</TR>
		<TR>
			<TD colspan=3 valign=top>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<?php 	
			for ($j = 3; $j < count($items); $j++) { 
				$sitems = $items[$j];
				if ($sitems[1] == "chinois") {
					continue;
				}
?>
				<TR>
					<TD class=lcenter  width=25% valign=top><?php echo($sitems[0]); ?></TD>
					<TD class=lcenter  width=70% valign=top>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<?php 	
			if (count($sitems) > 3 ) {
				if ($sitems[3][0] == "上课时间 ") {
					$ssitems = $sitems[3][2];
				}
				else {
					$ssitems = $sitems[3];
				}
				$vvname = "vttimes_".$i."_".$j;
				$nvname = "newvalue_".$i."_".$j;
				for ($k = 0; $k < count($ssitems); $k++) { 
					$titems = $ssitems[$k];
					$vname = "ttimes_".$i."_".$j."_".$k;
?>
						<TR>
							<TD class=labelleft height=30 valign=top>
							<INPUT class=fields type=text size=70 name="<?php echo($vname); ?>" value="<?php echo($titems); ?>">
							</TD>
						</TR>
<?php 				if ($isadd && $k == count($ssitems)-1)  { ?>
						<TR>
							<TD class=labelleft height=30 valign=top>
							<INPUT class=fields type=text size=70 name="<?php echo($nvname); ?>" value="">
							</TD>
						</TR>
<?php 				}
				}
			}
?>
						</TABLE>
					</TD>
					<TD class=lcenter  width=5%>
						<?php if ($sitems[2] == 1) { ?>
						<INPUT class=box type='checkbox' name="<?php echo($vvname); ?>" value='1'  checked>
						<?php } else { ?>
						<INPUT class=box type='checkbox' name="<?php echo($vvname); ?>" value='1'>
						<?php } ?>
					
					</TD>
				</TR>
				<TR><TD class=lcenter colspan=3 height=10></TD></TR>
<?php 
				} 
				
				if ($isadd) {
?>		
				<TR>
					<TD class=lcenter valign=top>
						<INPUT class=fields type=text size=15 name="newname" value="">
					</TD>
					<TD class=labelleft  valign=top>
						<INPUT class=fields type=text size=70 name="newvalue" value="">
					</TD>
					<TD class=lcenter >
						<INPUT class=box type='checkbox' name="newalide" value='1'>
					</TD>
				</TR>
<?php 			}
?>
				<TR><TD class=lcenter colspan=3 height=10></TD></TR>
				</TABLE>
			</TD>
		</TR>
<?php } ?>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD height=50 class=labelcenter>
		<INPUT class=button type=submit name="updatetimes" value=' 修改时刻表 '>
	</TD>
</TR>
</TABLE>
<?php	
}


function showCoursTimeItem($nitem, $msg)  {
	global $REGISTER_TAB, $CLASS_COURS_CHINOIS;

?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR><TD class=error height=20><?php echo($msg) ?></TD></TR>
<TR>
	<TD class=labelright>
<?php 
		if ($nitem == -1)
			$this->showCoursTable($CLASS_COURS_CHINOIS, "中文课程时刻表", 0, $nitem, 1);
		else 
			$this->showCoursTable($REGISTER_TAB, "课程时刻表",  1, $nitem, 1); 
?>
	</TD>
</TR>
		
<TR><TD height=50 class=labelleft><div class=item_tit>
		
</TABLE>

	
<?php	
}

function showCoursTime($msg)  {
	global $REGISTER_TAB, $CTIMES_TYPE, $CLASS_COURS_CHINOIS;

?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR><TD class=error height=20><?php echo($msg) ?></TD></TR>
<TR>
	<TD class=labelright>
		<?php $this->showCoursTable($REGISTER_TAB, "课程时刻表", 1, 0, 0); ?>
	</TD>
</TR>
		
<TR><TD height=50 class=labelleft></TD></TR>

</TABLE>

	
<?php	
}


function getFeteTable()  {
	global $FETE_TAB;
	$lists = array(); 
	for ($i = 0; $i < count($FETE_TAB); $i++) { 
		$items = $FETE_TAB[$i];
		$nb = count($items)-1;
		
		$tvar = "month_".$i;
		$tmonth  = getPostValue($tvar);
		$tvar = "day_".$i;
		$tday  = getPostValue($tvar);
		if ($tday) {
			$ll = explode(",", $tday);
			$elem = array();
			$elem[] = $tmonth;

			for ($j = 0; $j < count($ll); $j++) {
				$elem[] = $ll[$j];
			}
			$elem[] = $items[$nb-1];
			$elem[] = $items[$nb];
			$lists[] = $elem;
		}
	}	
	return $lists;
}

function saveFete()  {
	global $PROGRAM_JPG, $PROGRAM_PDF;
	$tab = $this->getFeteTable(); 

	$text  = "<?php\n\n\$FETE_TAB = array(\n";

	for ($i = 0; $i < count($tab); $i++) { 
		$items = $tab[$i];
		$nb = count($items)-1;
		$text  .= "\tarray(".$items[0].", " ;
		for ($j = 1; $j < $nb-1; $j++) { 
			$text  .= $items[$j].", " ;
		}
		$text  .= "\$".$items[$nb].", " ;
		$text  .= "\"".$items[$nb]."\"" ;
		$text  .= "),\n";
	}
	$text  .= ");\n\n";

	$day1  = getPostValue("start_day1");
	$day2  = getPostValue("start_day2");
	
	$text  .= "\$START_DAY1 = ". $day1. ";\n";
	$text  .= "\$START_DAY2 = ". $day2. ";\n\n";

	$text  .= "\$PROGRAM_JPG = \"". $PROGRAM_JPG. "\";\n";
	$text  .= "\$PROGRAM_PDF = \"". $PROGRAM_PDF. "\";\n\n";
	
	$text .= "?>\n\n";
	
	$fname = "../register/school_schedule.inc";
	$fp = fopen($fname, "w");
	fwrite($fp, $text);
	fclose($fp);
	return $tab;
}

function uploadFile($srcfile, $destfile, $isimg) 
{
	$ret = 0;
	if ($destfile && $srcfile) {
		$lowstr = strtolower($destfile);
		if ((strstr($lowstr, ".jpg") || strstr($lowstr, ".png"))) {
			if ($isimg) {
				move_uploaded_file($srcfile, "../photos/oushi/".$destfile);
				resize_photo($destfile, $destfile, "../photos/oushi", 650);
				$ret = 1;
			}
			else {
				$this->error .= $destfile. " is not PDF/DOC File!<br>";
			}
		}
		else if ((strstr($lowstr, ".pdf") || strstr($lowstr, ".doc")) ) {
			if ($isimg == 0) {
				move_uploaded_file($srcfile, "../files/".$destfile);
				$ret = 1;
			}
			else {
				$this->error .= $destfile. " is not IMAGE File!<br>";
			}
		}
		else {
			$this->error .= $destfile. " is not IMAGE/PDF File!<br>";
		}
	}
	return $ret;
}

function writePrograms() {
	global $PROGRAM_JPG, $PROGRAM_PDF;
	$pdffile = "";
	$jpgfile = "";
	$this->error = "";
	if(isset($_FILES['pdffile'])) { 
		$pdffile = basename($_FILES['pdffile']['name']);
		$tmpName = $_FILES['pdffile']['tmp_name'];
		if ($this->uploadFile($tmpName, $pdffile, 0) == 0) {
			$pdffile = "";
		}
	}
	if(isset($_FILES['jpgfile'])) { 
		$jpgfile = basename($_FILES['jpgfile']['name']);
		$tmpName = $_FILES['jpgfile']['tmp_name'];
		if ($this->uploadFile($tmpName, $jpgfile, 1) == 0) {
			$jpgfile = "";
		}
	}
	
	$filename = "../register/school_schedule.inc";
	$lines = file($filename);
	$text = "";
	$changed = 0;
	foreach ($lines as $line_num => $line) {
		if (strstr($line, "PROGRAM_JPG") && $jpgfile) {
			$text  .= "\$PROGRAM_JPG = \"". $jpgfile. "\";\n";
			$changed = 1;
		}
		else if (strstr($line, "PROGRAM_PDF") && $pdffile) {
			$text  .= "\$PROGRAM_PDF = \"". $pdffile. "\";\n\n";
			$changed = 1;
		}
		else {
			$text .= $line;
		}
	}
	if ($changed) {
		$fp = fopen($filename, "w");
		fwrite($fp, $text);
		fclose($fp);
	}
	return $this->error;
}



function showFeteTable($tab, $msg)  {
	global $CTIMES_TYPE, $FETE_TAB, $START_DAY1, $START_DAY2;
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR><TD class=error height=20><?php echo($msg) ?></TD></TR>
<FORM action='admin.php' name="updatefete" method=post>
<INPUT type=hidden name='action' value='updatefete'>
<INPUT type=hidden name='mtype' value='<?php echo($CTIMES_TYPE); ?>'>
<TR>
	<TD height=80>
		<div class=item_tit><h2><?php echo(getAnnee() ." - " .(getAnnee()+1)); ?>学年节假日</h2></div>
	</TD>
</TR>
<TR>
	<TD valign=top>
		<TABLE cellSpacing=1 cellPadding=0 width=98% border=0 align=center>
		<TR>
			<TD class=ITEMS_LINE_TITLE width=5% height=30 ></TD>
			<TD class=ITEMS_LINE_TITLE width=30%> 节日 </TD>
			<TD class=ITEMS_LINE_TITLE width=30%> 月 </TD>
			<TD class=ITEMS_LINE_TITLE width=30%> 日 </TD>
		</TR>
<?php
	if ($tab)
		$lists = $tab;
	else 
		$lists = $FETE_TAB;
			
	for ($i = 0; $i < count($lists); $i++) { 
		$items = $lists[$i];
		$nb = count($items)-2;
		$dd = $items[1];
		for ($j = 2; $j < $nb; $j++) {
			$dd .= "," .$items[$j];
		}
?>
		<TR>
			<TD class=lcenter width=5% height=30 >
				<font color=black><?php echo(($i+1)); ?></font>
			</TD>
			<TD class=lableright1 width=30%>
				<b><?php echo($items[$nb]); ?></b>
			</TD>
			<TD class=lcenter width=30%>
				<select name="month_<?php echo($i); ?>"  class=h100_select>
				<?php 
					for ($m = 1; $m < 13; $m++) {
						if ($m == $items[0]) {
							echo ("<option value=". $m ." selected>" .$m. " 月</option>");
						} else {
							echo ("<option value=". $m .">" .$m. " 月</option>");
						}
					}
				?>
				</select> 
			</TD>
			<TD class=lcenter width=30%>
				<INPUT class=fields type=text size=20 name="day_<?php echo($i); ?>" value="<?php echo($dd); ?>">
			</TD>
		</TR>
<?php 
	}
?>
		<TR><TD colspan=4 height=30></TD></TR>
		<TR>
			<TD class=lableright1>
			</TD>
			<TD class=lableright1>
				<b>左表格第一天</b>
			</TD>
			<TD class=lcenter width=30%>
				<select name="start_month1"  class=h100_select>
				<?php 
					for ($m = 1; $m < 13; $m++) {
						if ($m == 9) {
							echo ("<option value=". $m ." selected>" .$m. " 月</option>");
						} else {
							echo ("<option value=". $m .">" .$m. " 月</option>");
						}
					}
				?>
				</select> 
			</TD>
			<TD class=lcenter width=30%>
				<INPUT class=fields type=text size=20 name="start_day1" value="<?php echo($START_DAY1); ?>">
			</TD>
		</TR>
		
		<TR>
			<TD class=lableright1>
			</TD>
			<TD class=lableright1>
				<b>右表格第一天</b>
			</TD>
			<TD class=lcenter width=30%>
				<select name="start_month2"  class=h100_select>
				<?php 
					for ($m = 1; $m < 13; $m++) {
						if ($m == 1) {
							echo ("<option value=". $m ." selected>" .$m. " 月</option>");
						} else {
							echo ("<option value=". $m .">" .$m. " 月</option>");
						}
					}
				?>
				</select> 
			</TD>
			<TD class=lcenter width=30%>
				<INPUT class=fields type=text size=20 name="start_day2" value="<?php echo($START_DAY2); ?>">
			</TD>
		</TR>
		<TR><TD colspan=4 height=30></TD></TR>
		</TABLE>
	</TD>
<TR>
<TR>
	<TD height=50 class=labelcenter>
		<INPUT class=button type=submit name="updatefete" value=' 修改学年节假日'>
	</TD>
</TR>
</TABLE>
<?php	
}


function showSchoolSchduleTable($msg)  { 
	global $CTIMES_TYPE;
?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR><TD class=error height=20><?php echo($msg) ?></TD></TR>
<FORM action='admin.php' name="updateschedule" method=post enctype="multipart/form-data">
<INPUT type=hidden name='action' value='updateschedule'>
<INPUT type=hidden name='mtype' value='<?php echo($CTIMES_TYPE); ?>'>
<TR>
	<TD height=80>
		<div class=item_tit><h2><?php echo(getAnnee() ." - " .(getAnnee()+1)); ?>学年课程</h2></div>
	</TD>
</TR>
<TR>
	<TD valign=top>
		<TABLE cellSpacing=1 cellPadding=0 width=98% border=0 align=center>
		<TR>
			<TD class=labelright1 width=20% height=40>
				课程 (PDF)
			</TD>
			<TD class=lcenter width=80%>
				<div align=left><INPUT type=file size=35 name="pdffile" id="pdffile"></div>
			</TD>
		</TR>
		<TR>
			<TD class=labelright1 height=40>
				课程 (JPG)
			</TD>
			<TD class=lcenter>
				<div align=left><INPUT type=file size=35 name="jpgfile" id="jpgfile"></div>
			</TD>
		</TR>
		</TABLE>
	</TD>
<TR>
<TR>
	<TD height=50 class=labelcenter>
		<INPUT class=button type=submit name="updatefete" value=' 修改学年课程 '>
	</TD>
</TR>
</TABLE>
<?php	
}


}
?>
