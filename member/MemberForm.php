<?php
class MemberForm {

	var $MEMBER_TYPE = 1;

function getEmailLink($email) {
	if ($email)
	return ("<a href='mailto:"  .$email. "'>"  .$email. "</a>");
	else
	return "";
}
function getStudentScoresLink($id, $classes, $name) {
	return ("<a href='../member/member.php?action=studentscores&studentid="  .$id. "&classes=".$classes."'>"  .$name. "</a>");
}
function getStudentProfilLink($id, $name) {
	if ($id > 0)
		return ("<a href='../member/member.php?action=studentprofil&studentid="  .$id. "'>"  .$name. "</a>");
	else 
		return $name;
}

function getModifyStudents() {
	$students = array();
	$nb_student = getPostValue('studentnb');
	$cl = getPostValue('classes');
	$classes = getClassBaseName($cl);
	for ($i = 0; $i < $nb_student; $i++) {
		$studentid = getPostValue('studentid_'.$i);
		$civil = getPostValue('civil_'.$i);
		$cname = getPostValue('cname_'.$i);
		$fname = getPostValue('fname_'.$i);
		$address = getPostValue('address_'.$i);
		$email = getPostValue('email_'.$i);
		$phone = getPostValue('phone_'.$i);
		$mobile = getPostValue('mobile_'.$i);
		$isdelete = 0;
		if (getPostValue("delstudent_".$i)) {
			$isdelete = 1;
		}
		if ($cname || $fname || $studentid) {
			$student = new StudentTestClass();
			if ($studentid) {
				$student->getStudentByID($studentid);
			}
			else {
				$student->setID(0);
				$student->setCivil($civil);
				$student->setChineseName($cname);
				$student->setEnglishName($fname);
				$student->setClasses($classes);
			}
			$student->setEmail($email);
			$student->setPhone($phone);
			$student->setMobile($mobile);
			$student->setStreet($address);
			$student->setDeleted($isdelete);
			$students[] = $student;
		}
	}
	return $students;
}

function saveClassMember() {
	$studentform = new StudentForm();
	$students = $this->getModifyStudents();
	$nb_st =  count($students);
	if ($nb_st > 0) {
		for ($i = 0; $i < $nb_st; $i++) {
			$student = $students[$i];
			if ($student->getID() > 0) {
				$student->updateStudentData();
			}
			else {
				if ($student->isDataOK()) {
					$student->addStudent();
				}
				else {
					$err = "Add News Strudent Error : " .$student->getTrace();
					return $err;
				}
			}
		}
	}
	return "";
}

function listClassMemberTable($classes) {
	global $C_CIVIL, $C_NAME, $C_CLASS, $C_ADDRESS, $C_CNAME, $C_FNAME, $C_EMAIL, $C_PHONE, $C_CELL, $C_ALLSTUDENTS, $C_CLASSSTUDENTS, $SAVESTUDENTS, $C_UPDATE, $C_CANCEL;
	$mlists = new MemberList();
	$lists = $mlists->getClassMemberStudents($classes);
	$nbmember = count($lists);
	$showAllStudent = 0;
	$classname = getClassShowName($classes);
	$showname = $classname. " " .$C_CLASSSTUDENTS;
	
	$nb_loop = 	$nbmember;
	if ($nbmember < 35) {
		$nb_loop = 35;
	}
	else {
		$nb_loop += 5;
	}
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
	<TR>
		<TD class=ITEMS_LINE_TITLE>
			<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD height=25 width=50% class=TABLE_FTITLE>
						<div align=left>
							<font color=blue>&nbsp;&nbsp; <?php echo($showname); ?> </font>
						</div>
					</TD>
					<TD height=25 width=50% class=TABLE_FTITLE>
						<div align=right>&nbsp;</div>
					</TD>
				</TR>
			</TABLE>
		</TD>
	</TR>

	<TR>
		<TD class=background>
			<FORM action='../member/member.php' method=post>
			<INPUT NAME='action' TYPE=HIDDEN VALUE='<?php echo($SAVESTUDENTS); ?>'> 
			<INPUT NAME='classes' TYPE=HIDDEN VALUE='<?php echo($classes); ?>'>
			<INPUT NAME='studentnb' TYPE=HIDDEN VALUE='<?php echo($nb_loop); ?>'>
			<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center	class=registerborder>
			<TR>
				<TD class=ITEMS_LINE_TITLE height=25 width='3%'></TD>
				<TD class=ITEMS_LINE_TITLE width='5%'><?php echo($C_CIVIL); ?></TD>
				<TD class=ITEMS_LINE_TITLE width='10%'><?php echo($C_CNAME); ?></TD>
				<TD class=ITEMS_LINE_TITLE width='10%'><?php echo($C_FNAME); ?></TD>
				<TD class=ITEMS_LINE_TITLE width='20%'><?php echo($C_ADDRESS); ?></TD>
				<TD class=ITEMS_LINE_TITLE width='12%'><?php echo($C_PHONE); ?></TD>
				<TD class=ITEMS_LINE_TITLE width='12%'><?php echo($C_CELL); ?></TD>
				<TD class=ITEMS_LINE_TITLE width='20%'><?php echo($C_EMAIL); ?></TD>
				<TD class=ITEMS_LINE_TITLE width='5%'>DEL</TD>
			</TR>
	<?php
		for ($i = 0; $i < $nb_loop; $i++) {
			if ($i < $nbmember) {
				$id 		= $lists[$i]->getID();
				$civil		= $lists[$i]->getCivil();
				$cname		= $lists[$i]->getChineseName();
				$fname		= $lists[$i]->getEnglishName();
				$classes	= $lists[$i]->getClasses();
				$address	= $lists[$i]->getStreet();
				$email 		= $lists[$i]->getEmail();
				$phone 		= $lists[$i]->getPhone();
				$cell		= $lists[$i]->getMobile();
				$isdelete 	= $lists[$i]->isDeleted();
			}
			else {
				$id 		= 0;
				$civil		= "";
				$cname	= "";
				$fname	= "";
				$classes	= "";
				$address	= "";
				$email 		= "";
				$phone 		= "";
				$cell		= "";
				$isdelete 	= 0;
			}
	?>
			<TR>
				<TD class='listnum'>
					<div align=center>
						<?php echo($this->getStudentProfilLink($id, ($i+1))); ?>
					</div>
				</TD>
				<TD class='listtext'>
					<div align=center>
						<?php  
						if ($civil) { 
							echo($civil); 
						}
						else {	?>
						<select name="civil_<?php echo($i); ?>" onclick="active_save();">
							<option value=M selected>M.</option>
							<option value=F>F.</option>
						</select>
						<?php 	} ?>
					</div>
				</TD>
				<TD class='listtext'>
					<div align=center>
					<?php if ($id > 0) {?>
						<INPUT class=fields type=text size=8 name="cname_<?php echo($i); ?>" value="<?php echo($cname); ?>" DISABLED>
					<?php } else { ?>
						<INPUT class=fields type=text size=8 name="cname_<?php echo($i); ?>" value="<?php echo($cname); ?>" onclick="active_save();">
					<?php } ?>
					</div>
				</TD>
				<TD class='listtext'>
					<div align=center>
					<?php if ($id > 0) {?>
						<INPUT class=fields type=text size=10 name="fname_<?php echo($i); ?>" value="<?php echo($fname); ?>" DISABLED>
					<?php } else { ?>
						<INPUT class=fields type=text size=10 name="fname_<?php echo($i); ?>" value="<?php echo($fname); ?>" onclick="active_save();">
					<?php } ?>
					</div>
				</TD>
				<TD class='listtext'>
					<div align=center>
						<INPUT class=fields type=text size=25 name="address_<?php echo($i); ?>" value="<?php echo($address); ?>" onclick="active_save();">
					</div>
				</TD>
				<TD class='listtext'>
					<div align=center>
						<INPUT class=fields type=text size=10 name="phone_<?php echo($i); ?>" value="<?php echo($phone); ?>" onclick="active_save();">
					</div>
				</TD>
				<TD class='listtext'>
					<div align=center>
						<INPUT class=fields type=text size=10 name="mobile_<?php echo($i); ?>" value="<?php echo($cell); ?>" onclick="active_save();">
					</div>
				</TD>
				<TD class='listtext'>
					<div align=center>
						<INPUT class=fields type=text size=25 name="email_<?php echo($i); ?>" value="<?php echo($email); ?>" onclick="active_save();">
					</div>
				</TD>
				<TD class='listtext'>
					<div align=center>
					<?php if ($isdelete) { ?>
						<INPUT class=box type='checkbox' name='delstudent_<?php echo($i); ?>' value='1' CHECKED onclick="active_save();">
					<?php } else { ?>
						<INPUT class=box type='checkbox' name='delstudent_<?php echo($i); ?>' value='1' onclick="active_save();">
					<?php } ?>
						<INPUT NAME='studentid_<?php echo($i); ?>' TYPE=HIDDEN VALUE='<?php echo($id); ?>'>
					</div>
				</TD>
			</TR>
	<?php } ?>
			<TR>
				<TD height=30 class='formlabel' colspan=9>
					<div align=center>
						<INPUT class=button TYPE='submit' name="save" VALUE=' <?php echo($C_UPDATE); ?> ' id="savebuttonid"> 
						<INPUT class=button TYPE='submit' name="reset" VALUE=' <?php echo($C_CANCEL); ?> '> 
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

function listAllStudentTable($loaddel) {
	global $C_CIVIL, $C_NAME, $C_CLASS, $C_ADDRESS, $C_EMAIL, $C_PHONE, $C_CELL, $C_ALLSTUDENTS, $C_CLASSSTUDENTS;
	$mlists = new MemberList();
	$lists = $mlists->getAllStudentsLists($loaddel);
	$nbmember = count($lists);
	$showname = $C_ALLSTUDENTS;
?>

<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR>
	<TD class=ITEMS_LINE_TITLE>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
			<TR>
				<TD height=25 width=50% class=TABLE_FTITLE>
					<div align=left>
						<font color=blue>&nbsp;&nbsp; <?php echo($showname); ?> </font>
					</div>
				</TD>
				<TD height=25 width=50% class=TABLE_FTITLE>
					<div align=right>&nbsp;</div>
				</TD>
			</TR>
		</TABLE>
	</TD>
</TR>

<TR>
	<TD class=background>
		<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center class=registerborder>
		<TR>
			<TD class=ITEMS_LINE_TITLE height=25 width='3%'></TD>
			<TD class=ITEMS_LINE_TITLE width='10%'><?php echo($C_NAME); ?></TD>
			<TD class=ITEMS_LINE_TITLE width='10%'><?php echo($C_CLASS); ?></TD>
			<TD class=ITEMS_LINE_TITLE width='25%'><?php echo($C_ADDRESS); ?></TD>
			<TD class=ITEMS_LINE_TITLE width='13%'><?php echo($C_PHONE); ?></TD>
			<TD class=ITEMS_LINE_TITLE width='13%'><?php echo($C_CELL); ?></TD>
			<TD class=ITEMS_LINE_TITLE width='28%'><?php echo($C_EMAIL); ?></TD>
		</TR>
	<?php
	for ($i = 0; $i < $nbmember; $i++) {
		$id 		= $lists[$i]->getID();
		$name		= $lists[$i]->getChineseName();
		$cl			= $lists[$i]->getClasses();
		$classes	= getClassShowName($cl);
		$email 		= $lists[$i]->getEmail();
		$address 	= $lists[$i]->getStreet();
		$phone 		= $lists[$i]->getPhone();
		$cell		= $lists[$i]->getMobile();
		?>
		<TR>
			<TD class='listnum'>
				<div align=center><font size=1><?php echo(($i+1)); ?></font></div>
			</TD>
			<TD class='listtext'>
				<div align=center>
					<?php echo($this->getStudentProfilLink($id, $name)); ?>
				</div>
			</TD>
			<TD class='listtext'>
				<div align=center> <?php echo($classes); ?> </div>
			</TD>
			<TD class='listtext'>
				<div align=center><?php echo($address); ?></div>
			</TD>
			<TD class='listtext'>
				<div align=center><?php echo($phone); ?></div>
			</TD>
			<TD class='listtext'>
				<div align=center> <?php echo($cell); ?></div>
			</TD>
			<TD class='listtext'><div align=center>
				<?php echo($this->getEmailLink($email)); ?>	</div>
			</TD>
		</TR>
		<?php } ?>
		</TABLE>
	</TD>
</TR>
</TABLE>
<?php
}

function getStudentProfilForm($studentid)
{
	$memberList = new MemberList();
	$student = $memberList->getStudent($studentid);
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 style="MARGIN: 10px 3px 10px 10px">
<TR>
	<TD><?php FormTitle("Student Profile"); ?>
	</TD>
</TR>
<TR>
	<TD valign=top>
		<TABLE cellSpacing=2 cellPadding=0 width=520 border=0 class=registerborder>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=0 cellPadding=0 width=95% border=0 align=center>
				<TR>
					<TD>
						<FORM method="post" action="member.php">
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
						<TR>
							<TD height=25 class=formlabel2>
								<img src="../images/puce_red.gif" border=0>
								&nbsp;&nbsp;Change Student Infomation
							</TD>
						</TR>
						<TR>
							<TD>
								<?php $this->studentInfomationForm($student); ?>
							</TD>
						</TR>
						<TR>
							<TD class=background height=50>
								<div align=center>
									<INPUT NAME=studentid TYPE=HIDDEN VALUE="<?php echo($studentid); ?>"> 
									<INPUT NAME=action TYPE=HIDDEN VALUE="changeprofil"> 
									<INPUT type="submit" class=button NAME="update" value=" Update " id="savebuttonid" > 
									<INPUT type="submit" class=button NAME="reset" value=" Reset ">
								</div>
							</TD>
						</TR>
						</TABLE>
						</FORM>
					</TD>
				</TR>
				<TR>
					<TD height=20>&nbsp;</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD class=formlabel height=30></TD>
</TR>
</TABLE>
<?php
}



function studentInfomationForm($student)
{
		global $CLASS_NAME;
		$user_email 	= "";
		$user_name 	= "";
		$user_street 	= "";
		$user_city 		= "";
		$user_postcode 	= "";
		$user_country 	= "";
		$user_phone 	= "";
		$user_mobile 	= "";
		$classes 		= "";
		$isdeleted 		= 0;

		if ($student) {
			$user_email 	= $student->getEmail();
			$user_id 		= $student->getID();
			$cname 	= $student->getChineseName();
			$fname 	= $student->getEnglishName();
			if ($cname) {
				$user_name = $cname;
				if ($fname) {
					$user_name .= "(" .$fname.")";
				}
			}
			else {
				$user_name = $fname;
			}
			$classes = $student->getClasses();
			$classes2 = $student->getClasses2();;

			$notes = $student->getComments();

			$user_street 	= $student->getStreet();
			$user_city  	= $student->getCity();
			$user_postcode 	= $student->getPostCode();
			$user_country 	= $student->getCountry();
			$user_phone 	= $student->getPhone();
			$user_mobile 	= $student->getMobile();
			$isdeleted 	= $student->isDeleted();
			
			$bmonth = $bday = $byear = 0;
			$birthday = $student->getBirthDay();
			if ($birthday && $birthday != "NULL" && strstr($birthday,"/") && strlen($birthday) > 6) {
				list($bmonth, $bday, $byear) = explode("/", trim($birthday));
			}
		}
		?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
	<TR>
		<TD class=labelright height=25>&nbsp;&nbsp;Student Name :</TD>
		<TD class=formlabel><?php echo($user_name); ?></TD>
	</TR>
	<TR>
		<TD class=labelright height=25>&nbsp;&nbsp;Student ID :</TD>
		<TD class=formlabel><?php echo($user_id); ?></TD>
	</TR>
	<TR>
		<TD class=labelright height=25>&nbsp;&nbsp;Email :</TD>
		<TD class=formlabel><INPUT class=fields type=text size=50 name="email"
			value="<?php echo($user_email); ?>" onclick="active_save();">
		</TD>
	</TR>
	<TR>
		<TD class=labelright>Birthday :</TD>
		<TD class=labelleft><select name="bmonth" onclick="active_save();">
				<option value=0>&nbsp;-&nbsp; month &nbsp;-&nbsp;</option>
				<?php
				for ($i = 1; $i < 13; $i++) {
					if ($i == $bmonth)
					echo ("<option value=". $i ." selected>" .$i . "</option>");
					else
					echo ("<option value=". $i .">" .$i . "</option>");
				}
				?>
		</select> <select name="bday" onclick="active_save();">
				<option value=0>&nbsp;-&nbsp; day &nbsp;-&nbsp;</option>
				<?php
				for ($i = 1; $i < 32; $i++) {
					if ($i == $bday)
					echo ("<option value=". $i ." selected>" .$i . "</option>");
					else
					echo ("<option value=". $i .">" .$i . "</option>");
				}
				?>
		</select> <select name="byear" onclick="active_save();">
				<option value=0>&nbsp;-&nbsp; year &nbsp;-&nbsp;</option>
				<?php
				$yy = Date('Y');
				for ($i = $yy; $i >= 1970; $i--) {
					if ($i == $byear)
					echo ("<option value=". $i ." selected>" .$i . "</option>");
					else
					echo ("<option value=". $i .">" .$i . "</option>");
				}
				?>
		</select>
		</TD>
	</TR>
	<TR>
		<TD class=labelright height=25>&nbsp;&nbsp;Class :</TD>
		<TD class=formlabel>
		<select name="classes" onclick="active_save();">
		<?php 
		$n = findClassInTable($classes);
		for ($i = 0; $i < count($CLASS_NAME); $i+=2) {
			$classname = getClassShowName($i);
			if ($i == $n) {
				echo ("<option value='".$i."' selected> " .$classname." </option>");
			} else {
				echo ("<option value='".$i."'> " .$classname. "</option>");
			}
		}
		?>
		</select>
		</TD>
	</TR>

	<TR>
		<TD class=labelright height=25>&nbsp;&nbsp;Adresse :</TD>
		<TD class=formlabel>
			<INPUT class=fields type=text size=50 name="street" value="<?php echo($user_street); ?>" onclick="active_save();">
		</TD>
	</TR>
	<TR>
		<TD class=labelright height=25>&nbsp;&nbsp;Ville :</TD>
		<TD class=formlabel>
			<INPUT class=fields type=text size=50 name="city" value="<?php echo($user_city); ?>" onclick="active_save();">
		</TD>
	</TR>
	<TR>
		<TD class=labelright height=25>&nbsp;&nbsp;Code Postal:</TD>
		<TD class=formlabel>
			<INPUT size=20 class=fields type=text name="postcode" value="<?php echo($user_postcode); ?>" onclick="active_save();">
		</TD>
	</TR>
	<TR>
		<TD class=labelright height=25>&nbsp;&nbsp;Paye :</TD>
		<TD class=formlabel>
			<INPUT class=fields type=text size=50 name="country" value="<?php echo($user_country); ?>" onclick="active_save();">
		</TD>
	</TR>
	<TR>
		<TD class=labelright height=25>&nbsp;&nbsp;Phone :</TD>
		<TD class=formlabel><INPUT class=fields type=text size=50 name="phone"
			value="<?php echo($user_phone); ?>" onclick="active_save();">
		</TD>
	</TR>
	<TR>
		<TD class=labelright height=25>&nbsp;&nbsp;Mobile :</TD>
		<TD class=formlabel>
			<INPUT class=fields type=text size=50 name="mobile" value="<?php echo($user_mobile); ?>" onclick="active_save();">
		</TD>
	</TR>
	<TR>
		<TD class=labelright height=25>&nbsp;&nbsp;Comments :</TD>
		<TD class=formlabel>
			<INPUT class=fields type=text size=50 name="notes" value="<?php echo($notes); ?>" onclick="active_save();">
		</TD>
	</TR>
	<TR>
		<TD class=labelright height=25>&nbsp;&nbsp; Deleted :</TD>
		<TD class=formlabel>
			<?php if ($isdeleted) { ?>
				<INPUT class=box type='checkbox' name='deleted' value='1' checked>
			<?php } else { ?>
				<INPUT class=box type='checkbox' name='deleted' value='1'>
			<?php  } ?>
		</TD>
	</TR>
</TABLE>
<?php
}

function changeStudentProfil() {

	$street = getPostValue('street');
	$email = getPostValue('email');
	$city = getPostValue('city');
	$postcode = getPostValue('postcode');
	$country = getPostValue('country');
	$phone = getPostValue('phone');
	$mobile = getPostValue('mobile');
	$studentid = getPostValue('studentid');

	$cl = getPostValue('classes');
	$classes = getClassBaseName($cl);
	$classes2 = getPostValue('classes2');

	$notes = getPostValue('notes');
	$deleted = getPostValue('deleted');
	$bday = getPostValue("bday");
	$bmonth = getPostValue("bmonth");
	$byear = getPostValue("byear");
	if ($bday == 0 || $bmonth == 0 || $byear == 0) {
		$birthday = "";
	}
	else {
		$birthday = $bmonth. "/" .$bday. "/" .$byear;
	}
	
	if ($studentid) {
		$student = new StudentTestClass();
		if ($student->getStudentByID($studentid)) {
			$student->setEmail($email);
			$student->setStreet($street);
			$student->setCity($city);
			$student->setPostCode($postcode);
			$student->setCountry($country);
			$student->setPhone($phone);
			$student->setMobile($mobile);
			$student->setBirthDay($birthday);
		
			$student->setClasses($classes);
			$student->setClasses2($classes2);
			$student->setComments($notes);
			$student->setDeleted($deleted);
			
			$student->updateStudentData();
		}
	}
	else {
		$student = '';
	}
	return $student;
}

function listSummerTable() {
	global $C_DATE, $C_WEEK, $C_MORNING, $C_AFTERNOON, $C_NIGHT, $C_SUMMER, $C_SUMMER_TITLE, $C_WEEKDAT;
	
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
	<TR>
		<TD class=ITEMS_LINE_TITLE>
			<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD height=25 width=50% class=TABLE_FTITLE>
						<div align=center>
							<font color=blue><?php echo($C_SUMMER_TITLE); ?> </font>
						</div>
					</TD>
					<TD height=25 width=50% class=TABLE_FTITLE>
						<div align=right>&nbsp;</div>
					</TD>
				</TR>
			</TABLE>
		</TD>
	</TR>

	<TR>
		<TD class=background>
			<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center	class=registerborder>
			<TR>
				<TD class=ITEMS_LINE_TITLE height=25 width='5%'></TD>
				<TD class=ITEMS_LINE_TITLE width='10%'><?php echo($C_DATE); ?></TD>
				<TD class=ITEMS_LINE_TITLE width='5%'><?php echo($C_WEEK); ?></TD>
				<TD class=ITEMS_LINE_TITLE width='25%'><?php echo($C_MORNING); ?></TD>
				<TD class=ITEMS_LINE_TITLE width='30%'><?php echo($C_AFTERNOON); ?></TD>
				<TD class=ITEMS_LINE_TITLE width='25%'><?php echo($C_NIGHT); ?></TD>
			</TR>
	<?php $sw = 2;
		  $dm = 7;
		  $dd = 10;
		for ($i = 0; $i < count($C_SUMMER); $i++) {
			$item 	= $C_SUMMER[$i];
			$count 	= count($item);
			$sw++;
			$dd++;
	?>
			<TR>
				<TD class='listnum'>
					<div align=center>
						<?php echo($i+1); ?>
					</div>
				</TD>
				<TD class='listtext'>
					<div align=center>
					<?php 
						if ($dd == 32) {
							$dd = 1;
							$dm++;
						}
						echo($dm. ", ". $dd); 
					?>
					</div>
				</TD>
				<TD class='listtext'>
					<div align=center>
					<?php echo($C_WEEKDAT[$sw%7]); ?>
					</div>
				</TD>
			<?php if ($count == 1) {?>
				<TD class='listtext' colspan=3>
					<div align=left>&nbsp;&nbsp;<?php echo($item[0]); ?> </div>
				</TD>
			<?php } else { ?>
				<TD class='listtext'>
					<div align=left>&nbsp;&nbsp;<?php echo($item[0]); ?> </div>
				</TD>
				<TD class='listtext'>
					<div align=left>&nbsp;&nbsp;<?php echo($item[1]); ?> </div>
				</TD>
				<TD class='listtext'>
					<div align=left>&nbsp;&nbsp;<?php echo($item[2]); ?> </div>
				</TD>
			<?php } ?>
			</TR>
	<?php } ?>
			</TABLE>
		</TD>
	</TR>
</TABLE>

<?php
}


	

function listHodongRegisterTable() {	
	global $C_CIVIL, $C_NAME, $C_CLASS, $C_TIME, $C_TITLE, $C_ADDRESS, $C_EMAIL, $C_PHONE, $C_CELL, $C_BAOMING_TABLE, $C_CLASSSTUDENTS, $HUODONGTAB;
	$mlists = new MemberList();
	$lists = $mlists->getHuodongLists();
	$nbmember = count($lists);
	$showname = $C_BAOMING_TABLE;
?>

<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR>
	<TD class=ITEMS_LINE_TITLE>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
			<TR>
				<TD height=25 width=100% class=TABLE_FTITLE>
					<div align=center>
						<font color=blue><?php echo($showname); ?> </font>
					</div>
				</TD>
			</TR>
		</TABLE>
	</TD>
</TR>

<TR>
	<TD class=background>
		<TABLE cellSpacing=2 cellPadding=0 width=100% border=0 align=center class=registerborder>
		<TR>
			<TD class=ITEMS_LINE_TITLE height=25 width='3%'></TD>
			<TD class=ITEMS_LINE_TITLE width='10%'><?php echo($C_NAME); ?></TD>
			<TD class=ITEMS_LINE_TITLE width='20%'><?php echo($C_TITLE); ?></TD>
			<TD class=ITEMS_LINE_TITLE width='10%'><?php echo($C_CLASS); ?></TD>
			<TD class=ITEMS_LINE_TITLE width='8%'><?php echo($C_TIME); ?></TD>
			<TD class=ITEMS_LINE_TITLE width='10%'><?php echo($C_PHONE); ?></TD>
			<TD class=ITEMS_LINE_TITLE width='10%'><?php echo($C_CELL); ?></TD>
			<TD class=ITEMS_LINE_TITLE width='10%'>FAX</TD>
			<TD class=ITEMS_LINE_TITLE width='27%'><?php echo($C_EMAIL); ?></TD>
		</TR>
	<?php
	for ($i = 0; $i < $nbmember; $i++) {
		$huodong	= $lists[$i];
		$hdindex = $huodong->getHDIndex();	
		$cname = $huodong->getChinaName();	
		if (!$cname)  {
			$cname = $huodong->getEnglishName();
		} 
		$phone = $huodong->getPhone();
		$mobile = $huodong->getMobile();
		$fax 	= $huodong->getFax();
		$email = $huodong->getEmail();
		$classes = $huodong->getClasses();
		$times = $huodong->getTimes();								
				
		$payment = $huodong->getPayment();
		$street = $huodong->getStreet();
		$city  = $huodong->getCity();
		$postcode = $huodong->getPostCode();
		$country = $huodong->getCountry();
		
		
		?>
		<TR>
			<TD class='listnum'>
				<div align=center><font size=1><?php echo(($i+1)); ?></font></div>
			</TD>
			<TD class='listtext'>
				<div align=center><?php echo( $cname); ?></div>
			</TD>
			<TD class='listtext'>
				<div align=center><?php echo($HUODONGTAB[$hdindex][0]); ?></div>
			</TD>		
			<TD class='listtext'>
				<div align=center> <?php echo($classes); ?> </div>
			</TD>
			<TD class='listtext'>
				<div align=center> <?php echo($times); ?> </div>
			</TD>
			<TD class='listtext'>
				<div align=center><?php echo($phone); ?></div>
			</TD>
			<TD class='listtext'>
				<div align=center> <?php echo($mobile); ?></div>
			</TD>
			<TD class='listtext'>
				<div align=center> <?php echo($fax); ?></div>
			</TD>
			<TD class='listtext'><div align=center>
				<?php echo($this->getEmailLink($email)); ?>	</div>
			</TD>
		</TR>
		<?php } ?>
		</TABLE>
	</TD>
</TR>
</TABLE>
<?php
}



}

?>