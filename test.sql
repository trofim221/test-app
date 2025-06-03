

CREATE TABLE `admin_permissions` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `permission_key` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `admin_permissions` (`admin_id`, `permission_key`) VALUES
(4, 'view_statistics');

CREATE TABLE `admin_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','moderator','superadmin') DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_superadmin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `admin_users` (`id`, `username`, `email`, `password`, `role`, `created_at`, `is_superadmin`) VALUES
(1, 'superadmin', 'admin@gmail.com', '$2y$12$C21d41rE94YhLzTwlwCNo.jWlyuFZUqbifV9VKVXSNJNZ.wcWXLzO', 'superadmin', '2025-06-01 20:50:56', 1),
(3, 'admin1', 'admin1@gmail.com', '$2y$12$q7GzNuYm1PHUJEYa4epHm.ZjwvUW75.7SzehxPBQZRQIJuZm6NQmO', 'admin', '2025-06-02 08:32:32', 1),
(4, 'admin2', 'admin2@gmail.com', '$2y$12$poWJhaeeR0kZuaJ5hn7pnu4pmV18Ibmhri4QBO3.Cat5TAqSUg9VW', 'admin', '2025-06-02 08:33:08', 0);


CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `role` enum('basic','premium','pro') DEFAULT 'basic',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `email`, `password`, `name`, `role`, `created_at`) VALUES
(1, 'user1@gmail.com', '$2y$12$xoiOqZV2dB/YWAmDJUv8Cubd9zKlvjJuApqcdfkBwLLoEeTK2n2vq', 'User', 'basic', '2025-06-02 13:00:11'),
(2, 'jonh@gmail.com', '$2y$12$mZ8F0Z5VTHaSCWE65OkyNOQ2BgpS6dtHFHfg0aloeuLK3ORRXUXwK', 'jonh', 'basic', '2025-06-03 10:45:14'),
(3, 'ben@gmail.com', '$2y$12$FGwzT1/ACJQbSivgikHXluOoYjzh7ss3Y.euTZMGVn4tn361AAIym', 'Ben', 'basic', '2025-06-03 11:23:48'),
(4, 'mayls@gmail.com', '$2y$12$/VI5upItLUD43it7yOhps.K8a9DC54JkNFoahLmEoSn.t71R.Ld7m', 'mayls', 'basic', '2025-06-03 11:43:00');


CREATE TABLE `user_events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` enum('login','logout','registration','view-page','button-click') DEFAULT NULL,
  `details` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `user_events` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES
(1, 1, 'registration', NULL, '2025-06-02 16:00:11'),
(2, 1, 'view-page', 'page-a', '2025-06-02 16:49:47'),
(3, 1, 'view-page', 'page-a', '2025-06-02 16:50:10'),
(4, 1, 'view-page', 'page-a', '2025-06-02 16:51:30'),
(5, 1, 'view-page', 'page-a', '2025-06-02 16:53:58'),
(6, 1, 'view-page', 'page-a', '2025-06-02 16:53:59'),
(7, 1, 'view-page', 'page-a', '2025-06-02 16:58:19'),
(8, 1, 'view-page', 'page-a', '2025-06-02 17:00:20'),
(9, 1, 'view-page', 'page-a', '2025-06-02 17:00:20'),
(10, 1, 'button-click', 'buy-cow', '2025-06-02 17:00:22'),
(11, 1, 'view-page', 'page-a', '2025-06-02 17:00:22'),
(12, 1, 'view-page', 'page-a', '2025-06-02 17:04:50'),
(13, 1, 'view-page', 'page-a', '2025-06-02 17:04:52'),
(14, 1, 'view-page', 'page-a', '2025-06-02 17:04:53'),
(15, 1, 'view-page', 'page-a', '2025-06-02 17:04:55'),
(16, 1, 'view-page', 'page-a', '2025-06-02 17:04:56'),
(17, 1, 'view-page', 'page-a', '2025-06-02 17:05:03'),
(18, 1, 'view-page', 'page-a', '2025-06-02 17:05:40'),
(19, 1, 'view-page', 'page-a', '2025-06-02 17:06:12'),
(20, 1, 'view-page', 'page-a', '2025-06-02 17:11:15'),
(21, 1, 'view-page', 'page-a', '2025-06-02 23:28:46'),
(22, 1, 'view-page', 'page-a', '2025-06-02 23:29:30'),
(23, 1, 'view-page', 'page-a', '2025-06-02 23:29:31'),
(24, 1, 'view-page', 'page-a', '2025-06-02 23:29:41'),
(25, 1, 'view-page', 'page-a', '2025-06-02 23:29:43'),
(26, 1, 'view-page', 'page-a', '2025-06-02 23:29:51'),
(27, 1, 'view-page', 'page-a', '2025-06-02 23:30:14'),
(28, 1, 'view-page', 'page-a', '2025-06-02 23:30:31'),
(29, 1, 'view-page', 'page-a', '2025-06-02 23:30:41'),
(30, 1, 'view-page', 'page-a', '2025-06-02 23:30:42'),
(31, 1, 'view-page', 'page-a', '2025-06-02 23:30:51'),
(32, 1, 'view-page', 'page-a', '2025-06-02 23:30:51'),
(33, 1, 'view-page', 'page-a', '2025-06-02 23:31:02'),
(34, 1, 'view-page', 'page-a', '2025-06-02 23:31:02'),
(35, 1, 'view-page', 'page-a', '2025-06-02 23:31:03'),
(36, 1, 'view-page', 'page-a', '2025-06-02 23:31:03'),
(37, 1, 'view-page', 'page-a', '2025-06-02 23:31:51'),
(38, 1, 'view-page', 'page-a', '2025-06-02 23:32:01'),
(39, 1, 'view-page', 'page-a', '2025-06-02 23:32:02'),
(40, 1, 'button-click', 'buy-cow', '2025-06-02 23:32:04'),
(41, 1, 'view-page', 'page-a', '2025-06-02 23:32:04'),
(42, 1, 'view-page', 'page-a', '2025-06-02 23:42:40'),
(43, 1, 'view-page', 'page-a', '2025-06-02 23:42:42'),
(44, 1, 'view-page', 'page-a', '2025-06-02 23:42:42'),
(45, 1, 'view-page', 'page-a', '2025-06-02 23:43:18'),
(46, NULL, 'view-page', 'page-a', '2025-06-02 23:43:33'),
(47, NULL, 'view-page', 'page-a', '2025-06-02 23:44:06'),
(48, NULL, 'button-click', 'buy-cow', '2025-06-02 23:44:07'),
(49, NULL, 'view-page', 'page-a', '2025-06-02 23:44:07'),
(50, 1, 'view-page', 'page-a', '2025-06-02 23:45:32'),
(51, 1, 'view-page', 'page-a', '2025-06-02 23:45:34'),
(52, 1, 'view-page', 'page-a', '2025-06-02 23:45:35'),
(53, 1, 'view-page', 'page-a', '2025-06-03 00:26:59'),
(54, 1, 'view-page', 'page-a', '2025-06-03 00:27:04'),
(55, 1, 'view-page', 'page-a', '2025-06-03 00:27:13'),
(56, NULL, 'view-page', 'page-a', '2025-06-03 00:46:32'),
(57, NULL, 'view-page', 'page-a', '2025-06-03 09:42:05'),
(58, 1, 'view-page', 'page-a', '2025-06-03 10:10:42'),
(59, 1, 'view-page', 'page-a', '2025-06-03 10:10:43'),
(60, 1, 'view-page', 'page-a', '2025-06-03 10:10:52'),
(61, 1, 'view-page', 'page-a', '2025-06-03 10:10:53'),
(62, 1, 'view-page', 'page-a', '2025-06-03 10:10:53'),
(63, 1, 'view-page', 'page-a', '2025-06-03 10:10:56'),
(64, 1, 'view-page', 'page-a', '2025-06-03 10:15:57'),
(65, 1, 'view-page', 'page-a', '2025-06-03 10:52:39'),
(66, 1, 'view-page', 'page-a', '2025-06-03 10:54:37'),
(67, 1, 'view-page', 'page-a', '2025-06-03 10:56:41'),
(68, NULL, 'view-page', 'page-a', '2025-06-03 11:25:36'),
(69, NULL, 'view-page', 'page-a', '2025-06-03 11:25:42'),
(70, NULL, 'view-page', 'page-a', '2025-06-03 11:26:12'),
(71, NULL, 'view-page', 'page-a', '2025-06-03 11:26:14'),
(72, NULL, 'view-page', 'page-a', '2025-06-03 11:30:41'),
(73, NULL, 'button-click', 'buy-cow', '2025-06-03 11:31:40'),
(74, NULL, 'view-page', 'page-a', '2025-06-03 11:31:40'),
(75, NULL, 'view-page', 'page-b', '2025-06-03 12:05:50'),
(76, NULL, 'view-page', 'page-b', '2025-06-03 12:09:29'),
(77, 1, 'view-page', 'page-b', '2025-06-03 12:09:37'),
(78, 1, 'view-page', 'page-b', '2025-06-03 12:13:36'),
(79, 1, 'view-page', 'page-b', '2025-06-03 12:13:37'),
(80, 1, 'button-click', 'download', '2025-06-03 12:13:47'),
(81, 1, 'view-page', 'page-b', '2025-06-03 12:27:15'),
(82, 1, 'button-click', 'download', '2025-06-03 12:27:17'),
(83, 1, 'view-page', 'page-b', '2025-06-03 12:27:47'),
(84, 1, 'button-click', 'download', '2025-06-03 12:27:48'),
(85, 1, 'view-page', 'page-b', '2025-06-03 12:27:50'),
(86, 1, 'button-click', 'download', '2025-06-03 12:27:51'),
(87, 1, 'view-page', 'page-b', '2025-06-03 12:28:07'),
(88, 1, 'button-click', 'download', '2025-06-03 12:28:08'),
(89, 1, 'button-click', 'download', '2025-06-03 12:28:09'),
(90, 1, 'view-page', 'page-b', '2025-06-03 12:30:15'),
(91, 1, 'button-click', 'download', '2025-06-03 12:30:16'),
(92, 1, 'view-page', 'page-b', '2025-06-03 12:36:39'),
(93, 1, 'view-page', 'page-a', '2025-06-03 12:36:40'),
(94, 1, 'view-page', 'page-a', '2025-06-03 12:36:41'),
(95, 1, 'view-page', 'page-b', '2025-06-03 12:36:42'),
(96, 1, 'view-page', 'page-a', '2025-06-03 12:36:48'),
(97, 1, 'view-page', 'page-b', '2025-06-03 12:36:49'),
(98, 1, 'view-page', 'page-a', '2025-06-03 12:36:51'),
(99, 1, 'view-page', 'page-b', '2025-06-03 12:36:52'),
(100, 1, 'view-page', 'page-b', '2025-06-03 12:38:09'),
(101, 1, 'view-page', 'page-b', '2025-06-03 12:52:02'),
(102, 1, 'view-page', 'page-b', '2025-06-03 12:52:17'),
(103, 1, 'view-page', 'page-a', '2025-06-03 12:54:31'),
(104, 1, 'button-click', 'buy-cow', '2025-06-03 12:54:32'),
(105, 1, 'view-page', 'page-a', '2025-06-03 12:54:32'),
(106, 1, 'view-page', 'page-a', '2025-06-03 12:54:37'),
(107, 1, 'button-click', 'buy-cow', '2025-06-03 12:54:38'),
(108, 1, 'view-page', 'page-a', '2025-06-03 12:54:38'),
(109, 1, 'view-page', 'page-a', '2025-06-03 12:54:40'),
(110, 1, 'button-click', 'buy-cow', '2025-06-03 12:54:44'),
(111, 1, 'view-page', 'page-a', '2025-06-03 12:54:44'),
(112, 1, 'view-page', 'page-a', '2025-06-03 12:59:22'),
(113, 1, 'view-page', 'page-b', '2025-06-03 12:59:22'),
(114, 1, 'view-page', 'page-a', '2025-06-03 12:59:23'),
(115, 1, 'view-page', 'page-a', '2025-06-03 12:59:29'),
(116, 1, 'view-page', 'page-a', '2025-06-03 12:59:32'),
(117, 1, 'view-page', 'page-b', '2025-06-03 12:59:32'),
(118, 1, 'button-click', 'download', '2025-06-03 13:23:09'),
(119, 1, 'view-page', 'page-b', '2025-06-03 13:27:15'),
(120, 1, 'logout', '', '2025-06-03 13:39:46'),
(121, 2, 'registration', NULL, '2025-06-03 13:45:14'),
(122, NULL, 'registration', '', '2025-06-03 13:45:14'),
(123, NULL, 'login', '', '2025-06-03 13:55:55'),
(124, 2, 'view-page', 'page-a', '2025-06-03 13:55:55'),
(125, 2, 'button-click', 'buy-cow', '2025-06-03 13:55:56'),
(126, 2, 'view-page', 'page-a', '2025-06-03 13:55:56'),
(127, 2, 'view-page', 'page-b', '2025-06-03 13:55:58'),
(128, 2, 'button-click', 'download', '2025-06-03 13:55:59'),
(129, 2, 'view-page', 'page-b', '2025-06-03 13:58:51'),
(130, NULL, 'logout', '', '2025-06-03 14:23:14'),
(131, 3, 'registration', NULL, '2025-06-03 14:23:48'),
(132, NULL, 'registration', '', '2025-06-03 14:23:48'),
(133, NULL, 'login', '', '2025-06-03 14:27:10'),
(134, 3, 'view-page', 'page-a', '2025-06-03 14:27:10'),
(135, 3, 'view-page', 'page-b', '2025-06-03 14:27:12'),
(136, 3, 'view-page', 'page-b', '2025-06-03 14:27:15'),
(137, NULL, 'login', '', '2025-06-03 14:27:42'),
(138, 3, 'view-page', 'page-a', '2025-06-03 14:27:42'),
(139, 3, 'view-page', 'page-a', '2025-06-03 14:28:02'),
(140, 3, 'view-page', 'page-a', '2025-06-03 14:28:04'),
(141, 3, 'logout', '', '2025-06-03 14:28:07'),
(142, 3, 'view-page', 'page-a', '2025-06-03 14:29:18'),
(143, 3, 'logout', '', '2025-06-03 14:29:20'),
(144, NULL, 'view-page', 'page-b', '2025-06-03 14:36:36'),
(145, NULL, 'view-page', 'page-b', '2025-06-03 14:36:38'),
(146, NULL, 'view-page', 'page-b', '2025-06-03 14:40:48'),
(147, NULL, 'view-page', 'page-b', '2025-06-03 14:40:50'),
(148, NULL, 'view-page', 'page-b', '2025-06-03 14:40:52'),
(149, NULL, 'button-click', 'download', '2025-06-03 14:40:53'),
(150, NULL, 'login', '', '2025-06-03 14:41:11'),
(151, 2, 'view-page', 'page-a', '2025-06-03 14:41:12'),
(152, 2, 'view-page', 'page-a', '2025-06-03 14:41:16'),
(153, 2, 'view-page', 'page-b', '2025-06-03 14:41:16'),
(154, 2, 'view-page', 'page-a', '2025-06-03 14:41:17'),
(155, 2, 'button-click', 'buy-cow', '2025-06-03 14:41:17'),
(156, 2, 'view-page', 'page-a', '2025-06-03 14:41:17'),
(157, 2, 'logout', '', '2025-06-03 14:42:07'),
(158, 4, 'registration', NULL, '2025-06-03 14:43:00'),
(159, NULL, 'registration', '', '2025-06-03 14:43:00'),
(160, NULL, 'login', '', '2025-06-03 14:43:27'),
(161, 4, 'view-page', 'page-a', '2025-06-03 14:43:27'),
(162, 4, 'logout', '', '2025-06-03 14:43:33');

--
ALTER TABLE `admin_permissions`
  ADD PRIMARY KEY (`admin_id`,`permission_key`);

ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `user_events`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `admin_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `user_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;


ALTER TABLE `admin_permissions`
  ADD CONSTRAINT `admin_permissions_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin_users` (`id`) ON DELETE CASCADE;
COMMIT;
