-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2022 at 02:10 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yana`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_info`
--

CREATE TABLE `additional_info` (
  `id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `education` text DEFAULT NULL,
  `working_info` text DEFAULT NULL,
  `document_name` varchar(256) DEFAULT NULL,
  `document_location` varchar(256) DEFAULT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `additional_info`
--

INSERT INTO `additional_info` (`id`, `user_id`, `education`, `working_info`, `document_name`, `document_location`, `bio`) VALUES
(5, 6, 'adfasdfasdfasfasfasaa', 'adfasfasdf', 'Orli_edu166444065211843635.pdf', './uploads/educatoinal_doc/', NULL),
(7, 8, '', '', '', '', 'BLAH BLAH BLAH'),
(9, 10, 'zcvxzxcv', 'zxcvzxcv', 'Evelyn_edu16645587961548556545.pdf', './uploads/educatoinal_doc/', NULL),
(10, 11, '', '', '', '', NULL),
(16, 17, 'Sapiente sunt ut ame', 'Voluptates lorem ut', 'Connor_edu1664643225159706293.pdf', './uploads/educatoinal_doc/', 'something something\r\n'),
(17, 18, 'adsfasdf', '', '', '', NULL),
(18, 19, '', '', '', '', NULL),
(19, 20, '', '', '', '', NULL),
(22, 23, 'sgwdfasdasdf', 'adfasdfasdfdas', 'Unity_edu1665761079664412066.pdf', './uploads/educatoinal_doc/', NULL),
(23, 24, '', '', '', '', NULL),
(25, 26, '', '', '', '', NULL),
(26, 27, 'Voluptatibus quis im', 'Consectetur labore c', 'Garrett_edu1665762253856135200.pdf', './uploads/educatoinal_doc/', NULL),
(27, 28, '', '', '', '', NULL),
(28, 29, '', '', '', '', NULL),
(29, 30, 'Non rerum totam dign', 'Reprehenderit minim', 'Uta_edu1665763173821464796.pdf', './uploads/educatoinal_doc/', NULL),
(30, 31, 'afddfasfa', 'asdfasdfafsd', 'Urielle_edu166576324160452429.pdf', './uploads/educatoinal_doc/', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `doctor_id` int(10) NOT NULL,
  `start_time` varchar(10) DEFAULT NULL,
  `end_time` varchar(10) DEFAULT NULL,
  `ap_date` date DEFAULT NULL,
  `patient_capacity` int(3) DEFAULT NULL,
  `fees` decimal(10,2) DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `doctor_id`, `start_time`, `end_time`, `ap_date`, `patient_capacity`, `fees`, `description`) VALUES
(2, 17, '05:08', '23:49', '2022-09-08', 23, '73.00', 'Hello I am blah blah blah'),
(3, 17, '01:25', '02:07', '2022-09-06', 16, '50000.00', 'All Appointment'),
(4, 17, '05:30', '09:50', '2022-10-21', 30, '1500.00', 'Hello I am blah blah blah'),
(5, 17, '05:55', '06:06', '2022-10-20', 13, '1500.00', 'Hello I am blah blah blah'),
(6, 17, '04:36', '14:22', '2022-09-23', 59, '78.00', ''),
(7, 17, '04:39', '21:47', '2022-09-25', 91, '42.00', 'Consequuntur illo re'),
(8, 22, '22:11', '05:05', '2022-10-14', 15, '1500.00', 'Blah  blah blah'),
(9, 22, '05:55', '07:07', '2022-10-27', 5, '2000.00', 'afdafdas'),
(10, 22, '04:04', '15:03', '2022-10-15', 44, '1500.00', 'adfasdfasdfasdf'),
(11, 22, '05:05', '07:07', '2022-10-14', 5, '2000.00', 'adfasfds'),
(12, 22, '20:50', '11:06', '2022-10-11', 1, '94.00', 'Nesciunt enim cum d'),
(13, 22, '15:43', '01:08', '2022-10-11', 68, '28.00', 'Numquam laborum ut a'),
(14, 22, '05:40', '16:29', '2022-10-11', 15, '82.00', 'Aut repudiandae cumq'),
(15, 22, '04:44', '15:04', '2022-10-20', 44, '44444.00', 'sdfafdasf'),
(16, 22, '', '', '0000-00-00', 0, '0.00', ''),
(17, 22, '', '', '0000-00-00', 0, '0.00', ''),
(18, 22, '', '', '0000-00-00', 0, '0.00', ''),
(19, 22, '13:42', '10:57', '2022-10-13', 84, '5.00', 'Delectus quos esse '),
(20, 22, '09:15', '18:02', '2022-10-14', 75, '5.00', 'Veniam sit atque in'),
(21, 22, '06:10', '23:38', '2022-10-14', 5, '88.00', 'Autem dolore eos ob');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `forum_id` int(10) NOT NULL,
  `comment` text DEFAULT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `forum_id`, `comment`, `comment_date`) VALUES
(1, 17, 1, 'afasdfasdf', '2022-10-02'),
(2, 17, 1, 'Et tempora consectet', '2022-10-02'),
(3, 17, 3, 'Yalla I am leaving a comment', '2022-10-02'),
(4, 17, 1, 'asdfasdfasdf', '2022-10-07'),
(5, 17, 1, 'I am commenting', '2022-10-07'),
(6, 17, 2, 'mmmmmmmm this is a good post', '2022-10-07'),
(7, 1, 6, 'Yo\r\n', '2022-10-08'),
(8, 1, 6, 'dfgadf', '2022-10-09'),
(9, 18, 7, 'Molestiae non quibus', '2022-10-10'),
(10, 22, 7, 'can i comment??', '2022-10-11'),
(11, 18, 7, 'adfasdfasd', '2022-10-12'),
(12, 18, 12, 'adsfasdfasdf', '2022-10-12'),
(13, 18, 13, 'adsfasdfas', '2022-10-12'),
(14, 18, 13, 'adfadfasdf', '2022-10-12'),
(15, 18, 13, 'adfasdf', '2022-10-12'),
(16, 18, 14, 'wtert', '2022-10-12'),
(17, 18, 19, 'ADDFASDFA', '2022-10-12'),
(18, 18, 19, 'ADADF', '2022-10-12'),
(19, 1, 13, 'jguggvyguggbyu', '2022-10-13'),
(20, 22, 20, 'odjfkahsdiuf', '2022-10-13'),
(21, 22, 20, 'bdgsdgfsdfg', '2022-10-14'),
(22, 22, 20, 'dfasfd', '2022-10-14'),
(23, 22, 20, 'uj6ju67j', '2022-10-14'),
(24, 22, 20, 'afadfasd', '2022-10-14'),
(25, 22, 20, 'zcxzvzxcv', '2022-10-14'),
(26, 22, 20, 'zasddsf', '2022-10-14'),
(27, 1, 22, 'iyguygygytgy', '2022-10-14');

-- --------------------------------------------------------

--
-- Table structure for table `comment_react`
--

CREATE TABLE `comment_react` (
  `id` int(11) NOT NULL,
  `react_id` int(2) NOT NULL,
  `comment_id` int(20) DEFAULT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--
-- Error reading structure for table yana.contact_us: #1932 - Table 'yana.contact_us' doesn't exist in engine
-- Error reading data for table yana.contact_us: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `yana`.`contact_us`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263);

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `id` int(20) NOT NULL,
  `user_id` int(10) NOT NULL,
  `post_title` varchar(256) DEFAULT NULL,
  `post_description` text DEFAULT NULL,
  `post_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `user_id`, `post_title`, `post_description`, `post_date`) VALUES
