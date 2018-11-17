<?php

$JY_KONGZI_TITLE = "École chinoise et Classe Confucius";
$JY_SCHOOL_TITLE = "École chinoise";

$SCHEDULE_TABLE = array(
	array("Calendrier scolaire d'année 2013-2014", "Calendrier scolaire d'année 2013-2014"),
	array("Plan d’emploi d'année 2013-2014", "Plan d’emploi d'année 2013-2014")
);
$SCHEDULE_TIMER = 0; 
$SCHEDULE_HUODONG = 1; 

$JY_TAB = array(

array ( "Cours de chinois",  "chinese", "jiaoyu_450.jpg", "jiaoxue.png", 
	array(
	),

	array("Cours de chinois préscolaire", 
		array("school/children1.jpg", "préscolaire"),  
		array(
"Le cours de chinois préscolaire est destiné aux élèves de 4 à 6 ans dans le but de susciter leur intérêt pour apprendre une langue réputée difficile. À l’aide de jeux, de chansons, de vers classiques, ou de dessins animés, l’enseignant mobilise tous les atouts accessibles aux enfants pour les initier à la langue. Les manuels «My First Chinese Words», «Paradis du Chinois» et «Magical Chinese» ont été adaptés aux enfants français pour être mieux assimilés.",		
		),
		array(
			array("Horaires", "", 
				array("Samedi", "14H00 - 15H00 (6 ans) ", "15H15 - 16H15 (4-5ans)")
			),
			array("Inscription", $HOST_URL."/french/register/?registerref=chinois")
		),
	),	
	array("Cours de chinois pour enfants et adolescents", 
		array("jiaoyu_450.jpg", "enfants et adolescents", "enfants et adolescents"),  
		array(
"Les cours de chinois pour enfants et adolescents à partir de 7 ans occupent une place prépondérante dans les activités culturelles de l’association. Les manuels utilisés sont en principe «HAN YU» et «ZHONG WEN», avec en complément «Apprends le chinois avec moi», «Kuaile hanyu», «Great Wall Chinese», «Soundic» selon le niveau des classes qui va de Pinyin jusqu’au niveau 11. La compétence des professeurs expérimentés, les installations multimédias, la variété des moyens pédagogiques garantissent de bons résultats à la plupart des élèves."		
		),
		array(
			array("Horaires", "", 
				array("Mercredi", "14H—17H15"),
				array("Samedi", "10H30—17H45"),
				array("Dimanche", "10H30—17H45"),
			),
			array("Inscription", $HOST_URL."/french/register/?registerref=chinois")
		),
	),
	array("Cours de chinois pour adultes",
		array("school/adulte.jpg", "adultes", "adultes"),  
		array(
"Pour répondre aux besoins des adultes, nous avons mis en place depuis quelques années des cours pour ceux qui souhaitent acquérir certaines connaissances en langue chinoise. Le manuel principal est «Le chinois contemporain», avec en complément «Great Wall Chines», tous les deux édités par Hanban. Les élèves sont répartis dans deux classes selon leur niveau. Étant donné la faible disponibilité des élèves après les cours, nous sélectionnons les textes et nous consacrons plus de temps aux exercices en classe."
		),
		array(
			array("Horaires", "", 
				array("Samedi", "10H30-12H30", "13H30-15H30"), 
				array("Dimanche", "10H30-12H30"), 
			),
			array("Inscription", $HOST_URL."/french/register/?registerref=adulte")
		),
		array("Cours de conversation", 
			array("school/huiha.jpg", "Cours de conversation", "Cours de conversation"),
			array(
"Le cours de conversation constitue une plateforme d’échanges où se rencontrent des Français et des Chinois pour faire des exercices oraux pendant une heure. Ceux qui apprennent le chinois et ceux qui apprennent le français échangent leurs idées dans la langue voulue sous la direction d’un enseignant qui choisit le thème, soit dans le manuel, soit autour d’une exposition ou d’une conférence du centre culturel.",
						),
			array(
				array("Horaires", "",  
					array("Vendredi", "14H30 - 16H30"),
				),
				array("Inscription", $HOST_URL."/french/register/?registerref=huihua")
			),
		),
	),
),

array ("Tests et Concours", "concour", "school/YCTkaoshi.jpg",  " " /* " exma.png " */,
	array(
"Nouveau Test d’Evaluation de Chinois (HSK ou YCT) est un examen international standardisé attestant de compétences linguistiques en chinois, avec pour priorité l’évaluation de la capacité de communication dans la vie quotidienne et dans les études des candidats ayant une langue maternelle autre que le chinois. YCT est pour écoliers et lycéens. HSK ou YCT se décompose en Oral et en Ecrit, elles sont deux parties indépendantes l’une de l’autre.",
		),

	array("tests chinois",
		array("school/YCT.jpg", "tests chinois"),  
		array(
"Nouveau Test d’Evaluation de Chinois (HSK ou YCT) est un examen international standardisé attestant de compétences linguistiques en chinois, avec pour priorité l’évaluation de la capacité de communication dans la vie quotidienne et dans les études des candidats ayant une langue maternelle autre que le chinois. YCT est pour écoliers et lycéens. HSK ou YCT se décompose en Oral et en Ecrit, elles sont deux parties indépendantes l’une de l’autre.",
"Pour YCT, la partie Ecrite comporte 4 niveaux différents, à savoir : YCT (niveau 1) jusqu’à YCT (niveau 4) ; l’Oral se décompose en YCT (niveau bas), YCT (niveau moyen).",
"Pour HSK, la partie Ecrite comporte 6 niveaux différents, à savoir : HSK (niveau 1) jusqu'à HSK (niveau 6) ; Examen Oral se décompose en HSK (niveau bas), HSK (niveau moyen) et en HSK (haut niveau), avec le contenu de l’examen enregistré en cassette.",
"La Classe Confucius de Nouvelles d’Europe a organisé le premier YCT en région parisienne en novembre 2011. Depuis, chaque année en mars et en novembre, de nombreux élèves d’Ile de France viennent pour passer le test, avec un taux de réussite dépassant 99%. À plusieurs reprises, plus de la moitié des candidats a obtenu 20/20 pour le niveau I et II. En décembre 2014, la Classe Confucius de Nouvelles d’Europe va organiser son premier HSK."
		),
		array(
			array("Inscription", $HOST_URL."/french/register/?registerref=concoursyct")
		),
	),
	array("Concours sur les connaissances de la civilisation chinoise", 
		array("school/wenhuaconcours.jpg", "concours de la culture chinois"),  
		array(
"En 2012, après la réussite des trois expériences précédentes, l’AEOMC (Association des Échanges d’outre-mer de Chine) 
a changé le nom de son 4e Concours international sur les connaissances de la civilisation chinoise en 
«Grand Concours culturel pour les Jeunes et Adolescents des Chinois d’outre-mer». 
La première étape du concours commence dans les pays où vivent les candidats, 
sous forme de questions-réponses autour des trois manuels principaux sur la civilisation chinoise, 
à savoir : «Connaissances générales en culture chinoise», «Connaissances générales en histoire chinoise» et 
«Connaissances générales en géographie chinoise». 
Tous ceux qui ont eu des notes supérieures à 169/260 participent alors à la compétition suivante sur l’éloquence et 
l’art classique chinois. Les cinq premiers de chaque pays seront invités par l’AEOMC aux compétitions finales en Chine.",
				),
		array(
			array("Inscription", $HOST_URL."/french/register/?registerref=concourswenhua")
		),
	),
),


array ("Développez vos talents", "formation", "school/chaiyipeixun.jpg",  "formation.png", 
	array(""),

	array("Cours de calligraphie et de peinture chinoise",
		array("school/shufa.jpg", "calligraphie et peinture"),   
	 	array(
"La calligraphie et la peinture chinoises ont une histoire commune vieille de milliers d'années, et représentent la quintessence profonde de la Chine. Pratiquer l’art de la calligraphie c’est non seulement se cultiver, mais c’est aussi le plaisir d'acquérir de l'élégance et la paix de l’âme. L'enseignement est très personnalisé. ",
	 	"Professeur: MA Jianhong (Président de l'Association le Pinceau d’Or)"
	 	),
		array(
			array("Horaires", "", 
				array("Mercredi", "14H30—15H30","15H45—17H15"),
				array("Dimanche", "10H30—12H30")
			),
			array("Inscription", $HOST_URL."/french/register/?registerref=shuhua")
		),
	 ),
 
	array("Cours de Kungfu pour enfants", 
		array("school/wushu.jpg", "kungfu"),   
		array(
"L'art martial (Wushu en chinois) est un sport traditionnel chinois, qui a été développé en Chine au fil des siècles. Wushu est un patrimoine culturel précieux. La pratique de Wushu sert non seulement à renforcer la forme physique, mais aussi à cultiver et développer des caractères importants, comme la discipline, la preuve de volonté et de courage."
		),
		array(
			array("Horaires", "",  
				array("Mercredi", "14H30—15H30", "15H45—17H15")
			),
			array("Inscription", $HOST_URL."/french/register/?registerref=wushu")
		),
	), 
	array("Cours de piano", 
		array("school/piano.jpg", "Piano"),   
		array(
"Le cours de piano est individuel avec des professeurs diplômés en musique. Le cours est en fonction de chaque profil, met à la disposition des méthodes et outils pour permettre d'atteindre l'objectif de chaque enfant. Par l'apprentissage du piano, les élèves comprennent les éléments de base de la musique, expriment leurs sentiments et améliorent leur qualité culturelle et artistique.  Apprendre à jouer du piano favorise le développement personnel et apporte de nombreux bienfaits."
		),
		array(
			array("Horaires", "", 
				array("Mercredi", "en journée"),
				array("Samedi", "en journée"),
				array("Dimanche", "en journée"),
			),
			array("Inscription", $HOST_URL."/french/register/?registerref=piano")
		),
	),
	array("Cours d’aérobic pour enfants", 
		array("school/chaiyipeixun.jpg", "aérobic pour enfants", "aérobic pour enfants"),   
		array(
"Dans le but de favoriser chez les enfants une bonne constitution physique qui allie tonus, coordination et souplesse, nous avons cherché à nous appuyer sur leur spontanéité pour leur enseigner la danse, qui leur permette de développer sensibilité et émotion artistiques."
			),
		array(
			array("Horaires", "", 
				array("Mercredi", "14H00—15H30", "15H45—17H15")
			),
			array("Inscription", $HOST_URL."/french/register/?registerref=dance")
		),
	),
),

array ("Stage linguistique en été", "summer", "school/summer.jpg",  "summer.png ", 
	array(
	),

	array("Stages lingustiques",
		array("school/summer.jpg", "Stages lingustique"), 
		array(
"L’association organise chaque été des stages linguistiques en Chine, qui permettent aux adolescents de perfectionner leur pratique de la langue et de mieux connaître le pays de leurs ancêtres. Pendant 3 à 4 semaines, les élèves suivent des cours de chinois auprès des professeurs expérimentés, visitent des sites historiques et font de nouvelles connaissances avec des jeunes de leur âge. Nombreux sont ceux qui renouvellent l’inscription l’année suivante. Depuis quelques temps, les conditions de vie dans les écoles d’accueil en Chine ont été améliorées et les activités culturelles diversifiées. Aux stages linguistiques classiques à Pékin et Shanghai, l’association a su ajouter, grâce au soutien de la Fondation Soong Ching Ling (Madame Sun Yat-sen), un séjour d’été qui a été très bien accueilli par les élèves venus de différents pays."
		),
		array(
			array("Inscription", $HOST_URL."/french/register/?registerref=summer")
		),
	),
/*
	array("寻根之旅", 
		array("school/voyageete.jpg", "寻根之旅"), 
		array(
			""
		),
		array(
			array("Inscription", $HOST_URL."/french/register/?registerref=summerxungen")
		),
	),
*/
	array("Voyage d'Echanges Internationalle", 
		array("school/guojijiaoliu.jpg", "Voyage d'Echanges Internationalle"), 
		array(
			""
		),
		array(
			array("Inscription", $HOST_URL."/french/register/?registerref=summerjiaoliu")
		),
	),
),


);


