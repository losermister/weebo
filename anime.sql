-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 26, 2018 at 11:44 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anime`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `video_url` varchar(255) NOT NULL,
  `comment_body` text NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `email`, `video_url`, `comment_body`, `date_added`) VALUES
(1, 'ngmandyn@sfu.ca', 'http://embed.animetv.to/streaming.php?id=Mjk3Ng', 'Bestest show ever!', '2018-03-26 14:04:40');

-- --------------------------------------------------------

--
-- Table structure for table `favourite_shows`
--

CREATE TABLE `favourite_shows` (
  `email` varchar(255) NOT NULL,
  `show_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favourite_shows`
--

INSERT INTO `favourite_shows` (`email`, `show_id`) VALUES
('ngmandyn@sfu.ca', 12),
('ngmandyn@sfu.ca', 14);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `show_id` int(11) NOT NULL,
  `genre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`show_id`, `genre`) VALUES
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
(45, 'Action'),
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

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `show_id` int(11) NOT NULL,
  `episode_num` int(11) NOT NULL,
  `video_url` varchar(255) NOT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`show_id`, `episode_num`, `video_url`, `date_added`) VALUES
(62, 1, 'http//vidstreaming.io/embed.php?id=NzEzMDA&typesub=SUB', '2017-07-08'),
(14, 1, 'http://embed.animetv.to/streaming.php?id=Mjk3Ng', '2018-03-25'),
(6, 1, 'http://embed.animetv.to/streaming.php?id=MjY3ODk', '2018-03-25'),
(11, 1, 'http://embed.animetv.to/streaming.php?id=MTA2NDQ', '2018-03-25'),
(15, 1, 'http://embed.animetv.to/streaming.php?id=MTY0MDE', '2018-03-25'),
(13, 1, 'http://embed.animetv.to/streaming.php?id=MzkzNDQ', '2018-03-25'),
(16, 1, 'http://embed.animetv.to/streaming.php?id=MzUxOA', '2018-03-25'),
(12, 1, 'http://embed.animetv.to/streaming.php?id=MzUzNDY', '2018-03-25'),
(68, 1, 'http://entervideo.net/watch/51a6abdb5fd8138', '2017-07-08'),
(45, 1, 'http://play.animeplus.tv/?vid=11eyes/11eyes-01.flv', '2018-03-26'),
(51, 1, 'http://play.animeplus.tv/?vid=Black-Cat/Black-Cat-01.flv', '2018-03-26'),
(34, 1, 'http://play.animeplus.tv/?vid=Eyeshield-21/Eyeshield-21-001.flv', '2018-03-25'),
(10, 1, 'http://play.animeplus.tv/?vid=Gundam-Seed/Gundam-Seed-01.flv', '2018-03-25'),
(43, 1, 'http://play.animeplus.tv/?vid=Hack-Legend-Of-The-Twilight/Hack-Legend-Of-The-Twilight-01.flv', '2018-03-26'),
(61, 1, 'http://play.animeplus.tv/?vid=Mushishi/Mushishi-01.flv', '2018-03-26'),
(22, 1, 'http://play.animeplus.tv/?vid=ongoing/shingeki_no_kyojin_-_01.mp4', '2018-03-25'),
(57, 1, 'http://play.animeplus.tv/?vid=Tsubasa-Reservoir-Chronicle/Tsubasa-Reservoir-Chronicle-01.flv', '2018-03-26'),
(46, 1, 'http://s3.videozoo.me/akame_ga_kill_-_01.mp4?st=W_9JkqgHIv8HWr-Ito9xEA&e=1522056652&start=0', '2018-03-26'),
(21, 1, 'http://s4.videozoo.me/B/boku_dake_ga_inai_machi_-_01.mp4?st=SWyFyFfduwYC2Ys5F6tHow&e=1522052844&start=0', '2018-03-25'),
(31, 1, 'http://s4.videozoo.me/B/boku_no_hero_academia_-_01.mp4?st=fTgAlLH4Fn0RZsCjXAjjGA&e=1522054549&start=0', '2018-03-25'),
(7, 1, 'http://s7.videozoo.me/at_code_geass_lelouch_of_the_rebellion_-_01.mp4?st=laklKvWSfJuKHXnIF9Afsw&e=1522023617&start=0', '2018-03-25'),
(3, 1, 'http://s9.videozoo.me/D/new_dragon_ball_super_-_03.mp4?st=SeApqmpCfAMaucKsCDbxPg&e=1522022447&start=0', '2018-03-25'),
(58, 1, 'http://videozoo.gogoanime.to/index.php?vid=at/nw/at_danganronpa_the_animation_-_01.mp4', '2018-03-26'),
(23, 1, 'http://videozoo.gogoanime.to/index.php?vid=at/nw/one-punch_man_-_01_official.mp4', '2018-03-25'),
(53, 1, 'http://videozoo.gogoanime.to/index.php?vid=at/nw/punchline_-_01.mp4', '2018-03-26'),
(70, 1, 'http://videozoo.gogoanime.to/index.php?vid=at/nw/saenai_heroine_no_sodatekata_-_01.mp4', '2018-03-26'),
(62, 1, 'http://vidstreaming.io/embed.php?id=MjE3MTE&typesub=SUB', '2017-07-08'),
(67, 1, 'http://vidstreaming.io/embed.php?id=Mjg0NTY&typesub=SUB', '2017-07-08'),
(17, 2, 'http://vidstreaming.io/embed.php?id=Mjg3MjA&typesub=SUB', '2017-06-30'),
(17, 1, 'http://vidstreaming.io/embed.php?id=Mjg3MTk&typesub=SUB', '2017-06-30'),
(66, 1, 'http://vidstreaming.io/embed.php?id=Mjk4Mjg&typesub=SUB', '2017-07-08'),
(63, 1, 'http://vidstreaming.io/embed.php?id=MjkzMzM&typesub=SUB', '2017-07-08'),
(1, 3, 'http://vidstreaming.io/embed.php?id=MjUwNTg&typesub=SUB', '2017-06-17'),
(1, 1, 'http://vidstreaming.io/embed.php?id=MjUwNTQ&typesub=SUB', '2017-06-17'),
(1, 2, 'http://vidstreaming.io/embed.php?id=MjUwNTY&typesub=SUB', '2017-06-17'),
(38, 1, 'http://vidstreaming.io/embed.php?id=MTc4OTM&typesub=SUB', '2017-06-30'),
(38, 2, 'http://vidstreaming.io/embed.php?id=MTc4OTQ&typesub=SUB', '2017-06-30'),
(42, 1, 'http://vidstreaming.io/embed.php?id=MTc5MzQ&typesub=SUB', '2017-07-08'),
(55, 1, 'http://vidstreaming.io/embed.php?id=MTEwNjc&typesub=SUB', '2018-03-25'),
(2, 1, 'http://vidstreaming.io/embed.php?id=MTEwNjk&typesub=SUB', '2017-06-30'),
(66, 1, 'http://vidstreaming.io/embed.php?id=MTk4NjI&typesub=SUB', '2017-07-13'),
(24, 1, 'http://vidstreaming.io/embed.php?id=MTUyOTA&typesub=SUB', '2017-06-30'),
(64, 1, 'http://vidstreaming.io/embed.php?id=MTY0MDE&typesub=SUB', '2017-07-10'),
(20, 1, 'http://vidstreaming.io/embed.php?id=MzgzMTc&typesub=SUB', '2017-07-08'),
(25, 1, 'http://vidstreaming.io/embed.php?id=MzI4ODg&typesub=SUB', '2017-07-08'),
(63, 1, 'http://vidstreaming.io/embed.php?id=MzkzNDQ&typesub=SUB', '2017-07-10'),
(19, 3, 'http://vidstreaming.io/embed.php?id=MzQ0MjI&typesub=SUB', '2017-07-01'),
(19, 2, 'http://vidstreaming.io/embed.php?id=MzQ0MjM&typesub=SUB', '2017-07-01'),
(19, 1, 'http://vidstreaming.io/embed.php?id=MzQ0MjQ&typesub=SUB', '2017-07-01'),
(5, 1, 'http://vidstreaming.io/embed.php?id=MzUxNTk&typesub=SUB', '2017-07-08'),
(29, 1, 'http://vidstreaming.io/embed.php?id=NDc4Njk&typesub=SUB', '2017-06-30'),
(47, 4, 'http://vidstreaming.io/embed.php?id=NDI3MDc&typesub=SUB', '2017-07-03'),
(47, 5, 'http://vidstreaming.io/embed.php?id=NDI3MDg&typesub=SUB', '2017-07-03'),
(47, 6, 'http://vidstreaming.io/embed.php?id=NDI3MDk&typesub=SUB', '2017-07-03'),
(47, 1, 'http://vidstreaming.io/embed.php?id=NDI3MDM&typesub=SUB', '2017-07-03'),
(47, 2, 'http://vidstreaming.io/embed.php?id=NDI3MDU&typesub=SUB', '2017-07-03'),
(47, 3, 'http://vidstreaming.io/embed.php?id=NDI3MDY&typesub=SUB', '2017-07-03'),
(47, 7, 'http://vidstreaming.io/embed.php?id=NDI3MTA&typesub=SUB', '2017-07-03'),
(47, 8, 'http://vidstreaming.io/embed.php?id=NDI3MTE&typesub=SUB', '2017-07-03'),
(47, 9, 'http://vidstreaming.io/embed.php?id=NDI3MTI&typesub=SUB', '2017-07-03'),
(47, 10, 'http://vidstreaming.io/embed.php?id=NDI3MTM&typesub=SUB', '2017-07-03'),
(47, 11, 'http://vidstreaming.io/embed.php?id=NDI3MTQ&typesub=SUB', '2017-07-03'),
(32, 1, 'http://vidstreaming.io/embed.php?id=NDI3NjY&typesub=SUB', '2017-07-08'),
(33, 1, 'http://vidstreaming.io/embed.php?id=NDI3NzY&typesub=SUB', '2017-06-30'),
(33, 2, 'http://vidstreaming.io/embed.php?id=NDI5NDc&typesub=SUB', '2017-06-30'),
(60, 1, 'http://vidstreaming.io/embed.php?id=NjM5Mjc&typesub=SUB', '2017-07-07'),
(49, 2, 'http://vidstreaming.io/embed.php?id=NjQ3Mg&typesub=SUB', '2017-07-02'),
(49, 1, 'http://vidstreaming.io/embed.php?id=NjQ3MQ&typesub=SUB', '2017-07-02'),
(27, 1, 'http://vidstreaming.io/embed.php?id=NTIyMjg&typesub=SUB', '2017-07-01'),
(27, 2, 'http://vidstreaming.io/embed.php?id=NTM3MzE&typesub=SUB', '2017-07-01'),
(40, 1, 'http://vidstreaming.io/embed.php?id=OTc2MzI&typesub=SUB', '2017-07-07'),
(64, 1, 'http://www.mp4upload.com/embed-lxldvq4d5us1-712x445.html', '2017-07-08'),
(50, 1, 'http://www.video44.net/gogo/new/?w=712&h=445&vid=beyblade-01.flv', '2018-03-26'),
(52, 1, 'http://www.video44.net/gogo/new/?w=712&h=445&vid=blue_dragon_tenkai_no_shichi_ryuu_-_01.flv', '2018-03-26'),
(37, 1, 'http://www.video44.net/gogo/new/?w=712&h=445&vid=deathnote-01.flv', '2018-03-26'),
(69, 1, 'http://www.video44.net/gogo/new/?w=712&h=445&vid=initiald1ststage-01.flv', '2018-03-26'),
(26, 1, 'http://www.video44.net/gogo/new/?w=712&h=445&vid=magi_the_kingdom_of_magic_-_01.mp4', '2018-03-25'),
(36, 1, 'http://www.video44.net/gogo/new/?w=712&h=445&vid=mahoushoujomadokamagica-01.flv', '2018-03-25'),
(65, 1, 'http://www.video44.net/gogo/new/?w=712&h=445&vid=oregairu_-_01.flv', '2018-03-26'),
(35, 1, 'http://www.video44.net/gogo/new/?w=712&h=445&vid=psycho-pass_-_01.flv', '2018-03-25'),
(48, 1, 'https://oload.site/embed/QjQIgw7-goY/', '2018-03-26'),
(71, 1, 'https://vidlox.me/embed-x0dn1yfw316o.html', '2018-03-26'),
(18, 1, 'https://www.mp4upload.com/embed-6wfkmhnxlqrq-712x445.html', '2018-03-25'),
(28, 1, 'https://www.mp4upload.com/embed-g2s0mcu4tp62-712x445.html', '2018-03-25'),
(72, 1, 'https://www.mp4upload.com/embed-lfb5rvdouepr-712x445.html', '2018-03-26'),
(59, 1, 'https://www.mp4upload.com/embed-lyrcga6ccqu2-712x445.html', '2018-03-26'),
(4, 1, 'https://www.mp4upload.com/embed-mtfccbfqhqds-712x445.html', '2018-03-25'),
(41, 1, 'https://www.mp4upload.com/embed-sym8rk6c8ll3-712x445.html', '2018-03-26'),
(56, 1, 'https://www.mp4upload.com/embed-xiojfa2hy6e8-712x445.html', '2018-03-26'),
(54, 1, 'https://www.mp4upload.com/embed-yvy475r5kfqk-712x445.html', '2018-03-26'),
(39, 1, 'https://www.mp4upload.com/embed-zbaoa7b0o765-712x445.html', '2018-03-26'),
(30, 1, 'videozoo.me/embed.php?w=712&h=445&vid=at/nw/naruto_shippuuden_-_1-2x.mp4', '2018-03-25'),
(40, 8, 'vidstreaming.io/embed.php?id=OTc2MzI&typesub=SUB', '2017-07-07');

