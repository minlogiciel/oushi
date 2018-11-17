<?php
include "../php/allinclude.php";

include ("../jiaoyu/jy_include.php");

$nindex = isset($_GET["hindex"]) ? $_GET["hindex"] : (isset($_POST["hindex"]) ? $_POST["hindex"] : 0);
$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");
$kongzixx = isset($_GET["kongzixx"]) ? $_GET["kongzixx"] : (isset($_POST["kongzixx"]) ? $_POST["kongzixx"] : "");

include ("../php/title.php");
?>
<BODY>
<div class="content">
<?php include "../php/maintitle.php"; ?>
<div class="left">
<?php 
	if ($action == "detail")  { 
		$newsclass = new NewsClass();
		$item = $newsclass->getNews($FASTNEWS_JY, $nindex,1);
		//$item = $HOME_JY[3][$nindex]; 
?>
	<div class=left_box>
		<?php showNewsDetail($item, $nindex, $HOME_JY[1], $FASTNEWS_JY); ?> 
	</div>
<?php 
	} else if ($action == "morenews")  {
?>
	<div class="left_box">
<?php 
		if ($kongzixx=="kongzixx") {
    		showNewsPageList($HOME_KZXX, $FASTNEWS_KZ); 
		}
		else {
   			showNewsPageList($HOME_JY, $FASTNEWS_JY, "withhuajiao"); 
		}
?>
	</div>
   	<div class=box_bg>&nbsp; </div>		
<?php } else { ?>
	<div class="left_box">
    	<div class="PROG_TIT2">
 			<IMG src="../images/ecole.jpg">
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
			<div class=box_tit1_text1>
<?php 
				for ($i = 0; $i < 3; $i++) { 
					$item = $JY_TAB[$i];
		 			echo("<IMG SRC='".$PHOTO_PATH.$item[2]."' width=300  height=200>");
		 			echo("<p class=JY_ITEM><span>");  	
		 			echo($item[0]. "</span>&nbsp;:&nbsp;");
		 			if ($item[1] == "student") {
			 			echo("<a class=JY_BAR href='../jiaoyu/education.php?action=moreworks&resource=student'>优秀习作 </a>&nbsp;");
		 			}
		 			else {
			 			for ($j = $JY_START_ITEM; $j < count($item); $j++) {
							$s_item = $item[$j];
			 				echo("<a class=JY_BAR href='../jiaoyu/education.php?resource=".$item[1]. "&nindex=".$j."'>".$s_item[0]. "</a>&nbsp;");
			 			}
		 			}
		 			echo("</p>");
		 		} 
?>
	 		</div>
			
		 	<div class=box_tit1_text2>
<?php 
				for ($i = 3; $i < 6; $i++) { 
					$item = $JY_TAB[$i];
		 			echo("<IMG SRC='".$PHOTO_PATH.$item[2]. "' width=300 height=200>");
		 			echo("<p class=JY_ITEM><span>");  	
		 			//echo("<a href='../jiaoyu/education.php?resource=".$item[1]."'>".$item[0]. "</a></span>&nbsp;:&nbsp;");	
		 			echo($item[0]. "</span>&nbsp;:&nbsp;");
		 			for ($j = $JY_START_ITEM; $j < count($item); $j++) {
						$s_item = $item[$j];
		 				echo("<a class=JY_BAR href='../jiaoyu/education.php?resource=".$item[1]. "&nindex=".$j."'>".$s_item[0]. "</a>&nbsp;");
		 			}
		 			echo("</p>");
		 		} 
?>
			</div>

     	</div>
	</div>
   	<div class=box_bg>&nbsp; </div>
   	
<!--  hua wen jiao yu  -->
<?php  if ($action == "withhuajiao") { ?>
	<div class="left_box">
    	<div class="PROG_TIT2">
 			<IMG src="../images/ass.jpg">
 			<div class=red_line>&nbsp; </div>
     	</div>
    	<div class="PROG_TIT1">
 		<?php 
 			$texte = $JY_ASSO[4];
 			for ($i = 0; $i < count($texte); $i++) { 
	 			echo("<p>" .$texte[$i]. "</p>");  	
 			}
 		?> 			
     	</div>
		<br><br>
      	<div class="box_txt">
        	<div class="tit_img">
          		<img src="<?php echo($PHOTO_PATH.$HOME_HUAWEN[2]); ?>" border="0" width="290">
       		</div>
        	<div id="ISIndex">
        	<ul>
		    <?php
		      	$items = $HOME_HUAWEN[3];
		      	$nb = count($items);
		      	if (count($items) > 3)
		      		$nb = 3;
		      	for ($n = 0; $n < $nb; $n++) {
		      		if ($n == 0)
		         		echo("<li current>");
		         	else 
		         		echo("<li>");
		         	echo("<a href='".$HOME_HUAWEN[1]."?action=detail&hindex=".$n."'>".$items[$n][0]."</a>");
		         	if (count($items[$n]) > 1) {
		         		echo("<p>".$items[$n][1]." ...... </p>");
		         	}
		         	echo("</li>");
		         	
		 		}
		 	?>
		 	</ul>
	 			<div class=more_bottom>
					<a class=box_tit_more href="../association/?action=morenews">更多 <font color=red>&#187;</font></a>
				</div>
         	</div>
       	</div>
    </div>
   	<div class=box_bg>&nbsp; </div>
<?php  
	}
} ?>
   	
</div>

<div class="right">
	<?php include "../jiaoyu/jyright.php"; ?>    
</div>
</div>
<?php include "../php/foot1.php"; ?>

</body>
</html>
