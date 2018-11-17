<?php

$YUNNAN_PHOTOS = array(
	"../photos/yunnan/yunnan1.jpg", " ", 
	"../photos/yunnan/yunnan11.jpg", " ", 
	"../photos/yunnan/yunnan12.jpg", " ", 
	"../photos/yunnan/yunnan13.jpg",	" ",
	"../photos/yunnan/yunnan2.jpg", " ", 
	"../photos/yunnan/yunnan4.jpg",	" ",
	"../photos/yunnan/yunnan10.jpg", " ", 
);

$TONEWSCHOOL_PHOTOS = array(
		"../photos/school/top_newschool.jpg", 	"欧洲时报文化中心新址",
		"../photos/school/top_deng.jpg",      	"", 
		"../photos/school/top_zhang.jpg",		"", 
		"../photos/school/top_maire.jpg",		"",
		"../photos/school/top_zhong.jpg",		"", 
		"../photos/school/top1.jpg",			""
);

$NEWSCHOOL_PHOTOS = array(
	"../photos/school/school.jpg", 		"欧洲时报文化中心",
	"../photos/school/school2.jpg", 	"大厅",
	"../photos/school/classroom.jpg",	"教室",
	"../photos/school/danceroom.jpg",	"舞厅",
);

$PHOTOEXPO_PHOTOS = array(
	"../photos/expo/expo1.jpg", "", 
	"../photos/expo/expo2.jpg", "", 
	"../photos/expo/expo3.jpg", "", 
	"../photos/expo/expo4.jpg", "", 
	"../photos/expo/expo5.jpg", ""
); 


/****** top 5 photos ************/ 
function getTopURL($tab) {
	return ("../".$tab[2]."/?action=detail&hindex=".$tab[3]);
}

$TOPPHOTOS = array(
array("国侨办马儒沛副主任来访 ", 				"top/topma1.jpg", 			"jiaoliu", 	0),
array("欧洲时报文化中心筹备迎马年华法联欢会 ", "top/fete650.jpg",			"jiaoliu", 	1),
array("欧洲时报文化中心新址举行揭牌仪式", 	"top/top1-650x380.jpg",		"jiaoliu", 	3),
array("2014年3月23日YCT考试报名开始", 		"top/YCT650x380.jpg",		"jiaoyu", 	5),
array("云南省中华才艺培训团赴法送艺", 		"top/yunnan650x380.jpg",	"jiaoyu",	4),
);

include_once ("lastnews/newsinclude.inc");

