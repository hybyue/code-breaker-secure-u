-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2024 at 04:19 PM
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
-- Database: `securedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(381, 'default', 'deleted a Visitor information on ID number 56', 'App\\Models\\Visitor', 'deleted', 56, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"date\":\"2024-09-11\",\"first_name\":\"ihiwhfi\",\"middle_name\":\"hfhih\",\"last_name\":\"hifbhdih\",\"person_to_visit\":\"fhi\",\"purpose\":\"hihifh\",\"time_in\":\"10:36:43\",\"remarks\":null,\"time_out\":\"11:11:40\",\"id_type\":\"Student ID\"}}', NULL, '2024-09-11 13:24:25', '2024-09-11 13:24:25'),
(382, 'default', 'deleted a Visitor information on ID number 52', 'App\\Models\\Visitor', 'deleted', 52, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"date\":\"2024-09-03\",\"first_name\":\"ieighighiih\",\"middle_name\":\"ihhiehigwhi\",\"last_name\":\"hi\",\"person_to_visit\":\"knknfnkwnk\",\"purpose\":\"dknfwk\",\"time_in\":\"21:58:13\",\"remarks\":null,\"time_out\":\"21:58:18\",\"id_type\":\"Driver License ID\"}}', NULL, '2024-09-11 13:24:31', '2024-09-11 13:24:31'),
(383, 'default', 'deleted a Visitor information on ID number 37', 'App\\Models\\Visitor', 'deleted', 37, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"gvvg\",\"middle_name\":null,\"last_name\":\"evevggg\",\"person_to_visit\":\"vgvgwg\",\"purpose\":\"gvgv\",\"time_in\":\"15:44:51\",\"remarks\":null,\"time_out\":\"21:43:49\",\"id_type\":\"Employee ID\"}}', NULL, '2024-09-11 13:24:45', '2024-09-11 13:24:45'),
(384, 'default', 'deleted a Visitor information on ID number 50', 'App\\Models\\Visitor', 'deleted', 50, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"date\":\"2024-09-03\",\"first_name\":\"bjejbbj\",\"middle_name\":\"bjjbebjjb\",\"last_name\":\"bjbjegbjjb\",\"person_to_visit\":\"bjegjbep\",\"purpose\":\"ojegojkp\",\"time_in\":\"21:53:40\",\"remarks\":null,\"time_out\":\"21:56:09\",\"id_type\":\"Student ID\"}}', NULL, '2024-09-11 13:24:51', '2024-09-11 13:24:51'),
(385, 'default', 'updated a Visitor information on ID number 51', 'App\\Models\\Visitor', 'updated', 51, 'App\\Models\\User', 1, '{\"attributes\":{\"time_out\":\"21:24:59\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-11 13:24:59', '2024-09-11 13:24:59'),
(386, 'default', 'deleted a Visitor information on ID number 51', 'App\\Models\\Visitor', 'deleted', 51, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"date\":\"2024-09-03\",\"first_name\":\"ieighighiih\",\"middle_name\":\"ihhiehigwhi\",\"last_name\":\"hi\",\"person_to_visit\":\"hihihihi\",\"purpose\":\"hihihihir\",\"time_in\":\"21:56:24\",\"remarks\":null,\"time_out\":\"21:24:59\",\"id_type\":\"Student ID\"}}', NULL, '2024-09-11 13:25:08', '2024-09-11 13:25:08'),
(387, 'default', 'deleted a Visitor information on ID number 36', 'App\\Models\\Visitor', 'deleted', 36, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"gvvg\",\"middle_name\":null,\"last_name\":\"evevggg\",\"person_to_visit\":\"vgvgwg\",\"purpose\":\"gvgv\",\"time_in\":\"15:41:10\",\"remarks\":null,\"time_out\":\"15:44:18\",\"id_type\":\"Student ID\"}}', NULL, '2024-09-11 13:25:13', '2024-09-11 13:25:13'),
(388, 'default', 'created a Visitor information on ID number 57', 'App\\Models\\Visitor', 'created', 57, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-09-11\",\"first_name\":\"ihih\",\"middle_name\":\"hi\",\"last_name\":\"tghi\",\"person_to_visit\":\"ih\",\"purpose\":\"ihsihhi\",\"time_in\":\"23:07:31\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-11 15:07:31', '2024-09-11 15:07:31'),
(389, 'default', 'created a Pass Slip information on ID number 16', 'App\\Models\\PassSlip', 'created', 16, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"p_no\":\"P-20240911-1\",\"first_name\":\"Monkey\",\"middle_name\":\"D\",\"last_name\":\"Garcia\",\"department\":\"Department 1\",\"designation\":\"Instructor\",\"destination\":\"SM\",\"date\":\"2024-09-10T16:00:00.000000Z\",\"time_in\":null,\"time_out\":\"11:08:00\",\"empployee_type\":null,\"purpose\":\"qbwdudu\"}}', NULL, '2024-09-11 15:08:23', '2024-09-11 15:08:23'),
(390, 'default', 'created a Parking information on license number 92u9u29u', 'App\\Models\\Parking', 'created', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"license_no\":\"92u9u29u\",\"first_name\":\"yvyveyv\",\"middle_name\":\"yyvwd\",\"last_name\":\"3ryvy\",\"date_registered\":\"2024-09-11\",\"expiration_date\":\"2025-09-11\",\"license_photo\":\"\\/storage\\/license_photos\\/1726067377_radio-tower.png\",\"course\":\"yqyvd\",\"license_exp_date\":\"2024-09-11\",\"dl_codes\":\"9didn\",\"plate_no\":\"qbdb\",\"cr_no\":\"uuub2\",\"cr_date_register\":\"2024-09-04\",\"vehicle_type\":\"ub2udu2\",\"vehicle_image\":\"\\/storage\\/vehicle_images\\/1726067376_cars.jpeg\",\"sticker_id\":\"2023293\"}}', NULL, '2024-09-11 15:09:37', '2024-09-11 15:09:37'),
(391, 'default', 'created a Violation information on ID number 16', 'App\\Models\\Violation', 'created', 16, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"i89869\",\"first_name\":\"huh\",\"middle_initial\":\"uuh\",\"last_name\":\"huh4fu\",\"course\":\"h\",\"violation_type\":\"No ID\",\"date\":\"2024-09-11\"}}', NULL, '2024-09-11 15:10:18', '2024-09-11 15:10:18'),
(392, 'default', 'updated a Visitor information on ID number 57', 'App\\Models\\Visitor', 'updated', 57, 'App\\Models\\User', 6, '{\"attributes\":{\"time_out\":\"23:29:59\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-11 15:29:59', '2024-09-11 15:29:59'),
(393, 'default', 'created a Visitor information on ID number 58', 'App\\Models\\Visitor', 'created', 58, 'App\\Models\\User', 6, '{\"attributes\":{\"user_id\":6,\"date\":\"2024-09-11\",\"first_name\":\"iiei\",\"middle_name\":\"hhei\",\"last_name\":\"ehfi\",\"person_to_visit\":\"hhehi\",\"purpose\":\"ihh\",\"time_in\":\"23:36:41\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-11 15:36:41', '2024-09-11 15:36:41'),
(394, 'default', 'updated a Visitor information on ID number 58', 'App\\Models\\Visitor', 'updated', 58, 'App\\Models\\User', 6, '{\"attributes\":{\"time_out\":\"23:36:52\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-11 15:36:52', '2024-09-11 15:36:52'),
(395, 'default', 'created a Violation information on ID number 17', 'App\\Models\\Violation', 'created', 17, 'App\\Models\\User', 6, '{\"attributes\":{\"user_id\":6,\"student_no\":\"beyvv\",\"first_name\":\"yvvxywy\",\"middle_initial\":\"vyvw\",\"last_name\":\"vyyv\",\"course\":\"y\",\"violation_type\":\"No ID\",\"date\":\"2024-09-05\"}}', NULL, '2024-09-11 16:00:04', '2024-09-11 16:00:04'),
(396, 'default', 'created a Pass Slip information on ID number 17', 'App\\Models\\PassSlip', 'created', 17, 'App\\Models\\User', 6, '{\"attributes\":{\"user_id\":6,\"p_no\":\"P-20240912-1\",\"first_name\":\"bubdb\",\"middle_name\":null,\"last_name\":\"ncu\",\"department\":\"buwbub\",\"designation\":\"bubdubu\",\"destination\":\"ubbudbud\",\"date\":\"2024-09-11T16:00:00.000000Z\",\"time_in\":null,\"time_out\":\"00:17:00\",\"empployee_type\":null,\"purpose\":\"UBUBUUB\"}}', NULL, '2024-09-11 16:17:20', '2024-09-11 16:17:20'),
(397, 'default', 'created a Pass Slip information on ID number 18', 'App\\Models\\PassSlip', 'created', 18, 'App\\Models\\User', 6, '{\"attributes\":{\"user_id\":6,\"p_no\":\"P-20240912-1\",\"first_name\":\"yyecygyg\",\"middle_name\":\"y\",\"last_name\":\"ieceubvbb\",\"department\":\"vycvycvwyv\",\"designation\":\"yyvceyvcyv\",\"destination\":\"yvyvyvy\",\"date\":\"2024-09-11T16:00:00.000000Z\",\"time_in\":null,\"time_out\":\"00:22:00\",\"empployee_type\":null,\"purpose\":\"vyvyvYVYVY\"}}', NULL, '2024-09-11 16:22:10', '2024-09-11 16:22:10'),
(398, 'default', 'created a Pass Slip information on ID number 19', 'App\\Models\\PassSlip', 'created', 19, 'App\\Models\\User', 6, '{\"attributes\":{\"user_id\":6,\"p_no\":\"P-20240912-2\",\"first_name\":\"Monkey\",\"middle_name\":\"D\",\"last_name\":\"Garcia\",\"department\":\"jgrguhuh\",\"designation\":\"egugeu\",\"destination\":\"u eguwg\",\"date\":\"2024-09-10T16:00:00.000000Z\",\"time_in\":null,\"time_out\":\"08:27:00\",\"empployee_type\":null,\"purpose\":\"ug geuwfu\"}}', NULL, '2024-09-12 00:27:18', '2024-09-12 00:27:18'),
(399, 'default', 'created a Pass Slip information on ID number 20', 'App\\Models\\PassSlip', 'created', 20, 'App\\Models\\User', 6, '{\"attributes\":{\"user_id\":6,\"p_no\":\"P-20240912-1\",\"first_name\":\"uguufg\",\"middle_name\":null,\"last_name\":\"ihgu\",\"department\":\"ugguwgugu\",\"designation\":\"ufgu\",\"destination\":\"ugugfug\",\"date\":\"2024-09-11T16:00:00.000000Z\",\"time_in\":null,\"time_out\":\"08:27:00\",\"empployee_type\":null,\"purpose\":\"gufgu\"}}', NULL, '2024-09-12 00:28:02', '2024-09-12 00:28:02'),
(400, 'default', 'created a Visitor information on ID number 59', 'App\\Models\\Visitor', 'created', 59, 'App\\Models\\User', 6, '{\"attributes\":{\"user_id\":6,\"date\":\"2024-09-12\",\"first_name\":\"ugueu\",\"middle_name\":\"ugfug\",\"last_name\":\"uefugwu\",\"person_to_visit\":\"ugufgug\",\"purpose\":\"ugfu\",\"time_in\":\"08:28:26\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-12 00:28:26', '2024-09-12 00:28:26'),
(401, 'default', 'created a Visitor information on ID number 60', 'App\\Models\\Visitor', 'created', 60, 'App\\Models\\User', 6, '{\"attributes\":{\"user_id\":6,\"date\":\"2024-09-12\",\"first_name\":\"e\",\"middle_name\":\"h\",\"last_name\":\"wwwg\",\"person_to_visit\":\"eheh\",\"purpose\":\"eee\",\"time_in\":\"08:30:22\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-12 00:30:22', '2024-09-12 00:30:22'),
(402, 'default', 'updated a Visitor information on ID number 59', 'App\\Models\\Visitor', 'updated', 59, 'App\\Models\\User', 6, '{\"attributes\":{\"time_out\":\"08:32:22\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-12 00:32:22', '2024-09-12 00:32:22'),
(403, 'default', 'updated a Visitor information on ID number 60', 'App\\Models\\Visitor', 'updated', 60, 'App\\Models\\User', 6, '{\"attributes\":{\"time_out\":\"08:32:36\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-12 00:32:36', '2024-09-12 00:32:36'),
(404, 'default', 'created a Visitor information on ID number 61', 'App\\Models\\Visitor', 'created', 61, 'App\\Models\\User', 6, '{\"attributes\":{\"user_id\":6,\"date\":\"2024-09-12\",\"first_name\":\"gugu\",\"middle_name\":\"f\",\"last_name\":\"ugugug\",\"person_to_visit\":\"ffufuefu\",\"purpose\":\"ufufucf3f\",\"time_in\":\"09:12:23\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-12 01:12:24', '2024-09-12 01:12:24'),
(405, 'default', 'created a Visitor information on ID number 62', 'App\\Models\\Visitor', 'created', 62, 'App\\Models\\User', 6, '{\"attributes\":{\"user_id\":6,\"date\":\"2024-09-12\",\"first_name\":\"ttwxft\",\"middle_name\":\"tftxf\",\"last_name\":\"yfcf\",\"person_to_visit\":\"ftwxftwf\",\"purpose\":\"tfwft\",\"time_in\":\"09:12:41\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Driver License ID\"}}', NULL, '2024-09-12 01:12:41', '2024-09-12 01:12:41'),
(406, 'default', 'updated a Visitor information on ID number 62', 'App\\Models\\Visitor', 'updated', 62, 'App\\Models\\User', 6, '{\"attributes\":{\"time_out\":\"09:14:05\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-12 01:14:05', '2024-09-12 01:14:05'),
(407, 'default', 'updated a Visitor information on ID number 61', 'App\\Models\\Visitor', 'updated', 61, 'App\\Models\\User', 6, '{\"attributes\":{\"time_out\":\"09:14:10\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-12 01:14:10', '2024-09-12 01:14:10'),
(408, 'default', 'created a Lost and Found Information on id number 27', 'App\\Models\\Lost', 'created', 27, 'App\\Models\\User', 6, '{\"attributes\":{\"user_id\":6,\"object_type\":\"ugsugfu\",\"first_name\":\"ugeug\",\"middle_name\":\"uugwu\",\"last_name\":\"guwugu\",\"course\":\"gguf\",\"object_img\":null}}', NULL, '2024-09-12 01:34:48', '2024-09-12 01:34:48'),
(409, 'default', 'created a Lost and Found Information on id number 28', 'App\\Models\\Lost', 'created', 28, 'App\\Models\\User', 6, '{\"attributes\":{\"user_id\":6,\"object_type\":\"shessh\",\"first_name\":\"anyare\",\"middle_name\":\"ufuw\",\"last_name\":\"uwuugfgu\",\"course\":\"dugugdu\",\"object_img\":null}}', NULL, '2024-09-12 01:35:10', '2024-09-12 01:35:10'),
(410, 'default', 'created a Lost and Found Information on id number 29', 'App\\Models\\Lost', 'created', 29, 'App\\Models\\User', 6, '{\"attributes\":{\"user_id\":6,\"object_type\":\"Iphone pro max\",\"first_name\":\"Monkey\",\"middle_name\":\"D\",\"last_name\":\"Luffy\",\"course\":\"BSIT\",\"object_img\":null}}', NULL, '2024-09-12 01:37:20', '2024-09-12 01:37:20'),
(411, 'default', 'created a Lost and Found Information on id number 30', 'App\\Models\\Lost', 'created', 30, 'App\\Models\\User', 6, '{\"attributes\":{\"user_id\":6,\"object_type\":\"yfyfy\",\"first_name\":\"ttt\",\"middle_name\":\"rt\",\"last_name\":\"tertt\",\"course\":\"yryyry\",\"object_img\":null}}', NULL, '2024-09-12 05:22:26', '2024-09-12 05:22:26'),
(412, 'default', 'deleted a Visitor information on ID number 30', 'App\\Models\\Visitor', 'deleted', 30, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"yvvyeyvyv`\",\"middle_name\":null,\"last_name\":\"yvyeycvyvy\",\"person_to_visit\":\"yveydvy\",\"purpose\":\"yvvyvyyv\",\"time_in\":\"14:36:27\",\"remarks\":null,\"time_out\":\"14:37:06\",\"id_type\":\"Student ID\"}}', NULL, '2024-09-12 06:09:30', '2024-09-12 06:09:30'),
(413, 'default', 'deleted a Visitor information on ID number 31', 'App\\Models\\Visitor', 'deleted', 31, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"bwuu\",\"middle_name\":null,\"last_name\":\"beuu\",\"person_to_visit\":\"ububeub\",\"purpose\":\"bubububq\",\"time_in\":\"14:37:21\",\"remarks\":null,\"time_out\":\"14:45:53\",\"id_type\":\"Student ID\"}}', NULL, '2024-09-12 06:09:37', '2024-09-12 06:09:37'),
(414, 'default', 'updated a Visitor information on ID number 62', 'App\\Models\\Visitor', 'updated', 62, 'App\\Models\\User', 1, '{\"attributes\":{\"first_name\":\"Marlee\",\"middle_name\":null,\"last_name\":\"Schneider\",\"person_to_visit\":\"Library\",\"purpose\":\"Related Literature\"},\"old\":{\"first_name\":\"ttwxft\",\"middle_name\":\"tftxf\",\"last_name\":\"yfcf\",\"person_to_visit\":\"ftwxftwf\",\"purpose\":\"tfwft\"}}', NULL, '2024-09-12 06:11:56', '2024-09-12 06:11:56'),
(415, 'default', 'updated a Visitor information on ID number 61', 'App\\Models\\Visitor', 'updated', 61, 'App\\Models\\User', 1, '{\"attributes\":{\"first_name\":\"Harmony\",\"middle_name\":null,\"last_name\":\"Marshall\",\"person_to_visit\":\"Department of CEA\",\"purpose\":\"Request Letter\"},\"old\":{\"first_name\":\"gugu\",\"middle_name\":\"f\",\"last_name\":\"ugugug\",\"person_to_visit\":\"ffufuefu\",\"purpose\":\"ufufucf3f\"}}', NULL, '2024-09-12 06:16:46', '2024-09-12 06:16:46'),
(416, 'default', 'deleted a Visitor information on ID number 60', 'App\\Models\\Visitor', 'deleted', 60, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":6,\"date\":\"2024-09-12\",\"first_name\":\"e\",\"middle_name\":\"h\",\"last_name\":\"wwwg\",\"person_to_visit\":\"eheh\",\"purpose\":\"eee\",\"time_in\":\"08:30:22\",\"remarks\":null,\"time_out\":\"08:32:36\",\"id_type\":\"Student ID\"}}', NULL, '2024-09-12 06:16:59', '2024-09-12 06:16:59'),
(417, 'default', 'deleted a Visitor information on ID number 59', 'App\\Models\\Visitor', 'deleted', 59, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":6,\"date\":\"2024-09-12\",\"first_name\":\"ugueu\",\"middle_name\":\"ugfug\",\"last_name\":\"uefugwu\",\"person_to_visit\":\"ugufgug\",\"purpose\":\"ugfu\",\"time_in\":\"08:28:26\",\"remarks\":null,\"time_out\":\"08:32:22\",\"id_type\":\"Student ID\"}}', NULL, '2024-09-12 06:17:07', '2024-09-12 06:17:07'),
(418, 'default', 'deleted a Visitor information on ID number 58', 'App\\Models\\Visitor', 'deleted', 58, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":6,\"date\":\"2024-09-11\",\"first_name\":\"iiei\",\"middle_name\":\"hhei\",\"last_name\":\"ehfi\",\"person_to_visit\":\"hhehi\",\"purpose\":\"ihh\",\"time_in\":\"23:36:41\",\"remarks\":null,\"time_out\":\"23:36:52\",\"id_type\":\"Student ID\"}}', NULL, '2024-09-12 06:17:13', '2024-09-12 06:17:13'),
(419, 'default', 'deleted a Visitor information on ID number 11', 'App\\Models\\Visitor', 'deleted', 11, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":2,\"date\":\"2024-09-02\",\"first_name\":\"njegnjwnjj\",\"middle_name\":\"njnnj\",\"last_name\":\"infnin\",\"person_to_visit\":\"jnnjgjnj\",\"purpose\":\"nnjnjgenj\",\"time_in\":\"17:50:32\",\"remarks\":null,\"time_out\":\"17:53:39\",\"id_type\":\"Student ID\"}}', NULL, '2024-09-12 06:17:31', '2024-09-12 06:17:31'),
(420, 'default', 'deleted a Visitor information on ID number 8', 'App\\Models\\Visitor', 'deleted', 8, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"date\":\"2024-09-01\",\"first_name\":\"oihuiehefhqi1i\",\"middle_name\":\"hhihi\",\"last_name\":\"ihih\",\"person_to_visit\":\"ihih\",\"purpose\":\"ihi\",\"time_in\":\"19:05:11\",\"remarks\":null,\"time_out\":\"19:08:54\",\"id_type\":\"Student ID\"}}', NULL, '2024-09-12 06:17:36', '2024-09-12 06:17:36'),
(421, 'default', 'deleted a Visitor information on ID number 7', 'App\\Models\\Visitor', 'deleted', 7, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"date\":\"2024-08-26\",\"first_name\":\"kzudhvushuHU\",\"middle_name\":\"huhgiu\",\"last_name\":\"hiuhguih\",\"person_to_visit\":\"uhhuwh\",\"purpose\":\"huhqu\",\"time_in\":\"13:05:50\",\"remarks\":null,\"time_out\":\"13:46:30\",\"id_type\":\"Student ID\"}}', NULL, '2024-09-12 06:18:24', '2024-09-12 06:18:24'),
(422, 'default', 'updated a Visitor information on ID number 57', 'App\\Models\\Visitor', 'updated', 57, 'App\\Models\\User', 1, '{\"attributes\":{\"first_name\":\"Dominique\",\"middle_name\":null,\"last_name\":\"Sampson\",\"person_to_visit\":\"NSTP Department\",\"purpose\":\"Request form\"},\"old\":{\"first_name\":\"ihih\",\"middle_name\":\"hi\",\"last_name\":\"tghi\",\"person_to_visit\":\"ih\",\"purpose\":\"ihsihhi\"}}', NULL, '2024-09-12 06:19:54', '2024-09-12 06:19:54'),
(423, 'default', 'deleted a Visitor information on ID number 32', 'App\\Models\\Visitor', 'deleted', 32, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"Garby\",\"middle_name\":null,\"last_name\":\"Garcia\",\"person_to_visit\":\"hahaha\",\"purpose\":\"wdwbhw\",\"time_in\":\"14:50:00\",\"remarks\":null,\"time_out\":\"14:57:18\",\"id_type\":\"Driver License ID\"}}', NULL, '2024-09-12 06:20:22', '2024-09-12 06:20:22'),
(424, 'default', 'deleted a Visitor information on ID number 21', 'App\\Models\\Visitor', 'deleted', 21, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"Garby\",\"middle_name\":\"D\",\"last_name\":\"Garcia\",\"person_to_visit\":\"hahaha\",\"purpose\":\"shshh\",\"time_in\":\"12:56:17\",\"remarks\":null,\"time_out\":\"12:56:17\",\"id_type\":\"Student ID\"}}', NULL, '2024-09-12 06:20:46', '2024-09-12 06:20:46'),
(425, 'default', 'updated a Visitor information on ID number 14', 'App\\Models\\Visitor', 'updated', 14, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"CITE\"},\"old\":{\"person_to_visit\":\"CITEsss\"}}', NULL, '2024-09-12 06:21:40', '2024-09-12 06:21:40'),
(426, 'default', 'updated a Visitor information on ID number 16', 'App\\Models\\Visitor', 'updated', 16, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"CITE\"},\"old\":{\"person_to_visit\":\"CITEs\"}}', NULL, '2024-09-12 06:21:40', '2024-09-12 06:21:40'),
(427, 'default', 'updated a Visitor information on ID number 17', 'App\\Models\\Visitor', 'updated', 17, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"CITE\"},\"old\":{\"person_to_visit\":\"CITEa\"}}', NULL, '2024-09-12 06:21:40', '2024-09-12 06:21:40'),
(428, 'default', 'updated a Visitor information on ID number 18', 'App\\Models\\Visitor', 'updated', 18, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"CITE\"},\"old\":{\"person_to_visit\":\"CITEs\"}}', NULL, '2024-09-12 06:21:40', '2024-09-12 06:21:40'),
(429, 'default', 'updated a Visitor information on ID number 23', 'App\\Models\\Visitor', 'updated', 23, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"CITE\"},\"old\":{\"person_to_visit\":\"CITEss\"}}', NULL, '2024-09-12 06:21:40', '2024-09-12 06:21:40'),
(430, 'default', 'updated a Visitor information on ID number 24', 'App\\Models\\Visitor', 'updated', 24, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"CITE\"},\"old\":{\"person_to_visit\":\"CITEs\"}}', NULL, '2024-09-12 06:21:40', '2024-09-12 06:21:40'),
(431, 'default', 'updated a Visitor information on ID number 25', 'App\\Models\\Visitor', 'updated', 25, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"CITE\"},\"old\":{\"person_to_visit\":\"CITEss hahaha\"}}', NULL, '2024-09-12 06:21:40', '2024-09-12 06:21:40'),
(432, 'default', 'updated a Visitor information on ID number 26', 'App\\Models\\Visitor', 'updated', 26, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"CITE\"},\"old\":{\"person_to_visit\":\"CITE shesshh\"}}', NULL, '2024-09-12 06:21:40', '2024-09-12 06:21:40'),
(433, 'default', 'updated a Visitor information on ID number 27', 'App\\Models\\Visitor', 'updated', 27, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"CITE\"},\"old\":{\"person_to_visit\":\"CITEss\"}}', NULL, '2024-09-12 06:21:40', '2024-09-12 06:21:40'),
(434, 'default', 'updated a Visitor information on ID number 22', 'App\\Models\\Visitor', 'updated', 22, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"CITE\"},\"old\":{\"person_to_visit\":\"CITESSs\"}}', NULL, '2024-09-12 06:22:29', '2024-09-12 06:22:29'),
(435, 'default', 'updated a Visitor information on ID number 20', 'App\\Models\\Visitor', 'updated', 20, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"Security Management Office\",\"purpose\":\"Checking for lost item\"},\"old\":{\"person_to_visit\":\"ngekss hahaha\",\"purpose\":\"punta lang sa sm\"}}', NULL, '2024-09-12 06:23:46', '2024-09-12 06:23:46'),
(436, 'default', 'updated a Visitor information on ID number 19', 'App\\Models\\Visitor', 'updated', 19, 'App\\Models\\User', 1, '{\"attributes\":{\"first_name\":\"Trevor\",\"middle_name\":null,\"last_name\":\"Sloan\",\"person_to_visit\":\"Audit Office\",\"purpose\":\"Request Audits\"},\"old\":{\"first_name\":\"gguegugu\",\"middle_name\":\"gugueuggu\",\"last_name\":\"usufuwgu\",\"person_to_visit\":\"gugueguu\",\"purpose\":\"gugueguw\"}}', NULL, '2024-09-12 06:26:16', '2024-09-12 06:26:16'),
(437, 'default', 'deleted a Visitor information on ID number 13', 'App\\Models\\Visitor', 'deleted', 13, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"hbhvbbh\",\"middle_name\":\"hbhbwh\",\"last_name\":\"ysvhh\",\"person_to_visit\":\"bjjevjbebjb\",\"purpose\":\"jbjejwb\",\"time_in\":\"11:59:02\",\"remarks\":null,\"time_out\":\"12:03:19\",\"id_type\":\"Student ID\"}}', NULL, '2024-09-12 06:28:28', '2024-09-12 06:28:28'),
(438, 'default', 'created a Parking information on license number 299y', 'App\\Models\\Parking', 'created', 12, 'App\\Models\\User', 6, '{\"attributes\":{\"license_no\":\"299y\",\"first_name\":\"uwgdugu\",\"middle_name\":\"uu\",\"last_name\":\"8gu\",\"date_registered\":\"2024-09-27\",\"expiration_date\":\"2025-09-27\",\"license_photo\":\"\\/storage\\/license_photos\\/1726122848_users.png\",\"course\":\"gdugug\",\"license_exp_date\":\"2024-09-13\",\"dl_codes\":\"y9y9y\",\"plate_no\":\"881y888\",\"cr_no\":\"ugug\",\"cr_date_register\":\"2024-09-10\",\"vehicle_type\":\"y8y8ygug\",\"vehicle_image\":null,\"sticker_id\":\"wug8y\"}}', NULL, '2024-09-12 06:34:09', '2024-09-12 06:34:09'),
(439, 'default', 'deleted a Pass Slip information on ID number 20', 'App\\Models\\PassSlip', 'deleted', 20, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":6,\"p_no\":\"P-20240912-1\",\"first_name\":\"uguufg\",\"middle_name\":null,\"last_name\":\"ihgu\",\"department\":\"ugguwgugu\",\"designation\":\"ufgu\",\"destination\":\"ugugfug\",\"date\":\"2024-09-11T16:00:00.000000Z\",\"time_in\":null,\"time_out\":\"08:27:00\",\"empployee_type\":null,\"purpose\":\"gufgu\"}}', NULL, '2024-09-12 06:37:38', '2024-09-12 06:37:38'),
(440, 'default', 'deleted a Pass Slip information on ID number 9', 'App\\Models\\PassSlip', 'deleted', 9, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":2,\"p_no\":\"P-20240910-1\",\"first_name\":\"ijijwidji\",\"middle_name\":\"jI\",\"last_name\":\"ecjijijwiji\",\"department\":\"IJIJWIDJID\",\"designation\":\"DH28H8H\",\"destination\":\"8H8HD8\",\"date\":\"2024-09-09T16:00:00.000000Z\",\"time_in\":\"20:45:00\",\"time_out\":\"20:45:00\",\"empployee_type\":null,\"purpose\":\"8H8H2D8H\"}}', NULL, '2024-09-12 06:37:48', '2024-09-12 06:37:48'),
(441, 'default', 'deleted a Pass Slip information on ID number 18', 'App\\Models\\PassSlip', 'deleted', 18, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":6,\"p_no\":\"P-20240912-1\",\"first_name\":\"yyecygyg\",\"middle_name\":\"y\",\"last_name\":\"ieceubvbb\",\"department\":\"vycvycvwyv\",\"designation\":\"yyvceyvcyv\",\"destination\":\"yvyvyvy\",\"date\":\"2024-09-11T16:00:00.000000Z\",\"time_in\":null,\"time_out\":\"00:22:00\",\"empployee_type\":null,\"purpose\":\"vyvyvYVYVY\"}}', NULL, '2024-09-12 06:37:55', '2024-09-12 06:37:55'),
(442, 'default', 'deleted a Pass Slip information on ID number 19', 'App\\Models\\PassSlip', 'deleted', 19, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":6,\"p_no\":\"P-20240912-2\",\"first_name\":\"Monkey\",\"middle_name\":\"D\",\"last_name\":\"Garcia\",\"department\":\"jgrguhuh\",\"designation\":\"egugeu\",\"destination\":\"u eguwg\",\"date\":\"2024-09-10T16:00:00.000000Z\",\"time_in\":null,\"time_out\":\"08:27:00\",\"empployee_type\":null,\"purpose\":\"ug geuwfu\"}}', NULL, '2024-09-12 06:38:01', '2024-09-12 06:38:01'),
(443, 'default', 'deleted a Pass Slip information on ID number 17', 'App\\Models\\PassSlip', 'deleted', 17, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":6,\"p_no\":\"P-20240912-1\",\"first_name\":\"bubdb\",\"middle_name\":null,\"last_name\":\"ncu\",\"department\":\"buwbub\",\"designation\":\"bubdubu\",\"destination\":\"ubbudbud\",\"date\":\"2024-09-11T16:00:00.000000Z\",\"time_in\":null,\"time_out\":\"00:17:00\",\"empployee_type\":null,\"purpose\":\"UBUBUUB\"}}', NULL, '2024-09-12 06:38:33', '2024-09-12 06:38:33'),
(444, 'default', 'deleted a Pass Slip information on ID number 12', 'App\\Models\\PassSlip', 'deleted', 12, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"p_no\":\"P-20240911-1\",\"first_name\":\"uguwfu\",\"middle_name\":\"uigwuugf\",\"last_name\":\"euwgug\",\"department\":\"uwgfu\",\"designation\":\"ggfqgug\",\"destination\":\"ggfuggguu\",\"date\":\"2024-09-10T16:00:00.000000Z\",\"time_in\":\"10:36:00\",\"time_out\":\"10:36:00\",\"empployee_type\":null,\"purpose\":\"ugfgwg\"}}', NULL, '2024-09-12 06:38:43', '2024-09-12 06:38:43'),
(445, 'default', 'deleted a Pass Slip information on ID number 10', 'App\\Models\\PassSlip', 'deleted', 10, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":2,\"p_no\":\"P-20240910-1\",\"first_name\":\"uguu\",\"middle_name\":\"uu\",\"last_name\":\"dchvusu\",\"department\":\"sjcuwg\",\"designation\":\"uugucw\",\"destination\":\"guwugfug\",\"date\":\"2024-09-09T16:00:00.000000Z\",\"time_in\":null,\"time_out\":\"21:05:00\",\"empployee_type\":null,\"purpose\":\"ugugug\"}}', NULL, '2024-09-12 06:38:51', '2024-09-12 06:38:51'),
(446, 'default', 'deleted a Pass Slip information on ID number 8', 'App\\Models\\PassSlip', 'deleted', 8, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":2,\"p_no\":\"P-20240910-1\",\"first_name\":\"ijjb\",\"middle_name\":null,\"last_name\":\"BCWJBJb\",\"department\":\"hbhbsh\",\"designation\":\"huhuu\",\"destination\":\"huhuhqss2huh\",\"date\":\"2024-09-09T16:00:00.000000Z\",\"time_in\":\"20:44:00\",\"time_out\":\"20:44:00\",\"empployee_type\":null,\"purpose\":\"uhushu2sh2u\"}}', NULL, '2024-09-12 06:39:01', '2024-09-12 06:39:01'),
(447, 'default', 'deleted a Pass Slip information on ID number 6', 'App\\Models\\PassSlip', 'deleted', 6, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"p_no\":\"P-20240903-2\",\"first_name\":\"buebgbubu\",\"middle_name\":null,\"last_name\":\"iegiei\",\"department\":\"ubbugbuwlwnli\",\"designation\":\"nnekgkj\",\"destination\":\"bbjegjbkb\",\"date\":\"2024-09-02T16:00:00.000000Z\",\"time_in\":null,\"time_out\":\"22:49:00\",\"empployee_type\":null,\"purpose\":\"bjkjgjkebgjkkw\"}}', NULL, '2024-09-12 06:39:08', '2024-09-12 06:39:08'),
(448, 'default', 'deleted a Parking information on license number 835826', 'App\\Models\\Parking', 'deleted', 9, 'App\\Models\\User', 1, '{\"old\":{\"license_no\":\"835826\",\"first_name\":\"gugfgu\",\"middle_name\":null,\"last_name\":\"uguwg\",\"date_registered\":\"2024-09-04\",\"expiration_date\":\"2025-09-04\",\"license_photo\":\"\\/storage\\/license_photos\\/1725440439_user-gear.png\",\"course\":\"ggguwfgu\",\"license_exp_date\":\"2024-09-04\",\"dl_codes\":\"gueggu\",\"plate_no\":\"228868\",\"cr_no\":\"vfvvhhv\",\"cr_date_register\":\"2024-09-04\",\"vehicle_type\":\"uwfgwgv\",\"vehicle_image\":\"\\/storage\\/vehicle_images\\/1725440438_cars.jpeg\",\"sticker_id\":\"6468268\"}}', NULL, '2024-09-12 06:42:06', '2024-09-12 06:42:06'),
(449, 'default', 'deleted a Parking information on license number 299y', 'App\\Models\\Parking', 'deleted', 12, 'App\\Models\\User', 1, '{\"old\":{\"license_no\":\"299y\",\"first_name\":\"uwgdugu\",\"middle_name\":\"uu\",\"last_name\":\"8gu\",\"date_registered\":\"2024-09-27\",\"expiration_date\":\"2025-09-27\",\"license_photo\":\"\\/storage\\/license_photos\\/1726122848_users.png\",\"course\":\"gdugug\",\"license_exp_date\":\"2024-09-13\",\"dl_codes\":\"y9y9y\",\"plate_no\":\"881y888\",\"cr_no\":\"ugug\",\"cr_date_register\":\"2024-09-10\",\"vehicle_type\":\"y8y8ygug\",\"vehicle_image\":null,\"sticker_id\":\"wug8y\"}}', NULL, '2024-09-12 06:42:17', '2024-09-12 06:42:17'),
(450, 'default', 'deleted a Parking information on license number 92u9u29u', 'App\\Models\\Parking', 'deleted', 11, 'App\\Models\\User', 1, '{\"old\":{\"license_no\":\"92u9u29u\",\"first_name\":\"yvyveyv\",\"middle_name\":\"yyvwd\",\"last_name\":\"3ryvy\",\"date_registered\":\"2024-09-11\",\"expiration_date\":\"2025-09-11\",\"license_photo\":\"\\/storage\\/license_photos\\/1726067377_radio-tower.png\",\"course\":\"yqyvd\",\"license_exp_date\":\"2024-09-11\",\"dl_codes\":\"9didn\",\"plate_no\":\"qbdb\",\"cr_no\":\"uuub2\",\"cr_date_register\":\"2024-09-04\",\"vehicle_type\":\"ub2udu2\",\"vehicle_image\":\"\\/storage\\/vehicle_images\\/1726067376_cars.jpeg\",\"sticker_id\":\"2023293\"}}', NULL, '2024-09-12 06:42:25', '2024-09-12 06:42:25'),
(451, 'default', 'deleted a Parking information on license number iwih', 'App\\Models\\Parking', 'deleted', 10, 'App\\Models\\User', 1, '{\"old\":{\"license_no\":\"iwih\",\"first_name\":\"uwuggu\",\"middle_name\":\"ugguw\",\"last_name\":\"gugwgufgu\",\"date_registered\":\"2024-09-04\",\"expiration_date\":\"2025-09-04\",\"license_photo\":null,\"course\":\"ugufgu\",\"license_exp_date\":\"2024-09-20\",\"dl_codes\":\"hhighi\",\"plate_no\":\"ihwfhih\",\"cr_no\":\"ihhqihq\",\"cr_date_register\":\"2024-09-13\",\"vehicle_type\":\"hihi\",\"vehicle_image\":null,\"sticker_id\":\"uwuwguu\"}}', NULL, '2024-09-12 06:42:31', '2024-09-12 06:42:31'),
(452, 'default', 'deleted a Event Information on ID number 17', 'App\\Models\\Event', 'deleted', 17, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"Buwan ng Wika\",\"description\":\"Dapat ready kayo lagi pa sa paparating na buwan ng wika\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":\"2024-08-30T16:00:00.000000Z\"}}', NULL, '2024-09-12 06:52:44', '2024-09-12 06:52:44'),
(453, 'default', 'deleted a Event Information on ID number 52', 'App\\Models\\Event', 'deleted', 52, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":2,\"title\":\"jnuu4uu\",\"description\":\"uhuhuheufhuu\",\"date_start\":\"2024-09-10T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-12 06:52:51', '2024-09-12 06:52:51'),
(454, 'default', 'deleted a Event Information on ID number 45', 'App\\Models\\Event', 'deleted', 45, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"nice\",\"description\":\"ugfguwgu\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":\"2024-08-31T16:00:00.000000Z\"}}', NULL, '2024-09-12 06:52:56', '2024-09-12 06:52:56'),
(455, 'default', 'updated a Pass Slip information on ID number 16', 'App\\Models\\PassSlip', 'updated', 16, 'App\\Models\\User', 1, '{\"attributes\":{\"first_name\":\"Raymark\",\"middle_name\":\"B\",\"last_name\":\"Min\",\"time_in\":\"14:00:00\"},\"old\":{\"first_name\":\"Monkey\",\"middle_name\":\"D\",\"last_name\":\"Garcia\",\"time_in\":null}}', NULL, '2024-09-12 07:56:21', '2024-09-12 07:56:21'),
(456, 'default', 'updated a Pass Slip information on ID number 16', 'App\\Models\\PassSlip', 'updated', 16, 'App\\Models\\User', 1, '{\"attributes\":[],\"old\":[]}', NULL, '2024-09-12 07:56:22', '2024-09-12 07:56:22'),
(457, 'default', 'updated a Pass Slip information on ID number 11', 'App\\Models\\PassSlip', 'updated', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"first_name\":\"Angelo Austin\",\"middle_name\":\"A\",\"last_name\":\"Aquino\",\"designation\":\"Admin\",\"destination\":\"168\",\"time_in\":\"11:00:00\",\"purpose\":\"buying some foods\"},\"old\":{\"first_name\":\"Earl\",\"middle_name\":\"D\",\"last_name\":\"Garcia\",\"designation\":\"huhuu\",\"destination\":\"huhuhqss2huh\",\"time_in\":null,\"purpose\":\"nuduhuf\"}}', NULL, '2024-09-12 07:58:44', '2024-09-12 07:58:44'),
(458, 'default', 'updated a Pass Slip information on ID number 7', 'App\\Models\\PassSlip', 'updated', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"first_name\":\"Angelo\",\"last_name\":\"Gabertan\",\"designation\":\"Head III\",\"destination\":\"SM\",\"time_in\":\"13:00:00\",\"time_out\":\"12:00:00\",\"purpose\":\"eating\"},\"old\":{\"first_name\":\"Monkey\",\"last_name\":\"Garcia\",\"designation\":\"Excuse letter 1234\",\"destination\":\"yfyefy\",\"time_in\":null,\"time_out\":\"16:43:00\",\"purpose\":\"ghehefefi\"}}', NULL, '2024-09-12 08:00:30', '2024-09-12 08:00:30'),
(459, 'default', 'updated a Pass Slip information on ID number 5', 'App\\Models\\PassSlip', 'updated', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"first_name\":\"Lea\",\"middle_name\":\"C\",\"last_name\":\"Cruz\",\"designation\":\"PE teacher\",\"destination\":\"Sakura Kampai\",\"time_in\":\"11:30:00\",\"time_out\":\"10:48:00\",\"purpose\":\"Buying Milktea\"},\"old\":{\"first_name\":\"Gusion\",\"middle_name\":null,\"last_name\":\"Magic\",\"designation\":\"Janitor\",\"destination\":\"Baguio\",\"time_in\":\"22:48:00\",\"time_out\":\"22:48:00\",\"purpose\":\"kjbduiegfugugui\"}}', NULL, '2024-09-12 08:01:45', '2024-09-12 08:01:45'),
(460, 'default', 'updated a Pass Slip information on ID number 4', 'App\\Models\\PassSlip', 'updated', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"first_name\":\"Nicky James\",\"middle_name\":\"D\",\"last_name\":\"Buemio\",\"destination\":\"Outside UCU\",\"time_in\":\"11:15:00\",\"time_out\":\"10:48:00\",\"purpose\":\"Buying Foods\"},\"old\":{\"first_name\":\"Gusion\",\"middle_name\":null,\"last_name\":\"Magic\",\"destination\":\"Baguio\",\"time_in\":\"22:48:00\",\"time_out\":\"22:48:00\",\"purpose\":\"kjbduiegfugugui\"}}', NULL, '2024-09-12 08:03:15', '2024-09-12 08:03:15'),
(461, 'default', 'updated a Pass Slip information on ID number 2', 'App\\Models\\PassSlip', 'updated', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"first_name\":\"Jesem\",\"middle_name\":\"G\",\"last_name\":\"Tepace\",\"destination\":\"Manaoag\",\"purpose\":\"Go to emergency\"},\"old\":{\"first_name\":\"David Earl Gabriel\",\"middle_name\":null,\"last_name\":\"Garcia\",\"destination\":\"Dagupan City\",\"purpose\":\"I will go there to see my family because we have a serious problem and it is confidential\"}}', NULL, '2024-09-12 08:04:11', '2024-09-12 08:04:11'),
(462, 'default', 'updated a Pass Slip information on ID number 1', 'App\\Models\\PassSlip', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"first_name\":\"Yancy\",\"last_name\":\"Cabanting\",\"destination\":\"Pozzurobio\"},\"old\":{\"first_name\":\"David\",\"last_name\":\"Garcia\",\"destination\":\"Urdaneta City\"}}', NULL, '2024-09-12 08:04:51', '2024-09-12 08:04:51'),
(463, 'default', 'created a Parking information on license number 23672', 'App\\Models\\Parking', 'created', 13, 'App\\Models\\User', 1, '{\"attributes\":{\"license_no\":\"23672\",\"first_name\":\"Raymark\",\"middle_name\":\"B\",\"last_name\":\"Mina\",\"date_registered\":\"2024-08-16\",\"expiration_date\":\"2025-08-16\",\"license_photo\":\"\\/storage\\/license_photos\\/1726128486_abs.png\",\"course\":\"BSIT\",\"license_exp_date\":\"2027-06-15\",\"dl_codes\":\"hdads\",\"plate_no\":\"HEV 3624\",\"cr_no\":\"65839\",\"cr_date_register\":\"2024-09-24\",\"vehicle_type\":\"MIO\",\"vehicle_image\":\"\\/storage\\/vehicle_images\\/1726128485_dio.jpeg\",\"sticker_id\":\"203198\"}}', NULL, '2024-09-12 08:08:06', '2024-09-12 08:08:06'),
(464, 'default', 'deleted a Violation information on ID number 17', 'App\\Models\\Violation', 'deleted', 17, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":6,\"student_no\":\"beyvv\",\"first_name\":\"yvvxywy\",\"middle_initial\":\"vyvw\",\"last_name\":\"vyyv\",\"course\":\"y\",\"violation_type\":\"No ID\",\"date\":\"2024-09-05\"}}', NULL, '2024-09-12 08:08:55', '2024-09-12 08:08:55'),
(465, 'default', 'deleted a Violation information on ID number 8', 'App\\Models\\Violation', 'deleted', 8, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"student_no\":\"93949\",\"first_name\":\"guguwgugu\",\"middle_initial\":\"guguwgu\",\"last_name\":\"sbfwugguu\",\"course\":\"BSIT\",\"violation_type\":\"No ID\",\"date\":\"2024-09-04\"}}', NULL, '2024-09-12 08:09:05', '2024-09-12 08:09:05'),
(466, 'default', 'deleted a Violation information on ID number 9', 'App\\Models\\Violation', 'deleted', 9, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"student_no\":\"139149\",\"first_name\":\"uwfug\",\"middle_initial\":\"guuwgf\",\"last_name\":\"sufu\",\"course\":\"guwu\",\"violation_type\":\"No ID\",\"date\":\"2024-09-04\"}}', NULL, '2024-09-12 08:09:12', '2024-09-12 08:09:12'),
(467, 'default', 'updated a Violation information on ID number 16', 'App\\Models\\Violation', 'updated', 16, 'App\\Models\\User', 1, '{\"attributes\":{\"student_no\":\"20216354\",\"first_name\":\"Angelo Darren\",\"middle_initial\":\"G\",\"last_name\":\"Gabertan\",\"course\":\"BSIT\",\"violation_type\":\"Earings\"},\"old\":{\"student_no\":\"i89869\",\"first_name\":\"huh\",\"middle_initial\":\"uuh\",\"last_name\":\"huh4fu\",\"course\":\"h\",\"violation_type\":\"No ID\"}}', NULL, '2024-09-12 08:09:50', '2024-09-12 08:09:50'),
(468, 'default', 'updated a Violation information on ID number 11', 'App\\Models\\Violation', 'updated', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"student_no\":\"20217336\",\"first_name\":\"Raymark\",\"middle_initial\":\"B\",\"last_name\":\"Mina\",\"course\":\"BSIT\",\"violation_type\":\"No Uniform\"},\"old\":{\"student_no\":\"1234567\",\"first_name\":\"uugf\",\"middle_initial\":\"guguf\",\"last_name\":\"gufguw\",\"course\":\"guguwgu\",\"violation_type\":\"No ID\"}}', NULL, '2024-09-12 08:10:33', '2024-09-12 08:10:33'),
(469, 'default', 'updated a Violation information on ID number 10', 'App\\Models\\Violation', 'updated', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"student_no\":\"20218998\",\"first_name\":\"Jesem\",\"middle_initial\":\"J\",\"last_name\":\"Tepace\",\"course\":\"BSHM\",\"violation_type\":\"Inapropriate Cloths\",\"date\":\"2024-09-06\"},\"old\":{\"student_no\":\"202140403\",\"first_name\":\"huheh\",\"middle_initial\":\"hh\",\"last_name\":\"hsuhh\",\"course\":\"uhehwhu\",\"violation_type\":\"No ID\",\"date\":\"2024-09-04\"}}', NULL, '2024-09-12 08:11:10', '2024-09-12 08:11:10'),
(470, 'default', 'updated a Lost and Found Information on id number 23', 'App\\Models\\Lost', 'updated', 23, 'App\\Models\\User', 1, '{\"attributes\":{\"object_type\":\"phone\",\"first_name\":\"Raymark\",\"middle_name\":\"B\",\"last_name\":\"Mina\",\"course\":\"BSIT\",\"object_img\":\"\\/storage\\/lost_images\\/1726128814_nokia 3210.jpeg\"},\"old\":{\"object_type\":\"ijefhi\",\"first_name\":\"sbsb\",\"middle_name\":\"ihhiih\",\"last_name\":\"bsjbbsb\",\"course\":\"jb\",\"object_img\":null}}', NULL, '2024-09-12 08:13:34', '2024-09-12 08:13:34'),
(471, 'default', 'updated a Lost and Found Information on id number 12', 'App\\Models\\Lost', 'updated', 12, 'App\\Models\\User', 1, '{\"attributes\":{\"object_type\":\"Motor\",\"first_name\":\"Angelo a\"},\"old\":{\"object_type\":\"uehfuguuw\",\"first_name\":\"buufb\"}}', NULL, '2024-09-12 08:14:00', '2024-09-12 08:14:00'),
(472, 'default', 'updated a Lost and Found Information on id number 12', 'App\\Models\\Lost', 'updated', 12, 'App\\Models\\User', 1, '{\"attributes\":{\"first_name\":\"Angelo Austin\",\"middle_name\":\"A\",\"last_name\":\"Aquino\",\"course\":\"BSIT\"},\"old\":{\"first_name\":\"Angelo a\",\"middle_name\":\"buu\",\"last_name\":\"ubfbbufuq\",\"course\":\"ubwbububu\"}}', NULL, '2024-09-12 08:14:26', '2024-09-12 08:14:26'),
(473, 'default', 'deleted a Lost and Found Information on id number 24', 'App\\Models\\Lost', 'deleted', 24, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"object_type\":\"gwudg\",\"first_name\":\"ugg\",\"middle_name\":\"udgu\",\"last_name\":\"gugu\",\"course\":\"uguu\",\"object_img\":null}}', NULL, '2024-09-12 08:14:35', '2024-09-12 08:14:35'),
(474, 'default', 'deleted a Lost and Found Information on id number 26', 'App\\Models\\Lost', 'deleted', 26, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"object_type\":\"hihsi\",\"first_name\":\"ihhiehi\",\"middle_name\":\"ihihwhi\",\"last_name\":\"hihiwghiwhi\",\"course\":\"hihfwhi\",\"object_img\":null}}', NULL, '2024-09-12 08:14:39', '2024-09-12 08:14:39'),
(475, 'default', 'deleted a Lost and Found Information on id number 25', 'App\\Models\\Lost', 'deleted', 25, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"object_type\":\"ubucb\",\"first_name\":\"bubdb\",\"middle_name\":\"budb\",\"last_name\":\"bubdbu\",\"course\":\"bdbud\",\"object_img\":null}}', NULL, '2024-09-12 08:14:44', '2024-09-12 08:14:44'),
(476, 'default', 'deleted a Lost and Found Information on id number 27', 'App\\Models\\Lost', 'deleted', 27, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":6,\"object_type\":\"ugsugfu\",\"first_name\":\"ugeug\",\"middle_name\":\"uugwu\",\"last_name\":\"guwugu\",\"course\":\"gguf\",\"object_img\":null}}', NULL, '2024-09-12 08:14:49', '2024-09-12 08:14:49'),
(477, 'default', 'deleted a Lost and Found Information on id number 28', 'App\\Models\\Lost', 'deleted', 28, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":6,\"object_type\":\"shessh\",\"first_name\":\"anyare\",\"middle_name\":\"ufuw\",\"last_name\":\"uwuugfgu\",\"course\":\"dugugdu\",\"object_img\":null}}', NULL, '2024-09-12 08:14:55', '2024-09-12 08:14:55'),
(478, 'default', 'deleted a Lost and Found Information on id number 29', 'App\\Models\\Lost', 'deleted', 29, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":6,\"object_type\":\"Iphone pro max\",\"first_name\":\"Monkey\",\"middle_name\":\"D\",\"last_name\":\"Luffy\",\"course\":\"BSIT\",\"object_img\":null}}', NULL, '2024-09-12 08:15:00', '2024-09-12 08:15:00'),
(479, 'default', 'deleted a Lost and Found Information on id number 30', 'App\\Models\\Lost', 'deleted', 30, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":6,\"object_type\":\"yfyfy\",\"first_name\":\"ttt\",\"middle_name\":\"rt\",\"last_name\":\"tertt\",\"course\":\"yryyry\",\"object_img\":null}}', NULL, '2024-09-12 08:15:06', '2024-09-12 08:15:06'),
(480, 'default', 'updated a Event Information on ID number 41', 'App\\Models\\Event', 'updated', 41, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"Crim hope\",\"description\":\"tommorow 8 am to 5 pm\"},\"old\":{\"title\":\"pasok\",\"description\":\"tommor 8 am\"}}', NULL, '2024-09-12 08:16:01', '2024-09-12 08:16:01'),
(481, 'default', 'created a Visitor information on ID number 63', 'App\\Models\\Visitor', 'created', 63, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-09-12\",\"first_name\":\"lea mae\",\"middle_name\":\"V\",\"last_name\":\"cruz\",\"person_to_visit\":\"Cite\",\"purpose\":\"clearance\",\"time_in\":\"17:29:36\",\"remarks\":null,\"time_out\":null,\"id_type\":\"National ID\"}}', NULL, '2024-09-12 09:29:37', '2024-09-12 09:29:37'),
(482, 'default', 'updated a Visitor information on ID number 63', 'App\\Models\\Visitor', 'updated', 63, 'App\\Models\\User', 1, '{\"attributes\":{\"time_out\":\"17:29:53\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-12 09:29:53', '2024-09-12 09:29:53'),
(483, 'default', 'created a Violation information on ID number 18', 'App\\Models\\Violation', 'created', 18, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"20212809\",\"first_name\":\"lea mae\",\"middle_initial\":null,\"last_name\":\"cruz\",\"course\":\"BSIT\",\"violation_type\":\"Inapropriate Cloths\",\"date\":\"2024-09-12\"}}', NULL, '2024-09-12 09:35:13', '2024-09-12 09:35:13'),
(484, 'default', 'deleted a Event Information on ID number 8', 'App\\Models\\Event', 'deleted', 8, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"Events\",\"description\":\"this event is about feb-ibig kaya asahan nating maraming mga broken\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":\"2024-08-29T16:00:00.000000Z\"}}', NULL, '2024-09-12 10:52:48', '2024-09-12 10:52:48'),
(485, 'default', 'deleted a Event Information on ID number 39', 'App\\Models\\Event', 'deleted', 39, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"David\",\"description\":\"Nice\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-12 10:52:57', '2024-09-12 10:52:57'),
(486, 'default', 'created a Visitor information on ID number 64', 'App\\Models\\Visitor', 'created', 64, 'App\\Models\\User', 6, '{\"attributes\":{\"user_id\":6,\"date\":\"2024-09-12\",\"first_name\":\"yfyfs\",\"middle_name\":\"f\",\"last_name\":\"dwy\",\"person_to_visit\":\"yfdfqyf\",\"purpose\":\"yffdfy\",\"time_in\":\"19:10:25\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-12 11:10:25', '2024-09-12 11:10:25'),
(487, 'default', 'updated a Visitor information on ID number 64', 'App\\Models\\Visitor', 'updated', 64, 'App\\Models\\User', 6, '{\"attributes\":{\"time_out\":\"19:10:51\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-12 11:10:51', '2024-09-12 11:10:51'),
(488, 'default', 'created a Visitor information on ID number 65', 'App\\Models\\Visitor', 'created', 65, 'App\\Models\\User', 6, '{\"attributes\":{\"user_id\":6,\"date\":\"2024-09-12\",\"first_name\":\"lea mae\",\"middle_name\":\"V\",\"last_name\":\"cruz\",\"person_to_visit\":\"Cite\",\"purpose\":\"clearance\",\"time_in\":\"19:11:43\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Driver License ID\"}}', NULL, '2024-09-12 11:11:43', '2024-09-12 11:11:43'),
(489, 'default', 'created a Lost and Found Information on id number 31', 'App\\Models\\Lost', 'created', 31, 'App\\Models\\User', 6, '{\"attributes\":{\"user_id\":6,\"object_type\":\"Iphone 15 pro max\",\"first_name\":\"David Earl Gabriel\",\"middle_name\":null,\"last_name\":\"Garcia\",\"course\":\"BSIT\",\"object_img\":\"\\/storage\\/lost_images\\/1726140082_face-scan.png\"}}', NULL, '2024-09-12 11:21:23', '2024-09-12 11:21:23'),
(490, 'default', 'updated a Visitor information on ID number 65', 'App\\Models\\Visitor', 'updated', 65, 'App\\Models\\User', 6, '{\"attributes\":{\"time_out\":\"14:09:35\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-13 06:09:35', '2024-09-13 06:09:35'),
(491, 'default', 'created a Visitor information on ID number 66', 'App\\Models\\Visitor', 'created', 66, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-09-13\",\"first_name\":\"sgyqsgy\",\"middle_name\":\"gycygy\",\"last_name\":\"David\",\"person_to_visit\":\"yygyyqyggy\",\"purpose\":\"gygydgqysyggy\",\"time_in\":\"18:58:54\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Driver License ID\"}}', NULL, '2024-09-13 10:58:54', '2024-09-13 10:58:54'),
(492, 'default', 'updated a Visitor information on ID number 66', 'App\\Models\\Visitor', 'updated', 66, 'App\\Models\\User', 1, '{\"attributes\":{\"time_out\":\"19:01:26\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-13 11:01:26', '2024-09-13 11:01:26'),
(493, 'default', 'created a Visitor information on ID number 67', 'App\\Models\\Visitor', 'created', 67, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-09-13\",\"first_name\":\"guguwugugu\",\"middle_name\":\"guwgugwgu\",\"last_name\":\"hcuwug\",\"person_to_visit\":\"ugugwugcgu\",\"purpose\":\"ugiheiciwhi\",\"time_in\":\"19:04:33\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Driver License ID\"}}', NULL, '2024-09-13 11:04:33', '2024-09-13 11:04:33'),
(494, 'default', 'created a Visitor information on ID number 68', 'App\\Models\\Visitor', 'created', 68, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-09-13\",\"first_name\":\"guguwugugu\",\"middle_name\":\"guwgugwgu\",\"last_name\":\"hcuwug\",\"person_to_visit\":\"ugugwugcgu\",\"purpose\":\"ugiheiciwhi\",\"time_in\":\"19:08:59\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Driver License ID\"}}', NULL, '2024-09-13 11:08:59', '2024-09-13 11:08:59');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(495, 'default', 'created a Visitor information on ID number 69', 'App\\Models\\Visitor', 'created', 69, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-09-13\",\"first_name\":\"guguwugugu\",\"middle_name\":\"guwgugwgu\",\"last_name\":\"hcuwug\",\"person_to_visit\":\"ugugwugcgu\",\"purpose\":\"ugiheiciwhi\",\"time_in\":\"19:09:22\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Driver License ID\"}}', NULL, '2024-09-13 11:09:22', '2024-09-13 11:09:22'),
(496, 'default', 'created a Visitor information on ID number 70', 'App\\Models\\Visitor', 'created', 70, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-09-13\",\"first_name\":\"ijrfhuhuuh\",\"middle_name\":\"ubefb\",\"last_name\":\"uvbub\",\"person_to_visit\":\"uheuhf4uhuhu\",\"purpose\":\"uhuefhuuhu\",\"time_in\":\"19:11:02\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-13 11:11:02', '2024-09-13 11:11:02'),
(497, 'default', 'updated a Visitor information on ID number 69', 'App\\Models\\Visitor', 'updated', 69, 'App\\Models\\User', 1, '{\"attributes\":{\"time_out\":\"19:11:22\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-13 11:11:22', '2024-09-13 11:11:22'),
(498, 'default', 'created a Visitor information on ID number 71', 'App\\Models\\Visitor', 'created', 71, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-09-13\",\"first_name\":\"nuufbu\",\"middle_name\":\"uubuvbub\",\"last_name\":\"jnenuenu\",\"person_to_visit\":\"ububwcubu\",\"purpose\":\"ubuenuevu\",\"time_in\":\"19:12:17\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Driver License ID\"}}', NULL, '2024-09-13 11:12:17', '2024-09-13 11:12:17'),
(499, 'default', 'created a Visitor information on ID number 72', 'App\\Models\\Visitor', 'created', 72, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-09-13\",\"first_name\":\"nuufbu\",\"middle_name\":\"uubuvbub\",\"last_name\":\"jnenuenu\",\"person_to_visit\":\"ububwcubu\",\"purpose\":\"ubuenuevu\",\"time_in\":\"19:16:20\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Driver License ID\"}}', NULL, '2024-09-13 11:16:20', '2024-09-13 11:16:20'),
(500, 'default', 'created a Visitor information on ID number 73', 'App\\Models\\Visitor', 'created', 73, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-09-13\",\"first_name\":\"guguegu\",\"middle_name\":\"gugucububuBU\",\"last_name\":\"ugueuegu\",\"person_to_visit\":\"UBUBub\",\"purpose\":\"ububcubub\",\"time_in\":\"19:17:03\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-13 11:17:03', '2024-09-13 11:17:03'),
(501, 'default', 'created a Visitor information on ID number 74', 'App\\Models\\Visitor', 'created', 74, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-09-13\",\"first_name\":\"guguegu\",\"middle_name\":\"gugucububuBU\",\"last_name\":\"ugueuegu\",\"person_to_visit\":\"UBUBub\",\"purpose\":\"ububcubub\",\"time_in\":\"19:17:18\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-13 11:17:18', '2024-09-13 11:17:18'),
(502, 'default', 'created a Visitor information on ID number 75', 'App\\Models\\Visitor', 'created', 75, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-09-13\",\"first_name\":\"guguegu\",\"middle_name\":\"gugucububuBU\",\"last_name\":\"ugueuegu\",\"person_to_visit\":\"UBUBub\",\"purpose\":\"ububcubub\",\"time_in\":\"19:17:39\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-13 11:17:39', '2024-09-13 11:17:39'),
(503, 'default', 'created a Visitor information on ID number 76', 'App\\Models\\Visitor', 'created', 76, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-09-13\",\"first_name\":\"uhuhcuhwuhUHUHW\",\"middle_name\":\"UHUHCUH\",\"last_name\":\"uheuchuh\",\"person_to_visit\":\"Uhecuheuheu\",\"purpose\":\"UHUHWCUH\",\"time_in\":\"19:19:40\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Driver License ID\"}}', NULL, '2024-09-13 11:19:40', '2024-09-13 11:19:40'),
(504, 'default', 'created a Pass Slip information on ID number 21', 'App\\Models\\PassSlip', 'created', 21, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"p_no\":\"P-20240913-3\",\"first_name\":\"ubuubdu\",\"middle_name\":null,\"last_name\":\"en3ubub\",\"department\":\"ububdu3bub\",\"designation\":\"ubudbub\",\"destination\":\"ububudbu\",\"date\":\"2024-09-12T16:00:00.000000Z\",\"time_in\":null,\"time_out\":\"19:21:00\",\"empployee_type\":null,\"purpose\":\"bwudbubd3\"}}', NULL, '2024-09-13 11:22:01', '2024-09-13 11:22:01'),
(505, 'default', 'created a Parking information on license number i3hfih3ih', 'App\\Models\\Parking', 'created', 14, 'App\\Models\\User', 2, '{\"attributes\":{\"license_no\":\"i3hfih3ih\",\"first_name\":\"ojoqdojo\",\"middle_name\":\"jjdj\",\"last_name\":\"ojodjoj\",\"date_registered\":\"2024-09-13\",\"expiration_date\":\"2025-09-13\",\"license_photo\":null,\"course\":\"oodjojodj\",\"license_exp_date\":\"2024-09-27\",\"dl_codes\":\"ihihidiw\",\"plate_no\":\"3iihi\",\"cr_no\":\"ihih2id\",\"cr_date_register\":\"2024-09-13\",\"vehicle_type\":\"hiihihihi\",\"vehicle_image\":null,\"sticker_id\":\"ojowjo\"}}', NULL, '2024-09-13 11:24:23', '2024-09-13 11:24:23'),
(506, 'default', 'created a Parking information on license number ojwiwojwij', 'App\\Models\\Parking', 'created', 15, 'App\\Models\\User', 2, '{\"attributes\":{\"license_no\":\"ojwiwojwij\",\"first_name\":\"ihi\",\"middle_name\":\"hihiwif\",\"last_name\":\"ihihei\",\"date_registered\":\"2992-03-18\",\"expiration_date\":\"2993-03-18\",\"license_photo\":null,\"course\":\"ihhwiwifhi\",\"license_exp_date\":\"8383-03-08\",\"dl_codes\":\"jijijifjijqijiji\",\"plate_no\":\"ihwfh\",\"cr_no\":\"hihfhihi\",\"cr_date_register\":\"7237-04-07\",\"vehicle_type\":\"hihfihi\",\"vehicle_image\":null,\"sticker_id\":\"iheifhwihi\"}}', NULL, '2024-09-13 11:29:26', '2024-09-13 11:29:26'),
(507, 'default', 'created a Visitor information on ID number 77', 'App\\Models\\Visitor', 'created', 77, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-09-13\",\"first_name\":\"ubbudbu\",\"middle_name\":\"bubdbu\",\"last_name\":\"wudb\",\"person_to_visit\":\"ubdbububu\",\"purpose\":\"ubwbubdu\",\"time_in\":\"19:35:14\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-13 11:35:14', '2024-09-13 11:35:14'),
(508, 'default', 'created a Visitor information on ID number 78', 'App\\Models\\Visitor', 'created', 78, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-09-13\",\"first_name\":\"bubfbub\",\"middle_name\":\"bbfbu\",\"last_name\":\"fubf\",\"person_to_visit\":\"bbdubwbu\",\"purpose\":\"buwbub\",\"time_in\":\"19:39:56\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-13 11:39:56', '2024-09-13 11:39:56'),
(509, 'default', 'updated a Visitor information on ID number 77', 'App\\Models\\Visitor', 'updated', 77, 'App\\Models\\User', 1, '{\"attributes\":{\"time_out\":\"19:40:05\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-13 11:40:05', '2024-09-13 11:40:05'),
(510, 'default', 'updated a Visitor information on ID number 78', 'App\\Models\\Visitor', 'updated', 78, 'App\\Models\\User', 1, '{\"attributes\":{\"time_out\":\"19:40:11\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-13 11:40:11', '2024-09-13 11:40:11'),
(511, 'default', 'updated a Visitor information on ID number 76', 'App\\Models\\Visitor', 'updated', 76, 'App\\Models\\User', 1, '{\"attributes\":{\"time_out\":\"19:40:18\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-13 11:40:18', '2024-09-13 11:40:18'),
(512, 'default', 'updated a Visitor information on ID number 70', 'App\\Models\\Visitor', 'updated', 70, 'App\\Models\\User', 1, '{\"attributes\":{\"time_out\":\"19:41:58\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-13 11:41:58', '2024-09-13 11:41:58'),
(513, 'default', 'updated a Visitor information on ID number 72', 'App\\Models\\Visitor', 'updated', 72, 'App\\Models\\User', 1, '{\"attributes\":{\"time_out\":\"19:41:59\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-13 11:42:00', '2024-09-13 11:42:00'),
(514, 'default', 'updated a Visitor information on ID number 75', 'App\\Models\\Visitor', 'updated', 75, 'App\\Models\\User', 1, '{\"attributes\":{\"time_out\":\"19:42:01\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-13 11:42:01', '2024-09-13 11:42:01'),
(515, 'default', 'created a Visitor information on ID number 79', 'App\\Models\\Visitor', 'created', 79, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-09-13\",\"first_name\":\"bubdubwubub\",\"middle_name\":\"uubdubbudu\",\"last_name\":\"wdubwubu\",\"person_to_visit\":\"bubdubdub\",\"purpose\":\"ubbudbwubbu\",\"time_in\":\"19:46:59\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-13 11:46:59', '2024-09-13 11:46:59'),
(516, 'default', 'created a Lost and Found Information on id number 32', 'App\\Models\\Lost', 'created', 32, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"object_type\":\"ijitji3ii\",\"first_name\":\"jjeijij\",\"middle_name\":\"iijetj3hbh\",\"last_name\":\"hbhbhubbue\",\"course\":\"ububrubub\",\"object_img\":null}}', NULL, '2024-09-13 11:48:12', '2024-09-13 11:48:12'),
(517, 'default', 'created a Violation information on ID number 19', 'App\\Models\\Violation', 'created', 19, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"gyyf\",\"first_name\":\"tstsrs3\",\"middle_initial\":null,\"last_name\":\"rsrsrsr\",\"course\":\"rrerr\",\"violation_type\":\"No ID\",\"date\":\"2024-09-13\"}}', NULL, '2024-09-13 12:23:33', '2024-09-13 12:23:33'),
(518, 'default', 'created a Violation information on ID number 20', 'App\\Models\\Violation', 'created', 20, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"ef3ww\",\"first_name\":\"wfewfwf\",\"middle_initial\":\"f\",\"last_name\":\"efwf\",\"course\":\"wfwfw\",\"violation_type\":\"No ID\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-13 12:26:00', '2024-09-13 12:26:00'),
(519, 'default', 'deleted a Violation information on ID number 20', 'App\\Models\\Violation', 'deleted', 20, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"student_no\":\"ef3ww\",\"first_name\":\"wfewfwf\",\"middle_initial\":\"f\",\"last_name\":\"efwf\",\"course\":\"wfwfw\",\"violation_type\":\"No ID\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-13 12:26:15', '2024-09-13 12:26:15'),
(520, 'default', 'created a Violation information on ID number 21', 'App\\Models\\Violation', 'created', 21, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"797975\",\"first_name\":\"guegfu\",\"middle_initial\":\"geugfug\",\"last_name\":\"ugfu\",\"course\":\"guwfug\",\"violation_type\":\"No ID\",\"date\":\"2024-09-13\"}}', NULL, '2024-09-13 12:28:28', '2024-09-13 12:28:28'),
(521, 'default', 'created a Violation information on ID number 22', 'App\\Models\\Violation', 'created', 22, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"8y384\",\"first_name\":\"yywfy\",\"middle_initial\":\"yfywfyf\",\"last_name\":\"yryyg\",\"course\":\"yywffyfy\",\"violation_type\":\"No ID\",\"date\":\"2024-09-13\"}}', NULL, '2024-09-13 12:54:42', '2024-09-13 12:54:42'),
(522, 'default', 'created a Violation information on ID number 23', 'App\\Models\\Violation', 'created', 23, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"992r4927\",\"first_name\":\"gudgugu\",\"middle_initial\":\"gu\",\"last_name\":\"uguwdu\",\"course\":\"ugugdugdu\",\"violation_type\":\"No ID\",\"date\":\"2024-09-13\"}}', NULL, '2024-09-13 13:20:14', '2024-09-13 13:20:14'),
(523, 'default', 'created a Violation information on ID number 24', 'App\\Models\\Violation', 'created', 24, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"2u9\",\"first_name\":\"uggfu\",\"middle_initial\":\"ugqguu\",\"last_name\":\"uugwfu\",\"course\":\"ugugfu\",\"violation_type\":\"No ID\",\"date\":\"2024-09-13\"}}', NULL, '2024-09-13 13:24:04', '2024-09-13 13:24:04'),
(524, 'default', 'created a Violation information on ID number 25', 'App\\Models\\Violation', 'created', 25, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"747249\",\"first_name\":\"gydg\",\"middle_initial\":\"ygdy\",\"last_name\":\"ygwdygy\",\"course\":\"ygydyyg\",\"violation_type\":\"No ID\",\"date\":\"2024-09-13\"}}', NULL, '2024-09-13 13:25:35', '2024-09-13 13:25:35'),
(525, 'default', 'created a Violation information on ID number 26', 'App\\Models\\Violation', 'created', 26, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"826h\",\"first_name\":\"ugduugfug\",\"middle_initial\":\"gufu\",\"last_name\":\"uwdug\",\"course\":\"gufqugddgu\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-13 18:01:33', '2024-09-13 18:01:33'),
(526, 'default', 'created a Violation information on ID number 27', 'App\\Models\\Violation', 'created', 27, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"7348778\",\"first_name\":\"uugu\",\"middle_initial\":\"gugugc\",\"last_name\":\"u3uggug\",\"course\":\"uguvug\",\"violation_type\":\"No ID\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-13 18:06:30', '2024-09-13 18:06:30'),
(527, 'default', 'created a Violation information on ID number 28', 'App\\Models\\Violation', 'created', 28, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"u2u2hu\",\"first_name\":\"jebuf\",\"middle_initial\":\"ufuh\",\"last_name\":\"uhuwfhu\",\"course\":\"hqu\",\"violation_type\":\"No ID\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-13 18:12:59', '2024-09-13 18:12:59'),
(528, 'default', 'deleted a Violation information on ID number 28', 'App\\Models\\Violation', 'deleted', 28, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"student_no\":\"u2u2hu\",\"first_name\":\"jebuf\",\"middle_initial\":\"ufuh\",\"last_name\":\"uhuwfhu\",\"course\":\"hqu\",\"violation_type\":\"No ID\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-13 18:13:21', '2024-09-13 18:13:21'),
(529, 'default', 'created a Violation information on ID number 29', 'App\\Models\\Violation', 'created', 29, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"2813183\",\"first_name\":\"uud`h\",\"middle_initial\":\"uhuhhu\",\"last_name\":\"Shessh gumana ba\",\"course\":\"hufuhu\",\"violation_type\":\"No ID\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-13 18:13:53', '2024-09-13 18:13:53'),
(530, 'default', 'created a Violation information on ID number 30', 'App\\Models\\Violation', 'created', 30, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"728468\",\"first_name\":\"yygfgyfyg\",\"middle_initial\":\"shesshahahah\",\"last_name\":\"gwfyg\",\"course\":\"jwufqg\",\"violation_type\":\"No ID\",\"date\":\"2024-09-07\"}}', NULL, '2024-09-13 18:17:26', '2024-09-13 18:17:26'),
(531, 'default', 'created a Violation information on ID number 31', 'App\\Models\\Violation', 'created', 31, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"64684257\",\"first_name\":\"ufg Haghaha\",\"middle_initial\":\"haha\",\"last_name\":\"david\",\"course\":\"BSIT\",\"violation_type\":\"Inapropriate Cloths\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-13 18:20:07', '2024-09-13 18:20:07'),
(532, 'default', 'created a Violation information on ID number 32', 'App\\Models\\Violation', 'created', 32, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"64684257\",\"first_name\":\"ufg Haghaha\",\"middle_initial\":\"haha\",\"last_name\":\"david\",\"course\":\"BSIT\",\"violation_type\":\"Inapropriate Cloths\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-13 18:22:08', '2024-09-13 18:22:08'),
(533, 'default', 'created a Violation information on ID number 33', 'App\\Models\\Violation', 'created', 33, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"ihefihwfh\",\"first_name\":\"Jimuel\",\"middle_initial\":null,\"last_name\":\"Bautista\",\"course\":\"BSIT\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-07\"}}', NULL, '2024-09-13 18:22:45', '2024-09-13 18:22:45'),
(534, 'default', 'deleted a Violation information on ID number 33', 'App\\Models\\Violation', 'deleted', 33, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"student_no\":\"ihefihwfh\",\"first_name\":\"Jimuel\",\"middle_initial\":null,\"last_name\":\"Bautista\",\"course\":\"BSIT\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-07\"}}', NULL, '2024-09-13 18:23:12', '2024-09-13 18:23:12'),
(535, 'default', 'deleted a Violation information on ID number 32', 'App\\Models\\Violation', 'deleted', 32, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"student_no\":\"64684257\",\"first_name\":\"ufg Haghaha\",\"middle_initial\":\"haha\",\"last_name\":\"david\",\"course\":\"BSIT\",\"violation_type\":\"Inapropriate Cloths\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-13 18:23:18', '2024-09-13 18:23:18'),
(536, 'default', 'deleted a Violation information on ID number 30', 'App\\Models\\Violation', 'deleted', 30, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"student_no\":\"728468\",\"first_name\":\"yygfgyfyg\",\"middle_initial\":\"shesshahahah\",\"last_name\":\"gwfyg\",\"course\":\"jwufqg\",\"violation_type\":\"No ID\",\"date\":\"2024-09-07\"}}', NULL, '2024-09-13 18:23:25', '2024-09-13 18:23:25'),
(537, 'default', 'created a Violation information on ID number 34', 'App\\Models\\Violation', 'created', 34, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"20103028\",\"first_name\":\"Jimuel\",\"middle_initial\":null,\"last_name\":\"Baitista\",\"course\":\"Crim\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-13 18:30:13', '2024-09-13 18:30:13'),
(538, 'default', 'created a Violation information on ID number 35', 'App\\Models\\Violation', 'created', 35, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"uefeh\",\"first_name\":\"uu\",\"middle_initial\":\"huhfhu\",\"last_name\":\"uhuehu\",\"course\":\"hfuhufwu\",\"violation_type\":\"No ID\",\"date\":\"2024-09-07\"}}', NULL, '2024-09-13 18:32:14', '2024-09-13 18:32:14'),
(539, 'default', 'created a Violation information on ID number 36', 'App\\Models\\Violation', 'created', 36, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"ihihriih\",\"first_name\":\"hiwhhifhih\",\"middle_initial\":\"hiwhidhiq\",\"last_name\":\"ihwifi\",\"course\":\"BSIT\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-21\"}}', NULL, '2024-09-13 18:32:50', '2024-09-13 18:32:50'),
(540, 'default', 'deleted a Violation information on ID number 36', 'App\\Models\\Violation', 'deleted', 36, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"student_no\":\"ihihriih\",\"first_name\":\"hiwhhifhih\",\"middle_initial\":\"hiwhidhiq\",\"last_name\":\"ihwifi\",\"course\":\"BSIT\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-21\"}}', NULL, '2024-09-13 18:33:18', '2024-09-13 18:33:18'),
(541, 'default', 'created a Violation information on ID number 37', 'App\\Models\\Violation', 'created', 37, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"wdwwdw\",\"first_name\":\"dwwd\",\"middle_initial\":\"ddwwd\",\"last_name\":\"wdwdwd\",\"course\":\"fwwdwdwd\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-07\"}}', NULL, '2024-09-13 18:37:01', '2024-09-13 18:37:01'),
(542, 'default', 'created a Violation information on ID number 38', 'App\\Models\\Violation', 'created', 38, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"whih\",\"first_name\":\"hihwih\",\"middle_initial\":\"ihihwfhi\",\"last_name\":\"ihihfiqhi\",\"course\":\"ihih\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-07\"}}', NULL, '2024-09-13 18:38:59', '2024-09-13 18:38:59'),
(543, 'default', 'created a Violation information on ID number 39', 'App\\Models\\Violation', 'created', 39, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"hduhhw\",\"first_name\":\"uhuhfu\",\"middle_initial\":\"fg\",\"last_name\":\"uhfh\",\"course\":\"gfwfgufg\",\"violation_type\":\"No ID\",\"date\":\"2024-09-07\"}}', NULL, '2024-09-13 18:41:22', '2024-09-13 18:41:22'),
(544, 'default', 'deleted a Violation information on ID number 39', 'App\\Models\\Violation', 'deleted', 39, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"student_no\":\"hduhhw\",\"first_name\":\"uhuhfu\",\"middle_initial\":\"fg\",\"last_name\":\"uhfh\",\"course\":\"gfwfgufg\",\"violation_type\":\"No ID\",\"date\":\"2024-09-07\"}}', NULL, '2024-09-13 18:41:42', '2024-09-13 18:41:42'),
(545, 'default', 'created a Violation information on ID number 40', 'App\\Models\\Violation', 'created', 40, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"938380\",\"first_name\":\"ygwcyg\",\"middle_initial\":\"yygcyg\",\"last_name\":\"yydgy\",\"course\":\"ygywcgycgy\",\"violation_type\":\"No ID\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-14 03:44:33', '2024-09-14 03:44:33'),
(546, 'default', 'created a Violation information on ID number 41', 'App\\Models\\Violation', 'created', 41, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"938380\",\"first_name\":\"ygwcyg\",\"middle_initial\":\"yygcyg\",\"last_name\":\"yydgy\",\"course\":\"ygywcgycgy\",\"violation_type\":\"No ID\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-14 03:44:35', '2024-09-14 03:44:35'),
(547, 'default', 'created a Violation information on ID number 42', 'App\\Models\\Violation', 'created', 42, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"938380\",\"first_name\":\"ygwcyg\",\"middle_initial\":\"yygcyg\",\"last_name\":\"yydgy\",\"course\":\"ygywcgycgy\",\"violation_type\":\"No ID\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-14 03:44:37', '2024-09-14 03:44:37'),
(548, 'default', 'deleted a Violation information on ID number 38', 'App\\Models\\Violation', 'deleted', 38, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"student_no\":\"whih\",\"first_name\":\"hihwih\",\"middle_initial\":\"ihihwfhi\",\"last_name\":\"ihihfiqhi\",\"course\":\"ihih\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-07\"}}', NULL, '2024-09-14 03:47:48', '2024-09-14 03:47:48'),
(549, 'default', 'deleted a Violation information on ID number 37', 'App\\Models\\Violation', 'deleted', 37, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"student_no\":\"wdwwdw\",\"first_name\":\"dwwd\",\"middle_initial\":\"ddwwd\",\"last_name\":\"wdwdwd\",\"course\":\"fwwdwdwd\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-07\"}}', NULL, '2024-09-14 03:47:54', '2024-09-14 03:47:54'),
(550, 'default', 'created a Violation information on ID number 43', 'App\\Models\\Violation', 'created', 43, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"729799\",\"first_name\":\"uhud\",\"middle_initial\":\"ydv\",\"last_name\":\"huuheu\",\"course\":\"vydv\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-21\"}}', NULL, '2024-09-14 04:08:30', '2024-09-14 04:08:30'),
(551, 'default', 'created a Violation information on ID number 44', 'App\\Models\\Violation', 'created', 44, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"dygy\",\"first_name\":\"gygyfg\",\"middle_initial\":\"g\",\"last_name\":\"gywy\",\"course\":\"ggyqg\",\"violation_type\":\"No ID\",\"date\":\"2024-09-13\"}}', NULL, '2024-09-14 04:15:46', '2024-09-14 04:15:46'),
(552, 'default', 'created a Violation information on ID number 45', 'App\\Models\\Violation', 'created', 45, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"dygy\",\"first_name\":\"gygyfg\",\"middle_initial\":\"g\",\"last_name\":\"gywy\",\"course\":\"ggyqg\",\"violation_type\":\"No ID\",\"date\":\"2024-09-13\"}}', NULL, '2024-09-14 04:16:52', '2024-09-14 04:16:52'),
(553, 'default', 'created a Violation information on ID number 46', 'App\\Models\\Violation', 'created', 46, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"yeyg\",\"first_name\":\"ygsyg\",\"middle_initial\":\"ygyg\",\"last_name\":\"yg\",\"course\":\"gydgg\",\"violation_type\":\"No ID\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-14 04:17:23', '2024-09-14 04:17:23'),
(554, 'default', 'created a Violation information on ID number 47', 'App\\Models\\Violation', 'created', 47, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"20214040\",\"first_name\":\"David Earl Gabriel\",\"middle_initial\":\"D\",\"last_name\":\"Garcia\",\"course\":\"BSIT\",\"violation_type\":\"Inapropriate Cloths\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-14 04:18:11', '2024-09-14 04:18:11'),
(555, 'default', 'created a Violation information on ID number 48', 'App\\Models\\Violation', 'created', 48, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"728\",\"first_name\":\"yyqdgy\",\"middle_initial\":\"gyd\",\"last_name\":\"gywg\",\"course\":\"pusang gala kasi\",\"violation_type\":\"No ID\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-14 04:21:48', '2024-09-14 04:21:48'),
(556, 'default', 'created a Violation information on ID number 49', 'App\\Models\\Violation', 'created', 49, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"iehfihi\",\"first_name\":\"ihihh\",\"middle_initial\":\"ihwhih\",\"last_name\":\"hihe\",\"course\":\"hwdihwdh\",\"violation_type\":\"No ID\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-14 14:50:03', '2024-09-14 14:50:03'),
(557, 'default', 'created a Violation information on ID number 50', 'App\\Models\\Violation', 'created', 50, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"iehfihi\",\"first_name\":\"ihihh\",\"middle_initial\":\"ihwhih\",\"last_name\":\"hihe\",\"course\":\"hwdihwdh\",\"violation_type\":\"No ID\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-14 14:50:21', '2024-09-14 14:50:21'),
(558, 'default', 'created a Violation information on ID number 51', 'App\\Models\\Violation', 'created', 51, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"iehfihi\",\"first_name\":\"ihihh\",\"middle_initial\":\"ihwhih\",\"last_name\":\"hihe\",\"course\":\"hwdihwdh\",\"violation_type\":\"No ID\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-14 14:50:32', '2024-09-14 14:50:32'),
(559, 'default', 'created a Violation information on ID number 52', 'App\\Models\\Violation', 'created', 52, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"uuhu3\",\"first_name\":\"uhhfuh\",\"middle_initial\":\"hufhu\",\"last_name\":\"huhhf\",\"course\":\"hhfuh3\",\"violation_type\":\"No ID\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-14 14:52:51', '2024-09-14 14:52:51'),
(560, 'default', 'created a Violation information on ID number 53', 'App\\Models\\Violation', 'created', 53, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"uhr3huu\",\"first_name\":\"he\",\"middle_initial\":\"hfuhuu\",\"last_name\":\"uhehu\",\"course\":\"huhur\",\"violation_type\":\"No ID\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-14 14:55:19', '2024-09-14 14:55:19'),
(561, 'default', 'created a Violation information on ID number 54', 'App\\Models\\Violation', 'created', 54, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"ey2uye\",\"first_name\":\"uyyeyuY\",\"middle_initial\":\"YEUYYEUY\",\"last_name\":\"uyu2y\",\"course\":\"yu2yeuyu\",\"violation_type\":\"No ID\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-14 14:56:32', '2024-09-14 14:56:32'),
(562, 'default', 'created a Violation information on ID number 55', 'App\\Models\\Violation', 'created', 55, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"udgwydgy\",\"first_name\":\"gqdgy\",\"middle_initial\":\"gdy\",\"last_name\":\"gydgdg\",\"course\":\"gywg\",\"violation_type\":\"No ID\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-14 14:58:23', '2024-09-14 14:58:23'),
(563, 'default', 'created a Violation information on ID number 56', 'App\\Models\\Violation', 'created', 56, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"2ye82ye\",\"first_name\":\"vhvdhvhd\",\"middle_initial\":\"hvd\",\"last_name\":\"y8y2hvhv\",\"course\":\"hvhvh2v\",\"violation_type\":\"No ID\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-14 15:07:55', '2024-09-14 15:07:55'),
(564, 'default', 'created a Violation information on ID number 57', 'App\\Models\\Violation', 'created', 57, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"74624\",\"first_name\":\"plss gumana kana\",\"middle_initial\":\"po\",\"last_name\":\"lods\",\"course\":\"uhdudug2\",\"violation_type\":\"No ID\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-14 15:20:11', '2024-09-14 15:20:11'),
(565, 'default', 'created a Violation information on ID number 58', 'App\\Models\\Violation', 'created', 58, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"jbwhfwgu\",\"first_name\":\"niceB\",\"middle_initial\":\"UBUBFBU\",\"last_name\":\"uguguguf\",\"course\":\"UBFUB\",\"violation_type\":\"No ID\",\"date\":\"2024-09-15\"}}', NULL, '2024-09-15 07:11:07', '2024-09-15 07:11:07'),
(566, 'default', 'created a Violation information on ID number 59', 'App\\Models\\Violation', 'created', 59, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"hw247487\",\"first_name\":\"uqgg\",\"middle_initial\":\"uggqug\",\"last_name\":\"ngeks\",\"course\":\"gefugwfug\",\"violation_type\":\"No ID\",\"date\":\"2024-09-19\"}}', NULL, '2024-09-15 07:15:54', '2024-09-15 07:15:54'),
(567, 'default', 'created a Violation information on ID number 60', 'App\\Models\\Violation', 'created', 60, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"7924797\",\"first_name\":\"gana\",\"middle_initial\":\"na po\",\"last_name\":\"plss\",\"course\":\"iwudgugu\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-15\"}}', NULL, '2024-09-15 07:26:56', '2024-09-15 07:26:56'),
(568, 'default', 'created a Violation information on ID number 61', 'App\\Models\\Violation', 'created', 61, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"373778828\",\"first_name\":\"naman\",\"middle_initial\":\"idol\",\"last_name\":\"awit\",\"course\":\"ebyey\",\"violation_type\":\"No ID\",\"date\":\"2024-09-15\"}}', NULL, '2024-09-15 07:28:29', '2024-09-15 07:28:29'),
(569, 'default', 'created a Violation information on ID number 62', 'App\\Models\\Violation', 'created', 62, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"747297\",\"first_name\":\"ayaw\",\"middle_initial\":\"talaga\",\"last_name\":\"haha\",\"course\":\"BSIT\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-15\"}}', NULL, '2024-09-15 07:30:09', '2024-09-15 07:30:09'),
(570, 'default', 'created a Violation information on ID number 63', 'App\\Models\\Violation', 'created', 63, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"24928498\",\"first_name\":\"ihwifhw\",\"middle_initial\":\"ihfwihq\",\"last_name\":\"ngeks awit atalaga\",\"course\":\"vyvfvvwy\",\"violation_type\":\"No Uniform\",\"date\":\"2024-09-15\"}}', NULL, '2024-09-15 07:44:59', '2024-09-15 07:44:59'),
(571, 'default', 'created a Violation information on ID number 64', 'App\\Models\\Violation', 'created', 64, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"iefi\",\"first_name\":\"nice\",\"middle_initial\":\"gumana\",\"last_name\":\"iieiqhifh\",\"course\":\"ata\",\"violation_type\":\"Inapropriate Cloths\",\"date\":\"2024-09-15\"}}', NULL, '2024-09-15 07:47:16', '2024-09-15 07:47:16'),
(572, 'default', 'created a Violation information on ID number 65', 'App\\Models\\Violation', 'created', 65, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"97274979\",\"first_name\":\"hays\",\"middle_initial\":\"wjfjwnj\",\"last_name\":\"uufwkkjk\",\"course\":\"njejgn\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-15\"}}', NULL, '2024-09-15 07:55:18', '2024-09-15 07:55:18'),
(573, 'default', 'created a Violation information on ID number 66', 'App\\Models\\Violation', 'created', 66, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"ayaw talaga\",\"first_name\":\"uheufhwuuwhwuhwfu\",\"middle_initial\":\"uuwfuhwh\",\"last_name\":\"whduhwduhduh\",\"course\":\"uwhfuwhfuhduhd\",\"violation_type\":\"Inapropriate Cloths\",\"date\":\"2024-09-15\"}}', NULL, '2024-09-15 08:01:25', '2024-09-15 08:01:25'),
(574, 'default', 'created a Violation information on ID number 67', 'App\\Models\\Violation', 'created', 67, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"20214040\",\"first_name\":\"David Earl Gabriel\",\"middle_initial\":\"D\",\"last_name\":\"Garcia\",\"course\":\"BSIT\",\"violation_type\":\"Inapropriate Cloths\",\"date\":\"2024-09-16\"}}', NULL, '2024-09-16 04:30:16', '2024-09-16 04:30:16'),
(575, 'default', 'created a Event Information on ID number 53', 'App\\Models\\Event', 'created', 53, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"ihdvihi\",\"description\":\"ihiheh\",\"date_start\":\"2024-09-15T16:00:00.000000Z\",\"date_end\":\"2024-09-16T16:00:00.000000Z\"}}', NULL, '2024-09-16 07:37:25', '2024-09-16 07:37:25'),
(576, 'default', 'created a Event Information on ID number 54 title rgieihqihrgh ', 'App\\Models\\Event', 'created', 54, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"rgieihqihrgh\",\"description\":\"ihrhgihih\",\"date_start\":\"2024-09-15T16:00:00.000000Z\",\"date_end\":\"2024-09-09T16:00:00.000000Z\"}}', NULL, '2024-09-16 07:49:26', '2024-09-16 07:49:26'),
(577, 'default', 'created a Event Information on ID number 55 titled \'Bago lang\' ', 'App\\Models\\Event', 'created', 55, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"Bago lang\",\"description\":\"ggfgwggw\",\"date_start\":\"2024-09-16T16:00:00.000000Z\",\"date_end\":\"2024-09-17T16:00:00.000000Z\"}}', NULL, '2024-09-16 07:52:38', '2024-09-16 07:52:38'),
(578, 'default', 'created a Student Information on Student ID number 20214040', 'App\\Models\\Student', 'created', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"student_no\":\"20214040\",\"first_name\":\"David Earl Gabriel\",\"middle_name\":null,\"last_name\":\"Garcia\",\"course\":\"BSIT\"}}', NULL, '2024-09-16 15:47:22', '2024-09-16 15:47:22'),
(579, 'default', 'created a Student Information on Student ID number uguruGWFU', 'App\\Models\\Student', 'created', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"student_no\":\"uguruGWFU\",\"first_name\":\"gugf\",\"middle_name\":null,\"last_name\":\"uggegu\",\"course\":\"gufufw\"}}', NULL, '2024-09-16 16:00:31', '2024-09-16 16:00:31'),
(580, 'default', 'created a Employees information on ID number 020820 named \'uuhwuh\' ', 'App\\Models\\AllEmployee', 'created', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"employee_id\":\"020820\",\"first_name\":\"uuhwuh\",\"last_name\":\"hwudhu\",\"middle_name\":\"huh\",\"designation\":\"huhuf3hfu\",\"department\":\"uhfuh\",\"status\":\"Non-Teaching\"}}', NULL, '2024-09-16 17:01:18', '2024-09-16 17:01:18'),
(581, 'default', 'updated a Visitor information on ID number 79', 'App\\Models\\Visitor', 'updated', 79, 'App\\Models\\User', 1, '{\"attributes\":{\"time_out\":\"09:42:54\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-17 01:42:54', '2024-09-17 01:42:54'),
(582, 'default', 'updated a Announcement Information on ID number 55 titled \'Bago\' ', 'App\\Models\\Event', 'updated', 55, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"Bago\"},\"old\":{\"title\":\"Bago lang\"}}', NULL, '2024-09-17 10:00:55', '2024-09-17 10:00:55'),
(583, 'default', 'created a Announcement Information on ID number 56 titled \'juuugug\' ', 'App\\Models\\Event', 'created', 56, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"juuugug\",\"description\":\"ggugugucxyrxy\",\"date_start\":\"2024-09-16T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-17 10:07:40', '2024-09-17 10:07:40'),
(584, 'default', 'created a Violation information on ID number 68', 'App\\Models\\Violation', 'created', 68, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"84824008\",\"first_name\":\"gufug\",\"middle_initial\":\"ugfg\",\"last_name\":\"gefgu\",\"course\":\"gufggd\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-19\"}}', NULL, '2024-09-17 10:24:46', '2024-09-17 10:24:46'),
(585, 'default', 'created a Lost and Found Information on id number 33', 'App\\Models\\Lost', 'created', 33, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"object_type\":\"jbwduu\",\"first_name\":\"gueg\",\"middle_name\":\"ugegqugevug\",\"last_name\":\"uggfuw\",\"course\":\"guwguwgu\",\"object_img\":null}}', NULL, '2024-09-17 10:31:50', '2024-09-17 10:31:50'),
(586, 'default', 'deleted a Lost and Found Information on id number 33', 'App\\Models\\Lost', 'deleted', 33, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"object_type\":\"jbwduu\",\"first_name\":\"gueg\",\"middle_name\":\"ugegqugevug\",\"last_name\":\"uggfuw\",\"course\":\"guwguwgu\",\"object_img\":null}}', NULL, '2024-09-17 10:32:30', '2024-09-17 10:32:30'),
(587, 'default', 'created a Lost and Found Information on id number 34', 'App\\Models\\Lost', 'created', 34, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"object_type\":\"heu2u\",\"first_name\":\"yuy2u`uyuu\",\"middle_name\":\"uwuyu\",\"last_name\":\"yufyufy\",\"course\":\"yueyu\",\"object_img\":null}}', NULL, '2024-09-17 10:32:44', '2024-09-17 10:32:44'),
(588, 'default', 'created a Lost and Found Information on id number 35', 'App\\Models\\Lost', 'created', 35, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"object_type\":\"8784628\",\"first_name\":\"heufu\",\"middle_name\":\"h\",\"last_name\":\"uehguhqhu\",\"course\":\"heuhh\",\"object_img\":null}}', NULL, '2024-09-17 10:37:45', '2024-09-17 10:37:45'),
(589, 'default', 'created a Lost and Found Information on id number 36', 'App\\Models\\Lost', 'created', 36, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"object_type\":\"995739\",\"first_name\":\"ww\",\"middle_name\":\"hj\",\"last_name\":\"ngekss\",\"course\":\"jbsbj\",\"object_img\":null}}', NULL, '2024-09-17 10:39:43', '2024-09-17 10:39:43'),
(590, 'default', 'created a Lost and Found Information on id number 37', 'App\\Models\\Lost', 'created', 37, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"object_type\":\"3942947\",\"first_name\":\"awit\",\"middle_name\":\"ngay\",\"last_name\":\"nefwbhbh\",\"course\":\"hbwhfwh\",\"object_img\":null}}', NULL, '2024-09-17 10:40:51', '2024-09-17 10:40:51'),
(591, 'default', 'created a Lost and Found Information on id number 38', 'App\\Models\\Lost', 'created', 38, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"object_type\":\"271\",\"first_name\":\"uwgdugu\",\"middle_name\":\"ghwfhhhwf\",\"last_name\":\"hwudhu\",\"course\":\"hwfh hehehe\",\"object_img\":null}}', NULL, '2024-09-17 10:41:19', '2024-09-17 10:41:19'),
(592, 'default', 'created a Lost and Found Information on id number 39', 'App\\Models\\Lost', 'created', 39, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"object_type\":\"eufuwg\",\"first_name\":\"gugugwgu\",\"middle_name\":\"gufguwugu\",\"last_name\":\"gguwgu\",\"course\":\"guguwgu\",\"object_img\":null}}', NULL, '2024-09-17 10:45:29', '2024-09-17 10:45:29'),
(593, 'default', 'deleted a Lost and Found Information on id number 39', 'App\\Models\\Lost', 'deleted', 39, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"object_type\":\"eufuwg\",\"first_name\":\"gugugwgu\",\"middle_name\":\"gufguwugu\",\"last_name\":\"gguwgu\",\"course\":\"guguwgu\",\"object_img\":null}}', NULL, '2024-09-17 10:45:45', '2024-09-17 10:45:45'),
(594, 'default', 'deleted a Lost and Found Information on id number 38', 'App\\Models\\Lost', 'deleted', 38, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"object_type\":\"271\",\"first_name\":\"uwgdugu\",\"middle_name\":\"ghwfhhhwf\",\"last_name\":\"hwudhu\",\"course\":\"hwfh hehehe\",\"object_img\":null}}', NULL, '2024-09-17 10:45:55', '2024-09-17 10:45:55'),
(595, 'default', 'deleted a Lost and Found Information on id number 37', 'App\\Models\\Lost', 'deleted', 37, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"object_type\":\"3942947\",\"first_name\":\"awit\",\"middle_name\":\"ngay\",\"last_name\":\"nefwbhbh\",\"course\":\"hbwhfwh\",\"object_img\":null}}', NULL, '2024-09-17 10:46:03', '2024-09-17 10:46:03'),
(596, 'default', 'deleted a Lost and Found Information on id number 36', 'App\\Models\\Lost', 'deleted', 36, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"object_type\":\"995739\",\"first_name\":\"ww\",\"middle_name\":\"hj\",\"last_name\":\"ngekss\",\"course\":\"jbsbj\",\"object_img\":null}}', NULL, '2024-09-17 10:46:15', '2024-09-17 10:46:15'),
(597, 'default', 'deleted a Violation information on ID number 24', 'App\\Models\\Violation', 'deleted', 24, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"student_no\":\"2u9\",\"first_name\":\"uggfu\",\"middle_initial\":\"ugqguu\",\"last_name\":\"uugwfu\",\"course\":\"ugugfu\",\"violation_type\":\"No ID\",\"date\":\"2024-09-13\"}}', NULL, '2024-09-17 10:49:09', '2024-09-17 10:49:09'),
(598, 'default', 'deleted a Violation information on ID number 29', 'App\\Models\\Violation', 'deleted', 29, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"student_no\":\"2813183\",\"first_name\":\"uud`h\",\"middle_initial\":\"uhuhhu\",\"last_name\":\"Shessh gumana ba\",\"course\":\"hufuhu\",\"violation_type\":\"No ID\",\"date\":\"2024-09-14\"}}', NULL, '2024-09-17 10:49:16', '2024-09-17 10:49:16'),
(599, 'default', 'created a Violation information on ID number 69', 'App\\Models\\Violation', 'created', 69, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"20214040\",\"first_name\":\"David Earl Gabriel\",\"middle_initial\":\"D\",\"last_name\":\"Garcia\",\"course\":\"BSIT\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-17\"}}', NULL, '2024-09-17 11:11:46', '2024-09-17 11:11:46'),
(600, 'default', 'created a Student Information on Student ID number 829429', 'App\\Models\\Student', 'created', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"student_no\":\"829429\",\"first_name\":\"uggu\",\"middle_name\":null,\"last_name\":\"yuwuqugg\",\"course\":\"guwguwgu\"}}', NULL, '2024-09-17 11:44:19', '2024-09-17 11:44:19'),
(601, 'default', 'deleted a Student Information on Student ID number 829429', 'App\\Models\\Student', 'deleted', 3, 'App\\Models\\User', 1, '{\"old\":{\"student_no\":\"829429\",\"first_name\":\"uggu\",\"middle_name\":null,\"last_name\":\"yuwuqugg\",\"course\":\"guwguwgu\"}}', NULL, '2024-09-17 11:45:31', '2024-09-17 11:45:31'),
(602, 'default', 'deleted a Student Information on Student ID number uguruGWFU', 'App\\Models\\Student', 'deleted', 2, 'App\\Models\\User', 1, '{\"old\":{\"student_no\":\"uguruGWFU\",\"first_name\":\"gugf\",\"middle_name\":null,\"last_name\":\"uggegu\",\"course\":\"gufufw\"}}', NULL, '2024-09-17 11:45:39', '2024-09-17 11:45:39'),
(603, 'default', 'created a Student Information on Student ID number 9359', 'App\\Models\\Student', 'created', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"student_no\":\"9359\",\"first_name\":\"gugugu\",\"middle_name\":null,\"last_name\":\"ytwug\",\"course\":\"ugufgugu\"}}', NULL, '2024-09-17 11:48:04', '2024-09-17 11:48:04'),
(604, 'default', 'deleted a Student Information on Student ID number 9359', 'App\\Models\\Student', 'deleted', 4, 'App\\Models\\User', 1, '{\"old\":{\"student_no\":\"9359\",\"first_name\":\"gugugu\",\"middle_name\":null,\"last_name\":\"ytwug\",\"course\":\"ugufgugu\"}}', NULL, '2024-09-17 11:48:09', '2024-09-17 11:48:09'),
(605, 'default', 'created a Employees information on ID number u2eo2o named \'ouwh\' ', 'App\\Models\\AllEmployee', 'created', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"employee_id\":\"u2eo2o\",\"first_name\":\"ouwh\",\"last_name\":\"owouquo\",\"middle_name\":\"ihfi\",\"designation\":\"ihwhfiw\",\"department\":\"hihfhiwhi\",\"status\":\"Non-Teaching\"}}', NULL, '2024-09-17 11:56:45', '2024-09-17 11:56:45'),
(606, 'default', 'deleted a Employees information on ID number 020820 named \'uuhwuh\' ', 'App\\Models\\AllEmployee', 'deleted', 1, 'App\\Models\\User', 1, '{\"old\":{\"employee_id\":\"020820\",\"first_name\":\"uuhwuh\",\"last_name\":\"hwudhu\",\"middle_name\":\"huh\",\"designation\":\"huhuf3hfu\",\"department\":\"uhfuh\",\"status\":\"Non-Teaching\"}}', NULL, '2024-09-17 12:10:48', '2024-09-17 12:10:48'),
(607, 'default', 'created a Employees information on ID number ihwiqihi named \'hwihh\' ', 'App\\Models\\AllEmployee', 'created', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"employee_id\":\"ihwiqihi\",\"first_name\":\"hwihh\",\"last_name\":\"ihhihi\",\"middle_name\":null,\"designation\":\"ihihgwhghi\",\"department\":\"ihwhiwhi\",\"status\":\"Non-Teaching\"}}', NULL, '2024-09-17 12:11:29', '2024-09-17 12:11:29'),
(608, 'default', 'deleted a Employees information on ID number ihwiqihi named \'hwihh\' ', 'App\\Models\\AllEmployee', 'deleted', 3, 'App\\Models\\User', 1, '{\"old\":{\"employee_id\":\"ihwiqihi\",\"first_name\":\"hwihh\",\"last_name\":\"ihhihi\",\"middle_name\":null,\"designation\":\"ihihgwhghi\",\"department\":\"ihwhiwhi\",\"status\":\"Non-Teaching\"}}', NULL, '2024-09-17 12:11:36', '2024-09-17 12:11:36'),
(609, 'default', 'created a Employees information on ID number 20214040 named \'David Earl Gabriel\' ', 'App\\Models\\AllEmployee', 'created', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"employee_id\":\"20214040\",\"first_name\":\"David Earl Gabriel\",\"last_name\":\"Garcia\",\"middle_name\":\"D\",\"designation\":\"Janitor\",\"department\":\"CITE\",\"status\":\"Non-Teaching\"}}', NULL, '2024-09-17 12:59:57', '2024-09-17 12:59:57'),
(610, 'default', 'created a Pass Slip information on ID number 22', 'App\\Models\\PassSlip', 'created', 22, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"p_no\":\"P-20240917-1\",\"first_name\":\"David Earl Gabriel\",\"middle_name\":\"D\",\"last_name\":\"Garcia\",\"department\":\"CITE\",\"designation\":\"Janitor\",\"destination\":\"Dagupan City\",\"date\":\"2024-09-16T16:00:00.000000Z\",\"time_in\":null,\"time_out\":\"21:17:00\",\"empployee_type\":null,\"purpose\":\"hwdugudgud\"}}', NULL, '2024-09-17 13:17:33', '2024-09-17 13:17:33'),
(611, 'default', 'created a Pass Slip information on ID number 23', 'App\\Models\\PassSlip', 'created', 23, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"p_no\":\"P-20240917-2\",\"first_name\":\"David Earl Gabriel\",\"middle_name\":\"D\",\"last_name\":\"Garcia\",\"department\":\"CITE\",\"designation\":\"Janitor\",\"destination\":\"Baguio\",\"date\":\"2024-09-16T16:00:00.000000Z\",\"time_in\":null,\"time_out\":\"21:36:00\",\"empployee_type\":null,\"purpose\":\"hwuwrwbhb\"}}', NULL, '2024-09-17 13:36:33', '2024-09-17 13:36:33'),
(612, 'default', 'created a Employees information on ID number 123456 named \'Manny\' ', 'App\\Models\\AllEmployee', 'created', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"employee_id\":\"123456\",\"first_name\":\"Manny\",\"last_name\":\"Ultra\",\"middle_name\":null,\"designation\":\"Security Guard\",\"department\":\"Registrar\",\"status\":\"Teaching\"}}', NULL, '2024-09-17 13:46:06', '2024-09-17 13:46:06'),
(613, 'default', 'created a Employees information on ID number 54321 named \'Earl\' ', 'App\\Models\\AllEmployee', 'created', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"employee_id\":\"54321\",\"first_name\":\"Earl\",\"last_name\":\"Garcia\",\"middle_name\":\"S\",\"designation\":\"Awit\",\"department\":\"MIS\",\"status\":\"Teaching\"}}', NULL, '2024-09-17 13:52:12', '2024-09-17 13:52:12'),
(614, 'default', 'created a Pass Slip information on ID number 24', 'App\\Models\\PassSlip', 'created', 24, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"p_no\":\"P-20240917-3\",\"first_name\":\"David Earl Gabriel\",\"middle_name\":\"D\",\"last_name\":\"Garcia\",\"department\":\"CITE\",\"designation\":\"Janitor\",\"destination\":\"Dagupan City\",\"date\":\"2024-09-16T16:00:00.000000Z\",\"time_in\":null,\"time_out\":\"22:30:00\",\"empployee_type\":null,\"purpose\":\"wkjfiwiwh\"}}', NULL, '2024-09-17 14:30:29', '2024-09-17 14:30:29'),
(615, 'default', 'created a Violation information on ID number 70', 'App\\Models\\Violation', 'created', 70, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"202140423\",\"first_name\":\"bubwub\",\"middle_initial\":null,\"last_name\":\"wufwu\",\"course\":\"eubfwfub\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-18\"}}', NULL, '2024-09-18 01:17:31', '2024-09-18 01:17:31'),
(616, 'default', 'created a Visitor information on ID number 80', 'App\\Models\\Visitor', 'created', 80, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-09-19\",\"first_name\":\"guwugfug\",\"middle_name\":\"ufwvv\",\"last_name\":\"fwfu\",\"person_to_visit\":\"uvwuvfvu\",\"purpose\":\"bubeknwjj\",\"time_in\":\"14:35:39\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-19 06:35:40', '2024-09-19 06:35:40'),
(617, 'default', 'updated a Visitor information on ID number 80', 'App\\Models\\Visitor', 'updated', 80, 'App\\Models\\User', 1, '{\"attributes\":{\"time_out\":\"14:35:55\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-19 06:35:55', '2024-09-19 06:35:55'),
(618, 'default', 'created a Pass Slip information on ID number 25', 'App\\Models\\PassSlip', 'created', 25, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"p_no\":\"P-20240919-1\",\"first_name\":\"David Earl Gabriel\",\"middle_name\":\"D\",\"last_name\":\"Garcia\",\"department\":\"CITE\",\"designation\":\"Janitor\",\"destination\":\"Baguio\",\"date\":\"2024-09-18T16:00:00.000000Z\",\"time_in\":null,\"time_out\":\"14:41:00\",\"empployee_type\":null,\"purpose\":\"uhgueh\"}}', NULL, '2024-09-19 06:41:28', '2024-09-19 06:41:28');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(619, 'default', 'created a Violation information on ID number 71', 'App\\Models\\Violation', 'created', 71, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"20214040\",\"first_name\":\"gufug\",\"middle_initial\":\"ugfg\",\"last_name\":\"gefgu\",\"course\":\"gufggd\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-19\"}}', NULL, '2024-09-19 07:21:05', '2024-09-19 07:21:05'),
(620, 'default', 'created a Violation information on ID number 72', 'App\\Models\\Violation', 'created', 72, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"94208508\",\"first_name\":\"huwuhquhfheuq\",\"middle_initial\":\"huwguhu\",\"last_name\":\"hwfu\",\"course\":\"uhwfuwh\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-19\"}}', NULL, '2024-09-19 07:22:55', '2024-09-19 07:22:55'),
(621, 'default', 'updated a Lost and Found Information on id number 35', 'App\\Models\\Lost', 'updated', 35, 'App\\Models\\User', 2, '{\"attributes\":{\"object_type\":\"bwhwh\"},\"old\":{\"object_type\":\"8784628\"}}', NULL, '2024-09-19 07:26:41', '2024-09-19 07:26:41'),
(622, 'default', 'updated a Lost and Found Information on id number 1', 'App\\Models\\Lost', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"object_type\":\"Cups\"},\"old\":{\"object_type\":\"Cup\"}}', NULL, '2024-09-19 07:26:53', '2024-09-19 07:26:53'),
(623, 'default', 'updated a Violation information on ID number 72', 'App\\Models\\Violation', 'updated', 72, 'App\\Models\\User', 1, '{\"attributes\":{\"student_no\":\"9420850\"},\"old\":{\"student_no\":\"94208508\"}}', NULL, '2024-09-19 07:27:13', '2024-09-19 07:27:13'),
(624, 'default', 'updated a Visitor information on ID number 5', 'App\\Models\\Visitor', 'updated', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"Cite\"},\"old\":{\"person_to_visit\":\"Cites\"}}', NULL, '2024-09-19 07:27:30', '2024-09-19 07:27:30'),
(625, 'default', 'updated a Announcement Information on ID number 56 titled \'NICE\' ', 'App\\Models\\Event', 'updated', 56, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"NICE\",\"date_end\":\"2024-09-18T16:00:00.000000Z\"},\"old\":{\"title\":\"juuugug\",\"date_end\":null}}', NULL, '2024-09-19 07:27:46', '2024-09-19 07:27:46'),
(626, 'default', 'created a Announcement Information on ID number 57 titled \'ihwuhfuu\' ', 'App\\Models\\Event', 'created', 57, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"ihwuhfuu\",\"description\":\"huuf\",\"date_start\":\"2024-09-18T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-19 07:29:29', '2024-09-19 07:29:29'),
(627, 'default', 'created a Violation information on ID number 73', 'App\\Models\\Violation', 'created', 73, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"2021404i02\",\"first_name\":\"infinebeufu\",\"middle_initial\":\"bfubefbu\",\"last_name\":\"widn\",\"course\":\"ubwfbueeuf\",\"violation_type\":\"No ID\",\"date\":\"2024-09-19\"}}', NULL, '2024-09-19 07:36:10', '2024-09-19 07:36:10'),
(628, 'default', 'created a Violation information on ID number 74', 'App\\Models\\Violation', 'created', 74, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"873739742\",\"first_name\":\"uefguefg\",\"middle_initial\":\"gue\",\"last_name\":\"gwug\",\"course\":\"gefgegu\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-20\"}}', NULL, '2024-09-19 07:43:35', '2024-09-19 07:43:35'),
(629, 'default', 'created a Violation information on ID number 75', 'App\\Models\\Violation', 'created', 75, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"20214040\",\"first_name\":\"David Earl Gabriel\",\"middle_initial\":\"D\",\"last_name\":\"Garcia\",\"course\":\"BSIT\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-19\"}}', NULL, '2024-09-19 07:43:58', '2024-09-19 07:43:58'),
(630, 'default', 'created a Violation information on ID number 76', 'App\\Models\\Violation', 'created', 76, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"911\",\"first_name\":\"umuulan\",\"middle_initial\":\"parang\",\"last_name\":\"lagi nalang\",\"course\":\"walang katapusan\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-19\"}}', NULL, '2024-09-19 07:48:39', '2024-09-19 07:48:39'),
(631, 'default', 'created a Violation information on ID number 77', 'App\\Models\\Violation', 'created', 77, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"oirhi\",\"first_name\":\"iihihgeih\",\"middle_initial\":\"iiheghiei\",\"last_name\":\"iheihi\",\"course\":\"iheihghie\",\"violation_type\":\"No ID\",\"date\":\"2024-09-19\"}}', NULL, '2024-09-19 08:01:20', '2024-09-19 08:01:20'),
(632, 'default', 'created a Violation information on ID number 78', 'App\\Models\\Violation', 'created', 78, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"whri2\",\"first_name\":\"ihhiegihi\",\"middle_initial\":\"iheih\",\"last_name\":\"ihiwhfiih\",\"course\":\"iiheihw\",\"violation_type\":\"No ID\",\"date\":\"2024-09-19\"}}', NULL, '2024-09-19 08:03:23', '2024-09-19 08:03:23'),
(633, 'default', 'created a Violation information on ID number 79', 'App\\Models\\Violation', 'created', 79, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"20214040\",\"first_name\":\"David Earl Gabriel\",\"middle_initial\":\"D\",\"last_name\":\"Garcia\",\"course\":\"BSIT\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-19\"}}', NULL, '2024-09-19 08:17:36', '2024-09-19 08:17:36'),
(634, 'default', 'created a Violation information on ID number 80', 'App\\Models\\Violation', 'created', 80, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"20214040\",\"first_name\":\"David Earl Gabriel\",\"middle_initial\":\"D\",\"last_name\":\"Garcia\",\"course\":\"BSIT\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-19\"}}', NULL, '2024-09-19 14:47:00', '2024-09-19 14:47:00'),
(635, 'default', 'created a Pass Slip information on ID number 26', 'App\\Models\\PassSlip', 'created', 26, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"p_no\":\"P-20240919-1\",\"first_name\":\"Manny\",\"middle_name\":null,\"last_name\":\"Ultra\",\"department\":\"Registrar\",\"designation\":\"Security Guard\",\"destination\":\"dabdi\",\"date\":\"2024-09-18T16:00:00.000000Z\",\"time_in\":null,\"time_out\":\"22:48:00\",\"empployee_type\":null,\"purpose\":\"iwfwjfjfbj\"}}', NULL, '2024-09-19 14:48:31', '2024-09-19 14:48:31'),
(636, 'default', 'deleted a Announcement Information on ID number 57 titled \'ihwuhfuu\' ', 'App\\Models\\Event', 'deleted', 57, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"ihwuhfuu\",\"description\":\"huuf\",\"date_start\":\"2024-09-18T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-19 14:53:29', '2024-09-19 14:53:29'),
(637, 'default', 'deleted a Announcement Information on ID number 53 titled \'ihdvihi\' ', 'App\\Models\\Event', 'deleted', 53, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"ihdvihi\",\"description\":\"ihiheh\",\"date_start\":\"2024-09-15T16:00:00.000000Z\",\"date_end\":\"2024-09-16T16:00:00.000000Z\"}}', NULL, '2024-09-19 14:53:36', '2024-09-19 14:53:36'),
(638, 'default', 'created a Announcement Information on ID number 58 titled \'Tomorrow will have a meeting on the office\' ', 'App\\Models\\Event', 'created', 58, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"Tomorrow will have a meeting on the office\",\"description\":\"k3n3 q2ud 3u3 ud3 d3u3d 3d3d3d3dud3du\",\"date_start\":\"2024-09-18T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-19 14:56:14', '2024-09-19 14:56:14'),
(639, 'default', 'created a Announcement Information on ID number 59 titled \'knbejbjjb\' ', 'App\\Models\\Event', 'created', 59, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"knbejbjjb\",\"description\":\"jbbej\",\"date_start\":\"2024-09-19T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-19 14:56:51', '2024-09-19 14:56:51'),
(640, 'default', 'created a Announcement Information on ID number 60 titled \'lkedb\' ', 'App\\Models\\Event', 'created', 60, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"lkedb\",\"description\":\"knbfebfkq\",\"date_start\":\"2024-09-20T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-19 14:57:02', '2024-09-19 14:57:02'),
(641, 'default', 'created a Announcement Information on ID number 61 titled \'wiiwn\' ', 'App\\Models\\Event', 'created', 61, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"wiiwn\",\"description\":\"inienfwin\",\"date_start\":\"2024-09-18T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-19 14:59:32', '2024-09-19 14:59:32'),
(642, 'default', 'deleted a Violation information on ID number 63', 'App\\Models\\Violation', 'deleted', 63, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"student_no\":\"24928498\",\"first_name\":\"ihwifhw\",\"middle_initial\":\"ihfwihq\",\"last_name\":\"ngeks awit atalaga\",\"course\":\"vyvfvvwy\",\"violation_type\":\"No Uniform\",\"date\":\"2024-09-15\"}}', NULL, '2024-09-20 12:48:57', '2024-09-20 12:48:57'),
(643, 'default', 'created a Violation information on ID number 81', 'App\\Models\\Violation', 'created', 81, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"123\",\"first_name\":\"qwert\",\"middle_initial\":\"q\",\"last_name\":\"qwert\",\"course\":\"qwert\",\"violation_type\":\"No ID\",\"date\":\"2024-09-25\"}}', NULL, '2024-09-21 15:37:29', '2024-09-21 15:37:29'),
(644, 'default', 'created a Violation information on ID number 82', 'App\\Models\\Violation', 'created', 82, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"111111\",\"first_name\":\"David Earl Gabriel\",\"middle_initial\":\"D\",\"last_name\":\"Garciaaaa\",\"course\":\"BSIT\",\"violation_type\":\"No ID\",\"date\":\"2024-09-23\"}}', NULL, '2024-09-21 15:49:51', '2024-09-21 15:49:51'),
(645, 'default', 'created a Violation information on ID number 83', 'App\\Models\\Violation', 'created', 83, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"123\",\"first_name\":\"ihhiegihi\",\"middle_initial\":\"I\",\"last_name\":\"ihiwhfiih\",\"course\":\"BSIT\",\"violation_type\":\"No ID\",\"date\":\"2024-09-24\"}}', NULL, '2024-09-21 15:57:54', '2024-09-21 15:57:54'),
(646, 'default', 'created a Violation information on ID number 84', 'App\\Models\\Violation', 'created', 84, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"123new\",\"first_name\":\"ihhiegihi\",\"middle_initial\":\"I\",\"last_name\":\"ihiwhfiih\",\"course\":\"BSIT\",\"violation_type\":\"No ID\",\"date\":\"2024-09-24\"}}', NULL, '2024-09-21 16:04:38', '2024-09-21 16:04:38'),
(647, 'default', 'created a Violation information on ID number 85', 'App\\Models\\Violation', 'created', 85, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"444\",\"first_name\":\"David Earl Gabriel\",\"middle_initial\":\"D\",\"last_name\":\"Garcia\",\"course\":\"BSIT\",\"violation_type\":\"No ID\",\"date\":\"2024-09-25\"}}', NULL, '2024-09-21 16:09:26', '2024-09-21 16:09:26'),
(648, 'default', 'created a Violation information on ID number 86', 'App\\Models\\Violation', 'created', 86, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"bef\",\"first_name\":\"hihd\",\"middle_initial\":\"hwhi\",\"last_name\":\"hiwdi\",\"course\":\"hihdhw\",\"violation_type\":\"No ID\",\"date\":\"2024-09-22\"}}', NULL, '2024-09-21 16:15:18', '2024-09-21 16:15:18'),
(649, 'default', 'created a Violation information on ID number 87', 'App\\Models\\Violation', 'created', 87, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"20214040\",\"first_name\":\"David Earl Gabriel\",\"middle_initial\":\"D\",\"last_name\":\"Garcia\",\"course\":\"BSIT\",\"violation_type\":\"Inapropriate Cloths\",\"date\":\"2024-09-23\"}}', NULL, '2024-09-21 16:18:23', '2024-09-21 16:18:23'),
(650, 'default', 'created a Violation information on ID number 88', 'App\\Models\\Violation', 'created', 88, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"1222\",\"first_name\":\"laing\",\"middle_initial\":null,\"last_name\":\"king\",\"course\":\"nsh\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-30\"}}', NULL, '2024-09-21 16:29:02', '2024-09-21 16:29:02'),
(651, 'default', 'created a Violation information on ID number 89', 'App\\Models\\Violation', 'created', 89, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"huuhw\",\"first_name\":\"uhwudhu\",\"middle_initial\":\"h\",\"last_name\":\"huhu\",\"course\":\"hwduu\",\"violation_type\":\"No Shoes\",\"date\":\"2024-09-22\"}}', NULL, '2024-09-21 16:30:21', '2024-09-21 16:30:21'),
(652, 'default', 'deleted a Visitor information on ID number 1', 'App\\Models\\Visitor', 'deleted', 1, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":2,\"date\":\"2024-08-21\",\"first_name\":\"David Earl Gabriel\",\"middle_name\":null,\"last_name\":\"Garcia\",\"person_to_visit\":\"CITE\",\"purpose\":\"Request a Letter\",\"time_in\":\"20:40:43\",\"remarks\":null,\"time_out\":\"20:42:16\",\"id_type\":\"Student ID\"}}', NULL, '2024-09-24 14:14:38', '2024-09-24 14:14:38');

-- --------------------------------------------------------

--
-- Table structure for table `all_employees`
--

CREATE TABLE `all_employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `all_employees`
--

INSERT INTO `all_employees` (`id`, `employee_id`, `first_name`, `last_name`, `middle_name`, `designation`, `department`, `status`, `created_at`, `updated_at`) VALUES
(2, 'u2eo2o', 'ouwh', 'owouquo', 'ihfi', 'ihwhfiw', 'hihfhiwhi', 'Non-Teaching', '2024-09-17 11:56:45', '2024-09-17 11:56:45'),
(4, '20214040', 'David Earl Gabriel', 'Garcia', 'D', 'Janitor', 'CITE', 'Non-Teaching', '2024-09-17 12:59:56', '2024-09-17 12:59:56'),
(5, '123456', 'Manny', 'Ultra', NULL, 'Security Guard', 'Registrar', 'Teaching', '2024-09-17 13:46:06', '2024-09-17 13:46:06'),
(6, '54321', 'Earl', 'Garcia', 'S', 'Awit', 'MIS', 'Teaching', '2024-09-17 13:52:12', '2024-09-17 13:52:12');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1726767225),
('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1726767225;', 1726767225),
('5c785c036466adea360111aa28563bfd556b5fba', 'i:1;', 1727184095),
('5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1727184095;', 1727184095),
('admin@example.com|127.0.0.1:timer', 'i:1726764797;', 1726764797),
('user-is-online-1', 'b:1;', 1727187781);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `date_birth` date NOT NULL,
  `employment_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `user_id`, `id_number`, `first_name`, `middle_name`, `last_name`, `gender`, `civil_status`, `email_address`, `contact_no`, `date_birth`, `employment_type`, `created_at`, `updated_at`) VALUES
(2, 1, '202118', 'Manny', 'C', 'Pacquiao', 'Male', 'Married', 'admin@example.com', '09569473576', '1993-01-12', 'Admin', '2024-08-21 05:19:48', '2024-08-21 13:06:52'),
(3, 2, '20214040', 'David Earl Gabriel', 'D', 'Garcia', 'Male', 'Single', 'user@example.com', '09569473576', '2002-09-04', 'Part-Time', '2024-08-21 12:08:23', '2024-09-10 12:26:46'),
(4, 4, '20217336', 'Raymark', 'B', 'Mina', 'Male', 'Single', 'fizzmina07@gmail.com', '09663205097', '1991-05-16', 'Full-Time', '2024-08-22 11:24:58', '2024-08-22 11:24:58'),
(5, 1, '20213902', 'Angelo Darren', NULL, 'Gabertan', 'Male', 'Single', 'admin@example.com', '0967493573', '2002-07-20', 'Full-Time', '2024-08-26 05:38:00', '2024-08-26 05:38:00'),
(6, 6, '20214673', 'Nicky James', NULL, 'Buemio', 'Male', 'Single', 'nicky123@gmail.com', '09569473576', '2001-01-16', 'Full-Time', '2024-09-12 10:52:04', '2024-09-12 10:52:04');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `title`, `description`, `date_start`, `date_end`, `created_at`, `updated_at`) VALUES
(1, 1, 'Remindersssss', 'Don\'t forget your ID tomorrow because we have a visitor from US California you must be present', '2024-08-22', '2024-08-22', '2024-08-21 13:57:20', '2024-08-30 04:35:07'),
(41, 1, 'Crim hope', 'tommorow 8 am to 5 pm', '2024-09-01', '2024-09-01', '2024-09-01 14:04:12', '2024-09-12 08:16:01'),
(54, 1, 'rgieihqihrgh', 'ihrhgihih', '2024-09-16', '2024-09-10', '2024-09-16 07:49:25', '2024-09-16 07:49:25'),
(55, 1, 'Bago', 'ggfgwggw', '2024-09-17', '2024-09-18', '2024-09-16 07:52:38', '2024-09-17 10:00:54'),
(56, 1, 'NICE', 'ggugugucxyrxy', '2024-09-17', '2024-09-19', '2024-09-17 10:07:40', '2024-09-19 07:27:46'),
(58, 1, 'Tomorrow will have a meeting on the office', 'k3n3 q2ud 3u3 ud3 d3u3d 3d3d3d3dud3du', '2024-09-19', NULL, '2024-09-19 14:56:14', '2024-09-19 14:56:14'),
(59, 1, 'knbejbjjb', 'jbbej', '2024-09-20', NULL, '2024-09-19 14:56:51', '2024-09-19 14:56:51'),
(60, 1, 'lkedb', 'knbfebfkq', '2024-09-21', NULL, '2024-09-19 14:57:02', '2024-09-19 14:57:02'),
(61, 1, 'wiiwn', 'inienfwin', '2024-09-19', NULL, '2024-09-19 14:59:32', '2024-09-19 14:59:32');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lost_found`
--

CREATE TABLE `lost_found` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `object_type` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `object_img` varchar(300) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lost_found`
--

INSERT INTO `lost_found` (`id`, `user_id`, `object_type`, `first_name`, `middle_name`, `last_name`, `course`, `object_img`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cups', 'David', 'D', 'Garcia', 'BSIT', '/storage/lost_images/1724289508_pouring flavor.jpg', '2024-08-22 01:18:28', '2024-09-19 07:26:53'),
(2, 4, 'phone', 'Raymark', 'B', 'Mina', 'BSIT', '/storage/lost_images/1724325699_nokia 3210.jpeg', '2024-08-22 11:21:39', '2024-08-22 11:21:39'),
(12, 1, 'Motor', 'Angelo Austin', 'A', 'Aquino', 'BSIT', '/storage/lost_images/1725516230_dio.jpeg', '2024-09-05 06:03:51', '2024-09-12 08:14:26'),
(23, 1, 'phone', 'Raymark', 'B', 'Mina', 'BSIT', '/storage/lost_images/1726128814_nokia 3210.jpeg', '2024-09-09 10:39:23', '2024-09-12 08:13:34'),
(31, 6, 'Iphone 15 pro max', 'David Earl Gabriel', NULL, 'Garcia', 'BSIT', '/storage/lost_images/1726140082_face-scan.png', '2024-09-12 11:21:23', '2024-09-12 11:21:23'),
(32, 2, 'ijitji3ii', 'jjeijij', 'iijetj3hbh', 'hbhbhubbue', 'ububrubub', NULL, '2024-09-13 11:48:12', '2024-09-13 11:48:12'),
(34, 1, 'heu2u', 'yuy2u`uyuu', 'uwuyu', 'yufyufy', 'yueyu', NULL, '2024-09-17 10:32:44', '2024-09-17 10:32:44'),
(35, 1, 'bwhwh', 'heufu', 'h', 'uehguhqhu', 'heuhh', NULL, '2024-09-17 10:37:45', '2024-09-19 07:26:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_07_07_144131_create_visitors_table', 1),
(5, '2024_07_12_121955_create_employee_table', 1),
(6, '2024_07_12_163409_create_parking_table', 1),
(7, '2024_07_13_142240_create_events_table', 1),
(8, '2024_07_14_155106_create_pass_slips_table', 1),
(9, '2024_07_16_042125_create_lost_found_table', 1),
(10, '2024_07_29_111213_create_activity_log_table', 1),
(11, '2024_07_29_111214_add_event_column_to_activity_log_table', 1),
(12, '2024_07_29_111215_add_batch_uuid_column_to_activity_log_table', 1),
(13, '2024_08_08_013100_add_entry_count_to_visitors_table', 1),
(14, '2024_08_08_165927_add_entry_count_to_pass_slips_table', 1),
(17, '2024_08_28_234753_create_violation_table', 2),
(18, '2024_09_16_150437_create_students_table', 3),
(19, '2024_09_16_154206_create_all_employees_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `parkings`
--

CREATE TABLE `parkings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `license_no` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `date_registered` date NOT NULL,
  `expiration_date` date NOT NULL,
  `license_photo` varchar(255) DEFAULT NULL,
  `course` varchar(255) NOT NULL,
  `license_exp_date` date NOT NULL,
  `plate_no` varchar(255) NOT NULL,
  `cr_no` varchar(255) NOT NULL,
  `cr_date_register` date NOT NULL,
  `vehicle_type` varchar(255) NOT NULL,
  `vehicle_image` varchar(255) DEFAULT NULL,
  `sticker_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dl_codes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parkings`
--

INSERT INTO `parkings` (`id`, `user_id`, `license_no`, `first_name`, `middle_name`, `last_name`, `date_registered`, `expiration_date`, `license_photo`, `course`, `license_exp_date`, `plate_no`, `cr_no`, `cr_date_register`, `vehicle_type`, `vehicle_image`, `sticker_id`, `created_at`, `updated_at`, `dl_codes`) VALUES
(1, 1, '106534080013', 'David Earl Gabriel', 'D', 'Garcia', '2024-08-22', '2025-08-22', '/storage/license_photos/1724289281_lecense.jpg', 'BSIT', '2030-09-04', 'AI 4755', '2999724919', '2024-02-14', 'Car', '/storage/vehicle_images/1724289281_cars.jpeg', '20241', '2024-08-22 01:14:41', '2024-08-22 01:14:41', 'A, B, C,'),
(2, 4, '10093932939119', 'Angelo Darren', 'D', 'Gabertan', '2024-08-14', '2025-08-14', '/storage/license_photos/1724325515_woman.png', 'BSCE', '2025-08-23', 'AAX 6879', '2999724919', '2024-08-09', 'Motorcycle', '/storage/vehicle_images/1724325514_dio.jpeg', '65732113', '2024-08-22 11:18:35', '2024-08-22 11:18:35', 'A, B, C,'),
(3, 4, '10093932939119', 'Angelo Darren', 'D', 'Gabertan', '2024-08-14', '2025-08-14', '/storage/license_photos/1724325588_woman.png', 'BSCE', '2025-08-23', 'AAX 6879', '2999724919', '2024-08-09', 'Motorcycle', '/storage/vehicle_images/1724325588_dio.jpeg', '65732113', '2024-08-22 11:19:48', '2024-08-22 11:19:48', 'A, B, C,'),
(13, 1, '23672', 'Raymark', 'B', 'Mina', '2024-08-16', '2025-08-16', '/storage/license_photos/1726128486_abs.png', 'BSIT', '2027-06-15', 'HEV 3624', '65839', '2024-09-24', 'MIO', '/storage/vehicle_images/1726128485_dio.jpeg', '203198', '2024-09-12 08:08:06', '2024-09-12 08:08:06', 'hdads'),
(14, 2, 'i3hfih3ih', 'ojoqdojo', 'jjdj', 'ojodjoj', '2024-09-13', '2025-09-13', NULL, 'oodjojodj', '2024-09-27', '3iihi', 'ihih2id', '2024-09-13', 'hiihihihi', NULL, 'ojowjo', '2024-09-13 11:24:23', '2024-09-13 11:24:23', 'ihihidiw'),
(15, 2, 'ojwiwojwij', 'ihi', 'hihiwif', 'ihihei', '2992-03-18', '2993-03-18', NULL, 'ihhwiwifhi', '8383-03-08', 'ihwfh', 'hihfhihi', '7237-04-07', 'hihfihi', NULL, 'iheifhwihi', '2024-09-13 11:29:26', '2024-09-13 11:29:26', 'jijijifjijqijiji');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pass_slips`
--

CREATE TABLE `pass_slips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `p_no` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `employee_type` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `exit_count` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pass_slips`
--

INSERT INTO `pass_slips` (`id`, `user_id`, `p_no`, `first_name`, `middle_name`, `last_name`, `department`, `designation`, `destination`, `employee_type`, `purpose`, `date`, `time_in`, `time_out`, `created_at`, `updated_at`, `exit_count`) VALUES
(1, 1, 'P-20240822-1', 'Yancy', 'D', 'Cabanting', 'CITE', 'MIT', 'Pozzurobio', 'Non-Teaching', 'Emergency meeting', '2024-08-22', '13:00:00', '09:01:00', '2024-08-22 01:01:47', '2024-09-12 08:04:51', 1),
(2, 1, 'P-20240903-1', 'Jesem', 'G', 'Tepace', 'CITE', 'Instructor', 'Manaoag', 'Teaching', 'Go to emergency', '2024-09-04', '13:00:00', '10:00:00', '2024-09-03 14:16:45', '2024-09-12 08:04:11', 1),
(4, 1, 'P-20240903-1', 'Nicky James', 'D', 'Buemio', 'MIS', 'Janitor', 'Outside UCU', 'Non-Teaching', 'Buying Foods', '2024-09-04', '11:15:00', '10:48:00', '2024-09-03 14:48:26', '2024-09-12 08:03:15', 1),
(5, 1, 'P-20240903-1', 'Lea', 'C', 'Cruz', 'MIS', 'PE teacher', 'Sakura Kampai', 'Teaching', 'Buying Milktea', '2024-09-04', '11:30:00', '10:48:00', '2024-09-03 14:48:27', '2024-09-12 08:01:45', 2),
(7, 1, 'P-20240904-1', 'Angelo', 'D', 'Gabertan', 'Department 1', 'Head III', 'SM', 'Teaching', 'eating', '2024-09-04', '13:00:00', '12:00:00', '2024-09-04 08:43:35', '2024-09-12 08:00:30', 1),
(11, 1, 'P-20240910-1', 'Angelo Austin', 'A', 'Aquino', 'Department 2', 'Admin', '168', 'Non-Teaching', 'buying some foods', '2024-09-10', '11:00:00', '21:18:00', '2024-09-10 13:18:13', '2024-09-12 07:58:44', 1),
(13, 2, 'P-20240911-1', 'David Earl Gabriel', NULL, 'Garcia', 'MIS', 'Janitor', 'Baguio', 'Non-Teaching', 'Meeting', '2024-09-11', NULL, '11:27:00', '2024-09-11 03:28:02', '2024-09-11 03:28:02', 1),
(14, 2, 'P-20240911-1', 'David Earl Gabriel', NULL, 'Garcia', 'MIS', 'Janitor', 'Baguio', 'Teaching', 'efjef', '2024-09-11', NULL, '11:43:00', '2024-09-11 03:43:22', '2024-09-11 03:43:22', 2),
(15, 2, 'P-20240911-1', 'David Earl Gabriel', NULL, 'Garcia', 'MIS', 'Janitor', 'Baguio', 'Non-Teaching', 'ejn3d3id3idi3d 3id3 d3id3d33d 3dc cec hec ehc c', '2024-09-11', NULL, '11:54:00', '2024-09-11 03:54:34', '2024-09-11 03:54:34', 3),
(16, 1, 'P-20240911-1', 'Raymark', 'B', 'Min', 'Department 1', 'Instructor', 'SM', 'Teaching', 'qbwdudu', '2024-09-11', '14:00:00', '11:08:00', '2024-09-11 15:08:23', '2024-09-12 07:56:22', 1),
(21, 2, 'P-20240913-3', 'ubuubdu', NULL, 'en3ubub', 'ububdu3bub', 'ubudbub', 'ububudbu', 'Teaching', 'bwudbubd3', '2024-09-13', NULL, '19:21:00', '2024-09-13 11:22:01', '2024-09-13 11:22:01', 1),
(22, 1, 'P-20240917-1', 'David Earl Gabriel', 'D', 'Garcia', 'CITE', 'Janitor', 'Dagupan City', 'Non-Teaching', 'hwdugudgud', '2024-09-17', NULL, '21:17:00', '2024-09-17 13:17:33', '2024-09-17 13:17:33', 1),
(23, 1, 'P-20240917-2', 'David Earl Gabriel', 'D', 'Garcia', 'CITE', 'Janitor', 'Baguio', 'Non-Teaching', 'hwuwrwbhb', '2024-09-17', NULL, '21:36:00', '2024-09-17 13:36:33', '2024-09-17 13:36:33', 2),
(24, 1, 'P-20240917-3', 'David Earl Gabriel', 'D', 'Garcia', 'CITE', 'Janitor', 'Dagupan City', 'Teaching', 'wkjfiwiwh', '2024-09-17', NULL, '22:30:00', '2024-09-17 14:30:29', '2024-09-17 14:30:29', 3),
(25, 1, 'P-20240919-1', 'David Earl Gabriel', 'D', 'Garcia', 'CITE', 'Janitor', 'Baguio', 'Non-Teaching', 'uhgueh', '2024-09-19', NULL, '14:41:00', '2024-09-19 06:41:28', '2024-09-19 06:41:28', 1),
(26, 1, 'P-20240919-1', 'Manny', NULL, 'Ultra', 'Registrar', 'Security Guard', 'dabdi', 'Teaching', 'iwfwjfjfbj', '2024-09-19', NULL, '22:48:00', '2024-09-19 14:48:31', '2024-09-19 14:48:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('bsb3Fyzs1pPemrSOHMhTw2VTjNbLXYBzGcv0n7Ss', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidVQ2VG1OVmhlbmNJMmdoY0t1WTJraWc0SGRMdGJwWTJjRGRsWEdBaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1727187040),
('DYj4x0QMlD2JAlGU60BAUJFvHEUM6kAXgIitm5ki', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36 Edg/129.0.0.0', 'YTo0OntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6InpxZFdyTjZsblBWVEpVak02MnozTGFaeFJJWU1XV1VXandpS2JMdkYiO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1727187482);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_no` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_no`, `first_name`, `middle_name`, `last_name`, `course`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '20214040', 'David Earl Gabriel', NULL, 'Garcia', 'BSIT', NULL, '2024-09-16 15:47:21', '2024-09-16 15:47:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `last_seen` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `last_seen`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', '2024-08-21 04:53:47', '$2y$12$VLGs/xKoThb5akKFjk4yauECq1q8/npfodLG9wvc4PjXC7cW/R4jO', 1, '2024-09-24 14:18:02', '44OhYMFEgxL0US5ZzXqsiy1IiiVpz0wHuOGqsFfdAgej0ImW7L7x6HgycXTD', '2024-08-21 04:53:48', '2024-09-24 14:18:02'),
(2, 'Regular User', 'user@example.com', '2024-08-21 04:53:48', '$2y$12$7.AJhY0XCnjNs/XqCY6qXOJx/QtVy3eL/u.vpAiVNp35PyzLw00LC', 0, '2024-09-24 14:10:40', '6sNCNU98yWI41sZ5yxS5xxJEJYhMN11eFrHWXsJ6KPjpP75ODWgDYLOpW6NI', '2024-08-21 04:53:48', '2024-09-24 14:10:40'),
(3, 'Angelo', 'gabertanjelo@gmail.com', NULL, '$2y$12$7tY3eyGZIfLRW0g/79bqiuCTtLl7/UcKgrOU6HBjN2nNxrVk2D1vW', 0, NULL, NULL, '2024-08-22 10:53:56', '2024-08-22 10:53:56'),
(4, 'Mina', 'fizzmina07@gmail.com', NULL, '$2y$12$dvy307WoufiE9ZtLrFEVlOSQEZBq8/t9pfGLAVsr8DcryYRughVpi', 0, '2024-08-22 11:27:04', NULL, '2024-08-22 11:08:50', '2024-08-22 11:27:04'),
(5, 'David Earl Gabriel Garcia', 'gabriellodavid47@gmail.com', NULL, '$2y$12$X0YcXfmcXJuAVB84nFqbpuZF5LKs/Bt5EmvkptrzpGOiPvhnppT8W', 0, '2024-09-04 03:32:58', NULL, '2024-09-04 03:24:53', '2024-09-04 03:32:58'),
(6, 'Nicky James Buemio', 'nicky123@gmail.com', NULL, '$2y$12$TZzj8CPiWrWNh.VdRFW0QedyNwI7MSJKoccFnOUJj45I.Vk.O/6vW', 0, '2024-09-13 07:18:43', NULL, '2024-09-11 15:11:18', '2024-09-13 07:18:43');

-- --------------------------------------------------------

--
-- Table structure for table `violations`
--

CREATE TABLE `violations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `student_no` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_initial` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `violation_type` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `violation_count` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `violations`
--

INSERT INTO `violations` (`id`, `user_id`, `student_no`, `first_name`, `middle_initial`, `last_name`, `course`, `violation_type`, `date`, `violation_count`, `created_at`, `updated_at`) VALUES
(1, 1, '20214040', 'David Earl Gabriel', 'D', 'Garcia', 'BSIT', 'No ID', '2024-08-29', 1, '2024-08-28 16:47:02', '2024-08-28 16:47:02'),
(2, 1, '20214040', 'David Earl Gabriel', 'D', 'Garcia', 'BSIT', 'No ID', '2024-08-28', 2, '2024-08-28 16:47:57', '2024-08-28 16:47:57'),
(3, 1, '20214041', 'David Earl Gabriel', 'D', 'Garcia', 'BSIT', 'No ID', '2024-08-31', 1, '2024-08-28 16:48:24', '2024-08-28 16:48:24'),
(4, 1, '20214040', 'David Earl Gabriel', 'D', 'Garcia', 'BSIT', 'Inapropriate Cloths', '2024-08-31', 3, '2024-08-29 01:37:29', '2024-08-29 01:37:29'),
(5, 1, '20214040', 'Ryan', 'S', 'Cielo', 'BSIT', 'No ID', '2024-08-01', 4, '2024-08-29 01:38:32', '2024-08-29 01:38:32'),
(10, 1, '20218998', 'Jesem', 'J', 'Tepace', 'BSHM', 'Inapropriate Cloths', '2024-09-06', 1, '2024-09-04 02:37:34', '2024-09-12 08:11:10'),
(11, 1, '20217336', 'Raymark', 'B', 'Mina', 'BSIT', 'No Uniform', '2024-09-04', 1, '2024-09-04 02:39:14', '2024-09-12 08:10:33'),
(16, 1, '20216354', 'Angelo Darren', 'G', 'Gabertan', 'BSIT', 'Earings', '2024-09-11', 1, '2024-09-11 15:10:18', '2024-09-12 08:09:50'),
(18, 1, '20212809', 'lea mae', NULL, 'cruz', 'BSIT', 'Inapropriate Cloths', '2024-09-12', 1, '2024-09-12 09:35:13', '2024-09-12 09:35:13'),
(19, 1, 'gyyf', 'tstsrs3', NULL, 'rsrsrsr', 'rrerr', 'No ID', '2024-09-13', 1, '2024-09-13 12:23:33', '2024-09-13 12:23:33'),
(21, 1, '797975', 'guegfu', 'geugfug', 'ugfu', 'guwfug', 'No ID', '2024-09-13', 1, '2024-09-13 12:28:28', '2024-09-13 12:28:28'),
(22, 1, '8y384', 'yywfy', 'yfywfyf', 'yryyg', 'yywffyfy', 'No ID', '2024-09-13', 1, '2024-09-13 12:54:42', '2024-09-13 12:54:42'),
(23, 1, '992r4927', 'gudgugu', 'gu', 'uguwdu', 'ugugdugdu', 'No ID', '2024-09-13', 1, '2024-09-13 13:20:14', '2024-09-13 13:20:14'),
(25, 1, '747249', 'gydg', 'ygdy', 'ygwdygy', 'ygydyyg', 'No ID', '2024-09-13', 1, '2024-09-13 13:25:35', '2024-09-13 13:25:35'),
(26, 1, '826h', 'ugduugfug', 'gufu', 'uwdug', 'gufqugddgu', 'No Shoes', '2024-09-14', 1, '2024-09-13 18:01:33', '2024-09-13 18:01:33'),
(27, 1, '7348778', 'uugu', 'gugugc', 'u3uggug', 'uguvug', 'No ID', '2024-09-14', 1, '2024-09-13 18:06:30', '2024-09-13 18:06:30'),
(31, 1, '64684257', 'ufg Haghaha', 'haha', 'david', 'BSIT', 'Inapropriate Cloths', '2024-09-14', 1, '2024-09-13 18:20:07', '2024-09-13 18:20:07'),
(34, 1, '20103028', 'Jimuel', NULL, 'Baitista', 'Crim', 'No Shoes', '2024-09-14', 1, '2024-09-13 18:30:13', '2024-09-13 18:30:13'),
(35, 1, 'uefeh', 'uu', 'huhfhu', 'uhuehu', 'hfuhufwu', 'No ID', '2024-09-07', 1, '2024-09-13 18:32:14', '2024-09-13 18:32:14'),
(40, 1, '938380', 'ygwcyg', 'yygcyg', 'yydgy', 'ygywcgycgy', 'No ID', '2024-09-14', 1, '2024-09-14 03:44:32', '2024-09-14 03:44:32'),
(41, 1, '938380', 'ygwcyg', 'yygcyg', 'yydgy', 'ygywcgycgy', 'No ID', '2024-09-14', 2, '2024-09-14 03:44:35', '2024-09-14 03:44:35'),
(42, 1, '938380', 'ygwcyg', 'yygcyg', 'yydgy', 'ygywcgycgy', 'No ID', '2024-09-14', 3, '2024-09-14 03:44:37', '2024-09-14 03:44:37'),
(43, 1, '729799', 'uhud', 'ydv', 'huuheu', 'vydv', 'No Shoes', '2024-09-21', 1, '2024-09-14 04:08:30', '2024-09-14 04:08:30'),
(44, 1, 'dygy', 'gygyfg', 'g', 'gywy', 'ggyqg', 'No ID', '2024-09-13', 1, '2024-09-14 04:15:46', '2024-09-14 04:15:46'),
(45, 1, 'dygy', 'gygyfg', 'g', 'gywy', 'ggyqg', 'No ID', '2024-09-13', 2, '2024-09-14 04:16:52', '2024-09-14 04:16:52'),
(46, 1, 'yeyg', 'ygsyg', 'ygyg', 'yg', 'gydgg', 'No ID', '2024-09-14', 1, '2024-09-14 04:17:23', '2024-09-14 04:17:23'),
(47, 1, '20214040', 'David Earl Gabriel', 'D', 'Garcia', 'BSIT', 'Inapropriate Cloths', '2024-09-14', 5, '2024-09-14 04:18:11', '2024-09-14 04:18:11'),
(48, 1, '728', 'yyqdgy', 'gyd', 'gywg', 'pusang gala kasi', 'No ID', '2024-09-14', 1, '2024-09-14 04:21:48', '2024-09-14 04:21:48'),
(49, 1, 'iehfihi', 'ihihh', 'ihwhih', 'hihe', 'hwdihwdh', 'No ID', '2024-09-14', 1, '2024-09-14 14:50:03', '2024-09-14 14:50:03'),
(50, 1, 'iehfihi', 'ihihh', 'ihwhih', 'hihe', 'hwdihwdh', 'No ID', '2024-09-14', 2, '2024-09-14 14:50:21', '2024-09-14 14:50:21'),
(51, 1, 'iehfihi', 'ihihh', 'ihwhih', 'hihe', 'hwdihwdh', 'No ID', '2024-09-14', 3, '2024-09-14 14:50:32', '2024-09-14 14:50:32'),
(52, 1, 'uuhu3', 'uhhfuh', 'hufhu', 'huhhf', 'hhfuh3', 'No ID', '2024-09-14', 1, '2024-09-14 14:52:51', '2024-09-14 14:52:51'),
(53, 1, 'uhr3huu', 'he', 'hfuhuu', 'uhehu', 'huhur', 'No ID', '2024-09-14', 1, '2024-09-14 14:55:19', '2024-09-14 14:55:19'),
(54, 1, 'ey2uye', 'uyyeyuY', 'YEUYYEUY', 'uyu2y', 'yu2yeuyu', 'No ID', '2024-09-14', 1, '2024-09-14 14:56:32', '2024-09-14 14:56:32'),
(55, 1, 'udgwydgy', 'gqdgy', 'gdy', 'gydgdg', 'gywg', 'No ID', '2024-09-14', 1, '2024-09-14 14:58:23', '2024-09-14 14:58:23'),
(56, 1, '2ye82ye', 'vhvdhvhd', 'hvd', 'y8y2hvhv', 'hvhvh2v', 'No ID', '2024-09-14', 1, '2024-09-14 15:07:55', '2024-09-14 15:07:55'),
(57, 1, '74624', 'plss gumana kana', 'po', 'lods', 'uhdudug2', 'No ID', '2024-09-14', 1, '2024-09-14 15:20:11', '2024-09-14 15:20:11'),
(58, 1, 'jbwhfwgu', 'niceB', 'UBUBFBU', 'uguguguf', 'UBFUB', 'No ID', '2024-09-15', 1, '2024-09-15 07:11:07', '2024-09-15 07:11:07'),
(59, 1, 'hw247487', 'uqgg', 'uggqug', 'ngeks', 'gefugwfug', 'No ID', '2024-09-19', 1, '2024-09-15 07:15:53', '2024-09-15 07:15:53'),
(60, 1, '7924797', 'gana', 'na po', 'plss', 'iwudgugu', 'No Shoes', '2024-09-15', 1, '2024-09-15 07:26:56', '2024-09-15 07:26:56'),
(61, 1, '373778828', 'naman', 'idol', 'awit', 'ebyey', 'No ID', '2024-09-15', 1, '2024-09-15 07:28:29', '2024-09-15 07:28:29'),
(62, 1, '747297', 'ayaw', 'talaga', 'haha', 'BSIT', 'No Shoes', '2024-09-15', 1, '2024-09-15 07:30:09', '2024-09-15 07:30:09'),
(64, 1, 'iefi', 'nice', 'gumana', 'iieiqhifh', 'ata', 'Inapropriate Cloths', '2024-09-15', 1, '2024-09-15 07:47:16', '2024-09-15 07:47:16'),
(65, 1, '97274979', 'hays', 'wjfjwnj', 'uufwkkjk', 'njejgn', 'No Shoes', '2024-09-15', 1, '2024-09-15 07:55:18', '2024-09-15 07:55:18'),
(66, 1, 'ayaw talaga', 'uheufhwuuwhwuhwfu', 'uuwfuhwh', 'whduhwduhduh', 'uwhfuwhfuhduhd', 'Inapropriate Cloths', '2024-09-15', 1, '2024-09-15 08:01:25', '2024-09-15 08:01:25'),
(67, 1, '20214040', 'David Earl Gabriel', 'D', 'Garcia', 'BSIT', 'Inapropriate Cloths', '2024-09-16', 6, '2024-09-16 04:30:16', '2024-09-16 04:30:16'),
(68, 1, '84824008', 'gufug', 'ugfg', 'gefgu', 'gufggd', 'No Shoes', '2024-09-19', 1, '2024-09-17 10:24:46', '2024-09-17 10:24:46'),
(69, 1, '20214040', 'David Earl Gabriel', 'D', 'Garcia', 'BSIT', 'No Shoes', '2024-09-17', 7, '2024-09-17 11:11:46', '2024-09-17 11:11:46'),
(70, 1, '202140423', 'bubwub', NULL, 'wufwu', 'eubfwfub', 'No Shoes', '2024-09-18', 1, '2024-09-18 01:17:31', '2024-09-18 01:17:31'),
(71, 1, '20214040', 'gufug', 'ugfg', 'gefgu', 'gufggd', 'No Shoes', '2024-09-19', 8, '2024-09-19 07:21:05', '2024-09-19 07:21:05'),
(72, 1, '9420850', 'huwuhquhfheuq', 'huwguhu', 'hwfu', 'uhwfuwh', 'No Shoes', '2024-09-19', 1, '2024-09-19 07:22:55', '2024-09-19 07:27:13'),
(73, 1, '2021404i02', 'infinebeufu', 'bfubefbu', 'widn', 'ubwfbueeuf', 'No ID', '2024-09-19', 1, '2024-09-19 07:36:10', '2024-09-19 07:36:10'),
(74, 1, '873739742', 'uefguefg', 'gue', 'gwug', 'gefgegu', 'No Shoes', '2024-09-20', 1, '2024-09-19 07:43:35', '2024-09-19 07:43:35'),
(75, 1, '20214040', 'David Earl Gabriel', 'D', 'Garcia', 'BSIT', 'No Shoes', '2024-09-19', 9, '2024-09-19 07:43:58', '2024-09-19 07:43:58'),
(76, 1, '911', 'umuulan', 'parang', 'lagi nalang', 'walang katapusan', 'No Shoes', '2024-09-19', 1, '2024-09-19 07:48:39', '2024-09-19 07:48:39'),
(77, 1, 'oirhi', 'iihihgeih', 'iiheghiei', 'iheihi', 'iheihghie', 'No ID', '2024-09-19', 1, '2024-09-19 08:01:20', '2024-09-19 08:01:20'),
(78, 1, 'whri2', 'ihhiegihi', 'iheih', 'ihiwhfiih', 'iiheihw', 'No ID', '2024-09-19', 1, '2024-09-19 08:03:23', '2024-09-19 08:03:23'),
(79, 1, '20214040', 'David Earl Gabriel', 'D', 'Garcia', 'BSIT', 'No Shoes', '2024-09-19', 10, '2024-09-19 08:17:36', '2024-09-19 08:17:36'),
(80, 1, '20214040', 'David Earl Gabriel', 'D', 'Garcia', 'BSIT', 'No Shoes', '2024-09-19', 11, '2024-09-19 14:46:59', '2024-09-19 14:46:59'),
(81, 1, '123', 'qwert', 'q', 'qwert', 'qwert', 'No ID', '2024-09-25', 1, '2024-09-21 15:37:28', '2024-09-21 15:37:28'),
(82, 1, '111111', 'David Earl Gabriel', 'D', 'Garciaaaa', 'BSIT', 'No ID', '2024-09-23', 1, '2024-09-21 15:49:51', '2024-09-21 15:49:51'),
(83, 1, '123', 'ihhiegihi', 'I', 'ihiwhfiih', 'BSIT', 'No ID', '2024-09-24', 2, '2024-09-21 15:57:54', '2024-09-21 15:57:54'),
(84, 1, '123new', 'ihhiegihi', 'I', 'ihiwhfiih', 'BSIT', 'No ID', '2024-09-24', 1, '2024-09-21 16:04:38', '2024-09-21 16:04:38'),
(85, 1, '444', 'David Earl Gabriel', 'D', 'Garcia', 'BSIT', 'No ID', '2024-09-25', 1, '2024-09-21 16:09:26', '2024-09-21 16:09:26'),
(86, 1, 'bef', 'hihd', 'hwhi', 'hiwdi', 'hihdhw', 'No ID', '2024-09-22', 1, '2024-09-21 16:15:18', '2024-09-21 16:15:18'),
(87, 1, '20214040', 'David Earl Gabriel', 'D', 'Garcia', 'BSIT', 'Inapropriate Cloths', '2024-09-23', 12, '2024-09-21 16:18:23', '2024-09-21 16:18:23'),
(88, 1, '1222', 'laing', NULL, 'king', 'nsh', 'No Shoes', '2024-09-30', 1, '2024-09-21 16:29:02', '2024-09-21 16:29:02'),
(89, 1, 'huuhw', 'uhwudhu', 'h', 'huhu', 'hwduu', 'No Shoes', '2024-09-22', 1, '2024-09-21 16:30:21', '2024-09-21 16:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `person_to_visit` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `entry_count` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `user_id`, `date`, `first_name`, `middle_name`, `last_name`, `person_to_visit`, `purpose`, `time_in`, `time_out`, `id_type`, `created_at`, `updated_at`, `entry_count`) VALUES
(3, 1, '2024-08-24', 'Jerimich', NULL, 'Datu', 'HAhaha', '7g7gv7g7', '09:16:33', '09:23:25', 'Student ID', '2024-08-24 01:16:33', '2024-08-28 15:44:08', 1),
(4, 2, '2024-08-24', 'Jeremy', NULL, 'Escalante', 'juguefuweugug', 'guiduviueu', '09:25:06', '09:31:58', 'Student ID', '2024-08-24 01:25:06', '2024-08-24 01:31:58', 1),
(5, 1, '2024-08-24', 'Harold', NULL, 'Gamotea', 'Cite', 'uguwfuwfug', '09:25:10', '09:32:03', 'Student ID', '2024-08-24 01:25:10', '2024-09-19 07:27:30', 1),
(9, 2, '2024-09-02', 'David', NULL, 'Garcia', 'CITE', 'Request a Letter', '16:05:04', '16:11:02', 'Student ID', '2024-09-02 08:05:04', '2024-09-02 08:11:02', 1),
(10, 2, '2024-09-02', 'David', NULL, 'Garcia', 'CITESSS', 'Request a Letter', '17:12:45', '17:12:45', 'National ID', '2024-09-02 08:22:24', '2024-09-02 09:14:39', 2),
(12, 2, '2024-09-02', 'David', 'D', 'Garcia', 'CITE', 'Request a Letter', '17:54:04', '18:22:05', 'Driver License ID', '2024-09-02 09:54:04', '2024-09-03 03:57:53', 3),
(14, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'CITE', 'Request a Lettersss', '12:00:25', NULL, 'National ID', '2024-09-03 04:00:25', '2024-09-12 06:21:39', 1),
(15, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'Gymnasts', 'Enrollmentsss', '12:01:24', '12:03:14', 'Driver License ID', '2024-09-03 04:01:24', '2024-09-03 06:30:04', 2),
(16, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'CITE', 'Request a Letterss', '12:03:44', NULL, 'National ID', '2024-09-03 04:03:44', '2024-09-12 06:21:40', 3),
(17, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'CITE', 'Request a Letterss', '12:04:21', '12:04:27', 'Student ID', '2024-09-03 04:04:21', '2024-09-12 06:21:40', 4),
(18, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'CITE', 'Request a Letterss', '12:31:36', '12:32:13', 'Driver License ID', '2024-09-03 04:31:36', '2024-09-12 06:21:40', 5),
(19, 2, '2024-09-03', 'Trevor', NULL, 'Sloan', 'Audit Office', 'Request Audits', '12:36:51', '12:39:56', 'Student ID', '2024-09-03 04:36:51', '2024-09-12 06:26:16', 1),
(20, 2, '2024-09-03', 'Garby', NULL, 'Garcia', 'Security Management Office', 'Checking for lost item', '12:38:29', '12:38:29', 'Student ID', '2024-09-03 04:38:20', '2024-09-12 06:23:46', 1),
(22, 2, '2024-09-03', 'David', NULL, 'Garcia', 'CITE', 'Request a Letter', '14:04:48', '14:04:48', 'Employee ID', '2024-09-03 06:04:40', '2024-09-12 06:22:29', 1),
(23, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'CITE', 'Request a Letter', '14:13:07', '14:13:14', 'Driver License ID', '2024-09-03 06:13:07', '2024-09-12 06:21:40', 6),
(24, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'CITE', 'Request a Letterss', '14:15:39', NULL, 'Student ID', '2024-09-03 06:15:39', '2024-09-12 06:21:40', 7),
(25, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'CITE', 'Request a Letter', '14:15:46', NULL, 'Student ID', '2024-09-03 06:15:46', '2024-09-12 06:21:40', 8),
(26, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'CITE', 'Request a Letter', '14:16:00', NULL, 'Student ID', '2024-09-03 06:16:00', '2024-09-12 06:21:40', 9),
(27, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'CITE', 'Request a Letter', '14:19:54', '14:20:00', 'Driver License ID', '2024-09-03 06:19:54', '2024-09-12 06:21:40', 10),
(57, 1, '2024-09-11', 'Dominique', NULL, 'Sampson', 'NSTP Department', 'Request form', '23:07:31', '23:29:59', 'Student ID', '2024-09-11 15:07:31', '2024-09-12 06:19:54', 1),
(61, 6, '2024-09-12', 'Harmony', NULL, 'Marshall', 'Department of CEA', 'Request Letter', '09:12:23', '09:14:10', 'Student ID', '2024-09-12 01:12:23', '2024-09-12 06:16:46', 1),
(62, 6, '2024-09-12', 'Marlee', NULL, 'Schneider', 'Library', 'Related Literature', '09:12:41', '09:14:05', 'Driver License ID', '2024-09-12 01:12:41', '2024-09-12 06:11:56', 1),
(63, 1, '2024-09-12', 'lea mae', 'V', 'cruz', 'Cite', 'clearance', '17:29:36', '17:29:53', 'National ID', '2024-09-12 09:29:36', '2024-09-12 09:29:53', 1),
(64, 6, '2024-09-12', 'yfyfs', 'f', 'dwy', 'yfdfqyf', 'yffdfy', '19:10:25', '19:10:51', 'Student ID', '2024-09-12 11:10:25', '2024-09-12 11:10:51', 1),
(65, 6, '2024-09-12', 'lea mae', 'V', 'cruz', 'Cite', 'clearance', '19:11:43', '14:09:35', 'Driver License ID', '2024-09-12 11:11:43', '2024-09-13 06:09:35', 2),
(66, 1, '2024-09-13', 'sgyqsgy', 'gycygy', 'David', 'yygyyqyggy', 'gygydgqysyggy', '18:58:54', '19:01:26', 'Driver License ID', '2024-09-13 10:58:54', '2024-09-13 11:01:26', 1),
(67, 1, '2024-09-13', 'guguwugugu', 'guwgugwgu', 'hcuwug', 'ugugwugcgu', 'ugiheiciwhi', '19:04:33', NULL, 'Driver License ID', '2024-09-13 11:04:33', '2024-09-13 11:04:33', 1),
(68, 1, '2024-09-13', 'guguwugugu', 'guwgugwgu', 'hcuwug', 'ugugwugcgu', 'ugiheiciwhi', '19:08:59', NULL, 'Driver License ID', '2024-09-13 11:08:59', '2024-09-13 11:08:59', 2),
(69, 1, '2024-09-13', 'guguwugugu', 'guwgugwgu', 'hcuwug', 'ugugwugcgu', 'ugiheiciwhi', '19:09:22', '19:11:22', 'Driver License ID', '2024-09-13 11:09:22', '2024-09-13 11:11:22', 3),
(70, 1, '2024-09-13', 'ijrfhuhuuh', 'ubefb', 'uvbub', 'uheuhf4uhuhu', 'uhuefhuuhu', '19:11:02', '19:41:58', 'Student ID', '2024-09-13 11:11:02', '2024-09-13 11:41:58', 1),
(71, 1, '2024-09-13', 'nuufbu', 'uubuvbub', 'jnenuenu', 'ububwcubu', 'ubuenuevu', '19:12:17', NULL, 'Driver License ID', '2024-09-13 11:12:17', '2024-09-13 11:12:17', 1),
(72, 1, '2024-09-13', 'nuufbu', 'uubuvbub', 'jnenuenu', 'ububwcubu', 'ubuenuevu', '19:16:20', '19:41:59', 'Driver License ID', '2024-09-13 11:16:20', '2024-09-13 11:41:59', 2),
(73, 1, '2024-09-13', 'guguegu', 'gugucububuBU', 'ugueuegu', 'UBUBub', 'ububcubub', '19:17:03', NULL, 'Student ID', '2024-09-13 11:17:03', '2024-09-13 11:17:03', 1),
(74, 1, '2024-09-13', 'guguegu', 'gugucububuBU', 'ugueuegu', 'UBUBub', 'ububcubub', '19:17:18', NULL, 'Student ID', '2024-09-13 11:17:18', '2024-09-13 11:17:18', 2),
(75, 1, '2024-09-13', 'guguegu', 'gugucububuBU', 'ugueuegu', 'UBUBub', 'ububcubub', '19:17:39', '19:42:01', 'Student ID', '2024-09-13 11:17:39', '2024-09-13 11:42:01', 3),
(76, 1, '2024-09-13', 'uhuhcuhwuhUHUHW', 'UHUHCUH', 'uheuchuh', 'Uhecuheuheu', 'UHUHWCUH', '19:19:40', '19:40:18', 'Driver License ID', '2024-09-13 11:19:40', '2024-09-13 11:40:18', 1),
(77, 1, '2024-09-13', 'ubbudbu', 'bubdbu', 'wudb', 'ubdbububu', 'ubwbubdu', '19:35:14', '19:40:05', 'Student ID', '2024-09-13 11:35:14', '2024-09-13 11:40:05', 1),
(78, 1, '2024-09-13', 'bubfbub', 'bbfbu', 'fubf', 'bbdubwbu', 'buwbub', '19:39:56', '19:40:11', 'Student ID', '2024-09-13 11:39:56', '2024-09-13 11:40:11', 1),
(79, 1, '2024-09-13', 'bubdubwubub', 'uubdubbudu', 'wdubwubu', 'bubdubdub', 'ubbudbwubbu', '19:46:59', '09:42:54', 'Student ID', '2024-09-13 11:46:59', '2024-09-17 01:42:54', 1),
(80, 1, '2024-09-19', 'guwugfug', 'ufwvv', 'fwfu', 'uvwuvfvu', 'bubeknwjj', '14:35:39', '14:35:55', 'Student ID', '2024-09-19 06:35:39', '2024-09-19 06:35:55', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `all_employees`
--
ALTER TABLE `all_employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_user_id_foreign` (`user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lost_found`
--
ALTER TABLE `lost_found`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lost_found_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parkings`
--
ALTER TABLE `parkings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parkings_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pass_slips`
--
ALTER TABLE `pass_slips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pass_slips_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `violations`
--
ALTER TABLE `violations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitors_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=653;

--
-- AUTO_INCREMENT for table `all_employees`
--
ALTER TABLE `all_employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lost_found`
--
ALTER TABLE `lost_found`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `parkings`
--
ALTER TABLE `parkings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pass_slips`
--
ALTER TABLE `pass_slips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `violations`
--
ALTER TABLE `violations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lost_found`
--
ALTER TABLE `lost_found`
  ADD CONSTRAINT `lost_found_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `parkings`
--
ALTER TABLE `parkings`
  ADD CONSTRAINT `parkings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pass_slips`
--
ALTER TABLE `pass_slips`
  ADD CONSTRAINT `pass_slips_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `visitors`
--
ALTER TABLE `visitors`
  ADD CONSTRAINT `visitors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
