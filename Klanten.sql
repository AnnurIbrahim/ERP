-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 09 mrt 2023 om 11:50
-- Serverversie: 10.4.27-MariaDB
-- PHP-versie: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `us3/4`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Klanten`
--

CREATE TABLE `klanten` (
  `id` int(11) NOT NULL,
  `bedrijfsnaam` varchar(255) DEFAULT NULL,
  `voornaam` varchar(255) DEFAULT NULL,
  `tussenvoegsel` varchar(255) DEFAULT NULL,
  `achternaam` varchar(255) DEFAULT NULL,
  `functie` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefoonnummer` varchar(255) DEFAULT NULL,
  `adres` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `klanten`
--

INSERT INTO `klanten` (`id`, `bedrijfsnaam`, `voornaam`, `tussenvoegsel`, `achternaam`, `functie`, `email`, `telefoonnummer`, `adres`) VALUES

(2, ' LMN Inc.', 'Emliy', 'van der', ' Meer', 'Marketinganalist', 'emily.vandermeer@lmninc.com', '645678903', '456 Elm St, Anytown, USA'),

(3, 'Gilde Devops', 'Sanne', NULL, 'Meijer', 'ITSD medewerker', 'sannemeijer@gmail.com', '682233440', 'Bredeweg 235, 6042 GE Roermond'),

(4, 'Mcdonalds', 'Timint ', NULL, 'Adam', 'Medwerker', 'Timintadam@gmail.com', '683344556', 'Stadsweide 120, 6041 TD Roermond'),

(5, 'Vanrijtautomatisering', 'Kevin', 'van', 'Rijt', 'Manger', 'kevinvanrijt@gmail.com', '684455667', 'Kouk 2c, 6093 BG Heythuysen'),

(6, 'ABC B.V', 'Saddam', NULL, 'Abker', 'Software ontwikkelaar', 'Saddamabker@gmail.com', '685566778', 'Kastanjelaan 400, 5616 LZ Eindhoven'),

(7, 'Holland Food Service BV', 'Ali', NULL, 'Ibrahim', 'Verkoper', 'aliibrahim@gmail.com', '686677889', 'Bijsterhuizen 2513, 6604 LM Wijchen'),

(8, 'Blauwvis Beheer BV', 'Johan', 'Van de', 'Rijmon', 'Medwerker', 'Johanrijmon@gmail.com', '321321968', 'Veerweg 55, 6703CN Wageningen'),

(9, 'Mokrupak', 'Ellen', 'van', 'Bezouwen', 'Manger', 'Ellenbezouwen@gmail.com', '687788991', ' Groeneweg 22, 6041 AX Roermond'),

(10, 'Het goed', 'Tom', 'Van', 'Dijk', 'Assitant', 'tomvandijk@gmail.com', '688899112', 'Doctor Philipslaan 49B, 6042 CT Roermond'),

(11, 'Royal Brinkman Beheer BV', 'Ellian', NULL, 'Geert', 'Verkoper', 'Elliangeert@gmail.com', '689911223', 'Zonneveld 5, 5993 SG Maasbree'),

(12, 'WML', 'Staal', NULL, 'Welders', 'Mederwerker', 'staalwelders@gmail.com', '680011224', 'Limburglaan 25 6229 GA Maastricht'),

(13, 'Hema', 'Rylan', 'Van', 'Geert', 'Beheerder', 'rylangeert@gmail.com', '681122335', 'Gr, Graaf Gerardstraat 2, 6041 HH Roermond'),

(14, 'PC hulp Roermond', 'Omar', NULL, 'Ali', 'Engineer', 'omarali@gmail.com', '682233446', 'Charitashof 5 6001 WB Weert'),

(15, 'De bieren', 'Mark', 'Van', 'Welders', 'Manger', 'markwelders@gmail.com', '683344557', 'Markt 14, 6041 EL Roermond'),

(16, 'Euro PC', 'Adam', NULL, 'Annur', 'Expert manger', 'adamannur@gmail.com', '684455668', 'Maria Theresialaan 10, 6042 AL Roermond'),

(17, 'Ziggo BV', 'Max', NULL, 'verstappen', 'Software ontwikkelaar', 'maxverstappen@gamil.com', '685566779', 'Steenweg 15, 6041 EV Roermond'),

(18, 'KPN', 'Ahmed', NULL, 'Ibrahim', 'Manger', 'ahmedibrahim@gamil.com', '686677880', 'Steenweg 6, 6041 EW Roermond'),

(19, 'T-Mobiel', 'Mohamed', NULL, 'Al-Jaber', 'Mederwerker support', 'mohamed.aljaberi@t-mobile.nl', '686677881', 'T-Mobilestraat 1, 1000 AB Amsterdam'),

(20, 'Intel Nederland', 'lisa', NULL, 'Nguyen', 'Software Engineer', 'lisa.nguyen@intel.nl', '686677882', 'Claude Debussylaan 88, 1082 MD Amsterdam'),

(21, 'CGI ', 'Jasper', NULL, 'De Vris', 'IT Consultant', 'jasper.devries@cgi.nl', '686677883', 'Laan van Ypenburg 100, 2497 GB Den Haag'),

(22, 'Cisco Systeem ', 'Sarah', 'Van der', 'Meer', 'Netwerk Engineer', 'sarah.vandermeer@cisco.nl', '686677884', 'Haarlerbergweg 13-19, 1101 CH Amsterdam'),

(23, 'IBM', 'Kim', NULL, 'De Boer', 'Verkoop Executive', 'kim.deboer@nl.ibm.com', '686677885', 'Johan Huizingelaan 765, 1066VH Amsterdam'),

(24, 'Coolblue BV', 'Mohamed', NULL, 'Patel', 'Marketing Manager', 'mohamed.patel@coolblue.nl', '686677681', 'Weena 664, 3012 CN Rotterdam'),

