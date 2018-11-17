<?php
include_once ("photosinclude.inc");
include_once ("lastnews/newsinclude.inc");
include_once ("chinese_news_include.inc");
include_once ("last_annonces.inc");

$HOME_KZXX = array("中文学校/孔子课堂",	"../jiaoyu/",   "jiaoyu_450.jpg", 	$HOME_KZXX_NEWS);
$HOME_JY = array("文化教育",		"../jiaoyu/", 			"jiaoyu_450.jpg", 	$HOME_JY_NEWS);
$HOME_JL = array("文化交流",		"../jiaoliu/",  		"huigu_450.jpg", 	$HOME_JL_NEWS);
$HOME_YL = array("文化娱乐",		"../wenyi/",  			"mulan.jpg", 		$HOME_YL_NEWS);
$HOME_HUAWEN = array("华文教育协会", "../association/",  "huajiao/2013singing3.jpg", $HOME_HUAWEN_NEWS);

$HOME_RIGHT_ITEM = array($HOME_JY, $HOME_JL, $HOME_YL);

$JY_ASSO = array("华文教育协会", "../association/",  "", 
	array("huajiao/hwassociation.jpg", ""),
	array(
"2005年，由欧洲时报牵头成立了法国华文教育协会，秘书处设在欧洲时报文化中心，目前已经发展到有40多个会员学校。华文教育协会以推进海外华文教育为己任，以弘扬中华文化为宗旨，联合华埠各社团，注重各会员学校之间的交流和合作，不定期举办教师培训，提高广大中文教师的教学能力。同时，坚持每两年举行一次大型的校际比赛或联欢活动，增强各校师生的联系。"),
);


$HUIGU = array("精彩回顾", 	"huigu", "oushi/huigu300x240.jpg", " ",
	array(
			"intro"
	),
	
	$HGNEWS1
);

?>
