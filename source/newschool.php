<?php
include "../php/allinclude.php";

$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");
$nindex = isset($_GET["nindex"]) ? $_GET["nindex"] : (isset($_POST["nindex"]) ? $_POST["nindex"] : 0);

include ("../newschool/ns_include.php");
include ("../newschool/expo_include.inc");
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
	<?php include "../home/homeright.php" ?>    
</div>
</div>
<?php include "../php/foot1.php"; ?>

</body>
</html>
