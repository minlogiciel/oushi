-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Client :  db501123401.db.1and1.com
-- Généré le :  Mar 24 Novembre 2015 à 22:14
-- Version du serveur :  5.1.73-log
-- Version de PHP :  5.4.45-0+deb7u2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `db501123401`
--

-- --------------------------------------------------------

--
-- Structure de la table `REG_TABLE`
--

CREATE TABLE IF NOT EXISTS `REG_TABLE` (
  `IDS` int(11) NOT NULL AUTO_INCREMENT,
  `CIVIL` char(1) DEFAULT NULL,
  `CNAME` varchar(64) DEFAULT NULL,
  `FNAME` varchar(64) DEFAULT NULL,
  `BIRTHDAY` varchar(64) DEFAULT NULL,
  `PHONE` varchar(32) DEFAULT NULL,
  `MOBILE` varchar(32) DEFAULT NULL,
  `FAX` varchar(32) DEFAULT NULL,
  `EMAIL` varchar(128) DEFAULT NULL,
  `STREET` varchar(128) DEFAULT NULL,
  `CITY` varchar(64) DEFAULT NULL,
  `POSTCODE` varchar(64) DEFAULT NULL,
  `DEPARTEMENT` varchar(64) DEFAULT NULL,
  `COUNTRY` varchar(32) DEFAULT NULL,
  `CLASSES` varchar(64) DEFAULT NULL,
  `TIMES` varchar(64) DEFAULT NULL,
  `PAYEMENT` varchar(32) DEFAULT NULL,
  `REGISTDATE` varchar(32) DEFAULT NULL,
  `LASTMODIFY` varchar(32) DEFAULT NULL,
  `CHINESE` varchar(32) DEFAULT NULL,
  `PARENTS` varchar(32) DEFAULT NULL,
  `HDINDEX` varchar(32) DEFAULT NULL,
  `COMMENTS` varchar(512) DEFAULT NULL,
  `VALIDED` char(1) DEFAULT NULL,
  `DELETED` char(1) DEFAULT NULL,
  PRIMARY KEY (`IDS`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

--
-- Contenu de la table `REG_TABLE`
--

INSERT INTO `REG_TABLE` (`IDS`, `CIVIL`, `CNAME`, `FNAME`, `BIRTHDAY`, `PHONE`, `MOBILE`, `FAX`, `EMAIL`, `STREET`, `CITY`, `POSTCODE`, `DEPARTEMENT`, `COUNTRY`, `CLASSES`, `TIMES`, `PAYEMENT`, `REGISTDATE`, `LASTMODIFY`, `CHINESE`, `PARENTS`, `HDINDEX`, `COMMENTS`, `VALIDED`, `DELETED`) VALUES
(4, 'F', 'å˜‰æ…§', 'PEUVRIER--LI MÃ©lissa', '', '0634509435', '0634509435', '', 'peuvrierfei@yahoo.fr', '100 avenue Jean JaurÃ¨s, Escalier B', 'CHATENAY MALABRY', '92290', '', 'France', 'å¹¼å„¿ä¸­æ–‡è¯¾', 'æ˜ŸæœŸå…­15H15â€”16H15ï¼ˆ4-5å²å”±æ¸¸ç­ï¼‰', 'C', '04/15/2014 - 11:15:02', '04/24/2014 - 09:23:17', '', '', 'children', 'æˆ‘ä»¬5æœˆ10æ—¥åº¦å‡å›žæ¥ï¼Œ5æœˆ17æ—¥ä¸Šåˆæˆ‘ä»¬äº²è‡ªåŽ»ä»˜æ¬¾', '0', '0'),
(5, 'F', 'å¼ é¦¨æ€¡', 'Zhang flora xinyi', '1/2/2008', '0612101053', '0612101053', '', 'dianehu1979@gmail.com', '141 avenue de Paris', 'Villejuif', '94800', '', '', 'å¹¼å„¿ä¸­æ–‡è¯¾', 'æ˜ŸæœŸå…­ï¼š14H00â€”15H00ï¼ˆ6å²è¯†å­—ç­ï¼‰', 'C', '05/11/2014 - 12:40:49', '05/11/2014 - 12:40:49', '', '', 'children', 'Premiere inscription', '0', '0'),
(6, 'F', 'å¼ é¦¨æ€¡', 'Zhang Flora xinyi', '1/2/2008', '0172462230', '0612101053', '', 'dianehu1979@gmail.com', '141 avenue de Paris', 'Villejuif', '94800', '', 'France', 'æ±‰å­—ä¹¦å†™ç­;å°‘å„¿å¥ç¾Žç­;', 'æ˜ŸæœŸä¸€è‡³å…­:14h00-15h30æˆ–15h45-17h15', 'C', '05/11/2014 - 12:46:11', '05/11/2014 - 12:46:11', '', '', 'shuqipinyin', '', '0', '0'),
(7, 'M', 'çŽ‹æ ‘æ§', '', '10/18/1988', '00338989897', '321546987', '', '', 'Rue BenoÃ®t Malon', 'paris', '94587', '', '', 'åˆå”±å›¢', 'æ˜ŸæœŸæ—¥ : 14H00-18H30', 'C', '06/07/2014 - 16:17:32', '06/07/2014 - 16:17:32', '', '', 'hechangtuan', '', '0', '0'),
(8, 'M', '', 'Ford, Daniel', '4/28/1951', '0145812587', '0677204958', '', 'dford@free.fr', '12? rue GouthiÃ¨re', 'Paris', '75013', '', 'France', 'Cours de chinois pour adultes', 'Samedi: 14H30-16H30', 'M', '06/23/2014 - 17:41:31', '06/23/2014 - 17:41:31', '', '', 'adulte', '', '0', '0'),
(9, 'M', '', 'Ford, Daniel', '4/28/1951', '0145812587', '0677204958', '', 'dford@free.fr', '12? rue GouthiÃ¨re', 'Paris', '75013', '', 'France', 'Cours de chinois pour adultes', 'Samedi: 14H30-16H30', 'M', '06/23/2014 - 17:43:29', '06/23/2014 - 17:43:29', '', '', 'adulte', '', '0', '0'),
(10, 'M', '', 'Ford, Daniel', '4/28/1951', '0145812587', '0677204958', '', 'dford@free.fr', '12? rue GouthiÃ¨re', 'Paris', '75013', '', 'France', 'Cours de chinois pour adultes', 'Samedi: 14H30-16H30', 'M', '06/28/2014 - 19:35:35', '06/28/2014 - 19:35:35', '', '', 'adulte', '', '0', '0'),
(11, 'M', '', 'Ford, Daniel', '4/28/1951', '0145812587', '0677204958', '', 'dford@free.fr', '12? rue GouthiÃ¨re', 'Paris', '75013', '', 'France', 'Cours de chinois pour adultes', 'Samedi: 14H30-16H30', 'M', '06/29/2014 - 09:26:46', '06/29/2014 - 09:26:46', '', '', 'adulte', '', '0', '0'),
(12, 'M', '', 'Ford, Daniel', '4/28/1951', '0145812587', '0677204958', '', 'dford@free.fr', '12? rue GouthiÃ¨re', 'Paris', '75013', '', 'France', 'Cours de chinois pour adultes', 'Samedi: 14H30-16H30', 'M', '06/29/2014 - 17:37:56', '06/29/2014 - 17:37:56', '', '', 'adulte', '', '0', '0'),
(13, 'M', '', 'Ferrandes Jerome', '5/5/1980', '0610434630', '0610434630', '', '', '6 rue victor carmignac ', 'arcueil', '94110', '', 'France', 'Cours de chinois pour adultes', 'Samedi:11H25â€”12H55', 'C', '07/17/2014 - 17:40:07', '07/17/2014 - 17:40:07', '', '', 'adulte', '', '0', '0'),
(14, 'F', '', 'Luong Clarisse', '9/17/2002', '01.46.71.30.29', '06.51.55.83.78', '', 'yaoiluongclarisse@gmail.com', '32 rue BarbÃ¨s', 'Ivry Sur Seine', '94200', '', 'France', 'Hanyu 1', 'Mercredi:15:45-17:15/Samedi:15:45-17:15', 'C', '08/15/2014 - 18:31:25', '08/15/2014 - 18:31:25', '', '', 'chinois', '', '0', '1'),
(15, 'F', '', 'Luong Delphine', '11/6/2005', '01.46.71.30.29', '06.51.55.83.78', '', 'yaoiluongclarisse@gmail.com', '32 rue BarbÃ¨s', 'Ivry Sur Seine', '94200', '', 'France', 'Hanyu 1', 'Mercredi:15:45-17:15/Samedi:15:45-17:15', 'C', '08/15/2014 - 18:32:50', '08/15/2014 - 18:32:50', '', '', 'chinois', '', '0', '1'),
(16, 'F', 'ç¾Žä¸½', 'CÃ©line ', '6/5/2001', '0142035233', '0652167832', '', '', '22 avenue Choisy ', 'Paris', '75013', '', '', 'æ±‰è¯­äºŒå†Œ', 'æ˜ŸæœŸå…­:13:30-15:30', 'C', '08/27/2014 - 23:11:46', '08/27/2014 - 23:11:46', '', '', 'chinois', '', '0', '1'),
(17, 'F', '', 'BINET marie-anne', '3/7/1987', '0614878937', '', '', 'mmarrieanne@hotmail.com', '9 rue RenÃ© Anjolvy', 'gentilly', '94250', '', 'France', 'Cours de chinois pour adultes', 'Samedi:11H25â€”12H55', 'M', '09/01/2014 - 11:46:52', '09/01/2014 - 11:46:52', '', '', 'adulte', '', '1', '0'),
(18, 'M', '', 'HOUDAN-UNG THEO', '1/28/2004', '0620623571', '0620623571', '', '', '17 rue de la division leclerc', 'AULANY SOUS BOIS', '93600', '', 'France', 'Hanyu 2', 'Samedi:13:30-15:30', 'C', '09/03/2014 - 13:40:33', '09/03/2014 - 13:40:33', '', '', 'chinois', '', '0', '1'),
(19, 'M', '', 'Quartier-dit-Maire FranÃ§ois', '8/6/2005', '0984574857', '0624474650', '0144495070', 'pierre.quartier@nck.aphp.fr', '12 rue Notre-Dame des Champs', 'Paris', '75006', '', 'France', 'Hanyu 5', 'Samedi:13:30-15:30', 'C', '09/07/2014 - 18:17:21', '09/07/2014 - 18:17:21', '', '', 'chinois', 'MÃ¨re chinoise (yi.quartier@gmail.com), soeur ainÃ©e Wenqi Shu-Quartier ayant suivi les cours Ã  Villejuif', '0', '1'),
(20, 'M', 'ç§¦çŽºç”', 'Raynaud Simon', '7/4/2009', '0650154011', '0650154011', '', '', '3 rue cart, 94160', 'St MandÃ©', '94160', '', '', 'å¹¼å„¿ä¸­æ–‡è¯¾', 'æ˜ŸæœŸå…­15H15â€”16H15ï¼ˆ4-5å²å”±æ¸¸ç­ï¼‰', 'M', '09/13/2014 - 14:27:07', '09/13/2014 - 14:27:07', '', '', 'children', '', '0', '0'),
(21, 'M', '', 'THAI Adrien', '1/23/2008', '0628350543', '0628350543', '', 'fabricethai@yahoo.fr', '205 bld de stalingrad, appt 331', 'Vitry sur Seine', '94400', '', 'France', 'Pinyin', 'Dimanche:10:30-12:30', 'C', '09/14/2014 - 21:41:24', '09/14/2014 - 21:41:24', '', '', 'chinois', '', '0', '1'),
(22, 'M', 'æ˜Šæž—', '', '9/2/2009', '0633379798', '0633379798', '', '', '67 avenue de Paris', 'etampes', '91150 ', '', '', 'å¹¼å„¿ä¸­æ–‡è¯¾', 'æ˜ŸæœŸå…­:15H15â€”16H15ï¼ˆ4-5å²å”±æ¸¸ç­ï¼‰', 'C', '09/15/2014 - 22:45:43', '09/15/2014 - 22:45:43', '', '', 'children', '', '0', '0'),
(23, 'M', 'é™ˆæ¢“é“­', 'CHEN KEVIN', '12/20/2007', '0625481555', '0625481555   0603491652', '', '', '43 AV DE PARIS', 'CHATILLION', '92320', '', 'France', 'å°‘å„¿æ­¦æœ¯è¯¾ ', 'æ˜ŸæœŸä¸‰: 15H45â€”17H15', 'M', '09/17/2014 - 15:58:18', '09/17/2014 - 15:58:18', '', '', 'wushu', '', '0', '0'),
(24, 'M', 'é™ˆæ¢“é“­', 'CHEN KEVIN', '12/20/2007', '0625481555', '0625481555   0603491652', '', '', '43 AV DE PARIS', 'CHATILLION', '92320', '', '', 'å°‘å„¿æ­¦æœ¯è¯¾ ', 'æ˜ŸæœŸä¸‰: 15H45â€”17H15', 'M', '09/17/2014 - 16:05:18', '09/17/2014 - 16:05:18', '', '', 'wushu', '', '0', '0'),
(25, 'M', 'å¶æ™ºå¼º', 'Ye richard', '2/4/2000', '0146821799', '0678656006', '', '', '11 avenue Maximilien Robespierre  boÃ®te 64', 'Vitry sur seine ', '94400', '', '', 'æ±‰è¯­ä¸€å†Œ', 'æ˜ŸæœŸå…­:10:30-12:30', 'C', '09/23/2014 - 16:28:37', '09/23/2014 - 16:28:37', '', '', 'chinois', '', '0', '1'),
(26, 'F', 'Chau', 'Yeung chau ling', '11/10/1959', '', '0675221169', '', 'ch.yeung@laposte.net', '3 RUE BEETHOVEN', 'VITRY SUR SEINE', '94400', '', '', 'æˆäººæ³•æ–‡è¯¾', 'æ˜ŸæœŸå››:10H00-12H00', 'C', '10/14/2014 - 18:38:34', '10/14/2014 - 18:38:34', '', '', 'francais', '', '0', '1'),
(27, 'F', '', 'pellan marion', '2/12/1994', '0141240980', '0675216023', '', '', '1 rue gabrielle', 'gentilly', '94250', '', 'France', 'Yoga', 'Samedi: 13H30-15H00', 'C', '10/15/2014 - 00:13:07', '10/15/2014 - 00:13:07', '', '', 'yujia', '', '0', '0'),
(28, 'M', '', 'BECK GrÃ©gory', '5/31/1988', '0695645050', '', '', 'gregory.beck@outlook.com', '10, Rue Lafouge', 'GENTILLY', '94250', '', 'France', 'Cours de chinois pour adultes', 'Samedi:10H30â€”12H30', 'C', '10/26/2014 - 15:55:45', '10/26/2014 - 15:55:45', '', '', 'adulte', '', '0', '0'),
(29, 'F', '', 'Lowen Loven', '9/21/1977', '0789761622', '0789761622', '', 'loren.loven@gmil.com', 'rue jean baptiste clement', 'Gentilly', '94250', '', 'France', 'Yoga', 'Samedi: 10H30-12H00', 'C', '11/19/2014 - 17:21:17', '11/19/2014 - 17:21:17', '', '', 'yujia', '', '0', '0'),
(30, 'F', 'åˆ˜ç§‹ç‡•', '', '8/16/1987', '0169966661', '0652875299', '', '', 'Appt16,  4 Bis rue de la montagne de mons', 'athis mons', '91200', '', 'France', 'ç‘œä¼½', 'æ˜ŸæœŸå…­:10H30-12H00', 'C', '12/11/2014 - 21:12:21', '12/11/2014 - 21:12:21', '', '', 'yujia', '', '0', '0'),
(31, 'M', 'åˆ˜å®¶è¾‰', 'Perineau RaphaÃ«l', '12/16/2008', '0629650912', '0629650912', '', 'Lixia.perineau@yahoo.fr', '44 Rue Bayen', 'Paris', '75017', '', '', 'å¹¼å„¿ä¸­æ–‡è¯¾', 'æ˜ŸæœŸå…­:14H00â€”15H00ï¼ˆ6å²è¯†å­—ç­ï¼‰', 'C', '12/29/2014 - 23:24:53', '12/29/2014 - 23:24:53', '', '', 'children', '', '0', '0'),
(32, 'M', '', 'tai wang', '7/14/1990', '0612345789', '0123456789', '', '', '3rue de la prarie', 'antony', '92160', '', 'France', 'LV2-3', 'Dimanche:10:30-12:30', 'M', '01/08/2015 - 21:05:16', '01/08/2015 - 21:05:16', '', '', 'chinois', '', '0', '1'),
(33, 'F', '', 'Louis-Joseph Julie', '9/25/1988', '0666200877', '0666200877', '', 'julie_lj@live.fr', '14 place camille blanc', '94110', 'Arcueil', '', 'France', 'Cours de chinois pour adultes', 'Samedi:10H30â€”12H30', 'M', '01/09/2015 - 12:30:34', '01/09/2015 - 12:30:34', '', '', 'adulte', 'Renseignements sur le dÃ©roulement des cours', '0', '0'),
(34, 'M', 'å­™é¹', 'Jasper BLOEMENKAMP', '9/1/2009', '0763308691', '0763308691', '', '', '9 boulevard voltaire', 'issy les moulineaux', '92130', '', '', 'å¹¼å„¿ä¸­æ–‡è¯¾', 'æ˜ŸæœŸå…­:14H00â€”15H00ï¼ˆ6å²è¯†å­—ç­ï¼‰', 'C', '02/04/2015 - 11:35:20', '02/04/2015 - 11:35:20', '', '', 'children', '', '0', '0'),
(35, 'F', '', 'BARAZZA Magdalena', '5/7/2010', '01 53 67 50 34', '06 12 34 79 88', '', 'haiyancai@yahoo.com', '6 rue Lefebvre', 'Paris', '75015', '', 'France', 'Cours de chinois prÃ©scolaire ', 'Samedi:15H15â€”16H15ï¼ˆ4-5ansï¼‰', 'C', '03/04/2015 - 15:24:23', '03/04/2015 - 15:24:23', '', '', 'children', '', '0', '0'),
(36, 'F', 'æŽå—å—', 'LI Nannan', '7/9/1979', '0635508162', '0635508162', '', 'nannanli7979@yahoo.com', 'RUE REMY DUMONCEL', 'AVON', '77210', '', 'France', 'ä¹¦ç”»ç­ ', 'æ˜ŸæœŸä¸‰ :14H00â€”15H30', 'M', '03/11/2015 - 13:46:05', '03/11/2015 - 13:46:05', '', '', 'shuhua', '', '0', '0'),
(37, 'F', 'å¼ æ¢“çª', 'CERQUEIRA Jade', '3/31/2010', '0142838629', '0760821936', '', 'ttzhangchine129@hotmail.com', '93 rue de paris', 'joinville le pont', '94340', '', '', 'å¹¼å„¿ä¸­æ–‡è¯¾', 'æ˜ŸæœŸå…­:14H00â€”15H00ï¼ˆ6å²è¯†å­—ç­ï¼‰', 'C', '04/02/2015 - 15:36:48', '04/02/2015 - 15:36:48', '', '', 'children', '', '0', '0'),
(38, 'F', 'å¼ æ¢“çª', 'CERQUEIRA Jade', '3/31/2010', '0142838629', '0760821936', '', 'ttzhangchine129@hotmail.com', '93 rue de paris', 'joinville le pont', '94340', '', '', 'å¹¼å„¿ä¸­æ–‡è¯¾', 'æ˜ŸæœŸå…­:15H15â€”16H15ï¼ˆ4-5å²å”±æ¸¸ç­ï¼‰', 'C', '04/02/2015 - 15:37:17', '04/02/2015 - 15:37:17', '', '', 'children', '', '0', '0'),
(39, 'F', '', 'WOLFF LOUISE', '5/15/2008', '0610774731', '0610774731', '', 'soumany.wolff@gmail.com', '184 avenue de choisy', 'Paris', '75013', '', 'France', 'Hanyu 1', 'Samedi:10:30-12:30', 'C', '04/21/2015 - 11:26:53', '04/21/2015 - 11:26:53', '', '', 'chinois', '', '0', '1'),
(40, 'F', 'æž—èŠ³èŠ³', 'FANGFANG LIN', '7/3/1991', '', '0609835052', '', 'dandan492034922@qq.com', '13 rpt des martyrs', 'bagneux', '92220', '', '', 'é’¢ç´è¯¾ ', 'æ˜ŸæœŸä¸‰:', 'C', '04/28/2015 - 01:06:26', '04/28/2015 - 01:06:26', '', '', 'piano', '', '0', '0'),
(41, 'F', 'è”¡çºæ€¡', 'BARAZZA Magdalena', '5/7/2010', '09 51 58 01 76', '06 12 34 79 88', '', 'haiyancai@yahoo.com', '56 rue de VouillÃ©', 'Paris', '75015', '', '', 'å¹¼å„¿ä¸­æ–‡è¯¾', 'æ˜ŸæœŸå…­:14H00â€”15H00ï¼ˆ5å²ç­ï¼‰', 'C', '04/30/2015 - 13:01:34', '04/30/2015 - 13:01:34', '', '', 'children', '', '0', '0'),
(42, 'F', '', 'HEAN Sophie', '4/29/1998', '0143908454', '0651204502', '', 'sophie.hean@hotmail.fr', '22 rue henri barbusse', 'Villejuif', '94800', '', 'France', 'LV3', 'Dimanche:13:30-15:30', 'M', '05/08/2015 - 22:21:36', '05/08/2015 - 22:21:36', '', '', 'chinois', '', '0', '1'),
(43, 'M', '', 'KHEANG kevin', '3/2/2006', '0156521978', '0664432828', '', 'stephanie.baric@free.fr', '47 rue du chÃ¢teau des rentiers ', 'Paris', '75013', '', 'France', 'Hanyu 2', 'Samedi:10:30-12:30', 'C', '05/12/2015 - 23:51:51', '05/12/2015 - 23:51:51', '', '', 'chinois', '', '0', '1'),
(44, 'M', 'Kuo ze long ', 'KHEANG Dylan ', '3/2/2006', '0156521978', '0664432828', '', 'stephanie.baric@free.fr', '47 rue du chÃ¢teau des rentiers', 'Paris', '75013', '', '', 'æ±‰è¯­äºŒå†Œ', 'æ˜ŸæœŸå…­:10:30-12:30', 'C', '05/13/2015 - 00:06:34', '05/13/2015 - 00:06:34', '', '', 'chinois', '', '0', '1'),
(45, 'M', 'Kuo ze kuang', 'KHEANG axell', '4/25/2009', '0156521978', '0664432828', '', 'stephanie.baric@free.fr', '47 rue du chÃ¢teau des rentiers', 'Paris', '75013', '', '', 'æ‹¼éŸ³ç­', 'æ˜ŸæœŸå…­ 10:30-12:30', 'C', '05/13/2015 - 00:12:32', '05/13/2015 - 00:12:32', '', '', 'chinois', '', '0', '1'),
(46, 'F', 'çŽ‹è‰¾é›¯', 'REALE Mathilde', '4/18/2008', '01', '0619773001', '', '', '73, rue carnot', 'Maisons alfort', '94700', '', '', 'å¹¼å„¿ä¸­æ–‡è¯¾', 'æ˜ŸæœŸå…­:15H15â€”16H15ï¼ˆ6å²ç­ï¼‰', '', '05/18/2015 - 23:09:41', '05/18/2015 - 23:09:41', '', '', 'children', '', '0', '0'),
(47, 'F', 'çŽ‹è‰¾é›¯', 'REALE Mathilde', '4/18/2008', '', '0619773001', '', 'wanghe780113@hotmail.com', '73, rue carnot', 'Maisons alfort', '94700', '', '', 'æ‹¼éŸ³ç­', 'æ˜ŸæœŸä¸‰ 15:45-17:15/æ˜ŸæœŸæ—¥ 15:15-16:45', 'C', '05/19/2015 - 10:45:58', '05/19/2015 - 10:45:58', '', '', 'chinois', '', '0', '1'),
(48, 'M', 'å®¶æ‚¦', 'ESNAULT ANTOINE', '4/19/2010', '0652750748', '0652750748', '', 'Jieli55@yahoo.fr', '10 BIS RUE PAUL BERT', 'SAINT MANDE', '94160', '', '', 'å¹¼å„¿ä¸­æ–‡è¯¾', 'æ˜ŸæœŸå…­:14H00â€”15H00ï¼ˆ5å²ç­ï¼‰', 'M', '06/10/2015 - 21:28:27', '06/10/2015 - 21:28:27', '', '', 'children', '', '0', '0'),
(49, 'M', 'å®¶æ˜Ž', 'CLEMENT ESNAULT', '1/25/2006', '0652750748', '0652750748', '', 'jieli55@yahoo.fr', '10 BIS RUE PAUL BERT', 'SAINT MANDE', '94160', '', '', 'æ±‰è¯­ä¸‰å†Œ', 'æ˜ŸæœŸå…­:15:45-17:45', 'M', '06/10/2015 - 21:31:45', '06/10/2015 - 21:31:45', '', '', 'chinois', '', '0', '0'),
(50, 'M', 'èµµé»Žæ˜Ž', 'ZHAO Armand', '3/28/2006', '0951339900', '0623640233', '', 'jhzhao1@free.fr', '4 rue des pilotes', 'BRY SUR MARNE', '94360', '', '', 'æ±‰è¯­ä¸€å†Œ', 'æ˜ŸæœŸæ—¥:10:30-12:30', 'C', '06/13/2015 - 17:25:04', '06/13/2015 - 17:25:04', '', '', 'chinois', '', '0', '0'),
(51, 'F', ' èµµæ·‘æ¥ ', 'ZHAO Lucie', '1/30/2008', '0951339900', '0623640233', '', 'jhzhao1@free.fr', '4 rue des pilotes', 'BRY SUR MARNE', '94360', '', '', 'æ±‰è¯­ä¸€å†Œ', 'æ˜ŸæœŸæ—¥:10:30-12:30', 'C', '06/13/2015 - 17:31:05', '06/13/2015 - 17:31:05', '', '', 'chinois', '', '0', '0'),
(52, 'M', 'èµµå»ºçº¢', '', '10/31/1967', '0951339900', '0623640233', '', 'jhzhao1@free.fr', '4 rue des pilotes', 'BRY SUR MARNE', '94360', '', '', 'ç”µè„‘åˆçº§ç­', 'æ˜ŸæœŸå¤©:10H30-11H30(PY)', 'C', '06/13/2015 - 17:48:38', '06/13/2015 - 17:48:38', '', '', 'diannaochuji', '', '0', '0'),
(53, 'M', '', 'yao clovis', '12/6/2007', '', '0619866499', '', 'Yaojinyu1984@msn.cn', '97bis avenue de la republique ', 'Aubervilliers', '93300', '', '', 'å¹¼å„¿ä¸­æ–‡è¯¾', 'æ˜ŸæœŸå…­:14H00â€”15H00ï¼ˆ5å²ç­ï¼‰', 'C', '06/15/2015 - 07:59:32', '06/15/2015 - 07:59:32', '', '', 'children', '', '0', '0'),
(54, 'M', '', 'Yao quentin', '7/23/2009', '', '0619866499', '', 'Yaojinyu1984@msn.cn', '97bis avenue de la republique', 'Aubervilliers', '93300', '', '', 'å¹¼å„¿ä¸­æ–‡è¯¾', 'æ˜ŸæœŸå…­:14H00â€”15H00ï¼ˆ5å²ç­ï¼‰', 'C', '06/15/2015 - 08:02:40', '06/15/2015 - 08:02:40', '', '', 'children', '', '0', '0'),
(55, 'F', 'ç¾Žé˜…', 'MANON LIN MEYER', '12/14/2010', '0160690914', '0672155180', '', 'linsheng72@hotmail.com', '5 RUE GEORGES CHARPAK', 'ST FARGEAU PONTHIERRY', '77310', '', '', 'å¹¼å„¿ä¸­æ–‡è¯¾', 'æ˜ŸæœŸå…­:14H00â€”15H00ï¼ˆ5å²ç­ï¼‰', 'C', '06/23/2015 - 10:18:01', '06/23/2015 - 10:18:01', '', '', 'children', '', '0', '0'),
(56, 'F', 'æˆ¿äº­', '', '7/8/1981', '0618533306', '0618533306', '', 'valentine8178@hotmail.com', '11 rue de la Montagne Sainte GeneviÃ¨ve', 'Paris', '75005', '', '', 'ç‘œä¼½', 'æ˜ŸæœŸå…­:13H30-15H00', 'M', '06/26/2015 - 15:37:42', '06/26/2015 - 15:37:42', '', '', 'yujia', '', '0', '0'),
(57, 'F', '', 'CAI JULIE', '11/23/2007', '0688194809', '0688194809', '', '', '29 avenue edouard vaillant', 'Bobigny', '93000', '', 'France', 'Hanyu 1', 'Dimanche:10:30-12:30', 'C', '07/06/2015 - 15:52:05', '07/06/2015 - 15:52:05', '', '', 'chinois', '', '0', '0'),
(58, 'M', '', 'LAY  Harry', '12/30/2008', '0146644646', '0619756504', '', 'Primexo@yahoo.fr', '153 rue Julian grimau', 'Vitry sur seine', '94400', '', 'France', 'Pinyin', 'Mercredi 14:00â€”15:30/Samedi 13:30â€”15:00', 'M', '07/07/2015 - 00:14:08', '07/07/2015 - 00:14:08', '', '', 'chinois', '', '0', '0'),
(59, 'M', 'å°è´', 'BECK Gregory', '5/31/1988', '0695645050', '0695645050', '', 'gregory.beck@outlook.com', '10, Rue Lafouge', 'Gentilly', '94250', '', '', 'æˆäººä¸­æ–‡è¯¾', 'æ˜ŸæœŸå…­:10H30-12H30 (åˆçº§)', 'C', '07/19/2015 - 23:01:25', '07/19/2015 - 23:01:25', '', '', 'adulte', '', '0', '0'),
(60, 'M', '', 'Ferrandes Jerome', '5/5/1980', '0610434630', '0610434630', '', 'jferrandes2002@yahoo.fr', '6 rue victor carmignac ', 'arcueil', '94110', '', 'France', 'Cours de chinois pour adultes', 'Samedi:10H30â€”12H30 (dÃ©butant)', 'C', '07/23/2015 - 16:55:18', '07/23/2015 - 16:55:18', '', '', 'adulte', '', '0', '0'),
(61, 'M', 'é©¬å…‹è¥¿å§†', 'Despeisse Maxime', '11/21/1991', '0667695604', '0667695604', '', '', '18 allee du Cedre', 'Limeil brevannes', '94450', '', '', 'æˆäººä¸­æ–‡è¯¾', 'æ˜ŸæœŸå…­:10H30-12H30 (åˆçº§)', 'M', '07/25/2015 - 22:48:07', '07/25/2015 - 22:48:07', '', '', 'adulte', '', '0', '0'),
(62, 'M', '', 'Giraud Alexandre', '9/22/1982', '0667351768', '0667351768', '', 'alecsandr@hotmail.fr', '65 rue des Champs ElysÃ©es', 'Arcueil', '94110', '', 'France', 'æˆäººä¸­æ–‡è¯¾', 'æ˜ŸæœŸå…­:10H30-12H30 (åˆçº§)', 'C', '08/06/2015 - 18:00:15', '09/05/2015 - 11:38:05', '', '', 'adulte', '', '1', '0'),
(63, 'M', '', 'huynh', '6/17/2005', 'bureau 01 60 76 50 69', '06 61 30 39 16', '', '', '2 plcae Jean Giraudoux ', 'crÃ©teil ', '94000', '', 'France', 'Pinyin', 'Samedi:10:30-12:30', 'C', '08/19/2015 - 19:05:46', '08/19/2015 - 19:05:46', '', '', 'chinois', '', '0', '0'),
(64, 'F', '', 'Pellan Marion', '2/12/1994', '0141240980', '0675216023', '', '', '1 rue Gabrielle', 'Gentilly', '94250', '', 'France', 'Yoga', 'Samedi:13H30-15H00', 'C', '08/30/2015 - 19:08:49', '08/30/2015 - 19:08:49', '', '', 'yujia', '', '0', '0'),
(65, '', '', 'Tea Christelle', '7/7/1988', '0640113017', '', '', '', '46 rue pierre marcel', 'Gentilly', '94250', '', '', 'ç‘œä¼½', 'æ˜ŸæœŸå…­:10H30-12H00', 'C', '09/06/2015 - 16:06:47', '09/06/2015 - 16:06:47', '', '', 'yujia', '', '0', '0'),
(66, 'M', 'pierre', 'pierre-alain faure', '11/6/1974', '0662572661', '0662572661', '', '', '33 rue marcel dassault', 'bondy', '93140', '', '', 'æˆäººä¸­æ–‡è¯¾', 'æ˜ŸæœŸå…­:10H30-12H30 (åˆçº§)', 'C', '09/07/2015 - 11:46:45', '09/07/2015 - 11:46:45', '', '', 'adulte', '', '0', '0'),
(67, 'M', 'çŽ‹çŒ®æ…§', '', '2/21/1996', '0953631235', '0652575957', '', 'w871626021@gmail.com', '100 rue de la chapelle', 'paris', '75018', '', '', 'ä¹¦ç”»ç­ ', 'æ˜ŸæœŸå¤©:10:30â€”12:30 (é©¬è€å¸ˆ)', 'M', '09/10/2015 - 22:51:17', '09/10/2015 - 22:51:17', '', '', 'shuhua', '', '0', '0'),
(68, 'F', 'å¼µè‹¥ç³', 'CHANG Jolin', '11/29/1978', '0651596366', '0651596366', '', 'jolin1129@gmail.com', '29 rue emile goeury', 'Alfortville', '94140', '', 'France', 'æœ¨å…°æ‹³', 'æ˜ŸæœŸäº”:14H30-16H00', 'C', '11/16/2015 - 12:07:03', '11/16/2015 - 12:07:03', '', '', 'mulan', '', '0', '0'),
(69, 'F', 'å¼µè‹¥ç³', 'CHANG Jolin', '11/29/1978', '0651596366', '0651596366', '', 'jolin1129@gmail.com', '29 rue emile goeury', 'Alfortville', '94140', '', 'France', 'æœ¨å…°æ‹³', 'æ˜ŸæœŸäº”:14H30-16H00', 'M', '11/16/2015 - 12:07:27', '11/16/2015 - 12:07:27', '', '', 'mulan', '', '0', '0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
