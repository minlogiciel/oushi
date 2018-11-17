<?php
include_once("../admin/admin_include.php");
class TeacherForm {
	var $error = "";
	
function getError() {
	return $this->error;
}
function getLogin() {
	if (isset($_POST['log_name']))
		$log_name = $_POST['log_name'];
	if (isset($_POST['log_passwd']))
		$log_passwd = $_POST['log_passwd'];
			
	$this->error = '';
	$user = new AdminUserClass();
	if ($user->getRegistedUser($log_name, $log_passwd)) {
	}
	else {
		$this->error = "Login name or password is not correct!";
		$user = '';
	}
	return $user;
}
	
	
function showLoginForm($msg) {
?>

<FORM method=post action="education.php">
<INPUT NAME=action TYPE=HIDDEN VALUE="login">
<INPUT NAME=resource TYPE=HIDDEN VALUE="teacher">	
<TABLE cellSpacing=0 cellPadding=0 width=80% border=0 align=center>
<TR><TD class=error height=30><?php echo($msg) ?></TD></TR>
<TR>
	<TD valign=top class=background>
		<TABLE cellSpacing=0 cellPadding=2 width=620 border=0 align=center>
		<TR>
			<TD valign=top class=registerborder>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class=formlabel width=45% height=50>
						<div align=right>教师登录 : &nbsp;&nbsp;&nbsp;&nbsp;</div>
					</TD>
					<TD class=formlabel width=55%>
						<INPUT type=text class=fields size=20 name="log_name" value="">
					</TD>
				</TR>
				<TR>
					<TD class=formlabel height=50>
						<div align=right>密&nbsp;&nbsp;&nbsp;码 : &nbsp;&nbsp;&nbsp;&nbsp;</div>
					</TD>
					<TD class=formlabel>
						<INPUT type=password class=fields maxLength=20 size=20 name="log_passwd" value="">
					</TD>
				</TR>
				<TR>
					<TD class=formlabel colspan=2 height=50>
						<div align=center><INPUT type="submit" class=buttonlogin size=30 value=" 登录 "></div>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
</FORM>
<?php
}

}
?>
