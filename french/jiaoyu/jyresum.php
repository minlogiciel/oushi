
<?php 
$JYRESUM = array(
 	"Parmi les pionnières dans l’initiation au mandarin destinée à la jeune génération des ressortissants chinois à Paris, l’Association a su acquérir depuis une bonne réputation grâce aux résultats des élèves. Qualifiée par Qiaoban (Bureau des Affaires de Chinois d’outre-mer du Conseil d’État chinois), d’école modèle pour l’enseignement du chinois en dehors de la Chine, elle a été la première Classe Confucius créée en France, reconnue par Hanban (Bureau de Promotion internationale de la Langue chinoise). ",
 	"Fondée en 2005, l’Association pour la Promotion de l’Éducation de la Langue chinoise en France (APELCF) a pour vocation de rassembler les associations de la communauté en vue d’organiser des manifestations culturelles : la transmission des traditions et la promotion de la culture chinoises. Elle se propose également de favoriser les échanges d’informations pédagogiques entre enseignants, tant sur leur formation que sur le choix des manuels de chinois . Notre Association prend en charge le secrétariat de l’APELCF."
);

?>
<div class="right_box right_box3">
	<div class=item_tit>Éducation culturelle</div>
	<div class=item_txt>
	<?php 
	for ($i = 0; $i < count($JYRESUM); $i++) {
		echo("<p class=OUSHI_INFO>".$JYRESUM[$i]."</p>");
	}
	?>
	<p class=OUSHI_INFO>&nbsp; </p>
	</div>
</div>
