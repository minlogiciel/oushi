<?php
include ("../rootvar.php");
include ($FDOC_PATH."/php/allinclude.php");
session_start();
include ($FDOC_PATH."/jiaoyu/jyinclude.php");
include ($DOC_PATH."/register/SchoolForm.php");

include ($DOC_PATH."/wenyi/WenYiForm.php"); 
include ($DOC_PATH."/wenyi/wy_include.php");


$res = isset($_GET["resource"]) ? $_GET["resource"] : (isset($_POST["resource"]) ? $_POST["resource"] : 0);
$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");
$nindex = isset($_GET["nindex"]) ? $_GET["nindex"] : (isset($_POST["nindex"]) ? $_POST["nindex"] : 0);

if (!$action || $action == "subitem") {
	$item = getActiveTable($JY_TAB, $res);
	$indice = getActiveTableIndice($JY_TAB, $res);
}
include ($FDOC_PATH."/php/title.php");
?>

<!-- Add jQuery library -->
<script type="text/javascript" src="<?php echo($HOST_URL); ?>/javascript/fancy/lib/jquery-1.10.1.min.js"></script>

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="<?php echo($HOST_URL); ?>/javascript/fancy/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="<?php echo($HOST_URL); ?>/javascript/fancy/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo($HOST_URL); ?>/javascript/fancy/source/jquery.fancybox.css?v=2.1.5" media="screen" />

<!-- Add Button helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="<?php echo($HOST_URL); ?>/javascript/fancy/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
<script type="text/javascript" src="<?php echo($HOST_URL); ?>/javascript/fancy/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

<!-- Add Thumbnail helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="<?php echo($HOST_URL); ?>/javascript/fancy/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
<script type="text/javascript" src="<?php echo($HOST_URL); ?>/javascript/fancy/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<!-- Add Media helper (this is optional) -->
<script type="text/javascript" src="<?php echo($HOST_URL); ?>/javascript/fancy/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<!-- oushi fancy function  -->
<script type="text/javascript" src="<?php echo($HOST_URL); ?>/javascript/oushi.fancy.js"></script>


<BODY>
<div class="content">
<?php include ($FDOC_PATH."/php/maintitle.php"); ?>
<div class="left">

<?php if ($action == "schedule") { ?>
	<div class="left_box">
    	<div class="PROG_TIT1"><br>
 			<h1> <?php $sy = getSchoolYear(); echo($SCHEDULE_TABLE[$nindex][0]." ".$sy. "-" .($sy+1)); ?> </h1>
 			<div class=red_line>&nbsp;</div>
     	</div>
     	<br>
    	<div class="box_txt">
<?php  if ($nindex == $SCHEDULE_HUODONG) { ?>				
	    	<div class=box_prog>
				<IMG SRC='<?php echo($PHOTO_PATH); ?>/oushi/<?php echo($PROGRAM_JPG); ?>' width=640 border=0>
			</div>
			<br><br>
	   		<div class=box_down>
				<h3><IMG SRC='<?php echo($PHOTO_PATH); ?>/icon/bull16.png' width=9>&nbsp;
				 Télécharger le Programme : (<A href='<?php echo($HOST_URL); ?>/files/<?php echo($PROGRAM_PDF); ?>' target=_blank>Clique ici</A>) </h3>
			</div>
<?php 	} else if ($nindex == $SCHEDULE_TIMER) {
			include ("JYScheduleTable.php"); 
		} else {
			showProgramTable($P_PROG_TTILE, $P_PROG_COL, $P_PROG) ;
			showProgramTableNode($P_PROG_NOTE) ;
		}
?>
		</div>
	</div>
	<div><img src="<?php echo($HOST_URL); ?>/images/box_bg.gif"></div>
<?php } else { ?>
	<div class="left_box">
    	<?php 
    	if ($nindex < $JY_START_ITEM) {
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
	<?php include ($FDOC_PATH."/jiaoyu/educationright.php"); ?>    
</div>
</div>
<?php include ($FDOC_PATH."/php/foot.php"); ?>

</body>
</html>
