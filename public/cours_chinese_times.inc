<?php

//拼音班(7岁起）, 
$T_CC0 = array(
	"星期六 10:30-12:30",
	"星期三/星期六 14:00—15:30", 
	"星期三/星期日 15:45-17:15"
);
// "汉语一册"
$T_HY1 = array(
	"星期六 10:30-12:30", 
	"星期日 10:30-12:30", 
	"星期三/星期六 15:45-17:15",
	"星期三/星期日 14:00-15:30"
);
//"汉语二册", 	
$T_HY2 = array(
	"星期六:10:30-12:30", 
	//"星期日:10:30-12:30", 
	"星期三/星期六 15:45-17:15", 
	"星期三/星期日 14:00-15:30"
);

$T_HY3 = array(
		"星期六 10:30-12:30",
		"星期日 10:30-12:30",
		"星期三/星期六 14:00-15:30",
		"星期三/星期日 15:45-17:15",
);

$T_HY4 = array(
	"星期六 10:30-12:30", 
		"星期三/星期六 14:00-15:30",
		"星期三/星期六 15:45-17:15",
);

$T_HY5 = array(
	"星期六  15:40-17:40", 
	"星期日  13:30-15:30",
	"星期三/星期六  15:45-17:15",

);
$T_HY6 = array(
		"星期六 13:30-15:30",
		"星期三/星期六 14:00-15:30"
);
$T_HY7 = array(
	"星期日 13:30-15:30"
);
$T_HY8 = array(
		"星期六 13:30-15:30",
		"星期日 10:30-12:30",
		"星期日 15:40-17:40"
);
$T_HY10 = array(
	"星期日 13:30-15:30", 
);
$T_HY12 = array(
	"星期六 15:40-17:40"

);
$T_ZW10 = array("星期日 15:40-17:40");
$T_LV12 = array("星期日 10:30-12:30");
$T_LV23 = array("星期日 13:30-15:30");




$CLASS_COURS_CHINOIS = array(
array("中文课",			"chinois",			1,
	array("拼音班", 	"chinoisclasse0", 	0, 	$T_CC0),
	array("汉语一册", 	"chinoisclasse1",	1,	$T_HY1),
	array("汉语二册", 	"chinoisclasse2",	1,	$T_HY2),
	array("汉语三册", 	"chinoisclasse3",	1,	$T_HY3),
	array("汉语四册", 	"chinoisclasse4",	1,	$T_HY4),
	array("汉语五册", 	"chinoisclasse5",	1,	$T_HY5),
	array("汉语六册",  	"chinoisclasse6",	1,	$T_HY6),
	//array("汉语七册",  	"chinoisclasse7",	0,	$T_HY7),
	array("汉语八册", 	"chinoisclasse8",	1,	$T_HY8),
	array("汉语十册", 	"chinoisclasse10",	1,	$T_HY10),
	array("汉语十二册", 	"chinoisclasse12",	1,	$T_HY12),
	array("阅读提高班", 	"chinoisclasse100",	1,	$T_ZW10),
	array("LV1-2", 		"chinoisclasselv2",	1,	$T_LV12),
	array("LV2-3", 		"chinoisclasselv3",	1,	$T_LV23),
)
);
?>
