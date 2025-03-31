-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2025 at 02:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatbot_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(3, 'admin', '$2y$10$EZCkK3E/dGlIjwjgNtfs9uEYUHjq8ufXyQy8GlJxkC6P1dIlEYN1y');

-- --------------------------------------------------------

--
-- Table structure for table `chat_history`
--

CREATE TABLE `chat_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sender` varchar(10) NOT NULL CHECK (`sender` in ('user','admin')),
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `college_info`
--

CREATE TABLE `college_info` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `college_info`
--

INSERT INTO `college_info` (`id`, `title`, `description`) VALUES
(2, 'College Details', 'Vidyalankar believes that character-building is an important step towards nation-building. Nurturing young minds is a vital responsibility. Vidyalankar Values are the set of ideals which guide the attitudes and behaviour of the Vidyalankar family. It is said that there are no short-cuts on the road to success. Educating students on ethics, to differentiate between right and wrong and motivating them to choose the right path is imperative. The following values are interspersed in all aspects of the teaching-learning process.<br><br>\r\n\r\n<strong>Honesty</strong><br>\r\nBeing true to oneself and others; being trustworthy and straightforward in all our professional and personal dealings. To walk on the path of honesty and fairness, irrespective of the consequences that may ensue.<br><br>\r\n\r\n<strong>Integrity</strong><br>\r\nUnwaveringly adhering to moral and ethical principles and upholding righteous behaviour. Developing strength of character, which is absolutely incorruptible at any point in the teaching-learning process and in one’s academic and professional life.<br><br>\r\n\r\n<strong>Excellence</strong><br>\r\nSetting high standards and quality benchmarks for oneself and endeavouring to reach them. Doing the very best one can in every task that one accomplishes. Aiming for personal, academic and professional excellence and never compromising with mediocrity.<br><br>\r\n\r\n<strong>Responsibility</strong><br>\r\nBeing aware of and shouldering one’s responsibilities towards self, institute, home and society. Acquiring the inner belief to fulfil one’s responsibilities to the best of one’s abilities. Being accountable for one’s actions; practicing what one preaches and leading by example.<br><br>\r\n\r\n<strong>Commitment</strong><br>\r\nComplete dedication and thorough engagement towards work. Inculcating loyalty and developing a sense of ownership. To be sincere in approach, adhere to deadlines and have a result-oriented approach.<br><br>\r\n\r\n<strong>Salubrious Attitude</strong><br>\r\nNurturing and promoting a feeling of well-being and a healthy and wholesome academic and professional environment. An attitude that is favourable to develop a healthy body, mind and character.<br><br>\r\n\r\nFor more details, visit: <a href=\"http://vpt.edu.in\" target=\"_blank\">vpt.edu.in</a>.');

-- --------------------------------------------------------

--
-- Table structure for table `department_info`
--

