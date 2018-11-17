<?php 
include_once("../jiaoliu/jl_include.php");
include_once("../wenyi/wy_include.php");
include_once("../album/album_items.inc");

$nn_end = 15;
$newsclass = new NewsListClass();
switch ($mtype) {
	case $STUDENT_TYPE :
		$article = new ArticleListClass();
		$works = $article->getArticleLists(); 
?>
<div class="right_box right_box3">
	<div class=item_tit>学生作品</div>
	<div class=item_txt>
	<?php 
		for ($i = 0; $i < count($works); $i++) {
			$items = $works[$i];
			$title = $items->getTitle(). " " .$items->getStudent();
			$id = 	$items->getID();
			echo("<div class=textlink><a href='../admin/?action=detail&mtype=$STUDENT_TYPE&nindex=$id'>".($i+1). ".</a> "); 
			echo("<a href='../admin/?action=updatenews&mtype=$STUDENT_TYPE&nindex=$id'>$title</a></div>"); 
		}
	?>
	</div>
</div>
<div class=box_bg>&nbsp; </div>
<?php 
		break;
	case $MODIF_USER_TYPE :
	case $NEWS_TYPE :
	case $PHOTO_TYPE :
	case $MNEWS_TYPE :
?>
<div class="right_box right_box3">
	<div class=item_tit>文化教育消息</div>
	<div class=item_txt>
	<?php 
		$newslist = $newsclass->getLastNewsLists($FASTNEWS_JY);
		$nb = count($newslist);
		$i = 0;
		while (0 < $nb && $i < $nn_end) {
			$title = getNewsTitle($newslist[$nb-1]->getTitle());		
			$id = $newslist[$nb-1]->getID();
			echo("<div class=textlink><a href='../admin/?action=detail&mtype=$NEWS_TYPE&newstype=$FASTNEWS_JY&nindex=$id'>$nb.</a>"); 
			echo("<a href='../admin/?action=updatenews&mtype=$NEWS_TYPE&newstype=$FASTNEWS_JY&nindex=$id'>$title</a></div>"); 
			$nb--; $i++;
		}
	?>
	</div>
</div>
<div class=box_bg>&nbsp; </div>

<div class="right_box right_box3">
	<div class=item_tit>文化交流消息</div>
	<div class=item_txt>
	<?php 
		$newslist = $newsclass->getLastNewsLists($FASTNEWS_JL);
		$nb = count($newslist);
		$i = 0;
		while (0 < $nb && $i < $nn_end) {
			$title = getNewsTitle($newslist[$nb-1]->getTitle());		
			$id = $newslist[$nb-1]->getID();
			echo("<div class=textlink><a href='../admin/?action=detail&mtype=$NEWS_TYPE&newstype=$FASTNEWS_JL&nindex=$id'>$nb.</a>");
			echo("<a href='../admin/?action=updatenews&mtype=$NEWS_TYPE&newstype=$FASTNEWS_JL&nindex=$id'>$title</a></div>");
			$nb--; $i++;
		}
	?>
	</div>
</div>
<div class=box_bg>&nbsp; </div>


<div class="right_box right_box3">
	<div class=item_tit>文艺活动消息</div>
	<div class=item_txt>
	<?php  
		$newslist = $newsclass->getLastNewsLists($FASTNEWS_WY);
		$nb = count($newslist);
		$i = 0;
		while (0 < $nb && $i < $nn_end) {
			$title = getNewsTitle($newslist[$nb-1]->getTitle());		
			$id = $newslist[$nb-1]->getID();
			echo("<div class=textlink><a href='../admin/?action=detail&mtype=$NEWS_TYPE&newstype=$FASTNEWS_WY&nindex=$id'>$nb.</a>"); 
			echo("<a href='../admin/?action=updatenews&mtype=$NEWS_TYPE&newstype=$FASTNEWS_WY&nindex=$id'>$title</a></div>"); 
			$nb--; $i++;
		}
	?>
	</div>
</div>
<div class=box_bg>&nbsp; </div>
<?php 
		break;
case $JLPHOTO_TYPE :
case $JLNEWS_TYPE :
?>	

<div class="right_box right_box3">
	<div class=item_tit>文化交流页面</div>
	<div class=item_txt>
<?php  
		$nb = count($JL_TAB);
if (!$usejlbase) {
		if ($mtype == $JLNEWS_TYPE) {
			$nb--;
		}
		for ($i = 1; $i <= $nb; $i++) {
			$items = $JL_TAB[$i-1];
			echo("<div class=textlink>");
			echo("&bull; <font color=green>" .$items[0]. "</font>"); 
			$nn = 1;
			$mitems =  $items[5];
			for ($j = 0; $j < count($mitems); $j++) {
				$item = $mitems[$j];
				$texte = mb_substr($item[0], 0, 16, "UTF-8");
				echo("<div class=textlink>");
				echo("<a href='../admin/?action=detail&mtype=$mtype&mindex=$i&nindex=$j'>$nn</a> . ");
				echo("<a href='../admin/?action=jlphoto&mtype=$mtype&jlitem=$i&nindex=$j'>$texte</a>");
				echo("</div>"); 
				$nn++;
			}
			echo("</div>"); 
		}
} else {  
		$jllist = new JLPageListClass();		
		for ($i = 1; $i <= $nb; $i++) {
			$items = $jllist->getJLPageLists($i);
			echo("<div class=textlink>");
			echo("&bull; <font color=green>" .$JL_TAB[$i-1][0]. "</font>"); 
			$nn = 1;
			for ($j = 0; $j < count($items); $j++) {
				$item = $items[$j];
				$title = $item->getTitle();
				$ids = $item->getID();
				$position = $item->getPosition();
				$texte = mb_substr($title, 0, 15, "UTF-8");
				echo("<div class=textlink>");
				//echo("<a href='../admin/?action=detail&mtype=$mtype&mindex=$i&nindex=$ids'>$nn</a> . ");
				echo("<a href='../admin/?action=detail&mtype=$mtype&mindex=$i&nindex=$ids'>$position</a> . ");
				echo("<a href='../admin/?mtype=$mtype&mindex=$i&jlitem=$i&nindex=$ids'>$texte</a>");
				echo("</div>"); 
				$nn++;
			}
			echo("</div>"); 
		}
}
?>
	</div>
</div>
<div class=box_bg>&nbsp; </div>
<?php 
if ( $mtype == $JLNEWS_TYPE) { 
?>
<div class="right_box right_box3">
	<div class=item_tit>添加文化交流</div>
	<div class=item_txt>
		<div class=textlink>&bull; <font color=green>文化交流消息</font>
		<?php 
		$newslist = $newsclass->getLastNewsLists($FASTNEWS_JL);
		$nb = count($newslist);
		$i = 0;
		if ($nb > 20)
			$n_total = 20;
		else 
			$n_total = $nb;
		while($i < $n_total) {
			$title = getNewsTitle($newslist[$nb-1]->getTitle());		
			$id = $newslist[$nb-1]->getID();
			echo("<div class=textlink>");
			echo($nb. ".<a href='../admin/?action=tojlpage&mtype=$JLNEWS_TYPE&newstype=$FASTNEWS_JL&nindex=$id'>$title</a>");
			echo("</div>"); 
			$nb--; $i++;
		}
		?>
		</div>
		<div class=textlink>&bull; <font color=green>文艺活动消息</font>
		<?php  
		$newslist = $newsclass->getLastNewsLists($FASTNEWS_WY);
		$nb = count($newslist);
		$i = 0;
		if ($nb > 20)
			$n_total = 20;
		else 
			$n_total = $nb;
		while($i < $n_total) {
			$title = getNewsTitle($newslist[$nb-1]->getTitle());		
			$id = $newslist[$nb-1]->getID();
			echo("<div class=textlink>");
			echo($nb. ".<a href='../admin/?action=tojlpage&mtype=$JLNEWS_TYPE&newstype=$FASTNEWS_WY&nindex=$id'>$title</a>");
			echo("</div>"); 
			$nb--; $i++;
		}
		?>
		</div>
	</div>
</div>
<?php }
		break;
case $JYNEWS_TYPE :
?>

<div class="right_box right_box3">
	<div class=item_tit>文化教育页面</div>
	<div class=item_txt>
	<?php  
	$nb = count($JY_TAB);
	for ($i = 1; $i <= $nb; $i++) {
		$items = $JY_TAB[$i-1];
		if ($items[1] != "student" && $items[1] != "summer" && $items[1] != "teacher") {
			echo("<div class=textlink>");
			echo("&bull; <font color=green>" .$items[0]. "</font>"); 
			$nn = 1;
			for ($j = 5; $j < count($items); $j++) {
				$item = $items[$j];
				$texte = mb_substr($item[0], 0, 16, "UTF-8");
				echo("<div class=textlink>");
				echo("<a href='../admin/?action=detail&mtype=$JYNEWS_TYPE&mindex=$i&nindex=$j'>$nn</a> . ");
				echo("<a href='../admin/?action=wypage&mtype=$JYNEWS_TYPE&mindex=$i&nindex=$j'>$texte</a>");
				echo("</div>"); 
				$nn++;
			}
			echo("</div>"); 
		}
	}
	?>
	</div>
</div>
<div class=box_bg>&nbsp; </div>

<?php
		break;
case $WYNEWS_TYPE :
?>
<!-- 
<div class="right_box right_box3">
	<div class=item_tit>文艺活动消息</div>
	<div class=item_txt>
		<?php  
			$i = count($WY_NEWS)-1;
			$n = 1;
			while ($n < 8) {
				$items = $WY_NEWS[$i];
				$texte = mb_substr($items[0], 0, 16, "UTF-8");
				echo("<div class=textlink>");
				echo($n. ". <a href='../admin/?action=towypage&mtype=$WYNEWS_TYPE&newstype=$FASTNEWS_WY&nindex=$i'>$texte</a>");
				echo("</div>"); 
				$n++;
				$i--;
			}
		?>
	</div>
</div>
<div class=box_bg>&nbsp; </div>
-->
<div class="right_box right_box3">
	<div class=item_tit>文化娱乐页面</div>
	<div class=item_txt>
	<?php  
		$nb = count($WY_TAB);
		for ($i = 1; $i <= $nb; $i++) {
			$items = $WY_TAB[$i-1];
			echo("<div class=textlink>");
			echo("&bull; <font color=green>" .$items[0]. "</font>"); 
			$nn = 1;
			for ($j = 5; $j < count($items); $j++) {
				$item = $items[$j];
				$texte = mb_substr($item[0], 0, 16, "UTF-8");
				echo("<div class=textlink>");
				echo("<a href='../admin/?action=detail&mtype=$WYNEWS_TYPE&mindex=$i&nindex=$j'>$nn</a> . ");
				echo("<a href='../admin/?action=wypage&mtype=$WYNEWS_TYPE&mindex=$i&nindex=$j'>$texte</a>");
				echo("</div>"); 
				$nn++;
			}
			echo("</div>"); 
		}
	?>
	</div>
</div>
<div class=box_bg>&nbsp; </div>

<?php
		break;
case $HDBM_TYPE :
?>
<div class="right_box right_box3">
	<div class=item_tit>欧洲时报文化中心报名</div>
	<div class=item_txt>
	<?php include "registerlist.php"; ?>
	</div>
</div>
<?php 
		break;
case $CTIMES_TYPE :
?>
<div class="right_box right_box3">
	<div class=item_tit>文化中心校历课程表</div>
	<div class=item_txt>
		<div class=textlink><IMG height=9 src=../images/arrow.gif width=8>&nbsp; 
		<a href='../admin/admin.php?action=modifyschedule&mtype=<?php echo($CTIMES_TYPE); ?>'>文化中心课程安排</a>
		</div> 
		<div class=textlink><IMG height=9 src=../images/arrow.gif width=8>&nbsp; 
		<a href='../admin/admin.php?action=modifyfete&mtype=<?php echo($CTIMES_TYPE); ?>'>文化中心学年节假日</a>
		</div> 
	</div>
</div>
<div class=box_bg>&nbsp; </div>
<?php if (0) {?>
<div class="right_box right_box3">
	<div class=item_tit>文化中心报名课程时刻表</div>
	<div class=item_txt>
	<?php 
	for ($i = 0; $i < count($REGISTER_TAB); $i++) { 
		$items = $REGISTER_TAB[$i];
		echo("<div class=textlink><IMG height=9 src=../images/arrow.gif width=8>&nbsp;"); 
		echo("<a href='../admin/admin.php?action=modifycours&nindex=$i&mtype=$CTIMES_TYPE'>".$items[0]."</a></div>"); 
	}

	$items = $CLASS_COURS_CHINOIS[0];
	echo("<div class=textlink><IMG height=9 src=../images/arrow.gif width=8>&nbsp;");
	echo("<a href='../admin/admin.php?action=modifycours&mtype=$CTIMES_TYPE'>".$items[0]."</a></div>"); 

	?>
	</div>
</div>
<div class=box_bg>&nbsp; </div>
<?php 
}
	break;
case $HUIGU_TYPE :
?>
<div class="right_box3">
	<div class=item_tit>回精彩顾</div>

	<div class=item_txt>
		<div class=textlink>&nbsp; &nbsp; 
			<a href='../admin/?action=updatehuigu&mtype=<?php echo($HUIGU_TYPE); ?>'>添加新彩顾回精</a></div>
	<?php 
		for ($h = 1; $h <= count($HUIGU_ITEM_NAME); $h++) {
			$hitem = $HUIGU_ITEM_NAME[$h-1];
			echo("<div class=textlink>".$h.". <a href='../admin/?action=updatehuigu&mtype=$HUIGU_TYPE&nindex=$h'>".$hitem[0]."</a></div>"); 
		}
		$h = 10 - $h;
		while ($h > 0) {
			echo("<br>");
			$h--;
		}
	?>
	</div>
</div>
<div class=box_bg>&nbsp; </div>
<?php 
		break;
case $ALBUM_TYPE :
	$albumlist = new AlbumList();
	$n_album = count($ALBUM_ITEM_NAME);
?>
<div class="right_box3">
	<div class=item_tit>
		<div class=textlink>&nbsp; &nbsp; 
			<a href='../admin/admin.php?action=newalbum&mtype=<?php echo($ALBUM_TYPE); ?>'>添加新相册</a>
			<br><br>
		</div>
	</div>
<?php 
	$i = $n_album;
	while($i > ($n_album-2)) {
		$i--;
		$title = $ALBUM_ITEM_NAME[$i][0];
		$n_day = $ALBUM_ITEM_NAME[$i][3] ;
		$s_day =  $ALBUM_ITEM_NAME[$i][4];
		list($annee, $mois, $jour) =  explode("-", $s_day);
		
?>
	<div class=item_tit><?php echo($title)?></div>

	<div class=item_txt>
	<?php 
		$hh = 1;
		for ($h = 0; $h <= $n_day;  $h++) {
			$s = getMonthDayString($annee, $mois, $jour, $h);
			$lists = $albumlist->getAlbumLists($s, $i);
			if (count($lists) > 0) {
				$title = $lists[0]->getTitle();					
				echo("<div class=textlink>");
				echo("<a href='../admin/admin.php?action=modifyalbum&dates=$s&title=$title&mtype=$ALBUM_TYPE&groups=$i'>".$hh++."</a>. ");
				echo("<a href='../admin/admin.php?action=showalbum&dates=$s&title=$title&mtype=$ALBUM_TYPE&groups=$i'>".$s."-".$title."</a>");
				echo("</div>");
				for ($l = 1; $l < count($lists); $l++) {
					if ($lists[$l]->getTitle() != $title) {
						$title = $lists[$l]->getTitle();
						echo("<div class=textlink>");
						echo("<a href='../admin/admin.php?action=modifyalbum&dates=$s&title=$title&mtype=$ALBUM_TYPE&groups=$i'>".$hh++."</a>. ");
						echo("<a href='../admin/admin.php?action=showalbum&dates=$s&title=$title&mtype=$ALBUM_TYPE&groups=$i'>".$s."-".$title."</a>");
						echo("</div>");
					}	
				}
			} 
		}
	?>
		<div class=textlink>&nbsp; &nbsp; 
			<a href='../admin/admin.php?mtype=<?php echo($ALBUM_TYPE); ?>&groups=<?php echo($i); ?>'>添加新照片</a>
		</div>
		<div class=textlink>&nbsp; &nbsp; 
			<a href='../admin/admin.php?mtype=<?php echo($ALBUM_TYPE); ?>&action=updatealbum&groups=<?php echo($i); ?>'>修改相册</a>
			<br>
		</div>
		
	</div>
	<div class=box_bg>&nbsp; </div>
<?php } ?>
</div>

<?php 
		break;
case $ADMIN_USER_TYPE :
?>
<div class="right_box3">
	<div class=item_tit>用户管理</div>
	<div class=item_txt>
	<?php 
		$auser = new AdminUserClass();
		$userlist = $auser->getAllAdminUsers(0, 1);
		$n_user = count($userlist);
		echo("<div class=textlink>&bull; <a href='../admin/?mtype=$ADMIN_USER_TYPE'>添加新用户</a></div>"); 
		echo("<div class=textlink>&bull; &nbsp;修改用户 (".$n_user.")</div>"); 
		for ($i = 0; $i < $n_user; $i++) {
			$user = $userlist[$i];
			$level = $user->getLevel();
			$ids = $user->getID();
			$isdeleted = $user->isDeleted();
			if ($isdeleted) {
				$name = $user->getName(). " (<font color=red>已删除</font>)";
			}
			else {
				$name = $user->getName(). " (". getAdminUserTypeName($level) . ")";
			}
			echo("<div class=textlink>&nbsp;&nbsp;&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;");
			echo("<a href='../admin/?mtype=$ADMIN_USER_TYPE&nindex=".$ids."'>".$name."</a></div>"); 
		}
		?>
	
	</div>
</div>
<?php
		break;
default :
?>
<div class="right_box3">
	<div class=item_tit>教师交流中心</div>
	<div class=item_txt>
	<?php 

		$tclass = new TeacherClass();
		for ($i = 0; $i < count($TEACHER_ITEM); $i++) {
			$items = $TEACHER_ITEM[$i];
			echo("<div class=textlink>&bull; <a href='../admin/?mtype=$TEACHER_TYPE&nindex=$i'>$items[0]</a></div>"); 
		}

		echo("<div class=textlink>&bull; &nbsp;教师交流</div>"); 
		$tlists = new TeacherListClass();
		$teachers = $tlists->getAllTeachers();
		for ($j = 0; $j < count($teachers); $j++) {
			$t = $teachers[$j];
			$tname = $t->getName();
			$tid = $t->getID();
			$tab = $tclass->getAllJiaoliu($tid, 1);
			$n_item = count($tab);
			echo("<div class=textlink>&nbsp;&nbsp;&nbsp;&nbsp;<IMG height=9 src=../images/arrow.gif width=8>&nbsp;");
			echo("<a href='../admin/?mtype=$TEACHER_TYPE&nindex=$i&teacher=$tid'>$tname</a> ($n_item)</div>"); 
			
		}
		
		?>
	
	</div>	
</div>
<?php 
		break;
} 
?>
	
