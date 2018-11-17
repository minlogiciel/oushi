<?php
include ("rootvar.php");

$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");
$nindex = isset($_GET["nindex"]) ? $_GET["nindex"] : (isset($_POST["nindex"]) ? $_POST["nindex"] : 0);

include ($FDOC_PATH."/php/allinclude.php");
session_start();
include ($FDOC_PATH."/newschool/ns_include.php");
include ($DOC_PATH."/newschool/expo_include.inc");

include ($FDOC_PATH."/php/title.php");
?>
<BODY>

<div class="content">
<?php include $FDOC_PATH."/php/maintitle.php"; ?>
<div class="left">
<?php if ($action == "salleexpo") { ?>
	<div class="left_box">
<?php showExpoPage(1); ?>
	</div>
   	<div class=box_bg>&nbsp; </div>
<?php  } else { ?>
	<div class="left_box">
	<?php showShoolPage($nindex); ?>
	</div>
   	<div class=box_bg>&nbsp; </div>   	
<?php } ?>
</div>

 
<div class="right">
	<?php include $FDOC_PATH."/home/homeright.php" ?>    
</div>
</div>
<?php include $FDOC_PATH."/php/foot.php"; ?>

</body>
</html>