-- --------------------------------------------------------

--
-- Table structure for table `oso_slope_one`
--

CREATE TABLE `oso_slope_one` (
  `show_id1` int(11) NOT NULL,
  `show_id2` int(11) NOT NULL,
  `times` int(11) NOT NULL,
  `rating` decimal(14,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oso_user_ratings`
--

CREATE TABLE `oso_user_ratings` (
  `email` varchar(255) NOT NULL,
  `show_id` int(11) NOT NULL,
  `rating` decimal(14,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oso_user_ratings`
--

INSERT INTO `oso_user_ratings` (`email`, `show_id`, `rating`) VALUES
('losermister@gmail.com', 10, '10.0000'),
('losermister@gmail.com', 14, '2.0000'),
('losermister@gmail.com', 62, '9.0000'),
('losermister@gmail.com', 72, '8.0000'),
('ngmandyn@gmail.com', 15, '8.0000'),
('ngmandyn@gmail.com', 28, '9.0000'),
('ngmandyn@sfu.ca', 12, '10.0000'),
('ngmandyn@sfu.ca', 14, '10.0000');

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE `shows` (
  `show_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `bg_img` text NOT NULL,
  `description` text NOT NULL,
  `banner_img` text NOT NULL,
  `anime_trailer` text NOT NULL,
  `name_jp` text NOT NULL,
  `status` text NOT NULL,
  `airing_date` date NOT NULL,
  `avg_rating` decimal(14,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`show_id`, `name`, `bg_img`, `description`, `banner_img`, `anime_trailer`, `name_jp`, `status`, `airing_date`, `avg_rating`) VALUES
(1, 'Naruto', 'https://images-na.ssl-images-amazon.com/images/M/MV5BZmQ5NGFiNWEtMmMyMC00MDdiLTg4YjktOGY5Yzc2MDUxMTE1XkEyXkFqcGdeQXVyNTA4NzY1MzY@._V1_UY1200_CR93,0,630,1200_AL_.jpg', 'Guided by the spirit demon within him, orphaned Naruto learns to harness his powers as a ninja in this anime adventure series.', 'https://images3.alphacoders.com/135/thumb-1920-135625.jpg', 'https://www.youtube.com/embed/j2hiC9BmJlQ', 'ナルト', 'Completed', '2002-10-03', NULL),
(2, 'Bleach', 'http://www.gstatic.com/tv/thumb/tvbanners/189454/p189454_b_v8_aa.jpg', 'High school student Kurosaki Ichigo is unlike any ordinary kid. Why? Because he can see ghosts. Ever since a young age, he\'s been able to see spirits from the afterlife. Ichigo\'s life completely changes one day when he and his two sisters are attacked by an evil, hungry and tormented spirit known as a Hollow. Right in the nick of time, Ichigo and his siblings are aided by a Shinigami (Death God) named Kuchiki Rukia, whose responsibility it is to send good spirits (Pluses) to the afterlife known as Soul Society, and to purify Hollows and send them up to Soul Society. But during the fight against the Hollow, Rukia is injured and must transfer her powers to Ichigo. With this newly acquired power, so begins Kurosaki Ichigo\'s training and duty as a Shinigami to maintain the balance between the world of the living and the world of the dead', 'http://www.animenewsnetwork.com/thumbnails/crop600x315/herald/23810/bleachsmall.jpg', 'https://www.youtube.com/embed/oZ67d9XSjFs', 'ブリーチ', 'Completed', '2004-10-05', NULL),
(3, 'Dragon Ball Super', 'https://upload.wikimedia.org/wikipedia/en/7/74/Dragon_Ball_Super_Key_visual.jpg', 'Four years after the defeat of Majin Boo, peace has returned to Earth. Son Goku has settled down and now works as a radish farmer to support his family. His family and friends live peaceful lives. However, a new threat appears in the form of Beerus, The God of Destruction, who is considered to be the most terrifying being in Universe 7. After awakening from several years of slumber, Beerus is eager to fight the legendary warrior whom he had seen in a prophecy that is known as the Super Saiyan God. To protect Earth, Goku transforms into the Super Saiyan God to fight Beerus. Despite losing, Goku\'s efforts appease the God of Destruction enough so that he decides to spare the planet. This part of the series retells the events of Dragon Ball Z: Battle of Gods.', 'https://i.redd.it/sypoeebfdvox.jpg', 'https://www.youtube.com/embed/e7Cau3tep2g', 'ドラゴンボール 超 スーパー ', 'Ongoing', '2015-07-05', NULL),
(4, 'Dragon Ball Z', 'https://c1.staticflickr.com/8/7329/13469474264_21b5058c3c_b.jpg', 'Five years after winning the World Martial Arts tournament, Gokuu is now living a peaceful life with his wife and son. This changes, however, with the arrival of a mysterious enemy named Raditz who presents himself as Gokuu\'s long-lost brother. He reveals that Gokuu is a warrior from the once powerful but now virtually extinct Saiyan race, whose homeworld was completely annihilated. When he was sent to Earth as a baby, Gokuu\'s sole purpose was to conquer and destroy the planet; but after suffering amnesia from a head injury, his violent and savage nature changed, and instead was raised as a kind and well-mannered boy, now fighting to protect others.\r\n\r\nWith his failed attempt at forcibly recruiting Gokuu as an ally, Raditz warns Gokuu\'s friends of a new threat that\'s rapidly approaching Earth—one that could plunge Earth into an intergalactic conflict and cause the heavens themselves to shake. A war will be fought over the seven mystical dragon balls, and only the strongest will survive in Dragon Ball Z.', 'http://im.ziffdavisinternational.com/ign_fr/game/d/dragon-bal/dragon-ball-z-extreme-butoden_j82x.jpg', 'https://www.youtube.com/embed/GHnfX1RmZX8', 'ドラゴンボール Z ゼット', 'Completed', '1989-04-26', NULL),
(5, 'Tengen Toppa Gurren Lagann', 'http://img1.ak.crunchyroll.com/i/spire4/cf99ba5895abff9fa6fc7230a5c6d1b91367626926_full.jpg', 'Gurren Lagann takes place in a future where Earth is ruled by the Spiral King, Lordgenome, who forces mankind to live in isolated subterranean villages. These villages have no contact with the surface world or other villages and are under constant threat of earthquakes. Selected villagers called diggers are conscripted to expand their homes deeper underground. Simon, a meek young digger ostracized by his peers, finds solace in his best friend and older brother figure, an eccentric delinquent named Kamina. Kamina encourages Simon to join his gang, Team Gurren, to help him achieve his dream of visiting the surface world. One day, Simon unearths a drill-shaped key called a Core Drill, followed by a small mecha resembling a face called a Gunmen.[10][11] Shortly thereafter, a huge Gunmen crashes through the ceiling and begins attacking the village, followed by a girl named Yoko, who attempts to repel the Gunmen. Simon uses his Core Drill to activate the smaller Gunmen (which Kamina names Lagann), and it is used to destroy the larger Gunmen and break through to the surface world.', 'http://www.saywhatnowproductions.com/wp-content/uploads/2013/06/tengen-toppa-gurren-lagann-wallpapers-4.png', 'https://www.youtube.com/embed/SXg9mvnUWsM', '天元突破グレンラガン', 'Completed', '2007-08-17', NULL),
(6, 'Neon Genesis Evangelion', 'https://s-media-cache-ak0.pinimg.com/736x/fe/58/0c/fe580ca5f9889fdcb61fe98fb46dac9d.jpg', 'In 2015, fifteen years after a global cataclysm known as the Second Impact, teenager Shinji Ikari is summoned to the futuristic city of Tokyo-3 by his estranged father Gendo Ikari, director of the special paramilitary force Nerv. Shinji witnesses United Nations forces battling an Angel, one of a race of giant monstrous beings whose awakening was foretold by the Dead Sea Scrolls. Because of the Angels\' near-impenetrable force-fields, Nerv\'s giant Evangelion bio-machines, synchronized to the nervous systems of their pilots and possessing their own force-fields, are the only weapons capable of keeping the Angels from annihilating humanity. Nerv officer Misato Katsuragi escorts Shinji into the Nerv complex beneath the city, where his father pressures him into piloting the Evangelion Unit-01 against the Angel. Without training, Shinji is quickly overwhelmed in the battle, causing the Evangelion to go berserk and savagely kill the Angel on its own.', 'https://images.alphacoders.com/475/47523.jpg', 'https://www.youtube.com/embed/qW5DCdRp3rk', '新世紀エヴァンゲリオン', 'Completed', '1995-10-04', NULL),
(7, 'Code Geass: Hangyaku no Lelouch', 'http://static.tvtropes.org/pmwiki/pub/images/image_0250.jpeg', 'The story is set in an alternative timeline where the world has become split into three superpowers: the Holy Britannian Empire (the Americas; also called Britannia), the Chinese Federation (Asia), and the European Union (Europe and Africa; previously known as the Euro-Universe. Also known as Europa United in Akito the Exiled). The story takes place after the Holy Britannian Empire\'s conquest of Japan on August 10, 2010 a.t.b., by means of Britannia\'s newest weapon, the \"Autonomous Armored Knight\", or \"Knightmare Frame\". In turn, Britannia effectively strips Japan and its citizens of all rights and freedoms and renames the country Area 11 with its citizens referred to as Elevens.\r\n\r\nLelouch vi Britannia is an exiled Britannian prince who was sent as a bargaining tool to Japan, along with his sister Nunnally vi Britannia, by his father, Emperor Charles zi Britannia, after his mother, Marianne vi Britannia, was killed. Nunnally witnessed the murder of her mother Marianne, which caused her to lose both her sight and ability to walk. This makes it difficult for Lelouch because he must take care of her while on the run in Japan during the war. After the war in the ruins of a Japanese city he then vows to his Japanese friend Suzaku Kururugi that he will one day obliterate Britannia.', 'https://s-media-cache-ak0.pinimg.com/originals/10/20/57/102057dda53a0f6d36c1717683acb7d1.jpg', 'https://www.youtube.com/embed/O9Rdqm_74C0', 'コードギアス 反逆のルルーシュ', 'Completed', '2006-10-05', NULL),
(10, 'Mobile Suit Gundam SEED', 'https://myanimelist.cdn-dena.com/images/anime/9/16838.jpg', 'The series is the first of the Gundam franchise set in the \"Cosmic Era\" in which mankind is divided between normal Earth dwelling humans, known as \"Naturals\", and the genetically altered super-humans known as \"Coordinators\". The primary conflict of the story plot derives from jealous hatred by Naturals of the abilities of Coordinators, leading to hate crimes, and eventually the emigration of almost all Coordinators who flee into space to live idyllic lives on giant orbital space colonies called PLANTS of their own design. War eventually breaks out between Earth and the Plants. The Earth is divided between two major factions, the Earth Forces formed from most of the natural born human nations, primarily the Eurasians and the Atlantic Federation, and a natural human supremacist group known as Blue Cosmos with its slogan, \"For the preservation of our blue and pure world\". The Earth Forces are not a unified alliance, and infighting and mistrust exist between their various nation states. The second major Earth nation is the Orb Union, a staunchly politically neutral and isolationist nation located on small Pacific Ocean islands ruled by a hereditary monarchy and still contains Coordinator citizens.\r\n\r\n', 'http://www.wallpaperslot.com/data/media/2/Gundam%20Seed.jpg', 'https://www.youtube.com/embed/xuveD0juESE', '機動戦士ガンダムSEED (シード)', 'Completed', '2002-10-05', '10.0000'),
(11, 'Black Lagoon', 'http://vignette1.wikia.nocookie.net/lagooncompany/images/b/b1/Black_Lagoon.jpg/revision/latest?cb=20110718042001', 'Within Thailand is Roanapur, a depraved, crime-ridden city where not even the authorities or churches are untouched by the claws of corruption. A haven for convicts and degenerates alike, the city is notorious for being the center of illegal activities and operations, often fueled by local crime syndicates.\r\n\r\nEnter Rokurou Okajima, an average Japanese businessman who has been living a dull and monotonous life, when he finally gets his chance for a change of pace with a delivery trip to Southeast Asia. His business trip swiftly goes downhill as Rokurou is captured by a mercenary group operating in Roanapur, called Black Lagoon. The group plans to use him as a bargaining chip in negotiations which ultimately failed. Now abandoned and betrayed by his former employer, Rokurou decides to join Black Lagoon. In order to survive, he must quickly adapt to his new environment and prepare himself for the bloodshed and tribulation to come.\r\n\r\nA non-stop, high-octane thriller, Black Lagoon delves into the depths of human morality and virtue. Witness Rokurou struggling to keep his values and philosophies intact as he slowly transforms from businessman to ruthless mercenary.', 'http://lifestyle.inquirer.net/files/2017/04/Black-Lagoon-manga-to-resume-Levy.jpg', 'https://www.youtube.com/embed/JsL9vhMfyrs', 'ブラック・ラグーン', 'Completed', '2006-04-09', NULL),
(12, 'Sailor Moon', 'https://s-media-cache-ak0.pinimg.com/236x/ab/b3/fe/abb3fe6fda8fa561b7c02614f5b05eed.jpg', 'In Minato, Tokyo, a middle-school student named Usagi Tsukino befriends Luna, a talking black cat who gives her a magical brooch enabling her to become Sailor Moon: a soldier destined to save Earth from the forces of evil. Luna and Usagi assemble a team of fellow Sailor Soldiers to find their princess and the Silver Crystal. They encounter the studious Ami Mizuno, who awakens as Sailor Mercury; Rei Hino, a local shrine maiden who awakens as Sailor Mars; Makoto Kino, a tall transfer student who awakens as Sailor Jupiter; and Minako Aino, a young aspiring idol who awakens as Sailor Venus, accompanied by her talking feline companion Artemis. Additionally, they encounter Mamoru Chiba, a high-school student who assists them on occasion as Tuxedo Mask.', 'http://more-sky.com/data/out/12/IMG_482831.png', 'https://www.youtube.com/embed/ten4sIwapQ4', '美少女戦士セーラームーン', 'Completed', '1992-03-07', '10.0000'),
(13, 'Sword Art Online', 'https://myanimelist.cdn-dena.com/images/anime/11/39717.jpg', 'In 2022, a Virtual Reality Massively Multiplayer Online Role-Playing Game (VRMMORPG) called Sword Art Online (SAO) is released. With the NerveGear, a helmet that stimulates the user\'s five senses via their brain, players can experience and control their in-game characters with their minds. Both the game and the NerveGear was created by Akihiko Kayaba.\r\n\r\nOn November 6, 10,000 players log into the SAO\'s mainframe cyberspace for the first time, only to discover that they are unable to log out. Kayaba appears and tells the players that they must beat all 100 floors of Aincrad, a steel castle which is the setting of SAO, if they wish to be free. Those who suffer in-game deaths or forcibly remove the NerveGear out-of-game will suffer real-life deaths.', 'https://art-s.nflximg.net/ec9bc/4bf2bf91cde41c879e26e438751cdf4df7aec9bc.jpg', 'https://www.youtube.com/embed/6ohYYtxfDCg', 'ソードアート・オンライン', 'Completed', '2012-10-10', NULL),
(14, 'Pokemon', 'https://s-media-cache-ak0.pinimg.com/originals/d6/19/3b/d6193ba1060074639db3be2fb47984a9.jpg', 'Pokemon are peculiar creatures with a vast array of different abilities and appearances; many people, known as Pokemon trainers, capture and train them, often with the intent of battling others. Young Satoshi has not only dreamed of becoming a Pokemon trainer but also a \"Pokemon Master,\" and on the arrival of his 10th birthday, he finally has a chance to make that dream a reality. Unfortunately for him, all three Pokemon available to beginning trainers have already been claimed and only Pikachu, a rebellious Electric type Pokemon, remains. However, this chance encounter would mark the start of a lifelong friendship and an epic adventure!\r\n\r\nSetting off on a journey to become the very best, Satoshi and Pikachu travel across beautiful, sprawling regions with their friends Kasumi, a Water type trainer, and Takeshi, a Rock type trainer. But danger lurks around every corner. The infamous Team Rocket is always nearby, seeking to steal powerful Pokemon through nefarious schemes. It\'ll be up to Satoshi and his friends to thwart their efforts as he also strives to earn the eight Pokemon Gym Badges he\'ll need to challenge the Pokemon League, and eventually claim the title of Pokemon Master.', 'http://www.desktop-screens.com/data/out/87/3286197-pokemon-wallpapers.jpg', 'https://www.youtube.com/embed/d-lEahV5Q_o', 'ポケットモンスター', 'Completed', '1997-04-01', '6.0000'),
(15, 'Fullmetal Alchemist: Brotherhood', 'http://vignette2.wikia.nocookie.net/fma/images/e/e9/Fmab-poster.png/revision/latest?cb=20131124145205', 'Brothers Edward and Alphonse Elric are raised by their mother Trisha Elric in the remote village of Resembool in the country of Amestris. Their father Hohenheim, a noted and very gifted alchemist, abandoned his family while the boys were still young, and while in Trisha\'s care they began to show an affinity for alchemy. However, when Trisha died of a lingering illness, they were cared for by their best friend Winry Rockbell and her grandmother Pinako. The boys traveled the world to advance their alchemic training under Izumi Curtis.', 'http://vignette2.wikia.nocookie.net/thegamingfamily/images/2/29/Wallpaper_fullmetal_alchemist_brotherhood_by_narusailor-d6ve2q1.png/revision/latest?cb=20140526195429', 'https://www.youtube.com/embed/BOm_PAI2goo', '鋼の錬金術師 FULLMETAL ALCHEMIST', 'Completed', '2009-04-05', '8.0000'),
(16, 'One Piece', 'https://myanimelist.cdn-dena.com/images/manga/3/55539.jpg', 'Gol D. Roger was known as the \"Pirate King,\" the strongest and most infamous being to have sailed the Grand Line. The capture and execution of Roger by the World Government brought a change throughout the world. His last words before his death revealed the existence of the greatest treasure in the world, One Piece. It was this revelation that brought about the Grand Age of Pirates, men who dreamed of finding One Piece—which promises an unlimited amount of riches and fame—and quite possibly the pinnacle of glory and the title of the Pirate King.\r\n\r\nEnter Monkey D. Luffy, a 17-year-old boy who defies your standard definition of a pirate. Rather than the popular persona of a wicked, hardened, toothless pirate ransacking villages for fun, Luffy’s reason for being a pirate is one of pure wonder: the thought of an exciting adventure that leads him to intriguing people and ultimately, the promised treasure. Following in the footsteps of his childhood hero, Luffy and his crew travel across the Grand Line, experiencing crazy adventures, unveiling dark mysteries and battling strong enemies, all in order to reach the most coveted of all fortunes—One Piece.', 'https://images5.alphacoders.com/606/thumb-1920-606284.jpg', 'https://www.youtube.com/embed/ZwXKz2CeHwY', 'ワンピース', 'Ongoing', '1999-10-20', NULL),
(17, 'Kill La Kill', 'https://upload.wikimedia.org/wikipedia/en/thumb/a/a9/Killlakillpromo.jpg/215px-Killlakillpromo.jpg', 'After the murder of her father, Ryuuko Matoi has been wandering the land in search of his killer. Following her only lead—the missing half of his invention, the Scissor Blade—she arrives at the prestigious Honnouji Academy, a high school unlike any other. The academy is ruled by the imposing and cold-hearted student council president Satsuki Kiryuuin alongside her powerful underlings, the Elite Four. In the school\'s brutally competitive hierarchy, Satsuki bestows upon those at the top special clothes called \"Goku Uniforms,\" which grant the wearer unique superhuman abilities. \r\n\r\nThoroughly beaten in a fight against one of the students in uniform, Ryuuko retreats to her razed home where she stumbles across Senketsu, a rare and sentient \"Kamui,\" or God Clothes. After coming into contact with Ryuuko\'s blood, Senketsu awakens, latching onto her and providing her with immense power. Now, armed with Senketsu and the Scissor Blade, Ryuuko makes a stand against the Elite Four, hoping to reach Satsuki and uncover the culprit behind her father\'s murder once and for all. ', 'http://i0.kym-cdn.com/photos/images/original/000/686/177/af4.jpg', 'https://www.youtube.com/embed/B98NY8Hfo7I', 'キルラキル', 'Completed', '2013-10-04', NULL),
(18, 'Digimon Adventure', 'https://vignette1.wikia.nocookie.net/digimon/images/b/b2/Digimon_Adventure.jpg/revision/latest?cb=20100619144849', 'When a group of kids head out for summer camp, they don\'t expect it to snow in the middle of July. Out of nowhere, the kids receive strange devices which transport them to a very different world to begin their Digimon Adventure! Led by the plucky Taichi Yagami, the seven children must now survive in a realm far from home, filled with monsters and devoid of other humans.\r\n\r\nLuckily, they\'re not alone: each child is paired off with a companion digital monster called a Digimon. Together, the children and their new friends must overcome their insecurities, discover their inner strengths, and evolve into stronger fighters - literally.\r\n\r\nA force of evil is spreading through the Digital World, corrupting all the Digimon. The DigiDestined have arrived and it’s up to them to save the Digital World, if they ever want to see their home world again.', 'https://manga.tokyo/wp-content/uploads/2017/04/main.jpg', 'https://www.youtube.com/embed/YYFG6Ob1WAg', 'デジモンアドベンチャー', 'Completed', '1999-03-07', NULL),
(19, 'Love Live! School Idol Project', 'https://upload.wikimedia.org/wikipedia/en/b/b9/Love_Live%21_promotional_image.jpg', 'Honoka Kōsaka is a girl who belongs to Otonokizaka Academy. When the school is planned to be closed down due to a lack of applicants, Honoka becomes determined to save it. Honoka goes to UTX, where her little sister planned to go for high school, and sees a crowd watching a music video of A-Rise, UTX\'s school idol group. Learning that school idols are popular, Honoka and her friends follow A-Rise\'s footsteps to start a school idol group called μ\'s (ミューズ Myūzu, pronounced \"muse\") to attract new students. Once they successfully prevent Otonokizaka Academy from closing, the girls from μ\'s aim for higher grounds and participate in Love Live, the ultimate school idol competition featuring the best groups in the country. Despite winning the competition, the girls from μ\'s disband soon after for their own personal reasons.', 'http://pm1.narvii.com/6275/590dde9cd2fb957f35409eb023e9b5fa95df89cb_hq.jpg', 'https://www.youtube.com/embed/Yl5Kwi-uqQY', 'ラブライブ!', 'Completed', '2013-01-06', NULL),
(20, 'Steins Gate', 'http://static.tvtropes.org/pmwiki/pub/images/steins_gate_visarts20_2874.jpg', 'It is set in 2010 in Akihabara, Tokyo, and follows Rintaro Okabe, a self-proclaimed \"mad scientist\", who runs the \"Future Gadget Laboratory\" in an apartment together with his friends Mayuri Shiina and Itaru \"Daru\" Hashida. While attending a conference about time travel, Okabe finds the dead body of Kurisu Makise, a neuroscience researcher; he sends a text message about it to Daru, and later discovers that Kurisu is alive, and that the message arrived before he sent it. The laboratory members learn that the cell phone-operated microwave oven they are developing can send text messages back in time; they are joined by Kurisu, and investigate it, sending text messages – referred to as \"D-mails\" – to the past to change the present. Kurisu eventually creates a device that can send memories through the microwave oven, effectively allowing the user to time travel.', 'https://static.zerochan.net/Steins%3BGate.full.840343.jpg', 'https://www.youtube.com/embed/LwcTi86cFeg', 'シュタインズ・ゲート', 'Completed', '2011-04-06', NULL),
(21, 'Boku dake ga Inai Machi', 'http://img1.ak.crunchyroll.com/i/spire4/3727644b109279e2cb405ac89b0f293f1452549294_full.jpg', 'When tragedy is about to strike, Satoru Fujinuma finds himself sent back several minutes before the accident occurs. The detached, 29-year-old manga artist has taken advantage of this powerful yet mysterious phenomenon, which he calls \"Revival,\" to save many lives.\r\n\r\nHowever, when he is wrongfully accused of murdering someone close to him, Satoru is sent back to the past once again, but this time to 1988, 18 years in the past. Soon, he realizes that the murder may be connected to the abduction and killing of one of his classmates, the solitary and mysterious Kayo Hinazuki, that took place when he was a child. This is his chance to make things right.\r\n\r\nBoku dake ga Inai Machi follows Satoru in his mission to uncover what truly transpired 18 years ago and prevent the death of his classmate while protecting those he cares about in the present.', 'https://images7.alphacoders.com/697/thumb-1920-697284.png', 'https://www.youtube.com/embed/SUKevBJ703o', '僕だけがいない街', 'Completed', '2016-01-08', NULL),
(22, 'Attack on Titan', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMTY5ODk1NzUyMl5BMl5BanBnXkFtZTgwMjUyNzEyMTE@._V1_UY1200_CR85,0,630,1200_AL_.jpg', 'Centuries ago, mankind was slaughtered to near extinction by monstrous humanoid creatures called titans, forcing humans to hide in fear behind enormous concentric walls. What makes these giants truly terrifying is that their taste for human flesh is not born out of hunger but what appears to be out of pleasure. To ensure their survival, the remnants of humanity began living within defensive barriers, resulting in one hundred years without a single titan encounter. However, that fragile calm is soon shattered when a colossal titan manages to breach the supposedly impregnable outer wall, reigniting the fight for survival against the man-eating abominations.\r\n\r\nAfter witnessing a horrific personal loss at the hands of the invading creatures, Eren Yeager dedicates his life to their eradication by enlisting into the Survey Corps, an elite military unit that combats the merciless humanoids outside the protection of the walls. Based on Hajime Isayama\'s award-winning manga, Shingeki no Kyojin follows Eren, along with his adopted sister Mikasa Ackerman and his childhood friend Armin Arlert, as they join the brutal war against the titans and race to discover a way of defeating them before the last walls are breached.', 'https://wallpaperscraft.com/image/attack_on_titan_eren_jaeger_shingeki_no_kyojin_104200_3840x2160.jpg', 'https://www.youtube.com/embed/MGRm4IzK1SQ', '進撃の巨人', 'Completed', '2013-04-07', NULL),
(23, 'One Punch Man', 'https://myanimelist.cdn-dena.com/images/anime/12/76049.jpg', 'The seemingly ordinary and unimpressive Saitama has a rather unique hobby: being a hero. In order to pursue his childhood dream, he trained relentlessly for three years—and lost all of his hair in the process. Now, Saitama is incredibly powerful, so much so that no enemy is able to defeat him in battle. In fact, all it takes to defeat evildoers with just one punch has led to an unexpected problem—he is no longer able to enjoy the thrill of battling and has become quite bored.\r\n\r\nThis all changes with the arrival of Genos, a 19-year-old cyborg, who wishes to be Saitama\'s disciple after seeing what he is capable of. Genos proposes that the two join the Hero Association in order to become certified heroes that will be recognized for their positive contributions to society, and Saitama, shocked that no one knows who he is, quickly agrees. And thus begins the story of One Punch Man, an action-comedy that follows an eccentric individual who longs to fight strong enemies that can hopefully give him the excitement he once felt and just maybe, he\'ll become popular in the process.\r\n', 'https://i2.wp.com/www.anime-desu.com/wp-content/uploads/2015/11/eXrpCtt.jpg?zoom=2&fit=1218%2C546', 'https://www.youtube.com/embed/2JAElThbKrI', 'ワンパンマン', 'Completed', '2015-10-05', NULL),
(24, 'Fate/Zero', 'https://myanimelist.cdn-dena.com/images/anime/2/73249.jpg', 'The story of Fate/Zero takes place ten years prior to the events of Fate/stay night, detailing the events of the Fourth Holy Grail War in Fuyuki City.[1] The Holy Grail War is a contest, founded by the Einzbern, Matou, and Tōsaka families centuries ago, in which seven mages summon seven Heroic Spirits to compete to obtain the power of the \"Holy Grail\", which grants a wish to each member of the winning duo. After three inconclusive wars for the elusive Holy Grail, the Fourth War commences.', 'https://images6.alphacoders.com/332/thumb-1920-332414.jpg', 'https://www.youtube.com/embed/8TQeoyVDhro', 'フェイト/ゼロ', 'Completed', '2011-10-02', NULL),
(25, 'Kuroko No Basket', 'https://myanimelist.cdn-dena.com/images/anime/11/50453l.jpg', 'The basketball team of Teiko Middle School rose to distinction by demolishing all competition. The regulars of the team became known as the \"Generation of Miracles\". After graduating from middle school, these five stars went to different high schools with top basketball teams. However, a fact few know is that there was another player in the \"Generation of Miracles\": a phantom sixth man. This mysterious player is now a freshman at Seirin High, a new school with a powerful, if little-known, team. Now, Tetsuya Kuroko – \"the sixth member of the \"Generation of Miracles\", and Taiga Kagami – a naturally talented player who spent most of middle school in the US, aim to bring Seirin to the top of Japan and begin taking on Kuroko\'s former teammates one by one. The series chronicles Seirin\'s rise to become Japan\'s number one high school team. The rest of the Generation of Miracles include Ryota Kise, Shintaro Midorima, Daiki Aomine, Atsushi Murasakibara and Seijuro Akashi.', 'http://img1.wikia.nocookie.net/__cb20131127011053/epicrapbattlesofhistory/images/d/d0/-Kuroko-no-Basket-kuroko-tetsuya-34291567-1200-800.jpg', 'https://www.youtube.com/embed/LIBPhMB4nZw', '黒子のバスケ', 'Completed', '2012-04-08', NULL),
(26, 'Magi: The Kingdom of Magic', 'http://www.animefillerlist.com/sites/default/files/styles/anime_poster/public/magi_kom_0.jpg?itok=-HSRD1q4', 'After celebrating their victory against Al-Thamen, Aladdin and his friends depart the land of Sindria. With the end of the battle, however, comes the time for each of them to go their separate ways. Hakuryuu and Kougyoku are ordered to go back to their home country, the Kou Empire. Meanwhile Aladdin announces he needs to head for Magnostadt—a mysterious country ruled by magicians—to investigate the mysterious events occurring in this new kingdom and become more proficient in magic. For their part, encouraged by Aladdin\'s words, Alibaba and Morgiana also set off in pursuit of their own goals: training and going to her homeland, respectively.\r\n\r\nMagi: The Kingdom of Magic follows these friends as they all go about their separate adventures, each facing their own challenges. However, a new threat begins to rise as a great war looms over the horizon...\r\n', 'https://static.zerochan.net/MAGI%3A.The.Labyrinth.of.Magic.full.1340158.jpg', 'https://www.youtube.com/embed/2E7o26G1T0c', 'マギ The kingdom of magic', 'Completed', '2013-10-06', NULL),
(27, 'Shokugeki No Souma', 'https://myanimelist.cdn-dena.com/images/anime/3/72943.jpg', 'Shokugeki no Soma tells the story of a boy named Sōma Yukihira, whose dream is to become a full-time chef in his father\'s neighborhood restaurant and surpass his father\'s culinary skills. But just as Sōma graduates from middle school, his father, Jōichirō Yukihira, gets a new job that requires him to travel around the world and closes his shop. However, Sōma\'s fighting spirit is rekindled by a challenge from Jōichirō which is to survive in an elite culinary school where only 10% of the students manage to graduate, where he meets many amazing students and experiences new events that allow him to grow further towards his cooking goal.', 'https://images2.alphacoders.com/693/693195.png', 'https://www.youtube.com/embed/oAqN370duSQ', '食戟のソーマ', 'Completed', '2015-04-04', NULL),
(28, 'Clannad: After Story', 'https://myanimelist.cdn-dena.com/images/anime/13/24647.jpg', 'Clannad: After Story, the sequel to the critically acclaimed slice-of-life series Clannad, begins after Tomoya Okazaki and Nagisa Furukawa graduate from high school. Together, they experience the emotional rollercoaster of growing up. Unable to decide on a course for his future, Tomoya learns the value of a strong work ethic and discovers the strength of Nagisa\'s support. Through the couple\'s dedication and unity of purpose, they push forward to confront their personal problems, deepen their old relationships, and create new bonds.\r\n\r\nTime also moves on in the Illusionary World. As the plains grow cold with the approach of winter, the Illusionary Girl and the Garbage Doll are presented with a difficult situation that reveals the World\'s true purpose.\r\n\r\nBased on the visual novel by Key and produced by Kyoto Animation, Clannad: After Story is an impactful drama highlighting the importance of family and the struggles of adulthood.', 'http://images5.fanpop.com/image/photos/24700000/Clannad-Pics-clannad-and-clannad-after-story-24746547-1920-1200.jpg', 'https://www.youtube.com/embed/klUfRsd20gE', 'クラナド アフターストーリー', 'Completed', '2008-10-03', '9.0000'),
(29, 'Shigatsu wa Kimi no Uso', 'http://vignette4.wikia.nocookie.net/shigatsu-wa-kimi-no-uso/images/0/0f/SeriesAnime.jpg/revision/latest?cb=20150325003016', 'Music accompanies the path of the human metronome, the prodigious pianist Kousei Arima. But after the passing of his mother, Saki Arima, Kousei falls into a downward spiral, rendering him unable to hear the sound of his own piano.\r\n\r\nTwo years later, Kousei still avoids the piano, leaving behind his admirers and rivals, and lives a colorless life alongside his friends Tsubaki Sawabe and Ryouta Watari. However, everything changes when he meets a beautiful violinist, Kaori Miyazono, who stirs up his world and sets him on a journey to face music again.\r\n\r\nBased on the manga series of the same name, Shigatsu wa Kimi no Uso approaches the story of Kousei\'s recovery as he discovers that music is more than playing each note perfectly, and a single melody can bring in the fresh spring air of April.\r\n', 'https://vignette2.wikia.nocookie.net/shigatsu-wa-kimi-no-uso/images/5/55/CHARACTERS.jpg/revision/latest/scale-to-width-down/670?cb=20141020130812', 'https://www.youtube.com/embed/3aL0gDZtFbE', '四月は君の嘘', 'Completed', '2014-10-10', NULL),
(30, 'Naruto Shippuden', 'http://img1.ak.crunchyroll.com/i/spire4/1c1df98707aa0f22aa54342af725e48a1491245343_full.jpg', 'It has been two and a half years since Naruto Uzumaki left Konohagakure, the Hidden Leaf Village, for intense training following events which fueled his desire to be stronger. Now Akatsuki, the mysterious organization of elite rogue ninja, is closing in on their grand plan which may threaten the safety of the entire shinobi world.\r\n\r\nAlthough Naruto is older and sinister events loom on the horizon, he has changed little in personality—still rambunctious and childish—though he is now far more confident and possesses an even greater determination to protect his friends and home. Come whatever may, Naruto will carry on with the fight for what is important to him, even at the expense of his own body, in the continuation of the saga about the boy who wishes to become Hokage.', 'https://wallpaperscraft.com/image/naruto_naruto_shippuden_yondaime_namikaze_minato_sarutobi_hiruzen_kakashi_hatake_jiraiya_61954_3840x2160.jpg', 'https://www.youtube.com/embed/1WLO0Owi5-A', 'ナルト- 疾風伝', 'Completed', '2007-02-15', NULL),
(31, 'My Hero Academia', 'http://img1.ak.crunchyroll.com/i/spire1/863ba423b729f58769a4004834e5554e1491069428_full.jpg', 'The story follows Izuku Midoriya, a boy born without superpowers in a world where they are the norm, but who still dreams of becoming a superhero himself, and is scouted by the world\'s greatest hero who shares his powers with Izuku after recognizing his value and enrolls him in a high school for heroes in training.', 'http://wallpapercave.com/wp/wp1874080.png', 'https://www.youtube.com/embed/wIb3nnOeves', '僕のヒーローアカデミア', 'Completed', '2013-04-03', NULL),
(32, 'Haikyuu!!', 'https://myanimelist.cdn-dena.com/images/anime/4/60431l.jpg', 'Junior high school student Shōyō Hinata gains a sudden love of volleyball after seeing a national championship match on TV. Although short in height, he becomes determined to follow in the footsteps of the championship\'s star player, nicknamed the \"Little Giant\", after seeing his plays. He creates a volleyball club and begins practicing by himself. Eventually 3 other members join the team by his last year of middle school, pushing Hinata to persuade his two friends who are in different clubs to join just for the tournament. However, they are defeated in their first tournament game after being challenged by the championship favorite team, which includes the so-called \"King of the Court\" Tobio Kageyama, in the first round. Though Hinata\'s team suffers a miserable defeat, he vows to eventually surpass Kageyama and defeat him. Fast-forward to highschool, Hinata enters Karasuno Highschool with the hopes of joining their volleyball club.', 'http://goodereader.com/blog/wp-content/uploads/images/Haikyuu.jpg', 'https://www.youtube.com/embed/JOGp2c7-cKc', 'ハイキュー!!', 'Completed', '2014-04-06', NULL),
(33, 'No Game No Life', 'https://myanimelist.cdn-dena.com/images/anime/5/65187.jpg', 'No Game No Life is a surreal comedy that follows Sora and Shiro, shut-in NEET siblings and the online gamer duo behind the legendary username \"Blank.\" They view the real world as just another lousy game; however, a strange e-mail challenging them to a chess match changes everything—the brother and sister are plunged into an otherworldly realm where they meet Tet, the God of Games.\r\n\r\nThe mysterious god welcomes Sora and Shiro to Disboard, a world where all forms of conflict—from petty squabbles to the fate of whole countries—are settled not through war, but by way of high-stake games. This system works thanks to a fundamental rule wherein each party must wager something they deem to be of equal value to the other party\'s wager. In this strange land where the very idea of humanity is reduced to child\'s play, the indifferent genius gamer duo of Sora and Shiro have finally found a real reason to keep playing games: to unite the sixteen races of Disboard, defeat Tet, and become the gods of this new, gaming-is-everything world.', 'http://vignette3.wikia.nocookie.net/no-game-no-life/images/3/30/No_game_no_life_wallpaper.jpg/revision/latest?cb=20140901002548', 'Sora and Shiro are two hikikomori step-siblings who are known in the online gaming world as Blank, an undefeated group of gamers. One day, they are challenged to a game of chess by Tet, a god from another reality. The two are victorious and are offered to live in a world that centers around games. They accept, believing it to be a joke, and are summoned to a reality known as Disboard.', 'ノーゲーム・ノーライフ', 'Completed', '2014-04-09', NULL),
(34, 'Eyeshield 21', 'https://myanimelist.cdn-dena.com/images/anime/12/66961.jpg', 'Sena is like any other shy kid starting high school; he\'s just trying to survive. Constantly bullied, he\'s accustomed to running away.\r\n\r\nSurviving high school is about to become a lot more difficult after Hiruma, captain of the school\'s American football team, witnesses Sena\'s incredible agility and speed during an escape from some bullies. Hiruma schemes to make Sena the running back of his school team, The Devil Bats, hoping that it will turn around the squad\'s fortunes from being the laughingstock of Japan\'s high school leagues, to title contender.\r\n\r\nTo protect his precious star player from rivaling recruiters, he enlists Sena as \"team secretary,\" giving him a visored helmet and the nickname \"Eyeshield 21\" to hide his identity.\r\n\r\nThe Devilbats will look to make their way to the Christmas Bowl, an annual tournament attended by the best football teams in Japan, with \"Eyeshield 21\" leading the way. Will they be able to win the Christmas Bowl? Will Sena be able to transform from a timid, undersized freshman to an all-star player? Put on your pads and helmet to find out!\r\nEdit', 'https://www.desktopbackground.org/p/2015/07/07/975715_download-eyeshield-21-wallpapers-1920x1080_1366x800_h.jpg', 'https://www.youtube.com/embed/ytRsSPWlMdg', 'アイシールド21', 'Completed', '2005-04-06', NULL),
(35, 'Psycho-Pass', 'http://img1.ak.crunchyroll.com/i/spire3/2e3d5e0f13da8c0eced54b573d883f0a1473358908_full.jpg', 'Justice, and the enforcement of it, has changed. In the 22nd century, Japan enforces the Sibyl System, an objective means of determining the threat level of each citizen by examining their mental state for signs of criminal intent, known as their Psycho-Pass. Inspectors uphold the law by subjugating, often with lethal force, anyone harboring the slightest ill-will; alongside them are Enforcers, jaded Inspectors that have become latent criminals, granted relative freedom in exchange for carrying out the Inspectors\' dirty work.\r\n\r\nInto this world steps Akane Tsunemori, a young woman with an honest desire to uphold justice. However, as she works alongside veteran Enforcer Shinya Kougami, she soon learns that the Sibyl System\'s judgments are not as perfect as her fellow Inspectors assume. With everything she has known turned on its head, Akane wrestles with the question of what justice truly is, and whether it can be upheld through the use of a system that may already be corrupt.\r\n', 'https://img00.deviantart.net/1ca5/i/2015/008/a/c/psycho_pass_wallpaper_by_fednan-d80f8el.jpg', 'https://www.youtube.com/embed/YzuJnyebc40', 'サイコパス', 'Completed', '2012-10-12', NULL),
(36, 'Puella Magi Madoka Magica', 'http://img1.ak.crunchyroll.com/i/spire2/7facd20f5216202349ad2fc3119e2e5b1329936788_full.jpg', 'Madoka Kaname and Sayaka Miki are regular middle school girls with regular lives, but all that changes when they encounter Kyuubey, a cat-like magical familiar, and Homura Akemi, the new transfer student.', 'http://avante.biz/wp-content/uploads/Puella-magi-madoka-magica-hd-wallpaper/Puella-magi-madoka-magica-hd-wallpaper-012.jpg', 'https://www.youtube.com/embed/6CTHwEZK2JA', '魔法少女まどかマギカ', 'Completed', '2011-01-07', NULL),
(37, 'Death Note', 'https://myanimelist.cdn-dena.com/images/anime/9/9453.jpg', 'A high-school student discovers a supernatural notebook that grants its user the ability to kill.', 'https://wallpaperscraft.com/image/death_note_light_yagami_ryuk_the_creation_of_adam_art_parody_101922_1920x1080.jpg', 'https://www.youtube.com/embed/ELIKAYTDjNc', 'デスノート', 'Completed', '2006-10-04', NULL),
(38, 'Eureka Seven', 'http://www.gstatic.com/tv/thumb/tvbanners/185777/p185777_b_v8_ac.jpg', 'The pilot of the LFO is a beautiful young girl named Eureka, who has come to have her LFO serviced in the garage run by his family. But following her are the Gekkostate, a small band of guerilla fighters, and a United Federation Forces KLF unit.', 'http://citylovehz.com/data/out/52/2560730-eureka-seven-wallpapers.jpg', 'https://www.youtube.com/embed/o-zmMVZpeb8', '交響詩篇エウレカセブン', 'Completed', '2005-04-17', NULL),
(39, 'Guilty Crown', 'https://myanimelist.cdn-dena.com/images/anime/8/33713.jpg', 'Inori Yuzuriha, a key member of Funeral Parlor, runs into the weak and unsociable Shuu Ouma during a crucial operation, which results in him obtaining the \"Power of Kings\"—an ability which allows the wielder to draw out the manifestations of an individual\'s personality, or \"voids.\" Now an unwilling participant in the struggle against GHQ, Shuu must learn to control his newfound power if he is to help take back Japan once and for all.\r\n', 'https://images2.alphacoders.com/607/thumb-1920-607188.jpg', 'https://www.youtube.com/embed/JToS6gmWzgw', 'ギルティクラウン', 'Completed', '2011-10-14', NULL),
(40, 'Boruto: Naruto Next Generations', 'https://myanimelist.cdn-dena.com/images/anime/9/84460l.jpg', 'Years later after the Fourth Great Ninja War, Naruto Uzumaki achieves his dream of becoming the Seventh Hokage, after he and Hinata Hyuga married, and now oversees a new generation in the Ninja World. They have two children: Boruto and Himawari. Boruto has become part of a ninja team led by Naruto\'s protege Konohamaru Sarutobi, along with Sasuke Uchiha and Sakura Haruno\'s daughter Sarada, and Orochimaru\'s artificial son Mitsuki. Feeling that Naruto is placing his duties over his family, Boruto becomes upset at him for missing Himawari\'s birthday. Boruto meets Sasuke, when he returns to the village to warn Naruto about the impending threat. Boruto manages to convince Sasuke to teach the Rasengan to him for the upcoming Chunin Exam. Boruto\'s bad action drives him to cheat the exam with Katasuke\'s inventing device called the Kote, only for Naruto to disqualify Boruto during the match with Shikadai Nara. The two have an argument until Momoshiki and Kinshiki Ōtsutsuki, the figures Sasuke warned Naruto of, appear and abduct Naruto, so they can use Kurama, a creature sealed inside his body, to revitalize the dying Shinju from the dimension which they came from.', 'https://www.awn.com/sites/default/files/styles/original/public/image/featured/1032566-viz-media-acquires-rights-boruto-naruto-next-generations-anime-series.jpg?itok=-Vab_O-d', 'https://www.youtube.com/embed/ujB0VyOqVMA', 'BORUTO-ボルト- NARUTO NEXT GENERATIONS', 'Ongoing', '2017-04-05', NULL),
(41, 'Dragon Ball', 'https://images-na.ssl-images-amazon.com/images/M/MV5BMjRlYTYyMDUtOGY5MC00MmFiLTljOTMtM2QzOWZjMWViN2FiL2ltYWdlXkEyXkFqcGdeQXVyNTAyODkwOQ@@._V1_UY1200_CR123,0,630,1200_AL_.jpg', 'The series begins with a young monkey-tailed boy named Goku befriending a teenage girl named Bulma. Together they go on a quest to find the seven Dragon Balls (ドラゴンボール), which summons the dragon Shenlong to grant the user one wish.', 'https://wallpapers.walldevil.com/wallpapers/a45/preview/dragon-ball-dragon-goku-krillin-bulma-piccolo-master-roshi-oolong-tien.jpg', 'https://www.youtube.com/embed/X7kZVH849Eo', 'ドラゴンボール', 'Completed', '1986-02-26', NULL),
(42, 'Girls und Panzer', 'http://img1.ak.crunchyroll.com/i/spire2/fcc618e79bb56e87e456a6604040fe451351543013_full.jpg', 'The story takes place in a universe where historical World War II–era tanks are maintained for sport-style warfare competitions and large carrier ships known as Academy Ships support mobile sea communities. Of the many activities high school girls can participate in, one of the most popular is \"sensha-dō\" (戦車道, lit. \"the way of the tank\"),[FN 1] the art of operating tanks, which is considered a traditional martial art. Miho Nishizumi, a girl from a prestigious family of sensha-dō practitioners who became traumatized by a past event, transfers to Ōarai Girls High School to get away from sensha-dō, as she presumed the school was no longer practicing the sport. However, shortly after Miho begins her new school life and makes some new friends, the student council announces the revival of sensha-dō at Ōarai and coerces Miho, the only student with prior experience, to join. While reluctant to join at first, having practically been forced, Miho soon warms up to sensha-dō again and comes to enjoy it, after which the school prepares to enter a national sensha-dō championship, facing off against various other schools.', 'https://s-media-cache-ak0.pinimg.com/originals/99/6e/99/996e999b731e6908153ab1fd5ff5d16b.jpg', 'https://www.youtube.com/embed/oy80FhOJQG8', 'ガールズ&パンツァー', 'Completed', '2012-10-09', NULL),
(43, '.hack//Legend of the Twilight', 'https://myanimelist.cdn-dena.com/images/anime/4/78321.jpg', 'Winning the legendary characters \"Kite\" and \"Black Rose\" from an event held by the creators of the MMORPG \"The World,\" Shugo and his twin sister Rena steps into \"The World.\" Together they completed events and quests, along with their new friends Ouka, Mirelle, Hotaru, and Sanjuro. Soon after, mysterious monsters appeared, and death by these monsters caused players to slip into a coma in the real world. Only Shugo and Rena can solve this problem, but why are they being targeted, and what secrets is the game hiding?', 'https://images8.alphacoders.com/759/thumb-1920-759254.jpg', 'https://www.youtube.com/embed/E1M3nL35UDY', '.hack//黄昏の腕輪伝説', 'Completed', '2003-01-09', NULL),
(45, '11eyes', 'https://upload.wikimedia.org/wikipedia/en/f/f7/11eyes_original_visual_novel_cover.jpg', 'When the Sky turns Red, the Moon turns Black, and monsters begin roaming the streets, Satsuki Kakeru is at a loss for what to do. Along with his best friend Yuka, they try to decipher why they have been sent to this strange world, which is seemingly empty aside from themselves.\r\n\r\nHowever, when the \"Red Night\" ends, Kakeru and Yuka believed it was all a dream, until it happens again and they are left in a dangerous situation. They meet four others in the same predicament: Kusakabe Misuzu, an expert swordswoman, Tachibana Kukuri, a strange mute girl who looks uncannily like Kakeru\'s deceased sister, Hirohara Yukiko, a lively young girl whose personality reverts to that of a cold killer when her glasses are removed, and Tajima Takahisa, a young pyrokineticist.\r\n\r\nAs the six of them band together to survive and discover what this mysterious world is, things take a turn for the worse as six shadows appear before them...\r\n', 'http://images2.fanpop.com/image/photos/9300000/Girls-from-11eyes-11eyes-9399399-1920-1080.jpg', 'https://www.youtube.com/embed/q6LJUUd_O-s', 'イレブンアイズ', 'Completed', '2009-10-07', NULL),
(46, 'Akame ga Kill!', 'http://s2.mgicdn.com/avatar/1169-read_akame_ga_kill_manga.jpg', 'Night Raid is the covert assassination branch of the Revolutionary Army, an uprising assembled to overthrow Prime Minister Honest, whose avarice and greed for power has lead him to take advantage of the child emperor\'s inexperience. Without a strong and benevolent leader, the rest of the nation is left to drown in poverty, strife, and ruin. Though the Night Raid members are all experienced killers, they understand that taking lives is far from commendable and that they will likely face retribution as they mercilessly eliminate anyone who stands in the revolution\'s way.\r\n\r\nThis merry band of assassins\' newest member is Tatsumi, a naïve boy from a remote village who had embarked on a journey to help his impoverished hometown and was won over by not only Night Raid\'s ideals, but also their resolve. Akame ga Kill! follows Tatsumi as he fights the Empire and comes face-to-face with powerful weapons, enemy assassins, challenges to his own morals and values, and ultimately, what it truly means to be an assassin with a cause.', 'https://images5.alphacoders.com/605/thumb-1920-605794.jpg', 'https://www.youtube.com/embed/A45hvq7C5GM', 'アカメが斬る！\r\n', 'Completed', '2014-07-07', NULL),
(47, 'Anohana: The Flower We Saw That Day', 'http://img1.ak.crunchyroll.com/i/spire4/75d87960c388efc544be093603b8e9f01406669874_full.jpg', 'Friends grow apart after a tragic accident claims one of their number. Years later, the dead girl appears to them to ask for their help in crossing over to the afterlife.', 'https://s-media-cache-ak0.pinimg.com/originals/78/55/8a/78558a7c949d4d91198663a787f31bc5.png', 'https://www.youtube.com/embed/x8fvwC5xVGg', 'あの日見た花の名前を僕達はまだ知らない', 'Completed', '2011-04-15', NULL);
INSERT INTO `shows` (`show_id`, `name`, `bg_img`, `description`, `banner_img`, `anime_trailer`, `name_jp`, `status`, `airing_date`, `avg_rating`) VALUES
(48, 'Ao no Exorcist', 'https://myanimelist.cdn-dena.com/images/anime/10/75195l.jpg', 'Humans and demons are two sides of the same coin, as are Assiah and Gehenna, their respective worlds. The only way to travel between the realms is by the means of possession, like in ghost stories. However, Satan, the ruler of Gehenna, cannot find a suitable host to possess and therefore, remains imprisoned in his world. In a desperate attempt to conquer Assiah, he sends his son instead, intending for him to eventually grow into a vessel capable of possession by the demon king.\r\n\r\nAo no Exorcist follows Rin Okumura who appears to be an ordinary, somewhat troublesome teenager—that is until one day he is ambushed by demons. His world turns upside down when he discovers that he is in fact the very son of Satan and that his demon father wishes for him to return so they can conquer Assiah together. Not wanting to join the king of Gehenna, Rin decides to begin training to become an exorcist so that he can fight to defend Assiah alongside his brother Yukio.', 'https://static.zerochan.net/Happy.Tree.Friends.full.1446511.jpg', 'https://www.youtube.com/embed/8gIFjsTcWoY', '青の祓魔師(エクソシスト)', 'Completed', '2011-04-17', NULL),
(49, 'Bakemonogatari', 'https://myanimelist.cdn-dena.com/images/anime/11/75274.jpg', 'Koyomi Araragi, a high school student, returns to a normal human life after a vampire attack. As he lives with remnants of his vampire half still persisting, he finds himself returning to the world of the supernatural after discovering the unusual case of Hitagi Senjougahara, who is afflicted with a condition that leaves her weightless.', 'http://images6.fanpop.com/image/photos/33400000/bakemonogatari-bakemonogatari-33407683-1280-800.jpg', 'https://www.youtube.com/embed/ZIziNssFnHg', '化物語', 'Completed', '2009-07-03', NULL),
(50, 'Beyblade', 'http://vignette3.wikia.nocookie.net/beyblade/images/c/c4/Tumblr_mpqkzonakW1rja3cwo1_1280.jpg/revision/latest?cb=20130807024314', 'Thirteen-year-old Tyson Granger (Takao Kinomiya), along with his fellow teammates, Kai Hiwatari, Max Tate (Max Mizuhura), and Ray Kon (Rei Kon), strive to become the greatest Beybladers in the world. With the technical help of the team\'s resident genius, Kenny (Kyouju), and with the powerful strength of their BitBeasts, the Bladebreakers armed with their tops (AKA: Blades) attempt to reach their goal.', 'https://wallpapercave.com/wp/vKNRKGK.jpg', 'https://www.youtube.com/embed/zjXohtL7CP4', '爆転シュート　ベイブレード', 'Completed', '2001-01-08', NULL),
(51, 'Black Cat', 'https://myanimelist.cdn-dena.com/images/anime/11/75180l.jpg', 'Completing every job with ruthless accuracy, Train Heartnet is an infamous assassin with no regard for human life. Donning the moniker \"Black Cat\" in the underground world, the elite killer works for the powerful secret organization known only as Chronos.\r\n\r\nOne gloomy night, the blasé gunman stumbles upon Saya Minatsuki, an enigmatic bounty hunter, and soon develops an odd friendship with her. Influenced by Saya\'s positive outlook on life, Train begins to rethink his life. Deciding to abandon his role as the Black Cat, he instead opts to head down a virtuous path as an honest bounty hunter. However, Chronos—and particularly Creed Diskenth, Train\'s possessive underling—is not impressed with Train\'s sudden change of heart and vows to resort to extreme measures in order to bring back the emissary of bad luck.\r\n\r\nThis assassin turned \"stray cat\" can only wander so far before the deafening sound of gunfire rings out.', 'https://images4.alphacoders.com/783/thumb-1920-78394.jpg', 'https://www.youtube.com/embed/-ME7L45ui9g', 'ブラックキャット', 'Completed', '2005-10-05', NULL),
(52, 'Blue Dragon', 'https://myanimelist.cdn-dena.com/images/anime/2/20597.jpg', 'As Shu\'s village was being attacked by an unknown enemy, he and his friends, Jiro and Kluke decide to defend their home. They soon meet warrior Zola and receive the powers of Shadow, an ability that let\'s them transform their shadow into a powerful monster. Shu receives one of the most powerful monsters, Blue Dragon, and they all set out to defeat their enemy.\r\n', 'https://www.walldevil.com/wallpapers/a26/wallpaper-anime-dragon-blue.jpg', 'https://www.youtube.com/embed/c5BSuNgXjwc', 'ブルー・ドラゴン', 'Completed', '2007-04-07', NULL),
(53, 'Punch Line', 'http://img1.ak.crunchyroll.com/i/spire4/32364c0341343859046ed51f004216b41428009679_full.jpg', 'Yūta Iridatsu lives at the Korai House apartment complex with four girls: Mikatan Narugino, Ito Hikiotani, Meika Daihatsu, and Lovera Chichibu. One day, following a busjacking incident, Yūta finds himself ejected from his own body and becoming a spirit. Guided by the cat spirit Chiranosuke, Yūta must learn to master his spirit powers in order to protect his housemates from the various circumstances they find themselves in. However, if Yūta sees a girl\'s panties twice in a row, the Earth will be destroyed by a meteor.', 'https://images4.alphacoders.com/615/thumb-1920-615145.jpg', 'https://www.youtube.com/embed/hZPnz35JEl0', 'パンチライン', 'Completed', '2015-04-10', NULL),
(54, 'Aldnoah Zero', 'https://myanimelist.cdn-dena.com/images/anime/7/60263.jpg', 'It presents the fictional story of the Vers empire\'s 37 clans of Orbital Knights\' attempted reconquest of earth—enabled by the empowering titular Aldnoah energy/drive technology—following return to earth as a more technologically advanced people after a human diaspora to the planet Mars.', 'https://images6.alphacoders.com/607/thumb-1920-607185.jpg', 'https://www.youtube.com/embed/ibFyp9SGcTE', 'アルドノア・ゼロ', 'Completed', '2014-07-06', NULL),
(55, 'Cardcaptor Sakura', 'http://www.animenewsnetwork.com/thumbnails/hotlink-full/encyc/A126-1691590026.1442278236.jpg', 'Cardcaptor Sakura takes place in the fictional Japanese city of Tomoeda which is somewhere near Tokyo. Ten-year-old Sakura Kinomoto accidentally releases a set of magical cards known as Clow Cards from a book in her basement created and named after the sorcerer Clow Reed. Each card has its own unique ability and can assume an alternate form when activated.', 'https://akibento-leadnationmedia.netdna-ssl.com/blog/wp-content/uploads/2017/03/cardcaptor-sakura-surprise-news_1.jpeg', 'https://www.youtube.com/embed/luM4oGFSpT8', 'カードキャプターさくら', 'Completed', '1998-04-07', NULL),
(56, 'Soul Eater', 'https://myanimelist.cdn-dena.com/images/anime/9/7804.jpg', 'Set in the Shinigami technical school for weapon meisters, the series revolves around 3 groups of each a weapon meister and a human weapon. Trying to make the latter a \"Death Scythe\" and thus fit for use by the Shinigami, they must collect the souls of 99 evil humans and 1 witch.', 'https://wallpapercave.com/wp/Snk3CNz.jpg', 'https://www.youtube.com/embed/zzJ8U8OtEsE', 'ソウルイーター', 'Completed', '2008-04-07', NULL),
(57, 'Tsubasa Reservoir Chronicles', 'https://myanimelist.cdn-dena.com/images/anime/9/6555.jpg', 'The series begins by introducing childhood friends with quite a strong and close friendship: Syaoran, a young archaeologist who is investigating a ruin within the Kingdom of Clow, and Sakura, princess of the Kingdom of Clow and daughter of the late king Clow Reed. When Sakura visits Syaoran in the ruins, her spirit takes on the form of a pair of ghostly feathered wings that disintegrate to other dimensions.', 'https://www.walldevil.com/wallpapers/a88/tsubasa-reservoir-chronicle-sasuka-fai-kurogane-syaoran.jpg', 'https://www.youtube.com/embed/tmJRrnVFMt0', 'ツバサ・クロニクル', 'Completed', '2005-04-05', NULL),
(58, 'Danganronpa: Kibou no Gakuen to Zetsubou no Koukousei The Animation', 'https://myanimelist.cdn-dena.com/images/manga/2/106371.jpg', 'he series revolves around the elite high school, Hope\'s Peak Academy (希望ヶ峰学園 Kibōgamine Gakuen, lit. Kibogamine Academy), which, every year, selects \"Ultimate\" students (超高校級 chō-kōkō-kyū, lit. Super High School Level), talented high school students who are in the top of their field, along with one average \"Ultimate Lucky Student\" who is chosen by lottery.', 'http://static.minitokyo.net/downloads/16/48/619916.jpg', 'https://www.youtube.com/embed/Q01jVOI0d4w', 'ダンガンロンパ 希望の学園と絶望の高校生 THE ANIMATION', 'Completed', '2013-07-05', NULL),
(59, 'Chobits', 'http://static.zerochan.net/Chobits.full.32522.jpg', 'The series centers on the life of Hideki Motosuwa, a held-back student attempting to qualify for university by studying at Seki prep school in Tokyo. Besides a girlfriend, he dreams of having a persocom (パソコン): an android used as a personal computer, which is expensive. On his way home one evening, he stumbles across a persocom in the form of a beautiful girl with floor-length hair lying against a pile of trash bags, and he carries her home, not noticing that a disk fell on the ground. Upon turning her on, she instantly regards Hideki with adoration. The only word the persocom seems capable of saying is \"chi\" (ちぃ Chii), thus he names her that. Hideki assumes that there must be something wrong with her, and so the following morning he has his neighbor Hiromu Shinbo analyze her with his mobile persocom Sumomo. After Sumomo crashes during the attempt they conclude that she must be custom-built.', 'https://images4.alphacoders.com/246/246648.jpg', 'https://www.youtube.com/embed/DxsPKYq4OSc', 'ちょびっツ', 'Completed', '2002-04-03', NULL),
(60, 'Himouto! Umaru-chan', 'https://upload.wikimedia.org/wikipedia/en/1/1e/Him%C5%8Dto%21_Umaru-chan_volume_1_cover.jpg', 'The series follows Umaru Doma, a high school girl who lives with her older brother Taihei. At school, Umaru appears to be the ideal student with good looks, top grades, and a lot of talent. Once she gets home, however, she reverts into a layabout who spends her time lying around, playing video games, and constantly depending on her older brother, much to his dismay. Over the course of the series, Umaru\'s alternative personalities help her become friends with her female classmates Kirie Motoba, who has a reputation of glaring at people; and Sylphynford Tachibana, her competitive school rival; both of whom turn out to be little sisters of Taihei\'s coworkers.', 'https://images.alphacoders.com/711/thumb-1920-711497.jpg', 'https://www.youtube.com/embed/AiJCggDPVeA', '干物妹!うまるちゃん Himōto! Umaru-chan', 'Completed', '2015-07-09', NULL),
(61, 'Mushishi', 'https://myanimelist.cdn-dena.com/images/anime/2/73862.jpg', 'Mushishi is set in an imaginary time between the Edo and Meiji periods, featuring some 19th-century technology but with Japan still as a \"closed country\".[3] The story features ubiquitous creatures called Mushi (蟲) that often display what appear as supernatural powers. It is implied that there are many more lifeforms more primitive than \"normal\" living things such as animals, plants, fungi and bacteria, and Mushi is the most primitive of all. Due to their ethereal nature most humans are incapable of perceiving Mushi and are oblivious to their existence, but there are a few who possess the ability to see and interact with Mushi. One such person is Ginko (ギンコ), the main character of the series voiced by Yuto Nakano in the original version and by Travis Willingham in the English dub.[4][5] He employs himself as a Mushi Master (蟲師 mushi-shi), traveling from place to place to research Mushi and aid people suffering from problems caused by them.', 'http://www.imgbase.info/images/safe-wallpapers/anime/mushishi/21370_mushishi.jpg', 'https://www.youtube.com/embed/NcoZHk3M3io', '蟲師', 'Completed', '2005-10-23', NULL),
(62, 'Mobile Suit Gundam 00', 'http://img1.ak.crunchyroll.com/i/spire1/07074b150c56e91b313f93b8b246c0451489010084_full.jpg', 'The series is set in 2307 AD.[6] As a result of the depletion of fossil fuels, humanity had to search for a new source of power. The power was found in the form of multiple Dyson rings (massive arrays of solar power collectors) orbiting Earth, and supported by three orbital elevators, each one serving one of the three \"power blocs\" on the planet, namely Union, controlling the region surrounding North America; Human Reform League (Sino-Japanese: 人類革新連盟; Romaji: jinrui kakushin renmei; Pinyin: rénlèi géxīn liánméng), consisting of China, Russia and India; and AEU, which controls mainland Europe.', 'http://wallpapercave.com/wp/VuiQvug.jpg', 'https://www.youtube.com/embed/6BvNrcc4lgc', '機動戦士ガンダム00', 'Completed', '2007-10-06', '9.0000'),
(63, 'Oreimo', 'https://upload.wikimedia.org/wikipedia/en/8/8e/Ore_no_imouto_novel_v1_cover.jpg', 'Kyosuke Kosaka, a normal 17-year-old high school student living in Chiba,[4] has not gotten along with his younger sister Kirino in years. For longer than he can remember, Kirino has ignored his comings and goings and looked at him with spurning eyes. It seemed as if the relationship between Kyōsuke and his sister, now fourteen, would continue this way forever. One day however, Kyosuke finds a DVD case of a magical girl anime which had fallen in his house\'s entrance way. To Kyosuke\'s surprise, he finds a hidden eroge inside the case and he soon learns that both the DVD and the game belong to Kirino. That night, Kirino brings Kyosuke to her room and reveals herself to be an otaku with an extensive collection of moe anime and younger sister-themed eroge she has been collecting in secret. Kyosuke quickly becomes Kirino\'s confidant for her secret hobby. The series then follows Kyosuke\'s efforts to help his sister to reconcile her personal life with her secret hobbies, while restoring their broken relationship and coming to terms with their true feelings for each other.', 'https://www.walldevil.com/wallpapers/a74/oreimo.jpg', 'https://www.youtube.com/embed/cfsdcMoKTD4', '俺妹', 'Completed', '2010-10-03', NULL),
(64, 'Katanagatari', 'https://myanimelist.cdn-dena.com/images/anime/2/50023.jpg', 'Katanagatari is the story of Yasuri Shichika, a swordsman who fights without a sword, and Togame, an ambitious strategist who seeks to collect 12 legendary swords for the shogunate. The son of an exiled war hero, Shichika is the seventh head of the Kyotouryuu school of fighting and lives on isolated Fushou Island with his elder sister, Nanami. At the request of Togame, Shichika sets out on a journey across Edo-era Japan to locate the Deviant Blades, all wielded by formidable opponents. But in order to prove his loyalty to Togame, who has been betrayed before and relies on neither money nor honor, Shichika must fall in love.', 'http://jonvilma.com/images/katanagatari-1.jpg', 'https://www.youtube.com/embed/nocsfRZxt3M', '刀語', 'Completed', '2010-01-26', NULL),
(65, 'My Youth Romantic Comedy Is Wrong, As I Expected', 'https://myanimelist.cdn-dena.com/images/anime/11/49459.jpg', 'The story follows two loners: the pragmatic Hachiman Hikigaya and beautiful Yukino Yukinoshita, who, despite their varying personalities and ideals, offer help and advice to others as part of their school\'s Service Club, assisted by the cheerful and friendly Yui Yuigahama. It largely depicts various social situations faced by teens in a high school setting and the psychology driving their interactions.', 'https://bunny1ov3r.files.wordpress.com/2014/01/snafu-2.jpg', 'https://www.youtube.com/embed/u-bpwWPNEpE', 'やはり俺の青春ラブコメはまちがっている', 'Completed', '2013-04-05', NULL),
(66, 'Toradora!', 'https://myanimelist.cdn-dena.com/images/anime/13/22128.jpg', 'Ryuji Takasu is frustrated at trying to look his best as he enters his second year of high school. Despite his gentle personality, his eyes give him the appearance of an intimidating delinquent. He is happy to be classmates with his best friend Yusaku Kitamura, as well as the girl he has a crush on, Minori Kushieda. However, he unexpectedly runs into \"the school\'s most dangerous animal of the highest risk level\"—Taiga Aisaka—who just happens to be Minori\'s best friend. Taiga has a negative attitude towards others and has a habit of snapping violently at people. She takes an instant dislike to Ryuji, and it turns out she is living in an apartment facing Ryuji\'s house. When Ryuji discovers that Taiga has a crush on Yusaku, and Taiga finds out about Ryuji\'s affections towards Minori, they make an arrangement to help set each other up with their crushes.', 'http://stuffpoint.com/toradora/image/10463-toradora-toradora.jpg', 'https://www.youtube.com/embed/NYyVFBrHJFI', 'とらドラ!', 'Completed', '2008-10-02', NULL),
(67, 'Mirai Nikki', 'https://myanimelist.cdn-dena.com/images/anime/13/33465.jpg', 'Yukiteru Amano is a 14-year-old timid, daydreaming loner who observes life and jots down the events on his cell phone. His only friends are Deus Ex Machina, the God of Space and Time, and his assistant Muru Muru. Deus transforms Yukiteru\'s phone into a Future Diary, capable of predicting the future up to ninety days. Yukiteru discovers he and eleven others are part of a survival game orchestrated by Deus. The aim of this game is to eliminate the other diary holders, the winner succeeding Deus as god and can prevent the Apocalypse. Yukiteru finds himself protected by Yuno Gasai, a charming but psychopathic classmate who obsessively stalks him after they promised to go stargazing together a year before.', 'https://myanimelist.cdn-dena.com/s/common/uploaded_files/1441953309-7b73ed71506b7917241348f3a0cd84ac.jpeg', 'https://www.youtube.com/embed/cOmW9c43QkA', '未来日記', 'Completed', '2011-10-09', NULL),
(68, 'Dr. Slump', 'https://myanimelist.cdn-dena.com/images/anime/7/41289l.jpg', 'Dr. Slump is set in Penguin Village, a place where humans co-exist with all sorts of anthropomorphic animals and other objects. In this village lives Senbei Norimaki, an inventor. In the first chapter, he builds what he hopes will be the world\'s most perfect little girl robot, named Arale Norimaki. However, she turns out to be in severe need of eyeglasses. She is also very naïve, and in later issues she has adventures such as bringing a huge bear home, having mistaken it for a pet. To Senbei\'s credit, she does have super-strength. In general, the manga focuses on Arale\'s misunderstandings of humanity and Senbei\'s inventions, rivalries, and romantic misadventures. In the middle of the series, a recurring villain named Dr. Mashirito appears as a rival to Senbei.', 'http://cfile4.uf.tistory.com/image/2117DB3457F3919302FC8A', 'https://www.youtube.com/embed/MQ6YvFC6czQ', 'Dr. スランプ', 'Completed', '1981-04-08', NULL),
(69, 'Initial D First Stage', 'https://myanimelist.cdn-dena.com/images/anime/13/6801.jpg', 'The protagonist, Takumi Fujiwara, is a gas station attendant working with his friend Itsuki to buy a car, which they plan to drift on the twisting roads surrounding nearby Mount Akina. Unbeknownst to his colleagues, Takumi moonlights as a tofu delivery driver for his father\'s store before sunrise each morning, passively building an impressive amount of skill behind the wheel of the family car, an aging Toyota Sprinter Trueno.', 'https://wallpapercave.com/wp/oIkImQt.jpg', 'https://www.youtube.com/embed/3D4x6-8PIq4', '頭文字D', 'Completed', '1998-04-18', NULL),
(70, 'Saekano: How to Raise a Boring Girlfriend', 'http://img1.ak.crunchyroll.com/i/spire4/30eb07003c901066a9db027399c77ad41420598162_full.jpg', 'Tomoya Aki, a male high school teenager who works part-time to fund his otaku lifestyle (anime, dating sims, and related merchandise) encounters a beautiful girl one day during spring vacation. A month later, he finds out that the girl is his classmate, Megumi, who is hardly noticeable to her classmates. Hoping to create a visual novel computer game, he turns to school beauties Eriri Spencer Sawamura for designing the art, and Utaha Kasumigaoka for writing the game scenario. Tomoya then recruits Megumi to star as the \"heroine\" (the main character\'s love interest) of his game, thus forming the development team \"Blessing Software\", in which the three most renowned students in the school (Tomoya, Eriri, and Utaha) work on one of the least noticeable (Megumi). The series follows their adventures in developing the game and their plans to sell it at the Comiket convention, as well as the emotional entanglements among the team.', 'https://images6.alphacoders.com/633/thumb-1920-633121.png', 'https://www.youtube.com/embed/djsjWtBw2q0', '冴えない彼女 ヒロインの育てかた', 'Completed', '2015-01-09', NULL),
(71, 'Karakai Jouzu no Takagi-san', 'https://myanimelist.cdn-dena.com/images/anime/7/89990.jpg', '\"If you blush, you lose.\"\r\n\r\nLiving by this principle, the middle schooler Nishikata gets constantly made fun of by his seat neighbor Takagi-san. With his pride shattered to pieces, he vows to turn the tables and get back at her some day. And so, he attempts to tease her day after day, only to find himself victim to Takagi-san\'s ridicule again sooner than later. Will he be able to make Takagi-san blush from embarrassment even once in the end?', 'https://pre00.deviantart.net/1f9c/th/pre/f/2016/285/0/2/karakai_jouzu_no_takagi_san___yamamoto_souichirou_by_thebakamono-dakqi6k.png', 'https://www.youtube.com/embed/dAV3r5qV8d4', 'からかい上手の高木さん', 'Completed', '2018-01-08', NULL),
(72, 'Mobile Suit Gundam Wing', 'https://myanimelist.cdn-dena.com/images/anime/11/6613.jpg', 'The United Earth Sphere Alliance is a powerful military organization that has ruled over Earth and space colonies with an iron fist for several decades. When the colonies proclaimed their opposition to this, their leader was assassinated. Now, in the year After Colony 195, bitter colonial rebels have launched \"Operation Meteor,\" sending five powerful mobile suits to Earth for vengeance. Built out of virtually indestructible material called Gundanium Alloy, these \"Gundams\" begin an assault against the Alliance and its sub organization OZ.\r\n\r\nOne Gundam, whose pilot has taken the name of the slain colony leader Heero Yuy, is forced to make a crash landing into the ocean after an atmospheric battle against OZ\'s ace pilot Zechs Marquise. Upon coming ashore, he is found by Relena Peacecraft, daughter of a peace-seeking politician, who witnesses Heero\'s descent to Earth. Although neither of them realize it yet, this encounter will have a profound impact on both their lives, as well as those on Earth and in space colonies.', 'https://static.zerochan.net/Mobile.Suit.Gundam.Wing.full.34135.jpg', 'https://www.youtube.com/embed/EBqDyAvv-_M', '新機動戦記ガンダムW', 'Completed', '1995-04-07', '8.0000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(255) NOT NULL,
  `user_id` varchar(24) DEFAULT NULL,
  `hashed_password` varchar(255) DEFAULT NULL,
  `fav_genre` varchar(50) NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `user_id`, `hashed_password`, `fav_genre`, `profile_img`) VALUES
('losermister@gmail.com', 'losermister', '$2y$10$I5TV6HAjxq.KL8hrz4EIEOXX.oxlqJFRezIbA7evo.lFjNScOEMlu', 'Mecha', ''),
('ngmandyn@gmail.com', 'ngmandy', '$2y$10$D/lWeV36Kpy94RrnLKupxuCPR4ValuIqMRUZZexm9RaorsUvQg/BG', 'Action', ''),
('ngmandyn@sfu.ca', 'ngmandyn', '$2y$10$x1tXZ7DL6ArJo9.lcmlITOJe1uoPxxpCXz3Ati07RjyNn.YvoZ5Fe', 'Fantasy', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `email` (`email`),
  ADD KEY `video_url` (`video_url`);

--
-- Indexes for table `favourite_shows`
--
ALTER TABLE `favourite_shows`
  ADD PRIMARY KEY (`email`,`show_id`),
  ADD KEY `email` (`email`) USING BTREE,
  ADD KEY `show_id` (`show_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`show_id`,`genre`),
  ADD KEY `genre` (`genre`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`video_url`),
  ADD KEY `show_id` (`show_id`);

--
-- Indexes for table `oso_user_ratings`
--
ALTER TABLE `oso_user_ratings`
  ADD PRIMARY KEY (`email`,`show_id`),
  ADD KEY `email` (`email`),
  ADD KEY `show_id` (`show_id`);

--
-- Indexes for table `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`show_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`),
  ADD KEY `genre` (`fav_genre`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shows`
--
ALTER TABLE `shows`
  MODIFY `show_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`video_url`) REFERENCES `links` (`video_url`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `favourite_shows`
--
ALTER TABLE `favourite_shows`
  ADD CONSTRAINT `favourite_shows_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `favourite_shows_ibfk_2` FOREIGN KEY (`show_id`) REFERENCES `shows` (`show_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `links_ibfk_1` FOREIGN KEY (`show_id`) REFERENCES `shows` (`show_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `oso_user_ratings`
--
ALTER TABLE `oso_user_ratings`
  ADD CONSTRAINT `oso_user_ratings_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `oso_user_ratings_ibfk_2` FOREIGN KEY (`show_id`) REFERENCES `shows` (`show_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fav_genre`) REFERENCES `genres` (`genre`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
