
<div class="right_box right_box3">
	<div class=item_tit><?php echo($zhongwenkongzi[0]); ?></div>
	<div class=item_txt>
	<?php 
	for ($i = 1; $i < count($zhongwenkongzi); $i++) {
		echo("<p class=OUSHI_INFO>".$zhongwenkongzi[$i]."</p>");
	}
	?>
	</div>
</div>
<div class=box_bg>&nbsp; </div>

<?php include $FDOC_PATH."/jiaoyu/schedulelist.php"; ?>
<div class=box_bg>&nbsp; </div>


<?php include $FDOC_PATH."/jiaoyu/jylink.php"; ?>



