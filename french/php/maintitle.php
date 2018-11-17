<?php

$loguser = '';

$MITEM = array(
	array("Accueil", 				$HOST_URL."/french/home/"),
	array("Éducation Culturelle",	$HOST_URL."/french/jiaoyu/?action=withhuajiao",  
		array(
			"École Chinoise", 		$HOST_URL."/french/jiaoyu/",		
			"APELCF", 				$HOST_URL."/french/association/"), 
		),
	array("Échanges Culturels",		$HOST_URL."/french/jiaoliu/",
		array(
			"Expositions",  		$HOST_URL."/french/jiaoliu/?action=subitem&resource=exposition", 
			"Conférences et débats",$HOST_URL."/french/jiaoliu/?action=subitem&resource=formation",
			"Spectacles", 			$HOST_URL."/french/jiaoliu/?action=subitem&resource=conference",
			//"Salle Expositions", 	$HOST_URL."/french/jiaoliu/?action=subitem&resource=salleexpo"
		)
	),
	array("Activités culturelles",	$HOST_URL."/french/wenyi/",
		array(	
			"Cultures",  			$HOST_URL."/french/wenyi/?action=subitem&resource=wenhua", 
			"Sports",  				$HOST_URL."/french/wenyi/?action=subitem&resource=sports", 
			"Loisires",  			$HOST_URL."/french/wenyi/?action=subitem&resource=wenyi", 
		),
	), 
	array("Classes d'Ecole",			$HOST_URL."/french/newschool/"), 
	array("Inscriptions",			$HOST_URL."/french/register.php"), 
);

?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
<TR>
	<TD class=image_logo>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
		<TR>
			<TD valign=middle height=30>
				<TABLE cellSpacing=0 cellPadding=0 width="100%">
				<TR>
					<TD width=98% class=top_bar valign=top>
					|&nbsp;
					<?php if ($loguser) { ?>
						&nbsp;|&nbsp;
						<A class=top_bar href='../login/logout.php'>Déconnexion</A>&nbsp;|&nbsp;
					<?php } else if (0) { ?>
						<A class=top_bar href='../login/login.php'>Identifiez-vous</A>&nbsp;|&nbsp;
					<?php } else { ?>
						Bienvenue&nbsp;|&nbsp;
					<?php } ?>
						<A class=top_bar href='javascript:window.print()'>Imprimer</A>&nbsp;|
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
						<div align=right>
						 <a href="<?php echo($HOST_URL); ?>/home/"><IMG SRC="<?php echo($HOST_URL); ?>/images/chinaflag.png" border=0 width=38 height=25></a>
						</div>
					</TD>
					<TD class=flag_bar width=40>
						<div align=left>&nbsp; <a class=flag_bar href="<?php echo($HOST_URL); ?>/home/">中文</a></div>
					</TD>
					<TD class=flag_bar>
						<a href="<?php echo($HOST_URL); ?>/french/"><IMG SRC="<?php echo($HOST_URL); ?>/images/frenchflag.png" border=0 widht=30 height=25></a>
					</TD>
					<TD class=flag_bar width=100>
						<div align=left>&nbsp;<a class=flag_bar href="<?php echo($HOST_URL); ?>/french/">Français</a></div> 
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
			<TD>
				<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
				<TR>
					<TD class=bg_menu height=30 width=20></TD>
<?php 
				for ($i = 0; $i < count($MITEM); $i++) { 
					$m_item = $MITEM[$i];
					echo("<TD class=image_menu><div id='menu'><ul class='niveau1'>");
					echo("<li class='sousmenu'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
					echo("<A class=menu_bar href='".$m_item[1]."'>".$m_item[0]."</A>");
					if (count($m_item) > 2) {
						$s_item = $m_item[2];
						echo("<ul class='niveau2'>");
						$width = 80;
						$left = 0;
						for ($j = 0;  $j < count($s_item); $j+=2) {
							$ni = $j/2+1;
							$len = strlen($s_item[$j]);
							if ($len < 10)
								$width = 80;
							else if ($len > 20)
								$width = 150;
							else 
								$width = 120;
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
					<TD class=bg_menu width=180><em><b><?php showDateF(); ?></b></em></TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
</TR>

</TABLE>

<!--  end menu tool bar -->

