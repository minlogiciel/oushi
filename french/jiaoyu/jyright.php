
<?php include ($FDOC_PATH."/jiaoyu/jyresum.php"); ?>
<div class=box_bg>&nbsp; </div>

<?php include $FDOC_PATH."/jiaoyu/schedulelist.php"; ?>
<div class=box_bg>&nbsp; </div>

<div class="right_box right_box3">
	<div class=right_tit_img><?php echo($NAME_LASTNEWS); ?></div>
	<div class=item_txt><br>
		<ul>
<?php 
		$n_item = 5;
		$newsclass = new NewsListClass();
   		$news_item = $newsclass->getLastNewsLists($FASTNEWS_JY);
		$nb = count($news_item);
		for ($i = 0; $i < $n_item; $i++) {
			$nb--;
			$id = $news_item[$nb]->getID();
			$title = $news_item[$nb]->getFTitle();
			echo("<div class=textlink><li><a href='../jiaoyu/?action=detail&hindex=".$id."'>".$title."</a></li></div><br>"); 
		}
?>		
		</ul>
		<div class=textlink>
			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  
			<a  href='../jiaoyu/?action=morenews'>+plus <font color=red> &#187;</font></a>
		</div>
	</div>
	<br>
</div>
<div class=box_bg>&nbsp; </div>



<!------- google map --------> 
<?php include ($FDOC_PATH."/php/googlemap.php"); ?>
<div class=box_bg>&nbsp; </div>

<?php 
include $FDOC_PATH."/jiaoyu/jylink.php"; 
?>
