
<div class="right_box right_box3">
	<div class=item_tit><p class=OUSHI_INFO_TIT><?php echo($WY_TEXT[0]); ?></p></div>
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
	<div class=lastnews_img>&nbsp; </div>
	<div class=item_txt>
<?php 
		$n_item = 5;
		$newsclass = new NewsListClass();
   		$news_item = $newsclass->getLastNewsLists($FASTNEWS_WY);
		$nb = count($news_item);
		for ($i = 0; $i < $n_item; $i++) {
			$nb--;
			$id = $news_item[$nb]->getID();
			$title = $news_item[$nb]->getTitle();
			echo("<div class=textlink>&#149;<a href='../wenyi/?action=detail&hindex=".$id."'>".$title."</a></div>"); 
		}
?>
	</div>
	<br><br>
	<div class="box_more_r">
		<div class=more_bottom>
			<a class=box_tit_more href='../wenyi/?action=morenews'>更多 <font color=red>&#187;</font></a>
		</div>
	</div>
	
</div>
<div class=box_bg>&nbsp; </div>

<!------  hui gu ------>
<?php include "../huigu/huiguright1.php"; ?>
<div class=box_bg>&nbsp; </div>

<?php 
$WYLINK = array("友情链接",
	"欧洲时报",				"http://www.oushinet.com", "oushi.jpg",
	"欧时代", 					"http://www.oushidai.com/home/pc?local=eu", "oushidai.jpg",
);

?>

<div class="right_box right_box3">
	<div class=link_img>&nbsp; </div>
<?php for ($i = 1; $i < count($WYLINK); $i+=3) {?>
	<div class=textlink>
		<A href="<?php echo($WYLINK[$i+1]); ?>" target=_blank><IMG SRC="../photos/logos/<?php echo($WYLINK[$i+2]); ?>" width=32 height=32 border=0></A>
		<A href="<?php echo($WYLINK[$i+1]); ?>" target=_blank><?php echo($WYLINK[$i]); ?></A>
	</div>
<?php  } ?>		
</div>
<div class=box_bg>&nbsp; </div>