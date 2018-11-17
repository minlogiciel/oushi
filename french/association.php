<?php
include ("rootvar.php");
include ($FDOC_PATH."/php/allinclude.php");
session_start();


$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");
$nindex = isset($_GET["hindex"]) ? $_GET["hindex"] : (isset($_POST["hindex"]) ? $_POST["hindex"] : 0);


include ($FDOC_PATH."/php/title.php");
?>
<BODY>
<div class="content">
<?php include ($FDOC_PATH."/php/maintitle.php"); ?>
<div class="left">
<?php if ($action == "detail") {
		$item = $FHOME_HUAWEN[3][$nindex]; 
?>
	<div class="left_box">
		<?php showNewsDetail($item, $nindex, $FHOME_HUAWEN[1], count($FHOME_HUAWEN[3])); ?> 
	</div>
<?php 
	} else if ($action == "morenews")  {
?>
	<div class="left_box">
    	<?php showNewsPageList($FHOME_HUAWEN, $FASTNEWS_ASSO); ?>
	</div>	
<?php } else { ?>
	<div class="left_box">
    	<div class="PROG_TIT1">
 			<h1>APELCF</h1>
 			<div class=red_line>&nbsp; </div>
     	</div>
		<br><br>
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

  			<div class=more_bottom>
				<a class=box_tit_more href="<?php echo($HOST_URL) ;?>/french/association/?action=morenews"><?php echo($NAME_MORE); ?> <font color=red>&#187;</font></a>
			</div>
			
        	</div>
    </div>
  	<div class=box_bg>&nbsp; </div>
<?php  } ?>
</div>


<div class="right">
	<?php include $FDOC_PATH."/association/assoright.php" ?>    
</div>
</div>
<?php include $FDOC_PATH."/php/foot.php"; ?>
</body>
</html>
