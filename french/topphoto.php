<?php
include ("rootvar.php");
include ($FDOC_PATH."/php/allinclude.php");
session_start();

$nindex = isset($_GET["hindex"]) ? $_GET["hindex"] : (isset($_POST["hindex"]) ? $_POST["hindex"] : 0);

include ($FDOC_PATH."/php/title.php");

?>

<BODY>
<div class="content">
<?php include ($FDOC_PATH."/php/maintitle.php"); ?>

<div class="left">
	<div class="left_box">
<?php 
		//$item = $FTOPPHOTOS[$nindex][0]; 
		$newsclass = new NewsClass();
		$item = $newsclass->getNews($FASTNEWS_TOP, $nindex, 1);
		$item = $item[6];
		showNewsDetail($item, $nindex, $HOST_URL."/french/home/topphoto.php", $FASTNEWS_TOP); 
?> 
 		<div class="box_txt2">
		</div>
    </div>
  	<div class=box_bg>&nbsp; </div>
</div>
<!------ end left ------>


<div class="right">
	<?php include ($FDOC_PATH."/home/homeright.php") ; ?>
</div>
    
</div>
</div>

<?php include ($FDOC_PATH."/php/foot.php"); ?>

</body>
</html>
