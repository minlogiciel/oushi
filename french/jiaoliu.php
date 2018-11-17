<?php
include ("rootvar.php");
include ($FDOC_PATH."/php/allinclude.php");	
session_start();

$res = isset($_GET["resource"]) ? $_GET["resource"] : (isset($_POST["resource"]) ? $_POST["resource"] : 0);
$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");
$nindex = isset($_GET["hindex"]) ? $_GET["hindex"] : (isset($_POST["hindex"]) ? $_POST["hindex"] : 0);

$usejlbase = 1;

include ($FDOC_PATH."/jiaoliu/jl_include.php");
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
<script type="text/javascript" src="../javascript/fancy/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

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
		$item = $newsclass->getNews($FASTNEWS_JL, $nindex, 1);
		//$item = $FHOME_JL[3][$nindex]; 
		$item = $item[6];
?>
	<div class="left_box">
		<?php showNewsDetail($item, $nindex, $FHOME_JL[1], $FASTNEWS_JL); ?> 
	</div>
<?php } else if ($action == "subitem") { ?>
	<div class="left_box">
<?php 
	if ($usejlbase) {
		$jltype = getActiveTableIndice($JL_TAB, $res);
		showJLTypeDetail($jltype, $nindex); 
	}
	else {
		$item =   getActiveTable($JL_TAB, $res);
		showJiaoLiuItemDetail($item, $nindex);
	} 
?>
	</div>
<?php 
	} else if ($action == "morenews")  {
?>
	<div class="left_box">
    	<?php showNewsPageList($FHOME_JL, $FASTNEWS_JL); ?>
	</div>
   	<div class=box_bg>&nbsp; </div>		
<?php } else { ?>
	<div class="left_box">
<?php 
	if ($usejlbase) {
		showAllJLBaseItemDetail(); 
	} else {
		showAllJLItemDetail(); 
	}
?>

    </div>
<?php } ?>		
</div>

<div class="right">
	<?php include $FDOC_PATH."/jiaoliu/jlright.php" ?>    
</div>
</div>
<?php include $FDOC_PATH."/php/foot.php"; ?>

</body>
</html>
