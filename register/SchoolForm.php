<?php
include ("school_schedule.inc");

$C_NBCLASS = "班级数";
$C_CLASS = "班级";
$C_CLASSDAY = "上课日子";
$C_CLASSTIME = "上课时间";
$C_BAOMING ="报名信息";

$C_COURS_TITLE = "欧洲时报中文学校课程一览表";

$C_COURS_2013 = array(
array(3,	"新生班<br>（从拼音开始）",	
	array("周三和周六", "三13:30-15:00 / 六15:15-16:45", "周六", "六10:20-12:20", "周日", "日10:20-12:20"), 
	"2013年4月      开始报名"),
array(2,	"幼儿班", 
	array("周六", "14:00-15:00", "周六",  "15:15-16:15"),
	"2013年4月     开始报名"),
array(2,	"暑期班<br>（拼音补习/日常口语    作业辅导/少儿健身舞）", 
	array("一/三/五", "14:00-16:00"), 
	"2013年4月      开始报名"),
array(2,	"一册始", 
	array("周三和周六 ", "三13:30-15:00 / 六10:30-12:00", "周三和周日", "三10:30-12:00 / 日13:30-15:00"), 
	"2013年5月中旬开始招插班生"),
array(2,	"二册始", 
	array("周三和周六 ", "三10:30-12:00 / 六15:15-16:45", "周三和周日", "三13:30-15:00 / 日13:30-15:00"), 
	"2013年5月中旬开始招插班生"),
array(1,	"二册/11", 
	array("周六", "六10:30-12:00"), 
	"2013年5月中旬开始招插班生"),
array(2,	"三册", 
	array("周三和周六", "三15:15-16:45 / 六13:30-15:00", "周三和周日",  "三15:15-16:45 / 日10:30-12:00"), 
	"2013年5月中旬开始招插班生"),
array(1,	"四册", 
	array("周三和周日", "三15:15-16:45 / 日10:30-12:00"), 
	"2013年5月中旬开始招插班生"),
array(2,	"四册/6<br>四册/11", 
	array("周六 ", "六13:30-15:00", "周日", "日13:30-15:00"), 
	"2013年5月中旬开始招插班生"),
array(1,	"五册/11", 
	array("周六", "六13:30-15:00"), 
	"13年5月中旬开始招插班生"),
array(2,	"六册始", 
	array("周三和周六", "三15:15-16:45 / 六10:30-12:00", "周三和周日", "三13:30-15:00 / 日15:15-16:45"), 
	"13年5月中旬开始招插班生"),
array(2,	"六册/11", 
	array("周六", "六15:15-17:15",  "周日", "日13:15-15:15"), 
	"2013年5月中旬开始招插班生"),
array(1,	"七册始", 
	array("周三和周六 ", "三13:30-15:00 / 六13:30-15:00"), 
	"2013年5月中旬开始招插班生"),
array(1,	"八册始", 
	array("周日", "日10:20-12:20"),
	"2013年5月中旬开始招插班生"),
array(2,	"九册/6<br>九册/11", 
	array("周六 ",  "六15:15-17:15",  "周日", "日15:15-17:15"), 
	"2013年5月中旬开始招插班生"),
array(1,	"十册/11", 
	array("周日 ",  "日15:15-17:15"), 
	"2013年5月中旬开始招插班生"),
array(1,	"中九册/3", 
	array("周六 ",  "六15:15-17:15"), 
	"13年5月中旬开始招插班生"),
array(3,	"舞蹈班", 
	array("周三 ",  "三13:30-15:00", "周六 ",  "六15:15-16:45",  "周日 ", "日15:15-16:15"),  
	"2013年4月开始报名"),
array(2,	"武术班", 
	array("周三 ",  "三13:30-15:00 ",  "周三 ",   "三15:15-16:45 "),
	"13年4月开始报名"),
array("单独课",	"钢琴班",	
	array("周三、周六、周日", "上午10:30-13:00   下午14:00-18:00 （每节课45分钟）"),  
	"常年接受报名"),
);



