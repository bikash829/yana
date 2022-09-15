<?php
include "db_connection.php";
//-- Database structure
$run = true;
$sql = "CREATE DATABASE ".DB;
$con = new mysqli('localhost','root','');
if ($con->query($sql)){
    echo "<br>Database ".DB." is has been created successfully";
}else{
    echo "<br>Error404:".$con->error;
    $run=false;
}

$con= connection();

//-- Table structure for table `address_info`
$sql ="CREATE TABLE `adrees_info` (
          `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
          `zip_code` varchar(20),
          `city` varchar(50),
          `country_id` int(8) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";


if ($con->query($sql)){
    echo "<br>Table address info has been created successfully";
}else{
    echo "<br>Error404:".$con->error;
    $run=false;
}

//-- Table structure for table `blog`
 $sql="CREATE TABLE `blog` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
          `blog_head` varchar(200),
          `blog_details` text ,
          `post_date` varchar(30) ,
          `image_name` varchar(255) ,
          `image_ext` varchar(8)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($con->query($sql)){
    echo "<br>Table blog has been created successfully";
}else{
    echo "<br>Error404:".$con->error;
    $run=false;
}

//-- Table structure for table `users`
$sql = "CREATE TABLE `users` (
          `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
          `name` varchar(50),
          `email_add` varchar(100),
          `pass` varchar(255) ,
          `gender` int(2) COMMENT '1= male, 2 = femal, 3= others',
          `dob` date ,
          `phone` varchar(30),
          `role` int(1) COMMENT '1 = admin, 2 = general',
          `user_avater` varchar(100) ,
          `user_avater_format` varchar(7)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8; ";


if ($con->query($sql)){
    echo "<br>Table users has been created successfully";
}else{
    echo "<br>Error404:".$con->error;
    $run=false;
}

