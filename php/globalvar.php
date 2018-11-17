<?php
$TIME_OUT = $timeout = 60*60; // Set timeout
$ACTIVE_LOGIN = 0;
$DOC_ROOT = "/oushi/";
$DOC_PATH = $_SERVER["DOCUMENT_ROOT"].$DOC_ROOT;
$PHOTO_PATH = "../photos/";
$TEACHER_PATH = "../teacher/";

$JY_START_ITEM = 5;
$FASTNEWS_JY	= 0;
$FASTNEWS_JL	= 1;
$FASTNEWS_WY	= 2;
$FASTNEWS_ASSO	= 3;
$FASTNEWS_KZ 	= 4;
$FASTNEWS_TOP 	= 5;

$MITEM = array(
	array("&nbsp;&nbsp;首页", 		"home/"),
	array("文化教育",				"jiaoyu/?action=withhuajiao",  
		array(
				"中文学校/孔子课堂", "../jiaoyu/",		
				"华文教育协会", 		"../association/"), 
		),
	array("文化交流",			"jiaoliu/",
		array(	"展览",  		"../jiaoliu/?action=subitem&resource=exposition", 
				"讲座、论坛", 	"../jiaoliu/?action=subitem&resource=formation",
				"其它", 	"../jiaoliu/?action=subitem&resource=conference",
				/*"展厅展示", 		"../jiaoliu/?action=subitem&resource=salleexpo"*/)
		),
	array("文化娱乐",		"wenyi/",
		array(	"文化",  	"../wenyi/?action=subitem&resource=wenhua", 
				"文体",  	"../wenyi/?action=subitem&resource=sports", 
				"文娱",  	"../wenyi/?action=subitem&resource=wenyi", 
		),
	), 
	array("场地介绍",			"newschool/",
			//array(	"展厅展示", 		"../newschool/?action=salleexpo")
	), 
	array("网上报名",	"register/",
		/*array(	"中文班报名",  	"../register/", 
				"报名时间",  	"../register/?action=programs", 
		),*/
	), 
);

function getTopURL($n) {
	return ("../home/topphoto.php?action=detail&hindex=".$n);
}
function isFrancais() {
	return 0;
}

$AITEM = array(
	"请登录",		"../login/login.php",
	"注册",			"../register/",
	"退出",			"../login/logout.php",
	"打印本页",		"javascript:window.print()",
);

$CLASS_NAME =array(
	"拼音一班", 	"pinying1",
	"拼音二班", 	"pinying2",
	"一册一班", 	"class11",
	"一册二班",	"class12", 
	"二册一班", 	"class21",  
	"二册二班",	"class22",
	"三册一班",	"class31",  
	"三册二班",	"class32",
	"四册一班",	"class41",  
	"五册一班",	"class51",  
	"六册一班",	"class61",  
	"七册一班",	"class71",  
	"八册一班",	"class81",  
);

$CLASS_TYPE_NAME =array(
	"幼儿班", 
	"新生班", 	
	"一册始",
	"二册始",
	"二册",
	"三册",
	"四册",
	"五册",
	"六册始",
	"六册",
	"七册始",
	"八册始",
	"九册",
	"中九册",
	"十册"
);

$CLASS_TIME_NAME =array(
	"周三",
	"周六",
	"周日",
	"周三和周六",
	"周三和周日",
);

	
$CLASS_TEACHER_NAME =array(
	"张老师",
	"孙老师",
	"李老师",
	"孙老师",
	"孙老师",
	"张老师",
	"孙老师",
	"张老师",
	"李老师",
	"王老师",
	"孙老师",
	"王老师",	  
	"孙老师",
	"孙老师",
	"徐老师",
);

function getClassTeacher($classes) {
	global $CLASS_TEACHER_NAME;
	$n =  (int)(findClassInTable($classes)/2);
	if ($n > count($CLASS_TEACHER_NAME)) {
		$n = 0;
	}
	return 	$CLASS_TEACHER_NAME[$n];
}

function findClassInTable($classes) {
	global $CLASS_NAME;
	if (is_numeric($classes)) {
		return $classes;
	}
	else {
		for ($i = 0; $i < count($CLASS_NAME); $i+=2) {
			if ($classes == $CLASS_NAME[$i] || $classes == $CLASS_NAME[$i+1]) {
				return $i;
			}
		}
		return 0;
	}
}

function getClassBaseName($classes) {
	global $CLASS_NAME;
	$n = findClassInTable($classes);
	return $CLASS_NAME[$n+1];
}

function getClassShowName($classes) {
	global $CLASS_NAME;
	$n = findClassInTable($classes);
	return $CLASS_NAME[$n];
}

$NAME_PREV="上一条消息";
$NAME_NEXT="下一条消息";
$NAME_PUB="发表时间";
$NAME_BACK="返回";
$NAME_MORE="更多";
$NAME_DETAIL="详情";
$NAME_CONNEXE="相关内容";
$NAME_RECOM ="最新推荐";
$NAME_VIDEO="相关视频";
$NAME_PHOTO="相关照片";
$NAME_LASTHD="最新活动";

$FIRST_WAR="一战纪念日";
$EXAMEN_YCT ="YCT 考试";
$EXAMEN_HSK ="HSK 考试";
$DLY = "大乐园";
$TOUSSAINT = "万灵节";
$NOEL = "圣诞节";
$NOUVEL_AN="元旦";
$FETE_PRINTEMPS="春节";
$BAQUES="复活节";
$CONCOURS="文化知识大赛";
$FETE_TRAVAIL="劳动节";
$FETE_MAI8="二战纪念日";
$ATTENTE="待定";
$PENTECOTE="圣灵降临节";


$C_COURES = array("听写","笔试", "听力", "口语", "阅读");

function getScoreType($n) {
	global $C_COURES;
	return $C_COURES[$n];
}

$C_CIVIL = "性别";
$C_NAME = "姓名";
$C_CLASS = "班级";
$C_ADDRESS = "地址";
$C_CNAME = "中文名";
$C_FNAME = "外文名";
$C_EMAIL = "Email";
$C_PHONE = "电话";
$C_CELL = "手机";
$C_ALLSTUDENTS= "欧洲时报中文学校学生名单";
$C_CLASSSTUDENTS = "学生名单";

$C_BAOMING_TABLE= "欧洲时报文化中心报名表";

$C_UPDATE = "更新";
$C_CANCEL = "取消";


$C_TIME = "时间";
$C_TITLE = "题目";
$C_TEACHER = "老师";
$C_TYPE = "类型";
$C_AVG = "平均成绩";
$C_LS = "最低成绩";
$C_HS = "最高成绩";
$C_SCORE = "成绩";
$C_TOTAL = "总成绩";

$C_DATE = "日期";
$C_WEEK = "星期";
$C_MORNING = "上午";
$C_AFTERNOON = "下午";
$C_NIGHT = "晚上";

$C_NBCLASS = "班级数";
$C_CLASSDAY = "上课日子";
$C_CLASSTIME = "上课时间";
$C_BAOMING ="报名信息";

$C_WEEKDAT = array("日", "一", "二", "三", "四", "五", "六", "日");





?>