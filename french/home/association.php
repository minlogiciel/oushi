<?php
include "../php/allinclude.php";
session_start();

$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");
$nindex = isset($_GET["hindex"]) ? $_GET["hindex"] : (isset($_POST["hindex"]) ? $_POST["hindex"] : 0);

include ("../association/asso_include.php");
include ("../php/title.php");
?>
<BODY>
<div class="content">
<?php include "../php/maintitle.php"; ?>
<div class="left">
<?php if ($action == "detail") {
		$item = $HOME_HUAWEN[3][$nindex]; 
?>
	<div class="left_box">
		<?php showNewsDetail($item, $nindex, $HOME_HUAWEN[1], count($HOME_HUAWEN[3])); ?> 
	</div>
<?php 
	} else if ($action == "morenews")  {
?>
	<div class="left_box">
    	<?php showNewsPageList($HOME_HUAWEN, $FASTNEWS_ASSO); ?>
	</div>	
<?php } else { ?>
	<div class="left_box">
    	<div class="PROG_TIT2">
 			<IMG src="../images/huajiao.png">
 			<div class=red_line>&nbsp; </div>
     	</div>
    	<div class="PROG_TIT1">
 		<?php 
  			$texte = $JY_ASSO[4];
 			for ($i = 0; $i < count($texte); $i++) { 
	 			echo("<h5>" .$texte[$i]. "</h5>");  	
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
					<a class=box_tit_more href="../association/?action=morenews">更多  <font color=red>&#187;</font></a>
				</div>
        	</div>
       	</div>
    </div>
  	<div class=box_bg>&nbsp; </div>
<?php  } ?>
</div>

<div class="right">
	<?php include "../association/assoright.php" ?>    
</div>
</div>
<?php include "../php/foot1.php"; ?>

</body>
</html>
