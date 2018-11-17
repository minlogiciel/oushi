<?php
include ("rootvar.php");
include ($FDOC_PATH."/php/allinclude.php");
include ($FDOC_PATH."/about/aboutinclude.php");
session_start();
include ($FDOC_PATH."/php/title.php");
?>

<BODY>
<div class="content">
<?php include ($FDOC_PATH."/php/maintitle.php"); ?>
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
   	<div class=box_bg>&nbsp; </div>

</div>

<div class="right">
	<?php include ($FDOC_PATH."/php/right.php"); ?>    
</div>
</div>
<?php include ($FDOC_PATH."/php/foot.php"); ?>

</body>
</html>
