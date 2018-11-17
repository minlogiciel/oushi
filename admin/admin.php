<?php

session_start();

include ("../php/allinclude.php");
include ("../admin/admin_include.php");
include ("../register/HuoDongForm.php");
include "../register/BaomingForm.php";
include "../album/album_include.php";
include_once ("../jiaoyu/jy_include.php");
include_once ("../wenyi/wy_include.php");
include_once ("../form/form_include.php");
include_once ("../login/LoginClass.php");


   
$mtype = isset($_POST["mtype"]) ? $_POST["mtype"] : (isset($_GET["mtype"]) ? $_GET["mtype"] : 0);
$action = isset($_POST["action"]) ? $_POST["action"] : (isset($_GET["action"]) ? $_GET["action"] : "");
$nindex = isset($_POST["nindex"]) ? $_POST["nindex"] : (isset($_GET["nindex"]) ? $_GET["nindex"] : -1);
$mindex = isset($_POST["mindex"]) ? $_POST["mindex"] : (isset($_GET["mindex"]) ? $_GET["mindex"] : -1);
$newstype = isset($_POST["newstype"]) ? $_POST["newstype"] : (isset($_GET["newstype"]) ? $_GET["newstype"] : 0);
$tindex = isset($_POST["teacher"]) ? $_POST["teacher"] : (isset($_GET["teacher"]) ? $_GET["teacher"] : 0);
$registerref = isset($_POST["registerref"]) ? $_POST["registerref"] : (isset($_GET["registerref"]) ? $_GET["registerref"] : 0);
$memberid = isset($_POST["memberid"]) ? $_POST["memberid"] : (isset($_GET["memberid"]) ? $_GET["memberid"] : 0);
$galbum = isset($_POST["groups"]) ? $_POST["groups"] : (isset($_GET["groups"]) ? $_GET["groups"] : -1);
	
$sform = "";
$newsitem = "";
$huodong = '';
$msg = '';
$err = '';
$registerok = 0;

$adminuserform = "";
$adminuser = '';
$loginok = 0;
$adminlevel = 0;
$userid = 0;
$username = "";

if ($action == "login") {
	$loginclass = new LoginClass();
	$loginuser = $loginclass->getLogin();
	if ($loginuser) {
		$loginok = 1;
		$adminlevel = $loginuser->getLevel();
		$userid =  $loginuser->getID();
		if ($adminlevel == $UPDATE_USER) {
			$mtype = $NEWS_TYPE;
		}
		$username = $loginuser->getName();
		$_SESSION['log_user_id'] = $userid;
		$_SESSION['log_user_level'] = $adminlevel;
		$_SESSION['log_user_name'] = $username;
	}
	else {
		$msg = $loginclass->getError();
	}
}
else if ($action == "getpasswd") {
	$loginclass = new LoginClass();
	$msg = $loginclass->getForgotPassword();
}
else if ($action == "logout") {
	if (isset($_SESSION['log_user_id'])) {
		unset($_SESSION['log_user_id']);
	}
	if (isset($_SESSION['log_user_level'])) {
		unset($_SESSION['log_user_level']);
	}
	if (isset($_SESSION['log_user_name'])) {
		unset($_SESSION['log_user_name']);
	}
	$loginok = 0;
}
else if ($action == "changeuserinfo") {
	$loginclass = new LoginClass();
	$user  = $loginclass->changeUserInfo();
	$userid = $user->getID();
	$adminlevel = $user->getLevel();
	$username = $user->getName();
	$msg = $loginclass->getError();
	if ($adminlevel == $UPDATE_USER) {
		if ($mtype == 0) {
			$mtype = $NEWS_TYPE;
		}
		else if ($mtype == -1) {
			$mtype = $MODIF_USER_TYPE;
		}
	}
	$loginok = 1;
}
else {	
	if (isset($_SESSION['log_user_level'])) {
		$adminlevel = $_SESSION['log_user_level'];
	}
	if (isset($_SESSION['log_user_id'])) {
		$userid = $_SESSION['log_user_id'];
	}
	if (isset($_SESSION['log_user_name'])) {
		$username = $_SESSION['log_user_name'];
	}
	if ($adminlevel > 0 && $userid > 0) {
		$loginok = 1;
		if ($adminlevel == $UPDATE_USER) {
			if ($mtype == 0) {
				$mtype = $NEWS_TYPE;
			}
			else if ($mtype == -1) {
				$mtype = $MODIF_USER_TYPE;
			}
		}
	}
}

