<?php

include ("jiaoliupagephoto/jiaoliuphotos.inc");
include_once("jiaoliupage/jiaoliupageinfos.inc");
include_once("jl_list_include.inc");

$JL_TEXT = array(
"文化交流",
"欧洲时报文化中心依托《欧洲时报》，注重联络东西方，促进中法文化交流。一方面积极和国内相关文化团体合作，通过展览等形式增进旅法华侨与祖（籍）国的联系，另一方面与主流社会合作，帮助华侨了解法国社会及文化，并为大家提供了一个展示的平台。",
"全新装修的400平米展厅，跃层设计，风格独特，堪称巴黎798，将成为文化交流领域的新亮点。"
);


$JL_TAB = array(
array("展览", "exposition", "expo/expo3.jpg","expo.png",
	array("intro"),
	$JL_EXPO
),
	
array("讲座、论坛", "formation", "school/teacher.jpg", "lecture.png",
	array("intro"),
	$JL_CONF
),

array("其它", "conference", "meeting/meeting.jpg", "yanchu.png",
	array("intro"),
	$JL_FETE
),
/* to expo_include.inc
array("展厅展示", "salleexpo", "salleexpo/salleexpo600x450.jpg", "salleexpo.png",
	array(
		"欧洲时报文化中心新址位于巴黎南部近郊的Gentilly市，紧邻巴黎著名的大学城。整体设计雅致大方，既尊重法国建筑传统，又暗合中国传统的天人合一理念，体现人文思想。 ",
		"跃层式结构的展厅全新装修，上下两层共有400平米。整个展厅设计风格独特，充分地保留了原来的现代工业框架，堪称巴黎的798。"
	),
	array($JL_NEWS_EXPO_s)
),
*/

);


?>
