<?php

$loginform = new LoginForm();
$loginok = 0;

if ($action == "login") {
	$loginclass = new LoginClass();
	$student = $loginclass->getLogin();
	if ($student) {
		$_SESSION['log_user'] 		= $student;
		$loginok = 1;
		$ACTIVE_LOGIN = 1;
	}
	else {
		unset($_SESSION['log_user']);
		$err = $loginclass->getError();
		$ACTIVE_LOGIN = 0;
	}
}
else if ($action == "changepass")
{
	if(empty($_REQUEST['reset']))
	{
		$loginclass = new LoginClass();
		if ($loginclass->changePassword()) {
			$result = "Your password has been changed!";
			$resulttitle = "Change Password";
		}
		$err = $loginclass->getError();
	}
	$student = '';
	if (isset($_SESSION['log_user'])) {
		$student = $_SESSION['log_user'];
		$loginok = 1;
	}
}
else if ($action == "getpasswd") {
	$loginclass = new LoginClass();
	$result = $loginclass->getForgotPassword();
	if ($result[0] == '!') {
		$err = substr($result, 1);
		$result = '';
	}
	else {
		$resulttitle = "Get Password";
	}
	$student = '';
	if (isset($_SESSION['log_user'])) {
		$student = $_SESSION['log_user'];
	}
}
else {
	$student = '';
	if (isset($_SESSION['log_user'])) {
		$student = $_SESSION['log_user'];
		$loginok = 1;
	}
}

if ($student) {
	$cls = $student->getClasses();
	$savetobase .= " for " .$student->getStudentName(). " OK!";
}
else {
	if (isset($_POST['log_name']))
		$savetobase .= " for " .$_POST['log_name']. " KO!";
}

include ("../php/title.php");
?>
<script language="JavaScript" type="text/javascript"> 
function active_save() 
{ 
	document.getElementById("saveinofid").disabled='';
} 
function active_savepasswd() 
{ 
	document.getElementById("savepasswdid").disabled='';
} 
function loadSession(url, value) 
{ 
	window.open(url+'&dates='+value,'_self');
} 
</script>

<BODY onload="initializemaps()">

<div class="content">
<?php include "../php/maintitle.php"; ?>
<div class="left">
	<div class="left_box">
    	<div class="PROG_TIT">
 			<IMG src="../images/logo_s.png" height=50>
 			<h1>欧洲时报文化中心学生中心</h1>
     	</div>
     	<br>
    	<div class="box_txt">
		<?php 
			if ($err) { 
				echo("<div align=center>" .$err. "</DIV>");
			}
			if ($result) {
				$loginform->showResultForm($resulttitle, $result);
			}
			else {
				if ($loginok) {
					if ($action == "login") {
						$loginform->showMyAccountDetailForm($student);
					}
					else {
						$loginform->getAccountForm($student);
					}
				} else {
					$loginform->getLoginForm();
				}
			}
		?>
		</div>
	</div>
   	<div class=box_bg>&nbsp; </div>
</div>
<div class="right">
	<?php include "../php/right.php" ?>    
</div>
</div>
<?php include "../php/foot1.php"; ?>

</body>
</html>


