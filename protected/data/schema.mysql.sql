-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 03, 2013 at 09:48 AM
-- Server version: 5.1.70-cll
-- PHP Version: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `risshika_ogobaru`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `class` bigint(20) NOT NULL,
  `grade` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` bigint(20) NOT NULL,
  `attend` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `date`, `class`, `grade`, `student_id`, `teacher_id`, `attend`) VALUES
(1, '2013-05-09', 1, 5, 1, 2, 1),
(2, '2013-05-09', 1, 5, 2, 2, 1),
(3, '2013-05-09', 1, 5, 5, 2, 1),
(4, '2013-05-10', 1, 5, 1, 2, 1),
(5, '2013-05-10', 1, 5, 2, 2, 1),
(6, '2013-05-10', 1, 5, 5, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category_test_one`
--

CREATE TABLE IF NOT EXISTS `category_test_one` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `category_test_one`
--

INSERT INTO `category_test_one` (`id`, `category`) VALUES
(1, '+'),
(2, '-'),
(3, '*'),
(4, '/'),
(5, 'Check Test I'),
(6, 'Check Test II'),
(7, 'Check Test III'),
(8, 'Check Test IV'),
(9, 'Check Test V');

-- --------------------------------------------------------

--
-- Table structure for table `category_test_two`
--

CREATE TABLE IF NOT EXISTS `category_test_two` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `category_test_two`
--

INSERT INTO `category_test_two` (`id`, `category`) VALUES
(1, 'No Carry'),
(2, 'Carry'),
(3, 'Box & Carry'),
(4, 'Box & No Carry'),
(5, '筆算 carry'),
(6, '筆算 no carry'),
(7, '筆算C/D'),
(8, 'Type A'),
(9, 'Type B'),
(10, 'Type C');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` int(11) NOT NULL,
  `city_name` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `state`, `city_name`) VALUES
(1, 1, 'Surabaya'),
(2, 2, 'Semarang'),
(3, 3, '山口');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` varchar(10) NOT NULL,
  `grade` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `class`, `grade`, `school_id`) VALUES
(1, 'A', 5, 1),
(2, 'B', 5, 1),
(3, 'C', 5, 1),
(4, 'D', 5, 1),
(5, 'E', 5, 1),
(6, 'O2', 5, 1),
(7, 'N2', 5, 1),
(8, 'H2', 5, 1),
(9, 'aaa', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) COLLATE utf8_bin NOT NULL,
  `value` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `name`, `value`) VALUES
(1, 'tuition', 0x323030303030),
(2, 'book', 0x313030303030);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_category`
--

CREATE TABLE IF NOT EXISTS `evaluation_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evaluation` varchar(8) NOT NULL,
  `mistakes` int(11) NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE IF NOT EXISTS `grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grade` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(3, 'Student', 'Shogakusei'),
(4, 'Teacher', 'Sensei'),
(5, 'accounting', 'accounting'),
(6, 'parent', 'parent'),
(7, 'office1', 'Front Office');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) NOT NULL,
  `receiver_id` bigint(20) NOT NULL,
  `ammount` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `income_date` date NOT NULL,
  `payment_method` smallint(6) NOT NULL,
  `refferal_id` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `student_id`, `receiver_id`, `ammount`, `date`, `income_date`, `payment_method`, `refferal_id`) VALUES
(1, 1, 2, 1200000, '2013-05-13 03:58:11', '2013-07-01', 1, ''),
(2, 2, 2, 800000, '2013-05-13 05:22:06', '0000-00-00', 4, ''),
(3, 2, 2, 400000, '2013-05-13 05:30:16', '2013-05-20', 4, '5049000'),
(4, 3, 6, 400000, '2013-07-30 06:35:49', '0000-00-00', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `ammount` int(11) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `refferal_id` varchar(50) COLLATE utf8_bin NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `income_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=15 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `student_id`, `year`, `month`, `ammount`, `paid`, `payment_method`, `refferal_id`, `payment_date`, `income_date`) VALUES
(1, 1, 2013, 5, 200000, 1, 1, '', '2013-05-12 17:00:00', '0000-00-00'),
(2, 1, 2013, 6, 200000, 1, 1, '', '2013-05-12 17:00:00', '0000-00-00'),
(3, 1, 2013, 7, 200000, 1, 1, '', '2013-05-12 17:00:00', '0000-00-00'),
(4, 1, 2013, 8, 200000, 1, 1, '', '2013-05-12 17:00:00', '0000-00-00'),
(5, 1, 2013, 9, 200000, 1, 1, '', '2013-05-12 17:00:00', '0000-00-00'),
(6, 1, 2013, 10, 200000, 1, 1, '', '2013-05-12 17:00:00', '0000-00-00'),
(7, 2, 2013, 5, 300000, 1, 4, '', '2013-05-12 17:00:00', '0000-00-00'),
(8, 2, 2013, 6, 300000, 1, 4, '', '2013-05-12 17:00:00', '0000-00-00'),
(9, 2, 2013, 7, 300000, 1, 4, '', '2013-05-12 17:00:00', '0000-00-00'),
(10, 2, 2013, 8, 300000, 1, 4, '', '2013-05-12 17:00:00', '0000-00-00'),
(11, 2, 2013, 9, 300000, 1, 4, '5049000', '2013-05-12 17:00:00', '0000-00-00'),
(12, 2, 2013, 10, 300000, 1, 4, '5049000', '2013-05-12 17:00:00', '0000-00-00'),
(13, 3, 2013, 4, 300000, 1, 1, '1', '2013-07-29 17:00:00', '0000-00-00'),
(14, 3, 2013, 5, 300000, 1, 1, '1', '2013-07-29 17:00:00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE IF NOT EXISTS `school` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `category_school` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `level_of_school` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `school_name`, `category_school`, `state`, `city`, `level_of_school`) VALUES
(1, 'Kaliasin', 1, 1, 1, 1),
(2, '東方不敗', 2, 1, 1, 1),
(3, 'Risshikan RMI', 1, 1, 1, 1),
(4, 'Puncak Permai', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `school_category`
--

CREATE TABLE IF NOT EXISTS `school_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_of_school` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `school_category`
--

INSERT INTO `school_category` (`id`, `category_of_school`) VALUES
(1, 'Pilot'),
(2, 'Control');

-- --------------------------------------------------------

--
-- Table structure for table `school_level`
--

CREATE TABLE IF NOT EXISTS `school_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_level` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `school_level`
--

INSERT INTO `school_level` (`id`, `school_level`) VALUES
(1, 'SD'),
(2, 'SMP');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `state_name`) VALUES
(1, 'Jawa TImur'),
(2, 'Jawa Barat'),
(3, 'fff');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `student_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `school_id` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `home_address` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `emergency_adress` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `emergency_telephone` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `parent_job` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `income_level` int(11) NOT NULL,
  `date_enter` date NOT NULL,
  `grade_enter` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `absence_number` int(11) NOT NULL,
  `student_nick_name` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `gender` int(11) NOT NULL,
  `date_of_birth` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `school_id` (`school_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `parent_id`, `student_name`, `school_id`, `grade`, `class`, `home_address`, `emergency_adress`, `emergency_telephone`, `parent_job`, `income_level`, `date_enter`, `grade_enter`, `urutan`, `absence_number`, `student_nick_name`, `gender`, `date_of_birth`) VALUES
