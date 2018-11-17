<?php 
$LINK1 = array("友情链接",
	"欧洲时报",				"http://www.oushinet.com", "oushi.jpg",
	"欧时代", 					"http://www.oushidai.com/home/pc?local=eu", "oushidai.jpg",
	"中国驻法国大使馆",	"http://www.amb-chine.fr/chn/", "chine.jpg",
	"巴黎中国文化中心", 	"http://paris.cccweb.org/", 	"ccc.jpg",
	"国务院侨办", 		"http://www.gqb.gov.cn/", 			"chine.jpg",
);


?>

<div class="right_box right_box3">
	<div class=link_img>&nbsp; </div>
<?php for ($i = 1; $i < count($LINK1); $i+=3) {?>
	<div class=textlink>
		<A href="<?php echo($LINK1[$i+1]); ?>" target=_blank><IMG SRC="../photos/logos/<?php echo($LINK1[$i+2]); ?>" width=32 height=32 border=0></A>
		<A href="<?php echo($LINK1[$i+1]); ?>" target=_blank><?php echo($LINK1[$i]); ?></A>
	</div>
<?php  } ?>

</div>
