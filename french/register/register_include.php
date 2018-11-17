<?php

include_once("f_time_table.inc");

$DESPSUMMER = array(
array("Beijing : ",		"Cours de chinois, peinture, origami, ping-pong, natation, visites des monuments de Beijing…"),
array("Beijing et Mongolie intérieur : ", 	"Cours de chinois, peinture, origami, ping-pong, natation, visites des monuments de Beijing…"),
array("Remarques : ",  "de 12–17 ans （en bonne santé） ", " fournir une copie du passeport avec le règlement des frais de réservation de 200 euros en espèces ou par chèque à l'ORDRE : Association Des Amis de Nouvelle d'Europe"), 
);


$REGISTER_DESP = array(
array(" ",	"Tous les champs  <font color=red>*</font> sont obligatoires"),
array("  ", 	"Paiement nécessaire préalable pour s’inscrire."),
array(" ",  "Forfait par session, sans remboursement en cas d’absence."), 
array("Chèque à l’ordre de ： ", "Association des Amis de Nouvelles d’Europe"),
array(" Adresse ： ",				"Association des Amis de Nouvelles d’Europe, <br>48-50 Rue Benoît Malon, <br>94250 Gentilly"),
);


$REGISTER_RESU = array(
array("  ", "Votre inscription a bien été enregistrée."),
array(" ", 	"Paiement nécessaire préalable pour s’inscrire."),
array(" ",  "Forfait par session, sans remboursement en cas d’absence."), 
array("Chèque à l’ordre de ： ",	"Association des Amis de Nouvelles d’Europe"),
array("Addresse : ",	"Association des Amis de Nouvelles d’Europe, <br>48-50 Rue Benoît Malon, <br>94250 Gentilly"),
);

$SHUQICLASS = array(array("14h00-15h30", "拼音书写", "书法国画", "围棋", "武术", "手工"), array("15h45-17h15", "拼音书写", "书法国画", "围棋", "武术", "手工"));

$PERSONINFOS = array("Taille", "Alimentaires Allergique", "Poids",  "Allergie", "Taille de vêtements", "Maladie", "Taille de Chaussure", "Religion");


$REGISTER_TAB = array(
array("Cours de Langue", 			"langage",			1,	
//	array("Cours de langue française", 		"francais", 				1, $T_A_F),
	array("Cours de chinois préscolaire ",		"children",				0, $T_C_C),
	array("Cours de chinois pour enfants et adolescents ",	"chinois", 	1),
	array("Cours de chinois pour adultes",		"adulte",				1, $T_A_C),    
//	array("Cours de conversation",	"huihua",							0,	$T_A_H),
),
array("文体活动",			"wenti",			1, 	
		array("Yoga",			"yujia", 									1, 	$T_YJ),
		array("Guqin",			"guqin", 									1, 	$T_GUQ),
		array("Mulan", 			"mulan", 									1,  $T_ML),
	array("Qigong", 			"qigong", 								1, 	$T_QG),
	array("Tai Chi", 			"taiji", 								1, 	$T_TJ),
//	array("Club de Randonnée", 	"tubu", 								1, 	$T_TB, array("Graduite")),
),
array("文娱活动",			"wenyu",			1, 	
	array("Danses folkloriques",		"xingti", 				1,	$T_XT),
	array("Danse en ligne", 			"jianshenwu",					1,	$T_JS),
	array("Danse de Salon", 			"shalongwu", 					1,	$T_SL),
	//array("Danse Classique", 			"guodian",					1,	$T_GD),
	array("Chorale",			"hechangtuan",							1,	$T_HC),
),
/*
array("Stage d'été", 				"summer",			1,
	array("Stage linguistique d'été", 			"summerxungen",			0,	$T_ETE, $T_ETE_P),
),
*/

array("暑期活动",			"shuqihuodong",		1, 	
	array("Classes d'été", 		"shuqipinyin",							1, $T_SQ),
),

array("Formation d'informatidue", 			"diannao",			1,
	array("Formation d'informatique débutant", 		"diannaochuji", 	1,	$T_DL1),
	array("Formation d'informatique avancé", 		"diannaogaoji", 	1,	$T_DL2),
	//array("Formation E-commerce", 	"wangluoxiaoshou", 					1,	$T_WL),
),
array("才艺培训", 			"caiyi",			1,	
		array("Cours de Calligraphie et peinture pour adultes,",	"shuhua", 				1,	$T_SH),
		array("Cours de Calligraphie  pour enfants,",	"meishu", 				1,	$T_CSH),
		array("Cours de piano",			"piano", 							1,	$T_GQ),
	array("Cours de danse pour enfants",		"dance", 				1,	$T_WD),
	//array("Cours de Kung Fu pour enfants",		"wushu", 				1,	$T_WS),
),
/*
array("Tests chinois ", 			"concours",			1,	
//	array("Tests chinois",			"concoursyct", 		0,	$T_YCT),
	array("Concours de la culture chinois",	"concourswenhua",	1,	$T_CONCOURS),
),
*/

);

$CLASS_COURS_CHINOIS = array(
array("中文课",			"chinois",			1,
	array("Pinyin", 	"chinoisclasse0", 	0, 	$T_CC0),
	array("Hanyu 1", 	"chinoisclasse1",	1,	$T_HY1),
	array("Hanyu 2", 	"chinoisclasse2",	1,	$T_HY2),
	array("Hanyu 3", 	"chinoisclasse3",	1,	$T_HY3),
	array("Hanyu 4", 	"chinoisclasse4",	1,	$T_HY4),
	array("Hanyu 5", 	"chinoisclasse5",	1,	$T_HY5),
	array("Hanyu 6",  	"chinoisclasse6",	1,	$T_HY6),
	//array("Hanyu 7", 	"chinoisclasse7",	0,	$T_HY7),
	array("Hanyu 8", 	"chinoisclasse8",	1,	$T_HY8),
	array("Hanyu 10", 	"chinoisclasse10",	1,	$T_HY10),
	array("Hanyu 12", 	"chinoisclasse12",	1,	$T_HY12),
	array("Cours intensif de Compréhension écrite", 		"chinoisclasse100",	1,	$T_ZW10),
	array("LV1-2", 		"chinoisclasselv2",	1,	$T_LV12),
	array("LV2-3", 		"chinoisclasselv3",	1,	$T_LV23)
)
);

?>
