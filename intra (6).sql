-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 16 avr. 2024 à 20:46
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `intra`
--

-- --------------------------------------------------------

--
-- Structure de la table `badges`
--

CREATE TABLE `badges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `badge` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `badges`
--

INSERT INTO `badges` (`id`, `name`, `badge`, `is_active`, `created_at`, `updated_at`, `image`, `description`) VALUES
(1, 'Admin', 'Administrateur', 1, '2023-06-16 11:48:35', '2023-06-16 11:48:35', 'admin.png', 'Avoir le rôle Administrateur'),
(2, 'Champion', 'Champion', 1, '2023-06-16 11:48:35', '2023-06-16 11:48:35', 'champion.png', 'Être champion d\'un jeu'),
(3, 'Commentor', 'Commentor', 1, '2023-06-16 11:48:35', '2023-06-16 11:48:35', 'commentor.png', 'Avoir publié au moins dix commentaires'),
(4, 'Contributor', 'Contributeur', 1, '2023-06-16 11:48:35', '2023-06-16 11:48:35', 'contributor.png', 'Avoir contribué au dépot Github'),
(5, '5 Amis', 'Amical', 1, '2023-06-16 11:48:35', '2023-06-16 11:48:35', 'friends_5.png', 'Avoir au moins 5 amis'),
(6, '10 Amis', 'Populaire', 1, '2023-06-16 11:48:35', '2023-06-16 11:48:35', 'friends_10.png', 'Avoir au moins 10 amis'),
(7, 'Gamer', 'Joueur', 1, '2023-06-16 11:48:35', '2023-06-16 11:48:35', 'gamer.png', 'Avoir une place dans les classements de tous nos jeux'),
(8, 'Niveau 5', 'Niveau 5', 1, '2023-06-16 11:48:35', '2023-06-16 11:48:35', 'level_5.png', 'Atteindre le niveau 5'),
(9, 'Niveau 10', 'Niveau 10', 1, '2023-06-16 11:48:35', '2023-06-16 11:48:35', 'level_10.png', 'Atteindre le niveau 10'),
(10, 'Niveau 20', 'Niveau 20', 1, '2023-06-16 11:48:35', '2023-06-16 11:48:35', 'level_20.png', 'Atteindre le niveau 20'),
(11, 'Liked', 'Apprécié', 1, '2023-06-16 11:48:35', '2023-06-16 11:48:35', 'liked.png', 'Avoir au moins 10 likes sur l\'ensemble de ses posts'),
(12, 'Publisher', 'Publieur', 1, '2023-06-16 11:48:35', '2023-06-16 11:48:35', 'publisher.png', 'Avoir publié au moins 5 posts'),
(13, 'Reporter', 'Rapporteur', 1, '2023-06-16 11:48:35', '2023-06-16 11:48:35', 'reporter.png', 'Avoir publié au moins 5 rapports'),
(14, 'Validate', 'Validé', 1, '2023-06-16 11:48:35', '2023-06-16 11:48:35', 'validate.png', 'Compte validé');

-- --------------------------------------------------------

--
-- Structure de la table `ch_favorites`
--

CREATE TABLE `ch_favorites` (
  `id` char(36) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `favorite_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ch_favorites`
--

INSERT INTO `ch_favorites` (`id`, `user_id`, `favorite_id`, `created_at`, `updated_at`) VALUES
('64a2a66c71e09', 1, 13, '2023-07-03 08:43:56', '2023-07-03 08:43:56'),
('64a2a66c722e5', 13, 1, '2023-07-03 08:43:56', '2023-07-03 08:43:56');

-- --------------------------------------------------------

--
-- Structure de la table `ch_messages`
--

CREATE TABLE `ch_messages` (
  `id` char(36) NOT NULL,
  `from_id` bigint(20) NOT NULL,
  `to_id` bigint(20) NOT NULL,
  `body` varchar(5000) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ch_messages`
--

