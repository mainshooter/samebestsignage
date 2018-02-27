-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 27 feb 2018 om 13:06
-- Serverversie: 10.1.26-MariaDB
-- PHP-versie: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticket`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categorys`
--

CREATE TABLE `categorys` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `categorys`
--

INSERT INTO `categorys` (`cat_id`, `cat_name`, `cat_info`) VALUES
(1, 'Unknown', 'The cause of the problem is unknown'),
(2, 'Hardware Failure', 'The hardware is not fit for use'),
(3, 'Software Bug', 'There is a software bug'),
(4, 'Content Change', 'The customer asked for a content change'),
(5, 'Update Failure', 'The android update failed');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_tel` varchar(30) NOT NULL,
  `client_email` varchar(100) NOT NULL,
  `client_country` varchar(100) NOT NULL,
  `client_state` varchar(100) NOT NULL,
  `client_city` varchar(100) NOT NULL,
  `client_street` varchar(255) NOT NULL,
  `client_street_number` varchar(50) NOT NULL,
  `client_zipcode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `clients`
--

INSERT INTO `clients` (`client_id`, `client_name`, `client_tel`, `client_email`, `client_country`, `client_state`, `client_city`, `client_street`, `client_street_number`, `client_zipcode`) VALUES
(1, 'IdSignage', '+31-0341-555666', 'info@idsignage.nl', 'The Netherlands', 'Gelderland', 'Tiel', 'Morsestraat', '11C', '4004 JP'),
(2, 'Jordi Inc.', '0646366593', 'jordi.schaap@outlook.com', 'The Netherlands', 'Gelderland', 'IJzendoorn', 'Dorpstraat', '32A', '4053NH');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `importance_types`
--

