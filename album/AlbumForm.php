<?php


class AlbumForm {
	var $maxfile = 8;
function resize_photo($imagename, $path) {
	if (strstr(strtoupper($imagename), ".JPG")) {
		$file = $path."/".$imagename; 		
		$save = $path."/s_".$imagename;
		list($width, $height) = getimagesize($file) ; 

		$image = imagecreatefromjpeg($file) ; 
		
		$percent = 100/$width;
		$newwidth = $width * $percent;
		$newheight = $height * $percent;
		$tn = imagecreatetruecolor($newwidth, $newheight) ; 
		imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
		imagejpeg($tn, $save, 50) ;
		 
		$percent = 800/$width;
		$newwidth = $width * $percent;
		$newheight = $height * $percent;
		$tn = imagecreatetruecolor($newwidth, $newheight) ; 
		imagecopyresampled($tn, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height) ; 
		imagejpeg($tn, $file, 75) ; 
		
	}
}	
	
function uploadFile($srcfile, $destfile, $path) 
{
	$ret = 1;
	if (!file_exists($path)) {
 		mkdir($path, 0777, true);
	}
	if ($destfile && $srcfile) {
		if (file_exists( $path."/".$destfile)) {
	      	$ret = 0;
	    } else {
			$ret = move_uploaded_file($srcfile, $path."/".$destfile);
			$this->resize_photo($destfile, $path);
	    }
	}
	else {
		$ret = 0;
	}
	return $ret;
}

function uploadAlbum() {
	global $ALBUM_PATH;
	$lists = array();

	$title = getPostValue("title");
	$ftitle = getPostValue("ftitle");
	$ftitle = replace($ftitle);
	$groups = getPostValue("groups");
	
	$photodate = getPostValue("photodate");
	
	$path = $ALBUM_PATH."/".$photodate;
	for ($i = 1; $i < $this->maxfile; $i++) {
		if(isset($_FILES['photo_'.$i]))
		{ 
	    	$photoname = basename($_FILES['photo_'.$i]['name']);
	     	$tmpName = $_FILES['photo_'.$i]['tmp_name'];
	     	$remake  = getPostValue("remarks_".$i);
			if ($this->uploadFile($tmpName, $photoname, $path)) {
				$album = new AlbumClass();
				$album->setDates($photodate);
				$album->setTitle($title);
				$album->setFTitle($ftitle);
				$album->setPath($path);
				$album->setFiles($photoname);
				$album->setRemarks($remake);
				$album->setGroups($groups);
				$album->addNewPhoto();
				$lists[] = $album;
			}
		}
	}
	$nbphoto = getPostValue("nbphoto");
	for ($i = 1; $i <= $nbphoto; $i++) {
    	$album = new AlbumClass();
		$remake  = getPostValue("premarks_".$i);
    	$id  = getPostValue("photoid_".$i);
		$del  = getPostValue("pdelete_".$i);
    	
 		if ($album->getPhoto($id) ) {
			$album->setDates($photodate);
			$album->setTitle($title);
			$album->setFTitle($ftitle);
			$album->setRemarks($remake);
			$album->setDeleted($del);
			$album->updatePhoto();
 		}
	}
	
	return $lists;
}

function showUploadAlbumForm($lists, $dd, $tt, $groups)  {
	global $ALBUM_TYPE, $ALBUM_ITEM_NAME;
	$title = "";
	$ftitle = "";
	$ll = "";
	$nll = 0;
	$dates = "";
	if ($lists) {
		$album = $lists[0];
		$title = $album->getTitle();
		$ftitle = $album->getFTitle();
		$dates = $album->getDates();
	}
	else if ($dd)  {
		$dates = $dd;
		$title = $tt;
		$albumlist = new AlbumList(); 
 		$ll = $albumlist->getAlbumDateTitleLists($dates, $tt, $groups);
 		$nll = count($ll);
 		if ($nll > 0) {
			$ftitle = $ll[0]->getFTitle();
 		}
	}
	if ($groups < 0) {
		$groups = count($ALBUM_ITEM_NAME) - 1;
	}
	$nb_day = $ALBUM_ITEM_NAME[$groups][3];
	$s_day =  $ALBUM_ITEM_NAME[$groups][4];
	list($annee, $mois, $jour) =  explode("-", $s_day);
	
	$TAlbum = "上传".$ALBUM_ITEM_NAME[$groups][0]."照片";
?>
<FORM action='admin.php' name="uploadform" method=post enctype="multipart/form-data">
<INPUT type=hidden name='action' value='uploadphotos'>
<INPUT type=hidden name='mtype' value='<?php echo($ALBUM_TYPE); ?>'>
<INPUT type=hidden name='nbphoto' value='<?php echo($nll); ?>'>
<INPUT type=hidden name='groups' value='<?php echo($groups); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=labelright>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD height=80 colspan=4>
				<div class=item_tit><h2><?php echo($TAlbum); ?></h2></div>
			</TD>
		</TR>
		<TR>
			<TD height=80 colspan=4>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class=labelright width=15%  height=30>中文题目 : </TD>
					<TD class=labelleft width=35%>
						<INPUT class=fields type=text size=35 name="title" id="title" value="<?php echo($title); ?>">
					</TD>
					<TD class=labelright width=15%>日期 : </TD>
					<TD class=labelleft width=35%>
						<select name="photodate" STYLE='width:150px; color:black; align: center' >
						<?php 
						for ($i = 0; $i < $nb_day; $i++) {
							$s = getMonthDayString($annee, $mois, $jour, $i);
							
							if ($s == $dates)
								echo ("<option value=".$s." selected> " .$s. " </option>");
							else
								echo ("<option value=".$s."> " .$s. " </option>");
						}
						?>
						</select>
					</TD>
				</TR>
				<TR>
					<TD class=labelright height=30>法文题目 : </TD>
					<TD class=labelleft colspan=3>
						<INPUT class=fields type=text size=50 name="ftitle" id="ftitle" value="<?php echo($ftitle); ?>">
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR><TD colspan=4><div class=item_tit><h2> </h2></div></TD></TR>
		<?php if ($ll) { ?>
		<TR>
			<TD colspan=4 class=TABLE_TITLE>
				<TABLE cellSpacing=2 cellPadding=0 width=90% border=0 align=center>
				<TR>
					<TD class=TABLE_TITLE height=30 colspan=2 width=40%>照片文件名</TD>
					<TD class=TABLE_TITLE height=30 width=45%>照片注释</TD>
					<TD class=TABLE_TITLE height=30 width=15%>删除</TD>
				</TR>
		<?php for ($p = 1; $p <= count($ll); $p++) { 
			$pfile = $ll[$p-1]->getFiles();
			$premarks = $ll[$p-1]->getRemarks();
			$pid = $ll[$p-1]->getID();
			$del = $ll[$p-1]->isDeleted();
		?>
			<TR>
				<TD class=labelcenter width=5%>
					<?php echo($p); ?>
					<INPUT type=hidden name="photoid_<?php echo($p); ?>" value='<?php echo($pid); ?>'>
				</TD>
				<TD class=labelleft >
					<?php echo($pfile); ?>
				</TD>
				<TD class=labelleft >
					<INPUT class=fields type=text size=35 name="premarks_<?php echo($p); ?>" id="premarks_<?php echo($p); ?>" value="<?php echo($premarks); ?>">
				</TD>
				<TD class=labelcenter > 
					<?php if ($del) { ?>
					<INPUT class=box type='checkbox' name='pdelete_<?php echo($p); ?>' value='1'  checked>
					<?php } else { ?>
					<INPUT class=box type='checkbox' name='pdelete_<?php echo($p); ?>' value='1'>
					<?php } ?>
				</TD>
			</TR>
		<?php } ?>
				</TABLE>
			</TD>
		</TR>
		<TR><TD colspan=4><div class=item_tit><h2> </h2></div></TD></TR>
		<?php 
		} 
		for ($p = 1; $p < $this->maxfile; $p++) { ?>
		<TR>
			<TD class=labelright height=30>照片<?php echo($p); ?> : </TD>
			<TD class=labelleft>
				<input name="photo_<?php echo($p); ?>" size=35 type="file" id="photo_<?php echo($p); ?>" title="photo_<?php echo($p); ?>" value="photo_<?php echo($p); ?>" >
			</TD>
			<TD class=labelright height=30>注释<?php echo($p); ?> : </TD>
			<TD class=labelleft>
				<INPUT class=fields type=text size=35 name="remarks_<?php echo($p); ?>" id="remarks_<?php echo($p); ?>" value="">
			</TD>
		</TR>
		<?php } ?>
		<TR><TD height=50 class=labelleft colspan=4></TD></TR>
		<TR>
			<TD height=50 class=labelright colspan=4>
				<div align=center>
					<INPUT class=button type=submit name="uploadphoto" value=' 上传照片 ' id="uploadphotoid">
				</div>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
</FORM>
	
<?php	
}

function showAlbumAList($lists, $dates, $tt, $showdate) {
	$cn = 5;
	$np = count($lists);
 	if ($np > 0) {
?>
	<TR>
		<TD height=25 width=100% colspan=<?php echo($cn); ?>>
			<div class=item_tit><h4><?php if (!$tt || $showdate) { echo($tt. " ( ".$dates." )"); } else {echo($tt); } ?></h4></div>
		</TD>
	</TR>
<?php  	
	$p = 0;
	for ($i = 0; $i < $np; $i+=$cn) {
?>			
	<TR>
<?php 
		for ($m = 0; $m < $cn; $m++) {
?>
		<TD class='listtext' height=30 width=20%><div align=center>
<?php 			
		if ($p < $np) {
			$str = $lists[$p]->getTitle(). "-" .$lists[$p]->getDates();
			$path = $lists[$p]->getPath();
			$files = $lists[$p]->getFiles();
			$remarks =  $lists[$p]->getRemarks();

			echo("<a class='fancybox' data-fancybox-group='".$str."'  href='".$path."/".$files."' title='".$remarks."'>");
			echo("<IMG src='".$path."/s_".$files."' width=100 height=75 border=0></a>");
		}
		$p++;
?>
		&nbsp;</div></TD>
<?php 	
		} 
?>
	</TR>
<?php 
	}
?>
	<TR><TD colspan=<?php echo($cn); ?> height=20>&nbsp;</TD></TR>
<?php 
	}
}

function showAlbumList($dates, $tt, $groups) {
	global $ALBUM_ITEM_NAME;
	if ($groups < 0) {
		$groups = count($ALBUM_ITEM_NAME)-1;
	}
		
?>	
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD height=70 width=100%>
		<div class=item_tit><h2><?php echo($ALBUM_ITEM_NAME[$groups][1]); ?> </h2></div>
	</TD>
</TR>
<TR>
	<TD class=background>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<?php 
		$albumlist = new AlbumList(); 
		$lists = $albumlist->getAlbumDateTitleLists($dates, $tt, $groups);
 		$this->showAlbumAList($lists, $dates, $tt, 1);
?>		

		</TABLE>
	</TD>
</TR>
</TABLE>
<?php 
}

function showAlbumAllList($sem, $groups) {
	global $ALBUM_ITEM_NAME;
	$albumlist = new AlbumList(); 
	$s_day =  $ALBUM_ITEM_NAME[$groups][4];
	list($annee, $mois, $jour) =  explode("-", $s_day);
	if ($annee == 2016)
		$showdate = 0;
	else 
		$showdate = 1;
	if (count($ALBUM_ITEM_NAME[$groups]) > 8) {
		if (isFrancais())
	 		$resu =  ArrayToString($ALBUM_ITEM_NAME[$groups][9]);
	 	else
	 		$resu =  ArrayToString($ALBUM_ITEM_NAME[$groups][8]);
	}
	else 
		$resu = ""
 	
		
?>	
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR>
	<TD class=background>
		<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center>
<?php 
	$step = 7;
	$start = $sem*$step; $end = $start + $step;
	for ($k = $start; $k < $end; $k++) {
		$dates = getMonthDayString($annee, $mois, $jour, $k);
 		$lists = $albumlist->getAlbumLists($dates, $groups);
 		if ($lists) {
 			$ll = array();
 			if (isFrancais()) {
 				$title =  $lists[0]->getFTitle();
 				if (!$title)
 					$title =  $lists[0]->getTitle();
 			}
 			else {
				$title =  $lists[0]->getTitle();
 			}
 			$ll[] = $lists[0];
 			for ($i = 1; $i < count($lists); $i++) {
	 			if (isFrancais()) {
	 				$tt =  $lists[$i]->getFTitle();
 					if (!$tt)
 						$tt =  $lists[$i]->getTitle();
	 			}
	 			else {
					$tt =  $lists[$i]->getTitle();
	 			}
 				if ($title == $tt) {
 					$ll[] = $lists[$i];
 				}
 				else {
 					$this->showAlbumAList($ll, $dates, $title, $showdate);
					if (isFrancais()) {
 						$title = $lists[$i]->getFTitle();
 						if (!$title)
 							$title =  $lists[$i]->getTitle();
					}
 					else {
						$title =  $lists[$i]->getTitle();
 					}
 					$ll = array();
 					$ll[] = $lists[$i];
 				}
 			}
 			$this->showAlbumAList($ll, $dates, $title, $showdate);
 		}
	}
?>
		</TABLE>
	</TD>
</TR>
</TABLE>
<?php 
}

function addNewAlbum() {
	global $ALBUM_ITEM_NAME;
	
	$groups  = getPostValue("groups");
	$talbum  = getPostValue("talbum");
	$title  = getPostValue("title");
	$ftitle  = getPostValue("ftitle");
	$startday  = getPostValue("startday");
	$endday  = getPostValue("endday");
	$photofile = getPostValue("tphoto_1");
	$active = getPostValue("album_active");
	$text = getPostValue("albumtext");
	$ftext = getPostValue("falbumtext");
	if(isset($_FILES['fphoto_1'])) { 
		$pfile = basename($_FILES['fphoto_1']['name']);
		$tmpName = $_FILES['fphoto_1']['tmp_name'];

		if ($pfile && $tmpName) {
			$lowstr = strtolower($pfile);
			if ((strstr($lowstr, ".jpg") || strstr($lowstr, ".png"))) {
				move_uploaded_file($tmpName, "../photos/album/".$pfile);
				resize_photo($pfile, $pfile, "../photos/album", 450);
				$photofile = $pfile;
			}
		}
	}
	$diff = NbJours($startday, $endday);
	
	$item = array($talbum, $title, $ftitle, $diff, $startday, $endday, $photofile, $active, AreaTextToTable($text), AreaTextToTable($ftext));
	
	$lists = array();
	for($i = 0; $i < count($ALBUM_ITEM_NAME); $i++) {
		if ($i == $groups) {
			$lists[] = $item;
		}
		else {
			$lists[] = $ALBUM_ITEM_NAME[$i];
		}
	}
	if ($groups < 0) {
		$lists[] = $item;
	}
	

	$text  = "<?php\n\$ALBUM_ITEM_NAME  = array(\n";
	for($i = 0; $i < count($lists); $i++) {
		$elem = $lists[$i];
		if (count($elem) > 8) {
			$resum = $elem[8];
			$fresum = $elem[9];
		}
		else {
			$resum = array("");
			$fresum = array("");
		}
		$text .= "\tarray(\"".$elem[0]."\", \"".$elem[1]."\", \"".$elem[2]."\", ".$elem[3].", \"" .$elem[4]."\", \"" .$elem[5]."\", \""  .$elem[6]."\",";
		if ($elem[7]) {
			$text .= " 1,"; 
		}
		else {
			$text .= " 0,"; 
		}
		$text .= "\n\t\t" .ArrayToArrayString($resum). ",\n\t\t".ArrayToArrayString($fresum)."),\n";
	}		
	$text .= ");\n\n?>\n\n";
	
	
	$filename = "../album/album_items.inc";
	$fp = fopen($filename, "w");
	fwrite($fp, $text);
	fclose($fp);
	return $lists;
}


function showNewAlbumForm($newsitem, $groups, $msg)  {
	global $ALBUM_TYPE, $ALBUM_ITEM_NAME;
	$album = date("Y")."年夏令营";
	$title = $album."生活";
	$ftitle =  date("Y")." Stage linguistique d'été";
	$text = $title;
	$ftext =  $ftitle;
	$startday = date("Y-m-d");
	$endday = $startday;
	$active = 0;
	$photo = "";
	$TTITLE = "添加新相册";
	$VTITLE = "添加新相册";
	$tab = $ALBUM_ITEM_NAME;
	if ($newsitem) {
		$tab = $newsitem;
	}
	if ($groups >=0) {
		$album = $tab[$groups][0];
		$title = $tab[$groups][1];
		$ftitle = $tab[$groups][2];
		$startday = $tab[$groups][4];
		$endday = $tab[$groups][5];
		$photo = $tab[$groups][6];
		$active = $tab[$groups][7];
		if (count($tab[$groups]) > 8) {
			$text = ArrayToString($tab[$groups][8]);
			$ftext = ArrayToString($tab[$groups][9]);
		}
		$VTITLE = "修改相册";
		$TTITLE = "修改".$album."相册";
	}

?>
<FORM action='admin.php' name="createalbum" method=post enctype="multipart/form-data">
<INPUT type=hidden name='action' value='createalbum'>
<INPUT type=hidden name='mtype' value='<?php echo($ALBUM_TYPE); ?>'>
<INPUT type=hidden name='groups' value='<?php echo($groups); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR><TD class=error height=20><?php echo($msg) ?></TD></TR>
<TR>
	<TD class=labelright>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD height=80 colspan=4>
				<div class=item_tit><h2><?php echo($TTITLE); ?></h2></div>
			</TD>
		</TR>
		<TR>
			<TD height=80 colspan=4>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class=labelright width=20%  height=30>相册名称 : </TD>
					<TD class=labelleft width=80%>
						<INPUT class=fields type=text size=60 name="talbum" id="title" value="<?php echo($album); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright width=20%  height=30>相册中文题目 : </TD>
					<TD class=labelleft width=80%>
						<INPUT class=fields type=text size=60 name="title" id="title" value="<?php echo($title); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright width=15%  height=30>相册中文介绍 : </TD>
					<TD class=labelleft width=85% colspan ='3'>
						<textarea class=fields name="albumtext" cols="62" rows="8"><?php echo($text); ?></textarea>
					</TD>
				</TR>
				<TR>
					<TD class=labelright height=30>相册法文题目 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=60 name="ftitle" id="ftitle" value="<?php echo($ftitle); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright width=15%  height=30>相册法文介绍 : </TD>
					<TD class=labelleft width=85% colspan ='3'>
						<textarea class=fields name="falbumtext" cols="62" rows="8"><?php echo($ftext); ?></textarea>
					</TD>
				</TR>
				<TR>
					<TD class=labelright>日期 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=13 name="startday" id="startday" value="<?php echo($startday); ?>"> -  
						<INPUT class=fields type=text size=13 name="endday" id="endday" value="<?php echo($endday); ?>"> 
						<font color='#aaaaaa'>(2014-12-27)</font>
					</TD>
				</TR>
				<TR>
					<TD class=labelright height=30>相册封面照片 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=60 name="tphoto_1" id="tphoto_1" value="<?php echo($photo); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright height=30>上传封面照片 : </TD>
					<TD class=labelleft>
						<input type="file"  size=35 name="fphoto_1" id="fphoto_1" onChange='javascript:setTopPhoto(1, 0);'>
					</TD>
				</TR>
				<TR>
					<TD class=labelright height=30>显示相册 : </TD>
					<TD class=labelleft>
						<?php if ($active) { ?>
						<INPUT class=box type='checkbox' name='album_active' value='1'  checked>
						<?php } else { ?>
						<INPUT class=box type='checkbox' name='album_active' value='1'>
						<?php } ?>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR><TD height=50 class=labelleft colspan=4></TD></TR>
		<TR>
			<TD height=50 class=labelright colspan=4>
				<div align=center>
					<INPUT class=button type=submit name="createalbum" value=' <?php echo($VTITLE); ?> ' id="createalbum">
				</div>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
</FORM>
	
<?php	
}


}
?>
