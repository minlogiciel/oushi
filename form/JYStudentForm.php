<?php
include_once("../public/student/student_include.php");

class JYStudentForm {

	
function WriteStudentWorks($id) {
	$works = new ArticleClass();
	if ($id > 0) {
		$works->getArticle($id);
	}
	$title  = replace_forbase(getPostValue("title"));  
	$competition  = getPostValue("competition");
	$autor  = getPostValue("autor");
	$classes  = getPostValue("classes");
	$reward  = getPostValue("reward");
	$dates  = getPostValue("dates");
	$texte  = replace_forbase(getPostValue("texte"));
	
	$works->setTitle($title); 
	$works->setCompetition($competition);
	$works->setStudent($autor);
	$works->setClasses($classes);
	$works->setReward($reward);
	$works->setDates($dates);
	$works->setContents($texte);
	
	return $works->addArticle();
}


function showStudentWorksForm($nindex, $msg) {
	global $STUDENT_TYPE;

	$title = "";
	$competition = "";
	$autor = "";
	$classe = "";
	$reward = "";
	$dates = "";
	$texts = "";
	if ($nindex > 0) {
		$works = new ArticleClass();
		if ($works->getArticle($nindex)) {
			$title = $works->getTitle();
			$competition = $works->getCompetition();
			$autor = $works->getStudent();
			$classe = $works->getClasses();
			$reward = $works->getReward();
			$dates = $works->getDates();
			$texts = $works->getContents();
		}
	}
?>

<FORM action='admin.php' method=post>
<INPUT type=hidden name='action' value='addstudentworks'>
<INPUT type=hidden name='mtype' value='<?php echo($STUDENT_TYPE); ?>'>
<INPUT type=hidden name='nindex' value='<?php echo($nindex); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD class=error><?php echo($msg) ?></TD></TR>
<TR>
	<TD height=50><h2>学生作品</h2></TD>
</TR>
<TR>
	<TD>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD >
				<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
				<TR>
					<TD width=15% class=labelright1 height=30>作品题目 : </TD>
					<TD width=85% class=labelleft>
						<INPUT class=fields type=text size=70 name="title" value="<?php echo($title); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 height=30>参加比赛 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=70 name="competition" value="<?php echo($competition); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 height=30>作品作者 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=70 name="autor" value="<?php echo($autor); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 height=30>作者班级 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=70 name="classes" value="<?php echo($classe); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 height=30>作品奖励 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=70 name="reward" value="<?php echo($reward); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 height=30>发布日期 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=20 name="dates" value="<?php echo($dates); ?>">
						<font color=red>&nbsp;&nbsp;&nbsp; 时间格式 : yyyy-mm-dd (2015-01-01)</font>
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 valign=top>作品内容 : </TD>
					<TD class=labelleft>
						<textarea class=fields name="texte" cols="65" rows="30"><?php echo($texts); ?></textarea>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD height=60 class=formlabel>
				<div align=center>
	<?php if ($nindex > 0) { ?>
				<INPUT class=button type=submit value=' 修改作品 '>
	<?php } else { ?>
				<INPUT class=button type=submit value=' 添加作品 '>
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