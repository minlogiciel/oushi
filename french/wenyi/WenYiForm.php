<?php


function listSummerTable($title, $col, $elements) {
	global $C_WEEKDAT;
	
	$nb = count($col)/2;
	
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
	<TR>
		<TD class=ITEMS_LINE_TITLE>
			<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center	class=registerborder>
			<TR>
				<TD height=25 width=100% colspan=6 class=TABLE_STITLE>
					<?php echo($title); ?>
				</TD>
			</TR>
			<TR>
				<TD class=ITEMS_LINE_TITLE height=25 width='3%'></TD>
			<?php for ($i = 0; $i < $nb; $i++) { ?>
				<TD class=ITEMS_LINE_TITLE width='<?php echo($col[$i*2+1]); ?>%' height=25><?php echo($col[$i*2]); ?></TD>
			<?php } ?>
			</TR>
	<?php $sw = 2;
		  $dm = 7;
		  $dd = 10;
		for ($i = 0; $i < count($elements); $i++) {
			$item 	= $elements[$i];
			$count 	= count($item);
			$sw++;
			$dd++;
			if ($dd > 32) {
				$dd = 1;
				$dm++;
			}
			
	?>
			<TR>
				<TD class='listnum'>
					<div align=center><?php echo($i+1); ?></div>
				</TD>
				<TD class='listtext'>
					<div align=center><?php echo($dm. "月". $dd. "日"); 	?></div>
				</TD>
				<TD class='listtext'>
					<div align=center><?php echo($C_WEEKDAT[$sw%7]); ?>	</div>
				</TD>
			<?php for ($cn = 0; $cn < $count; $cn++) {?>
				<TD class='listtext' colspan=<?php echo(4-$count); ?>>
					<div align=left>&nbsp;&nbsp;<?php echo($item[$cn]); ?> </div>
				</TD>
			<?php } ?>
			</TR>
	<?php } ?>
			</TABLE>
		</TD>
	</TR>
</TABLE>

<?php
}

function listProgramAdultTable($title, $col, $elements) {
	$nb = count($col)/2;
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
	<TR>
		<TD class=ITEMS_LINE_TITLE>
			<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center	class=registerborder>
			<TR>
				<TD height=25 width=100% colspan=<?php echo($nb); ?> class=TABLE_STITLE>
					<?php echo($title); ?>
				</TD>
			</TR>
			<TR>
			<?php for ($i = 0; $i < $nb; $i++) { ?>
				<TD class=ITEMS_LINE_TITLE width='<?php echo($col[$i*2+1]); ?>%' height=25><?php echo($col[$i*2]); ?></TD>
			<?php } ?>
			</TR>
<?php
		for ($i = 0; $i < count($elements); $i++) {
			$item 	= $elements[$i];
?>
			<TR>
<?php
			for ($j = 0; $j < $nb; $j++) {
?>
			
				<TD class='listtext'>
					<div align=left>&nbsp;&nbsp;<?php echo($item[$j]); ?> </div>
				</TD>
	<?php } ?>

			</TR>
	<?php } ?>
			</TABLE>
		</TD>
	</TR>
</TABLE>

<?php
}

function showProgramTableNode($elements) {
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
	<TR>
		<TD>
			<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<?php
			for ($i = 0; $i < count($elements); $i++) {
				$item 	= $elements[$i];
				$nb = count($item);
				if ($nb > 2) {
					echo("<TR><TD class='PROG_NOTE' colspan=2>&nbsp;".$item[0]."</TD></TR>");
					for ($j = 1; $j < count($item); $j++) {
						$sitem = $item[$j];
						echo("<TR><TD class='PROG_NOTE'>&nbsp;&nbsp;&nbsp;");
						echo ($sitem[0]. "&nbsp;&nbsp;". $sitem[1]);
						echo("</TD></TR>");
					} 
				}
				else {
					echo("<TR><TD class='PROG_NOTE'> " .($i+1). ".&nbsp;&nbsp;");
					echo ($item[0]. "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$item[1]);
					echo("</TD></TR>");
				}
			} 
?>
			</TABLE>
		</TD>
	</TR>
</TABLE>

<?php
}

function showProgramTable($title, $col, $elements) {
	$nb = count($col)/2;
?>

<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
	<TR>
		<TD>
			<TABLE cellSpacing=1 cellPadding=0 width=100% border=0 align=center	class=registerborder>
			<TR>
			<?php for ($i = 0; $i < $nb; $i++) { ?>
				<TD class=PROG_TITLE width='<?php echo($col[$i*2+1]); ?>%' height=40><?php echo($col[$i*2]); ?></TD>
			<?php } ?>
			</TR>
<?php
			for ($i = 0; $i < count($elements); $i++) {
				$item 	= $elements[$i];
				$nn = $i%2;
				echo("<TR>");
				for ($j = 0; $j < $nb; $j++) {
					
					if ($j == 0) {
						echo ("<TD class='PROG_TITLE' height=50>");
					}
					else {
						echo ("<TD class='PROG_LINE".$nn."'>");
					}
					echo($item[$j]. "</TD>");
				} 
	
				echo("</TR>");
			} 
?>
			</TABLE>
		</TD>
	</TR>
</TABLE>

<?php
}



?>