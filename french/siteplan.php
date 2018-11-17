<?php
include ("rootvar.php");
include ($FDOC_PATH."/php/allinclude.php");
session_start();

include ($FDOC_PATH."/php/title.php");
?>
<BODY>
<div class="content">
<?php include ($FDOC_PATH."/php/maintitle.php"); ?>
<div class="left">
	<div class="left_box">
    	<div class=box_tit3>
    		<h1>Plan du site</h1>
    	</div><br><br>
		<div class="box500">
		
			<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
<?php 
			for ($i = 0; $i < count($MITEM); $i++) { 
				$m_item = $MITEM[$i];		
?>
			<TR>
				<TD width=5% valign=top></TD>
				<TD width=25% valign=top height=40>
					<div align=left>
					<A class=PAGE_BAR href='<?php echo($m_item[1]); ?>'><b><?php echo($m_item[0]); ?></b></A> :
					</div>
				</TD>	
				<TD width=70% valign=top>
<?php 	if (count($m_item) > 2) { $s_item = $m_item[2]; $n_item = count($s_item); ?>
					<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
<?php 				for ($j = 0;  $j < $n_item; $j+=6) {
						echo("<TR>");
						echo("<TD width=33% height=40 valign=top><a class=PAGE_BAR href='".$s_item[$j+1]."'>".$s_item[$j]."</a></TD>");
						if ($j < $n_item - 2) {
							echo("<TD width=33% valign=top><a class=PAGE_BAR href='".$s_item[$j+3]."'>".$s_item[$j+2]."</a></TD>");
						}
						else {
							echo("<TD width=33%>&nbsp;</TD>");
						}
						if ($j < $n_item - 5) {
							echo("<TD width=33% valign=top><a class=PAGE_BAR href='".$s_item[$j+5]."'>".$s_item[$j+4]."</a></TD>");
						}
						else {
							echo("<TD width=33%>&nbsp;</TD>");
						}
						echo("</TR>");
					}
?>
					</TABLE>
<?php } ?>
				</TD>	
<?php 
			} 
?>
			</TR>
			</TABLE>
		</div>
	</div>
   	<div class=box_bg>&nbsp; </div>
</div>
	
<div class="right">
	<?php include $FDOC_PATH."/php/right.php" ?>    
</div>
</div>
<?php include $FDOC_PATH."/php/foot.php"; ?>

</body>
</html>
