-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 20 feb 2018 om 10:06
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
(8, 'test', 'cat'),
(9, 'deze bug', 's');

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
(8, 'Extremely Slow', 'Just sit back and let it solve itself', '#b2b2b2', 'Extremely Slow');

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
(73, 6, '127.0.0.1', '2018-02-20 09:07:50');

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
(2, 'There is a ticket waiting for you', '<!DOCTYPE html>\r\n<html lang=\"en\" xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\r\n<head>\r\n    <meta charset=\"utf-8\"> <!-- utf-8 works for most cases -->\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"> <!-- Use the latest (edge) version of IE rendering engine -->\r\n    <meta name=\"x-apple-disable-message-reformatting\">  <!-- Disable auto-scale in iOS 10 Mail entirely -->\r\n    <title>({[!TITLE!]})</title> <!-- The title tag shows in email notifications, like Android 4.4. -->\r\n\r\n    <!-- Web Font / @font-face : BEGIN -->\r\n    <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->\r\n\r\n    <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->\r\n    <!--[if mso]>\r\n    <style>\r\n        * {\r\n            font-family: sans-serif !important;\r\n        }\r\n    </style>\r\n    <![endif]-->\r\n\r\n    <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->\r\n    <!--[if !mso]><!-->\r\n    <!-- insert web font reference, eg: <link href=\'https://fonts.googleapis.com/css?family=Roboto:400,700\' rel=\'stylesheet\' type=\'text/css\'> -->\r\n    <!--<![endif]-->\r\n\r\n    <!-- Web Font / @font-face : END -->\r\n\r\n    <!-- CSS Reset : BEGIN -->\r\n    <style>\r\n\r\n        /* What it does: Remove spaces around the email design added by some email clients. */\r\n        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */\r\n        html,\r\n        body {\r\n            margin: 0 auto !important;\r\n            padding: 0 !important;\r\n            height: 100% !important;\r\n            width: 100% !important;\r\n        }\r\n\r\n        /* What it does: Stops email clients resizing small text. */\r\n        * {\r\n            -ms-text-size-adjust: 100%;\r\n            -webkit-text-size-adjust: 100%;\r\n        }\r\n\r\n        /* What it does: Centers email on Android 4.4 */\r\n        div[style*=\"margin: 16px 0\"] {\r\n            margin: 0 !important;\r\n        }\r\n\r\n        /* What it does: Stops Outlook from adding extra spacing to tables. */\r\n        table,\r\n        td {\r\n            mso-table-lspace: 0pt !important;\r\n            mso-table-rspace: 0pt !important;\r\n        }\r\n\r\n        /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */\r\n        table {\r\n            border-spacing: 0 !important;\r\n            border-collapse: collapse !important;\r\n            table-layout: fixed !important;\r\n            margin: 0 auto !important;\r\n        }\r\n        table table table {\r\n            table-layout: auto;\r\n        }\r\n\r\n        /* What it does: Uses a better rendering method when resizing images in IE. */\r\n        img {\r\n            -ms-interpolation-mode:bicubic;\r\n        }\r\n\r\n        /* What it does: A work-around for email clients meddling in triggered links. */\r\n        *[x-apple-data-detectors],  /* iOS */\r\n        .x-gmail-data-detectors,    /* Gmail */\r\n        .x-gmail-data-detectors *,\r\n        .aBn {\r\n            border-bottom: 0 !important;\r\n            cursor: default !important;\r\n            color: inherit !important;\r\n            text-decoration: none !important;\r\n            font-size: inherit !important;\r\n            font-family: inherit !important;\r\n            font-weight: inherit !important;\r\n            line-height: inherit !important;\r\n        }\r\n\r\n        /* What it does: Prevents Gmail from displaying an download button on large, non-linked images. */\r\n        .a6S {\r\n            display: none !important;\r\n            opacity: 0.01 !important;\r\n        }\r\n        /* If the above doesn\'t work, add a .g-img class to any image in question. */\r\n        img.g-img + div {\r\n            display: none !important;\r\n        }\r\n\r\n        /* What it does: Prevents underlining the button text in Windows 10 */\r\n        .button-link {\r\n            text-decoration: none !important;\r\n        }\r\n\r\n        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */\r\n        /* Create one of these media queries for each additional viewport size you\'d like to fix */\r\n        /* Thanks to Eric Lepetit (@ericlepetitsf) for help troubleshooting */\r\n        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) { /* iPhone 6 and 6+ */\r\n            .email-container {\r\n                min-width: 375px !important;\r\n            }\r\n        }\r\n\r\n        @media screen and (max-width: 480px) {\r\n            /* What it does: Forces Gmail app to display email full width */\r\n            div > u ~ div .gmail {\r\n                min-width: 100vw;\r\n            }\r\n        }\r\n\r\n    </style>\r\n    <!-- CSS Reset : END -->\r\n\r\n    <!-- Progressive Enhancements : BEGIN -->\r\n    <style>\r\n\r\n        /* What it does: Hover styles for buttons */\r\n        .button-td,\r\n        .button-a {\r\n            transition: all 100ms ease-in;\r\n        }\r\n        .button-td:hover,\r\n        .button-a:hover {\r\n            background: #555555 !important;\r\n            border-color: #555555 !important;\r\n        }\r\n\r\n        /* Media Queries */\r\n        @media screen and (max-width: 600px) {\r\n\r\n            .email-container {\r\n                width: 100% !important;\r\n                margin: auto !important;\r\n            }\r\n\r\n            /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */\r\n            .fluid {\r\n                max-width: 100% !important;\r\n                height: auto !important;\r\n                margin-left: auto !important;\r\n                margin-right: auto !important;\r\n            }\r\n\r\n            /* What it does: Forces table cells into full-width rows. */\r\n            .stack-column,\r\n            .stack-column-center {\r\n                display: block !important;\r\n                width: 100% !important;\r\n                max-width: 100% !important;\r\n                direction: ltr !important;\r\n            }\r\n            /* And center justify these ones. */\r\n            .stack-column-center {\r\n                text-align: center !important;\r\n            }\r\n\r\n            /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */\r\n            .center-on-narrow {\r\n                text-align: center !important;\r\n                display: block !important;\r\n                margin-left: auto !important;\r\n                margin-right: auto !important;\r\n                float: none !important;\r\n            }\r\n            table.center-on-narrow {\r\n                display: inline-block !important;\r\n            }\r\n\r\n            /* What it does: Adjust typography on small screens to improve readability */\r\n            .email-container p {\r\n                font-size: 17px !important;\r\n            }\r\n        }\r\n\r\n    </style>\r\n    <!-- Progressive Enhancements : END -->\r\n\r\n    <!-- What it does: Makes background images in 72ppi Outlook render at correct size. -->\r\n    <!--[if gte mso 9]>\r\n    <xml>\r\n        <o:OfficeDocumentSettings>\r\n            <o:AllowPNG/>\r\n            <o:PixelsPerInch>96</o:PixelsPerInch>\r\n        </o:OfficeDocumentSettings>\r\n    </xml>\r\n    <![endif]-->\r\n\r\n</head>\r\n<body width=\"100%\" style=\"margin: 0; mso-line-height-rule: exactly;\">\r\n<center style=\"width: 100%; text-align: left;\">\r\n\r\n    <!-- Visually Hidden Preheader Text : BEGIN -->\r\n    <div style=\"display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;\">({[!PROBLEM!]})</div>\r\n    <!-- Visually Hidden Preheader Text : END -->\r\n\r\n    <!-- Email Header : BEGIN -->\r\n    <table role=\"presentation\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" width=\"600\" style=\"margin: auto;\" class=\"email-container\">\r\n        <tr>\r\n            <td style=\"padding: 20px 0; text-align: center\">\r\n                <img src=\"({[!BASEURL!]})/public/img/logo-idsignage.png\" alt=\"IdSignage\" border=\"0\" style=\"height: auto; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555;\">\r\n            </td>\r\n        </tr>\r\n    </table>\r\n    <!-- Email Header : END -->\r\n\r\n    <!-- Email Body : BEGIN -->\r\n    <table role=\"presentation\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" width=\"600\" style=\"margin: auto;\" class=\"email-container\">\r\n\r\n        <!-- 1 Column Text + Button : BEGIN -->\r\n        <tr>\r\n            <td bgcolor=\"#ffffff\" style=\"padding: 40px 40px 20px; text-align: center;\">\r\n                <h1 style=\"margin: 0; font-family: sans-serif; font-size: 24px; line-height: 125%; color: #333333; font-weight: normal;\"></h1>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#ffffff\" style=\"padding: 0 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555; text-align: center;\">\r\n                <h3 style=\"margin: 0; font-family: sans-serif; font-size: 19px; line-height: 125%; color: #333333; font-weight: normal;\">({[!CATEGORY!]})</h3>\r\n                <p style=\"margin: 0;\">({[!PROBLEM!]})</p>\r\n            </td>\r\n        </tr>\r\n        <tr>\r\n            <td bgcolor=\"#ffffff\" style=\"padding: 0 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 140%; color: #555555;\">\r\n                <!-- Button : BEGIN -->\r\n                <table role=\"presentation\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" style=\"margin: auto\">\r\n                    <tr>\r\n                        <td style=\"border-radius: 3px; background: #222222; text-align: center;\" class=\"button-td\">\r\n                            <a href=\"({[!BASEURL!]})/forgotpassword/reset/({[!HASH!]})\" style=\"background: #222222; border: 15px solid #222222; font-family: sans-serif; font-size: 13px; line-height: 110%; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;\" class=\"button-a\">\r\n                                    <span style=\"color:#ffffff;\">Reset</span>    \r\n                            </a>\r\n                        </td>\r\n                    </tr>\r\n                </table>\r\n                <!-- Button : END -->\r\n            </td>\r\n        </tr>\r\n        <!-- 1 Column Text + Button : END -->\r\n\r\n    </table>\r\n    <!-- Email Body : END -->\r\n\r\n    <!-- Email Footer : BEGIN -->\r\n    <table role=\"presentation\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" width=\"100%\" style=\"max-width: 680px; font-family: sans-serif; color: #888888; font-size: 12px; line-height: 140%;\">\r\n        <tr>\r\n            <td style=\"padding: 40px 10px; width: 100%; font-family: sans-serif; font-size: 12px; line-height: 140%; text-align: center; color: #888888;\" class=\"x-gmail-data-detectors\">\r\n                <br><br>\r\n                IdSignage<br>Morsestraat 11C, Tiel<br>(123) 456-7890\r\n            </td>\r\n        </tr>\r\n    </table>\r\n    <!-- Email Footer : END -->\r\n\r\n</center>\r\n</body>\r\n</html>\r\n');

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
(3, 'Unsolved', 'The mechanic was not able to solve the problem', 'failed');

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
  `ticket_master` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `client_id`, `ticket_type`, `ticket_status`, `ticket_importance`, `ticket_created_at`, `ticket_edited_at`, `ticket_completed_at`, `ticket_problem`, `ticket_solution`, `ticket_comment`, `ticket_images`, `ticket_creator`, `ticket_master`) VALUES
