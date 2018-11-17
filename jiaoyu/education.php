<?php

session_start();

include "../php/allinclude.php";
include ("../php/title.php");
include ("../jiaoyu/jy_include.php");
include ("../register/SchoolForm.php");
include ("../public/jynews/jynews_lists.inc");
include ("../jiaoyu/JYForm.php");
include "../wenyi/WenYiForm.php"; 
include "../wenyi/wy_include.php";

$res = isset($_GET["resource"]) ? $_GET["resource"] : (isset($_POST["resource"]) ? $_POST["resource"] : 0);
$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");
$nindex = isset($_GET["nindex"]) ? $_GET["nindex"] : (isset($_POST["nindex"]) ? $_POST["nindex"] : 0);

if (!$action || $action == "subitem") {
	$item = getActiveTable($JY_TAB, $res);
	$indice = getActiveTableIndice($JY_TAB, $res);
}


?>

<!-- Add jQuery library -->
<script type="text/javascript" src="../javascript/fancy/lib/jquery-1.10.1.min.js"></script>

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="../javascript/fancy/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="../javascript/fancy/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="../javascript/fancy/source/jquery.fancybox.css?v=2.1.5" media="screen" />

<!-- Add Button helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="../javascript/fancy/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
<script type="text/javascript" src="../javascript/fancy/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

<!-- Add Thumbnail helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="../javascript/fancy/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
<script type="text/javascript" src="../javascript/fancy/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<!-- Add Media helper (this is optional) -->
<script type="text/javascript" src="../javascript/fancy/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<!-- oushi fancy function  -->
<script type="text/javascript" src="../javascript/oushi.fancy.js"></script>

<!-- oushi preview pdf function  -->
<script type="text/javascript" src="../javascript/oushi.previewpdf.js"></script>

<BODY>
<div class="content">
<?php include "../php/maintitle.php"; ?>
<div class="left">

<?php if ($action == "schedule") { ?>
	<div class="left_box">
    	<div class="PROG_TIT1"><br>
 			<h1> <?php echo($SCHEDULE_TABLE[$nindex][0]); ?> </h1>
 			<div class=red_line>&nbsp;</div>
     	</div>
     	<br>
    	<div class="box_txt">
<?php 
			switch($nindex) {
				case $SCHEDULE_HUODONG :
?>				
	    	<div class=box_prog>
				<IMG SRC='../photos/oushi/<?php echo($PROGRAM_JPG); ?>' width=640 border=0>
			</div>
			<br><br>
	   		<div class=box_down>
				<h3><IMG SRC='../photos/icon/bull16.png' width=9>&nbsp;
				下载课程安排  Télécharger le Programme : (<A href='../files/<?php echo($PROGRAM_PDF); ?>' target=_blank>点击此处下载</A>) </h3>
			</div>
<?php 				
					break;
				case $ZHONGXIN_HUODONG:
	?>
	    	<div class=box_prog>
				<IMG SRC='../photos/oushi/<?php echo($PROGRAM_JPG2); ?>' width=640 border=0>
			</div>
			<br><br>
	   		<div class=box_down>
				<h3><IMG SRC='../photos/icon/bull16.png' width=9>&nbsp;
				下载课程安排  Télécharger le Programme : (<A href='../files/<?php echo($PROGRAM_PDF2); ?>' target=_blank>点击此处下载</A>) </h3>
			</div>
<?php 				
					break;
					case $SCHEDULE_TIMER :
					showSchoolScheduleTable(); 
					break;
				default :
					showProgramTable($P_PROG_TTILE, $P_PROG_COL, $P_PROG) ;
					showProgramTableNode($P_PROG_NOTE) ;
					break;
			}
?>
		</div>
	</div>
	<div><img src="../images/box_bg.gif"></div>
<?php 
	} else if ($action == "moreworks")  {
?>
	<div class="left_box">
<?php 
   		showStudentWorksList(); 
?>
	</div>
   	<div class=box_bg>&nbsp; </div>		

<?php } else { ?>
	<div class="left_box">
<?php 

if ($res == "teacher") {

$loginok = 0;
$tform = new TeacherForm();
$errmsg = "";

if ($action == "login") {
	$loginuser = $tform->getLogin();
	if ($loginuser) {
		$adminlevel = $loginuser->getLevel();
		if ($adminlevel == 1 || $adminlevel == 4) {
			$loginok = 1;
			$userid =  $loginuser->getID();
			$username = $loginuser->getName();
			$_SESSION['log_user_id'] = $userid;
			$_SESSION['log_user_level'] = $adminlevel;
			$_SESSION['log_user_name'] = $username;
		}
		else {
			
		}
	}
	else {
		$errmsg = $tform->getError();
	}
}
else {	
	$adminlevel = 0;
	if (isset($_SESSION['log_user_level'])) {
		$adminlevel = $_SESSION['log_user_level'];
	}
	if (isset($_SESSION['log_user_id'])) {
		$userid = $_SESSION['log_user_id'];
	}
	if (isset($_SESSION['log_user_name'])) {
		$username = $_SESSION['log_user_name'];
	}
	if ($adminlevel == 1 ||  $adminlevel == 4) { /* TEACHER=1, ADMIN=4 */
		$loginok = 1;
	}
}
			
			
			echo("<div class='PROG_TIT2'>");
			echo("<IMG src='../photos/icon/teacherjiaoliu.png'>");
			echo("<div class=red_line>&nbsp;</div><br></div>");
		    echo("<div class=box_txt2><div class=boxred600>");
			if ($loginok) {
		    	showTeacherJiaoYuInformation();
    		}
    		else {
				echo("<h1>此网页只提供给欧洲时报老师使用</h1>");
				$tform = new TeacherForm();
 				$tform->showLoginForm($errmsg);
				
				//echo("<h1>请联系网站管理员！</h1>");
    		}
			echo("</div></div>");

			
    	}
    	else if ($res == "student") {
			//showJiaoyuStudentItemDetail($item, $nindex); 

			showStudentWorksDetailBase($nindex);
    	}
    	else if ($nindex < $JY_START_ITEM) {
     		showJiaoyuAllItemsDetail($item); 
 	  	}
    	else {
    		showJiaoyuItemDetail($item, $nindex, $indice); 
    	}
    	?>
	</div>
	<div class=box_bg>&nbsp; </div>
<?php } ?>
</div>

<div class="right">
	<?php include "../jiaoyu/educationright.php" ?>    
</div>
</div>
<?php include "../php/foot1.php"; ?>

</body>
</html>
