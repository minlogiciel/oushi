<?php
class OushiMail {

	var $titre =   "Inscriptions ";				## Titre par defaut du email
	var $oushi_email = "culture@oushinet.com";	## oushi email
	//var $oushi_to = "culture@oushinet.com";		## oushi email
	var $oushi_to = "amyxujr@gmail.com";		## oushi email
	var $back_to = "daimin08@gmail.com";		## oushi email
	var $priority = 1;							## Priority of message      **|1|2|3|4|5|**
	var $MAIL_OK = 1;
	
	function SendToOushi($text){
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= 'From: Oushi <' .$this->oushi_email. '>' ."\r\n";
		$headers .= 'Reply-To: Oushi <' .$this->oushi_email. '>' ."\r\n";
		//$headers .= 'cc: amyxujr@gmail.com' . "\r\n";		
		//$headers .= 'Bcc: daimin08@gmail.com' . "\r\n";		
		$headers .= "X-Priority: ".$this->priority;
 			
		$texte = $this->body($text);
		$title = $this->titre. "(".date('Y-m-d - H:i').")";	
		if ($this->MAIL_OK) {
			if (mail($this->oushi_to, $title, $texte, $headers)) {
				return "OK";
			}
		}
		else {
			if (mail($this->back_to, $title, $texte, $headers)) {
				return "OK";
			}
		}
		
		return "Faild";
	}
	
	function body($texte){
		$body = '
			<html>
				<head>
					<title>'.$this->titre.'</title>
				</head>
				<body text="#000000" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0">'
					.$texte. 		
				'</body>
			</html>';
		return $body;
	}
}

?>
