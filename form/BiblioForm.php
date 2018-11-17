<?php

class BiblioForm {


function addBiblioArticles() {
	
}


function showBiblioForm($nindex, $msg) {
	$isupdate = 0;
?>
<FORM action='admin.php' method=post>
<INPUT type=hidden name='action' value='addbiblio'>
<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
<TR><TD class=error height=20><?php echo($msg) ?></TD></TR>
<TR><TD height=50><h2>添加修改最新推荐 </h2></TD></TR>
<TR>
	<TD>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD >
				<TABLE cellSpacing=0 cellPadding=0 width=98% border=0 align=center>
				<TR>
					<TD width=20% class=labelright1 height=30>推荐题目 : </TD>
					<TD width=80% class=labelleft>
						<INPUT class=fields type=text size=85 name="title" value="<?php echo($title); ?>">
					</TD>
				</TR>
				<TR>
					<TD width=20% class=labelright1 height=30>作者/导演 : </TD>
					<TD width=80% class=labelleft>
						<INPUT class=fields type=text size=85 name="title" value="<?php echo($title); ?>">
					</TD>
				</TR>
				<TR>
					<TD width=20% class=labelright1 height=30>主演 : </TD>
					<TD width=80% class=labelleft>
						<INPUT class=fields type=text size=85 name="title" value="<?php echo($title); ?>">
					</TD>
				</TR>
				<TR>
					<TD width=20% class=labelright1 height=30>类型: </TD>
					<TD width=80% class=labelleft>
						<INPUT class=fields type=text size=85 name="title" value="<?php echo($title); ?>">
					</TD>
				</TR>
				<TR>
					<TD width=20% class=labelright1 height=30>内容简介: </TD>
					<TD width=80% class=labelleft>
						<INPUT class=fields type=text size=85 name="title" value="<?php echo($title); ?>">
					</TD>
				</TR>
				<TR><TD colspan=2 height=15></TD></TR>		
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD height=60 class=formlabel>
				<div align=center>
				<?php if ($isupdate) { ?>
				<INPUT class=button type=submit value=' 修改'>
				<?php } else { ?>
				<INPUT class=button type=submit value=' 添加 '>
				<?php } ?>
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
