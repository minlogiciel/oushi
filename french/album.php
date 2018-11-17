<?php 
include ("rootvar.php");
include ($FDOC_PATH."/php/allinclude.php");
include ($DOC_PATH."/album/album_include.php");
session_start();
include ($FDOC_PATH."/php/title.php");

$sem = isset($_POST["semaine"]) ? $_POST["semaine"] : (isset($_GET["semaine"]) ? $_GET["semaine"] : 0);
$groups = isset($_POST["groups"]) ? $_POST["groups"] : (isset($_GET["groups"]) ? $_GET["groups"] : 0);


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
<?php include ($FDOC_PATH."/php/maintitle.php"); ?>
<div class="left">
<?php if ($groups > 0) { ?>
	<div class="left_box">
    	<div class="PROG_TIT">
 			<h1><?php echo($ALBUM_ITEM_NAME[$groups][1]) ?></h1>
     	</div>
     	<br>
     	<div class=PROG_TIT1>
 			<p><?php if (count($ALBUM_ITEM_NAME[$groups]) > 8) echo(ArrayToHTMLString($ALBUM_ITEM_NAME[$groups][9])) ?></p>
     	</div>
      	<div class="box_txt">
<?php 
			$albumform = new AlbumForm();
			$albumform->showAlbumAllList($sem, $groups);
?>
     	</div>
	</div>
<?php } else { ?>
	<div class="left_box">
    	<div class="PROG_TIT">
 			<h1><?php echo($ALBUM_ITEM_NAME[0][1]) ?></h1>
     	</div>
     	<br>
      	<div class="box_txt">
<?php 
			$vacance_sem = array("1<sup>ère</sup> semaine", "2<sup>nde</sup> semaine", "3<sup>ème</sup> semaine", "4<sup>ème</sup> semaine");
			echo("<div class=NEWS_BAR>");
			for ($s = 0; $s < count($vacance_sem); $s++) {
				if ($sem == $s ) {
					echo("<font color=red>".$vacance_sem[$s]."</font>&nbsp; &nbsp; &nbsp; &nbsp;");
				}
				else { 
					echo("<a class=NEWS_BAR href='album.php?semaine=".$s."'>".$vacance_sem[$s]."</a>");
				}
			}
			echo("</div>");
			$albumform = new AlbumForm();
			$albumform->showAlbumAllList($sem, 0);
			echo("<div class=NEWS_BAR>");
			for ($s = 0; $s < count($vacance_sem); $s++) {
				if ($sem == $s ) {
					echo("<font color=red>".$vacance_sem[$s]."</font>&nbsp; &nbsp; &nbsp; &nbsp;");
				}
				else { 
					echo("<a class=NEWS_BAR href='album.php?semaine=".$s."'>".$vacance_sem[$s]."</a>");
				}
			}
			echo("</div>");
?>

     	</div>
	</div>
<?php } ?>
   	<div class=box_bg>&nbsp; </div>   	
</div>


<div class="right">
	<?php include ($FDOC_PATH."/home/homeright.php"); ?>    
</div>
</div>
<?php include ($FDOC_PATH."/php/foot.php"); ?>

</body>
</html>
