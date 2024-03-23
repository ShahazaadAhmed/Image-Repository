-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2023 at 04:39 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Uid` varchar(25) NOT NULL,
  `pd` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Uid`, `pd`) VALUES
('admin', 'admin'),
('Laasya', 'ALaasya@2004'),
('Shahazaad', 'Shahazaad'),
('Sreekar', 'ASreekar@2003'),
('superA', 'superA');

-- --------------------------------------------------------

--
-- Table structure for table `castordisease`
--

CREATE TABLE `castordisease` (
  `Id` int(25) NOT NULL,
  `PName` varchar(30) NOT NULL,
  `SCName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `castordisease`
--

INSERT INTO `castordisease` (`Id`, `PName`, `SCName`) VALUES
(101, 'Seedling blight', 'Phytophthora parasitica'),
(102, 'Rust', 'Melampsora ricini'),
(103, 'Leaf blight', 'Alternaria ricini'),
(104, 'Brown leaf spot', 'Cercospora ricinella'),
(105, 'Powdery mildew', 'Leveillula taurica'),
(106, 'Stem rot', 'Macrophomina phaseolina'),
(107, 'Bacterial leaf spot', 'Xanthomonas campestris pv. ric'),
(108, 'Wilt', 'Fusarium oxysporum'),
(109, 'Alternaria Blight', 'Alternaria ricini Y'),
(110, 'Root rot / Charcoal Rot / Die ', 'Macrophomina phaseolina'),
(111, 'Fusarium wilt', 'Fusarium oxysporum f. sp. rici'),
(112, 'Grey mold', 'Botrytis ricini'),
(113, 'Capsule rot', 'Cladosporium oxysporum');

-- --------------------------------------------------------

--
-- Table structure for table `castorpest`
--

CREATE TABLE `castorpest` (
  `Id` int(25) NOT NULL,
  `PName` varchar(30) NOT NULL,
  `SCName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `castorpest`
--

INSERT INTO `castorpest` (`Id`, `PName`, `SCName`) VALUES
(101, 'Red Hairy Catterpillar', 'Amsacta albistriga Walker'),
(102, 'Castor semilooper', 'Achoea janata Linnaeus'),
(103, 'Tobacco caterpillar', 'Spodoptera litura (Fabr)'),
(104, 'Shoot and Capsule borer', 'Conogethes (Dichocrosis) punct'),
(105, 'Leaf hopper', 'Empoasca flavescens (Fabr)'),
(106, 'Thrips', 'Retithrips syriacus (Mayet)'),
(107, 'Whitefly', 'Trialeurodes ricini (Misra)'),
(108, 'Serpentine leaf miner', 'Liriomyza trifolii Burgess'),
(109, 'Bihar Hairy caterpillar', 'Spilosoma (Diacrisia) obliqua '),
(110, 'Red spider mite', 'Tetranychus telarious L.');

-- --------------------------------------------------------

--
-- Table structure for table `crop`
--

CREATE TABLE `crop` (
  `Id` int(3) NOT NULL,
  `CName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crop`
--

INSERT INTO `crop` (`Id`, `CName`) VALUES
(1, 'castor'),
(2, 'sunflower'),
(3, 'safflower'),
(4, 'sesame'),
(5, 'linseed');

-- --------------------------------------------------------

--
-- Table structure for table `linseeddisease`
--

CREATE TABLE `linseeddisease` (
  `Id` int(25) NOT NULL,
  `PName` varchar(30) NOT NULL,
  `SCName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `linseeddisease`
--

INSERT INTO `linseeddisease` (`Id`, `PName`, `SCName`) VALUES
(501, 'Rust', 'Melompsora lini'),
(502, 'Alternaria blight', 'Alternaria lini'),
(503, 'Wilt', 'Fusarium oxysporum spp. Lini'),
(504, 'Powdery mildew ', 'Powdery mildew ');

-- --------------------------------------------------------

--
-- Table structure for table `moderator`
--

CREATE TABLE `moderator` (
  `Uid` varchar(25) NOT NULL,
  `pd` varchar(20) NOT NULL,
  `spz` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `moderator`
--

INSERT INTO `moderator` (`Uid`, `pd`, `spz`) VALUES
('admin', 'admin', 'castordisease'),
('Laasya', 'MLaasya@2004', NULL),
('mod', 'mod', 'sesamepest'),
('Sreekar', 'MSreekar@2003', NULL),
('superM', 'superM', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nutrients`
--

CREATE TABLE `nutrients` (
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nutrients`
--

INSERT INTO `nutrients` (`name`) VALUES
('Nitrogen'),
('Phosphorus'),
('Potassium'),
('Magnesium'),
('Manganese'),
('Calcium'),
('Sulfur'),
('Boron'),
('Zinc'),
('Iron'),
('Copper'),
('Molybdenum'),
('Chlorine');

-- --------------------------------------------------------

--
-- Table structure for table `permdb`
--

CREATE TABLE `permdb` (
  `User` varchar(50) NOT NULL,
  `IName` int(10) NOT NULL,
  `CROP` varchar(20) NOT NULL,
  `MONTH` varchar(10) NOT NULL,
  `YEAR` int(4) NOT NULL,
  `CROP STAGE` varchar(20) NOT NULL,
  `PARTS-AFFECTED` varchar(15) NOT NULL,
  `DEVICE/SHOT` varchar(15) NOT NULL,
  `SEASON` varchar(10) NOT NULL,
  `STATE` varchar(20) NOT NULL,
  `PORD` varchar(15) NOT NULL,
  `AREA` varchar(30) NOT NULL,
  `BACKGROUND` varchar(15) NOT NULL,
  `PORDNAME` varchar(50) NOT NULL,
  `IMGCONTAINS` varchar(15) NOT NULL,
  `STAGE` varchar(20) NOT NULL,
  `IMAGE` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `safflowerdisease`
--

CREATE TABLE `safflowerdisease` (
  `PName` varchar(30) NOT NULL,
  `SCName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `safflowerdisease`
--

INSERT INTO `safflowerdisease` (`PName`, `SCName`) VALUES
('Alternaria blight', 'Alternaria carthami'),
('Leaf spot', 'Cercospora carthami'),
('Powdery mildew', 'Erysiphe cichoracearum'),
('Mosaic', 'Cucumber mosaic virus (CMV)'),
('Rust', 'Puccinia carthami'),
('Puccinia carthami', 'Puccinia carthami'),
('Ramularia leaf spot', 'Ramularia leaf spot'),
('Root rot', 'Rhizoctonia bataticola');

-- --------------------------------------------------------

--
-- Table structure for table `safflowerpest`
--

CREATE TABLE `safflowerpest` (
  `Id` int(25) NOT NULL,
  `PName` varchar(30) NOT NULL,
  `SCName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `safflowerpest`
--

INSERT INTO `safflowerpest` (`Id`, `PName`, `SCName`) VALUES
(301, 'Capsule borer', 'Helicoverpa armigera'),
(302, 'Safflower caterpillar', 'Perigaea capensis'),
(303, 'Capsule fly/Safflower bud fly', 'Acanthiophilus helianthi rossi'),
(304, 'Safflower aphid', 'Uroleucon carthami'),
(305, 'Aphids', 'Uroleucon compositae');

-- --------------------------------------------------------

--
-- Table structure for table `scastorpest`
--

CREATE TABLE `scastorpest` (
  `stages` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scastorpest`
--

INSERT INTO `scastorpest` (`stages`) VALUES
('Egg'),
('Early instar Larva'),
('Late instar Larva'),
('Pupa'),
('Adult'),
('Nymph'),
('Pupae'),
('Maggots');

-- --------------------------------------------------------

--
-- Table structure for table `sesamedisease`
--

CREATE TABLE `sesamedisease` (
  `Id` int(25) NOT NULL,
  `PName` varchar(30) NOT NULL,
  `SCName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sesamedisease`
--

INSERT INTO `sesamedisease` (`Id`, `PName`, `SCName`) VALUES
(401, 'Bacterial blight', 'Xanthomonas campestris pv. ses'),
(402, 'Cercospora leaf spot ', 'Cercospora sesami, C. sesamico'),
(403, 'Damping off / Root Rot', 'Macrophomina phaseolina'),
(404, 'Powdery mildew', 'Oidium sp., Sphaerotheca fulig'),
(405, 'Sesamum phyllody', 'Phytoplasma'),
(406, 'Root rot', 'Fusarium oxysporum f.sp.sesami'),
(407, 'Leaf blight', 'Alternaria sesami'),
(408, 'Stem blight', 'Phytophthora parasitica var. s'),
(409, 'Bacterial leaf spot', 'Pseudomonas sesami');

-- --------------------------------------------------------

--
-- Table structure for table `sesamepest`
--

CREATE TABLE `sesamepest` (
  `Id` int(25) NOT NULL,
  `PName` varchar(30) NOT NULL,
  `SCName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sesamepest`
--

INSERT INTO `sesamepest` (`Id`, `PName`, `SCName`) VALUES
(401, 'Leaf webber', 'Antigastra catalaunalis'),
(402, 'Gall fly', 'Asphondylia sesami'),
(403, 'Bud fly', 'Dasineura sesami'),
(404, 'Sesame leafhopper', 'Orosius albicinctus'),
(405, 'Orosius albicinctus', 'Orosius albicinctus'),
(406, 'Bihar hairy caterpillar', 'Spilosoma obliqua'),
(407, 'Linseed gall fly', 'Dasyneura sesame '),
(408, 'Aphids', 'Aphis gossypii');

-- --------------------------------------------------------

--
-- Table structure for table `ssafflowerpest`
--

CREATE TABLE `ssafflowerpest` (
  `stages` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ssafflowerpest`
--

INSERT INTO `ssafflowerpest` (`stages`) VALUES
('Eggs'),
('Early instar'),
('Late instar'),
('nymph'),
('wingless adult'),
('winged adult');

-- --------------------------------------------------------

--
-- Table structure for table `ssesamepest`
--

CREATE TABLE `ssesamepest` (
  `stages` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ssesamepest`
--

INSERT INTO `ssesamepest` (`stages`) VALUES
('Egg'),
('Early instar Larva'),
('Late instar Larva'),
('Pupa'),
('Adult'),
('maggot'),
('pupa'),
('Nymph');

-- --------------------------------------------------------

--
-- Table structure for table `ssunflowerpest`
--

CREATE TABLE `ssunflowerpest` (
  `stages` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ssunflowerpest`
--

INSERT INTO `ssunflowerpest` (`stages`) VALUES
('Larva'),
('Egg'),
('Egg mass'),
('Nymph'),
('adult');

-- --------------------------------------------------------

--
-- Table structure for table `sunflowerdisease`
--

CREATE TABLE `sunflowerdisease` (
  `Id` int(25) NOT NULL,
  `PName` varchar(30) NOT NULL,
  `SCName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sunflowerdisease`
--

INSERT INTO `sunflowerdisease` (`Id`, `PName`, `SCName`) VALUES
(201, 'Alternaria leaf blight', 'Alternaria helianthi'),
(202, 'Downy mildew', 'Plasmopara halstedi'),
(203, 'Phoma blight', 'Phoma macdonaldii'),
(204, 'Powdery mildew', 'Erysiphe cichoracearum'),
(205, 'Septoria leaf spot', 'Septoria helianthi'),
(206, 'Verticillium wilt', 'Verticillium wilt'),
(207, 'Rust', 'Puccinia helianthi'),
(208, 'Charcoal Rot', 'Macrophomina phaseolina'),
(209, 'Rhizopus Head Rot', 'Rhizopus sp'),
(210, 'Sclerotium wilt', 'Sclerotium rolfsii'),
(212, 'Sunflower mosaic virus SMV', 'Sunflower mosaic virus ');

-- --------------------------------------------------------

--
-- Table structure for table `sunflowerpest`
--

CREATE TABLE `sunflowerpest` (
  `Id` int(25) NOT NULL,
  `PName` varchar(30) NOT NULL,
  `SCName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sunflowerpest`
--

INSERT INTO `sunflowerpest` (`Id`, `PName`, `SCName`) VALUES
(201, 'Capitulum borer', 'Helicoverpa armigera'),
(202, 'Bihar hairy caterpillar', 'Spilosoma obliqua '),
(203, 'Tobacco caterpillar', 'Spodoptera litura'),
(204, 'Leaf hopper', 'Amrasca biguttula biguttula'),
(205, 'Parakeet', 'Psittacula krameri'),
(206, 'cut worms', 'Agrotis sp.'),
(207, 'Grasshoppers', 'Attractomorpha crenulata'),
(208, 'White fly', 'Bemesia tabaci'),
(209, 'Thrips', 'Scirtothrips dorsalis'),
(210, 'Green semilooper', 'Green semilooper');

-- --------------------------------------------------------

--
-- Table structure for table `tempdb`
--

CREATE TABLE `tempdb` (
  `User` varchar(50) NOT NULL,
  `IName` int(10) NOT NULL,
  `CROP` varchar(20) NOT NULL,
  `MONTH` varchar(10) NOT NULL,
  `YEAR` int(4) NOT NULL,
  `CROP STAGE` varchar(20) NOT NULL,
  `PARTS-AFFECTED` varchar(15) NOT NULL,
  `DEVICE/SHOT` varchar(15) NOT NULL,
  `SEASON` varchar(10) NOT NULL,
  `STATE` varchar(20) NOT NULL,
  `PORD` varchar(30) NOT NULL,
  `AREA` varchar(30) NOT NULL,
  `BACKGROUND` varchar(15) NOT NULL,
  `PORDNAME` varchar(50) NOT NULL,
  `IMGCONTAINS` varchar(15) NOT NULL,
  `STAGE` varchar(20) NOT NULL,
  `IMAGE` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Uid` varchar(25) NOT NULL,
  `pd` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Uid`, `pd`) VALUES
('admin', 'admin'),
('Laasya', 'ULaasya@2004'),
('Shahazaad', 'Shahazaad'),
('Sreekar', 'USreekar@2003'),
('superU', 'superU');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Uid`);

--
-- Indexes for table `castordisease`
--
ALTER TABLE `castordisease`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `castorpest`
--
ALTER TABLE `castorpest`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `crop`
--
ALTER TABLE `crop`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `linseeddisease`
--
ALTER TABLE `linseeddisease`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `moderator`
--
ALTER TABLE `moderator`
  ADD PRIMARY KEY (`Uid`);

--
-- Indexes for table `permdb`
--
ALTER TABLE `permdb`
  ADD PRIMARY KEY (`IName`);

--
-- Indexes for table `safflowerpest`
--
ALTER TABLE `safflowerpest`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `sesamedisease`
--
ALTER TABLE `sesamedisease`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `sesamepest`
--
ALTER TABLE `sesamepest`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `sunflowerdisease`
--
ALTER TABLE `sunflowerdisease`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `sunflowerpest`
--
ALTER TABLE `sunflowerpest`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tempdb`
--
ALTER TABLE `tempdb`
  ADD PRIMARY KEY (`IName`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crop`
--
ALTER TABLE `crop`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permdb`
--
ALTER TABLE `permdb`
  MODIFY `IName` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tempdb`
--
ALTER TABLE `tempdb`
  MODIFY `IName` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
