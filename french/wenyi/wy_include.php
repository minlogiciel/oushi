<?php
include_once($DOC_PATH."/wenyi/wy_item_include.inc");


$WY_TEXT = array(
"Activités culturelles", 
"Le Centre culturel de «Nouvelles d’Europe» essaie de rendre plus de services aux ressortissants chinois qui ne maîtrisent pas le français. Pour répondre à leurs besoins, nous organisons des cours culturels et sportifs diversifiés avec des professeurs ou moniteurs chinois. Les cours d’initiation permettent à tous de se familiariser avec l’informatique. Les cours de français les aident à s’intégrer dans la vie française."
);

$WY_TAB = array(
array ( "Cultures",  "wenhua", "expo/expo3.jpg", "wenhua.png",
	array(
		"intro"
	),
	$WY_BIBLIO, $WY_LANGUE, $WY_SHUHUA, $WY_COMPUTE,
/*	
	array("Bibliothèque", 
		array("school/biblio-600.jpg", "Bibliothèque",  "Bibliothèque"),  
		array(
"La bibliothèque du centre culturel de «Nouvelles d’Europe» a été fondée en 1996. Vous pourrez y trouver environ 10 000 livres en chinois : des romans chinois et étrangers, des essais, des recueils, des biographies, et puis des ouvrages sur l'histoire, la philosophie, les sciences sociales, l’administration, les voyages, les loisirs ou la santé, afin de satisfaire les goûts du plus large public.",
"De plus, tous les deux ou trois mois, de nouvelles séries de la télévision et des films nationaux en DVD viendront compléter la collection de vidéodisques qui en comporte déjà plus de 2 000, dont un grand nombre de documentaires et d’importantes conférences."
		),
		array(
			array("Horaires", " ", 
				array("Samedi, Dimance", "12H00—12H30", "15H00—16H00"),
			),
		),
	),	
	array("Cours de Langues", 
		array("school/coursfrancais-600.jpg", "Cours de langue", "Le cours de langue française "),  
		array(
		"<h3>Cours de français pour adultes</h3>",
		"Le cours de langue française s’adresse à tous les niveaux. L’objectif est de pouvoir commencer à communiquer en français 
		pour les débutants, puis d’acquérir une autonomie permettant de faire face à la plupart des situations de la vie courante. 
		Puis les cours peuvent permettre de perfectionner la pratique et la compréhension du français. 
		Ces cours sont basés sur les méthodes de communication, et supposent la participation active des élèves.",
		"Le professeur de français, qui a reçu une formation à l’Alliance française de Paris, 
		a longtemps été instituteur dans le 13è arrondissement de Paris, et il a déjà enseigné aux adultes dans diverses associations.",
		"Après l’inscription, le professeur fait passer un test individuel pour trouver le cours correspondant au niveau de chacun."
		),
		array(
			array("Horaires", "",  
					array("Dimance", "10H00—12H00 （Avancé）"),
			),
			array("Inscription", $HOST_URL."/french/register/?registerref=francais")
		),
		array("",
			array("school/adulte.jpg", "Cours de chinois pour adultes", "Cours de chinois pour adultes",),  
			array("<h3>Cours de chinois pour adultes</h3>",
"Pour répondre aux besoins des adultes, on a mis en place depuis quelques années des cours pour ceux 
qui souhaitent acquérir certaines connaissances sur la langue chinoise. 
Le manuel principal est 《Le chinois contemporain》,avec en complément 《Great Wall Chinese》, 
tous les deux édités par Hanban. Les élèves sont répartis dans deux classes selon leur niveau. 
Étant donné la faible disponibilité des élèves après les cours, 
on sélectionne les textes et on consacre plus de temps aux exercices en classe."
			),
			array(
				array("Horaires", "", 
					array("Samedi", "10H30-12H30", "13H30-15H30"), 
					array("Dimanche", "10H30-12H30"), 
				),
				array("Inscription", $HOST_URL."/french/register/?registerref=adulte")
			),
		),
		array("", 
			array("school/huiha.jpg", "Cours de conversation", "Cours de conversation"),
			array("<h3>Cours de conversation</h3>",
"Le cours de conversation constitue une plateforme d’échanges où se rencontrent des Français et des Chinois 
pour faire des exercices oraux pendant une heure. Ceux qui apprennent le chinois et ceux 
qui apprennent le français échangent leurs idées dans la langue voulue sous la direction d’un enseignant qui choisit le thème, 
soit dans le manuel, soit autour d’une exposition ou d’une conférence du centre culturel."
			),
			array(
				array("Horaires", "", 
					array("Vendredi", "14H30 - 16H30"),
				),
				array("Inscription", $HOST_URL."/french/register/?registerref=chinois")
			),
		),
		
		
	),
	array("Cours de calligraphie et de peinture chinoise", 
		array("school/shufa-600.jpg", "Calligraphie et peinture","Calligraphie et peinture"),  

		array("<h3>Calligraphie et Peinture chinoise</h3>",
"La calligraphie et la peinture chinoises ont une histoire commune vieille de milliers d'années, et représentent la quintessence profonde de la Chine. Pratiquer l’art de la calligraphie c’est non seulement se cultiver, mais c’est aussi le plaisir d'acquérir de l'élégance et la paix de l’âme. L'enseignement est très personnalisé. ",
"Professeur: WANG Xiaojun (Diplômé de l’Ecole des Beaux-Arts de Chine)"
	 	),
		array(
			array("Horaires", "", 
				array("Mercredi", "14H00—15H30","15H45—17H15")
			),
			array("Inscription", $HOST_URL."/french/register/?registerref=shuhua")
		),
		array("", 
			array("school/clubphoto.jpg", "Club photographie", "Club photographie"),  
			array("<h3>Club de photographie</h3>",
"Un appareil photo pour capturer instantanément la beauté et la garder éternellement ! Il y a de nombreux Chinois amateurs de photographie en France, dont beaucoup sont des artistes reconnus qui ont créé ce club ensemble. Le club organise occasionnellement des sorties en plein air dans le but d'échanger les expériences de chacun. Des expositions sont également organisées pour partager les œuvres de ses membres."
			),
	 	),
	),	
	array("Informatique", 
		array("school/infodebutant.jpg", "Informatique",  "Formation d'informatidue débutant"),  
		array(
		"<h3>Formation d'informatidue dédutant</h3>",
"Les ordinateurs ont désormais un rôle essentiel dans nos vies ou à notre travail, et cela concerne également les personnes âgées. ",
"Une classe de premier niveau est proposée pour en apprendre l'utilisation aux débutants. Un ordinateur est mis à la disposition de chaque élève. L'enseignant vous emmènera pas à pas dans le monde de l'informatique. Les cours portent sur les applications pratiques, dont l'Internet, l'écriture et l’envoi des e-mails, l'installation et le téléchargement des logiciels et des outils anti-virus, la transmission des données numériques d'un appareil photo, etc. Apprendre à entrer des caractères chinois par Pinyin vous sera également proposé."
		),
		array(
			array("Horaires", "", 
				array("Dimanche", "10H30—11H30(Pingyin)","11H30—13H00")
			),
			array("Inscription", $HOST_URL."/french/register/?registerref=diannaochuji")
		),
		array("", 
			array("school/infoavance.jpg", "Formation d'informatidue avancé", "Formation d'informatidue avancé"),  
			array("<h3>Formation d'informatidue (niveau 2)</h3>",
"Durant 10 semaines, ceux qui ont une certaine base d'informatique pourront bénéficier d’un cours flexible selon les besoins de chacun : requêtes Google Maps, Facebook, QQ, création de blogs n’auront plus de secrets pour vous, de même que d’autres applications ou logiciels bureautiques, ainsi que des fonctions avancées de messagerie, de téléchargements de musique ou de films. Chaque élève aura un ordinateur à sa disposition.",
	 		),
			array(
				array("Horaires", "",  
					array("Dimanche", "14H30—16H30")
				),
				array("Inscription", $HOST_URL."/french/register/?registerref=diannaogaoji")
			),
	 	),
		array("", 
			array("school/e-commerce600-480.JPG", "Formation E-commerce", "Formation E-commerce"),  
			array("<h3>Formation d'E-commerce</h3>",
"Près de 17 millions de Français, et plus de 80 millions de Chinois font leurs achats sur internet. En 6 semaines, le professeur  aidera les hommes d'affaires chinois en France, qui ont une certaine base en informatique, à organiser leurs ventes en ligne. Un ordinateur est affecté à chaque élève."
	 		),
			array(
				array("Horaires", "", 
					array("Samedi", "15H30—17H30")
				),
				array("Inscription", $HOST_URL."/french/register/?registerref=wangluoxiaoshou")
			),
	 	),
	),*/
),

array ( "Sport",  "sports", "wushu.jpg", "sports.png",
	array(
		"intro"
	),
	 $WY_YOGA,$WY_TUBU,$WY_MULAN,$WY_QIGONG,
/*	array("Fitness et danses chinoises", 
		array("school/xingti-600.jpg", "Fitness et danses chinoises", "Fitness et danses chinoises"),  
		array(
"Les femmes modernes font attention à leur corps et à leur élégance. Le fitness et la danse chinoise les aideront à améliorer leur ligne.",
		"Professeur： Mlle LU Dong"
		),
		array(
			array("Horaires", "",  
				array("Mercredi", "14H45-16H45"),
				array("Dimance", "10H30-12H30"),
			),
			array("Inscription", $HOST_URL."/french/register/?registerref=xingti")
		),
	),	
	array("Yoga", 
		array("school/yoga.jpg", "Yoga", "Yoga"),  
		array(
"Le yoga est à la fois une science et un sport efficace et sans danger, si l’on prend soin de suivre un échauffement avant de le pratiquer. Le professeur, certifié et qualifié, guidera les élèves dans la maîtrise des exercices.",
"Professeur: Mme Rebeyrolle (Certificat du YOGA Intermédiaire Instructeur de Hong Kong)"
		),
		array(
			array("Horaires", "", 
				array("Samedi", "10h30 – 12h00", "13h30 – 15h00"),
			),
			array("Inscription", $HOST_URL."/french/register/?registerref=yujia")
		),
	),
	array("Club de Randonnée", 
		array("wh_01.260-0.jpg", "Club de Randonnée",  "Club de Randonnée"),  
		array(
"L’OMS (Organisation Mondiale de la Santé) préconise la marche comme activité sportive.",
"Le club de randonnée organise chaque mois, soit une découverte de la nature, soit une promenade culturelle. On peut ainsi profiter à la fois des bienfaits des forêts ou des lacs, tout en découvrant l’histoire, et les histoires des lieux visités.",
		),
	),	
	array("Mulan",
		array("mulan.jpg","Mulan", "Mulan"),  
		array(
"Mulan Quan est une forme de gymnastique douce, mélange de Tai Chi et d’arts martiaux. Tout au long de l'année, on peut pratiquer les trois enchaînements réglementaires du Mulan Quan : l'enchaînement à mains nues, avec l'éventail ou avec l'épée.",
"Les élèves du Mulan ont gagné plusieurs premiers prix dans des compétitions internationales.",
"Professeur： Mme WANG Xian Qin"
		),
		array(
			array("Horaires", "", 
				array("Vendredi", "14H30—16H00"),
			),
			array("Inscription", $HOST_URL."/french/register/?registerref=mulan")
		),
	),
	array("Qigong", 
		array("wenyunews/journeeqigong3.jpg", "Qigong", "Qigong"),  
		array(
"Le Qi Gong est une discipline où s'harmonise le corps, la respiration et l'esprit pour une meilleure gestion de votre vitalité quotidienne.", 
"Dans ce cours, tout au long de l'année vous pratiquerez principalement un enchaînement traditionnel : « Les huit pièces de brocard » (Ba Duan Jin) tel que le transmettent les experts de «l'Association chinoise du Qi Gong pour la santé». ",
"Le &quot;Ba Duan Jin&quot; est un des plus anciens et des plus traditionnels enchaînements de Qi Gong. Il est pratiqué en Chine depuis des siècles.",
				),
		array(
			array("Horaires ", " ", 
				array("Jeudi", "18:30 – 19:30", "19:30 – 20:30"),
			),
			array("Inscription", $HOST_URL."/french/register/?registerref=qigong")
		),
	),
		*/
),

array ( "Loisirs",  "wenyi", "wenyi_450.jpg", "wenyi.png",
	array(
		"intro"
	),
	$WY_WUDAO, $WY_SINGING,
/*	array("Danses", 
		array("school/dance-600.jpg", "Danse de salon et Country", "Danse de salon et Country"),  
		array(
		"<h3>Danse de salon et Country</h3>",
"Le cours combine non seulement la danse de bal, les danses latines, mais aussi les nouvelles danses. Un cours spécial pour les débutants vous apprendra les bases en country. Tous les cours sont expliqués lentement afin que les élèves puissent progresser.",
"Professeurs : M. Lim Kim et Mme Lim"
		),
		array(
			array("Horaires", "", 
				array("Samedi", "14H00—15H00（Debutant） ", "15H00—19H00")
			),
			array("Inscription", $HOST_URL."/french/register/?registerref=shalongwu")
		),
		array("", 
			array("school/dance1.jpg", "Danse en ligne et Danse sociale", "Danse en ligne et Danse sociale"),  
			array(
			"<h3>Danse en ligne et sociale</h3>",
"Cette danse américaine permet d’évoluer avec des pas de danse de salon, sous forme de danse en ligne. Cette danse collective et sociale est non seulement bonne pour mise en forme, mais crée aussi une ambiance très chaleureuse.  ",
"Professeurs : Mme WU Xue Xuehui et M. Wu Ganwen"
			),
			array(
				array("Horaires", "", 
					array("Jeudi", "14H30—16H00", "16H00-17H30"),
				),
				array("Inscription", $HOST_URL."/french/register/?registerref=jianshenwu")
			),
		),	
	),	
	array("Chant", 
		array("school/music-600.jpg", "Chant", "Chant"),  
		array("<h3>Chorale</h3>",
"Beaucoup d'entre eux sont venus de l’Asie du Sud-Est, et ils sont en France depuis de nombreuses années. Grâce à leur passion de la musique et leur sentiment profond pour le pays natal, ils se réunissent chaque dimanche. Ils participent à de nombreux spectacles et sont devenus des représentants de la communauté chinoise à Paris.  ",
"Professeur : ZHAO Bai "
		),
		array(
			array("Horaires", "", 
				array("Dimanche", "14H00—18H00"),
			),
			array("Inscription", $HOST_URL."/french/register/?registerref=hechangtuan")
		),
	),
	*/
),

);