CREATE TABLE `department_info` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_info`
--

INSERT INTO `department_info` (`id`, `title`, `description`) VALUES
(1, 'Computer Engineering', 'Our Polytechnic offers a three year Diploma course in Computer Engineering. As technology develops in leaps and bounds, opportunities for expanding the field of computing grow rapidly. The course provides a sound grounding in the fundamentals of computing and underlying engineering principles. Vidyalankar Polytechnic is affiliated to the Maharashtra State Board of Technical Education (MSBTE), Mumbai and Approved by the All India Council for Technical Education.<br><br>\r\n\r\n<strong>Total Intake:</strong> 3 divisions each of 60 students<br>\r\n<strong>Admission:</strong> Please refer to our website for details.<br><br>\r\n\r\n<strong>Vision:</strong> To empower students with domain knowledge and interpersonal skills to cater to industrial and societal needs.<br>\r\n<strong>Mission:</strong> Develop technical skills, interpersonal abilities, and awareness of evolving professional practices.'),
(2, 'Information Technology', 'Vidyalankar Polytechnic offers a three year Diploma course in Information Technology. The program provides a strong foundation in IT, exposing students to current trends and practical applications. The course is affiliated to the Maharashtra State Board of Technical Education (MSBTE).<br><br>\r\n\r\n<strong>Total Intake:</strong> 3 divisions each of 60 students<br>\r\n<strong>Admission:</strong> Please refer to our website for details.<br><br>\r\n\r\n<strong>Vision:</strong> To become a leading center in Information Technology, introducing learners to contemporary technologies.<br>\r\n<strong>Mission:</strong> Encourage academic excellence, nurture soft-skills, and build a robust institute-industry interface.'),
(3, 'Electronics And Telecommunication', 'Vidyalankar Polytechnic offers a three year Diploma course in Electronics and Computer Engineering. This sophisticated branch has diverse applications impacting daily life. The course is affiliated to the Maharashtra State Board of Technical Education (MSBTE), Mumbai and Approved by the All India Council for Technical Education.<br><br>\r\n\r\n<strong>Total Intake:</strong> 3 divisions each of 60 students<br>\r\n<strong>Admission:</strong> Please refer to our website for details.<br><br>\r\n\r\n<strong>Vision:</strong> To produce engineers capable of effectively using technical knowledge and interpersonal skills for industry and society.<br>\r\n<strong>Mission:</strong> Provide state-of-the-art facilities, educate students to face a competitive world, and promote industry-institute interaction.');

-- --------------------------------------------------------

--
-- Table structure for table `syllabus`
--

CREATE TABLE `syllabus` (
  `id` int(11) NOT NULL,
  `year` varchar(20) NOT NULL,
  `semester` varchar(20) DEFAULT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `syllabus`
--

INSERT INTO `syllabus` (`id`, `year`, `semester`, `details`) VALUES
(1, '1st Year', 'Semester 1', 'Details for 1st Year, Semester 1'),
(2, '1st Year', 'Semester 2', 'Details for 1st Year, Semester 2'),
(3, '2nd Year', 'Semester 1', 'Details for 2nd Year, Semester 1'),
(4, '2nd Year', 'Semester 2', 'Details for 2nd Year, Semester 2'),
(5, '3rd Year', 'Semester 1', 'Details for 3rd Year, Semester 1'),
(6, '3rd Year', 'Semester 2', 'Details for 3rd Year, Semester 2'),
(7, 'Computer Engineering', 'Semester 1', 'Subjects:<br>\r\n  - Communication Skill (English)<br>\r\n  - Basic Science (Physics & Chemistry)<br>\r\n  - Basic Mathematics<br>\r\n  - Engineering Graphics<br>\r\n  - Fundamentals of ICT<br>\r\n  - Engineering Workshop Practice<br>\r\n  - Yoga and Meditation<br>\r\n  - CO-First Semester Scheme'),
(8, 'Computer Engineering', 'Semester 2', 'Subjects:<br>\r\n  - Linux Basics<br>\r\n  - Professional Communication<br>\r\n  - Social and Life Skills<br>\r\n  - Web Page Designing<br>\r\n  - Applied Mathematics<br>\r\n  - Basic Electrical And Electronics Engineering<br>\r\n  - Programming In C<br>\r\n  - CO-Second Semester Scheme');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(4, 'admin', 'vinayprakashmore@gmail.com', '$2y$10$3oChcbsJy962piVizPB1TuHqCRuK4ARmm/4pXmlUxv4FlOq15Sf9.', '2025-03-28 19:15:33'),
(5, 'Shreya', 'shreyashraddhapanhale@gmail.com', '$2y$10$qX.AWCVJiPyZWNyf7XfPK.OYgfnE0tfa6HWVBhZVIjzVPmmPrPH4.', '2025-03-28 20:36:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` datetime DEFAULT current_timestamp(),
  `logout_time` datetime DEFAULT NULL,
  `session_duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `user_id`, `login_time`, `logout_time`, `session_duration`) VALUES
(1, 4, '2025-03-31 17:02:48', '2025-03-31 13:33:23', -12565),
(2, 4, '2025-03-31 17:16:41', '2025-03-31 17:17:11', 30),
(3, 4, '2025-03-31 17:26:46', '2025-03-31 17:28:06', 80),
(4, 4, '2025-03-31 17:29:33', '2025-03-31 17:29:37', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `chat_history`
--
ALTER TABLE `chat_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `college_info`
--
ALTER TABLE `college_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_info`
--
ALTER TABLE `department_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chat_history`
--
ALTER TABLE `chat_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `college_info`
--
ALTER TABLE `college_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department_info`
--
ALTER TABLE `department_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `syllabus`
--
ALTER TABLE `syllabus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat_history`
--
ALTER TABLE `chat_history`
  ADD CONSTRAINT `chat_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD CONSTRAINT `user_logins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