(1, 8, 'jonathan joestar', 1, 5, 1, '', '', '', '', 1, '2004-05-05', 5, 1, 12, 'jojo', 1, '2004-05-05'),
(2, 8, 'George Joestar', 1, 5, 1, '', '', '', '', 0, '2013-05-05', 5, 2, 11, 'jojo', 1, '2013-05-05'),
(3, 0, 'hideyoshi', 2, 5, 9, '', '', '', '', 0, '2013-04-01', 5, 1, 21, 'aaa', 0, '2013-05-12'),
(4, 0, '杉田　ジロ', 1, 1, 3, '', '', '', '', 1, '0000-00-00', 1, 1, 9, '??', 1, '01/05/2004'),
(5, 0, 'l-elf', 1, 5, 1, '', '', '', '', 0, '2013-05-05', 5, 4, 11, 'l-elf', 1, '2002-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `email`) VALUES
(22, 'admin', 'admin', 'admin@admin.adm');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_one` int(11) NOT NULL,
  `category_two` int(11) NOT NULL,
  `date` date NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `number_of_question` int(11) NOT NULL,
  `time_limit` int(11) NOT NULL,
  `time_counted` time NOT NULL,
  `mistakes` int(11) NOT NULL,
  `time_predicted` time NOT NULL,
  `evaluation_category` int(11) NOT NULL,
  `school` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `category_one`, `category_two`, `date`, `exercise_id`, `number_of_question`, `time_limit`, `time_counted`, `mistakes`, `time_predicted`, `evaluation_category`, `school`, `grade`, `student`) VALUES
(1, 1, 2, '2013-03-24', 1, 50, 420, '00:01:00', 0, '00:01:00', 1, 1, 5, 1),
(2, 1, 5, '2013-03-27', 0, 44, 420, '00:00:00', 0, '00:00:00', 0, 1, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `test_result`
--

CREATE TABLE IF NOT EXISTS `test_result` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) NOT NULL,
  `class_id` bigint(20) NOT NULL,
  `test_id` bigint(20) NOT NULL,
  `answered` int(11) NOT NULL,
  `mistake` int(11) NOT NULL,
  `time_minute` int(11) NOT NULL,
  `time_second` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `test_result`
--

INSERT INTO `test_result` (`id`, `student_id`, `class_id`, `test_id`, `answered`, `mistake`, `time_minute`, `time_second`) VALUES
(1, 1, 1, 1, 23, 12, 10, 3),
(2, 2, 1, 1, 23, 6, 10, 4),
(3, 1, 1, 2, 20, 3, 5, 7),
(4, 2, 1, 2, 20, 1, 5, 10),
(5, 3, 2, 1, 23, 12, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `activation_code` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `forgotten_password_code` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '\0\0', 'administrator', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1353593136, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '\0\0\0\0', 'kharisma muchammad', '33ec966efaf6d4af1c5335adfbbfad40', NULL, 'greyroot00@gmail.com', NULL, NULL, NULL, NULL, 1353592389, 1362205358, 1, 'kharisma', 'muchammad', '', '--'),
(6, '', 'restuadi studiawan', '202cb962ac59075b964b07152d234b70', NULL, 'ewaru@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '', 'Mie', 'd41d8cd98f00b204e9800998ecf8427e', NULL, 'm.tanino@osaka-kyoiku.co.jp', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(6, 6, 1),
(7, 6, 4),
(8, 7, 5),
(9, 8, 6),
(10, 9, 5),
(11, 9, 7),
(12, 10, 1),
(13, 10, 5),
(14, 10, 7);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`) ON DELETE NO ACTION;
