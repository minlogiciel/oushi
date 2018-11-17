<?php

include_once ("../form/form_include.php");
include_once ("../admin/AdminFunction.php");
include_once ("../teacher/teacher_include.php");

include "../admin/BaseList.php";
include_once ("../public/admin_public_include.inc");
include_once ("../teacher/teacher_list.inc");
include_once ("../teacher/teacher_cours.inc");

$SHOWMEMBER = "showmember";

$ADMIN_USER		= 4;
$TEACHER_USER 	= 1;
$UPDATE_USER	= 2;
$OTHER_USER		= 0;
$BIBLIO_USER	= 3;

$ADMIN_USER_NAME 	= array(
	array("管理员", 		$ADMIN_USER),
	array("更新用户", 	$UPDATE_USER),
	array("教师",  		$TEACHER_USER),
	array("普通用户", 	$OTHER_USER)
	//array("图书管理", 	$BIBLIO_USER)
);

function getAdminUserTypeName($level) {
	global $ADMIN_USER_NAME;
	for ($i = 0; $i < count($ADMIN_USER_NAME); $i++) {
		if ($ADMIN_USER_NAME[$i][1] == $level) {
			return $ADMIN_USER_NAME[$i][0];
		}
	}
	return "NO FOUND";
}

$ADDINFOITEMS= array(
	array("教师交流", 		"", 		$TEACHER_USER),
	array("添加消息", 		"", 		$UPDATE_USER),
	array("精彩回顾", 		"", 		$UPDATE_USER),
	array("注册报名", 		"", 		$TEACHER_USER),
	array("上传照片", 		"", 		$UPDATE_USER),
	array("幻灯片", 			"", 		$UPDATE_USER),
	array("主页消息", 		"", 		$UPDATE_USER),
	array("文化教育", 		"jiaoyu", 	$UPDATE_USER),
	array("文化交流", 		"jiaoliu", 	$UPDATE_USER),
	array("交流相关照片", 	"", 		$UPDATE_USER),
	array("文化娱乐",		"wenyi", 	$UPDATE_USER),
	array("课表",		"", 		$TEACHER_USER),
	array("通知",		"", 		$TEACHER_USER),
	array("图书", 		"", 		$TEACHER_USER),
	array("学生作品", 		"", 		$TEACHER_USER),
	array("用户管理", 		"", 		$ADMIN_USER),
);
	
$TEACHER_TYPE 	= 0;
$NEWS_TYPE		= 1;
$HUIGU_TYPE		= 2;
$HDBM_TYPE		= 3;
$ALBUM_TYPE		= 4;
$PHOTO_TYPE		= 5;
$MNEWS_TYPE		= 6;
$JYNEWS_TYPE	= 7;
$JLNEWS_TYPE	= 8;
$JLPHOTO_TYPE	= 9;
$WYNEWS_TYPE	= 10;
$CTIMES_TYPE	= 11;
$ANNO_TYPE		= 12;
$BIBLIO_TYPE	= 13;
$STUDENT_TYPE	= 14;
$ADMIN_USER_TYPE = 15;
$MODIF_USER_TYPE = 100;

$REGTAB = array(
array("中文学校中文班报名", 	"2014-1-2", 1),
array("华裔青少年夏令营", 	"2014-5-2", 1),
array("舞塑班",				"时间待定", 0),
array("暑期拼音班",			"时间待定", 0),
array("暑期少儿武术班",		"时间待定", 0),
array("书法、山水画班 ",		"时间待定", 0),
array("徒步俱乐部",			"时间待定", 0),
array("电脑班 ",				"时间待定", 0),
array("木兰拳  ",				"时间待定", 0),
array("瑜伽班",				"时间待定", 0),
array("集体交谊舞 ",			"时间待定", 0),
array("合唱团 ",				"时间待定", 0)
);


$TEACHER_ITEM = array(
	array("教师通讯录"),
	array("教师课表"),
);
$T_ADDRESS_TYPE 		= 0;
$T_SCHEDULE_TYPE		= 1;
$T_COMUNICATION_TYPE	= 2;

?>