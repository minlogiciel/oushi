
<?php 
$LINK1 = array("Accès direct",
	"Education de Langue Chinoise",					"http://www.oushinet.com", 		"huajiao.jpg",
	"Institut Confucius (Hanban)",					"http://www.hanban.edu.cn", 	"kongyuan.jpg",
	"UNESCO",										"http://www.unesco.org/new/zh", "unesco.jpg",
	"Association d'Education de Langue Chinoise", 	"http://www.shihan.org.cn", 	"worldhangyu.jpg",
	"Association d'Education de Langue Chinoise en France", 			"http://afpc.asso.fr", 			"fhassosiation.jpg",
	"Institut Confucius",							"http://www.chinesecio.com/", 	"kongyuan.jpg",
	"Tests de langue chinoise",					"http://www.chinesetest.cn", 	"hanban.jpg",
	"Institut de Formation Franco-Chinois", 		"http://iffcparis.blogspot.fr/", "zhonghua.jpg",
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