(1, 17, 'Do nesciunt est dolores quis ad dolores placeat libero repudiandae est', 'Tempora magnam volup', '2022-10-01'),
(2, 17, 'Non quae dolor nobis ut nostrum dolorem culpa rerum rerum tenetur veniam', 'Sed fugiat proident Sed fugiat proident Sed fugiat proident  Sed fugiat proidentSed fugiat proidentSed fugiat proidentSed fugiat proidentSed fugiat proidentSed fugiat proidentSed fugiat proidentSed fugiat proidentSed fugiat proident', '2022-10-01'),
(3, 17, 'afasdfasdfasdfasdf', 'adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf adfasfdf ', '2022-10-01'),
(4, 17, 'belh', ' blah blah b lah blah blah b lah blah blah b lah blah blah b lah blah blah b lah blah blah b lah blah blah b lah blah blah b lah blah blah b lah blah blah b lah blah blah b lah blah blah b lah blah blah b lah blah blah b lah ', '2022-10-01'),
(5, 17, 'Reprehenderit maxime est consequatur rerum velit non iusto minus facere tempore non natus delectus voluptatibus officia cumque deleniti porro', 'Sunt accusantium numasdfsdfsadfasdfasdfsadfasfd', '2022-10-08'),
(6, 1, 'Nisi voluptas aperiam quae non', 'Omnis ut excepteur e', '2022-10-08'),
(7, 1, 'adfasfdadfa', 'asdfafadasdfasdfasdf', '2022-10-09'),
(8, 1, 'sgfsdgfd', 'sdafasdf', '2022-10-09'),
(9, 1, 'safafs', 'asdfadfasfda', '2022-10-09'),
(10, 1, 'Quae atque aperiam voluptas in atque mollitia ullam illum id aut in ex voluptatem est', 'Eum elit voluptatib', '2022-10-09'),
(11, 1, 'asdfasfda', 'asdfasdfasdfasdf', '2022-10-09'),
(12, 1, 'sfgsdfgfsdf', 'sdfgsdfgsdfg', '2022-10-10'),
(13, 18, 'Sint qui id modi nisi facilis odio eum et ut sequi voluptas fugit nihil incidunt', 'Magni debitis saepe ', '2022-10-12'),
(14, 18, 'asdfasd', 'asdfasdf', '2022-10-12'),
(15, 18, 'asdfasdf', 'asdfasdf', '2022-10-12'),
(16, 18, 'wetge', 'fgsfas', '2022-10-12'),
(17, 18, 'Voluptatem fuga Adipisci amet quia quae dolores nobis anim et adipisci quas deserunt inventore aut et voluptatem facere exercitationem inventore', 'In esse dolore even', '2022-10-12'),
(18, 18, 'Est ipsum qui aut recusandae Aute qui rerum in quibusdam odit rerum id officiis laborum Inventore fugiat sit dolores', 'Officiis eaque et si', '2022-10-12'),
(19, 18, 'Voluptatem officia irure est iure praesentium dolor', 'Quia deleniti laudan', '2022-10-12'),
(20, 1, 'ojihihuihuyi', 'iuhuyguyguy', '2022-10-13'),
(21, 22, 'kgytf', 'iuguygytugu', '2022-10-13'),
(22, 22, 'Inventore nostrum cupiditate ab corporis culpa et esse commodo autem at quidem eum modi ex', 'Excepteur ratione qu', '2022-10-14'),
(23, 1, 'Enim dicta occaecat aliquid sed rerum provident ad iusto in ducimus in', 'At minima placeat m', '2022-10-14');