INSERT INTO `ch_messages` (`id`, `from_id`, `to_id`, `body`, `attachment`, `seen`, `created_at`, `updated_at`) VALUES
('263a954f-9d14-477a-8d45-2ee0bd4d044b', 1, 2, 'Salut comment tu vas?', NULL, 1, '2023-07-03 08:10:23', '2023-07-03 08:10:29'),
('33e60e8e-fe63-43d4-82a4-d486d8fcc79d', 1, 2, 'Lol', NULL, 1, '2023-07-03 08:10:48', '2023-07-03 08:10:48'),
('377d4991-2bb1-4b73-836a-586bbbe5679d', 2, 1, '', '{\"new_name\":\"1b5eb556-ec71-4ab2-98bb-f4342ba2ff3f.png\",\"old_name\":\"2023-07-02 23_19_57-Window.png\"}', 1, '2023-07-03 08:10:44', '2023-07-03 08:10:45'),
('898c4d60-dd6f-4f14-bc3a-3838c0874402', 2, 1, '😀😀😀😀😀😀😀😀😀', NULL, 1, '2023-07-03 08:10:40', '2023-07-03 08:10:40'),
('cf3b73f0-5491-48b5-96de-993ba44970be', 2, 1, 'Bien et toi?', NULL, 1, '2023-07-03 08:10:34', '2023-07-03 08:10:34');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` int(11) NOT NULL,
  `message` text NOT NULL,
  `code` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
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
-- Structure de la table `friendships`
--

CREATE TABLE `friendships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `friend_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `confirm` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `friendships`
--

INSERT INTO `friendships` (`id`, `user_id`, `friend_id`, `created_at`, `updated_at`, `confirm`) VALUES
(301, 13, 1, '2023-07-03 08:43:50', '2023-07-03 08:43:50', 1),
(302, 1, 13, '2023-07-03 08:43:56', '2023-07-03 08:43:56', 1);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_06_06_133419_create_roles_table', 1),
(5, '2023_06_06_133443_create_status_table', 1),
(6, '2023_06_06_133502_create_badges_table', 1),
(7, '2023_06_06_133502_create_users_table', 1),
(8, '2023_06_06_133527_create_users_badges_table', 1),
(9, '2023_06_06_133543_create_posts_table', 1),
(10, '2023_06_06_133603_create_comments_table', 1),
(11, '2023_06_06_134129_create_user_roles_table', 1),
(12, '2023_06_08_210055_add_role_id_to_users', 1),
(13, '2023_06_12_103020_create_sections_table', 1),
(14, '2023_06_13_124117_create_likes_table', 1),
(15, '2023_06_14_102502_add_columns_to_comments_table', 2),
(16, '2023_06_15_082119_create_rapports_table', 3),
(17, '2023_06_15_205051_create_news_table', 4),
(18, '2023_06_16_133108_add_image_to_badges_table', 5),
(19, '2023_06_16_133300_add_description_to_badges_table', 6),
(20, '2023_06_16_170114_create_friendships_table', 7),
(21, '2023_06_16_170557_create_notifications_table', 8),
(22, '2023_06_17_202217_add_columns_to_friendship_table', 9),
(23, '2023_06_18_174936_add_author_id_to_notifications', 10),
(24, '2023_06_18_183004_add_columns_to_notifications_table', 11),
(31, '2014_10_12_000000_create_users_table', 12),
(32, '2014_10_12_200000_add_two_factor_columns_to_users_table', 12),
(33, '2023_06_19_154618_add_missing_columns_to_users_table', 13),
(34, '2023_06_19_155428_add_first_name_last_name_to_users_table', 13),
(35, '2023_06_19_999999_add_active_status_to_users', 13),
(36, '2023_06_19_999999_add_avatar_to_users', 13),
(37, '2023_06_19_999999_add_dark_mode_to_users', 13),
(38, '2023_06_19_999999_add_messenger_color_to_users', 13),
(39, '2023_06_19_999999_create_chatify_favorites_table', 13),
(40, '2023_06_19_999999_create_chatify_messages_table', 13),
(41, '2023_06_20_190205_add_column_to_notifications_table', 14),
(43, '2023_07_02_214130_create_scores_table', 15);

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `image`, `user_id`, `created_at`, `updated_at`) VALUES
(32, 'fezfzeze ffe zefzezef  zefzfezefze', '<p>ze fzezfe zfe zefzfe</p>', NULL, 1, '2023-07-03 10:43:18', '2023-07-03 10:43:18');

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(255) NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` int(11) NOT NULL,
  `friendship` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `author_id`, `user_id`, `message`, `read`, `created_at`, `updated_at`, `type`, `friendship`) VALUES
