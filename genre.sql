-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 24, 2018 at 11:15 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `anime_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `show_id` int(50) NOT NULL,
  `genre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`show_id`, `genre`) VALUES
(1, 'Action'),
(1, 'Adventure'),
(1, 'Comedy'),
(1, 'Martial Arts'),
(1, 'Shounen'),
(1, 'Super Power'),
(2, 'Action'),
(2, 'Adventure'),
(2, 'Comedy'),
(2, 'Shounen'),
(2, 'Super Power'),
(2, 'Supernatural'),
(3, 'Action'),
(3, 'Adventure'),
(3, 'Comedy'),
(3, 'Fantasy'),
(3, 'Martial Arts'),
(3, 'Shounen'),
(3, 'Super Power'),
(4, 'Action'),
(4, 'Adventure'),
(4, 'Comedy'),
(4, 'Fantasy'),
(4, 'Martial Arts'),
(4, 'Shounen'),
(4, 'Super Power'),
(5, 'Action'),
(5, 'Adventure'),
(5, 'Comedy'),
(5, 'Mecha'),
(5, 'Sci-Fi'),
(6, 'Action'),
(6, 'Dementia'),
(6, 'Drama'),
(6, 'Mecha'),
(6, 'Psychological'),
(6, 'Sci-Fi'),
(7, 'Action'),
(7, 'Drama'),
(7, 'Mecha'),
(7, 'Military'),
(7, 'School'),
(7, 'Sci-Fi'),
(7, 'Super Power'),
(10, 'Action'),
(10, 'Drama'),
(10, 'Mecha'),
(10, 'Military'),
(10, 'Romance'),
(10, 'Sci-Fi'),
(10, 'Space'),
(11, 'Action'),
(11, 'Seinen'),
(12, 'Demons'),
(12, 'Magic'),
(12, 'Romance'),
(12, 'Shoujo'),
(13, 'Action'),
(13, 'Adventure'),
(13, 'Fantasy'),
(13, 'Game'),
(13, 'Romance'),
(14, 'Action'),
(14, 'Adventure'),
(14, 'Comedy'),
(14, 'Fantasy'),
(14, 'Kids'),
(15, 'Action'),
(15, 'Adventure'),
(15, 'Comedy'),
(15, 'Drama'),
(15, 'Fantasy'),
(15, 'Magic'),
(15, 'Military'),
(15, 'Shounen'),
(16, 'Action'),
(16, 'Adventure'),
(16, 'Comedy'),
(16, 'Drama'),
(16, 'Fantasy'),
(16, 'Shounen'),
(16, 'Super Power'),
(17, 'Action'),
(17, 'Comedy'),
(17, 'Ecchi'),
(17, 'School'),
(17, 'Super Power'),
(18, 'Action'),
(18, 'Adventure'),
(18, 'Comedy'),
(18, 'Fantasy'),
(18, 'Kids'),
(19, 'Music'),
(19, 'School'),
(19, 'Slice of Life'),
(20, 'Sci-Fi'),
(20, 'Thriller'),
(21, 'Mystery'),
(21, 'Psychological'),
(21, 'Seinen'),
(21, 'Supernatural'),
(22, 'Action'),
(22, 'Drama'),
(22, 'Fantasy'),
(22, 'Military'),
(22, 'Mystery'),
(22, 'Shounen'),
(22, 'Super Power'),
(23, 'Action'),
(23, 'Comedy'),
(23, 'Parody'),
(23, 'Sci-Fi'),
(23, 'Seinen'),
(23, 'Super Power'),
(23, 'Supernatural'),
(24, 'Action'),
(24, 'Fantasy'),
(24, 'Magic'),
(24, 'Supernatural'),
(25, 'Comedy'),
(25, 'School'),
(25, 'Shounen'),
(25, 'Sports'),
(26, 'Action'),
(26, 'Adventure'),
(26, 'Fantasy'),
(26, 'Magic'),
(26, 'Shounen'),
(27, 'Ecchi'),
(27, 'School'),
(27, 'Shounen'),
(28, 'Comedy'),
(28, 'Drama'),
(28, 'Romance'),
(28, 'Slice of Life'),
(28, 'Supernatural'),
(29, 'Drama'),
(29, 'Music'),
(29, 'Romance'),
(29, 'School'),
(29, 'Shounen'),
(30, 'Action'),
(30, 'Adventure'),
(30, 'Comedy'),
(30, 'Martial Arts'),
(30, 'Shounen'),
(30, 'Super Power'),
(31, 'Action'),
(31, 'Comedy'),
(31, 'School'),
(31, 'Shounen'),
(31, 'Super Power'),
(32, 'Comedy'),
(32, 'Drama'),
(32, 'School'),
(32, 'Shounen'),
(32, 'Sports'),
(33, 'Adventure'),
(33, 'Comedy'),
(33, 'Ecchi'),
(33, 'Fantasy'),
(33, 'Game'),
(33, 'Supernatural'),
(34, 'Action'),
(34, 'Comedy'),
(34, 'Shounen'),
(34, 'Sports'),
(35, 'Action'),
(35, 'Police'),
(35, 'Psychological'),
(35, 'Sci-Fi'),
(36, 'Drama'),
(36, 'Magic'),
(36, 'Psychological'),
(36, 'Thriller'),
(37, 'Mystery'),
(37, 'Police'),
(37, 'Psychological'),
(37, 'Shounen'),
(37, 'Supernatural'),
(37, 'Thriller'),
(38, 'Adventure'),
(38, 'Drama'),
(38, 'Mecha'),
(38, 'Romance'),
(38, 'Sci-Fi'),
(39, 'Action'),
(39, 'Drama'),
(39, 'Romance'),
(39, 'Sci-Fi'),
(39, 'Super Power'),
(40, 'Action'),
(40, 'Adventure'),
(40, 'Martial Arts'),
(40, 'Shounen'),
(40, 'Super Power'),
(41, 'Adventure'),
(41, 'Comedy'),
(41, 'Fantasy'),
(41, 'Martial Arts'),
(41, 'Shounen'),
(41, 'Super Power'),
(42, 'Action'),
(42, 'Military'),
(42, 'School'),
(42, 'Sports'),
(43, 'Adventure'),
(43, 'Comedy'),
(43, 'Fantasy'),
(43, 'Game'),
(43, 'Sci-Fi'),
(43, 'Shounen'),
(44, 'Action'),
(44, 'Adventure'),
(44, 'Shounen'),
(44, 'Supernatural'),
(44, 'Vampire'),
(45, 'Action'),
(45, 'Ecchi'),
(45, 'Super Power'),
(45, 'Supernatural'),
(46, 'Action'),
(46, 'Adventure'),
(46, 'Drama'),
(46, 'Fantasy'),
(46, 'Shounen'),
(47, 'Drama'),
(47, 'Slice of Life'),
(47, 'Supernatural'),
(48, 'Action'),
(48, 'Demons'),
(48, 'Fantasy'),
(48, 'Shounen'),
(48, 'Supernatural'),
(49, 'Mystery'),
(49, 'Romance'),
(49, 'Supernatural'),
(49, 'Vampire'),
(50, 'Action'),
(50, 'Adventure'),
(50, 'Comedy'),
(50, 'Sci-Fi'),
(50, 'Shounen'),
(50, 'Sports'),
(51, 'Adventure'),
(51, 'Comedy'),
(51, 'Sci-Fi'),
(51, 'Shounen'),
(51, 'Super Power'),
(52, 'Adventure'),
(52, 'Comedy'),
(52, 'Fantasy'),
(52, 'Supernatural'),
(53, 'Comedy'),
(53, 'Ecchi'),
(53, 'Sci-Fi'),
(53, 'Super Power'),
(53, 'Supernatural'),
(54, 'Action'),
(54, 'Mecha'),
(54, 'Sci-Fi'),
(55, 'Adventure'),
(55, 'Comedy'),
(55, 'Drama'),
(55, 'Fantasy'),
(55, 'Magic'),
(55, 'Romance'),
(55, 'School'),
(55, 'Shoujo'),
(56, 'Action'),
(56, 'Adventure'),
(56, 'Comedy'),
(56, 'Fantasy'),
(56, 'Shounen'),
(56, 'Supernatural'),
(57, 'Action'),
(57, 'Adventure'),
(57, 'Fantasy'),
(57, 'Magic'),
(57, 'Romance'),
(57, 'Shounen'),
(57, 'Supernatural'),
(58, 'Mystery'),
(58, 'Psychological'),
(58, 'School'),
(59, 'Comedy'),
(59, 'Drama'),
(59, 'Ecchi'),
(59, 'Romance'),
(59, 'Sci-Fi'),
(59, 'Seinen'),
(60, 'Comedy'),
(60, 'School'),
(60, 'Seinen'),
(60, 'Slice of Life'),
(61, 'Adventure'),
(61, 'Fantasy'),
(61, 'Historical'),
(61, 'Mystery'),
(61, 'Seinen'),
(61, 'Slice of Life'),
(61, 'Supernatural'),
(62, 'Action'),
(62, 'Drama'),
(62, 'Mecha'),
(62, 'Military'),
(62, 'Sci-Fi'),
(62, 'Space'),
(63, 'Comedy'),
(63, 'Slice of Life'),
(64, 'Action'),
(64, 'Adventure'),
(64, 'Historical'),
(64, 'Martial Arts'),
(64, 'Romance'),
(65, 'Comedy'),
(65, 'Drama'),
(65, 'Romance'),
(65, 'School'),
(65, 'Slice of Life'),
(66, 'Comedy'),
(66, 'Romance'),
(66, 'School'),
(66, 'Slice of Life'),
(67, 'Action'),
(67, 'Mystery'),
(67, 'Psychological'),
(67, 'Shounen'),
(67, 'Supernatural'),
(67, 'Thriller'),
(68, 'Comedy'),
(68, 'Sci-Fi'),
(68, 'Shounen'),
(68, 'Slice of Life'),
(69, 'Action'),
(69, 'Cars'),
(69, 'Drama'),
(69, 'Seinen'),
(69, 'Sports'),
(70, 'Comedy'),
(70, 'Ecchi'),
(70, 'Harem'),
(70, 'Romance'),
(70, 'School'),
(71, 'Comedy'),
(71, 'Romance'),
(71, 'School'),
(71, 'Shounen'),
(71, 'Slice of Life'),
(72, 'Action'),
(72, 'Drama'),
(72, 'Mecha'),
(72, 'Military'),
(72, 'Sci-Fi'),
(72, 'Space');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`show_id`,`genre`);
