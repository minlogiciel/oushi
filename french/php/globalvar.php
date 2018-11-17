<?php


$JY_START_ITEM = 5;
$FASTNEWS_JY	= 0;
$FASTNEWS_JL	= 1;
$FASTNEWS_WY	= 2;
$FASTNEWS_ASSO	= 3;
$FASTNEWS_KZ 	= 4;
$FASTNEWS_TOP 	= 5;

$MITEM = array(
	array("Accueil", 				$HOST_URL."/french/home/"),
	array("Éducation Culturelle",	$HOST_URL."/french/jiaoyu/?action=withhuajiao",  
		array(
			"École Chinoise", 		$HOST_URL."/french/jiaoyu/",		
			"APELCF", 				$HOST_URL."/french/association/"), 
		),
	array("Échanges Culturels",		$HOST_URL."/french/jiaoliu/",
		array(
			"Expositions",  		$HOST_URL."/french/jiaoliu/?action=subitem&resource=exposition", 
			"Conférences et débats",$HOST_URL."/french/jiaoliu/?action=subitem&resource=formation",
			"Spectacles", 			$HOST_URL."/french/jiaoliu/?action=subitem&resource=conference",
			//"Salle Expositions", 	$HOST_URL."/french/jiaoliu/?action=subitem&resource=salleexpo"
		)
	),
	array("Activités culturelles",	$HOST_URL."/french/wenyi/",
		array(	
			"Cultures",  			$HOST_URL."/french/wenyi/?action=subitem&resource=wenhua", 
			"Sports",  				$HOST_URL."/french/wenyi/?action=subitem&resource=sports", 
			"Loisires",  			$HOST_URL."/french/wenyi/?action=subitem&resource=wenyi", 
		),
	), 
	array("Nouveaux locaux",			$HOST_URL."/french/newschool/"), 
	//array("Inscriptions",			$HOST_URL."/register/"), 
);

$NAME_PUB="Publié";
$NAME_BACK="Retour";
$NAME_MORE="Plus";
$NAME_DETAIL="Détails";
$NAME_CONNEXE="ASSOCIEE";
$NAME_RECOM ="RECOMMANDATION";
$NAME_VIDEO="VIDEO ASSOCIEE";
$NAME_PHOTO="PHOTO ASSOCIEE";
$NAME_LASTHD="ACTIVITE";


$NAME_LASTNEWS="Actualité";
$NAME_PLANACC="Plan d'accès";
$NAME_LINK="Accès direct";
$NAME_HUIGU="Souvenirs";


$FIRST_WAR = "Armistice 1918";
$EXAMEN_YCT = "YCT exam";
$EXAMEN_HSK = "HSK exam";
$DLY = "Da Le Yuan";
$TOUSSAINT = "Toussaint";
$NOEL = "Noël";
$NOUVEL_AN = "Nouvel An";
$FETE_PRINTEMPS = "Fête du Printemps";
$BAQUES = "Pâques";
$CONCOURS = "Concours";
$FETE_TRAVAIL = "Fête du Travail";
$FETE_MAI8 = "Victoire 1945";
$ATTENTE = "attente";
$PENTECOTE="Pentecôte";


$NAME_PREV="Précédent";
$NAME_NEXT="Suivant";

function getTopURL($n) {
	global $HOST_URL;
	return ($HOST_URL."/french/home/topphoto.php?action=detail&hindex=".$n);
}

function isFrancais() {
	return 1;
}

?>