-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2022 at 02:59 AM
-- Server version: 10.4.22-MariaDB
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
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `Book_id` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Author` text NOT NULL,
  `ISBN` text NOT NULL,
  `Genre` text NOT NULL,
  `Condition` text NOT NULL,
  `Book_image` text NOT NULL,
  `User_id` int(11) NOT NULL,
  `Status` text NOT NULL,
  `PhoneNumber` text DEFAULT NULL,
  `Email` text DEFAULT NULL,
  `Note` text DEFAULT NULL,
  `AddedDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`Book_id`, `Title`, `Author`, `ISBN`, `Genre`, `Condition`, `Book_image`, `User_id`, `Status`, `PhoneNumber`, `Email`, `Note`, `AddedDate`) VALUES
(6, 'Libertie', 'Kaitlyn Greenidge', '9780262000801', 'Fiction - Historical', 'New', 'gwilliam@gmail.com1647823020.jpg', 3, '1', '807-357-8249', 'gwilliam@gmail.com', 'The book can be picked up after 6.00PM', '2022-03-21 00:37:00'),
(7, 'Last Night at the Telegraph Club', 'Malinda Lo', '', 'Young Adult fiction', 'Decent', 'gwilliam@gmail.com1647823250.jpg', 3, '0', '807-357-8269', '', 'I am available after 7 pm if anyone wants to pick up the book. call me before you come', '2022-03-21 00:40:50'),
(8, 'Charlotte’s Web', 'E. B. White', '9780060006983', 'Fantasy', 'Decent', 'mscott1988@yahoo.com1647823738.jpg', 4, '0', '807-356-3458', 'mscott1988@yahoo.com', 'Call me if you are interested in this book.', '2022-03-21 00:48:58'),
(9, 'THE WAY OF ALL FLESH', 'Samuel Butler', '9780192829801', 'Autobiographical novel', 'New', 'mscott1988@yahoo.com1647824039.jpg', 4, '1', '807-356-8207', 'samfernado@gmail.com', 'This book is owned by one of my friends. You can contact him through the above email or phone number for the pickup details.  ', '2022-03-21 00:53:59'),
(10, 'Mother', 'Maxim Gorky', '', 'Novel', 'NotGreat', 'mscott1988@yahoo.com1647824246.jpg', 4, '1', '807-356-3458', 'mscott1988@yahoo.com', 'You can pick up the book on Sunday evening.', '2022-03-21 00:57:26'),
(11, 'Walt Disney: A Life From Beginning to End Paperback', 'Hourly History', '9781608008650', 'Nonfiction -Biography', 'Decent', 'mscott1988@yahoo.com1647824611.jpg', 4, '0', '807-356-3458', 'mscott1988@yahoo.com', '', '2022-03-21 01:03:31'),
(12, 'Booth', 'Karen Joy Fowler', '9781603094276', 'Fiction - Historical', 'Decent', 'nicksamson87@gmail.com1647824955.jpg', 5, '1', '647-356-3458', 'nicksamson87@gmail.com', 'Call me to discuss pickup details.', '2022-03-21 01:09:15'),
(13, 'The Barbizon: The Hotel That Set Women Free', 'Paulina Bren', '9781603093699', 'Nonfiction -Biography', 'Decent', 'nicksamson87@gmail.com1647825164.jpg', 5, '0', '647-356-3458', 'nicksamson87@gmail.com', '', '2022-03-21 01:12:44'),
(14, 'The Great Passion', 'James Runcie', '9780062829801', 'Historical Fiction', 'Decent', 'sjoseph@yahoo.com1647825713.jpg', 6, '0', '807-357-6489', '', 'The book can be picked up after 6.00 PM. Call me if anyone is interested. ', '2022-03-21 01:21:53'),
(15, 'The Women of Chateau Lafayette', 'Stephanie Dray', '9780262000801', 'Historical Fiction', 'Decent', 'sjoseph@yahoo.com1647825958.jpg', 6, '1', '647-356-3458', 'nicksamson87@gmail.com', 'The book can be picked up after 6.00 pm any weekday. ', '2022-03-21 01:25:58'),
(16, 'Seeking Fortune Elsewhere', 'Sindya Bhanoo', '9781603093750', 'Fiction -Short Story', 'Decent', 'sjoseph@yahoo.com1647826861.jpg', 6, '1', '807-357-6489', '', '', '2022-03-21 01:41:01'),
(17, 'Snow White and the Seven Dwarfs (Disney Classic)_new', 'RH Disney', '9781608088650', 'Fantasy', 'Decent', 'gwilliam@gmail.com1647827854.jpg', 3, '0', '416-356-3458', 'gwilliam@gmail.com', '', '2022-03-21 01:57:34');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `Query_id` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Email` text NOT NULL,
  `Message` text NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`Query_id`, `Name`, `Email`, `Message`, `Date`) VALUES
(1, 'Iresha Mudiyanselage', 'ire@yahoo.com', 'How can I contact the owner of the Book Mother', '2022-03-21 06:42:35'),
(2, 'Farjana Kamal', 'farjaKamal@gmail.com', 'Can you please tell me how this website is working? How can I add book to the site. ', '2022-03-21 06:43:51');

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
(2, 'I am unable to see the pickup information. Why is that?', 'You first need to login to see the pickup information.'),
(3, 'How should I take a book?', 'Contact the person that giving away a book through phone number or email they provided to discuss.'),
(4, 'How should I remove book?', 'You can remove the book from my inventory. Click on remove option.'),
(5, 'What is an ISBN?', 'ISBN stands for International Standard Book Number. You can find the ISBN on the back cover of the book near the bar code, or on the copyright page of the book.'),
(6, 'Do you rent textbooks?', 'Book Xchange does not currently offer a textbook rental program.'),
(7, 'How can I reset my Login and/or Password?', 'If you have forgotten your Username or Password, click the ‘Forgot your Password?’ link when logging in to kick-start the password recovery process. Follow the prompts to provide your email address and we will email your password details directly. If you encounter any further problems logging in, please do not hesitate to contact us.'),
(8, 'How do I make changes to my account details?', 'You can make changes to your account details at any time. Simply log in using your email address and password and select the ‘Edit Profile’ link at the top right of the home page. Once signed in, you can make the changes you need.');

-- --------------------------------------------------------

--
-- Table structure for table `registered_user`
--

CREATE TABLE `registered_user` (
  `User_id` int(11) NOT NULL,
  `UserName` text NOT NULL,
  `Password` text NOT NULL,
  `FirstName` text NOT NULL,
  `LastName` text NOT NULL,
  `PhoneNumber` text NOT NULL,
  `Email` text NOT NULL,
  `Address` text NOT NULL,
  `PostalCode` text NOT NULL,
  `Image` text NOT NULL,
  `Created_Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registered_user`
--

INSERT INTO `registered_user` (`User_id`, `UserName`, `Password`, `FirstName`, `LastName`, `PhoneNumber`, `Email`, `Address`, `PostalCode`, `Image`, `Created_Date`) VALUES
(1, 'iredilu', '25f9e794323b453885f5181f1b624d0b', 'Iresha', 'Mudiyanselage', '09865324526', 'ire@yahoo.com', '429, Frankwood, Avnue', 'P7B4R3', 'ire@yahoo.com1647312800.jfif', '2022-03-15 02:53:20'),
(2, 'sam_willi', '25f9e794323b453885f5181f1b624d0b', 'Sam', 'William', '807-357-8249', 'sam_willi@gmail.com', '429, Frankwood, Avnue', 'P7B4R3', 'sam_willi@gmail.com1647732576.jpg', '2022-03-19 23:29:36'),
(3, 'G_william76', '5a228c96a65ba383632c1ee156ef4dd3', 'Gorge', 'William', '416-356-3458', 'gwilliam@gmail.com', '38 Richmond Street West, Toronto, ON', 'M5V 3S6', 'gwilliam@gmail.com1647822813.jpg', '2022-03-21 00:33:33'),
(4, 'mscott1988', 'fe803346b8d732d7a6238c90b3ac083e', 'Michele', 'Scott', '807-356-3458', 'mscott1988@yahoo.com', '284 Lansdowne Avenue, Toronto, ON', 'M6H 3Y1', 'mscott1988@yahoo.com1647823433.jpg', '2022-03-21 00:43:53'),
(5, 'nicksamson87', '620537796698b8e6641a8a77693993c0', 'Nick', 'Samson', '647-356-3458', 'nicksamson87@gmail.com', '617, Lansdowne Ave, Toronto, ON', 'M6H 3Y2', 'nicksamson87@gmail.com1647824753.jpg', '2022-03-21 01:05:53'),
(6, 'josSteverock', '1fb899f96f825cb65940e645af29f37b', 'Steeve', 'Joseph', '807-357-6489', 'sjoseph@yahoo.com', '419 Frankwood Avenue, Thunder Bay, ON', 'P7B 4R3', 'sjoseph@yahoo.com1647825457.jpg', '2022-03-21 01:17:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`Book_id`),
  ADD KEY `User_id` (`User_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`Query_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`FAQ_id`);

--
-- Indexes for table `registered_user`
--
ALTER TABLE `registered_user`
  ADD PRIMARY KEY (`User_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `Book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `Query_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `FAQ_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `registered_user`
--
ALTER TABLE `registered_user`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `registered_user` (`User_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
