<?php
include ("rootvar.php");
include ($FDOC_PATH."/php/allinclude.php");
session_start();
include ($FDOC_PATH."/jiaoyu/jyinclude.php");


$nindex = isset($_GET["hindex"]) ? $_GET["hindex"] : (isset($_POST["hindex"]) ? $_POST["hindex"] : 0);
$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");

include ($FDOC_PATH."/php/title.php");
?>
<BODY>
<div class="content">
<?php include ($FDOC_PATH."/php/maintitle.php"); ?>
<div class="left">
<?php 
	if ($action == "detail")  { 
		$newsclass = new NewsClass();
		$item = $newsclass->getNews($FASTNEWS_JY, $nindex,1);
		//$item = $FHOME_JY[3][$nindex]; 
		$item = $item[6];
		
?>
	<div class=left_box>
		<?php showNewsDetail($item, $nindex, $FHOME_JY[1], $FASTNEWS_JY); ?> 
	</div>
<?php 
	} else if ($action == "morenews")  {
?>
	<div class="left_box">
    	<?php showNewsPageList($FHOME_JY, $FASTNEWS_JY, "withhuajiao"); ?>
	</div>
   	<div class=box_bg>&nbsp; </div>		
<?php } else { ?>
	<div class="left_box">
    	<div class="PROG_TIT1">
 			<h1><?php echo($FHOME_KZXX[0]); ?></h1>
 			<div class=red_line>&nbsp; </div>
     	</div>
    	<div class="PROG_TIT1">
 		<?php 
 			for ($i = 1; $i < count($zhongwenkongzi); $i++) { 
	 			echo("<p>" .$zhongwenkongzi[$i]. "</p>");  	
 			}
		?> 			
     	</div>
       	<div class="box_txt">
			
<?php 	for ($i = 0; $i < count($JY_TAB); $i++) { 
			$item = $JY_TAB[$i];
			echo("<div class=box_full_left>");
 			echo("<div class=box_ll>");
 			echo("<IMG SRC='".$PHOTO_PATH.$item[2]."' width=300  height=200>");
			echo("</div><div class=box_lr>");
 			echo("<h1>". $item[0]."</h1>");
 			echo("<div class=box_li><ul>");
 			for ($j = $JY_START_ITEM; $j < count($item); $j++) {
				$s_item = $item[$j];
				$s_item = getItemTable($s_item);
				//echo("<li><IMG src='".$HOST_URL."/images/arrow-orange-double.gif' width=8>");
				echo("<li><a href='".$HOST_URL."/french/jiaoyu/education.php?resource=".$item[1]. "&nindex=".$j."'>".$s_item[0]. "</a>&nbsp;");
		 		echo("</li>");
		 	}
 			echo("</ul></div>");
		 	echo("</div></div>");
		 } 
?>
     	</div>
	</div>
   	<div class=box_bg>&nbsp; </div>
   	
<!--  hua wen jiao yu  -->
<?php  if ($action == "withhuajiao") { ?>
	<div class="left_box">
    	<div class="PROG_TIT1">
 			<h1><?php echo($FJY_ASSO[0]); ?></h1>
 			<div class=red_line>&nbsp; </div>
     	</div>
		<br>
      	<div class="box_txt">
 		 	<div class=HItemIndex>
      		
        	<div class="tit_img">
          		<img src="<?php echo($PHOTO_PATH.$FHOME_HUAWEN[2]); ?>" border="0" width="290">
       		</div>
  		<?php 
 			$texte = $FJY_ASSO[4];
 			for ($i = 0; $i < count($texte); $i++) { 
	 			echo("<p>" .$texte[$i]. "</p>");  	
 			}
 		?> 			
 
         	</div>
       	</div>
    </div>
   	<div class=box_bg>&nbsp; </div>
<?php  
	}
} ?>
   	
</div>

<div class="right">
	<?php include ($FDOC_PATH."/jiaoyu/jyright.php"); ?>    
</div>
</div>
<?php include ($FDOC_PATH."/php/foot.php"); ?>

</body>
</html>
