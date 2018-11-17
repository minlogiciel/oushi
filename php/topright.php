<?php 

$HORAIRES = array(
	array("星期一 ：", 		"关门", 		"关门"),
  	array("星期二 ：", 		"10h - 12h30", 	"13h30 - 17h"), 
  	array("星期三 ：", 		"10h - 12h30", 	"13h30 - 17h"),
  	array("星期四 ： ",		"关门", 		"13h30 - 17H"),
  	array("星期五 ：", 		"10h - 12h30",	"13h30 - 17h"),
  	array("星期六/日 ：",		"10h00 - 18h")
);

$ASSO_OUSHI = array(
	"法国欧洲时报文化中心位于巴黎近郊，遵照法国1901年对民间协会的法律规定正式注册，法文名称：ASSOCIATION DES AMIS DE NOUVELLES D'EUROPE(欧洲时报之友协会)。",
	"文化中心以促进法中文化交流，弘扬中华文化为宗旨，并为旅法华侨华人提供力所能及的服务。"
);

?>

<div class="right_box right_box_top">
	<?php 
	for ($i = 0; $i < count($ASSO_OUSHI); $i++) {
		echo("<p>".$ASSO_OUSHI[$i]."</p>");
	}
	?>
	<div class=gred_line>&nbsp;</div>
	
<?php 	$mm = date('n');
if ($mm != 7 && $mm != 8) { ?>	
	<h5>开放时间  :</h5>
	<div class=text7>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<?php for ($i = 0; $i < count($HORAIRES); $i++) { $item = $HORAIRES[$i]; ?>
				<TR>
				<?php if (count($item) == 2) {?>
					<TD class='horaire_lab' colspan=2>
						<?php echo($item[0]); ?>
					</TD>
					<TD class='horaire'>
						<?php echo($item[1]); ?>
					</TD>
				<?php } else { ?>
					<TD class='horaire_lab'>
						<?php echo($item[0]); ?>
					</TD>
					<TD class='horaire'>
						<?php echo($item[1]); ?>
					</TD>
					<TD class='horaire'>
						<?php echo($item[2]); ?>
					</TD>
				<?php } ?>
				</TR>
		<?php } ?>
		</TABLE>
	</div>
<?php } else { ?>
	<h5>暑期开门时间 (七月)</h5>
	<div class=text7>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class='horaire_lab' width=35%>
				开门时间 : 
			</TD>
			<TD class='horaire' colspan=2>
				&nbsp;&nbsp;星期一至星期五
			</TD>
		</TR>
		<TR>
			<TD class='horaire_lab'></TD>
			<TD class='horaire'>
						&nbsp;&nbsp;10h30 - 12h30 
			</TD>
			<TD class='horaire' >
						14h00 - 17h30 
			</TD>
		</TR>
		<TR>
			<TD class='horaire_lab' colspan=3 height=5>
				
			</TD>
		</TR>
		<TR>
			<TD class='horaire_lab' >
				图书馆开放时间 : 
			</TD>
			<TD class='horaire' colspan=2>
				&nbsp;&nbsp;星期五 
			</TD>
		</TR>
		<TR>
			<TD class='horaire_lab'></TD>
			<TD class='horaire' colspan=2>
						&nbsp;&nbsp;14h30 - 17h30 
			</TD>
		</TR>
		</TABLE>
	</div>
	<h5> 八月全月关门 (九月起恢复正常)</h5>
<?php } ?>

	<div class=gred_line>&nbsp;</div>
	<div class=text7>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class='horaire_lab' width=20%> 电话： </TD> 
			<TD class='horaire' width=80%> +33 (0)1 41 24 41 40</TD>
		</TR>
		<TR>
			<TD class='horaire_lab'> 地址： </TD> 
			<TD class='horaire'>  48-50 Rue Benoît Malon</TD>
		</TR>
		<TR>
			<TD class='horaire'></TD> 
			<TD class='horaire'>94250 Gentilly</TD>
		</TR>
		<TR>
			<TD class='horaire'></TD> 
			<TD class='horaire'>France</TD>
		</TR>
		</TABLE>
	</div>
</div>
<div class=box_bg>&nbsp; </div>
