
<div class="right_box right_box3">
	<div class=item_tit>Calendrier scolaire</div>
	<div class=item_txt>
<?php $sy = getSchoolYear();
	for ($i = 0; $i < count($SCHEDULE_TABLE); $i++) {
		echo("<div class=textlink>&#149; "); 
		echo("<a href='".$HOST_URL."/french/jiaoyu/education.php?action=schedule&nindex=".$i."'>".$SCHEDULE_TABLE[$i][1]." ".$sy. "-" .($sy+1)."</a></div><br>"); 
	}
?>
	</div>
</div>


