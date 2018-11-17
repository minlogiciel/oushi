<?php
include "../php/allinclude.php";
session_start();

if (isset($_SESSION['start_time'])) {
	$elapsed_time = time() - $_SESSION['start_time'];
	if ($elapsed_time >= $TIME_OUT) {
		unset($_SESSION['start_time']);
		$ACTIVE_LOGIN = 1;
		session_destroy();
		header("Location: ../home/");
	}
}

$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");
$classes = isset($_GET["classes"]) ? $_GET["classes"] : (isset($_POST["classes"]) ? $_POST["classes"] : 1);
$studentid = isset($_GET["studentid"]) ? $_GET["studentid"] : (isset($_POST["studentid"]) ? $_POST["studentid"] : 0);
$prog = isset($_GET["programs"]) ? $_GET["programs"] : (isset($_POST["programs"]) ? $_POST["programs"] : "");
$semester = isset($_GET["semester"]) ? $_GET["semester"] : (isset($_POST["semester"]) ? $_POST["semester"] : '');
$period = isset($_GET["period"]) ? $_GET["period"] : (isset($_POST["period"]) ? $_POST["period"] : 0);
$createdpdf = isset($_GET["createdpdf"]) ? $_GET["createdpdf"] : (isset($_POST["createdpdf"]) ? $_POST["createdpdf"] : 0);

$student = '';
$studentform = '';
$tuto = 0;
if (isset($_SESSION['log_user'])) {
	$student = $_SESSION['log_user'];
}

if ($student) {
	$cls = $student->getClasses();
	if ($cls == $CLASS_NAME[count($CLASS_NAME)-2]) {
		$tuto = 1;
	}
}

if ($action == "reportcard" || $action == "tuitionbill" || $action =="allscores") {
	if (!$studentid && $student) {
		$studentid = $student->getID();
	}
	if ($studentid) {
		$studentform = new StudentForm();
	}
}
else {
	if ($studentid) {
		$studentform = new StudentForm();
	}
	else {
		$loginform = new LoginForm();
	}
}

include "../php/header.php";
?>
<TABLE width=970 cellspacing=0 cellpadding=0 align=center>
	<TR>
		<TD valign=top>
			<table width=100% height=550 cellspacing=0 cellpadding=0 align=center>
				<tr>
					<td width=200 valign=top class=ITEMS_BG><?php 
					include "../member/indexleft.php";
					?>
					</td>
					<td width=750 valign=top>
						<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
							<TR>
								<TD>
									<TABLE cellSpacing=0 cellPadding=0 width=100% border=0
										align=center>
										<TR>
											<TD>
												<TABLE cellSpacing=0 cellPadding=0 width=100% border=0
													align=center>
													<TR>
														<TD valign=top>
															<TABLE cellSpacing=0 cellPadding=0 width=98% border=0
																align=center>
																<TR>
																	<TD class=formlabel height=10></TD>
																</TR>
																<TR>
																	<TD width=100% class=formlabel><?php 

																	if ($action == "reportcard") {
																		if ($studentform)  {
																			$studentform->listStudentReportTable($studentid, $semester, $period, $createdpdf) ;
																		}
																	}
																	else if ($action == "allscores") {
																		if ($studentform)  {
																			$studentform->listStudentAllScoresTable($studentid, $semester, $period, $createdpdf) ;
																		}
																	}
																	else {
																		if (!$loginform) {
																			$loginform = new LoginForm();
																		}

																		if ($student) {
																			if ($tuto) {
																				$sessionform = new PrivateForm();
																				$sessionform->showTeacherPrivateSessionForStudent("", "", "", $student->getID());
																			} else {
																				$loginform->showMyAccountDetailForm($student);
																			}
																		} else {
																			$loginform->getLoginForm();
																		}
																	}
																	?>
																	</TD>
																</TR>
															</TABLE>
														</TD>
													</TR>
													<TR>
														<TD class=formlabel height=20></TD>
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

$ip = $_SERVER['REMOTE_ADDR'];
include_once("../geoip/geo_include.php");

if ($student) {
	$savetobase = $action. " for " .$student->getStudentName();
}
else if ($studentid) {
	$savetobase = $action. " for " .$studentid;
}
else {
	$savetobase = $action;
}

//$con_addr = new ConnectClass();
//$con_addr->addUserIP($ip, $action. $savetobase);

include "../php/footer.php"; 

?>
