
<div class="right_box right_box3">
	<div class=calendrier_img>&nbsp; </div>
	<div class=item_txt>
<?php 
// modify for new year after update
$sy17 = 2017;
$sy18 = 2018;
$sy = 2018;
for ($i = 0; $i < count($SCHEDULE_TABLE); $i++) {
		echo("<div class=textlink>&#149;"); 
		echo("<a href='../jiaoyu/education.php?action=schedule&nindex=".$i."'>中文学校 ".$sy. "-" .($sy+1)." ".$SCHEDULE_TABLE[$i][1]."</a></div>"); 
	}
?>
	<div class=textlink>&#149;
	<a href="../jiaoyu/education.php?action=schedule&nindex=2"><?php echo("文化中心 ".$sy. "-" .($sy+1)." 课程安排");?></a>
	</div>
	<br>
	</div>
</div>


