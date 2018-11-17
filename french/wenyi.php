<?php 
include ("rootvar.php");
include ($FDOC_PATH."/php/allinclude.php");
session_start();

$res = isset($_GET["resource"]) ? $_GET["resource"] : (isset($_POST["resource"]) ? $_POST["resource"] : 0);
$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");
$hindex = isset($_GET["hindex"]) ? $_GET["hindex"] : (isset($_POST["hindex"]) ? $_POST["hindex"] : 0);
$nindex = isset($_GET["nindex"]) ? $_GET["nindex"] : (isset($_POST["nindex"]) ? $_POST["nindex"] : $hindex);

include $FDOC_PATH."/wenyi/WenYiForm.php"; 
include $FDOC_PATH."/wenyi/wy_include.php";
 
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
<?php if ($action == "detail") { 
		$newsclass = new NewsClass();
		$item = $newsclass->getNews($FASTNEWS_WY, $nindex,1);
		$item = $item[6];
		//$item = $FHOME_YL[3][$nindex]; 
?>
	<div class=left_box>
		<?php showNewsDetail($item, $nindex, $FHOME_YL[1], $FASTNEWS_WY); ?> 
	</div>
<?php } else if ($action == "subitem") { $item =   getActiveTable($WY_TAB, $res); ?>
	<div class="left_box">
    	<?php showWenyiItemDetail($item, $nindex); ?>
	</div> 
<?php } else if ($action == "lastbiblio") { $item =   getActiveTable($WY_TAB, $res); ?>
	<div class="left_box">
    	<?php showLastBiblioNews($nindex); ?> <br><br>
	</div>
 <?php } else if ($action == "programs") { ?>
	<div class="left_box">
    	<div class="PROG_TIT">
 			<IMG src="../images/logo_s.png" height=50>
 			<h1> Programme&nbsp;&nbsp;&nbsp;&nbsp;<em><font size=2 color=#333>(Sept.2013—Juin 2014)</font></em> </h1>
     	</div>
      	<div class="box_txt">
    		<?php  showProgramTable($P_PROG_TTILE, $P_PROG_COL, $P_PROG) ; ?>
   		</div>
      	<div class="box_txt">
    		<?php  showProgramTableNode($P_PROG_NOTE) ; ?>
   		</div>
   		<br>
      	<div class="box_txt">
    		<?php  /* listSummerTable($P_SUMMER_TITLE, $P_SUMMER_COL, $P_SUMMER) ;*/ ?>
   		</div>
   	</div>
<?php 
	} else if ($action == "morenews")  {
?>
	<div class="left_box">
    	<?php showNewsPageList($FHOME_YL, $FASTNEWS_WY); ?>
	</div>
<?php } else { ?>

	<div class="left_box">
<?php 
	for ($n = 0; $n < count($WY_TAB); $n++) { 
		$item = $WY_TAB[$n];
?>
    	<div class="PROG_TIT1">
 			<?php echo("<h1>" .$item[0]. "</h1>");  ?>
   			<div class=more_bottom>
				<a class=box_tit_more href="../wenyi/?action=subitem&resource=<?php echo($item[1]); ?>"><?php echo($NAME_MORE); ?> <font color=red>&#187;</font></a>
			</div>
 			<div class=red_line>&nbsp; </div>
     	</div>
	 
      	<div class="box_txt">
			<div class=box_tit1_text1>
<?php 
			for ($i = $JY_START_ITEM; $i < count($item); $i+=2) { 
				$sitem = $item[$i];
				$sitem = getItemTable($sitem);
			 	echo("<a href='../wenyi/?action=subitem&resource=".$item[1]."&hindex=".$i."'>"); 
				echo("<IMG SRC='".$PHOTO_PATH.$sitem[1][0]."' width=300  height=200 border=0>");
			 	echo("</a><div class=img_label>"); 
			 	echo("<a href='../wenyi/?action=subitem&resource=".$item[1]."&hindex=".$i."'>"); 
			 	echo($sitem[0]); 
			 	echo("</a></div>"); 			
			} 
?>
	 		</div>
		 	<div class=box_tit1_text2>
<?php 
			for ($i = ($JY_START_ITEM+1); $i < count($item); $i+=2) {
				$sitem = $item[$i];
				$sitem = getItemTable($sitem);
			 	echo("<a href='../wenyi/?action=subitem&resource=".$item[1]."&hindex=".$i."'>"); 
				echo("<IMG SRC='".$PHOTO_PATH.$sitem[1][0]."' width=300  height=200 border=0>");
			 	echo("</a><div class=img_label>"); 
			 	echo("<a href='../wenyi/?action=subitem&resource=".$item[1]."&hindex=".$i."'>"); 
			 	echo($sitem[0]); 
			 	echo("</a></div>"); 
	 		} 
?>
			</div>

     	</div>
<?php } ?>
	</div>
<?php } ?>
   	<div class=box_bg>&nbsp; </div>
   	
</div>
<div class="right">
	<?php include $FDOC_PATH."/wenyi/wenyiright.php" ?>    
</div>
</div>
<?php include $FDOC_PATH."/php/foot.php"; ?>

</body>
</html>
