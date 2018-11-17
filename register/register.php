<?php
include "../php/allinclude.php";
include ("../register/HuoDongForm.php");
include ("../register/SchoolForm.php");
include ("../register/BaomingForm.php");
include ("../register/sendemail.php");
session_start();

$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");
$hdindex = isset($_GET["hdindex"]) ? $_GET["hdindex"] : (isset($_POST["hdindex"]) ? $_POST["hdindex"] : 0);
$activeform = isset($_GET["active"]) ? $_GET["active"] : (isset($_POST["active"]) ? $_POST["active"] : 0);
$registerref = isset($_GET["registerref"]) ? $_GET["registerref"] : (isset($_POST["registerref"]) ? $_POST["registerref"] : "");

$err = '';
$registerok = 0;
$studentform = '';
$student = '';
$huodong = '';

$huodongform = new BaomingForm();

if ($action == "register") {
	if(empty($_REQUEST['reset']))
	{
		$huodong = $huodongform->getRegisterData();
		$err = $huodongform->addNewRegister($huodong);
		if (!$err) {
			$registerok = 1;
		}
	}
}
else if ($action == "changeclass") {
	$huodong = $huodongform->getRegisterData();
}


include ("../php/title.php");
?>
<script type="text/javascript" src="../javascript/frais.js"></script>

<BODY>
<div class="content">
<?php include "../php/maintitle.php"; ?>
<div class="left">
<?php 
if ($action == "programs") { ?>
	<div class="left_box">
    	<div class="PROG_TIT">
 			<h1>欧洲时报中文学校报名时间</h1>
     	</div>

     	<br>
      	<div class="box_txt">
   			<?php listNewSchoolScheduleTable(); ?>
     	</div>
	</div>
   	<div class=box_bg>&nbsp; </div>
<?php 
} else if ($registerok) {
?>
	<div class="left_box">
    	<div class="box_txt">
	    	<div class="PROG_TIT2">
	 			<IMG src="../images/enligne.png">
	 			<div class=red_line>&nbsp; </div>
	     	</div>
			<?php 
			$huodongform->showRegisterResultTable($huodong); 
			//$send = new sendemail();
			//$send->SendRegistedEmail($huodong);
			?>
		</div>
	</div>
<?php 
} else { 
?>
	<div class="left_box">
<?php if (1) { ?>
		<div class="box_txt">
	    	<div class="PROG_TIT2">
	 			<IMG src="../images/enligne.png">
	 			<div class=red_line>&nbsp; </div>
	     	</div>
			<?php $huodongform->showRegisterTable($registerref, $huodong, "register.php", $err); ?>
		</div>
<?php } else { ?>
    	<div class=box_prog>
			<IMG SRC='../photos/oushi/baomingform.jpg' width=640 border=0>
		</div>
		<br>
<?php } ?>
		<div class=box_bg>&nbsp; </div>
		<div class="box_txt">
	    	<div class="PROG_TIT2">
	 			<IMG src="../images/telecharger.png">
	 			<div class=red_line>&nbsp; </div>
	     	</div>
   			<div class=box_down>
			<h2><IMG SRC='../photos/icon/bull16.png' width=9>&nbsp;欧洲时报文化中心报名表 : (<A href='../files/baoming.pdf' target=_blank>点击此处下载</A>) </h2>
			<br>
			<h2><IMG SRC='../photos/icon/bull16.png' width=9>&nbsp;请将填好的报名表：</h2>
			<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
			<TR>
				<TD width=20% class=reg_label>扫描后发送至 : </TD>
				<TD width=80% class=reg_text> <a href="mailto:culture@oushinet.com">culture@oushinet.com</a></TD>
			</TR>
			<TR>
				<TD class=reg_label>或传真到 : </TD>
				<TD class=reg_text> 01 41 24 41 49</TD>
			</TR>
			<TR>
				<TD class=reg_label>或邮寄到 : </TD>
				<TD class=reg_text>ASSOCIATION DES AMIS DE NOUVELLES D’EUROPE</TD>
			</TR>
			<TR>
				<TD class=reg_label></TD>
				<TD class=reg_text>48-50 RUE BENOIT MALON</TD>
			</TR>
			<TR>
				<TD class=reg_label ></TD>
				<TD class=reg_text>94250 GENTILLY</TD>
			</TR>
			</TABLE>
			<br>
			<h2><IMG SRC='../photos/icon/bull16.png' width=9>&nbsp;咨询电话 : 01 41 24 41 40 </h2>
			</div>
		</div>
	</div>
   	<div class=box_bg>&nbsp; </div>
<?php }  ?>
	
</div>

<div class="right">
	<?php include "../php/right.php" ?>    
</div>
</div>
<?php include "../php/foot1.php"; ?>

</body>
</html>

