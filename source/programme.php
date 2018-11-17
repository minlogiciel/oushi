<?php
include "../php/allinclude.php";

include ("../register/school_schedule.inc");
include ("../php/title.php");
?>
<BODY>
<div class="content">
<?php include "../php/maintitle.php"; ?>
	<div class="left">
		<div class="left_box">
	    	<div class=box_prog>
				<IMG SRC='../photos/oushi/<?php echo($PROGRAM_JPG); ?>' width=640 border=0>
			</div>
			<br><br>
	   		<div class=box_down>
				<h3><IMG SRC='../photos/icon/bull16.png' width=9>&nbsp;下载课程安排  Télécharger le Programme : (<A href='../files/<?php echo($PROGRAM_PDF); ?>' target=_blank>点击此处下载</A>) </h3>
			</div>
			<br>
		</div>
		
		
	   	<div class=box_bg>&nbsp; </div>
	</div>
	
	<div class="right">
		<?php include "../php/right.php" ?>    
	</div>
</div>
<?php include "../php/foot1.php"; ?>

</body>
</html>