if ($action == "detail" || $action == "updatenews" || $action == "updatenews") {
	$newsclass = new NewsClass();
	$newsitem = $newsclass->getNews($newstype, $nindex, 0);
	/*if ($newstype == $FASTNEWS_JY) {
		$newsitem = $JY_NEWS[$nindex]; 	
	}
	else if ($newstype == $FASTNEWS_JL) {
		$newsitem = $JL_NEWS[$nindex]; 
	}
	else if ($newstype == $FASTNEWS_WY) {
		$newsitem = $WY_NEWS[$nindex]; 
	}
	else if ($newstype == $FASTNEWS_ASSO) {
		$newsitem = $ASSO_NEWS[$nindex]; 
	}*/
}
else if ($action == "showalbum" || $action == "modifyalbum") {
	$dalbum = isset($_POST["dates"]) ? $_POST["dates"] : (isset($_GET["dates"]) ? $_GET["dates"] : 0);
	$talbum = isset($_POST["title"]) ? $_POST["title"] : (isset($_GET["title"]) ? $_GET["title"] : "");
}
else if ($action == "jlphoto" || $action == "uploadjlphotos") {
	$mindex = isset($_POST["jlitem"]) ? $_POST["jlitem"] : (isset($_GET["jlitem"]) ? $_GET["jlitem"] : -1);
}
else if ($action == "tojlpage" || $action == "towypage") {
	$newsclass = new NewsClass();
	$newsitem = $newsclass->getNews($newstype, $nindex, 0);
}
$usejlbase = 1;

include ("../php/title.php");
?>
<BODY>
<script type="text/javascript" src="../javascript/frais.js"></script>
<script type="text/javascript" src="../javascript/topphoto.items.js"></script> 
<script type="text/javascript" src="../javascript/topphoto.js"></script> 


