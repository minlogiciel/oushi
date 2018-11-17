<div class="right_box right_box3">
	<div class=item_tit>教育娱乐活动报名</div>
	<?php 
		for ($i = 0; $i < count($HUODONGTAB); $i++) {
			$hd = $HUODONGTAB[$i];				
			$hdtitle = $hd[0];
			$hdtime = $hd[1];
			$hdv = $hd[2];
			echo("<div class=textlink>&#149; "); 
			if ($hdv) {
				echo("<a href='".$HOST_URL."/register/?hdindex=".$i."'>".$hdtitle."</a>"); 
			} else {
				echo("<font color=black>&nbsp;&nbsp;".$hdtitle."</font>"); 
			} 
			echo("<font color=green>&nbsp;&nbsp;(".$hdtime.")</font></div>");
		}
	?>
</div>