function listNewSchoolScheduleTable() {
	global $C_NBCLASS, $C_CLASS, $C_CLASSDAY, $C_CLASSTIME, $C_BAOMING, $C_COURS_TITLE, $C_COURS_2013;
	
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
	<TR>
		<TD class=tab_border>
			<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center>
			<TR>
				<TD height=30 width=100% colspan=6 class=tab_title1>
					<?php echo($C_COURS_TITLE); ?> 
				</TD>
			</TR>
			<TR>
				<TD class=tab_title2 height=30 width='3%'></TD>
				<TD class=tab_title2 width='8%'><?php echo($C_NBCLASS); ?></TD>
				<TD class=tab_title2 width='17%'><?php echo($C_CLASS); ?></TD>
				<TD class=tab_title2 width='15%'><?php echo($C_CLASSDAY); ?></TD>
				<TD class=tab_title2 width='30%'><?php echo($C_CLASSTIME); ?></TD>
				<TD class=tab_title2 width='25%'><?php echo($C_BAOMING); ?></TD>
			</TR>
	<?php 
		for ($i = 0; $i < count($C_COURS_2013); $i++) {
			$item 	= $C_COURS_2013[$i];
			$sc 	= $item[2];
			$rn = (int) count($sc)/2;
	?>
			<TR>
				<TD class='tab_title2' rowspan=<?php echo($rn); ?> >
					<div align=center>
						<?php echo($i+1); ?>
					</div>
				</TD>
				<TD class='listtext' rowspan=<?php echo($rn); ?>>
					<div align=center>
					<?php echo( $item[0]); ?>
					</div>
				</TD>
				<TD class='listtext' rowspan=<?php echo($rn); ?>>
					<div align=center>
					<?php echo( $item[1]); ?>
					</div>
				</TD>
				<TD class='listtext' height=25>
					<div align=left>&nbsp;&nbsp;<?php echo($sc[0]); ?> </div>
				</TD>
				<TD class='listtext'>
					<div align=left>&nbsp;&nbsp;<?php echo($sc[1]); ?> </div>
				</TD>
				<TD class='listtext' rowspan=<?php echo($rn); ?>>
					<div align=left>&nbsp;&nbsp;<?php echo($item[3]); ?> </div>
				</TD>
			</TR>
			<?php for ($r = 1; $r < $rn; $r++)   { ?>
			<TR>
				<TD class='listtext'>
					<div align=left>&nbsp;&nbsp;<?php echo($sc[$r * 2]); ?> </div>
				</TD>
				<TD class='listtext'>
					<div align=left>&nbsp;&nbsp;<?php echo($sc[$r *2 + 1]); ?> </div>
				</TD>
			</TR>
			<?php  } ?>
	<?php } ?>
			</TABLE>
		</TD>
	</TR>
</TABLE>

<?php
}

function getMonthDays($i, $m) {
	if ($m == 9) {
		$sum = 31;
		if ($i > 0) {
			$sum += 31; //10
		}
		if ($i > 1) {
			$sum += 30; //11
		}
		if ($i > 2) {
			$sum += 31; //12
		}
		if ($i > 3) {
			$sum += 30; //1
		}		
	}
	else {
		$sum = 32;
		if ($i > 0) {
			$sum += 28; //2
			/* m = 2 d == 29 */
			$sum++;
		}
		if ($i > 1) {
			$sum += 31; //3
		}
		if ($i > 2) {
			$sum += 30; //4
		}
		if ($i > 3) {
			$sum += 31; //5
		}		
		if ($i > 4) {
			$sum += 30; //6
		}		
	}
	return $sum;
}

function getDisplayScheduleDate($d, $m, $y) {
	global 	$FIRST_WAR, $EXAMEN_YCT, $EXAMEN_HSK, $TOUSSAINT, $NOEL, $NOUVEL_AN, $FETE_PRINTEMPS, $BAQUES,$CONCOURS,
	$FETE_TRAVAIL, $FETE_MAI8, $ATTENTE, $PENTECOTE, $DLY, $FETE_TAB, $NOTE_TAB;
	$dstr = "";
	if ($d <= 31) {
		if ($d < 10)
			$dstr .= "0";
		$dstr .= $d."/";
		if ($m < 10)
			$dstr .= "0";		
		$dstr .= $m."/".$y;
	}
	for ($i = 0; $i < count($FETE_TAB); $i++) {
		if ($m == $FETE_TAB[$i][0]) {
			$nb = count($FETE_TAB[$i])-2;
			for ($j = 1; $j < $nb; $j++) {
				if ($d == $FETE_TAB[$i][$j]) {
					return ("<span class=nonclass>".$dstr."</span><br><span class=nondate>".$FETE_TAB[$i][$nb]."</span>");
				}
			}
		}
	}
	
	for ($i = 0; $i < count($NOTE_TAB); $i++) {
		if ($m == $NOTE_TAB[$i][0]) {
			$nb = count($NOTE_TAB[$i])-2;
			for ($j = 1; $j < $nb; $j++) {
				if ($d == $NOTE_TAB[$i][$j]) {
					return ("<span class=noteclass>".$dstr."</span><br><span class=noteclass>".$NOTE_TAB[$i][$nb]."</span>");
				}
			}
		}
	}
	
	return $dstr;
}


function getSchoolScheduleDate($i, $w, $s) {
	global $START_DAY1, $START_DAY2;	
	$start1 = $START_DAY1-13;
	$start2 = $START_DAY2-13;
	$year1 = 2015;
	$year2 = 2016;
	if ($s == 1) {
		$d = $i * 7 + $w + $start1;
		$m = 9;
		$y = $year1;
	}
	else {
		$d = $i * 7 + $w + $start2; 
		$m = 1;
		$y = $year2;
	}
	$dd1 = getMonthDays(0, $m);
	$dd2 = getMonthDays(1, $m);
	$dd3 = getMonthDays(2, $m);
	$dd4 = getMonthDays(3, $m);
	$dd5 = getMonthDays(4, $m);
	$dd6 = getMonthDays(5, $m);
	if ($d < $dd1) {
		
	}
	else if ($d < $dd2) {
		$m += 1;
		$d -= $dd1 - 1;
	}
	else if ($d < $dd3) {
		$m += 2;
		$d -= $dd2 - 1;
	}
	else if ($d < $dd4) {
		$m += 3;
		$d -= $dd3 - 1;
	}
	else if ($d < $dd5) {
		$m += 4;
		if ($m > 12) {
			$m = 1;
			$y++;
		}
		$d -= $dd4 - 1;
	}
	else if ($d < $dd6) {
		$m += 5;
		if ($m > 12) {
			$m = 1;
			$y++;
		}
		$d -= $dd5 - 1;
	}
	
	return getDisplayScheduleDate($d, $m, $y);
}

