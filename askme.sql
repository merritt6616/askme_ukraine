-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 09, 2015 at 11:15 AM
-- Server version: 5.5.44-0ubuntu0.14.10.1
-- PHP Version: 5.5.12-2ubuntu4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `askme`
--

-- --------------------------------------------------------

--
-- Table structure for table `Answer`
--

CREATE TABLE IF NOT EXISTS `Answer` (
`id` int(11) NOT NULL,
  `answer_name` varchar(100) DEFAULT NULL,
  `answer_votes` int(11) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=104 ;

--
-- Dumping data for table `Answer`
--

INSERT INTO `Answer` (`id`, `answer_name`, `answer_votes`) VALUES
(93, 'Vielleicht', 0),
(94, 'Hund', 0),
(95, 'Katze', 2),
(96, 'Tiger', 0),
(97, 'Elefant', 0),
(98, 'Hamburger', 0),
(99, 'Spaghetti', 0),
(100, 'Pizza', 2),
(101, 'It''s awesome', 1),
(103, 'I dont really care', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Question`
--

CREATE TABLE IF NOT EXISTS `Question` (
`id` int(11) NOT NULL,
  `question_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `Question`
--

INSERT INTO `Question` (`id`, `question_name`) VALUES
(38, 'Was ist euer Lieblingstier?'),
(39, 'Was ist euer Lieblingsessen?'),
(40, 'How do you like the sea?');

-- --------------------------------------------------------

--
-- Table structure for table `Question_Answer`
--

CREATE TABLE IF NOT EXISTS `Question_Answer` (
`id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

--
-- Dumping data for table `Question_Answer`
--

INSERT INTO `Question_Answer` (`id`, `answer_id`, `question_id`) VALUES
(79, 94, 38),
(80, 95, 38),
(81, 96, 38),
(82, 97, 38),
(83, 98, 39),
(84, 99, 39),
(85, 100, 39),
(86, 101, 40),
(88, 103, 40);

-- --------------------------------------------------------

--
-- Table structure for table `Survey`
--

CREATE TABLE IF NOT EXISTS `Survey` (
`id` int(11) NOT NULL,
  `survey_name` varchar(45) DEFAULT NULL,
  `survey_theme` varchar(45) DEFAULT NULL,
  `survey_runtime` int(11) DEFAULT NULL,
  `survey_timestamp` int(11) DEFAULT NULL,
  `survey_activated` tinyint(1) DEFAULT '0',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `Survey`
--

INSERT INTO `Survey` (`id`, `survey_name`, `survey_theme`, `survey_runtime`, `survey_timestamp`, `survey_activated`, `user_id`) VALUES
(22, 'How do you like Odessa?', 'Summer school 2015', 1800, 1439110856, 0, 27);

-- --------------------------------------------------------

--
-- Table structure for table `Survey_Question`
--

CREATE TABLE IF NOT EXISTS `Survey_Question` (
`id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `Survey_Question`
--

INSERT INTO `Survey_Question` (`id`, `survey_id`, `question_id`) VALUES
(35, 22, 40);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
`id` int(11) NOT NULL,
  `user_firstname` varchar(45) DEFAULT NULL,
  `user_lastname` varchar(45) DEFAULT NULL,
  `user_username` varchar(45) DEFAULT NULL,
  `user_password` varchar(80) DEFAULT NULL,
  `user_isMaster` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `user_firstname`, `user_lastname`, `user_username`, `user_password`, `user_isMaster`) VALUES
(27, 'test', 'test', 'test', '$2y$13$p2Q1i3JM0nieIc7z21XvP.J5bCwEKb/WnUt5aRJMO8iJQuZ5W01jq', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Answer`
--
ALTER TABLE `Answer`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Question`
--
ALTER TABLE `Question`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Question_Answer`
--
ALTER TABLE `Question_Answer`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_answer` (`answer_id`), ADD KEY `fk_question` (`question_id`);

--
-- Indexes for table `Survey`
--
ALTER TABLE `Survey`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `umfrage_timestamp_UNIQUE` (`survey_timestamp`), ADD KEY `fk_Survey_User1_idx` (`user_id`);

--
-- Indexes for table `Survey_Question`
--
ALTER TABLE `Survey_Question`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_SQ_survey_idx` (`survey_id`), ADD KEY `fk_SQ_question_idx` (`question_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Answer`
--
ALTER TABLE `Answer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `Question`
--
ALTER TABLE `Question`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `Question_Answer`
--
ALTER TABLE `Question_Answer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT for table `Survey`
--
ALTER TABLE `Survey`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `Survey_Question`
--
ALTER TABLE `Survey_Question`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Question_Answer`
--
ALTER TABLE `Question_Answer`
ADD CONSTRAINT `Question_Answer_ibfk_1` FOREIGN KEY (`answer_id`) REFERENCES `Answer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Question_Answer_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `Question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Survey`
--
ALTER TABLE `Survey`
ADD CONSTRAINT `Survey_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Survey_Question`
--
ALTER TABLE `Survey_Question`
ADD CONSTRAINT `Survey_Question_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `Survey` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `Survey_Question_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `Question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
