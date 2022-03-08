-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 08 Mar 2022, 11:51:48
-- Sunucu sürümü: 10.4.18-MariaDB
-- PHP Sürümü: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `testing`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` varchar(250) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `chat_message`
--

INSERT INTO `chat_message` (`chat_message_id`, `to_user_id`, `from_user_id`, `chat_message`, `timestamp`, `status`) VALUES
(248, 101, 96, 'selam naber', '2022-02-26 18:52:32', 0),
(249, 101, 96, 'nasılsın', '2022-02-26 18:52:32', 0),
(250, 96, 101, 'iyiyim sağol', '2022-02-26 18:52:42', 0),
(251, 96, 101, '\nsen nasılsın', '2022-02-26 18:52:47', 0),
(252, 103, 96, 'selam', '2022-02-27 02:01:51', 0),
(253, 96, 103, 'selam naber', '2022-02-27 02:02:03', 0),
(254, 103, 96, 'iyidir senden?\n', '2022-02-27 02:02:15', 0),
(255, 96, 103, '\niyilik nolsun', '2022-02-27 02:02:38', 0),
(256, 103, 96, 'ne var ne yok\n', '2022-02-27 02:02:55', 0),
(257, 96, 103, '\naynı bea nolsun', '2022-02-27 02:03:19', 0),
(258, 104, 96, 'naber', '2022-02-27 02:09:06', 0),
(259, 96, 104, 'iyilik senden', '2022-02-27 02:09:13', 0),
(260, 104, 96, 'iyi valla nolsun\n', '2022-02-27 02:09:31', 0),
(261, 96, 104, '\ngörüşelim senle bi gün', '2022-02-27 02:10:24', 0),
(262, 96, 104, '\nne dersin', '2022-02-27 02:10:28', 0),
(263, 104, 96, 'olur valla', '2022-02-27 02:10:36', 0),
(264, 104, 96, '\nne zaman görüşelim', '2022-02-27 02:10:46', 0),
(265, 96, 104, 'fark etmez\n', '2022-02-27 02:11:19', 0),
(266, 96, 104, 'yarın uygun mu?', '2022-02-27 02:11:24', 0),
(267, 104, 96, 'olur saat kaçta?\n', '2022-02-27 02:11:46', 0),
(268, 96, 104, '\nöğlen gibi görüşelim', '2022-02-27 02:12:29', 0),
(269, 104, 96, 'iyi olur', '2022-02-27 02:12:41', 0),
(270, 104, 96, '\nhem pazar günü', '2022-02-27 02:12:46', 0),
(271, 104, 96, '\ndaha rahat olur', '2022-02-27 02:12:51', 0),
(272, 96, 104, 'aynen öyle\n', '2022-02-27 02:13:04', 0),
(273, 105, 96, 'hi', '2022-02-27 16:21:22', 0),
(274, 105, 96, '\nhow are you', '2022-02-27 16:21:22', 0),
(275, 96, 105, 'hi I\'m fine', '2022-02-27 16:21:37', 0),
(276, 96, 105, '\nwhat about you', '2022-02-27 16:21:42', 0),
(277, 105, 96, '\nme too fine', '2022-02-27 16:21:58', 0),
(278, 96, 105, '\ngood good', '2022-02-27 16:22:17', 0),
(279, 96, 105, 'are you student', '2022-02-27 16:22:32', 0),
(280, 105, 96, '\nyes I\'m student', '2022-02-27 16:22:48', 0),
(281, 96, 105, 'good\n', '2022-02-27 16:23:07', 0),
(282, 105, 96, 'so you?', '2022-02-27 16:23:38', 0),
(283, 96, 105, 'I\'m enginner\n', '2022-02-27 16:23:47', 0),
(284, 105, 96, 'software?\n', '2022-02-27 16:24:03', 0),
(285, 96, 105, '\nyesss', '2022-02-27 16:24:12', 0),
(286, 105, 96, '\nooo great', '2022-02-27 16:24:28', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `friend_request`
--

CREATE TABLE `friend_request` (
  `request_id` int(11) NOT NULL,
  `request_from_id` int(11) NOT NULL,
  `request_to_id` int(11) NOT NULL,
  `request_status` enum('Pending','Confirm','Reject') NOT NULL,
  `request_notification_status` enum('No','Yes') NOT NULL,
  `request_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `friend_request`
--

