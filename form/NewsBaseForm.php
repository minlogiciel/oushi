<?php
include_once("../french/french_news_include.inc");
include_once("../public/topphoto.items.inc");
include_once("../huigu/huigu_include.php");
include_once("../public/huigu/huigulists.inc");

class NewsBaseForm {

	var $maxfile = 5;
	
function uploadFile($srcfile, $destfile, $path, $size) 
{
	$ret = 1;
	
	if ($destfile && $srcfile) {
		$lowstr = strtolower($destfile);
		if (strstr($lowstr, ".pdf") || strstr($lowstr, ".doc")) {
			$ret = move_uploaded_file($srcfile, "../files/".$destfile);
		}
		else {
			if (!file_exists($path)) {
	 			mkdir($path, 0777, true);
			}
			$ret = move_uploaded_file($srcfile, $path."/".$destfile);
			resize_photo($destfile, $destfile, $path, $size);
		}
	}
	else {
		$ret = 0;
	}
	return $ret;
}

function getPhotoPath($newstype) {
	$imagepath = "jiaoyunews";
	switch ($newstype) {
		case 1:
			$imagepath = "jiaoliunews";
			break;
		case 2:
			$imagepath = "wenyunews";
			break;
		case 3:
			$imagepath = "huajiao";
			break;
	}
	return "../photos/".$imagepath;
}

function WriteFastNews($newstype, $nindex) {
	$news = new NewsClass();
	$position = 0;
	$publie  		= getPostValue("newsdate");
	$kongzi 		= getPostValue("tokzhj");
	$title 			= replace_forbase(getPostValue("newstitle"));
	$resume 		= replace_forbase(getPostValue("resume"));
	$stitle 		= replace_forbase(getPostValue("subtitle"));
	$ftitle 		= replace_forbase(getPostValue("fnewstitle"));
	$fresume 		= replace_forbase(getPostValue("fresume"));
	$fstitle 		= replace_forbase(getPostValue("fsubtitle"));
	$orgnewstype 	= getPostValue("orgnewstype");
	if ($nindex > 0) {
		$news->getLastNews($nindex);
		$position = $nindex;
	}
	else {
		$position = $news->getNewsMaxNumber();
	}
	$news->setType($newstype);
	$news->setPublie($publie);
	$news->setKongzi($kongzi);
	$news->setPosition($position);
		
	$news->setTitle($title);
	$news->setResume($resume);
	$news->setSTitle($stitle);
	$news->setFTitle($ftitle);
	$news->setFResume($fresume);
	$news->setFSTitle($fstitle);
	
	$texte 			= changeDefinedTag(getPostValue("fastnews"));
	$ftexte 		= changeDefinedTag(getPostValue("ffastnews"));
	$photopath 		= $this->getPhotoPath($newstype);
	for ($i = 1; $i <= $this->maxfile; $i++) {
		if(isset($_FILES['photo_'.$i]))
		{ 
	    	$photoname = basename($_FILES['photo_'.$i]['name']);
	     	$tmpName = $_FILES['photo_'.$i]['tmp_name'];
			if ($this->uploadFile($tmpName, $photoname, $photopath, 600)) {
			}
			$lowstr = strtolower($photoname);
			if (strstr($lowstr, ".pdf") || strstr($lowstr, ".doc")) {
				$texte = replace_files($texte, $photoname, $i);
				$ftexte = replace_files($ftexte, $photoname, $i);
			}
			else {
				$texte = replace_photo($texte, $photoname, $photopath, $i);
				$ftexte = replace_photo($ftexte, $photoname, $photopath, $i);
			}
		}
	}
	$texte  		= replace_forbase($texte);
	$ftexte  		= replace_forbase($ftexte);
	$ftexte  		= replace_frenchpath($ftexte);
	$news->setFContents($ftexte);
	$news->setContents($texte);
	$news->addLastNews();
	return $news;
}
	

function showNewsForm($fastnews, $newstype, $nindex, $isupdate, $msg) {
	global $NEWS_TYPE, $FASTNEWS_JY, $FASTNEWS_JL, $FASTNEWS_WY;
	
	$action = "addfastnews";
	$newstitle = "";
	$resume = "";
	$subtitle = "";
	$newstime = date("Y-m-d");
	$news = "";
	$fnewstitle = "";
	$fresume = "";
	$fsubtitle = "";
	$fnews = "";
	$kongzi = 0;
	$photos = array("","","","","","","","","","");

	if ($nindex > 0) {
		$newsclass = new NewsClass();
		if ($newsclass->getLastNews($nindex)) {
			$newstime = $newsclass->getPublie();
			$kongzi = $newsclass->getKongzi();
			$newstitle = replace_forfield($newsclass->getTitle());
			$resume = replace_forfield($newsclass->getResume());
			$subtitle = replace_forfield($newsclass->getSTitle());
			$news = $newsclass->getContents();
			
			$fnewstitle = replace_forfield($newsclass->getFTitle());
			$fresume = replace_forfield($newsclass->getFResume());
			$fsubtitle = replace_forfield($newsclass->getFSTitle());
			$fnews = $newsclass->getFContents();
		}
	}
?>

<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
	<TR><TD class=error><?php echo($msg) ?></TD></TR>
	<TR>
		<TD height=50>
			<h2>欧洲时报文化中心快讯</h2>
		</TD>
	</TR>
	<TR>
		<TD>
		<FORM action='admin.php' name="uploadnews" method=post enctype="multipart/form-data">
		<INPUT type=hidden name='action' value='<?php echo($action); ?>'>
		<INPUT type=hidden name='mtype' value='<?php echo($NEWS_TYPE); ?>'>
		<INPUT type=hidden name='nindex' value='<?php echo($nindex); ?>'>
		<INPUT type=hidden name='orgnewstype' value='<?php echo($newstype); ?>' >
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD >
				<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
				<TR>
					<TD width=15% class=labelright1 height=40><?php showmark( ); ?> 快讯类型 : </TD>
					<TD width=85% class=labelleft>&nbsp;&nbsp;&nbsp;&nbsp; 
					<?php if ($newstype == $FASTNEWS_JL ) { ?>
						<INPUT class=box type='radio' name='newstype' value='0'> 文化教育快讯
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
						<INPUT class=box type='radio' name='newstype' value='1'  checked> 文化交流快讯
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
						<INPUT class=box type='radio' name='newstype' value='2'> 文艺活动快讯
					<?php } else if ($newstype == $FASTNEWS_WY) { ?>
						<INPUT class=box type='radio' name='newstype' value='0'> 文化教育快讯
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
						<INPUT class=box type='radio' name='newstype' value='1' > 文化交流快讯
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
						<INPUT class=box type='radio' name='newstype' value='2' checked> 文艺活动消息
					<?php } else { ?>
						<INPUT class=box type='radio' name='newstype' value='0' checked> 文化教育快讯
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
						<INPUT class=box type='radio' name='newstype' value='1' > 文化交流快讯
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
						<INPUT class=box type='radio' name='newstype' value='2'> 文艺活动消息
					<?php } ?>
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 height=30>课堂/华教 : </TD>
					<TD class=labelleft>&nbsp;&nbsp;&nbsp;&nbsp; 
					<?php if ($kongzi == 4) { ?>
						<INPUT class=box type='radio' name="tokzhj" value='4' checked> 孔子课堂
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
						<INPUT class=box type='radio' name="tokzhj" value='3'> 华文教育
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
						<INPUT class=box type='radio' name="tokzhj" value='0'> NO
					<?php } else if ($kongzi == 3) { ?>
						<INPUT class=box type='radio' name="tokzhj" value='4'> 孔子课堂
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    
						<INPUT class=box type='radio' name="tokzhj" value='3' checked> 华文教育
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
						<INPUT class=box type='radio' name="tokzhj" value='0'> NO
					<?php } else { ?>
						<INPUT class=box type='radio' name="tokzhj" value='4'> 孔子课堂
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
						<INPUT class=box type='radio' name="tokzhj" value='3'> 华文教育
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
						<INPUT class=box type='radio' name="tokzhj" value='0' checked> NO
					<?php } ?>
					</TD>
				</TR>
				<TR>
					<TD width=15% class=labelright1 height=30><?php showmark( ); ?> 发布日期 : </TD>
					<TD width=85% class=labelleft>					
						<INPUT class=fields type=text size=20 name="newsdate" value='<?php echo($newstime); ?>'>
						<font color=red>&nbsp;&nbsp;&nbsp; 时间格式 : yyyy-mm-dd (2015-01-01)</font>
					</TD>
				</TR>


				<TR><TD class=labelright1 colspan=2 height=25></TD></TR>
				<TR>
					<TD class=labelright1 height=30><?php showmark( ); ?> 快讯题目 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=70 name="newstitle" value="<?php echo($newstitle); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 height=30>快讯简介 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=70 maxlength="55" name="resume" value="<?php echo($resume); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 height=30>快讯付标题 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=70 name="subtitle" value='<?php echo($subtitle); ?>'>
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 valign=top><?php showmark( ); ?> 中文快讯 : </TD>
					<TD class=labelleft>
						<textarea class=fields name="fastnews" cols="70" rows="20"><?php echo($news); ?></textarea>
					</TD>
				</TR>
				<TR> <TD colspan=2 height=30></TD></TR>
				
				<TR>
					<TD  class=labelright1 height=30><?php showmark( ); ?> 法文题目 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=70 name="fnewstitle" value='<?php echo($fnewstitle); ?>'>
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 height=30>法文简介 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=70 maxlength="90" name="fresume" value='<?php echo($fresume); ?>'>
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 height=30>法文付标题 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=70 name="fsubtitle" value='<?php echo($fsubtitle); ?>'>
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 valign=top><?php showmark( ); ?> 法文快讯 : </TD>
					<TD class=labelleft>
						<textarea class=fields name="ffastnews" cols="70" rows="20"><?php echo($fnews); ?></textarea>
					</TD>
				</TR>
				<TR><TD class=labelright1 colspan=2 height=25></TD></TR>
		<?php 
			for ($i = 1; $i <= $this->maxfile; $i++) {
		?>
				<TR>
					<TD class=labelright1 height=30>上传照片<?php echo($i); ?> : </TD>
					<TD class=labelleft>
						<input name="photo_<?php echo($i); ?>" size=35 type="file" id="photo_<?php echo($i); ?>">
					</TD>
				</TR>				
		<?php } ?>	
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD height=60 class=formlabel>
				<div align=center>
				<?php if ($isupdate) { ?>
				<INPUT class=button type=submit value=' 修改快讯 '>
				<?php } else { ?>
				<INPUT class=button type=submit value=' 添加快讯 '>
				<?php } ?>
				</div>
			</TD>
		</TR>
		<TR><TD height=25></TD></TR>
		<TR>
			<TD >
				<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
				<TR>
					<TD width=15% class=labelright1 height=20>可用格式 : </TD>
					<TD class=labelleft>
						<font color=red>
						&lt;IMG#&gt; &nbsp;&nbsp;
						&lt;TH1&gt; 中间题目 &lt;/TH1&gt; &nbsp;&nbsp;
						&lt;TSPAN&gt; 左边空格 &lt;/TSPAN&gt; &nbsp;&nbsp;
						</font>
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 height=20> </TD>
					<TD class=labelleft>
						<font color=red>
						&lt;b&gt;<b>粗体</b> &lt;/b&gt; &nbsp;&nbsp;
						&lt;em&gt;<em>斜体</em>&lt;/em&gt; &nbsp;&nbsp;
						空格符号 : &amp;nbsp; 
						</font>
					</div>
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 height=20> </TD>
					<TD class=labelleft>
						<font color=red>
						&lt;font color=blue size=3&gt;<font color=blue size=3>蓝色3号字</font>&lt;/font&gt; &nbsp;&nbsp;<br>
						&lt;font color=green size=1&gt;<font color=green size=1>绿色1号字</font>&lt;/font&gt; &nbsp;&nbsp;
						</font>
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 height=25>链接格式 : </TD>
					<TD class=labelleft>
						<font color=red>
						&lt;W&gt;http://culture-oushi.com&lt;/W&gt;文化中心&lt;/A&gt; &nbsp;&nbsp;
						</font>
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 height=25>下载格式 : </TD>
					<TD class=labelleft>
						<font color=red>
						&lt;F#&gt;点击下载文件&lt;/F&gt; &nbsp;&nbsp;(只能是Word和PDF文件)
						</font>
					</TD>
				</TR>
				<TR><TD class=labelright1 colspan=2 height=25></TD></TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
		</FORM>
	</TD>
</TR>
</TABLE>
<?php
}


function WriteTopNews() {
	$newslistclass= new NewsListClass();
	$newslistclass->resetTopNews();
	
	$varr = "";
	$photopath = "top";
	$ntop = 5;
	for ($i = 1; $i < 6; $i++) {
		$newsclass = new NewsClass();
		$ids = getPostValue("tvariable_".$i);
		$cfile = getPostValue("tphoto_".$i);
		$ffile = getPostValue("ftphoto_".$i);  
		if (!$ffile) {
			$ffile = $cfile;
		}
		if ($newsclass->getLastNews($ids)) {
			$newsclass->setTop5($ntop);
			$newsclass->setTopPhotoC($cfile);
			$newsclass->setTopPhotoF($ffile);
			$newsclass->updateTopNews();
			$ntop--;
		}
			
		if(isset($_FILES['fphoto_'.$i]))
		{ 
	    	$photoname = basename($_FILES['fphoto_'.$i]['name']);
	     	$tmpName = $_FILES['fphoto_'.$i]['tmp_name'];
			if ($this->uploadFile($tmpName, $photoname, "../photos/".$photopath, 650)) {
			}
		}
		if(isset($_FILES['ffphoto_'.$i]))
		{ 
	    	$photoname = basename($_FILES['ffphoto_'.$i]['name']);
	     	$tmpName = $_FILES['ffphoto_'.$i]['tmp_name'];
			if ($this->uploadFile($tmpName, $photoname, "../photos/".$photopath, 650)) {
			}
		}
	}
}
		
function showTopPhotoForm($msg) {
	global $PHOTO_TYPE;
	$newslistclass = new NewsListClass();
	$toplists = $newslistclass->getTopNews();
	$lists = $newslistclass->getLatestNewsLists(-1, 5);
	
?>

<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
	<TR><TD class=error height=20><?php echo($msg) ?></TD></TR>
	<TR>
		<TD height=80><div class=item_tit>
			<h2>欧洲时报文化主页图片</h2>
			<h4><font color=red>(图片尺寸 650 x 380， 图片文件名不要有中文和空格)</font></h4>
			</div>
		</TD>
	</TR>
	<TR><TD class=error height=20></TD></TR>
	<TR>
		<TD>
		<!-- FORM method=post action='admin.php' -->
		<FORM action='admin.php' name="uploadtopphoto" method=post enctype="multipart/form-data">
		<INPUT type=hidden name='action' value='modifytopphoto'>
		<INPUT type=hidden name='mtype' value='<?php echo($PHOTO_TYPE); ?>'>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD>
				<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<?php
		for ($i = 1; $i <= count($toplists); $i++) { 
			$elem = $toplists[$i-1];
			$ids = $elem->getID();
			$title = $elem->getTitle();
			$photo = $elem->getTopPhotoC();
			$fphoto = $elem->getTopPhotoF();
?>
				<TR>
					<TD width=10% class=lcenter height=30><?php echo($i); ?> :</TD>
					<TD width=45% class=labelleft>
						<select name="phototitle_<?php echo($i); ?>" STYLE='width:280px; color:black; align: center' onChange='javascript:setTopTitle3(this, <?php echo($i); ?>);'>
	<?php 
						$tvar = 0;
						for ($k = 0; $k < count($lists); $k++) {
							$elems = $lists[$k];
							$l_ids 		= $elems->getID();
							$l_title 	= $elems->getTitle();
							$l_photo 	= basename($elems->getTopPhotoC());
							$l_fphoto 	= basename($elems->getTopPhotoF());
							$vname = $l_ids. "|". $l_title. "|" .$l_photo. "|" .$l_fphoto;
							if ($ids == $l_ids) {
								echo ("<option value=".$vname." selected> " .$l_title. " </option>");
								$tvar = $ids;
							}
							else {
								echo ("<option value=".$vname."> " .$l_title. " </option>");
							}
						}
						?>
						</select>
					</TD>
					<TD width=45% class=labelleft>
						<input name="title_<?php echo($i); ?>" size=35 type="text" id="title_<?php echo($i); ?>" value="<?php echo($title); ?>" readonly>
						<input name="tvariable_<?php echo($i); ?>" size=2 id="tvariable_<?php echo($i); ?>" type="text" value="<?php echo($tvar); ?>" readonly>
					</TD>
				</TR>				
				<TR>
					<TD width=5% class=lcenter height=30 >中文图
					</TD>
					<TD width=50% class=labelleft>
						<input name="fphoto_<?php echo($i); ?>" type="file" id="fphoto_<?php echo($i); ?>" onChange='javascript:setTopPhoto(<?php echo($i); ?>, 0);'>
					</TD>
					<TD width=45% class=labelleft>
						<input name="tphoto_<?php echo($i); ?>" size=35 type="text" id="tphoto_<?php echo($i); ?>" value="<?php echo($photo); ?>">
					</TD>
				</TR>				
				<TR>
					<TD width=5% class=lcenter height=30 >法文图
					</TD>
					<TD width=50% class=labelleft>
						<input name="ffphoto_<?php echo($i); ?>" type="file" id="ffphoto_<?php echo($i); ?>" onChange='javascript:setTopPhoto(<?php echo($i); ?>, 1);'>
					</TD>
					<TD width=45% class=labelleft>
						<input name="ftphoto_<?php echo($i); ?>" size=35 type="text" id="ftphoto_<?php echo($i); ?>" value="<?php echo($fphoto); ?>">
					</TD>
				</TR>				
				<TR><TD colspan=3 height=20> </TD></TR>				
		<?php } ?>
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD height=60 class=lcenter>
				<INPUT class=button type=submit value=' 修改主页图片 '>
			</TD>
		</TR>
		</TABLE>
		</FORM>
	</TD>
</TR>
</TABLE>
<?php
}

function WriteMainNews() {
	global $FASTNEWS_ASSO, $FASTNEWS_KZ;
	
	$newslistclass= new NewsListClass();
	$newslistclass->resetMainNews();
	$newsclass= new NewsClass();
	for ($n = 0; $n < 3; $n++) {
		for ($i = 0; $i < 3; $i++) {
			$varname = "news_".$n."_".$i;
			$ids = getPostValue($varname);
			
			$varname = "newnews_".$n."_".$i;
			$star = getPostValue($varname);

			if ($newsclass->getLastNews($ids)) {
				$newsclass->setMainnews(3-$i);
				$newsclass->setStars($star);
				$newsclass->updateMainNews();
			}
		}
	}	
}

function showMainNewsForm($msg) {
	global $MNEWS_TYPE;
	$NTABLE = array("文化教育", "文化交流 ", "文化娱乐 ");
	$NEWSLISTS = array();
	$MAINNEWSLISTS = array();
	$newsclass= new NewsListClass();
	for ($n = 0; $n < 3; $n++) {
		$NEWSLISTS[] = $newsclass->getLatestNewsLists($n, 10);
		$MAINNEWSLISTS[] = $newsclass->getMainNewsLists($n);
	}
	
?>

<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
	<TR><TD class=error height=20><?php echo($msg) ?></TD></TR>
	<TR>
		<TD height=80><div class=item_tit>
			<h2>欧洲时报文化中心主页消息</h2>
			</div>
		</TD>
	</TR>
	<TR><TD class=error height=20></TD></TR>
	<TR>
		<TD>
		<FORM action='admin.php' name="updatenews" method=post>
		<INPUT type=hidden name='action' value='modifymainnews'>
		<INPUT type=hidden name='mtype' value='<?php echo($MNEWS_TYPE); ?>'>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD>
				<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<?php	
	for ($n = 0; $n < 3; $n++) { 
		$news_tab = $NEWSLISTS[$n];
		$main_tab = $MAINNEWSLISTS[$n];
		$main_tab_nb = count($main_tab);
?>
				<TR>
					<TD class=lcenter height=40 width=55% colspan=2>
						<font colr=green size=3><b><?php echo($NTABLE[$n]); ?> : </b></font> 
					</TD>
					<TD class=labelleft width=45%></TD>
				</TR>
			
<?php
 		for ($i = 0; $i < 3; $i++) { 
 			if ($i < $main_tab_nb) {
				$news_id = $main_tab[$i]->getID();
				$star = $main_tab[$i]->getStars();
 			}
			
?>
				<TR>
					<TD width=5% class=lcenter height=30><?php echo(($i+1)); ?> : </TD>
					<TD width=45% class=labelleft>
						<select name="news_<?php echo($n); ?>_<?php echo($i); ?>" STYLE='width:280px; color:black; align: center'>
							<option value=""> --- </option>
<?php 
						$tvar = "";
						for ($j = 0; $j < count($news_tab); $j++) {
							$ids = $news_tab[$j]->getID();
							$tstr = $news_tab[$j]->getTitle();
							if ($news_id == $ids) {
								echo ("<option value=".$ids." selected> " .$tstr. " </option>");
							}
							else {
								echo ("<option value=".$ids."> " .$tstr. " </option>");
							}
						}
						?>
						</select>
					</TD>
					<TD width=50% class=labelleft>
				<?php 	if ($star) { ?>
						<INPUT class=box type='checkbox' name="newnews_<?php echo($n); ?>_<?php echo($i); ?>" value='1' checked> 新消息
					<?php } else { ?>
						<INPUT class=box type='checkbox' name="newnews_<?php echo($n); ?>_<?php echo($i); ?>" value='1'> 新消息
					<?php } ?>
					</TD>
				</TR>				

				<TR><TD colspan=3 height=10></TD></TR>				
		<?php } ?>
	
		<?php }  ?>
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD height=60 class=lcenter>
				<INPUT class=button type=submit value=' 修改主页消息 '>
			</TD>
		</TR>
		</TABLE>
		</FORM>
	</TD>
</TR>
</TABLE>
<?php
}

function WriteHuiguItemName($huigu, $nindex, $active){
	global $HUIGU_ITEM_NAME;
	if ($nindex < 1) {
		$HUIGU_ITEM_NAME[] = array($huigu[0], $huigu[1][1], $huigu[4][0], "", "",  $huigu[4][1][0], $huigu[1][0], $active);
	}
	else {
		$HUIGU_ITEM_NAME[$nindex-1][0] = $huigu[0];
		$HUIGU_ITEM_NAME[$nindex-1][1] = $huigu[1][1];
		$HUIGU_ITEM_NAME[$nindex-1][2] = $huigu[4][0];
		$HUIGU_ITEM_NAME[$nindex-1][5] = $huigu[4][1][0];
		$HUIGU_ITEM_NAME[$nindex-1][6] = $huigu[1][0];
		$HUIGU_ITEM_NAME[$nindex-1][7] = $active;
	}
	
	$text  = "<?php\n\$HUIGU_ITEM_NAME = array(\n";
	for ($i = 0; $i < count($HUIGU_ITEM_NAME); $i++) {
		$text  .= "\tarray(" .OS_GetTableString($HUIGU_ITEM_NAME[$i], 0, 0). "),\n";
	}
	$text  .= ");\n\n?>\n\n";
	
	$fp = fopen("../huigu/huigu_include.php", "w");	
	fwrite($fp, $text);
	fclose($fp);
	
}

function getHuiguString($huigu) {
			
	$text  = "array(\n";
	$text  .= "\"".$huigu[0]."\", \n"; 									// title
	$text  .= "array(" .OS_GetTableString($huigu[1], 0, 0). 	"),\n"; 	// image
	$text  .= "array(\n" .OS_GetTableString($huigu[2], 2, 1). "),\n"; 	// text
	$text  .= "array(\n";													// link
	for ($i = 0; $i < count($huigu[3]); $i++) {								// each photo
		$p = $huigu[3][$i];
		$text  .= "\tarray(".OS_GetTableString($p, 0, 0). "),\n";
	}
	$text  .= "),\n";	
	return $text;
}


function WriteHuigu($huigu, $nindex){
	global $HG_NEWS, $HUIGU_ITEM_NAME;
	$ret = $nindex;
	$nb_v = count($HG_NEWS)+1;
	if ($nindex < 1) {
		$ret = count($HG_NEWS)+1;
	}

	$active = getPostValue("huigu_active");
	
	$vname = "HGNEWS".$ret;
		
	$text  = "<?php\n\$" .$vname. " = ";
	$text  .= $this->getHuiguString($huigu);
	
	$text  .= "\n// version francais\n";	
	
	$text  .= $this->getHuiguString($huigu[4]);
	$text  .= "),\n";	
	
	$text  .= "1\n);\n\n?>\n";	

	$fname = "../public/huigu/hg_news".$ret.".inc";
	$fp = fopen($fname, "w");
	fwrite($fp, $text);
	fclose($fp); 
	
	if ($active) {
		$fname = "../public/lastnews/huigunews/hg_news".$ret.".inc";
		$fp = fopen($fname, "w");
		fwrite($fp, $text);
		fclose($fp); 
	}
	/* write list file */	
	if ($nindex < 1) {

		$text  = "<?php\n\n";
		for ($i = 1; $i <= $nb_v; $i++) {
			$text .= "include (\"hg_news".$i.".inc\");\n";
		}
		$text .= "\n\n\$HG_NEWS = array(";
		for ($i = 1; $i <= $nb_v; $i++) {
			if ($i > 1)
				$text .= ", \$HGNEWS".$i;
			else
				$text .= "\$HGNEWS".$i;
		}
		$text .= ");\n\n ?>\n\n";
	
		$lname = "../public/huigu/huigulists.inc";
		$fp = fopen($lname, "w");	
		fwrite($fp, $text);
		fclose($fp);

		if ($active) {
			$lname = "../public/lastnews/huigunews/huigulists.inc";
			$fp = fopen($lname, "w");	
			fwrite($fp, $text);
			fclose($fp);
		}
		
	}
	$this->WriteHuiguItemName($huigu, $nindex, $active);
	return $ret;
}
	
function getHuigu() {
	$huigu = array();
	
	
	$huigu[] = changeDoubleString(getPostValue("huigutitle")); // 0 title
	$img = array();
	$img[]  = "huigu/".getPostValue("tphoto_1");
	$img[]  = changeDoubleString(getPostValue("huiguimgtxt"));
	$img[]  = getPostValue("huiguhost");
	$img[]  = getPostValue("huigudate");
	$huigu[] = $img;											// 1 image
	
	if(isset($_FILES['fphoto_1']))
	{ 
		$photoname = basename($_FILES['fphoto_1']['name']);
		$tmpName = $_FILES['fphoto_1']['tmp_name'];
		OS_UploadFile($tmpName, $photoname, "../photos/huigu", 450, 1);
	}
	$huigu[] = OS_TextToTable(getPostValue("huigutext")); 		// 2 text
	
	$nindex = getPostValue("nindex");
	$nbp = getPostValue("nbphotos");
	$videos = array();
	for ($i = 0; $i < $nbp; $i++) {
		$vtitle = getPostValue("vtitle_".$i);
		if ($vtitle) {				
			$vshowtitle = getPostValue("vshowtitle_".$i);
			if (!$vshowtitle) {
				$vshowtitle = $vtitle;
			}
			$vtp = getPostValue("vtp_".$i);
			$vcode = getPostValue("vcode_".$i);
			$vcode1 = getPostValue("vcode1_".$i);
			$p = array();
			$p[] = $vtitle;
			$p[] = $vshowtitle;
			$p[] = $vtp;
			$p[] = $vcode;
			$p[] = $vcode1;
			$videos[] = $p;
		}
	}
	$huigu[] = $videos;										// 3 videos

	// francais 
	$fdata = array();
	$ftitle = changeDoubleString(getPostValue("fhuiguimgtxt")); 
	$fdata[] = $ftitle;										// 0 F title 
	$fimg = array();
	$fimg[]  = $img[0];
	$fimg[]  = $ftitle;
	$fimg[]  = $img[2];
	$fimg[]  = getPostValue("fhuigudate");
	$fdata[] = $fimg;										// 1 image 
	$fdata[] = OS_TextToTable(getPostValue("fhuigutext")); 	// 2 F text
	$fdata[] = $videos;										// 3 videos
	// end francais
	
	$huigu[] = $fdata;										// 4 francais
	$huigu[] = 1;											// 5 flag avec francais 
	return $huigu;
}
	
function showHuiguForm($huiguelem, $nindex, $msg) {
	global $HUIGU_TYPE, $HG_NEWS, $FHG_NEWS, $HUIGU_ITEM_NAME;
	if ($huiguelem) {
		$huigu = $huiguelem;
	}
	else if ($nindex > 0) {
		$huigu = $HG_NEWS[$nindex-1];
	}
	else {
		$huigu = "";
	} 
	if ($huigu) {
		$title = $huigu[0];
		$image 		= basename($huigu[1][0]);
		$image_txt 	= $huigu[1][1];
		$serv_host 	= $huigu[1][2];
		$huigudate 	= $huigu[1][3];
		$texte = "";
		$nb = count($huigu[2]);
		while ($nb > 0) {
			if (trim($huigu[2][$nb-1])) {
				break;
			}
			$nb--;
		}
		for ($i = 0; $i < $nb; $i++) {
			$texte .= $huigu[2][$i]. "\n";
		}
		$photos = $huigu[3];
		$nbp = count($photos) + 5;
		if (count($huigu) > 4) {
			$fitem 			= $huigu[4];
			$fimage_txt 	= $fitem[1][1];
			$fhuigudate 	= $fitem[1][3];
			
			$nb = count($fitem[2]);
			while ($nb > 0) {
				if (trim($fitem[2][$nb-1])) {
					break;
				}
				$nb--;
			}
			$ftexte = "";
			for ($i = 0; $i < $nb; $i++) {
				$ftexte .= $fitem[2][$i]. "\n";
			}
		}
		else {
			$fimage_txt 	= "";
			$fhuigudate 	= "";
			$ftexte = "";
		}
		$active = $HUIGU_ITEM_NAME[$nindex-1][7];
	}
	else {
		$title = "";		
		$huigudate = "";
		$image = "";
		$image_txt = "";
		$texte = "";
		$ftexte = "";
		$serv_host = "";
		$photos = array();
		$nbp = 10;
		$active = 0;
		$fhuigudate = "";
		$fimage = "";
		$fimage_txt = "";
	}
?>

<FORM action='admin.php' name="updatehuigu" method=post enctype="multipart/form-data">
<INPUT type=hidden name='action' value='addhuigu'>
<INPUT type=hidden name='mtype' value='<?php echo($HUIGU_TYPE); ?>'>
<INPUT type=hidden name='nindex' value='<?php echo($nindex); ?>'>
<INPUT type=hidden name='nbphotos' value='<?php echo($nbp); ?>'>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<TR><TD class=error height=30><?php echo($msg) ?></TD></TR>
<TR>
	<TD>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD width=15% class=labelright1 height=30>回顾题目 :</TD>
			<TD width=85% class=labelleft >
				<INPUT class=fields type=text size=80 name="huigutitle" value="<?php echo($title); ?>">
			</TD>
		</TR>
		<TR>
			<TD  class=labelright1 height=30>回顾照片 : </TD>
			<TD class=labelleft >
				<INPUT class=fields type=text size=28 id="tphoto_1" name="tphoto_1" value="<?php echo($image); ?>">
				&nbsp;&nbsp;&nbsp;&nbsp 
				<input name="fphoto_1" type="file" id="fphoto_1" onChange='javascript:setTopPhoto(1, 0);'>
			</TD>
		</TR>
		<TR>
			<TD  class=labelright1 height=30>照片注释 :</TD>
			<TD class=labelleft >
				<INPUT class=fields type=text size=80 name="huiguimgtxt" value="<?php echo($image_txt); ?>">
			</TD>
		</TR>
		<TR>
			<TD class=labelright1 height=30>回顾日期 : </TD>
			<TD class=labelleft >
				<INPUT class=fields type=text size=28 name="huigudate" value="<?php echo($huigudate); ?>">
				&nbsp;&nbsp;&nbsp;&nbsp;视频网站 : 
				<INPUT class=fields type=text size=30 name="huiguhost" value="<?php echo($serv_host); ?>">
			</TD>
		</TR>
		<TR>
			<TD class=labelright1 valign=top>回顾简介 : </TD>
			<TD class=labelleft >
				<textarea class=fields name="huigutext" cols="58" rows="12"><?php echo($texte); ?></textarea>
			</TD>
		</TR>
		<TR><TD colspan=2 height=20></TD></TR> 
		<TR>
			<TD  class=labelright1 height=30>法文题目  : </TD>
			<TD class=labelleft >
				<INPUT class=fields type=text size=80 name="fhuiguimgtxt" value="<?php echo($fimage_txt); ?>">
			</TD>
		</TR>
		<TR>
			<TD class=labelright1 height=30>法文日期 : </TD>
			<TD class=labelleft >
				<INPUT class=fields type=text size=28 name="fhuigudate" value="<?php echo($fhuigudate); ?>">
			</TD>
		</TR>
		<TR>
			<TD class=labelright1 valign=top>法文简介 : </TD>
			<TD class=labelleft >
				<textarea class=fields name="fhuigutext" cols="58" rows="12"><?php echo($ftexte); ?></textarea>
			</TD>
		</TR>
		<TR><TD colspan=2 height=20></TD></TR> 
		<TR>
			<TD class=labelright1 height=30>显示回顾 : </TD>
			<TD class=labelleft>
				<?php if ($active) { ?>
				<INPUT class=box type='checkbox' name='huigu_active' value='1'  checked>
				<?php } else { ?>
				<INPUT class=box type='checkbox' name='huigu_active' value='1'>
				<?php } ?>
			</TD>
		</TR>
		<TR><TD colspan=2 height=20></TD></TR> 
		</TABLE>
	</TD>
</TR>
<TR>
	<TD>
		<TABLE cellSpacing=0 cellPadding=1 width=98% border=0 align=center>
		<TR>
			<TD width=4% class=ITEMS_LINE_TITLE height=30></TD>
			<TD width=30% class=ITEMS_LINE_TITLE height=30>活动题目</TD>
			<TD width=20% class=ITEMS_LINE_TITLE height=30>显示名称</TD>
			<TD width=6% class=ITEMS_LINE_TITLE height=30>类型</TD>
			<TD width=20% class=ITEMS_LINE_TITLE height=30>链接1</TD>
			<TD width=20% class=ITEMS_LINE_TITLE height=30>链接2</TD>
		</TR>
<?php  
for ($i = 0; $i < $nbp; $i++) { 
	$item1 = "";
	$item2 = "";
	$item3 = "";
	$item4 = "";
	$item5 = "";
	if ($i < count($photos)) {
		$item1 = $photos[$i][0];
		$item2 = $photos[$i][1];
		$item3 = $photos[$i][2];
		$item4 = $photos[$i][3];
		$item5 = $photos[$i][4];
	}
?>
		<TR>
			<TD class=listnum>
				<?php echo($i+1); ?>
			</TD>
			<TD>
				<INPUT class=fields type=text size=35 name="vtitle_<?php echo($i); ?>" value="<?php echo($item1); ?>">
			</TD>
			<TD>
				<INPUT class=fields type=text size=15 name="vshowtitle_<?php echo($i); ?>" value="<?php echo($item2); ?>">
			</TD>
			<TD>
				<INPUT class=fields type=text size=4 name="vtp_<?php echo($i); ?>" value="<?php echo($item3); ?>">
			</TD>
			<TD>
				<INPUT class=fields type=text size=15 name="vcode_<?php echo($i); ?>" value="<?php echo($item4); ?>">
			</TD>
			<TD>
				<INPUT class=fields type=text size=15 name="vcode1_<?php echo($i); ?>" value="<?php echo($item5); ?>">
			</TD>
		</TR>
<?php } ?>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD height=60 class=lcenter>
<?php if ($nindex>0) { ?>
		<INPUT class=button type=submit value=' 修改 '>
<?php } else { ?>
		<INPUT class=button type=submit value=' 添加 '>
<?php } ?>
	</TD>
</TR>
</TABLE>
</FORM>
<?php
}

function getLastAnnonceTable() {
	$annonce = array();
	$ff = array();
	$ff[] = getPostValue("ctitle");
	$ff[] = getPostValue("ftitle");
	$ff[] = getPostValue("tochinese");
	$ff[] = getPostValue("tofrench");
	$annonce[] = $ff;
	$annonce[] = OS_TextToTable(getPostValue("cannonce")); 
	$annonce[] = OS_TextToTable(getPostValue("fannonce"));
	
	return $annonce;
}
function WriteLastAnnonce() {
	$annonce = $this->getLastAnnonceTable();

	$text  = "<?php\n\n\$LAST_ANNONCE = array(\n";
	for ($i = 0; $i < count($annonce); $i++) {
		if ($i == 0) {
			$text .= "array(" .OS_GetTableString($annonce[$i], 0, 0). ")";
		}
		else {
			$text .= ",\narray(\n" .OS_GetTableString($annonce[$i], 1, 1). "\n)";
		}
	}
	$text .= "\n);\n\n?>\n";
	$fp = fopen("../public/last_annonces.inc", "w");
	fwrite($fp, $text);
	fclose($fp);
	
	return $annonce;
}

function showAnnonceForm($news, $msg) {
	global $LAST_ANNONCE, $ANNO_TYPE;

	$cannonce = "";
	$fannonce = "";
	if ($news) {
		$tab = $news;
	}
	else {
		$tab = $LAST_ANNONCE;
	}
	$ctitle = $tab[0][0];
	$ftitle = $tab[0][1];
	$toc = $tab[0][2];
	$tof = $tab[0][3];
	for ($i = 0; $i < count( $tab[1]); $i++) {
		$cannonce .= $tab[1][$i]. "\n";
	}
	for ($i = 0; $i < count( $tab[2]); $i++) {
		$fannonce .= $tab[2][$i]. "\n";
	}
?>

<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
	<?php if ($msg) { ?>
	<TR><TD class=error><?php echo($msg) ?></TD></TR>
	<?php } ?>
	<TR>
		<TD height=50>
			<h2>欧洲时报文化中心最新通知</h2>
		</TD>
	</TR>
	<TR>
		<TD>
		<FORM method=post action='admin.php'>
		<INPUT type=hidden name='action' value='lastannonce'>
		<INPUT type=hidden name='mtype' value='<?php echo($ANNO_TYPE); ?>'>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD >
				<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
				<TR>
					<TD width=15% class=labelright1 height=30>中文题目 : </TD>
					<TD width=85% class=labelleft>
						<INPUT class=fields type=text size=70  name="ctitle" value="<?php echo($ctitle); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 valign=top>中文通知 : </TD>
					<TD class=labelleft>
						<textarea class=fields name="cannonce" cols="60" rows="12"><?php echo($cannonce); ?></textarea>
					</TD>
				</TR>
				
				<TR>
					<TD class=labelright1 height=30>法文题目 : </TD>
					<TD class=labelleft>
						<INPUT class=fields type=text size=70 name="ftitle" value="<?php echo($ftitle); ?>">
					</TD>
				</TR>
				<TR>
					<TD class=labelright1 valign=top>法文通知 : </TD>
					<TD class=labelleft>
						<textarea class=fields name="fannonce" cols="60" rows="12"><?php echo($fannonce); ?></textarea>
						</div>
					</TD>
				</TR>
				<TR>
					<TD colspan=2 valign=top height=50 class=lcenter>
					<?php if ($toc) { ?>
						<INPUT class=box type='checkbox' name="tochinese" value='1' checked> 中文通知
					<?php } else { ?>
						<INPUT class=box type='checkbox' name="tochinese" value='1'> 中文通知
					<?php } if ($tof) { ?>
						<INPUT class=box type='checkbox' name="tofrench" value='1' checked> 法文通知
					<?php } else { ?>
						<INPUT class=box type='checkbox' name="tofrench" value='1'> 法文通知
					<?php } ?>
					</TD>
				</TR>		
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD height=60 class=formlabel>
				<div align=center>
				<INPUT class=button type=submit value=' 修改通知'>
				</div>
			</TD>
		</TR>
		</TABLE>
		</FORM>
	</TD>
</TR>
</TABLE>
<?php
}



}
?>