function getScheduleDateString($i, $w, $y) {
	global $START_M, $END_M, $START_DAY, $END_DAY, $START_WEEK, $M2_DAY;
	
	$diff = $START_DAY - $START_WEEK - 7;
	$d = $i*7 + $w + $diff;
	$m = 9;

	if ($d > 30) {
		$d -= 30;
		$m = 10;		// 10
	}
	if ($d > 31) {
		$d -= 31;
		$m = 11;		// 11
	}
	if ($d > 30 && $m == 11) {
		$d -= 30;
		$m = 12;		// 12
	}
	if ($d > 31) {
		$d -= 31;
		$m = 1;		// 1
	}
	if ($d > 31) {
		$d -= 31;
		$m = 2;		// 2
	}
	if ($d > $M2_DAY && $m == 2) {
		$d -= $M2_DAY;
		$m = 3;		// 3
	}
	if ($d > 31) {
		$d -= 31;
		$m = 4;		// 4
	}
	if ($d > 30 && $m == 4) {
		$d -= 30;
		$m = 5;		// 5
	}
	if ($d > 31) {
		$d -= 31;
		$m = 6;		// 6
	}
	if (($m == $START_M && $d < $START_DAY) || ($m == $END_M && $d > $END_DAY)) {
		return "";
	}
	else {
		return getDisplayScheduleDate($d, $m, $y);
	}
}

function listSchoolScheduleTable() {
	$year = getSchoolYear();
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
	<TR>
		<TD class=tab_border>
			<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center>
			<TR>
				<TD height=25 width=50% colspan=7 class=tab_title1 height=30>
						（ <?php echo($year); ?>/9- <?php echo(($year+1)); ?>/1  ）
				</TD>
				<TD height=25 width=50% colspan=7 class=tab_title1>
						（ <?php echo(($year+1)); ?>/2-<?php echo(($year+1)); ?>/6  ）
				</TD>
			</TR>
			<TR>
				<TD class=tab_title2 height=30 width='4%'>&nbsp;</TD>
				<TD class=tab_title2 width='15%' colspan=2>周六</TD>
				<TD class=tab_title2 width='15%' colspan=2>周日</TD>
				<TD class=tab_title2 width='15%' colspan=2>周三</TD>
				<TD class=tab_title2 height=25 width='4%'>&nbsp;</TD>
				<TD class=tab_title2 width='15%' colspan=2>周三</TD>
				<TD class=tab_title2 width='15%' colspan=2>周六</TD>
				<TD class=tab_title2 width='15%' colspan=2>周日</TD>
			</TR>
	<?php 
		for ($i = 1; $i <= 20; $i++) {
			$w6 = getSchoolScheduleDate($i, 6, 1)
	?>
			<TR>
				<TD class='tab_title2' height=25>
					<div align=center>
						<?php if ($w6) echo($i); else echo(""); ?>
					</div>
				</TD>
				<TD class='listtext' >
					<div align=center> <?php echo($w6); ?></div>
				</TD>
				<TD class='listtext' >
					
				</TD>
				<TD class='listtext'>
					<div align=center><?php echo( getSchoolScheduleDate($i, 7, 1)); ?>	</div>
				</TD>
				<TD class='listtext' >
					
				</TD>
				<TD class='listtext'>
					<div align=center><?php echo( getSchoolScheduleDate($i, 3+7, 1)); ?>	</div>
				</TD>
				<TD class='listtext' >
					
				</TD>

				<TD class='tab_title2'>
					<div align=center>
						<?php echo($i+20); ?>
					</div>
				</TD>
				<TD class='listtext' >
					<div align=center> <?php echo( getSchoolScheduleDate($i, 10, 2)); ?>10</div>
				</TD>
				<TD class='listtext' >
					
				</TD>
				<TD class='listtext'>
					<div align=center><?php echo( getSchoolScheduleDate($i, 7, 2)); ?>	</div>
				</TD>
				<TD class='listtext' >
					
				</TD>
				<TD class='listtext'>
					<div align=center><?php echo( getSchoolScheduleDate($i, 10, 2)); ?>	</div>
				</TD>
				<TD class='listtext' >
					
				</TD>

			</TR>
	<?php } ?>
			</TABLE>
		</TD>
	</TR>
</TABLE>

<?php
}

?>