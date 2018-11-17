<?php

$EXPO_sp = array(
		array("salleexpo/int-800x600.jpg",	"salleexpo/int-800x600.jpg",	"一层展厅内侧", "Première Etage"),
		array("salleexpo/ext-800x600.jpg",	"salleexpo/ext-800x600.jpg",	"展厅入口", "Entrée"),
		array("salleexpo/mezzanine1-800x1000.jpg",	"salleexpo/mezzanine1-800x1000.jpg",	"廊桥", ""),
		array("salleexpo/mezzanine3-800x1000.jpg",	"salleexpo/mezzanine3-800x1000.jpg",	"廊桥", ""),
		array("salleexpo/mezzanine2-800x600.jpg",	"salleexpo/mezzanine2-800x600.jpg",	"廊桥", ""),
		array("salleexpo/expo1-800x600.jpg",	"salleexpo/expo1-800x600.jpg",	"一层展厅效果", "Première Etage"),
		array("salleexpo/expo2-800x600.jpg",	"salleexpo/expo2-800x600.jpg",	"一层展厅效果", "Première Etage"),
		array("salleexpo/expo3-800x600.jpg",	"salleexpo/expo3-800x600.jpg",	"一层展厅效果", "Première Etage"),
		array("salleexpo/expo4-800x600.jpg",	"salleexpo/expo4-800x600.jpg",	"一层展厅效果", "Première Etage"),
		array("salleexpo/salleexpo4-800x600.jpg",	"salleexpo/salleexpo4-800x600.jpg",	"二层展厅", "Seconde Etage"),
		array("salleexpo/salleexpo3-800x1000.jpg",	"salleexpo/salleexpo3-800x1000.jpg",	"一层展厅内侧", "Première Etage"),
		array("salleexpo/salleexpo2-800x600.jpg",	"salleexpo/salleexpo2-800x600.jpg",	"一层展厅", "Première Etage"),
		array("salleexpo/salleexpo1-800x600.jpg",	"salleexpo/salleexpo1-800x600.jpg",	"一层展厅", "Première Etage"),
		array("salleexpo/railetprojecteur-800x600.jpg",	"salleexpo/railetprojecteur-800x600.jpg",	"挂槽和射灯",""),
);



$JL_NEWS_EXPO_s =	array(
		"展厅",
		array("salleexpo/salleexpo600x450.jpg", "展厅展示",  "EXPO_sp"), //images
		array(
				"欧洲时报文化中心新址位于巴黎南部近郊的Gentilly市，紧邻巴黎著名的大学城。整体设计雅致大方，既尊重法国建筑传统，又暗合中国传统的天人合一理念，体现人文思想。 ",
				"跃层式结构的展厅全新装修，上下两层共有400平米。整个展厅设计风格独特，充分地保留了原来的现代工业框架，堪称巴黎的798。"
		),
		$EXPO_sp,
);

$ETAGES = array(
	
		array ("一层", "Première Etage",
				array ("schoolclass/etage1.jpg", 		"一层通道", "Première Etage"),
				array ("schoolclass/escalier.jpg", 		"楼梯", "Escalier"),
				array ("schoolclass/classroom.jpg", 	"中文教室", "Classe"),
				array ("schoolclass/biblio-600.jpg", 	"图书馆", "Bibliothèques"),
				array ("schoolclass/danceroom.jpg", 	"舞蹈大厅", "Salle de Danse"),
				array ("schoolclass/room.jpg", 			"更衣室", "Vestiaire"),
		),
		array ("二层", "Deuxième Etage",
				array ("schoolclass/etage2.jpg", 		"二层通道", "Deuxième Etage"),
				array ("schoolclass/etage1-600.jpg", 	"绿化台", "Couloir"),
				array ("schoolclass/childrenroom.jpg", 	"幼儿班教室", "Classe pour les enfants"),
				array ("schoolclass/pianoroom.jpg", 	"钢琴教室", "Salle de Piano"),
				array ("schoolclass/etage1.jpg", 	"绿化带", "Coulée Verte"),
		),
		array ("展厅展示", "Galerie",
				array("salleexpo/int-800x600.jpg",		"一层展厅内侧", "Première Etage"),
				array("salleexpo/ext-800x600.jpg",		"展厅入口", "Entrée"),
				array("salleexpo/mezzanine1-800x1000.jpg",		"廊桥", "Couloir"),
				array("salleexpo/mezzanine3-800x1000.jpg",		"廊桥", "Couloir"),
				array("salleexpo/mezzanine2-800x600.jpg",		"廊桥", "Couloir"),
				array("salleexpo/expo1-800x600.jpg",		"一层展厅效果", "Première Etage"),
				array("salleexpo/expo2-800x600.jpg",		"一层展厅效果", "Première Etage"),
				array("salleexpo/expo3-800x600.jpg",		"一层展厅效果", "Première Etage"),
				array("salleexpo/expo4-800x600.jpg",		"一层展厅效果", "Première Etage"),
				array("salleexpo/salleexpo4-800x600.jpg",		"二层展厅", "Deuxième Etage"),
				array("salleexpo/salleexpo3-800x1000.jpg",		"一层展厅内侧", "Première Etage"),
				array("salleexpo/salleexpo2-800x600.jpg",		"一层展厅", "Première Etage"),
				array("salleexpo/salleexpo1-800x600.jpg",		"一层展厅", "Première Etage"),
				array("salleexpo/railetprojecteur-800x600.jpg",	"挂槽和射灯","Couloir"),
		),
		
);


$EXPO_TAB = array(
		array("场地介绍", "Classes d'Ecole", "salleexpo/salleexpo600x450.jpg", "",
				array(
						"欧洲时报文化中心新址位于巴黎南部近郊的Gentilly市，紧邻巴黎著名的大学城。整体设计雅致大方，既尊重法国建筑传统，又暗合中国传统的天人合一理念，体现人文思想。 ",
						"跃层式结构的展厅全新装修，上下两层共有400平米。整个展厅设计风格独特，充分地保留了原来的现代工业框架，堪称巴黎的798。"
				),
				array(
						"欧洲时报文化中心新址位于巴黎南部近郊的Gentilly市，紧邻巴黎著名的大学城。整体设计雅致大方，既尊重法国建筑传统，又暗合中国传统的天人合一理念，体现人文思想。 ",
						"跃层式结构的展厅全新装修，上下两层共有400平米。整个展厅设计风格独特，充分地保留了原来的现代工业框架，堪称巴黎的798。"
				),
				$ETAGES
		),
		array("展厅展示", "salleexpo", "salleexpo/salleexpo600x450.jpg", "salleexpo.png",
				array(
						"欧洲时报文化中心新址位于巴黎南部近郊的Gentilly市，紧邻巴黎著名的大学城。整体设计雅致大方，既尊重法国建筑传统，又暗合中国传统的天人合一理念，体现人文思想。 ",
						"跃层式结构的展厅全新装修，上下两层共有400平米。整个展厅设计风格独特，充分地保留了原来的现代工业框架，堪称巴黎的798。"
				),
				array($JL_NEWS_EXPO_s)
		),
		
		
);


?>
