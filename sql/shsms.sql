-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2021 at 09:56 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shsms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `ID` int(15) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `Gender` varchar(30) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Passwords` varchar(255) NOT NULL,
  `Phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`ID`, `Username`, `Email`, `DOB`, `Gender`, `FirstName`, `LastName`, `Passwords`, `Phone`) VALUES
(1, 'admin', 'admin@edukate.edu', '1992-05-05', 'Male', 'Thomas', 'Muller', 'WjVuMDZhNUVQZXJvOWFjT2x0cmdYdz09', '0335899652'),
(3, 'Jarro', 'admin2@edukate.edu', '1990-11-02', 'Male', 'Charles', 'Colton', 'WjVuMDZhNUVQZXJvOWFjT2x0cmdYdz09', '0200336688');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `ID` int(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Account_No` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`ID`, `Name`, `Account_No`) VALUES
(1, 'GCB', '00000132254545'),
(2, 'Access bank', '55800132254545'),
(3, 'Fidelity bank', '99885132254545'),
(5, 'UBA', '78556552299875');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `ID` int(10) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`ID`, `Name`) VALUES
(1, 'Form One'),
(2, 'Form Two'),
(3, 'Form Three');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `ID` int(10) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`ID`, `Name`) VALUES
(1, 'Science'),
(2, 'Business'),
(3, 'Home Economics'),
(4, 'Visual Arts'),
(5, 'General Arts'),
(6, 'Information Technology');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `ID` int(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`ID`, `Name`, `Date`, `Details`) VALUES
(1, 'Bootcamp', '2021-04-30', 'Ut Enim Ad Minim Veniam, Quis Nostrud Exercitation Ullamco Laboris Nisi Ut Aliquip Ex Ea Commodo Consequat. Duis Aute Irure Dolor In Reprehenderit In Voluptate Velit Esse Cillum Dolore Eu Fugiat Nulla Pariatur.'),
(2, 'Jump Tup', '2021-05-12', 'Integer Malesuada Nunc Vel Risus Commodo. Ut Faucibus Pulvinar Elementum Integer Enim Neque Volutpat. Tortor Vitae Purus Faucibus Ornare Suspendisse Sed Nisi. Ut Tortor Pretium Viverra Suspendisse Potenti. Ornare Arcu Dui Vivamus Arcu Felis. Tellus Elementum Sagittis Vitae Et Leo Duis Ut Diam. Duis At Tellus At Urna Condimentum Mattis Pellentesque Id Nibh. Dui Accumsan Sit Amet Nulla Facilisi. Id Velit Ut Tortor Pretium Viverra Suspendisse. Quis Vel Eros Donec Ac Odio Tempor Orci Dapibus.');

-- --------------------------------------------------------

--
-- Table structure for table `examcategory`
--

CREATE TABLE `examcategory` (
  `ID` int(10) NOT NULL,
  `Term` varchar(255) NOT NULL,
  `Section` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `examcategory`
--

INSERT INTO `examcategory` (`ID`, `Term`, `Section`) VALUES
(1, 'First-Term', 'End-Of-Term'),
(2, 'Second-Term', 'End-Of-Term'),
(3, 'Third-Term', 'End-Of-Term');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `ID` int(10) NOT NULL,
  `StudentID` varchar(255) NOT NULL,
  `Class` int(10) NOT NULL,
  `ExamCategory` int(10) NOT NULL,
  `Subject` int(10) NOT NULL,
  `Score` int(3) NOT NULL,
  `Grade` varchar(10) NOT NULL,
  `DOG` date NOT NULL,
  `GradedBy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`ID`, `StudentID`, `Class`, `ExamCategory`, `Subject`, `Score`, `Grade`, `DOG`, `GradedBy`) VALUES
(1, 'REG5285209375', 1, 1, 4, 50, 'C6', '2021-05-26', 'ghana polk(Teacher)');

-- --------------------------------------------------------

--
-- Table structure for table `feescollection`
--

