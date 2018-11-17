<?php
include "../php/allinclude.php";


include ("../php/title.php");
$newsclass = new NewsListClass();
$toplists = $newsclass->getTopNews();
?>
<BODY>

<div class="content">
<?php include "../php/maintitle.php"; ?>

<div class="left">

<!----------- photos  ------------->
	<div class="left_pic">		
		<ul id="YSlide">
<?php 
		for ($i = 0; $i < 5; $i++) { 
			$title = $toplists[$i]->getTitle();
			$photo = $toplists[$i]->getTopPhotoC();
			$ids = $toplists[$i]->getID();
			$topurl = getTopURL($ids);
			$toppath = "top/";
			if ($i == 0) {
				echo("<li style='display: block;' class='YSample'>");
			} else {
	      		echo("<li style='display: none;' class='YSample'>");
			}
	  		if (strlen($topurl) > 5) {
	 			echo("<a href='".$topurl."'><IMG style='z-index:2' SRC='".$PHOTO_PATH."top/".$photo. "' border=0 width='650'></a>");
				echo("<div class=title1><a href='".$topurl."'><h2>".$title."</h2></a></div>");
			} else { 
	 			echo("<IMG style='z-index:2' SRC='".$PHOTO_PATH."top/".$photo."' border=0 width='650'>");
				echo("<div class=title1><h2>".$title."</h2></div>");
			} 
			echo("</li>");
		} 
?>
		</ul>
		<div id="YSIndex">
	        <ul>
<?php 
    	for ($j = 0; $j < 5; $j++) { 
			$ids = $toplists[$j]->getID();
			$topurl = getTopURL($ids);
			$n = $j + 1;
        	if ($n == 1) {
        		if (strlen($topurl) > 5)
        			echo("<li class='li_0".$n. " current'><a href='".$topurl. "'>&nbsp;".$n."&nbsp;</a></li>");
	        	else 
        			echo("<li class='li_0".$n. " current'><font color=black>&nbsp;".$n."&nbsp;</font></li>");
        	}
        	else {
        		if (strlen($topurl) > 5)
	        		echo("<li class='li_0".$n. "'><a href='".$topurl. "'>&nbsp;".$n."&nbsp;</a></li>");
	        	else 
	        		echo("<li class='li_0".$n. "'><font color=black>&nbsp;".$n."&nbsp;</font></li>");
        	}
        }
	     ?>
	        </ul>
      	</div>
	</div>
  	<div class=box_bg>&nbsp; </div>

<?php 
if ($LAST_ANNONCE[0][2] == 1) { 
?>
	<div class="left_box">
		<div class="box_annonce">
			<h1><?php echo($LAST_ANNONCE[0][0]); ?></h1>
      	</div>
      	<div class="box_annonce">
		<?php
			for ($n = 0; $n < count($LAST_ANNONCE[1]); $n++) {
		    	echo("<p>".$LAST_ANNONCE[1][$n]."</p>");
		 	}
		?>
       	</div>
    </div>
  	<div class=box_bg>&nbsp; </div>
<?php } ?>
<!-------- start home page items -------->
<?php 
for ($i = 0; $i < count($HOME_RIGHT_ITEM); $i++) { 
	$home_item = $HOME_RIGHT_ITEM[$i]; 
	$home_star = $HOME_RIGHT_ITEM_NEW[$i];
?>
	<div class="left_box">
		<div class="box_tit">
			<div class=box_tit_img><a href="<?php echo($home_item[1]); ?>"><?php echo($home_item[0]); ?></a></div>
			<div class=box_tit_more>
				<a class=box_tit_more href="<?php echo($home_item[1]); ?>?action=morenews">更多 <font color=red>&#187;</font></a>
			</div>
      	</div>
      	<div class="box_txt">
        	<div class="tit_img">
          		<img src="<?php echo($PHOTO_PATH.$home_item[2]); ?>" border="0" width="290">
        	</div>
        	<div id="ISIndex">
        	<ul>
<?php
	      	$nb = 0;
	    	$items = $newsclass->getMainNewsLists($i);
	    	$nb_news =  count($items);
	   	 	if ($nb_news) {
		      	while (($nb < 3) && ($nb < $nb_news)) {
		      		$id = $items[$nb]->getID();
		      		$title = $items[$nb]->getTitle();
		      		$resume = $items[$nb]->getResume();
		      		$star = $items[$nb]->getStars();
		      		echo("<li>");
		         	echo("<a href='".$home_item[1]."?action=detail&hindex=".$id."'>".$title."</a>");
		         	if ($star == 1) {
		         		echo(" <IMG src='../images/newstar.jpg' width=12>");
		         	}
	         		echo("<p>".$resume." ...... </p>");
		         	echo("</li>");
		         	$nb++;
		 		}
	   	 	}
?>
		 	</ul>
        	</div>
       	</div>
    </div>
  	<div class=box_bg>&nbsp; </div>
 <?php } ?>
<!--  end home page item -->
<?php 
if (0) { 
?>
	<div class="left_box">
		<div class="box_annonce">
			<h1><?php echo($JL_NEWS24[0]); ?></h1>
      	</div>
      	<div class="box_annonce2">
      	<MARQUEE onmouseover=this.stop() onmouseout=this.start() trueSpeed scrollAmount=1 scrollDelay=25 direction=left  behavior="alternate">
      	<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
      	<TR><TD width=100%>
      	<?php 
      		$nb = count($JL_NEWS24_3_sp);
			for ($i = 0; $i < $nb; $i++) { 
				$item = $JL_NEWS24_3_sp[$i];
				echo("<IMG SRC='".$PHOTO_PATH.$item[0]."' height=150 border=0>&nbsp;");
			}
		?>
		</TD></TR>
 		</TABLE>
 		</MARQUEE>
       	</div>
    </div>
  	<div class=box_bg>&nbsp; </div>
<?php } ?>
</div>
<!------ end left ------>

<script language="javascript" type="text/javascript" src="../javascript/yao.js"></script>
<script language="javascript" type="text/javascript">
        <!--
        YAO.YTabs({
                tabs: YAO.getEl('YSIndex').getElementsByTagName('li'),
                contents: YAO.getElByClassName('YSample', 'li', 'YSlide'),
                defaultIndex: 0,
                auto: true,
                fadeUp: true
        });
        //-->
</script>

<div class="right">
	<?php include ("../home/homeright.php") ; ?>
</div>
    
</div>
</div>
<?php include "../php/foot1.php"; ?>

</body>
</html>