INSERT INTO `friend_request` (`request_id`, `request_from_id`, `request_to_id`, `request_status`, `request_notification_status`, `request_datetime`) VALUES
(42, 97, 96, 'Confirm', 'Yes', '2022-02-19 23:23:04'),
(43, 96, 97, 'Confirm', 'Yes', '2022-02-19 23:30:32'),
(45, 98, 96, 'Confirm', 'Yes', '2022-02-20 00:46:25'),
(46, 96, 98, 'Confirm', 'Yes', '2022-02-20 00:47:10'),
(47, 99, 96, 'Confirm', 'Yes', '2022-02-21 10:38:36'),
(48, 96, 99, 'Confirm', 'Yes', '2022-02-21 10:40:57'),
(49, 100, 96, 'Confirm', 'Yes', '2022-02-25 20:41:12'),
(50, 96, 100, 'Confirm', 'Yes', '2022-02-25 20:42:20'),
(51, 101, 96, 'Confirm', 'Yes', '2022-02-25 23:49:54'),
(52, 96, 101, 'Confirm', 'Yes', '2022-02-25 23:50:43'),
(53, 103, 96, 'Confirm', 'Yes', '2022-02-27 01:59:46'),
(54, 96, 103, 'Confirm', 'Yes', '2022-02-27 02:00:39'),
(55, 104, 96, 'Confirm', 'Yes', '2022-02-27 02:08:02'),
(56, 96, 104, 'Confirm', 'Yes', '2022-02-27 02:08:40'),
(57, 105, 96, 'Confirm', 'Yes', '2022-02-27 15:41:27'),
(58, 96, 105, 'Confirm', 'Yes', '2022-02-27 16:16:29');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `login_data`
--

CREATE TABLE `login_data` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_otp` int(6) NOT NULL,
  `last_activity` datetime NOT NULL,
  `login_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_type` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `login_data`
--

INSERT INTO `login_data` (`login_details_id`, `user_id`, `login_otp`, `last_activity`, `login_datetime`, `is_type`) VALUES
(90, 94, 935418, '2020-02-22 12:11:40', '2022-02-19 23:11:40', 'no'),
(91, 94, 614353, '2020-02-22 12:12:33', '2022-02-19 23:12:33', 'no'),
(92, 94, 718385, '2020-02-22 12:13:29', '2022-02-19 23:13:29', 'no'),
(93, 95, 319782, '2020-02-22 12:16:31', '2022-02-19 23:16:31', 'no'),
(94, 95, 135682, '2020-02-22 12:17:25', '2022-02-19 23:17:25', 'no'),
(95, 96, 724660, '2022-02-20 04:09:48', '2022-02-20 01:09:48', 'no'),
(96, 97, 146202, '2022-02-20 03:24:42', '2022-02-20 00:24:42', 'no'),
(97, 98, 207178, '2020-02-22 01:45:05', '2022-02-20 00:45:05', 'no'),
(98, 96, 141894, '2022-02-21 14:25:06', '2022-02-21 11:25:06', 'no'),
(99, 99, 243668, '2022-02-21 14:25:06', '2022-02-21 11:25:06', 'no'),
(100, 96, 589279, '2022-02-25 23:55:21', '2022-02-25 20:55:21', 'no'),
(101, 100, 435002, '2022-02-25 23:55:22', '2022-02-25 20:55:22', 'no'),
(102, 100, 482212, '2022-02-27 00:28:11', '2022-02-26 21:28:11', 'no'),
(103, 96, 436964, '2022-02-27 00:28:09', '2022-02-26 21:28:09', 'no'),
(104, 101, 110694, '2022-02-27 00:27:47', '2022-02-26 21:27:47', 'no'),
(105, 96, 775284, '2022-02-27 04:22:10', '2022-02-27 01:22:10', 'no'),
(106, 102, 532518, '2022-02-27 04:22:21', '2022-02-27 01:22:21', 'no'),
(107, 96, 750802, '2022-02-27 05:16:50', '2022-02-27 02:16:50', 'no'),
(108, 103, 416847, '2022-02-27 05:16:54', '2022-02-27 02:16:54', 'no'),
(109, 104, 778113, '2022-02-27 05:16:51', '2022-02-27 02:16:51', 'no'),
(110, 96, 722855, '2022-02-27 18:31:48', '2022-02-27 15:31:48', 'no'),
(111, 105, 551140, '2022-02-27 20:43:41', '2022-02-27 17:43:41', 'no'),
(112, 96, 509746, '2022-02-27 19:36:21', '2022-02-27 16:36:21', 'no'),
(113, 96, 355469, '2022-02-27 21:35:07', '2022-02-27 18:35:07', 'no'),
(114, 107, 575391, '2022-02-27 20:54:25', '2022-02-27 17:54:25', 'no'),
(115, 108, 767908, '2022-02-27 21:05:46', '2022-02-27 18:05:46', 'no');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `media_table`
--

CREATE TABLE `media_table` (
  `media_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `media_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `posts_table`
--

CREATE TABLE `posts_table` (
  `posts_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_content` text NOT NULL,
  `post_code` varchar(100) NOT NULL,
  `post_datetime` datetime NOT NULL,
  `post_status` enum('Publish','Draft') NOT NULL,
  `post_type` enum('Text','Media') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `posts_table`
--

INSERT INTO `posts_table` (`posts_id`, `user_id`, `post_content`, `post_code`, `post_datetime`, `post_status`, `post_type`) VALUES
(70, 96, 'hello there, what\'s up?', '9b9b129806ff0cca3fcff5ae9a0045a4', '2022-02-27 19:14:28', 'Publish', 'Text'),
(71, 105, 'have nice day...', 'afe2fcc735e222f4f9a49e72b56db140', '2022-02-27 19:17:19', 'Publish', 'Text');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `register_user`
--

CREATE TABLE `register_user` (
  `register_user_id` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_password` varchar(250) NOT NULL,
  `user_activation_code` varchar(250) NOT NULL,
  `user_email_status` enum('not verified','verified') NOT NULL,
  `user_otp` int(11) NOT NULL,
  `user_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_avatar` varchar(100) NOT NULL,
  `user_birthdate` date NOT NULL,
  `user_gender` enum('Erkek','Kadın') CHARACTER SET utf8mb4 NOT NULL,
  `user_address` text CHARACTER SET utf8mb4 NOT NULL,
  `user_city` varchar(250) NOT NULL,
  `user_zipcode` varchar(30) NOT NULL,
  `user_state` varchar(250) NOT NULL,
  `user_country` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `register_user`
