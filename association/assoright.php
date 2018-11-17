
<?php include "../jiaoyu/jyresum.php"; ?>
<div class=box_bg>&nbsp; </div>

<div class="right_box right_box3">
	<div class=lastnews_img>&nbsp; </div>
	<div class=item_txt>
<?php $n_item = 5;
		$newsclass = new NewsListClass();
		$news_item = $newsclass->getLastNewsLists(0, $FASTNEWS_ASSO);
		$nb = count($news_item);
		for ($i = 0; $i < $n_item; $i++) {
			$nb--;
			$id = $news_item[$nb]->getID();
			$title = $news_item[$nb]->getTitle();
			echo("<div class=textlink>&#149;<a href='../association/?action=detail&hindex=".$id."'>".$title."</a></div>"); 
		}
?>
	</div>
	<br><br>
	<div class="box_more_r">
		<div class=more_bottom>
			<a class=box_tit_more href='../association/?action=morenews'>更多 <font color=red>&#187;</font></a>
		</div>
	</div>	
</div>
<div class=box_bg>&nbsp; </div>

<?php include "../php/usedlink.php"; ?>
<div class=box_bg>&nbsp; </div>





