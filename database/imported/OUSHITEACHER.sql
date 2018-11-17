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
-- Structure de la table `OUSHITEACHER`
--

CREATE TABLE IF NOT EXISTS `OUSHITEACHER` (
  `IDS` int(11) NOT NULL AUTO_INCREMENT,
  `NAMES` varchar(32) DEFAULT NULL,
  `TEACHERID` int(11) DEFAULT NULL,
  `TITLE` varchar(64) DEFAULT NULL,
  `JIAOCAI` varchar(64) DEFAULT NULL,
  `TYPES` varchar(64) DEFAULT NULL,
  `DATES` varchar(32) DEFAULT NULL,
  `CONTENT` varchar(1024) DEFAULT NULL,
  `PATHS` varchar(512) DEFAULT NULL,
  `FILES` varchar(128) DEFAULT NULL,
  `FTYPE` varchar(32) DEFAULT NULL,
  `LASTMODIF` varchar(32) DEFAULT NULL,
  `REMARKES` varchar(1024) DEFAULT NULL,
  `DELETED` char(1) DEFAULT NULL,
  PRIMARY KEY (`IDS`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=132 ;

--
-- Contenu de la table `OUSHITEACHER`
--

INSERT INTO `OUSHITEACHER` (`IDS`, `NAMES`, `TEACHERID`, `TITLE`, `JIAOCAI`, `TYPES`, `DATES`, `CONTENT`, `PATHS`, `FILES`, `FTYPE`, `LASTMODIF`, `REMARKES`, `DELETED`) VALUES
(1, 'å­™çª', 22, 'ç¬¬ä¸€å†Œ ç¬¬ä¸ƒè¯¾', 'ç¬¬ä¸€å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-01-15', 'ç¬¬ä¸€å†Œ ç¬¬ä¸ƒè¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', ' ç¬¬ä¸ƒè¯¾ ç»ƒä¹ é¢˜.pdf', 'PDF', '09/07/2015 - 22:44:25', 'remarkes', '1'),
(2, 'å­™çª', 22, 'ç¬¬äºŒå†Œç¬¬ä¹è¯¾', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-01-16', 'ç¬¬äºŒå†Œç¬¬ä¹è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', '9è¯¾A.pdf', 'PDF', '09/07/2015 - 22:44:03', '', '1'),
(3, 'å­™çª', 22, 'ç¬¬ä¸€å†Œç¬¬ä¸€å•å…ƒæ€»å¤ä¹ ', 'ç¬¬ä¸€å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-08-31', 'ç¬¬ä¸€å†Œç¬¬ä¸€å•å…ƒæ€»å¤ä¹ ', '../teacher/teacher22', '.pdf', 'PDF', '09/11/2015 - 19:07:49', '', '1'),
(4, 'å­™çª', 22, 'åäºŒç”Ÿè‚–', 'ç¬¬äº”å†Œ(æ—§ç‰ˆ)', 'é˜…è¯»', '2015-09-07', 'é˜…è¯»å’Œç†è§£-åäºŒç”Ÿè‚–', '../teacher/teacher22', '12ç”Ÿè‚–.pdf', 'PDF', '09/09/2015 - 11:07:33', '', '1'),
(5, 'å­™çª', 22, 'ç”»è›‡æ·»è¶³', 'ç¬¬äº”å†Œ(æ—§ç‰ˆ)', 'é˜…è¯»', '2015-09-07', 'é˜…è¯»å’Œç†è§£-ç”»è›‡æ·»è¶³', '../teacher/teacher22', '-ç”»è›‡æ·»è¶³.pdf', 'PDF', '09/08/2015 - 21:39:26', '', '1'),
(6, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 1 è¯¾å ‚ç”¨', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-08', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 1 è¯¾å ‚ç”¨ bpmf+ai-ao', '../teacher/teacher22', '1 b-p-m-fè¯¾å ‚ç”¨.pdf', 'PDF', '09/11/2015 - 22:18:35', '', '0'),
(7, 'æ½˜å‡€', 13, 'æ–°å››å†Œç¬¬å…«ã€ç¬¬ä¹è¯¾â€œå¯ä»¥â€å’Œâ€œèƒ½â€çš„ç”¨æ³•', 'ç¬¬å››å†Œ(æ–°ç‰ˆ)', 'æ•™æ¡ˆ', '2015-09-11', 'æ–°å››å†Œç¬¬å…«ã€ç¬¬ä¹è¯¾â€œå¯ä»¥â€å’Œâ€œèƒ½â€çš„ç”¨æ³•', '../teacher/teacher13', '20150926141018_13.pdf', 'PDF', '09/26/2015 - 14:10:18', '', '0'),
(8, 'æ½˜å‡€', 13, 'äº”å†Œé˜…è¯»æ–‡ç« ä¸€', 'ç¬¬äº”å†Œ(æ–°ç‰ˆ)', 'é˜…è¯»', '2015-09-11', 'æœ‰è¶£çš„å‘æ˜Ž', '../teacher/teacher13', '3.pdf', 'PDF', '09/11/2015 - 11:33:07', '', '0'),
(9, 'æ½˜å‡€', 13, 'äºŒå†Œ', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'äºŒå†Œç¬¬äºŒè¯¾å½¢å®¹è¯ç»ƒä¹ å¥', '../teacher/teacher13', '.pdf', 'PDF', '09/11/2015 - 11:18:37', '', '0'),
(10, 'æ½˜å‡€', 13, 'äº”å†Œé˜…è¯»æ–‡ç« äºŒ', 'ç¬¬äº”å†Œ(æ–°ç‰ˆ)', 'é˜…è¯»', '2015-09-11', 'å’•å’šæ¥äº†', '../teacher/teacher13', '3.pdf', 'PDF', '09/11/2015 - 11:34:55', '', '0'),
(11, 'æ½˜å‡€', 13, 'äº”å†Œé˜…è¯»æ–‡ç« ä¸‰', 'ç¬¬äº”å†Œ(æ–°ç‰ˆ)', 'é˜…è¯»', '2015-09-11', 'åŠ¨ç‰©æ²»ç—…', '../teacher/teacher13', ' ç¬¬4è¯¾.pdf', 'PDF', '09/11/2015 - 11:36:02', '', '0'),
(12, 'æ½˜å‡€', 13, 'äº”å†Œé˜…è¯»æ–‡ç« å››', 'ç¬¬äº”å†Œ(æ–°ç‰ˆ)', 'é˜…è¯»', '2015-09-11', 'æ‰¾æ±—', '../teacher/teacher13', '5.pdf', 'PDF', '09/11/2015 - 11:37:30', '', '0'),
(13, 'æ½˜å‡€', 13, 'äº”å†Œé˜…è¯»æ–‡ç« äº”', 'ç¬¬äº”å†Œ(æ–°ç‰ˆ)', 'é˜…è¯»', '2015-09-11', 'ä¹Œé¸¦å…„å¼Ÿ', '../teacher/teacher13', '6.pdf', 'PDF', '09/11/2015 - 11:38:05', '', '0'),
(14, 'æ½˜å‡€', 13, 'äº”å†Œé˜…è¯»æ–‡ç« å…­', 'ç¬¬äº”å†Œ(æ–°ç‰ˆ)', 'é˜…è¯»', '2015-09-11', 'è¢‹é¼ ä¸Žèœ—ç‰›', '../teacher/teacher13', '7.pdf', 'PDF', '09/11/2015 - 11:38:55', '', '0'),
(15, 'æ½˜å‡€', 13, 'äº”å†Œé˜…è¯»æ–‡ç« ä¸ƒ', 'ç¬¬äº”å†Œ(æ–°ç‰ˆ)', 'é˜…è¯»', '2015-09-11', 'å°çŒ´é‡ä½“æ¸©', '../teacher/teacher13', '8.pdf', 'PDF', '09/11/2015 - 11:39:28', '', '0'),
(16, 'æ½˜å‡€', 13, 'äº”å†Œé˜…è¯»æ–‡ç« å…«', 'ç¬¬äº”å†Œ(æ–°ç‰ˆ)', 'é˜…è¯»', '2015-09-11', 'æ¯”è„–å­', '../teacher/teacher13', '9.pdf', 'PDF', '09/11/2015 - 11:40:07', '', '0'),
(17, 'æ½˜å‡€', 13, 'äº”å†Œé˜…è¯»æ–‡ç« ä¹', 'ç¬¬äº”å†Œ(æ–°ç‰ˆ)', 'é˜…è¯»', '2015-09-11', 'æƒ³èµ°éå…¨ä¸–ç•Œçš„é©´å­', '../teacher/teacher13', '10.pdf', 'PDF', '09/11/2015 - 11:40:41', '', '0'),
(18, 'æ½˜å‡€', 13, 'äº”å†Œé˜…è¯»æ–‡ç« å', 'ç¬¬äº”å†Œ(æ–°ç‰ˆ)', 'é˜…è¯»', '2015-09-11', 'çˆ±è¯´å¤§è¯çš„é’è›™', '../teacher/teacher13', '11.pdf', 'PDF', '09/11/2015 - 11:41:14', '', '0'),
(19, 'æ½˜å‡€', 13, 'äº”å†Œé˜…è¯»æ–‡ç« åä¸€', 'ç¬¬äº”å†Œ(æ–°ç‰ˆ)', 'é˜…è¯»', '2015-09-11', 'èœ—ç‰›', '../teacher/teacher13', '12.pdf', 'PDF', '09/11/2015 - 11:41:56', '', '0'),
(20, 'æ½˜å‡€', 13, 'äº”å†Œé˜…è¯»æ–‡ç« åäºŒ', 'ç¬¬äº”å†Œ(æ–°ç‰ˆ)', 'é˜…è¯»', '2015-09-11', 'åäºŒç”Ÿè‚–çš„æ•…äº‹', '../teacher/teacher13', '13.pdf', 'PDF', '09/11/2015 - 11:42:30', '', '0'),
(21, 'æ½˜å‡€', 13, 'äº”å†Œè¡¥å……ç»ƒä¹ ', 'ç¬¬äº”å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬ä¸€è¯¾', '../teacher/teacher13', ' ç¬¬1è¯¾.pdf', 'PDF', '09/11/2015 - 11:46:29', '', '0'),
(22, 'æ½˜å‡€', 13, 'äº”å†Œè¡¥å……ç»ƒä¹ ', 'ç¬¬äº”å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬äºŒè¯¾', '../teacher/teacher13', ' ç¬¬2è¯¾.pdf', 'PDF', '09/11/2015 - 11:46:22', '', '0'),
(23, 'æ½˜å‡€', 13, 'äº”å†Œè¡¥å……ç»ƒä¹ ', 'ç¬¬äº”å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬ä¸‰è¯¾', '../teacher/teacher13', ' ç¬¬3è¯¾.pdf', 'PDF', '09/11/2015 - 11:47:17', '', '0'),
(24, 'æ½˜å‡€', 13, 'äº”å†Œè¡¥å……ç»ƒä¹ ', 'ç¬¬äº”å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬å››è¯¾', '../teacher/teacher13', ' ç¬¬4è¯¾.pdf', 'PDF', '09/11/2015 - 11:47:50', '', '0'),
(25, 'æ½˜å‡€', 13, 'äº”å†Œè¡¥å……ç»ƒä¹ ', 'ç¬¬äº”å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬ä¸€å•å…ƒ', '../teacher/teacher13', ' ç¬¬1å•å…ƒ.pdf', 'PDF', '09/11/2015 - 11:48:45', '', '0'),
(26, 'æ½˜å‡€', 13, 'äº”å†Œè¡¥å……ç»ƒä¹ ', 'ç¬¬äº”å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬å…­è¯¾', '../teacher/teacher13', ' ç¬¬6è¯¾.pdf', 'PDF', '09/11/2015 - 11:49:22', '', '0'),
(27, 'æ½˜å‡€', 13, 'äº”å†Œè¡¥å……ç»ƒä¹ ', 'ç¬¬äº”å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬ä¸ƒè¯¾', '../teacher/teacher13', ' ç¬¬7è¯¾.pdf', 'PDF', '09/11/2015 - 11:49:58', '', '0'),
(28, 'æ½˜å‡€', 13, 'äº”å†Œè¡¥å……ç»ƒä¹ ', 'ç¬¬äº”å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬å…«è¯¾', '../teacher/teacher13', ' ç¬¬8è¯¾.pdf', 'PDF', '09/11/2015 - 11:50:39', '', '0'),
(29, 'æ½˜å‡€', 13, 'äº”å†Œè¡¥å……ç»ƒä¹ ', 'ç¬¬äº”å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬ä¹è¯¾', '../teacher/teacher13', ' ç¬¬9è¯¾.pdf', 'PDF', '09/11/2015 - 11:51:10', '', '0'),
(30, 'æ½˜å‡€', 13, 'ä¸­å›½äººçš„å®¶æ—è¡¨', '', 'èµ„æ–™', '2015-09-11', 'å…³ç³»å’Œç§°å‘¼', '../teacher/teacher13', '.xls', 'XLS', '09/11/2015 - 15:39:50', '', '0'),
(31, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 3', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-11', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 3 d-t-n-l', '../teacher/teacher22', '3 d-t-n-l.pdf', 'PDF', '09/11/2015 - 22:19:05', '', '0'),
(32, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 2', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-11', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 2 b-p-m-f-d-t', '../teacher/teacher22', '2 b-p-m-f-d-t.pdf', 'PDF', '10/27/2015 - 18:24:54', '', '0'),
(33, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 4', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-11', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 4 d-t-n-l-g-k-h', '../teacher/teacher22', '4 d-t-n-l-g-k-h.pdf', 'PDF', '09/11/2015 - 13:37:42', '', '0'),
(34, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 5', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-11', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 5 g-k-h', '../teacher/teacher22', '5 g-k-h.pdf', 'PDF', '09/11/2015 - 13:37:56', '', '0'),
(35, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 6', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-08', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 6 gkh-j-q-x', '../teacher/teacher22', '6 g-k-h-j-q-x.pdf', 'PDF', '09/11/2015 - 13:40:09', '', '0'),
(36, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 7', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-08', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 7 j-q-x', '../teacher/teacher22', '7 j-q-x.pdf', 'PDF', '09/11/2015 - 13:40:45', '', '0'),
(37, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 8', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-08', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 8 j-q-x', '../teacher/teacher22', '8 j-q-x.pdf', 'PDF', '09/11/2015 - 13:41:14', '', '0'),
(38, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 9', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-08', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 9 z-c-s', '../teacher/teacher22', '9 z-c-s.pdf', 'PDF', '09/11/2015 - 13:42:48', '', '0'),
(39, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 10', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-08', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 10 zh-ch-sh', '../teacher/teacher22', '10 zh-ch-sh.pdf', 'PDF', '09/11/2015 - 13:43:37', '', '0'),
(40, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 11', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-08', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 11 zh-ch-sh-r', '../teacher/teacher22', '11 zh-ch-sh-r.pdf', 'PDF', '09/11/2015 - 13:44:11', '', '0'),
(41, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 12', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-08', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 12 y-w', '../teacher/teacher22', '12 y-w.pdf', 'PDF', '09/11/2015 - 13:44:48', '', '0'),
(42, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 13 ä¸‰æ‹¼éŸ³èŠ‚', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-08', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 13 ä¸‰æ‹¼éŸ³èŠ‚ ua-uo-iao', '../teacher/teacher22', '13 ua-uo-iao.pdf', 'PDF', '09/11/2015 - 13:46:40', '', '0'),
(43, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 14 ', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-08', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 14 ie-ue-er', '../teacher/teacher22', '14 ie-ue-er.pdf', 'PDF', '09/11/2015 - 13:47:55', '', '0'),
(44, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 15', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-08', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 15 an-en-in-un', '../teacher/teacher22', '15 an-en-in-un.pdf', 'PDF', '09/11/2015 - 13:48:45', '', '0'),
(45, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 16', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-08', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 16 ang-eng-ing-ong', '../teacher/teacher22', '16 ang-eng-ing-ong.pdf', 'PDF', '09/11/2015 - 13:49:21', '', '0'),
(46, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 17 æ€»å¤ä¹ ', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-08', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 17 æ€»å¤ä¹ ', '../teacher/teacher22', '17 æ€»å¤ä¹ .pdf', 'PDF', '09/11/2015 - 13:50:59', '', '0'),
(47, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 18 æ€»å¤ä¹ ', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-08', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 18 æ€»å¤ä¹ ', '../teacher/teacher22', '18 æ€»å¤ä¹ .pdf', 'PDF', '09/11/2015 - 13:51:17', '', '0'),
(48, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 19 æ€»å¤ä¹ ', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-08', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 19 æ€»å¤ä¹ ', '../teacher/teacher22', '19 æ€»å¤ä¹ .pdf', 'PDF', '09/11/2015 - 13:51:42', '', '0'),
(49, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 20 æ€»å¤ä¹ ', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-08', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 20 æ€»å¤ä¹ ', '../teacher/teacher22', '20æ€»å¤ä¹ .pdf', 'PDF', '09/11/2015 - 13:52:09', '', '0'),
(50, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 21 æ€»å¤ä¹ ', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-08', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 21 æ€»å¤ä¹ ', '../teacher/teacher22', '21æ€»å¤ä¹ .pdf', 'PDF', '09/11/2015 - 13:52:41', '', '0'),
(51, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 22 æ€»å¤ä¹ ', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-08', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 22 æ€»å¤ä¹ ', '../teacher/teacher22', '22æ€»å¤ä¹ .pdf', 'PDF', '09/11/2015 - 13:53:00', '', '0'),
(52, 'å­™çª', 22, 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 23 æ€»å¤ä¹ ', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-08', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ 23 æ€»å¤ä¹ ', '../teacher/teacher22', '23æ€»å¤ä¹ .pdf', 'PDF', '09/11/2015 - 13:53:28', '', '0'),
(53, 'å­™çª', 22, 'æ‹¼éŸ³ç‰¹åˆ«å¤ä¹  jqx-zcs', 'æ‹¼éŸ³', 'ç»ƒä¹ ', '2015-09-08', 'æ‹¼éŸ³è¡¥å……ç»ƒä¹ ç‰¹åˆ«å¤ä¹  jqx-zcs', '../teacher/teacher22', 'jqx zcsç»ƒä¹ é¢˜.pdf', 'PDF', '09/11/2015 - 13:56:00', '', '0'),
(54, 'å­™çª', 22, 'ç¬¬ä¸€å†Œæ‰€æœ‰ç”Ÿå­—ç¬”ç”»+éƒ¨é¦–+æ‹¼éŸ³', 'ç¬¬ä¸€å†Œ(æ–°ç‰ˆ)', 'èµ„æ–™', '2015-09-11', 'ç¬¬ä¸€å†Œæ‰€æœ‰ç”Ÿå­—ç¬”ç”»+éƒ¨é¦–+æ‹¼éŸ³', '../teacher/teacher22', '.pdf', 'PDF', '09/11/2015 - 16:28:37', '', '0'),
(55, 'å­™çª', 22, 'ç¬¬äºŒå†Œæ‰€æœ‰ç”Ÿå­—ç¬”ç”»+éƒ¨é¦–+æ‹¼éŸ³', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'èµ„æ–™', '2015-09-11', 'ç¬¬äºŒå†Œæ‰€æœ‰ç”Ÿå­—ç¬”ç”»+éƒ¨é¦–+æ‹¼éŸ³', '../teacher/teacher22', '.pdf', 'PDF', '09/11/2015 - 16:29:58', '', '0'),
(56, 'å­™çª', 22, 'ç¬¬ä¸€å†Œç¬¬1è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬ä¸€å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬ä¸€å†Œç¬¬1è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', ' ç¬¬ä¸€è¯¾ ç»ƒä¹ é¢˜.pdf', 'PDF', '09/12/2015 - 21:07:41', '', '0'),
(57, 'å­™çª', 22, 'ç¬¬ä¸€å†Œç¬¬2è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬ä¸€å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬ä¸€å†Œç¬¬2è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', ' ç¬¬äºŒè¯¾ ç»ƒä¹ é¢˜.pdf', 'PDF', '09/12/2015 - 21:07:20', '', '0'),
(58, 'å­™çª', 22, 'ç¬¬ä¸€å†Œç¬¬3è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬ä¸€å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬ä¸€å†Œç¬¬3è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', ' ç¬¬ä¸‰è¯¾ ç»ƒä¹ é¢˜.pdf', 'PDF', '09/12/2015 - 21:06:58', '', '0'),
(59, 'å­™çª', 22, 'ç¬¬ä¸€å†Œç¬¬4è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬ä¸€å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬ä¸€å†Œç¬¬4è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', ' ç¬¬å››è¯¾ ç»ƒä¹ é¢˜.pdf', 'PDF', '09/12/2015 - 21:05:11', '', '0'),
(60, 'å­™çª', 22, 'ç¬¬ä¸€å†Œç¬¬1å•å…ƒæ€»å¤ä¹ ', 'ç¬¬ä¸€å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬ä¸€å†Œç¬¬1å•å…ƒæ€»å¤ä¹ ', '../teacher/teacher22', '.pdf', 'PDF', '09/12/2015 - 21:04:57', '', '0'),
(61, 'å­™çª', 22, 'ç¬¬ä¸€å†Œç¬¬6è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬ä¸€å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬ä¸€å†Œç¬¬6è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', ' ç¬¬å…­è¯¾ ç»ƒä¹ é¢˜.pdf', 'PDF', '09/12/2015 - 21:06:46', '', '0'),
(62, 'å­™çª', 22, 'ç¬¬ä¸€å†Œç¬¬7è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬ä¸€å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬ä¸€å†Œç¬¬7è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', ' ç¬¬ä¸ƒè¯¾ ç»ƒä¹ é¢˜.pdf', 'PDF', '09/12/2015 - 21:05:54', '', '0'),
(63, 'å­™çª', 22, 'ç¬¬ä¸€å†Œç¬¬8è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬ä¸€å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬ä¸€å†Œç¬¬8è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', ' ç¬¬å…«è¯¾ ç»ƒä¹ é¢˜.pdf', 'PDF', '09/12/2015 - 21:05:39', '', '0'),
(64, 'å­™çª', 22, 'ç¬¬ä¸€å†Œç¬¬9è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬ä¸€å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬ä¸€å†Œç¬¬9è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', ' ç¬¬ä¹è¯¾ ç»ƒä¹ é¢˜.pdf', 'PDF', '09/12/2015 - 21:05:26', '', '0'),
(65, 'å­™çª', 22, 'ç¬¬ä¸€å†Œç¬¬2å•å…ƒæ€»å¤ä¹ ', 'ç¬¬ä¸€å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬ä¸€å†Œç¬¬2å•å…ƒæ€»å¤ä¹ ', '../teacher/teacher22', '.pdf', 'PDF', '09/12/2015 - 21:04:45', '', '0'),
(66, 'å­™çª', 22, 'ç¬¬ä¸€å†Œç¬¬11è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬ä¸€å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬ä¸€å†Œç¬¬11è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', ' ç¬¬åä¸€è¯¾ ç»ƒä¹ é¢˜.pdf', 'PDF', '09/12/2015 - 21:04:33', '', '0'),
(67, 'å­™çª', 22, 'ç¬¬ä¸€å†Œç¬¬12è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬ä¸€å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬ä¸€å†Œç¬¬12è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', ' ç¬¬åäºŒè¯¾ ç»ƒä¹ é¢˜.pdf', 'PDF', '09/12/2015 - 21:04:22', '', '0'),
(68, 'å­™çª', 22, 'ç¬¬ä¸€å†Œç¬¬13è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬ä¸€å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬ä¸€å†Œç¬¬13è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', ' ç¬¬åä¸‰è¯¾ ç»ƒä¹ é¢˜.pdf', 'PDF', '09/12/2015 - 21:04:07', '', '0'),
(69, 'å­™çª', 22, 'ç¬¬ä¸€å†Œç¬¬14è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬ä¸€å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬ä¸€å†Œç¬¬14è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', ' ç¬¬åå››è¯¾ ç»ƒä¹ é¢˜.pdf', 'PDF', '09/12/2015 - 21:03:52', '', '0'),
(70, 'å­™çª', 22, 'ç¬¬ä¸€å†Œç¬¬3å•å…ƒæ€»å¤ä¹ ', 'ç¬¬ä¸€å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬ä¸€å†Œç¬¬3å•å…ƒæ€»å¤ä¹ ', '../teacher/teacher22', '20150927083109_22.pdf', 'PDF', '09/27/2015 - 08:31:09', '', '0'),
(71, 'å­™çª', 22, 'ç¬¬ä¸€å†Œå£è¯•é¢˜', 'ç¬¬ä¸€å†Œ(æ–°ç‰ˆ)', 'è¯•å·', '2015-09-11', 'ç¬¬ä¸€å†Œå£è¯•é¢˜', '../teacher/teacher22', '20150926092145_22.pdf', 'PDF', '09/26/2015 - 09:21:45', '', '0'),
(72, 'å­™çª', 22, 'ç¬¬äºŒå†Œå£è¯•é¢˜', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'è¯•å·', '2015-09-11', 'ç¬¬äºŒå†Œå£è¯•é¢˜', '../teacher/teacher22', '20150926091847_22.pdf', 'PDF', '09/26/2015 - 09:18:47', '', '0'),
(73, 'å­™çª', 22, 'ç¬¬äºŒå†Œç¬¬2å•å…ƒè¯•é¢˜+å¬åŠ›æ–‡æœ¬', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'è¯•å·', '2015-09-11', 'ç¬¬äºŒå†Œç¬¬2å•å…ƒè¯•é¢˜+å¬åŠ›æ–‡æœ¬', '../teacher/teacher22', '+å¬åŠ›æ–‡æœ¬.pdf', 'PDF', '09/12/2015 - 21:03:21', '', '0'),
(74, 'å­™çª', 22, 'ç¬¬äºŒå†Œç¬¬3å•å…ƒè¯•é¢˜+å¬åŠ›æ–‡æœ¬', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'è¯•å·', '2015-09-11', 'ç¬¬äºŒå†Œç¬¬3å•å…ƒè¯•é¢˜+å¬åŠ›æ–‡æœ¬', '../teacher/teacher22', '+å¬åŠ›æ–‡æœ¬.pdf', 'PDF', '09/12/2015 - 20:59:15', '', '1'),
(75, 'å¾å˜‰è“‰', 27, 'HSKä¸‰çº§æ ·å·', 'HSK3', 'è¯•å·', '2015-09-11', 'HSKä¸‰çº§æ ·å· è¯•å·', '../teacher/teacher27', 'HSK3 shijuan.pdf', 'PDF', '09/11/2015 - 20:34:04', '', '0'),
(76, 'å¾å˜‰è“‰', 27, 'HSKä¸‰çº§æ ·å·', 'HSK3', 'è¯•å·', '2015-09-11', 'HSKä¸‰çº§æ ·å· ç­”æ¡ˆ', '../teacher/teacher27', 'HSK3 daan.pdf', 'PDF', '09/11/2015 - 20:34:42', '', '0'),
(77, 'å¾å˜‰è“‰', 27, 'HSKä¸‰çº§æ ·å·', 'HSK3', 'è¯•å·', '2015-09-11', 'HSKä¸‰çº§æ ·å· å¬åŠ›ææ–™', '../teacher/teacher27', 'HSK3 tingli.pdf', 'PDF', '09/11/2015 - 20:35:05', '', '0'),
(78, 'å¾å˜‰è“‰', 27, 'HSKå››çº§æ ·å·', 'HSK4', 'è¯•å·', '2015-09-11', 'HSKå››çº§æ ·å· è¯•å·', '../teacher/teacher27', 'HSK4 shijuan.pdf', 'PDF', '09/11/2015 - 20:35:52', '', '0'),
(79, 'å¾å˜‰è“‰', 27, 'HSKå››çº§æ ·å·', 'HSK4', 'è¯•å·', '2015-09-11', 'HSKå››çº§æ ·å· ç­”æ¡ˆ', '../teacher/teacher27', 'HSK4 daan.pdf', 'PDF', '09/11/2015 - 20:36:16', '', '0'),
(80, 'å¾å˜‰è“‰', 27, 'HSKå››çº§æ ·å·', 'HSK4', 'è¯•å·', '2015-09-11', 'HSKå››çº§æ ·å· å¬åŠ›ææ–™', '../teacher/teacher27', 'HSK4 tingli.pdf', 'PDF', '09/11/2015 - 20:36:36', '', '0'),
(81, 'å¾å˜‰è“‰', 27, 'HSKäº”çº§æ ·å·', 'HSK5', 'è¯•å·', '2015-09-11', 'HSKäº”çº§æ ·å· è¯•å·', '../teacher/teacher27', 'HSK5 shijuan.pdf', 'PDF', '09/11/2015 - 20:37:22', '', '0'),
(82, 'å¾å˜‰è“‰', 27, 'HSKäº”çº§æ ·å·', 'HSK5', 'è¯•å·', '2015-09-11', 'HSKäº”çº§æ ·å· ç­”æ¡ˆ', '../teacher/teacher27', 'HSK5 daan.pdf', 'PDF', '09/11/2015 - 20:37:40', '', '0'),
(83, 'å¾å˜‰è“‰', 27, 'HSKäº”çº§æ ·å·', 'HSK5', 'è¯•å·', '2015-09-11', 'HSKäº”çº§æ ·å· å¬åŠ›ææ–™', '../teacher/teacher27', 'HSK5 tingli.pdf', 'PDF', '09/11/2015 - 20:38:06', '', '0'),
(84, 'å¾å˜‰è“‰', 27, 'HSKä¸‰çº§è¯æ±‡', 'HSK3', 'èµ„æ–™', '2015-09-11', 'HSKä¸‰çº§ è¯æ±‡', '../teacher/teacher27', 'HSK3 cihui.pdf', 'PDF', '09/11/2015 - 20:39:34', '', '0'),
(85, 'å¾å˜‰è“‰', 27, 'HSKä¸‰çº§è¯æ±‡', 'HSK3', 'èµ„æ–™', '2015-09-11', 'HSKä¸‰çº§ è¯æ±‡ ä¸­æ³•å¯¹ç…§ç‰ˆ', '../teacher/teacher27', 'HSK3 cihui ch-fr.pdf', 'PDF', '09/11/2015 - 20:41:18', '', '0'),
(86, 'å­™çª', 22, 'ç¬¬äºŒå†Œç¬¬3å•å…ƒè¯•é¢˜+å¬åŠ›æ–‡æœ¬', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'è¯•å·', '2015-09-11', 'ç¬¬äºŒå†Œç¬¬3å•å…ƒè¯•é¢˜+å¬åŠ›æ–‡æœ¬', '../teacher/teacher22', '+å¬åŠ›æ–‡æœ¬.pdf', 'PDF', '09/12/2015 - 20:59:00', '', '0'),
(87, 'å¾å˜‰è“‰', 27, 'HSKå››çº§è¯æ±‡', 'HSK4', 'èµ„æ–™', '2015-09-11', 'HSKå››çº§ è¯æ±‡', '../teacher/teacher27', 'HSK4 cihui.pdf', 'PDF', '09/11/2015 - 20:42:38', '', '0'),
(88, 'å¾å˜‰è“‰', 27, 'HSKå››çº§è¯æ±‡', 'HSK4', 'èµ„æ–™', '2015-09-11', 'HSKå››çº§ è¯æ±‡ ä¸­æ³•å¯¹ç…§ç‰ˆ', '../teacher/teacher27', 'HSK4 cihui ch-fr.pdf', 'PDF', '09/11/2015 - 20:43:15', '', '0'),
(89, 'å¾å˜‰è“‰', 27, 'HSKä¸‰çº§ä¸“é¡¹ç»ƒä¹ ', 'HSK3', 'ç»ƒä¹ ', '2015-09-11', 'HSKä¸‰çº§ è¿žè¯æˆå¥ 100é¢˜', '../teacher/teacher27', 'HSK 3 liancichengju.pdf', 'PDF', '09/11/2015 - 20:45:07', '', '0'),
(90, 'å­™çª', 22, 'ç¬¬äºŒå†Œç¬¬1è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬äºŒå†Œç¬¬1è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', '.pdf', 'PDF', '09/12/2015 - 20:58:48', '', '0'),
(91, 'å­™çª', 22, 'ç¬¬äºŒå†Œç¬¬2è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬äºŒå†Œç¬¬2è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', '.pdf', 'PDF', '09/12/2015 - 20:58:32', '', '0'),
(92, 'å­™çª', 22, 'ç¬¬äºŒå†Œç¬¬3è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬äºŒå†Œç¬¬3è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', '.pdf', 'PDF', '09/12/2015 - 20:58:19', '', '0'),
(93, 'å­™çª', 22, 'ç¬¬äºŒå†Œç¬¬4è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬äºŒå†Œç¬¬4è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', '.pdf', 'PDF', '09/12/2015 - 20:58:08', '', '0'),
(94, 'å­™çª', 22, 'ç¬¬äºŒå†Œç¬¬1å•å…ƒæ€»å¤ä¹ ', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬äºŒå†Œç¬¬1å•å…ƒæ€»å¤ä¹ ', '../teacher/teacher22', '.pdf', 'PDF', '09/12/2015 - 20:57:54', '', '0'),
(95, 'å­™çª', 22, 'ç¬¬äºŒå†Œç¬¬6è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬äºŒå†Œç¬¬6è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', '.pdf', 'PDF', '09/12/2015 - 20:57:40', '', '0'),
(96, 'å­™çª', 22, 'ç¬¬äºŒå†Œç¬¬7è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬äºŒå†Œç¬¬7è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', '.pdf', 'PDF', '09/12/2015 - 20:57:30', '', '0'),
(97, 'å­™çª', 22, 'ç¬¬äºŒå†Œç¬¬8è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬äºŒå†Œç¬¬8è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', '.pdf', 'PDF', '09/12/2015 - 20:57:12', '', '0'),
(98, 'å­™çª', 22, 'ç¬¬äºŒå†Œç¬¬9è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬äºŒå†Œç¬¬9è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', '.pdf', 'PDF', '09/12/2015 - 20:56:56', '', '0'),
(99, 'å­™çª', 22, 'ç¬¬äºŒå†Œç¬¬2å•å…ƒæ€»å¤ä¹ ', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬äºŒå†Œç¬¬2å•å…ƒæ€»å¤ä¹ ', '../teacher/teacher22', '.pdf', 'PDF', '09/12/2015 - 20:56:44', '', '0'),
(100, 'å­™çª', 22, 'ç¬¬äºŒå†Œç¬¬11è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬äºŒå†Œç¬¬11è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', '.pdf', 'PDF', '09/12/2015 - 20:56:31', '', '0'),
(101, 'å­™çª', 22, 'ç¬¬äºŒå†Œç¬¬12è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬äºŒå†Œç¬¬12è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', '.pdf', 'PDF', '09/12/2015 - 20:56:15', '', '0'),
(102, 'å­™çª', 22, 'ç¬¬äºŒå†Œç¬¬13è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬äºŒå†Œç¬¬13è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', '.pdf', 'PDF', '09/12/2015 - 20:56:03', '', '0'),
(103, 'å­™çª', 22, 'ç¬¬äºŒå†Œç¬¬14è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬äºŒå†Œç¬¬14è¯¾è¡¥å……ç»ƒä¹ ', '../teacher/teacher22', '.pdf', 'PDF', '09/12/2015 - 20:55:48', '', '0'),
(104, 'å­™çª', 22, 'ç¬¬äºŒå†Œç¬¬3å•å…ƒæ€»å¤ä¹ ', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬äºŒå†Œç¬¬3å•å…ƒæ€»å¤ä¹ ', '../teacher/teacher22', '.pdf', 'PDF', '09/12/2015 - 20:55:28', '', '0'),
(105, 'å­™çª', 22, 'ç¬¬äºŒå†Œé‡è¯ç»ƒä¹ ', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-09-11', 'ç¬¬äºŒå†Œé‡è¯ç»ƒä¹ ', '../teacher/teacher22', '.pdf', 'PDF', '09/11/2015 - 20:55:53', '', '0'),
(106, 'å¾å˜‰è“‰', 27, 'YCT ä¸€çº§æ ·å·', 'YCT1', 'è¯•å·', '2015-09-11', 'YCTä¸€çº§ å…¨å¥—æ ·å·', '../teacher/teacher27', 'YCT 1.rar', '', '09/11/2015 - 21:28:38', '', '0'),
(107, 'å­™çª', 22, 'ç¬¬äºŒå†Œç»ƒä¹ å†Œä»¥å¤–è¡¥å……ç”Ÿå­—ç¬”ç”»+éƒ¨é¦–+æ‹¼éŸ³', 'ç¬¬äºŒå†Œ(æ–°ç‰ˆ)', 'èµ„æ–™', '2015-09-11', 'ç»ƒä¹ å†Œä»¥å¤–è¡¥å……ç”Ÿå­—ç¬”ç”»+éƒ¨é¦–+æ‹¼éŸ³', '../teacher/teacher22', '20150914102519_22.pdf', 'PDF', '09/14/2015 - 10:25:19', '', '0'),
(108, 'å­™çª', 22, 'ç¬¬ä¸€å†Œç»ƒä¹ å†Œä»¥å¤–è¡¥å……ç”Ÿå­—ç¬”ç”»+éƒ¨é¦–+æ‹¼éŸ³', 'ç¬¬ä¸€å†Œ(æ–°ç‰ˆ)', 'èµ„æ–™', '2015-09-11', 'ç»ƒä¹ å†Œä»¥å¤–è¡¥å……ç”Ÿå­—ç¬”ç”»+éƒ¨é¦–+æ‹¼éŸ³', '../teacher/teacher22', '20150914114524_22.pdf', 'PDF', '09/14/2015 - 11:45:24', '', '0'),
(109, 'æœ±åŒè´ž', 19, '', 'ç¬¬å…­å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-10-02', '', '../teacher/teacher19', '1è¯¾ç»ƒä¹ é¢˜.docx', 'DOC', '10/02/2015 - 11:17:26', '', '0'),
(110, 'æœ±åŒè´ž', 19, 'ç¬¬äºŒè¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬å…­å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-10-02', '', '../teacher/teacher19', '2è¯¾ç»ƒä¹ é¢˜.docx', 'DOC', '10/02/2015 - 11:18:29', '', '0'),
(111, 'æœ±åŒè´ž', 19, 'ç¬¬äºŒè¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬å…­å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-10-02', '', '../teacher/teacher19', '1è¯¾ç»ƒä¹ é¢˜.docx', 'DOC', '10/02/2015 - 13:14:04', '', '1'),
(112, 'æœ±åŒè´ž', 19, 'ç¬¬ä¸‰è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬å…­å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-10-02', '', '../teacher/teacher19', '3è¯¾ç»ƒä¹ é¢˜.docx', 'DOC', '10/02/2015 - 13:14:51', '', '0'),
(113, 'æœ±åŒè´ž', 19, 'ç¬¬ä¸€è¯¾è¡¥å……ç»ƒä¹ ', 'ç¬¬å…­å†Œ(æ–°ç‰ˆ)', 'ç»ƒä¹ ', '2015-10-02', '', '../teacher/teacher19', '1è¯¾ç»ƒä¹ é¢˜.docx', 'DOC', '10/02/2015 - 13:15:24', '', '0'),
(114, 'æ½˜å‡€', 13, 'ä¸­é«˜ç­é˜…è¯»æ–‡ç« ä¸€', 'è¯¾å¤–', 'é˜…è¯»', '2015-10-05', 'é’‰é’‰å­', '../teacher/teacher13', 'é’‰é’‰å­.pdf', 'PDF', '10/05/2015 - 10:14:52', '', '0'),
(115, 'æ½˜å‡€', 13, 'ä¸­é«˜ç­é˜…è¯»æ–‡ç« äºŒ', 'è¯¾å¤–', 'é˜…è¯»', '2015-10-05', 'ç ´æ°´æ¡¶çš„æ•…äº‹', '../teacher/teacher13', '20151005102010_13.pdf', 'PDF', '10/05/2015 - 10:20:25', '', '0'),
(116, 'æ½˜å‡€', 13, 'ä¸­é«˜ç­é˜…è¯»æ–‡ç« ä¸‰', 'è¯¾å¤–', 'é˜…è¯»', '2015-10-05', 'åªéœ€ååˆ†é’Ÿ', '../teacher/teacher13', '20151005102551_13.pdf', 'PDF', '10/05/2015 - 10:25:56', '', '0'),
(117, 'æ½˜å‡€', 13, 'ä¸­é«˜ç­é˜…è¯»æ–‡ç« å››', 'è¯¾å¤–', 'é˜…è¯»', '2015-10-05', 'ä¸­å›½è´§å¸', '../teacher/teacher13', '20151005102753_13.pdf', 'PDF', '10/05/2015 - 10:27:53', '', '0'),
(118, 'çŽ‹ä¼Ÿç', 12, 'æ•™å¸ˆåŸ¹è®­ææ–™', 'å…¶å®ƒ', 'èµ„æ–™', '2015-10-09', 'æ±‰å­—æ³¨æ‹¼éŸ³', '../teacher/teacher12', 'KTestpinyin.exe', '', '10/09/2015 - 12:17:30', '', '1'),
(119, 'çŽ‹ä¼Ÿç', 12, 'æ•™å¸ˆåŸ¹è®­ææ–™', 'å…¶å®ƒ', 'èµ„æ–™', '2015-10-09', 'å¤šéŸ³èŠ‚å­—æ‹¼éŸ³', '../teacher/teacher12', 'ppt.ppt', 'PPT', '10/09/2015 - 12:18:56', '', '1'),
(120, 'çŽ‹ä¼Ÿç', 12, 'æ•™å¸ˆåŸ¹è®­ææ–™', 'å…¶å®ƒ', 'èµ„æ–™', '2015-10-09', 'å•éŸ³èŠ‚å­—æ‹¼éŸ³', '../teacher/teacher12', 'ppt.ppt', 'PPT', '10/09/2015 - 12:19:36', '', '0'),
(121, 'çŽ‹ä¼Ÿç', 12, 'æ•™å¸ˆåŸ¹è®­ææ–™', 'å…¶å®ƒ', 'å…¶å®ƒ', '2015-10-09', 'å¤šéŸ³èŠ‚è¯', '../teacher/teacher12', 'ppt.ppt', 'PPT', '10/09/2015 - 12:44:56', '', '0'),
(122, 'çŽ‹ä¼Ÿç', 12, 'æ•™å¸ˆåŸ¹è®­ææ–™', 'å…¶å®ƒ', 'å…¶å®ƒ', '2015-10-09', 'çŽ°ä»£æ±‰è¯­è¯­éŸ³åŸºç¡€çŸ¥è¯†', '../teacher/teacher12', '[å…¼å®¹æ¨¡å¼].pdf', 'PDF', '10/09/2015 - 12:48:42', '', '0'),
(123, 'çŽ‹ä¼Ÿç', 12, 'æ•™å¸ˆåŸ¹è®­ææ–™', 'å…¶å®ƒ', 'å…¶å®ƒ', '2015-10-09', 'å£°è°ƒè¾©è¯', '../teacher/teacher12', '20151009125205_12.ppt', 'PPT', '10/09/2015 - 12:52:05', '', '0'),
(124, 'çŽ‹ä¼Ÿç', 12, 'æ•™å¸ˆåŸ¹è®­ææ–™', 'å…¶å®ƒ', 'å…¶å®ƒ', '2015-10-09', 'æ•™å­¦æ¡ˆä¾‹äº¤æµ', '../teacher/teacher12', 'BKX501äº¤æµç¨¿.DOC', 'DOC', '10/09/2015 - 12:57:36', '', '0'),
(125, 'çŽ‹ä¼Ÿç', 12, 'æ•™å¸ˆåŸ¹è®­ææ–™', 'å…¶å®ƒ', 'å…¶å®ƒ', '2015-10-09', 'å„¿ç«¥å¿ƒç†ä¸ŽåŽæ–‡å­¦ä¹ ', '../teacher/teacher12', '20151009130218_12.ppt', 'PPT', '10/09/2015 - 13:02:18', '', '0'),
(126, 'çŽ‹ä¼Ÿç', 12, 'æ•™å¸ˆåŸ¹è®­ææ–™', 'å…¶å®ƒ', 'å…¶å®ƒ', '2015-10-09', 'æ•™ææ•™æ³•è®²ä¹‰', '../teacher/teacher12', '110517æ•™ææ•™æ³•è®²ä¹‰.ppt', 'PPT', '10/09/2015 - 13:05:51', '', '0'),
(127, 'çŽ‹ä¼Ÿç', 12, 'æ•™å¸ˆåŸ¹è®­ææ–™', 'å…¶å®ƒ', 'å…¶å®ƒ', '2015-10-09', 'å¤‡è¯¾æŽ¢è®¨æ–‡ç« ', '../teacher/teacher12', '20151009130830_12.doc', 'DOC', '10/09/2015 - 13:08:30', '', '0'),
(128, 'çŽ‹ä¼Ÿç', 12, 'æ•™å¸ˆåŸ¹è®­ææ–™', 'å…¶å®ƒ', 'å…¶å®ƒ', '2015-10-09', 'æ±‰å­—æ³¨æ‹¼éŸ³', '../teacher/teacher12', 'KTestpinyin.exe', '', '10/09/2015 - 13:10:19', '', '1'),
(129, 'çŽ‹ä¼Ÿç', 12, 'æ•™å¸ˆåŸ¹è®­ææ–™', 'å…¶å®ƒ', 'å…¶å®ƒ', '2015-10-09', 'æ±‰å­—æ³¨æ‹¼éŸ³é™„ä»¶1', '../teacher/teacher12', 'Pinyin.dl_', '', '10/09/2015 - 13:10:37', '', '1'),
(130, 'çŽ‹ä¼Ÿç', 12, 'æ•™å¸ˆåŸ¹è®­ææ–™', 'å…¶å®ƒ', 'å…¶å®ƒ', '2015-10-09', 'æ±‰å­—æ³¨æ‹¼éŸ³é™„ä»¶2', '../teacher/teacher12', 'Pinyin.dll', '', '10/09/2015 - 13:10:50', '', '1'),
(131, 'çŽ‹ä¼Ÿç', 12, 'æ•™å¸ˆåŸ¹è®­ææ–™', 'å…¶å®ƒ', 'å…¶å®ƒ', '2015-10-09', 'æ±‰å­—æ³¨æ‹¼éŸ³é™„ä»¶3', '../teacher/teacher12', 'PY.dll', '', '10/09/2015 - 13:11:02', '', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