//Table structure for table `user_address`
$sql = "CREATE TABLE `user_address`  (
          `id` int(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
          `user_id_fk` int(8) NOT NULL,
          `address_id_fk` int(8) NOT NULL,
          FOREIGN KEY (`user_id_fk`) REFERENCES `users`(`id`),
          FOREIGN KEY (`address_id_fk`) REFERENCES `adrees_info`(`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if ($con->query($sql)){
    echo "<br>Link table user address has been created successfully";
}else{
    echo "<br>Error404:".$con->error;
    $run=false;
}

//-- Table structure for table `user_faq`
$sql = "CREATE TABLE `user_faq` (
          `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
          `header` varchar(100) NOT NULL,
          `subject` text NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($con->query($sql)){
    echo "<br>Link table FAQ has been created successfully";
}else{
    echo "<br>Error404:".$con->error;
    $run=false;
}

//-- Table structure for table `user_ques`
$sql = "CREATE TABLE `user_ques` (
          `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
          `name` varchar(50) NOT NULL,
          `e_mail` varchar(100) NOT NULL,
          `subject` varchar(100) NOT NULL,
          `messeage` text NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if ($con->query($sql)){
    echo "<br>Link table user questions has been created successfully";
}else{
    echo "<br>Error404:".$con->error;
    $run=false;
}



$sql ="INSERT INTO `adrees_info` ( `zip_code`, `city`, `country_id`) VALUES
        ('1553', 'dhaka', 18)";
if ($con->query($sql)){
    echo "<br>Table address information's data has been inserted successfully";
}else{
    echo "<br>Error404:".$con->error;
    $run=false;
}

$sql = "INSERT INTO `blog` ( `blog_head`, `blog_details`, `post_date`, `image_name`, `image_ext`) VALUES
        ( 'Ambient air pollution', 'From smog hanging over cities to smoke inside the home, air pollution poses a major threat to health and climate.  Ambient air pollution accounts for an estimated 4.2 million deaths per year due to stroke, heart disease, lung cancer and chronic respiratory diseases.\r\nAround 91% of the worldâ€™s population live in places where air quality levels exceed WHO limits. While ambient air pollution affects developed and developing countries alike, low- and middle-income countries experience the highest burden, with the greatest toll in the WHO Western Pacific and South-East Asia regions. \r\nThe major outdoor pollution sources include vehicles, power generation, building heating systems, agriculture/waste incineration and industry. Policies and investments supporting cleaner transport, energy-efficient housing, power generation, industry and better municipal waste management can effectively reduce key sources of ambient air pollution.\r\nAir quality is closely linked to earthâ€™s climate and ecosystems globally. Many of the drivers of air pollution (i.e. combustion of fossil fuels) are also sources of high CO2 emissions. Policies to reduce air pollution, therefore, offer a â€œwinâ€“winâ€ strategy for both climate and health, lowering the burden of disease attributable to air pollution, as well as contributing to the near- and long-term mitigation of climate change.', '2020-04-06 09:48:04 AM', '5e998e80cfa351587121792', 'png'),
        ('Household air pollution', 'Household air pollution is one of the leading causes of disease and premature death in the developing world.\r\n Exposure to smoke from cooking fires causes 3.8 million premature deaths each year, mostly in low- and middle-income countries. Burning fuels such as dung, wood and coal in inefficient stoves or open hearths produces a variety of health-damaging pollutants, including particulate matter (PM), methane, carbon monoxide, polyaromatic hydrocarbons (PAH) and volatile organic compounds (VOC). Burning kerosene in simple wick lamps also produces significant emissions of fine particles and other pollutants.\r\n Particulate matter is a pollutant of special concern. Many studies have demonstrated a direct relationship between exposure to PM and negative health impacts. Smaller-diameter particles (PM2.5 or smaller) are generally more dangerous and ultrafine particles (one micron in diameter or less) can penetrate tissues and organs, posing an even greater risk of systemic health impacts.\r\nExposure to indoor air pollutants can lead to a wide range of adverse health outcomes in both children and adults, from respiratory illnesses to cancer to eye problems. Members of households that rely on polluting fuels and devices also suffer a higher risk of burns, poisonings, musculoskeletal injuries and accidents.', '2020-04-06 10:17:49 AM', '5e998ecded3cc1587121869', 'png'),
        ( 'Air Pollutions bad affect for human body', 'Poor air quality kills people. Worldwide, bad outdoor air caused an estimated 4.2 million premature deaths in 2016, about 90 percent of them in low- and middle-income countries, according to the World Health Organization. Indoor smoke is an ongoing health threat to the 3 billion people who cook and heat their homes by burning biomass, kerosene, and coal. Air pollution has been linked to higher rates of cancer, heart disease, stroke, and respiratory diseases such as asthma. In the U.S. nearly 134 million peopleâ€”over 40 percent of the populationâ€”are at risk of disease and premature death because of air pollution, according to American Lung Association estimates.\r\nWhile those effects emerge from long-term exposure, air pollution can also cause short-term problems such as sneezing and coughing, eye irritation, headaches, and dizziness. Particulate matter smaller than 10 micrometers (classified as PM10 and the even smaller PM2.5) pose higher health risks because they can be breathed deeply into the lungs and may cross into the bloodstream.', '2020-04-06 10:19:19 AM', '5e99918d364ba1587122573', 'png'),
        ('Living things emit carbon dioxide ', 'Though many living things emit carbon dioxide when they breathe, the gas is widely considered to be a pollutant when associated with cars, planes, power plants, and other human activities that involve the burning of fossil fuels such as gasoline and natural gas. That\'s because carbon dioxide is the most common of the greenhouse gases, which trap heat in the atmosphere and contribute to climate change. Humans have pumped enough carbon dioxide into the atmosphere over the past 150 years to raise its levels higher than they have been for hundreds of thousands of years.\r\nOther greenhouse gases include methane â€”which comes from such sources as landfills, the natural gas industry, and gas emitted by livestockâ€”and chlorofluorocarbons (CFCs), which were used in refrigerants and aerosol propellants until they were banned in the late 1980s because of their deteriorating effect on Earth\'s ozone layer.\r\nAnother pollutant associated with climate change is sulfur dioxide, a component of smog. Sulfur dioxide and closely related chemicals are known primarily as a cause of acid rain. But they also reflect light when released in the atmosphere, which keeps sunlight out and creates a cooling effect.\r\n', '2020-04-17 13:39:34 PM', '5e9995764ef351587123574', 'png'),
        ('Buddha statue in China destroyed by acid rain ', 'The Leshan Giant Buddha in Leshan, Southwest China\'s Sichuan, is 1,204 years old and was only given a facelift in 2001. But it seems it could already do with another one.\r\nIt is a good visual example of the damage caused by acid rain, which costs the agricultural Sichuan economy billions of yuan each year in crop damage.\r\nRetired worker Liu Zhaoxu visited the Buddha last week. His last visit was just after the 2001 facelift.The 77-year-old said the Buddha \"had many black and gray stains on its face and body in contrast to its cleanliness during my first visit.\" Environment experts ascribe one of the causes for the change to the Buddha - which is on the World Heritage List - to acid rain.\r\nAccording to a recent survey by the Institute of Mountain Hazards and Environment under the Chinese Academy of Sciences, acid rain causes an annual average loss of 11.3 billion yuan (US$1.4 billion) to the agricultural province. Each year, the rain costs it 6 billion yuan (US$726 million) in crop damage. Acid rain hits 80 per cent of Sichuan\'s 21 cities and autonomous prefectures.\r\nWith the implementation of the western development strategy in the 1ate 1990s, Sichuan has witnessed rapid economic development. But that has brought many environmental problems. Some firms lacking environmental protection facilities have broken the law and discharged waste water, gas and other residues. \r\n', '2020-04-17 13:43:18 PM', '5e999656f41ad1587123798', 'png');";

if ($con->query($sql)){
    echo "<br>Table blog's data has been inserted successfully";
}else{
    echo "<br>Error404:".$con->error;
    $run=false;
}


$sql = "INSERT INTO `users` (`name`, `email_add`, `pass`, `gender`, `dob`, `phone`, `role`, `user_avater`, `user_avater_format`) VALUES
        ('bikash chowdhury', 'admin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, '1982-03-10', '1777099139', 1, '5e917798390d11586591640', 'jpg');";

if ($con->query($sql)){
    echo "<br>Table users's data has been inserted successfully";
}else{
    echo "<br>Error404:".$con->error;
    $run=false;
}


$sql = "INSERT INTO `user_address` (`user_id_fk`, `address_id_fk`) VALUES
        (1, 1);";
if ($con->query($sql)){
    echo "<br>Table user address's data has been inserted successfully";
}else{
    echo "<br>Error404:".$con->error;
    $run=false;
}

$sql ="INSERT INTO `user_faq` (`header`, `subject`) VALUES
        ('What is air pollution?', 'Air pollution is a mix of particles and gases that can reach harmful concentrations both outside and indoors. Its effects can range from higher disease risks to rising temperatures. Soot, smoke, mold, pollen, methane, and carbon dioxide are a just few examples of common pollutants.'),
        ('What causes air pollution?', 'The main sources of air pollution are the industries, agriculture and traffic, as well as energy generation. During combustion processes and other production processes air pollutants are emitted. Some of these substances are not directly damaging to air quality, but will form harmful air pollutants by reactions with other substances that are present in air.\r\n\r\n'),
        ('How does air pollution form?', 'Air pollution can form in various ways. Chemicals are emitted during many different human activities. In the atmosphere these chemicals can react with other chemicals to more dangerous substances. Air pollutants often have properties that are harmful to the environment.\r\n'),
        ('What types of air pollution are there?', 'Air pollution consists of gases and/ or particles. These have a distinct chemical or physical structure, or a distinct effect on human health.'),
        ('How does air pollution spread and how can we handle this? ', 'The dispersion of air pollutants mainly depends on physical processes is air; those of wind and weather. How far air pollutants are transported mainly depends upon particle size of the compounds and at which height the pollution was emitted into the air. Fumes that are emitted into air through high smoke stags will mix with air so that local concentrations are not very high. However, wind will transport compounds and the pollution will become very disperse.');";

if ($con->query($sql)){
    echo "<br>Table faq's data has been inserted successfully";
}else{
    echo "<br>Error404:".$con->error;
    $run=false;
}

//-- Table structure for table `country`
$sql = "CREATE TABLE `country` (
          `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
          `iso` char(2) NOT NULL,
          `name` varchar(80) NOT NULL,
          `nicename` varchar(80) NOT NULL,
          `iso3` char(3) DEFAULT NULL,
          `numcode` smallint(6) DEFAULT NULL,
          `phonecode` int(5) NOT NULL
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

if ($con->query($sql)){
    echo "<br>Table country has been created successfully";
}else{
    echo "<br>Error404:".$con->error;
    $run=false;
}

$sql ="INSERT INTO `country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES
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
        (239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263);";
if ($con->query($sql)){
    echo "<br>Table country's data has been inserted successfully";
}else{
    echo "<br>Error404:".$con->error;
    $run=false;
}



echo "<br><br><br><br><br><br>Admin id : admin@gmail.com<br> Password : 1234";

if ($run==true) {
	# code...

?>

<div>
	The application is ready to run. To go home page just<a href="../index.php" title=""> Click here</a>
</div>
<?php } ?>