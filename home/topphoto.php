<?php
include "../php/allinclude.php";

$nindex = isset($_GET["hindex"]) ? $_GET["hindex"] : (isset($_POST["hindex"]) ? $_POST["hindex"] : 0);

include ("../php/title.php");

?>

<BODY>
<div class="content">
<?php include "../php/maintitle.php"; ?>

<div class="left">
	<div class="left_box">
<?php 
		$newsclass = new NewsClass();
		$item = $newsclass->getNews($FASTNEWS_TOP, $nindex, 1);
		//$item = $TOPPHOTOS[$nindex][0]; 
		
		showNewsDetail($item, $nindex, "../home/topphoto.php", $FASTNEWS_TOP); 
?> 
		
 		<div class="box_txt2">
		</div>
    </div>
  	<div class=box_bg>&nbsp; </div>
</div>
<!------ end left ------>


<div class="right">
	<?php include ("../home/homeright.php") ; ?>
</div>
    
</div>
</div>

<?php include "../php/foot1.php"; ?>

</body>
</html>
