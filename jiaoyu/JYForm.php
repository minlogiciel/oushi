<?php

include_once ("../teacher/teacher_include.php");

function showTeachersDocuments($teachers, $tn, $jc, $ty, $wj, $an, $sort1, $sort2, $sort3, $ordre) {
	global $GRADE_TEXT_NAME, $FILE_TYPE_NAME,$GRADE_TYPE_NAME;

$SORT_TAB = array(
	"TEACHERID", 	"按教师排序",
	"TITLE", 		"按题目排序",
	"JIAOCAI",		"按教材排序",
);
	
	
	?>

<FORM action='education.php' method=post>	
<INPUT type=hidden name="resource" value="teacher"> 
<INPUT type=hidden name='action' value='searchjc'>
<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center >
<TR>
	<TD class=listtextcenter height=50>
		<select name="selectteacher" class=SEL_BOX >
			<option value='' selected>所有教师</option>
<?php 
		for ($i = 0; $i < count($teachers); $i++) {
			$t = $teachers[$i];
			$tid = $t->getID();
			$aname = $t->getName();
			if ($aname == $tn || $tid == $tn)
				echo ("<option value='".$tid."' selected>" .$aname. "</option>");
			else
				echo ("<option value='".$tid."'>" .$aname. "</option>");
		}
?>
		</select>&nbsp;&nbsp;
		<select name="selectgrade" class=SEL_BOX >
			<option value='' selected>所有教材</option>
<?php 
		for ($i = 1; $i < count($GRADE_TEXT_NAME); $i++) {
			$aname = $GRADE_TEXT_NAME[$i];
			if ($aname == $jc)
				echo ("<option value='".$aname."' selected>" .$aname. "</option>");
			else
				echo ("<option value='".$aname."'>" .$aname. "</option>");
		}
?>
		</select>&nbsp;&nbsp;
		<select name="selectfile" class=SEL_BOX >
			<option value='' selected>所有文件</option>
<?php 
		for ($i = 1; $i < count($FILE_TYPE_NAME); $i++) {
			$aname = $FILE_TYPE_NAME[$i];
			if ($aname == $wj)
				echo ("<option value='".$aname."' selected>" .$aname. "</option>");
			else
				echo ("<option value='".$aname."'>" .$aname. "</option>");
		}
?>
		</select>&nbsp;&nbsp;
		<select name="selecttype" class=SEL_BOX >
			<option value='' selected>所有类别</option> 
<?php 
		for ($i = 1; $i < count($GRADE_TYPE_NAME); $i++) {
			$aname = $GRADE_TYPE_NAME[$i];
			if ($aname == $ty)
				echo ("<option value='".$aname."' selected>" .$aname. "</option>");
			else
				echo ("<option value='".$aname."'>" .$aname. "</option>");
		}
?>
		</select>&nbsp;&nbsp;
		<select name="selectyear" class=SEL_BOX >
			<option value='' selected>所有年份</option>
<?php 
		$y =  date("Y");
		for ($i = $y; $i > 2013; $i--) {
			if ($i == $an)
				echo ("<option value='".$i."' selected>" .$i. "</option>");
			else
				echo ("<option value='".$i."'>" .$i. "</option>");
		}
?>
		</select>	
	</TD>
</TR>
<TR>
	<TD class=listtextcenter height=30>
		<select name="sort1" class=SEL_BOX >
			<option value='' selected>选择排序  1</option>
<?php 
		for ($i = 0; $i < count($SORT_TAB); $i+=2) {
			if ($sort1 == $SORT_TAB[$i])
				echo ("<option value='".$SORT_TAB[$i]."' selected>" .$SORT_TAB[$i+1]. "</option>");
			else
				echo ("<option value='".$SORT_TAB[$i]."'>" .$SORT_TAB[$i+1]. "</option>");
		}
?>
		</select>&nbsp;&nbsp;
		<select name="sort2" class=SEL_BOX >
			<option value='' selected>选择排序 2</option>
<?php 
		for ($i = 0; $i < count($SORT_TAB); $i+=2) {
			if ($sort2 == $SORT_TAB[$i])
				echo ("<option value='".$SORT_TAB[$i]."' selected>" .$SORT_TAB[$i+1]. "</option>");
			else
				echo ("<option value='".$SORT_TAB[$i]."'>" .$SORT_TAB[$i+1]. "</option>");
		}
?>
		</select>&nbsp;&nbsp;
		<select name="sort3" class=SEL_BOX >
			<option value='' selected>选择排序 3</option>
<?php 
		for ($i = 0; $i < count($SORT_TAB); $i+=2) {
			if ($sort3 == $SORT_TAB[$i])
				echo ("<option value='".$SORT_TAB[$i]."' selected>" .$SORT_TAB[$i+1]. "</option>");
			else
				echo ("<option value='".$SORT_TAB[$i]."'>" .$SORT_TAB[$i+1]. "</option>");
		}
?>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;
<?php if ($ordre) { ?>		
		<INPUT class=box type='checkbox' name="ordre" value='DESC' checked> 倒序排列
<?php } else { ?>
		<INPUT class=box type='checkbox' name="ordre" value='DESC'> 倒序排列
<?php } ?>
	</TD>
</TR>
<TR>
	<TD class=listtextcenter height=50>
		<INPUT class=button type=submit value=' 查询 ' id="search" >
	</TD>
</TR>
</TABLE>
</FORM>
<?php 
}


