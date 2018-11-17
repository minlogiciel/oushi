<?php
include "../php/allinclude.php";
include "../member/actionlist.php";
session_start();



//if (isAdminAllowed($remoteip))
//{

$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");
$classes = isset($_GET["classes"]) ? $_GET["classes"] : (isset($_POST["classes"]) ? $_POST["classes"] : 0);
$groups = isset($_GET["groups"]) ? $_GET["groups"] : (isset($_POST["groups"]) ? $_POST["groups"] : "");
$studentid = isset($_GET["studentid"]) ? $_GET["studentid"] : (isset($_POST["studentid"]) ? $_POST["studentid"] : 0);

$err = '';
$ok = 0;
$scoresform = '';
$memberform = '';
$studentform = '';
$student = '';
$scoreslists = '';

$result = '';

if ($action == $SAVESTUDENTS) {
	$memberform = new MemberForm();
	if(empty($_REQUEST['reset']) )  
	{  
		$err = $memberform->saveClassMember();
		if (!$err)
			$result = "class members have been updated.";
	}
}
else if ($action == "changeprofil") {
	$memberform = new MemberForm();
	if(empty($_REQUEST['reset'])) {
		$memberform->changeStudentProfil();
		$result = "student profil have been changed.";
	}
}
else if ($action == $SAVESCORES) {
	$scoresform = new ScoresForm();
	if(!empty($_REQUEST[$VIEWSCORES]))  
	{  
		$scoreslists = $scoresform->getScoreslist();
		$action = $VIEWSCORES;
	}
	else if(empty($_REQUEST['reset']))  
	{  
		$scoreslists = $scoresform->addNewScoresList();
		$result = "Scores have been saved.";
		$action = $SHOWSCORES;
	}
}
else if ($action == $CHANGESCORES) {
	$scoresform = new ScoresForm();
	if(empty($_REQUEST['reset'])) {
		$scoreslists = $scoresform->updateScoresList($groups); 
		$result = "Scores have been changed.";
	}
}


include "../php/header.php";
?>


<TABLE width=970 cellspacing=0 cellpadding=0 align=center>
<TR>
	<TD valign=top>
		<table width=100% height=550 cellspacing=0 cellpadding=0 align=center>
		<tr>
			<td width=180 valign=top class=ITEMS_BG><?php include "../member/memberleft.php"; ?></td>
			<td width=770 valign=top>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0  align=center>
				<TR>
					<TD>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0  align=center>
						<?php if ($err) { ?>
						<TR>
							<TD class=error height=30>
								<DIV align=center><?php echo($err); ?></DIV>
							</TD>
						</TR>
						<?php } ?>
						<TR>
							<TD class=error height=20>
								<DIV align=center><b><?php echo($result); ?></b></DIV>
							</TD>
						</TR>
					
						<TR>
							<TD>
								<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center> 
								<TR>
									<TD>
										<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
										<TR>
											<TD valign=top>
												<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
												<TR>
													<TD width=100%>
<?php 

if ($action == $ALLSTUDENTS) {
	$memberform = new MemberForm();
	$memberform->listAllStudentTable(0) ;
}
else if ($action == $OLDSTUDENTS) {
	$memberform = new MemberForm();
	$memberform->listAllStudentTable(1) ;
}
else if ($action == $CLASSMEMBER) {
	$memberform = new MemberForm();
	$memberform->listClassMemberTable($classes) ;
}
else if ($action == $SAVESTUDENTS) {
	$memberform->listClassMemberTable($classes) ;
}
else if ($action == "studentprofil" || $action == "changeprofil") {
	$memberform = new MemberForm();
	$memberform->getStudentProfilForm($studentid);
}							
else  if ($action == $INPUTSCORES) {												
	$scoresform = new ScoresForm();
	$scoresform->showScoresForm($classes, $scoreslists);
}
else if ($action == $VIEWSCORES) {
	$scoresform->showScoresForm($classes, $scoreslists);
}
else if ($action == $SHOWSCORES) {
	$scoresform = new ScoresForm();
	$scoresform->showClassStudentsScoresList($classes);
}
else if ($action == $UPDATESCORES) {
	$scoresform = new ScoresForm();
	$scoresform->getUpdateScoresForm($classes, $groups);
}
else if ($action == $CHANGESCORES) {
	$scoresform->getUpdateScoresForm($classes, $groups);
}
else {
	$memberform = new MemberForm();
	$memberform->listAllStudentTable(0) ;
}
?>
													</TD>
												</TR>
												</TABLE>
											</TD>
										</TR>
										</TABLE>
									</TD>
								</TR>
								</TABLE>	
							</TD>
						</TR>
						</TABLE>
					</td>
				</TR>
				</TABLE>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
<?php 
include "../php/footer.php";
?>

