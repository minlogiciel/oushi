<?php
class ScheduleForm {

	
function getTeacherList() {
	global $TEACHER_TABLE;
	$lists = array();
	$ntotal = getPostValue("ntotal");
	for ($i = 1; $i <= $ntotal; $i++) {
		//$elem = $TEACHER_TABLE[$i-1];
		$name = getPostValue("name_".$i);
		if (trim($name)) {
			$elem = array();
			$elem[0] = getPostValue("name_".$i);
			$elem[1] = getPostValue("phone_".$i);
			$elem[2] = getPostValue("mobile_".$i);
			$elem[3] = getPostValue("email_".$i);
			$elem[4] = getPostValue("ids_".$i);
			$lists[] = $elem;
		}
	}
	return $lists;
}
function updateTeacherList() {
	$tab = $this->getTeacherList();
	$text  = "<?php\n";
	$text .= "\$TEACHER_TABLE = array(\n";
	$rn = count($tab)-1; 
	for ($i = 0; $i <= $rn; $i++) {
		$elem = $tab[$i];
		$text .= "\tarray(";
		$cn = count($elem);
		for ($j = 0; $j < $cn; $j++) {
			$text .= "\"" .$elem[$j]. "\", ";
		}
		if ($i == $rn) {
			$text .= ") \n";
		}
		else {
			$text .= "), \n";
		}
	}
	$text .=");\n\n?>\n\n";
	
	$fp = fopen("../teacher/teacher_list.inc", "w");
	fwrite($fp, $text);
	fclose($fp);
	return $tab;
}


function listTeacherTable($newsitem, $msg) {
	global $TEACHER_TABLE, $TEACHER_TYPE;
	$tab = $TEACHER_TABLE;
	$nb = count($TEACHER_TABLE);
	$id = 0;
	if ($newsitem) {
		$tab = $newsitem;
	}
	else {
		$id = $tab[$nb-1][4];
		$tab[] = array("","","","", $id+1);
		$tab[] = array("","","","", $id+2);
	}
	$n_total = count($tab);
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=error height=40><?php echo($msg) ?></TD>
</TR>
<TR>
	<TD class=background>
		<FORM action='admin.php' method=post>
		<INPUT type=hidden name='action' value='modifyteacher'>
		<INPUT type=hidden name='mtype' value='<?php echo($TEACHER_TYPE); ?>'>
		<INPUT type=hidden name='ntotal' value='<?php echo($n_total); ?>'>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD height=50>
				<h2>欧洲时报文化中心中文学校教师通讯录</h2>
				<br>
				<?php if (!$newsitem) { ?>
				<font color=red><b>(可以删除教师名字，不可调换教师名字)</b></font>
				<br><br>
				<?php } ?>
			</TD>
		</TR>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center class=registerborder>
				<TR>
					<TD class=ITEMS_LINE_TITLE height=30 width='5%'></TD>
					<TD class=ITEMS_LINE_TITLE width='15%'>教师</TD>
					<TD class=ITEMS_LINE_TITLE width='20%'>电话</TD>
					<TD class=ITEMS_LINE_TITLE width='20%'>手机</TD>
					<TD class=ITEMS_LINE_TITLE width='40%'>EMAIL</TD>
				</TR>
<?php
			$n = 0;
			for ($i = 1; $i <= $n_total; $i++) {
				$lists = $tab[$i-1];
				$name 	= $lists[0];
				$phone 	= $lists[1];
				$mobile = $lists[2];
				$email = $lists[3];
				$nid = $lists[4];
				if (!trim($name) && $nid < $id) {
					continue;
				}
				$n++;
				if ($newsitem) {
?>
				<TR>
					<TD class='ITEMS_LINE_TITLE' height=25>
					<?php echo($nid); ?>
					</TD>
					<TD class='listtextcenter'>
						<?php echo($name); ?>
					</TD>						
					<TD class='listtextcenter'>
						<?php echo($phone); ?>
					</TD>
					<TD class='listtextcenter'>	
						<?php echo($mobile); ?>
					</TD>
					<TD class='listtextcenter'>
						<a href="mailto:<?php echo($email); ?>"><?php echo($email); ?></a>
					</TD>
				</TR>
<?php   		} else { ?>
				<TR>
					<TD class='ITEMS_LINE_TITLE' height=25>
						<?php echo($nid); ?>
						<INPUT type=hidden name="ids_<?php echo($i); ?>" value="<?php echo($nid); ?>">
					</TD>
					<TD class='listtextcenter'>
						<INPUT class=fields type=text size=10 name="name_<?php echo($i); ?>" value="<?php echo($name); ?>">
					</TD>						
					<TD class='listtextcenter'>
						<INPUT class=fields type=text size=15 name="phone_<?php echo($i); ?>" value="<?php echo($phone); ?>">
					</TD>
					<TD class='listtextcenter'>
						<INPUT class=fields type=text size=15 name="mobile_<?php echo($i); ?>" value="<?php echo($mobile); ?>">
					</TD>
					<TD class='listtextcenter'>
						<INPUT class=fields type=text size=33 name="email_<?php echo($i); ?>" value="<?php echo($email); ?>">
					</TD>
				</TR>
<?php 		} }  ?>

				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD height=50 class=listtextcenter>
				<INPUT class=button1 type=submit value=' 修改 ' id="savebuttonid">
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
<?php 
}

function getTeacherCoursList() {
	global $TEACHER_COURS;
	$lists = array();
	for ($i = 0; $i < count($TEACHER_COURS); $i++) {
		$elem = $TEACHER_COURS[$i];
		for ($j = 1; $j < count($elem); $j++) {
			$elem[$j][0] = getPostValue("class_".$i."_".$j);
			$elem[$j][1] = getPostValue("cours_".$i."_".$j."_1");
			$elem[$j][2] = getPostValue("cours_".$i."_".$j."_2");
			$elem[$j][3] = getPostValue("cours_".$i."_".$j."_3");
			$elem[$j][4] = getPostValue("cours_".$i."_".$j."_4");
		}
		$lists[] =  $elem;
	}
	return $lists;
}
function updateTeacherCours() {
	global $TEACHER_COURS;
	$tab = $this->getTeacherCoursList();
	$text  = "<?php\n";
	$text .= "\$TEACHER_COURS = array(\n";
	$rn = count($tab); 
	for ($i = 0; $i < $rn; $i++) {
		$elem = $tab[$i];
		$text .= "array(\"".$elem[0]. "\",\n";
		$cn = count($elem);
		for ($j = 1; $j < $cn; $j++) {
			$text .= "\tarray(";
			$text .= "\"" .$elem[$j][0]. "\", ";
			$text .= "\"" .$elem[$j][1]. "\", ";
			$text .= "\"" .$elem[$j][2]. "\", ";
			$text .= "\"" .$elem[$j][3]. "\", ";
			$text .= "\"" .$elem[$j][4]. "\"),\n";
		}
		if ($i == ($rn-1)) {
			$text .= ") \n";
		}
		else {
			$text .= "), \n";
		}
	}
	$text .=");\n\n?>\n\n";
	
	$fp = fopen("../teacher/teacher_cours.inc", "w");
	fwrite($fp, $text);
	fclose($fp);
	return $tab;
}

function listTeacherCoursTable($newsitem, $msg) {
	global $TEACHER_COURS, $TEACHER_TYPE, $T_SCHEDULE_TYPE;
	$tab = $TEACHER_COURS;
	if ($newsitem) {
		$tab = $newsitem;
	}
	
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=error height=40><?php echo($msg) ?></TD>
</TR>
<TR>
	<TD class=background>
		<FORM action='admin.php' method=post>
		<INPUT type=hidden name='action' value='modifycours'>
		<INPUT type=hidden name='mtype' value='<?php echo($TEACHER_TYPE); ?>'>
		<INPUT type=hidden name='nindex' value='<?php echo($T_SCHEDULE_TYPE); ?>'>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD height=50>
				<h2>法国欧洲时报中文学校课表</h2> 
			</TD>
		</TR>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center class=registerborder>
<?php 
	for ($i = 0; $i < count($tab); $i++) {
		$elem = $tab[$i];
?>
				<TR>
					<TD class=ITEMS_LINE_TITLE height=25 width='10%'>教室</TD>
					<TD class=ITEMS_LINE_TITLE width='90%' colspan=4><?php echo($elem[0]); ?></TD>
				</TR>
<?php
			for ($j = 1; $j < count($elem); $j++) {
				$items = $elem[$j];
				if ($newsitem) {
?>
				<TR>
					<TD class='listtextcenter' height=30 width=10%><?php echo($items[0]); ?></TD>
					<TD class='listtextcenter' width=22%><?php echo($items[1]); ?></TD>						
					<TD class='listtextcenter' width=22%><?php echo($items[2]); ?></TD>
					<TD class='listtextcenter' width=22%>	<?php echo($items[3]); ?></TD>
					<TD class='listtextcenter' width=22%><?php echo($items[4]); ?></TD>
				</TR>
<?php   		} else { ?> 
				<TR>
					<TD class='listtextcenter' height=30 width=10%>
						<INPUT class=fields type=text size=5 name="class_<?php echo($i); ?>_<?php echo($j); ?>" value="<?php echo($items[0]); ?>">			
					</TD>
					<TD class='listtextcenter' width=20%>
						<INPUT class=fields type=text size=20 name="cours_<?php echo($i); ?>_<?php echo($j); ?>_1" value="<?php echo($items[1]); ?>">			
					</TD>						
					<TD class='listtextcenter' width=20%>
						<INPUT class=fields type=text size=20 name="cours_<?php echo($i); ?>_<?php echo($j); ?>_2" value="<?php echo($items[2]); ?>">
					</TD>
					<TD class='listtextcenter' width=20%>
						<INPUT class=fields type=text size=20 name="cours_<?php echo($i); ?>_<?php echo($j); ?>_3" value="<?php echo($items[3]); ?>">
					</TD>
					<TD class='listtextcenter' width=20%>
						<INPUT class=fields type=text size=20 name="cours_<?php echo($i); ?>_<?php echo($j); ?>_4" value="<?php echo($items[4]); ?>">
					</TD>
				</TR>
<?php 			}  
			}
		}
?>
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD height=50 class=listtextcenter>
				<INPUT class=button1 type=submit value=' 修改 ' id="savebuttonid">
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
<?php 
}

function updateActiveMember() {
	$nb = getPostValue("nbmember");
	$blists = new BaseList();
	for ($i = 0; $i < $nb; $i++) {
		$active = getPostValue("active_".$i);
		$id =  getPostValue("memberid_".$i);
		$blists->updateActiveRegisteLists($id, $active);
	} 
}

function getRegisterTypeName($registerref) {
	global $REGISTER_TAB;
	for ($i = 0; $i < count($REGISTER_TAB); $i++) {
		$item = $REGISTER_TAB[$i];
		for ($j = 3; $j < count($item); $j++) {
			$sitem =  $item[$j];
			$title = $sitem[0];
			if ($sitem[1] == $registerref) {
				return $sitem[0];
			}
		}
	}
	return "";
}
function showRegisterMemberTable($registerref, $err) {
	global $HDBM_TYPE;
	
	$title = $this->getRegisterTypeName($registerref);
	
	$blists = new BaseList();
	
	$lists = $blists->getRegisterLists($registerref);
	$nbm = count($lists);
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
	<TR>
		<TD class=background>
			<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
			<TR>
				<TD height=50>
				<h2><?php echo($title); ?>注册成员</h2> 
				</TD>
			</TR>
			<TR><TD class=error height=30><?php echo($err); ?></TD></TR>
			<TR>
				<TD class=background>
				<FORM action='admin.php' name="valideform" method=post>
				<INPUT type=hidden name='action' value='validemember'>
				<INPUT type=hidden name='mtype' value='<?php echo($HDBM_TYPE); ?>'>
				<INPUT type=hidden name='registerref' value='<?php echo($registerref); ?>'>
				<INPUT type=hidden name='nbmember' value='<?php echo($nbm); ?>'>
				<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center class=registerborder>
					<TR>
						<TD class=ITEMS_LINE_TITLE height=25 width='5%'></TD>
						<TD class=ITEMS_LINE_TITLE width='15%'>姓名</TD>
						<TD class=ITEMS_LINE_TITLE width='15%'>报名班级 </TD>
						<TD class=ITEMS_LINE_TITLE width='15%'>上课时间</TD>
						<TD class=ITEMS_LINE_TITLE width='25%'>注册时间</TD>
						<TD class=ITEMS_LINE_TITLE width='15%'>联系电话</TD>
						<TD class=ITEMS_LINE_TITLE width='10%'>有效</TD>
					</TR>
<?php
				for ($i = 0; $i < count($lists); $i++)
				{
					$huodong = $lists[$i];
					$n = $i + 1;
					$name 	= $huodong->getChinaName(). "<br>" .$huodong->getEnglishName();
					$classes = $huodong->getClasses();
					$phone = $huodong->getPhone(). "<br>" .$huodong->getMobile();
					$times = $huodong->getTimes();
					$addr = $huodong->getRegisterDate();
					//$addr = $huodong->getStreet(). ", " .$huodong->getPostCode(). " " .$huodong->getCity(). ", " .$huodong->getCountry();
					$active = $huodong->isValided();
					$deleted = $huodong->isDeleted();
					$id = $huodong->getID();
?>
					<TR>
						<TD class='listtextcenter' height=60><?php echo($n); ?></TD>
						<TD class='listtextcenter' >
							<a href="../admin/?action=modifymember&mtype=<?php echo($HDBM_TYPE); ?>&memberid=<?php echo($id); ?>"><?php echo($name); ?></a>
						</TD>						
						<TD class='listtextcenter'><?php echo($classes); ?></TD>
						<TD class='listtextcenter'>	<?php echo($times); ?></TD>
						<TD class='listtextcenter'><?php echo($addr); ?></TD>
						<TD class='listtextcenter'><?php echo($phone); ?></TD>
						<TD class='listtextcenter'>
							<INPUT type='hidden' name='memberid_<?php echo($i); ?>' value='<?php echo($id); ?>'>
							
							<select name="active_<?php echo($i); ?>" STYLE="width:60; color:blue">
								<option value='0' selected> -- </option>
								<?php if ($active) { ?>
								<option value="1" selected>有效</option>
								<?php } else { ?>
								<option value="1">有效</option>
								<?php } ?>
								
								<?php if ($deleted) { ?>
								<option value="2" selected>取消</option>
								<?php } else { ?>
								<option value="2">取消</option>
								<?php } ?>
							</select> 
						</TD>
					</TR>
<?php   	}  ?>
					<TR>
						<TD height=30 class=listtextcenter colspan=6></TD>
						<TD height=30 class=listtextcenter>
								<INPUT class=button1 type=submit value='确认' id="savebuttonid">
						</TD>
					</TR>
					</TABLE>
					</FORM>
				</TD>
			</TR>
			<TR>
				<TD height=15></TD>
			</TR>
			</TABLE>
		</TD>
	</TR>
</TABLE>
<?php 
}

function showTeacherJiaoliuTable($tindex, $nindex, $addtitle) {
	global $TEACHER_TYPE;
	
	$tclass = new TeacherClass();
	$mtable = $tclass->getAllJiaoliu($tindex, 1);
	$title = "";
	if ($addtitle) {
		$user = new AdminUserClass();
		if ($user->findUser($tindex)) {
			$title = "欧洲时报文化中心教师交流  (".  $user->getName().")";
		}
	}
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<?php if ($addtitle) { echo("<TR><TD height=50><h2>".$title."</h2></TD></TR>"); } ?>
	<TR>
		<TD class=background>
			<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
			<TR>
				<TD class=background>
					<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center class=registerborder>
					<TR>
						<TD class=ITEMS_LINE_TITLE height=25 width='3%'></TD>
						<TD class=ITEMS_LINE_TITLE width='20%'>交流题目</TD>
						<TD class=ITEMS_LINE_TITLE width='25%'>教材 </TD>
						<TD class=ITEMS_LINE_TITLE width='12%'>交流日期 </TD>
						<TD class=ITEMS_LINE_TITLE width='30%'>交流内容</TD>
						<TD class=ITEMS_LINE_TITLE width='10%'>交流文件</TD>
					</TR>
<?php
				for ($i = 0; $i < count($mtable); $i++) {
					$s_table = $mtable[$i];
					$ids = $s_table->getID();		
					$title = $s_table->getTitle();		
					$jiaocai = $s_table->getJiaocai();
					$jltype = $s_table->getTypes();
					$jldate = $s_table->getDates();
					$texte = $s_table->getContent();
					$jlfile = $s_table->getFiles();
					$path = $s_table->getPaths();
?>
					<TR>
						<TD class='listtextcenter' height=30>
							<?php echo(($i+1)); ?>
						</TD>
						<TD class='listtextcenter' >
							<?php echo("<a href='../admin/?mtype=$TEACHER_TYPE&nindex=$nindex&mindex=$i&teacher=$tindex&mindex=$ids'>$title</a>"); ?>
						</TD>						
						<TD class='listtextcenter'>
							<?php echo($jiaocai. " (" .$jltype. ")"); ?>
						</TD>
						<TD class='listtextcenter'>
							<?php echo($jldate); ?>
						</TD>
						<TD class='listtextcenter'>	
							<?php echo($texte); ?>
						</TD>
						<TD class='listtextcenter'>
						<?php 
							if (trim($jlfile)) {
								$icon = getFileTypeIcon($jlfile);
								echo("<a href='".$path."/".$jlfile."' target=_blank><IMG src='../images/".$icon."' border=0 width=16></a>"); 
							}
						?>
						</TD>
					</TR>
<?php   	}  ?>
					</TABLE>
				</TD>
			</TR>
			</TABLE>
		</TD>
	</TR>
</TABLE>
<?php 
}


function getUploadJiaoliuFile($filename, $teacherid="") 
{
	$fname = trim($filename);
	$pos = strrpos($fname, '.');
	if($pos < 1) {
		$fname = date("YmdHis");
		if ($teacherid) {
			$fname .= "_".$teacherid;
		}
		$fname .= substr($filename, $pos);
    }
    return $fname;
}

function RemoveJiaoliuInfo() {

	$jiaoliu = new TeacherClass();

	$mindex = getPostValue("mindex");
	if ($jiaoliu->getTeacherJiaoliu($mindex)) {
		$jiaoliu->deleteJiaoliu(1);
	}
	return -1;
}

function WriteJiaoliuInfo() {

	$isdeleted = getPostValue("isdeleted");
	if ($isdeleted) {
		return $this->RemoveJiaoliuInfo();
	}
	else {
		$jiaoliu = new TeacherClass();
		if(empty($_REQUEST['addnew']))  
			$mindex = getPostValue("mindex");
		else 
			$mindex = -1;
		$nindex = getPostValue("nindex");
		$teacherid = getPostValue("teacher");
		$teachername = getPostValue("teachername");
		$titles = getPostValue("jltitle");
		$jiaocai = getPostValue("jiaocai");
		if ($jiaocai == "其它")
			$jiaocai = getPostValue("fjiaocai");
		$gtype = getPostValue("gradetype");
		if ($gtype == "其它") 
			$gtype = getPostValue("fgradetype");
	
		$ljdate = getPostValue("jldate");
		$texte = getPostValue("jltext");
		$path = getPostValue("jlpath");
	
		$uploadfile = "";
		if(isset($_FILES['upload_file']))
		{ 
	 	  	$uploadfile = basename($_FILES['upload_file']['name']);
	     	$inputFileName = $_FILES['upload_file']['tmp_name'];
			if ($inputFileName) {
				$uploadfile = $this->getUploadJiaoliuFile($uploadfile, $teacherid);
				uploadFile($inputFileName, $uploadfile, $path);
	 		}
		}
		if (!$uploadfile) {
			$uploadfile = getPostValue("jlfile");
			$inputFileName = "";
		}

		$filetype = getFileType($uploadfile);
		
		if ($mindex < 0 || !$jiaoliu->getTeacherJiaoliu($mindex))
			$jiaoliu->setID($mindex);
		$jiaoliu->setName($teachername);
		$jiaoliu->setTeacherID($teacherid);
		$jiaoliu->setTitle($titles);
		$jiaoliu->setJiaocai($jiaocai);
		$jiaoliu->setTypes($gtype);
		$jiaoliu->setDates($ljdate);
		$jiaoliu->setContent($texte);
		$jiaoliu->setPaths($path);
		$jiaoliu->setFiles($uploadfile);
		$jiaoliu->setFType($filetype);
		$jiaoliu->addTeacherJiaoliu();
		return $jiaoliu->getID();
	}
}

function showTeacherJiaoliuForm($tindex, $nindex, $mindex, $msg) {
	global $TEACHER_TYPE, $GRADE_TEXT_NAME, $GRADE_TYPE_NAME, $FILE_TYPE_NAME;
	$action = "addjiaoliu";
	$title = "";		
	$jlfile = "";
	$jldate = "";
	$texte = "";
	$jiaocai = $GRADE_TEXT_NAME[0];		
	$gtype = $GRADE_TYPE_NAME[0];		
	$ftype = "";
	$jlpath = "";	
	$user = new AdminUserClass();
	if ($user->findUser($tindex)) {
		$tname = $user->getName();
	}
	else {
		$tname = "";
	}
	if ($mindex > 0) {
		$tclass = new TeacherClass();
		if ($tclass->getTeacherJiaoliu($mindex)) {
			$title 		= $tclass->getTitle();		
			$jiaocai 	= $tclass->getJiaocai();		
			$gtype 		= $tclass->getTypes();		
			$jldate 	= $tclass->getDates();	
			$texte 		= $tclass->getContent();	
			$jlpath 	= $tclass->getPaths();	
			$jlfile 	= $tclass->getFiles();	
			$ftype 		= $tclass->getFType();
			if (!$ftype) {
				$ftype = getFileType($jlfile);
			}
		}
	}
	if (!$jlpath)
		$jlpath = getTeacherDiretory($tindex);
	if (!$jldate) {
		$jldate = getToday();
	}
?>

<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
	<TR><TD class=error><?php echo($msg) ?></TD></TR>
	<TR><TD height=50><h2>欧洲时报文化中心教师交流  (<?php echo($tname); ?>)</h2></TD></TR>
	<TR>
		<TD>
		<FORM action='admin.php' name="uploadform" method=post enctype="multipart/form-data">
		<INPUT type=hidden name='action' value='<?php echo($action); ?>'>
		<INPUT type=hidden name='mtype' value='<?php echo($TEACHER_TYPE); ?>'>
		<INPUT type=hidden name='nindex' value='<?php echo($nindex); ?>'>
		<INPUT type=hidden name='mindex' value='<?php echo($mindex); ?>'>
		<INPUT type=hidden name='teacher' value='<?php echo($tindex); ?>'>
		<INPUT type=hidden name='teachername' value='<?php echo($tname); ?>'>
		<INPUT type=hidden name='jlpath' value='<?php echo($jlpath); ?>'>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD >
				<TABLE cellSpacing=0 cellPadding=0 width=95% border=0 align=center>
				<TR>
					<TD width=10% class=reg_label height=30>交流题目 : </TD>
					<TD width=90% class=reg_text >					
						<INPUT class=fields type=text size=60 name="jltitle" value="<?php echo($title); ?>">
					</TD>
				</TR>
				<TR>
					<TD width=15% class=reg_label height=30>教材 : </TD>
					<TD width=85%  class=reg_text >
						<select name="jiaocai"  class=cours_select>
						<?php 
							for ($i = 0; $i < count($GRADE_TEXT_NAME); $i++) {
								$gradetext = $GRADE_TEXT_NAME[$i];
								if ($i == $jiaocai || $gradetext == $jiaocai) {
									echo ("<option value=". $gradetext ." selected>" .$gradetext. "</option>");
								} else {
									echo ("<option value=". $gradetext .">" .$gradetext. "</option>");
								}
							}
						?>
						</select> &nbsp;&nbsp;
						<INPUT class=fields type=text size=30 name="fjiaocai" value="<?php echo($jiaocai); ?>">
					</TD>
				</TR>
				<TR>
					<TD width=15% class=reg_label height=30>类别  : </TD>
					<TD width=85%  class=reg_text >
						<select name="gradetype"  class=cours_select>
						<?php 
							for ($i = 0; $i < count($GRADE_TYPE_NAME); $i++) {
								$gradetype = $GRADE_TYPE_NAME[$i];
								if ($gradetype == $gtype) {
									echo ("<option value=". $gradetype ." selected>" .$gradetype. "</option>");
								} else {
									echo ("<option value=". $gradetype .">" .$gradetype. "</option>");
								}
							}
						?>
						</select> &nbsp;&nbsp;
						<INPUT class=fields type=text size=30 name="fgradetype" value="<?php echo($gtype); ?>">	
					</TD>
				</TR>
				<TR>
					<TD width=15% class=reg_label height=30>日期  : </TD>
					<TD width=85%  class=reg_text >
						<INPUT class=fields type=text size=17 name="jldate" value="<?php echo($jldate); ?>">
						<font color=red>&nbsp; 格式 : yyyy-mm-dd (排序用)</font>
					</TD>
				</TR>
				<TR>
					<TD width=10% class=reg_label valign=top>交流内容 : </TD>
					<TD width=90% class=reg_text >
						<textarea class=fields name="jltext" cols="60" rows="5"><?php echo($texte); ?></textarea>
					</TD>
				</TR>
				<TR>
					<TD width=15% class=reg_label height=30>上传文件 : </TD>
					<TD width=85% class=reg_text>
					<INPUT type=hidden name="jlfile" value="<?php echo($jlfile); ?>">
						<INPUT class=files type=file name="upload_file" id="upload_file" title="upload file" value="upload_file" />
						<br><font color=red>(文件不能大於30M)</font>
					</TD>
				</TR>
				<TR>
					<TD class=reg_label> 删除 : </TD>
					<TD class=labelleft>
						<INPUT class=box type='checkbox' name="isdeleted" value='1'>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD height=60 class=listtextcenter>
				<?php if ($mindex > 0) {?>
				<INPUT class=button name="modify" type=submit value='保存修改'>
				<INPUT class=button name="addnew" type=submit value='保存为新文件'>
				<INPUT class=button name="remove" type=submit value='删除文件'>
				<?php } else { ?>
				<INPUT class=button name="addnew" type=submit value='保存'>
				<?php } ?>
				<INPUT class=button name="reset" type=submit value='清除 '>
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