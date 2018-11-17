<?php
include "../php/allinclude.php";

$res = isset($_GET["resource"]) ? $_GET["resource"] : (isset($_POST["resource"]) ? $_POST["resource"] : 0);
$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");
$nindex = isset($_GET["hindex"]) ? $_GET["hindex"] : (isset($_POST["hindex"]) ? $_POST["hindex"] : 0);

include ("../public/jlnews/jlnews_lists.inc");
include ("jl_include.php");
include ("../php/title.php");
$usejlbase = 1;
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


<BODY>
<div class="content">
<?php include "../php/maintitle.php"; ?>
<div class="left">
<?php if ($action == "detail") { 
		$newsclass = new NewsClass();
		$item = $newsclass->getNews( $FASTNEWS_JL, $nindex,1 );
		//$item = $HOME_JL[3][$nindex]; 
?>
	<div class="left_box">
		<?php showNewsDetail($item, $nindex, $HOME_JL[1], $FASTNEWS_JL); ?> 
	</div>
<?php } else if ($action == "subitem") { ?>
	<div class="left_box">
<?php 
if ($usejlbase) {
	$jltype = getActiveTableIndice($JL_TAB, $res);
	showJLTypeDetail($jltype, $nindex);
}
else {
	$item = getActiveTable($JL_TAB, $res);
	showJiaoLiuItemDetail($item, $nindex);
}


?>
	</div>
   	<div class=box_bg>&nbsp; </div>
<?php 
	} else if ($action == "morenews")  {
?>
	<div class="left_box">
<?php 	showNewsPageList($HOME_JL, $FASTNEWS_JL); ?>
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
	<?php include "../jiaoliu/jlright.php" ?>    
</div>
</div>
<?php include "../php/foot1.php"; ?>

</body>
</html>
