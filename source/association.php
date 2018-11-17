<?php
include "../php/allinclude.php";

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
		//$item = $HOME_HUAWEN[3][$nindex]; 
		$newsclass = new NewsClass();
		$item = $newsclass->getNews( $FASTNEWS_ASSO, $nindex,1 );
?>
	<div class="left_box">
		<?php showNewsDetail($item, $nindex, $HOME_HUAWEN[1], $FASTNEWS_ASSO); ?> 
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
 			<IMG src="../images/ass.jpg">
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
			$newsclass = new NewsListClass();
  			$news_item = $newsclass->getLastNewsLists(0, $FASTNEWS_ASSO);
			$nb = count($news_item);		
			for ($n = 0; $n < 3; $n++) {
				$nb--;
				$title = $news_item[$nb]->getTitle();
				$id = $news_item[$nb]->getID();
				$resume = $news_item[$nb]->getResume();
				if ($n == 0)
		         	echo("<li current>");
		         else 
		         	echo("<li>");
		         echo("<a href='".$HOME_HUAWEN[1]."?action=detail&hindex=".$id."'>".$title."</a>");
		         if ($resume) {
		         	echo("<p>".$resume." ...... </p>");
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
