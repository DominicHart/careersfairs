-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2017 at 03:40 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppm`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmark_event`
--

CREATE TABLE `bookmark_event` (
  `ID` int(11) NOT NULL,
  `euserID` int(11) NOT NULL,
  `eventID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookmark_event`
--

INSERT INTO `bookmark_event` (`ID`, `euserID`, `eventID`) VALUES
(17, 3, 17),
(22, 3, 18),
(23, 3, 20),
(40, 1, 18),
(41, 2, 17),
(42, 2, 20),
(43, 2, 18);

-- --------------------------------------------------------

--
-- Table structure for table `bookmark_information`
--

CREATE TABLE `bookmark_information` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `infoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookmark_information`
--

INSERT INTO `bookmark_information` (`ID`, `userID`, `infoID`) VALUES
(2, 1, 4),
(3, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eventID` int(11) NOT NULL,
  `Type` varchar(100) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Date` varchar(20) NOT NULL,
  `Time` varchar(20) NOT NULL,
  `Location` varchar(100) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventID`, `Type`, `Title`, `Date`, `Time`, `Location`, `Description`) VALUES
(17, 'Recruitment Event', 'Education Placement Showcase Yr 1 Students (Childhood Studies, Joint / Single Honours in Education)', '03/05/2017', '13:00 - 16:00', 'Clifton Campus - Teaching and Learning block 1-3pm CTLLT3 3-4pm CTLLT4', 'Employers attending this event have designed placements specifically for Childhood Studies and Joint / Single Honours in Education students. Get ahead and start planning your year two placement experience now!\r\n\r\nThis event is also suitable for students looking for volunteering opportunities.\r\n\r\nWednesday 3rd May\r\n\r\nEvent programme:\r\n\r\n1.00pm â€“ Event Registration & Introduction\r\n\r\n1.15pm â€“ Student Panel - Previous Placement Students\r\n\r\nPrevious placement students talk about their experiences in finding, securing and carrying out their placement. There will be a live Q&A and students will answer any questions you have. \r\n\r\n2.00-2.30pm â€“ Short Employer Presentations From\r\n\r\nInternChina https://internchina.com/\r\n\r\nInternChina is an award-winning organisation in the International Higher Education sector. Providing funded programmes to universities and government-funded organisations since 2007, InternChina have placed over 2000 students and recent graduates from countries all over the world in China. They aim to be an ethical, transparent and student-focused organisation, with a well-established and enthusiastic team, spread across the UK, Europe and 5 destinations in Greater China.\r\n\r\nPlan My Gap Year https://www.planmygapyear.co.uk/\r\n\r\nAn award-winning international volunteer placement organisation based in the UK. We provide safe, affordable, volunteer programmes overseas. Founded by volunteers for volunteers, we work with local communities in the developing world towards long-term sustainable goals. Destinations: Bail, Cambodia, Ghana, India, Morocco, Nepal, South Africa, Sri Lanka, Tanzania, Thailand, Vietnam. Placement Opportunities in these destinations.\r\n\r\nNational Justice Museum (previously Galleries of Justice) http://www.galleriesofjustice.org.uk/\r\n\r\nThe National Justice Museum are the only museum of its kind in Europe, home to the Villainous Sheriff of Nottingham and the only venue where you can discover Nottinghamâ€™s horrible history! The museum use actors, audio guides, guide sheets & boards, lighting, sounds, set dressing and exhibitions to explain the grim and gruesome history. Their aim is to educate, entertain and inform everyone who comes through the doors.\r\n\r\nCatch 22 (TBC) https://www.catch-22.org.uk/\r\n\r\nCatch 22 is a social business, a not for profit business with a social mission. For over 20 years they have designed and delivered services that build resilience and aspiration in people and communities. Today Catch 22 deliver childrenâ€™s social care, alternative education, apprenticeships and employability programmes, justice and rehabilitation services and personal and social development programmes.\r\n\r\n3.00pm â€“ Networking / marketplace\r\n\r\nEach employer will also have a stand in the networking area for you to have an informal chat with them when they are not presenting.\r\n\r\nThe Employability Team will also be present to help with any queries.'),
(18, 'Job Search', 'Find Your Sci Tech Placement', '02/05/2017', '14:00 - 16:00', 'Room 189 - Student Services Building - Clifton', 'Although the session runs for 2hours you can pop in anytime between 2pm-4pm, meet the Employability and Business Advisors and maximise your chances of finding and securing a summer or year-long placement.'),
(20, 'Recruitment Event', 'Pioneer and Beyond - Employer Presentation - City', '03/05/2017', '13:00 - 16:00', ' LT1 - Newton - City', 'Available Opportunities\r\n\r\nPioneer and Beyond invites NTU students from all courses to hear first-hand about their Graduate and Placement opportunities for 2017.\r\n\r\nAn excellent opportunity for you to get the inside track directly from this employer, who is looking to recruit NTU students into graduate and placement jobs. Pioneer and Beyond are interested all students and will take applications from any degree. These unique â€˜hiring nowâ€™, insight events explain the jobs and schemes on offer; what employers are looking for and how to maximise the impact of your application.\r\n\r\nWe are offering individuals the opportunity to teach English and open new frontiers and create gateways and pathways to the EAST. The vision of Pioneer and BEYOND is to be the global leader by providing native speakers the opportunity to access the EAST.\r\n\r\nWho are we?\r\n\r\nPioneer and Beyond perceive a new generation of individuals that are looking for opportunities and â€œout of the Boxâ€ discoveries and adding more to the meaning of life, by experiencing a unique teaching experience in China. Currently, we are seeking to attract individuals who want to skip from their current life, exploit a different world and fall in love with adventure. In addition, have a new start in life by learning Chinese and embracing a new culture and facing new challenges.');

-- --------------------------------------------------------

--
-- Table structure for table `event_maps`
--

CREATE TABLE `event_maps` (
  `mapID` int(11) NOT NULL,
  `eventRef` int(11) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_maps`
--

INSERT INTO `event_maps` (`mapID`, `eventRef`, `image`) VALUES
(1, 18, '590783005dc866.27056767.jpg'),
(3, 20, '5907836782cba0.09022968.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `eventID` int(11) NOT NULL,
  `whatdidyouthink` varchar(1000) NOT NULL,
  `whichemployers` varchar(1000) NOT NULL,
  `whowould` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackID`, `userID`, `eventID`, `whatdidyouthink`, `whichemployers`, `whowould`) VALUES
(8, 2, 17, 'It was well structured, a good variety of employers.', 'I really liked the nursery.', 'No one in-particular.'),
(9, 3, 20, 'It was good', '`Asda', 'Tesco');

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `infoID` int(11) NOT NULL,
  `Type` varchar(100) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `Date` varchar(20) NOT NULL,
  `Time` varchar(20) NOT NULL,
  `Location` varchar(200) NOT NULL,
  `Description` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`infoID`, `Type`, `Title`, `Date`, `Time`, `Location`, `Description`) VALUES
(4, 'General Information', 'Business Recruitment Fair', '27/07/2017', '09:00 - 16:00', 'Clifton Campus - Lee Westwood Sports Centre', 'The March Business recruitment fair will be held on the Clifton Campus in the Lee Westwood Sports Centre. The event will start at 9AM and run throughout the day with refreshments being provided. Employers will be advertising placements to make sure you bring along an updated CV to the event.'),
(5, 'Exhibitors', 'Exhibitors', '27/07/2017', '09:00 - 16:00', '09:00 Clifton Campus - Lee Westwood Sports Centre', 'Aldi Stores ltd, ASDA, ASOS, Boots Uk ltd, Bupa Health, Catipilar, CMZ, Debenhams PLC, Decathalon UK, JCB, McDonalds, Microsoft, Morrison PLC, Mothercare, Net Rail, Next Retail LTD, PWC, RSPB, Sainsbury&#39;s PLC');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `Username` varchar(8) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Fullname` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `level` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `Username`, `Email`, `Fullname`, `Password`, `level`) VALUES
(1, 'admin', 'admin@my.ntu.ac.uk', 'Administrator', '$2y$10$.i1qzRGEDa8XgXZl1172jersP0Fc2MeTIidyrZoJYyIsygBAa4o9C', 1),
(2, 'N0702543', 'n0702543@my.ntu.ac.uk', 'Dominic Hart', '$2y$10$odH9ASFiKxx.QR5ElhZyw.shskJ9p5TaDD6HW1mbf26Q46pl8f57.', 0),
(3, 'N0601040', 'n0601040@my.ntu.ac.uk', 'Jim Davies', '$2y$10$Dl6GwyVWOYCShMjRL/ruxu0FuQAcAnO4xxcqYsC4F5alZnA6lbJ/e', 0),
(4, 'tuser1', '', 'Test User1', '$2y$10$m.WYeIdSSgQo7RyQSX23v.5FCsdqV/zeuicexR8/8GNmg.oRbgD..', 0),
(5, 'tuser2', '', 'Test User2', '$2y$10$io/0N5tnGFXklyvKWfkfMOl5he3JWwoMn66pAq7deOwi2gJe1wE.a', 0),
(6, 'tuser3', '', 'Test User3', '$2y$10$uA.jnxIIXm6wnytgiUquPuZTokcQtgRNHbwcQYah58YofoV0IoEu2', 0),
(7, 'tuser4', '', 'Test User4', '$2y$10$XRG25zIFT8KtA/wIGXqyGuBY5K/rzFYbj0zLDJBP5dEhBcWloL9HW', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmark_event`
--
ALTER TABLE `bookmark_event`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`euserID`),
  ADD KEY `eventID` (`eventID`);

--
-- Indexes for table `bookmark_information`
--
ALTER TABLE `bookmark_information`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`,`infoID`),
  ADD KEY `infoID` (`infoID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventID`);

--
-- Indexes for table `event_maps`
--
ALTER TABLE `event_maps`
  ADD PRIMARY KEY (`mapID`),
  ADD KEY `eventRef` (`eventRef`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `eventID` (`eventID`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`infoID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmark_event`
--
ALTER TABLE `bookmark_event`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `bookmark_information`
--
ALTER TABLE `bookmark_information`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `event_maps`
--
ALTER TABLE `event_maps`
  MODIFY `mapID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `infoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmark_event`
--
ALTER TABLE `bookmark_event`
  ADD CONSTRAINT `bookmark_event_ibfk_1` FOREIGN KEY (`euserID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookmark_event_ibfk_2` FOREIGN KEY (`eventID`) REFERENCES `event` (`eventID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bookmark_information`
--
ALTER TABLE `bookmark_information`
  ADD CONSTRAINT `bookmark_information_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookmark_information_ibfk_2` FOREIGN KEY (`infoID`) REFERENCES `information` (`infoID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_maps`
--
ALTER TABLE `event_maps`
  ADD CONSTRAINT `event_maps_ibfk_1` FOREIGN KEY (`eventRef`) REFERENCES `event` (`eventID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`eventID`) REFERENCES `event` (`eventID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