$HOME_JY = array("文化教育",      "../jiaoyu/",   "jiaoyu_450.jpg", 
	array($JY_NEWS1, $JY_NEWS2, $JY_NEWS3, $JY_NEWS4, $JY_NEWS5, $JY_NEWS6, $JY_NEWS7)
/*
	array(	
		array("少儿健美舞开班啦", "少儿舞蹈训练，在教学上用童心追求童趣，不仅培养学生健美的体魄，发展其灵活性，", "", "2014年1月20日",
			array(), 
			$CHILDRENDANCEBM
		),
		array("欧洲时报中文学校、欧洲时报孔子课堂喜迁新址", "欧洲时报文化中心于2013年12月初搬入位于Gentilly的新址，", "", "2013年12月10日",
			$NEWSCHOOL_PHOTOS, 
			$TO_NEWSSCHOOL
		),
		array("2013年11月YCT成绩揭晓", "2013年11月16日在欧洲时报孔子课堂举行的YCT考试成绩已经揭晓 ","","2013年12月28日",
			array(), 
			$YCT_RESULT
		),
 		array(
 			"中华文化大乐园举行闭营式",
			"“中华文化大乐园法国巴黎营”在法国巴黎精英中文学校开营，",
			"","2014年1月4日",
			array(
				"huodong/leyuan2014-1.jpg", ""
			),
			$ZHWHDLYCLOSED
		),
		array("云南省中华才艺培训团赴法送艺", "云南省海外交流协会、云南海外文化教育中心组织中华才艺培训团远赴法国","","2013年12月16日",
			$YUNNAN_PHOTOS,
			$YUNNAN,
		),
		array("2014年3月23日YCT考试报名开始", " ", "","2013年12月26日",
			array(
			"../photos/school/YCTkaoshi.jpg",	"",
			"../photos/school/yctneirong.jpg",	"",
			), 
			$YCTREGIST,
		),
		array("中华文化大乐园开园", " ","","2013年12月23日",
			array("../photos/A2-7.JPG",""), 
			$ZHWHDLY,
		),
	),
*/
);
$HOME_JL = array("文化交流", "../jiaoliu/",  "huigu_450.jpg",
 	array($JL_NEWS1, $JL_NEWS2, $JL_NEWS3, $JL_NEWS4, $JL_NEWS5, $JL_NEWS6)
/*	array(
		array(
			"国侨办马儒沛副主任来访 ",
		    "由中国国务院侨办副主任马儒沛率领的侨务考察团2月9日上午走访了刚刚投入使用不久的欧洲时报文化中心。",
			"",	"2014年2月10日",
			array(),	
			$TOPMA
		),
		array(
			"欧洲时报文化中心筹备迎马年华法联欢会 ", 
			"新年的钟声还在耳边回荡，空气中仍然洋溢着圣诞节的气息，中国春节悄悄地走近了。",
			"",	"2014年1月6日",
			array(),	
			$MANIAN
		),
		array(
			"《两岸四地摄影家合拍中国大地24小时十年回顾》摄影展", 
			"欧洲时报文化中心新址开张好戏连台！揭牌仪式当天，全新的展厅迎来了处女秀 ",
			"",	"2013年12月15日",
			$PHOTOEXPO_PHOTOS,
			$PHOTO_EXPO
			
		),
		array(
			"欧洲时报文化中心新址举行揭牌仪式", 	
			"2013年12月15日上午，位于 Gentilly 市全新的欧洲时报文化中心打开了大门，",
			"","2013年12月10日",
			array("../photos/school/top_newschool.jpg","", "../photos/school/top_deng.jpg","", "../photos/school/top_zhang.jpg","", "../photos/school/top_maire.jpg","","../photos/school/top_zhong.jpg","", "../photos/school/top1.jpg",""), 
			$NEWSCHOOL,
		),
		array(
			"中欧华文传媒高峰对话在欧洲时报文化中心新址举行", 	
			"2013年12月15日，由欧洲华文传媒协会主办、欧洲时报承办的“中欧华文传媒高峰对话”",
			"","2013年12月15日",
			array("../photos/meeting/meeting.jpg","", "../photos/meeting/meeting2.jpg","", "../photos/meeting/meeting3.jpg",""), 
			$HM_MEETING
		),
		array("开门迎街坊，香槟待朋友", 
			"2013年12月15日上午，欧洲时报文化中心举行了新址揭牌仪式，",
			"","2013年12月15日",
			array("../photos/meeting/openparty.jpg","", "../photos/meeting/party2.jpg","", "../photos/meeting/party.png",""), 
			$NEW_WELCOM
		),
	)
*/
);

$HOME_YL = array("文化娱乐", "../wenyi/",  "mulan.jpg", 
	array($WY_NEWS1, $WY_NEWS2, $WY_NEWS3, $WY_NEWS4, $WY_NEWS5)
/*	
array(	
		array("电脑培训各班开始报名", "电脑已经成为现代人生活工作中必不可少的一部分。中老年学电脑，更是生活在当下的需要。","","2014年2月6日",
			array(
			),
			$COMPUTEBM
		),
		array("木兰拳班学员拍摄比赛录像", "对于全世界的木兰拳爱好者和练习者来说，2013年中国木兰拳跨年度（碟片）国际挑战评奖大赛","","2014年1月15日",
			array(
				"../photos/mulan.jpg", "",
			),
			$MULANMATCH
		),
		array("二月新班注册", "中国书法和绘画经过几千年的历史沉淀，已经成为中国的国粹。","","2014年1月14日",
			array(
			),
			$FEBNEWCLASSBM
		),
		
		array("合唱团精心准备春节演出", "今年春节期间，合唱团的成员将应邀参加巴黎十三区市政府的团拜会","","2014年1月8日",
			array(
				"../photos/school/hechangtuan.jpg", "",
				"../photos/school/hechangtuan2.jpg", "",
			),
			$HECHANGTUAN
		),
		array("2014，新年新班", "新年伊始，欧洲时报文化中心迎来新班新学期的注册，欢迎大家踊跃报名。","","2014年1月3日",
			array(),
			$JIANMEBAN
		),
		
	),
*/
);


$HOME_RIGHT_ITEM = array($HOME_JY, $HOME_JL, $HOME_YL);


$HUIGU = array("精彩回顾", "../photos/oushi/huigu.jpg",	"../huigu/", 
"癸巳蛇年2013\"孔子学院网络春晚\"由国家汉办/孔子学院总部主办、网络孔子学院承办。这次网络春晚是孔子学院举办的第二届，从2012年11月起面向全球的孔子学院和孔子课堂征集节目，共收到了来自46个国家、112所孔子学院或课堂的500多个节目。",
"欧洲时报孔子课堂学生表演的舞蹈《蝶舞》和《小龙人》获优秀节目奖。同时，欧洲时报孔子课堂在全球众多竞争者中脱颖而出，获得最佳组织奖。"
);

?>
