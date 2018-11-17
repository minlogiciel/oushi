<?php

include_once("../jiaoliu/jl_include.php");
class JLPageBaseForm {
	var $maxfile = 6;
function resize_photo($imagename, $path) {
	if (strstr(strtoupper($imagename), ".JPG") || strstr(strtoupper($imagename), ".PNG") ) {
		$file = $path."/".$imagename; 		
		$save = $path."/s_".$imagename;
		list($width, $height) = getimagesize($file) ; 
		$image = imagecreatefromjpeg($file) ; 
		
		$newwidth = 200;
		$newheight = 150;
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
	
function uploadFile($srcfile, $destfile, $path) {
	$ret = 1;
	if (!file_exists($path)) {
 		mkdir($path, 0777, true);
	}
	if ($destfile && $srcfile) {
		if (file_exists( $path."/".$destfile)) {
	      	$ret = 2;
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

function WriteJLPhoto($lists, $nindex) {
	if ($nindex > 0 && count($lists) > 0) {
		$jlpage = new JLPageClass();
		if ($jlpage->getJLPage($nindex)) {
			$photos = "";
			$sphotos = "";
			$remarkc = "";
			$remarkf = "";

			for ($i = 0; $i < count($lists); $i++) {
				if ($i > 0) {
					$photos .= ";";
					$sphotos .= ";";
					$remarkc .= ";";
					$remarkf .= ";";
				}
				$photos .= $lists[$i][1];
				$sphotos .= $lists[$i][0];
				$remarkc .= $lists[$i][2];
				$remarkf .= $lists[$i][3];
			}
			$jlpage->setPhotos($photos);
			$jlpage->setSPhotos($sphotos);
			$jlpage->setRemarkC($remarkc);
			$jlpage->setRemarkF($remarkf);
			$jlpage->updateJLPhotos();
		}
	}
}

function uploadJLPhoto() {
	$nindex  = getPostValue("nindex");
	$nbphoto = getPostValue("nbphoto");	
	$path  	= getPostValue("filepath");
	if (!$path) {
		$path = strtolower($varname);
	}

	$lists = array();

	for ($i = 1; $i <= $nbphoto; $i++) {
		$ff = array();
		$del  = getPostValue("delete_".$i);
		if (!$del) {
			$ff[] = getPostValue("spphoto_".$i);
			$ff[] = getPostValue("pphoto_".$i);
			$ff[] = getPostValue("premarks_".$i);
			$ff[] = getPostValue("fpremarks_".$i);
			$lists[] = $ff;
		}
	}
	
 	for ($i = 1; $i < $this->maxfile; $i++) {
		$remake  = getPostValue("remarks_".$i);
		$fremake  = getPostValue("fremarks_".$i);
 		if(isset($_FILES['photo_'.$i])) { 
		    $photoname = basename($_FILES['photo_'.$i]['name']);
		    $tmpName = $_FILES['photo_'.$i]['tmp_name'];
		    $ret = $this->uploadFile($tmpName, $photoname, "../photos/" .$path);
		    if ($ret) {
				$ff = array();
				$ff[] = $path."/s_" .$photoname;
				$ff[] = $path."/" .$photoname;
				$ff[] = $remake;
				$ff[] = $fremake;
				$lists[] = $ff;
			}
		}
	}
	$this->WriteJLPhoto($lists, $nindex);
}


function addJiaoliuPage() {
	$jlpage = new JLPageClass();

	if(isset($_FILES['cphoto'])) { 
		$photoname = basename($_FILES['cphoto']['name']);
		$tmpName = $_FILES['cphoto']['tmp_name'];
		$ret = $this->uploadFile($tmpName, $photoname, "../photos/jiaoliunews");
	}
	
	if(isset($_FILES['fphoto'])) { 
		$photoname = basename($_FILES['fphoto']['name']);
		$tmpName = $_FILES['fphoto']['tmp_name'];
		$ret = $this->uploadFile($tmpName, $photoname, "../photos/jiaoliunews");
	}
	
	$nindex  		= getPostValue("nindex");
	$jiaoliutype  	= getPostValue("jiaoliutype");
	$title = replace_forbase(getPostValue("title"));
	$stitle = replace_forbase(getPostValue("subtitle"));
	$texte = replace_forbase(getPostValue("jlpagenews"));
	$image = getPostValue("imgfile");
	// french 
	$ftitle = replace_forbase(getPostValue("ftitle"));
	$fstitle = replace_forbase(getPostValue("fsubtitle"));
	$ftexte = replace_forbase(getPostValue("fjlpagenews"));
	$fimage = getPostValue("fimgfile");
	if (!$fimage)
		$fimage = $image;
	
	if ($nindex > 0) {
		$jlpage->getJLPage($nindex);
	}
	$position = getPostValue("position");
	
	$jlpage->setType($jiaoliutype);
	$jlpage->setTitle($title);
	$jlpage->setSTitle($stitle);
	$jlpage->setFTitle($ftitle);
	$jlpage->setFSTitle($fstitle);	
	$jlpage->setFContents($ftexte);
	$jlpage->setContents($texte);	
	$jlpage->setPhotoC($image);
	$jlpage->setPhotoF($fimage);
	$jlpage->setPosition($position);
	
	$jlpage->addJLPage();
	return "";
}


function showUploadJLPhotoForm($mindex, $nindex, $msg)  {
	global $JLPHOTO_TYPE, $JL_TAB, $JY_START_ITEM;
	$title = "";
	$photos = "";
	$path = "";
	$nbphoto = 0;
	$show = 0;

	$jlpage = new JLPageClass();
	if ($jlpage->getJLPage($nindex)) {
		$title 	= $jlpage->getTitle();
		$photos = $jlpage->getRelativePhotoList();
		$nbphoto = count($photos);
		if ($nbphoto > 0) {
			$pfile = $photos[0][0];
			$path_parts = pathinfo($pfile);
			$path = $path_parts['dirname'];	
		}
		else {
			$path = "jlpage_".$nindex."_sp";
		}
		$show = 1;
	}
?>
<FORM action='admin.php' name="uploadform" method=post enctype="multipart/form-data">
<INPUT type=hidden name='action' value='uploadjlphotos'>
<INPUT type=hidden name='mtype' value='<?php echo($JLPHOTO_TYPE); ?>'>
<INPUT type=hidden name='nindex' value='<?php echo($nindex); ?>'>
<INPUT type=hidden name='filepath' value='<?php echo($path); ?>'>
<INPUT type=hidden name='nbphoto' value='<?php echo($nbphoto); ?>'>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR><TD class=error height=20><?php echo($msg) ?></TD></TR>
<TR>
	<TD class=labelright>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD height=80>
				<div class=item_tit>
				<h2>上传文化交流相关照片</h2>
				<h4><font color=red>(图片尺寸 800 x 600)</font></h4>
				</div>
			</TD>
		</TR>
		<TR>
			<TD class=labelcenter height=50><h2><?php echo($title); ?></h2></TD>
		</TR>
		<TR>
			<TD>
				<TABLE cellSpacing=1 cellPadding=0 width=98% border=0 align=center>
				<TR>
					<TD class=TABLE_TITLE height=30 width=50% colspan=2>照片文件</TD>
					<TD class=TABLE_TITLE height=30 width=50% colspan=2>照片注释</TD>
				</TR>

<?php 	for ($p = 1; $p < $this->maxfile; $p++) { ?>
				<TR>
					<TD class=labelright height=30 width=5%><?php echo($p); ?>.</TD>
					<TD class=labelleft width=45%>
						<input name="photo_<?php echo($p); ?>" size=30 type="file" id="photo_<?php echo($p); ?>" title="photo_<?php echo($p); ?>" value="photo_<?php echo($p); ?>" >
					</TD>
					<TD class=labelleft width=50%>
						中文: <INPUT class=fields type=text size=35 name="remarks_<?php echo($p); ?>" id="remarks_<?php echo($p); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright height=30 width=5%> </TD>
					<TD class=labelleft width=45%> </TD>
					<TD class=labelleft width=50%>
						法文: <INPUT class=fields type=text size=35 name="fremarks_<?php echo($p); ?>" id="fremarks_<?php echo($p); ?>">
					</TD>
				</TR>
				<TR><TD colspan=3 height=20></TD></TR>
<?php } ?>
				</TABLE>
			</TD>
		</TR>

<?php if ($photos) { ?>
		<TR>
			<TD>
				<TABLE cellSpacing=2 cellPadding=0 width=98% border=0 align=center>
<?php 	for ($p = 1; $p <= count($photos); $p++) { 
			$pitem = $photos[$p-1];
			$pfile = $pitem[0];
			$photofile = $pitem[1];
			$premarks = $pitem[2];
			$fpremarks = $pitem[3];
?>
				<TR>
					<TD class=labelright height=30 width=5%><?php echo($p); ?>.</TD>
					<TD class=labelleft width=45%>
						<IMG src="../photos/<?php echo($pfile); ?>" height=50 alt="../photos/<?php echo($pfile); ?>">
						<INPUT class=box type='checkbox' name='delete_<?php echo($p); ?>'> 删除
						<INPUT type=hidden name="pphoto_<?php echo($p); ?>" value="<?php echo($photofile); ?>">
						<INPUT type=hidden name="spphoto_<?php echo($p); ?>" value="<?php echo($pfile); ?>">
					</TD>
					<TD class=labelleft width=50%>
						中文: <INPUT class=fields type=text size=35 name="premarks_<?php echo($p); ?>" id="premarks_<?php echo($p); ?>" value="<?php echo($premarks); ?>"><br>
						法文: <INPUT class=fields type=text size=35 name="fpremarks_<?php echo($p); ?>" id="fpremarks_<?php echo($p); ?>" value="<?php echo($fpremarks); ?>">
					</TD>
				</TR>
				<TR><TD colspan=3 height=10></TD></TR>
<?php 	} 	?>
				</TABLE>
			</TD>
		</TR>
<?php 	}  ?>

	
		<TR>
			<TD height=70 class=labelcenter>
<?php if ($show) { ?>	
				<INPUT class=button type=submit name="uploadphoto" value=' 上传照片 '>
<?php } ?>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
</FORM>
	
<?php	
}

function showJLPageForm($jlnews, $mindex, $nindex, $msg) {
	global $JLNEWS_TYPE, $JL_TAB;

	$modified 	= 0;
	$isupdate 	= 0;
	$title 		= "";
	$ftitle 	= "";
	$stitle 	= "";
	$fstitle 	= "";
	$news 		= "";
	$fnews 		= "";
	$imgfile	= "";
	$fimgfile	= "";
	$position 	= 1;
	$n_item 	= 1;
	$p_index 	= 0; 
	
	$jlpage = new JLPageClass();
	$n_max = $jlpage->getJLPageNumber();
	
	if ($jlnews) {
		$title 		= $jlnews[0];
		$stitle 	= $jlnews[0];
		$newstext 	= $jlnews[5];
		for ($i = 0; $i < count($newstext); $i++) {
			$news .= $newstext[$i]. "\n";
		}
		/* francais */		
		if (count($jlnews) > 6) {
			$fjlnews 	= $jlnews[6];
			$ftitle 	= $fjlnews[0];
			$fstitle 	= $fjlnews[0];
			$newstext 	= $fjlnews[5];
			for ($i = 0; $i < count($newstext); $i++) {
				$fnews .= $newstext[$i]. "\n";
			}
		}
		$modified = 1;
	}
	else {
		if ($jlpage->getJLPage($nindex)) {
			$title 		= $jlpage->getTitle();
			$stitle 	= $jlpage->getSTitle();
			$imgfile 	= $jlpage->getPhotoC();
			$news 		= $jlpage->getContents();
			$ftitle 	= $jlpage->getFTitle();
			$fstitle 	= $jlpage->getFSTitle();
			$fimgfile 	= $jlpage->getPhotoF();
			$fnews 		= $jlpage->getFContents();
			$n_item		= $jlpage->getType();
			$isupdate = 1;
			$p_index = $nindex;
			
			$position = $jlpage->getPosition();
			if ($position < 1) {
				$position = $nindex;
			}
		}
	}
	
?>

<FORM action='admin.php' name="addjlpage" method=post enctype="multipart/form-data">
<INPUT type=hidden name='action' value='addjlpage'>
<INPUT type=hidden name='mtype' value='<?php echo($JLNEWS_TYPE); ?>'>
<INPUT type=hidden name='nindex' value='<?php echo($p_index); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD class=error height=20><?php echo($msg) ?></TD></TR>
<TR>
	<TD height=50>
<?php 
		if ($isupdate) {
			echo("<h2>修改文化交流页面</h2>");
		} else { 
			echo("<h2>添加文化交流页面</h2>");
		} 
?>
	</TD>
</TR>
<TR>
	<TD>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD >
				<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
				<TR>
					<TD width=15% class=labelright1 height=30>中文题目 : </TD>
					<TD width=85% class=labelleft>
						<INPUT class=fields type=text size=70 name="title" value="<?php echo($title); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 height=30>中文副标题3 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=70 name="subtitle" value="<?php echo($stitle); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 height=30>图片 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=70 name="imgfile" id="imgfile" value="<?php echo($imgfile); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 height=30>上传图片 : </TD>
					<TD class=labelleft>
						<input name="cphoto" type="file" id="cphoto" title="cphoto" onChange='javascript:setJLPhoto(0);'>
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 valign=top>中文介绍 : </TD>
					<TD class=labelleft>
						<textarea class=fields name="jlpagenews" cols="70" rows="20"><?php echo($news); ?></textarea>
					</TD>
				</TR>
						
				<TR><TD colspan=2 height=20></TD></TR>
				<TR>
					<TD class=labelright1 height=30>法文题目 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=70 name="ftitle" value="<?php echo($ftitle); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 height=30>法文副标题 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=70 name="fsubtitle" value="<?php echo($fstitle); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 height=30>法文图片 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=70 name="fimgfile" id="fimgfile" value="<?php echo($fimgfile); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 height=30>上传法文图片 : </TD>
					<TD class=labelleft>
						<input name="fphoto" type="file" id="fphoto" title="fphoto" onChange='javascript:setJLPhoto(1);'>
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 valign=top>法文介绍 : </TD>
					<TD class=labelleft>
						<textarea class=fields name="fjlpagenews" cols="70" rows="20"><?php echo($fnews); ?></textarea>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD height=40 class=formlabel><div align=center>
<?php 
				for ($i = 1; $i <= count($JL_TAB); $i++) { 
					$items = $JL_TAB[$i-1];
					echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
					if ($n_item == $i) {
						echo("<INPUT type=radio name='jiaoliutype' value='".$i."' checked> ".$items[0]);
					}
					else {
						echo("<INPUT type=radio name='jiaoliutype' value='".$i."'> ".$items[0]);
					}
				}
?>
			</div></TD>
		</TR>
		<TR>
			<TD height=20 class=formlabel><div align=center>
				<select name="position" STYLE='width:120px; color:black; align: center'>
				<?php
				for ($k = 0; $k < $n_max; $k++) {
					if ($position == $k) {
						echo ("<option value=".$k." selected> " .$k. " </option>");
					}
					else {
						echo ("<option value=".$k."> " .$k. " </option>");
					}
				}
				?>
				</select>

			</div></TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD height=60 class=labelcenter>
	<?php 	if ($isupdate) { ?>
				<INPUT class=button type=submit value=' 修改'>
	<?php 	} else { ?>
				<INPUT class=button type=submit value=' 添加 '>
	<?php 	} ?>
		</TD>
	</TR>
</TABLE>

</FORM>
<?php
}



}
?>
