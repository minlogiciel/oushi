
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
<TR>
	<TD class=image_logo>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
		<TR>
			<TD valign=middle height=30>
				<TABLE cellSpacing=0 cellPadding=0 width="100%">
				<TR>
					<TD width=98% class=top_bar valign=top>
					您好，欢迎来到欧洲时报文化中心&nbsp;|&nbsp;
						<A class=top_bar href='javascript:window.print()'>打印本页</A>&nbsp;|
						</div>
					</TD>
					<TD class=top_bar width=2%>&nbsp;</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD valign=top>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
				<TR>
					<TD class=top_bar height=150 width=100%>&nbsp;</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD height=40 width=100%>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
				<TR>
					<TD height=40 width=81% class=flag_bar>
						 <a href="../home/"><IMG SRC="../images/chinaflag.png" border=0 width=38 height=25></a>
					</TD>
					<TD class=flag_bar width=40>
							<div align=left>&nbsp; <a class=flag_bar href="../home/">中文</a></div>
					</TD>
					<TD class=flag_bar>
						<a href="../french/"><IMG SRC="../images/frenchflag.png" border=0 widht=30 height=25></a>
					</TD>
					<TD class=flag_bar width=100>
						<div align=left>&nbsp;<a class=flag_bar href="../french/">Français</a></div> 
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
<TR>
	<TD>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
		<TR>
			<TD class=TITLE_LINE>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
				<TR>
					<TD class=TITLE_LINE height=30 width=20></TD>
<?php 
				for ($i = 0; $i < count($MITEM); $i++) { 
					$m_item = $MITEM[$i];		
					echo("<TD class=image_menu><div id='menu'><ul class='niveau1'>");
					echo("<li class='sousmenu'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
					echo("<A class=menu_bar href='../".$m_item[1]."'>".$m_item[0]."</A>");
					if (count($m_item) > 2) {
						$s_item = $m_item[2];
						echo("<ul class='niveau2'>");
						$width = 80;
						$left = 0;
						for ($j = 0;  $j < count($s_item); $j+=2) {
							$ni = $j/2+1;
							$len = strlen($s_item[$j]);
							if ($len < 10)
								$width = 60;
							else if ($len > 20)
								$width = 120;
							else 
								$width = 100;
							echo("<li style='width:".$width."px; left:".$left."px;background:#666666;'>");
							echo("<a class=menu_bar href='".$s_item[$j+1]."'>".$s_item[$j]."</a>");
							echo("</li>");
							$left += $width;
						}
						echo("</ul>");
					}						
					echo("</li></ul></div></TD>");	
				} 
?>
					<TD class=TITLE_LINE width=200>
						<div style="margin-right:13px;"><font size=1><?php showDate(); ?></font></div>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>
</TABLE>

<!--  end menu tool bar -->

