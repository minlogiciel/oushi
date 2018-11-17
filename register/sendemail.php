<?php
class sendemail {

	var $titre = "欧洲时报文化中心新注册成员";	
	var $texte = '';	 				
	var $oushi_email = "mdai@sefas.com";	
	var $dest_email = "daimin08@gmail.com";	
	var $priority = 1;						
	
	function SendRegistedEmail($huodong){
		$texte = '';	
 		if ($huodong) {
			$title = $huodong->getClasses();
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: oushi <' .$this->oushi_email. '>' ."\r\n";
			$headers .= 'Reply-To: oushi <' .$this->oushi_email. '>' ."\r\n";
			$headers .= "X-Priority: ".$this->priority;
 			
			$texte = $this->body($huodong);
			mail($this->dest_email, $title, $texte, $headers);
		}
	}

	function body($huodong){
		$body  = "<html><head><title>".$this->titre."</title></head>";
		$body .= "<body text='#000000'>";
		$body .= "<table>";
		$body .= "<TR><TD>".$huodong->getClasses()."</TD></TR>";
		$body .= "<TR><TD>".$huodong->getTimes()."</TD></TR>";
		$body .= "<TR><TD>".$huodong->getChinaName()."</TD></TR>";
		$body .= "<TR><TD>".$huodong->getPhone()."</TD></TR>";
		$body .= "<TR><TD>".$huodong->getMobile()."</TD></TR>";
		$body .= "</table>";
		$body .= "</body></html>";
		return $body;
	}
}

?>
