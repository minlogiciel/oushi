<?php if ($loginok) { ?>
<div class=head_logo_space>
	<div align=right><br>
<?php 
	if ($adminlevel == $ADMIN_USER) { 
		echo("<A class=top_bar href='../admin/?mtype=".$ADMIN_USER_TYPE."'>".$ADDINFOITEMS[$ADMIN_USER_TYPE][0]."&nbsp;|&nbsp;</A>");
	} 
	else {
		$namemodif = "修改";
		if ($username) {
			$namemodif .= " (".$username.")";
		}
		echo("<A class=top_bar href='../admin/?mtype=-1&action=modifuserinfo'>".$namemodif."&nbsp;|&nbsp;</A>");
	}
?>
		<A class=top_bar href='../admin/?userid=<?php echo($userid); ?>&action=logout'>退出&nbsp;&nbsp;&nbsp;&nbsp;</A>
	</div>

</div>
<?php } else { ?>
	<A href='../home/'><div class=head_logo_space>&nbsp;</div></A> 
<?php } ?>
<div class=head_admin>
<?php 
	for ($i = 0; $i < count($ADDINFOITEMS)-1; $i++) {
		if ($ADDINFOITEMS[$i][2] == $adminlevel || ($adminlevel == $ADMIN_USER)) {
			echo("<A  href='../admin/admin.php?mtype=".$i."'>".$ADDINFOITEMS[$i][0]."</A>&nbsp;|&nbsp;");
		}
	} 
?>
</div>


