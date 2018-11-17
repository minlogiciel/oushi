<?php
class sendemail {

	var $titre = "New Message";			## Titre par d�faut du email
	var $texte = '';	 				## Texte par d�faut du email
	var $email = '';					## Email qui on envois
	var $name  = '';	 				## Nom qui on envois
	var $type = 'html';					## Type de email envoyé     **|html|text|none|**
	var $priority = 1;					## Priorit� du message      **|1|2|3|4|5|**
	var $oushi_email = "culture@oushinet.com";

	function sendpassword($youremail, $user){
		$this->titre = "找回密码";
		if ($user && $youremail) {
			$name = $user->getLoginName();
			$pass = $user->getPassword();
			
			$this->texte = "<br><bt>登录欧洲时报文化中心网站管理员<br><br>   登录名 : " . $name . "<br> 密码 : " . $pass . "<br<br>";
			
			$this->email = $youremail;
			$to = $this->name." <".$this->email.">";

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: Oushi <' .$this->oushi_email. '>' ."\r\n";
			$headers .= 'Reply-To: Oushi <' .$this->oushi_email. '>' ."\r\n";
			$headers .= "X-Priority: 1";
			
			$texte = $this->body($this->texte);
			
			mail($to, $this->titre, $texte, $headers);
		}
	}
	
	
	function body($texte){
		$body = '<html><head><title>'.$this->titre.'</title></head>
				<body text="#000000" link="#640c0b" vlink="#640c0b" alink="#640c0b"
				leftmargin="0" marginwidth="0" topmargin="0" marginheight="0">'
				.$texte. '</body></html>';
		return $body;
	}
}

?>