CREATE TABLE `importance_types` (
  `importance_id` int(11) NOT NULL,
  `importance_name` varchar(255) NOT NULL,
  `importance_info` text NOT NULL,
  `importance_color` varchar(50) DEFAULT NULL,
  `importance_level` enum('Immediately','Fast','Normal','Slow','Extremely Slow') NOT NULL DEFAULT 'Immediately'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `importance_types`
--

INSERT INTO `importance_types` (`importance_id`, `importance_name`, `importance_info`, `importance_color`, `importance_level`) VALUES
(1, 'Immediately', 'Must be taken care of immediately', '#dc3545', 'Immediately'),
(2, 'Fast', 'Must be taken care of fast but not immediately', '#ffc107', 'Fast'),
(3, 'Normal', 'No need to solve it fast but don\'t be to slow', '#17a2b8', 'Normal'),
(4, 'Slow', 'No need to hurry', '#28a745', 'Slow'),
(8, 'Extremely Slow', 'Just sit back and let it solve itself', '#aaaaaa', 'Extremely Slow');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `logins`
--

CREATE TABLE `logins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` text NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `logins`
--

INSERT INTO `logins` (`id`, `user_id`, `ip_address`, `date`) VALUES
(1, 6, '', '2018-01-31 14:12:45'),
(2, 6, '', '2018-01-30 14:12:45'),
(3, 6, '', '2018-01-29 14:12:45'),
(4, 6, '', '2018-01-28 14:12:45'),
(5, 6, '', '2018-01-30 14:12:45'),
(6, 6, '', '2018-01-30 14:12:45'),
(7, 6, '', '2018-01-29 14:12:45'),
(8, 6, '', '2018-01-29 14:12:45'),
(9, 6, '', '2018-01-29 14:12:45'),
(10, 6, '', '2018-01-29 14:12:45'),
(11, 6, '', '2018-01-29 14:12:45'),
(12, 6, '', '2018-01-31 14:27:53'),
(13, 6, '', '2018-01-31 14:27:53'),
(14, 6, '', '2018-01-31 15:10:01'),
(15, 10, '', '2018-01-31 15:10:53'),
(16, 6, '', '2018-01-31 15:12:25'),
(17, 6, '', '2018-01-31 15:13:10'),
(18, 10, '', '2018-01-31 15:13:54'),
(19, 10, '', '2018-01-31 15:14:51'),
(20, 6, '', '2018-01-31 15:15:07'),
(21, 6, '', '2018-01-31 15:19:51'),
(22, 6, '', '2018-02-01 09:39:17'),
(23, 6, '', '2018-02-01 16:19:16'),
(24, 6, '', '2018-02-01 16:19:42'),
(25, 6, '', '2018-02-01 16:19:43'),
(26, 6, '', '2018-02-02 09:14:28'),
(27, 6, '', '2018-02-02 09:14:31'),
(28, 6, '', '2018-02-06 09:06:50'),
(29, 6, '', '2018-02-06 11:28:25'),
(30, 6, '', '2018-02-06 11:52:15'),
(31, 6, '', '2018-02-06 11:52:16'),
(32, 6, '', '2018-02-06 11:53:33'),
(33, 6, '', '2018-02-06 12:54:22'),
(34, 10, '', '2018-02-06 15:52:29'),
(35, 6, '', '2018-02-06 15:52:39'),
(36, 6, '', '2018-02-06 16:04:55'),
(37, 6, '', '2018-02-06 16:04:56'),
(38, 6, '', '2018-02-08 09:24:55'),
(39, 6, '', '2018-02-08 10:39:32'),
(40, 6, '', '2018-02-08 10:39:32'),
(41, 6, '', '2018-02-08 10:43:01'),
(42, 6, '', '2018-02-08 11:26:59'),
(43, 6, '', '2018-02-08 13:47:19'),
(44, 6, '', '2018-02-08 13:51:13'),
(45, 6, '', '2018-02-08 14:53:45'),
(46, 6, '', '2018-02-08 15:06:00'),
(47, 6, '', '2018-02-08 16:12:41'),
(48, 6, '', '2018-02-08 16:13:10'),
(49, 6, '', '2018-02-08 16:13:49'),
(50, 6, '', '2018-02-08 16:14:21'),
(51, 6, '', '2018-02-08 16:27:12'),
(52, 6, '', '2018-02-09 09:24:31'),
(53, 6, '', '2018-02-09 09:34:10'),
(54, 6, '', '2018-02-09 10:05:47'),
(55, 6, '', '2018-02-09 10:08:51'),
(56, 6, '', '2018-02-09 10:11:44'),
(57, 11, '', '2018-02-09 10:23:15'),
(58, 6, '', '2018-02-09 11:47:09'),
(59, 6, '', '2018-02-09 13:04:44'),
(60, 6, '', '2018-02-09 14:27:13'),
(61, 6, '', '2018-02-09 14:27:45'),
(62, 6, '127.0.0.1', '2018-02-09 14:29:14'),
(63, 6, '127.0.0.1', '2018-02-09 14:29:39'),
(64, 6, '127.0.0.1', '2018-02-09 14:41:54'),
(65, 6, '127.0.0.1', '2018-02-13 09:09:22'),
(66, 6, '192.168.43.1', '2018-02-13 15:14:08'),
(67, 10, '127.0.0.1', '2018-02-13 15:22:20'),
(68, 6, '127.0.0.1', '2018-02-13 18:01:31'),
(69, 6, '127.0.0.1', '2018-02-15 10:04:51'),
(70, 6, '127.0.0.1', '2018-02-15 13:57:50'),
(71, 6, '127.0.0.1', '2018-02-16 09:41:12'),
(72, 6, '127.0.0.1', '2018-02-16 10:05:47'),
(73, 6, '127.0.0.1', '2018-02-20 09:07:50'),
(74, 6, '127.0.0.1', '2018-02-21 09:24:20'),
(75, 6, '192.168.43.1', '2018-02-21 10:01:04'),
(76, 6, '192.168.43.1', '2018-02-21 10:31:09'),
(77, 6, '127.0.0.1', '2018-02-21 16:47:29'),
(78, 6, '127.0.0.1', '2018-02-22 09:23:37'),
(79, 6, '192.168.43.1', '2018-02-22 09:57:09'),
(80, 6, '192.168.43.1', '2018-02-22 11:20:16'),
(81, 6, '127.0.0.1', '2018-02-22 13:07:11'),
(82, 6, '192.168.43.1', '2018-02-22 14:25:10'),
(83, 6, '192.168.43.1', '2018-02-22 14:56:31'),
(84, 6, '127.0.0.1', '2018-02-22 15:07:32'),
(85, 6, '127.0.0.1', '2018-02-22 16:25:49'),
(86, 6, '127.0.0.1', '2018-02-23 09:09:03'),
(87, 6, '192.168.43.1', '2018-02-23 13:21:08'),
(88, 6, '127.0.0.1', '2018-02-27 09:11:30'),
(89, 6, '192.168.43.1', '2018-02-27 11:06:45'),
(90, 11, '192.168.43.1', '2018-02-27 11:23:04'),
(91, 11, '192.168.43.1', '2018-02-27 11:25:59'),
(92, 6, '192.168.43.1', '2018-02-27 11:26:34'),
(93, 6, '127.0.0.1', '2018-02-27 12:49:14'),
(94, 1, '127.0.0.1', '2018-02-27 12:52:56'),
(95, 1, '127.0.0.1', '2018-02-27 12:54:00');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `mail_config`
--

CREATE TABLE `mail_config` (
  `id` int(11) NOT NULL,
  `protocol` varchar(255) NOT NULL DEFAULT 'smtp',
  `smtp_host` varchar(255) NOT NULL DEFAULT 'smtp.gmail.com',
  `smtp_user` varchar(255) NOT NULL,
  `smtp_pass` varchar(255) NOT NULL,
  `smtp_port` varchar(255) NOT NULL DEFAULT '25',
  `smtp_timeout` varchar(255) NOT NULL DEFAULT '5',
  `smtp_crypto` varchar(255) DEFAULT NULL,
  `mailtype` varchar(255) NOT NULL DEFAULT 'html',
  `newline` varchar(255) NOT NULL DEFAULT '\\r\\n',
  `crlf` varchar(255) NOT NULL DEFAULT '\\r\\n',
  `charset` varchar(255) NOT NULL DEFAULT 'utf-8',
  `validate` tinyint(1) NOT NULL DEFAULT '0',
  `priority` varchar(255) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `mail_config`
--

INSERT INTO `mail_config` (`id`, `protocol`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`, `smtp_timeout`, `smtp_crypto`, `mailtype`, `newline`, `crlf`, `charset`, `validate`, `priority`) VALUES
(0, 'smtp', 'smtp.gmail.com', '', '', '25', '5', NULL, 'html', '\\r\\n', '\\r\\n', 'utf-8', 0, '2'),
(1, 'smtp', 'smtp.gmail.com', 'phpmailertest12@gmail.com', 'ditiseentest', '25', '5', '', 'html', '\\r\\n', '\\r\\n', 'utf-8', 0, '3');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `mail_templates`
--

CREATE TABLE `mail_templates` (
  `id` int(11) NOT NULL,
  `subject` varchar(1000) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `mail_templates`
--

INSERT INTO `mail_templates` (`id`, `subject`, `content`) VALUES
(1, 'There is a ticket waiting for you', '<!DOCTYPE html>\r\n<html lang=\"en\" xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\r\n<head>\r\n    <meta charset=\"utf-8\"> <!-- utf-8 works for most cases -->\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"> <!-- Use the latest (edge) version of IE rendering engine -->\r\n    <meta name=\"x-apple-disable-message-reformatting\">  <!-- Disable auto-scale in iOS 10 Mail entirely -->\r\n    <title>({[!TITLE!]})</title> <!-- The title tag shows in email notifications, like Android 4.4. -->\r\n\r\n    <!-- Web Font / @font-face : BEGIN -->\r\n    <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->\r\n\r\n    <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->\r\n    <!--[if mso]>\r\n    <style>\r\n        * {\r\n            font-family: sans-serif !important;\r\n        }\r\n    </style>\r\n    <![endif]-->\r\n\r\n    <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->\r\n    <!--[if !mso]><!-->\r\n    <!-- insert web font reference, eg: <link href=\'https://fonts.googleapis.com/css?family=Roboto:400,700\' rel=\'stylesheet\' type=\'text/css\'> -->\r\n    <!--<![endif]-->\r\n\r\n    <!-- Web Font / @font-face : END -->\r\n\r\n    <!-- CSS Reset : BEGIN -->\r\n    <style>\r\n\r\n        /* What it does: Remove spaces around the email design added by some email clients. */\r\n        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */\r\n        html,\r\n        body {\r\n            margin: 0 auto !important;\r\n            padding: 0 !important;\r\n            height: 100% !important;\r\n            width: 100% !important;\r\n        }\r\n\r\n        /* What it does: Stops email clients resizing small text. */\r\n        * {\r\n            -ms-text-size-adjust: 100%;\r\n            -webkit-text-size-adjust: 100%;\r\n        }\r\n\r\n        /* What it does: Centers email on Android 4.4 */\r\n        div[style*=\"margin: 16px 0\"] {\r\n            margin: 0 !important;\r\n        }\r\n\r\n        /* What it does: Stops Outlook from adding extra spacing to tables. */\r\n        table,\r\n        td {\r\n            mso-table-lspace: 0pt !important;\r\n            mso-table-rspace: 0pt !important;\r\n        }\r\n\r\n        /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */\r\n        table {\r\n            border-spacing: 0 !important;\r\n            border-collapse: collapse !important;\r\n            table-layout: fixed !important;\r\n            margin: 0 auto !important;\r\n        }\r\n        table table table {\r\n            table-layout: auto;\r\n        }\r\n\r\n        /* What it does: Uses a better rendering method when resizing images in IE. */\r\n        img {\r\n            -ms-interpolation-mode:bicubic;\r\n        }\r\n\r\n        /* What it does: A work-around for email clients meddling in triggered links. */\r\n        *[x-apple-data-detectors],  /* iOS */\r\n        .x-gmail-data-detectors,    /* Gmail */\r\n        .x-gmail-data-detectors *,\r\n        .aBn {\r\n            border-bottom: 0 !important;\r\n            cursor: default !important;\r\n            color: inherit !important;\r\n            text-decoration: none !important;\r\n            font-size: inherit !important;\r\n            font-family: inherit !important;\r\n            font-weight: inherit !important;\r\n            line-height: inherit !important;\r\n        }\r\n\r\n        /* What it does: Prevents Gmail from displaying an download button on large, non-linked images. */\r\n        .a6S {\r\n            display: none !important;\r\n            opacity: 0.01 !important;\r\n        }\r\n        /* If the above doesn\'t work, add a .g-img class to any image in question. */\r\n        img.g-img + div {\r\n            display: none !important;\r\n        }\r\n\r\n        /* What it does: Prevents underlining the button text in Windows 10 */\r\n        .button-link {\r\n            text-decoration: none !important;\r\n        }\r\n\r\n        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */\r\n        /* Create one of these media queries for each additional viewport size you\'d like to fix */\r\n        /* Thanks to Eric Lepetit (@ericlepetitsf) for help troubleshooting */\r\n        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) { /* iPhone 6 and 6+ */\r\n            .email-container {\r\n                min-width: 375px !important;\r\n            }\r\n        }\r\n\r\n        @media screen and (max-width: 480px) {\r\n            /* What it does: Forces Gmail app to display email full width */\r\n            div > u ~ div .gmail {\r\n                min-width: 100vw;\r\n            }\r\n        }\r\n\r\n    </style>\r\n    <!-- CSS Reset : END -->\r\n\r\n    <!-- Progressive Enhancements : BEGIN -->\r\n    <style>\r\n\r\n        /* What it does: Hover styles for buttons */\r\n        .button-td,\r\n        .button-a {\r\n            transition: all 100ms ease-in;\r\n        }\r\n        .button-td:hover,\r\n        .button-a:hover {\r\n            background: #555555 !important;\r\n            border-color: #555555 !important;\r\n        }\r\n\r\n        /* Media Queries */\r\n        @media screen and (max-width: 600px) {\r\n\r\n            .email-container {\r\n                width: 100% !important;\r\n                margin: auto !important;\r\n            }\r\n\r\n            /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */\r\n            .fluid {\r\n                max-width: 100% !important;\r\n                height: auto !important;\r\n                margin-left: auto !important;\r\n                margin-right: auto !important;\r\n            }\r\n\r\n            /* What it does: Forces table cells into full-width rows. */\r\n            .stack-column,\r\n            .stack-column-center {\r\n                display: block !important;\r\n                width: 100% !important;\r\n                max-width: 100% !important;\r\n                direction: ltr !important;\r\n            }\r\n            /* And center justify these ones. */\r\n            .stack-column-center {\r\n                text-align: center !important;\r\n            }\r\n\r\n            /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */\r\n            .center-on-narrow {\r\n                text-align: center !important;\r\n                display: block !important;\r\n                margin-left: auto !important;\r\n                margin-right: auto !important;\r\n                float: none !important;\r\n            }\r\n            table.center-on-narrow {\r\n                display: inline-block !important;\r\n            }\r\n\r\n            /* What it does: Adjust typography on small screens to improve readability */\r\n            .email-container p {\r\n                font-size: 17px !important;\r\n            }\r\n        }\r\n\r\n    </style>\r\n    <!-- Progressive Enhancements : END -->\r\n\r\n    <!-- What it does: Makes background images in 72ppi Outlook render at correct size. -->\r\n    <!--[if gte mso 9]>\r\n    <xml>\r\n        <o:OfficeDocumentSettings>\r\n            <o:AllowPNG/>\r\n            <o:PixelsPerInch>96</o:PixelsPerInch>\r\n        </o:OfficeDocumentSettings>\r\n    </xml>\r\n    <![endif]-->\r\n\r\n</head>\r\n<body width=\"100%\" style=\"margin: 0; mso-line-height-rule: exactly;\">\r\n<center style=\"width: 100%; text-align: left;\">\r\n\r\n    <!-- Visually Hidden Preheader Text : BEGIN -->\r\n    <div style=\"display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;\"></div>\r\n    <!-- Visually Hidden Preheader Text : END -->\r\n\r\n    <!-- Email Header : BEGIN -->\r\n    <table role=\"presentation\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" width=\"600\" style=\"margin: auto;\" class=\"email-container\">\r\n        <tr>\r\n            <td style=\"padding: 20px 0; text-align: center\">\r\n                <img src=\"({[!BASEURL!]})/public/img/logo-idsignage.png\" alt=\"IdSignage\" border=\"0\" style=\"height: auto; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555;\">\r\n            </td>\r\n        </tr>\r\n    </table>\r\n    <!-- Email Header : END -->\r\n\r\n    <!-- Email Body : BEGIN -->\r\n    <table role=\"presentation\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" width=\"600\" style=\"margin: auto;\" class=\"email-container\">\r\n\r\n        <!-- 1 Column Text + Button : BEGIN -->\r\n        <tr>\r\n            <td bgcolor=\"#ffffff\" style=\"padding: 40px 40px 20px; text-align: center;\">\r\n                <h1 style=\"margin: 0; font-family: sans-serif; font-size: 24px; line-height: 125%; color: #333333; font-weight: normal;\">There is a ticket waiting for you</h1>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#ffffff\" style=\"padding: 0 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555; text-align: center;\">\r\n                <h3 style=\"margin: 0; font-family: sans-serif; font-size: 19px; line-height: 125%; color: #333333; font-weight: normal;\">({[!CATEGORY!]})</h3>\r\n                <p style=\"margin: 0;\">({[!PROBLEM!]})</p>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#ffffff\" style=\"padding: 0 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555;\">\r\n                <!-- Button : BEGIN -->\r\n                <table role=\"presentation\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" style=\"margin: auto\">\r\n                    <tr>\r\n                        <td style=\"border-radius: 3px; background: #222222; text-align: center;\" class=\"button-td\">\r\n                            <a href=\"({[!BASEURL!]})/ticket/({[!TICKETID!]})\" style=\"background: #222222; border: 15px solid #222222; font-family: sans-serif; font-size: 13px; line-height: 110%; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;\" class=\"button-a\">\r\n                                    <span style=\"color:#ffffff;\">View ticket</span>    \r\n                            </a>\r\n                        </td>\r\n                    </tr>\r\n                </table>\r\n                <!-- Button : END -->\r\n            </td>\r\n        </tr>\r\n        <!-- 1 Column Text + Button : END -->\r\n\r\n    </table>\r\n    <!-- Email Body : END -->\r\n\r\n    <!-- Email Footer : BEGIN -->\r\n    <table role=\"presentation\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" width=\"100%\" style=\"max-width: 680px; font-family: sans-serif; color: #888888; font-size: 12px; line-height: 140%;\">\r\n        <tr>\r\n            <td style=\"padding: 40px 10px; width: 100%; font-family: sans-serif; font-size: 12px; line-height: 140%; text-align: center; color: #888888;\" class=\"x-gmail-data-detectors\">\r\n                <br><br>\r\n                IdSignage<br>Morsestraat 11C, Tiel<br>(123) 456-7890\r\n            </td>\r\n        </tr>\r\n    </table>\r\n    <!-- Email Footer : END -->\r\n\r\n</center>\r\n</body>\r\n</html>\r\n'),
(2, 'There is a ticket waiting for you', '<!DOCTYPE html>\r\n<html lang=\"en\" xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\r\n<head>\r\n    <meta charset=\"utf-8\"> <!-- utf-8 works for most cases -->\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"> <!-- Use the latest (edge) version of IE rendering engine -->\r\n    <meta name=\"x-apple-disable-message-reformatting\">  <!-- Disable auto-scale in iOS 10 Mail entirely -->\r\n    <title>({[!TITLE!]})</title> <!-- The title tag shows in email notifications, like Android 4.4. -->\r\n\r\n    <!-- Web Font / @font-face : BEGIN -->\r\n    <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->\r\n\r\n    <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->\r\n    <!--[if mso]>\r\n    <style>\r\n        * {\r\n            font-family: sans-serif !important;\r\n        }\r\n    </style>\r\n    <![endif]-->\r\n\r\n    <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->\r\n    <!--[if !mso]><!-->\r\n    <!-- insert web font reference, eg: <link href=\'https://fonts.googleapis.com/css?family=Roboto:400,700\' rel=\'stylesheet\' type=\'text/css\'> -->\r\n    <!--<![endif]-->\r\n\r\n    <!-- Web Font / @font-face : END -->\r\n\r\n    <!-- CSS Reset : BEGIN -->\r\n    <style>\r\n\r\n        /* What it does: Remove spaces around the email design added by some email clients. */\r\n        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */\r\n        html,\r\n        body {\r\n            margin: 0 auto !important;\r\n            padding: 0 !important;\r\n            height: 100% !important;\r\n            width: 100% !important;\r\n        }\r\n\r\n        /* What it does: Stops email clients resizing small text. */\r\n        * {\r\n            -ms-text-size-adjust: 100%;\r\n            -webkit-text-size-adjust: 100%;\r\n        }\r\n\r\n        /* What it does: Centers email on Android 4.4 */\r\n        div[style*=\"margin: 16px 0\"] {\r\n            margin: 0 !important;\r\n        }\r\n\r\n        /* What it does: Stops Outlook from adding extra spacing to tables. */\r\n        table,\r\n        td {\r\n            mso-table-lspace: 0pt !important;\r\n            mso-table-rspace: 0pt !important;\r\n        }\r\n\r\n        /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */\r\n        table {\r\n            border-spacing: 0 !important;\r\n            border-collapse: collapse !important;\r\n            table-layout: fixed !important;\r\n            margin: 0 auto !important;\r\n        }\r\n        table table table {\r\n            table-layout: auto;\r\n        }\r\n\r\n        /* What it does: Uses a better rendering method when resizing images in IE. */\r\n        img {\r\n            -ms-interpolation-mode:bicubic;\r\n        }\r\n\r\n        /* What it does: A work-around for email clients meddling in triggered links. */\r\n        *[x-apple-data-detectors],  /* iOS */\r\n        .x-gmail-data-detectors,    /* Gmail */\r\n        .x-gmail-data-detectors *,\r\n        .aBn {\r\n            border-bottom: 0 !important;\r\n            cursor: default !important;\r\n            color: inherit !important;\r\n            text-decoration: none !important;\r\n            font-size: inherit !important;\r\n            font-family: inherit !important;\r\n            font-weight: inherit !important;\r\n            line-height: inherit !important;\r\n        }\r\n\r\n        /* What it does: Prevents Gmail from displaying an download button on large, non-linked images. */\r\n        .a6S {\r\n            display: none !important;\r\n            opacity: 0.01 !important;\r\n        }\r\n        /* If the above doesn\'t work, add a .g-img class to any image in question. */\r\n        img.g-img + div {\r\n            display: none !important;\r\n        }\r\n\r\n        /* What it does: Prevents underlining the button text in Windows 10 */\r\n        .button-link {\r\n            text-decoration: none !important;\r\n        }\r\n\r\n        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */\r\n        /* Create one of these media queries for each additional viewport size you\'d like to fix */\r\n        /* Thanks to Eric Lepetit (@ericlepetitsf) for help troubleshooting */\r\n        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) { /* iPhone 6 and 6+ */\r\n            .email-container {\r\n                min-width: 375px !important;\r\n            }\r\n        }\r\n\r\n        @media screen and (max-width: 480px) {\r\n            /* What it does: Forces Gmail app to display email full width */\r\n            div > u ~ div .gmail {\r\n                min-width: 100vw;\r\n            }\r\n        }\r\n\r\n    </style>\r\n    <!-- CSS Reset : END -->\r\n\r\n    <!-- Progressive Enhancements : BEGIN -->\r\n    <style>\r\n\r\n        /* What it does: Hover styles for buttons */\r\n        .button-td,\r\n        .button-a {\r\n            transition: all 100ms ease-in;\r\n        }\r\n        .button-td:hover,\r\n        .button-a:hover {\r\n            background: #555555 !important;\r\n            border-color: #555555 !important;\r\n        }\r\n\r\n        /* Media Queries */\r\n        @media screen and (max-width: 600px) {\r\n\r\n            .email-container {\r\n                width: 100% !important;\r\n                margin: auto !important;\r\n            }\r\n\r\n            /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */\r\n            .fluid {\r\n                max-width: 100% !important;\r\n                height: auto !important;\r\n                margin-left: auto !important;\r\n                margin-right: auto !important;\r\n            }\r\n\r\n            /* What it does: Forces table cells into full-width rows. */\r\n            .stack-column,\r\n            .stack-column-center {\r\n                display: block !important;\r\n                width: 100% !important;\r\n                max-width: 100% !important;\r\n                direction: ltr !important;\r\n            }\r\n            /* And center justify these ones. */\r\n            .stack-column-center {\r\n                text-align: center !important;\r\n            }\r\n\r\n            /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */\r\n            .center-on-narrow {\r\n                text-align: center !important;\r\n                display: block !important;\r\n                margin-left: auto !important;\r\n                margin-right: auto !important;\r\n                float: none !important;\r\n            }\r\n            table.center-on-narrow {\r\n                display: inline-block !important;\r\n            }\r\n\r\n            /* What it does: Adjust typography on small screens to improve readability */\r\n            .email-container p {\r\n                font-size: 17px !important;\r\n            }\r\n        }\r\n\r\n    </style>\r\n    <!-- Progressive Enhancements : END -->\r\n\r\n    <!-- What it does: Makes background images in 72ppi Outlook render at correct size. -->\r\n    <!--[if gte mso 9]>\r\n    <xml>\r\n        <o:OfficeDocumentSettings>\r\n            <o:AllowPNG/>\r\n            <o:PixelsPerInch>96</o:PixelsPerInch>\r\n        </o:OfficeDocumentSettings>\r\n    </xml>\r\n    <![endif]-->\r\n\r\n</head>\r\n<body width=\"100%\" style=\"margin: 0; mso-line-height-rule: exactly;\">\r\n<center style=\"width: 100%; text-align: left;\">\r\n\r\n    <!-- Visually Hidden Preheader Text : BEGIN -->\r\n    <div style=\"display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;\">({[!PROBLEM!]})</div>\r\n    <!-- Visually Hidden Preheader Text : END -->\r\n\r\n    <!-- Email Header : BEGIN -->\r\n    <table role=\"presentation\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" width=\"600\" style=\"margin: auto;\" class=\"email-container\">\r\n        <tr>\r\n            <td style=\"padding: 20px 0; text-align: center\">\r\n                <img src=\"({[!BASEURL!]})/public/img/logo-idsignage.png\" alt=\"IdSignage\" border=\"0\" style=\"height: auto; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555;\">\r\n            </td>\r\n        </tr>\r\n    </table>\r\n    <!-- Email Header : END -->\r\n\r\n    <!-- Email Body : BEGIN -->\r\n    <table role=\"presentation\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" width=\"600\" style=\"margin: auto;\" class=\"email-container\">\r\n\r\n        <!-- 1 Column Text + Button : BEGIN -->\r\n        <tr>\r\n            <td bgcolor=\"#ffffff\" style=\"padding: 40px 40px 20px; text-align: center;\">\r\n                <h1 style=\"margin: 0; font-family: sans-serif; font-size: 24px; line-height: 125%; color: #333333; font-weight: normal;\"></h1>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#ffffff\" style=\"padding: 0 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555; text-align: center;\">\r\n                <h3 style=\"margin: 0; font-family: sans-serif; font-size: 19px; line-height: 125%; color: #333333; font-weight: normal;\">({[!CATEGORY!]})</h3>\r\n                <p style=\"margin: 0;\">({[!PROBLEM!]})</p>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#ffffff\" style=\"padding: 0 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555;\">\r\n                <!-- Button : BEGIN -->\r\n                <table role=\"presentation\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" style=\"margin: auto\">\r\n                    <tr>\r\n                        <td style=\"border-radius: 3px; background: #222222; text-align: center;\" class=\"button-td\">\r\n                            <a href=\"({[!BASEURL!]})/forgotpassword/reset/({[!HASH!]})\" style=\"background: #222222; border: 15px solid #222222; font-family: sans-serif; font-size: 13px; line-height: 110%; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;\" class=\"button-a\">\r\n                                    <span style=\"color:#ffffff;\">Reset</span>    \r\n                            </a>\r\n                        </td>\r\n                    </tr>\r\n                </table>\r\n                <!-- Button : END -->\r\n            </td>\r\n        </tr>\r\n        <!-- 1 Column Text + Button : END -->\r\n\r\n    </table>\r\n    <!-- Email Body : END -->\r\n\r\n    <!-- Email Footer : BEGIN -->\r\n    <table role=\"presentation\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" width=\"100%\" style=\"max-width: 680px; font-family: sans-serif; color: #888888; font-size: 12px; line-height: 140%;\">\r\n        <tr>\r\n            <td style=\"padding: 40px 10px; width: 100%; font-family: sans-serif; font-size: 12px; line-height: 140%; text-align: center; color: #888888;\" class=\"x-gmail-data-detectors\">\r\n                <br><br>\r\n                IdSignage<br>Morsestraat 11C, Tiel<br>(123) 456-7890\r\n            </td>\r\n        </tr>\r\n    </table>\r\n    <!-- Email Footer : END -->\r\n\r\n</center>\r\n</body>\r\n</html>\r\n'),
(3, 'Er is een ticket met u gedeeld', '<!DOCTYPE html>\r\n<html lang=\"en\" xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\r\n<head>\r\n    <meta charset=\"utf-8\"> <!-- utf-8 works for most cases -->\r\n    <meta name=\"viewport\" content=\"width=device-width\"> <!-- Forcing initial-scale shouldn\'t be necessary -->\r\n    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"> <!-- Use the latest (edge) version of IE rendering engine -->\r\n    <meta name=\"x-apple-disable-message-reformatting\">  <!-- Disable auto-scale in iOS 10 Mail entirely -->\r\n    <title>({[!TITLE!]})</title> <!-- The title tag shows in email notifications, like Android 4.4. -->\r\n\r\n    <!-- Web Font / @font-face : BEGIN -->\r\n    <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->\r\n\r\n    <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->\r\n    <!--[if mso]>\r\n    <style>\r\n        * {\r\n            font-family: sans-serif !important;\r\n        }\r\n    </style>\r\n    <![endif]-->\r\n\r\n    <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->\r\n    <!--[if !mso]><!-->\r\n    <!-- insert web font reference, eg: <link href=\'https://fonts.googleapis.com/css?family=Roboto:400,700\' rel=\'stylesheet\' type=\'text/css\'> -->\r\n    <!--<![endif]-->\r\n\r\n    <!-- Web Font / @font-face : END -->\r\n\r\n    <!-- CSS Reset : BEGIN -->\r\n    <style>\r\n\r\n        /* What it does: Remove spaces around the email design added by some email clients. */\r\n        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */\r\n        html,\r\n        body {\r\n            margin: 0 auto !important;\r\n            padding: 0 !important;\r\n            height: 100% !important;\r\n            width: 100% !important;\r\n        }\r\n\r\n        /* What it does: Stops email clients resizing small text. */\r\n        * {\r\n            -ms-text-size-adjust: 100%;\r\n            -webkit-text-size-adjust: 100%;\r\n        }\r\n\r\n        /* What it does: Centers email on Android 4.4 */\r\n        div[style*=\"margin: 16px 0\"] {\r\n            margin: 0 !important;\r\n        }\r\n\r\n        /* What it does: Stops Outlook from adding extra spacing to tables. */\r\n        table,\r\n        td {\r\n            mso-table-lspace: 0pt !important;\r\n            mso-table-rspace: 0pt !important;\r\n        }\r\n\r\n        /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */\r\n        table {\r\n            border-spacing: 0 !important;\r\n            border-collapse: collapse !important;\r\n            table-layout: fixed !important;\r\n            margin: 0 auto !important;\r\n        }\r\n        table table table {\r\n            table-layout: auto;\r\n        }\r\n\r\n        /* What it does: Uses a better rendering method when resizing images in IE. */\r\n        img {\r\n            -ms-interpolation-mode:bicubic;\r\n        }\r\n\r\n        /* What it does: A work-around for email clients meddling in triggered links. */\r\n        *[x-apple-data-detectors],  /* iOS */\r\n        .x-gmail-data-detectors,    /* Gmail */\r\n        .x-gmail-data-detectors *,\r\n        .aBn {\r\n            border-bottom: 0 !important;\r\n            cursor: default !important;\r\n            color: inherit !important;\r\n            text-decoration: none !important;\r\n            font-size: inherit !important;\r\n            font-family: inherit !important;\r\n            font-weight: inherit !important;\r\n            line-height: inherit !important;\r\n        }\r\n\r\n        /* What it does: Prevents Gmail from displaying an download button on large, non-linked images. */\r\n        .a6S {\r\n            display: none !important;\r\n            opacity: 0.01 !important;\r\n        }\r\n        /* If the above doesn\'t work, add a .g-img class to any image in question. */\r\n        img.g-img + div {\r\n            display: none !important;\r\n        }\r\n\r\n        /* What it does: Prevents underlining the button text in Windows 10 */\r\n        .button-link {\r\n            text-decoration: none !important;\r\n        }\r\n\r\n        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */\r\n        /* Create one of these media queries for each additional viewport size you\'d like to fix */\r\n        /* Thanks to Eric Lepetit (@ericlepetitsf) for help troubleshooting */\r\n        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) { /* iPhone 6 and 6+ */\r\n            .email-container {\r\n                min-width: 375px !important;\r\n            }\r\n        }\r\n\r\n        @media screen and (max-width: 480px) {\r\n            /* What it does: Forces Gmail app to display email full width */\r\n            div > u ~ div .gmail {\r\n                min-width: 100vw;\r\n            }\r\n        }\r\n\r\n    </style>\r\n    <!-- CSS Reset : END -->\r\n\r\n    <!-- Progressive Enhancements : BEGIN -->\r\n    <style>\r\n\r\n        /* What it does: Hover styles for buttons */\r\n        .button-td,\r\n        .button-a {\r\n            transition: all 100ms ease-in;\r\n        }\r\n        .button-td:hover,\r\n        .button-a:hover {\r\n            background: #555555 !important;\r\n            border-color: #555555 !important;\r\n        }\r\n\r\n        /* Media Queries */\r\n        @media screen and (max-width: 600px) {\r\n\r\n            .email-container {\r\n                width: 100% !important;\r\n                margin: auto !important;\r\n            }\r\n\r\n            /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */\r\n            .fluid {\r\n                max-width: 100% !important;\r\n                height: auto !important;\r\n                margin-left: auto !important;\r\n                margin-right: auto !important;\r\n            }\r\n\r\n            /* What it does: Forces table cells into full-width rows. */\r\n            .stack-column,\r\n            .stack-column-center {\r\n                display: block !important;\r\n                width: 100% !important;\r\n                max-width: 100% !important;\r\n                direction: ltr !important;\r\n            }\r\n            /* And center justify these ones. */\r\n            .stack-column-center {\r\n                text-align: center !important;\r\n            }\r\n\r\n            /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */\r\n            .center-on-narrow {\r\n                text-align: center !important;\r\n                display: block !important;\r\n                margin-left: auto !important;\r\n                margin-right: auto !important;\r\n                float: none !important;\r\n            }\r\n            table.center-on-narrow {\r\n                display: inline-block !important;\r\n            }\r\n\r\n            /* What it does: Adjust typography on small screens to improve readability */\r\n            .email-container p {\r\n                font-size: 17px !important;\r\n            }\r\n        }\r\n\r\n    </style>\r\n    <!-- Progressive Enhancements : END -->\r\n\r\n    <!-- What it does: Makes background images in 72ppi Outlook render at correct size. -->\r\n    <!--[if gte mso 9]>\r\n    <xml>\r\n        <o:OfficeDocumentSettings>\r\n            <o:AllowPNG/>\r\n            <o:PixelsPerInch>96</o:PixelsPerInch>\r\n        </o:OfficeDocumentSettings>\r\n    </xml>\r\n    <![endif]-->\r\n\r\n</head>\r\n<body width=\"100%\" style=\"margin: 0; mso-line-height-rule: exactly;\">\r\n<center style=\"width: 100%; text-align: left;\">\r\n\r\n    <!-- Visually Hidden Preheader Text : BEGIN -->\r\n    <div style=\"display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;\"></div>\r\n    <!-- Visually Hidden Preheader Text : END -->\r\n\r\n    <!-- Email Header : BEGIN -->\r\n    <table role=\"presentation\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" width=\"600\" style=\"margin: auto;\" class=\"email-container\">\r\n        <tr>\r\n            <td style=\"padding: 20px 0; text-align: center\">\r\n                <img src=\"({[!BASEURL!]})/public/img/logo-idsignage.png\" alt=\"IdSignage\" border=\"0\" style=\"height: auto; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555;\">\r\n            </td>\r\n        </tr>\r\n    </table>\r\n    <!-- Email Header : END -->\r\n\r\n    <!-- Email Body : BEGIN -->\r\n    <table role=\"presentation\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" width=\"600\" style=\"margin: auto;\" class=\"email-container\">\r\n\r\n        <!-- 1 Column Text + Button : BEGIN -->\r\n        <tr>\r\n            <td bgcolor=\"#ffffff\" style=\"padding: 40px 40px 20px; text-align: center;\">\r\n                <h1 style=\"margin: 0; font-family: sans-serif; font-size: 24px; line-height: 125%; color: #333333; font-weight: normal;\">Er is een ticket gedeelt met u</h1>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#ffffff\" style=\"padding: 0 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555; text-align: center;\">\r\n                <h3 style=\"margin: 0; font-family: sans-serif; font-size: 19px; line-height: 125%; color: #333333; font-weight: normal;\">Druk op de knop hier onder om deze te bekijken.</h3>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#ffffff\" style=\"padding: 0 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555;\">\r\n                <!-- Button : BEGIN -->\r\n                <table role=\"presentation\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" style=\"margin: auto\">\r\n                    <tr>\r\n                        <td style=\"border-radius: 3px; background: #222222; text-align: center;\" class=\"button-td\">\r\n                            <a href=\"({[!BASEURL!]})({[!LINK!]})\" style=\"background: #222222; border: 15px solid #222222; font-family: sans-serif; font-size: 13px; line-height: 110%; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;\" class=\"button-a\">\r\n                                &nbsp;&nbsp;&nbsp;&nbsp;<span style=\"color:#ffffff;\">Bekijk ticket</span>&nbsp;&nbsp;&nbsp;&nbsp;\r\n                            </a>\r\n                        </td>\r\n                    </tr>\r\n                </table>\r\n                <!-- Button : END -->\r\n            </td>\r\n        </tr>\r\n        <!-- 1 Column Text + Button : END -->\r\n\r\n    </table>\r\n    <!-- Email Body : END -->\r\n\r\n    <!-- Email Footer : BEGIN -->\r\n    <table role=\"presentation\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" width=\"100%\" style=\"max-width: 680px; font-family: sans-serif; color: #888888; font-size: 12px; line-height: 140%;\">\r\n        <tr>\r\n            <td style=\"padding: 40px 10px; width: 100%; font-family: sans-serif; font-size: 12px; line-height: 140%; text-align: center; color: #888888;\" class=\"x-gmail-data-detectors\">\r\n                <br><br>\r\n                IdSignage<br>Morsestraat 11C, Tiel<br>(123) 456-7890\r\n            </td>\r\n        </tr>\r\n    </table>\r\n    <!-- Email Footer : END -->\r\n\r\n</center>\r\n</body>\r\n</html>\r\n');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `role_info` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `role_info`) VALUES
(1, 'Employee', 'These are employees of your company'),
(2, 'Admin', 'This is an administrator'),
(3, 'Super Admin', 'This is the webmaster');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `status_types`
--

CREATE TABLE `status_types` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL,
  `status_info` text NOT NULL,
  `status_level` enum('pending','solved','failed') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `status_types`
--

INSERT INTO `status_types` (`status_id`, `status_name`, `status_info`, `status_level`) VALUES
(1, 'Pending', 'The ticket is awaiting to be solved', 'pending'),
(2, 'Solved', 'The ticket is solved', 'solved'),
(3, 'Unsolved', 'The mechanic was not able to solve the problem', 'failed'),
(7, 'Paused', 'The ticket is on hold', 'pending');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `ticket_type` int(11) NOT NULL,
  `ticket_status` int(11) NOT NULL,
  `ticket_importance` int(11) NOT NULL,
  `ticket_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ticket_edited_at` datetime DEFAULT NULL,
  `ticket_completed_at` datetime DEFAULT NULL,
  `ticket_problem` text NOT NULL,
  `ticket_solution` text,
  `ticket_comment` text,
  `ticket_images` int(11) NOT NULL,
  `ticket_creator` int(11) NOT NULL,
  `ticket_master` int(11) NOT NULL,
  `ticket_hash` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `client_id`, `ticket_type`, `ticket_status`, `ticket_importance`, `ticket_created_at`, `ticket_edited_at`, `ticket_completed_at`, `ticket_problem`, `ticket_solution`, `ticket_comment`, `ticket_images`, `ticket_creator`, `ticket_master`, `ticket_hash`) VALUES
(190, 2, 4, 1, 3, '2018-02-21 10:18:14', '2018-02-22 10:02:59', NULL, 'Afbeeldingen moeten er in. Snel', NULL, 'You can do it, because i can\'t.', 19, 6, 6, '20NjcOp6wXcd620js168r5DcX5Y209ZHuY6t4apI20Xf1l6Sf72Y.20rNTxFwAkCX220gY8VvjzrP9M2084JsiZnuTKA2016T.2n0kJB5Y20THkj6hSoWE220mlQ5XbqQUCQ20LWKZAz9ihhw20E3l95pvfYHw20Bax1fik3SKo20C06tBCHknZ.20qeN16XxPApDg20neuhIBXNSM620msStY55lU6M20qu3VGsPxVRQ208Kvi5NBB8mc20SxAXHV6Krco20YXOt816.16jgk201NdDf8VGG.Q20yj6C0uNA9FA20ZAEOYOS38Cs20nh3SyzGzxUw20rOyrA6am16LU3b3a0ebd2646834bca5a824d7cddc2ebb226773f4b09bb2eafa1254eba87b7828734ec72b1e421af'),
(191, 2, 2, 1, 2, '2018-02-22 12:56:56', NULL, NULL, 'Yay', NULL, NULL, 20, 6, 6, '20tq7FpPSuceM20Bt5KDQohJRg20DWbSRk7fdXw20nwiCoWZJLXo76f850be0160414143f85756a1fe319bb85b475f0e1e1637677a8c5b282c7f2345cb7474e8873997'),
(192, 1, 5, 1, 3, '2018-02-23 09:29:28', NULL, NULL, 'Die ja', NULL, NULL, 47, 6, 12, '20tvmroDGvZeM20REAwtZBiR8s20V3sMLkfCx2c20YIS4DVvTSuo20lPfHuNdD59I20RL.E1qHfCvM20TOpdLlc.CI66e0f30e2676f61de50b62b932e11796301a7a358ed9d81e22ddd50cbc2ebb38eeeb9795815bdbc28'),
(193, 1, 2, 1, 1, '2018-02-23 09:30:02', '2018-02-27 11:39:37', NULL, 'jp', NULL, 'You can do it, because i can\'t.', 50, 6, 12, '20pWAeWd7W8rc20DqG2pGl0q7Y20eCufZqvu4Hwd28f4eb2d49eaa9fdca0d24e2860e29484714e5b0b8babbec344e66fb64eb428177e2cb84d17ff47'),
(194, 1, 2, 2, 1, '2018-02-23 09:30:50', NULL, '2018-02-27 11:43:31', 'jp', 'Just had to turn it off and on again :)', NULL, 53, 6, 10, '204040fsI1Ie0qU20T1NUIcv.pOU20B7vmjo5CFCY1b357047749a9bc3c75021c52777cdf2b73e40f1cd01d48239af1e96c38b3f3345e4ff01d195a0ba'),
(195, 1, 2, 1, 1, '2018-02-23 09:30:56', NULL, NULL, 'jp', NULL, NULL, 56, 6, 10, '20V7KBPDBVe.Q20b4oZifweQcE20oQP3TjRH2j.cd1482c47972742febf4dac7b1c6e1db12cee289524defb0647311fb1bc8d99a11189f91cf364bba'),
(196, 1, 2, 1, 1, '2018-02-23 09:30:57', NULL, NULL, 'jp', NULL, NULL, 59, 6, 10, '20FVf2ozZD.E620uJZWZBxflNU20vR18EnVVKwY40bb64f09603409e4b3caf770aac179c46f93a0bb7a4dfd4e9d4f6588abcd7bc55c7abd408c9d443'),
(197, 1, 2, 1, 1, '2018-02-23 09:30:58', NULL, NULL, 'jp', NULL, NULL, 62, 6, 10, '20YU25mlAis82I20vfzHv1LHea.20FyIvltRnnRY2d7bf20819f9a1e525fc56098dbd9232fc1f88984833cdcc17acaba4f6d056755ecc211267dd0191'),
(198, 1, 2, 1, 1, '2018-02-23 09:30:59', NULL, NULL, 'jp', NULL, NULL, 65, 6, 10, '201akuyzBGOGA20fRmLftYQWBc20Gwvqd10jqwbo537400adc9d8f34126afa30dc5937be7ae4f0ae56eb08ff7beea91e54c5c043ef509958bc647d907'),
(199, 1, 2, 1, 1, '2018-02-23 09:31:01', NULL, NULL, 'jp', NULL, NULL, 68, 6, 10, '20xBwBZfo.30ro20ll1BFF65S4220Gwvqd30jqwbo7f14b9cd420faded93289a5dbe1913e36ef5938474ebdd9a803a5702f6833ac5b5de5608043b6248'),
(200, 1, 2, 1, 1, '2018-02-23 09:31:02', NULL, NULL, 'jp', NULL, NULL, 71, 6, 10, '20FVf2ozZD.E620em5OVUNoFfc20q5bK8RSDSoE139f896bea6f752a3b1044fe8a03e8452230f0066a542ab9ab9fd7cd7d6c7f04b9174937d863fbdc'),
(201, 1, 2, 1, 1, '2018-02-23 09:31:03', NULL, NULL, 'jp', NULL, NULL, 74, 6, 10, '20lnS96P4rVYE20KdhkZ.K37ovg20yXnrceqTGqA06c878c48db793d08016caeb079bcba04f869fc7d276c37c4a28761ccdc1f6c1423b903ce793bbc4'),
(202, 1, 2, 1, 1, '2018-02-23 09:31:04', NULL, NULL, 'jp', NULL, NULL, 77, 6, 10, '20YU17mlAis82I20rD.o5yxqdZ220yjbzn0OPSx65ef020035026c4a1a50b1b2b2f4ea88aadceff83bf8548482c7edef767b6340ed4d9b796929b9670'),
(203, 1, 2, 1, 1, '2018-02-23 09:31:05', NULL, NULL, 'jp', NULL, NULL, 80, 6, 10, '20yHLm9vj0yQY20oY2trVGG8cM20nqpoeMJ9c8M7f57608acd1c30cb409cb1c41ca6d5f7afe2a756daea17d4e653765a861843bd3473d6a5d8b3cb7b'),
(204, 1, 1, 2, 8, '2018-02-23 10:35:42', NULL, NULL, 'jp', NULL, NULL, 83, 6, 10, '20ecDQgSIiuLg20TZPfuVYJIpA20kgnrIPlUN8s8c16d3d878034511e0be043543d5e399dd1e99ce7bf1e45690585649b65b69a7041bd908c767e202'),
(205, 1, 1, 2, 8, '2018-02-23 10:35:46', NULL, NULL, 'jp', NULL, NULL, 86, 6, 10, '20I5wfbny3z3U203mVlvPFL6U.202jGxmQTGO3oab76813e068171323521a3c2539187c9cac7e41431c77695c149794dd6fbafc786d7b13d23fe3f1f'),
(206, 1, 1, 2, 8, '2018-02-23 10:35:47', NULL, NULL, 'jp', NULL, NULL, 89, 6, 10, '20dkdS0OsPn4M20I5y3jVAkW5g20JKhaJcM1Zrs372707b5bbf8264d109566739f443b3bf22ed0dc4cdfc842611e1ad835cc4ce1828ede283cd4662d'),
(207, 1, 1, 2, 8, '2018-02-23 10:35:49', NULL, NULL, 'jp', NULL, NULL, 92, 6, 10, '20H417S3lrSkas208TWirYA2nyQ20R8vPKhA6VvM2c3584f9b1696716adad231d5d81805365416452366c36e977b58f0bbf05b437d4cd423ec713e72d'),
(208, 1, 1, 2, 8, '2018-02-23 10:35:52', NULL, NULL, 'jp', NULL, NULL, 95, 6, 10, '20w8cTdMI6r9E20dgcMdkkMmkg20I8iJyJ10KIM.21e397e8813c92f2626145f574a18db7cfb248ea3ce4c4384b940fa3b3c9076e51b8b4de1dab0145'),
(209, 1, 1, 2, 8, '2018-02-23 10:35:54', NULL, NULL, 'jp', NULL, NULL, 98, 6, 10, '20sZ0n1TSX9Ko20sM6rmeZlMIM20hQN5RqH896c71c9a7d63fefe8b01fb89e2809669948b619e539aca36fc4d882df3cd49e1f83da42144ea2821414'),
(210, 1, 1, 2, 8, '2018-02-23 10:35:55', NULL, NULL, 'jp', NULL, NULL, 101, 6, 10, '20LCrZ0y7tFKE20R2I6YhvDTe220.rjlTQmhUL61c69e0b8c1ce8ced8c49f56e936ba0564ac40fcbd657c9dba7a030d9bf46ca107e7d433005aaa3cf'),
(211, 1, 1, 2, 8, '2018-02-23 10:35:56', NULL, NULL, 'jp', NULL, NULL, 104, 6, 10, '20wlBTSrB0zCs20iSs84xpqzW620Jsq8Mpnv4Eoa55a996577475cb9e199eb7f181bf2aaf0c615abe8cffb578fabae24a21fea2d5c6af0ca46e97807'),
(212, 1, 1, 2, 8, '2018-02-23 10:35:59', NULL, NULL, 'jp', NULL, NULL, 107, 6, 10, '204YXsuC9Xko.20sCSe2oYWlHk20artW7YHDiZk958056fc1585d966c7df6c7176da800fffaff8e111de430f4afbad733b878ffa99349afa3a66afa4'),
(213, 1, 1, 2, 8, '2018-02-23 10:36:01', NULL, NULL, 'jp', NULL, NULL, 110, 6, 10, '20Gyivu8Eop1c20m5RcLXmYpW620W0rtV1.jd322f0afc57eddddfecfa1ad71de2197b7b9618fba41cc77b996fa644e08418f065f30af417cb38379a'),
(214, 1, 2, 1, 4, '2018-02-23 10:36:27', NULL, NULL, 'jp', NULL, NULL, 113, 6, 10, '208Aox2EYgQao204xzfc9rAgpA20IyYcpjNvKzoc331db96d2460f99a78188111be5e35143ee165d5bc943bfbea7a7e571aaccd8dae1098d1dd88ec3'),
(215, 1, 2, 1, 4, '2018-02-23 10:36:30', NULL, NULL, 'jp', NULL, NULL, 116, 6, 10, '20r83kszwyRuc20.VYd8faWKHs20DcR79CTem067c8ecfd8300d1e47e1d273c8c62baa028c23723ee3153817fbc10d8b2f3df68f22b156b2dd5ca5c6'),
(216, 1, 2, 1, 4, '2018-02-23 10:36:32', NULL, NULL, 'jp', NULL, NULL, 119, 6, 10, '20zKGzyDrzrh620XCfAeLVrHMM20eCufZqvu4Hw4e511a06b768f2a2380afb34c17106a03ade473f6d9104fb8460130a39830094817c4076c8672a19'),
(217, 1, 2, 1, 4, '2018-02-23 10:36:33', NULL, NULL, 'jp', NULL, NULL, 122, 6, 10, '20eKDrlpZc016201viIkfIZsQw20ZaB5FHa0ea.8921f48767362bce55dd0b3f9f503db39674f814a6487e80bcf068c8f5f66308541e886c31e73295'),
(218, 1, 2, 1, 4, '2018-02-23 10:36:34', NULL, NULL, 'jp', NULL, NULL, 125, 6, 10, '20WiY1b6OPfiI20oY2trVGG8cM200SWTIJEyAqM5757f3ce29f097c633beec8c000bf1ada6c7028e56133dba00cfe479d005aac24817822f5b6e630f'),
(219, 1, 2, 1, 4, '2018-02-23 10:36:35', NULL, NULL, 'jp', NULL, NULL, 128, 6, 10, '20LjyDyR0i4TY20cnK8tltUvOU20jUw18FNtiOQf73c31fdf6eac8f5833be0cfc80154109ce47049a45c5d4740f0156084d0464e8390f5258e11ae1c'),
(220, 1, 2, 1, 4, '2018-02-23 10:36:36', NULL, NULL, 'jp', NULL, NULL, 131, 6, 10, '20KGB37pvsE8u.20Gn24D1u73js20KVNRKfhbLuE932314d91b6a876634a636a7a7000ea6450b78f60bcca388ca95b8f38c6b2227b00592c4abf42f03'),
(221, 1, 2, 1, 4, '2018-02-23 10:36:37', NULL, NULL, 'jp', NULL, NULL, 134, 6, 10, '200tq1nAjwQtM20eGCAULvDQSQ20lLI9Zc1EaQM5e274f14072c9f2d9dae34e3ab617206573b7a2f1c23343803fe2993619122c89612a17c745b606e'),
(222, 1, 2, 1, 4, '2018-02-23 10:36:38', NULL, NULL, 'jp', NULL, NULL, 137, 6, 10, '20r83kszwyRuc202kYNzcqvfV.20vR18EnVVKwY42167f6cce52aaaa1dd83c92ce5bd50b53dd1a45e9779166d9e5a7cf1aca058a14fd0d2e3e0e5536'),
(223, 1, 2, 1, 4, '2018-02-23 10:36:39', NULL, NULL, 'jp', NULL, NULL, 140, 6, 10, '20O0KggNG6eqo20ehaN1rTusDo20pQ72n713Vao761e7983db5f4d73de6a3fb6bd711c1c23acc1ec8b057887640a277e6c2a337540fc8e30582e61d6'),
(224, 1, 2, 1, 4, '2018-02-23 10:36:40', NULL, NULL, 'jp', NULL, NULL, 143, 6, 10, '20MYO13.Jkgjk20DqG2pGl0q7Y20K1QcCpf9nvU7681733b165ef3f3674e50d567529a2c6e6849ac37ac8a4f172174bdd3bbce3246fae40cde4c23cf'),
(225, 1, 2, 1, 4, '2018-02-23 10:36:41', NULL, NULL, 'jp', NULL, NULL, 146, 6, 10, '202t8TnAuY6DE20gU7PhUClzr.208qq9reUd52kM1a5a70e58f57b4bd36ca74ea397ebd506bf895eedcb5a7e2e095782cedb05d327f8fbdda702ad43c');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '1',
  `username` varchar(25) COLLATE utf8_bin NOT NULL,
  `password` varchar(34) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hash` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `email`, `last_ip`, `created`, `modified`, `hash`) VALUES
(1, 3, 'Super Admin', '$1$nOWlv7hD$FkFIdTI6I82TvAR5N.hD./', 'info@idsignage.nl', '127.0.0.1', '2018-02-27 12:54:00', '2018-02-27 11:54:00', NULL),
(6, 3, 'Admin', '$1$.86Fj7qb$OtwsyD.mI3AJfX8PzZTpJ/', 'jordi.schaap@outlook.com', '127.0.0.1', '2018-01-25 14:23:18', '2018-02-27 11:49:14', NULL),
(11, 2, 'Test', '$1$Rj3c.EL5$DKQflkbyiN/Be6ydPyKXE1', 'a@a.a', '192.168.43.1', '0000-00-00 00:00:00', '2018-02-27 10:23:04', NULL),
(12, 3, 'Peter', '$1$N.ewH/KC$hMSxRSkCsWwgWpN3pr8WN.', 'peter@idsignage.nl', '', '0000-00-00 00:00:00', '2018-02-22 12:56:32', NULL);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexen voor tabel `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexen voor tabel `importance_types`
--
ALTER TABLE `importance_types`
  ADD PRIMARY KEY (`importance_id`);

--
-- Indexen voor tabel `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `mail_config`
--
ALTER TABLE `mail_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `mail_templates`
--
ALTER TABLE `mail_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexen voor tabel `status_types`
--
ALTER TABLE `status_types`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexen voor tabel `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `type` (`ticket_type`),
  ADD KEY `status` (`ticket_status`),
  ADD KEY `ticket_importance` (`ticket_importance`),
  ADD KEY `ticket_creator` (`ticket_creator`),
  ADD KEY `ticket_master` (`ticket_master`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `ticket_images` (`ticket_images`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `categorys`
--
ALTER TABLE `categorys`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `importance_types`
--
ALTER TABLE `importance_types`
  MODIFY `importance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT voor een tabel `mail_config`
--
ALTER TABLE `mail_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `mail_templates`
--
ALTER TABLE `mail_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `status_types`
--
ALTER TABLE `status_types`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`ticket_type`) REFERENCES `categorys` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`ticket_status`) REFERENCES `status_types` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_ibfk_3` FOREIGN KEY (`ticket_importance`) REFERENCES `importance_types` (`importance_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
