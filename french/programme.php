<?php
include ("rootvar.php");
include ($FDOC_PATH."/php/allinclude.php");
session_start();
include ($DOC_PATH."/register/school_schedule.inc");
include ($FDOC_PATH."/php/title.php");
?>
<BODY>
<div class="content">
<?php include ($FDOC_PATH."/php/maintitle.php"); ?>
	<div class="left">
		<div class="left_box">
	    	<div class=box_prog>
				<IMG SRC='<?php echo($PHOTO_PATH); ?>/oushi/<?php echo($PROGRAM_JPG); ?>' width=640 border=0>
			</div>
			<br><br>
	   		<div class=box_down>
				<h3><IMG SRC='<?php echo($PHOTO_PATH); ?>/icon/bull16.png' width=9>&nbsp; Télécharger le Programme : (<A href='../files/<?php echo($PROGRAM_PDF); ?>' target=_blank>Clique ici</A>) </h3>
			</div>
			<br>
		</div>
		
		
	   	<div class=box_bg>&nbsp; </div>
	</div>
	
<div class="right">
	<?php include $FDOC_PATH."/php/right.php" ?>    
</div>
</div>
<?php include $FDOC_PATH."/php/foot.php"; ?>

</body>
</html>
