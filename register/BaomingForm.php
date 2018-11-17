<?php
include_once("HuodongClass.php");
class BaomingForm {

function getRegisterData() {
	global $SHUQICLASS, $PERSONINFOS;
	$memberid = getPostValue("memberid");
	$civil = getPostValue("civil");
	$cname = getPostValue("cname");
	$fname = getPostValue("fname");
	$street = getPostValue("street");
	$city = getPostValue("city");
	$postcode = getPostValue("postcode");
	$country = getPostValue("country");
	$phone = getPostValue("phone");
	$mobile = getPostValue("mobile");
	$fax = getPostValue("fax");
	$email = getPostValue("email");
	
	$chinese = getPostValue("chinese");
	$parents = getPostValue("parents");
	$hdindex = getPostValue("registerref");
	$bday = getPostValue("bday");
	$bmonth = getPostValue("bmonth");
	$byear = getPostValue("byear");
	if ($byear == 0 || $bmonth == 0 || $bday == 0) {
		$birthday = "";
	}
	else {
		$birthday = $bmonth. "/" .$bday. "/" .$byear;
	}

	$classes = getPostValue("classes");
	$times = getPostValue("times");
	$payment = getPostValue("payment");
	$comments = getPostValue("comments");
	
	if (strstr($hdindex, "shuqi")) {
		$classes = "";
		$ncls = 0;
		for ($i = 0; $i < count($SHUQICLASS); $i++) {
			$str = getPostValue("option_".$i);
			if ($str && $str != "NON") {
				if ($ncls < 2) {
					$classes .= $str.";";
				}
				$ncls++;
			}	
		}
	}
	else if (strstr($hdindex, "summer")) {
		$comments = "";
		for ($i = 0; $i < count($PERSONINFOS); $i++) {
			$str = getPostValue("person_".$i);
			$comments .= $str.";";
		}
	}
	


	$huodong = new HuodongClass();
	if ($memberid > 0) {
		$huodong->getHuodong($memberid);
	}
	$huodong->setTrace("");

	$huodong->setCivil($civil);
	$huodong->setChinaName($cname);
	$huodong->setEnglishName($fname);
	$huodong->setBirthDay($birthday);
	$huodong->setPhone($phone);
	$huodong->setMobile($mobile);
	$huodong->setFax($fax);
	$huodong->setEmail($email);
	$huodong->setStreet($street);
	$huodong->setCity($city);
	$huodong->setPostCode($postcode);
	$huodong->setCountry($country);

	$huodong->setClasses($classes);
	$huodong->setTimes($times);
	$huodong->setPayment($payment);
	$huodong->setChinese($chinese);
	$huodong->setParents($parents);
	$huodong->setHDIndex($hdindex);
	
	$huodong->setComments($comments);
	$huodong->setDeleted(0);
	return $huodong;
}

/*********   add register ****************/
function addNewRegister($huodong)
{
	$err = "";

	if ($huodong->isOK()) {
		$huodong->addHuodong();
	}
	else  {
		$err = $huodong->getTrace();
	}
	return $err;
}

function showRegisterTable($ref, $huodong, $url, $err) {
	global $REGISTER_TAB, $CLASS_COURS_CHINOIS, $HDBM_TYPE, $SHUQICLASS, $PERSONINFOS;

	
	$temps = array("星期三", "星期四", "星期五", "星期六", "星期日");
	$issummer = 0;
	$isshuqiclass = 0;
	if (strstr($ref,"chinois")) { 
		$reg_tab = $CLASS_COURS_CHINOIS;
		$ref_base = "chinois";
	} else { 
		if (strstr($ref,"shuqi")) {  
			$isshuqiclass = 1;
		} else if (strstr($ref,"summer")) {  
			$issummer = 1;
		}
		$reg_tab = $REGISTER_TAB;
		$ref_base = $ref;
	}
	
	$civil = 'F';
	$cname = "";
	$fname = "";
	$email = "";
	$street = "";
	$city = "";
	$postcode = "";
	$country = "France";
	$phone = "";
	$mobile = "";
	$fax = "";
	$subs=array("","");
	$bmonth = 0;
	$bday = 0;
	$byear = 0;

	$classes = "";
	$cls1 = $classes;
	$cls2 = $classes;
	$times = "";
	$payment = "C";
	$comments = "";
	$parents = "";
	$chinese = "";
	$n_subs ="";
	$memberid = 0;
	$perinfos = array(" ", " ", "  ", "  ", " ", "  ", "  ", "  ");
	$frais = array(" - ", " - ", " - ", " - ");
	if ($huodong) {
		$memberid = $huodong->getID();
		$civil = $huodong->getCivil();
		$cname = $huodong->getChinaName();
		$fname = $huodong->getEnglishName();

		$street = $huodong->getStreet();
		$city  = $huodong->getCity();
		$postcode = $huodong->getPostCode();
		$country = $huodong->getCountry();
		$phone = $huodong->getPhone();
		$mobile = $huodong->getMobile();
		$fax = $huodong->getFax();
		$email = $huodong->getEmail();
			
		$birthday = $huodong->getBirthDay();
		if ($birthday && strstr($birthday,"/") && strlen($birthday) > 6) {
			list($bmonth, $bday, $byear) = explode("/", trim($birthday));
		}
		$payment = $huodong->getPayment();
		$classes = $huodong->getClasses();
		$parents = $huodong->getParents();
		$chinese = $huodong->getChinese();
		$times = $huodong->getTimes();
		$comments = $huodong->getComments();
		if ($issummer && strstr($comments, ";")) {
			$perinfos = explode(";", trim($comments));
		}
		if ($isshuqiclass && strstr($classes, ";")) {
			list($cls1, $cls2) = explode(";", trim($classes));
		}
	}
	
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD valign=top class=tab_border>
		<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 >
		<TR>
			<TD class=background>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0	align=center>
				<TR>
					<TD width=100%>
						<FORM action='<?php echo($url); ?>' method=post>
						<INPUT type=hidden name="registerref" value="<?php echo($ref_base); ?>"> 
						<INPUT type=hidden name='mtype' value='<?php echo($HDBM_TYPE); ?>'>
						<INPUT type=hidden name='memberid' value='<?php echo($memberid); ?>'>
						<INPUT type=hidden name='action' value='register'>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0	align=center>
						<TR><TD colspan=3 class=error height=30><?php echo($err); ?></TD></TR>
						<TR>
							<TD class=reg_label><?php showmark( ); ?>活动名称 (Activité) :</TD>
							<TD class=reg_text colspan=2>
					<?php  
					?>
							<select class=suj_select name="classessss" onChange='window.location="<?php echo($url); ?>?mtype=<?php echo($HDBM_TYPE); ?>&memberid=<?php echo($memberid); ?>&action=changeclass&registerref=" + this.value;'>
								<option value=0>&nbsp;- - -&nbsp;</option>
						<?php
								$cls = "";
								for ($i = 0; $i < count($reg_tab); $i++) {
									$item =  $reg_tab[$i];
									for ($j = 3; $j < count($item); $j++) {
										$sitem =  $item[$j];
										if ($sitem[2] == 1) {
											if ($ref == $sitem[1]) {
												if (count($sitem) > 3) {
													$temps = $sitem[3];
													$cls = $sitem[0];
												}
												if (count($sitem) > 4) {
													$frais = $sitem[4];
												}
												echo ("<option  value=".$sitem[1]." selected>" .$sitem[0]. "</option>");
											} else {
												echo ("<option value=".$sitem[1].">" .$sitem[0]. "</option>");
											}
										}
										else {
											$vname = $sitem[0]."(已结束)";
											echo ("<option value=".$sitem[1]." disabled>" .$sitem[0]. "</option>");
										}
										
									}
								}
						?>
							</select> 
							<INPUT type=hidden name='classes' value='<?php echo($cls); ?>'>
							</TD>
						</TR>
						
						<?php  if ($isshuqiclass)  { $nbc = count($SHUQICLASS); $n = 0; ?>
						<TR>
							<TD class=reg_label valign=top>
						<?php 
								if ($nbc == 2) {
									echo ($SHUQICLASS[0][0]."<br>". $SHUQICLASS[1][0]); 
								}
								else {
									showmark( ); echo ("可选两项 :"); 
								}
						?>
							</TD>
							<TD class=reg_text colspan=2>
						<?php 	
							if ($nbc == 2 ) {
								for ($n = 0; $n < 2; $n++) {
									$elem = $SHUQICLASS[$n];
									for ($ii = 1; $ii < count($elem); $ii++) {
										$ccc = $elem[$ii];
										if ($ccc == $cls1 || $ccc == $cls2 ) {
											echo ("<input type='radio' name='option_".$n."' value='".$ccc."' checked>" .$ccc."&nbsp;");
										}
										else {
											echo ("<input type='radio' name='option_".$n."' value='".$ccc."'>" .$ccc."&nbsp;&nbsp;");				
										}
									}
									echo ("<input type='radio' name='option_".$n."' value='NON'>NON<br>");				
								}							
							}
							else {
								echo("<TABLE cellSpacing=0 cellPadding=0 width=100% border=0	align=center>");
								while($n< $nbc) {
									echo("<TR><TD class=reg_text>");
									if ($SHUQICLASS[$n] == $cls1 || $SHUQICLASS[$n] == $cls2 ) {
										echo ("<input type='checkbox' name='option_".$n."' value='".$SHUQICLASS[$n]."' checked>" .$SHUQICLASS[$n]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
									}
									else {
										echo ("<input type='checkbox' name='option_".$n."' value='".$SHUQICLASS[$n]."'>" .$SHUQICLASS[$n]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");				
									}
									$n++;
									echo("</TD><TD class=reg_text>");
									if ($n < $nbc) {
										if ($SHUQICLASS[$n] == $cls1 || $SHUQICLASS[$n] == $cls2 ) {
											echo ("<input type='checkbox' name='option_".$n."' value='".$SHUQICLASS[$n]."' checked>" .$SHUQICLASS[$n]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
										}
										else {
											echo ("<input type='checkbox' name='option_".$n."' value='".$SHUQICLASS[$n]."'>" .$SHUQICLASS[$n]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");				
										}
									}
									echo ("</TD></TR>");
									$n++;
								}
								echo("</TABLE>");
							}
						?>				
							</TD>
						</TR>
						<?php } ?>
						<TR>
							<TD class=reg_label><?php showmark( ); ?>活动时间 (Horaires) :</TD>
							<TD class=reg_text colspan=2>
								<select name="times" class=suj_select onChange='javascript:setFrais(this);' >
						<?php 	if (count($temps) == 0) { ?>
									<option value=0>&nbsp;- - -&nbsp;</option>
						<?php	} else {
								if (count($temps) > 2 && is_array($temps[2])) {
									for ($i = 2; $i < count($temps); $i++) {
										$tt = $temps[$i];
										if (is_numeric($tt[0])) {
											$tweek = getWeekday($tt[0]).":";
											$tstart = 1;
										}
										else {
											$tweek = "";
											$tstart = 0;
										}
										for ($j = $tstart; $j < count($tt); $j++) {
											$tname = $tweek.$tt[$j];
											if ($times == $tname) {
												echo ("<option value='". $tname ."' selected>" .$tname. "</option>");
											} else {
												echo ("<option value='". $tname ."'>" .$tname. "</option>");
											}
										}
									}
								}
								else 
									for ($i = 0; $i < count($temps); $i++) {
										if ($times == $temps[$i]) {
											echo ("<option value='". $temps[$i] ."' selected>" .$temps[$i]. "</option>");
										} else {
											echo ("<option value='". $temps[$i] ."'>" .$temps[$i]. "</option>");
										}
									}
								}
						?>
							</select> 
							</TD>
						</TR>

						<TR>
							<TD class=reg_label width=40%><?php showmark( ); ?> 中文姓名 : </TD>
							<TD class=reg_text width=60% colspan=2>
								<INPUT class=fields type=text size=50 name="cname" value="<?php echo($cname); ?>"  onclick="active_save();">
							</TD>
						</TR>
						<TR>
							<TD class=reg_label height=25>Nom et Prénom :</TD>
							<TD class=reg_text colspan=2>
								<INPUT class=fields type=text size=50 name="fname" value="<?php echo($fname); ?>"  onclick="active_save();">
							</TD>
						</TR>
						<TR>
							<TD class=reg_label><?php showmark( ); ?> 性别 (Civilité) :</TD>
							<TD class=reg_text width=25%>&nbsp;&nbsp;&nbsp;&nbsp;
						<?php if ($civil == "M") { ?> 
								<INPUT type=radio name="civil" value="M" CHECKED  onclick="active_save();">男 (H) 
						<?php } else { ?>
								<INPUT type=radio name="civil" value="M"  onclick="active_save();">男 (H) 
						<?php } ?>
							</TD>
							<TD class=reg_text>
						<?php if ($civil == "F") { ?> 
								<INPUT type=radio name="civil" value="F" CHECKED  onclick="active_save();">女 (F) 
						<?php } else { ?>
								<INPUT type=radio name="civil" value="F"  onclick="active_save();">女 (F) <?php } ?>
							</TD>
						</TR>
						<TR>
							<TD class=reg_label>
							<?php if (shouldInputBirthday($ref)) {	showmark( ); } ?> 出生日期 (Date de Naissance) :</TD>
							<TD class=reg_text colspan=2>
								<select name="byear" class=date_select >
									<option value=0>&nbsp;-&nbsp; 年 &nbsp;-&nbsp;</option>
									<?php
										$yy = Date('Y')-5;
										for ($i = $yy; $i >= 1930; $i--) {
											if ($i == $byear) {
												echo ("<option value=". $i ." selected>" .$i . "</option>");
											} else {
												echo ("<option value=". $i .">" .$i . "</option>");
											}
										}
									?>
								</select>
								<select name="bmonth" class=date_select >
									<option value=0>&nbsp;-&nbsp; 月 &nbsp;-&nbsp;</option>
									<?php
										for ($i = 1; $i < 13; $i++) {
											if ($i == $bmonth) {
												echo ("<option value=". $i ." selected>" .$i . "</option>");
											} else {
												echo ("<option value=". $i .">" .$i . "</option>");
											}
										}
									?>
								</select> 
								<select name="bday" class=date_select >
									<option value=0>&nbsp;-&nbsp; 日 &nbsp;-&nbsp;</option>
									<?php
									for ($i = 1; $i < 32; $i++) {
										if ($i == $bday) {
											echo ("<option value=". $i ." selected>" .$i . "</option>");
										} else {
											echo ("<option value=". $i .">" .$i . "</option>");
										}
									}
									?>
								</select> 
							</TD>
						</TR>
					<?php if ($issummer) { ?>
						<TR>
							<TD class=reg_label> 中文程度  :</TD>
							<TD class=reg_text colspan=2>
								<INPUT class=fields type=text size=50 name="chinese" value="<?php echo($chinese); ?>" onclick="active_save();">
							</TD>
						</TR>
				<?php for ($i = 0; $i < count($PERSONINFOS); $i+=2) { ?>
						<TR>
							<TD class=reg_label> <?php $n=$i; echo($PERSONINFOS[$n]); ?> :</TD>
							<TD class=reg_text colspan=2>
								<INPUT class=fields type=text size=15 name="person_<?php echo($n); ?>" value="<?php echo($perinfos[$n]); ?>">
								<?php $n=$i+1; echo($PERSONINFOS[$n]); ?> : <INPUT class=fields type=text size=18 name="person_<?php echo($n); ?>" value="<?php echo($perinfos[$n]); ?>" >
							</TD>
						</TR>
				<?php } ?>
						<TR>
							<TD class=reg_label><?php showmark( ); ?> 家长姓名 (Nom de Parent) :</TD>
							<TD class=reg_text colspan=2>
								<INPUT class=fields type=text size=50 name="parents" value="<?php echo($parents); ?>" onclick="active_save();">
							</TD>
						</TR>
					<?php } ?>
						<TR>
							<TD class=reg_label><?php showmark( ); ?> 电话 (Tél) :</TD>
							<TD class=reg_text colspan=2>
								<INPUT class=fields type=text size=50 name="phone" value="<?php echo($phone); ?>" onclick="active_save();">
							</TD>
						</TR>
						<TR>
							<TD class=reg_label><?php showmark( ); ?> 手机 (Mobile) :</TD>
							<TD class=reg_text colspan=2>
								<INPUT class=fields type=text size=50 name="mobile" value="<?php echo($mobile); ?>"	onclick="active_save();">
							</TD>
						</TR>
						<TR>
							<TD class=reg_label>传真 (FAX) :</TD>
							<TD class=reg_text colspan=2>
								<INPUT class=fields type=text size=50 name="fax" value="<?php echo($fax); ?>" onclick="active_save();">
							</TD>
						</TR>
						<TR>
							<TD class=reg_label><?php showmark( ); ?> E-Mail :</TD>
							<TD class=reg_text colspan=2>
								<INPUT class=fields type=text size=50 name="email" value="<?php echo($email); ?>" onclick="active_save();">
							</TD>
						</TR>
						<TR>
							<TD class=reg_label><?php showmark( ); ?> 地址 (Adresse) :</TD>
							<TD class=reg_text colspan=2>
								<INPUT class=fields type=text size=50 name="street" value="<?php echo($street); ?>"	onclick="active_save();">
							</TD>
						</TR>
						<TR>
							<TD class=reg_label><?php showmark( ); ?> 城市 (Ville) :</TD>
							<TD class=reg_text colspan=2>
								<INPUT class=fields type=text size=50 name="city" value="<?php echo($city); ?>" onclick="active_save();">
							</TD>
						</TR>
						<TR>
							<TD class=reg_label><?php showmark( ); ?> 邮编 (Code Postal) :</TD>
							<TD class=reg_text colspan=2>
								<INPUT size=50 class=fields type=text name="postcode" value="<?php echo($postcode); ?>" onclick="active_save();">
								<INPUT type=hidden  name="country" value="<?php echo($country); ?>">
							</TD>
						</TR>
						<TR>
							<TD class=reg_label>费用 (Frais) (€) : 
								<?php 	
									$str = $frais[0];
									for ($m = 1; $m < count($frais); $m++) {
										$str .=  ";" .$frais[$m];
									}
								?>
								<INPUT type=hidden name='fraisselect' id="fraisselect" value="<?php echo($str); ?>">
							</TD>
							<TD class=reg_text colspan=2 id="fraisid"><?php echo($frais[0]); ?>
							</TD>
						</TR>
						<TR>
							<TD class=reg_label>付款方式 (Paiement ) :</TD>
							<TD class=reg_text>&nbsp;&nbsp;&nbsp;&nbsp;
							<?php if ($payment == "M") { ?> 
								<INPUT type=radio name="payment" value="M" CHECKED>现金 (Espece) 
							<?php } else { ?>
								<INPUT type=radio name="payment" value="M">现金 (Espece) 
							<?php } ?>
							</TD>
							<TD class=reg_text>
							<?php if ($payment == "C") { ?> 
								<INPUT type=radio name="payment" value="C" CHECKED>支票 (Chèque) 
							<?php } else { ?>
								<INPUT type=radio name="payment" value="C">支票 (Chèque) 
							<?php } ?>
							</TD>
						</TR>
					<?php if ($issummer == 0) { ?>
						<TR>
							<TD class=reg_label> 备注 (Infos complémentaires) :</TD>
							<TD class=reg_text colspan=2>
								<INPUT class=fields type=text size=50 name="comments" value="<?php echo($comments); ?>" onclick="active_save();">
							</TD>
						</TR>
					<?php } ?>
						<TR><TD  colspan=3 height=20>&nbsp;</TD></TR>
						<TR>
							<TD  colspan=3>
								<?php if ($issummer) { $this->showSummerDespTable(); }	?>
							</TD>
						</TR>
						<TR>
							<TD  colspan=3>
								<?php  $this->showRegisterDespTable($ref); ?>
							</TD>
						</TR>
						<TR>
							<TD colspan=3 >
								<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
								<TR><TD height=20 colspan=2>&nbsp;</TD></TR>
								<TR>
									<TD class=reg_label width=50%v>
										<INPUT class=button type=submit value=' 确认 ' id="savebuttonid" >
									</TD>
									<TD class=reg_text width=50%>
										<INPUT class=button TYPE='submit' name='reset' VALUE=' 取消 '>
									</TD>
								</TR>
								<TR><TD height=20 colspan=2>&nbsp;</TD></TR>
								</TABLE>
							</TD>
						</TR>
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

function showSummerDespTable() {
	global $DESPSUMMER;
	$items = $DESPSUMMER;
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD width=100%>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR><TD height=10 colspan=2></TD> </TR>
<?php 
	for ($i = 0; $i < count($items); $i++) {
		$item = $items[$i];
?>
		<TR>
			<TD class=reg_text width=30% valign=top>
				<div align=right><?php echo($item[0]); ?></div>
			</TD>
			<TD class=reg_text width=70% valign=top>
				<font color=#333><?php echo($item[1]); ?></font>
			</TD>
		</TR>
		<?php for ($j = 2; $j < count($item); $j++) { ?>
		<TR>
			<TD class=reg_text>
			</TD>
			<TD class=reg_text >
				<font color=#333><?php echo($item[$j]); ?></font>
			</TD>
		</TR>
		<?php } ?>		
<?php } ?>
		</TABLE>
	</TD>
</TR>
</TABLE>

<?php
}

function showRegisterDespTable($registerref) {
	global $REGISTER_DESP;
	$items = $REGISTER_DESP;
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD width=100%>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR><TD height=10 colspan=2></TD> </TR>
<?php 
	for ($i = 0; $i < count($items); $i++) {
		$item = $items[$i];
?>
		<TR>
			<TD class=reg_text width=30% valign=top>
				<div align=right><?php echo($item[0]); ?></div>
			</TD>
			<TD class=reg_text width=70% valign=top>
				<font color=#333><?php echo($item[1]); ?></font>
			</TD>
		</TR>
		<?php for ($j = 2; $j < count($item); $j++) { ?>
		<TR>
			<TD class=reg_text>
			</TD>
			<TD class=reg_text >
				<font color=#333><?php echo($item[$j]); ?></font>
			</TD>
		</TR>
		<?php } ?>		
<?php } ?>
		</TABLE>
	</TD>
</TR>
</TABLE>
<?php

}

function showRegisterResultTable($huodong) {
	$civil = 'F';
	$cname = "";
	$fname = "";
	$email = "";
	$street = "";
	$city = "";
	$postcode = "";
	$country = "France";
	$phone = "";
	$mobile = "";
	$fax = "";

	$bmonth = 0;
	$bday = 0;
	$byear = 0;

	$classes = "";
	$times = "";
	$payment = "";
	$comments = "";
	$parents = "";
	$chinese = "";
	if ($huodong) {
		$civil = $huodong->getCivil();
		$cname = $huodong->getChinaName();
		$fname = $huodong->getEnglishName();

		$street = $huodong->getStreet();
		$city  = $huodong->getCity();
		$postcode = $huodong->getPostCode();
		$country = $huodong->getCountry();
		$phone = $huodong->getPhone();
		$mobile = $huodong->getMobile();
		$fax = $huodong->getFax();
		$email = $huodong->getEmail();
			
		$birthday = $huodong->getBirthDay();
		if ($birthday && strstr($birthday,"/") && strlen($birthday) > 6) {
			list($bmonth, $bday, $byear) = explode("/", trim($birthday));
		}
			
			
		$payment = $huodong->getPayment();
		$classes = $huodong->getClasses();
		$times = $huodong->getTimes();
		$comments = $huodong->getComments();
		$parents = $huodong->getParents();
		$chinese = $huodong->getChinese();
	}
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
<TR>
	<TD valign=top>
		<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 class=registerborder>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0	align=center>
				<TR><TD height=10 colspan=3></TD></TR>
				<TR>
					<TD class=reg_label> 活动名称 (Activité) :</TD>
					<TD class=reg_text>
						<?php echo($classes); ?>
					</TD>
				</TR>
				<TR>
					<TD class=reg_label> 活动时间 (Horaires) :</TD>
					<TD class=reg_text>
						<?php echo($times); ?>
					</TD>
				</TR>
				<TR>
					<TD class=reg_label width=40%>
						中文姓名 :
					</TD>
					<TD class=reg_text width=60% colspan=2>
						<?php echo($cname); ?>
					</TD>
				</TR>
				<TR>
					<TD class=reg_label>Nom et Prénom :</TD>
					<TD class=reg_text colspan=2>
						<?php echo($fname); ?>
					</TD>
				</TR>
				<TR>
					<TD class=reg_label> 性别 (Civilité) :</TD>
					<TD class=reg_text colspan=2>
				<?php if ($civil == "M") { ?> 
						男 (H) 
				<?php } else { ?>
						女 (F) 
				<?php } ?>
					</TD>
				</TR>
				<TR>
					<TD class=reg_label>出生年月 (Date de Naissance) :</TD>
					<TD class=reg_text colspan=2>
						<?php
							if ($bday) {
								echo ($bday."/");
							}
							if ($bmonth) {
								echo ($bmonth."/");
							}
							echo ($byear);
						?>
					</TD>
				</TR>
				<TR>
					<TD class=reg_label>电话 (Tél) :</TD>
					<TD class=reg_text colspan=2>
						<?php echo($phone); ?>
					</TD>
				</TR>
				<TR>
					<TD class=reg_label>手机 (Mobile) :</TD>
					<TD class=reg_text colspan=2>
						<?php echo($mobile); ?>
					</TD>
				</TR>
				<TR>
					<TD class=reg_label>传真 (FAX) :</TD>
					<TD class=reg_text colspan=2>
						<?php echo($fax); ?>
					</TD>
				</TR>
				<TR>
					<TD class=reg_label>E-Mail :</TD>
					<TD class=reg_text colspan=2>
						<?php echo($email); ?>
					</TD>
				</TR>
				<TR>
					<TD class=reg_label>地址 (Adresse) :</TD>
					<TD class=reg_text colspan=2>
						<?php echo($street); ?>
					</TD>
				</TR>
				<TR>
					<TD class=reg_label>城市 (Ville) :</TD>
					<TD class=reg_text colspan=2>
						<?php echo($city); ?>
					</TD>
				</TR>
				<TR>
					<TD class=reg_label>邮编 (Code Postal) :</TD>
					<TD class=reg_text colspan=2>
						<?php echo($postcode); ?>
					</TD>
				</TR>
				<TR>
					<TD class=reg_label>国家 (Paye) :</TD>
					<TD class=reg_text colspan=2>	
						<?php echo($country); ?>
					</TD>
				</TR>
				<TR>
					<TD class=reg_label>付款方式 (Paiement) 	(€) :</TD>
					<TD class=reg_text colspan=2>
						<?php if ($payment == "M") { ?> 
							现金 (Espece)
						<?php } else { ?>
							支票 (Chèque)
						<?php } ?>
					</TD>
				</TR>
				<TR>
					<TD class=reg_label> 备注 (Comments) :</TD>
					<TD class=reg_text colspan=2>
						<?php echo($comments); ?>
					</TD>
				</TR>
				<TR>
					<TD class=reg_label height=30 colspan=3></TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD width=100%>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR><TD height=10 colspan=2></TD> </TR>
<?php 
	global $REGISTER_RESU;
	$items = $REGISTER_RESU;

	for ($i = 0; $i < count($items); $i++) {
		$item = $items[$i];
?>
		<TR>
			<TD class=reg_text width=30% valign=top>
				<div align=right><?php echo($item[0]); ?></div>
			</TD>
			<TD class=reg_text width=70%  valign=top>
				<font color=#333><?php echo($item[1]); ?></font>
			</TD>
		</TR>
		<?php for ($j = 2; $j < count($item); $j++) { ?>
		<TR>
			<TD class=reg_text valign=top>
			</TD>
			<TD class=reg_text valign=top>
				<font color=#333><?php echo($item[$j]); ?></font>
			</TD>
		</TR>
		<?php } ?>		
<?php } ?>
		</TABLE>
	</TD>
</TR>


</TABLE>

<?php
}



}
?>
