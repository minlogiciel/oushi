
<?php 
$JYRESUM = array(
"欧洲时报文化中心始终重视文化教育，是巴黎资格最老的中文学校之一。学校以教师认真负责、教学质量高著称，即是国侨办授予的首批海外华文教育示范学校，也是国家汉办在法国开设的第一个孔子课堂。",
 	"2005年，由欧洲时报牵头成立的法国华文教育协会，广泛联系了法国，尤其是大巴黎区的中文学校，为传承中国传统、弘扬中国文化，推进华文教育全力合作。"
);

?>
<div class="right_box right_box3">
	<div class=item_tit><p class=OUSHI_INFO_TIT>文化教育</p></div>
	<div class=item_txt>
	<?php 
	for ($i = 0; $i < count($JYRESUM); $i++) {
		echo("<p class=OUSHI_INFO>".$JYRESUM[$i]."</p>");
	}
	?>
	<p class=OUSHI_INFO>&nbsp; </p>
	</div>
</div>
