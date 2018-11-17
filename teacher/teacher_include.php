<?php
include_once ("../teacher/tjl_include.inc");
include_once ("../teacher/teacher_list.inc");
include_once ("TeacherForm.php");

function getTeacherName($tindex) {
	global $TEACHER_TABLE;
	for ($i = 0; $i < count($TEACHER_TABLE); $i++) {
		if ($TEACHER_TABLE[$i][4] == $tindex) {
			return $TEACHER_TABLE[$i][0];
		}
	}
	return "";
}

function getTeacherJiaoliuTable($tindex) {
	global $TJL_LISTS;
	for ($i = 0; $i < count($TJL_LISTS); $i++) {
		if ($TJL_LISTS[$i][0] == $tindex) {
			return $TJL_LISTS[$i];
		}
	}
	return array();
}

$GRADE_TEXT_NAME = array("其它", "拼音",
	"第一册(新版)", "第二册(新版)", "第三册(新版)", "第四册(新版)", "第五册(新版)", "第六册(新版)", 
	"第七册(新版)", "第八册(新版)", "第九册(新版)", "第十册(新版)", "第十一册(新版)", "第十二册(新版)",
	"第一册(旧版)", "第二册(旧版)", "第三册(旧版)", "第四册(旧版)", "第五册(旧版)", "第六册(旧版)", 
	"第七册(旧版)", "第八册(旧版)", "第九册(旧版)", "第十册(旧版)", "第十一册(旧版)", "第十二册(旧版)",
	"YCT1", "YCT2", "YCT3","YCT4","HSK1","HSK2","HSK3","HSK4","HSK5","HSK6"
);
$GRADE_TYPE_NAME = array("其它", "练习", "试卷", "阅读", "教案", "资料");
$FILE_TYPE_NAME = array("其它", "PDF", "DOC", "PPT",  "XLS", "ZIP", "AUDIO", /*"IMAGE", "VIDEO"*/);


function getFileType($name) {
	global $FILE_TYPE_NAME;
	$ret = "";
	if ($name) {
		if (strstr(strtolower($name), ".pdf")) {
			$ret = $FILE_TYPE_NAME[1];
		}
		else if (strstr(strtolower($name), ".doc") || strstr(strtolower($name), ".docx")) {
			$ret = $FILE_TYPE_NAME[2];
		}
		else if (strstr(strtolower($name), ".ppt")) {
			$ret = $FILE_TYPE_NAME[3];
		}
		else if (strstr(strtolower($name), ".xls")) {
			$ret = $FILE_TYPE_NAME[4];
		}
		else if (strstr(strtolower($name), ".zip") || strstr(strtolower($name), ".rar")) {
			$ret = $FILE_TYPE_NAME[5];
		}
		else if (strstr(strtolower($name), "mp3")) {
			$ret = $FILE_TYPE_NAME[6];
		}
		/*else if (strstr(strtolower($name), ".jpg") || strstr(strtolower($name), ".png") || strstr(strtolower($name), ".gif")) {
			$ret = $FILE_TYPE_NAME[5];
		}
		else if (strstr(strtolower($name), "mp4")) {
			$ret = $FILE_TYPE_NAME[6];
		}*/
	}
	return $ret;
}

function getFileTypeIcon($name) {
	$icon = "document.png";
	if ($name) {
		if (strstr(strtolower($name), ".pdf")) {
			$icon = "pdficon.png";
		}
		else if (strstr(strtolower($name), ".doc") || strstr(strtolower($name), ".docx")) {
			$icon = "word.png";
		}
		else if (strstr(strtolower($name), ".ppt")) {
			$icon = "ppt.png";
		}
		else if (strstr(strtolower($name), ".xls")) {
			$icon = "excel.png";
		}
		else if (strstr(strtolower($name), ".zip") || strstr(strtolower($name), ".rar")) {
			$icon = "rar.png";
		}
		/*
		else if (strstr(strtolower($name), "mp3")) {
			$ret = $FILE_TYPE_NAME[4];
		}
		else if (strstr(strtolower($name), ".jpg") || strstr(strtolower($name), ".png") || strstr(strtolower($name), ".gif")) {
			$ret = $FILE_TYPE_NAME[5];
		}
		else if (strstr(strtolower($name), "mp4")) {
			$ret = $FILE_TYPE_NAME[6];
		}*/
	}
	return $icon;
}

function getTeacherDiretory($tindex) {
	global $TEACHER_PATH;
	return ($TEACHER_PATH."teacher".$tindex);
}

function uploadFile($srcfile, $destfile, $path) 
{
	if (!file_exists($path)) {
 		mkdir($path, 0777, true);
	}
	if (file_exists($path.$destfile)) {
      	echo ($destfile . " already exists. ");
    } else {
		move_uploaded_file($srcfile, $path."/".$destfile);
    }
	
}


?>