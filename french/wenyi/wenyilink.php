<?php 
$LINK1 = array("Accès direct",
	"Journal des Nouvelles d’Europe",			"http://www.oushinet.com", 		"oushi.jpg",
	"France Zone",								"http://fzone.oushinet.com", 	"fazhong.jpg",
);

?>

<div class="right_box right_box3">
	<div class=right_tit_img><?php echo($NAME_LINK); ?></div>
	<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<?php for ($i = 1; $i < count($LINK1); $i+=3) {?>
	<TR>
	<TD width=20% height=35>
	<div class=textlink>
		<A href="<?php echo($LINK1[$i+1]); ?>" target=_blank><IMG SRC="<?php echo($PHOTO_PATH); ?>/logos/<?php echo($LINK1[$i+2]); ?>" width=32 height=32 border=0></A>
	</div>
	</TD>
	<TD width=80% >
	<div class=textlink>
		<A href="<?php echo($LINK1[$i+1]); ?>" target=_blank><?php echo($LINK1[$i]); ?></A>
	</div>
	</TD>
	
	</TR>
<?php  } ?>
	</TABLE>
</div>