CREATE TABLE `feescollection` (
  `ID` int(10) NOT NULL,
  `Student` varchar(20) NOT NULL,
  `Arrears` int(10) NOT NULL,
  `PaidAmount` varchar(255) NOT NULL,
  `Balance` int(10) NOT NULL,
  `Date` date NOT NULL,
  `Remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feescollection`
--

INSERT INTO `feescollection` (`ID`, `Student`, `Arrears`, `PaidAmount`, `Balance`, `Date`, `Remarks`) VALUES
(4, 'Reg6204456829', 1900, '2000', 100, '2021-04-11', 'Paid in advance'),
(7, 'Reg4663084931', 2533, '7888', 5355, '2021-04-27', 'Paid in advance');

-- --------------------------------------------------------

--
-- Table structure for table `hostels`
--

CREATE TABLE `hostels` (
  `ID` int(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hostels`
--

INSERT INTO `hostels` (`ID`, `Name`, `Status`) VALUES
(1, 'Moteja hostel', 'Available'),
(2, 'Folden hostel', 'Unavailable'),
(3, 'Henma hostel', 'Avaliable'),
(4, 'Postalon Hostel', 'Available'),
(6, 'Freeman hostel', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `ID` int(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Description` text NOT NULL,
  `Posted_By` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`ID`, `Name`, `Date`, `Description`, `Posted_By`) VALUES
(1, 'Spirng Carnival', '2021-05-02', 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit, Sed Do Eiusmod Tempor Incididunt Ut Labore Et Dolore Magna Aliqua. Ut Enim Ad Minim Veniam, Quis Nostrud Exercitation Ullamco Laboris Nisi Ut Aliquip Ex Ea Commodo Consequat. Duis Aute Irure Dolor In Reprehenderit In Voluptate Velit Esse Cillum Dolore Eu Fugiat Nulla Pariatur. Excepteur Sint Occaecat Cupidatat Non Proident, Sunt In Culpa Qui Officia Deserunt Mollit Anim Id Est Laborum.', '(admin) Thomas Muller');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `ID` int(10) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `HomeAddress` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`ID`, `FirstName`, `LastName`, `Phone`, `HomeAddress`, `Email`) VALUES
(1, 'Amelia Asana', 'Atepa', '0201239850', '24 Lanpo street, Osu.', 'ameliaaa@gmail.com'),
(2, 'Philip', 'Jones', '0266611447', 'Nano gen avenue, kanda.', 'jonesphil@newmount.com'),
(3, 'Mary ', 'Alorde', '0245188332', '214 Teleko street, maamobi', 'alorde22@yahoo.com'),
(4, 'Samira', 'Janga', '0302114577', 'Janga Town 20, 455', 'samijanga@live.com'),
(6, 'Edga', 'Simons', '0549833225', '45 Atipa Street kanda', 'pastaking77@gmail.com'),
(7, 'Shima', 'Kissi', '027788995', 'Flat house 225', 'shimakissi@kims.com');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `ID` int(10) NOT NULL,
  `Position` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`ID`, `Position`) VALUES
(1, 'Head Teacher'),
(2, 'Assistant Head Teacher'),
(3, 'Teacher');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `Position` int(11) NOT NULL,
  `Subject` int(10) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Passwords` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `FirstName`, `LastName`, `Gender`, `DOB`, `Position`, `Subject`, `Phone`, `Email`, `Passwords`) VALUES
('stf001 ', 'Ellen', 'French', 'Female', '1992-02-29', 1, 6, '0558964785', 'ellenfrench@edukate.edu', 'WjVuMDZhNUVQZXJvOWFjT2x0cmdYdz09'),
('stf002', 'John', 'Doe', 'Male', '1988-08-20', 2, 6, '0248514778', 'johndoe@edukate.edu', 'WjVuMDZhNUVQZXJvOWFjT2x0cmdYdz09'),
('stf2588', 'Nana', 'Ebow Aidoo', 'Male', '1998-02-14', 3, 1, '0200304477', 'ebowaidoonana@edukate.edu', 'WjVuMDZhNUVQZXJvOWFjT2x0cmdYdz09'),
('stf3673', 'Daniel', 'Sins', 'Male', '1992-04-11', 3, 2, '0285563325', 'danielsin@edukate.edu', 'WjVuMDZhNUVQZXJvOWFjT2x0cmdYdz09'),
('stf6113', 'Derek', 'Morgan', 'Male', '1989-03-18', 3, 3, '0269800003', 'morganderek@edukate.edu', 'WjVuMDZhNUVQZXJvOWFjT2x0cmdYdz09'),
('stf6393', 'Roger Finley', 'Maxwells', 'Male', '1991-08-23', 3, 4, '0554896742', 'maxwellsrogerfinley@edukate.edu', 'WjVuMDZhNUVQZXJvOWFjT2x0cmdYdz09'),
('stf8216', 'Nathan', 'Quao', 'Male', '1997-02-15', 3, 4, '0200639920', 'quaonathan@edukate.edu', 'WjVuMDZhNUVQZXJvOWFjT2x0cmdYdz09'),
('stf8591', 'ghana', 'polk', 'Male', '1991-07-13', 3, 4, '787987652', 'polkghana@edukate.edu', 'WjVuMDZhNUVQZXJvOWFjT2x0cmdYdz09'),
('stf8853', 'Selina', 'Atumpa', 'Female', '1992-07-10', 3, 5, '0235566002', 'atumpaselina@edukate.edu', 'WjVuMDZhNUVQZXJvOWFjT2x0cmdYdz09');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Gender` varchar(25) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `HostelID` int(11) NOT NULL,
  `ClassID` int(11) NOT NULL,
  `CourseID` int(10) NOT NULL,
  `ParentID` int(11) NOT NULL,
  `Passwords` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `FirstName`, `LastName`, `Gender`, `Email`, `DOB`, `HostelID`, `ClassID`, `CourseID`, `ParentID`, `Passwords`) VALUES
('REG2469126179', 'Daniel', 'Honda', 'Male', 'hondadaniel@st.edukate.edu', '1999-03-14', 2, 1, 1, 1, 'WjVuMDZhNUVQZXJvOWFjT2x0cmdYdz09'),
('REG4663084931', 'Edward', 'Kissi', 'Male', 'kissiedward@st.edukate.edu', '2002-09-24', 2, 1, 2, 7, 'WjVuMDZhNUVQZXJvOWFjT2x0cmdYdz09'),
('REG5108785235', 'Thim', 'Lo', 'Female', 'lothim@st.edukate.edu', '2001-03-17', 1, 1, 3, 2, 'WjVuMDZhNUVQZXJvOWFjT2x0cmdYdz09'),
('REG5285209375', 'Timothy', 'Janga', 'Male', 'jangatimothy@st.edukate.edu', '2004-04-18', 1, 1, 4, 4, 'WjVuMDZhNUVQZXJvOWFjT2x0cmdYdz09'),
('REG9291858497', 'Samuella', 'Tanko', 'Female', 'tankosamuella@st.edukate.edu', '2000-11-08', 1, 1, 5, 6, 'WjVuMDZhNUVQZXJvOWFjT2x0cmdYdz09');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `ID` int(10) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`ID`, `Name`) VALUES
(1, 'Core Science'),
(2, 'Core Mathematics'),
(3, 'Core English'),
(4, 'Social Studies'),
(5, 'French'),
(6, 'All Subjects');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `examcategory`
--
ALTER TABLE `examcategory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `ExamCategory` (`ExamCategory`),
  ADD KEY `Class` (`Class`);

--
-- Indexes for table `feescollection`
--
ALTER TABLE `feescollection`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hostels`
--
ALTER TABLE `hostels`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `staff_ibfk_1` (`Subject`),
  ADD KEY `PositionFK` (`Position`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`),
  ADD KEY `students_ibfk_1` (`HostelID`),
  ADD KEY `students_ibfk_2` (`ClassID`),
  ADD KEY `students_ibfk_3` (`ParentID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `examcategory`
--
ALTER TABLE `examcategory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feescollection`
--
ALTER TABLE `feescollection`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hostels`
--
ALTER TABLE `hostels`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `students` (`StudentID`),
  ADD CONSTRAINT `exams_ibfk_2` FOREIGN KEY (`ExamCategory`) REFERENCES `examcategory` (`ID`),
  ADD CONSTRAINT `exams_ibfk_3` FOREIGN KEY (`Class`) REFERENCES `classes` (`ID`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `PositionFK` FOREIGN KEY (`Position`) REFERENCES `positions` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`Subject`) REFERENCES `subjects` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`HostelID`) REFERENCES `hostels` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`ClassID`) REFERENCES `classes` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`ParentID`) REFERENCES `parents` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_4` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
