<?php 
include "../php/allinclude.php";

$sem = isset($_POST["semaine"]) ? $_POST["semaine"] : (isset($_GET["semaine"]) ? $_GET["semaine"] : 0);
$groups = isset($_POST["groups"]) ? $_POST["groups"] : (isset($_GET["groups"]) ? $_GET["groups"] : 0);

include ("../album/album_include.php");

include ("../php/title.php");


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
	<div class="left_box">
    	<div class="PROG_TIT">
 			<h1><?php echo($ALBUM_ITEM_NAME[$groups][1]) ?></h1>
     	</div>
     	<br>
     	<div class=PROG_TIT1>
 			<p><?php if (count($ALBUM_ITEM_NAME[$groups]) > 8) echo(ArrayToHTMLString($ALBUM_ITEM_NAME[$groups][8])) ?></p>
     	</div>
      	<div class="box_txt">
<?php 
		$vacance_sem = array("第一周 ", "第二周", "第三周", "第四周");
		$albumform = new AlbumForm();
		if ($ALBUM_ITEM_NAME[$groups][3] > 20) {
			echo("<div class=NEWS_BAR>");
			for ($s = 0; $s < count($vacance_sem); $s++) {
				if ($sem == $s ) {
					echo("<font color=red>".$vacance_sem[$s]."</font>&nbsp; &nbsp; &nbsp; &nbsp;");
				}
				else { 
					echo("<a class=NEWS_BAR href='../album/?semaine=".$s."&groups=".$groups."'>".$vacance_sem[$s]."</a>");
				}
			}
			echo("</div>");
			$albumform->showAlbumAllList($sem, $groups);
		
			echo("<div class=NEWS_BAR>");
			for ($s = 0; $s < count($vacance_sem); $s++) {
				if ($sem == $s ) {
					echo("<font color=red>".$vacance_sem[$s]."</font>&nbsp; &nbsp; &nbsp; &nbsp;");
				}
				else { 
					echo("<a class=NEWS_BAR href='../album/?semaine=".$s."&groups=".$groups."'>".$vacance_sem[$s]."</a>");
				}
			}
			echo("</div>");
		}
		else {
			$albumform->showAlbumAllList($sem, $groups);
		}
?>
     	</div>
	</div>
   	<div class=box_bg>&nbsp; </div>   	
</div>



<div class="right">
	<?php include "../home/homeright.php" ?>    
</div>
</div>
<?php include "../php/foot1.php"; ?>

</body>
</html>
