<?php
include ("rootvar.php");
include ($FDOC_PATH."/php/allinclude.php");
session_start();
include ($FDOC_PATH."/php/title.php");

$vtitle = isset($_GET["vtitle"]) ? $_GET["vtitle"] : (isset($_POST["vtitle"]) ? $_POST["vtitle"] : "歌唱会");
$vname = isset($_GET["vname"]) ? $_GET["vname"] : (isset($_POST["vname"]) ? $_POST["vname"] : "childrensingsing.avi");
$vtype = isset($_GET["vtype"]) ? $_GET["vtype"] : (isset($_POST["vtype"]) ? $_POST["vtype"] : "");
?>

<BODY>
<div class="content">
<?php include ($FDOC_PATH."/php/maintitle.php"); ?>
<div class="left">
	<div class="left_box">
   		<div class=PROG_TIT1><br>
    		<h1><?php echo($vtitle); ?></h1>
    		<br>
 			<div class=red_line>&nbsp; </div>
     	</div>
     	<br><br>
<?php if ($vtype == "youtube") { ?>
   		<div class="PROG_TIT1">
			<iframe src="http://www.youtube.com/embed/<?php echo($vname); ?>?wmode=transparent" width="600" height="450" frameborder="0" allowfullscreen></iframe>
		</div>
<?php } else { ?>
    	<div class="PROG_TIT1">
			<object width=600
			  id      ="MediaPlayer"
			  type    ="application/x-oleobject"
			  standby ="Loading Windows Media Player components..."
			  classid ="CLSID:22D6f312-B0F6-11D0-94AB-0080C74C7E95"
			  codebase="http://activex.microsoft.com/activex/controls/mplayer/
			            en/nsmp2inf.cab#Version=6,4,7,1112">
			  <param name="showControls" value="true">
			  <param name="autoStart"    value="true">
			  <param name="filename"     value="../video/<?php echo($vname); ?>">
			  <embed width=600 height=450  src="../video/<?php echo($vname); ?>"
			         type="application/x-mplayer2" showControls=1 autoStart=1></embed>
			 </object>
     	</div>
     	<div class='box_txt'> 
     		<div class='same_item'>
	<?php 
		for ($i = 0; $i < count($JY_VIDEO_TAB); $i++) {
			$item = $JY_VIDEO_TAB[$i];
			if (count($item) > 1) {
				echo("<a href='../php/?vtitle=".$item[1]."&vname=".$item[0]."'>");
				echo("<IMG SRC='../images/video-player-3.jpg' width=100  height=70></a>");
			}
		}
	?>
			</div>
		</div>
<?php } ?>     	
     	
    </div>
</div>

<div class="right">
	<?php include ($FDOC_PATH."/php/right.php"); ?>    
</div>
</div>
<?php include ($FDOC_PATH."/php/foot.php"); ?>

</body>
</html>
