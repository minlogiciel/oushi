
<div class="right_box right_box3">
	<div class=item_tit><?php echo($zhongwenkongzi[0]); ?></div>
	<div class=item_txt>
	<?php 
	for ($i = 1; $i < 3; $i++) {
		echo("<p class=OUSHI_INFO>".$zhongwenkongzi[$i]."</p>");
	}
	?>
	</div>
</div>
<div class=box_bg>&nbsp; </div>
<?php 
include "../jiaoyu/schedulelist.php"; 
?>
<div class=box_bg>&nbsp; </div>

<?php if ($res == "student") { ?>
<div class="right_box right_box3">
	<div class=item_tit>学生园地 : 优秀习作 </div>
	<div class=item_txt>
<?php 
		$articles = new ArticleListClass();
		$item = $articles->getArticleLists();
		for ($i = 0; $i < 10; $i++) {
			$sitem = $item[$i];				
			$id = $sitem->getID();
			$title = $sitem->getTitle(). " " .$sitem->getStudent(). " (".$sitem->getReward().")";
			echo("<div class=textlink>&#149; <a href='../jiaoyu/education.php?action=subitem&resource=student&nindex=".$id."'>".$title. "</a></div>");
		}
?>		
	</div>
	<br><br>
	<div class="box_more_r">
		<div class=more_bottom>
			<a class=box_tit_more href='../jiaoyu/education.php?action=moreworks&resource=student'>更多 <font color=red>&#187;</font></a>
		</div>
	</div>
	
</div>
<div class=box_bg>&nbsp; </div>
<?php 
} else {
?>
<div class="right_box right_box3">
	<div class=lastnews_img>&nbsp; </div>
	<div class=item_txt>
<?php 
		$news_item = $HOME_JY[3];
		$n_item = (count($news_item) > 5 )? 5 : count($news_item);
		for ($i = 0; $i < $n_item; $i++) {
			$items =$news_item[$i];				
			echo("<div class=textlink>&#149;<a href=\"../jiaoyu/?action=detail&hindex=".$i."\">".$items[0]."</a></div>"); 
		}
?>		
	</div>
	<br><br>
	<div class="box_more_r">
		<div class=more_bottom>
			<a class=box_tit_more href='../jiaoyu/?action=morenews&kongzixx=withhuajiao'>更多 <font color=red>&#187;</font></a>
		</div>
	</div>
	
</div>
<div class=box_bg>&nbsp; </div>

<?php 
}
include "../jiaoyu/jylink.php"; 
?>