--

INSERT INTO `register_user` (`register_user_id`, `user_name`, `user_email`, `user_password`, `user_activation_code`, `user_email_status`, `user_otp`, `user_datetime`, `user_avatar`, `user_birthdate`, `user_gender`, `user_address`, `user_city`, `user_zipcode`, `user_state`, `user_country`) VALUES
(96, 'rikefih', 'rikefih399@submic.com', '$2y$10$2m4AXJMfD87KLOksL8nzP.fJiA16WLH89tBCRqbJbpqxKdFUgK0Mq', '253ce15bcd8efee128c0d5d88171663c', 'verified', 688009, '2022-02-19 23:19:24', 'avatar/1645312749.png', '0000-00-00', 'Erkek', '', '', '', '', ''),
(97, 'purze', 'purzevomli@vusra.com', '$2y$10$X4cLTFkefSLWVH.LEfVYjOoygF2YODlNeIKsedp5EvTXNNw6tv7sy', '0c459b7848cb7ad8938b9c176c6a14b8', 'verified', 849326, '2022-02-19 23:21:06', 'avatar/1645312835.png', '0000-00-00', 'Erkek', '', '', '', '', ''),
(98, 'Defyi', 'defyikelmi@vusra.com', '$2y$10$4/Lb9pPvvZFNWbpG7dB9xeRLd4sPSY/1dZIkXKAT6xR9S9Nen47vm', '1cc753663ce95dc03ad87634ec7a57aa', 'verified', 938264, '2022-02-20 00:44:52', 'avatar/1645317849.png', '0000-00-00', 'Erkek', '', '', '', '', ''),
(99, 'Bumlaca', 'bumlacagni@vusra.com', '$2y$10$WOlr/qMqsl0/Ry7vv0eiYu1BgbGKbRQYAwdpWH/BFcyrGvdHso/lS', '8ea7a9e756aeb5fd6679f90523064b44', 'verified', 319321, '2022-02-21 10:36:23', 'avatar/1645439755.png', '0000-00-00', 'Erkek', '', '', '', '', ''),
(100, 'Susto', 'sustobaspo@vusra.com', '$2y$10$7lGSpeAy516n8P38vemyy.JvaxVnhR.DyYHlL2ZmmZ/fPmQ66Hsjy', '2cb34791ff9aed77dbef5469c9d0850d', 'verified', 822380, '2022-02-25 20:38:23', 'avatar/1645821452.png', '0000-00-00', 'Erkek', '', '', '', '', ''),
(101, 'rugnego', 'rugnegokki@vusra.com', '$2y$10$aAn2JseejN4rEVzO0rDnNeBtiFEjLeRqyvzQsoGZ3DIExRHtXRO/W', '38b8c5ffedaed917d75284c65d6b3dbe', 'verified', 790008, '2022-02-25 23:48:23', 'avatar/1645832873.png', '0000-00-00', 'Erkek', '', '', '', '', ''),
(102, 'zoltibalta', 'zoltibalta@vusra.com', '$2y$10$SFEpq8mbFZdo7Ay.qJlSye8aUfCONmmR6gBdNtxeNtu7OaTujAtHG', '2ffbb39a5ab30d2937319c869de175df', 'verified', 256608, '2022-02-27 00:57:52', 'avatar/1645923443.png', '0000-00-00', 'Erkek', '', '', '', '', ''),
(103, 'nikazudre', 'nikkazudre@vusra.com', '$2y$10$5q9Nlk9J8ixdOQkPKc/qFui0n3aZY3//sCFwAfyw9bgGw4K9pmXoW', 'ee1656089943adff23b71b50aac32312', 'verified', 788885, '2022-02-27 01:57:26', 'avatar/1645927009.png', '0000-00-00', 'Erkek', '', '', '', '', ''),
(104, 'pupsi', 'rirtipupsi@vusra.com', '$2y$10$daLF9X3T6A5.PaOiLabhUOajuHvE5ZAIqOnYziweO0iGVIApNhI36', '1cbd9a14be22860280db68131672d3b5', 'verified', 981243, '2022-02-27 02:04:30', 'avatar/1645927445.png', '0000-00-00', 'Erkek', '', '', '', '', ''),
(105, 'Zaki', 'zakkitulto@vusra.com', '$2y$10$AgmlxbwfWyJIpUqjYtjVQ.2Dqvw9BM7vCKRg.nP1MDakaiZ0Ct.A6', 'e434f82e289e56d48d4b4b277a3ac337', 'verified', 292913, '2022-02-27 15:39:59', 'avatar/1645976369.png', '0000-00-00', 'Erkek', '', '', '', '', ''),
(106, 'Adem', 'ladebackone@mobisi.site', '$2y$10$5srakmOR.gsinZ1vP/5Of.IIYrYTipzZTbjdvl2W4cCtnIbBC5Ux.', '42404b60d0e2f2d605bbe2092d3bdb48', 'not verified', 879494, '2022-02-27 17:40:54', 'avatar/1645983654.png', '0000-00-00', 'Erkek', '', '', '', '', ''),
(107, 'Leec', 'leechcrudden50094@randomail.io', '$2y$10$MzSL2Qnzz5gXUpYKyr5vxuuexd9JYzJxFZNSEEYiPmTeC5ZjKLeeG', 'cec98636a3fb62fb9f45256e6a7cfd41', 'verified', 635205, '2022-02-27 17:53:29', 'avatar/1645984370.png', '0000-00-00', 'Erkek', '', '', '', '', ''),
(108, 'Mahyan', 'mahanyjamaah26437@randomail.io', '$2y$10$N5v45cZn9mZ69xgUmuacAujMP8OlfZJBkQbGz64uRbbXHMF0PYuk2', 'db8cc6f9cf7c29f69719aed92c05c8b2', 'verified', 190617, '2022-02-27 18:05:13', 'avatar/1645984726.png', '0000-00-00', 'Erkek', '', '', '', '', ''),
(109, 'Filgu', 'filguierasgaudreau@fakemail.io', '$2y$10$fvkMP9wdtHNqLhCiqIDUv.nWW0ygRN7NW4KVzC6zH.ExQEWC1GZLm', '09800417d8c30f2a27fe39a42049b727', 'verified', 259546, '2022-02-27 18:06:49', 'avatar/1645985173.png', '0000-00-00', 'Erkek', '', '', '', '', ''),
(110, 'G&ouml;kten', 'goktenmishra21207@randomail.io', '$2y$10$v4O86SsGuUwWxSytkmkGTORMABCdp6nPpDdiM2WnvCXwGOqDhhO62', '481b542e7afd19d236a2d5cc3425f682', 'verified', 101229, '2022-02-27 18:14:14', 'avatar/1645985638.png', '0000-00-00', 'Erkek', '', '', '', '', '');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Tablo için indeksler `friend_request`
--
ALTER TABLE `friend_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Tablo için indeksler `login_data`
--
ALTER TABLE `login_data`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Tablo için indeksler `media_table`
--
ALTER TABLE `media_table`
  ADD PRIMARY KEY (`media_id`);

--
-- Tablo için indeksler `posts_table`
--
ALTER TABLE `posts_table`
  ADD PRIMARY KEY (`posts_id`);

--
-- Tablo için indeksler `register_user`
--
ALTER TABLE `register_user`
  ADD PRIMARY KEY (`register_user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- Tablo için AUTO_INCREMENT değeri `friend_request`
--
ALTER TABLE `friend_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Tablo için AUTO_INCREMENT değeri `login_data`
--
ALTER TABLE `login_data`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- Tablo için AUTO_INCREMENT değeri `media_table`
--
ALTER TABLE `media_table`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `posts_table`
--
ALTER TABLE `posts_table`
  MODIFY `posts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Tablo için AUTO_INCREMENT değeri `register_user`
--
ALTER TABLE `register_user`
  MODIFY `register_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