(283, NULL, 1, 'Une nouvelle alerte de spamming a été lancée!', 1, '2023-07-03 08:32:26', '2023-07-03 08:32:26', 0, NULL),
(284, NULL, 1, 'Une nouvelle alerte de spamming a été lancée!', 1, '2023-07-03 08:33:01', '2023-07-03 08:33:01', 0, NULL),
(285, 13, 1, 'Lockwood Sarah vous a envoyé une invitation!', 1, '2023-07-03 08:43:50', '2023-07-03 08:43:50', 1, 301),
(286, 1, 13, 'Anthony Delmeire a accepté votre invitation.', 0, '2023-07-03 08:43:56', '2023-07-03 08:43:56', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `code` text DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `author`, `message`, `code`, `language`, `created_at`, `updated_at`, `is_active`, `section_id`) VALUES
(124, 'erger', 1, 'ger', 'geregr', 'PHP', '2023-07-03 09:40:47', '2023-07-03 09:40:47', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `rapports`
--

CREATE TABLE `rapports` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `rapports`
--

INSERT INTO `rapports` (`id`, `user_id`, `title`, `message`, `created_at`, `updated_at`) VALUES
(14, NULL, 'Concerne @JamesRodriguez', 'Spamming de publications potentiel.', '2023-06-30 12:02:50', '2023-06-30 12:02:50'),
(15, NULL, 'Concerne @JamesRodriguez', 'Spamming de publications potentiel.', '2023-06-30 12:09:34', '2023-06-30 12:09:34'),
(16, NULL, 'Concerne @JamesRodriguez', 'Spamming de publications potentiel.', '2023-06-30 12:11:16', '2023-06-30 12:11:16'),
(17, NULL, 'Concerne @JamesRodriguez', 'Spamming de commentaires potentiel.', '2023-06-30 12:18:30', '2023-06-30 12:18:30'),
(18, NULL, 'Concerne @JamesRodriguez', 'Spamming de commentaires potentiel.', '2023-06-30 12:20:31', '2023-06-30 12:20:31'),
(26, 1, 'zeefzzef', 'ezfzefzef', '2023-07-02 20:36:34', '2023-07-02 20:36:34'),
(27, 1, 'zefzefzfzef', 'ezfzfzef', '2023-07-02 20:37:08', '2023-07-02 20:37:08'),
(28, 1, '(gregerger', 'egregergegegr', '2023-07-02 20:38:33', '2023-07-02 20:38:33'),
(29, NULL, 'Concerne @AnthonyDelmeire', 'Spamming de publications potentiel.', '2023-07-03 05:21:36', '2023-07-03 05:21:36'),
(30, NULL, 'Concerne @AnthonyDelmeire', 'Spamming de publications potentiel.', '2023-07-03 07:41:56', '2023-07-03 07:41:56'),
(31, NULL, 'Concerne @SarahLockwood', 'Spamming de publications potentiel.', '2023-07-03 08:32:26', '2023-07-03 08:32:26'),
(32, NULL, 'Concerne @SarahLockwood', 'Spamming de publications potentiel.', '2023-07-03 08:33:01', '2023-07-03 08:33:01');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Administrateur', 1, '2023-06-16 11:48:35', '2023-06-16 11:48:35'),
(2, 'Modérateur', 1, '2023-06-16 11:48:35', '2023-06-16 11:48:35'),
(3, 'Utilisateur', 1, '2023-06-16 11:48:35', '2023-06-16 11:48:35');

-- --------------------------------------------------------

--
-- Structure de la table `scores`
--

CREATE TABLE `scores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `score` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sections`
--

INSERT INTO `sections` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Développement', NULL, NULL),
(2, 'Problèmes et erreurs', NULL, NULL),
(3, 'Projets et réalisations', NULL, NULL),
(4, 'Astuces et conseils', NULL, NULL),
(5, 'Ressources', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

CREATE TABLE `status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `experience` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` int(11) NOT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `dark_mode` tinyint(1) NOT NULL DEFAULT 0,
  `messenger_color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `level`, `experience`, `status`, `gender`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `role_id`, `is_active`, `active_status`, `avatar`, `dark_mode`, `messenger_color`) VALUES
(1, '@AnthonyDelmeire', 'Anthony', 'Delmeire', 'anthony@gmail.com', NULL, '$2y$10$WrBSp28zFTZ93Pe6x/pzGe1KiUaHSTMtiFBoLrudpP.VlXwBE0LwW', 9, 60, 1, '/', NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-20 12:12:03', '2023-07-03 08:10:28', 1, 1, 1, '1.jpg', 0, NULL),
(13, '@SarahLockwood', 'Sarah', 'Lockwood', 'sarah@gmail.com', NULL, '$2y$10$ikSuyAI./JUlD.fbC5DLjej32uSz8yYEpjc7oL5yK6x/F0j8gYtKe', 2, 10, 1, '/', NULL, NULL, NULL, 'F6CFS40cM8', NULL, NULL, '2023-07-03 08:24:35', '2023-07-03 08:24:46', 3, 1, 0, '13.jpg', 1, NULL),
(22, '@AnthonyEsek', 'Anthony', 'Esek', 'anthonydelmeire2709@gmail.com', NULL, '$2y$10$5AtEQ7LDYQYACF7NuPqIOeWnErGcZIoOkQ6PqPu.ACMGmtS/4s.KS', 1, 0, 1, '/', NULL, NULL, NULL, 'eP9Iee4I4TMXfAR3pPcckxn60v685H76PvetCtz2P4mKf8fsTlCQdj3p2pUi', NULL, NULL, '2023-07-03 09:12:36', '2023-07-03 09:12:36', 3, 1, 0, 'default.jpg', 1, NULL),
(23, '@JamesSwan', 'James', 'Swan', 'james@gmail.com', NULL, '$2y$10$2wJamaOEA0UcsG/WXiqqJuWh.dO/y1lK1ngPgLg9aipbsB/rZGYtC', 1, 0, 1, '/', NULL, NULL, NULL, 'TSt2Zo3GgCuvZQtdBAVOlWSWgLHQBzCAZkvoc8EgvFDAV24cvxPMhz1Yu1O6', NULL, NULL, '2023-07-03 09:13:55', '2023-07-03 09:13:55', 3, 1, 0, 'default.jpg', 1, NULL),
(24, '@AdelineLavens', 'Adeline', 'Lavens', 'adeline@gmail.com', NULL, '$2y$10$0CyVmMMh.LD6f5fDtkEer.lSKSBzyPZksAUyYNS8Dv/dNXzaHS1Sq', 1, 0, 1, '/', NULL, NULL, NULL, 'DjBHqPVPbwZSAf3zR4JNSfZPFloje5RPXDVy0kP7EExet70um6r8XicfPLnp', NULL, NULL, '2023-07-03 09:15:14', '2023-07-03 09:15:14', 3, 1, 0, 'default.jpg', 1, NULL),
(25, '@AntoineEvrard', 'Antoine', 'Evrard', 'antoine@gmail.com', NULL, '$2y$10$6THaGpqcVWw3vgc8DHY6jOZTWDoezCwixZU844QkbOgJ9pjuxHzKS', 1, 0, 1, '/', NULL, NULL, NULL, 'cA22KDqpKN', NULL, NULL, '2023-07-03 09:17:50', '2023-07-03 09:17:50', 3, 1, 0, 'default.jpg', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users_badges`
--

CREATE TABLE `users_badges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `badge_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users_badges`
--

INSERT INTO `users_badges` (`id`, `user_id`, `badge_id`, `created_at`, `updated_at`) VALUES
(32, 1, 1, NULL, NULL),
(33, 1, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ch_favorites`
--
ALTER TABLE `ch_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ch_messages`
--
ALTER TABLE `ch_messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_author_foreign` (`author`),
  ADD KEY `comments_post_id_foreign` (`post_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `friendships`
--
ALTER TABLE `friendships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `friendships_user_id_index` (`user_id`),
  ADD KEY `friendships_friend_id_index` (`friend_id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_post_id_foreign` (`post_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_user_id_foreign` (`user_id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_index` (`user_id`),
  ADD KEY `notifications_author_id_foreign` (`author_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_author_foreign` (`author`),
  ADD KEY `posts_section_id_foreign` (`section_id`);

--
-- Index pour la table `rapports`
--
ALTER TABLE `rapports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rapports_user_id_foreign` (`user_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scores_user_id_foreign` (`user_id`);

--
-- Index pour la table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Index pour la table `users_badges`
--
ALTER TABLE `users_badges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_badges_user_id_foreign` (`user_id`),
  ADD KEY `users_badges_badge_id_foreign` (`badge_id`);

--
-- Index pour la table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_roles_user_id_foreign` (`user_id`),
  ADD KEY `user_roles_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `badges`
--
ALTER TABLE `badges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `friendships`
--
ALTER TABLE `friendships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT pour la table `rapports`
--
ALTER TABLE `rapports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `status`
--
ALTER TABLE `status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `users_badges`
--
ALTER TABLE `users_badges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_author_foreign` FOREIGN KEY (`author`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Contraintes pour la table `friendships`
--
ALTER TABLE `friendships`
  ADD CONSTRAINT `friendships_friend_id_foreign` FOREIGN KEY (`friend_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `friendships_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_author_foreign` FOREIGN KEY (`author`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `posts_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`);

--
-- Contraintes pour la table `rapports`
--
ALTER TABLE `rapports`
  ADD CONSTRAINT `rapports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Contraintes pour la table `users_badges`
--
ALTER TABLE `users_badges`
  ADD CONSTRAINT `users_badges_badge_id_foreign` FOREIGN KEY (`badge_id`) REFERENCES `badges` (`id`),
  ADD CONSTRAINT `users_badges_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