(21, 1, 1, 1, 1, '2018-01-24 12:07:24', '2018-01-30 10:09:16', NULL, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.', 'Just had to turn it off and on again :)', '', 0, 0, 0),
(22, 1, 1, 2, 3, '2018-01-24 12:07:24', NULL, '2018-01-25 00:00:00', 'onii', 'done', NULL, 0, 0, 0),
(23, 2, 1, 3, 4, '2018-01-24 12:07:49', NULL, NULL, 'tja', NULL, 'kwee nie', 0, 0, 0),
(24, 1, 1, 1, 2, '2018-01-24 13:07:24', NULL, NULL, 'Test', NULL, NULL, 0, 0, 0),
(25, 1, 1, 2, 3, '2018-01-24 05:07:24', NULL, '2018-01-17 00:00:00', 'onii', 'done', NULL, 0, 0, 0),
(26, 1, 1, 3, 4, '2018-01-24 12:07:49', NULL, NULL, 'tja', NULL, 'kwee nie', 0, 0, 0),
(27, 1, 1, 1, 3, '2018-01-24 12:07:24', NULL, NULL, 'Test', NULL, NULL, 0, 0, 0),
(28, 1, 1, 2, 3, '2018-01-24 12:07:24', NULL, '2018-01-31 00:00:00', 'onii', 'done', NULL, 0, 0, 0),
(29, 2, 1, 3, 4, '2018-01-24 12:07:49', NULL, NULL, 'tja', NULL, 'kwee nie', 0, 0, 0),
(30, 1, 1, 1, 4, '2018-01-24 13:07:24', NULL, NULL, 'Test', NULL, NULL, 0, 0, 0),
(31, 1, 1, 2, 3, '2018-01-24 05:07:24', NULL, '2018-01-19 00:00:00', 'onii', 'done', NULL, 0, 0, 0),
(32, 1, 1, 3, 4, '2018-01-24 12:07:49', NULL, NULL, 'tja', NULL, 'kwee nie', 0, 0, 0),
(33, 2, 1, 1, 3, '2018-01-24 12:07:24', NULL, NULL, 'Test', NULL, NULL, 0, 0, 0),
(34, 1, 1, 1, 4, '2018-01-24 13:07:24', NULL, NULL, 'Test', NULL, NULL, 0, 0, 0),
(35, 1, 1, 1, 2, '2018-01-24 12:07:24', NULL, NULL, 'Test', NULL, NULL, 0, 0, 0),
(36, 1, 1, 1, 1, '2018-01-24 13:07:24', NULL, NULL, 'Test', NULL, NULL, 0, 0, 0),
(37, 1, 1, 2, 1, '2018-01-24 13:40:32', NULL, NULL, 'aa', NULL, NULL, 0, 0, 0),
(38, 1, 1, 1, 1, '2018-01-24 13:41:16', NULL, NULL, 'DB Test', NULL, NULL, 0, 0, 0),
(39, 1, 1, 1, 1, '2018-01-24 13:52:09', NULL, NULL, 'Dit is een alert test', NULL, NULL, 0, 0, 0),
(40, 1, 1, 1, 1, '2018-01-24 13:52:21', NULL, NULL, 'Dit is een alert test', NULL, NULL, 0, 0, 0),
(41, 1, 1, 1, 1, '2018-01-24 13:52:42', NULL, NULL, 'Alert test 2', NULL, NULL, 0, 0, 0),
(42, 1, 1, 1, 1, '2018-01-24 13:53:37', NULL, NULL, 'Alert test 3', NULL, NULL, 0, 0, 0),
(43, 2, 1, 1, 1, '2018-01-24 13:54:20', NULL, NULL, 'alert test 4', NULL, NULL, 0, 0, 0),
(44, 1, 1, 1, 1, '2018-01-24 13:55:15', NULL, NULL, 'alert test 4', NULL, NULL, 0, 0, 0),
(50, 1, 1, 3, 2, '2018-01-24 18:18:05', '2018-01-31 15:56:48', '2018-01-31 15:56:48', 'YES', NULL, 'Just had to turn it off and on again :)', 0, 0, 10),
(51, 2, 3, 2, 1, '2018-01-24 18:25:26', '2018-02-08 12:44:30', '2018-02-08 12:46:12', 'Softwarepakket loopt regelmatig vast', 'Just had to turn it off and on again :)', NULL, 0, 0, 6),
(52, 2, 3, 2, 1, '2018-01-24 18:25:28', '2018-02-06 12:54:57', '2018-02-06 12:54:57', 'Softwarepakket loopt regelmatig vast', 'Just had to turn it off and on again :)', NULL, 0, 0, 9),
(53, 1, 1, 1, 3, '2018-01-24 18:26:10', '2018-02-13 15:26:03', NULL, 'jkhkjkjhjhj', NULL, 'You can do it, because i can\'t.', 0, 0, 6),
(54, 1, 4, 1, 2, '2018-01-30 09:11:14', NULL, NULL, 'check test', NULL, NULL, 0, 0, 9),
(56, 1, 3, 3, 1, '2018-01-30 10:09:35', '2018-01-31 15:56:03', '2018-01-31 15:56:03', 'jaaj', NULL, 'Just had to turn it off and on again :)', 0, 0, 9),
(57, 1, 4, 3, 1, '2018-01-30 10:11:22', '2018-01-31 15:56:22', '2018-01-31 15:56:22', 'jaja', NULL, 'Just had to turn it off and on again :)', 0, 0, 6),
(58, 1, 2, 2, 1, '2018-01-31 12:23:12', '2018-02-13 14:06:40', '2018-02-13 14:30:12', 'jjjj2', 'Just had to turn it off and on again :)', 'You can do it, because i can\'t.', 0, 0, 11),
(59, 1, 2, 2, 1, '2018-01-31 12:23:12', '2018-01-31 15:57:23', '2018-01-31 15:57:23', 'jjjj', 'Just had to turn it off and on again :)', NULL, 0, 0, 9),
(60, 1, 2, 2, 1, '2018-01-31 12:23:12', '2018-01-31 15:57:47', '2018-01-31 15:57:47', 'jjjj', 'Just had to turn it off and on again :)', NULL, 0, 0, 9),
(61, 1, 2, 2, 1, '2018-01-31 12:23:12', '2018-01-31 15:58:00', '2018-01-31 15:58:00', 'jjjj', 'Just had to turn it off and on again :)', NULL, 0, 0, 9),
(62, 1, 2, 2, 1, '2018-01-31 12:23:12', '2018-01-31 15:58:13', '2018-01-31 15:58:13', 'jjjj', 'Just had to turn it off and on again :)', NULL, 0, 0, 10),
(63, 1, 2, 2, 1, '2018-01-31 12:23:12', '2018-01-31 15:58:33', '2018-01-31 15:58:33', 'jjjj', 'Just had to turn it off and on again :)', NULL, 0, 0, 10),
(64, 1, 2, 2, 1, '2018-01-31 12:23:12', '2018-01-31 15:58:59', '2018-01-31 15:58:59', 'jjjj', 'Just had to turn it off and on again :)', NULL, 0, 0, 6),
(65, 1, 2, 2, 1, '2018-01-31 12:23:12', '2018-01-31 15:59:12', '2018-01-31 15:59:12', 'jjjj', 'Just had to turn it off and on again :)', NULL, 0, 0, 6),
(66, 1, 4, 1, 3, '2018-01-31 15:32:32', NULL, NULL, 'test', NULL, NULL, 0, 6, 6),
(68, 1, 2, 3, 2, '2018-01-31 15:34:08', '2018-01-31 15:59:34', '2018-01-31 15:59:34', 'aaa', NULL, 'Just had to turn it off and on again :)', 0, 6, 10),
(69, 1, 3, 2, 8, '2018-01-31 15:34:31', '2018-01-31 15:54:34', '2018-01-31 15:54:34', 'aaa', 'Just had to turn it off and on again :)', NULL, 0, 6, 9),
(70, 1, 3, 2, 2, '2018-02-01 11:19:20', '2018-02-13 18:05:26', '2018-02-13 18:05:56', 'jaja 2.0', 'Just had to turn it off and on again :)', 'You can do it, because i can\'t.', 0, 6, 10),
(71, 1, 3, 2, 2, '2018-02-01 11:25:58', NULL, '2018-02-13 14:46:13', 'jaja', 'Just had to turn it off and on again :)', NULL, 0, 6, 6),
(72, 1, 3, 1, 2, '2018-02-01 11:26:30', '2018-02-13 14:33:03', NULL, 'jaja', NULL, 'You can do it, because i can\'t.', 0, 6, 10),
(73, 1, 3, 1, 2, '2018-02-01 11:26:35', NULL, NULL, 'jaja', NULL, NULL, 0, 6, 6),
(74, 1, 3, 1, 2, '2018-02-01 11:26:40', NULL, NULL, 'jaja', NULL, NULL, 0, 6, 6),
(75, 1, 2, 2, 1, '2018-02-01 11:27:01', NULL, NULL, 'a', NULL, NULL, 0, 6, 6),
(76, 1, 2, 2, 1, '2018-02-01 11:27:42', NULL, NULL, 'a', NULL, NULL, 0, 6, 6),
(77, 1, 2, 2, 1, '2018-02-01 11:30:08', NULL, NULL, 'a', NULL, NULL, 0, 6, 6),
(78, 1, 3, 1, 3, '2018-02-01 11:33:58', NULL, NULL, 'aaa', NULL, NULL, 0, 6, 6),
(79, 1, 3, 1, 3, '2018-02-01 11:35:58', NULL, NULL, 'aaa', NULL, NULL, 0, 6, 6),
(80, 1, 3, 1, 3, '2018-02-01 11:36:05', NULL, NULL, 'aaa', NULL, NULL, 0, 6, 6),
(81, 1, 2, 1, 2, '2018-02-01 11:36:31', NULL, NULL, 'a', NULL, NULL, 0, 6, 6),
(82, 1, 1, 2, 2, '2018-02-01 11:37:58', NULL, NULL, 'a', NULL, NULL, 0, 6, 6),
(83, 1, 1, 2, 2, '2018-02-01 11:38:14', NULL, NULL, 'a', NULL, NULL, 0, 6, 6),
(84, 1, 1, 2, 2, '2018-02-01 11:38:22', NULL, NULL, 'a', NULL, NULL, 0, 6, 6),
(85, 1, 1, 2, 2, '2018-02-01 11:42:25', NULL, NULL, 'a', NULL, NULL, 0, 6, 6),
(86, 1, 1, 2, 2, '2018-02-01 11:42:50', NULL, NULL, 'a', NULL, NULL, 0, 6, 6),
(87, 1, 2, 1, 2, '2018-02-01 11:43:37', NULL, NULL, 'a', NULL, NULL, 0, 6, 6),
(88, 1, 2, 1, 2, '2018-02-01 11:47:07', NULL, NULL, 'a', NULL, NULL, 0, 6, 6),
(89, 1, 2, 1, 2, '2018-02-01 11:49:40', '2018-02-13 14:47:34', NULL, 'a2', NULL, NULL, 0, 6, 6),
(90, 1, 2, 1, 2, '2018-02-01 11:51:00', NULL, NULL, 'a', NULL, NULL, 0, 6, 6),
(91, 1, 3, 1, 2, '2018-02-01 11:51:59', NULL, NULL, '-', NULL, NULL, 0, 6, 6),
(92, 1, 2, 2, 2, '2018-02-01 12:20:35', NULL, NULL, 'Problem db test en email..............', NULL, NULL, 0, 6, 6),
(93, 1, 2, 2, 2, '2018-02-01 12:21:23', NULL, NULL, 'Problem db test en email..............', NULL, NULL, 0, 6, 6),
(94, 1, 2, 2, 2, '2018-02-01 12:21:28', NULL, NULL, 'Problem db test en email..............', NULL, NULL, 0, 6, 6),
(95, 1, 2, 2, 2, '2018-02-01 12:22:35', NULL, NULL, 'Problem db test en email..............', NULL, NULL, 0, 6, 6),
(96, 1, 2, 2, 2, '2018-02-01 12:23:31', NULL, NULL, 'Problem db test en email..............', NULL, NULL, 0, 6, 6),
(97, 1, 2, 2, 2, '2018-02-01 12:24:02', NULL, NULL, 'Problem db test en email..............', NULL, NULL, 0, 6, 6),
(98, 1, 2, 2, 4, '2018-02-01 12:26:51', NULL, NULL, 'JJJAAA', NULL, NULL, 0, 6, 6),
(99, 1, 4, 2, 1, '2018-02-01 12:27:44', '2018-02-08 09:47:02', '2018-02-08 10:43:09', 'ONiiii2', 'Just had to turn it off and on again :)', NULL, 0, 6, 6),
(100, 1, 4, 1, 2, '2018-02-01 12:29:14', NULL, NULL, 'ONiii 2', NULL, NULL, 0, 6, 6),
(101, 1, 3, 1, 3, '2018-02-01 12:32:30', NULL, NULL, 'Die ja', NULL, NULL, 0, 6, 10),
(102, 1, 3, 2, 2, '2018-02-01 13:28:46', '2018-02-13 11:12:30', '2018-02-13 13:43:26', 'Ja kan niet dit omdat zo en dit kan ik daarom dus niet dus fix het', 'Just had to turn it off and on again :)', 'You can do it, because i can\'t.', 0, 6, 11),
(103, 1, 2, 1, 2, '2018-02-01 13:31:33', NULL, NULL, '5', NULL, NULL, 0, 6, 6),
(104, 1, 2, 1, 2, '2018-02-01 13:32:28', NULL, NULL, '6', NULL, NULL, 0, 6, 6),
(105, 1, 2, 1, 2, '2018-02-01 13:33:48', NULL, NULL, '6', NULL, NULL, 0, 6, 6),
(106, 1, 2, 1, 2, '2018-02-01 13:33:50', NULL, NULL, '6', NULL, NULL, 0, 6, 6),
(107, 1, 2, 1, 2, '2018-02-01 13:34:11', NULL, NULL, '6', NULL, NULL, 0, 6, 6),
(108, 1, 2, 1, 2, '2018-02-01 13:34:18', NULL, NULL, '6', NULL, NULL, 0, 6, 6),
(109, 1, 2, 1, 3, '2018-02-01 13:39:33', NULL, NULL, 'YOU NEED TO DO SOMETHING', NULL, NULL, 0, 6, 6),
(110, 1, 4, 1, 3, '2018-02-01 14:36:38', NULL, NULL, 'Nothing', NULL, NULL, 0, 6, 6),
(111, 1, 4, 1, 3, '2018-02-01 14:37:40', NULL, NULL, 'Nothing', NULL, NULL, 0, 6, 6),
(114, 1, 2, 3, 1, '2018-02-01 16:30:16', NULL, NULL, 'test', NULL, NULL, 0, 6, 6),
(115, 1, 2, 2, 2, '2018-02-01 17:01:48', NULL, NULL, 'aaaaaaaaaa', NULL, NULL, 0, 6, 6),
(116, 1, 4, 1, 3, '2018-02-06 11:35:18', NULL, NULL, 'Do this and then that', NULL, NULL, 0, 6, 6),
(117, 1, 2, 1, 3, '2018-02-06 11:54:23', NULL, NULL, 'aaa', NULL, NULL, 0, 6, 6),
(118, 1, 2, 2, 3, '2018-02-06 11:55:08', NULL, NULL, 'aaaaaaaaaa', NULL, NULL, 0, 6, 6),
(119, 1, 1, 2, 2, '2018-02-06 12:36:38', '2018-02-06 12:40:24', '2018-02-06 12:40:24', 'sss', 'Just had to turn it off and on again :)', NULL, 0, 6, 6),
(121, 2, 3, 1, 3, '2018-02-06 16:09:21', NULL, NULL, 'Die ja', NULL, NULL, 0, 6, 6),
(122, 1, 4, 1, 3, '2018-02-06 16:10:06', NULL, NULL, 'a', NULL, NULL, 0, 6, 6),
(123, 1, 4, 1, 3, '2018-02-06 16:10:47', NULL, NULL, 'a', NULL, NULL, 0, 6, 6),
(124, 1, 4, 1, 3, '2018-02-06 16:10:51', NULL, NULL, 'a', NULL, NULL, 0, 6, 6),
(125, 1, 4, 1, 3, '2018-02-06 16:11:25', NULL, NULL, 'a', NULL, NULL, 0, 6, 6),
(126, 1, 4, 2, 3, '2018-02-06 16:11:29', '2018-02-06 16:34:35', '2018-02-06 16:34:35', 'a2.3', 'Just had to turn it off and on again :)', NULL, 0, 6, 6),
(127, 2, 4, 2, 3, '2018-02-06 16:12:16', '2018-02-06 16:13:00', '2018-02-06 16:13:00', 'Dee tesr can het jaar', NULL, NULL, 0, 6, 6),
(130, 2, 4, 1, 3, '2018-02-09 14:32:16', NULL, NULL, 'Disss', NULL, NULL, 0, 6, 6),
(131, 2, 4, 1, 3, '2018-02-09 14:33:28', NULL, NULL, 'Disss', NULL, NULL, 0, 6, 6),
(132, 2, 4, 1, 3, '2018-02-09 14:33:33', NULL, NULL, 'Disss', NULL, NULL, 0, 6, 6),
(133, 2, 4, 2, 1, '2018-02-09 14:36:00', NULL, '2018-02-13 11:41:57', 'Dis ja', 'Just had to turn it off and on again :)', NULL, 0, 6, 6),
(134, 2, 4, 1, 3, '2018-02-09 16:28:06', NULL, NULL, 'onii', NULL, NULL, 0, 6, 6),
(135, 2, 3, 1, 3, '2018-02-09 16:28:52', NULL, NULL, 'onii', NULL, NULL, 0, 6, 6),
(136, 1, 4, 1, 3, '2018-02-09 16:29:28', NULL, NULL, 'jahhhh', NULL, NULL, 0, 6, 6),
(137, 2, 2, 1, 3, '2018-02-13 14:03:18', NULL, NULL, 'onii', NULL, NULL, 0, 6, 10),
(138, 2, 2, 1, 3, '2018-02-13 14:04:24', NULL, NULL, 'onii', NULL, NULL, 0, 6, 10),
(139, 2, 2, 1, 3, '2018-02-13 14:04:50', NULL, NULL, 'onni', NULL, NULL, 0, 6, 6),
(140, 2, 1, 1, 4, '2018-02-13 14:46:39', NULL, NULL, 'jaja', NULL, NULL, 0, 6, 10),
(141, 2, 1, 1, 4, '2018-02-13 14:46:42', NULL, NULL, 'jaja', NULL, NULL, 0, 6, 10),
(142, 2, 1, 1, 4, '2018-02-13 14:46:49', NULL, NULL, 'jaja', NULL, NULL, 0, 6, 10),
(143, 2, 2, 2, 2, '2018-02-13 15:27:40', NULL, '2018-02-13 15:28:25', 'aa', 'Just had to turn it off and on again :)', NULL, 0, 6, 6),
(145, 1, 3, 1, 3, '2018-02-13 16:22:04', NULL, NULL, 'aa', NULL, NULL, 0, 6, 10),
(146, 1, 3, 1, 3, '2018-02-13 16:23:09', NULL, NULL, 'aa', NULL, NULL, 0, 6, 10),
(147, 1, 3, 1, 3, '2018-02-13 16:23:21', NULL, NULL, 'aa', NULL, NULL, 0, 6, 10),
(148, 1, 3, 1, 3, '2018-02-13 16:26:52', NULL, NULL, 'aa', NULL, NULL, 0, 6, 10),
(149, 1, 3, 1, 3, '2018-02-13 16:27:43', NULL, NULL, 'aa', NULL, NULL, 0, 6, 10),
(150, 1, 3, 1, 3, '2018-02-13 16:27:47', NULL, NULL, 'aa', NULL, NULL, 0, 6, 10),
(151, 1, 3, 1, 3, '2018-02-13 16:28:12', NULL, NULL, 'aa', NULL, NULL, 0, 6, 10),
(152, 1, 3, 1, 3, '2018-02-13 16:28:16', NULL, NULL, 'aa', NULL, NULL, 0, 6, 10),
(153, 1, 3, 1, 3, '2018-02-13 16:28:58', NULL, NULL, 'aa', NULL, NULL, 0, 6, 10),
(154, 1, 3, 1, 3, '2018-02-13 16:29:03', NULL, NULL, 'aa', NULL, NULL, 0, 6, 10),
(155, 1, 3, 1, 3, '2018-02-13 16:31:57', NULL, NULL, 'aa', NULL, NULL, 0, 6, 10),
(156, 1, 3, 1, 3, '2018-02-13 16:32:56', NULL, NULL, 'aa', NULL, NULL, 0, 6, 10),
(157, 1, 3, 1, 3, '2018-02-13 16:33:01', NULL, NULL, 'aa', NULL, NULL, 0, 6, 10),
(158, 2, 2, 1, 2, '2018-02-13 18:05:01', NULL, NULL, 'hardware', NULL, NULL, 0, 6, 6),
(159, 1, 2, 3, 2, '2018-02-15 10:50:55', NULL, NULL, 'a', NULL, NULL, 0, 6, 10),
(160, 1, 2, 3, 2, '2018-02-15 10:58:03', NULL, NULL, 'a', NULL, NULL, 0, 6, 10),
(161, 1, 2, 3, 2, '2018-02-15 10:58:14', NULL, NULL, 'a', NULL, NULL, 0, 6, 10),
(162, 1, 2, 3, 2, '2018-02-15 11:00:14', NULL, NULL, 'a', NULL, NULL, 0, 6, 10),
(163, 1, 2, 3, 2, '2018-02-15 11:00:19', NULL, NULL, 'a', NULL, NULL, 0, 6, 10),
(164, 1, 2, 3, 2, '2018-02-15 11:00:44', NULL, NULL, 'a', NULL, NULL, 0, 6, 10),
(165, 1, 2, 3, 2, '2018-02-15 11:00:46', NULL, NULL, 'a', NULL, NULL, 0, 6, 10),
(167, 1, 2, 1, 2, '2018-02-16 12:39:41', NULL, NULL, 'a', NULL, NULL, 0, 6, 6),
(168, 1, 2, 1, 2, '2018-02-16 12:40:30', NULL, NULL, 'a', NULL, NULL, 0, 6, 6),
(169, 2, 3, 1, 3, '2018-02-16 12:40:52', NULL, NULL, 'a', NULL, NULL, 0, 6, 10),
(170, 2, 1, 1, 2, '2018-02-16 12:41:56', NULL, NULL, 'aaa', NULL, NULL, 0, 6, 10),
(171, 2, 1, 1, 2, '2018-02-16 13:11:37', NULL, NULL, 'aaa', NULL, NULL, 0, 6, 10),
(172, 2, 1, 1, 2, '2018-02-16 13:11:42', NULL, NULL, 'aaa', NULL, NULL, 0, 6, 10),
(173, 2, 1, 1, 2, '2018-02-16 13:19:11', NULL, NULL, 'aaa', NULL, NULL, 0, 6, 10),
(174, 2, 1, 1, 2, '2018-02-16 13:20:45', NULL, NULL, 'aaa', NULL, NULL, 0, 6, 10),
(175, 2, 1, 1, 2, '2018-02-16 13:20:48', NULL, NULL, 'aaa', NULL, NULL, 0, 6, 10),
(176, 2, 1, 1, 2, '2018-02-16 13:25:40', NULL, NULL, 'aaa', NULL, NULL, 5, 6, 10),
(177, 2, 1, 1, 2, '2018-02-16 13:25:48', NULL, NULL, 'aaa', NULL, NULL, 6, 6, 10),
(178, 2, 1, 1, 2, '2018-02-16 13:44:05', NULL, NULL, 'aaa', NULL, NULL, 7, 6, 10),
(179, 2, 1, 1, 2, '2018-02-16 13:59:48', NULL, NULL, 'aaa', NULL, NULL, 8, 6, 10);

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
(6, 3, 'Admin', '$1$.86Fj7qb$OtwsyD.mI3AJfX8PzZTpJ/', 'jordi.schaap@outlook.com', '127.0.0.1', '2018-01-25 14:23:18', '2018-02-13 17:01:31', NULL),
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
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT voor een tabel `mail_config`
--
ALTER TABLE `mail_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `mail_templates`
--
ALTER TABLE `mail_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `status_types`
--
ALTER TABLE `status_types`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

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
