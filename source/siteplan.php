<?php
include "../php/allinclude.php";

include ("../php/title.php");
?>
<BODY>
<div class="content">
<?php include "../php/maintitle.php"; ?>
<div class="left">
	<div class="left_box">
    	<div class=box_tit3>
    		<h1>网站地图</h1>
    	</div><br><br>
		<div class="box500">
		
			<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
<?php 
			for ($i = 0; $i < count($MITEM); $i++) { 
				$m_item = $MITEM[$i];		
?>
			<TR>
				<TD height=50 width=15%></TD>
				<TD width=15%>
					<div align=left>
					<A class=SITE_MAP href='../<?php echo($m_item[1]); ?>'><b><?php echo($m_item[0]); ?></b></A> :
					</div>
				</TD>	
				<TD width=70%><div align=left>
<?php 
					if (count($m_item) > 2) {
						$s_item = $m_item[2];
						for ($j = 0;  $j < count($s_item); $j+=2) {
							echo("<a class=SITE_MAP href='".$s_item[$j+1]."'>".$s_item[$j]."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
						}
					}
?>
				</div></TD>	
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
	<?php include "../php/right.php" ?>       
</div>
</div>
<?php include "../php/foot1.php"; ?>

</body>
</html>
