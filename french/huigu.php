<?php
include ("rootvar.php");
include ($FDOC_PATH."/php/allinclude.php");

session_start();

$hgindex = isset($_GET["hgindex"]) ? $_GET["hgindex"] : (isset($_POST["hgindex"]) ? $_POST["hgindex"] : 0);
$h_item = $HG_NEWS[$hgindex][4];

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
	<div class="left_box">
    	<div class="PROG_TIT1">
        	<h1><?php echo($FHUIGU[0]); ?></h1>
        	<div class=more_bottom>
        	<a class=box_tit_more href='javascript:history.back()'><?php echo($NAME_BACK); ?>  <font color=red>&#187;</font></a>
        	</div>
        	<div class=red_line>&nbsp; </div>
		</div>
		
    	<div class=box_txt>
<?php 
    		showPhotoArticlePage($h_item[0], $h_item, 1); 
?>
		</div>
		<br>
		<div class=box_bg>&nbsp; </div>
		
		<div class='box_txt'>
		<?php showYoutubeVideoItem($h_item, $hgindex); ?>

		</div>
		
	</div>
   	<div class=box_bg>&nbsp; </div>
   	
</div>

<div class="right">
	<?php include $FDOC_PATH."/php/right.php" ?>    
</div>
</div>
<?php include $FDOC_PATH."/php/foot.php"; ?>

</body>
</html>
