<?php
include ("rootvar.php");
include ($FDOC_PATH."/php/allinclude.php");
session_start();
include ($FDOC_PATH."/php/title.php");
include ($FDOC_PATH."/content_include.inc");

$newsclass = new NewsListClass();
$toplists = $newsclass->getTopNews();
?>
<BODY>

<div class="content">
<?php include ($FDOC_PATH."/php/maintitle.php"); ?>
<div class="left">

<!----------- photos  ------------->
	<div class="left_pic">		
		<ul id="YSlide">
<?php 
	for ($i = 0; $i < 5; $i++) { 
		$title = $toplists[$i]->getFTitle();
		$photo = $toplists[$i]->getTopPhotoF();
		$ids = $toplists[$i]->getID();
		$topurl = getTopURL($ids);
		$toppath="top/";
   		if ($i == 0) {
			echo("<li style='display: block;' class='YSample'>");
		} else {
      		echo("<li style='display: none;' class='YSample'>");
		}
 		if (strlen($topurl) > 5) { 
 			echo("<a href='".$topurl."'>");
 			echo("<IMG style='z-index:2' SRC='".$PHOTO_PATH.$toppath.$photo."' border=0 width='650' ></a>");
			echo("<div class=title1><a href='".$topurl."'><h2>".$title."</h2></a></div>");
		} else { 
 			echo("<IMG style='z-index:2' SRC='".$PHOTO_PATH.$toppath.$photo."' border=0 width='650'>");
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
if ($LAST_ANNONCE[0][3] == 1) { 
?>
	<div class="left_box">
		<div class="box_annonce">
			<h1><?php echo($LAST_ANNONCE[0][1]); ?></h1>
      	</div>
      	<div class="box_annonce">
		<?php
			for ($n = 0; $n < count($LAST_ANNONCE[2]); $n++) {
		    	echo("<p>".$LAST_ANNONCE[2][$n]."</p>");
		 	}
		?>
       	</div>
    </div>
  	<div class=box_bg>&nbsp; </div>
<?php } ?>

<!-------- start home page items -------->
<?php 
for ($i = 0; $i < count($FHOME_RIGHT_ITEM); $i++) { 
	$home_item = $FHOME_RIGHT_ITEM[$i]; 
	$home_star = $FHOME_RIGHT_ITEM_NEW[$i];
?>
	<div class="left_box">
		<div class="box_tit">
			<div class="box_tit_img"><a href="<?php echo($home_item[1]); ?>"><?php echo($home_item[0]); ?></a></div>
			<div class="more_center">
				<a class="box_tit_more" href="<?php echo($home_item[1]); ?>?action=morenews">Plus <font color=red> &#187;</font></a>
			</div>
       	</div>
      	<div class="box_txt">
        	<div class="tit_img">
          		<img src="<?php echo($PHOTO_PATH.$home_item[2]); ?>" border="0" width="290">
        	</div>

        	<div id="ISIndex">
        	<ul>
<?php
	    	$items = $newsclass->getMainNewsLists($i);
	    	$nb_news =  count($items);
	   	 	$nb = 0;
	    	if ($nb_news) {
		      	while (($nb < 3) && ($nb < $nb_news)) {
		      		$id = $items[$nb]->getID();
		      		$title = $items[$nb]->getFTitle();
		      		$resume = $items[$nb]->getFResume();
		      		$star = $items[$nb]->getStars();
		      		echo("<li>");
		         	echo("<a href='".$home_item[1]."?action=detail&hindex=".$id."'>".$title."</a>");
		         	if ($star == 1) {
		         		echo(" <IMG src='".$PHOTO_PATH."../images/newstar.jpg' width=12>");
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

<script language="javascript" type="text/javascript" src="<?php echo($HOST_URL); ?>/javascript/yao.js"></script>
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
	<?php include ($FDOC_PATH."/home/homeright.php") ; ?>
</div>
</div>

<?php include ($FDOC_PATH."/php/foot.php"); ?>

</body>
</html>