-- --------------------------------------------------------

--
-- Table structure for table `post_react`
--

CREATE TABLE `post_react` (
  `id` int(11) NOT NULL,
  `react_id` int(2) NOT NULL,
  `post_id` int(20) DEFAULT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `react`
--

CREATE TABLE `react` (
  `id` int(11) NOT NULL,
  `react` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `react`
--

INSERT INTO `react` (`id`, `react`) VALUES
(1, 'heart'),
(2, 'like'),
(3, 'dislike'),
(4, 'sad');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `report_name` varchar(256) DEFAULT NULL,
  `report_locatin` varchar(256) DEFAULT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `social_medium`
--

CREATE TABLE `social_medium` (
  `id` int(11) NOT NULL,
  `medium` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `social_medium`
--

INSERT INTO `social_medium` (`id`, `medium`) VALUES
(1, 'facebook'),
(2, 'youtube'),
(3, 'website'),
(4, 'linkdin'),
(5, 'instagram'),
(6, 'twitter');

-- --------------------------------------------------------

--
-- Table structure for table `social_user_link`
--

CREATE TABLE `social_user_link` (
  `id` int(11) NOT NULL,
  `link` text DEFAULT NULL,
  `user_id` int(10) NOT NULL,
  `medium_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `social_user_link`
--

INSERT INTO `social_user_link` (`id`, `link`, `user_id`, `medium_id`) VALUES
(1, 'https://www.facebook.com/bikash.chowdhury.980/', 2, 1),
(2, 'https://www.youtube.com/', 17, 2),
(3, 'https://bd.linkedin.com/', 17, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `f_name` varchar(50) DEFAULT NULL,
  `l_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `pass` varchar(256) NOT NULL,
  `country_id` int(10) DEFAULT NULL,
  `phone_code` varchar(5) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `addr` text DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `profile_photo` varchar(256) DEFAULT NULL,
  `profile_location` varchar(256) DEFAULT NULL,
  `role_id` int(2) NOT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `l_name`, `email`, `gender`, `date_of_birth`, `pass`, `country_id`, `phone_code`, `phone_number`, `addr`, `city`, `zip_code`, `profile_photo`, `profile_location`, `role_id`, `status`) VALUES
(1, 'Admin', NULL, 'admin@email.com', NULL, NULL, '59235f35e4763abb0b547bd093562f6e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
(2, 'Denise', 'Mcmahon', 'jecotuzi@mailinator.com', 'other', '2017-08-19', '26d4fccb3c81e8855dc60ed8b037f801', 115, '61', '225', 'Similique perferendi', 'Consequuntur libero', '76032', 'Denise_pp1664440426868841801.jpg', './uploads/profile_photo/', 2, 2),
(6, 'Orli', 'Austin', 'nyfyhaqah@mailinator.com', 'other', '1974-02-19', '26d4fccb3c81e8855dc60ed8b037f801', 190, '175', '573', 'Iusto labore nobis n', 'Reiciendis veniam i', '44003', 'Orli_pp1664440652949331879.jpg', './uploads/profile_photo/', 3, 2),
(8, 'Nora', 'Mclaughlin', 'gozada@mailinator.com', 'female', '2003-05-14', '26d4fccb3c81e8855dc60ed8b037f801', 101, '101', '367', 'Omnis est aperiam in', 'Ipsum facilis rerum', '42867', '', '', 4, 1),
(10, 'Evelyn', 'Albert', 'xuqi@mailinator.com', 'female', '1986-08-27', '26d4fccb3c81e8855dc60ed8b037f801', 179, '65', '170', 'Optio qui illo et d', 'Sit est modi cum qui', '84403', '', '', 2, 2),
(11, 'Lavinia', 'Freeman', 'kedo@mailinator.com', 'other', '1974-11-04', '26d4fccb3c81e8855dc60ed8b037f801', 60, '33', '381', 'Quia facere occaecat', 'Ipsum nulla adipisci', '77268', '', '', 4, 2),
(17, 'Connor', 'Gregory', 'myemail@gmail.com', 'male', '1976-08-06', '26d4fccb3c81e8855dc60ed8b037f801', 67, '216', '676', 'Ullamco qui rerum a', 'Deserunt doloremque', '18110', '', '', 3, 2),
(18, 'mayesha', 'Contreras', 'mayesha@gmail.com', 'male', '1994-02-02', '26d4fccb3c81e8855dc60ed8b037f801', 185, '149', '592', 'Molestiae repellendu', 'Error quibusdam quod', '58420', 'mayesha_pp1665400945146475322.jpg', './uploads/', 4, 2),
(19, 'Kevyn', 'Mooney', 'akash@gmail.com', 'male', '2011-08-01', '26d4fccb3c81e8855dc60ed8b037f801', 18, '18', '0162454544', 'Aliquam error totam', 'Dolor expedita et es', '37881', '', '', 4, 1),
(20, 'Mugamboo', 'Khus', 'mugamboo@gmail.com', 'male', '2004-06-23', '26d4fccb3c81e8855dc60ed8b037f801', 18, '18', '012548899555', 'mohammadpur', 'Dhaka', '1207', 'Mugamboo_pp1665428190805173544.jpg', './uploads/profile_photo/', 4, 1),
(22, 'Doctordsaf', 'Treatment', 'doctor@gmail.com', 'male', '1990-02-14', '26d4fccb3c81e8855dc60ed8b037f801', 18, '18', '013546845555', 'Mohammadpur', 'Dhaka', '1207', 'Doctor_pp16654325501350405648.jpg', './uploads/profile_photo/', 3, 2),
(23, 'Unity', 'Rollins', 'dycemy@mailinator.com', 'female', '1970-12-08', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 230, '79', '340', 'Aut dolore et quo is', 'Tenetur numquam aute', '89023', 'Unity_pp16657610791830845803.jpg', './uploads/profile_photo/', 2, 2),
(24, 'Geoffrey', 'Alford', 'zecu@mailinator.com', 'male', '2022-06-29', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 130, '95', '231', 'Commodi iure et occa', 'Sequi enim sed at se', '47135', 'Geoffrey_pp1665761484796451164.jpg', './uploads/profile_photo/', 4, 1),
(26, 'Rhiannon', 'Weeks', 'goduxex@mailinator.com', 'other', '2011-02-19', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 136, '126', '414', 'Non consectetur eius', 'Est beatae sint adi', '60220', 'Rhiannon_pp1665761981117082114.jpg', './uploads/profile_photo/', 4, 1),
(27, 'Garrett', 'Beck', 'xecerymog@mailinator.com', 'female', '2015-09-29', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 128, '187', '857', 'Ea ratione laboriosa', 'Necessitatibus dolor', '18894', '', '', 2, 2),
(28, 'Juliet', 'Houston', 'tunev@mailinator.com', 'other', '1999-12-07', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 228, '164', '635', 'Modi et in non velit', 'Et recusandae Saepe', '89058', '', '', 4, 1),
(29, 'Tyrone', 'Hayden', 'syxezakuli@mailinator.com', 'male', '2019-05-04', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 100, '230', '685', 'Aspernatur quia itaq', 'Voluptatum aut ea mo', '78457', '', '', 4, 1),
(30, 'Uta', 'Love', 'wyzoxicafy@mailinator.com', 'other', '2000-08-06', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 18, '44', '896', 'Ex nisi natus velit', 'Fugiat quis quo dol', '77158', 'Uta_pp1665763173731119314.jpg', './uploads/profile_photo/', 2, 1),
(31, 'Urielle', 'Gentry', 'guneh@mailinator.com', 'other', '1973-07-03', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 149, '168', '992', 'Id qui expedita quo', 'Incididunt voluptas', '75771', 'Urielle_pp16657632412097064415.jpg', './uploads/profile_photo/', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_appointment`
--

CREATE TABLE `user_appointment` (
  `id` int(11) NOT NULL,
  `patient_id` int(10) NOT NULL,
  `appointment_id` int(10) NOT NULL,
  `appointment_status` int(2) DEFAULT NULL COMMENT '2=Pending,1=Active,4=Canceled,3=past'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_appointment`
--

INSERT INTO `user_appointment` (`id`, `patient_id`, `appointment_id`, `appointment_status`) VALUES
(34, 18, 4, 1),
(35, 18, 5, 1),
(36, 20, 8, 1),
(47, 18, 8, 1),
(48, 18, 11, 4),
(49, 18, 10, 1),
(50, 18, 9, 4),
(51, 18, 15, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'councilor'),
(3, 'doctor'),
(4, 'patient'),
(5, 'other');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_info`
--
ALTER TABLE `additional_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_react`
--
ALTER TABLE `comment_react`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `react_id` (`react_id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post_react`
--
ALTER TABLE `post_react`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `react_id` (`react_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `react`
--
ALTER TABLE `react`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `social_medium`
--
ALTER TABLE `social_medium`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_user_link`
--
ALTER TABLE `social_user_link`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `medium_id` (`medium_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_appointment`
--
ALTER TABLE `user_appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_info`
--
ALTER TABLE `additional_info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `comment_react`
--
ALTER TABLE `comment_react`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `post_react`
--
ALTER TABLE `post_react`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `react`
--
ALTER TABLE `react`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_medium`
--
ALTER TABLE `social_medium`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `social_user_link`
--
ALTER TABLE `social_user_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user_appointment`
--
ALTER TABLE `user_appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `additional_info`
--
ALTER TABLE `additional_info`
  ADD CONSTRAINT `additional_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comment_react`
--
ALTER TABLE `comment_react`
  ADD CONSTRAINT `comment_react_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comment_react_ibfk_2` FOREIGN KEY (`react_id`) REFERENCES `react` (`id`),
  ADD CONSTRAINT `comment_react_ibfk_3` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`);

--
-- Constraints for table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `post_react`
--
ALTER TABLE `post_react`
  ADD CONSTRAINT `post_react_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `post_react_ibfk_2` FOREIGN KEY (`react_id`) REFERENCES `react` (`id`),
  ADD CONSTRAINT `post_react_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `forum` (`id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `social_user_link`
--
ALTER TABLE `social_user_link`
  ADD CONSTRAINT `social_user_link_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `social_user_link_ibfk_2` FOREIGN KEY (`medium_id`) REFERENCES `social_medium` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`);

--
-- Constraints for table `user_appointment`
--
ALTER TABLE `user_appointment`
  ADD CONSTRAINT `user_appointment_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_appointment_ibfk_2` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
