<?php
include_once ("../public/student/student_include.php");
include_once ("jy_item_include.inc");

$JY_KONGZI_TITLE = "中文学校 / 孔子课堂 ";
$JY_SCHOOL_TITLE = "欧洲时报中文学校";

$SCHEDULE_TABLE = array(
	array("欧洲时报中文学校上课日期", "学年上课日期"),
	array("欧洲时报中文学校课程安排", "学年课程安排")
);
$SCHEDULE_TIMER = 0; 
$SCHEDULE_HUODONG = 1;
$ZHONGXIN_HUODONG = 2;

$JY_TAB = array(

array ( "汉语教学",  "chinese", "jiaoyu_450.jpg", "jiaoxue.png",
	array(
"欧洲时报文化中心始终重视文化教育，早在1992年就开设中文课程，是巴黎资格最老的中文学校之一。 学校以教师认真负责、教学质量高著称，即是国侨办授予的首批海外华文教育示范学校，也是国家汉办在法国开设的第一个孔子课堂。",
"2005年，由欧洲时报牵头成立的法国华文教育协会，广泛联系了法国，尤其是大巴黎区的中文学校，为传承中国传统、弘扬中国文化，推进华文教育全力合作。"
	),
	$JY_CHILDREN, $JY_YOUTH, $JY_ADULTE,
/*
	array("幼儿", 
		array("school/children1.jpg", "幼儿中文课", "幼儿中文课","JY_CHILDREN"),  
		array(
"幼儿汉语班以培养学龄前儿童对中文学习的兴趣为目的，分为唱游班和识字班。除了使用《快乐华语》、《汉语乐园》和《中文真有趣》等主要教材外，还针对幼儿的学习特点，采用儿歌、动画、游戏等多种手段，寓教于乐，让孩子们在玩乐中体会中文的奥妙。"
		),
		array(
			array("上课时间 ", " ", 
				array("星期六", "14H00 - 15H00", "15H15 - 16H15")
			),
			array("报名表", "../register/?registerref=children")
		),
		array("Cours de chinois préscolaire", 
			array("school/children1.jpg", "préscolaire", "préscolaire"),  
			array(
	"Le cours de chinois préscolaire est destiné aux élèves de 4 à 6 ans dans le but de susciter leur intérêt pour apprendre une langue réputée difficile. À l’aide de jeux, de chansons, de vers classiques, ou de dessins animés, l’enseignant mobilise tous les atouts accessibles aux enfants pour les initier à la langue. Les manuels «My First Chinese Words», «Paradis du Chinois» et «Magical Chinese» ont été adaptés aux enfants français pour être mieux assimilés.",		
			),
			array(
				array("Horaires", "", 
					array("Samedi", "14H00 - 15H00 (6 ans) ", "15H15 - 16H15 (4-5ans)")
				),
				array("Inscription", "registerref=chinois")
			),
		),	1
	),	
	array("青少年", 
		array("jiaoyu_450.jpg", "青少年中文课", "青少年中文课", "JY_YOUTH"),  
		array(
"青少年汉语班面对七岁以上的青少年学生，主要使用《汉语》和《中文》两套教材，并根据班级水平及学生特色，辅以《跟我学汉语》、《快乐汉语》、《长城汉语》、《声典》等多种汉办指定教材，丰富教学内容。拥有《汉语》从拼音开始至十一册的班，以及《中文》九册班。教师认真负责，教室配备多媒体教学设备，教学手段多样化，教学质量高。",
		),
		array(
			array("上课时间 ", "", 
				array("星期三", "14H—17H15"),
				array("星期六", "10H30—17H45"),
				array("星期日", "10H30—17H45"),
			),
			array("报名表", "../register/?registerref=chinois")
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
			array("Inscription", "registerref=chinois")
		),
	),
	1
				
		),
	array("成人",
		array("school/adulte.jpg", "成人中文课", "成人中文课", "JY_ADULTE"),  
		array(
"汉语学习在法国持续升温，除了青少年外，越来越多的成年人也投入到学习汉语的热潮中。成人汉语班即是针对希望学习汉语的成年人而开办的。成人汉语班使用《当代中文》作为主教材，《长城汉语》作为辅助教材，根据学生的汉语程度分为初级班和提高班。在教学过程中借助现代教学手段，注重教学内容的实用性，以练为主，使学生能学有所用。"
		),
		array(
			array("上课时间 ", "", 
				array("星期六", "13H30-15H30", "10H30—12H30"),
				array("星期日", "10H30-12H30"),
			),
			array("报名表", "registerref=adulte")
		),
		array("汉法双语会话角", 
			array("school/huiha.jpg", "汉语会话角", "汉语会话角"),
			array(
"为了提高语言学习者的口语表达能力，欧洲时报孔子课堂定期举办双语角活动，为学习汉语或法语的有关人士提供了一个交流和练习的平台。每次活动的主题广泛取材于《汉语900句》、《汉语301句》以及《体验汉语》等教材。同时，双语角以中国文化为切入点，紧扣时事，并结合欧洲时报文化中心的相关展览或讲座，组织大家进行有目的的学习和研讨。"
			),
			array(
				array("上课时间 ", "", 
					array("星期五", "14H30 - 16H30"),
				),
				//array("报名表", "../register/?registerref=huihua")
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
			array("Inscription", "/french/register/?registerref=adulte")
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
				array("Inscription", "/french/register/?registerref=huihua")
			),
		),
	),1
				
	),
	*/
),

array ("竞试活动", "concour", "school/YCTkaoshi.jpg",  "exma.png",
	array(
"2011年11月，欧洲时报孔子课堂举办了巴黎大区首次新YCT考试。从此，每年的3月和11月都定期举办YCT考试的笔试。每次考试，考生成绩合格率均超过99%。甚至在YCT的一、二级考试中，多次出现超过半数的考生拿到了满分。"
	),
	$JY_EXAM, $JY_CONCOURS
/*	
	array("汉语考试",
		array("school/YCT.jpg", "汉语考试", "汉语考试", "JY_EXAM"),  
		array(
"作为国际汉语能力标准化考试，新汉语水平考试（HSK）和新中小学生汉语考试（YCT）主要考查汉语非第一语言的考生在日常生活和学习中运用汉语的能力，其中新YCT则专门为中小学生而设置。HSK和YCT均分相互独立的笔试和口试两部分。",
"YCT笔试包括YCT（一级）、YCT（二级）、YCT（三级）和YCT（四级）；口试包括YCT（初级）和YCT（中级）。HSK笔试包括HSK（一级）、HSK（二级）、HSK（三级）、HSK（四级）、HSK（五级）和HSK（六级）；口试（HSKK）包括HSKK（初级）、HSKK（中级）和HSKK（高级）。",
"2011年11月，欧洲时报孔子课堂举办了巴黎大区首次新YCT考试。从此，每年都定期举办两次YCT考试的笔试。每次考试，考生成绩合格率均超过99%。甚至在YCT的一、二级考试中，多次出现超过半数的考生拿到了满分。从2014年12月起，欧洲时报孔子课堂将举办HSK考试。"
		),
		array(
			array("时间 ", " ", array("","")),
			array("报名表", "../register/?registerref=concoursyct")
			),
	array("Tests chinois",
		array("school/YCT.jpg", "Tests chinois", "Tests chinois"),  
		array(
"Nouveau Test d’Evaluation de Chinois (HSK ou YCT) est un examen international standardisé attestant de compétences linguistiques en chinois, avec pour priorité l’évaluation de la capacité de communication dans la vie quotidienne et dans les études des candidats ayant une langue maternelle autre que le chinois. YCT est pour écoliers et lycéens. HSK ou YCT se décompose en Oral et en Ecrit, elles sont deux parties indépendantes l’une de l’autre.",
"Pour YCT, la partie Ecrite comporte 4 niveaux différents, à savoir : YCT (niveau 1) jusqu’à YCT (niveau 4) ; l’Oral se décompose en YCT (niveau bas), YCT (niveau moyen).",
"Pour HSK, la partie Ecrite comporte 6 niveaux différents, à savoir : HSK (niveau 1) jusqu'à HSK (niveau 6) ; Examen Oral se décompose en HSK (niveau bas), HSK (niveau moyen) et en HSK (haut niveau), avec le contenu de l’examen enregistré en cassette.",
"La Classe Confucius de Nouvelles d’Europe a organisé le premier YCT en région parisienne en novembre 2011. Depuis, chaque année en mars et en novembre, de nombreux élèves d’Ile de France viennent pour passer le test, avec un taux de réussite dépassant 99%. À plusieurs reprises, plus de la moitié des candidats a obtenu 20/20 pour le niveau I et II. En décembre 2014, la Classe Confucius de Nouvelles d’Europe va organiser son premier HSK."
		),
		array(
			array("时间 ", " ", array("","")),
		array("Inscription", "registerref=concoursyct")
		),
	),1
		),
	array("中华文化大赛", 
		array("school/wenhuaconcours.jpg", "中华文化大赛", "中华文化大赛", "JY_CONCOURS"),  
		array(
"为进一步激发海外华裔青少年学习汉语和中华文化兴趣，提升效应，扩大影响，同时亦为满足海外华文学校师生需求，中国海外交流协会在总结以往三届知识竞赛经验的基础上，将“海外华裔青少年中华文化知识竞赛”改为“海外华裔青少年中华文化大赛”。",
"大赛分为海外预赛和国内决赛两个环节，知识竞赛、演讲比赛和中华才艺比赛三项。知识竞赛的内容主要出自三常教材（《中国文化常识》、《中国历史常识》和《中国地理常识》），知识竞赛成绩169（满分260分）以上的考生，才能具备参考演讲和才艺比赛资格。每国演讲比赛和才艺比赛的前5名将受邀回国参加决赛。"
		),
		array(
			array("时间 ", " ", array("","")),
		array("报名表", "../register/?registerref=concourswenhua")
		),
	array("Concours sur les connaissances de la civilisation chinoise", 
		array("school/wenhuaconcours.jpg", "concours de la culture chinois", "concours de la culture chinois"),  
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
			array("时间 ", " ", array("","")),
		array("Inscription", "/french/register/?registerref=concourswenhua")
		),
	),1
		),
	*/
),

array ("学生园地", "student", "school/student.jpg", "studentyuandi.png ",
	array(""),
	$ST_W1, $ST_W2, $ST_W3, $ST_W8, $ST_W4, $ST_W5, $ST_W6, $ST_W7,  
	$ST_W9, $ST_W10, $ST_W11, $ST_W12, $ST_W13, $ST_W14, $ST_W15, $ST_W16, $ST_W17, $ST_W18
),

array ("才艺培训", "formation", "school/chaiyipeixun.jpg",  "formation.png", 
	array(""),
	$JY_SHUHUA, $JY_WUSHU, $JY_PIANO, $JY_WUDAO,
/*
	array("书画",
		array("school/shufa.jpg", "书画课", "书画课", "JY_SHUHUA"),   
	 	array(
"中国书法和绘画经过几千年的历史基奠，已经成为中国的国粹。练习书画不仅能陶冶人的情操，培养高雅的业余爱好和文明的风度，还能给人以愉悦，激发人的感情，宁神健魄。教学中，教师注重因材施教，针对个人的水平和特色做个性化的辅导。",
"执教老师：王小军（中国美术学院毕业）"
	 	),
		array(
			array("上课时间 ", "", 
				array("星期三", "14H00—15H30","15H45—17H15")
			),
			array("报名表", "../register/?registerref=shuhua")
		),
	array("Cours de calligraphie et de peinture chinoise",
		array("school/shufa.jpg", "calligraphie et peinture", "calligraphie et peinture"),   
	 	array(
"La calligraphie et la peinture chinoises ont une histoire commune vieille de milliers d'années, et représentent la quintessence profonde de la Chine. Pratiquer l’art de la calligraphie c’est non seulement se cultiver, mais c’est aussi le plaisir d'acquérir de l'élégance et la paix de l’âme. L'enseignement est très personnalisé. ",
	 		 	"Professeur: WANG Xiaojun (Diplômé de l’Ecole des Beaux-Arts de Chine)"
	 	),
		array(
			array("Horaires", "", 
				array("Mercredi", "14H00—15H30","15H45—17H15")
			),
			array("Inscription", "/french/register/?registerref=shuhua")
		),
	 ),1
				),
 
	array("武术", 
		array("school/wushu.jpg", "少儿武术课", "少儿武术课", "JY_WUSHU"),   
		array(
"武术是中国传统的体育项目，更是中国人民在长期的社会实践中不断积累和丰富起来的运动形式。武术注重内外兼修，是一项宝贵的文化遗产，也是中国传统文化的重要组成部分。练习武术除能强身健体、锻炼意志外﹐还能培养机智勇敢﹑坚韧不屈等优良性格。"),
		array(
			array("上课时间 ", "", 
				array("星期三", "14H30—15H30", "15H45—17H15")
			),
			array("报名表", "../register/?registerref=wushu")
		),
	array("Cours de Kungfu pour enfants", 
		array("school/wushu.jpg", "kungfu", "kungfu"),   
		array(
"L'art martial (Wushu en chinois) est un sport traditionnel chinois, qui a été développé en Chine au fil des siècles. Wushu est un patrimoine culturel précieux. La pratique de Wushu sert non seulement à renforcer la forme physique, mais aussi à cultiver et développer des caractères importants, comme la discipline, la preuve de volonté et de courage."
		),
		array(
			array("Horaires", "",  
				array("Mercredi", "14H30—15H30", "15H45—17H15")
			),
			array("Inscription", "/french/register/?registerref=wushu")
		),
	), 1
		), 
	array("钢琴", 
		array("school/piano.jpg", "钢琴课", "钢琴课", "JY_PIANO"),   
		array(
"钢琴课采用一对一教学。教师在教学中注重丰富学生的生活，陶冶情操，开阔视野，使学生身心愉悦健康。最重要的是，通过钢琴学习，使学生了解构成音乐的基本要素，懂得理解和表现音乐的规律，从而全面提高音乐素养和文化艺术修养。"),
		array(
			array("上课时间 ", "", 
				array("星期三", "全天"),
				array("星期六", "全天"),
				array("星期日", "全天"),
			),
			array("报名表", "../register/?registerref=piano")
		),
	array("Cours de piano", 
		array("school/piano.jpg", "Piano", "Piano"),   
		array(
"Le cours de piano est individuel avec des professeurs diplômés en musique. Le cours est en fonction de chaque profil, met à la disposition des méthodes et outils pour permettre d'atteindre l'objectif de chaque enfant. Par l'apprentissage du piano, les élèves comprennent les éléments de base de la musique, expriment leurs sentiments et améliorent leur qualité culturelle et artistique.  Apprendre à jouer du piano favorise le développement personnel et apporte de nombreux bienfaits."
		),
		array(
			array("Horaires", "", 
				array("Mercredi", "en journée"),
				array("Samedi", "en journée"),
				array("Dimanche", "en journée"),
			),
			array("Inscription", "/french/register/?registerref=piano")
		),
	),1
		),
	array("舞蹈", 
		array("school/chaiyipeixun.jpg", "少儿健美舞课", "少儿健美舞课", "JY_WUDAO"),   
		array(
"少儿舞蹈训练，在教学上用童心追求童趣，不仅培养学生健美的体魄，发展其灵活性，柔韧性和协调性。而且在潜移默化中培养美的情操，引导学生对舞蹈表现形式和情感内涵的整体把握。"
			),
		array(
			array("上课时间 ", "", 
				array("星期三", "14H00—15H30", "15H45—16H15")
			),
			array("报名表", "../register/?registerref=dance")
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
			array("Inscription", "/french/register/?registerref=dance")
		),
	),1
		),
	*/
),

array ("夏令营 ", "summer", "school/summer.jpg",  "summer.png ", 
	array(
	),

	array("简介",
		array("school/summer.jpg", "夏令营简介", "夏令营简介", "JY_SUMMER"), 
		array(
"青少年夏令营是欧洲时报中文学校的名牌项目。近二十年来，除遇特大自然灾害，学校年年都组织学生赴中国进行三周至一个月的夏令营活动。",
"夏令营期间，学生们在中国学习汉语知识、体验中国文化、参观名胜古迹，并结交了不少新朋友。很多学生都觉得非常有意义，有的还参加了两三次夏令营活动。近年来，夏令营的住宿条件有了很大的改善，活动安排也更多样化。在传统的北京、上海寻根夏令营的基础上，欧洲时报中文学校与中国宋庆龄基金会合作，参加了由基金会组织的国际青少年交流营，深受学生的喜爱。"
		),
		array(
			array("报名表", "../register/?registerref=summer")
		),
	),

	array("寻根之旅", 
		array("school/voyageete.jpg", "寻根之旅",  "寻根之旅",  "JY_VOYAGE"), 
		array(
"“中国寻根之旅”夏令营是中国国务院侨务办公室和中国海外交流协会为增进海外华裔和港澳台地区青少年对中国的了解，提高他们学习汉语和中华文化的兴趣，推动海外华文教育发展而举办的大型综合性活动。",
"近年来，中国国务院侨务办公室和中国海外交流协会与地方有关单位合作，挖掘特色文化资源，统筹安排办营计划。通过多姿多彩的游教活动，使广大营员了解古老中国的悠久历史和灿烂文化，感受当今中国蓬勃发展的良好态势，增强同为炎黄子孙的民族认同感和自豪感。",
"欧洲时报中文学校的青少年寻根夏令营通过与国内华文教育基地多年的合作，摸索出了一套既行之有效，又受学生喜爱的学习方式。除了常规的汉语课，还为广大营员开设了各种具有中国特色的文化体验课，让大家学有所得，学有所乐。劳逸结合的日程安排，让大家在学习之余，外出游览参观、深入生活、寻根问祖。每次夏令营活动都给广大营员留下了深刻的印象。",
		),
		array(
			array("报名表", "../register/?registerref=summerxungen")
		),
	),

	array("国际交流营", 
		array("school/guojijiaoliu.jpg", "国际交流营", "国际交流营", "JY_GUOJI"), 
		array(
"宋庆龄国际青少年交流营由中国宋庆龄基金会主办，以“来中国，交世界的朋友”为主题，旨在搭建广阔的国际交流平台，让各国青少年在轻松愉快的氛围中，在丰富多彩的活动中，开阔眼界，增长知识，结交朋友，从而拥有广博胸怀，感知和理解多元文化，尊重和包容各民族文化差异，在他们心中播下友谊的种子，使之成为维护世界和平的新生力量。同时，积极传播中国历史悠久的传统文化，传达中国人民热爱和平的美好情感。",
"欧洲时报中文学校组织参加国际交流营中的“北京——内蒙古”自然之旅。营员们在北京相识相知，通过国家日活动展示本国的特色文化，又登上长城为世界和平祈愿。在内蒙古，营员们走进草原亲近大自然，开展草原趣味运动会，欣赏蒙古族歌舞表演，感受中国多民族文化的魅力。"
		),
		array(
			array("报名表", "../register/?registerref=summerjiaoliu")
		),
	),
),


array ("教师交流", "teacher", "school/teacher.jpg", "teacherjiaoliu.png",
	array("教师交流简介"),
	array("教学交流", 
		array("school/teacher.jpg", "教学交流"), 
		array(
			"",
		),
	),
),

);


