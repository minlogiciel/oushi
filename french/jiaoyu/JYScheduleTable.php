<?php $yy = getSchoolYear(); ?>
<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
	<TR>
		<TD class=tab_border>
			<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center>
			<TR>
				<TD class=PROG_TITLE height=30 width='4%'>&nbsp;</TD>
				<TD height=25 width=46% colspan=6 class=PROG_TITLE height=30>
					<?php echo("(" .$yy. "/9-".($yy+1)."/1 ）"); ?>
				</TD>
				<TD class=PROG_TITLE height=30 width='4%'>&nbsp;</TD>
				<TD height=25 width=46% colspan=6 class=PROG_TITLE>
					<?php echo("(" .($yy+1). "/2-".($yy+1)."/6 ）"); ?>
				</TD>
			</TR>
			<TR>
				<TD class=PROG_TITLE height=30 width='4%'>&nbsp;</TD>
				<TD class=PROG_TITLE width='15%' colspan=2>Mercredi</TD>
				<TD class=PROG_TITLE width='15%' colspan=2>Samedi</TD>
				<TD class=PROG_TITLE width='15%' colspan=2>Dimanche</TD>
				<TD class=PROG_TITLE height=25 width='4%'>&nbsp;</TD>
				<TD class=PROG_TITLE width='15%' colspan=2>Mercredi</TD>
				<TD class=PROG_TITLE width='15%' colspan=2>Samedi</TD>
				<TD class=PROG_TITLE width='15%' colspan=2>Dimanche</TD>
			</TR>
	<?php 
		$total_m = 21;
		for ($i = 1; $i <= $total_m; $i++) {
			$nn = $i%2;
			$classname = "PROG_LINE".$nn;
			$w3 = getScheduleDateString($i, 3, $yy);
			$w6 = getScheduleDateString($i, 6, $yy);
			$w7 = getScheduleDateString($i, 7, $yy);
			
			$ii = $i+$total_m;
			$w32 = getScheduleDateString($ii, 3, $yy);
			$w62 = getScheduleDateString($ii, 6, $yy);
			$w72 = getScheduleDateString($ii, 7, $yy);
	?>
			<TR>
				<TD class='PROG_TITLE' height=30><?php echo($i); ?>	</TD>
				<TD class="<?php echo($classname); ?>"><?php echo( $w3); ?></TD>
				<TD class="<?php echo($classname); ?>"></TD>
				<TD class="<?php echo($classname); ?>"><?php echo($w6); ?></TD>
				<TD class="<?php echo($classname); ?>"></TD>
				<TD class="<?php echo($classname); ?>"><?php echo( $w7); ?></TD>
				<TD class="<?php echo($classname); ?>"></TD>

				<TD class='PROG_TITLE'><?php echo($ii); ?></TD>
				<TD class="<?php echo($classname); ?>"><?php echo( $w32); ?></TD>
				<TD class="<?php echo($classname); ?>"></TD>
				<TD class="<?php echo($classname); ?>"><?php echo( $w62); ?></TD>
				<TD class="<?php echo($classname); ?>"></TD>
				<TD class='<?php echo($classname); ?>'><?php echo( $w72); ?></TD>
				<TD class='<?php echo($classname); ?>' ></TD>
			</TR>
	<?php } ?>
			</TABLE>
		</TD>
	</TR>
</TABLE>

