<?php
include_once ("french_news_include.inc");

$JYRESUM = array(
 	"Parmi les pionnières dans l’initiation au mandarin destinée à la jeune génération des ressortissants chinois à Paris, 
 	l’association a su acquérir depuis une bonne réputation grâce aux résultats des élèves. 
 	Elle est qualifiée parmi les premières Ecoles modèles de chinois en dehors de la Chine par Qiaoban 
 	(Bureau des Affaires de Chinois d’outre-mer du Conseil d’État chinois) et elle est également la première Classe Confucius en France, 
 	classement par Hanban (Bureau de Promotion internationale de la Langue chinoise). ",
 	"Fondée en 2005, l’Association pour la Promotion de l’Éducation de la Langue chinoise en France (APELCF) 
 	a pour vocation de rassembler les associations de la communauté en vue d’organiser des manifestations culturelles: 
 	la transmission des traditions et la promotion de la culture chinoises. 
 	Elle se propose également de favoriser les échanges d’informations pédagogiques entre enseignants, 
 	tant sur leur formation que sur le choix des manuels de chinois. 
 	Notre association prend en charge le secrétariat de l’APELCF."
);

$JLRESUM = array(
"Le centre culturel de « Nouvelles d’Europe » a su profiter des ressources humaines et médiatiques du journal pour développer les échanges culturels entre la France et la Chine. Sur ce plateau d’échanges, les expositions sur des thèmes différents permettent aux ressortissants chinois de mieux connaître l’actualité de leur pays d’origine. Des conférences diverses sur l’histoire, la société, la législation, la mode et les arts, ont facilité l’intégration des Chinois dans la société française.",  
"Une salle d’exposition nouvellement rénovée, originale et lumineuse, offre aux artistes une plate-forme en duplex pour mieux exposer leur talent.",
);

$WYRESUM = array(
"Le centre culturel de « Nouvelles d’Europe » essaie de rendre plus de services aux ressortissants chinois qui ne maîtrisent pas le français. Pour répondre à leur besoin, on organise des cours culturels et sportifs diversifiés avec des professeurs ou moniteurs chinois. Les cours d’initiation permettent à tous de se familiariser avec l’informatique. Les cours de français les aident à s’intégrer dans la vie française."
);



$FHOME_KZXX = array("École chinoise et Classe Confucius",	$HOST_URL."/french/jiaoyu/",   "jiaoyu_450.jpg", 
	$FHOME_KZXX_NEWS
);

$FHOME_JY = array("Éducation culturelle",	$HOST_URL."/french/jiaoyu/",   "jiaoyu_450.jpg", 
	$FHOME_JY_NEWS, 	$JYRESUM
);
$FHOME_JL = array("Échanges culturels", 	$HOST_URL."/french/jiaoliu/",  "huigu_450.jpg",
 	$FHOME_JL_NEWS, 	$JLRESUM
);
$FHOME_YL = array("Activités culturelles", 	$HOST_URL."/french/wenyi/",  "mulan.jpg", 
	$FHOME_YL_NEWS,	$WYRESUM
);

$FHOME_HUAWEN = array("APELCF", $HOST_URL."/french/association/",   "huajiao/2013singing3.jpg", 
	$FHOME_HUAWEN_NEWS
);

$FHOME_RIGHT_ITEM = array($FHOME_JY, $FHOME_JL, $FHOME_YL);




$FJY_ASSO = array("APELCF", $HOST_URL."/french/association/",  "", 
	array("huajiao/hwassociation.jpg", ""),
	array(
	"Fondée en 2005, l’Association pour la Promotion de l’Education de la Langue chinoise en France (APELCF) a pour vocation de rassembler les Associations de la communauté en vue d’organiser des manifestations culturelles. Elle se propose également de favoriser les échanges d’informations pédagogiques entre enseignants, tant sur leur formation, que sur le choix des manuels. En outre, notre Association prend en charge le secrétariat de l’APELCF qui regroupe une quarantaine d’associations-membres. La manifestation culturelle inter-écoles organisée tous les deux an renforce les relations entre les établissements et attire de plus en plus d’élèves."
	),
);


$FHUIGU = array("Mémoires / Souvenirs", 	"huigu", "oushi/huigu.jpg", "expo.png",
	array(
			"intro"
	),
	
	array("2013 Festival du Printemps de l’Institut Confucius via internet.",
		array("oushi/huigu.jpg", "2013 Festival du Printemps de l’Institut Confucius", "2013 Festival du Printemps de l’Institut Confucius"),
		array(
		"Venant de 56 pays et 112 écoles de 500 programmes, parmi eux, \"Dance de Papillon\" et \"Petit Dragon\" de notre classe 
		ont gagné le Premier Prix. Nous avons également obtenu le Prix d'Organisation."
		)
	)
);


?>
