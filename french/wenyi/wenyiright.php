
<div class="right_box right_box3">
	<div class=item_tit><?php echo($WY_TEXT[0]); ?></div>
	<div class=item_txt>
	<?php 
	for ($i = 1; $i < count($WY_TEXT); $i++) {
		echo("<p class=OUSHI_INFO>".$WY_TEXT[$i]."</p>");
	}
	?>
	</div>
</div>
<div class=box_bg>&nbsp; </div>

<div class="right_box right_box3">
	<div class=right_tit_img><?php echo($NAME_LASTNEWS); ?></div>
	<div class=item_txt><br>
		<ul>
<?php 
		$n_item = 5;
		$newsclass = new NewsListClass();
   		$news_item = $newsclass->getLastNewsLists($FASTNEWS_WY);
		$nb = count($news_item);
		for ($i = 0; $i < $n_item; $i++) {
			$nb--;
			$id = $news_item[$nb]->getID();
			$title = $news_item[$nb]->getFTitle();
			echo("<div class=textlink><li><a href='".$HOST_URL."/french/wenyi/?action=detail&hindex=".$id."'>".$title."</a></li></div><br>"); 
		}
?>
		</ul>
		<div class=textlink>
			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  
			<a href='../wenyi/?action=morenews'>+plus <font color=red> &#187;</font></a>
		</div>

	</div>
	<br>
</div>
<div class=box_bg>&nbsp; </div>

<!------  hui gu ------>
<?php include $FDOC_PATH."/huigu/huiguright.php"; ?>
<div class=box_bg>&nbsp; </div>

<?php include "wenyilink.php"; ?>
<div class=box_bg>&nbsp; </div>


