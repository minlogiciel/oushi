
<?php include "../jiaoyu/jyresum.php"; ?>
<div class=box_bg>&nbsp; </div>

<?php 
include "../jiaoyu/schedulelist.php"; 
?>
<div class=box_bg>&nbsp; </div>

<div class="right_box right_box3">
	<div class=lastnews_img>&nbsp; </div>
	<div class=item_txt>
<?php 
		$n_item = 5;
		$newsclass = new NewsListClass();
		if ($kongzixx == "kongzixx" || $action=="")
			$news_item = $newsclass->getLastNewsLists(0, $FASTNEWS_KZ);
		else
			$news_item = $newsclass->getLastNewsLists($FASTNEWS_JY);
		$nb = count($news_item);
		for ($i = 0; $i < $n_item; $i++) {
			$nb--;
			$id = $news_item[$nb]->getID();
			$title = $news_item[$nb]->getTitle();
			echo("<div class=textlink>&#149;<a href='../jiaoyu/?action=detail&hindex=".$id."'>".$title."</a></div>"); 
		}
?>		
	</div>
	<br><br>
	<div class="box_more_r">
		<div class=more_bottom>
		<?php if ($action == "withhuajiao" || $kongzixx == "withhuajiao") {  ?>
			<a class=box_tit_more href='../jiaoyu/?action=morenews&kongzixx=withhuajiao'>更多 <font color=red>&#187;</font></a>
		<?php } else { ?>
			<a class=box_tit_more href='../jiaoyu/?action=morenews&kongzixx=kongzixx'>更多 <font color=red>&#187;</font></a>
		<?php } ?>
		</div>
	</div>
	
</div>
<div class=box_bg>&nbsp; </div>

<!------- google map --------> 
<?php include "../php/googlemap.php"; ?>
<div class=box_bg>&nbsp; </div>


<?php include "../jiaoyu/jylink.php"; ?>
<div class=box_bg>&nbsp; </div>
