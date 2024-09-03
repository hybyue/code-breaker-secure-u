-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 10:16 AM
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
(1, 'default', 'created a Visitor information on ID number 1', 'App\\Models\\Visitor', 'created', 1, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-08-21\",\"first_name\":\"David\",\"middle_name\":null,\"last_name\":\"Garcia\",\"person_to_visit\":\"CITE\",\"purpose\":\"Request a Letter\",\"time_in\":\"20:40:43\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-08-21 12:40:44', '2024-08-21 12:40:44'),
(2, 'default', 'updated a Visitor information on ID number 1', 'App\\Models\\Visitor', 'updated', 1, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"20:42:16\"},\"old\":{\"time_out\":null}}', NULL, '2024-08-21 12:42:16', '2024-08-21 12:42:16'),
(3, 'default', 'created a Event Information on ID number 1', 'App\\Models\\Event', 'created', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"Reminder\",\"description\":\"Don\'t forget your ID tomorrow because we have a visitor from US California you must be present\",\"date_start\":\"2024-08-21T16:00:00.000000Z\",\"date_end\":\"2024-08-20T16:00:00.000000Z\"}}', NULL, '2024-08-21 13:57:20', '2024-08-21 13:57:20'),
(4, 'default', 'created a Pass Slip information on ID number 1', 'App\\Models\\PassSlip', 'created', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"p_no\":\"P-20240822-1\",\"first_name\":\"David\",\"middle_name\":\"D\",\"last_name\":\"Garcia\",\"department\":\"CITE\",\"designation\":\"MIT\",\"destination\":\"Urdaneta City\",\"date\":\"2024-08-21T16:00:00.000000Z\",\"time_in\":\"13:00:00\",\"time_out\":\"09:01:00\",\"empployee_type\":null,\"purpose\":\"Emergency meeting\"}}', NULL, '2024-08-22 01:01:48', '2024-08-22 01:01:48'),
(5, 'default', 'created a Parking information on license number 106534080013', 'App\\Models\\Parking', 'created', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"license_no\":\"106534080013\",\"first_name\":\"David Earl Gabriel\",\"middle_name\":\"D\",\"last_name\":\"Garcia\",\"date_registered\":\"2024-08-22\",\"expiration_date\":\"2025-08-22\",\"license_photo\":\"\\/storage\\/license_photos\\/1724289281_lecense.jpg\",\"course\":\"BSIT\",\"license_exp_date\":\"2030-09-04\",\"dl_codes\":\"A, B, C,\",\"plate_no\":\"AI 4755\",\"cr_no\":\"2999724919\",\"cr_date_register\":\"2024-02-14\",\"vehicle_type\":\"Car\",\"vehicle_image\":\"\\/storage\\/vehicle_images\\/1724289281_cars.jpeg\",\"sticker_id\":\"20241\"}}', NULL, '2024-08-22 01:14:41', '2024-08-22 01:14:41'),
(6, 'default', 'created a Lost and Found Information on id number 1', 'App\\Models\\Lost', 'created', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"object_type\":\"Cup\",\"first_name\":\"David\",\"middle_name\":\"D\",\"last_name\":\"Garcia\",\"course\":\"BSIT\",\"object_img\":\"\\/storage\\/lost_images\\/1724289508_pouring flavor.jpg\"}}', NULL, '2024-08-22 01:18:28', '2024-08-22 01:18:28'),
(7, 'default', 'created a Visitor information on ID number 2', 'App\\Models\\Visitor', 'created', 2, 'App\\Models\\User', 4, '{\"attributes\":{\"user_id\":4,\"date\":\"2024-08-22\",\"first_name\":\"Angelo Darren\",\"middle_name\":\"D\",\"last_name\":\"Gabertan\",\"person_to_visit\":\"Engineering\",\"purpose\":\"to sign my completion form to our dean\",\"time_in\":\"19:14:04\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-08-22 11:14:04', '2024-08-22 11:14:04'),
(8, 'default', 'created a Parking information on license number 10093932939119', 'App\\Models\\Parking', 'created', 2, 'App\\Models\\User', 4, '{\"attributes\":{\"license_no\":\"10093932939119\",\"first_name\":\"Angelo Darren\",\"middle_name\":\"D\",\"last_name\":\"Gabertan\",\"date_registered\":\"2024-08-14\",\"expiration_date\":\"2025-08-14\",\"license_photo\":\"\\/storage\\/license_photos\\/1724325515_woman.png\",\"course\":\"BSCE\",\"license_exp_date\":\"2025-08-23\",\"dl_codes\":\"A, B, C,\",\"plate_no\":\"AAX 6879\",\"cr_no\":\"2999724919\",\"cr_date_register\":\"2024-08-09\",\"vehicle_type\":\"Motorcycle\",\"vehicle_image\":\"\\/storage\\/vehicle_images\\/1724325514_dio.jpeg\",\"sticker_id\":\"65732113\"}}', NULL, '2024-08-22 11:18:35', '2024-08-22 11:18:35'),
(9, 'default', 'created a Parking information on license number 10093932939119', 'App\\Models\\Parking', 'created', 3, 'App\\Models\\User', 4, '{\"attributes\":{\"license_no\":\"10093932939119\",\"first_name\":\"Angelo Darren\",\"middle_name\":\"D\",\"last_name\":\"Gabertan\",\"date_registered\":\"2024-08-14\",\"expiration_date\":\"2025-08-14\",\"license_photo\":\"\\/storage\\/license_photos\\/1724325588_woman.png\",\"course\":\"BSCE\",\"license_exp_date\":\"2025-08-23\",\"dl_codes\":\"A, B, C,\",\"plate_no\":\"AAX 6879\",\"cr_no\":\"2999724919\",\"cr_date_register\":\"2024-08-09\",\"vehicle_type\":\"Motorcycle\",\"vehicle_image\":\"\\/storage\\/vehicle_images\\/1724325588_dio.jpeg\",\"sticker_id\":\"65732113\"}}', NULL, '2024-08-22 11:19:48', '2024-08-22 11:19:48'),
(10, 'default', 'created a Lost and Found Information on id number 2', 'App\\Models\\Lost', 'created', 2, 'App\\Models\\User', 4, '{\"attributes\":{\"user_id\":4,\"object_type\":\"phone\",\"first_name\":\"Raymark\",\"middle_name\":\"B\",\"last_name\":\"Mina\",\"course\":\"BSIT\",\"object_img\":\"\\/storage\\/lost_images\\/1724325699_nokia 3210.jpeg\"}}', NULL, '2024-08-22 11:21:39', '2024-08-22 11:21:39'),
(11, 'default', 'created a Event Information on ID number 2', 'App\\Models\\Event', 'created', 2, 'App\\Models\\User', 4, '{\"attributes\":{\"user_id\":4,\"title\":\"holiday\",\"description\":\"special holiday\",\"date_start\":\"2024-08-22T16:00:00.000000Z\",\"date_end\":\"2024-08-23T16:00:00.000000Z\"}}', NULL, '2024-08-22 11:22:46', '2024-08-22 11:22:46'),
(12, 'default', 'updated a Event Information on ID number 2', 'App\\Models\\Event', 'updated', 2, 'App\\Models\\User', 4, '{\"attributes\":{\"description\":\"non working holiday\",\"date_end\":\"2024-08-25T16:00:00.000000Z\"},\"old\":{\"description\":\"special holiday\",\"date_end\":\"2024-08-23T16:00:00.000000Z\"}}', NULL, '2024-08-22 11:26:58', '2024-08-22 11:26:58'),
(13, 'default', 'deleted a Visitor information on ID number 2', 'App\\Models\\Visitor', 'deleted', 2, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":4,\"date\":\"2024-08-22\",\"first_name\":\"Angelo Darren\",\"middle_name\":\"D\",\"last_name\":\"Gabertan\",\"person_to_visit\":\"Engineering\",\"purpose\":\"to sign my completion form to our dean\",\"time_in\":\"19:14:04\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-08-24 01:14:59', '2024-08-24 01:14:59'),
(14, 'default', 'created a Visitor information on ID number 3', 'App\\Models\\Visitor', 'created', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-08-24\",\"first_name\":\"Jerimich\",\"middle_name\":null,\"last_name\":\"Datu\",\"person_to_visit\":\"bugfueug\",\"purpose\":\"7g7gv7g7\",\"time_in\":\"09:16:33\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-08-24 01:16:33', '2024-08-24 01:16:33'),
(15, 'default', 'updated a Visitor information on ID number 3', 'App\\Models\\Visitor', 'updated', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"time_out\":\"09:23:25\"},\"old\":{\"time_out\":null}}', NULL, '2024-08-24 01:23:25', '2024-08-24 01:23:25'),
(16, 'default', 'created a Visitor information on ID number 4', 'App\\Models\\Visitor', 'created', 4, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-08-24\",\"first_name\":\"Jeremy\",\"middle_name\":null,\"last_name\":\"Escalante\",\"person_to_visit\":\"juguefuweugug\",\"purpose\":\"guiduviueu\",\"time_in\":\"09:25:06\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-08-24 01:25:06', '2024-08-24 01:25:06'),
(17, 'default', 'created a Visitor information on ID number 5', 'App\\Models\\Visitor', 'created', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-08-24\",\"first_name\":\"Harold\",\"middle_name\":null,\"last_name\":\"Gamotea\",\"person_to_visit\":\"uuegfugwu\",\"purpose\":\"uguwfuwfug\",\"time_in\":\"09:25:10\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-08-24 01:25:10', '2024-08-24 01:25:10'),
(18, 'default', 'updated a Visitor information on ID number 4', 'App\\Models\\Visitor', 'updated', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"time_out\":\"09:31:58\"},\"old\":{\"time_out\":null}}', NULL, '2024-08-24 01:31:58', '2024-08-24 01:31:58'),
(19, 'default', 'updated a Visitor information on ID number 5', 'App\\Models\\Visitor', 'updated', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"time_out\":\"09:32:03\"},\"old\":{\"time_out\":null}}', NULL, '2024-08-24 01:32:03', '2024-08-24 01:32:03'),
(20, 'default', 'created a Visitor information on ID number 6', 'App\\Models\\Visitor', 'created', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-08-24\",\"first_name\":\"Harold\",\"middle_name\":null,\"last_name\":\"Gamotea\",\"person_to_visit\":\"CITE\",\"purpose\":\"Payment lang po\",\"time_in\":\"09:32:52\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-08-24 01:32:52', '2024-08-24 01:32:52'),
(21, 'default', 'updated a Visitor information on ID number 6', 'App\\Models\\Visitor', 'updated', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"time_out\":\"09:40:03\"},\"old\":{\"time_out\":null}}', NULL, '2024-08-24 01:40:03', '2024-08-24 01:40:03'),
(22, 'default', 'deleted a Event Information on ID number 2', 'App\\Models\\Event', 'deleted', 2, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":4,\"title\":\"holiday\",\"description\":\"non working holiday\",\"date_start\":\"2024-08-22T16:00:00.000000Z\",\"date_end\":\"2024-08-25T16:00:00.000000Z\"}}', NULL, '2024-08-26 04:37:02', '2024-08-26 04:37:02'),
(23, 'default', 'created a Visitor information on ID number 7', 'App\\Models\\Visitor', 'created', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-08-26\",\"first_name\":\"kzudhvushuHU\",\"middle_name\":\"huhgiu\",\"last_name\":\"hiuhguih\",\"person_to_visit\":\"uhhuwh\",\"purpose\":\"huhqu\",\"time_in\":\"13:05:50\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-08-26 05:05:51', '2024-08-26 05:05:51'),
(24, 'default', 'updated a Visitor information on ID number 7', 'App\\Models\\Visitor', 'updated', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"time_out\":\"13:46:30\"},\"old\":{\"time_out\":null}}', NULL, '2024-08-26 05:46:30', '2024-08-26 05:46:30'),
(25, 'default', 'updated a Visitor information on ID number 5', 'App\\Models\\Visitor', 'updated', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"Cites\"},\"old\":{\"person_to_visit\":\"uuegfugwu\"}}', NULL, '2024-08-28 15:16:33', '2024-08-28 15:16:33'),
(26, 'default', 'deleted a Visitor information on ID number 6', 'App\\Models\\Visitor', 'deleted', 6, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"date\":\"2024-08-24\",\"first_name\":\"Harold\",\"middle_name\":null,\"last_name\":\"Gamotea\",\"person_to_visit\":\"CITE\",\"purpose\":\"Payment lang po\",\"time_in\":\"09:32:52\",\"remarks\":null,\"time_out\":\"09:40:03\",\"id_type\":\"Student ID\"}}', NULL, '2024-08-28 15:16:44', '2024-08-28 15:16:44'),
(27, 'default', 'updated a Visitor information on ID number 3', 'App\\Models\\Visitor', 'updated', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"HAhaha\"},\"old\":{\"person_to_visit\":\"bugfueug\"}}', NULL, '2024-08-28 15:44:08', '2024-08-28 15:44:08'),
(28, 'default', 'created a Violation information on ID number 1', 'App\\Models\\Violation', 'created', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"20214040\",\"first_name\":\"David Earl Gabriel\",\"middle_initial\":\"D\",\"last_name\":\"Garcia\",\"course\":\"BSIT\",\"violation_type\":\"No ID\",\"date\":\"2024-08-29\"}}', NULL, '2024-08-28 16:47:03', '2024-08-28 16:47:03'),
(29, 'default', 'created a Violation information on ID number 2', 'App\\Models\\Violation', 'created', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"20214040\",\"first_name\":\"David Earl Gabriel\",\"middle_initial\":\"D\",\"last_name\":\"Garcia\",\"course\":\"BSIT\",\"violation_type\":\"No ID\",\"date\":\"2024-08-28\"}}', NULL, '2024-08-28 16:47:57', '2024-08-28 16:47:57'),
(30, 'default', 'created a Violation information on ID number 3', 'App\\Models\\Violation', 'created', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"20214041\",\"first_name\":\"David Earl Gabriel\",\"middle_initial\":\"D\",\"last_name\":\"Garcia\",\"course\":\"BSIT\",\"violation_type\":\"No ID\",\"date\":\"2024-08-31\"}}', NULL, '2024-08-28 16:48:24', '2024-08-28 16:48:24'),
(31, 'default', 'created a Violation information on ID number 4', 'App\\Models\\Violation', 'created', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"20214040\",\"first_name\":\"David Earl Gabriel\",\"middle_initial\":\"D\",\"last_name\":\"Garcia\",\"course\":\"BSIT\",\"violation_type\":\"Inapropriate Cloths\",\"date\":\"2024-08-31\"}}', NULL, '2024-08-29 01:37:29', '2024-08-29 01:37:29'),
(32, 'default', 'created a Violation information on ID number 5', 'App\\Models\\Violation', 'created', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"student_no\":\"20214040\",\"first_name\":\"Ryan\",\"middle_initial\":\"S\",\"last_name\":\"Cielo\",\"course\":\"BSIT\",\"violation_type\":\"No ID\",\"date\":\"2024-08-01\"}}', NULL, '2024-08-29 01:38:32', '2024-08-29 01:38:32'),
(33, 'default', 'created a Event Information on ID number 3', 'App\\Models\\Event', 'created', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"dbcuebybu\",\"description\":\"ubucbuecbu\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":\"2024-08-29T16:00:00.000000Z\"}}', NULL, '2024-08-30 03:31:36', '2024-08-30 03:31:36'),
(34, 'default', 'created a Event Information on ID number 4', 'App\\Models\\Event', 'created', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"uyvdc7veyvvy\",\"description\":\"yevyvyevy\",\"date_start\":\"2024-12-11T16:00:00.000000Z\",\"date_end\":\"2024-12-11T16:00:00.000000Z\"}}', NULL, '2024-08-30 03:31:56', '2024-08-30 03:31:56'),
(35, 'default', 'deleted a Event Information on ID number 4', 'App\\Models\\Event', 'deleted', 4, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"uyvdc7veyvvy\",\"description\":\"yevyvyevy\",\"date_start\":\"2024-12-11T16:00:00.000000Z\",\"date_end\":\"2024-12-11T16:00:00.000000Z\"}}', NULL, '2024-08-30 03:58:50', '2024-08-30 03:58:50'),
(36, 'default', 'deleted a Event Information on ID number 3', 'App\\Models\\Event', 'deleted', 3, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"dbcuebybu\",\"description\":\"ubucbuecbu\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":\"2024-08-29T16:00:00.000000Z\"}}', NULL, '2024-08-30 03:59:00', '2024-08-30 03:59:00'),
(37, 'default', 'created a Event Information on ID number 5', 'App\\Models\\Event', 'created', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"uhecyeyyv\",\"description\":\"yvyfvyfvy\",\"date_start\":\"2024-08-11T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 03:59:32', '2024-08-30 03:59:32'),
(38, 'default', 'deleted a Event Information on ID number 5', 'App\\Models\\Event', 'deleted', 5, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"uhecyeyyv\",\"description\":\"yvyfvyfvy\",\"date_start\":\"2024-08-11T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 04:21:49', '2024-08-30 04:21:49'),
(39, 'default', 'created a Event Information on ID number 6', 'App\\Models\\Event', 'created', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"knuibefubub\",\"description\":\"beuuwbubu\",\"date_start\":\"2024-07-31T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 04:22:59', '2024-08-30 04:22:59'),
(40, 'default', 'deleted a Event Information on ID number 6', 'App\\Models\\Event', 'deleted', 6, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"knuibefubub\",\"description\":\"beuuwbubu\",\"date_start\":\"2024-07-31T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 04:23:11', '2024-08-30 04:23:11'),
(41, 'default', 'created a Event Information on ID number 7', 'App\\Models\\Event', 'created', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"hvsyvwvvvyvy\",\"description\":\"yvvyyvqvyyv\",\"date_start\":\"2024-08-30T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 04:23:58', '2024-08-30 04:23:58'),
(42, 'default', 'deleted a Event Information on ID number 7', 'App\\Models\\Event', 'deleted', 7, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"hvsyvwvvvyvy\",\"description\":\"yvvyyvqvyyv\",\"date_start\":\"2024-08-30T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 04:24:05', '2024-08-30 04:24:05'),
(43, 'default', 'updated a Event Information on ID number 1', 'App\\Models\\Event', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"Reminderss\",\"date_end\":\"2024-08-21T16:00:00.000000Z\"},\"old\":{\"title\":\"Reminder\",\"date_end\":\"2024-08-20T16:00:00.000000Z\"}}', NULL, '2024-08-30 04:31:03', '2024-08-30 04:31:03'),
(44, 'default', 'updated a Event Information on ID number 1', 'App\\Models\\Event', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"Remindersssss\"},\"old\":{\"title\":\"Reminderss\"}}', NULL, '2024-08-30 04:35:07', '2024-08-30 04:35:07'),
(45, 'default', 'created a Event Information on ID number 8', 'App\\Models\\Event', 'created', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"jbjvbfbwub\",\"description\":\"ubbubuwub\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 04:35:53', '2024-08-30 04:35:53'),
(46, 'default', 'created a Event Information on ID number 9', 'App\\Models\\Event', 'created', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"jbjvbfbwub\",\"description\":\"ubbubuwub\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 04:36:02', '2024-08-30 04:36:02'),
(47, 'default', 'deleted a Event Information on ID number 9', 'App\\Models\\Event', 'deleted', 9, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"jbjvbfbwub\",\"description\":\"ubbubuwub\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 04:47:51', '2024-08-30 04:47:51'),
(48, 'default', 'updated a Event Information on ID number 8', 'App\\Models\\Event', 'updated', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"Event\",\"description\":\"this event is about feb-ibig kaya asahan nating maraming mga broken\",\"date_end\":\"2024-08-29T16:00:00.000000Z\"},\"old\":{\"title\":\"jbjvbfbwub\",\"description\":\"ubbubuwub\",\"date_end\":null}}', NULL, '2024-08-30 04:48:35', '2024-08-30 04:48:35'),
(49, 'default', 'updated a Event Information on ID number 8', 'App\\Models\\Event', 'updated', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"Events\"},\"old\":{\"title\":\"Event\"}}', NULL, '2024-08-30 04:50:02', '2024-08-30 04:50:02'),
(50, 'default', 'created a Event Information on ID number 10', 'App\\Models\\Event', 'created', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"iufhwhiqih\",\"description\":\"ihhishiwih\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 04:51:55', '2024-08-30 04:51:55'),
(51, 'default', 'updated a Event Information on ID number 10', 'App\\Models\\Event', 'updated', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"Meeting\",\"date_end\":\"2024-08-29T16:00:00.000000Z\"},\"old\":{\"title\":\"iufhwhiqih\",\"date_end\":null}}', NULL, '2024-08-30 04:59:35', '2024-08-30 04:59:35'),
(52, 'default', 'created a Event Information on ID number 11', 'App\\Models\\Event', 'created', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"getcve\",\"description\":\"vevctevt\",\"date_start\":\"2024-08-22T16:00:00.000000Z\",\"date_end\":\"2024-08-30T16:00:00.000000Z\"}}', NULL, '2024-08-30 06:15:08', '2024-08-30 06:15:08'),
(53, 'default', 'created a Event Information on ID number 12', 'App\\Models\\Event', 'created', 12, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"byrfyryby\",\"description\":\"ybeydyvyv\",\"date_start\":\"2024-08-11T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 06:16:59', '2024-08-30 06:16:59'),
(54, 'default', 'updated a Event Information on ID number 12', 'App\\Models\\Event', 'updated', 12, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"David\",\"date_end\":\"2024-08-11T16:00:00.000000Z\"},\"old\":{\"title\":\"byrfyryby\",\"date_end\":null}}', NULL, '2024-08-30 06:34:01', '2024-08-30 06:34:01'),
(55, 'default', 'deleted a Event Information on ID number 11', 'App\\Models\\Event', 'deleted', 11, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"getcve\",\"description\":\"vevctevt\",\"date_start\":\"2024-08-22T16:00:00.000000Z\",\"date_end\":\"2024-08-30T16:00:00.000000Z\"}}', NULL, '2024-08-30 07:03:02', '2024-08-30 07:03:02'),
(56, 'default', 'created a Event Information on ID number 13', 'App\\Models\\Event', 'created', 13, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"bcycy\",\"description\":\"ybeybcyb\",\"date_start\":\"2024-08-07T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 07:42:15', '2024-08-30 07:42:15'),
(57, 'default', 'created a Event Information on ID number 14', 'App\\Models\\Event', 'created', 14, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"ueubuuub\",\"description\":\"bububueub\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":\"2024-08-30T16:00:00.000000Z\"}}', NULL, '2024-08-30 07:49:20', '2024-08-30 07:49:20'),
(58, 'default', 'created a Event Information on ID number 15', 'App\\Models\\Event', 'created', 15, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"David\",\"description\":\"ggs\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":\"2024-08-30T16:00:00.000000Z\"}}', NULL, '2024-08-30 07:52:30', '2024-08-30 07:52:30'),
(59, 'default', 'created a Event Information on ID number 16', 'App\\Models\\Event', 'created', 16, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"eventss\",\"description\":\"haha\",\"date_start\":\"2024-07-31T16:00:00.000000Z\",\"date_end\":\"2024-08-22T16:00:00.000000Z\"}}', NULL, '2024-08-30 07:55:20', '2024-08-30 07:55:20'),
(60, 'default', 'deleted a Event Information on ID number 13', 'App\\Models\\Event', 'deleted', 13, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"bcycy\",\"description\":\"ybeybcyb\",\"date_start\":\"2024-08-07T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 08:13:47', '2024-08-30 08:13:47'),
(61, 'default', 'deleted a Event Information on ID number 14', 'App\\Models\\Event', 'deleted', 14, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"ueubuuub\",\"description\":\"bububueub\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":\"2024-08-30T16:00:00.000000Z\"}}', NULL, '2024-08-30 08:13:53', '2024-08-30 08:13:53'),
(62, 'default', 'created a Event Information on ID number 17', 'App\\Models\\Event', 'created', 17, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"David wug\",\"description\":\"guwgufgu\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 08:14:05', '2024-08-30 08:14:05'),
(63, 'default', 'created a Event Information on ID number 18', 'App\\Models\\Event', 'created', 18, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"oeihfiwih\",\"description\":\"iihwihwihhi\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 08:18:38', '2024-08-30 08:18:38'),
(64, 'default', 'created a Event Information on ID number 19', 'App\\Models\\Event', 'created', 19, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"khsciahiihhi\",\"description\":\"ihhiw\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":\"2024-08-29T16:00:00.000000Z\"}}', NULL, '2024-08-30 08:22:18', '2024-08-30 08:22:18'),
(65, 'default', 'deleted a Event Information on ID number 18', 'App\\Models\\Event', 'deleted', 18, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"oeihfiwih\",\"description\":\"iihwihwihhi\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 08:23:57', '2024-08-30 08:23:57'),
(66, 'default', 'deleted a Event Information on ID number 12', 'App\\Models\\Event', 'deleted', 12, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"David\",\"description\":\"ybeydyvyv\",\"date_start\":\"2024-08-11T16:00:00.000000Z\",\"date_end\":\"2024-08-11T16:00:00.000000Z\"}}', NULL, '2024-08-30 08:24:11', '2024-08-30 08:24:11'),
(67, 'default', 'created a Event Information on ID number 20', 'App\\Models\\Event', 'created', 20, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"etihwhiihwhi\",\"description\":\"ihehiih\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":\"2024-08-29T16:00:00.000000Z\"}}', NULL, '2024-08-30 08:32:58', '2024-08-30 08:32:58'),
(68, 'default', 'created a Event Information on ID number 21', 'App\\Models\\Event', 'created', 21, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"yvefevy\",\"description\":\"vyvefyv\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":\"2024-08-30T16:00:00.000000Z\"}}', NULL, '2024-08-30 08:34:32', '2024-08-30 08:34:32'),
(69, 'default', 'created a Event Information on ID number 22', 'App\\Models\\Event', 'created', 22, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"tdttdydtydty\",\"description\":\"rytxyrxyxxryryrx\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 08:37:03', '2024-08-30 08:37:03'),
(70, 'default', 'created a Event Information on ID number 23', 'App\\Models\\Event', 'created', 23, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"dvwuu\",\"description\":\"bbwubwub\",\"date_start\":\"2024-08-30T16:00:00.000000Z\",\"date_end\":\"2024-08-23T16:00:00.000000Z\"}}', NULL, '2024-08-30 08:41:53', '2024-08-30 08:41:53'),
(71, 'default', 'deleted a Event Information on ID number 23', 'App\\Models\\Event', 'deleted', 23, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"dvwuu\",\"description\":\"bbwubwub\",\"date_start\":\"2024-08-30T16:00:00.000000Z\",\"date_end\":\"2024-08-23T16:00:00.000000Z\"}}', NULL, '2024-08-30 08:44:30', '2024-08-30 08:44:30'),
(72, 'default', 'deleted a Event Information on ID number 21', 'App\\Models\\Event', 'deleted', 21, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"yvefevy\",\"description\":\"vyvefyv\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":\"2024-08-30T16:00:00.000000Z\"}}', NULL, '2024-08-30 08:44:36', '2024-08-30 08:44:36'),
(73, 'default', 'deleted a Event Information on ID number 19', 'App\\Models\\Event', 'deleted', 19, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"khsciahiihhi\",\"description\":\"ihhiw\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":\"2024-08-29T16:00:00.000000Z\"}}', NULL, '2024-08-30 08:44:44', '2024-08-30 08:44:44'),
(74, 'default', 'created a Event Information on ID number 24', 'App\\Models\\Event', 'created', 24, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"nice event gar\",\"description\":\"this event is shess awitt\",\"date_start\":\"2024-08-23T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 08:47:22', '2024-08-30 08:47:22'),
(75, 'default', 'created a Event Information on ID number 25', 'App\\Models\\Event', 'created', 25, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"jkbfiwbb\",\"description\":\"vwydyv\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 08:48:22', '2024-08-30 08:48:22'),
(76, 'default', 'created a Event Information on ID number 26', 'App\\Models\\Event', 'created', 26, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"Eto ang na add ko after ako mag add event\",\"description\":\"uuefufue\",\"date_start\":\"2024-08-30T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 08:54:47', '2024-08-30 08:54:47'),
(77, 'default', 'created a Event Information on ID number 27', 'App\\Models\\Event', 'created', 27, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"David uf3yfg\",\"description\":\"byvy3y3y\",\"date_start\":\"2024-08-11T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 08:55:09', '2024-08-30 08:55:09'),
(78, 'default', 'created a Event Information on ID number 28', 'App\\Models\\Event', 'created', 28, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"hvcvvyv\",\"description\":\"yyvecvywvy\",\"date_start\":\"2024-08-28T16:00:00.000000Z\",\"date_end\":\"2024-08-29T16:00:00.000000Z\"}}', NULL, '2024-08-30 08:56:08', '2024-08-30 08:56:08'),
(79, 'default', 'created a Event Information on ID number 29', 'App\\Models\\Event', 'created', 29, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"hbbjbjskjk\",\"description\":\"bjbibeyevuy\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 08:58:18', '2024-08-30 08:58:18'),
(80, 'default', 'deleted a Event Information on ID number 29', 'App\\Models\\Event', 'deleted', 29, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"hbbjbjskjk\",\"description\":\"bjbibeyevuy\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 09:00:31', '2024-08-30 09:00:31'),
(81, 'default', 'deleted a Event Information on ID number 28', 'App\\Models\\Event', 'deleted', 28, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"hvcvvyv\",\"description\":\"yyvecvywvy\",\"date_start\":\"2024-08-28T16:00:00.000000Z\",\"date_end\":\"2024-08-29T16:00:00.000000Z\"}}', NULL, '2024-08-30 09:00:36', '2024-08-30 09:00:36'),
(82, 'default', 'deleted a Event Information on ID number 26', 'App\\Models\\Event', 'deleted', 26, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"Eto ang na add ko after ako mag add event\",\"description\":\"uuefufue\",\"date_start\":\"2024-08-30T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 09:00:42', '2024-08-30 09:00:42'),
(83, 'default', 'deleted a Event Information on ID number 25', 'App\\Models\\Event', 'deleted', 25, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"jkbfiwbb\",\"description\":\"vwydyv\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 09:00:58', '2024-08-30 09:00:58'),
(84, 'default', 'deleted a Event Information on ID number 27', 'App\\Models\\Event', 'deleted', 27, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"David uf3yfg\",\"description\":\"byvy3y3y\",\"date_start\":\"2024-08-11T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 16:17:37', '2024-08-30 16:17:37'),
(85, 'default', 'deleted a Event Information on ID number 24', 'App\\Models\\Event', 'deleted', 24, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"nice event gar\",\"description\":\"this event is shess awitt\",\"date_start\":\"2024-08-23T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 16:17:42', '2024-08-30 16:17:42'),
(86, 'default', 'deleted a Event Information on ID number 22', 'App\\Models\\Event', 'deleted', 22, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"tdttdydtydty\",\"description\":\"rytxyrxyxxryryrx\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 16:17:48', '2024-08-30 16:17:48'),
(87, 'default', 'deleted a Event Information on ID number 20', 'App\\Models\\Event', 'deleted', 20, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"etihwhiihwhi\",\"description\":\"ihehiih\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":\"2024-08-29T16:00:00.000000Z\"}}', NULL, '2024-08-30 16:17:55', '2024-08-30 16:17:55'),
(88, 'default', 'created a Event Information on ID number 30', 'App\\Models\\Event', 'created', 30, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"jbvubu\",\"description\":\"uubeuvbebuub\",\"date_start\":\"2024-08-23T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 17:15:37', '2024-08-30 17:15:37'),
(89, 'default', 'deleted a Event Information on ID number 30', 'App\\Models\\Event', 'deleted', 30, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"jbvubu\",\"description\":\"uubeuvbebuub\",\"date_start\":\"2024-08-23T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-30 17:53:21', '2024-08-30 17:53:21'),
(90, 'default', 'created a Event Information on ID number 31', 'App\\Models\\Event', 'created', 31, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"gwgufgwuug\",\"description\":\"gugueguqgu\",\"date_start\":\"2024-08-01T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-08-31 05:14:13', '2024-08-31 05:14:13'),
(91, 'default', 'updated a Event Information on ID number 31', 'App\\Models\\Event', 'updated', 31, 'App\\Models\\User', 1, '{\"attributes\":{\"date_end\":\"2024-08-30T16:00:00.000000Z\"},\"old\":{\"date_end\":null}}', NULL, '2024-08-31 05:28:01', '2024-08-31 05:28:01'),
(92, 'default', 'deleted a Event Information on ID number 31', 'App\\Models\\Event', 'deleted', 31, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"gwgufgwuug\",\"description\":\"gugueguqgu\",\"date_start\":\"2024-08-01T16:00:00.000000Z\",\"date_end\":\"2024-08-30T16:00:00.000000Z\"}}', NULL, '2024-08-31 05:38:02', '2024-08-31 05:38:02'),
(93, 'default', 'deleted a Event Information on ID number 16', 'App\\Models\\Event', 'deleted', 16, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"eventss\",\"description\":\"haha\",\"date_start\":\"2024-07-31T16:00:00.000000Z\",\"date_end\":\"2024-08-22T16:00:00.000000Z\"}}', NULL, '2024-08-31 05:38:06', '2024-08-31 05:38:06'),
(94, 'default', 'updated a Event Information on ID number 17', 'App\\Models\\Event', 'updated', 17, 'App\\Models\\User', 1, '{\"attributes\":{\"date_end\":\"2024-08-30T16:00:00.000000Z\"},\"old\":{\"date_end\":null}}', NULL, '2024-08-31 05:38:40', '2024-08-31 05:38:40'),
(95, 'default', 'updated a Event Information on ID number 17', 'App\\Models\\Event', 'updated', 17, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"David\"},\"old\":{\"title\":\"David wug\"}}', NULL, '2024-08-31 05:40:51', '2024-08-31 05:40:51'),
(96, 'default', 'updated a Event Information on ID number 17', 'App\\Models\\Event', 'updated', 17, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"David wug\"},\"old\":{\"title\":\"David\"}}', NULL, '2024-08-31 05:41:04', '2024-08-31 05:41:04'),
(97, 'default', 'updated a Event Information on ID number 17', 'App\\Models\\Event', 'updated', 17, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"David\"},\"old\":{\"title\":\"David wug\"}}', NULL, '2024-08-31 05:41:16', '2024-08-31 05:41:16'),
(98, 'default', 'updated a Event Information on ID number 17', 'App\\Models\\Event', 'updated', 17, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"Buwan ng Wika\",\"description\":\"Dapat ready kayo lagi pa sa paparating na buwan ng wika\"},\"old\":{\"title\":\"David\",\"description\":\"guwgufgu\"}}', NULL, '2024-09-01 10:29:59', '2024-09-01 10:29:59'),
(99, 'default', 'created a Event Information on ID number 32', 'App\\Models\\Event', 'created', 32, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"hyfy4y\",\"description\":\"gedt3tvt\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 10:30:27', '2024-09-01 10:30:27'),
(100, 'default', 'updated a Event Information on ID number 32', 'App\\Models\\Event', 'updated', 32, 'App\\Models\\User', 1, '{\"attributes\":{\"description\":\"jdj3\",\"date_end\":\"2024-08-31T16:00:00.000000Z\"},\"old\":{\"description\":\"gedt3tvt\",\"date_end\":null}}', NULL, '2024-09-01 11:01:55', '2024-09-01 11:01:55'),
(101, 'default', 'deleted a Event Information on ID number 32', 'App\\Models\\Event', 'deleted', 32, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"hyfy4y\",\"description\":\"jdj3\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":\"2024-08-31T16:00:00.000000Z\"}}', NULL, '2024-09-01 11:02:37', '2024-09-01 11:02:37'),
(102, 'default', 'created a Visitor information on ID number 8', 'App\\Models\\Visitor', 'created', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"date\":\"2024-09-01\",\"first_name\":\"oihuiehefhqi1i\",\"middle_name\":\"hhihi\",\"last_name\":\"ihih\",\"person_to_visit\":\"ihih\",\"purpose\":\"ihi\",\"time_in\":\"19:05:11\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-01 11:05:11', '2024-09-01 11:05:11'),
(103, 'default', 'updated a Visitor information on ID number 8', 'App\\Models\\Visitor', 'updated', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"time_out\":\"19:08:54\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-01 11:08:54', '2024-09-01 11:08:54'),
(104, 'default', 'deleted a Event Information on ID number 10', 'App\\Models\\Event', 'deleted', 10, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"Meeting\",\"description\":\"ihhishiwih\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":\"2024-08-29T16:00:00.000000Z\"}}', NULL, '2024-09-01 11:42:52', '2024-09-01 11:42:52'),
(105, 'default', 'created a Event Information on ID number 33', 'App\\Models\\Event', 'created', 33, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"uhueucbu\",\"description\":\"ubucwbu\",\"date_start\":\"2024-09-10T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 12:04:10', '2024-09-01 12:04:10'),
(106, 'default', 'deleted a Event Information on ID number 33', 'App\\Models\\Event', 'deleted', 33, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"uhueucbu\",\"description\":\"ubucwbu\",\"date_start\":\"2024-09-10T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 12:05:51', '2024-09-01 12:05:51'),
(107, 'default', 'created a Event Information on ID number 34', 'App\\Models\\Event', 'created', 34, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"knnvknknkKNK\",\"description\":\"KNKNWKCK\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 12:07:28', '2024-09-01 12:07:28'),
(108, 'default', 'created a Event Information on ID number 35', 'App\\Models\\Event', 'created', 35, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"bbcjwbjbj\",\"description\":\"wubuwbu\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":\"2024-09-01T16:00:00.000000Z\"}}', NULL, '2024-09-01 12:08:39', '2024-09-01 12:08:39'),
(109, 'default', 'created a Event Information on ID number 36', 'App\\Models\\Event', 'created', 36, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"bwduwbbby\",\"description\":\"yydyvy\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 12:09:58', '2024-09-01 12:09:58'),
(110, 'default', 'created a Event Information on ID number 37', 'App\\Models\\Event', 'created', 37, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"jbeubu\",\"description\":\"ubuuwbw\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 12:11:01', '2024-09-01 12:11:01'),
(111, 'default', 'deleted a Event Information on ID number 37', 'App\\Models\\Event', 'deleted', 37, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"jbeubu\",\"description\":\"ubuuwbw\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 12:14:08', '2024-09-01 12:14:08'),
(112, 'default', 'deleted a Event Information on ID number 36', 'App\\Models\\Event', 'deleted', 36, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"bwduwbbby\",\"description\":\"yydyvy\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 12:14:17', '2024-09-01 12:14:17'),
(113, 'default', 'updated a Event Information on ID number 35', 'App\\Models\\Event', 'updated', 35, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"David\"},\"old\":{\"title\":\"bbcjwbjbj\"}}', NULL, '2024-09-01 12:15:13', '2024-09-01 12:15:13'),
(114, 'default', 'updated a Event Information on ID number 35', 'App\\Models\\Event', 'updated', 35, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"bbcjwbjbj\"},\"old\":{\"title\":\"David\"}}', NULL, '2024-09-01 12:16:20', '2024-09-01 12:16:20'),
(115, 'default', 'deleted a Event Information on ID number 35', 'App\\Models\\Event', 'deleted', 35, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"bbcjwbjbj\",\"description\":\"wubuwbu\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":\"2024-09-01T16:00:00.000000Z\"}}', NULL, '2024-09-01 12:17:20', '2024-09-01 12:17:20'),
(116, 'default', 'deleted a Event Information on ID number 34', 'App\\Models\\Event', 'deleted', 34, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"knnvknknkKNK\",\"description\":\"KNKNWKCK\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 12:17:28', '2024-09-01 12:17:28'),
(117, 'default', 'created a Event Information on ID number 38', 'App\\Models\\Event', 'created', 38, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"jbeuebuu\",\"description\":\"uuefuebu\",\"date_start\":\"2024-09-02T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 12:17:54', '2024-09-01 12:17:54'),
(118, 'default', 'deleted a Event Information on ID number 38', 'App\\Models\\Event', 'deleted', 38, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"jbeuebuu\",\"description\":\"uuefuebu\",\"date_start\":\"2024-09-02T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 14:03:01', '2024-09-01 14:03:01'),
(119, 'default', 'deleted a Event Information on ID number 15', 'App\\Models\\Event', 'deleted', 15, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"David\",\"description\":\"ggs\",\"date_start\":\"2024-08-29T16:00:00.000000Z\",\"date_end\":\"2024-08-30T16:00:00.000000Z\"}}', NULL, '2024-09-01 14:03:13', '2024-09-01 14:03:13'),
(120, 'default', 'created a Event Information on ID number 39', 'App\\Models\\Event', 'created', 39, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"David\",\"description\":\"Nice\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 14:03:37', '2024-09-01 14:03:37'),
(121, 'default', 'created a Event Information on ID number 40', 'App\\Models\\Event', 'created', 40, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"hwuuh\",\"description\":\"uhhufqhu\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 14:03:52', '2024-09-01 14:03:52'),
(122, 'default', 'created a Event Information on ID number 41', 'App\\Models\\Event', 'created', 41, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"nsfhuwhu\",\"description\":\"uhueuhwuh\",\"date_start\":\"2024-09-01T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 14:04:12', '2024-09-01 14:04:12'),
(123, 'default', 'updated a Event Information on ID number 41', 'App\\Models\\Event', 'updated', 41, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"pasok\",\"description\":\"tommor 8 am\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":\"2024-08-31T16:00:00.000000Z\"},\"old\":{\"title\":\"nsfhuwhu\",\"description\":\"uhueuhwuh\",\"date_start\":\"2024-09-01T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 14:06:11', '2024-09-01 14:06:11'),
(124, 'default', 'created a Event Information on ID number 42', 'App\\Models\\Event', 'created', 42, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"jbjbfwjb\",\"description\":\"bbjejbjb\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 14:06:42', '2024-09-01 14:06:42'),
(125, 'default', 'deleted a Event Information on ID number 42', 'App\\Models\\Event', 'deleted', 42, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"jbjbfwjb\",\"description\":\"bbjejbjb\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 14:09:24', '2024-09-01 14:09:24'),
(126, 'default', 'created a Event Information on ID number 43', 'App\\Models\\Event', 'created', 43, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"higehiih\",\"description\":\"ihiih3ihih\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 14:09:43', '2024-09-01 14:09:43'),
(127, 'default', 'deleted a Event Information on ID number 43', 'App\\Models\\Event', 'deleted', 43, 'App\\Models\\User', 1, '{\"old\":{\"user_id\":1,\"title\":\"higehiih\",\"description\":\"ihiih3ihih\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 14:09:50', '2024-09-01 14:09:50'),
(128, 'default', 'created a Event Information on ID number 44', 'App\\Models\\Event', 'created', 44, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"jbzdufuahuhu\",\"description\":\"uhuhwuh\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 14:33:15', '2024-09-01 14:33:15'),
(129, 'default', 'created a Event Information on ID number 45', 'App\\Models\\Event', 'created', 45, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"uuwgfugqgu\",\"description\":\"ugfguwgu\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 14:35:58', '2024-09-01 14:35:58'),
(130, 'default', 'updated a Event Information on ID number 45', 'App\\Models\\Event', 'updated', 45, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"nice\",\"date_end\":\"2024-08-31T16:00:00.000000Z\"},\"old\":{\"title\":\"uuwgfugqgu\",\"date_end\":null}}', NULL, '2024-09-01 14:39:35', '2024-09-01 14:39:35'),
(131, 'default', 'created a Event Information on ID number 46', 'App\\Models\\Event', 'created', 46, 'App\\Models\\User', 1, '{\"attributes\":{\"user_id\":1,\"title\":\"nsnfniwi\",\"description\":\"ninenieni\",\"date_start\":\"2024-08-31T16:00:00.000000Z\",\"date_end\":null}}', NULL, '2024-09-01 14:39:55', '2024-09-01 14:39:55'),
(132, 'default', 'created a Visitor information on ID number 9', 'App\\Models\\Visitor', 'created', 9, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-02\",\"first_name\":\"David\",\"middle_name\":null,\"last_name\":\"Garcia\",\"person_to_visit\":\"CITE\",\"purpose\":\"Request a Letter\",\"time_in\":\"16:05:04\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-02 08:05:04', '2024-09-02 08:05:04'),
(133, 'default', 'updated a Visitor information on ID number 9', 'App\\Models\\Visitor', 'updated', 9, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"16:11:02\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-02 08:11:02', '2024-09-02 08:11:02'),
(134, 'default', 'created a Visitor information on ID number 10', 'App\\Models\\Visitor', 'created', 10, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-02\",\"first_name\":\"David\",\"middle_name\":null,\"last_name\":\"Garcia\",\"person_to_visit\":\"CITE\",\"purpose\":\"Request a Letter\",\"time_in\":\"16:22:24\",\"remarks\":null,\"time_out\":null,\"id_type\":\"National ID\"}}', NULL, '2024-09-02 08:22:24', '2024-09-02 08:22:24'),
(135, 'default', 'updated a Visitor information on ID number 10', 'App\\Models\\Visitor', 'updated', 10, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"17:12:45\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-02 09:12:45', '2024-09-02 09:12:45'),
(136, 'default', 'updated a Visitor information on ID number 10', 'App\\Models\\Visitor', 'updated', 10, 'App\\Models\\User', 2, '{\"attributes\":{\"person_to_visit\":\"CITES\",\"time_in\":\"17:12:45\"},\"old\":{\"person_to_visit\":\"CITE\",\"time_in\":\"16:22:24\"}}', NULL, '2024-09-02 09:13:24', '2024-09-02 09:13:24'),
(137, 'default', 'updated a Visitor information on ID number 10', 'App\\Models\\Visitor', 'updated', 10, 'App\\Models\\User', 2, '{\"attributes\":{\"person_to_visit\":\"CITESSS\"},\"old\":{\"person_to_visit\":\"CITES\"}}', NULL, '2024-09-02 09:14:39', '2024-09-02 09:14:39'),
(138, 'default', 'created a Visitor information on ID number 11', 'App\\Models\\Visitor', 'created', 11, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-02\",\"first_name\":\"njegnjwnjj\",\"middle_name\":\"njnnj\",\"last_name\":\"infnin\",\"person_to_visit\":\"jnnjgjnj\",\"purpose\":\"nnjnjgenj\",\"time_in\":\"17:50:32\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-02 09:50:32', '2024-09-02 09:50:32'),
(139, 'default', 'updated a Visitor information on ID number 11', 'App\\Models\\Visitor', 'updated', 11, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"17:53:39\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-02 09:53:39', '2024-09-02 09:53:39'),
(140, 'default', 'created a Visitor information on ID number 12', 'App\\Models\\Visitor', 'created', 12, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-02\",\"first_name\":\"David\",\"middle_name\":\"D\",\"last_name\":\"Garcia\",\"person_to_visit\":\"CITE\",\"purpose\":\"Request a Letter\",\"time_in\":\"17:54:04\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Driver License ID\"}}', NULL, '2024-09-02 09:54:04', '2024-09-02 09:54:04'),
(141, 'default', 'updated a Visitor information on ID number 12', 'App\\Models\\Visitor', 'updated', 12, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"18:22:05\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-02 10:22:05', '2024-09-02 10:22:05');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(142, 'default', 'updated a Visitor information on ID number 1', 'App\\Models\\Visitor', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"first_name\":\"David Earl Gabriel\"},\"old\":{\"first_name\":\"David\"}}', NULL, '2024-09-02 11:56:33', '2024-09-02 11:56:33'),
(143, 'default', 'updated a Event Information on ID number 46', 'App\\Models\\Event', 'updated', 46, 'App\\Models\\User', 1, '{\"attributes\":{\"title\":\"eventsss\",\"date_end\":\"2024-09-01T16:00:00.000000Z\"},\"old\":{\"title\":\"nsnfniwi\",\"date_end\":null}}', NULL, '2024-09-02 14:33:16', '2024-09-02 14:33:16'),
(144, 'default', 'updated a Visitor information on ID number 12', 'App\\Models\\Visitor', 'updated', 12, 'App\\Models\\User', 2, '{\"attributes\":{\"person_to_visit\":\"CITESS\"},\"old\":{\"person_to_visit\":\"CITE\"}}', NULL, '2024-09-02 14:35:47', '2024-09-02 14:35:47'),
(145, 'default', 'updated a Visitor information on ID number 12', 'App\\Models\\Visitor', 'updated', 12, 'App\\Models\\User', 2, '{\"attributes\":{\"person_to_visit\":\"CITESSsss\"},\"old\":{\"person_to_visit\":\"CITESS\"}}', NULL, '2024-09-02 14:36:37', '2024-09-02 14:36:37'),
(146, 'default', 'updated a Visitor information on ID number 12', 'App\\Models\\Visitor', 'updated', 12, 'App\\Models\\User', 2, '{\"attributes\":{\"purpose\":\"Request a Letterssss\"},\"old\":{\"purpose\":\"Request a Letter\"}}', NULL, '2024-09-02 14:41:47', '2024-09-02 14:41:47'),
(147, 'default', 'updated a Visitor information on ID number 12', 'App\\Models\\Visitor', 'updated', 12, 'App\\Models\\User', 2, '{\"attributes\":{\"purpose\":\"Request a Letter\"},\"old\":{\"purpose\":\"Request a Letterssss\"}}', NULL, '2024-09-02 14:42:26', '2024-09-02 14:42:26'),
(148, 'default', 'updated a Event Information on ID number 46', 'App\\Models\\Event', 'updated', 46, 'App\\Models\\User', 1, '{\"attributes\":{\"description\":\"ninenienissss\"},\"old\":{\"description\":\"ninenieni\"}}', NULL, '2024-09-02 14:44:29', '2024-09-02 14:44:29'),
(149, 'default', 'updated a Event Information on ID number 46', 'App\\Models\\Event', 'updated', 46, 'App\\Models\\User', 1, '{\"attributes\":{\"description\":\"ninenieni\"},\"old\":{\"description\":\"ninenienissss\"}}', NULL, '2024-09-02 14:44:38', '2024-09-02 14:44:38'),
(150, 'default', 'updated a Visitor information on ID number 12', 'App\\Models\\Visitor', 'updated', 12, 'App\\Models\\User', 2, '{\"attributes\":{\"middle_name\":null},\"old\":{\"middle_name\":\"D\"}}', NULL, '2024-09-03 03:56:54', '2024-09-03 03:56:54'),
(151, 'default', 'updated a Visitor information on ID number 12', 'App\\Models\\Visitor', 'updated', 12, 'App\\Models\\User', 2, '{\"attributes\":{\"middle_name\":\"D\",\"person_to_visit\":\"CITESS\"},\"old\":{\"middle_name\":null,\"person_to_visit\":\"CITESSsss\"}}', NULL, '2024-09-03 03:57:03', '2024-09-03 03:57:03'),
(152, 'default', 'updated a Visitor information on ID number 12', 'App\\Models\\Visitor', 'updated', 12, 'App\\Models\\User', 2, '{\"attributes\":{\"person_to_visit\":\"CITE\"},\"old\":{\"person_to_visit\":\"CITESS\"}}', NULL, '2024-09-03 03:57:53', '2024-09-03 03:57:53'),
(153, 'default', 'created a Visitor information on ID number 13', 'App\\Models\\Visitor', 'created', 13, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"hbhvbbh\",\"middle_name\":\"hbhbwh\",\"last_name\":\"ysvhh\",\"person_to_visit\":\"bjjevjbebjb\",\"purpose\":\"jbjejwb\",\"time_in\":\"11:59:02\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 03:59:02', '2024-09-03 03:59:02'),
(154, 'default', 'created a Visitor information on ID number 14', 'App\\Models\\Visitor', 'created', 14, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"David Earl Gabriel\",\"middle_name\":null,\"last_name\":\"Garcia\",\"person_to_visit\":\"CITE\",\"purpose\":\"Request a Letter\",\"time_in\":\"12:00:25\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 04:00:25', '2024-09-03 04:00:25'),
(155, 'default', 'created a Visitor information on ID number 15', 'App\\Models\\Visitor', 'created', 15, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"David Earl Gabriel\",\"middle_name\":null,\"last_name\":\"Garcia\",\"person_to_visit\":\"Gymnast\",\"purpose\":\"Enrollment\",\"time_in\":\"12:01:24\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 04:01:24', '2024-09-03 04:01:24'),
(156, 'default', 'updated a Visitor information on ID number 15', 'App\\Models\\Visitor', 'updated', 15, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"12:03:14\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-03 04:03:15', '2024-09-03 04:03:15'),
(157, 'default', 'updated a Visitor information on ID number 13', 'App\\Models\\Visitor', 'updated', 13, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"12:03:19\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-03 04:03:19', '2024-09-03 04:03:19'),
(158, 'default', 'created a Visitor information on ID number 16', 'App\\Models\\Visitor', 'created', 16, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"David Earl Gabriel\",\"middle_name\":null,\"last_name\":\"Garcia\",\"person_to_visit\":\"CITE\",\"purpose\":\"Request a Letter\",\"time_in\":\"12:03:44\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 04:03:44', '2024-09-03 04:03:44'),
(159, 'default', 'created a Visitor information on ID number 17', 'App\\Models\\Visitor', 'created', 17, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"David Earl Gabriel\",\"middle_name\":null,\"last_name\":\"Garcia\",\"person_to_visit\":\"CITE\",\"purpose\":\"Request a Letter\",\"time_in\":\"12:04:21\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 04:04:21', '2024-09-03 04:04:21'),
(160, 'default', 'updated a Visitor information on ID number 17', 'App\\Models\\Visitor', 'updated', 17, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"12:04:27\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-03 04:04:27', '2024-09-03 04:04:27'),
(161, 'default', 'updated a Visitor information on ID number 17', 'App\\Models\\Visitor', 'updated', 17, 'App\\Models\\User', 2, '{\"attributes\":{\"person_to_visit\":\"CITEa\"},\"old\":{\"person_to_visit\":\"CITE\"}}', NULL, '2024-09-03 04:04:51', '2024-09-03 04:04:51'),
(162, 'default', 'created a Visitor information on ID number 18', 'App\\Models\\Visitor', 'created', 18, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"David Earl Gabriel\",\"middle_name\":null,\"last_name\":\"Garcia\",\"person_to_visit\":\"CITE\",\"purpose\":\"Request a Letter\",\"time_in\":\"12:31:36\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Driver License ID\"}}', NULL, '2024-09-03 04:31:36', '2024-09-03 04:31:36'),
(163, 'default', 'updated a Visitor information on ID number 18', 'App\\Models\\Visitor', 'updated', 18, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"12:32:13\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-03 04:32:13', '2024-09-03 04:32:13'),
(164, 'default', 'created a Visitor information on ID number 19', 'App\\Models\\Visitor', 'created', 19, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"gguegugu\",\"middle_name\":\"gugueuggu\",\"last_name\":\"usufuwgu\",\"person_to_visit\":\"gugueguu\",\"purpose\":\"gugueguw\",\"time_in\":\"12:36:51\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 04:36:51', '2024-09-03 04:36:51'),
(165, 'default', 'created a Visitor information on ID number 20', 'App\\Models\\Visitor', 'created', 20, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"buegfu\",\"middle_name\":\"uguegugu\",\"last_name\":\"jbfwbjbj\",\"person_to_visit\":\"gugegugu\",\"purpose\":\"guuggu\",\"time_in\":\"12:38:20\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 04:38:20', '2024-09-03 04:38:20'),
(166, 'default', 'updated a Visitor information on ID number 20', 'App\\Models\\Visitor', 'updated', 20, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"12:38:29\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-03 04:38:29', '2024-09-03 04:38:29'),
(167, 'default', 'updated a Visitor information on ID number 20', 'App\\Models\\Visitor', 'updated', 20, 'App\\Models\\User', 2, '{\"attributes\":{\"person_to_visit\":\"hahaha\"},\"old\":{\"person_to_visit\":\"gugegugu\"}}', NULL, '2024-09-03 04:39:15', '2024-09-03 04:39:15'),
(168, 'default', 'updated a Visitor information on ID number 20', 'App\\Models\\Visitor', 'updated', 20, 'App\\Models\\User', 2, '{\"attributes\":{\"first_name\":\"Garby\",\"middle_name\":null,\"last_name\":\"Garcia\"},\"old\":{\"first_name\":\"buegfu\",\"middle_name\":\"uguegugu\",\"last_name\":\"jbfwbjbj\"}}', NULL, '2024-09-03 04:39:43', '2024-09-03 04:39:43'),
(169, 'default', 'updated a Visitor information on ID number 19', 'App\\Models\\Visitor', 'updated', 19, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"12:39:56\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-03 04:39:56', '2024-09-03 04:39:56'),
(170, 'default', 'updated a Visitor information on ID number 20', 'App\\Models\\Visitor', 'updated', 20, 'App\\Models\\User', 2, '{\"attributes\":{\"purpose\":\"punta lang sa sm\"},\"old\":{\"purpose\":\"guuggu\"}}', NULL, '2024-09-03 04:40:12', '2024-09-03 04:40:12'),
(171, 'default', 'created a Visitor information on ID number 21', 'App\\Models\\Visitor', 'created', 21, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"Garby\",\"middle_name\":null,\"last_name\":\"Garcia\",\"person_to_visit\":\"hahaha\",\"purpose\":\"shshh\",\"time_in\":\"12:55:47\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 04:55:47', '2024-09-03 04:55:47'),
(172, 'default', 'updated a Visitor information on ID number 21', 'App\\Models\\Visitor', 'updated', 21, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"12:56:17\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-03 04:56:17', '2024-09-03 04:56:17'),
(173, 'default', 'updated a Visitor information on ID number 21', 'App\\Models\\Visitor', 'updated', 21, 'App\\Models\\User', 2, '{\"attributes\":{\"middle_name\":\"D\",\"time_in\":\"12:56:17\"},\"old\":{\"middle_name\":null,\"time_in\":\"12:55:47\"}}', NULL, '2024-09-03 06:03:54', '2024-09-03 06:03:54'),
(174, 'default', 'updated a Visitor information on ID number 20', 'App\\Models\\Visitor', 'updated', 20, 'App\\Models\\User', 2, '{\"attributes\":{\"person_to_visit\":\"ngekss hahaha\",\"time_in\":\"12:38:29\"},\"old\":{\"person_to_visit\":\"hahaha\",\"time_in\":\"12:38:20\"}}', NULL, '2024-09-03 06:04:10', '2024-09-03 06:04:10'),
(175, 'default', 'created a Visitor information on ID number 22', 'App\\Models\\Visitor', 'created', 22, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"David\",\"middle_name\":null,\"last_name\":\"Garcia\",\"person_to_visit\":\"CITE\",\"purpose\":\"Request a Letter\",\"time_in\":\"14:04:40\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 06:04:40', '2024-09-03 06:04:40'),
(176, 'default', 'updated a Visitor information on ID number 22', 'App\\Models\\Visitor', 'updated', 22, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"14:04:48\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-03 06:04:48', '2024-09-03 06:04:48'),
(177, 'default', 'updated a Visitor information on ID number 22', 'App\\Models\\Visitor', 'updated', 22, 'App\\Models\\User', 2, '{\"attributes\":{\"person_to_visit\":\"CITESS\",\"time_in\":\"14:04:48\"},\"old\":{\"person_to_visit\":\"CITE\",\"time_in\":\"14:04:40\"}}', NULL, '2024-09-03 06:08:01', '2024-09-03 06:08:01'),
(178, 'default', 'updated a Visitor information on ID number 22', 'App\\Models\\Visitor', 'updated', 22, 'App\\Models\\User', 2, '{\"attributes\":{\"purpose\":\"Request a LetterS\"},\"old\":{\"purpose\":\"Request a Letter\"}}', NULL, '2024-09-03 06:08:49', '2024-09-03 06:08:49'),
(179, 'default', 'updated a Visitor information on ID number 22', 'App\\Models\\Visitor', 'updated', 22, 'App\\Models\\User', 2, '{\"attributes\":{\"id_type\":\"Employee ID\"},\"old\":{\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 06:11:12', '2024-09-03 06:11:12'),
(180, 'default', 'updated a Visitor information on ID number 22', 'App\\Models\\Visitor', 'updated', 22, 'App\\Models\\User', 2, '{\"attributes\":{\"person_to_visit\":\"CITESSs\"},\"old\":{\"person_to_visit\":\"CITESS\"}}', NULL, '2024-09-03 06:11:30', '2024-09-03 06:11:30'),
(181, 'default', 'updated a Visitor information on ID number 22', 'App\\Models\\Visitor', 'updated', 22, 'App\\Models\\User', 2, '{\"attributes\":{\"purpose\":\"Request a Letter\"},\"old\":{\"purpose\":\"Request a LetterS\"}}', NULL, '2024-09-03 06:12:16', '2024-09-03 06:12:16'),
(182, 'default', 'created a Visitor information on ID number 23', 'App\\Models\\Visitor', 'created', 23, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"David Earl Gabriel\",\"middle_name\":null,\"last_name\":\"Garcia\",\"person_to_visit\":\"CITE\",\"purpose\":\"Request a Letter\",\"time_in\":\"14:13:07\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Driver License ID\"}}', NULL, '2024-09-03 06:13:07', '2024-09-03 06:13:07'),
(183, 'default', 'updated a Visitor information on ID number 23', 'App\\Models\\Visitor', 'updated', 23, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"14:13:14\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-03 06:13:15', '2024-09-03 06:13:15'),
(184, 'default', 'created a Visitor information on ID number 24', 'App\\Models\\Visitor', 'created', 24, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"David Earl Gabriel\",\"middle_name\":null,\"last_name\":\"Garcia\",\"person_to_visit\":\"CITE\",\"purpose\":\"Request a Letter\",\"time_in\":\"14:15:39\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 06:15:39', '2024-09-03 06:15:39'),
(185, 'default', 'created a Visitor information on ID number 25', 'App\\Models\\Visitor', 'created', 25, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"David Earl Gabriel\",\"middle_name\":null,\"last_name\":\"Garcia\",\"person_to_visit\":\"CITE\",\"purpose\":\"Request a Letter\",\"time_in\":\"14:15:46\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 06:15:46', '2024-09-03 06:15:46'),
(186, 'default', 'created a Visitor information on ID number 26', 'App\\Models\\Visitor', 'created', 26, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"David Earl Gabriel\",\"middle_name\":null,\"last_name\":\"Garcia\",\"person_to_visit\":\"CITE\",\"purpose\":\"Request a Letter\",\"time_in\":\"14:16:00\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 06:16:01', '2024-09-03 06:16:01'),
(187, 'default', 'created a Visitor information on ID number 27', 'App\\Models\\Visitor', 'created', 27, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"David Earl Gabriel\",\"middle_name\":null,\"last_name\":\"Garcia\",\"person_to_visit\":\"CITE\",\"purpose\":\"Request a Letter\",\"time_in\":\"14:19:54\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Driver License ID\"}}', NULL, '2024-09-03 06:19:54', '2024-09-03 06:19:54'),
(188, 'default', 'updated a Visitor information on ID number 27', 'App\\Models\\Visitor', 'updated', 27, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"14:20:00\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-03 06:20:00', '2024-09-03 06:20:00'),
(189, 'default', 'created a Visitor information on ID number 28', 'App\\Models\\Visitor', 'created', 28, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"David Earl Gabriel\",\"middle_name\":null,\"last_name\":\"Garcia\",\"person_to_visit\":\"CITE\",\"purpose\":\"Request a Letter\",\"time_in\":\"14:22:42\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 06:22:42', '2024-09-03 06:22:42'),
(190, 'default', 'updated a Visitor information on ID number 28', 'App\\Models\\Visitor', 'updated', 28, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"14:22:49\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-03 06:22:49', '2024-09-03 06:22:49'),
(191, 'default', 'created a Visitor information on ID number 29', 'App\\Models\\Visitor', 'created', 29, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"David Earl Gabriel\",\"middle_name\":null,\"last_name\":\"Garcia\",\"person_to_visit\":\"CITE\",\"purpose\":\"Request a Letter\",\"time_in\":\"14:24:58\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Driver License ID\"}}', NULL, '2024-09-03 06:24:58', '2024-09-03 06:24:58'),
(192, 'default', 'updated a Visitor information on ID number 29', 'App\\Models\\Visitor', 'updated', 29, 'App\\Models\\User', 1, '{\"attributes\":{\"time_out\":\"14:28:03\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-03 06:28:03', '2024-09-03 06:28:03'),
(193, 'default', 'updated a Visitor information on ID number 14', 'App\\Models\\Visitor', 'updated', 14, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"CITEsss\"},\"old\":{\"person_to_visit\":\"CITE\"}}', NULL, '2024-09-03 06:28:46', '2024-09-03 06:28:46'),
(194, 'default', 'updated a Visitor information on ID number 15', 'App\\Models\\Visitor', 'updated', 15, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"Gymnasts\"},\"old\":{\"person_to_visit\":\"Gymnast\"}}', NULL, '2024-09-03 06:28:46', '2024-09-03 06:28:46'),
(195, 'default', 'updated a Visitor information on ID number 16', 'App\\Models\\Visitor', 'updated', 16, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"CITEs\"},\"old\":{\"person_to_visit\":\"CITE\"}}', NULL, '2024-09-03 06:28:46', '2024-09-03 06:28:46'),
(196, 'default', 'updated a Visitor information on ID number 14', 'App\\Models\\Visitor', 'updated', 14, 'App\\Models\\User', 1, '{\"attributes\":{\"purpose\":\"Request a Lettersss\",\"id_type\":\"National ID\"},\"old\":{\"purpose\":\"Request a Letter\",\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 06:30:04', '2024-09-03 06:30:04'),
(197, 'default', 'updated a Visitor information on ID number 15', 'App\\Models\\Visitor', 'updated', 15, 'App\\Models\\User', 1, '{\"attributes\":{\"purpose\":\"Enrollmentsss\",\"id_type\":\"Driver License ID\"},\"old\":{\"purpose\":\"Enrollment\",\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 06:30:04', '2024-09-03 06:30:04'),
(198, 'default', 'updated a Visitor information on ID number 16', 'App\\Models\\Visitor', 'updated', 16, 'App\\Models\\User', 1, '{\"attributes\":{\"purpose\":\"Request a Letterss\",\"id_type\":\"National ID\"},\"old\":{\"purpose\":\"Request a Letter\",\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 06:30:04', '2024-09-03 06:30:04'),
(199, 'default', 'updated a Visitor information on ID number 17', 'App\\Models\\Visitor', 'updated', 17, 'App\\Models\\User', 1, '{\"attributes\":{\"purpose\":\"Request a Letterss\"},\"old\":{\"purpose\":\"Request a Letter\"}}', NULL, '2024-09-03 06:30:04', '2024-09-03 06:30:04'),
(200, 'default', 'updated a Visitor information on ID number 18', 'App\\Models\\Visitor', 'updated', 18, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"CITEs\",\"purpose\":\"Request a Letterss\"},\"old\":{\"person_to_visit\":\"CITE\",\"purpose\":\"Request a Letter\"}}', NULL, '2024-09-03 06:30:04', '2024-09-03 06:30:04'),
(201, 'default', 'updated a Visitor information on ID number 23', 'App\\Models\\Visitor', 'updated', 23, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"CITEss\"},\"old\":{\"person_to_visit\":\"CITE\"}}', NULL, '2024-09-03 06:30:04', '2024-09-03 06:30:04'),
(202, 'default', 'updated a Visitor information on ID number 24', 'App\\Models\\Visitor', 'updated', 24, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"CITEs\",\"purpose\":\"Request a Letterss\"},\"old\":{\"person_to_visit\":\"CITE\",\"purpose\":\"Request a Letter\"}}', NULL, '2024-09-03 06:30:04', '2024-09-03 06:30:04'),
(203, 'default', 'updated a Visitor information on ID number 25', 'App\\Models\\Visitor', 'updated', 25, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"CITEss hahaha\"},\"old\":{\"person_to_visit\":\"CITE\"}}', NULL, '2024-09-03 06:30:04', '2024-09-03 06:30:04'),
(204, 'default', 'updated a Visitor information on ID number 26', 'App\\Models\\Visitor', 'updated', 26, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"CITE shesshh\"},\"old\":{\"person_to_visit\":\"CITE\"}}', NULL, '2024-09-03 06:30:04', '2024-09-03 06:30:04'),
(205, 'default', 'updated a Visitor information on ID number 27', 'App\\Models\\Visitor', 'updated', 27, 'App\\Models\\User', 1, '{\"attributes\":{\"person_to_visit\":\"CITEss\"},\"old\":{\"person_to_visit\":\"CITE\"}}', NULL, '2024-09-03 06:30:04', '2024-09-03 06:30:04'),
(206, 'default', 'updated a Visitor information on ID number 29', 'App\\Models\\Visitor', 'updated', 29, 'App\\Models\\User', 2, '{\"attributes\":{\"person_to_visit\":\"CITEsss\",\"purpose\":\"Request a Letter\\r\\nnabago ito\",\"time_in\":\"14:28:03\"},\"old\":{\"person_to_visit\":\"CITE\",\"purpose\":\"Request a Letter\",\"time_in\":\"14:24:58\"}}', NULL, '2024-09-03 06:34:16', '2024-09-03 06:34:16'),
(207, 'default', 'created a Visitor information on ID number 30', 'App\\Models\\Visitor', 'created', 30, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"yvvyeyvyv`\",\"middle_name\":null,\"last_name\":\"yvyeycvyvy\",\"person_to_visit\":\"yveydvy\",\"purpose\":\"yvvyvyyv\",\"time_in\":\"14:36:27\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 06:36:27', '2024-09-03 06:36:27'),
(208, 'default', 'updated a Visitor information on ID number 30', 'App\\Models\\Visitor', 'updated', 30, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"14:37:06\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-03 06:37:06', '2024-09-03 06:37:06'),
(209, 'default', 'created a Visitor information on ID number 31', 'App\\Models\\Visitor', 'created', 31, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"bwuu\",\"middle_name\":null,\"last_name\":\"beuu\",\"person_to_visit\":\"ububeub\",\"purpose\":\"bubububq\",\"time_in\":\"14:37:21\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 06:37:21', '2024-09-03 06:37:21'),
(210, 'default', 'updated a Visitor information on ID number 31', 'App\\Models\\Visitor', 'updated', 31, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"14:45:53\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-03 06:45:53', '2024-09-03 06:45:53'),
(211, 'default', 'created a Visitor information on ID number 32', 'App\\Models\\Visitor', 'created', 32, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"Garby\",\"middle_name\":null,\"last_name\":\"Garcia\",\"person_to_visit\":\"hahaha\",\"purpose\":\"wdwbhw\",\"time_in\":\"14:50:00\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Driver License ID\"}}', NULL, '2024-09-03 06:50:00', '2024-09-03 06:50:00'),
(212, 'default', 'created a Visitor information on ID number 33', 'App\\Models\\Visitor', 'created', 33, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"bubuu\",\"middle_name\":\"u\",\"last_name\":\"ubebubuu`ubb\",\"person_to_visit\":\"nbhbbh\",\"purpose\":\"bhbhhhb\",\"time_in\":\"14:52:07\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 06:52:07', '2024-09-03 06:52:07'),
(213, 'default', 'created a Visitor information on ID number 34', 'App\\Models\\Visitor', 'created', 34, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"bjbj\",\"middle_name\":null,\"last_name\":\"bcebj\",\"person_to_visit\":\"bjbc\",\"purpose\":\"jbjw\",\"time_in\":\"14:54:39\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 06:54:39', '2024-09-03 06:54:39'),
(214, 'default', 'updated a Visitor information on ID number 34', 'App\\Models\\Visitor', 'updated', 34, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"14:57:09\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-03 06:57:09', '2024-09-03 06:57:09'),
(215, 'default', 'updated a Visitor information on ID number 33', 'App\\Models\\Visitor', 'updated', 33, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"14:57:16\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-03 06:57:16', '2024-09-03 06:57:16'),
(216, 'default', 'updated a Visitor information on ID number 32', 'App\\Models\\Visitor', 'updated', 32, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"14:57:18\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-03 06:57:18', '2024-09-03 06:57:18'),
(217, 'default', 'created a Visitor information on ID number 35', 'App\\Models\\Visitor', 'created', 35, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"David Earl Gabriel\",\"middle_name\":null,\"last_name\":\"Garcia\",\"person_to_visit\":\"CITE\",\"purpose\":\"n eh heh he\",\"time_in\":\"15:36:53\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Driver License ID\"}}', NULL, '2024-09-03 07:36:53', '2024-09-03 07:36:53'),
(218, 'default', 'updated a Visitor information on ID number 35', 'App\\Models\\Visitor', 'updated', 35, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"15:37:03\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-03 07:37:03', '2024-09-03 07:37:03'),
(219, 'default', 'created a Visitor information on ID number 36', 'App\\Models\\Visitor', 'created', 36, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"gvvg\",\"middle_name\":null,\"last_name\":\"evevggg\",\"person_to_visit\":\"vgvgwg\",\"purpose\":\"gvgv\",\"time_in\":\"15:41:10\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 07:41:10', '2024-09-03 07:41:10'),
(220, 'default', 'updated a Visitor information on ID number 36', 'App\\Models\\Visitor', 'updated', 36, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"15:44:18\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-03 07:44:18', '2024-09-03 07:44:18'),
(221, 'default', 'created a Visitor information on ID number 37', 'App\\Models\\Visitor', 'created', 37, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"gvvg\",\"middle_name\":null,\"last_name\":\"evevggg\",\"person_to_visit\":\"vgvgwg\",\"purpose\":\"gvgv\",\"time_in\":\"15:44:51\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Employee ID\"}}', NULL, '2024-09-03 07:44:51', '2024-09-03 07:44:51'),
(222, 'default', 'created a Visitor information on ID number 38', 'App\\Models\\Visitor', 'created', 38, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"gvvg\",\"middle_name\":null,\"last_name\":\"evevggg\",\"person_to_visit\":\"vgvgwg\",\"purpose\":\"gvgv\",\"time_in\":\"15:45:31\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Driver License ID\"}}', NULL, '2024-09-03 07:45:31', '2024-09-03 07:45:31'),
(223, 'default', 'updated a Visitor information on ID number 38', 'App\\Models\\Visitor', 'updated', 38, 'App\\Models\\User', 2, '{\"attributes\":{\"time_out\":\"15:46:13\"},\"old\":{\"time_out\":null}}', NULL, '2024-09-03 07:46:14', '2024-09-03 07:46:14'),
(224, 'default', 'created a Visitor information on ID number 39', 'App\\Models\\Visitor', 'created', 39, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"bubbdbu`\",\"middle_name\":\"bu\",\"last_name\":\"uuuubq\",\"person_to_visit\":\"buubu\",\"purpose\":\"bub\",\"time_in\":\"15:48:15\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 07:48:15', '2024-09-03 07:48:15'),
(225, 'default', 'created a Visitor information on ID number 40', 'App\\Models\\Visitor', 'created', 40, 'App\\Models\\User', 2, '{\"attributes\":{\"user_id\":2,\"date\":\"2024-09-03\",\"first_name\":\"ybbyybkjk\",\"middle_name\":null,\"last_name\":\"eyyy1ybyb\",\"person_to_visit\":\"jbbbkbk\",\"purpose\":\"kbkb\",\"time_in\":\"15:52:20\",\"remarks\":null,\"time_out\":null,\"id_type\":\"Student ID\"}}', NULL, '2024-09-03 07:52:20', '2024-09-03 07:52:20');

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
('user-is-online-1', 'b:1;', 1725345305),
('user-is-online-2', 'b:1;', 1725350240);

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
(3, 2, '20214040', 'David Earl Gabriel', 'D', 'Garcia', 'Male', 'Single', 'user@example.com', '09569473576', '2002-09-04', 'Full-Time', '2024-08-21 12:08:23', '2024-08-21 13:00:07'),
(4, 4, '20217336', 'Raymark', 'B', 'Mina', 'Male', 'Single', 'fizzmina07@gmail.com', '09663205097', '1991-05-16', 'Full-Time', '2024-08-22 11:24:58', '2024-08-22 11:24:58'),
(5, 1, '20213902', 'Angelo Darren', NULL, 'Gabertan', 'Male', 'Single', 'admin@example.com', '0967493573', '2002-07-20', 'Full-Time', '2024-08-26 05:38:00', '2024-08-26 05:38:00');

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
(8, 1, 'Events', 'this event is about feb-ibig kaya asahan nating maraming mga broken', '2024-08-30', '2024-08-30', '2024-08-30 04:35:53', '2024-08-30 04:50:02'),
(17, 1, 'Buwan ng Wika', 'Dapat ready kayo lagi pa sa paparating na buwan ng wika', '2024-08-30', '2024-08-31', '2024-08-30 08:14:05', '2024-09-01 10:29:59'),
(39, 1, 'David', 'Nice', '2024-09-01', NULL, '2024-09-01 14:03:37', '2024-09-01 14:03:37'),
(40, 1, 'hwuuh', 'uhhufqhu', '2024-09-01', NULL, '2024-09-01 14:03:52', '2024-09-01 14:03:52'),
(41, 1, 'pasok', 'tommor 8 am', '2024-09-01', '2024-09-01', '2024-09-01 14:04:12', '2024-09-01 14:06:11'),
(44, 1, 'jbzdufuahuhu', 'uhuhwuh', '2024-09-01', NULL, '2024-09-01 14:33:15', '2024-09-01 14:33:15'),
(45, 1, 'nice', 'ugfguwgu', '2024-09-01', '2024-09-01', '2024-09-01 14:35:58', '2024-09-01 14:39:35'),
(46, 1, 'eventsss', 'ninenieni', '2024-09-01', '2024-09-02', '2024-09-01 14:39:55', '2024-09-02 14:44:38');

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
(1, 1, 'Cup', 'David', 'D', 'Garcia', 'BSIT', '/storage/lost_images/1724289508_pouring flavor.jpg', '2024-08-22 01:18:28', '2024-08-22 01:18:28'),
(2, 4, 'phone', 'Raymark', 'B', 'Mina', 'BSIT', '/storage/lost_images/1724325699_nokia 3210.jpeg', '2024-08-22 11:21:39', '2024-08-22 11:21:39');

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
(17, '2024_08_28_234753_create_violation_table', 2);

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
(3, 4, '10093932939119', 'Angelo Darren', 'D', 'Gabertan', '2024-08-14', '2025-08-14', '/storage/license_photos/1724325588_woman.png', 'BSCE', '2025-08-23', 'AAX 6879', '2999724919', '2024-08-09', 'Motorcycle', '/storage/vehicle_images/1724325588_dio.jpeg', '65732113', '2024-08-22 11:19:48', '2024-08-22 11:19:48', 'A, B, C,');

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
(1, 1, 'P-20240822-1', 'David', 'D', 'Garcia', 'CITE', 'MIT', 'Urdaneta City', 'Non-Teaching', 'Emergency meeting', '2024-08-22', '13:00:00', '09:01:00', '2024-08-22 01:01:47', '2024-08-22 01:01:47', 1);

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
('PUrm2UugVThR7Kwo2tgc8WEn0EC1Yiy4oGqqfGYZ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo0OntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0MjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3Zpc2l0b3I/cGFnZT0yIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6Ink2Zk9XVFZ0VE1aRHcyN1M5WUV3am95RWJBYUxrcU9tNG9oVjRQSGkiO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1725345006),
('wQ2zhgxR6btXQ9aYaQDtJTqFDKqYHVgElwPSlChV', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiazZ1UW5vOFhMbzVSbzUyc1duQ1FyUFBSRjNlRTQxU202RWpkRzZTTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdWItYWRtaW4vdmlzaXRvciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1725349941);

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
(1, 'Admin User', 'admin@example.com', '2024-08-21 04:53:47', '$2y$12$mcPW4nFTI0AsQyByhg5eneFRssGGxjuZ1qMceW.lLLUNnYOojeVUu', 1, '2024-09-03 06:30:06', 'jxVnNHjoXw', '2024-08-21 04:53:48', '2024-09-03 06:30:06'),
(2, 'Regular User', 'user@example.com', '2024-08-21 04:53:48', '$2y$12$7.AJhY0XCnjNs/XqCY6qXOJx/QtVy3eL/u.vpAiVNp35PyzLw00LC', 0, '2024-09-03 07:52:21', 'OWRISeJ3iGkWVg2AEGMCmhtL8XYbI3L73aXq6b01sITxOfMruC96mXacfceN', '2024-08-21 04:53:48', '2024-09-03 07:52:21'),
(3, 'Angelo', 'gabertanjelo@gmail.com', NULL, '$2y$12$7tY3eyGZIfLRW0g/79bqiuCTtLl7/UcKgrOU6HBjN2nNxrVk2D1vW', 0, NULL, NULL, '2024-08-22 10:53:56', '2024-08-22 10:53:56'),
(4, 'Mina', 'fizzmina07@gmail.com', NULL, '$2y$12$dvy307WoufiE9ZtLrFEVlOSQEZBq8/t9pfGLAVsr8DcryYRughVpi', 0, '2024-08-22 11:27:04', NULL, '2024-08-22 11:08:50', '2024-08-22 11:27:04');

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
(5, 1, '20214040', 'Ryan', 'S', 'Cielo', 'BSIT', 'No ID', '2024-08-01', 4, '2024-08-29 01:38:32', '2024-08-29 01:38:32');

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
(1, 2, '2024-08-21', 'David Earl Gabriel', NULL, 'Garcia', 'CITE', 'Request a Letter', '20:40:43', '20:42:16', 'Student ID', '2024-08-21 12:40:43', '2024-09-02 11:56:33', 1),
(3, 1, '2024-08-24', 'Jerimich', NULL, 'Datu', 'HAhaha', '7g7gv7g7', '09:16:33', '09:23:25', 'Student ID', '2024-08-24 01:16:33', '2024-08-28 15:44:08', 1),
(4, 2, '2024-08-24', 'Jeremy', NULL, 'Escalante', 'juguefuweugug', 'guiduviueu', '09:25:06', '09:31:58', 'Student ID', '2024-08-24 01:25:06', '2024-08-24 01:31:58', 1),
(5, 1, '2024-08-24', 'Harold', NULL, 'Gamotea', 'Cites', 'uguwfuwfug', '09:25:10', '09:32:03', 'Student ID', '2024-08-24 01:25:10', '2024-08-28 15:16:32', 1),
(7, 1, '2024-08-26', 'kzudhvushuHU', 'huhgiu', 'hiuhguih', 'uhhuwh', 'huhqu', '13:05:50', '13:46:30', 'Student ID', '2024-08-26 05:05:50', '2024-08-26 05:46:30', 1),
(8, 1, '2024-09-01', 'oihuiehefhqi1i', 'hhihi', 'ihih', 'ihih', 'ihi', '19:05:11', '19:08:54', 'Student ID', '2024-09-01 11:05:11', '2024-09-01 11:08:54', 1),
(9, 2, '2024-09-02', 'David', NULL, 'Garcia', 'CITE', 'Request a Letter', '16:05:04', '16:11:02', 'Student ID', '2024-09-02 08:05:04', '2024-09-02 08:11:02', 1),
(10, 2, '2024-09-02', 'David', NULL, 'Garcia', 'CITESSS', 'Request a Letter', '17:12:45', '17:12:45', 'National ID', '2024-09-02 08:22:24', '2024-09-02 09:14:39', 2),
(11, 2, '2024-09-02', 'njegnjwnjj', 'njnnj', 'infnin', 'jnnjgjnj', 'nnjnjgenj', '17:50:32', '17:53:39', 'Student ID', '2024-09-02 09:50:32', '2024-09-02 09:53:39', 1),
(12, 2, '2024-09-02', 'David', 'D', 'Garcia', 'CITE', 'Request a Letter', '17:54:04', '18:22:05', 'Driver License ID', '2024-09-02 09:54:04', '2024-09-03 03:57:53', 3),
(13, 2, '2024-09-03', 'hbhvbbh', 'hbhbwh', 'ysvhh', 'bjjevjbebjb', 'jbjejwb', '11:59:02', '12:03:19', 'Student ID', '2024-09-03 03:59:02', '2024-09-03 04:03:19', 1),
(14, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'CITEsss', 'Request a Lettersss', '12:00:25', NULL, 'National ID', '2024-09-03 04:00:25', '2024-09-03 06:30:04', 1),
(15, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'Gymnasts', 'Enrollmentsss', '12:01:24', '12:03:14', 'Driver License ID', '2024-09-03 04:01:24', '2024-09-03 06:30:04', 2),
(16, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'CITEs', 'Request a Letterss', '12:03:44', NULL, 'National ID', '2024-09-03 04:03:44', '2024-09-03 06:30:04', 3),
(17, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'CITEa', 'Request a Letterss', '12:04:21', '12:04:27', 'Student ID', '2024-09-03 04:04:21', '2024-09-03 06:30:04', 4),
(18, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'CITEs', 'Request a Letterss', '12:31:36', '12:32:13', 'Driver License ID', '2024-09-03 04:31:36', '2024-09-03 06:30:04', 5),
(19, 2, '2024-09-03', 'gguegugu', 'gugueuggu', 'usufuwgu', 'gugueguu', 'gugueguw', '12:36:51', '12:39:56', 'Student ID', '2024-09-03 04:36:51', '2024-09-03 04:39:56', 1),
(20, 2, '2024-09-03', 'Garby', NULL, 'Garcia', 'ngekss hahaha', 'punta lang sa sm', '12:38:29', '12:38:29', 'Student ID', '2024-09-03 04:38:20', '2024-09-03 06:04:10', 1),
(21, 2, '2024-09-03', 'Garby', 'D', 'Garcia', 'hahaha', 'shshh', '12:56:17', '12:56:17', 'Student ID', '2024-09-03 04:55:47', '2024-09-03 06:03:54', 2),
(22, 2, '2024-09-03', 'David', NULL, 'Garcia', 'CITESSs', 'Request a Letter', '14:04:48', '14:04:48', 'Employee ID', '2024-09-03 06:04:40', '2024-09-03 06:12:16', 1),
(23, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'CITEss', 'Request a Letter', '14:13:07', '14:13:14', 'Driver License ID', '2024-09-03 06:13:07', '2024-09-03 06:30:04', 6),
(24, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'CITEs', 'Request a Letterss', '14:15:39', NULL, 'Student ID', '2024-09-03 06:15:39', '2024-09-03 06:30:04', 7),
(25, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'CITEss hahaha', 'Request a Letter', '14:15:46', NULL, 'Student ID', '2024-09-03 06:15:46', '2024-09-03 06:30:04', 8),
(26, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'CITE shesshh', 'Request a Letter', '14:16:00', NULL, 'Student ID', '2024-09-03 06:16:00', '2024-09-03 06:30:04', 9),
(27, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'CITEss', 'Request a Letter', '14:19:54', '14:20:00', 'Driver License ID', '2024-09-03 06:19:54', '2024-09-03 06:30:04', 10),
(28, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'CITE', 'Request a Letter', '14:22:42', '14:22:49', 'Student ID', '2024-09-03 06:22:42', '2024-09-03 06:22:49', 11),
(29, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'CITEsss', 'Request a Letter\r\nnabago ito', '14:28:03', '14:28:03', 'Driver License ID', '2024-09-03 06:24:58', '2024-09-03 06:34:16', 12),
(30, 2, '2024-09-03', 'yvvyeyvyv`', NULL, 'yvyeycvyvy', 'yveydvy', 'yvvyvyyv', '14:36:27', '14:37:06', 'Student ID', '2024-09-03 06:36:27', '2024-09-03 06:37:06', 1),
(31, 2, '2024-09-03', 'bwuu', NULL, 'beuu', 'ububeub', 'bubububq', '14:37:21', '14:45:53', 'Student ID', '2024-09-03 06:37:21', '2024-09-03 06:45:53', 1),
(32, 2, '2024-09-03', 'Garby', NULL, 'Garcia', 'hahaha', 'wdwbhw', '14:50:00', '14:57:18', 'Driver License ID', '2024-09-03 06:50:00', '2024-09-03 06:57:18', 3),
(33, 2, '2024-09-03', 'bubuu', 'u', 'ubebubuu`ubb', 'nbhbbh', 'bhbhhhb', '14:52:07', '14:57:16', 'Student ID', '2024-09-03 06:52:07', '2024-09-03 06:57:16', 1),
(34, 2, '2024-09-03', 'bjbj', NULL, 'bcebj', 'bjbc', 'jbjw', '14:54:39', '14:57:09', 'Student ID', '2024-09-03 06:54:39', '2024-09-03 06:57:09', 1),
(35, 2, '2024-09-03', 'David Earl Gabriel', NULL, 'Garcia', 'CITE', 'n eh heh he', '15:36:53', '15:37:03', 'Driver License ID', '2024-09-03 07:36:53', '2024-09-03 07:37:03', 13),
(36, 2, '2024-09-03', 'gvvg', NULL, 'evevggg', 'vgvgwg', 'gvgv', '15:41:10', '15:44:18', 'Student ID', '2024-09-03 07:41:10', '2024-09-03 07:44:18', 1),
(37, 2, '2024-09-03', 'gvvg', NULL, 'evevggg', 'vgvgwg', 'gvgv', '15:44:51', NULL, 'Employee ID', '2024-09-03 07:44:51', '2024-09-03 07:44:51', 2),
(38, 2, '2024-09-03', 'gvvg', NULL, 'evevggg', 'vgvgwg', 'gvgv', '15:45:31', '15:46:13', 'Driver License ID', '2024-09-03 07:45:31', '2024-09-03 07:46:13', 3),
(39, 2, '2024-09-03', 'bubbdbu`', 'bu', 'uuuubq', 'buubu', 'bub', '15:48:15', NULL, 'Student ID', '2024-09-03 07:48:15', '2024-09-03 07:48:15', 1),
(40, 2, '2024-09-03', 'ybbyybkjk', NULL, 'eyyy1ybyb', 'jbbbkbk', 'kbkb', '15:52:20', NULL, 'Student ID', '2024-09-03 07:52:20', '2024-09-03 07:52:20', 1);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `parkings`
--
ALTER TABLE `parkings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pass_slips`
--
ALTER TABLE `pass_slips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `violations`
--
ALTER TABLE `violations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
