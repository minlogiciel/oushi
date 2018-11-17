<div class="right_box right_box3">
	<div class=item_tit><p class=OUSHI_INFO_TIT><?php echo($JL_TEXT[0]); ?></p></div>
	<div class=item_txt>
	<?php 
	for ($i = 1; $i < count($JL_TEXT); $i++) {
		echo("<p class=OUSHI_INFO>".$JL_TEXT[$i]."</p>");
	}
	?>
	</div>
</div>
<div class=box_bg>&nbsp; </div>

<div class="right_box right_box3">
	<div class=lastnews_img>&nbsp; </div>
	<div class=item_txt>
<?php 
		$n_item = 5;
		$newsclass = new NewsListClass();
   		$news_item = $newsclass->getLastNewsLists($FASTNEWS_JL);
		$nb = count($news_item);
		for ($i = 0; $i < $n_item; $i++) {
			$nb--;
			$id = $news_item[$nb]->getID();
			$title = $news_item[$nb]->getTitle();
			echo("<div class=textlink>&#149;<a href='../jiaoliu/?action=detail&hindex=".$id."'>".$title."</a></div>"); 
		}
?>
	</div>
	<br><br>
	<div class="box_more_r">
		<div class=more_bottom>
			<a class=box_tit_more href='../jiaoliu/?action=morenews'>更多 <font color=red>&#187;</font></a>
		</div>
	</div>
	
</div>
<div class=box_bg>&nbsp; </div>

<!------  hui gu ------>
<?php include "../huigu/huiguright1.php"; ?>
<div class=box_bg>&nbsp; </div>


<?php include "../jiaoliu/jllink.php"; ?>
<div class=box_bg>&nbsp; </div>
