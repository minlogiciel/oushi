<?php 
$LINK1 = array("友情链接",
	"欧洲时报",				"http://www.oushinet.com", "oushi.jpg",
	"欧时代", 					"http://www.oushidai.com/home/pc?local=eu", "oushidai.jpg",
	"中国华文教育网", 		"http://www.hwjyw.com", "huajiao.jpg",
	"孔子学院总部、国家汉办",	"http://www.hanban.edu.cn", "kongyuan.jpg",
	"汉语考试服务网",		"http://www.chinesetest.cn", "hanban.jpg",
//	"法国中华学校", 				"http://iffcparis.blogspot.fr/", "zhonghua.jpg",
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