(25, 'Bol.com BV', 'Marieke', NULL, 'Jansen', 'Operationeel Manager', 'marieke.jansen@bol.com', '686677381', 'Papendorpseweg 100, 3528 BJ Utrecht'),

(26, 'Tom Tom', 'Max ', NULL, 'Schemidt', 'Software Developer', 'max.schmidt@tomtom.com', '686677481', 'Oosterdoksstraat 114, 1011 DK Amsterdam'),

(27, 'Atos IT Systeem B.V.', 'Yusuf', NULL, 'Gonzales', 'Cybersecurity Consultant', 'yusuf.gonzalez@atos.net', '686677881', 'Reykjavikplein 1, 3543 KA Utrecht'),

(28, 'AMSL', 'Eva', NULL, 'Oosterhuis', 'Logistiek coördinator', 'eva.oosterhuis@amsl.nl', '686687881', 'Fokkerweg 300, 1118 CP Schiphol'),

(29, 'Belden B.V.', 'Jan', NULL, 'Schemidt', 'Verkoop vertegenwoordiger', 'jan.schmidt@belden.nl', '686677981', 'De Witbogt 6, 5652 AG Eindhoven'),

(30, 'Volta Limburg', 'Lisa', 'de', ' Vris', 'Project Manager', 'lisa.devries@volta-limburg.nl', '686671881', 'Flemingstraat 2, 6415 CT Heerlen'),

(31, 'Media Market', 'Mohamed', NULL, 'Adam', 'Verkoop Medewerker', 'mohamed.adam@mediamarkt.nl', '686672881', 'Kalverstraat 123, 1012 PK Amsterdam'),

(32, 'Etos', '	Laura', 'van den', 'Brink', 'HR Manager', 'l.vandenbrink@etos.nl', '686637881', '	Utrechtsestraat 35, 1017 VH Amsterdam'),

(33, 'ABN AMRO', 'Thijs', 'de', 'Jong', 'Financial Analyst', 't.dejong@abnamro.nl', '686477881', 'Gustav Mahlerlaan 10, 1082 PP Amsterdam'),

(34, 'HP', 'Martijn', 'van der', 'Pol', 'Senior Developer', 'm.vanderpol@hp.com', '686657881', 'Startbaan 16, 1187 XR Amstelveen'),
(35, 'Sony', 'Kim', 'van der', 'Heuvel', 'Marketing Coördinator', 'k.vandenheuvel@sony.nl', '680677881', 'Vlinderweg 1, 1118 LA Schiphol'),

(36, 'KLM', 'Thijs', 'de', 'Vries', 'Medewerker Service Manager', 't.devries@klm.com', '688777881', 'Amsterdam Airport Schiphol, Evert van de Beekstraat 202, 1118 CP'),

(37, 'DSM', 'Marloes', 'van der', 'Linden', 'Supply Chain Manager', 'm.vanderlinden@dsm.com', '687877881', 'Het Overloon 1, 6411 TE Heerlen'),

(38, 'Accenture', 'Tim', 'van den', 'Bosch', 'Management adviseur', 't.vandenbosch@accenture.com', '685977881', 'Gustav Mahlerplein 90, 1082 MA Amsterdam'),

(39, 'NVIDIA B.V', 'Emma', 'van der', 'Laar', 'Software Engineer', 'e.vanderlaar@nvidia.com', '684677881', 'Aert van Nesstraat 45, 3012 CA Rotterdam'),

(40, 'VMware B.V', 'Sander', 'van den', 'Berg', 'IT Consultant', 's.vandenbergh@vmware.com', '683677881', 'Oosterdoksstraat 114, 1021 DK Amsterdam'),

(41, 'BMC Software', 'Roel', 'van der', 'Thijs', 'Product Manager', 'r.vanderthijs@gmail.nl', '682677881', 'Hogehilweg 16, 1101 CD Amsterdam'),

(42, 'Exact', 'Marije', 'van der', 'Bosch', 'Financieel manager', 'm.vanderbosch@gmail.nl', '681677881', 'Veldzijde 28, 3454 PW'),

(43, 'Mendix', 'Smits', NULL, 'man', 'Web ontwikkelaar', 's.man@gmail.nl', '688677881', 'Wilhelminakade 197, 3072 AP Rotterdam'),

(44, 'Schuberg Philis', 'John', 'van der', 'Doe', 'CEO', 'john.doe@schubergphilis.com', '686677581', 'Kruisweg 799, 2132 NG Hoofddorp'),

(45, 'Microsoft', 'Sarah', 'de', 'Vris', 'CTO', 'sarah.devries@microsoft.com', '686679881', 'Evert van de Beekstraat 354, 1118 CZ Schiphol'),

(46, 'TOPdesk', 'Thomas', 'van', 'Leeuwen', 'CFO', 'thomas.vanleeuwen@topdesk.com', '686670881', 'Burgemeester Roelenweg 33, 8021 EV Zwolle'),

(47, 'SLTN Inter Acces', 'Lisa ', 'van ', 'Jasper', 'Chief operational officer', 'lisa.jasper@sltn.nl', '686697881', 'Louis Braillelaan 80, 2719 EK Zoetermeer'),

(48, 'HSO', 'Erik', 'den', 'Braber', 'CMO', 'erik.denbraber@hso.com', '686877881', 'Houttuinlaan 7, 3447 GM Woerden'),

(49, 'PwC Nederland', 'Jan', 'den', 'Bosch', 'CEO', 'jan.denbosch@pwc.com', '686670881', 'Thomas R. Malthusstraat 5, 1066 JR Amsterdam');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `werknemers`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `werknemers`
--
ALTER TABLE `klanten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
