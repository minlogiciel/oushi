<?php
include_once("../admin/admin_include.php");
class AdminUserForm {

function getAdminUserData()
{
	$ids = getPostValue("ids");
	$name = getPostValue("names");
	$loginname = getPostValue("loginname");
	$passwd1 = getPostValue("passwd1");
	$passwd2 = getPostValue("passwd2");
	$level = getPostValue("level");
	$phone = getPostValue("phone");
	$mobile = getPostValue("mobile");
	$email = getPostValue("email");
	$isdeleted = getPostValue("isdeleted");
	
	$user = new AdminUserClass();
	if ($ids > 0) {
		$user->findUser($ids);
	}
	$user->setTrace("");
	$user->setName($name);
	$user->setLoginName($loginname);
	$user->setPassword($passwd1);
	$user->setPassword2($passwd2);
	$user->setLevel($level);
	$user->setPhone($phone);
	$user->setMobile($mobile);
	$user->setEmail($email);
	$user->setDeleted($isdeleted);
	
	return $user;
}

/*********   add admin user ****************/
function addNewAdminUser()
{
	$adminuser = $this->getAdminUserData();
	if ($adminuser->isUserDataOK()) {
		$adminuser->addUser();
		$adminuser->setTrace("添加  / 修改用户完成!");
	}
	return $adminuser;
}

function showAdminUserForm($ids, $adminuser) {
	global $ADMIN_USER_TYPE, $ADMIN_USER_NAME;

	$name = "";
	$loginname = "";
	$passwd1 = "";
	$passwd2 = "";
	$level = 2;
	$phone = "";
	$mobile = "";
	$email = "";
	$err = "";
	$isdeleted = 0;
	if ($adminuser) {
		$err = $adminuser->getTrace();
		$name = $adminuser->getName();
		$loginname = $adminuser->getLoginName();
		$passwd1 = $adminuser->getPassword();
		$passwd2 = $adminuser->getPassword2();
		$level = $adminuser->getLevel();
		$phone = $adminuser->getPhone();
		$mobile = $adminuser->getMobile();
		$email = $adminuser->getEmail();
		$isdeleted = $adminuser->isDeleted();
	}
	else if ($ids > 0) {
		$adminuser = new AdminuserClass();
		if ($adminuser->findUser($ids)) {
			$err = $adminuser->getTrace();
			$name = $adminuser->getName();
			$loginname = $adminuser->getLoginName();
			$passwd1 = $adminuser->getPassword();
			$passwd2 = $adminuser->getPassword2();
			$level = $adminuser->getLevel();
			$phone = $adminuser->getPhone();
			$mobile = $adminuser->getMobile();
			$email = $adminuser->getEmail();
			$isdeleted = $adminuser->isDeleted();
		}
	}
?>

<FORM action='admin.php' method=post>
<INPUT type=hidden name='action' value='addadminuser'>
<INPUT type=hidden name='mtype' value='<?php echo($ADMIN_USER_TYPE); ?>'>
<INPUT type=hidden name='ids' value='<?php echo($ids); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0	style="MARGIN: 10px 3px 10px 10px" align=center>
<TR>
	<TD class=error height=40><?php echo($err) ?></TD>
</TR>
<TR>
	<TD valign=top class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=620 border=0 align=center>
		<TR>
			<TD width=12 height=24 class=registerborder>
				<IMG height=24 src="../images/left.gif" width=12 border=0>
			</TD>
			<TD width=600 class=registerbar>添加修改管理员</TD>
			<TD width=14 height=24 class=registerborder>
				<IMG height=24 src="../images/right.gif" width=14 border=0>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD valign=top class=background>
		<TABLE cellSpacing=2 cellPadding=0 width=620 border=0 class=registerborder align=center>
		<TR>
			<TD height=10 colspan=2></TD>
		</TR>
		<TR>
			<TD class=labelright width=30%><?php showmark( ); ?> 姓名 :</TD>
			<TD class=labelleft  width=70%>
				<INPUT class=fields type=text size=40 name="names" value="<?php echo($name); ?>">
			</TD>
		</TR>
		<TR>
			<TD class=labelright> 登录名 :</TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=40 name="loginname" value="<?php echo($loginname); ?>">
			</TD>
		</TR>
		<TR>
			<TD class=labelright><?php showmark( ); ?> 密码 :</TD>
			<TD class=labelleft>
				<INPUT class=fields type=password size=20 name="passwd1" value="<?php echo($passwd1); ?>"> (8-12字)
			</TD>
		</TR>
		<TR>
			<TD class=labelright><?php showmark( ); ?> 重输密码 :</TD>
			<TD class=labelleft>
				<INPUT class=fields type=password size=20 name="passwd2" value="<?php echo($passwd2); ?>"> (8-12字)
			</TD>
		</TR>
		<TR>
			<TD class=labelright>电话 :</TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=40 name="phone" value="<?php echo($phone); ?>">
			</TD>
		</TR>
		<TR>
			<TD class=labelright>手机 :</TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=40 name="mobile" value="<?php echo($mobile); ?>">
			</TD>
		</TR>
		<TR>
			<TD class=labelright><?php showmark( ); ?> Email :</TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="email" value="<?php echo($email); ?>">
			</TD>
		</TR>
		<TR>
			<TD class=labelright>用户级别 :</TD>
			<TD class=labelleft>
				<select name="level">
<?php 
				for ($i = 0; $i < count($ADMIN_USER_NAME); $i++) {
					$aname = $ADMIN_USER_NAME[$i][0];
					$alevel = $ADMIN_USER_NAME[$i][1];
					if ($alevel == $level)
						echo ("<option value='".$alevel."' selected>" .$aname. "</option>");
					else
						echo ("<option value='".$alevel."'>" .$aname. "</option>");
				}
?>
				</select>
			</TD>
		</TR>
		<TR>
			<TD class=labelright> 删除 : </TD>
			<TD class=labelleft>
				<?php if ($isdeleted == 1) { ?>
					<INPUT class=box type='checkbox' name="isdeleted" value='1'  checked>
				<?php } else { ?>
					<INPUT class=box type='checkbox' name="isdeleted" value='1'>
				<?php } ?>
			</TD>
		</TR>
		<TR>
			<TD colspan=2 class=labelright height=50>
				<div align=center>
				<INPUT class=button type=submit value=' 添加/修改 ' id="savebuttonid">
				&nbsp;&nbsp; 
				<INPUT class=button TYPE='submit' name='reset' VALUE=' Reset '>
				</div>
			</TD>
		</TR>
		<TR>
			<TD height=15 colspan=2>&nbsp;</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
</FORM>
<?php
}

function showAdminUserInfoForm($ids, $msg) {
	global $ADMIN_USER_TYPE, $ADMIN_USER_NAME;

	$name = "";
	$loginname = "";
	$passwd1 = "";
	$passwd2 = "";
	$phone = "";
	$mobile = "";
	$email = "";
	if ($ids > 0) {
		$adminuser = new AdminuserClass();
		if ($adminuser->findUser($ids)) {
			$name = $adminuser->getName();
			$loginname = $adminuser->getLoginName();
			$passwd1 = $adminuser->getPassword();
			$passwd2 = $adminuser->getPassword2();
			$phone = $adminuser->getPhone();
			$mobile = $adminuser->getMobile();
			$email = $adminuser->getEmail();
		}
	}
?>

<FORM action='admin.php' method=post>
<INPUT type=hidden name='action' value='changeuserinfo'>
<INPUT type=hidden name='mtype' value='-1'>
<INPUT type=hidden name='ids' value='<?php echo($ids); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0	style="MARGIN: 10px 3px 10px 10px" align=center>
<TR>
	<TD class=error height=40><?php echo($msg) ?></TD>
</TR>
<TR>
	<TD valign=top class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=620 border=0 align=center>
		<TR>
			<TD width=12 height=24 class=registerborder>
				<IMG height=24 src="../images/left.gif" width=12 border=0>
			</TD>
			<TD width=600 class=registerbar>修改管理员信息</TD>
			<TD width=14 height=24 class=registerborder>
				<IMG height=24 src="../images/right.gif" width=14 border=0>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD valign=top class=background>
		<TABLE cellSpacing=2 cellPadding=0 width=620 border=0 class=registerborder align=center>
		<TR>
			<TD height=10 colspan=2></TD>
		</TR>
		<TR>
			<TD class=labelright width=30%> 姓名 :</TD>
			<TD class=labelleft  width=70%>
				<?php echo($name); ?>
			</TD>
		</TR>
		<TR>
			<TD class=labelright> 登录名 :</TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=40 name="loginname" value="<?php echo($loginname); ?>">
			</TD>
		</TR>
		<TR>
			<TD class=labelright><?php showmark( ); ?> 密码 :</TD>
			<TD class=labelleft>
				<INPUT class=fields type=password size=20 name="passwd1" value="<?php echo($passwd1); ?>"> (8-12字)
			</TD>
		</TR>
		<TR>
			<TD class=labelright><?php showmark( ); ?> 重输密码 :</TD>
			<TD class=labelleft>
				<INPUT class=fields type=password size=20 name="passwd2" value="<?php echo($passwd2); ?>"> (8-12字)
			</TD>
		</TR>
		<TR>
			<TD class=labelright>电话 :</TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=40 name="phone" value="<?php echo($phone); ?>">
			</TD>
		</TR>
		<TR>
			<TD class=labelright>手机 :</TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=40 name="mobile" value="<?php echo($mobile); ?>">
			</TD>
		</TR>
		<TR>
			<TD class=labelright><?php showmark( ); ?> Email :</TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=50 name="email" value="<?php echo($email); ?>">
			</TD>
		</TR>
		<TR>
			<TD colspan=2 class=labelright height=50>
				<div align=center>
				<INPUT class=button type=submit value=' 修改 ' id="savebuttonid">				
				</div>
			</TD>
		</TR>
		<TR>
			<TD height=15 colspan=2>&nbsp;</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
</FORM>
<?php
}

function showLoginForm($msg) {
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 	style="MARGIN: 10px 3px 10px 10px">
<TR>
	<TD class=error ><?php echo($msg) ?></TD>
</TR>
<TR>
	<TD valign=top class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=620 border=0 align=center>
		<TR>
			<TD width=12 height=24 class=registerborder>
				<IMG height=24 src="../images/left.gif" width=12 border=0>
			</TD>
			<TD width=600 class=registerbar>管理员登录</TD>
			<TD width=14 height=24 class=registerborder>
				<IMG height=24 src="../images/right.gif" width=14 border=0>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD valign=top class=background>
		<TABLE cellSpacing=0 cellPadding=2 width=620 border=0 class=registerborder align=center>
		<TR>
			<TD valign=top class=registerborder>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD>
						<FORM method=post action="admin.php">
						<INPUT NAME=action TYPE=HIDDEN VALUE="login">		
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
						<TR>
							<TD height=20 colspan=2 class=formlabel></TD>
						</TR>
						<TR>
							<TD class=formlabel width=45%>
								<DIV align=right>用户名 : &nbsp;&nbsp;&nbsp;&nbsp;</DIV>
							</TD>
							<TD class=formlabel width=55%>
								<DIV align=left>
									<INPUT type=text class=fields size=20 name="log_name" value="">
								</DIV>
							</TD>
						</TR>
						<TR>
							<TD height=10 colspan=2 class=formlabel></TD>
						</TR>
						<TR>
							<TD class=formlabel>
								<DIV align=right>密&nbsp;&nbsp;&nbsp;码 : &nbsp;&nbsp;&nbsp;&nbsp;</DIV>
							</TD>
							<TD class=formlabel>
								<DIV align=left>
									<INPUT type=password class=fields maxLength=20 size=20 name="log_passwd" value="">
								</DIV>
							</TD>
						</TR>
						<TR>
							<TD height=20 colspan=2 class=formlabel>&nbsp;</TD>
						</TR>
						<TR>
							<TD class=formlabel colspan=2 height=30>
								<div align=center>
								<INPUT type="submit" class=buttonlogin size=30 value=" 登录 ">
								</div>
							</TD>
						</tr>
						</TABLE>
						</FORM>
					</TD>
				</TR>
				<TR>
					<TD>
						<FORM method=post action="admin.php">
						<INPUT NAME=action TYPE=HIDDEN VALUE="getpasswd">
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
						<TR>
							<TD height=60 class=formlabel valign=bottom>
								<DIV align=center><img src="../images/puce_red.gif" border=0>&nbsp;&nbsp;忘记密码 ?</DIV>
							</TD>
							<TD class=formlabel>
								&nbsp;
							</TD>
						</TR>
						<TR>
							<TD class=formlabel width=45%>
								<DIV align=right>Email地址 : &nbsp;&nbsp;&nbsp;&nbsp;</DIV>
							</TD>
							<TD class=formlabel width=55%>
								<DIV align=left>
									<INPUT type=text class=fields size=40 name="your_email" value="">
								</DIV>
							</TD>
						</TR>
						<TR>
							<TD class=formlabel colspan=2 height=50>
								<div align=center>
									<INPUT type="submit" class=buttonlogin size=50 value=" 找回密码  ">
								</div>
							</TD>
						</TR>
						<TR>
							<TD height=20 colspan=2 class=formlabel>&nbsp;</TD>
						</tr>
						</TABLE>
						</FORM>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
<?php
}

}
?>
