
<!------  hui gu ------>
<?php 
include_once ("../album/album_items.inc");
include_once ("huigu_include.php");
$nb_album = count($ALBUM_ITEM_NAME)-1;
$nb_huigu = count($HUIGU_ITEM_NAME)-1;
$nb_show = 4;
?>

<div class="right_box right_box3">
	<div class=huigu_img>&nbsp; </div>
	<div class="right_album">		
		<ul id="ASlide">
<?php 
		$nb = 0;
		$first = 1;
		for ($i = $nb_album; $i >= 0; $i--) { 
			$item = $ALBUM_ITEM_NAME[$i];
			if ($item[7]) {
				$atitle = $item[1];
				$aimage = $item[6];
				if ($first) {
					echo("<li style='display: block;' class='ASample'>");
				}
				else {
					echo("<li style='display: none;' class='ASample'>");
				}
				echo("<a href='../album/album.php?groups=".$i."'><IMG style='z-index:2' SRC='".$PHOTO_PATH."album/".$aimage. "' border=0 width='300px' height='200px'></a>");
				echo("<h5><a href='../album/album.php?groups=".$i."'>".$atitle."</a></h5>");
				echo("</li>");
				/* show only the last 4 album */
				$nb++;
       			if (($nb_album-$i+1) >= $nb_show) {
					break;
				}
				$first = 0;
			}
		} 
		for ($i = $nb_huigu; $i >= 0; $i--) { 
			$item = $HUIGU_ITEM_NAME[$i];
			$atitle = $item[1];
			if (!$atitle)
				$atitle = $item[0];
			$aimage = $item[6];
			if ($item[7]) {
	      		echo("<li style='display: none;' class='ASample'>");
				echo("<a href='../huigu/?hgindex=".$i."'><IMG style='z-index:2' SRC='".$PHOTO_PATH.$aimage. "' border=0 width='300px' height='200px'></a>");
				echo("<h5><a href='../huigu/?hgindex=".$i."'>".$atitle."</a></h5>");
				echo("</li>");
				/* show only the last 5 huigu */
				$nb++;
				if (($nb_huigu-$i+1) >= $nb_show) {
					break;
				}
			}
		} 
?>
		</ul>
		<div id="ASIndex">
	        <ul>
	    <?php 
			$left=170-10*$nb;
			$first = 1;
	    	for ($i = $nb_album; $i >= 0; $i--) { 
				if ($ALBUM_ITEM_NAME[$i][7]) {
	    			if ($first) {
	    				echo("<li style='left:".$left."px; top:225px;' class='li_0a current'>");
	    			}
	    			else {
	    				echo("<li style='left:".$left."px; top:225px;' class='li_0a'>");
	    			}
       				echo("<a href='../album/album.php?groups=".$i."'>&bull;</a></li>");
	    			$left +=18;
       				if (($nb_album-$i+1) >= $nb_show) {
						break;
					}
					$first = 0;
				}
	    	}
	    	for ($i = $nb_huigu; $i >= 0; $i--) { 
	    		if ($HUIGU_ITEM_NAME[$i][7]) {
		    		echo("<li style='left:".$left."px; top:225px;' class='li_0a'>");
	       			echo("<a href='../huigu/?hgindex=".$i."'>&bull;</a></li>");
		    		$left +=18;
	       			if (($nb_huigu-$i+1) >= $nb_show) {
						break;
					}
	    		}
	    	}
	        ?>
	        </ul>
      	</div>
	</div>
</div>

<script language="javascript" type="text/javascript" src="../javascript/yao.js"></script>
<script language="javascript" type="text/javascript">
        <!--
        YAO.YTabs({
                tabs: YAO.getEl('ASIndex').getElementsByTagName('li'),
                contents: YAO.getElByClassName('ASample', 'li', 'ASlide'),
                defaultIndex: 0,
                auto: true,
                fadeUp: true
        });
        //-->
</script>


