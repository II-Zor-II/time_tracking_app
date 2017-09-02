
-- --------------------------------------------------------
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `time-tracking-app`
--

CREATE DATABASE IF NOT EXISTS `time-tracking-app` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `time-tracking-app`;
-- --------------------------------------------------------

--
-- Table structure for table `daily_tracker`
--

CREATE TABLE `daily_tracker` (
  `member_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` datetime NOT NULL,
  `total_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `daily_tracker`
--

INSERT INTO `daily_tracker` (`member_id`, `status`, `date_from`, `date_to`, `total_time`) VALUES
(5, 2, '2017-06-26', '2017-06-27 00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `daily_tracker_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `position`, `email`, `password`, `role`, `team_id`, `daily_tracker_status`) VALUES
(4, 'admin', 'Director', 'admin@gmail.com', 'admin', 1, 0, 0),
(5, 'user1', 'Member', 'member@gmail.com', 'user1', 3, 1, 2),
(8, 'User_demo', 'Test Position', 'User_demo@gmail.com', 'User_demo', 3, 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `created`) VALUES
(19, 'test project', '2017-06-21 23:28:44'),
(26, 'New Project 2', '2017-06-22 03:03:03'),
(27, 'project gray', '2017-06-22 21:54:37'),
(28, 'Latest Project', '2017-06-22 22:48:46'),
(29, 'Project Demo', '2017-06-23 22:40:35'),
(30, 'Project Demo 2', '2017-06-23 22:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `members_id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL,
  `task_duration` time NOT NULL,
  `task_due_date` datetime NOT NULL,
  `datetime_started` datetime NOT NULL,
  `datetime_finished` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `members_id`, `task_name`, `priority`, `task_duration`, `task_due_date`, `datetime_started`, `datetime_finished`, `status`) VALUES
(14, 26, 5, 'Task 1', 3, '01:33:05', '2017-06-23 05:15:14', '2017-06-23 03:42:09', '0000-00-00 00:00:00', 0),
(15, 26, 5, 'new', 4, '02:44:00', '2017-06-23 06:50:01', '2017-06-23 04:06:01', '0000-00-00 00:00:00', 0),
(16, 28, 5, 'minute task', 2, '00:03:35', '2017-06-23 04:41:31', '2017-06-23 04:37:56', '0000-00-00 00:00:00', 0),
(17, 26, 5, 'copywriting', 1, '04:14:25', '2017-06-24 00:20:30', '2017-06-24 04:34:55', '0000-00-00 00:00:00', 0),
(18, 30, 8, 'Task Demo', 4, '14:46:04', '1970-01-01 08:00:00', '2017-06-23 22:46:04', '0000-00-00 00:00:00', 0),
(19, 30, 8, 'New Task Demo', 4, '00:44:51', '2017-06-24 05:00:00', '2017-06-24 04:15:09', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `team_name` varchar(150) NOT NULL,
  `team_description` text NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `team_name`, `team_description`, `created`) VALUES
(9, 'test', 'setsasdfas', '2017-06-21 23:51:39'),
(11, 'Blue Team', 'A very blue team', '2017-06-22 03:41:28'),
(12, 'Red Team', 'ajlsdfjk lasdf sdf asdf asdfasdf dsdfsdf', '2017-06-22 21:55:31'),
(13, 'Team Demo', 'Demo Team', '2017-06-23 22:41:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daily_tracker`
--
ALTER TABLE `daily_tracker`
  ADD PRIMARY KEY (`member_id`,`date_from`,`date_to`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