$zhongwenkongzi = array(
"École chinoise et Classe Confucius",
"L’une des pionnières dans l’initiation au mandarin de la jeune génération des ressortissants chinois à Paris, l’Association a débuté ses cours de langue en 1992. Aujourd’hui toute proche de la Cité Universitaire, dans les locaux du Centre culturel du journal «Nouvelles d’Europe» à Gentilly, elle n’est qu’à quelques minutes en voiture de la Porte d’Italie. Elle a su acquérir depuis une bonne réputation grâce aux résultats de ses jeunes élèves.",
"Des enseignants prennent en charge des cours de différents niveaux les mercredis après-midi et le week-end, pour les participants de tout âge, à partir de 4 ans. En dehors des cours de chinois, les cours de piano, de danse folklorique, de kung-fu, de calligraphie et de peinture classique chinoise attirent chaque année de nouveaux adhérents. Les stages linguistiques organisés chaque été depuis 20 ans amènent des jeunes à la découverte du pays d’origine de leurs parents. Soutenue par l’Institut Confucius, l’Association organise chaque année des tests reconnus par Hanban (Bureau de Promotion internationale de la Langue chinoise), et contribue par ailleurs à la formation d’enseignants en multimédia."
);


$JY_OTHER_PHOTOS = array(
	array(	
		array("school/children1.jpg", "school/children1.jpg", "Cours de chinois pour enfants"), 
		array("school/jiaoyu3.jpg", "school/jiaoyu3.jpg", "Cours de chinois"),   
		array("school/jiaoyu5.jpg", "school/jiaoyu4.jpg", "Cours de chinois"),   
		array("school/jiaoyu5.jpg", "school/jiaoyu5.jpg", "Cours de chinois"),   
		array("school/jiaoyu5.jpg", "school/jiaoyu6.jpg", "Cours de chinois"),   
		array("school/adulte.jpg", "school/adulte.jpg", "Cours de chinois pour adultes"),  
		array("school/huiha.jpg", "school/huiha.jpg", "Conversation"), 
	),
	array(),
	array(),
	array(
		array("school/shufa.jpg", "school/shufa.jpg", "Calligraphie et Peitutre Chinoise"),   
		array("school/wushu.jpg","school/wushu.jpg", "Cours de Kung Fu pour enfants"),
		array("school/piano.jpg", "school/piano.jpg", "Cours de piano"), 
		array("school/chaiyipeixun.jpg", "school/chaiyipeixun.jpg", "Cours de dance pour les enfants"),
	),
);


?>
