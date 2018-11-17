<?php
include ("rootvar.php");
include ($FDOC_PATH."/php/allinclude.php");
include ($FDOC_PATH."/content_include.inc");
include_once ($DOC_PATH."/database/sql/sql_include.php");
include ($FDOC_PATH."/register/BaomingForm.php");

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

include ($FDOC_PATH."/php/title.php");
?>
<script type="text/javascript" src="../javascript/frais.js"></script>

<BODY>
<div class="content">
<?php include ($FDOC_PATH."/php/maintitle.php"); ?>
<div class="left">
<?php 
if ($registerok) {
?>
	<div class="left_box">
    	<div class="box_txt">
	    	<div class="PROG_TIT1">
	 			<h1>Inscription en ligne</h1>
	 			<div class=red_line>&nbsp; </div>
	     	</div>
			<?php $huodongform->showRegisterResultTable($huodong); ?>
		</div>
	</div>
<?php 
} else { 
?>
	<div class="left_box">
		<div class="box_txt">
	    	<div class="PROG_TIT1">
	 			<h1>Inscription en ligne</h1>
	 			<div class=red_line>&nbsp; </div>
	     	</div>
			<?php $huodongform->showRegisterTable($registerref, $huodong, "../french/register.php", $err); ?>
		</div>
		<div class=box_bg>&nbsp; </div>
		<div class="box_txt">
	    	<div class="PROG_TIT1">
	 			<h1>Télécharger les formulaires</h1>
	 			<div class=red_line>&nbsp; </div>
	     	</div>
   			<div class=box_down>
			<h2><IMG SRC='<?php echo($PHOTO_PATH."icon/bull16.png"); ?>' width=9>&nbsp;Centre culture formulaire : (<A href='<?php echo($HOST_URL."/files/baoming.pdf"); ?>' target=_blank>Clique ici</A>) </h2>
			<br>
			<h2><IMG SRC='<?php echo($PHOTO_PATH."icon/bull16.png"); ?>' width=9>&nbsp;Envoyer les formulaires ：</h2>
			<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
			<TR>
				<TD width=20% class=reg_label>Par Email : </TD>
				<TD width=80% class=reg_text> <a href="mailto:culture@oushinet.com">culture@oushinet.com</a></TD>
			</TR>
			<TR>
				<TD class=reg_label>Par Fax : </TD>
				<TD class=reg_text> 01 41 24 41 49</TD>
			</TR>
			<TR>
				<TD class=reg_label>Par Mail : </TD>
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
			<h2><IMG SRC='../photos/icon/bull16.png' width=9>&nbsp;Information : 01 41 24 41 40 </h2>
			</div>
		</div>
	</div>
   	<div class=box_bg>&nbsp; </div>
<?php }  ?>
	
</div>

<div class="right">
	<?php include ($FDOC_PATH."/home/homeright.php") ; ?>
</div>
</div>
<?php include ($FDOC_PATH."/php/foot.php"); ?>

</body>
</html>

