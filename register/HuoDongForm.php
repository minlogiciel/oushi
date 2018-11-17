<?php
include_once("HuodongClass.php");
class HuoDongForm {

function getHuodongData() {
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
	$hdindex = getPostValue("hdindex");
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


	$huodong = new HuodongClass();
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
function addNewHuodong($huodong)
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

function TableFormTitle($title) {
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
	<TR>
		<TD width=12 height=24 class=registerborder>
			<IMG src="../images/left.gif" height=24 width=12 border=0>
		</TD>
		<TD width=600 class=registerbar>
			<p><?php echo($title); ?></p>
		</TD>
		<TD width=14 height=24 class=registerborder><IMG height=24
			src="../images/right.gif" width=14 border=0>
		</TD>
	</TR>
</TABLE>
<?php
}

function showHuodongTable($hdindex, $huodong, $hdtab, $active) {
	global $HUODONGSUB, $CLASS_TYPE_NAME, $CLASS_TIME_NAME;
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
	$payment = "C";
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
		$parents = $huodong->getParents();
		$chinese = $huodong->getChinese();
		$times = $huodong->getTimes();
		$comments = $huodong->getComments();
	}
	if ($hdindex < 0)
		$n_index = 0;
	else
		$n_index = (int)$hdindex;
	
	$hditem = $hdtab[$n_index];
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=tab_title1 height=25><?php echo($hditem[0]); ?></TD>
</TR>
<TR>
	<TD valign=top class=tab_border>
		<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 >
		<TR>
			<TD class=background>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0	align=center>
				<TR>
					<TD width=100%>
						<FORM action='register.php' method=post>
						<INPUT type=hidden name="hdindex" value="<?php echo($hdindex); ?>"> 
						<INPUT type=hidden name='action' value='register'>
						<TABLE cellSpacing=0 cellPadding=0 width=100% border=0	align=center>
						<TR><TD height=10 colspan=3></TD></TR>
						<TR>
							<TD class=labelright width=40%><?php showmark( ); ?> 中文姓名 : </TD>
							<TD class=labelleft width=60% colspan=2>
								<INPUT class=fields type=text size=50 name="cname" value="<?php echo($cname); ?>"  onclick="active_save();">
							</TD>
						</TR>
						<TR>
							<TD class=labelright height=25>Nom et Prénom :</TD>
							<TD class=labelleft colspan=2>
								<INPUT class=fields type=text size=50 name="fname" value="<?php echo($fname); ?>"  onclick="active_save();">
							</TD>
						</TR>
						<TR>
							<TD class=labelright><?php showmark( ); ?> 性别 (Civilité) :</TD>
							<TD class=labelleft>
						<?php if ($civil == "M") { ?> 
								<INPUT type=radio name="civil" value="M" CHECKED  onclick="active_save();">男 (H) 
						<?php } else { ?>
								<INPUT type=radio name="civil" value="M"  onclick="active_save();">男 (H) 
						<?php } ?>
							</TD>
							<TD class=labelleft>
						<?php if ($civil == "F") { ?> 
								<INPUT type=radio name="civil" value="F" CHECKED  onclick="active_save();">女 (F) 
						<?php } else { ?>
								<INPUT type=radio name="civil" value="F"  onclick="active_save();">女 (F) <?php } ?>
							</TD>
						</TR>
						<TR>
							<TD class=labelright>出生年月 (Date de Naissance) :</TD>
							<TD class=labelleft colspan=2>
								<select name="bday" onclick="active_save();">
									<option value=0>&nbsp;-&nbsp; D &nbsp;-&nbsp;</option>
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
								<select name="bmonth" onclick="active_save();">
									<option value=0>&nbsp;-&nbsp; M &nbsp;-&nbsp;</option>
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
								<select name="byear" onclick="active_save();">
									<option value=0>&nbsp;-&nbsp; Y &nbsp;-&nbsp;</option>
									<?php
										$yy = Date('Y');
										for ($i = $yy; $i >= 1970; $i--) {
											if ($i == $byear) {
												echo ("<option value=". $i ." selected>" .$i . "</option>");
											} else {
												echo ("<option value=". $i .">" .$i . "</option>");
											}
										}
									?>
								</select>
							</TD>
						</TR>
						<TR>
							<TD class=labelright><?php showmark( ); ?> 电话 (Tél) :</TD>
							<TD class=labelleft colspan=2>
								<INPUT class=fields type=text size=50 name="phone" value="<?php echo($phone); ?>" onclick="active_save();">
							</TD>
						</TR>
						<TR>
							<TD class=labelright>手机 (Mobile) :</TD>
							<TD class=labelleft colspan=2>
								<INPUT class=fields type=text size=50 name="mobile" value="<?php echo($mobile); ?>"	onclick="active_save();">
							</TD>
						</TR>
						<TR>
							<TD class=labelright>传真 (FAX) :</TD>
							<TD class=labelleft colspan=2>
								<INPUT class=fields type=text size=50 name="fax" value="<?php echo($fax); ?>" onclick="active_save();">
							</TD>
						</TR>
						<TR>
							<TD class=labelright>E-Mail :</TD>
							<TD class=labelleft colspan=2>
								<INPUT class=fields type=text size=50 name="email" value="<?php echo($email); ?>" onclick="active_save();">
							</TD>
						</TR>
						<TR>
							<TD class=labelright>地址 (Adresse) :</TD>
							<TD class=labelleft colspan=2>
								<INPUT class=fields type=text size=50 name="street" value="<?php echo($street); ?>"	onclick="active_save();">
							</TD>
						</TR>
						<TR>
							<TD class=labelright>城市 (Ville) :</TD>
							<TD class=labelleft colspan=2>
								<INPUT class=fields type=text size=20 name="city" value="<?php echo($city); ?>" onclick="active_save();">
							</TD>
						</TR>
						<TR>
							<TD class=labelright>邮编 (Code Postal) :</TD>
							<TD class=labelleft colspan=2>
								<INPUT size=20 class=fields type=text name="postcode" value="<?php echo($postcode); ?>" onclick="active_save();">
							</TD>
						</TR>
						<TR>
							<TD class=labelright>国家 (Pays) :</TD>
							<TD class=labelleft colspan=2>
								<INPUT class=fields type=text size=20 name="country" value="<?php echo($country); ?>" onclick="active_save();">
							</TD>
						</TR>
				<?php 
					$subs = $HUODONGSUB[$n_index]; 
					$n_subs = count($subs);
					if ($n_index == 0) { /* 中文学校报名 */
				?>
						<TR>
							<TD class=labelright> 报名班级 (Classe) :</TD>
							<TD class=labelleft colspan=2>
								<select name="classes" onclick="active_save();" >
								<option value=0>&nbsp;&nbsp;&nbsp;&nbsp;- - - -&nbsp;&nbsp;&nbsp;&nbsp;</option>
								<?php
									for ($i = 0; $i < count($CLASS_TYPE_NAME); $i++) {
										$name_c = $CLASS_TYPE_NAME[$i]; 
										if ($classes == $name_c) {
											echo ("<option value=". $name_c ." selected>" .$name_c . "</option>");
										} else {
											echo ("<option value=". $name_c .">" .$name_c . "</option>");
										}
									}
								?>
								</select>
							</TD>
						</TR>
						<TR>
							<TD class=labelright> 上课时间 (Temps) :</TD>
							<TD class=labelleft colspan=2>
								<select name="times" onclick="active_save();" >
								<option value=0>&nbsp;&nbsp;&nbsp;&nbsp;- - - -&nbsp;&nbsp;&nbsp;&nbsp;</option>
								<?php
									for ($i = 0; $i < count($CLASS_TIME_NAME); $i++) {
										$name_c = $CLASS_TIME_NAME[$i]; 
										if ($times == $name_c) {
											echo ("<option value=". $name_c ." selected>" .$name_c . "</option>");
										} else {
											echo ("<option value=". $name_c .">" .$name_c . "</option>");
										}
									}
								?>
								</select>
							</TD>
						</TR>
				<?php } else if ($n_index == 1) { /* 夏令营  */
				?>
						<TR>
							<TD class=labelright><?php showmark( ); ?> 选择地区(Destination) :</TD>
							<TD class=labelleft>
						<?php 
							$suj = $subs[0];
							if ($classes == $suj) { ?> 
								<INPUT type=radio name="classes" value="<?php echo($suj); ?>" CHECKED>
						<?php	} else { ?> 
								<INPUT type=radio name="classes" value="<?php echo($suj); ?>"> 
						<?php } echo($suj);	?>
							</TD>
							<TD class=labelleft>
						<?php 
							$suj = $subs[1];
							if ($classes == $suj) { ?> 
								<INPUT type=radio name="classes" value="<?php echo($suj); ?>" CHECKED> 
						<?php  } else { ?> 
								 <INPUT type=radio name="classes" value="<?php echo($suj); ?>"> 
						<?php } echo($suj); ?>
							</TD>
						</TR>
						<TR>
							<TD class=labelright><?php showmark( ); ?> 家长姓名 (Nom de Parent) :</TD>
							<TD class=labelleft colspan=2>
								<INPUT class=fields type=text size=20 name="parents" value="<?php echo($parents); ?>" onclick="active_save();">
							</TD>
						</TR>
						<TR>
							<TD class=labelright> 中文程度  :</TD>
							<TD class=labelleft colspan=2>
								<INPUT class=fields type=text size=20 name="chinese" value="<?php echo($chinese); ?>" onclick="active_save();">
							</TD>
						</TR>
				<?php } else { ?>										
						<TR>
							<TD class=labelright><?php showmark( ); ?> 报名科目 (Sujets) :</TD>
							<TD class=labelleft>
						<?php 
							$suj = $subs[0];
							if ($classes == $suj) { ?> 
								<INPUT type=radio name="classes" value="<?php echo($suj); ?>" CHECKED>
						<?php	} else { ?> 
								<INPUT type=radio name="classes" value="<?php echo($suj); ?>"> 
						<?php } echo($suj);	?>
							</TD>
							<TD class=labelleft>
						<?php 
							$suj = $subs[1];
							if ($classes == $suj) { ?> 
								<INPUT type=radio name="classes" value="<?php echo($suj); ?>" CHECKED> 
						<?php  } else { ?> 
								 <INPUT type=radio name="classes" value="<?php echo($suj); ?>"> 
						<?php } echo($suj); ?>
							</TD>
						</TR>
					<?php } ?>
						<TR>
							<TD class=labelright><?php if ($n_subs > 2) { echo("学费 (Frais) :"); } ?></TD>
							<TD class=labelleft>
							<?php if ($n_subs > 2) { echo($subs[2]); } ?>
							</TD>
							<TD class=labelleft>
							<?php if ($n_subs > 2) { echo($subs[3]); }  ?>
							</TD>
						</TR>
						<TR>
							<TD class=labelright> </TD>
							<TD class=labelleft>
								<?php if ($n_subs > 4) { echo($subs[4]); } ?>
							</TD>
							<TD class=labelleft>
								<?php if ($n_subs > 4) { echo($subs[5]); } ?>
							</TD>
						</TR>
						<TR>
							<TD class=labelright>付款方式 (Paiement)(€) :</TD>
							<TD class=labelleft>
							<?php if ($payment == "M") { ?> 
								<INPUT type=radio name="payment" value="M" CHECKED>现金 (Espece) 
							<?php } else { ?>
								<INPUT type=radio name="payment" value="M">现金 (Espece) 
							<?php } ?>
							</TD>
							<TD class=labelleft>
							<?php if ($payment == "C") { ?> 
								<INPUT type=radio name="payment" value="C" CHECKED>支票 (Chèque) 
							<?php } else { ?>
								<INPUT type=radio name="payment" value="C">支票 (Chèque) 
							<?php } ?>
							</TD>
						</TR>
						<TR>
							<TD class=labelright> 备注 (Comments) :</TD>
							<TD class=labelleft colspan=2>
								<INPUT class=fields type=text size=50 name="comments" value="<?php echo($comments); ?>" onclick="active_save();">
							</TD>
						</TR>
						<TR>
							<TD height=40 colspan=3>
								<font color=orange><b>所有 <?php showmark( ); ?> 必须填写!</b> </font>
							</TD>
						</TR>
						<?php if ($active) { ?>
						<TR>
							<TD colspan=3 class=labelright>
								<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
								<TR>
									<TD height=30 class=formlabel width=50%>
										<div align=right>
											<INPUT class=button type=submit value=' 确认 ' id="savebuttonid" disabled="disabled">
										</div>
									</TD>
									<TD height=30 class=formlabel width=50%>
										<div align=left> &nbsp;&nbsp; 
											<INPUT class=button TYPE='submit' name='reset' VALUE=' 取消 '>
										</div>
									</TD>
								</TR>
								<TR>
									<TD height=15 colspan=2>&nbsp;</TD>
								</TR>
								</TABLE>
							</TD>
						</TR>
						<?php } ?>
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

function showHuodongDespTable($hdindex) {
	global $HUODONGDESP;
	$nb = count($HUODONGDESP);
	if ($hdindex < 0)
		$hdindex = 0; 
	if ($nb > $hdindex) {
		$items = $HUODONGDESP[$hdindex];
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD width=100%>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR><TD height=10 colspan=2></TD> </TR>
<?php for ($i = 0; $i < count($items); $i++) {
		$item = $items[$i];
	?>
		<TR>
			<TD class=labelright width=20% valign=top>
				<?php echo($item[0]); ?> :
			</TD>
			<TD class=labelleft width=80%  valign=top>
				<font color=navy><?php echo($item[1]); ?></font>
			</TD>
		</TR>
		<?php for ($j = 2; $j < count($item); $j++) { ?>
		<TR>
			<TD class=labelright valign=top>
			</TD>
			<TD class=labelleft valign=top>
				<font color=navy><?php echo($item[$j]); ?></font>
			</TD>
		</TR>
		<?php } ?>		
		<TR><TD height=10 colspan=2></TD> </TR>
<?php } ?>
		</TABLE>
	</TD>
</TR>
</TABLE>
<?php
	}
}
		
function showHuodongResultTable($hdindex, $huodong, $hdtab) {
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

	$hditem = $hdtab[$hdindex];
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
<TR>
	<TD>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
			<TR>
				<TD width=12 height=24 class=registerborder>
					<IMG src="../images/left.gif" height=24 width=12 border=0>
				</TD>
				<TD width=600 class=registerbar>
					<p><?php echo($hditem[0]); ?></p>
				</TD>
				<TD width=14 height=24 class=registerborder>
					<IMG height=24 src="../images/right.gif" width=14 border=0>
				</TD>
			</TR>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD valign=top>
		<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 class=registerborder>
		<TR>
			<TD class=background>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0	align=center>
				<TR><TD height=10 colspan=3></TD></TR>
				<TR>
					<TD class=reg_label width=40%>
						<?php showmark( ); ?> 中文姓名 :
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
					<TD class=reg_label><?php showmark( ); ?> 性别 (Civilité) :</TD>
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
		<?php 
			if ($hdindex == 0) { /* 中文学校报名 */
		?>
				<TR>
					<TD class=reg_label> 报名班级 (Classe) :</TD>
					<TD class=reg_text colspan=2>
						<?php echo($classes); ?>
					</TD>
				</TR>
				<TR>
					<TD class=reg_label> 上课时间 (Temps) :</TD>
					<TD class=reg_text colspan=2>
						<?php echo($times); ?>
					</TD>
				</TR>
		<?php } else if ($hdindex == 1) { /* 夏令营  */
		?>
				<TR>
					<TD class=reg_label><?php showmark( ); ?> 报名选择 (Sujets) :</TD>
					<TD class=reg_text colspan=2>
						<?php echo($classes); ?>
					</TD>
				</TR>
				<TR>
					<TD class=reg_label><?php showmark( ); ?> 家长姓名 (Nom de Parent) :</TD>
					<TD class=reg_text colspan=2>
						<?php echo($parents); ?>
					</TD>
				</TR>
				<TR>
					<TD class=reg_label> 中文程度  :</TD>
					<TD class=reg_text colspan=2>
						<?php echo($chinese); ?>
					</TD>
				</TR>
		<?php } else { ?>										
				<TR>
					<TD class=reg_label> 报名科目 (Sujets) :</TD>
					<TD class=reg_text>
						<?php echo($classes); ?>
					</TD>
				</TR>
		<?php } ?>
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
					<TD class=labelright height=30 colspan=3></TD>
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