$zhongwenkongzi = array(
"中文学校/孔子课堂",
"法国欧洲时报中文学校成立于1992年，是巴黎大区最早开始中文教育的机构之一。学校位于巴黎近郊的欧洲时报文化中心内，紧邻巴黎著名的大学城，离华人聚居的13区只有几分钟的车程。学校一向以教师认真负责、教学质量高著称，是巴黎大区有口皆碑的中文名校。同时，也是国侨办授予的首批海外华文教育示范学校。",
"2008年6月，欧洲时报中文学校与国家汉办签署协议，成为孔子课堂。2009年1月，国家汉办许琳主任莅临为欧洲时报孔子课堂挂牌，是法国的第一家孔子课堂。",
"针对不同年龄和中文水平的学生，学校开办了多个中文班，包括幼儿汉语班和成人中文班等。除了汉语教学外，校内还设有钢琴、舞蹈、武术、书画等才艺班，并每年组织寻根之旅夏令营等活动。",
"学校利用孔子课堂的资源优势，除每年举办汉语考试外，还主办过法国本土教师多媒体中文教育培训和孔子课堂教材展等活动。"
);

$JY_VIDEO_TAB = array(
	array(
		array("childrensingsing.avi", "歌唱会"),
		array("childrensingsing.avi", "歌唱会"),
	),
);

$JY_OTHER_PHOTOS = array(
	array(	
		array("school/children1.jpg", "school/children1.jpg", "幼儿中文课"), 
		array("school/jiaoyu3.jpg", "school/jiaoyu3.jpg", "中文课"),   
		array("school/jiaoyu5.jpg", "school/jiaoyu4.jpg", "中文课"),   
		array("school/jiaoyu5.jpg", "school/jiaoyu5.jpg", "中文课"),   
		array("school/jiaoyu5.jpg", "school/jiaoyu6.jpg", "中文课"),   
		array("school/adulte.jpg", "school/adulte.jpg", "成人中文课"),  
		array("school/huiha.jpg", "school/huiha.jpg", "汉语会话角"), 
	),
	array(),
	array(),
	array(
		array("school/shufa.jpg", "school/shufa.jpg", "书画课"),   
		array("school/wushu.jpg","school/wushu.jpg", "少儿武术课"),
		array("school/piano.jpg", "school/piano.jpg", "钢琴课"), 
		array("school/chaiyipeixun.jpg", "school/chaiyipeixun.jpg", "少儿健美舞课"),
	),
);


?>
