-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 15, 2022 at 04:49 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_exchange`
--

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `FAQ_id` int(11) NOT NULL,
  `Question` text NOT NULL,
  `Answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`FAQ_id`, `Question`, `Answer`) VALUES
(1, 'How does Book Exchanging work?', 'Type in the books you want to give away and take books you want to read instead.'),
(2, 'I am unable to see the pickup location. Why is that?', 'You first need to give away a book, in order to take book.'),
(3, 'How should I take a book?', 'Contact the person that giving away a book through phone number or email they provided to discuss.'),
(4, 'How should I take remove book?', 'You can remove the book from my inventory. Click on remove option. You can also put the username of the person that took your book and rate him.'),
(6, 'What is an ISBN?', 'ISBN stands for International Standard Book Number. You can find the ISBN on the back cover of the book near the bar code, or on the copyright page of the book.'),
(7, 'Do you rent textbooks?', 'Book Xchange does not currently offer a textbook rental program.'),
(8, 'How can I reset my Login and/or Password?', 'If you have forgotten your Username or Password, click the ‘Forgot your Password?’ link when logging in to kick-start the password recovery process. Follow the prompts to provide your email address and we will email your password details directly. If you encounter any further problems logging in, please do not hesitate to contact us.'),
(9, 'How do I make changes to my account details?', 'You can make changes to your account details at any time. Simply log in using your email address and password and select the ‘Edit Profile’ link at the top right of the home page. Once signed in, you can make the changes you need.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`FAQ_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `FAQ_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
