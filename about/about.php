<?php
include "../php/allinclude.php";
include ("aboutinclude.php");

include ("../php/title.php");
?>


<body>
<div class="content">
<?php include "../php/maintitle.php"; ?>
<div class="left">
	<div class="left_box">
    	<div class=box_txt>
			<div id=article>
    			<h1><?php echo($ABOUT_TEXT[0]); ?></h1> 
 				<div class=article_media_no>
					<p><img src="<?php echo($PHOTO_PATH.$ABOUT_TEXT[2][1]); ?>" width=280 ></p>
				</div>
			<?php 
				$contents = $ABOUT_TEXT[2];
				echo("<h2>".$contents[0]."</h2>");
				for ($j = 2; $j < count($contents); $j++) {
					echo("<p>".$contents[$j]. "</p>");
				}
			?>
			</div><br><br><br>

			<div id=article>
 				<div align=center><img src="<?php echo($PHOTO_PATH.$ABOUT_TEXT[3][1]); ?>" width=400 ></div><br><br>
			<?php 
				$contents = $ABOUT_TEXT[3];
				//echo("<h2>".$contents[0]."</h2>");
				for ($j = 2; $j < count($contents); $j++) {
					echo("<p>".$contents[$j]. "</p>");
				}
			?>
			</div>
		</div>
   	</div>
   	<div class=box_bg>&nbsp;</div>

</div>

<div class="right">
	<?php include "../php/right.php" ?>    
</div>
</div>
<?php include "../php/foot1.php"; ?>

</body>
</html>