<div class="content">
<?php 
if (isAdminAllowed()) {
if ($loginok) {
switch ($mtype) {
	case $STUDENT_TYPE:
		$sform = new JYStudentForm();
		if ($action == "addstudentworks") {
			$nindex = $sform->WriteStudentWorks($nindex);
		}
		break;
	case $NEWS_TYPE:
	case $HUIGU_TYPE :
	case $PHOTO_TYPE :
	case $MNEWS_TYPE :
	case $ANNO_TYPE :
		$sform = new NewsBaseForm();
		if ($action == "addfastnews") {
			$newsitem = $sform->WriteFastNews($newstype, $nindex);
			if ($nindex < 1) {
				$nindex = $newsitem->getID();
			}
			$msg = "添加  / 修改快讯消息完成";
		}
		else if ($action == "addhuigu") {
			$newsitem = $sform->getHuigu();
			$msg = "添加  / 修改完成";
			$nindex = $sform->WriteHuigu($newsitem, $nindex);
		}
		else if ($action == "modifytopphoto") {
			$sform->WriteTopNews();
			$msg = "修改成功";
		}
		else if ($action == "modifymainnews") {
			$sform->WriteMainNews();
			$msg = "修改完成";
		}
		else if ($action == "lastannonce") {
			$msg = "修改最新通知完成";
			$newsitem = $sform->WriteLastAnnonce();
		}
		break;
	case $JLPHOTO_TYPE :
	case $JLNEWS_TYPE :
		if ($usejlbase)
			$sform = new JLPageBaseForm();
		else
			$sform = new JLPageForm();
		if ($action == "uploadjlphotos") {
			$sform->uploadJLPhoto();
			$msg = "修改完成";
		}
		else if ($action == "addjlpage") {
			$mindex = isset($_POST["jiaoliutype"]) ? $_POST["jiaoliutype"] : (isset($_GET["jiaoliutype"]) ? $_GET["jiaoliutype"] : -1);
			$msg = $sform->addJiaoliuPage();
			if (!$msg) {
				$msg = "添加  / 修改完成";
			}
		}
		
		break;
	case $CTIMES_TYPE :
		$sform = new CoursTimeForm();
		if ($action == "updatetimes") {
			$sform->writeCoursTimes();
			$msg = "修改完成";
		}
		else if ($action == "updatefete") {
			$newsitem = $sform->saveFete();
			$msg = "修改完成";
		}
		else if ($action == "updateschedule") {
			$msg = $sform->writePrograms();
			if (!$msg)
				$msg = "修改完成";
		}
		break;
	case $WYNEWS_TYPE :
		$sform = new NewsPageForm();
		if ($action == "addnewspage") {
			$sform->addNewsPage($WY_TAB, $WYNEWS_TYPE);
			$msg = "修改完成";
		}
		break;
	case $JYNEWS_TYPE :
		$sform = new NewsPageForm();
		if ($action == "addnewspage") {
			$sform->addNewsPage($JY_TAB, $JYNEWS_TYPE);
			$msg = "修改完成";
		}
		break;
	case $ALBUM_TYPE :
		$sform = new AlbumForm();
		if ($action == "uploadphotos") {
			$newsitem = $sform->uploadAlbum();
		}
		else if ($action == "createalbum") {
			$newsitem = $sform->addNewAlbum();
			$msg = "添加  / 修改完成";
		}
		break;
	case $TEACHER_TYPE :
		$sform = new ScheduleForm();
		if ($action == "addjiaoliu") {
			if (!empty($_REQUEST['remove'])) {
				$msg = "删除教师交流完成";
				$mindex = $sform->RemoveJiaoliuInfo();
			}
			else if (empty($_REQUEST['reset'])) {
				$msg = "添加  / 修改教师交流完成";
				$mindex = $sform->WriteJiaoliuInfo();
			}
			else {
				$mindex = -1;
			}
		}
		else if ($action == "modifyteacher") {
			$msg = "修改欧洲时报文化中心中文学校教师通讯录完成";
			$newsitem = $sform->updateTeacherList();
		}
		else if ($action == "modifycours") {
			$msg = "修改欧洲时报文化中心中文学校教师课程完成";
			$newsitem = $sform->updateTeacherCours();
		}
		break;
	case $HDBM_TYPE :
		$sform = new BaomingForm();
		if ($action == "register") {
			if(empty($_REQUEST['reset']))
			{
				$huodong = $sform->getRegisterData();
				$err = $sform->addNewRegister($huodong);
				if (!$err) {
					$registerok = 1;
				}
			}
		}
		else if ($action == "changeclass") {
			$huodong = $sform->getRegisterData();
		}
		
		break;
	case $ADMIN_USER_TYPE :
		$adminuserform = new AdminUserForm();
		if ($action == "addadminuser") {
			$adminuser = $adminuserform->addNewAdminUser();
			$nindex = $adminuser->getID();
		}
	default :
		$sform = new ScheduleForm();
		break;
}
	
include "../admin/admintitle.php";

?>

<div class="admin_left">
	<?php include "adminleft.php"; ?>
</div>

<div class="admin_right">

 	<div class="admin_right_box">
<?php  
switch ($mtype) {
	case $ADMIN_USER_TYPE :
		$adminuserform->showAdminUserForm($nindex, $adminuser, $msg);
		break;
	case $TEACHER_TYPE :
		if ($nindex == $T_SCHEDULE_TYPE) {
			$sform->listTeacherCoursTable($newsitem, $msg); 
		}
		else if ($nindex == $T_COMUNICATION_TYPE) {
			if ($tindex == $userid || $adminlevel == $ADMIN_USER) {
				$sform->showTeacherJiaoliuForm($tindex, $nindex, $mindex, $msg);
				$sform->showTeacherJiaoliuTable($tindex, $nindex, 0);
			}
			else {
				$sform->showTeacherJiaoliuTable($tindex, $nindex, 1);
			}
		}
		else {
			$sform->listTeacherTable($newsitem, $msg);
		}
		break;
	case $STUDENT_TYPE:
		if ($action == "detail") {
			showStudentWorksDetailBase($nindex);
		}
		else {
			$sform->showStudentWorksForm($nindex, $msg);
		} 
		break;
	case $NEWS_TYPE:
		if ($action == "detail") {
			showNewsDetail($newsitem, $nindex, "", -1);
			if (count($newsitem) > 6) {
				showNewsDetail($newsitem[6], $nindex, "", -1);
			}
		}
		else if ($action == "updatenews") {
			$sform->showNewsForm($newsitem, $newstype, $nindex, 1, $msg);
		}
		else {
			$sform->showNewsForm($newsitem, $newstype, $nindex, 0, $msg);
		} 
		break;
	case $PHOTO_TYPE:
		$sform->showTopPhotoForm($msg);
		break;
	case $MNEWS_TYPE:
		$sform->showMainNewsForm($msg);
		break;
	case $ANNO_TYPE:
		$sform->showAnnonceForm($newsitem, $msg);
		break;
	case $JLPHOTO_TYPE:
	case $JLNEWS_TYPE:
		if ($action == "detail") {
			if (!$usejlbase) {
				$items = $JL_TAB[$mindex - 1];
				$item = $items[$JY_START_ITEM][$nindex];
				showJiaoLiuItemDetail($items, $nindex+1);
				if (isFrenchTable($item)) {
					echo("<div class=box_bg>&nbsp; </div>");
					showPhotoArticlePage($item[4][0], $item[4]);
				}
			}
			else {
				$jlpage = new JLPageClass();
				if ($jlpage->getJLPage($nindex)) {
					$item = $jlpage->getJLPageItem();
					showJLPageItemDetail($item, $nindex);
					if (isFrenchTable($item)) {
						echo("<div class=box_bg>&nbsp; </div>");
						showPhotoArticlePage($item[4][0], $item[4]);
					}
				}			
			}		
		}
		else {
			if ($mtype == $JLPHOTO_TYPE) {
				$sform->showUploadJLPhotoForm($mindex, $nindex, $msg);
			}
			else {
				$sform->showJLPageForm($newsitem, $mindex, $nindex, $msg);
			}
		}
		break;
	case $WYNEWS_TYPE:
		if ($action == "detail") {
			$items = $WY_TAB[$mindex - 1];
			$item = $items[$nindex];
			showWenyiItemDetail($items, $nindex);
			if (isFrenchTable($item)) {
				$nb_items = count($item);
				echo("<div class=box_bg>&nbsp;</div>");
				$fitems = $item[$nb_items-2];
				$nb_items = count($fitems);
				
				showPhotoArticlePage($fitems[0], $fitems);
				if (count($fitems) > 3) {
					if ($nindex == $RANDON_INDEX && $item[1] == "sports") {
						showLastRandonList($fitems[3]);
					}
					else {
						showArticleLinkPage($fitems[3]);
					}
				}
				
				for ($i = 4; $i < $nb_items; $i++) {
	 				$right = $i % 2;
					echo("<div class=gred_line>&nbsp;</div>");
					showPhotoArticlePage($fitems[$i][0], $fitems[$i], $right);
					// start link 
					if (count($fitems[$i]) > 3) {
						showArticleLinkPage($fitems[$i][3]);
		 			}
				} // end  more item
			}
		}
		else {
			$sform->showNewsPageForm($newsitem, $mindex, $nindex, $WY_TAB, $WYNEWS_TYPE, $msg);
		}
		break;
	case $JYNEWS_TYPE:
		if ($action == "detail") {
			$items = $WY_TAB[$mindex - 1];
			$item = $items[$nindex];
			showWenyiItemDetail($items, $nindex);
			if (isFrenchTable($item)) {
				$nb_items = count($item);
				echo("<div class=box_bg>&nbsp;</div>");
				$fitems = $item[$nb_items-2];
				$nb_items = count($fitems);
				
				showPhotoArticlePage($fitems[0], $fitems);
				if (count($fitems) > 3) {
					if ($nindex == $RANDON_INDEX && $item[1] == "sports") {
						showLastRandonList($fitems[3]);
					}
					else {
						showArticleLinkPage($fitems[3]);
					}
				}
				
				for ($i = 4; $i < $nb_items; $i++) {
	 				$right = $i % 2;
					echo("<div class=gred_line>&nbsp;</div>");
					showPhotoArticlePage($fitems[$i][0], $fitems[$i], $right);
					// start link 
					if (count($fitems[$i]) > 3) {
						showArticleLinkPage($fitems[$i][3]);
		 			}
				} // end  more item
			}
		}
		else {
			$sform->showNewsPageForm($newsitem, $mindex, $nindex, $JY_TAB, $JYNEWS_TYPE, $msg);
		}
		break;
	case $CTIMES_TYPE:
		if ($action == "modifycours") {
			//$sform->showCoursTimeItem($nindex, $msg); 
		}
		else if ($action == "modifyfete" || $action == "updatefete") {
			$sform->showFeteTable($newsitem, $msg); 
		}
		else if ($action == "modifyschedule" || $action == "updateschedule") {
			$sform->showSchoolSchduleTable($msg); 
		}
		else {
			$sform->showSchoolSchduleTable($msg); 
			//$sform->showCoursTime($msg);
		}
		break;
	case $ALBUM_TYPE:
		if ($action == "showalbum") {
			$sform->showAlbumList($dalbum, $talbum, $galbum);
		}
		else if ($action == "modifyalbum") {
			$sform->showUploadAlbumForm("", $dalbum, $talbum, $galbum);
		}
		else if ($action == "newalbum" || $action == "updatealbum" || $action == "createalbum" ) {
			$sform->showNewAlbumForm($newsitem, $galbum, $msg);
		}
		else {
			$sform->showUploadAlbumForm($newsitem,"","", $galbum);
		}
		break;
	case $HUIGU_TYPE:
		$sform->showHuiguForm($newsitem, $nindex, $msg);
		break;
	case $HDBM_TYPE:
		if ($action == $SHOWMEMBER) {
			$sform = new ScheduleForm();
			$sform->showRegisterMemberTable($registerref, "");
		}
		else if ($action == "validemember") {
			$sform = new ScheduleForm();
			$sform->updateActiveMember();		
			$sform->showRegisterMemberTable($registerref, "修改成功！");
		}
		else {
			echo("<div class='admin_right_redline'><IMG src='../images/enligne.png'></div>");
			if ($memberid > 0) {
				$huodong = new HuodongClass();
				if ($huodong->getHuodong($memberid)) {
					if ($action == "modifymember") {
						$registerref = $huodong->getHDIndex();
					}
				}
				else {			
					$huodong = '';
				}
			} 
			if ($registerok) {
				$sform->showRegisterResultTable($huodong);
			}
			else {
				$sform->showRegisterTable($registerref, $huodong, "admin.php", $err);
			}
		}
		break;
	default :	
		if ($action == "modifuserinfo" || $action == "changeuserinfo") {
			$adminuserform = new AdminUserForm();
			$adminuserform->showAdminUserInfoForm($userid, $msg);
		}
		else {
			echo("<h1>法国欧洲时报文化中心</h1>");
		}
		break;
 } 
?>
	</div>
</div>

<?php } else {
include "../admin/admintitle.php";
//include "../php/maintitle.php";
?>

<div class="full_box">
	<br><br>
	<h1>法国欧洲时报文化中心 </h1>
	<br>
    <div class="box700">
<?php 
	$adminform = new AdminUserForm();
 	$adminform->showLoginForm($msg);
?>
	</div>
</div>

<?php } } else {
include "../php/maintitle.php";
?>

<div class="full_box">
	<br><br>
	<h1>法国欧洲时报文化中心 </h1>
	<br>
    <div class="box700">
	</div>
</div>

<?php } ?>

</div>
<?php include "../php/foot1.php"; ?>


</body>
</html>
