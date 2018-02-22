-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 22 feb 2018 om 13:45
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
(81, 6, '127.0.0.1', '2018-02-22 13:07:11');

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
(191, 2, 2, 1, 2, '2018-02-22 12:56:56', NULL, NULL, 'Yay', NULL, NULL, 20, 6, 6, '20tq7FpPSuceM20Bt5KDQohJRg20DWbSRk7fdXw20nwiCoWZJLXo76f850be0160414143f85756a1fe319bb85b475f0e1e1637677a8c5b282c7f2345cb7474e8873997');

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
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hash` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `email`, `last_ip`, `created`, `modified`, `hash`) VALUES
(6, 3, 'Admin', '$1$.86Fj7qb$OtwsyD.mI3AJfX8PzZTpJ/', 'jordi.schaap@outlook.com', '127.0.0.1', '2018-01-25 14:23:18', '2018-02-22 12:07:11', NULL),
(10, 2, 'Piet 2.0', '$1$sgpkJHPY$CCKuqpUR8Mi.72/AcoXia0', 'piet@a.nl', '127.0.0.1', '2018-01-31 15:10:35', '2018-02-13 09:24:09', NULL),
(11, 2, 'Test', '$1$Rj3c.EL5$DKQflkbyiN/Be6ydPyKXE1', 'a@a.a', '127.0.0.1', '0000-00-00 00:00:00', '2018-02-09 13:42:31', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

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
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
