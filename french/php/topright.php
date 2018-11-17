<?php 

$HORAIRES = array(
	array("LUNDI ：", 		"Fermé", 		"Fermé"),
  	array("MARDI ：", 		"10h - 12h30", 	"13h30 - 17h"), 
  	array("MERCREDI ：", 	"10h - 12h30", 	"13h30 - 17h"),
  	array("JEUDI ： ",		"Fermé", 		"13h30 - 17h"),
  	array("VENDREDI ：", 	"10h - 12h30",	"13h30 - 17h"),
  	array("SAMEDI/DIMANCHE ：","10h00 - 18h")
);

$ASSO_OUSHI = array(
	"L’Association des Amis de Nouvelles d’Europe, régie par la loi de 1901, 
	est située à Gentilly dans la proche banlieue parisienne. Centre culturel du journal «Nouvelles d’Europe», 
	premier quotidien en langue chinoise diffusé en Europe, elle a pour mission les échanges culturels franco-chinois et 
	la transmission de la civilisation chinoise aux enfants de la seconde génération, née en France. 
	Elle essaye également de faciliter aux Chinois résidant en France l’accès à des activités culturelles organisées 
	tout le long de l’année."
);

?>

<div class="right_box right_box_top">

	<?php 
	for ($i = 0; $i < count($ASSO_OUSHI); $i++) {
		echo("<p>".$ASSO_OUSHI[$i]."</p>");
	}
	?>

	<div class=gred_line>&nbsp;</div>
	
<?php 
	$mm = date('n');
if ($mm != 7 && $mm != 8) { ?>	
	
	<h5>Horaires d'ouverture :</h5>
	<div class=hor>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0>
<?php 
	for ($i = 0; $i < count($HORAIRES); $i++) { 
		$item = $HORAIRES[$i]; 
?>
			<TR>
			<?php if (count($item) == 2) {?>
				<TD class='horaire_lab' colspan=2>
					<div align=left><?php echo($item[0]); ?></div>
				</TD>
				<TD class="horaire">
					<div align=left><?php echo($item[1]); ?></div>
				</TD>
			<?php } else { ?>
				<TD class="horaire_lab">
					<?php echo($item[0]); ?>
				</TD>
				<TD class='horaire'>
					<div align=left><?php echo($item[1]); ?></div>
				</TD>
				<TD class='horaire'>
					<div align=left><?php echo($item[2]); ?></div>
				</TD>
			<?php } ?>
			</TR>
<?php } ?>
		</TABLE>
	</div>

<?php } else { ?>
	<h5>Horaires d'été (juillet)</h5>
	<div class=text7>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class='horaire_lab' width=35%>
				Centre : 
			</TD>
			<TD class='horaire' colspan=2>
				du lundi au vendredi
			</TD>
		</TR>
		<TR>
			<TD class='horaire_lab'></TD>
			<TD class='horaire'>
						10:30 - 12:30 
			</TD>
			<TD class='horaire'>
						14:00 - 17:30 
			</TD>
		</TR>
		<TR>
			<TD class='horaire_lab' colspan=3 height=5>
				
			</TD>
		</TR>
		<TR>
			<TD class='horaire_lab' >
				Bibliothèque : 
			</TD>
			<TD class='horaire' colspan=2>
				vendredi
			</TD>
		</TR>
		<TR>
			<TD class='horaire_lab'></TD>
			<TD class='horaire' >
				14:30 - 17:30 		 
			</TD>
			<TD class='horaire' >
						
			</TD>
		</TR>
		</TABLE>
	</div>
	<h5> Tout le mois d'août centre est fermé</h5>
<?php } ?>

	<div class=gred_line>&nbsp;</div>
	<div class=hor>
		<TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align=center>
		<TR>
			<TD class='horaire_lab' width=35%> Téléphone ： </TD> 
			<TD class='horaire' width=70%> +33 (0)1 41 24 41 40</TD>
		</TR>
		<TR>
			<TD class='horaire_lab'> Adresse ： </TD> 
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