function showTeacherJiaoYuInformation() {
	
	$tn = getPostValue("selectteacher");
	$jc = getPostValue("selectgrade");
	$ty = getPostValue("selecttype");
	$wj = getPostValue("selectfile");
	$an = getPostValue("selectyear");
	$sort1 = getPostValue("sort1");
	$sort2 = getPostValue("sort2");
	$sort3 = getPostValue("sort3");
	$ordre = getPostValue("ordre");
	
	$npage = getPostValue("npage");

	$n_p = 20;
	if ($npage < 1)
		$npage = 1;
	$nnext = $npage+1;
	$nprev = $npage-1;	
	$n_start = $nprev*$n_p;
	
	$tlists = new TeacherListClass();
	$teachers = $tlists->getAllTeachers();
	$doclists = $tlists->getTeacherJiaoliuList($tn, $jc, $ty, $wj, $an, $sort1, $sort2, $sort3, $ordre, $n_start, $n_p);
	if (count($doclists) > 1) {
		$totaldoc = $doclists[0];
	}
	$nbpage = (int)($totaldoc/$n_p);
	if ($totaldoc%$n_p != 0)
		$nbpage++;
			
	$url = "../jiaoyu/education.php?resource=teacher";
	if ($tn) {
		$url .="&selectteacher=".$tn; 
	}
	if ($jc) {
		$url .="&selectgrade=".$jc; 
	}
	if ($ty) {
		$url .="&selecttype=".$ty; 
	}
	if ($wj) {
		$url .="&selectfile=".$wj; 
	}
	if ($an) {
		$url .="&selectyear=".$an; 
	}
	if ($sort1) {
		$url .="&sort1=".$sort1; 
	}
	if ($sort2) {
		$url .="&sort2=".$sort2; 
	}
	if ($sort3) {
		$url .="&sort3=".$sort3; 
	}
	if ($ordre) {
		$url .="&ordre=".$ordre; 
	}
	
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class=background>
			<?php 	showTeachersDocuments($teachers, $tn, $jc, $ty, $wj, $an, $sort1, $sort2, $sort3, $ordre); ?>
			</TD>
		</TR>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center class=registerborder>
				<TR>
					<TD class=jltitle height=25 width='3%'></TD>
					<TD class=jltitle width='7%'>教师 </TD>
					<TD class=jltitle width='20%'>交流题目</TD>
					<TD class=jltitle width='20%'>教材 </TD>
					<TD class=jltitle width='35%'>交流内容</TD>
					<TD class=jltitle width='10%'>交流文件</TD>
				</TR>
<?php
		$nb_doc = count($doclists);
		for ($i = 1; $i < $nb_doc; $i++) {
			$docs = $doclists[$i];
			$tid = $docs->getTeacherID();
			$teacher = $docs->getName();		
			$title = $docs->getTitle();		
			$jiaocai = $docs->getJiaocai();
			$jltype = $docs->getTypes();
			$jldate = $docs->getDates();
			$texte = $docs->getContent();
			$jlfile = $docs->getFiles();
			$path = $docs->getPaths();
			if (!$path)
				$path = getTeacherDiretory($tid);
			
			$icon = getFileTypeIcon($jlfile);
			$urlfile = "";
			if (trim($jlfile)) {
				$urlfile = $path."/".trim($jlfile);
			}
			$fid = "pdf_".$i;
?>
				<div class="pdfbox" id="<?php echo($fid); ?>">
				<?php if ($icon == "pdficon.png") { ?>
					<embed src='<?php echo($urlfile);?>' width='580' height='500'
			           	pluginspage='http://www.adobe.com/products/acrobat/readstep3.html' />
			    <?php } ?>
				</div>
				<TR>
					<TD class='jlnum'><?php echo($i); ?></TD>
					<TD class='jltextcenter'><?php echo($teacher); ?></TD>
					<TD class='jltextcenter'><?php echo($title); ?></TD>						
					<TD class='jltextcenter'><?php echo($jiaocai." (".$jltype.")"); ?></TD>
					<TD class='jltextcenter'><?php echo($texte); ?></TD>
					<TD class='jltextcenter'>
<?php
				if ($urlfile) {
					if ($icon == "pdficon.png")
						echo("<a href='".$urlfile."' onmouseover=showbox('".$fid."') onmouseout=hidebox('".$fid."') target=_blank><IMG src='../images/".$icon."' border=0 height=16 width=16></a>");
					else
						echo("<a href='".$urlfile."' target=_blank><IMG src='../images/".$icon."' border=0 width=16 height=16></a>");
				} 
?>
					</TD>
				</TR>
<?php
		}
		for ($i = $nb_doc; $i < 21; $i++) {
			echo("<TR><TD height=25 class=background></TD><TD class=background> </TD><TD class=background></TD><TD class=background> </TD><TD class=background></TD><TD class=background></TD></TR>");
			//echo("<TR><TD height=25 class=background colspan=6></TD></TR>");
		}
?>
				</TABLE>
			</TD>
		</TR>
		<TR><TD height=10></TD></TR>
		<TR>
			<TD height=20 class=NEWS_BAR>
<?php 
				echo("第 ".$npage. " 页 / 共 ".$nbpage. " 页&nbsp;( ".$totaldoc. " )&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
				if($nprev > 0)
					echo("<a class=NEWS_BAR href='".$url."&npage=".$nprev."'>上一页</a> ");
				else
					echo("<span>上一页</span> ");
				echo("&nbsp;&nbsp;");
				if ($nnext <= $nbpage)
					echo("<a class=NEWS_BAR href='".$url."&npage=".$nnext."'>下一页</a>");
				else 
					echo("<span>下一页</span>");
?>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
<?php 
}

function showSchoolScheduleTable() {
	$year = getSchoolYear();
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
	<TR>
		<TD class=tab_border>
			<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center>
			<TR>
				<TD class=PROG_TITLE height=30 width='4%'>&nbsp;</TD>
				<TD height=25 width=46% colspan=6 class=PROG_TITLE height=30>
						（ <?php echo($year); ?>/9- <?php echo(($year+1)); ?>/1  ）
				</TD>
				<TD class=PROG_TITLE height=30 width='4%'>&nbsp;</TD>
				<TD height=25 width=46% colspan=6 class=PROG_TITLE>
						（ <?php echo(($year+1)); ?>/2-<?php echo(($year+1)); ?>/6  ）
				</TD>
			</TR>
			<TR>
				<TD class=PROG_TITLE height=30 width='4%'>&nbsp;</TD>
				<TD class=PROG_TITLE width='15%' colspan=2>周三</TD>
				<TD class=PROG_TITLE width='15%' colspan=2>周六</TD>
				<TD class=PROG_TITLE width='15%' colspan=2>周日</TD>
				<TD class=PROG_TITLE height=25 width='4%'>&nbsp;</TD>
				<TD class=PROG_TITLE width='15%' colspan=2>周三</TD>
				<TD class=PROG_TITLE width='15%' colspan=2>周六</TD>
				<TD class=PROG_TITLE width='15%' colspan=2>周日</TD>
			</TR>
	<?php 
		$total_m = 20;
		for ($i = 1; $i <= $total_m; $i++) {
			$nn = $i%2;
			$classname = "PROG_LINE".$nn;
			$w3 = getScheduleDateString($i, 3, $year);
			$w6 = getScheduleDateString($i, 6, $year);
			$w7 = getScheduleDateString($i, 7, $year);
			
			$ii = $i+$total_m;
			if ($i == 1)
				$w32 = ""; // no mercredi
			else 
				$w32 = getScheduleDateString($ii, 3, $year);
			$w62 = getScheduleDateString($ii, 6, $year);
			$w72 = getScheduleDateString($ii, 7, $year);
?>
			<TR>
				<TD class='PROG_TITLE' height=30><?php echo($i); ?>	</TD>
				<TD class="<?php echo($classname); ?>"><?php echo( $w3); ?></TD>
				<TD class="<?php echo($classname); ?>"></TD>
				<TD class="<?php echo($classname); ?>"><?php echo($w6); ?></TD>
				<TD class="<?php echo($classname); ?>"></TD>
				<TD class="<?php echo($classname); ?>"><?php echo( $w7); ?></TD>
				<TD class="<?php echo($classname); ?>"></TD>

				<TD class='PROG_TITLE'><?php echo($ii); ?></TD>
				<TD class="<?php echo($classname); ?>"><?php echo( $w32); ?></TD>
				<TD class="<?php echo($classname); ?>"></TD>
				<TD class="<?php echo($classname); ?>"><?php echo( $w62); ?></TD>
				<TD class="<?php echo($classname); ?>"></TD>
				<TD class='<?php echo($classname); ?>'><?php echo( $w72); ?></TD>
				<TD class='<?php echo($classname); ?>' ></TD>
			</TR>
	<?php } 
			// last line only mercredi 
			$i = 21;
			$nn = $i%2;
			$classname = "PROG_LINE".$nn;
			$w3 = getScheduleDateString($i, 3, $year);
			$w6 = "";
			$w7 = "";
			
			$ii = $i+$total_m;
			$w32 = getScheduleDateString($ii, 3, $year);
			$w62 = getScheduleDateString($ii, 6, $year);
			$w72 = getScheduleDateString($ii, 7, $year);
		?>
			<TR>
				<TD class='PROG_TITLE' height=30><?php echo($i); ?>	</TD>
				<TD class="<?php echo($classname); ?>"><?php echo( $w3); ?></TD>
				<TD class="<?php echo($classname); ?>"></TD>
				<TD class="<?php echo($classname); ?>"><?php echo($w6); ?></TD>
				<TD class="<?php echo($classname); ?>"></TD>
				<TD class="<?php echo($classname); ?>"><?php echo( $w7); ?></TD>
				<TD class="<?php echo($classname); ?>"></TD>

				<TD class='PROG_TITLE'><?php echo($ii); ?></TD>
				<TD class="<?php echo($classname); ?>"><?php echo( $w32); ?></TD>
				<TD class="<?php echo($classname); ?>"></TD>
				<TD class="<?php echo($classname); ?>"><?php echo( $w62); ?></TD>
				<TD class="<?php echo($classname); ?>"></TD>
				<TD class='<?php echo($classname); ?>'><?php echo( $w72); ?></TD>
				<TD class='<?php echo($classname); ?>' ></TD>
			</TR>


			</TABLE>
		</TD>
	</TR>
</TABLE>

<?php
}

?>