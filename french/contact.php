<?php
include ("rootvar.php");
include ($FDOC_PATH."/php/allinclude.php");
session_start();

$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");


$OUSHI_ADDR = array(
	"Les Amis de Nouvelles d’Europe", 
	array("Adresse ", "48-50 Rue Benoît Malon",
		array("", "94250 Gentilly")
	),
	array("En Voiture", "Périphérique sortie: Porte de Gentilly"
	),
	array("Transport en commun", "",
		array("RER B : ", "Gentilly"),
		array("Bus 125 : ", "Gentilly RER"),
		array("Tramway T3 : ", "STADE CHARLETY"),
		
	),
	array("Téléphone et Email ", "",
		array("Standard : ", 		"+33 （0）1 41 24 41 40", " "),
		array("Ecole Chinoise : ", 		"+33 （0）1 41 24 41 40", "<a href='mailto:ecole@oushinet.com'>ecole@oushinet.com</a>"),
		array("Location des salles : ","+33 （0）1 41 24 41 41", "<a href='mailto:culture@oushinet.com'>culture@oushinet.com</a>"),
		array("Activité: ", 		"+33 （0）1 41 24 41 42", "<a href='mailto:chenxiaojing@oushinet.com'>chenxiaojing@oushinet.com</a>"),
		array("Bibliothèque : ", 		"+33 （0）1 41 24 41 44", "<a href='mailto:chenxiaojing@oushinet.com'>chenxiaojing@oushinet.com</a>"),
		array("Autres : ",			"+33 （0）1 41 24 41 41", "<a href='mailto:culture@oushinet.com'>culture@oushinet.com</a>"),
		array("Fax : ",			"+33 （0）1 41 24 41 49", " "),
		
	),
);


include ($FDOC_PATH."/php/title.php");
?>
<script type="text/javascript"  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9OpdlEHy1-u9hSYsh4MOqAHN-FYl2mvI&sensor=true"></script>    
<script type="text/javascript" src="<?php echo($HOST_URL); ?>/javascript/gmap.js"></script>

<BODY onload="initializemaps()">

<div class="content">
<?php include ($FDOC_PATH."/php/maintitle.php"); ?>
<div class="left">
	<div class="left_box">
		<div class='PROG_TIT1'>
 			<h1><?php echo($OUSHI_ADDR[0]); ?></h1> 
 			<div class=red_line>&nbsp; </div>
		</div><br>
<?php if ($action == "contact") { ?>
      	<div class="box_txt">
			<div class=box_contact>
			<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<?php 
			for ($i= 1; $i < count($OUSHI_ADDR); $i++) {
				$item = $OUSHI_ADDR[$i];
				echo("<tr><td colspan=2 class='contact_lab'><h4>".$item[0]." : </h4></td>"); 
				echo("<td colspan=2 class='contact'>".$item[1]."</td></tr>"); 
				
				for ($j= 2; $j < count($item); $j++) {
					$sitem = $item[$j];
					echo("<tr><td width=5% height=25></td>"); 
					if (count($sitem) == 2) {
						echo("<td class='contact_lab'>".$sitem[0]."</td>"); 
						echo("<td colspan=2 class='contact'>".$sitem[1]."</td>"); 
					}
					else {
						echo("<td class='contact_lab'>".$sitem[0]."</td>"); 
						echo("<td class='contact'>".$sitem[1]."</td>"); 
						echo("<td class='contact'>".$sitem[2]."</td>"); 
					}
					echo("</tr>"); 
				}
			}
			?>
			</TABLE>
			<br><br>
	 		</div>
     	</div>
     	<div class=box_bg>&nbsp; </div>
      	<div class="box_txt" align=center>
			<div id="map_canvas" style="width:640px; height:360px;"></div> 
		</div>
<?php } else { ?>
      	<div class="box_txt" align=center>
			<div id="map_canvas" style="width:640px; height:360px;"></div> 
		</div>
		<div class=box_bg>&nbsp; </div>
     	<div class="box_txt">
			<div class=box_contact>
			<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
			<TR><TD colspan=2 height=20></TD></TR>
			<TR><TD width=50% valign=top>
			<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<?php 
				$item = $OUSHI_ADDR[1];
				echo("<tr><td class='contact_lab'  width=30%><h4>".$item[0]." : </h4></td>"); 
				echo("<td  class='contact' width=70%>".$item[1]."</td></tr>"); 
				
				for ($j= 2; $j < count($item); $j++) {
					$sitem = $item[$j];
					echo("<tr>"); 
						echo("<td class='contact_lab'>".$sitem[0]."</td>"); 
						echo("<td class='contact'>".$sitem[1]."</td>"); 
					echo("</tr>"); 
				}
			?>
			</TABLE>
			</TD>
			<TD valign=top>
<?php  $item = $OUSHI_ADDR[3]; ?>
				<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
				<TR>
					<TD class='contact_lab' width=45%><h4><?php echo($item[0]); ?> : </h4></TD> 
					<TD class='contact'><?php echo($item[1]); ?></TD>
				</TR> 
	<?php 
				for ($j= 2; $j < count($item); $j++) {
					$sitem = $item[$j];
					echo("<tr>"); 
						echo("<td class='contact_lab' height=25>&nbsp;&nbsp;&nbsp;&nbsp;".$sitem[0]."</td>"); 
						echo("<td class='contact'>".$sitem[1]."</td>"); 
					echo("</tr>"); 
				}
	?>
				</TABLE>
				</TD>
			</TR>
			</TABLE>
			<br><br>
	 		</div>
     	</div>
<?php } ?>
     	
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