$LAST_BIBLIO_LIST = array(
array("《巨流河》 ", "biblio/ju.jpg", 
	array(
		"书名:巨流河",  
		"作者: 齐邦媛",   
		"天下远见出版股份有限公司2009年7月出版",
		"巨流河，位于中国东北地区，是七大江河之一，被辽宁百姓称为「母亲河」。影响中国命运的「巨流河之役」，发生在民国十四年，当地淳朴百姓们仍沿用着清代巨流河之名，本书的记述，从长城外的「巨流河」开始，到台湾南端恒春的「哑口海」结束……它是一部反映中国近代苦难的家族记忆史。作者呕心沥血四年才完成。"
	),
),

array("《61小时》 ", "biblio/61.jpg",
	array(
		"书名：61小时",
		"作者：李查德  翻译：黄鸿砚",
		"皇冠文化出版有限公司2013年9月出版",
		"人生是一场赌局，但李奇的牌却总是被动过手脚！",
		"惊悚大师杰佛瑞．迪佛：杰克‧李奇实在是一个令人难忘的硬汉英雄！",
		"「孤独」是他的代名词，「恐惧」从来就与他绝缘，然而这一次，他将经历人生中最黑暗的倒数计时……"
	),
),
array("《医闹》", "biblio/yilao.jpg",
	array(
		"书名：《医闹》",
		"作者： 晋橹",   
		"重庆出版集团重庆出版社2010年6月出版",
		"中国首部披露医患关系的长篇小说。其作者晋橹就是中山坦洲某医院的主治医师。",
		"医闹凶猛：患者是助长“医闹”气焰的罪魁祸首吗？还是医生医德的沦丧才是滋长“医闹”之患的最终源泉？患者视医生如蛇蝎，医生视患者如寇仇，是因为病人投诉无门，还是患者在无理取闹？患者确实是“弱势群体”，还是医生有理说不清？",
	),
),
array("《辣妈正传》 ","biblio/lama.jpg",
	array(
		"电视剧：《辣妈正传》",
		"导演: 沈严",     
		"主演: 孙俪 / 张译 / 明道 / 邬君梅 / 张晨光/ 奚美娟 ",
		"现代都市剧，讲述了从随性自由的生活态度转变成敢于承担家庭责任的年轻母亲，将过去崇尚享乐的麻辣性格转变为时尚理性的现代派辣妈的经历。",
	),
),
array("《大秦帝国之纵横》 ", "biblio/diguo.jpg",
	array(
		"电视剧：《大秦帝国之纵横》",
		"导演：丁黑",    
		"主演：宁静 / 王学兵 / 富大龙 / 傅淼 / 喻恩泰 / 杨志刚 /李立群",
		"该剧以商地民众安葬商鞅与秦国镇压旧贵族叛乱为切入点，展开描写稳定强大的秦国东进中原，山东六国合纵抗秦、秦国连横分化六国的曲折故事。"
	),
),
);


?>