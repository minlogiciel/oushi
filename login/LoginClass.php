<?php
class LoginClass
{
	var $error = '';
	function getError() {
		return $this->error;
	}

	function setCookie($log_name, $log_passwd, $rememberme) {
		$expires = time() + 30*3600*24*$rememberme ; /* 30 days */
		setcookie("oushiadminname", $log_name, $expires);
		setcookie("oushiadminpassword", $log_passwd, $expires);
	}

	function getLogin() {
		if (isset($_POST['log_name']))
			$log_name = $_POST['log_name'];
		if (isset($_POST['log_passwd']))
			$log_passwd = $_POST['log_passwd'];
			
		$remoteip = $_SERVER['REMOTE_ADDR'];
		$this->error = '';
		$user = new AdminUserClass();
		if ($user->getRegistedUser($log_name, $log_passwd)) {
			$this->setCookie($log_name, $log_passwd, 1);
			$user->updateUserIP($remoteip);
		}
		else {
			$this->error = "Login name or password is not correct!";
			$user = '';
		}
		return $user;
	}

	function getForgotPassword() {
		$youremail = "";
		if (isset($_POST['your_email']))
			$youremail = $_POST['your_email'];
		$user = new AdminUserClass();
		if ($user->isEmailValide($youremail)) {
			if ($user->findUserByEmail($youremail)) {
				include "../email/sendemail.php";
				$sendemail 					= new sendemail();
				$sendemail->sendpassword($youremail, $user);
				$msg = "Your password will be sent to your email address " .$youremail. ".";
			}
			else {
				$msg = "Your email address (".$youremail.") is not found!";
			}
		}
		else {
			$msg = "Your email address is not valide!";
		}
		return $msg;
	}

	function changeUserInfo()
	{
		$ids = getPostValue("ids");
		$loginname = getPostValue("loginname");
		$passwd1 = getPostValue("passwd1");
		$passwd2 = getPostValue("passwd2");
		$phone = getPostValue("phone");
		$mobile = getPostValue("mobile");
		$email = getPostValue("email");
		
		$user = new AdminUserClass();
		if ($ids > 0) {
			$user->findUser($ids);
			$user->setTrace("");
			$user->setLoginName($loginname);
			$user->setPassword($passwd1);
			$user->setPassword2($passwd2);
			$user->setPhone($phone);
			$user->setMobile($mobile);
			$user->setEmail($email);
			if ($user->isUserDataOK()) {
				$user->updateUserInfo();
				$this->error = "修改个人信息完成!";
			}
			else {
				$this->error = "Modify Admin User Information Error!";
			}
		}
		else {
			$this->error = "Admin User is not found!";
		}
		return $user;;
	}

}
?>
