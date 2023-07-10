-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 10, 2023 at 04:57 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ereliv`
--

-- --------------------------------------------------------

--
-- Table structure for table `ActivePaper`
--

CREATE TABLE `ActivePaper` (
  `studentCreatorID` int(11) DEFAULT NULL,
  `facultyCreatorID` int(11) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `researchPaper` int(11) NOT NULL,
  `activePaperID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ActivePaper`
--

INSERT INTO `ActivePaper` (`studentCreatorID`, `facultyCreatorID`, `status`, `researchPaper`, `activePaperID`) VALUES
(NULL, 15, 'inactive', 80, 9),
(NULL, 15, 'inactive', 80, 10),
(NULL, 15, 'inactive', 80, 11),
(NULL, 15, 'inactive', 80, 12),
(NULL, 15, 'inactive', 94, 13),
(NULL, 15, 'active', 97, 14),
(NULL, 15, 'inactive', 89, 15),
(NULL, 15, 'inactive', 91, 16),
(NULL, 18, 'active', 92, 17),
(NULL, 18, 'active', 93, 18),
(NULL, 15, 'inactive', 95, 19),
(NULL, 15, 'inactive', 98, 20),
(NULL, 15, 'active', 100, 21);

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `adminID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`adminID`, `username`, `password`, `firstname`, `lastname`) VALUES
(1, 'admin', '$2y$10$13QvYvjNtdiRq/hO6Bs3iuRboRXiSTFgXlHC9s71bU.KcH4d4SETq', 'e-Reliv', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `Adviserteam`
--

CREATE TABLE `Adviserteam` (
  `facultyID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Adviserteam`
--

INSERT INTO `Adviserteam` (`facultyID`, `studentID`) VALUES
(1, 30),
(11, 32),
(13, 31),
(15, 33),
(15, 34),
(15, 35),
(18, 29);

-- --------------------------------------------------------

--
-- Table structure for table `Approve`
--

CREATE TABLE `Approve` (
  `approveID` int(11) NOT NULL,
  `research` int(11) DEFAULT NULL,
  `notification` int(11) DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `oldresearch` int(11) DEFAULT NULL,
  `action` enum('ApprovePaper','ApproveEdit','ApproveDelete','ApproveAuthorEdit','ApproveAuthorDelete','ApproveAccount') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Author`
--

CREATE TABLE `Author` (
  `authorID` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Author`
--

INSERT INTO `Author` (`authorID`, `firstname`, `lastname`, `status`) VALUES
(3, 'Angela', 'Batoon', 'Active'),
(5, 'Jahzel', 'Peralta', 'Active'),
(6, 'Katherine', 'Tan', 'Active'),
(9, 'Madhuri', 'Kulkarni', 'Active'),
(114, 'Hayme', 'Belgica', 'Active'),
(119, 'Sevim', 'Zaim', 'Active'),
(120, 'vissagan', 'Sankaranayanan', 'Active'),
(121, 'Louise', 'Rainfold', 'Active'),
(122, 'Antonina', 'Tcacenco', 'Active'),
(123, 'Simplice', 'Asongu', 'Active'),
(125, 'joseph', 'nnannaa', 'Active'),
(127, 'Giuseppe', 'Latessa', 'Active'),
(128, 'Luigi', 'Bianchi', 'Active'),
(130, 'Erik', 'Cambria', 'Active'),
(131, 'Bebo', 'White', 'Active'),
(134, 'Katherine', 'Thanos', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `EditHistory`
--

CREATE TABLE `EditHistory` (
  `editID` int(11) NOT NULL,
  `activePaperID` int(11) DEFAULT NULL,
  `paperUpdate` int(11) NOT NULL,
  `approver` int(11) NOT NULL,
  `editDate` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `EditHistory`
--

INSERT INTO `EditHistory` (`editID`, `activePaperID`, `paperUpdate`, `approver`, `editDate`) VALUES
(6, 9, 47, 15, '2023-06-29'),
(7, 9, 47, 15, '2023-06-29'),
(8, 9, 49, 15, '2023-06-29'),
(9, 9, 50, 15, '2023-06-29'),
(10, 9, 51, 15, '2023-06-29'),
(11, 9, 52, 15, '2023-06-29'),
(12, 9, 53, 15, '2023-06-29'),
(13, 9, 54, 15, '2023-06-29'),
(14, 9, 55, 15, '2023-06-29'),
(15, 9, 56, 15, '2023-06-29'),
(16, 9, 57, 15, '2023-06-29'),
(17, 9, 58, 15, '2023-06-29'),
(18, 9, 59, 15, '2023-06-29'),
(19, 9, 60, 15, '2023-06-29'),
(20, 9, 61, 15, '2023-06-29'),
(21, 9, 62, 15, '2023-06-29'),
(22, 9, 63, 15, '2023-06-29'),
(23, 9, 64, 15, '2023-06-29'),
(24, 9, 65, 15, '2023-06-29'),
(25, 10, 66, 15, '2023-06-29'),
(26, 9, 67, 15, '2023-06-29'),
(27, 9, 68, 15, '2023-06-29'),
(28, 11, 69, 15, '2023-06-29'),
(29, 12, 70, 15, '2023-06-29'),
(30, 9, 71, 15, '2023-06-29'),
(31, 9, 72, 15, '2023-06-29'),
(32, 13, 73, 15, '2023-06-29'),
(33, 9, 74, 15, '2023-06-29'),
(34, 9, 75, 15, '2023-06-29'),
(35, 9, 76, 15, '2023-06-29'),
(36, 9, 77, 15, '2023-06-29'),
(37, 14, 78, 15, '2023-06-29'),
(38, 14, 79, 15, '2023-06-29'),
(39, 9, 80, 15, '2023-06-29'),
(40, 14, 81, 15, '2023-06-29'),
(41, 13, 82, 15, '2023-06-30'),
(42, 13, 83, 15, '2023-06-30'),
(43, 13, 84, 15, '2023-06-30'),
(44, 13, 85, 15, '2023-06-30'),
(45, 13, 86, 15, '2023-06-30'),
(46, 13, 87, 15, '2023-06-30'),
(47, 15, 88, 15, '2023-07-01'),
(48, 15, 89, 15, '2023-07-01'),
(49, 16, 90, 15, '2023-07-01'),
(50, 16, 91, 15, '2023-07-01'),
(51, 17, 92, 18, '2023-07-01'),
(52, 18, 93, 18, '2023-07-01'),
(53, 13, 94, 15, '2023-07-01'),
(54, 19, 95, 15, '2023-07-01'),
(55, 14, 96, 15, '2023-07-01'),
(56, 14, 97, 15, '2023-07-01'),
(57, 20, 98, 15, '2023-07-05'),
(58, 21, 99, 15, '2023-07-05'),
(59, 21, 100, 15, '2023-07-05');

-- --------------------------------------------------------

--
-- Table structure for table `Faculty`
--

CREATE TABLE `Faculty` (
  `facultyID` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `emailadd` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `dateregistered` date NOT NULL DEFAULT curdate(),
  `code` varchar(255) DEFAULT NULL,
  `category` enum('Supervisor','Advisor') NOT NULL DEFAULT 'Advisor',
  `priority` enum('High','Medium','Low') NOT NULL DEFAULT 'Low'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Faculty`
--

INSERT INTO `Faculty` (`facultyID`, `firstname`, `lastname`, `password`, `emailadd`, `status`, `dateregistered`, `code`, `category`, `priority`) VALUES
(1, 'jane', 'doe', '$2y$10$84Nko3ZLpP1PO846mmw/5uaTbBIdefOLsHDWHLEdOFG5xKAGwF9CC', 'janedoe@gmail.com', 'Active', '2023-05-19', NULL, 'Supervisor', 'Low'),
(11, 'Yoshi', 'Taro', '$2y$10$7bL7PM8Mk6wNeIMjyETjTOcccQIY8UiujvpJk4EwcDs2dIjReeUrm', 'yohitaro@gmail.com', 'Active', '2023-05-16', NULL, 'Advisor', 'Low'),
(13, 'Dina', 'Lego', '$2y$10$qVg8IChoSzEvoSFdl8btZu1Ts85ndDhTn5/yKcLuEX2sYgtt/JQAq', 'dinalego@gmail.com', 'Active', '2023-05-16', NULL, 'Advisor', 'Low'),
(15, 'hayme', 'belgica', '$2y$10$FSx.YPvarkOM7r56fwxK0uIA3w1ZMTq3DdyG4aGVpHj90OXp1iNdW', 'jamesmatthewbelgica@gmail.com', 'Active', '2023-05-25', 'HBIj5tMNax', 'Supervisor', 'Low'),
(18, 'Piacente Nich ', 'Commemoro', '$2y$10$4oHfOEsE2Yod4QU8yAoQnOkgwNPOyIDvd.trAjO1/xYT30lZsEuEu', 'piacentenichcommemoro@gmail.com', 'Active', '2023-06-02', 'ow3ZTxAVWc', 'Advisor', 'Low'),
(38, 'jane', 'taro', '$2y$10$L0bf93jyI6ATngQyMSgwM.TgW/NZr8s6AOOwI86iOnL76hL9ItdVi', 'janetaro@gmail.com', 'Active', '2023-07-01', NULL, 'Advisor', 'Low'),
(39, 'Jazhiel', 'Peralta', '$2y$10$0LwS6poqRdYLhx8TKTs3jO2dgOfX7fPMPaW00T4Ez7xAr.Zdkb25O', 'jwejaearts@gmail.com', 'Active', '2023-07-01', NULL, 'Advisor', 'Low');

--
-- Triggers `Faculty`
--
DELIMITER $$
CREATE TRIGGER `update_priority` BEFORE UPDATE ON `Faculty` FOR EACH ROW BEGIN
  IF NEW.status = 'Inactive' THEN
    IF DATEDIFF(CURDATE(), NEW.dateregistered) >= 3 THEN
      SET NEW.priority = 'high';
    ELSE
      SET NEW.priority = 'medium';
    END IF;
  ELSE
    SET NEW.priority = 'low';
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Interest`
--

CREATE TABLE `Interest` (
  `interestID` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Interest`
--

INSERT INTO `Interest` (`interestID`, `name`) VALUES
(1, 'Technology'),
(3, 'Information'),
(14, 'Entertainment');

-- --------------------------------------------------------

--
-- Table structure for table `Notification`
--

CREATE TABLE `Notification` (
  `notificationID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `dateissued` date NOT NULL DEFAULT curdate(),
  `status` enum('Read','Unread') NOT NULL DEFAULT 'Unread',
  `action` enum('ApprovePaper','ApproveEdit','ApproveDelete','ApproveAuthorEdit','ApproveAuthorDelete','ApproveAccount') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Notification`
--

INSERT INTO `Notification` (`notificationID`, `title`, `content`, `dateissued`, `status`, `action`) VALUES
(109, 'Request for Account Approval', 'I am writing to request the approval of my student account on the PUPQC Paper Management System. As a registered user, I have created the account and seek your validation to gain access to the system\'s valuable resources. Your approval will greatly contribute to my active participation in academic pursuits. Thank you for your kind attention.', '2023-06-22', 'Unread', NULL),
(110, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated. Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-06-24', 'Unread', NULL),
(111, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System. You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please don\'t hesitate to reach out to our support team.', '2023-06-24', 'Unread', NULL),
(112, 'Request for Account Approval', 'I am writing to request the approval of my student account on the PUPQC Paper Management System. As a registered user, I have created the account and seek your validation to gain access to the system\'s valuable resources. Your approval will greatly contribute to my active participation in academic pursuits. Thank you for your kind attention.', '2023-07-01', 'Unread', NULL),
(113, 'PUPQCRMS Faculty Account Created!', 'Congratulations we have successfully created your account! We are thrilled to welcome you to the PUPQC Paper Management System - E Reliv. This powerful platform will empower you to manage your papers efficiently, collaborate effectively, and streamline your academic processes. We are excited to have you on board and look forward to witnessing your valuable contributions. Should you have any questions or require assistance, please don\'t hesitate to reach out. Welcome to the PUPQC community!', '2023-07-01', 'Unread', NULL),
(114, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System. You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please don\'t hesitate to reach out to our support team.', '2023-07-01', 'Unread', NULL),
(115, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System. You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please don\'t hesitate to reach out to our support team.', '2023-07-01', 'Unread', NULL),
(116, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated. Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-01', 'Unread', NULL),
(117, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated. Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-01', 'Unread', NULL),
(118, 'Request for Account Approval', 'I am writing to request the approval of my student account on the PUPQC Paper Management System. As a registered user, I have created the account and seek your validation to gain access to the system\'s valuable resources. Your approval will greatly contribute to my active participation in academic pursuits. Thank you for your kind attention.', '2023-07-01', 'Unread', NULL),
(119, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System. You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please don\'t hesitate to reach out to our support team.', '2023-07-01', 'Unread', NULL),
(120, 'PUPQCRMS Faculty Account Created!', 'Congratulations we have successfully created your account! We are thrilled to welcome you to the PUPQC Paper Management System - E Reliv. This powerful platform will empower you to manage your papers efficiently, collaborate effectively, and streamline your academic processes. We are excited to have you on board and look forward to witnessing your valuable contributions. Should you have any questions or require assistance, please don\'t hesitate to reach out. Welcome to the PUPQC community!', '2023-07-01', 'Unread', NULL),
(121, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System. You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please don\'t hesitate to reach out to our support team.', '2023-07-01', 'Unread', NULL),
(122, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System. You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please don\'t hesitate to reach out to our support team.', '2023-07-01', 'Unread', NULL),
(123, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated. Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-01', 'Unread', NULL),
(124, 'Request for Account Approval', 'I am writing to request the approval of my student account on the PUPQC Paper Management System. As a registered user, I have created the account and seek your validation to gain access to the system\'s valuable resources. Your approval will greatly contribute to my active participation in academic pursuits. Thank you for your kind attention.', '2023-07-04', 'Unread', NULL),
(125, 'Request for Account Approval', 'I am writing to request the approval of my student account on the PUPQC Paper Management System. As a registered user, I have created the account and seek your validation to gain access to the system\'s valuable resources. Your approval will greatly contribute to my active participation in academic pursuits. Thank you for your kind attention.', '2023-07-04', 'Unread', NULL),
(126, 'Request for Account Approval', 'I am writing to request the approval of my student account on the PUPQC Paper Management System. As a registered user, I have created the account and seek your validation to gain access to the system\'s valuable resources. Your approval will greatly contribute to my active participation in academic pursuits. Thank you for your kind attention.', '2023-07-04', 'Unread', NULL),
(127, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System. You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please don\'t hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(128, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(Faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(129, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(130, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(131, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(132, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(133, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated. Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(134, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System. You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please don\'t hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(135, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(136, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(137, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(Faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(138, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(Faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(139, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(140, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(141, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(142, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(143, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(144, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(145, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(146, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(147, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(148, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(149, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(150, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(151, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(152, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(153, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(154, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(155, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(156, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(157, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(158, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(159, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(160, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(161, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(162, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(163, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(164, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(165, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(166, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(167, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(168, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(169, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(170, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(171, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(172, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(173, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(174, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(175, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(176, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(177, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(178, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(179, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(180, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(181, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(182, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(183, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(184, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(185, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(186, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(187, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(188, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(189, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(190, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(191, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(192, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(193, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(194, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(195, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(196, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(197, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(198, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(199, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(200, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(201, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(202, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(203, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(204, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(205, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(206, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(207, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(208, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(209, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(210, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL);
INSERT INTO `Notification` (`notificationID`, `title`, `content`, `dateissued`, `status`, `action`) VALUES
(211, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(212, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(213, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(214, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(215, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(216, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-05', 'Unread', NULL),
(217, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(218, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-05', 'Unread', NULL),
(219, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-06', 'Unread', NULL),
(220, 'PUPQC RMS Account Deactivation', 'We regret to inform you that your account in the PUPQC Research Paper Management System has been deactivated by our \' . ucwords(faculty) . \' member, \' . ucwords(Hayme Belgica) . \' . Your account was previously activated but has now been deactivated. <br> If you have any questions or concerns regarding the deactivation of your account, please contact our support team for further assistance.', '2023-07-06', 'Unread', NULL),
(221, 'PUPQC RMS Account Request Approval Accepted', 'Congratulations! Your account has been successfully accepted in the PUPQC Research Paper Management System by our Faculty member, Hayme Belgica . You now have access to our platform, where you can submit and manage your research papers efficiently. <br> We are excited to have you onboard and look forward to your valuable contributions. If you have any questions or need assistance, please nevert hesitate to reach out to our support team.', '2023-07-06', 'Unread', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `NotificationLink`
--

CREATE TABLE `NotificationLink` (
  `linkID` int(11) NOT NULL,
  `issuerAdminID` int(11) DEFAULT NULL,
  `issuerFacultyID` int(11) DEFAULT NULL,
  `issuerStudentID` int(11) DEFAULT NULL,
  `recipientAdminID` int(11) DEFAULT NULL,
  `recipientFacultyID` int(11) DEFAULT NULL,
  `recipientStudentID` int(11) DEFAULT NULL,
  `notificationID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `NotificationLink`
--

INSERT INTO `NotificationLink` (`linkID`, `issuerAdminID`, `issuerFacultyID`, `issuerStudentID`, `recipientAdminID`, `recipientFacultyID`, `recipientStudentID`, `notificationID`) VALUES
(118, NULL, NULL, 30, NULL, 1, NULL, 109),
(119, NULL, NULL, 30, NULL, NULL, NULL, 109),
(120, 1, NULL, NULL, NULL, NULL, 29, 110),
(121, 1, NULL, NULL, NULL, NULL, 29, 111),
(122, NULL, NULL, 31, NULL, 13, NULL, 112),
(123, NULL, NULL, 31, NULL, NULL, NULL, 112),
(124, 1, NULL, NULL, NULL, 38, NULL, 113),
(125, 1, NULL, NULL, NULL, NULL, 30, 114),
(126, 1, NULL, NULL, NULL, NULL, 31, 115),
(127, 1, NULL, NULL, NULL, NULL, 31, 116),
(128, 1, NULL, NULL, NULL, NULL, 29, 117),
(129, NULL, NULL, 32, NULL, 11, NULL, 118),
(130, NULL, NULL, 32, NULL, NULL, NULL, 118),
(131, 1, NULL, NULL, NULL, NULL, 32, 119),
(132, 1, NULL, NULL, NULL, 39, NULL, 120),
(133, 1, NULL, NULL, NULL, NULL, 31, 121),
(134, 1, NULL, NULL, NULL, NULL, 29, 122),
(135, 1, NULL, NULL, NULL, NULL, 32, 123),
(136, NULL, NULL, 33, NULL, 15, NULL, 124),
(137, NULL, NULL, 33, NULL, NULL, NULL, 124),
(138, NULL, NULL, 34, NULL, 15, NULL, 125),
(139, NULL, NULL, 34, NULL, NULL, NULL, 125),
(140, NULL, NULL, 35, NULL, 15, NULL, 126),
(141, NULL, NULL, 35, NULL, NULL, NULL, 126),
(142, 1, NULL, NULL, NULL, NULL, 35, 127),
(150, NULL, 15, NULL, NULL, NULL, NULL, 135),
(151, NULL, 15, NULL, NULL, NULL, NULL, 136),
(152, NULL, 15, NULL, NULL, NULL, NULL, 137),
(153, NULL, 15, NULL, NULL, NULL, NULL, 138),
(154, NULL, 15, NULL, NULL, NULL, NULL, 139),
(155, NULL, 15, NULL, NULL, NULL, NULL, 140),
(156, NULL, 15, NULL, NULL, NULL, NULL, 141),
(157, NULL, 15, NULL, NULL, NULL, NULL, 142),
(158, NULL, 15, NULL, NULL, NULL, NULL, 143),
(159, NULL, 15, NULL, NULL, NULL, NULL, 144),
(160, NULL, 15, NULL, NULL, NULL, NULL, 145),
(161, NULL, 15, NULL, NULL, NULL, NULL, 146),
(162, NULL, 15, NULL, NULL, NULL, NULL, 147),
(163, NULL, 15, NULL, NULL, NULL, NULL, 148),
(164, NULL, 15, NULL, NULL, NULL, NULL, 149),
(165, NULL, 15, NULL, NULL, NULL, NULL, 150),
(166, NULL, 15, NULL, NULL, NULL, NULL, 151),
(167, NULL, 15, NULL, NULL, NULL, NULL, 152),
(168, NULL, 15, NULL, NULL, NULL, NULL, 153),
(169, NULL, 15, NULL, NULL, NULL, NULL, 154),
(170, NULL, 15, NULL, NULL, NULL, NULL, 155),
(171, NULL, 15, NULL, NULL, NULL, NULL, 156),
(172, NULL, 15, NULL, NULL, NULL, NULL, 157),
(173, NULL, 15, NULL, NULL, NULL, NULL, 158),
(174, NULL, 15, NULL, NULL, NULL, NULL, 159),
(175, NULL, 15, NULL, NULL, NULL, NULL, 160),
(176, NULL, 15, NULL, NULL, NULL, NULL, 161),
(177, NULL, 15, NULL, NULL, NULL, NULL, 162),
(178, NULL, 15, NULL, NULL, NULL, NULL, 163),
(179, NULL, 15, NULL, NULL, NULL, NULL, 164),
(180, NULL, 15, NULL, NULL, NULL, NULL, 165),
(181, NULL, 15, NULL, NULL, NULL, NULL, 166),
(182, NULL, 15, NULL, NULL, NULL, NULL, 167),
(183, NULL, 15, NULL, NULL, NULL, NULL, 168),
(184, NULL, 15, NULL, NULL, NULL, NULL, 169),
(185, NULL, 15, NULL, NULL, NULL, NULL, 170),
(186, NULL, 15, NULL, NULL, NULL, NULL, 171),
(187, NULL, 15, NULL, NULL, NULL, NULL, 172),
(188, NULL, 15, NULL, NULL, NULL, NULL, 173),
(189, NULL, 15, NULL, NULL, NULL, NULL, 174),
(190, NULL, 15, NULL, NULL, NULL, NULL, 175),
(191, NULL, 15, NULL, NULL, NULL, NULL, 176),
(192, NULL, 15, NULL, NULL, NULL, NULL, 177),
(193, NULL, 15, NULL, NULL, NULL, NULL, 178),
(194, NULL, 15, NULL, NULL, NULL, NULL, 179),
(195, NULL, 15, NULL, NULL, NULL, NULL, 180),
(196, NULL, 15, NULL, NULL, NULL, NULL, 181),
(197, NULL, 15, NULL, NULL, NULL, NULL, 182),
(198, NULL, 15, NULL, NULL, NULL, NULL, 183),
(199, NULL, 15, NULL, NULL, NULL, 34, 184),
(200, NULL, 15, NULL, NULL, NULL, 35, 185),
(201, NULL, 15, NULL, NULL, NULL, 34, 186),
(202, NULL, 15, NULL, NULL, NULL, 33, 187),
(203, NULL, 15, NULL, NULL, NULL, 33, 188),
(204, NULL, 15, NULL, NULL, NULL, 35, 189),
(205, NULL, 15, NULL, NULL, NULL, 34, 190),
(206, NULL, 15, NULL, NULL, NULL, 35, 191),
(207, NULL, 15, NULL, NULL, NULL, 34, 192),
(208, NULL, 15, NULL, NULL, NULL, 35, 193),
(209, NULL, 15, NULL, NULL, NULL, 34, 194),
(210, NULL, 15, NULL, NULL, NULL, 33, 195),
(211, NULL, 15, NULL, NULL, NULL, 33, 196),
(212, NULL, 15, NULL, NULL, NULL, 35, 197),
(213, NULL, 15, NULL, NULL, NULL, 35, 198),
(214, NULL, 15, NULL, NULL, NULL, 34, 199),
(215, NULL, 15, NULL, NULL, NULL, 34, 200),
(216, NULL, 15, NULL, NULL, NULL, 34, 201),
(217, NULL, 15, NULL, NULL, NULL, 34, 202),
(218, NULL, 15, NULL, NULL, NULL, 34, 203),
(219, NULL, 15, NULL, NULL, NULL, 34, 204),
(220, NULL, 15, NULL, NULL, NULL, 34, 205),
(221, NULL, 15, NULL, NULL, NULL, 34, 206),
(222, NULL, 15, NULL, NULL, NULL, 34, 207),
(223, NULL, 15, NULL, NULL, NULL, 34, 208),
(224, NULL, 15, NULL, NULL, NULL, 34, 209),
(225, NULL, 15, NULL, NULL, NULL, 34, 210),
(226, NULL, 15, NULL, NULL, NULL, 34, 211),
(227, NULL, 15, NULL, NULL, NULL, 34, 212),
(228, NULL, 15, NULL, NULL, NULL, 34, 213),
(229, NULL, 15, NULL, NULL, NULL, 34, 214),
(230, NULL, 15, NULL, NULL, NULL, 33, 215),
(231, NULL, 15, NULL, NULL, NULL, 35, 216),
(232, NULL, 15, NULL, NULL, NULL, 33, 217),
(233, NULL, 15, NULL, NULL, NULL, 35, 218),
(234, NULL, 15, NULL, NULL, NULL, 34, 219),
(235, NULL, 15, NULL, NULL, NULL, 35, 220),
(236, NULL, 15, NULL, NULL, NULL, 34, 221);

-- --------------------------------------------------------

--
-- Table structure for table `Program`
--

CREATE TABLE `Program` (
  `programID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Program`
--

INSERT INTO `Program` (`programID`, `name`) VALUES
(17, 'BTLED'),
(18, 'BSIT'),
(22, 'BSBA');

-- --------------------------------------------------------

--
-- Table structure for table `Programsections`
--

CREATE TABLE `Programsections` (
  `programID` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Programsections`
--

INSERT INTO `Programsections` (`programID`, `sectionID`) VALUES
(17, 74),
(17, 77),
(18, 58),
(22, 75);

-- --------------------------------------------------------

--
-- Table structure for table `Research`
--

CREATE TABLE `Research` (
  `researchID` int(11) NOT NULL,
  `title` text NOT NULL,
  `abstract` text NOT NULL,
  `datepublished` date NOT NULL DEFAULT curdate(),
  `keywords` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `proposer` varchar(255) NOT NULL,
  `studentProposerID` int(11) DEFAULT NULL,
  `facultyProposerID` int(11) DEFAULT NULL,
  `advisorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Research`
--

INSERT INTO `Research` (`researchID`, `title`, `abstract`, `datepublished`, `keywords`, `status`, `proposer`, `studentProposerID`, `facultyProposerID`, `advisorID`) VALUES
(47, 'VR Juggler: a virtual platform for virtual reality application development', '<p>Today, scientists and engineers are exploring advanced applications and uses of immersive systems that can be cost-effectively applied in their fields. However, one of the impediments to the widespread use of these technologies is the extensive technical expertise required of application developers. A software environment that provides abstractions from specific details of hardware configurations and low-level software tools is needed to provide a common base for the prototyping, development, testing and debugging of applications. This paper describes VR Juggler, a virtual platform for the creation and execution of immersive applications, that provides a virtual reality system-independent operating environment. We focus on the approach taken to specify, design and implement VR Juggler and the benefits derived from our approach.</p>', '2002-07-08', 'Economic output, Information technology, Sub-Saharan Africa', 'Active', 'Hayme Belgica', NULL, 15, 15),
(48, 'VR: a virtual platform for virtual reality application development', '', '2002-07-08', 'Economic output, Information technology, Sub-Saharan Africa', 'Active', 'Hayme Belgica', NULL, 15, 15),
(49, 'VR: a virtual platform for virtual reality application development', '', '2002-07-08', 'Economic output, Information technology, Sub-Saharan Africa', 'Active', 'Hayme Belgica', NULL, 15, 15),
(50, 'VR: a virtual platform for virtual reality application development', '<p>Today, scientists and engineers are exploring advanced applications and uses of immersive systems that can be cost-effectively applied in their fields. However, one of the impediments to the widespread use of these technologies is the extensive technical expertise required of application developers. A software environment that provides abstractions from specific details of hardware configurations and low-level software tools is needed to provide a common base for the prototyping, development, testing and debugging of applications. This paper describes VR Juggler, a virtual platform for the creation and execution of immersive applications, that provides a virtual reality system-independent operating environment. We focus on the approach taken to specify, design and implement VR Juggler and the benefits derived from our approach.</p>', '2002-07-08', 'Economic output, Information technology, Sub-Saharan Africa', 'Active', 'Hayme Belgica', NULL, 15, 15),
(51, 'VR: a virtual platform for virtual reality application development', '<p>Today, scientists and engineers are exploring advanced applications and uses of immersive systems that can be cost-effectively applied in their fields. However, one of the impediments to the widespread use of these technologies is the extensive technical expertise required of application developers. A software environment that provides abstractions from specific details of hardware configurations and low-level software tools is needed to provide a common base for the prototyping, development, testing and debugging of applications. This paper describes VR Juggler, a virtual platform for the creation and execution of immersive applications, that provides a virtual reality system-independent operating environment. We focus on the approach taken to specify, design and implement VR Juggler and the benefits derived from our approach.</p>', '2002-07-08', 'Economic output, Information technology, Sub-Saharan Africa', 'Active', 'Hayme Belgica', NULL, 15, 15),
(52, 'VR Juggler: a virtual platform for virtual reality application development', '<p>Today, scientists and engineers are exploring advanced applications and uses of immersive systems that can be cost-effectively applied in their fields. However, one of the impediments to the widespread use of these technologies is the extensive technical expertise required of application developers. A software environment that provides abstractions from specific details of hardware configurations and low-level software tools is needed to provide a common base for the prototyping, development, testing and debugging of applications. This paper describes VR Juggler, a virtual platform for the creation and execution of immersive applications, that provides a virtual reality system-independent operating environment. We focus on the approach taken to specify, design and implement VR Juggler and the benefits derived from our approach.</p>', '2002-07-08', 'Economic output, Information technology, Sub-Saharan Africa', 'Active', 'Hayme Belgica', NULL, 15, 15),
(53, 'VR Juggler: a virtual platform for virtual reality application development', '', '2001-07-08', 'Economic output, Information technology, Sub-Saharan Africa', 'Active', 'Hayme Belgica', NULL, 15, 15),
(54, 'VR Juggler: a virtual platform for virtual reality application development', '<p>Today, scientists and engineers are exploring advanced applications and uses of immersive systems that can be cost-effectively applied in their fields. However, one of the impediments to the widespread use of these technologies is the extensive technical expertise required of application developers. A software environment that provides abstractions from specific details of hardware configurations and low-level software tools is needed to provide a common base for the prototyping, development, testing and debugging of applications. This paper describes VR Juggler, a virtual platform for the creation and execution of immersive applications, that provides a virtual reality system-independent operating environment. We focus on the approach taken to specify, design and implement VR Juggler and the benefits derived from our approach.</p>', '2001-07-08', 'Economic output, Information technology, Sub-Saharan Africa', 'Active', 'Hayme Belgica', NULL, 15, 15),
(55, 'VR Juggler: a virtual platform for virtual reality application development', '', '2001-07-08', 'Economic output, Information technology, Sub-Saharan Africa', 'Active', 'Hayme Belgica', NULL, 15, 15),
(56, 'VR Juggler: a virtual platform for virtual reality application development', '<p>Today, scientists and engineers are exploring advanced applications and uses of immersive systems that can be cost-effectively applied in their fields. However, one of the impediments to the widespread use of these technologies is the extensive technical expertise required of application developers. A software environment that provides abstractions from specific details of hardware configurations and low-level software tools is needed to provide a common base for the prototyping, development, testing and debugging of applications. This paper describes VR Juggler, a virtual platform for the creation and execution of immersive applications, that provides a virtual reality system-independent operating environment. We focus on the approach taken to specify, design and implement VR Juggler and the benefits derived from our approach.</p>', '2001-07-08', 'Economic output, Information technology, Sub-Saharan Africa', 'Active', 'Hayme Belgica', NULL, 15, 15),
(57, 'VR Juggler: a virtual platform for virtual reality application development', '<p>Today, scientists and engineers are exploring advanced applications and uses of immersive systems that can be cost-effectively applied in their fields. However, one of the impediments to the widespread use of these technologies is the extensive technical expertise required of application developers. A software environment that provides abstractions from specific details of hardware configurations and low-level software tools is needed to provide a common base for the prototyping, development, testing and debugging of applications. This paper describes VR Juggler, a virtual platform for the creation and execution of immersive applications, that provides a virtual reality system-independent operating environment. We focus on the approach taken to specify, design and implement VR Juggler and the benefits derived from our approach.</p>', '2001-07-08', 'Economic output, Information technology, Sub-Saharan Africa', 'Active', 'Hayme Belgica', NULL, 15, 15),
(58, 'VR Juggler: a virtual platform for virtual reality application development', '<p>Today, scientists and engineers are exploring advanced applications and uses of immersive systems that can be cost-effectively applied in their fields. However, one of the impediments to the widespread use of these technologies is the extensive technical expertise required of application developers. A software environment that provides abstractions from specific details of hardware configurations and low-level software tools is needed to provide a common base for the prototyping, development, testing and debugging of applications. This paper describes VR Juggler, a virtual platform for the creation and execution of immersive applications, that provides a virtual reality system-independent operating environment. We focus on the approach taken to specify, design and implement VR Juggler and the benefits derived from our approach.</p>', '2001-07-08', 'Economic output, Information technology, Sub-Saharan Africa', 'Active', 'Hayme Belgica', NULL, 15, 15),
(59, 'VR Juggler: a virtual platform for virtual reality application development', '', '2001-07-08', 'Economic output, Information technology, Sub-Saharan Africa', 'Active', 'Hayme Belgica', NULL, 15, 15),
(60, 'VR Juggler: a virtual platform for virtual reality application development', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>Today, scientists and engineers are exploring advanced applications and uses of immersive systems that can be cost-effectively applied in their fields. However, one of the impediments to the widespread use of these technologies is the extensive technical expertise required of application developers. A software environment that provides abstractions from specific details of hardware configurations and low-level software tools is needed to provide a common base for the prototyping, development, testing and debugging of applications. This paper describes VR Juggler, a virtual platform for the creation and execution of immersive applications, that provides a virtual reality system-independent operating environment. We focus on the approach taken to specify, design and implement VR Juggler and the benefits derived from our approach.</div>\r\n</div>\r\n</div>\r\n</div>', '2001-07-08', 'Economic output, Information technology, Sub-Saharan Africa', 'Active', 'Hayme Belgica', NULL, 15, 15),
(61, 'VR Juggler: a virtual platform for virtual reality application development', '', '2001-07-08', 'Economic output, Information technology, Sub-Saharan Africa', 'Active', 'Hayme Belgica', NULL, 15, 15),
(62, 'VR Juggler: a virtual platform for virtual reality application development', '', '2001-07-08', 'Economic output, Information technology, Sub-Saharan Africa', 'Active', 'Hayme Belgica', NULL, 15, 15),
(63, 'VR Juggler: a virtual platform for virtual reality application development', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>Today, scientists and engineers are exploring advanced applications and uses of immersive systems that can be cost-effectively applied in their fields. However, one of the impediments to the widespread use of these technologies is the extensive technical expertise required of application developers. A software environment that provides abstractions from specific details of hardware configurations and low-level software tools is needed to provide a common base for the prototyping, development, testing and debugging of applications. This paper describes VR Juggler, a virtual platform for the creation and execution of immersive applications, that provides a virtual reality system-independent operating environment. We focus on the approach taken to specify, design and implement VR Juggler and the benefits derived from our approach.</div>\r\n</div>\r\n</div>\r\n</div>', '2001-07-08', 'Economic output, Information technology, Sub-Saharan Africa', 'Active', 'Hayme Belgica', NULL, 15, 15),
(64, 'VR Juggler: a virtual platform for virtual reality application development', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>Today, scientists and engineers are exploring advanced applications and uses of immersive systems that can be cost-effectively applied in their fields. However, one of the impediments to the widespread use of these technologies is the extensive technical expertise required of application developers. A software environment that provides abstractions from specific details of hardware configurations and low-level software tools is needed to provide a common base for the prototyping, development, testing and debugging of applications. This paper describes VR Juggler, a virtual platform for the creation and execution of immersive applications, that provides a virtual reality system-independent operating environment. We focus on the approach taken to specify, design and implement VR Juggler and the benefits derived from our approach.</div>\r\n</div>\r\n</div>\r\n</div>', '2001-07-08', 'Economic output, Information technology, Sub-Saharan Africa', 'Active', 'Hayme Belgica', NULL, 15, 15),
(65, 'VR Juggler: a virtual platform for virtual reality application development', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>Today, scientists and engineers are exploring advanced applications and uses of immersive systems that can be cost-effectively applied in their fields. However, one of the impediments to the widespread use of these technologies is the extensive technical expertise required of application developers. A software environment that provides abstractions from specific details of hardware configurations and low-level software tools is needed to provide a common base for the prototyping, development, testing and debugging of applications. This paper describes VR Juggler, a virtual platform for the creation and execution of immersive applications, that provides a virtual reality system-independent operating environment. We focus on the approach taken to specify, design and implement VR Juggler and the benefits derived from our approach.</div>\r\n</div>\r\n</div>\r\n</div>', '2001-07-08', 'Economic output, Information technology, Sub-Saharan Africa', 'Active', 'Hayme Belgica', NULL, 15, 15),
(66, 'Virtual reality implementation as a useful software tool for e-health applications', '<p>Human hand and finger movements are of obvious importance. The possibility of recording all fingers joints movements during everyday life is then strategic for medical diagnosis, surgery and post traumatic rehabilitation. A proper presentation of recorded data can be really useful for doctors and therapists to correctly act in the occurrence of peripheral nerve injury, rigidities, camptodactyly (decline in permanent deformity of the interphalangeal junction), orthoses, tenolisi, congenital malformations, trauma, dexterity and/or muscular and/or articulate motility evaluations, thumb atros, syndromes, use of mentors, spasm, use of mechanical supports etc.. According to this context we report a virtual reality implementation on the basis of fingers movements recorded data, suitable for fingers joints movement analysis.</p>', '2009-06-15', 'hand movements, finger movements, joints movements, medical diagnosis, surgery, post traumatic rehabilitation, peripheral nerve injury, rigidities, camptodactyly, orthoses, tenolysis, congenital malformations, trauma, dexterity, muscular motility, articulate motility, thumb atrophy, syndromes, mentors, spasm, mechanical supports, virtual reality, movement analysis', 'Active', 'Hayme Belgica', NULL, 15, 15),
(67, 'VR implementation as a useful software tool for e-health applications', '<p>Human hand and finger movements are of obvious importance. The possibility of recording all fingers joints movements during everyday life is then strategic for medical diagnosis, surgery and post traumatic rehabilitation. A proper presentation of recorded data can be really useful for doctors and therapists to correctly act in the occurrence of peripheral nerve injury, rigidities, camptodactyly (decline in permanent deformity of the interphalangeal junction), orthoses, tenolisi, congenital malformations, trauma, dexterity and/or muscular and/or articulate motility evaluations, thumb atros, syndromes, use of mentors, spasm, use of mechanical supports etc.. According to this context we report a virtual reality implementation on the basis of fingers movements recorded data, suitable for fingers joints movement analysis.</p>', '2009-06-15', 'hand movements, finger movements, joints movements, medical diagnosis, surgery, post traumatic rehabilitation, peripheral nerve injury, rigidities, camptodactyly, orthoses, tenolysis, congenital malformations, trauma, dexterity, muscular motility, articulate motility, thumb atrophy, syndromes, mentors, spasm, mechanical supports, virtual reality, movement analysis', 'Active', 'Hayme Belgica', NULL, 15, 15),
(68, 'VR Juggler: a virtual platform for virtual reality application development', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>Today, scientists and engineers are exploring advanced applications and uses of immersive systems that can be cost-effectively applied in their fields. However, one of the impediments to the widespread use of these technologies is the extensive technical expertise required of application developers. A software environment that provides abstractions from specific details of hardware configurations and low-level software tools is needed to provide a common base for the prototyping, development, testing and debugging of applications. This paper describes VR Juggler, a virtual platform for the creation and execution of immersive applications, that provides a virtual reality system-independent operating environment. We focus on the approach taken to specify, design and implement VR Juggler and the benefits derived from our approach.</div>\r\n</div>\r\n</div>\r\n</div>', '2001-03-13', 'immersive systems, cost-effectiveness, application development, technical expertise, software environment, hardware configurations, low-level software tools, prototyping, development, testing, debugging, VR Juggler, virtual platform, immersive applications, virtual reality system-independent operating environment', 'Active', 'Hayme Belgica', NULL, 15, 15),
(69, 'VR Juggler: a virtual platform for virtual reality application development', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>Today, scientists and engineers are exploring advanced applications and uses of immersive systems that can be cost-effectively applied in their fields. However, one of the impediments to the widespread use of these technologies is the extensive technical expertise required of application developers. A software environment that provides abstractions from specific details of hardware configurations and low-level software tools is needed to provide a common base for the prototyping, development, testing and debugging of applications. This paper describes VR Juggler, a virtual platform for the creation and execution of immersive applications, that provides a virtual reality system-independent operating environment. We focus on the approach taken to specify, design and implement VR Juggler and the benefits derived from our approach.</div>\r\n</div>\r\n</div>\r\n</div>', '2023-06-29', 'immersive systems, cost-effectiveness, application development, technical expertise, software environment, hardware configurations, low-level software tools, prototyping, development, testing, debugging, VR Juggler, virtual platform, immersive applications, virtual reality system-independent operating environment', 'Active', 'Hayme Belgica', NULL, 15, 15),
(70, 'Software tools for complex distributed systems: toward integrated tool environments', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>The demands on software tools for the design and testing of complex distributed systems are considerable. An environment that integrates domain-specific and commercial off-the-shelf tools and that supports rapid prototyping of application-specific tools can greatly increase the functionality and usability of such tools. We look at distributed computing systems as complex systems, focusing on two contemporary examples, and present an overview of online monitoring and dynamic analysis tools that support the design and test of such systems. To provide a specific example of integration and rapid prototyping, we describe an integrated tool environment that we have targeted at the types of complex systems addressed in this article.</div>\r\n</div>\r\n</div>\r\n</div>', '2023-06-29', 'Software tools , Application software , Distributed computing , MOS devices , Control systems , Software prototyping , Prototypes , Telecommunication control , System performance , Usability', 'Active', 'Hayme Belgica', NULL, 15, 15),
(71, 'Software tools for complex distributed systems: toward integrated tool ', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>The demands on software tools for the design and testing of complex distributed systems are considerable. An environment that integrates domain-specific and commercial off-the-shelf tools and that supports rapid prototyping of application-specific tools can greatly increase the functionality and usability of such tools. We look at distributed computing systems as complex systems, focusing on two contemporary examples, and present an overview of online monitoring and dynamic analysis tools that support the design and test of such systems. To provide a specific example of integration and rapid prototyping, we describe an integrated tool environment that we have targeted at the types of complex systems addressed in this article.</div>\r\n</div>\r\n</div>\r\n</div>', '2023-06-29', 'Software tools , Application software , Distributed computing , MOS devices , Control systems , Software prototyping , Prototypes , Telecommunication control , System performance , Usability', 'Active', 'Hayme Belgica', NULL, 15, 15),
(72, ' tools for complex distributed systems: toward integrated tool ', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>The demands on software tools for the design and testing of complex distributed systems are considerable. An environment that integrates domain-specific and commercial off-the-shelf tools and that supports rapid prototyping of application-specific tools can greatly increase the functionality and usability of such tools. We look at distributed computing systems as complex systems, focusing on two contemporary examples, and present an overview of online monitoring and dynamic analysis tools that support the design and test of such systems. To provide a specific example of integration and rapid prototyping, we describe an integrated tool environment that we have targeted at the types of complex systems addressed in this article.</div>\r\n</div>\r\n</div>\r\n</div>', '2023-06-29', 'Software tools , Application software , Distributed computing , MOS devices , Control systems , Software prototyping , Prototypes , Telecommunication control , System performance , Usability', 'Active', 'Hayme Belgica', NULL, 15, 15),
(73, 'Integration of software tools in software engineering education', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>There are significant benefits to be gained from promoting extensive use of software tools and environments in software engineering education, providing that they are educationally appropriate. This paper describes practice and experience of using a \"purpose-built\" teaching support environment specifically designed to emphasise the systematic nature of the processes and tools involved, support for the teaching of a range of programming paradigms and software prototyping via the use of (executable) formal specifications. It also enables the production, subject to rigorous set of constraints of software systems which exhibit powerful behaviour at an early stage. This general model of the software development process can be related to the more complex, or less well organised facilities, to which students will be exposed later in their career. Some details of the curriculum components of a software engineering course are given. Specifics of this teaching support environment are described. Illustrative examples are also presented. They demonstrate how the facilities of this environment can be exploited to support concepts and principles introduced to the students during the study.</div>\r\n</div>\r\n</div>\r\n</div>', '1996-04-21', 'Software tools , Software engineering , Education , Educational programs , Programming profession , Software prototyping , Formal specifications , Production systems , Software systems , Power system modeling', 'Active', 'Hayme Belgica', NULL, 15, 15),
(74, ' Software tools for complex distributed systems: toward integrated tool ', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>The demands on software tools for the design and testing of complex distributed systems are considerable. An environment that integrates domain-specific and commercial off-the-shelf tools and that supports rapid prototyping of application-specific tools can greatly increase the functionality and usability of such tools. We look at distributed computing systems as complex systems, focusing on two contemporary examples, and present an overview of online monitoring and dynamic analysis tools that support the design and test of such systems. To provide a specific example of integration and rapid prototyping, we describe an integrated tool environment that we have targeted at the types of complex systems addressed in this article.</div>\r\n</div>\r\n</div>\r\n</div>', '2023-06-29', 'Software tools , Application software , Distributed computing , MOS devices , Control systems , Software prototyping , Prototypes , Telecommunication control , System performance , Usability', 'Active', 'Hayme Belgica', NULL, 15, 15),
(75, ' Software tools for complex distributed systems: toward integrated tool ', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>The demands on software tools for the design and testing of complex distributed systems are considerable. An environment that integrates domain-specific and commercial off-the-shelf tools and that supports rapid prototyping of application-specific tools can greatly increase the functionality and usability of such tools. We look at distributed computing systems as complex systems, focusing on two contemporary examples, and present an overview of online monitoring and dynamic analysis tools that support the design and test of such systems. To provide a specific example of integration and rapid prototyping, we describe an integrated tool environment that we have targeted at the types of complex systems addressed in this article.</div>\r\n</div>\r\n</div>\r\n</div>', '1996-04-21', 'Software tools , Application software , Distributed computing , MOS devices , Control systems , Software prototyping , Prototypes , Telecommunication control , System performance , Usability', 'Active', 'Hayme Belgica', NULL, 15, 15),
(76, ' Software tools for complex distributed systems: toward integrated tool ', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>The demands on software tools for the design and testing of complex distributed systems are considerable. An environment that integrates domain-specific and commercial off-the-shelf tools and that supports rapid prototyping of application-specific tools can greatly increase the functionality and usability of such tools. We look at distributed computing systems as complex systems, focusing on two contemporary examples, and present an overview of online monitoring and dynamic analysis tools that support the design and test of such systems. To provide a specific example of integration and rapid prototyping, we describe an integrated tool environment that we have targeted at the types of complex systems addressed in this article.</div>\r\n</div>\r\n</div>\r\n</div>', '1996-01-21', 'Software tools , Application software , Distributed computing , MOS devices , Control systems , Software prototyping , Prototypes , Telecommunication control , System performance , Usability', 'Active', 'Hayme Belgica', NULL, 15, 15),
(77, ' Software tools for complex distributed systems: toward integrated tool ', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>The demands on software tools for the design and testing of complex distributed systems are considerable. An environment that integrates domain-specific and commercial off-the-shelf tools and that supports rapid prototyping of application-specific tools can greatly increase the functionality and usability of such tools. We look at distributed computing systems as complex systems, focusing on two contemporary examples, and present an overview of online monitoring and dynamic analysis tools that support the design and test of such systems. To provide a specific example of integration and rapid prototyping, we describe an integrated tool environment that we have targeted at the types of complex systems addressed in this article.</div>\r\n</div>\r\n</div>\r\n</div>', '2007-01-21', 'Software tools , Application software , Distributed computing , MOS devices , Control systems , Software prototyping , Prototypes , Telecommunication control , System performance , Usability', 'Active', 'Hayme Belgica', NULL, 15, 15),
(78, ' The International Impact of COVID-19 and “Emergency Remote Teaching” on Computer Science Education Practitioners', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>In March 2020, the COVID-19 global pandemic imposed &ldquo;emergency remote teaching&rdquo; across education globally, leading to a rapid shift to online learning, teaching and assessment (LT&amp;A) across all settings, from schools through to universities. This paper looks specifically at the impact of these disruptive - and ongoing - changes to those teaching the discipline of computer science (CS) across the world. Drawing on the quantitative and qualitative findings from a large-scale international survey (N=2,483) conducted in the immediate aftermath of the shift online between March-April 2020, we report how those teaching CS across all educational settings and contexts (n=327) show significantly more positive attitudes towards the move to online LT&amp;A than those working in other disciplines. When comparing educational setting, CS practitioners in schools felt more prepared and confident than those in higher education; however, they expressed greater concern around equity and whether students would be able to access and meaningfully engage with online LT&amp;A. Furthermore, while CS practitioners across all sectors consistently noted the potential opportunities of these changes, they also raised a number of wider concerns on the impact of this shift to online, especially on workload and job precarity. Concerns were also raised by international CS practitioners regarding the ability to effectively deliver technical topics online, as well as the impact on formal examinations and assessment. This rapid response snapshot of the early impact of COVID-19 on CS education internationally provides insight into emerging LT&amp;A strategies that will likely continue to be constrained by coronavirus into 2021 and beyond.</div>\r\n</div>\r\n</div>\r\n</div>', '2021-04-21', 'COVID-19 , Computer science , Pandemics , Conferences , Education , Computer science education', 'Active', 'Hayme Belgica', NULL, 15, 15),
(79, ' The International Impact of COVID-19 and “Emergency Remote Teaching” on Computer Science Education Practitioners', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>In March 2020, the COVID-19 global pandemic imposed &ldquo;emergency remote teaching&rdquo; across education globally, leading to a rapid shift to online learning, teaching and assessment (LT&amp;A) across all settings, from schools through to universities. This paper looks specifically at the impact of these disruptive - and ongoing - changes to those teaching the discipline of computer science (CS) across the world. Drawing on the quantitative and qualitative findings from a large-scale international survey (N=2,483) conducted in the immediate aftermath of the shift online between March-April 2020, we report how those teaching CS across all educational settings and contexts (n=327) show significantly more positive attitudes towards the move to online LT&amp;A than those working in other disciplines. When comparing educational setting, CS practitioners in schools felt more prepared and confident than those in higher education; however, they expressed greater concern around equity and whether students would be able to access and meaningfully engage with online LT&amp;A. Furthermore, while CS practitioners across all sectors consistently noted the potential opportunities of these changes, they also raised a number of wider concerns on the impact of this shift to online, especially on workload and job precarity. Concerns were also raised by international CS practitioners regarding the ability to effectively deliver technical topics online, as well as the impact on formal examinations and assessment. This rapid response snapshot of the early impact of COVID-19 on CS education internationally provides insight into emerging LT&amp;A strategies that will likely continue to be constrained by coronavirus into 2021 and beyond.</div>\r\n</div>\r\n</div>\r\n</div>', '2021-04-27', 'COVID-19 , Computer science , Pandemics , Conferences , Education , Computer science education', 'Active', 'Hayme Belgica', NULL, 15, 15),
(80, ' Software tools for complex distributed systems: toward integrated tool ', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>The demands on software tools for the design and testing of complex distributed systems are considerable. An environment that integrates domain-specific and commercial off-the-shelf tools and that supports rapid prototyping of application-specific tools can greatly increase the functionality and usability of such tools. We look at distributed computing systems as complex systems, focusing on two contemporary examples, and present an overview of online monitoring and dynamic analysis tools that support the design and test of such systems. To provide a specific example of integration and rapid prototyping, we describe an integrated tool environment that we have targeted at the types of complex systems addressed in this article.</div>\r\n</div>\r\n</div>\r\n</div>', '2007-01-31', 'Software tools , Application software , Distributed computing , MOS devices , Control systems , Software prototyping , Prototypes , Telecommunication control , System performance , Usability', 'Active', 'Hayme Belgica', NULL, 15, 15),
(81, ' The International Impact of COVID-19 and “Emergency Remote Teaching” on Computer Science Education Practitioners', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>In March 2020, the COVID-19 global pandemic imposed &ldquo;emergency remote teaching&rdquo; across education globally, leading to a rapid shift to online learning, teaching and assessment (LT&amp;A) across all settings, from schools through to universities. This paper looks specifically at the impact of these disruptive - and ongoing - changes to those teaching the discipline of computer science (CS) across the world. Drawing on the quantitative and qualitative findings from a large-scale international survey (N=2,483) conducted in the immediate aftermath of the shift online between March-April 2020, we report how those teaching CS across all educational settings and contexts (n=327) show significantly more positive attitudes towards the move to online LT&amp;A than those working in other disciplines. When comparing educational setting, CS practitioners in schools felt more prepared and confident than those in higher education; however, they expressed greater concern around equity and whether students would be able to access and meaningfully engage with online LT&amp;A. Furthermore, while CS practitioners across all sectors consistently noted the potential opportunities of these changes, they also raised a number of wider concerns on the impact of this shift to online, especially on workload and job precarity. Concerns were also raised by international CS practitioners regarding the ability to effectively deliver technical topics online, as well as the impact on formal examinations and assessment. This rapid response snapshot of the early impact of COVID-19 on CS education internationally provides insight into emerging LT&amp;A strategies that will likely continue to be constrained by coronavirus into 2021 and beyond.</div>\r\n</div>\r\n</div>\r\n</div>', '2021-04-27', 'COVID-19 , Computer science , Pandemics , Conferences , Education , Computer science education', 'Active', 'Hayme Belgica', NULL, 15, 15),
(82, 'Integration of software tools in software engineering education', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>There are significant benefits to be gained from promoting extensive use of software tools and environments in software engineering education, providing that they are educationally appropriate. This paper describes practice and experience of using a \"purpose-built\" teaching support environment specifically designed to emphasise the systematic nature of the processes and tools involved, support for the teaching of a range of programming paradigms and software prototyping via the use of (executable) formal specifications. It also enables the production, subject to rigorous set of constraints of software systems which exhibit powerful behaviour at an early stage. This general model of the software development process can be related to the more complex, or less well organised facilities, to which students will be exposed later in their career. Some details of the curriculum components of a software engineering course are given. Specifics of this teaching support environment are described. Illustrative examples are also presented. They demonstrate how the facilities of this environment can be exploited to support concepts and principles introduced to the students during the study.</div>\r\n</div>\r\n</div>\r\n</div>', '1996-05-02', 'Software tools , Software engineering , Education , Educational programs , Programming profession , Software prototyping , Formal specifications , Production systems , Software systems , Power system modeling', 'Active', 'Hayme Belgica', NULL, 15, 15),
(83, 'Integration of software tools in software engineering education', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>There are significant benefits to be gained from promoting extensive use of software tools and environments in software engineering education, providing that they are educationally appropriate. This paper describes practice and experience of using a \"purpose-built\" teaching support environment specifically designed to emphasise the systematic nature of the processes and tools involved, support for the teaching of a range of programming paradigms and software prototyping via the use of (executable) formal specifications. It also enables the production, subject to rigorous set of constraints of software systems which exhibit powerful behaviour at an early stage. This general model of the software development process can be related to the more complex, or less well organised facilities, to which students will be exposed later in their career. Some details of the curriculum components of a software engineering course are given. Specifics of this teaching support environment are described. Illustrative examples are also presented. They demonstrate how the facilities of this environment can be exploited to support concepts and principles introduced to the students during the study.</div>\r\n</div>\r\n</div>\r\n</div>', '1996-06-01', 'Software tools , Software engineering , Education , Educational programs , Programming profession , Software prototyping , Formal specifications , Production systems , Software systems , Power system modeling', 'Active', 'Hayme Belgica', NULL, 15, 15),
(84, 'Integration of software tools in software engineering education', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>There are significant benefits to be gained from promoting extensive use of software tools and environments in software engineering education, providing that they are educationally appropriate. This paper describes practice and experience of using a \"purpose-built\" teaching support environment specifically designed to emphasise the systematic nature of the processes and tools involved, support for the teaching of a range of programming paradigms and software prototyping via the use of (executable) formal specifications. It also enables the production, subject to rigorous set of constraints of software systems which exhibit powerful behaviour at an early stage. This general model of the software development process can be related to the more complex, or less well organised facilities, to which students will be exposed later in their career. Some details of the curriculum components of a software engineering course are given. Specifics of this teaching support environment are described. Illustrative examples are also presented. They demonstrate how the facilities of this environment can be exploited to support concepts and principles introduced to the students during the study.</div>\r\n</div>\r\n</div>\r\n</div>', '1996-08-01', 'Software tools , Software engineering , Education , Educational programs , Programming profession , Software prototyping , Formal specifications , Production systems , Software systems , Power system modeling', 'Active', 'Hayme Belgica', NULL, 15, 15),
(85, 'Integration of software tools in software engineering education', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>There are significant benefits to be gained from promoting extensive use of software tools and environments in software engineering education, providing that they are educationally appropriate. This paper describes practice and experience of using a \"purpose-built\" teaching support environment specifically designed to emphasise the systematic nature of the processes and tools involved, support for the teaching of a range of programming paradigms and software prototyping via the use of (executable) formal specifications. It also enables the production, subject to rigorous set of constraints of software systems which exhibit powerful behaviour at an early stage. This general model of the software development process can be related to the more complex, or less well organised facilities, to which students will be exposed later in their career. Some details of the curriculum components of a software engineering course are given. Specifics of this teaching support environment are described. Illustrative examples are also presented. They demonstrate how the facilities of this environment can be exploited to support concepts and principles introduced to the students during the study.</div>\r\n</div>\r\n</div>\r\n</div>', '1996-11-21', 'Software tools , Software engineering , Education , Educational programs , Programming profession , Software prototyping , Formal specifications , Production systems , Software systems , Power system modeling', 'Active', 'Hayme Belgica', NULL, 15, 15),
(86, 'Integration of software tools in software engineering education', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>There are significant benefits to be gained from promoting extensive use of software tools and environments in software engineering education, providing that they are educationally appropriate. This paper describes practice and experience of using a \"purpose-built\" teaching support environment specifically designed to emphasise the systematic nature of the processes and tools involved, support for the teaching of a range of programming paradigms and software prototyping via the use of (executable) formal specifications. It also enables the production, subject to rigorous set of constraints of software systems which exhibit powerful behaviour at an early stage. This general model of the software development process can be related to the more complex, or less well organised facilities, to which students will be exposed later in their career. Some details of the curriculum components of a software engineering course are given. Specifics of this teaching support environment are described. Illustrative examples are also presented. They demonstrate how the facilities of this environment can be exploited to support concepts and principles introduced to the students during the study.</div>\r\n</div>\r\n</div>\r\n</div>', '1996-12-02', 'Software tools , Software engineering , Education , Educational programs , Programming profession , Software prototyping , Formal specifications , Production systems , Software systems , Power system modeling', 'Active', 'Hayme Belgica', NULL, 15, 15),
(87, 'Integration of software tools in software engineering education', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>There are significant benefits to be gained from promoting extensive use of software tools and environments in software engineering education, providing that they are educationally appropriate. This paper describes practice and experience of using a \"purpose-built\" teaching support environment specifically designed to emphasise the systematic nature of the processes and tools involved, support for the teaching of a range of programming paradigms and software prototyping via the use of (executable) formal specifications. It also enables the production, subject to rigorous set of constraints of software systems which exhibit powerful behaviour at an early stage. This general model of the software development process can be related to the more complex, or less well organised facilities, to which students will be exposed later in their career. Some details of the curriculum components of a software engineering course are given. Specifics of this teaching support environment are described. Illustrative examples are also presented. They demonstrate how the facilities of this environment can be exploited to support concepts and principles introduced to the students during the study.</div>\r\n</div>\r\n</div>\r\n</div>', '1997-02-01', 'Software tools , Software engineering , Education , Educational programs , Programming profession , Software prototyping , Formal specifications , Production systems , Software systems , Power system modeling', 'Active', 'Hayme Belgica', NULL, 15, 15),
(88, 'Jumping NLP Curves: A Review of Natural Language Processing Research', '<p>Natural language processing (NLP) is a theory-motivated range of computational techniques for the automatic analysis and representation of human language. NLP research has evolved from the era of punch cards and batch processing (in which the analysis of a sentence could take up to 7 minutes) to the era of Google and the likes of it (in which millions of webpages can be processed in less than a second). This review paper draws on recent developments in NLP research to look at the past, present, and future of NLP technology in a new light. Borrowing the paradigm of `jumping curves\' from the field of business management and marketing prediction, this survey article reinterprets the evolution of NLP research as the intersection of three overlapping curves-namely Syntactics, Semantics, and Pragmatics Curveswhich will eventually lead NLP research to evolve into natural language understanding</p>', '2023-07-01', 'jumping NLP curves, natural language processing research, computational techniques, automatic human language analysis, automatic human language representation, punch cards, batch processing, Google, Webpages, NLP technology, business management, marketing prediction, NLP research evolution, syntactics curve, semantics curve, pragmatics curve, natural language understanding', 'Active', 'Hayme Belgica', NULL, 15, 15);
INSERT INTO `Research` (`researchID`, `title`, `abstract`, `datepublished`, `keywords`, `status`, `proposer`, `studentProposerID`, `facultyProposerID`, `advisorID`) VALUES
(89, 'Jumping NLP Curves: A Review of Natural Language Processing Research', '<p>Natural language processing (NLP) is a theory-motivated range of computational techniques for the automatic analysis and representation of human language. NLP research has evolved from the era of punch cards and batch processing (in which the analysis of a sentence could take up to 7 minutes) to the era of Google and the likes of it (in which millions of webpages can be processed in less than a second). This review paper draws on recent developments in NLP research to look at the past, present, and future of NLP technology in a new light. Borrowing the paradigm of `jumping curves\' from the field of business management and marketing prediction, this survey article reinterprets the evolution of NLP research as the intersection of three overlapping curves-namely Syntactics, Semantics, and Pragmatics Curveswhich will eventually lead NLP research to evolve into natural language understanding</p>', '2014-04-10', 'jumping NLP curves, natural language processing research, computational techniques, automatic human language analysis, automatic human language representation, punch cards, batch processing, Google, Webpages, NLP technology, business management, marketing prediction, NLP research evolution, syntactics curve, semantics curve, pragmatics curve, natural language understanding', 'Active', 'Hayme Belgica', NULL, 15, 15),
(90, ' Screen Time Controller App: Application to Supervise the Young Adults’ Smartphone Usage', '<p>This research aims to assess the criterion validity of a recently created application that measures smartphone usage on both iOS and Android platforms. The study aimed to determine the accuracy and reliability of this newly developed application in evaluating individuals\' smartphone usage patterns on various mobile devices. By examining the extent to which the application aligns with established criteria for assessing smartphone use, the researchers aimed to establish its effectiveness and usefulness as a valid tool for monitoring and analyzing smartphone usage behaviors.</p>', '2023-07-01', 'Screen Time, Smartphone Usage, Control, Application, Tracking', 'Active', 'Hayme Belgica', NULL, 15, 15),
(91, ' Screen Time Controller App: Application to Supervise the Young Adults’ Smartphone Usage', '<p>This research aims to assess the criterion validity of a recently created application that measures smartphone usage on both iOS and Android platforms. The study aimed to determine the accuracy and reliability of this newly developed application in evaluating individuals\' smartphone usage patterns on various mobile devices. By examining the extent to which the application aligns with established criteria for assessing smartphone use, the researchers aimed to establish its effectiveness and usefulness as a valid tool for monitoring and analyzing smartphone usage behaviors.</p>', '2023-03-02', 'Screen Time, Smartphone Usage, Control, Application, Tracking', 'Active', 'Hayme Belgica', NULL, 15, 15),
(92, 'Exploring the Potential of Quantum Computing in Cryptography', '<p>This research paper investigates the application of blockchain technology in revolutionizing supply chain management practices. The study explores the benefits of decentralized ledgers, smart contracts, and traceability features in enhancing transparency, efficiency, and security in supply chain processes. The findings contribute to the understanding of blockchain\'s potential impact on various industries, including logistics, manufacturing, and retail.</p>', '2023-07-01', 'Blockchain technology, supply chain management, decentralized ledgers, smart contracts, traceability, transparency, efficiency, security.', 'Active', 'Piacente Nich  Commemoro', NULL, 18, 18),
(93, 'Advancements in Natural Language Processing for Intelligent Chatbot Systems', '<p>This study focuses on advancements in natural language processing (NLP) techniques for developing intelligent chatbot systems. The research explores methods such as sentiment analysis, entity recognition, and dialogue management to enhance chatbot capabilities in understanding and generating human-like responses. The findings contribute to the development of more interactive and efficient conversational agents.</p>', '2022-10-11', ' Natural language processing, NLP, chatbot systems, sentiment analysis, entity recognition, dialogue management, conversational agents.', 'Active', 'Piacente Nich  Commemoro', NULL, 18, 18),
(94, ' software tools in software engineering education', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>There are significant benefits to be gained from promoting extensive use of software tools and environments in software engineering education, providing that they are educationally appropriate. This paper describes practice and experience of using a \"purpose-built\" teaching support environment specifically designed to emphasise the systematic nature of the processes and tools involved, support for the teaching of a range of programming paradigms and software prototyping via the use of (executable) formal specifications. It also enables the production, subject to rigorous set of constraints of software systems which exhibit powerful behaviour at an early stage. This general model of the software development process can be related to the more complex, or less well organised facilities, to which students will be exposed later in their career. Some details of the curriculum components of a software engineering course are given. Specifics of this teaching support environment are described. Illustrative examples are also presented. They demonstrate how the facilities of this environment can be exploited to support concepts and principles introduced to the students during the study.</div>\r\n</div>\r\n</div>\r\n</div>', '2023-07-01', 'Software tools , Software engineering , Education , Educational programs , Programming profession , Software prototyping , Formal specifications , Production systems , Software systems , Power system modeling', 'Active', 'Hayme Belgica', NULL, 15, 15),
(95, 'A Literature Overview of Virtual Reality (VR) in Treatment of Psychiatric Disorders: Recent Advances and Limitations', '<p>In this paper, we conduct a literature survey on various virtual reality (VR) treatments in psychiatry. We collected 36 studies that used VR to provide clinical trials or therapies for patients with psychiatric disorders. In order to gain a better understanding of the management of pain and stress, we first investigate VR applications for patients to alleviate pain and stress during immersive activities in a virtual environment. VR exposure therapies are particularly effective for anxiety, provoking realistic reactions to feared stimuli. On top of that, exposure therapies with simulated images are beneficial for patients with psychiatric disorders such as phobia and posttraumatic stress disorder (PTSD). Moreover, VR environments have shown the possibility of changing depression, cognition, even social functions. We review empirical evidence from VR-based treatments on psychiatric illnesses such as dementia, mild cognitive impairment (MCI), schizophrenia and autism. Through cognitive training and social skill training, rehabilitation through VR therapies helps patients to improve their quality of life. Recent advances in VR technology also demonstrate potential abilities to address cognitive and functional impairments in dementia. In terms of the different types of VR systems, we discuss the feasibility of the technology within different stages of dementia as well as the methodological limitations. Although there is room for improvement, its widespread adoption in psychiatry is yet to occur due to technical drawbacks such as motion sickness and dry eyes, as well as user issues such as preoccupation and addiction. However, it is worth mentioning that VR systems relatively easily deliver virtual environments with well-controlled sensory stimuli. In the future, VR systems may become an innovative clinical tool for patients with specific psychiatric symptoms.</p>', '2023-07-02', 'vr, technology, keywords', 'Active', 'Hayme Belgica', NULL, 15, 15),
(96, ' The International Impact of COVID-19 and “Emergency Remote Teaching” on Computer Science Education Practitioners', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>In March 2020, the COVID-19 global pandemic imposed &ldquo;emergency remote teaching&rdquo; across education globally, leading to a rapid shift to online learning, teaching and assessment (LT&amp;A) across all settings, from schools through to universities. This paper looks specifically at the impact of these disruptive - and ongoing - changes to those teaching the discipline of computer science (CS) across the world. Drawing on the quantitative and qualitative findings from a large-scale international survey (N=2,483) conducted in the immediate aftermath of the shift online between March-April 2020, we report how those teaching CS across all educational settings and contexts (n=327) show significantly more positive attitudes towards the move to online LT&amp;A than those working in other disciplines. When comparing educational setting, CS practitioners in schools felt more prepared and confident than those in higher education; however, they expressed greater concern around equity and whether students would be able to access and meaningfully engage with online LT&amp;A. Furthermore, while CS practitioners across all sectors consistently noted the potential opportunities of these changes, they also raised a number of wider concerns on the impact of this shift to online, especially on workload and job precarity. Concerns were also raised by international CS practitioners regarding the ability to effectively deliver technical topics online, as well as the impact on formal examinations and assessment. This rapid response snapshot of the early impact of COVID-19 on CS education internationally provides insight into emerging LT&amp;A strategies that will likely continue to be constrained by coronavirus into 2021 and beyond.</div>\r\n</div>\r\n</div>\r\n</div>', '2021-04-27', 'COVID-19 , Computer science , Pandemics , Conferences , Education , Computer science education', 'Active', 'Hayme Belgica', NULL, 15, 15),
(97, ' The International Impact of COVID-23 and “Emergency Remote Teaching” on Computer Science Education Practitioners', '<div class=\"abstract-text row g-0\">\r\n<div class=\"col-12\">\r\n<div class=\"u-mb-1\">\r\n<div>In March 2020, the COVID-19 global pandemic imposed &ldquo;emergency remote teaching&rdquo; across education globally, leading to a rapid shift to online learning, teaching and assessment (LT&amp;A) across all settings, from schools through to universities. This paper looks specifically at the impact of these disruptive - and ongoing - changes to those teaching the discipline of computer science (CS) across the world. Drawing on the quantitative and qualitative findings from a large-scale international survey (N=2,483) conducted in the immediate aftermath of the shift online between March-April 2020, we report how those teaching CS across all educational settings and contexts (n=327) show significantly more positive attitudes towards the move to online LT&amp;A than those working in other disciplines. When comparing educational setting, CS practitioners in schools felt more prepared and confident than those in higher education; however, they expressed greater concern around equity and whether students would be able to access and meaningfully engage with online LT&amp;A. Furthermore, while CS practitioners across all sectors consistently noted the potential opportunities of these changes, they also raised a number of wider concerns on the impact of this shift to online, especially on workload and job precarity. Concerns were also raised by international CS practitioners regarding the ability to effectively deliver technical topics online, as well as the impact on formal examinations and assessment. This rapid response snapshot of the early impact of COVID-19 on CS education internationally provides insight into emerging LT&amp;A strategies that will likely continue to be constrained by coronavirus into 2021 and beyond.</div>\r\n</div>\r\n</div>\r\n</div>', '2023-04-27', 'COVID-19 , Computer science , Pandemics , Conferences , Education , Computer science education', 'Active', 'Hayme Belgica', NULL, 15, 15),
(98, 'COVID-19 and Multiorgan Response', '<p>Since the outbreak and rapid spread of COVID-19 starting late December 2019, it has been apparent that disease prognosis has largely been influenced by multiorgan involvement.&nbsp;<a class=\"topic-link\" title=\"Learn more about Comorbidities from ScienceDirect\'s AI-generated Topic Pages\" href=\"https://www.sciencedirect.com/topics/medicine-and-dentistry/comorbidity\">Comorbidities</a>&nbsp;such as cardiovascular diseases have been the most common risk factors for severity and mortality. The hyperinflammatory response of the body, coupled with the plausible direct effects of severe acute respiratory syndrome on body-wide organs via angiotensin-converting enzyme 2, has been associated with complications of the disease.&nbsp;<a class=\"topic-link\" title=\"Learn more about Acute respiratory distress syndrome from ScienceDirect\'s AI-generated Topic Pages\" href=\"https://www.sciencedirect.com/topics/medicine-and-dentistry/acute-respiratory-distress-syndrome\">Acute respiratory distress syndrome</a>, heart failure, renal failure, liver damage,&nbsp;<a class=\"topic-link\" title=\"Learn more about shock from ScienceDirect\'s AI-generated Topic Pages\" href=\"https://www.sciencedirect.com/topics/medicine-and-dentistry/shock-circulatory\">shock</a>, and&nbsp;<a class=\"topic-link\" title=\"Learn more about multiorgan failure from ScienceDirect\'s AI-generated Topic Pages\" href=\"https://www.sciencedirect.com/topics/medicine-and-dentistry/multiple-organ-dysfunction-syndrome\">multiorgan failure</a>&nbsp;have precipitated death. Acknowledging the comorbidities and potential organ injuries throughout the course of COVID-19 is therefore crucial in the clinical management of&nbsp;<a class=\"topic-link\" title=\"Learn more about patients from ScienceDirect\'s AI-generated Topic Pages\" href=\"https://www.sciencedirect.com/topics/medicine-and-dentistry/patient\">patients</a>. This paper aims to add onto the ever-emerging landscape of medical knowledge on COVID-19, encapsulating its multiorgan impact.</p>', '2023-07-04', 'covid, response, multiorgans', 'Active', 'Hayme Belgica', NULL, 15, 15),
(99, 'COVID-19 and Multiorgan Response', '<p>Since the outbreak and rapid spread of COVID-19 starting late December 2019, it has been apparent that disease prognosis has largely been influenced by multiorgan involvement. Comorbidities such as cardiovascular diseases have been the most common risk factors for severity and mortality. The hyperinflammatory response of the body, coupled with the plausible direct effects of severe acute respiratory syndrome on body-wide organs via angiotensin-converting enzyme 2, has been associated with complications of the disease. Acute respiratory distress syndrome, heart failure, renal failure, liver damage, shock, and multiorgan failure have precipitated death. Acknowledging the comorbidities and potential organ injuries throughout the course of COVID-19 is therefore crucial in the clinical management of patients. This paper aims to add onto the ever-emerging landscape of medical knowledge on COVID-19, encapsulating its multiorgan impact.</p>', '2020-04-28', 'covid, organs, comorbilities', 'Active', 'Hayme Belgica', NULL, 15, 15),
(100, 'COVID-19 and Multiorgan Response', '<p>Since the outbreak and rapid spread of COVID-19 starting late December 2019, it has been apparent that disease prognosis has largely been influenced by multiorgan involvement. Comorbidities such as cardiovascular diseases have been the most common risk factors for severity and mortality. The hyperinflammatory response of the body, coupled with the plausible direct effects of severe acute respiratory syndrome on body-wide organs via angiotensin-converting enzyme 2, has been associated with complications of the disease. Acute respiratory distress syndrome, heart failure, renal failure, liver damage, shock, and multiorgan failure have precipitated death. Acknowledging the comorbidities and potential organ injuries throughout the course of COVID-19 is therefore crucial in the clinical management of patients. This paper aims to add onto the ever-emerging landscape of medical knowledge on COVID-19, encapsulating its multiorgan impact.</p>', '2020-04-28', 'covid, organs, comorbilities', 'Active', 'Hayme Belgica', NULL, 15, 15);

-- --------------------------------------------------------

--
-- Table structure for table `ResearchAuthorList`
--

CREATE TABLE `ResearchAuthorList` (
  `authorID` int(11) NOT NULL,
  `researchID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ResearchAuthorList`
--

INSERT INTO `ResearchAuthorList` (`authorID`, `researchID`) VALUES
(3, 47),
(3, 50),
(3, 51),
(3, 52),
(3, 53),
(3, 54),
(3, 57),
(3, 58),
(3, 62),
(3, 63),
(3, 64),
(3, 78),
(3, 79),
(3, 81),
(3, 92),
(3, 96),
(3, 97),
(5, 47),
(5, 50),
(5, 51),
(5, 52),
(5, 53),
(5, 54),
(5, 57),
(5, 58),
(5, 62),
(5, 63),
(5, 64),
(5, 78),
(5, 79),
(5, 81),
(5, 88),
(5, 89),
(5, 92),
(5, 93),
(5, 96),
(6, 47),
(6, 50),
(6, 51),
(6, 52),
(6, 53),
(6, 54),
(6, 57),
(6, 58),
(6, 62),
(6, 63),
(6, 64),
(6, 78),
(6, 79),
(6, 81),
(6, 88),
(6, 89),
(6, 90),
(6, 91),
(6, 92),
(6, 93),
(6, 96),
(6, 97),
(9, 47),
(9, 50),
(9, 51),
(9, 52),
(9, 62),
(9, 63),
(9, 64),
(9, 78),
(9, 79),
(114, 47),
(114, 50),
(114, 51),
(114, 52),
(114, 53),
(114, 54),
(114, 62),
(114, 63),
(114, 64),
(114, 78),
(114, 79),
(114, 93),
(119, 47),
(119, 50),
(119, 51),
(119, 52),
(119, 62),
(119, 63),
(119, 64),
(119, 78),
(119, 79),
(119, 93),
(119, 98),
(119, 99),
(119, 100),
(120, 47),
(120, 50),
(120, 51),
(120, 52),
(120, 62),
(120, 63),
(120, 64),
(120, 75),
(120, 76),
(120, 77),
(120, 78),
(120, 79),
(120, 80),
(120, 99),
(120, 100),
(121, 47),
(121, 50),
(121, 51),
(121, 52),
(121, 62),
(121, 63),
(121, 64),
(121, 75),
(121, 76),
(121, 77),
(121, 78),
(121, 79),
(121, 80),
(122, 47),
(122, 50),
(122, 51),
(122, 52),
(122, 62),
(122, 63),
(122, 64),
(122, 68),
(122, 75),
(122, 76),
(122, 77),
(122, 78),
(122, 79),
(122, 80),
(123, 47),
(123, 50),
(123, 51),
(123, 52),
(123, 62),
(123, 63),
(123, 64),
(123, 68),
(123, 78),
(123, 79),
(125, 47),
(125, 50),
(125, 51),
(125, 52),
(125, 60),
(125, 61),
(125, 62),
(125, 63),
(125, 64),
(125, 65),
(125, 68),
(125, 71),
(125, 72),
(125, 74),
(125, 78),
(125, 79),
(125, 94),
(127, 66),
(127, 67),
(127, 69),
(127, 70),
(127, 71),
(127, 72),
(127, 73),
(127, 74),
(127, 78),
(127, 79),
(127, 82),
(127, 83),
(127, 84),
(127, 85),
(127, 86),
(127, 87),
(127, 94),
(128, 66),
(128, 67),
(128, 69),
(128, 70),
(128, 71),
(128, 72),
(128, 73),
(128, 74),
(128, 78),
(128, 79),
(128, 82),
(128, 83),
(128, 84),
(128, 85),
(128, 86),
(128, 87),
(128, 94),
(130, 88),
(130, 89),
(131, 88),
(131, 89),
(131, 99),
(131, 100),
(134, 100);

-- --------------------------------------------------------

--
-- Table structure for table `ResearchInterestList`
--

CREATE TABLE `ResearchInterestList` (
  `interestID` int(11) DEFAULT NULL,
  `researchID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ResearchInterestList`
--

INSERT INTO `ResearchInterestList` (`interestID`, `researchID`) VALUES
(1, 47),
(3, 47),
(14, 47),
(1, 50),
(3, 50),
(14, 50),
(1, 51),
(3, 51),
(14, 51),
(1, 52),
(3, 52),
(14, 52),
(1, 54),
(3, 54),
(1, 57),
(3, 57),
(14, 57),
(1, 58),
(3, 58),
(14, 58),
(1, 60),
(3, 60),
(14, 60),
(1, 61),
(3, 61),
(14, 61),
(1, 62),
(3, 62),
(14, 62),
(1, 63),
(3, 63),
(14, 63),
(1, 64),
(3, 64),
(14, 64),
(1, 65),
(3, 65),
(14, 65),
(1, 66),
(3, 66),
(1, 67),
(3, 67),
(1, 68),
(3, 68),
(1, 69),
(1, 70),
(3, 70),
(1, 71),
(3, 71),
(1, 72),
(3, 72),
(1, 73),
(3, 73),
(14, 73),
(1, 74),
(3, 74),
(1, 75),
(3, 75),
(14, 75),
(1, 76),
(3, 76),
(14, 76),
(1, 77),
(3, 77),
(14, 77),
(1, 78),
(1, 79),
(1, 80),
(3, 80),
(14, 80),
(1, 81),
(1, 82),
(3, 82),
(14, 82),
(1, 83),
(3, 83),
(14, 83),
(1, 84),
(3, 84),
(14, 84),
(1, 85),
(3, 85),
(14, 85),
(1, 86),
(3, 86),
(14, 86),
(1, 87),
(3, 87),
(14, 87),
(1, 88),
(3, 88),
(1, 89),
(3, 89),
(1, 90),
(3, 90),
(1, 91),
(3, 91),
(1, 92),
(3, 92),
(1, 93),
(3, 93),
(1, 94),
(3, 94),
(14, 94),
(1, 96),
(1, 97),
(3, 98),
(1, 99),
(1, 100);

-- --------------------------------------------------------

--
-- Table structure for table `ResearchProgramList`
--

CREATE TABLE `ResearchProgramList` (
  `programID` int(11) DEFAULT NULL,
  `researchID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ResearchProgramList`
--

INSERT INTO `ResearchProgramList` (`programID`, `researchID`) VALUES
(17, 47),
(18, 47),
(17, 50),
(18, 50),
(17, 51),
(18, 51),
(17, 52),
(18, 52),
(17, 54),
(18, 54),
(17, 57),
(18, 57),
(17, 58),
(18, 58),
(17, 60),
(18, 60),
(18, 61),
(17, 62),
(18, 62),
(17, 63),
(18, 63),
(17, 64),
(18, 64),
(17, 65),
(18, 65),
(18, 66),
(18, 67),
(18, 68),
(18, 69),
(18, 70),
(17, 71),
(18, 71),
(17, 72),
(18, 72),
(17, 73),
(18, 73),
(17, 74),
(18, 74),
(17, 75),
(18, 75),
(17, 76),
(18, 76),
(17, 77),
(18, 77),
(17, 78),
(17, 79),
(17, 80),
(18, 80),
(17, 81),
(17, 82),
(18, 82),
(17, 83),
(18, 83),
(17, 84),
(18, 84),
(17, 85),
(18, 85),
(17, 86),
(18, 86),
(17, 87),
(18, 87),
(17, 88),
(18, 88),
(17, 89),
(18, 89),
(18, 90),
(18, 91),
(18, 92),
(18, 93),
(17, 94),
(18, 94),
(17, 96),
(17, 97),
(22, 98),
(17, 99),
(17, 100);

-- --------------------------------------------------------

--
-- Table structure for table `Section`
--

CREATE TABLE `Section` (
  `sectionID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Section`
--

INSERT INTO `Section` (`sectionID`, `name`) VALUES
(58, 'BSIT 3-3'),
(74, 'BTLED 3-1'),
(75, 'BSBA 3-1'),
(77, 'BTLED 3-4');

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE `Student` (
  `studentID` int(11) NOT NULL,
  `studentnumber` varchar(255) NOT NULL,
  `program` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `emailadd` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `advisor` int(11) NOT NULL,
  `dateregistered` date NOT NULL DEFAULT curdate(),
  `code` varchar(255) DEFAULT NULL,
  `priority` enum('High','Medium','Low') NOT NULL DEFAULT (case when `status` = 'Inactive' and `dateregistered` <= curdate() - interval 3 day then 'High' when `status` = 'Inactive' then 'Medium' else 'Low' end),
  `sectionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`studentID`, `studentnumber`, `program`, `password`, `emailadd`, `firstname`, `lastname`, `status`, `advisor`, `dateregistered`, `code`, `priority`, `sectionID`) VALUES
(29, '2020-00001-CM-0', 'BSIT', '$2y$10$NZORJXb/qYcQVfilcC6pme0jbNS6i9rhNw3QwHZXq5MhI5Obcd5Ou', 'jamesmatthewbelgica@gmail.com', 'hayme', 'belgica', 'Active', 18, '2023-06-20', NULL, 'Low', 58),
(30, '2020-00002-CM-0', 'BTLED', '$2y$10$rYaZL6Xrfq6wElQUR6dG7uO3IugRL2ivkHwHH/KuXwjv9tjAi5Jz6', 'piacentenichcommemoro@gmail.com', 'Hayme', 'Belgica', 'Active', 1, '2023-06-22', NULL, 'Low', 74),
(31, '2020-12341-CM-0', 'BSIT', '$2y$10$.j9Fsn01VcS.vzI0YEAIfe3vzhCYLcXdQG8UR7Cq0LTYkK6DnXYY6', 'haymebelgica@gmail.com', 'Hayme', 'Belgica', 'Active', 13, '2023-07-01', NULL, 'Low', 58),
(32, '2020-00043-CM-0', 'BSIT', '$2y$10$bnHz6PJOU1P.I79kzmAk7uiApaDq1tUkt915IXatCctfnSM8TZEW2', 'jwejaearts@gmail.com', 'Jazhel', 'Peralta', 'Inactive', 11, '2023-07-01', 'RlYwnszI4k', 'Medium', 58),
(33, '2020-00038-CM-0', 'BSIT', '$2y$10$2kpMlv0Pyca0jFX99aprv.nAqiJ7thWoMqGKMVEIdBZf1fEXjUMkq', 'hirayamanawari', 'Hiraya', 'Manawari', 'Active', 15, '2023-07-04', NULL, 'Low', 58),
(34, '2020-00039-CM-0', 'BTLED', '$2y$10$NPYCk83UtM5iO0jlaBB/7e5HmQvAUOC3Qm7Ib24OPhEnwFGaKS5Aa', 'creamcheeseoreo@gmail.com', 'Creamcheese', 'Oreo', 'Active', 15, '2023-07-04', NULL, 'Low', 77),
(35, '2020-00040-CM-0', 'BSIT', '$2y$10$M4j4JhYrw85D.rEUBDVTG.ae.sGovPqVQDHeyYXQGB925tk3yTjIC', 'princesstheamabangis', 'Princess Thea', 'Mabangis', 'Inactive', 15, '2023-07-04', NULL, 'Medium', 58);

--
-- Triggers `Student`
--
DELIMITER $$
CREATE TRIGGER `update_priority_student` BEFORE UPDATE ON `Student` FOR EACH ROW BEGIN
  IF NEW.status = 'Inactive' THEN
    IF DATEDIFF(CURDATE(), NEW.dateregistered) >= 3 THEN
      SET NEW.priority = 'high';
    ELSE
      SET NEW.priority = 'medium';
    END IF;
  ELSE
    SET NEW.priority = 'low';
  END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ActivePaper`
--
ALTER TABLE `ActivePaper`
  ADD PRIMARY KEY (`activePaperID`),
  ADD KEY `studentCreatorID` (`studentCreatorID`),
  ADD KEY `facultyCreatorID` (`facultyCreatorID`),
  ADD KEY `fk_researchPaper` (`researchPaper`);

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`adminID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `Adviserteam`
--
ALTER TABLE `Adviserteam`
  ADD PRIMARY KEY (`facultyID`,`studentID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `Approve`
--
ALTER TABLE `Approve`
  ADD PRIMARY KEY (`approveID`),
  ADD KEY `research` (`research`),
  ADD KEY `notification` (`notification`),
  ADD KEY `author` (`author`),
  ADD KEY `oldresearch` (`oldresearch`);

--
-- Indexes for table `Author`
--
ALTER TABLE `Author`
  ADD PRIMARY KEY (`authorID`);

--
-- Indexes for table `EditHistory`
--
ALTER TABLE `EditHistory`
  ADD PRIMARY KEY (`editID`),
  ADD KEY `paperUpdate` (`paperUpdate`),
  ADD KEY `approver` (`approver`),
  ADD KEY `fk_activePaperID` (`activePaperID`);

--
-- Indexes for table `Faculty`
--
ALTER TABLE `Faculty`
  ADD PRIMARY KEY (`facultyID`),
  ADD UNIQUE KEY `emailadd` (`emailadd`);

--
-- Indexes for table `Interest`
--
ALTER TABLE `Interest`
  ADD PRIMARY KEY (`interestID`);

--
-- Indexes for table `Notification`
--
ALTER TABLE `Notification`
  ADD PRIMARY KEY (`notificationID`);

--
-- Indexes for table `NotificationLink`
--
ALTER TABLE `NotificationLink`
  ADD PRIMARY KEY (`linkID`),
  ADD KEY `issuerAdminID` (`issuerAdminID`),
  ADD KEY `issuerFacultyID` (`issuerFacultyID`),
  ADD KEY `issuerStudentID` (`issuerStudentID`),
  ADD KEY `recipientAdminID` (`recipientAdminID`),
  ADD KEY `recipientFacultyID` (`recipientFacultyID`),
  ADD KEY `recipientStudentID` (`recipientStudentID`),
  ADD KEY `notificationID` (`notificationID`);

--
-- Indexes for table `Program`
--
ALTER TABLE `Program`
  ADD PRIMARY KEY (`programID`);

--
-- Indexes for table `Programsections`
--
ALTER TABLE `Programsections`
  ADD PRIMARY KEY (`programID`,`sectionID`),
  ADD KEY `Programsections_ibfk_2` (`sectionID`);

--
-- Indexes for table `Research`
--
ALTER TABLE `Research`
  ADD PRIMARY KEY (`researchID`),
  ADD KEY `fk_studentProposer` (`studentProposerID`),
  ADD KEY `fk_facultyProposer` (`facultyProposerID`),
  ADD KEY `fk_advisor` (`advisorID`);

--
-- Indexes for table `ResearchAuthorList`
--
ALTER TABLE `ResearchAuthorList`
  ADD PRIMARY KEY (`authorID`,`researchID`),
  ADD KEY `researchID` (`researchID`);

--
-- Indexes for table `ResearchInterestList`
--
ALTER TABLE `ResearchInterestList`
  ADD KEY `researchID` (`researchID`),
  ADD KEY `fk_interestID` (`interestID`);

--
-- Indexes for table `ResearchProgramList`
--
ALTER TABLE `ResearchProgramList`
  ADD KEY `programID` (`programID`),
  ADD KEY `researchID` (`researchID`);

--
-- Indexes for table `Section`
--
ALTER TABLE `Section`
  ADD PRIMARY KEY (`sectionID`);

--
-- Indexes for table `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`studentID`),
  ADD UNIQUE KEY `studentnumber` (`studentnumber`),
  ADD UNIQUE KEY `emailadd` (`emailadd`),
  ADD KEY `advisor` (`advisor`),
  ADD KEY `FK_Student_Section` (`sectionID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ActivePaper`
--
ALTER TABLE `ActivePaper`
  MODIFY `activePaperID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Author`
--
ALTER TABLE `Author`
  MODIFY `authorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `EditHistory`
--
ALTER TABLE `EditHistory`
  MODIFY `editID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `Faculty`
--
ALTER TABLE `Faculty`
  MODIFY `facultyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `Interest`
--
ALTER TABLE `Interest`
  MODIFY `interestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `Notification`
--
ALTER TABLE `Notification`
  MODIFY `notificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `NotificationLink`
--
ALTER TABLE `NotificationLink`
  MODIFY `linkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT for table `Program`
--
ALTER TABLE `Program`
  MODIFY `programID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `Research`
--
ALTER TABLE `Research`
  MODIFY `researchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `Section`
--
ALTER TABLE `Section`
  MODIFY `sectionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `Student`
--
ALTER TABLE `Student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ActivePaper`
--
ALTER TABLE `ActivePaper`
  ADD CONSTRAINT `ActivePaper_ibfk_1` FOREIGN KEY (`studentCreatorID`) REFERENCES `Student` (`studentID`),
  ADD CONSTRAINT `ActivePaper_ibfk_2` FOREIGN KEY (`facultyCreatorID`) REFERENCES `Faculty` (`facultyID`),
  ADD CONSTRAINT `fk_researchPaper` FOREIGN KEY (`researchPaper`) REFERENCES `Research` (`researchID`);

--
-- Constraints for table `Adviserteam`
--
ALTER TABLE `Adviserteam`
  ADD CONSTRAINT `Adviserteam_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `Student` (`studentID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_adviserteam_faculty` FOREIGN KEY (`facultyID`) REFERENCES `Faculty` (`facultyID`),
  ADD CONSTRAINT `fk_faculty` FOREIGN KEY (`facultyID`) REFERENCES `Faculty` (`facultyID`);

--
-- Constraints for table `Approve`
--
ALTER TABLE `Approve`
  ADD CONSTRAINT `Approve_ibfk_1` FOREIGN KEY (`research`) REFERENCES `Research` (`researchID`),
  ADD CONSTRAINT `Approve_ibfk_2` FOREIGN KEY (`notification`) REFERENCES `Notification` (`notificationID`),
  ADD CONSTRAINT `Approve_ibfk_3` FOREIGN KEY (`author`) REFERENCES `Author` (`authorID`),
  ADD CONSTRAINT `Approve_ibfk_4` FOREIGN KEY (`oldresearch`) REFERENCES `Research` (`researchID`);

--
-- Constraints for table `EditHistory`
--
ALTER TABLE `EditHistory`
  ADD CONSTRAINT `EditHistory_ibfk_2` FOREIGN KEY (`paperUpdate`) REFERENCES `Research` (`researchID`),
  ADD CONSTRAINT `EditHistory_ibfk_3` FOREIGN KEY (`approver`) REFERENCES `Faculty` (`facultyID`),
  ADD CONSTRAINT `fk_activePaperID` FOREIGN KEY (`activePaperID`) REFERENCES `ActivePaper` (`activePaperID`);

--
-- Constraints for table `NotificationLink`
--
ALTER TABLE `NotificationLink`
  ADD CONSTRAINT `NotificationLink_ibfk_1` FOREIGN KEY (`issuerAdminID`) REFERENCES `Admin` (`adminID`) ON DELETE CASCADE,
  ADD CONSTRAINT `NotificationLink_ibfk_2` FOREIGN KEY (`issuerFacultyID`) REFERENCES `Faculty` (`facultyID`) ON DELETE CASCADE,
  ADD CONSTRAINT `NotificationLink_ibfk_3` FOREIGN KEY (`issuerStudentID`) REFERENCES `Student` (`studentID`) ON DELETE CASCADE,
  ADD CONSTRAINT `NotificationLink_ibfk_4` FOREIGN KEY (`recipientAdminID`) REFERENCES `Admin` (`adminID`) ON DELETE CASCADE,
  ADD CONSTRAINT `NotificationLink_ibfk_5` FOREIGN KEY (`recipientFacultyID`) REFERENCES `Faculty` (`facultyID`) ON DELETE CASCADE,
  ADD CONSTRAINT `NotificationLink_ibfk_6` FOREIGN KEY (`recipientStudentID`) REFERENCES `Student` (`studentID`) ON DELETE CASCADE,
  ADD CONSTRAINT `NotificationLink_ibfk_7` FOREIGN KEY (`notificationID`) REFERENCES `Notification` (`notificationID`) ON DELETE CASCADE;

--
-- Constraints for table `Programsections`
--
ALTER TABLE `Programsections`
  ADD CONSTRAINT `FK_Programsections_Program` FOREIGN KEY (`programID`) REFERENCES `Program` (`programID`) ON DELETE CASCADE,
  ADD CONSTRAINT `Programsections_ibfk_1` FOREIGN KEY (`programID`) REFERENCES `Program` (`programID`) ON DELETE CASCADE,
  ADD CONSTRAINT `Programsections_ibfk_2` FOREIGN KEY (`sectionID`) REFERENCES `Section` (`sectionID`) ON DELETE CASCADE,
  ADD CONSTRAINT `Programsections_ibfk_3` FOREIGN KEY (`sectionID`) REFERENCES `Section` (`sectionID`) ON DELETE CASCADE,
  ADD CONSTRAINT `Programsections_ibfk_4` FOREIGN KEY (`sectionID`) REFERENCES `Section` (`sectionID`) ON DELETE CASCADE,
  ADD CONSTRAINT `Programsections_ibfk_5` FOREIGN KEY (`programID`) REFERENCES `Program` (`programID`) ON DELETE CASCADE;

--
-- Constraints for table `Research`
--
ALTER TABLE `Research`
  ADD CONSTRAINT `fk_advisor` FOREIGN KEY (`advisorID`) REFERENCES `Faculty` (`facultyID`),
  ADD CONSTRAINT `fk_facultyProposer` FOREIGN KEY (`facultyProposerID`) REFERENCES `Faculty` (`facultyID`),
  ADD CONSTRAINT `fk_studentProposer` FOREIGN KEY (`studentProposerID`) REFERENCES `Student` (`studentID`);

--
-- Constraints for table `ResearchAuthorList`
--
ALTER TABLE `ResearchAuthorList`
  ADD CONSTRAINT `ResearchAuthorList_ibfk_1` FOREIGN KEY (`authorID`) REFERENCES `Author` (`authorID`) ON DELETE CASCADE,
  ADD CONSTRAINT `ResearchAuthorList_ibfk_2` FOREIGN KEY (`researchID`) REFERENCES `Research` (`researchID`);

--
-- Constraints for table `ResearchInterestList`
--
ALTER TABLE `ResearchInterestList`
  ADD CONSTRAINT `ResearchInterestList_ibfk_2` FOREIGN KEY (`researchID`) REFERENCES `Research` (`researchID`),
  ADD CONSTRAINT `fk_interestID` FOREIGN KEY (`interestID`) REFERENCES `Interest` (`interestID`);

--
-- Constraints for table `ResearchProgramList`
--
ALTER TABLE `ResearchProgramList`
  ADD CONSTRAINT `ResearchProgramList_ibfk_1` FOREIGN KEY (`programID`) REFERENCES `Program` (`programID`),
  ADD CONSTRAINT `ResearchProgramList_ibfk_2` FOREIGN KEY (`researchID`) REFERENCES `Research` (`researchID`);

--
-- Constraints for table `Student`
--
ALTER TABLE `Student`
  ADD CONSTRAINT `FK_Student_Section` FOREIGN KEY (`sectionID`) REFERENCES `Section` (`sectionID`),
  ADD CONSTRAINT `Student_ibfk_2` FOREIGN KEY (`advisor`) REFERENCES `Faculty` (`facultyID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
