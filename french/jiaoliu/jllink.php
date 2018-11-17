<?php 

$LINK1 = array("Accès direct",
	"Journal des Nouvelles d’Europe",				"http://www.oushinet.com", "oushi.jpg",
	"Frence Zone", 					"http://fzone.oushinet.com", "fazhong.jpg",
	"Ambassade de la Chine en France",	"http://www.amb-chine.fr/chn/", "chine.jpg",
	"Centre culturel de Chine à Paris", 	"http://paris.cccweb.org/", 	"ccc.jpg",
	"Overseas affaires chinois Bureau du Conseil d'Etat", 		"http://www.gqb.gov.cn/", 			"chine.jpg",
);


?>
<div class="right_box right_box3">
	<div class=right_tit_img><?php echo($NAME_LINK); ?></div>
	<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
	<TR><TD colspan=2 height=10></TD></TR>
<?php for ($i = 1; $i < count($LINK1); $i+=3) {?>
	<TR>
	<TD width=15% height=30>
	<div class=textlink>
		<A href="<?php echo($LINK1[$i+1]); ?>" target=_blank><IMG SRC="<?php echo($PHOTO_PATH); ?>/logos/<?php echo($LINK1[$i+2]); ?>" width=24 height=24 border=0></A>
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
