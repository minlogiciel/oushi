<?php 
include "../php/allinclude.php";
session_start();
include "../php/header.php"; 

include "../register/HuoDongForm.php";
$huodongform = new HuoDongForm();
?>
<script language="JavaScript" type="text/javascript"> 
function active_save() 
{ 
	document.getElementById("savebuttonid").disabled='';
} 
</script>


<table  width=100% cellspacing=0 cellpadding=0 align=center>
<tr>
	<td width=700 valign=top>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
		<TR><TD height=20></TD></TR>
		<TR vAlign=top>
			<TD>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
				<TR>
					<TD class=PAGE_TITLE width=20%>&nbsp;</TD>
					<TD class=PAGE_TITLE width=80% height=25>
						<font color=red>2013华裔青少年夏令营</font>
					</TD>
				</TR>
			    <TR>
			    	<TD colspan=2> 
			    		<TABLE cellSpacing=0 cellPadding=0 width=95% border=0 align=center>
			    		<TR><TD height=10 class=formlabel></TD></TR>
			    		<TR>
			    			<TD height=40  class=formlabel>
			    				<div align=center><em><font color=blue>去中国学中文+丰富多彩的文娱活动，伴青少年度愉快假期。</font></em></div>
			    			</TD>
			    		</TR>
						<TR>
							<TD>
								<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
								<TR>
									<TD width=100%>
										<?php $huodongform->showHuoDongDespTable(1);	?>
									</TD>
								</TR>
								<TR>
									<TD class=PAGE_TITLE >&nbsp;</TD>
								</TR>
								<TR>
									<TD width=100% height=20>
										
									</TD>
								</TR>
								<TR>
									<TD valign=top width=100%>
										<?php $huodongform->showHuoDongTable(1, ""); ?>
									</TD>
								</TR>
								</TABLE>
							</TD>
						</TR>
						</TABLE>
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		<TR><TD height=20> </TD></TR>
		<TR>
			<TD>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
				<TR>
					<TD  width=50%>
					</TD>
					<TD  width=50% >
					</TD>
				</TR>
				</TABLE>
			</TD>
		</TR>
		</TABLE>
	</TD>
	
	<td width=250 valign=top class=ITEMS_BG>
		<?php include "../php/right.php" ?>
	</td>

</TR>		
</table>
<?php 
include "../php/footer.php"; 
?>
