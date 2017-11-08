-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 08, 2017 at 03:36 AM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tcp`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemId` tinyint(4) NOT NULL,
  `name` varchar(40) NOT NULL,
  `price` float NOT NULL,
  `item_category` int(11) NOT NULL,
  `item_ageGroup` int(11) NOT NULL,
  `itemDesc` varchar(120) NOT NULL,
  `color` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemId`, `name`, `price`, `item_category`, `item_ageGroup`, `itemDesc`, `color`) VALUES
(1, 'Dell Inspiron 11 3000', 249.99, 1, 4, 'Dell Inspiron Personal Laptop.', 'Black'),
(2, 'Apple iPad mini 4 Wi-Fi', 399.99, 1, 4, 'Apple iPad 4th Generation (Mini version).', 'Space Grey'),
(3, 'Nintendo Switch ', 299.99, 1, 4, 'Nintendo portable gaming platform with joycons.', 'Grey'),
(4, 'Apple EarPods', 29.99, 1, 4, 'Apple earbuds with 3mm jack connection.', 'White'),
(5, 'LeapFrog LeapStart Interactive Tablet', 24.99, 1, 2, 'Leapfrog interactive kids gaming tablet.', 'Yellow'),
(6, 'Amazon Echo Dot', 49.99, 1, 4, 'Amazon Echo (dot version).', 'Black'),
(7, 'Splatoon 2 Nintendo Switch', 56.99, 1, 3, 'Splatoon 2 video game for the Nintendo Switch.', 'Grey'),
(8, 'LeapStart Preschool Activity Book', 8.29, 1, 1, 'Leapfrog Preschool activity book for kids.', 'Green'),
(9, 'Mario + Rabbids Kingdom Battle', 59.99, 1, 3, 'Mario and Rabbids Kingdom Battle video game for the Nintendo Switch.', 'Grey'),
(10, 'Amazon Fire HD 8 Kids Edition', 129.99, 1, 2, 'Amazon Fire Tablet for kids.', 'Black'),
(11, 'Crest Kids Cavity Protection', 1.89, 2, 2, 'Crest Toothpaste for kids.', 'Blue'),
(12, 'U by Kotex Pantiliners', 5.59, 2, 4, 'U by Kotex.', 'White'),
(13, 'GoodNites Underwear for Boys', 24.99, 2, 1, 'Underwear for younger children.', 'White'),
(14, 'Vitafusion Women\'s Multivitamins', 9.79, 2, 4, 'Multivitamins for women, complete.', 'Various'),
(15, 'Clif Kid Zbar Organic Chocolate', 3.99, 2, 2, 'Cliff Bar for kids. Organic.', 'Brown'),
(16, 'First Response Pregnancy Test', 8.99, 2, 4, 'Pregnancy test with high accuracy.', 'White'),
(17, 'Boogie Wipes Saline Nose Wipes', 3.49, 2, 1, 'Saline nose wipes for nasal care.', 'White'),
(18, 'PreNatal Multivitamin', 7.89, 2, 4, 'Multivitamins for prenatal support.', 'Various'),
(19, 'Always Radiant Infinity Teen Pads', 6.99, 2, 3, 'Womens health products.', 'White'),
(20, 'Act Kids Spongebob Mouthwash', 3.49, 2, 2, 'Kids Spongebob mouthwash.', 'Blue'),
(21, 'Monopoly Stranger Things Game', 24.99, 3, 3, 'Monopoly board game featuring Stranger Things.', 'Black'),
(22, 'The Oregon Trail Card Game', 7.5, 3, 3, 'Oregon Trail card game with 100% more dysentery.', 'Black'),
(23, 'Craft City DIY Slime Kit', 17.99, 3, 3, 'Do-It-Yourself slime kit.', 'Green'),
(24, 'Playskool Friends Elmo', 19.99, 3, 1, 'An Elmo doll that you can set fire to.', 'Red'),
(25, 'Fisher-Price Laugh and Learn Puppy', 39.99, 3, 1, 'Laugh and learn puppy helps children learn.', 'Brown'),
(26, 'Munchkin Bath Crayons', 3.99, 3, 1, 'Crayons that work in the bathtub.', 'Various'),
(27, 'Cards Against Humanity', 25, 3, 4, 'Cards that make you question your life choices.', 'Black'),
(28, 'Hatchimals', 64.99, 3, 3, 'Eggs that hatch into stuffed animals.', 'Various'),
(29, 'My Little Pony Figurine', 2.49, 3, 2, 'My Little Pony dolls for kids of all ages, maybe.', 'Pink'),
(30, 'Pop the Pig Board Game', 9.99, 3, 3, 'Board game about popping pigs.', 'Black'),
(31, '8ok of 1 Fuzzy Socks', 4, 4, 1, 'Fuzzy socks to keep your feet warm.', 'Orange'),
(32, 'Women\'s I Want All the Candy Shirt', 9.08, 4, 4, 'You want the candy? We got the shirt.', 'Blue'),
(33, 'Girls Long Sleeve Woven Button Up', 12.74, 4, 3, 'Long sleeve woven button up for those cold days.', 'Brown'),
(34, 'Baby Plush Lamb Vest', 10, 4, 1, 'Plush lamb vest.', 'Grey'),
(35, 'Girls Long Sleeve Zipper Cat Mouth Dress', 7.48, 4, 3, 'Long sleeve zipper cat mouth dress for those feline feelings.', 'Black'),
(36, 'Halloween Hanging Lights', 10, 4, 4, 'Hanging spooky lights for Halloween.', 'Orange'),
(37, 'Men\'s Straight Leg Pants', 24.99, 4, 4, 'Pants for men.', 'Khaki'),
(38, 'Women\'s Crotchet High Shirt', 13.98, 4, 4, 'High top shirt for women.', 'Red'),
(39, 'Toddler Plush Leopard Costume', 12.5, 4, 1, 'Dress your toddler up as a leopard with this costume.', 'Yellow'),
(40, 'Girls Long Sleeve Zip Up', 9.98, 4, 3, 'Long sleeve zip up for girls.', 'Blue');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemId` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
