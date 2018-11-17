<!------  album ------>
<?php 
$albumindex = isset($_POST["albumindex"]) ? $_POST["albumindex"] : (isset($_GET["albumindex"]) ? $_GET["albumindex"] : -1);

include_once ("../album/album_items.inc");
$curr_url = $_SERVER["PHP_SELF"]; 

$n_next = 1;
$n_prev = -1;
if ($albumindex < 0) {
	$atitle = $ALBUM_ITEM_NAME[0][1];
	$aimage = $ALBUM_ITEM_NAME[0][6];
	$n_album = 0;
	for ($i = 1; $i < count($ALBUM_ITEM_NAME); $i++) {
		$active = $ALBUM_ITEM_NAME[$i][7];
		if ($active) {
			$atitle = $ALBUM_ITEM_NAME[$i][1];
			$aimage = $ALBUM_ITEM_NAME[$i][6];
			$n_album = $i;
			$n_next = $i+1;
			$n_prev = $i-1;
		}
	}
}
else {
	$atitle = $ALBUM_ITEM_NAME[$albumindex][1];
	$aimage = $ALBUM_ITEM_NAME[$albumindex][6];
	$n_album = $albumindex;
	$n_next = $albumindex+1;
	$n_prev = $albumindex-1;
}

if ($n_next >= count($ALBUM_ITEM_NAME)) {
	$n_next = -1;
}

?>
<div class="right_box right_box3">
    <div class=album_box>
<?php 
	echo("<h1>"); 
    if ($n_prev >= 0) {
 		echo("<a href='".$curr_url."?albumindex=".$n_prev."'>&#171;</a>"); 
    }
	echo("&nbsp;&nbsp;<a href='../album/album.php?groups=".$n_album."'>".$atitle."</a>&nbsp;&nbsp;"); 
    if ($n_next > 0) {
 		echo("<a href='".$curr_url."?albumindex=".$n_next."'>&#187;</a>");
    }
	echo("</h1>"); 
?>
	</div>
    <div class="img">
       	<a href="../album/album.php?groups=<?php echo($n_album); ?>"><img src="../photos/album/<?php echo($aimage); ?>" border='0' width='280px'></a>
    </div>
</div>
<div class=box_bg>&nbsp; </div>
