<?php
include "../php/allinclude.php";

$action = isset($_GET["action"]) ? $_GET["action"] : (isset($_POST["action"]) ? $_POST["action"] : "");


$OUSHI_ADDR = array(
	"欧洲时报文化中心 ", 
	array("地址 ", "48-50 Rue Benoît Malon",
		array("", "94250 Gentilly")
	),
	array("驾车 ", "环城线 Porte de Gentilly 出口"
	),
	array("公共交通 ", "",
		array("地铁快线 RER B : ", "Gentilly"),
		array("公共汽车 125 : ", "Gentilly RER"),
		array("有轨电车 T3 : ", "STADE CHARLETY"),
		
	),
	array("电话及邮箱 ", "",
		array("总机 : ", 		"+33 （0）1 41 24 41 40", " "),
		array("中文学校 : ", 		"+33 （0）1 41 24 41 40", "<a href='mailto:ecole@oushinet.com'>ecole@oushinet.com</a>"),
		array("展览、场地出租 : ","+33 （0）1 41 24 41 41", "<a href='mailto:culture@oushinet.com'>culture@oushinet.com</a>"),
		array("群众活动 : ", 		"+33 （0）1 41 24 41 42", "<a href='mailto:chenxiaojing@oushinet.com'>chenxiaojing@oushinet.com</a>"),
		array("图书馆 : ", 		"+33 （0）1 41 24 41 44", "<a href='mailto:chenxiaojing@oushinet.com'>chenxiaojing@oushinet.com</a>"),
		array("其它 : ",			"+33 （0）1 41 24 41 41", "<a href='mailto:culture@oushinet.com'>culture@oushinet.com</a>"),
		array("传真 : ",			"+33 （0）1 41 24 41 49", " "),
		
	),
);


include ("../php/title.php");
?>
<script type="text/javascript"  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9OpdlEHy1-u9hSYsh4MOqAHN-FYl2mvI&sensor=true"></script>    
<script type="text/javascript" src="../javascript/gmap.js"></script>

<BODY onload="initializemaps()">

<div class="content">
<?php include "../php/maintitle.php"; ?>
<div class="left">
	<div class="left_box">
		<div class='PROG_TIT1'>
 			<h1><?php echo($OUSHI_ADDR[0]); ?></h1> 
 			<div class=red_line>&nbsp; </div>
		</div>
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
       	<div class="box_txt">
			<div id="map_canvas" style="width:640px; height:360px;"></div> 
		</div>
     	<div class=box_bg>&nbsp; </div>
     	<div class="box_txt">
			<div class=box_contact>
			<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
			<TR><TD width=50% valign=top>
			<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
<?php 
				$item = $OUSHI_ADDR[1];
				echo("<tr><td class='contact_lab'  width=20%><h4>".$item[0]." : </h4></td>"); 
				echo("<td  class='contact'>".$item[1]."</td></tr>"); 
				
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
			<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
			
<?php 
				$item = $OUSHI_ADDR[3];
				echo("<tr><td class='contact_lab' width=45%><h4>".$item[0]." : </h4></td>"); 
				echo("<td class='contact'>".$item[1]."</td></tr>"); 
				
				for ($j= 2; $j < count($item); $j++) {
					$sitem = $item[$j];
					echo("<tr>"); 
						echo("<td class='contact_lab' height=25>&nbsp;&nbsp;&nbsp;&nbsp;".$sitem[0]."</td>"); 
						echo("<td class='contact'>".$sitem[1]."</td>"); 
					echo("</tr>"); 
				}
			?>
			</TABLE>
			</TD></TR>
			</TABLE>
			<br><br>
	 		</div>
     	</div>
<?php } ?>
	</div>
	<div class=box_bg>&nbsp; </div>
   	
</div>
<div class="right">
	<?php include "../contact/contactright.php" ?>    
</div>
</div>
<?php include "../php/foot1.php"; ?>

</body>
</html>
